<?php

declare(strict_types=1);

namespace App\Services;

/**
 * Class ShortCreator
 * @package App\Services
 */
class ShortCreator
{
    private const NUM = 6;

    /** @var array */
    private $chars = [];

    /**
     * ShortLink constructor.
     */
    public function __construct()
    {
        $this->chars = array_merge($this->chars, range(0, 9));
        $this->chars = array_merge($this->chars, range('a', 'z'));
        $this->chars = array_merge($this->chars, range('A', 'Z'));
    }

    /**
     * @return string
     */
    public function generate(): string
    {
        $result = '';
        for ($i = 0; $i < self::NUM; $i++) {
            $result .= $this->chars[mt_rand(0, count($this->chars) - 1)];
        }

        return $result;
    }
}