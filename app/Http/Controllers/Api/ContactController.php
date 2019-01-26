<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Contact;

class ContactController extends Controller
{

	/**
	 * Retrieve list of contacts
	 * 
	 */
	public function list(Request $request)
	{
		$contacts = Contact::all();
		return $contacts;
	}

	/**
	 * Store new contact
	 * 
	 * @return boolean
	 */
	public function storeNewContact(Request $request)
	{
		$input = $request->all();
		
		Contact()->save($input);

		return $input;
	}
}