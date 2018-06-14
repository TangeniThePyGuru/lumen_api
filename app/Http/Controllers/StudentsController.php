<?php namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Response;

class StudentsController extends Controller {

    const MODEL = "App\Student";

    use RESTActions;

    /**
     * @param $id
     * @return mixed
     */
	public function remove($id)
	{
		$model = Student::find($id);
		if(is_null($model)){
			return $this->createErrorMessage(Response::HTTP_NOT_FOUND);
		}

		$model->courses()->detach();
		$model->destroy($id);
		return $this->respond(Response::HTTP_OK, "Student with id {$id} has been successfully deleted");
	}

}
