<?php

namespace App\Services;

use App\Enums\LuckyResultEnum;
use App\Models\LuckyResult;
use App\Models\UserLink;
use Illuminate\Database\Eloquent\Collection;

class LuckyGameService
{
    protected array $gameRules = [
        900 => 0.7,
        600 => 0.5,
        300 => 0.3,
        0 => 0.1,
    ];

    /**
     * @param int $randomNumber
     * @return float
     */
    private function calculateWinSum(int $randomNumber): float
    {
        foreach ($this->gameRules as $limit => $winPercent) {
            if ($randomNumber > $limit) {
                return round($randomNumber * $winPercent, 2);
            }
        }

        return 0;
    }

    /**
     * @param UserLink $userLink
     * @return array
     */
    public function play(UserLink $userLink): array
    {
        $winSum = 0;
        $result = LuckyResultEnum::Lose;

        $randomNumber = rand(1, 1000);
        if ($randomNumber % 2 === 0) {
            $result = LuckyResultEnum::Win;
            $winSum = $this->calculateWinSum($randomNumber);
        }

        LuckyResult::create([
            'user_link_id' => $userLink->id,
            'random_number' => $randomNumber,
            'result' => $result->value,
            'win_sum' => $winSum,
        ]);

        return [
            'random' => $randomNumber,
            'result' => $result,
            'winSum' => number_format($winSum, 2),
        ];
    }

    /**
     * @param UserLink $userLink
     * @param int $limit
     * @return Collection
     */
    public function getHistory(UserLink $userLink, int $limit = 3): Collection
    {
        return LuckyResult::where('user_link_id', $userLink->id)
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->take($limit)
            ->get();
    }
}
