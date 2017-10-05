<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Carbon\Carbon;

use App\Models\User;
use App\Services\Auth\Token\Token;
use App\Http\Controllers\ApiController;

/**
 * Class TokenController
 * @package App\Http\Controllers\Api
 */
class TokenController extends ApiController
{
    public function store()
    {
        /** @var User $user */
        $user = User::create();
        $token = $user->createToken('web-app');

        /** @var Carbon $expiresAt */
        $expiresAt = $token->token->expires_at;
        return (new Token('Bearer', $expiresAt, $token->accessToken))->asArray();
    }
}