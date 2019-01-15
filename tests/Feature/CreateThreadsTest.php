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
    public function an_auth_user_can_make_thread()
    {
        $this->be(factory('App\User')->create());
            $thread=factory('App\Thread')->make();

            $this->post('/threads',$thread->ToArray());
                $this->get($thread->path())
                    ->assertSee($thread->title)
                    ->assertSee($thread->body);

    }
}
