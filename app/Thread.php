<?php

namespace App;

use App\Activity;
use App\Notifications\ThreadWasUpdated;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    use RecordsActivity;

    protected $guarded=[];
    protected $with = ['creator', 'channel'];
    protected $appends = ['isSubscribedTo'];

    protected static function boot()
    {
        parent::boot();

//        static::addGlobalScope('RepliesCount', function (Builder $builder) {
//            $builder->withCount('replies');
//        });
        static::deleting(function ($thread) {
            $thread->replies->each->delete();
        });


    }

    public function path(){
        return '/threads/'.$this->Channel->slug.'/'.$this->id;
    }


    public function replies(){
        return $this->hasMany(Reply::class);
    }


    public function creator(){

        return $this->belongsTo(User::class,'user_id');
    }

    public function channel(){

        return $this->belongsTo(Channel::class);
    }

    public function addreply($reply){

        $reply = $this->replies()->create($reply);

        $this->notifySubscribers($reply);
        return $reply;
    }

    public function notifySubscribers($reply)
    {
        $this->subscriptions
            ->where('user_id', '!=', $reply->user_id)
            ->each(function ($sub) use ($reply) {
                $sub->user->notify(new ThreadWasUpdated($this, $reply));
            });
    }

    public function scopeFilter($query, $filters)
    {

        return $filters->apply($query);
    }

    public function subscribe($userId = null)
    {
        $this->subscriptions()->create([
            'user_id' => $userId ?: auth()->id()
        ]);

        return $this;
    }

    public function unsubscribe($userId = null)
    {
        $this->subscriptions()->where('user_id', $userId ?: auth()->id())->delete();
    }


    public function subscriptions()
    {
        return $this->hasMany(ThreadSubscriptions::class);
    }

    public function getIsSubscribedToAttribute()
    {
        return $this->subscriptions()
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function threadupdate()
    {

        $key = sprintf("users.%s.visits.%s", auth()->id(), $this->id);

        return $this->updated_at > cache($key);
    }
}
