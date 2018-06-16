<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/**
 * Routes for resource teacher
 */
$router->get('teachers', 'TeachersController@all');
$router->get('teachers/{id}', 'TeachersController@get');
$router->post('teachers', 'TeachersController@add');
$router->put('teachers/{id}', 'TeachersController@put');
$router->delete('teachers/{id}', 'TeachersController@remove');

/**
 * Routes for resource student
 */
$router->get('students', 'StudentsController@all');
$router->get('students/{id}', 'StudentsController@get');
$router->post('students', 'StudentsController@add');
$router->put('students/{id}', 'StudentsController@put');
$router->delete('students/{id}', 'StudentsController@remove');

/**
 * Routes for resource course
 */
$router->get('courses', 'CoursesController@all');
$router->get('courses/{id}', 'CoursesController@get');

/**
 * Routes for resource teacher-course
 */
$router->get('teachers/{teacher}/courses', 'TeacherCoursesController@all');
$router->get('teachers/{teacher}/courses/{course}', 'TeacherCoursesController@get');
$router->post('teachers/{teacher}/courses', 'TeacherCoursesController@add');
$router->put('teachers/{teacher}/courses/{course}', 'TeacherCoursesController@put');
$router->delete('teachers/{teacher}/courses/{course}', 'TeacherCoursesController@remove');

/**
 * Routes for resource course-student
 */
$router->get('courses/{course}/students', 'CourseStudentsController@all');
$router->get('courses/{course}/students/{student}', 'CourseStudentsController@get');
$router->post('courses/{course}/students/{student}', 'CourseStudentsController@add');
$router->put('courses/{course}/students/{student}', 'CourseStudentsController@put');
$router->delete('courses/{course}/students/{student}', 'CourseStudentsController@remove');
