<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $fillable = ['subject_id', 'course_id', 'topic', 'sub_topic', 'video'];

    public function subject(){
        $this->belongsTo('App\Subject');
    }

}
