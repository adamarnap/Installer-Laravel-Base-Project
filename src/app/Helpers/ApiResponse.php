<?php

namespace App\Helpers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;

class ApiResponse
{

    public static function success($data = [], string $message = 'Success', int $status = 200): JsonResponse
    {
        $base_response = [
            'status'  => 'success',
            'message' => $message,
            'data'    => $data,
        ];

        if ($data instanceof LengthAwarePaginator) {
            $base_response['data'] = $data->items();
            $base_response['pagination'] = [
                'next_page' => $data->nextPageUrl() == null ? null : explode("=", $data->nextPageUrl())[1],
                'prev_page' => $data->previousPageUrl() == null ? null : explode("=", $data->previousPageUrl())[1],
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'per_page' => $data->perPage(),
                'to' => $data->lastItem(),
                'from' => $data->firstItem(),
                'total' => $data->total(),
            ];
        }

        $response = response()->json($base_response, $status);

        return $response;
    }

    public static function error(string $message = 'Error', int $status = 400, $errors = []): JsonResponse
    {
        if ($status == 0) {
            $status = 500;
        }
        $response = response()->json([
            'status'  => 'error',
            'message' => $message,
            'errors'  => $errors,
        ], $status);

        return $response;
    }

    public static function unauthorized(string $message = 'Unauthorized', $errors = []): JsonResponse
    {
        return self::error($message, 401, $errors);
    }

    public static function unauthenticated(string $message = 'Unauthenticated', $errors = []): JsonResponse
    {
        return self::error($message, 401, $errors);
    }

    public static function forbidden(string $message = 'Forbidden'): JsonResponse
    {
        return self::error($message, 403);
    }

    public static function validation(array|\Illuminate\Support\MessageBag $errors, string $message = 'Validation failed'): JsonResponse
    {
        return self::error($message, 422, $errors);
    }

    public static function notFound(string $message = "Not Found", $errors = []): JsonResponse
    {
        return self::error($message, 404, $errors);
    }
}
