<?php

namespace App\Traits;

trait JsonResponses
{

    public function successResponse($message = null,$extraParams = [], $status = 200)
    {
        return response()->json(array_merge([
            'success' => true,
            'message' => $message,
        ],$extraParams));
    }

    public function errorResponse($message = null,$extraParams = [], $status = 200)
    {
        return response()->json(array_merge([
            'success' => false,
            'message' => $message,
        ],$extraParams));
    }
}
