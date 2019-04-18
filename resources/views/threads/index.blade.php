@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @forelse($threads as $thread)
                    <div class="form-group">
                        <div class="card">
                            <article>
                                <div class="card-header">
                                    <div class="level">
                                        <h4 class="flex">
                                            <a href="{{$thread->path()}}">
                                                @if($thread->threadupdate(auth()->user()))
                                                    <strong>{{$thread->title}}</strong>
                                                @else
                                                    {{$thread->title}}
                                                @endif

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
                @empty
                    <h1>there are no threads at this time </h1>
                @endforelse


            </div>
        </div>
    </div>
    </div>
@endsection