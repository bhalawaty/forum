<?php

namespace Tests\Feature;

use Illuminate\Notifications\DatabaseNotification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NotificationsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->signIn();
    }

    /** @test */
    public function a_subscribe_user_can_get_notifications_from_thread_we_anyone_left_reply()
    {


        $thread = create('App\Thread')->subscribe();

        $this->assertCount(0, auth()->user()->notifications);

        $thread->addReply([
            'user_id' => auth()->id(),
            'body' => 'yaaa ciciiiiiiiiiiiiiii'
        ]);

        $this->assertCount(0, auth()->user()->fresh()->notifications);

        $thread->addReply([
            'user_id' => create('App\User')->id,
            'body' => 'yaaa ciciiiiiiiiiiiiiii'
        ]);

        $this->assertCount(1, auth()->user()->fresh()->notifications);
    }

    /** @test */
    public function a_user_can_fetch_their_unread_notification()
    {


        create(DatabaseNotification::class);

        $user = auth()->user();

        $this->assertCount(1, $this->getJson("/profiles/{$user->name}/notifications/")->json());

    }

    /** @test */
    public function a_user_can_mark_their_notification_as_read()
    {


        create(DatabaseNotification::class);

        $user = auth()->user();

        $this->assertCount(1, $user->unreadNotifications);

        $this->delete("/profiles/{$user->name}/notifications/" . $user->unreadNotifications->first()->id);

        $this->assertCount(0, $user->fresh()->unreadNotifications);
    }
}