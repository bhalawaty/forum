<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->thread = create('App\Thread');
    }

    /** @test */
    public function a_thread_has_replies()
    {

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    /** @test */
    public function a_thread_have_creator()
    {

        $this->assertInstanceOf('App\User', $this->thread->creator);
    }


    /** @test */
    public function a_thread_belongs_to_channel()
    {

        $this->assertInstanceOf('App\Channel', $this->thread->channel);

    }

    /** @test */
    public function a_thread_must_have_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_thread_must_have_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function a_thread_must_have_channel()
    {
        factory('App\Channel', 2)->create();

        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 6575675])
            ->assertSessionHasErrors('channel_id');


    }


    public function publishThread($check_validate = [])
    {

        $this->expectException('Illuminate\Validation\ValidationException');
        $this->signIn();
        $thread = make('App\Thread', $check_validate);
        return $this->post('/threads', $thread->toArray());

    }

    /** @test */
    public function a_thread_can_be_subscribed_to()
    {
        $thread = create('App\Thread');

        $thread->subscribe($userId = 1);

        $this->assertEquals(1,
            $thread->subscriptions()->where('user_id', $userId)->count());
    }

    /** @test */
    public function a_thread_can_be_unsubscribed_from()
    {
        $thread = create('App\Thread');

        $thread->subscribe($userId = 1);
        $thread->unsubscribe($userId);

        //dd($thread->subscriptions()->count());
        $this->assertEquals(0, $thread->subscriptions()->count());
    }
}


