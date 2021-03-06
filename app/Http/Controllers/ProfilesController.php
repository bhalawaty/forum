<?php

namespace App\Http\Controllers;

use App\Activity;
use App\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
        return view('profiles.show', [
            'userprofile' => $user,
            'activities' => Activity::feed($user)
        ]);
    }

    /**
     * @param User $user
     * @return mixed
     */

}
