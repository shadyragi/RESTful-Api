<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Response;

class apicontroller extends Controller
{
    //
    protected $statuscode = 200;

    public function getStatusCode()
    {
    	return $this->statuscode;
    }
    
    public function setStatusCode($code)
    {
    	$this->statuscode = $code;
    	return $this;
    }

    public function respondNotFound($message = 'not found')
    {
    	return $this->setStatusCode(404)->respondWithError($message);
    }

    public function respondBadRequest($message = 'All Fields Must Be Present')
    {
        return $this->setStatusCode(400)->respondWithError($message);
    }

    public function respondCreated($message = 'Item Has Been Created Successfully')
    {
        return $this->setStatusCode(201)->response([
            'message' => $message
            ]);
    }

    public function respondUpdated($message = 'Item Has Been Updated Successfully')
    {
        return $this->setStatusCode(200)->response([
            'message' => $message
            ]);
    }

    public function respondDeleted($message = "Item Has Been Deleted Successfully")
    {
        return $this->setStatusCode(200)->response([
            'message' => $message
            ]);
    }

    public function response($data)
    {
    	return Response::json($data, $this->statuscode);
    }

    private function respondWithError($message)
    {
    	return $this->response([
    		'error' => [
    				'message' => $message
    			]
    		]);
    }
}
