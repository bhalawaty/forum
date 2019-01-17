<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Illuminate\Http\Request;

class RepliesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *Persist new Reply.
     *
     * @param $channel
     * @param  Thread $thread
     * @return \Illuminate\Http\Response
     */
    public function store($channel,Thread $thread){


        $this->validate(request(),[
            'body'=>'required',
        ]);


        $thread->addreply([
         'body'=>request('body'),
         'user_id'=>auth()->id()

     ]);
     return back();
 }
}
