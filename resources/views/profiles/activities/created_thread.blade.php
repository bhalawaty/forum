@component('profiles.activities.activity')
    @slot('heading')
        {{$userprofile->name}} published
        <a href="{{$activity->subject->path() }}">{{$activity->subject->title }}</a>
    @endslot

    @slot('body')
        <div class="card-body">{{$activity->subject->body}}</div>
    @endslot
@endcomponent