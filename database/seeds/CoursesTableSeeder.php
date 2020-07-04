<?php

use App\Course;
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $course = new Course([
            'course_name' => 'SS1',
            'fee' => '500',
            'subject_id' => '1',
            'benefits' => 'Learn at any time, any day and anywhere | Ask question using the and get response | Access to multiple questions and solutions on topics covered | Take test after every class to master your skill',
            'tutor' => 'Mr. Goodness Etuk',
            'topics' => 'Indices (Part I) | Logarithm of Numbers | Circle Geometry '
        ]);
        $course->save();

        $course = new Course([
            'course_name' => 'SS2',
            'fee' => '500',
            'subject_id' => '1',
            'benefits' => '',
            'tutor' => 'Mr. Goodness Etuk',
            'topics' => ' '
        ]);
        $course->save();

        $course = new Course([
            'course_name' => 'SS3',
            'fee' => '500',
            'subject_id' => '1',
            'benefits' => '',
            'tutor' => 'Mr. Goodness Etuk',
            'topics' => ''
        ]);
        $course->save();

        $course = new Course([
            'course_name' => 'SS2',
            'fee' => '500',
            'subject_id' => '2',
            'benefits' => '',
            'tutor' => '',
            'topics' => ''
        ]);
        $course->save();

        $course = new Course([
            'course_name' => 'SS2',
            'fee' => '500',
            'subject_id' => '2',
            'benefits' => '',
            'tutor' => '',
            'topics' => ''
        ]);
        $course->save();

        $course = new Course([
            'course_name' => 'SS3',
            'fee' => '500',
            'subject_id' => '2',
            'benefits' => '',
            'tutor' => '',
            'topics' => ''
        ]);
        $course->save();

    }
}
