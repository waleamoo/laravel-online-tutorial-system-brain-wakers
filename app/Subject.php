<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;

class Subject extends Model
{
    protected $fillable = ['subject_name'];

    public function lectures(){
        $this->hasMany('App\Lecture');
    }

    public function courses(){
        $this->hasMany('App\Course');
    }
}
