@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                        @foreach($threads as $thread)
                    <div class="form-group">
                        <div class="card">
                     <article>
                       <div class="card-header"  >
                           <a href="{{$thread->path()}}">
                                        <h4>{{$thread->title}}</h4>
                           </a>
                           <a href="#">
                       {{$thread->creator->name}} </a>... at {{$thread->created_at->diffForHumans()}}


                       </div>
                         <div class="card-body">{{$thread->body}}</div>
                     </article>

                        </div></div>
                @endforeach


                </div>
            </div>
        </div>
    </div>
@endsection