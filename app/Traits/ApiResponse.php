<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * Success Response
     *
     * @param mixed $data
     * @param string|null $message
     * @param int $code
     * @return JsonResponse
     */
    protected function successResponse($data, $message = null, $code = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
            'code' => $code
        ], $code);
    }

    /**
     * Error Response
     *
     * @param string|null $message
     * @param int $code
     * @return JsonResponse
     */
    protected function errorResponse($message = null, $code = 500): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => null,
            'code' => $code
        ], $code);
    }
}
