<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    protected function error(int $code, string $message): JsonResponse
    {
        return response()->json(['message' => $message], $code);
    }
}
