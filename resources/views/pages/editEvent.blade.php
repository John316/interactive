@extends('app')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1>Update: {{ $clientEvent['name'] }}</h1>
        <p>Contact information</p>

        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {!! Form::model($clientEvent, ['method' => 'PATCH', 'action' => ['EventsController@update', $clientEvent->id]]) !!}
            @include('partials._form', ['nameOfSubmitBtn' => 'Update the Event'])
        {!! Form::close() !!}

    </div>
</div>

@stop