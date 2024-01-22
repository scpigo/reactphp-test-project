<?php

namespace App\Http\Controllers;

use App\Events\NewMessageAdded;
use App\Http\Controllers\Controller as Controller;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\VarDumper\VarDumper;

class ChatController extends Controller
{
    public function index(int $user_id) {
        $chat = Chat::findByUsersId($user_id, Auth::user()->id);
        if (!$chat) {
            $chat_id = Str::random(12);
            $chat = new Chat();
            $chat->chat_id = $chat_id;
            $chat->user_id = $user_id;
            $chat->user_two_id = Auth::user()->id;
            $chat->save();

            $chat = $chat->chat_id;
        }

        $messages = Message::findMessagesByChatId($chat);
        $friend_name = User::query()->where('id', $user_id)->first()->name;

        return view('chat.index', ['messages' => $messages, 'chat_id' => $chat, 'user_id' => $user_id, 'friend_name' => $friend_name]);
    }
}
