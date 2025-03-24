<?php

namespace App\Http\Middleware;

use App\Services\UserLinkService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidUserLinkToken
{

    public function __construct(protected UserLinkService $userLinkService)
    {
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->route('token');
        $userLink = $this->userLinkService->getByToken($token);
        if (!$userLink) {
            return redirect('/')->withErrors('The link does not exist or expired.');
        }

        $request->attributes->add(['userLink' => $userLink]);

        return $next($request);
    }
}
