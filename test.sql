-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 19 feb 2012 kl 03:00
-- Serverversion: 5.5.16
-- PHP-version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `test`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `comment_content` varchar(1000) NOT NULL,
  `comment_by` varchar(25) NOT NULL,
  `comment_time` datetime NOT NULL,
  `comment_on_post_id` int(10) unsigned NOT NULL,
  `comment_ip` varchar(255) NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=99 ;

--
-- Dumpning av Data i tabell `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_content`, `comment_by`, `comment_time`, `comment_on_post_id`, `comment_ip`) VALUES
(87, 'Lol', 'adam', '2012-02-16 03:15:08', 100, '127.0.0.1'),
(88, 'Ganska kul', 'GÃ¤st', '2012-02-16 15:05:29', 100, '127.0.0.1'),
(89, 'Yeeei', 'GÃ¤st', '2012-02-16 15:05:44', 101, '127.0.0.1'),
(90, 'Lol', 'anv', '2012-02-17 22:40:01', 100, '127.0.0.1'),
(91, 'ewrwe', 'anv', '2012-02-17 22:41:21', 101, '127.0.0.1'),
(92, 'Kuul ju', 'GÃ¤st', '2012-02-18 04:38:54', 117, '127.0.0.1'),
(93, 'Heheee HÃ„Ã„', 'adam', '2012-02-18 16:22:25', 118, '127.0.0.1'),
(94, 'ds g', 'GÃ¤st', '2012-02-18 16:51:34', 119, '127.0.0.1'),
(95, 'dg fa', 'GÃ¤st', '2012-02-18 16:51:39', 119, '127.0.0.1'),
(96, 'df gadf ', 'GÃ¤st', '2012-02-18 16:51:44', 119, '127.0.0.1'),
(97, 'df dfs', 'GÃ¤st', '2012-02-18 16:51:49', 119, '127.0.0.1'),
(98, 'df  df', 'GÃ¤st', '2012-02-18 16:51:56', 119, '127.0.0.1');

-- --------------------------------------------------------

--
-- Tabellstruktur `online`
--

CREATE TABLE IF NOT EXISTS `online` (
  `time` time NOT NULL,
  `ip` int(11) NOT NULL,
  `track` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `online`
--

INSERT INTO `online` (`time`, `ip`, `track`) VALUES
('23:30:04', 1270, ''),
('23:30:04', 1270, '119'),
('23:30:38', 1270, ''),
('23:30:38', 1270, '119'),
('23:30:54', 1270, ''),
('23:30:54', 1270, '119'),
('23:31:24', 1270, ''),
('23:31:25', 1270, '119'),
('23:31:33', 1270, ''),
('23:31:33', 1270, '119'),
('23:31:53', 1270, ''),
('23:31:54', 1270, '119'),
('23:32:10', 1270, ''),
('23:32:10', 1270, '119'),
('23:32:26', 1270, ''),
('23:32:27', 1270, '119'),
('23:32:36', 1270, ''),
('23:32:37', 1270, '119'),
('23:32:46', 1270, ''),
('23:32:46', 1270, '119'),
('23:33:21', 1270, ''),
('23:33:21', 1270, '119'),
('23:37:37', 1270, ''),
('23:37:44', 1270, ''),
('23:38:01', 1270, ''),
('23:38:29', 1270, ''),
('23:38:38', 1270, ''),
('23:38:41', 1270, ''),
('02:32:02', 1270, ''),
('02:32:02', 1270, '119'),
('02:32:09', 1270, '');

-- --------------------------------------------------------

--
-- Tabellstruktur `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_title` varchar(80) NOT NULL,
  `post_content` varchar(5000) NOT NULL,
  `post_creator` varchar(25) NOT NULL,
  `post_ip` varchar(255) NOT NULL,
  `post_time` datetime NOT NULL,
  `post_edit_time` datetime NOT NULL,
  `post_edit_by` varchar(25) NOT NULL,
  `post_views` int(11) unsigned NOT NULL,
  `post_rank` tinyint(3) NOT NULL COMMENT 'Listar efter popularitet',
  `post_desc` varchar(510) NOT NULL COMMENT 'kort beskrivning',
  `post_cat_type` tinyint(2) NOT NULL,
  `post_upload_id` int(11) NOT NULL,
  `post_conf` tinyint(4) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=123 ;

--
-- Dumpning av Data i tabell `posts`
--

INSERT INTO `posts` (`post_id`, `post_title`, `post_content`, `post_creator`, `post_ip`, `post_time`, `post_edit_time`, `post_edit_by`, `post_views`, `post_rank`, `post_desc`, `post_cat_type`, `post_upload_id`, `post_conf`) VALUES
(100, 'Rubrik', '<strong>s fsdafa sdfsadf</strong><strong></strong><br />sdiofj siodafjiojasdfoij saodifjosdiafis udhafniuasd hfiugbsdafugbsxbnsj dkcvnsiadhfn iu hdfahs daifhsiaufd uixchvui safuhdsiuadfh uihasfuh sa fui hsduifh ius afhv fuixhcv xbnczm, xbviuwsdfuis dbcvuisbdvui sbdvciub sdviubsdv uisadu vbisudb iusbdafibu sadfubsadf<br />ssdfasdfsad fsad f<br /><strong>Miiiicke</strong><br />asfpiasodfijasiofj oia', 'anv', '127.0.0.1', '2012-02-16 03:10:42', '0000-00-00 00:00:00', '', 20, 6, 'en fin inleding asodh ioashdoihas diuhasoidh asioh doihas odih asiohd asio h', 0, 0, 1),
(101, 'Till rubrik', 'asdfasd asd asd asd asd asdas das das das das dasd asd as das dasd <br /><strong>asdasfasf asf</strong>', 'adam', '127.0.0.1', '2012-02-16 03:22:17', '0000-00-00 00:00:00', '', 16, 0, 'oaisjdoiasj doiasjdoiasjdoijqwoij aiudiasudh iuasdhiuash duiashdui hasduih asiudh iasu dhiasudh iuasdh', 0, 0, 1),
(102, 'Du kan ocksÃ¥', '<strong>Oj</strong>okok<br /><br />Juiiuyigasdyg asduyhasiudhoasf sdf sd asdgasdf asdf sdafs adfsdaf sdf sdaf asdf asdasdfs dafsad fsd sad fsadf asdfs dfsd f sdafsd fasad fsd fsdf asdf sadf asdfsdf afs ddsf sdfa fsd af sda sdf sadf dsf sdaf sdfasdf sdf sadf sadfasdf sadf sadf sadf sadds fahtrujtyujd fhrturt rthrdhf gh dfh hf fd', 'anv', '127.0.0.1', '2012-02-16 04:24:02', '0000-00-00 00:00:00', '', 11, 0, 'en asiodnoasidn asoidn oin bra sako i noasn doina sdniioansd a.sdoas nidoiasndoin asd', 0, 0, 1),
(103, 'Vhat ioje', '<strong>asd nasdbhasb jhasd a<br /></strong>sdanjfb ashsab fuasbf hasbdfmnsdb jf iqwehfiuqh fqwopj dioqwfjksb dfjsbdf ,zxcvnsjkdfquibw diqwohd uibdiuas bdasfuigbasiufgqu wfdiqwugf iuqfg wuiq fgiuqwef iwepufg weuifg iweugf wuieffgb wfsudgbfuc ysfuywef uwefvweu fuywefv uyewfv uyewufvy weufv uyvuys uiqweofg wefioguwefy uywefvweyfvwe fwevbyf uyvwefyuwevf uwefvuywe iweuo fewuf weyfv euwfywev fuywev wef wef wee w<br /><strong><br />we fweiuh fuiwebuib weuibweui uiwef <br /></strong>kbdf jksdfui iusdbfuib sdfuisdgbu isdufuisd ubisdf uibsdfui bsdfuib sjfp wejoif weuihf iuwefui weui fuiew uie wy wegfiweiu gfuiwe uigf wuiuiwe fugweui fguiwegfb weiufuiwe fuiwe fuiew fuiewfh iweuf uiwef bweuif eiwuf iweuf uiwef uiwef iwuef hweuif ewuif ewfwe&nbsp; sdf sdf sdf sdf sdf', 'adam', '127.0.0.1', '2012-02-16 15:02:09', '0000-00-00 00:00:00', '', 5, 0, 's aiduisah diuasui duiasn diuasbndiubasdi ubasoidbnasiodn ioasdjio adh suia diubasdui basduibasidbasuib duias du asbnidubasui bdasiubd iasubd iabsdiub', 0, 0, 1),
(104, 'I U D oasijdoi', '<span style="text-decoration: underline;"><strong>iubui sdf sdfsd fsdf</strong></span><br />sdf sd fsdlnfi sdfuhsd iufbsui fioewh fiouwbhfuih wuiegbfuqeg ipug qwiudgbqw dbncfbsd ffuo gqeufo ewgvyowv fyefv uiwevofuov qefv quefv uy efvuysv dfuyvsdfuy vsdfuvso fwfnwoiefguweiof gweuifgvbefcge uyweufg ewfg weuifgwe ufefg uwefg woewf <br /><strong>we fwe fwebhi uigb <br /></strong>e wfh iuwefbh uiweuifhiuwefbwe fwjkoefn iusdf', 'adam', '127.0.0.1', '2012-02-16 15:03:03', '0000-00-00 00:00:00', '', 4, 0, 'poopj 0oijsdpo asopjkd opasjd oasp opasdopaj sdopj asdopj aopsdjaposdj ioashdibasfuisdb ifubsd uifsuifui wbfuiewb iu', 0, 0, 1),
(105, 'P G uiouhui', 'ijd i9uf wef euiwfiu jkxcn vkldfnv kjsdfng jkfg<br />&nbsp;sfg joidfgj iosdfgoidf uigdhng iuphdfip suiopdg ouisdfgosdfpghisdfgn sdf<br />gsdf gdfs iosdfhiosdf hpidfd sd', 'adam', '127.0.0.1', '2012-02-16 15:04:27', '0000-00-00 00:00:00', '', 3, 0, 'hiasudhuias dui asuidh', 0, 0, 1),
(106, 'Generlaol', '<em>asd asdasd asdas d<br /></em>&nbsp;asdmnoasi ndioans doinasdio asdhni asiodnioasn d<br />asd nosfnsdf indsfiubn sdifbniausdfbuisdbfuisdbfuibasdfuibsdfuibsdfuibasduifbsduiafbsdi u uisd bui uias fbuisad sda fuiosd uibsd fsda', 'adam', '127.0.0.1', '2012-02-16 16:22:19', '0000-00-00 00:00:00', '', 2, 0, 'kansoindsaoindoinas doinao sdnasoidnoasin ioasndioansdo inasoidn oaisndo', 0, 0, 1),
(107, 'Ogranskad', '<strong>sd afasd fasd fasdf nasdfjb ''<br /></strong>sdf aasd fasdfh uasldfhiasduf uasdfuih sdauifh asduifhasuid fhasdf<br />Â sadfh asuidfh uiashd fiuhasdfiuh asdifuh iasudhfui asdfuihsdafi usaduifh iusdfhuisdh uihasdf uiasdhf sdafh sdf asdf asdf sdafas', 'adam', '127.0.0.1', '2012-02-16 17:12:08', '0000-00-00 00:00:00', '', 0, 0, 'Juuustaoh ushuasd uiahsdhu asuidh uiashd asiudh asuidhuias iashd uiasdh', 0, 0, 1),
(108, 'a', 'a', 'adam', '127.0.0.1', '2012-02-16 17:35:30', '0000-00-00 00:00:00', '', 0, 0, 'a', 0, 0, 1),
(109, '', '''', 'adam', '127.0.0.1', '2012-02-16 17:52:37', '0000-00-00 00:00:00', '', 1, 0, '', 0, 0, 0),
(110, '1234567890123456789012', 'hUSUSAUIJSA<strong>SDAASFD<br />SDFDSFADSFDSF<br />ASDF<br />ASDFSDAF SDF JOS DIAHUIOH SDFOIJHASDFOIJ SDIOAFJ IOJDASFIO IOSDJF ASDF </strong>', 'adam', '127.0.0.1', '2012-02-17 22:53:35', '0000-00-00 00:00:00', '', 1, 0, 'asduhashdu', 0, 0, 1),
(111, 'dsf', 'sdf', 'adam', '127.0.0.1', '2012-02-18 03:57:41', '0000-00-00 00:00:00', '', 0, 0, 'sdf', 0, 0, 0),
(112, '', '', 'adam', '127.0.0.1', '2012-02-18 03:58:21', '0000-00-00 00:00:00', '', 0, 0, '', 0, 0, 0),
(113, '', '', 'adam', '127.0.0.1', '2012-02-18 03:59:45', '0000-00-00 00:00:00', '', 1, 0, '', 0, 0, 2),
(114, 'sad', 'asd', 'adam', '127.0.0.1', '2012-02-18 04:00:41', '0000-00-00 00:00:00', '', 1, 0, 'asd', 0, 0, 2),
(115, '', '', 'adam', '127.0.0.1', '2012-02-18 04:04:46', '0000-00-00 00:00:00', '', 0, 0, '', 0, 0, 2),
(116, 'ska bli kult', 'awio0ed uiawjio d ds<br />&nbsp;sdfinoasj dfiojsdf a', 'adam', '127.0.0.1', '2012-02-18 04:10:44', '0000-00-00 00:00:00', '', 7, 7, 'yywwwy', 0, 0, 1),
(117, 'Fin rubrik med bild', '<strong>D&auml;r g&aring;r en d&ouml;perpl<br /></strong>Fy f&auml;reopk iofweoifweioh weoifh iowh efihowe &aring;ihfosdi faasdfoisdfoih sdioahf&nbsp; iohsdafioh sdfiohioshadf oishdfoi hsdfioh s diofhoiasdh fiohs dfo ihsdfioh siofhdiosh oihsd fiohsdf iosdfhio hio sd iohsfioh sdio hfohisdio sdohifioshd foihsdfio sdhiofaio hsdfoiha iosdfh iohsdfh iosodif hiosdh fiohsdhi osdfh sdoihfiosadhf iosh dfiohsd iohsdfhi sdiofh oisdhf iohsdaf hiosadfioh siodhf oishdaf oishdf oishd afiohsd aiohsioadfh osidfhso ihfddhios ahfoish adfoishdf iosdfh saodfih sdiohf iosdhaio fioashdfoisahdfn sdo iafhi soidh fasdhio sdhio hio sdhiosd hi sdio sdfhio sdaiho sdah ioasdhois adhi<br /><strong><br />adf gdafgadf gadgda jioadiogjioadjfgoijad gi<br /></strong><br />dfgdoauig iadfguihdauif ghuidahf guihdfaugh duiag iudfa uhdfa dadaf gdaf gadf gadf gadf gadf adf adf adh sfh dfkbdafui adguip hadguihd agh juste vad brta att de kommer lite svenska nuy d&aring;', 'adam', '127.0.0.1', '2012-02-18 04:29:48', '0000-00-00 00:00:00', '', 9, 0, 'JuuustÃ¤Ã¤Ã¤Ã¤', 0, 0, 1),
(118, 'JusstÃ¤Ã¤', '<strong>sdaf sdafio jsdfji sdiofajoijsdf<br /></strong>sdfo ajuisdfhui hsdfiuh uidfhiusaf uihsdfiuh sduifuisdh uihxcviub zuxvuixcbhzv iuhxcb zvuih&nbsp; zxuicvhuixcvh iuhxczv uixhczviuh ixcuzvhiuxzcv iuhxczv iuhxczvui iuxch uihxcvui iuxcz uixcz<br />sdf aihsduifh uisdfh ouihsdafuihsduiafh usdhfsdh afuihsdiopaf uiosdhafuisdfuiah sduifh uisdfh uihsdaf sdfa sdf a', 'adam', '127.0.0.1', '2012-02-18 16:19:05', '0000-00-00 00:00:00', '', 4, 0, 'asidhuiasdhui ashduih asdiuasd uiasdhash duiashd ui', 0, 0, 1),
(119, 'aiyshd uhasduihasuid ', '<strong>sdfsd afs dfsd a<br /></strong>sdf asda fsd ojisdf ijsd fiojsiodf joisdfjoisdj foisdjfoi sdfijsd fiosd oisdjf oijsdfjio sdfiosdf joisdj foisdjf sdjifjio sdfjio sd fjisdiojf iosdfj isdijo sdfjiosd fjisdijo fsdjio&nbsp; df sjvjh dfsbi fdo idgjdsfjiog oidfgjiodfs iodfjiojdfg iodfjio fdj jdfioj fgoijd sfgidfoigj dfiojg odfij iodfg oidfj goidjfo fdsigj dofiiodf sjiofj sdiofdji odfjdfogj<span style="color: #0c85d4; text-decoration: underline;">...</span>', 'adam', '127.0.0.1', '2012-02-18 16:34:05', '0000-00-00 00:00:00', '', 33, 0, 'ookefdjwe iodioejw iowehi uhwefiowerfipuawer fgh a dfuhd iu fhdui ahsfduig uiseafui sdafui sa uifuiasdg uiasdfu asdufh uiasdfu sdh sdfuih sd uhsdiau fiasdh isdfu h', 0, 0, 1),
(120, 'loal', 'oiuhn sidf sdf', 'adam', '127.0.0.1', '2012-02-18 19:38:34', '0000-00-00 00:00:00', '', 1, 9, 'qnio', 0, 0, 1),
(121, 'wqrsedfasf', '<strong>weterwtv wybsdf sdaf asdf sdfaasdf sdfa sdaf sda&nbsp;</strong>sdaf sdafsd afsd afsd afsd afdsaf sdfa sdaf sdaf sdfa sdaf sdaf sdaf sdfa sdaf sdfa sdfa sdaf ert er rtaweqwe qwe qwd sd afsdf&nbsp;<span style="color: #0c85d4; text-decoration: underline;">...</span>', 'adam', '127.0.0.1', '2012-02-18 19:39:24', '0000-00-00 00:00:00', '', 1, 8, 'wr', 0, 0, 1),
(122, '65 37 65', '<strong>sdgts vy y r<br />&nbsp;rtsrss </strong>', 'adam', '127.0.0.1', '2012-02-18 19:39:53', '0000-00-00 00:00:00', '', 3, 5, 'ookefdjwe iodioejw iowehi uhwefiowerfipuawer fgh a dfuhd iu fhdui ahsfduig uiseafui sdafui sa uifuiasdg uiasdfu asdufh uiasdfu sdh sdfuih sd uhsdiau fiasdh isdfu h', 0, 0, 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `upload`
--

CREATE TABLE IF NOT EXISTS `upload` (
  `upload_id` int(11) NOT NULL AUTO_INCREMENT,
  `upload_name` varchar(30) NOT NULL,
  `upload_type` varchar(30) NOT NULL,
  `upload_size` int(11) NOT NULL,
  `upload_by_user` varchar(25) NOT NULL,
  `upload_to_post_id` int(11) NOT NULL,
  `upload_dir` varchar(255) NOT NULL,
  `upload_dir_606` varchar(255) NOT NULL,
  `upload_dir_240` varchar(255) NOT NULL,
  PRIMARY KEY (`upload_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumpning av Data i tabell `upload`
--

INSERT INTO `upload` (`upload_id`, `upload_name`, `upload_type`, `upload_size`, `upload_by_user`, `upload_to_post_id`, `upload_dir`, `upload_dir_606`, `upload_dir_240`) VALUES
(1, '(1)607691main_Kepler22bArtwork', 'image/jpeg', 160361, 'adam', 0, 'images/(1)607691main_Kepler22bArtwork_946-710_610x458.jpg', '', ''),
(2, '(2)607691main_Kepler22bArtwork', 'image/jpeg', 160361, 'adam', 0, 'images/(2)607691main_Kepler22bArtwork_946-710_610x458.jpg', '', ''),
(3, '(3)607691main_Kepler22bArtwork', 'image/jpeg', 160361, 'adam', 114, 'images/(3)607691main_Kepler22bArtwork_946-710_610x458.jpg', '', ''),
(4, '20111009625.JPG', 'jpeg', 2723381, 'adam', 115, 'images/20111009625.JPG', '', ''),
(5, '20110910583.JPG', 'jpeg', 1744265, 'adam', 116, 'images/20110910583.JPG', 'images/606_20110910583.JPG', ''),
(6, '20110906549.JPG', 'jpeg', 1714708, 'adam', 117, 'images/20110906549.JPG', 'images/606_20110906549.JPG', ''),
(7, 'myPicRotated.jpg', 'jpeg', 16119, 'adam', 118, 'images/myPicRotated.jpg', 'images/606_myPicRotated.jpg', ''),
(8, '(1)20111009625.JPG', 'jpeg', 2723381, 'adam', 119, 'images/(1)20111009625.JPG', 'images/606_(1)20111009625.JPG', 'images/240_(1)20111009625.JPG'),
(9, '(1)20110910583.JPG', 'jpeg', 1744265, 'adam', 120, 'images/(1)20110910583.JPG', 'images/606_(1)20110910583.JPG', 'images/240_(1)20110910583.JPG'),
(10, '(1)20110906549.JPG', 'jpeg', 1714708, 'adam', 121, 'images/(1)20110906549.JPG', 'images/606_(1)20110906549.JPG', 'images/240_(1)20110906549.JPG'),
(11, '20110825533.JPG', 'jpeg', 2286401, 'adam', 122, 'images/20110825533.JPG', 'images/606_20110825533.JPG', 'images/240_20110825533.JPG');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(25) NOT NULL,
  `user_pass` varchar(40) NOT NULL,
  `user_email` varchar(80) NOT NULL,
  `user_date` date NOT NULL,
  `user_level` tinyint(2) unsigned NOT NULL,
  `user_ip` varchar(23) NOT NULL COMMENT 'Ändra senare?',
  `user_location` varchar(60) NOT NULL,
  `user_personnummer` int(12) unsigned NOT NULL,
  `user_notification` enum('0','1') NOT NULL DEFAULT '1',
  `user_firstname` varchar(80) NOT NULL,
  `user_lastname` varchar(80) NOT NULL,
  `user_malt` varchar(40) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=94 ;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_date`, `user_level`, `user_ip`, `user_location`, `user_personnummer`, `user_notification`, `user_firstname`, `user_lastname`, `user_malt`) VALUES
(92, 'anv', '97c0ecf7724f2ff5aacbc2099d3ad72f90dbf51c', 'mail@osd.se', '2012-02-16', 0, '127.0.0.1', '', 0, '1', 'Oij', 'Just', ''),
(93, 'adam', '173fae587d22d3c0b7e898fe02e6bad018a148f9', 'mail@aosk.se', '2012-02-16', 1, '127.0.0.1', '', 0, '1', 'adam', 'hei', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
