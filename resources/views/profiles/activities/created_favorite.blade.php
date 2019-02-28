@component('profiles.activities.activity')
    @slot('heading')
        {{$userprofile->name}} favorite a
        <a href="{{$activity->subject->favorited->path() }}">reply</a>
    @endslot

    @slot('body')
        <div class="card-body">{{$activity->subject->favorited->body}}</div>
    @endslot
@endcomponent