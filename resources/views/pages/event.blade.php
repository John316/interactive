@extends('eventFrame')

@section('head')
    <script type="text/babel" src="/js/bundle.js"></script>
    <script type="text/javascript">
        var eventId = "{{$clientEvent['id']}}";
        var eventStatus = "{{$clientEvent['status']}}";
        var startUrl = '{{ action('EventsController@start', [$clientEvent['id']]) }}';
        var stopUrl = '{{ action('EventsController@stop', [$clientEvent['id']]) }}';
    </script>
@stop

@section('eventMenu')
    <nav>
        <ul class="nav nav-pills pull-right">
            <li role="presentation"><a id="start" href="#">Start</a></li>
            <li role="presentation"><a id="stop" href="#">Stop</a></li>
        </ul>
    </nav>
@stop

@section('top-content')
    <div id="root"></div>
    <div class="one-time-voit">
        <p class="bg-info info"><strong>Сейчас начинается доклад на тему: "{{ $clientEvent['name'] }}".</strong></p>
        <h4>Описание</h4>
        <p>{{ $clientEvent['desc'] }}</p>
        <p class="bg-warning info"><span class="lang" text="INFO_OF_RELEVANCE">Оцените единоразово актуальность темы для Вас и на сколько вы знакомы с этой темой.</span></p>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong><span class="lang" text="THE_TITLE_OF_2">На сколько вам знакома тема?</span></strong></h3>
                    </div>
                    <div class="panel-body">
                        <p><span class="lang" text="THE_TEXT_OF_2">На сколько вам знакома тема?</span></p>
                        <select id="estimate1" class="form-control">
                            <option value="5"><span class="lang" text="G_NONE">Хорошо владею</span></option>
                            <option value="4"><span class="lang" text="AVERAGE_L">Средний уровень</span></option>
                            <option value="3"><span class="lang" text="BASIC_KN">Базовые знания</span></option>
                            <option value="2"><span class="lang" text="NONE">Не владею</span></option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong><span class="lang" text="THE_TITLE_OF_3">Level of interest</span></strong></h3>
                    </div>
                    <div class="panel-body">
                        <p><span class="lang" text="THE_TEXT_OF_3">Please estimate the level of interest.</span></p>
                        <select id="estimate2" class="form-control">
                            <option value="5"><span class="lang" text="VERY_INTER">Очень интересно</span></option>
                            <option value="4"><span class="lang" text="AVERAGE_INTER">Средний интерес</span></option>
                            <option value="3"><span class="lang" text="LACK_OF_INTER">Слабый интерес</span></option>
                            <option value="2"><span class="lang" text="SENNOT_INTER">Не интересно</span></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="center-block send-btn-one">
                    <button type="button" id="sentOneVoit" class="btn btn-success"><span class="lang" text="SEND">Отправить</button>
                </div>
            </div>
        </div>
        <hr>
    </div>
    <!-- end one time voit -->
@stop

@section('eventTitle')
    <a href="/">{{ $clientEvent['name'] }}</a>
@stop

@section('content')
<div class="main-content">
    <p class="bg-info info">Description: {{ $clientEvent['desc'] }}</p>
    <div class="row">
        <div class="col-md-6">
            <div class="chart-2">
                <div class="body-of-chart-2">
                    <div id="chart-object-2" style="height:300px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="chart-3">
                <div class="body-of-chart-3">
                    <div id="chart-object-3" style="height:300px;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="header-chart-1">
                <span class="lang" text="THE_TITLE_OF_1">Level of understanding</span><span class="count-users"></span>
            </div>
            <div class="circle blink"></div>
            <div id="chart-object-1" style="height:150px;"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong><span class="lang" text="THE_TEXT_OF_1">Level of understanding</span></strong></h3>
                </div>
                <div class="panel-body">
                    <div class="sw-block">
                        <div class="sw-left">
                            <span class="lang" text="NO">НЕТ</span>
                        </div>
                        <div class="onoffswitch">
                            {!! Form::model($clientEvent, ['method' => 'POST']) !!}
                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked>
                                <label class="onoffswitch-label" for="myonoffswitch"></label>
                            {!! Form::close() !!}
                        </div>
                        <div class="sw-right">
                            <span class="lang" text="YES">ДА</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div id="ask-module"></div>
        </div>
    </div>
</div>

@stop