<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Events\ChatSent;
use Illuminate\Support\Facades\Session;

class ChatsController extends Controller
{    
    /**
    * Show chats
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return Inertia::render('Chats');
    }
    
    /**
    * Fetch all messages
    *
    * @return Message
    */
    public function fetchChats()
    {
      return Chat::with('user')->get(['id', 'user_id', 'chat']);
    }
    
    /**
     * Persist chat to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendChat(Request $request)
    {
      $user = Auth::user();
    
      $chat = $user->chats()->create([
        'chat' => $request->input('chat')
      ]);
    
      broadcast(new ChatSent($user, $chat))->toOthers();

      Session::flash('success', 'Chat Sent!');
      return ['status' => 'Chat Sent!'];
    }
    
}
