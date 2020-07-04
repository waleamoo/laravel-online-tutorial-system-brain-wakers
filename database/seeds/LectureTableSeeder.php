<?php

use App\Lecture;
use Illuminate\Database\Seeder;

class LectureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lecture = new Lecture([
            'subject_id' => '1',
            'course_id' => '1',
            'topic' => 'Algebra',
            'sub_topic' => 'Expansion',
            'video' => 'link'
        ]);
        $lecture->save();
    }
}
