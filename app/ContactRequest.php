<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactRequest extends Model
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
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'accepted_at'];

    /**
     * The recepient of request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
    	return $this->belongsTo(\App\User::class, 'user_id');
    }

    /**
     * The sender of request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function friend()
    {
    	return $this->belongsTo(\App\User::class, 'friend_user_id');
    }
}
