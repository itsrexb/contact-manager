<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactInfo extends Model
{
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
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'accepted_at'];
    

    public function contact(){
        return $this->belongsTo('App\Contact');
    }
}
