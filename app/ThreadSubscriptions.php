<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThreadSubscriptions extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTO(User::class);
    }
}

