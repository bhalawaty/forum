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
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" >

            </div>
            <div class="form-group">
                <label for="body">Body:</label>
                <textarea type="text" class="form-control" id="body" name="body" ></textarea>
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