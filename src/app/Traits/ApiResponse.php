<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * Success Response
     */
    protected function success(
        mixed $data = null,
        string $message = 'Success',
        int $status = 200
    ): JsonResponse {

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'errors' => null,
        ], $status);
    }

    /**
     * Error Response
     */
    protected function error(
        string $message = 'Error',
        mixed $errors = [],
        int $status = 400
    ): JsonResponse {

        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => null,
            'errors' => $errors,
        ], $status);
    }

    /**
     * Created Response
     */
    protected function created(
        mixed $data,
        string $message = 'Created Successfully'
    ): JsonResponse {

        return $this->success(
            $data,
            $message,
            201
        );
    }

    /**
     * No Content Response
     */
    protected function noContent(): JsonResponse
    {
        return response()->json(null, 204);
    }

    /**
     * Unauthorized
     */
    protected function unauthorized(
        string $message = 'Unauthorized'
    ): JsonResponse {

        return $this->error(
            $message,
            [],
            401
        );
    }

    /**
     * Forbidden
     */
    protected function forbidden(
        string $message = 'Forbidden'
    ): JsonResponse {

        return $this->error(
            $message,
            [],
            403
        );
    }

    /**
     * Not Found
     */
    protected function notFound(
        string $message = 'Data not found'
    ): JsonResponse {

        return $this->error(
            $message,
            [],
            404
        );
    }

    /**
     * Validation Error
     */
    protected function validationError(
        mixed $errors,
        string $message = 'Validation Error'
    ): JsonResponse {

        return $this->error(
            $message,
            $errors,
            422
        );
    }

    /**
     * Server Error
     */
    protected function serverError(
        string $message = 'Internal Server Error'
    ): JsonResponse {

        return $this->error(
            $message,
            [],
            500
        );
    }
}
