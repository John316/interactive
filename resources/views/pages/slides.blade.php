@extends('eventFrame')

@section('head')
    <!-- <script type="text/babel" src="/js/bundle.js"></script> -->
    <link href="{{ asset('css/slide.css') }}" rel="stylesheet">
    <script type="text/javascript">
        var eventId = "{{$event['id']}}";
        var eventStatus = "{{$event['status']}}";
        var startUrl = '{{ action('EventsController@start', [$event['id']]) }}';
        var stopUrl = '{{ action('EventsController@stop', [$event['id']]) }}';
        var demonstration = true;
    </script>
    <script type="text/javascript">
        addEventListener("keyup", function(event) {
            var forword = 39;
            var backword = 37;
            var down = 40;
            var up = 38;
            var controlFF = 34;
            var controlBK = 33;
            if(event.keyCode == forword || event.keyCode == down || event.keyCode == controlFF){
                initNextSlide();
            }else if (event.keyCode == backword || event.keyCode == up || event.keyCode == controlBK) {
                initPrevSlide();
            }
        });

        function initNextSlide() {
            var id = parseInt("{{$event['id']}}");
            var next = id + 1;
            var url = window.location.pathname;
            var res =  url.replace(id, next);
            window.location.replace(res);
        }

        function initPrevSlide() {
            var id = parseInt("{{$event['id']}}");
            var next = 1;
            id !== 1 ? next = id - 1 : null;
            var url = window.location.pathname;
            var res =  url.replace(id, next);
            window.location.replace(res);
        }
    </script>

@stop

@section('eventTitle')
    <a href="/event/{{ $event['id'] }}">{{ $event['name'] }}</a> <a class="demo-info" href="/event/{{ $event['id'] }}"> iactive.life/event/{{ $event['id'] }}</a></strong></span>
@stop

@section('content')
    <div class="main-window">
        <div class="slide-frame">
            <div class="image-frame">
                <img class="img-slide active" data="{{ $event['id'] }}" src="/images/slides/01.png">
            </div>
        </div>
        <div id="message-aside"></div>
        <div class="clear"></div>
        <div class="tools-frame">
            <div id="chart-1" style="height: 164px; width: 800px;"></div>
        </div>
        {{ csrf_field() }}
    </div>
@stop
