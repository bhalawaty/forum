    <div class="form-group">
        <div id="reply-{{$reply->id}}" class="card">
            <div class="card-header">
                <div class="level" style="align-items: center;display: flex">
                    <h4 class="flex" style="flex: 1">
                        <a href="{{ Route ('userProfile',$reply->owner)}}">
                            {{$reply->owner->name}}
                        </a> at ...
                        {{$reply->created_at->diffForHumans()}}
                    </h4>
                    @if(Auth::check())
                        <div>
                            <favorite :reply="{{$reply}}"></favorite>
                        </div>
                    @endif

                </div>


            </div>
            <div class="card-body">
                <div v-if="editing">
                    <div class="form-group">
                        <textarea class="form-control" v-model="body"></textarea>
                    </div>
                    <button class="btn btn-primary btn-sm mr-1" @click="update">save</button>
                    <button class="btn btn-link btn-sm mr-1" @click="editing = false">cancel</button>

                </div>
                <div v-else v-text="body">
                </div>

            </div>
            @can ('update',$reply)
                <div class="card-footer  level">
                    <button class="btn btn-primary btn-sm mr-1" @click="editing = true">Edit</button>
                    <button class="btn btn-danger btn-sm" @click="destroy">Delete</button>

                </div>
            @endcan
        </div>
    </div>
