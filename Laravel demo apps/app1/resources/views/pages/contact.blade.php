@extends('master.page')



@section('content')

{{-- @if ($name == 'Brendon')
<h1>Hello Person</h1>
@endif --}}


<h3>Contact Us</h3>
<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Et repellat voluptate ab, 
    dicta fugiat eaque animi! Ex natus blanditiis ab architecto qui inventore, dignissimos culpa rem eaque, assumenda, obcaecati sequi!</p>
<ul>
    @foreach ($people as $p)
    </li>{{ $p }}</li>
    @endforeach
</ul>
@stop

@section('footer')
<script>console.log('Ooooookkkkkkkk');</script>
@stop