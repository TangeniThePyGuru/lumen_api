<?php namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Response;

class CourseStudentsController extends Controller {



//    use RESTActions;

//    const MODEL = "App\CourseStudent";

//    use RESTActions;

	public function all($course)
	{
		$course = Course::find($course);
		return $this->respond(Response::HTTP_OK, $course->students);
	}

	public function get($course, $student)
	{
//		$m = self::MODEL;
		$course = Course::find($course);
		$student = $course->students()->find($student);
		if(is_null($student)){
			return $this->respond(Response::HTTP_NOT_FOUND);
		}
		return $this->respond(Response::HTTP_OK, $student);
	}

//	public function add(Teacher $teacher, Request $request)
//	{
////		$m = self::MODEL;
////		$m::create($request->all())
////		$this->validate($request, Course::$rules);
//		return $this->respond(Response::HTTP_CREATED, $teacher->courses()->attach(Course::create($request->all())));
//	}

//	public function put(Request $request, $teacher, $course)
//	{
////		$m = self::MODEL;
//		$this->validate($request, []);
//		$teacher = Teacher::find($teacher);
//		if(is_null($model)){
//			return $this->respond(Response::HTTP_NOT_FOUND);
//		}
//		$model->update($request->all());
//		return $this->respond(Response::HTTP_OK, $model);
//	}

//	public function remove($id)
//	{
//		$m = self::MODEL;
//		if(is_null($m::find($id))){
//			return $this->respond(Response::HTTP_NOT_FOUND);
//		}
//		$m::destroy($id);
//		return $this->respond(Response::HTTP_NO_CONTENT);
//	}

	protected function respond($status, $data = [])
	{
		return response()->json($data, $status);
	}
}
