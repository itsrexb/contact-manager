<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * Setup HasMany relations to App\ContactInfo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contactInfo()
    {
        return $this->hasMany(ContactInfo::class);
    }


    /**
     * Setup HasMany relations to App\ContactAddress
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contactAddresses()
    {
        return $this->hasMany(ContactAddress::class);
    }
}
