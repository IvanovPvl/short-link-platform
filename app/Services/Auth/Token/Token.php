<?php

declare(strict_types=1);

namespace App\Services\Auth\Token;

use Carbon\Carbon;

/**
 * Class Token
 * @package App\Services\Auth\Token
 */
class Token
{
    /** @var string */
    private $tokenType;

    /** @var Carbon */
    private $expiresAt;

    /** @var string */
    private $accessToken;

    /**
     * Token constructor.
     *
     * @param string $tokenType
     * @param Carbon $expiresAt
     * @param string $accessToken
     */
    public function __construct($tokenType, Carbon $expiresAt, $accessToken)
    {
        $this->tokenType   = $tokenType;
        $this->expiresAt   = $expiresAt;
        $this->accessToken = $accessToken;
    }

    /**
     * @return string
     */
    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    /**
     * @param string $tokenType
     */
    public function setTokenType(string $tokenType)
    {
        $this->tokenType = $tokenType;
    }

    /**
     * @return Carbon
     */
    public function getExpiresAt(): Carbon
    {
        return $this->expiresAt;
    }

    /**
     * @param Carbon $expiresAt
     */
    public function setExpiresAt(Carbon $expiresAt)
    {
        $this->expiresAt = $expiresAt;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        return [
            'token_type'   => $this->tokenType,
            'expires_at'   => $this->expiresAt->toDateTimeString(),
            'access_token' => $this->accessToken,
        ];
    }
}