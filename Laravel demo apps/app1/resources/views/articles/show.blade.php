@extends('master.page')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-lg-12">
              <h1>{{ $article->title }}</h1>
            <p>{{ $article->body }}</p>
        </div>
    </div>
</div>
@stop
