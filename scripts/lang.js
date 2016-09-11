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
  "THE_TITLE_OF_1" : ["Understanding", "Понимание аудитории", "Розуміння аудиторії"],
  "THE_TEXT_OF_1" : ["Are you understand, yes/no?", "Вам понятно то, что вы слышите?", "Ви розумієте, так/ні"],
  "THE_TITLE_OF_2" : ["Level of relevance", "На сколько знакома тема?", "Рівень актуальності"],
  "THE_TEXT_OF_2" : ["Please estimate the level of relevance for you?", "Оцените, пожалуйста, уровень ваших знаний по данной теме.", "Оцініть, будь ласка, рівень актуальності теми для Вас?"],
  "THE_TITLE_OF_3" : ["Level of interest", "На сколько интересна тема?", "Рівень цікавості"],
  "THE_TEXT_OF_3" : ["Please estimate the level of interest for you?", "Пожалуйста, оцените свой интерес к данной теме?", "Будь ласка, оцініть на скільки Вам цікава тема?"],
  "RELEVANCE" : ["Relevance", "Актуальность", "Актуальність"],
  "INTEREST" : ["Interest", "Интерес", "Цікавість"],
  "UNDERSTANDING" : ["Understanding of people", "Понимание аудитории", "Зрозумілість аудіторії"],
  "CONNECT_TO_WIFI" : ["Enter in the browser the address: ", "Чтобы принять участие откройте сайт: ", "Введіть в браузері адресу: "],
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
