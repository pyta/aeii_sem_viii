-- phpMyAdmin SQL Dump
-- version 3.4.4
-- http://www.phpmyadmin.net
--
-- Host: laverte.nazwa.pl:3305
-- Czas wygenerowania: 13 Sty 2014, 11:34
-- Wersja serwera: 5.0.91
-- Wersja PHP: 5.2.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Baza danych: `laverte_13`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `login` text NOT NULL,
  `pass` text NOT NULL,
  `email` text NOT NULL,
  `acces` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin2;

--
-- Zrzut danych tabeli `admin`
--

INSERT INTO `admin` (`id`, `login`, `pass`, `email`, `acces`) VALUES
(1, 'd.tomczyk', 'dawid.tomczyk1', 'dawid.tomczyk@laverte.pl', 5),
(2, 'p.ciwis', 'piotr.ciwis1', 'pciw@wp.pl', 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `administrator`
--

CREATE TABLE `administrator` (
  `administratorId` int(11) NOT NULL auto_increment,
  `administratorLogin` varchar(55) NOT NULL,
  `administratorPass` varchar(55) NOT NULL,
  `administratorName` varchar(100) NOT NULL,
  `administratorLoginsucces` datetime NOT NULL,
  `administratorLoginfailure` datetime NOT NULL,
  `administratorActive` tinyint(4) NOT NULL,
  PRIMARY KEY  (`administratorId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `administrator`
--

INSERT INTO `administrator` (`administratorId`, `administratorLogin`, `administratorPass`, `administratorName`, `administratorLoginsucces`, `administratorLoginfailure`, `administratorActive`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '2012-01-19 10:34:36', '2012-01-12 11:43:35', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL auto_increment,
  `text` text NOT NULL,
  `usersId` int(11) NOT NULL,
  `newsId` int(11) NOT NULL,
  `addDate` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin2 AUTO_INCREMENT=30 ;

--
-- Zrzut danych tabeli `comments`
--

INSERT INTO `comments` (`id`, `text`, `usersId`, `newsId`, `addDate`) VALUES
(25, 'Pewnie zwróciłeś uwagę na jej boski wokal :>', 1, 17, '2012-01-19 14:46:57'),
(22, 'kon pije piwo na polanie', 1, 5, '2012-01-19 13:37:57'),
(23, 'Całkiem niezły kawałek ! :)', 17, 17, '2012-01-19 14:35:26'),
(24, 'To miło. Generalnie polecam dyskografię', 1, 17, '2012-01-19 14:36:18'),
(26, 'Daje rady dziewczyna :D', 17, 17, '2012-01-19 14:53:21'),
(27, 'Bajka, trzeba kiedyś ogarnąć jakiś koncert. Posłuchałbym sobie bałałajki czy na czym to oni tam grają (nie chodzi mi tu o flet) :>', 1, 17, '2012-01-19 14:55:27'),
(28, 'vghcghfg', 6, 17, '2012-01-20 11:20:33'),
(29, 'k', 1, 5, '2012-11-26 23:10:11');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `content`
--

CREATE TABLE `content` (
  `id` int(3) NOT NULL auto_increment,
  `type` varchar(200) default NULL,
  `lang` set('pl','en') NOT NULL default 'pl',
  `title` varchar(255) default NULL,
  `text` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Zrzut danych tabeli `content`
--

INSERT INTO `content` (`id`, `type`, `lang`, `title`, `text`) VALUES
(1, 'home', 'pl', 'O firmie', '<p>P.P.H.U "Lismar" Marcin Lisek powstała w maju 1999 roku w Romanowie pod Częstochową i od początku swojego istnienia prężnie rozwija się na rynku. Zajmujemy się skupem i sprzedażą złomu stalowego i metali kolorowych w obrocie detalicznym i hurtowym. <br/>\r\n    W firmie posiadamy wysokiej klasy sprzęt jak choćby urządzenie amerykańskiej firmy Niton do analizowania metali za pomocą promieni.</p>'),
(2, 'oferta', 'pl', 'Oferta', '<p><h3>1. Zakup złomu</h3>\r\n    Firma LISMAR we wszystkich swoich punktach skupu prowadzi zakup złomu:<br/>\r\n    - metali nieżelaznych<br/>\r\n    - stalowego<br/>\r\n    - żeliwnego<br/>\r\n    we wszystkich asortymentach oferując wysokie ceny i atrakcyjne warunki płatności. Stałym dostawcom oferujemy wstawienie kontenerów oraz odbiór złomu własnym transportem.<br/><br/>\r\n    \r\n    Na naszej stronie znajdziecie Państwo codziennie aktualizowany cennik.<br/><br/>\r\n    \r\n    <h3>2. Zakup złomu</h3>\r\n    Firma LISMAR we wszystkich swoich punktach skupu prowadzi zakup złomu:<br/>\r\n    - metali nieżelaznych<br/>\r\n    - stalowego<br/>\r\n    - żeliwnego<br/>\r\n    we wszystkich asortymentach oferując wysokie ceny i atrakcyjne warunki płatności. Stałym dostawcom oferujemy wstawienie kontenerów oraz odbiór złomu własnym transportem.<br/><br/>\r\n    \r\n    <h3>3. Zakup złomu</h3>\r\n    Firma LISMAR we wszystkich swoich punktach skupu prowadzi zakup złomu:<br/>\r\n    - metali nieżelaznych<br/>\r\n    - stalowego<br/>\r\n    - żeliwnego<br/>\r\n    we wszystkich asortymentach oferując wysokie ceny i atrakcyjne warunki płatności. Stałym dostawcom oferujemy wstawienie kontenerów oraz odbiór złomu własnym transportem.<br/><br/></p>'),
(3, 'wspolpraca', 'pl', 'Współpraca', '<p>treść wsp&oacute;łpraca....</p>'),
(4, 'parkmaszynowy', 'pl', 'Park Maszynowy', 'tresc park maszynowy....'),
(5, 'kontakt', 'pl', 'Kontakt', '<b>Marcin Lisek</b><br/>\r\n        Romanów 16<br/>\r\n        42-260 Kamienica Polska<br/>\r\n        NIP 573-233-47-43<br/>\r\n        tel. 0 605 883 785<br/>\r\n        <a href="mailto:marcin.lisek@poczta.fm">marcin.lisek@poczta.fm</a><br/>\r\n        <center><img src="images/lismar_mapka.jpg"/></center>'),
(6, 'dokumenty', 'pl', 'Dokumenty', 'treść dokumenty....'),
(7, 'home', 'en', 'About Company', '<p> Ltd. "Lismar" Marcin Lisek was established in May 1999 in Romanów at Czestochowa and since its inception, a rapidly growing market. We buy and sell scrap steel and nonferrous metals in the retail trade and wholesale. <br/>\r\n     The company have high quality equipment such as the American company Niton device for analyzing metals by means of rays. </ P>'),
(8, 'offer', 'en', 'Offer', '<p> <h3>1. Buying scrap </h3>\r\n     Company LISMAR in all its points of buying leads buying scrap: <br/>\r\n     - Non-ferrous metals <br/>\r\n     - Steel <br/>\r\n     - Iron <br/>\r\n     all ranges by offering high prices and attractive payment terms. Providers to offer fixed-insert containers and scrap collection by private transport. <br/>\r\n    \r\n     On our site you will find daily updated price list. <br/>\r\n    \r\n     <h3>2. Buying scrap </h3>\r\n     Company LISMAR in all its points of buying leads buying scrap: <br/>\r\n     - Non-ferrous metals <br/>\r\n     - Steel <br/>\r\n     - Iron <br/>\r\n     all ranges by offering high prices and attractive payment terms. Providers to offer fixed-insert containers and scrap collection by private transport. <br/>\r\n    \r\n     <h3>3. Buying scrap </h3>\r\n     Company LISMAR in all its points of buying leads buying scrap: <br/>\r\n     - Non-ferrous metals <br/>\r\n     - Steel <br/>\r\n     - Iron <br/>\r\n     all ranges by offering high prices and attractive payment terms. Providers to offer fixed-insert containers and scrap collection by private transport. <br/> </p>'),
(9, 'contact', 'en', 'Contact', '<b>Marcin Lisek</b><br/>\r\n        Romanów 16<br/>\r\n        42-260 Kamienica Polska<br/>\r\n        NIP 573-233-47-43<br/>\r\n        tel. 0 605 883 785<br/>\r\n        <a href="mailto:marcin.lisek@poczta.fm">marcin.lisek@poczta.fm</a><br/>\r\n        <center><img src="images/lismar_mapka.jpg"/></center>');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL auto_increment,
  `category` text NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `date` text NOT NULL,
  `usersId` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin2 AUTO_INCREMENT=9 ;

--
-- Zrzut danych tabeli `events`
--

INSERT INTO `events` (`id`, `category`, `title`, `content`, `date`, `usersId`) VALUES
(8, 'ewq', 'ee', '<p>\r\n	wqe</p>\r\n', '2012-11-26 22:52:40', 6);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `films`
--

CREATE TABLE `films` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `link` varchar(50) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(50) character set latin1 collate latin1_general_ci NOT NULL,
  `addDate` datetime NOT NULL,
  `usersId` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin2 AUTO_INCREMENT=12 ;

--
-- Zrzut danych tabeli `films`
--

INSERT INTO `films` (`id`, `name`, `link`, `categoryId`, `description`, `image`, `addDate`, `usersId`) VALUES
(1, 'Persival Schuttenbach - Satanismus', 'embed/z4E0VVKuKNE', 1, 'Persival wykonuje na żywo swój klasyczny utwor - Satanismus.', 'film1.jpg', '2011-12-07 10:53:47', 1),
(9, 'Wywiad z Titusem przed Opolem', 'embed/jzfPowFzIrU', 2, 'Titi jak zawsze w formie.', 'film2.jpg', '2012-01-04 21:00:29', 1),
(11, 'Turbo - Dorosłe Dzieci', 'embed/Y7vYOMNZc9A', 1, 'Turbo i ich nieśmiertelna ballada - Dorosłe Dzieci. Na jeden scenie dówch wokalistów Turbo.', 'tur1.jpg', '2012-01-19 19:49:30', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `films_category`
--

CREATE TABLE `films_category` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `addDate` datetime NOT NULL,
  `image` varchar(50) NOT NULL,
  `viewImage` varchar(50) NOT NULL,
  `usersId` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin2 AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `films_category`
--

INSERT INTO `films_category` (`id`, `name`, `description`, `addDate`, `image`, `viewImage`, `usersId`) VALUES
(1, 'Z koncertów', 'Filmy z koncertów i innych wydarzeń muzycznych.', '2011-12-07 14:09:12', 'live.jpg', '2live.jpg', 1),
(2, 'Wywiady', 'Wywiady z muzykami i ludźmi związanymi z muzyką.', '2011-12-07 18:37:45', 'interview.jpg', '2interview.jpg', 1),
(4, 'ewqeqweqw', '', '2012-01-20 11:26:10', '', '', 6),
(5, 'ee', '', '2012-11-26 22:52:52', '', '', 6);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL auto_increment,
  `senderId` int(11) NOT NULL,
  `recipientId` int(11) NOT NULL,
  `sendDate` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin2 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `friends`
--

INSERT INTO `friends` (`id`, `senderId`, `recipientId`, `sendDate`) VALUES
(1, 1, 6, '2011-11-30 22:45:19'),
(2, 1, 7, '2011-12-04 18:27:12'),
(3, 7, 1, '2011-12-11 18:09:44'),
(4, 1, 17, '2012-01-19 16:53:52');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `gallery`
--

CREATE TABLE `gallery` (
  `id` int(3) NOT NULL auto_increment,
  `catId` int(3) NOT NULL default '1',
  `lang` set('pl','en') NOT NULL default 'pl',
  `title` varchar(255) default NULL,
  `url_foto` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Zrzut danych tabeli `gallery`
--

INSERT INTO `gallery` (`id`, `catId`, `lang`, `title`, `url_foto`) VALUES
(18, 1, 'pl', 'lama', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `gallerycat`
--

CREATE TABLE `gallerycat` (
  `id` int(11) NOT NULL auto_increment,
  `lang` set('pl','en') NOT NULL default 'pl',
  `title` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `gallerycat`
--

INSERT INTO `gallerycat` (`id`, `lang`, `title`) VALUES
(1, 'pl', 'galeria złomu3');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `gallery_category`
--

CREATE TABLE `gallery_category` (
  `id` int(11) NOT NULL auto_increment,
  `tit_id` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `addDate` date NOT NULL,
  `patch` text NOT NULL,
  `thumbnail` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin2 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `gallery_category`
--

INSERT INTO `gallery_category` (`id`, `tit_id`, `title`, `description`, `addDate`, `patch`, `thumbnail`) VALUES
(1, 'jeden', 'Przykladowa Galeria Zdjec', '<p>\r\n	Testowa galeria pobrana wprost z piďż˝knej bazy MySQL :))</p>\r\n', '2011-11-15', 'gallery/tests', 'test.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `gallery_photo`
--

CREATE TABLE `gallery_photo` (
  `id` int(11) NOT NULL auto_increment,
  `tit_cat_id` text NOT NULL,
  `category` text NOT NULL,
  `name` text NOT NULL,
  `url` text NOT NULL,
  `description` text NOT NULL,
  `addDate` date NOT NULL,
  `thumbnail` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin2 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `gallery_photo`
--

INSERT INTO `gallery_photo` (`id`, `tit_cat_id`, `category`, `name`, `url`, `description`, `addDate`, `thumbnail`) VALUES
(1, 'jeden', 'test', 'IMG_1579', 'photo/IMG_1579.JPG', 'opis zdjęcia IMG_1579.JPG', '2011-11-15', 'thumb/thumb_IMG_1579.jpg'),
(2, 'jeden', 'test', 'IMG_1588', 'photo/IMG_1588.JPG', 'opis do zdjecia drugiego :))', '2011-11-01', 'thumb/thumb_IMG_1588.jpg'),
(3, 'jeden', 'test', 'IMG_1688', 'photo/IMG_1688.JPG', 'opis trzeciego zdjecia', '2011-11-05', 'thumb/thumb_IMG_1688.jpg'),
(4, 'jeden', 'test', 'IMG_1871', 'photo/IMG_1871.JPG', 'opis 3 zdjecia', '2011-11-09', 'thumb/thumb_IMG_1871.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `link` text NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin2;

--
-- Zrzut danych tabeli `menu`
--

INSERT INTO `menu` (`id`, `title`, `link`) VALUES
(0, 'strona główna', 'index.php'),
(3, 'wydarzenia', 'subpage.php?page=events'),
(2, 'galeria filmów', 'subpage.php?page=films'),
(1, 'galeria zdjęć', 'subpage.php?page=gallery'),
(4, 'kontakt', 'subpage.php?page=contact');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL auto_increment,
  `senderId` int(11) NOT NULL,
  `recipientId` int(11) NOT NULL,
  `text` text NOT NULL,
  `sendDate` datetime NOT NULL,
  `state` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin2 AUTO_INCREMENT=20 ;

--
-- Zrzut danych tabeli `messages`
--

INSERT INTO `messages` (`id`, `senderId`, `recipientId`, `text`, `sendDate`, `state`) VALUES
(1, 1, 7, 'Siema Tomek, co tam?', '2011-11-14 20:23:16', 1),
(4, 1, 6, 'Siema,\r\nto je próbna wiadomość. Powinna kiedyśtam dojść i być widoczna. \r\nPozdro', '2011-11-15 20:49:39', 1),
(5, 6, 1, 'widza widza', '2011-11-15 20:57:18', 1),
(7, 1, 7, 'poteżna wichura, łamiąc duże drzewa trzciną zaledwie tylko kołysze... Ważaj! Uważaj!', '2011-11-15 21:04:13', 1),
(8, 7, 1, 'No siemka, jakoś leci :P', '2011-11-15 23:03:07', 1),
(9, 1, 7, 'to fajnie', '2011-11-15 23:04:07', 1),
(10, 7, 1, 'Nawet Ci to działa widze', '2011-11-15 23:08:15', 1),
(12, 7, 1, 'Siemka, co tam?\r\npozdro', '2011-11-30 21:39:51', 1),
(18, 1, 6, 'v ghjvgjg', '2012-01-20 11:19:52', 1),
(15, 1, 7, 'Siemka, to jest próba wysłania szybkiej wiadomości.', '2011-12-11 18:09:17', 1),
(17, 1, 7, ' gvhvcghjgc', '2012-01-20 11:19:42', 1),
(19, 1, 6, 'Zamiast konia było piwo w haśle :P', '2012-11-26 23:08:05', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL auto_increment,
  `author` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `category` text character set latin2 NOT NULL,
  `title` text character set latin2 NOT NULL,
  `content` text character set latin2 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=23 ;

--
-- Zrzut danych tabeli `news`
--

INSERT INTO `news` (`id`, `author`, `data`, `category`, `title`, `content`) VALUES
(5, 1, '2012-01-09 18:53:41', 'news', 'Metallica stawia na groove i ciężar', '<p>\r\n	<b>Metallica pracuje od pewnego czasu nad kolejnym albumem.</b> Kirk Hammett, gitarzysta kapeli, zdradził, czego należy spodziewać się po wydawnictwie.</p>\r\n<center>\r\n	<img height="250" src="http://cdn.doseofmetal.com/wp-content/uploads/2010/09/hammett.jpg" width="500" /></center>\r\n<p>\r\n	- Jeśli &quot;Death Magnetic&quot; było logicznym spadkobiercą quot;&hellip;And Justice For All&quot;, nasz kolejny album będzie cięższą wersją &quot;Black Album&quot; - zdradził gitarzysta Kirk Hammett w rozmowie z magazynem &quot;Rolling Stone&quot;. - Nie zamierzamy robić tak rozbudowanych i złożonych rzeczy jak na &quot;Death Magnetic&quot;. Materiał, nad kt&oacute;rym obecnie pracujemy jest bardziej zorientowany na groove i jest cięższą wersją tego, co robiliśmy na początku lat 90. Produkcją krążka ponownie zajmie się Rick Rubin. Ostatni longplay zespołu Metallica &quot;Death Magnetic&quot; miał premierę we wrześniu 2008 roku. 30 stycznia ukaże się kompaktowa wersja EP-ki z odrzutami z sesji, &quot;Beyond Magnetic&quot;.</p>\r\n'),
(17, 1, '2012-01-19 12:13:37', 'news', 'Nowa płyta Eluveitie', '<p>\r\n	<b>Eluveitie to szwajcarski zesp&oacute;ł folkmetalowy. Ich muzyka to celtycki pagan-folk metal z wpływami melodic death metal.</b> Wygląda na to, że Panowie i Panie z Eluveitie przymierzają się do wydnia nowego albumu. W sieci można już trochę poczytać na ten temat. Dla nakręcenia poniżej pierwszy nowy teledysk. Zapowiada się folkowo, ciężko i mrocznie. Osobiście z wielką ochotą czekam na <b>10 lutego</b>.</p>\r\n<center>\r\n	<iframe allowfullscreen="" frameborder="0" height="300" src="http://www.youtube.com/embed/mtMG9VDMk70" width="500"></iframe></center>\r\n<p>\r\n	Jak dotychczas dyskografię grupy zamyka płyta <b>Everything Remains As It Never Was</b>.</p>\r\n'),
(22, 6, '2012-11-26 22:52:22', 'news', 'ewqeqw', '<p>\r\n	eqw</p>\r\n');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `panels`
--

CREATE TABLE `panels` (
  `id` int(11) NOT NULL auto_increment,
  `title` text NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin2 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `panels`
--

INSERT INTO `panels` (`id`, `title`, `content`) VALUES
(1, 'Logowanie', '<form name="logowanie" action="subpage.php?page=user_session" class="form" method="post">\r\n    <table>\r\n        <tr>\r\n            <td><label for="login">login</label></td>\r\n            <td><input type = "text" name = "login" style = "width: 150px;"/></td>\r\n        </tr>\r\n        <tr>\r\n            <td colspan="2"></td>\r\n        </tr>\r\n        <tr>\r\n            <td><label for="haslo">haslo</label></td>\r\n            <td><input type = "password" name = "pass" style = "width: 150px;"/></td>\r\n        </tr>\r\n        <tr>\r\n            <td colspan="2"></td>\r\n        </tr>\r\n        <tr>\r\n            <td colspan="2"></td>\r\n        </tr>\r\n        <tr>\r\n            <td colspan="2">\r\n                <p class="submit" style="text-align:center;">\r\n                    <input type="submit" value="Zaloguj" />\r\n                </p>\r\n    		</td>\r\n        </tr>\r\n        <tr>\r\n          <td colspan="2">\r\n              <p style="border-top:1px dotted #e4e4e4; text-align: center; font-size: 0.80em;  margin: 10px 0px 0px 0px; padding: 10px 0px 0px 0px;" >\r\n                 Nie masz jeszcze kotnta? <a href="subpage.php?page=sinup">załóż je</a>!<br />\r\n                 Zapomniałeś hasła <a href="/subpage.php?page=newpassword">odzyskaj je!</a>\r\n              </p>\r\n         </td>\r\n        </tr>\r\n        \r\n    </table>\r\n</form>'),
(2, 'Szukaj Nas', '<center>\r\n<a href="http://pl-pl.facebook.com/people/Dawid-Tomczyk/100000224685246" target="_TOP" title="Dawid Tomczyk"><img src="http://badge.facebook.com/badge/100000224685246.2720.560100467.png" style="border: 0px;" /></a>\r\n\r\n<a href="http://pl-pl.facebook.com/piotr.ciwis" target="_TOP" title="Piotr Ciwiś"><img src="http://badge.facebook.com/badge/1751985942.1049.1993785338.png" style="border: 0px;" /></a>\r\n</center>'),
(3, 'Szukaj', '<form name="szukanie" action="subpage.php?page=search" class="form" method="post">\r\n    <table>\r\n        <tr>\r\n            <td><label for="aim">Fraza</label></td>\r\n            <td><input type = "text" name = "aim" style = "width: 150px;"/></td>\r\n        </tr>\r\n        <tr>\r\n            <td colspan="2"></td>\r\n        </tr>\r\n        <tr>\r\n            <td colspan="2">\r\n                <p class="submit" style="text-align:center;">\r\n                    <input type="submit" value="Szukaj" />\r\n                </p>\r\n    	    </td>\r\n        </tr>\r\n    </table>\r\n</form>');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `price`
--

CREATE TABLE `price` (
  `id` int(3) NOT NULL auto_increment,
  `catId` int(3) NOT NULL default '1',
  `lang` set('pl','en') NOT NULL default 'pl',
  `name` varchar(255) default NULL,
  `price` varchar(255) default NULL,
  `unit` varchar(255) NOT NULL default 'zł/kg',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `price`
--

INSERT INTO `price` (`id`, `catId`, `lang`, `name`, `price`, `unit`) VALUES
(1, 4, 'pl', 'Cu Millbery', '24,7', 'zł/kg'),
(2, 3, 'pl', 'M63 kawałki', '15,7', 'zł/kg'),
(3, 3, 'pl', 'Cu palona gruba', '24,4', 'zł/kg'),
(4, 3, 'pl', 'Cu piecyki', '20,5', 'zł/kg'),
(5, 3, 'pl', 'Cu wióry', '19,6', 'zł/kg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `pricecat`
--

CREATE TABLE `pricecat` (
  `id` int(3) NOT NULL auto_increment,
  `lang` set('pl','en') NOT NULL default 'pl',
  `name` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `pricecat`
--

INSERT INTO `pricecat` (`id`, `lang`, `name`) VALUES
(3, 'pl', 'Miedź'),
(4, 'pl', 'Mosiądz dwuskładnikowy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `sentences`
--

CREATE TABLE `sentences` (
  `id` int(11) NOT NULL auto_increment,
  `sentence` text NOT NULL,
  `author` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin2 AUTO_INCREMENT=9 ;

--
-- Zrzut danych tabeli `sentences`
--

INSERT INTO `sentences` (`id`, `sentence`, `author`) VALUES
(1, 'The Australian Pink Floyd Live Show znów w Polsce z swoim muzyczno-świetlnym show. W Polsce odbędą się cztery koncerty, w czterech różnych miastach...\r\n\r\nRelacja z koncertu już niebawem...', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `settings`
--

CREATE TABLE `settings` (
  `name` text NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin2;

--
-- Zrzut danych tabeli `settings`
--

INSERT INTO `settings` (`name`, `value`) VALUES
('web-title', 'Blog Muzyczny - http://si-s11.laverte.pl/'),
('description', 'Muzyczny Blog - Serwisy Internetowe Projekt'),
('keywords', 'muzyka, blog, rozrywka'),
('author', 'Dawid Tomczyk, Piotr Ciwiś');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `forname` varchar(20) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `city` varchar(20) NOT NULL,
  `sex` varchar(1) NOT NULL,
  `bornDate` date NOT NULL,
  `addDate` date NOT NULL,
  `avatar` varchar(25) NOT NULL,
  `about` varchar(500) NOT NULL,
  `range` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin2 AUTO_INCREMENT=19 ;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `mail`, `forname`, `surname`, `city`, `sex`, `bornDate`, `addDate`, `avatar`, `about`, `range`) VALUES
(1, 'pyter', 'lanepiwo', 'piociw@gmail.com', 'Piotr', 'Ciwiś', 'Mikołów', 'M', '1989-03-21', '2011-10-30', 'pyter.jpg', 'koń pije piwo na polanie!', 5),
(6, 'dejvs', 'dejvs', 'dawidtomczyk@wp.eu', 'Dawid', 'Tomczyk', 'Radzionków', 'M', '0000-00-00', '2011-11-02', '_def.jpg', '', 5),
(7, 'zdupydomordyzaur', 'algorytm', 'moj_mail@pupa.pl', 'Tytus', 'Bomba', 'Kurwix', 'M', '2011-01-01', '2011-11-14', 'zdupydomordyzaur.jpg', '[Nie podano]', 0),
(16, 'Marekk', 'fanmuzyki', 'marekfan@op.pl', 'Marek', 'Markowski', 'Markowice', 'M', '2003-03-03', '2011-12-22', 'Marekk.jpg', 'Jestem fajny kolo.!', 0),
(17, 'tomek', '12345', 'aa@aa.pl', 'Zbyszek', '', '', 'M', '1985-06-07', '2012-01-19', '', '', 0),
(18, 'łolaboga', 'twojastara', '6666@wp.pl', '', '', '', 'M', '2011-01-01', '2012-01-19', '', '', 0);
