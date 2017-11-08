@extends('app')
@section('content')

<div class="jumbotron">
    <h1>Интерактив</h1>
    <p class="lead">Удобный инструмент для интерактивного общения между слушателями и докладчиком. Докладчик всегда располагает информацией насколько аудитория понимает материал, какие у них есть вопросы, а также может быстро проводить срезы различной статистики.Слушатели имеют возможность задать вопрос не нарушая ход лекции и не привлекая к себе много внимания. Также могут явным образом выразить непонимание материала. При этом не стесняясь окружающих. Каждый слушатель может быть уверен, что его вопрос не останется без внимания.
    </br><b>Сферы применения:</b> презентации, доклады, лекции, семинары, форумы, конференции, уроки.</p>
    @if (!Auth::guest())
    <p><a class="btn btn-lg btn-success" href="{{ action('EventsController@create') }}" role="button">Создать событие</a></p>
    @endif
</div>

<div class="row marketing">
    <div class="col-lg-6">
        <h4>События на сегодня</h4>
        @if(count($listOfCurrentEvents))
            @foreach ($listOfCurrentEvents as $event)
                <p>
                    <strong><a href="{{ action('EventsController@show', [$event['id']]) }}">{{ $event['name'] }}</a></strong> -
                    <a href="{{ action('EventsController@edit', [$event['id']]) }}">[edit]</a>
                </p>
            @endforeach
        @endif
    </div>

    <div class="col-lg-6">
        <h4>Будующие события</h4>
        @if(count($listOfFutureEvents))
            @foreach ($listOfFutureEvents as $event)
                <p>
                    <strong><a href="{{ action('EventsController@show', [$event['id']]) }}">{{ $event['name'] }}</a></strong> -
                    <a href="{{ action('EventsController@edit', [$event['id']]) }}">[edit]</a>
                </p>
            @endforeach
        @endif
    </div>
</div>
@stop
