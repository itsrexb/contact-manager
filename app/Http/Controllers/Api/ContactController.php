<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

use App\Contact;
use App\ContactInfo;
use App\ContactRequest;
use App\User;
use App\BlockedList;

class ContactController extends Controller
{

	/**
	 * Retrieve list of contacts
	 * 
	 * @param Illuminate\Http\Request
	 */
	public function list(Request $request)
	{
		$search = $request->input('search');
		if (!empty($search)) {
			return Contact::with('info')
				->where('user_id', \Auth::user()->id)
				->where(function($query) use($search){
					$query->where('first_name', 'LIKE', "%{$search}%")
						  ->orWhere('last_name', 'LIKE', "%{$search}%");
				})
				->paginate(25);

		} else {
			return Contact::with('info')
				->where('user_id', \Auth::user()->id)
				->paginate(25);
		}
	}


	/**
	 * Store new contact
	 * 
	 * @param Illuminate\Http\Request
	 * @return boolean
	 */
	public function storeNewContact(Request $request)
	{
		$input = $request->all();
		
		$request->validate([
			'first_name'=>'required',
	        'last_name'=> 'required'
		]);

		$contact = new Contact([
			'user_id'	=> \Auth::user()->id,
			'first_name' => $input['first_name'],
			'last_name' => $input['last_name'],
			'notes'	=> !empty($input['notes']) ? $input['notes'] : ''
		]);
		
		$contact->save();
		$contactId = $contact->id;

		// save contact information
		if ($contactId) {
			if (!empty($input['info']) && is_array($input['info'])) {

				foreach ( $input['info'] as $key => $info ) {
					if (!empty($info['value'])) {
						if ($info['type'] == 'email') {
							if (!filter_var($info['value'], FILTER_VALIDATE_EMAIL)) {
								// invalid email, proceed to next.
								continue;
							}

							// For now, we only check the email if exist.
							// If it is, we request the owner
							$user = User::where('email',$info['value'])->first();

							if (!empty($user)) {
								$contactRequest = new ContactRequest([
									'user_id' => \Auth::user()->id,
									'friend_user_id' => $user['id']
								]);
								$contactRequest->save();
							}
						}

						$info = new ContactInfo([
							'contact_id' => $contactId,
							'type' => !empty($info['custom']) ? $info['custom'] : $info['type'],
							'content' => $info['value']
						]);
						$info->save();
					}
				}
			}
		}

		
		return ['success' => !empty($contactId) ];
	}

	/**
     * Remove the specified contact entry from storage.
     *
     * @param Illuminate\Http\Request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {	
    	$contact = Contact::find($id);
    	$response = false;
    	if (!empty($contact)) {
    		$response = $contact->delete();
    	}
        return ['success' => !empty($response) ];
    }

    /**
     * Display the specified contact.
     *
     * @param Illuminate\Http\Request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
       $contact = Contact::with('info')->where('id', $id)->first();
       return $contact;
    }

    
    /**
     * Display contact request
     *
     * @param Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function contactRequest(Request $request)
    {
       $contact = ContactRequest::with( 
	       					array( 'user' => function($query){
						        $query->select('id','first_name', 'last_name');
						    })
						)
       					->with( 
	       					array( 'friend' =>function($query){
						        $query->select('id','first_name', 'last_name');
						    })
					    )
       					->where('friend_user_id', \Auth::user()->id)
       					->paginate(25);
       return $contact;
    }

    /**
     * Block  contact request
     * @param Illuminate\Http\Request
     * @return boolean
     */
    public function blockUser(Request $request, $id)
    {
		$request = ContactRequest::find($id);
    	$response = false;
    	if ($request) {
    		$request->blocked_at = now();
    		$request->accepted_at = NULL;
    		$response = $request->save();
    	}
    	return [ 'success' => !empty($response) ];
    }

    /**
     * Accept  contact request
     * @param Illuminate\Http\Request
     * @return boolean
     */
    public function acceptUser(Request $request, $id)
    {
    	$request = ContactRequest::find($id);
    	$response = false;
    	if ($request) {
    		$request->accepted_at = now();
    		$request->blocked_at = NULL;
    		$response = $request->save();
    	}
    	return [ 'success' => !empty($response) ];
    }

    /**
     * Add item to blocked list
     */
    public function blockedlist(Request $request)
    {
    	$input = Input::all();

    	$request->validate([
			'type'=>'required',
	        'content'=> 'required'
		]);

    	$blockedlist = new BlockedList([
    		'user_id' => \Auth::user()->id,
    		'type'	=> $input['type'],
    		'content'	=> $input['content'],
    	]);

    	$response =  $blockedlist->save();

    	return [ 'success' => !empty($response) ];
    }

    /**
     * Get all blocked list
     */
    public function getBlockedList(Request $request)
    {
    	return BlockedList::where('user_id', \Auth::user()->id)->paginate(25);
    }


    /**
     * Display all user
     */
    public function getAllUsers()
    {
    	return User::where('id', '!=', \Auth::user()->id)
    			->select('id', 'first_name', 'last_name')
    			->paginate(25);
    }
}