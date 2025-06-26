<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        // Handle API routes
        if ($request->expectsJson() || $request->is('api/*')) {

            // Handle validation exceptions
            if ($exception instanceof ValidationException) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $exception->errors()
                ], 422);
            }

            // Handle authentication exceptions
            if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
                return response()->json([
                    'message' => 'Unauthenticated',
                    'error' => 'INVALID_TOKEN'
                ], 401);
            }

            // Handle authorization exceptions
            if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
                return response()->json([
                    'message' => 'Unauthorized',
                    'error' => 'ACCESS_DENIED'
                ], 403);
            }

            // Handle model not found exceptions
            if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return response()->json([
                    'message' => 'Resource not found',
                    'error' => 'NOT_FOUND'
                ], 404);
            }

            // Handle general exceptions
            if ($exception instanceof \Exception) {
                return response()->json([
                    'message' => 'Something went wrong',
                    'error' => 'SERVER_ERROR'
                ], 500);
            }
        }

        return parent::render($request, $exception);
    }
}
