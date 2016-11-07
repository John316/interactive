@extends('app')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1>Create new Event</h1>
        <p>Contact information</p>

        @include('errors.list')

        {!! Form::open(['url' => 'event']) !!}

            @include('partials._form', ['nameOfSubmitBtn' => 'Create the Event'])

        {!! Form::close() !!}

    </div>
</div>

@stop