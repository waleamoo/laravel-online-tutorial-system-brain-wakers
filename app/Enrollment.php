<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = ['course_id', 'user_id', 'progress'];

    // one to many relationship with user 
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    // one to one relationship with course
    public function course(){
        return $this->belongsTo('App\Course');
    }

}
