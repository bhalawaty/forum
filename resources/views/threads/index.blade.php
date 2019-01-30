@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @foreach($threads as $thread)
                    <div class="form-group">
                        <div class="card">
                            <article>
                                <div class="card-header">
                                    <div class="level">
                                        <h4 class="flex">
                                            <a href="{{$thread->path()}}">
                                                {{$thread->title}}
                                            </a>
                                        </h4>
                                        <strong><a href="{{$thread->path()}}">{{$thread->replies_count}}
                                                {{str_plural('Reply',$thread->replies_count)}}</a> </strong>
                                    </div>

                                    <a href="{{ route('userProfile',$thread->creator)}}">
                                        {{$thread->creator->name}} </a>... at {{$thread->created_at->diffForHumans()}}

                                </div>
                                <div class="card-body">{{$thread->body}}</div>
                            </article>

                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    </div>
@endsection