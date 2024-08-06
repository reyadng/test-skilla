<?php

namespace App\Http\Controllers\Api\Passport;

use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthorizedAccessTokenController extends \Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController
{
    public function forUserAll(Request $request)
    {
        $tokens = $this->tokenRepository->forUser($request->user()->getAuthIdentifier());

        return $tokens->load('client')->filter(function ($token) {
            return !$token->revoked && $token->expires_at->greaterThan(Carbon::now());
        })->values()
            ->map(fn($token) => $token->only(['id', 'client_id', 'name', 'created_at', 'updated_at', 'expires_at']));
    }
}
