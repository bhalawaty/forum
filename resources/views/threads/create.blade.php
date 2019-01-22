@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card">

            <div class="card-header">
        <h1>Create a Thread</h1>
            </div>
            <div class="card-body">
        <form method="POST" action="/threads">

            {{csrf_field()}}

            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Channels</label>
                    </div>
                    <select class="custom-select" id="channel_id" name="channel_id" required>
                        <option value="">Choose one...</option>
                        @foreach($channels as $channel)
                            <option value="{{$channel->id}}" {{old('channel_id')==$channel->id ?'selected': ''}}>{{$channel->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" value="{{old('title')}}" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="body">Body:</label>
                <textarea type="text" class="form-control" id="body" name="body" required>{{old('body')}}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Publish</button>
            </div>

            @include('layouts.errors')
        </form></div>

    </div>
    </div>
    </div>
@endsection