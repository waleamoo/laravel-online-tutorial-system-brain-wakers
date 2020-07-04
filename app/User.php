<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'address', 'phone', 'dob', 'email', 'password', 'is_activated'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // one to many relationship with Enrollment 
    public function enrollments(){
        return $this->hasMany('App\Enrollment');
    }

    public function orders(){
        return $this->hasMany('App\Order');
    }
}
