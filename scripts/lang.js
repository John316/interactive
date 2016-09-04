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
  "LEVEL_OF_UNDERSTANDING" : ["Level of understanding", "Уровень понимания", "Рівень розуміння"],
  "THE_LEVEL_OF_AGREEMENT" : ["The level<br>of agreement", "Уровень согласия", "Рівень згоди"],
  "LEVEL" : ["Level", "Уровень", "Рівень"],
  "NO" : ["No", "Нет", "Ні"],
  "YES" : ["Yes", "Да", "Так"],
  "THE_TITLE_OF_1" : ["The level of understanding", "Уровень понимания", "Рівень розуміння"],
  "THE_TITLE_OF_2" : ["The level of agreement", "Уровень согласия", "Рівень згоди"],
  "THE_TEXT_OF_1" : ["Please select the level of understanding", "Пожалуйста, выберите уровень понимания", "Будь ласка, оберіть рівень розуміння"],
  "THE_TEXT_OF_2" : ["Are you agree with the speaker?", "Вы согласны с докладчиком?", "Ви згодні з доповідачем?"]
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
