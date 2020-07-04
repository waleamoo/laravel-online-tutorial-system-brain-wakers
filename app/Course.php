<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Subject;

class Course extends Model
{
    protected $fillable = ['course_name', 'fee', 'subject_id', 'benefits', 'tutor', 'topics'];

    public function subject(){
        $this->belongsTo('App\Subject');
    }

    // has one to relationship with course
    public function enrollment(){
        return $this->hasOne('App\Enrollment');
    }
}
