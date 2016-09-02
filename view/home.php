<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div id="understandChart"></div>
      </div>
      <div class="col-md-4">
        <div id="agreeChart"></div>
      </div>
    </div>
  </div>
</div>

<div class="main-content">
  <!-- Example row of columns -->
  <div class="row">
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><strong>The level of understanding</strong></h3>
        </div>
        <div class="panel-body">
          <p>Please select the level of understanding of the speaker.</p>
          <label for="level1">I understand on:</label>
          <input type="text" id="level1" readonly style="width: 23px; border:0; color:#f6931f; font-weight:bold;">%
          <div id="slider-vertical"></div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="panel panel-success">
        <div class="panel-heading">
          <h3 class="panel-title"><strong>The level of interest</strong></h3>
        </div>
        <div class="panel-body">
          <p>If you are interested in the report of the select level of interest.</p>
          <label for="level3">I interested on:</label>
          <input type="text" id="level3" readonly style="width: 23px; border:0; color:#f6931f; font-weight:bold;">%
          <div id="interest-slider"></div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="panel panel-warning">
        <div class="panel-heading">
          <h3 class="panel-title"><strong>The level of agreement</strong></h3>
        </div>
        <div class="panel-body">
          <p>If you agree with the speaker please press the Agree button else choose a Disagree button.</p>
          <p>
            <a class="btn btn-success" id="iAgree" role="button">Agree</a>
            <a class="btn btn-danger" id="iDisagree" role="button">Disagree</a>
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="main">
    <p>
      <a class="btn btn-primary" id="start" role="button">Start</a>
      <a class="btn btn-danger" id="stop" role="button">Stop</a>
      <a class="btn btn-success" id="sendLevel" role="button">Send</a>
    </p>
    <div class="tools">
        <input type="hidden" name="level2" id="level2" value="10">
        <input type="hidden" name="level3" id="level3" value="10">
    </div>
  </div>
  <hr>

  <footer>
    <p>&copy; 2016 Company, Inc.</p>
  </footer>
</div> <!-- /container -->
