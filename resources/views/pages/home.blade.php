@extends('app')
@section('content')

<div class="jumbotron">
    <h1>Welcome to Interactive</h1>
    <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
    <p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p>
</div>

<div class="row marketing">
    <div class="col-lg-6">
        <h4>List of current events</h4>
        @if(count($listOfCurrentEvents))
            @foreach ($listOfCurrentEvents as $event)
                <p><a href="/event/{{ $event['id'] }}">{{ $event['name'] }}</a></p>
            @endforeach
        @endif
    </div>

    <div class="col-lg-6">
        <h4>List of future events</h4>
        @if(count($listOfFutureEvents))
            @foreach ($listOfFutureEvents as $event)
                <p><a href="/event/{{ $event['id'] }}">{{ $event['name'] }}</a></p>
            @endforeach
        @endif
    </div>
</div>
@stop