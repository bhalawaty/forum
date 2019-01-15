<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInFormTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_auth_user_can_participate_in_form()
    {

        $this->be(factory('App\User')->create());

        $thread=factory('App\Thread')->create();

        $reply=factory('App\Reply')->make();

        $this->post($thread->path().'/replies',$reply->ToArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}
