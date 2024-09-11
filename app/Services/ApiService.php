<?php

namespace App\Services;

class ApiService
{
    public function apiResponse($data, $message, $statusCode = 200, $success = true)
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }
}
