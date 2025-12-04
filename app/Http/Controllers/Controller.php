<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;


abstract class Controller
{
    use AuthorizesRequests, ValidatesRequests;

    protected function successResponse($data, $message = 'Success', $statusCode = 200): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }
}
