<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use ContactInfo;

class Contact extends Model
{
    
    use SoftDeletes;

    /**
     * make all fields fillable except id
     * 
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * mutate date fields
     * 
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Setup BelongsTo relations to App\User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    /**
     * Setup HasMany relations to App\ContactInfo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function info()
    {
        return $this->hasMany(\App\ContactInfo::class);
    }


    /**
     * Get the contact address of the contact
     *
     * @return array
     */
    public function contactAddresses($contactId)
    {
        $contactInfo = new ContactInfo();
        return $contactInfo->where(['type' => 'address', 'id' => $contactId]);
    }

}
