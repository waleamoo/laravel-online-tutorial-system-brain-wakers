<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SubjectTableSeeder::class);
        $this->call(LectureTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
    }
}
