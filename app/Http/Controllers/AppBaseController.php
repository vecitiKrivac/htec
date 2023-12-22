<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;

class AppBaseController extends Controller
{
    public function sendResponse($result, $message, $success = true, $code = 200, $var = 'data')
    {
        return Response::json([
            'success' => $success,
            $var => $result,
            'message' => $message
        ], $code);
    }

    public function sendError($error, $code = 404)
    {
        return Response::json([
            'success' => false,
            'message' => $error
        ], $code);
    }

    public function sendSucces($message)
    {
        return Response::json([
            'success' => true,
            'message' => $message
        ], 200);
    }
}
