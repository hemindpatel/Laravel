<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class ResponseController extends Controller
{
    /**
     * @param $response
     * @return \Illuminate\Http\JsonResponse
     * Use : used to return success json response
     */
    public function sendResponse($response)
    {
        return response()->json($response, 200);
    }

    /**
     * @param $error
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     * Use : used to return failed or error json response
     */
    public function sendError($error, $code = 404){
    	$response = [
            'error' => $error,
        ];
        return response()->json($response, $code);
    }
}
