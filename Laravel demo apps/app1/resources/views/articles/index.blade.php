@extends('master.page')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1> Articles</h1>
@foreach ($articles as $a)

                    <h1><a href="{{ url('/articles', $a->id) }}">{{ $a->title }}</a></h1>
                    <p>{{ $a->body }}</p>
                    <hr>

@endforeach
            </div>
        </div>
    </div>
@stop
