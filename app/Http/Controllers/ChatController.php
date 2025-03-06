<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index ()
    {
        return view('chat-screen');
    }
    public function sendmsg (Request $request)
    {
        // dd($request->input());
        event(new \App\Events\chat($request->unme ,$request->chatmessage));
    }
}
