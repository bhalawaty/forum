<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use App\User;
use http\Env\Response;
use Illuminate\Support\Facades\Auth;


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
    public function store($channel, Thread $thread)
    {


        $this->validate(request(), [
            'body' => 'required',
        ]);


        $thread->addreply([
            'body' => request('body'),
            'user_id' => auth()->id()

        ]);
        return back()->with('flash', 'Reply Set Successfully ');
    }


    public function update(Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->update(request(['body']));
    }


    public function destroy(Reply $reply)
    {

        $this->authorize('update', $reply);
        $reply->delete();

        if (request()->expectsJson()) {
            return Response(['status' => 'success destroy']);
        }
        return back();
    }
}
