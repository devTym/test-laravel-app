<?php

namespace App\Services;

use App\Models\UserLink;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class UserLinkService
{
    /**
     * @param array $data
     * @return UserLink
     */
    public function create(array $data): UserLink
    {
        $token = Str::random(32);

        return UserLink::create([
            'username'         => $data['username'],
            'phonenumber'      => $data['phonenumber'],
            'token'            => $token,
            'token_expires_at' => Carbon::now()->addDays(7),
        ]);
    }

    /**
     * @param string $token
     * @return UserLink|null
     */
    public function getByToken(string $token): ?UserLink
    {
        return UserLink::where('token', $token)
            ->where('token_expires_at', '>', now())
            ->first();
    }

    /**
     * @param string $token
     * @return UserLink|null
     */
    public function createNew(string $token): ?UserLink
    {
        $userLink = $this->getByToken($token);

        if (!$userLink) return null;

        $userLink->update([
            'token' => Str::random(32),
            'token_expires_at' => Carbon::now()->addDays(7),
        ]);

        return $userLink;
    }

    /**
     * @param string $token
     * @return void
     */
    public function deactivateByToken(string $token): void
    {
        $userLink = $this->getByToken($token);

        if ($userLink) {
            $userLink->update([
                'token_expires_at' => now()->subMinute(),
            ]);
        }
    }
}
