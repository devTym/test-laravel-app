<?php

namespace App\Models;

use App\Enums\LuckyResultEnum;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuckyResult extends Model
{
    /** @use HasFactory<\Database\Factories\LuckyResultFactory> */
    use HasFactory;

    protected $fillable = [
        'user_link_id',
        'random_number',
        'result',
        'win_sum',
    ];

    protected $casts = [
        'result' => LuckyResultEnum::class,
    ];

    public function userLink()
    {
        return $this->belongsTo(UserLink::class);
    }

}
