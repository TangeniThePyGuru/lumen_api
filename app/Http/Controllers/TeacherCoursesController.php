<?php namespace App\Http\Controllers;

use App\Course;
use App\Teacher;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class TeacherCoursesController extends Controller {

    const COURSE_MODEL = "App\Course";

    use RESTActions;


	public function all($teacher)
	{
		$teacher = Teacher::find($teacher);

		if ($teacher){
            return $this->respond(Response::HTTP_OK, $teacher->courses);
        }

        return $this->createErrorMessage(Response::HTTP_NOT_FOUND, "Teacher with given id does not exist");
	}

//	public function get($teacher, $course)
//	{
////		$m = self::MODEL;
//		$teacher = Teacher::find($teacher);
//		$course = $teacher->courses()->find($course);
//		if(is_null($course)){
//			return $this->respond(Response::HTTP_NOT_FOUND);
//		}
//		return $this->respond(Response::HTTP_OK, $course);
//	}

	public function add($teacher, Request $request)
	{
	    $teacher = Teacher::find($teacher);

	    if ($teacher){
            $m = self::COURSE_MODEL;
            $this->validate($request, $m::$rules);
//            dd($request->all());
            $course = $m::create(array_merge(
                $request->all(),
                ["teacher_id" => $teacher->id]
            ));

            return $this->respond(Response::HTTP_OK, "The course with id {$course->id} has been created and associated with teacher with id {$teacher->id}");

        }
        return $this->createErrorMessage(Response::HTTP_NOT_FOUND, "Teacher with given id does not exist");
	}

	public function put(Request $request, $teacher, $course)
	{
		$course_model = self::COURSE_MODEL;
		$teacher = Teacher::find($teacher);
		if($teacher){
		    $course = Course::find($course);
		    if ($course){
		        $this->validate($request, $course_model::$rules);

		        $course->title = $request->title;
                $course->description = $request->description;
                $course->value = $request->value;

		        $course->save();
                return $this->respond(Response::HTTP_OK, "Course with id {$course->id} successfully updated");
            }
			return $this->createErrorMessage(Response::HTTP_NOT_FOUND, "Course with given id does not exist");
		}
		return $this->createErrorMessage(Response::HTTP_NOT_FOUND, "Teacher with given id does not exist");
	}

//	public function remove($id)
//	{
//		$m = self::MODEL;
//		if(is_null($m::find($id))){
//			return $this->respond(Response::HTTP_NOT_FOUND);
//		}
//		$m::destroy($id);
//		return $this->respond(Response::HTTP_NO_CONTENT);
//	}

}
