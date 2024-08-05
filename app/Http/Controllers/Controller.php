<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    protected function error(int $code, string $message)
    {
        return response()->json(['message' => $message], $code);
    }

    protected function response(int $code, $content)
    {
        return response()->json($content, $code);
    }
}
