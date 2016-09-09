var lang = {
  "HELLO" :["Hello", "Привет", "Вітаю"],
  "HOME" : ["Home", "Главная", "Головна"],
  "INTERACTIVE" :["Interactive", "Интерактив", "Інтерактив"],
  "GROUPS_AND_USERS" : ["Groups and Users", "Группы и пользователи", "Групи та користувачі"],
  "GROUPS" : ["Groups", "Группы", "Групи"],
  "ADD_GROUP" : ["Add group", "Добавить группу", "Додати групу"],
  "DISPLAY_GROUPS" : ["Display groups", "Показать группы", "Показати групи"],
  "USERS" : ["Users", "Пользователи", "Користувачі"],
  "ADD_USER" : ["Add user", "Добавить пользователя", "Додати користувача"],
  "DISPLAY_USERS" : ["Display users", "Показать пользоватей", "Показати користувачів"],
  "LANGUAGE" : ["Language", "Язык", "Мова"],
  "SELECT_LANGUAGE" : ["Select language", "Выберите язык", "Оберіть мову"],
  "START" : ["Start", "Старт", "Старт"],
  "STOP" : ["Stop", "Стоп", "Стоп"],
  "EXIT" : ["Exit", "Выход", "Вхід"],
  "SIGN_IN" : ["Sign in", "Войти", "Увійти"],
  "LEVEL" : ["Level", "Уровень", "Рівень"],
  "NO" : ["No", "Нет", "Ні"],
  "YES" : ["Yes", "Да", "Так"],
  "THE_TITLE_OF_1" : ["The level of understanding", "Уровень понимания", "Рівень розуміння"],
  "THE_TEXT_OF_1" : ["Please select the level of understanding.", "Выберите, пожалуйста, уровень понимания доклада.", "Оберіть, будь ласка, рівень розуміння доповіді."],
  "THE_TITLE_OF_2" : ["The level of relevance", "Уровень актуальности", "Рівень актуальності"],
  "THE_TEXT_OF_2" : ["Please rate the level of relevance for you?", "Оцените, пожалуйста, актуальность темы для Вас?", "Оцініть, будь ласка, рівень актуальності теми для Вас?"],
  "THE_TITLE_OF_3" : ["The level of interest", "Уровень интереса", "Рівень цікавості"],
  "THE_TEXT_OF_3" : ["Please rate the level of interest for you?", "Пожалуйста, оцените на сколько Вам интересна тема?", "Будь ласка, оцініть на скільки Вам цікава тема?"],
  "RELEVANCE" : ["Relevance", "Актуальность", "Актуальність"],
  "INTEREST" : ["Interest", "Интерес", "Цікавість"],
  "UNDERSTANDING" : ["Understanding of people", "Понимание аудитории", "Зрозумілість аудіторії"],
  "CONNECT_TO_WIFI" : ["Connect to a WiFi network and enter in the browser the address: ", "Подключитесь к сети WiFi и введите в браузере адрес: ", "Підключіться до мережі WiFi і введіть в браузері адресу: "],
}
function getTranslate(text) {
  var number = getCookie("lang");
  if(!number){
    number = 0;
  }
  return lang[text][number];
}
function changeLang() {
  var number = getCookie("lang");
  $( ".lang" ).each(function() {
    var text = $(this).attr( "text" );
    if(lang[text]){
        $(this).text(lang[text][number]);
    }
  });
}
function setLang(number) {
  setCookie("lang", number, {"path": "/"});
  changeLang(number);
}
