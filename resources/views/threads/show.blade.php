@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="form-group">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h4>{{$thread->title}}</h4></div>
                    <div class="card-body">{{$thread->body}}</div>

                </div>
            </div>
        </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 col-md-offset-2 ">
                    @foreach($thread->replies as $reply)
                      @include('threads.reply')
                    @endforeach
        </div>
        </div>

        {{--add comment--}}
        <hr>
@if(auth()->check())
        <div class="row justify-content-center">
            <div class="col-md-8">

                <form action="/threads/{{$thread->channel->slug}}/{{$thread->id}}/replies" method="Post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <textarea type="text" class="form-control" id="body" name="body" placeholder="Add ur Comment" rows="5" ></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                    @include('layouts.errors')

                </form>

            </div>
        </div>
    @else
            <div class="row justify-content-center">
    <p>please <a href="{{route('login')}}">sign in </a> to participate in this discussion </p>
            </div>
    @endif

    </div>
@endsection