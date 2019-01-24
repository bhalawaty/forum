<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */

    /** @test */
    public function guests_may_not_favorite_repleis()
    {

        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('replies/1/favorites')
            ->assertRedirect('/login');
    }

    /** @test */
    public function guests_may_not_favorite_threads()
    {

        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('threads/1/favorites')
            ->assertRedirect('/login');
    }

    /** @test */
    public function An_auth_user_can_favorites_replies()
    {
        $this->signIn();
        $reply = create('App\Reply');

        $this->post('replies/' . $reply->id . '/favorites');

        $this->assertCount(1, $reply->favorites);
    }

    /** @test */
    public function An_auth_user_can_favorites_replies_once()
    {
        $this->signIn();
        $reply = create('App\Reply');
        try {
            $this->post('replies/' . $reply->id . '/favorites');
            $this->post('replies/' . $reply->id . '/favorites');
        } catch (\Exception $e) {
            $this->fail('hhhhhhhhhhhhhhhhh');
        }


        $this->assertCount(1, $reply->favorites);
    }

    /** @test */
    public function An_auth_user_can_favorites_threads()
    {
        $this->signIn();
        $thread = create('App\Thread');

        $this->post('threads/' . $thread->id . '/favorites');

        $this->assertCount(1, $thread->favorites);
    }

    /** @test */
    public function An_auth_user_can_favorites_threads_once()
    {
        $this->signIn();
        $thread = create('App\Thread');
        try {
            $this->post('threads/' . $thread->id . '/favorites');
            $this->post('threads/' . $thread->id . '/favorites');

        } catch (\Exception $e) {
            $this->fail('xxxxxxxxxxxxxx');
        }
        $this->assertCount(1, $thread->favorites);
    }
}
