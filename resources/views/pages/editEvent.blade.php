@extends('app')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1>Create new Event</h1>
        <p>Contact information</p>

        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {!! Form::open(['url' => 'event']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

        <div class="form-group">
            {!! Form::label('desc', 'Description:') !!}
            {!! Form::textarea('desc', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('status', 'Status:') !!}
            {!! Form::text('status', 1, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('active_from', 'Active from:') !!}
            {!! Form::input('date', 'active_from', date('Y-m-d'), ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('active_to', 'Active to:') !!}
            {!! Form::input('date', 'active_to', date('Y-m-d'), ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Add Event', ['class' => 'btn btn-primary form-control']) !!}
        </div>

        {!! Form::close() !!}

    </div>
</div>

@stop