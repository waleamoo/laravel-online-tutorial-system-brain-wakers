<?php

use App\Subject;
use Illuminate\Database\Seeder;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subject = new Subject([
            'subject_name' => 'Mathematics'
        ]);
        $subject->save();

        $subject = new Subject([
            'subject_name' => 'English Language'
        ]);
        $subject->save();
    }
}
