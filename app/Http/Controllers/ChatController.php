<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\chat ;

class ChatController extends Controller
{
    public function index ()
    {
        return view('chat-screen');
    }
}
