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
    public function guests_may_not_create_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $thread = make('App\Thread');
        $this->post('/threads', $thread->toArray());

    }

    /** @test */
    public function a_auth_user_can_participate_in_form()
    {

        $this->signIn();

        $thread=create('App\Thread');

        $reply=create('App\Reply');

        $this->post($thread->path().'/replies',$reply->ToArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
        }
}
