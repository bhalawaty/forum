<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storereply(Reply $reply)
    {

        $reply->favorite();
        return back();
    }

    public function storethread(Thread $thread)
    {
        $thread->favorite();
        return back();
    }
}
