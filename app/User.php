<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * @var array
     */
    protected  $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Setup HasMany relations to App\Contact
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }


    /**
     * Setup HasMany relations to App\Contact
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contactRequests()
    {
        return $this->hasMany(ContactRequest::class);
    }

    /**
     * Setup HasMany relations to App\Contact
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sentContactRequests()
    {
        return $this->hasMany(ContactRequest::class, 'friend_user_id');
    }

    /**
     * Setup HasMany relations to App\BlockedList
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blockedLists()
    {
        return $this->hasMany(BlockedList::class);
    }

}
