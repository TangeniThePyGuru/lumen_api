<?php namespace App\Http\Controllers;

use App\Student;
use App\Teacher;
use Illuminate\Http\Response;

class TeachersController extends Controller {

    const MODEL = "App\Teacher";

    use RESTActions;

    /**
     * @param $id
     * @return mixed
     */
    public function remove($id)
    {
        $model = Teacher::find($id);
        if(is_null($model)){
            return $this->createErrorMessage(Response::HTTP_NOT_FOUND);
        }

        $courses = $model->courses;
        if (sizeof($courses) > 0){
//            409 represents a conflict request
            return $this->createErrorMessage(Response::HTTP_CONFLICT,'You can\'t remove a teacher with active subscriptions. Please remove those courses first');
        }else{

            $model->destroy($id);
            return $this->respond(Response::HTTP_OK, "Teacher with id {$id} has been successfully deleted");
        }
    }

}
