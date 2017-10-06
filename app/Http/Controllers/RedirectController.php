<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

use App\Models\Link;
use App\Exceptions\LinkNotFoundException;

/**
 * Class IpGeoController
 * @package App\Http\Controllers
 */
class RedirectController extends Controller
{
    public function perform(string $short)
    {
        /** @var Link $link */
        $link = Link::where('short', $short)->first();
        if (!$link) {
            throw new LinkNotFoundException();
        }

        return redirect($link->original);
    }
}