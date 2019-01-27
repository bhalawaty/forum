
<div class="form-group">
    <div class="card">
        <div class="card-header">
            <div class="level" style="align-items: center;display: flex">
                <h4 class="flex" style="flex: 1">
                    <a href="#">
                        {{$reply->owner->name}}
                    </a> at ...
                    {{$reply->created_at->diffForHumans()}}
                </h4>
                <form method="POST" action="/replies/{{$reply->id}}/favorites">
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-default" {{$reply->isFavored() ? 'disabled': ' '}}>
                        {{$reply->favorites_count }}    {{str_plural('favorite',$reply->favorites_count)}}
                    </button>

                </form>
            </div>


        </div>
        <div class="card-body">
            <p class="card-text">{{$reply->body}}.</p>

        </div>
    </div>
</div>