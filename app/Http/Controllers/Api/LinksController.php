<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Models\Link;
use App\Http\Controllers\ApiController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LinksController
 * @package App\Http\Controllers\Api
 */
class LinksController extends ApiController
{
    public function store(Request $request)
    {
        $request->validate([
            'original' => 'required|url',
        ]);

        $original = $request->input('original');

        /** @var Link $link */
        $link = Link::store($original, $this->currentUser->id);

        $responseData = [
            'short'      => env('APP_URL') . '/' . $link->short,
            'original'   => $original,
            'created_at' => $link->created_at->toDateTimeString(),
        ];

        return response($responseData, Response::HTTP_CREATED);
    }
}