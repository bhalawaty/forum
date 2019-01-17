<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function a_replies_have_owner()
{
    $reply=make('App\Reply');
    $this->assertInstanceOf('App\User',$reply->owner);
}

    /** @test */
    public function a_thread_must_have_body()
    {
        $this->publishThread(['body'=>null])
            ->assertSessionHasErrors('body');
    }
    public function publishThread($check_validate=[]){

        $this->expectException('Illuminate\Validation\ValidationException');
        $this->signIn();
        $thread=make('App\Thread',$check_validate);
        return  $this->post('/threads',$thread->toArray());

    }
}
