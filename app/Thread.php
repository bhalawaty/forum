<?php

namespace App;

use App\Activity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    use RecordsActivity;

    protected $guarded=[];
    protected $with = ['creator', 'channel'];


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('RepliesCount', function (Builder $builder) {
            $builder->withCount('replies');
        });
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

        return $this->replies()->create($reply);

    }

    public function scopeFilter($query, $filters)
    {

        return $filters->apply($query);
    }



}
