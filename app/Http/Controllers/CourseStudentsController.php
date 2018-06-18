<?php namespace App\Http\Controllers;

use App\Course;
use App\Student;
use Illuminate\Http\Response;

class CourseStudentsController extends Controller {



//    use RESTActions;

//    const MODEL = "App\CourseStudent";

    use RESTActions;

	public function all($course)
	{
		$course = Course::find($course);
		if ($course){
            return $this->respond(Response::HTTP_OK, $course->students);
        }

        return $this->createErrorMessage(Response::HTTP_NOT_FOUND, "Course with given id does not exist");

	}

//	public function get($course, $student)
//	{
//		$course = Course::find($course);
//		$student = $course->students()->find($student);
//		if(is_null($student)){
//			return $this->respond(Response::HTTP_NOT_FOUND);
//		}
//		return $this->respond(Response::HTTP_OK, $student);
//	}

	public function add($course, $student)
	{
//	    check if course exist
        $course = Course::find($course);

        if ($course){
//            check if student exist
            $student = Student::find($student);

            if ($student){
//                 check if this student exists in the course
                if ($course->students()->find($student->id)){
                   return $this->createErrorMessage(Response::HTTP_CONFLICT, "Student with id {$student->id} already exists in this course");
                }
//                add student to course
                $course->students()->attach($student->id);
                return $this->respond(Response::HTTP_CREATED, "Student with id {$student->id} successfully added to course");
            }
            return $this->createErrorMessage(Response::HTTP_NOT_FOUND, "Student with given id does not exist");

        }
		return $this->createErrorMessage(Response::HTTP_NOT_FOUND, "Course with given id does not exist");
	}

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

	public function remove($course, $student)
	{

//	    check if course exist
        $course = Course::find($course);

        if ($course){
//            check if student exist
            $student = Student::find($student);

            if ($student){
//                 check if this student exists in the course
                if ($course->students()->find($student->id)){
//                remove student from course
                    $course->students()->detach($student->id);
                    return $this->createErrorMessage(Response::HTTP_CONFLICT, "Student with id {$student->id} successfully removed from the course with id {$course->id}");
                }

                return $this->respond(Response::HTTP_CREATED, "Student with id {$student->id} does not exist in the course with id {$course->id}");
            }
            return $this->createErrorMessage(Response::HTTP_NOT_FOUND, "Student with given id does not exist");

        }
        return $this->createErrorMessage(Response::HTTP_NOT_FOUND, "Course with given id does not exist");
	}

}
