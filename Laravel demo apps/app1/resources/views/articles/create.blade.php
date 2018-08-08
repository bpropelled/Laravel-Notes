@extends('master.page') @section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>Add An Article</h1>
            <hr> {!! Form::open(['url' => 'articles']) !!}
            <div class="form-group">
                {!! Form::label('title', 'Title:') !!}
                {!! Form::text('title', null, ['class' => 'form-control'])  !!}
            </div>

            <div class="form-group">
                {!! Form::label('body', 'Description:') !!} 
                {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Submit Your Article', ['class' => 'btn  btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}

      
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      
        </div>
    </div>
</div>


@stop
