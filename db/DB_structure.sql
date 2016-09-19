
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `infire_i`
--

-- --------------------------------------------------------

--
-- Структура таблицы `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `event`
--

INSERT INTO `event` (`id`, `name`, `start_date`, `end_date`, `status`) VALUES
(1, 'Алгоритмы в действии', '2016-09-22', '2016-09-22', 1),
(2, 'Что такое AJAX?', '2016-09-22', '2016-09-22', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `event_relations`
--

CREATE TABLE IF NOT EXISTS `event_relations` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(6) NOT NULL,
  `event_id` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `event_relations`
--

INSERT INTO `event_relations` (`id`, `user_id`, `event_id`) VALUES
(1, 100, 1),
(2, 100, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `Name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `group`
--

INSERT INTO `group` (`id`, `Name`) VALUES
(1, 'Users'),
(5, 'Admins'),
(13, 'Mentors');

-- --------------------------------------------------------

--
-- Структура таблицы `level`
--

CREATE TABLE IF NOT EXISTS `level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level1` float NOT NULL,
  `level2` float NOT NULL,
  `level3` float NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userId` int(11) NOT NULL,
  `clientIP` varchar(22) NOT NULL,
  `typeId` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `level`
--

INSERT INTO `level` (`id`, `level1`, `level2`, `level3`, `time`, `userId`, `clientIP`, `typeId`) VALUES
(14, 5, 0, 0, '2016-09-14 20:58:25', 15, '192.168.0.103', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userId` int(10) NOT NULL,
  `text` text NOT NULL,
  `rank` float NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(4) NOT NULL,
  `type` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_group` int(10) NOT NULL,
  `Login` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `org_name` varchar(50) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `avatar_extension` varchar(200) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `id_group`, `Login`, `Password`, `org_name`, `Email`, `reg_date`, `avatar_extension`, `status`) VALUES
(98, 5, 'admin', '123456', 'Main', 'slya.vchoda@gmail.com', '0000-00-00 00:00:00', 'upload/consumer_avatar/98.jpg', 1),
(100, 5, 'Ivan', '123456', 'Zengineers', 'John316@i.ua', '2016-09-16 22:51:04', 'upload/consumer_avatar/100.jpg', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `voting`
--

CREATE TABLE IF NOT EXISTS `voting` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `text` varchar(200) NOT NULL,
  `settings` text NOT NULL,
  `options` text NOT NULL,
  `event_id` int(10) NOT NULL,
  `targeting` varchar(22) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
