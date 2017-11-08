@extends('eventFrame')

@section('head')
    <!-- <script type="text/babel" src="/js/bundle.js"></script> -->
    <script type="text/javascript">
        var eventId = "{{$event['id']}}";
        var eventStatus = "{{$event['status']}}";
        var startUrl = '{{ action('EventsController@start', [$event['id']]) }}';
        var stopUrl = '{{ action('EventsController@stop', [$event['id']]) }}';
    </script>
@stop

@section('eventTitle')
    <a href="/event/{{ $event['id'] }}">{{ $event['name'] }}</a>
@stop

@section('content')
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
