<?php

namespace App\Traits;

trait ApiResponse
{
    /**
     * Return a successful JSON response with locale
     */
    protected function successResponse($data = null, string $message = 'Success', int $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'locale' => app()->getLocale(),
        ], $code);
    }

    /**
     * Return an error JSON response
     */
    protected function errorResponse(string $message = 'Error', int $code = 400, $errors = null)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
            'locale' => app()->getLocale(),
        ], $code);
    }

    /**
     * Return a validation error response
     */
    protected function validationErrorResponse($errors)
    {
        return response()->json([
            'success' => false,
            'message' => __('ui.messages.error'),
            'errors' => $errors,
            'locale' => app()->getLocale(),
        ], 422);
    }
}
