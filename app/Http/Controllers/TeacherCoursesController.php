<?php namespace App\Http\Controllers;

use App\Course;
use App\Teacher;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class TeacherCoursesController extends Controller {

//    const MODEL = "App\Course";

//    use RESTActions;

	public function all($teacher)
	{
		$teacher = Teacher::find($teacher);
		return $this->respond(Response::HTTP_OK, $teacher->courses);
	}

	public function get($teacher, $course)
	{
//		$m = self::MODEL;
		$teacher = Teacher::find($teacher);
		$course = $teacher->courses()->find($course);
		if(is_null($course)){
			return $this->respond(Response::HTTP_NOT_FOUND);
		}
		return $this->respond(Response::HTTP_OK, $course);
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
