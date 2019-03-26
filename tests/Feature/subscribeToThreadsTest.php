<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class subscribeToThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_subscribe_To_Threads()
    {
        $thread = create('App\Thread');

        $this->signIn();

        $this->post($thread->path() . '/subscriptions');


        $this->assertCount(1, $thread->fresh()->subscriptions);
//
    }

    /** @test */
    public function a_user_can_unsubscribe_form_Threads()
    {
        $thread = create('App\Thread');

        $this->signIn();

        $this->delete($thread->path() . '/subscriptions');

        $this->assertCount(0, $thread->subscriptions);
    }

}