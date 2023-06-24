<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\General\PosCode;
use App\Models\General\PosDetail;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class BaseAPIController extends Controller
{

    public function sendResponse($data, $message="",$code = 200)
    {
        $headers  = [
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset'      => 'utf-8',
        ];
        $response = [
            'success' => true,
            'message'       => $message,
            'data'          => $data,
        ];
        return response()
            ->json($response, 200, $headers, JSON_UNESCAPED_UNICODE);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $headers  = [
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset'      => 'utf-8',
        ];
        $response = [
            'success' => false,
            'message' => $error,
            'errors' => $errorMessages,
        ];

        return response()->json($response, $code, $headers, JSON_UNESCAPED_UNICODE);
    }

    public function catchError($ex)
    {
        $headers  = [
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset'      => 'utf-8',
        ];
        $response = [
            'code'      => 500,
            'message'       => $ex->getMessage(),
            'data'          => ($ex->getTraceAsString()),
        ];

        return response()->json($response, 200, $headers, JSON_UNESCAPED_UNICODE);
    }

    public function validationError($validator)
    {
        return $this->sendError('validation error',$validator->errors(), 422);

    }

    public function unAuthError()
    {
        return $this->sendError([], 1, 403);

    }


}




