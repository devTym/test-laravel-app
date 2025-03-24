<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLinkRegisterRequest;
use App\Services\UserLinkService;
use Illuminate\Http\Request;


class UserLinkController extends Controller
{
    public function __construct(protected UserLinkService $userLinkService)
    {
    }

    public function registerForm()
    {
        return view('user_link.register_form');
    }

    public function register(UserLinkRegisterRequest $request)
    {
        $userLink = $this->userLinkService->create($request->validated());

        return redirect()->route('userLink.show', ['token' => $userLink->token])
            ->with('message', 'Your unique link: ' . url("/link/{$userLink->token}"));
    }

    public function show($token, Request $request)
    {
        $userLink = $request->get('userLink');

        return view('user_link.show', compact('userLink'));
    }

    public function generateNewLink($token, Request $request)
    {
        $userLink = $this->userLinkService->createNew($token);

        return redirect()->route('userLink.show', ['token' => $userLink->token])
            ->with('message', 'New link generated!');
    }

    public function deactivate($token, Request $request)
    {
        $this->userLinkService->deactivateByToken($token);

        return redirect('/')->with('message', 'Your link has been deactivated!.');
    }
}
