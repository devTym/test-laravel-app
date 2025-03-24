<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLink extends Model
{
    /** @use HasFactory<\Database\Factories\UserLinkFactory> */
    use HasFactory;

    protected $fillable = [
        'username',
        'phonenumber',
        'token',
        'token_expires_at'
    ];

    public function luckyResults()
    {
        return $this->hasMany(LuckyResult::class);
    }
}
