<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;


    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->thread=factory('App\Thread')->create();
    }

    /** @test */
    public function A_user_can_view_all_threads()
    {

        $response = $this->get('/threads')
                    ->assertSee($this->thread->title);
    }

    /** @test */
    public function A_user_can_view_single_thread()
    {
        $this->get($this->thread->path())
                ->assertSee($this->thread->title);
    }

   /** @test */

   public function a_user_can_see_all_replies_accosiated_with_thread(){

       $reply=factory('App\Reply')->create(['thread_id'=>$this->thread->id]);

       $this->get($this->thread->path())
           ->assertSee($reply->body);


   }





}