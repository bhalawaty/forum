@component('profiles.activities.activity')
    @slot('heading')
        {{$userprofile->name}} replied to
        <a href="{{$activity->subject->thread->path() }}">{{$activity->subject->thread->title }}</a>
    @endslot

    @slot('body')
        <div class="card-body">{{$activity->subject->body}}</div>
    @endslot
@endcomponent