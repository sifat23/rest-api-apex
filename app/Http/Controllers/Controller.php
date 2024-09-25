<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendSuccessJson(mixed $result, int $statusCode = 200, $pagination = []): \Illuminate\Http\JsonResponse
    {
        $response = [
            'data' => $result,
        ];

        if (! empty($pagination)) {
            $response['pagination'] = $pagination;
        }

        return response()->json($response, $statusCode);
    }

    public function sendErrorJson(array $errors, int $statusCode): \Illuminate\Http\JsonResponse
    {
        $response = [
            'errors' => $errors,
        ];

        return response()->json($response, $statusCode);
    }
}
