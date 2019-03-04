@extends('layouts.app')

@section('content')
    <thread-view :initial-replies-count="{{$thread->replies_count}}" inline-template>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">

                        <div class="card-header">
                            <div class="level">
                                <div class="flex">
                                    <h4>
                                        <a href="{{ Route ('userProfile',$thread->creator)}}">
                                            {{$thread->creator->name}}
                                        </a>
                                        posted :{{$thread->title}}
                                    </h4>
                                </div>
                                @can('update',$thread)

                                    <form action="{{$thread->path()}}" method="post">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-danger">Delete Thread</button>
                                    </form>
                                @endcan
                            </div>

                        </div>

                        <div class="card-body">{{$thread->body}}</div>

                    </div>
                    <hr>

                    <replies :data="{{$thread->replies}}" @removed="repliesCount--"></replies>
                    {{----}}
                    {{--@foreach($replies as $reply)--}}
                    {{--@include('threads.reply')--}}
                    {{--@endforeach--}}

                    {{--{{$replies->links()}}--}}

                    @if(auth()->check())

                        <form action="/threads/{{$thread->channel->slug}}/{{$thread->id}}/replies" method="Post">
                            {{csrf_field()}}
                            <div class="form-group">
                            <textarea type="text" class="form-control" id="body" name="body"
                                      placeholder="Add ur Comment" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                            @include('layouts.errors')

                        </form>

                    @else
                        <div class="row justify-content-center">
                            <p>please <a href="{{route('login')}}">sign in </a> to participate in this discussion </p>
                        </div>
                    @endif
                </div>
                <div class="col-md-4">
                    <div class="card">

                        <div class="card-body">This Thread was published {{$thread->created_at->diffForHumans()}} by <a
                                    href="{{ Route ('userProfile',$thread->creator)}}">{{$thread->creator->name}}</a>
                            and currently has <span
                                    v-text="repliesCount"></span> {{str_plural('comment',$thread->replies_count)}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </thread-view>
@endsection