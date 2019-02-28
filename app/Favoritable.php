<?php
/**
 * Created by PhpStorm.
 * User: Bilal Halawaty
 * Date: 28-Feb-19
 * Time: 2:50 AM
 */

namespace App;


trait Favoritable
{
    public static function bootFavoritable()
    {
        static::deleting(function ($model) {
            $model->favorites->each->delete();
        });
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

    public function unfavorite()
    {

        $attributes = ['user_id' => auth()->id()];
        $this->favorites()->where($attributes)->get()->each(function ($favorite) {
            $favorite->delete();
        });

    }

    /**
     *determine if current reply has been favorited.
     *
     * @return boolean
     */
    public function isFavored()
    {
        return !!$this->favorites->where('user_id', auth()->id())->count();

    }

    public function getIsFavoredAttribute()
    {
        return $this->isFavored();
    }

    public function getFavoritesCountAttribute()
    {

        return $this->favorites->count();
    }
}