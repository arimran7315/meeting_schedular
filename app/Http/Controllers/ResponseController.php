<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function SuccessResponse($result, $message){
        $response = [
            'success' =>true,
            'message' => $message,
            'data' => $result
        ];

        return response()->json($response,200);
    }
    public function ErrorResponse($error, $errorMessage = [], $code = 404){
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if(!empty($errorMessage)){
            $response['data'] = $errorMessage;
        }
        return response()->json($response, $code);
    }
}
