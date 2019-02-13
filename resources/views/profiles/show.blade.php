@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-group">
                    <div class="card">
                        <div class="card-header">
                            <h3>
                                {{$userprofile->name}} Since...{{$userprofile->created_at->diffForHumans()}}
                            </h3>
                        </div>
                    </div>
                </div>
                @foreach($activities as $date=> $activity)
                    <h3 class="page_header">{{$date}}</h3>
                    @foreach($activity as $record)
                        @include("profiles.activities.{$record->type}",['activity'=>$record])
                @endforeach
                @endforeach
                {{--{{$threads->links()}}--}}
            </div>
        </div>
    </div>
@endsection