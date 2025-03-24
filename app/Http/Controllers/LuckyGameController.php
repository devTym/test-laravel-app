<?php

namespace App\Http\Controllers;

use App\Services\LuckyGameService;
use App\Services\UserLinkService;
use Illuminate\Http\Request;

class LuckyGameController extends Controller
{
    public function __construct(
        protected UserLinkService $userLinkService,
        protected LuckyGameService $luckyGameService
    ) {}


    public function imFeelingLucky($token, Request $request)
    {
        $userLink = $request->get('userLink');
        $result = $this->luckyGameService->play($userLink);

        return redirect()->route('userLink.show', ['token' => $userLink->token])
            ->with('lucky', $result);
    }

    public function history($token, Request $request)
    {
        $userLink = $request->get('userLink');
        $results = $this->luckyGameService->getHistory($userLink);

        return view('lucky_game.history', compact('results'));
    }
}
