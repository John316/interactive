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
  "THE_TITLE_OF_1" : ["Understandig", "Понимание аудитории", "Розуміння аудиторії"],
  "THE_TEXT_OF_1" : ["Do you understand what you hear?", "Вам понятно то, что вы слышите?", "Вам зрозуміло те, що ви чуєте?"],
  "THE_TITLE_OF_2" : ["How many familiar theme?", "На сколько знакома тема?", "На скільки знайома тема?"],
  "THE_TEXT_OF_2" : ["Please rate your level of knowledge on the topic?", "Оцените, пожалуйста, уровень ваших знаний по данной теме.", "Оцініть, будь ласка, рівень ваших знань по даній темі?"],
  "THE_TITLE_OF_3" : ["How interested in the topic?", "На сколько интересна тема?", "Наскільки цікава тема?"],
  "THE_TEXT_OF_3" : ["Please estimate the level of interest for you?", "Пожалуйста, оцените свой интерес к данной теме?", "Будь ласка, оцініть на скільки Вам цікава тема?"],
  "RELEVANCE" : ["Relevance", "Актуальность", "Актуальність"],
  "INTEREST" : ["Interest", "Интерес", "Цікавість"],
  "UNDERSTANDING" : ["Understanding the audience", "Понимание аудитории", "Розуміння аудиторії"],
  "CONNECT_TO_WIFI" : ["To participate go to the website: ", "Чтобы принять участие откройте сайт: ", "Щоб взяти участь відкрийте сайт: "],
  "S_QUESTION" : ["Send a question", "Отправить вопрос", "Надіслати питання"],
  "SEND" : ["Send", "Отправить", "Відправити"],
  "LIST_OF_R_I" : ["List of recent issues", "Список последних вопросов", "Список останніх питань"],
  "NO_QUES" : ["No questions", "Пока вопросов нет.", "Поки питань немає."],
  "G_NONE" : ["Good None", "Хорошо владею", "Добре володію"],
  "AVERAGE_L" : ["Average level", "Средний уровень", "Середній рівень"],
  "BASIC_KN" : ["Basic knowledge", "Базовые знания", "Базові знання"],
  "NONE" : ["None", "Не владею", "Не володію"],
  "VERY_INTER" : ["Very interesting", "Очень интересно", "Дуже цікаво"],
  "AVERAGE_INTER" : ["Average interest", "Средний интерес", "Cередній інтерес"],
  "LACK_OF_INTER" : ["Lack of interest", "Слабый интерес", "Слабкий інтерес"],
  "NOT_INTER" : ["Not interested", "Не интересно", "Не цікаво"],
  "INFO_OF_RELEVANCE" : ["Please rate the relevance of single use threads for you and how much you are familiar with this topic.", "Оцените единоразово актуальность темы для Вас и на сколько вы знакомы с этой темой.", "Оцініть одноразово актуальність теми для Вас і на скільки ви знайомі з цією темою."],
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

function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
      "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}
