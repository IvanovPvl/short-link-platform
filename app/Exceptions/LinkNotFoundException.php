<?php

declare(strict_types=1);

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class LinkNotFoundException
 * @package App\Exceptions
 */
class LinkNotFoundException extends ModelNotFoundException
{
    protected $message = 'Link not found.';

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function render()
    {
        return response()->json(['error' => ['message' => $this->message]], Response::HTTP_NOT_FOUND);
    }
}