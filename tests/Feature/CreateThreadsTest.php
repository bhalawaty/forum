<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */

    /** @test */
    public function guests_may_not_create_threads()
    {

        $this->expectException('Illuminate\Auth\AuthenticationException');
        $thread = make('App\Thread');
        $this->post('/threads', $thread->toArray());
    }

    /** @test */
    public function an_auth_user_can_make_thread()
    {
        $this->signIn();

            $thread=make('App\Thread');
        $response=$this->post('/threads',$thread->toArray());
        $dd = $response->headers->get('location');
        $this->get($dd)
                    ->assertSee($thread->title)
                    ->assertSee($thread->body);

    }
}
