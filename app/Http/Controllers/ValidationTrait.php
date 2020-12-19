<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ValidationTrait
{
    protected function createValidationErrorView($validationErrors): JsonResponse
    {
        return $this->view([
            'errors' => $this->buildValidationErrors($validationErrors->toArray()),
        ], Response::HTTP_BAD_REQUEST);
    }

    protected function buildValidationErrors(array $validationErrors): array
    {
        $errors = [];

        foreach ($validationErrors as $key => $validationError) {
            $errors[] = [
                'property' => $key,
                'message' => $validationError,
            ];
        }

        return $errors;
    }
}
