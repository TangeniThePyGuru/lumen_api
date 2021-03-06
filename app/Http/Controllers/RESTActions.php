<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

trait RESTActions {


    public function all()
    {
        $m = self::MODEL;
        return $this->respond(Response::HTTP_OK, $m::all());
    }

    public function get($id)
    {
        $m = self::MODEL;
        $model = $m::find($id);
        if(is_null($model)){
            return $this->createErrorMessage(Response::HTTP_NOT_FOUND);
        }
        return $this->respond(Response::HTTP_OK, $model);
    }

    public function add(Request $request)
    {
        $m = self::MODEL;
        $this->validate($request, $m::$rules);
        return $this->respond(Response::HTTP_CREATED, $m::create($request->all()));
    }

    public function put(Request $request, $id)
    {
        $m = self::MODEL;
        $model = $m::find($id);
        if(is_null($model)){
            return $this->createErrorMessage(Response::HTTP_NOT_FOUND,'Resource with id '.$id. ' not found.');
        }
		$this->validate($request, $m::$rules);
        $model->update($request->all());
        return $this->respond(Response::HTTP_OK, $model);
    }

    public function remove($id)
    {
        $m = self::MODEL;
        if(is_null($m::find($id))){
            return $this->createErrorMessage(Response::HTTP_NOT_FOUND);
        }
        $m::destroy($id);
        return $this->respond(Response::HTTP_NO_CONTENT);
    }

	/**
	 * respond with data
	 * @param $status
	 * @param array $data
	 * @return mixed
	 */
    protected function respond($status, $data = [])
    {
        return response()->json(['data' => $data], $status);
    }

	/**
	 * respond with error messages
	 * @param $code
	 * @param null $message
	 * @return mixed
	 */
	public function createErrorMessage($code, $message = null){
		return response()->json(['message' => ($message) ? $message : 'Resource does not exist', 'code' => $code ], $code);
	}

	/**
	 * respond with validation error messages
	 * @param Request $request
	 * @param array $errors
	 * @return mixed
	 */
	protected function buildFailedValidationResponse(Request $request, array $errors)
	{
		return $this->createErrorMessage( 422, $errors);
	}
}
