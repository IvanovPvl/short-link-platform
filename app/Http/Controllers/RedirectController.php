<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Models\Link;
use App\Models\Stat;
use App\Exceptions\LinkNotFoundException;

/**
 * Class IpGeoController
 * @package App\Http\Controllers
 */
class RedirectController extends Controller
{
    public function perform(Request $request, string $short)
    {
        /** @var Link $link */
        $link = Link::where('short', $short)->first();
        if (!$link) {
            throw new LinkNotFoundException();
        }

        Stat::store($request, $link->id);

        return redirect($link->original);
    }
}