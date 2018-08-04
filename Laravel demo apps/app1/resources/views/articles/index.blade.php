@extends('master.page')

@section('content')

@foreach ($articles as $a)
<h1><a href="{{ url('/articles', $a->id) }}">{{ $a->title }}</a></h1>
<p>{{ $a->body }}</p>
@endforeach
@stop
