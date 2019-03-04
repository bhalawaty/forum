<?php

namespace App\Filters;

use App\User;

class ThreadFilters extends Filters
{

    protected $filters = ['by', 'popular', 'unpopular'];


    protected function by($username)
    {

        if (User::where('name', $username)->count() == 0) {
            dd('مفيش حد هنا بالاسم دا ');
        };

        $user = User::where('name', $username)->firstOrFail();

        return $this->query->where('user_id', $user->id);

    }

    protected function popular()
    {
        $this->query->getQuery()->orders = [];
        return $this->query->orderBy('replies_count', 'desc');
    }

    protected function unpopular()
    {

        return $this->query->where('replies_count', 0);
    }

}