@extends('eventFrame')

@section('head')
    <!-- <script type="text/babel" src="/js/bundle.js"></script> -->
    <script type="text/javascript">
        var eventId = "{{$event['id']}}";
        var eventStatus = "{{$event['status']}}";
        var startUrl = '{{ action('EventsController@start', [$event['id']]) }}';
        var stopUrl = '{{ action('EventsController@stop', [$event['id']]) }}';
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
    <a href="/event/{{ $event['id'] }}">{{ $event['name'] }}</a>
@stop

@section('content')

    <form method="POST" action="/event/{{ $event['id'] }}/upload" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="form-group">
            <img class="img-slide active" data="{{ $event['id'] }}" src="/slides/{{ $event['id'] }}/images">
        </div>

        <div class="form-group">
            <label for="file">Select image to upload:</label>
            <input type="file" class="form-control" id="file" name="file" >
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" >Upload</button>
        </div>
    </form>

    <form method="post" action="/event/{{ $event['id'] }}/delete">
        <div class="form-group">
            {{method_field('DELETE')}} {{ csrf_field() }}
            <button type="submit" class="btn btn-danger" >Delete</button>
        </div>
    </form>

    <div class="main-window">
        <div class="demo-info">
            <div>
                <span>Enter in your browser address - <strong> <a href="/event/{{ $event['id'] }}"> iactive.life/event/{{ $event['id'] }}</a></strong></span>
            </div>
        </div>
        <div class="slide-frame">
            <div class="image-frame">

            </div>
        </div>
        <div id="message-aside"></div>
        <div class="clear"></div>
        <div class="tools-frame">
            <div id="chart-1" style="height: 164px; width: 800px;"></div>
        </div>

    </div>
@stop
