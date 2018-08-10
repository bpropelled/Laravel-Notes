@extends('master.page')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1> Leasees</h1>
                @foreach ($leases as $l)
                <h2>{{ $l->name }}</h2>
                <h3>{{ $l->comp }}</h3>
                <p>{{ $office->name  }}</p>
                    
                <hr>
                @endforeach

            </div>
        </div>
    </div>
@stop
