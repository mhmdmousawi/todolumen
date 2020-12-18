<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ], Response::HTTP_OK);
    }

    protected function view($data = null, int $statusCode = null, array $headers = []): JsonResponse
    {
        return response()->json($data, $statusCode, $headers);
    }

    protected function createGenericErrorView(
        $message = null,
        $statusCode = Response::HTTP_BAD_REQUEST,
        array $headers = []
    ): JsonResponse {
        $error = [
            'errors' => [
                ['message' => $message],
            ],
        ];

        return $this->view($error, $statusCode, $headers);
    }
}
