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

    	\Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS = 0');

		\App\Teacher::truncate();
		\App\Student::truncate();
		\App\Course::truncate();

//		truncate the pivot table
		\Illuminate\Support\Facades\DB::table('course_student')->truncate();

		factory(\App\Teacher::class, 50)->create();
//		dd('testing');
		factory(\App\Student::class, 500)->create();

		factory(\App\Course::class, 40)->create()->each(function (\App\Course $course){
			$course->students()->attach(array_rand(range(1, 500),40));
		});

        // $this->call('UsersTableSeeder');
    }
}
