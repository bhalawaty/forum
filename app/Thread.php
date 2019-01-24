<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    protected $guarded=[];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('RepliesCount', function (Builder $builder) {
            $builder->withCount('replies');
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


    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite()
    {
        $attributes = ['user_id' => auth()->id()];

        if (!$this->favorites()->where($attributes)->exists()) {

            return $this->favorites()->create($attributes);
        }

    }

}
