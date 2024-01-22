<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'user_id',
    ];

    public static function findByUsersId(int $user_id, int $user_two_id)
    {
        $chat = Chat::query()->where('user_id', $user_id)->where('user_two_id', $user_two_id)->first();

        if (!$chat) {
            $chat = Chat::query()->where('user_id', $user_two_id)->where('user_two_id', $user_id)->first();
            if (!$chat) {
                return null;
            }
        }

        return $chat->chat_id;
    }
}
