@extends('master.page')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1> Manufacturers</h1>
@foreach ($mfgs as $m)

                    <h1><a href="{{ url('/cars', $m->id) }}">{{ $m->name }}</a></h1>
                    <p>{{ $m->about }}</p>
                    <hr>

@endforeach
            </div>
        </div>
    </div>
@stop
