{{--<h5>--}}
    {{--<div class="card-header">--}}
        {{--<a href="#">--}}
            {{--{{$reply->owner->name}}--}}
        {{--</a>--}}
        {{--at ... {{$reply->created_at->diffForHumans()}}</div>--}}
{{--</h5>--}}
{{--<div class="card-body">--}}
    {{--{{$reply->body}}--}}
{{--</div>--}}

<div class="form-group">
<div class="card">
    <div class="card-header">
        <a href="#">
        {{$reply->owner->name}}
            </a>
                at ...
        {{$reply->created_at->diffForHumans()}}
    </div>
    <div class="card-body">
        <p class="card-text">{{$reply->body}}.</p>

    </div>
</div>
</div>