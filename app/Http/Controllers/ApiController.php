<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

use App\Models\User;

/**
 * Class ApiController
 * @package App\Http\Controllers
 */
class ApiController extends BaseController
{
    /** @var User */
    protected $currentUser;

    /**
     * ApiController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->middleware(function (Request $request, \Closure $next) {
            $this->currentUser = $request->user();

            return $next($request);
        });
    }
}