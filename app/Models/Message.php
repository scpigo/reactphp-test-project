<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'author_id',
        'content'
    ];

    protected $appends = [
        'author_name',
    ];

    public function getAuthorNameAttribute()
    {
        return User::query()->where('id', $this->author_id)->first()->name;
    }

    public static function findMessagesByChatId(string $chat_id)
    {
        return Message::query()->where('chat_id', $chat_id)->get();
    }
}
