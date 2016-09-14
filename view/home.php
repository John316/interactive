<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="one-time-voit">
  <p class="bg-info info"><strong>Сейчас начинается доклад на тему: "PHP для начинающих".</strong></p>
  <p class="bg-warning info">Оцените единоразово актуальность темы для Вас и на сколько вы знакомы с этой темой.</p>
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-success">
        <div class="panel-heading">
          <h3 class="panel-title"><strong><span class="lang" text="THE_TITLE_OF_2">На сколько вам знакома тема?</span></strong></h3>
        </div>
        <div class="panel-body">
          <p><span class="lang" text="THE_TEXT_OF_2">На сколько вам знакома тема?</span></p>
          <select id="estimate1" class="form-control">
            <option value="5">Хорошо владею</option>
            <option value="4">Средний уровень</option>
            <option value="3">Базовые знания</option>
            <option value="2">Не владею</option>
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
            <option value="5">Очень интересно</option>
            <option value="4">Средний интерес</option>
            <option value="3">Слабый интерес</option>
            <option value="2">Не интересно</option>
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="center-block send-btn-one">
        <button type="button" id="sentOneVoit" class="btn btn-success">Отправить</button>
      </div>
    </div>
  </div>
  <hr>
</div>
<!-- end one time voit -->
<div class="main-content">
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
    <div class="col-md-12">
      <div class="header-chart-1">
        <span class="lang" text="THE_TITLE_OF_1">Level of understanding</span><span class="count-users"></span>
      </div>
      <div class="circle blink"></div>
      <div id="chart-object-1" style="height:150px;"></div>
    </div>
    <div class="col-md-6">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title"><strong><span class="lang" text="THE_TEXT_OF_1">Level of understanding</span></strong></h3>
        </div>
        <div class="panel-body">
          <div class="sw-block">
              <div class="sw-left">
                <span>НЕТ</span>
              </div>
              <div class="onoffswitch">
                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked>
                <label class="onoffswitch-label" for="myonoffswitch"></label>
              </div>
              <div class="sw-right">
                  <span>ДА</span>
              </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="panel panel-success">
        <div class="panel-heading">
          <h3 class="panel-title"><strong><span>Отправить вопрос</span></strong></h3>
        </div>
        <div class="panel-body">
          <p class="bg-primary info-sent">Your question was sent. Thank you!</p>
          <form class="form-inline" id="question_form">
            <div class="form-group">
              <input type="text" class="form-control" id="enter_question" placeholder="Напишите вопрос">
            </div>
            <button type="button" id="send_question" class="btn btn-default">Отправить</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Список последних вопросов</h3>
        </div>
        <div class="panel-body">
          <div id="message-on-client">
            Пока вопросов нет.
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer>
    <p>&copy; 2016 Company, Inc.</p>
  </footer>
</div> <!-- /container -->
