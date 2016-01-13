-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 07 Nis 2015, 23:15:53
-- Sunucu sürümü: 5.6.23
-- PHP Sürümü: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `script_siv`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `aboutus_content`
--

CREATE TABLE IF NOT EXISTS `aboutus_content` (
  `id` int(215) NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8_turkish_ci NOT NULL,
  `date_modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `aboutus_content`
--

INSERT INTO `aboutus_content` (`id`, `content`, `date_modified`) VALUES
(1, '<p>We are offering an unique opportunity for the examiners to create and conduct unlimited online exams for unlimited students without wasting any resources to develop personalize examination software&rsquo;s.</p>\n\n<p>DOES FEATURES IMAGES:</p>\n\n<ol>\n	<li>White labelled and Responsive Design</li>\n	<li>Made for Education and Recruitment Organizations</li>\n	<li>Audio, Video, Image and Multiple choice questions</li>\n	<li>Question Banks with difficulty levels</li>\n	<li>Awesome Graphic Presence for Statistics</li>\n	<li>PDF Certificate Generation</li>\n	<li>Individual Performances, Exam wise Performances</li>\n	<li>Top Rankers list from Exams</li>\n	<li>Retake Exam facility</li>\n	<li>Users Statistics</li>\n	<li>Forgot Password with Link Expiration Facility</li>\n	<li>IP block facility</li>\n	<li>Negative Marking</li>\n	<li>Mark for review</li>\n	<li>SEO Settings</li>\n	<li>Bulk upload Questions by CSV</li>\n	<li>Need more? Drop an email&nbsp;</li>\n</ol>', '2014-09-25');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `userid` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=6667 ;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`userid`, `username`, `password`) VALUES
(6666, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `catid` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_turkish_ci NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`catid`, `name`, `status`) VALUES
(1, 'Türkçe', 'Active');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `currencies`
--

CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `country` varchar(50) COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=25 ;

--
-- Tablo döküm verisi `currencies`
--

INSERT INTO `currencies` (`id`, `code`, `country`) VALUES
(1, 'AUD', 'Australian Dollar'),
(2, 'BRL', 'Brazilian Real'),
(3, 'CAD', 'Canadian Dollar'),
(4, 'CZK', 'Czech Koruna'),
(5, 'DKK', 'Danish Krone'),
(6, 'EUR', 'Euro'),
(7, 'HKD', 'Hong Kong Dollar'),
(8, 'HUF', 'Hungarian Forint'),
(9, 'ILS', 'Israeli New Sheqel'),
(10, 'JPY', 'Japanese Yen'),
(11, 'MYR', 'Malaysian Ringgit'),
(12, 'MXN', 'Mexican Peso'),
(13, 'NOK', 'Norwegian Krone'),
(14, 'NZD', 'New Zealand Dollar'),
(15, 'PHP', 'Philippine Peso'),
(16, 'PLN', 'Polish Zloty'),
(17, 'GBP', 'Pound Sterling'),
(18, 'SGD', 'Singapore Dollar'),
(19, 'SEK', 'Swedish Krona'),
(20, 'CHF', 'Swiss Franc'),
(21, 'TWD', 'Taiwan New Dollar'),
(22, 'THB', 'Thai Baht'),
(23, 'TRY', 'Turkish Lira'),
(24, 'USD', 'U.S. Dollar');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `email_setting`
--

CREATE TABLE IF NOT EXISTS `email_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `smtp_host` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `smtp_user` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `smtp_pass` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `smtp_port` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `email_setting`
--

INSERT INTO `email_setting` (`id`, `smtp_host`, `smtp_user`, `smtp_pass`, `smtp_port`) VALUES
(1, 'ssl://smtp.googlemail.com', 'digionlineexam@gmail.com', '*****', '465');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `general_settings`
--

CREATE TABLE IF NOT EXISTS `general_settings` (
  `id` int(215) NOT NULL AUTO_INCREMENT,
  `site_title` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `site_description` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `site_keywords` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `site_url` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `copy_right` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `site_logo` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `address` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `phone` bigint(16) NOT NULL,
  `passing_score` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `is_performance_report_for` enum('Allusers','Paidusers') COLLATE utf8_turkish_ci NOT NULL,
  `quizzes_for` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `contact_email` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `paypal_email` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `facebook_url` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `twitter_username` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `linkedin_url` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `feedburner_link` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `google_analytics` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `certificate_logo` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `certificate_content` longtext COLLATE utf8_turkish_ci NOT NULL,
  `certificate_sign` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `certificate_sign_text` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `added_date` date NOT NULL,
  `updated_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_title`, `site_description`, `site_keywords`, `site_url`, `copy_right`, `site_logo`, `address`, `phone`, `passing_score`, `is_performance_report_for`, `quizzes_for`, `contact_email`, `paypal_email`, `facebook_url`, `twitter_username`, `linkedin_url`, `feedburner_link`, `google_analytics`, `certificate_logo`, `certificate_content`, `certificate_sign`, `certificate_sign_text`, `added_date`, `updated_date`) VALUES
(1, 'Welcome To Digi Online Examination System &#40;DOES&#41;', 'Digi Online Examination System (DOES)', 'Digi, Online Examination System, Online Examination, DOES, Exam', 'http://envato.digitalvidhya.com/codecanyon/doesv3/', '2012-2014 DOES', 'logo.jpg', 'Hyderabad', 9490472748, '60', 'Paidusers', 'groupquizzes', 'digionlineexam@gmail.com', 'digi@gmail.com', 'https://www.facebook.com/samplename', 'sample name', 'sample name', 'Testing.com', '<script>\n\n</script>', 'certificates.jpg', '<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>', 'sign.jpg', '<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>', '2014-05-22', '2015-03-24');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=5 ;

--
-- Tablo döküm verisi `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'superadmin', 'Super Admin'),
(2, 'members', 'General User'),
(3, 'admin', 'Admin'),
(4, 'moderator', 'Moderator');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `group_settings`
--

CREATE TABLE IF NOT EXISTS `group_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_turkish_ci NOT NULL DEFAULT 'Active',
  `date_added` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=13 ;

--
-- Tablo döküm verisi `group_settings`
--

INSERT INTO `group_settings` (`id`, `group_name`, `status`, `date_added`) VALUES
(4, 'Degree', 'Active', '0000-00-00'),
(5, 'Btech', 'Active', '0000-00-00'),
(6, 'Ssc', 'Active', '0000-00-00'),
(8, 'Inter', 'Active', '0000-00-00'),
(10, 'pharmacy', 'Active', '0000-00-00'),
(11, 'Itermediate', 'Active', '0000-00-00'),
(12, 'Diploma', 'Active', '0000-00-00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `login` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=3 ;

--
-- Tablo döküm verisi `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(2, '88.224.98.208', 'mp3portali@mp3portali.com', 1428437697);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `nid` int(215) NOT NULL AUTO_INCREMENT,
  `title` mediumtext COLLATE utf8_turkish_ci NOT NULL,
  `description` longtext COLLATE utf8_turkish_ci NOT NULL,
  `post_date` date NOT NULL,
  `last_date` date NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_turkish_ci NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `paypal`
--

CREATE TABLE IF NOT EXISTS `paypal` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `paypal_email` varchar(50) COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `currency_code` varchar(10) COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `header_image` varchar(50) COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `account_type` enum('Sandbox','Production') COLLATE utf8_turkish_ci NOT NULL DEFAULT 'Sandbox',
  `status` enum('Active','Inactive') COLLATE utf8_turkish_ci NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `paypal`
--

INSERT INTO `paypal` (`id`, `paypal_email`, `currency_code`, `header_image`, `account_type`, `status`) VALUES
(1, 'digionlineexam@gmail.com', 'AUD', 'logo.jpg', 'Sandbox', 'Active');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `payu`
--

CREATE TABLE IF NOT EXISTS `payu` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `merchant_key` varchar(50) COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `salt` varchar(50) COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `test_url` varchar(50) COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `live_url` varchar(50) COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `account_type` enum('TEST','LIVE') COLLATE utf8_turkish_ci NOT NULL DEFAULT 'TEST',
  `status` enum('Active','Inactive') COLLATE utf8_turkish_ci NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `payu`
--

INSERT INTO `payu` (`id`, `merchant_key`, `salt`, `test_url`, `live_url`, `account_type`, `status`) VALUES
(1, 'JBZaLc', 'GQs7yium', 'https://test.payu.in', 'https://secure.payu.in', 'TEST', 'Active');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `questionid` int(255) NOT NULL AUTO_INCREMENT,
  `subjectid` int(255) DEFAULT NULL,
  `questiontype` enum('SingleAnswer','MultiAnswer') COLLATE utf8_turkish_ci DEFAULT 'SingleAnswer',
  `totalanswers` int(222) DEFAULT NULL,
  `question` text COLLATE utf8_turkish_ci,
  `answer1` varchar(500) COLLATE utf8_turkish_ci DEFAULT NULL,
  `answer2` varchar(500) COLLATE utf8_turkish_ci DEFAULT NULL,
  `answer3` varchar(500) COLLATE utf8_turkish_ci DEFAULT NULL,
  `answer4` varchar(500) COLLATE utf8_turkish_ci DEFAULT NULL,
  `answer5` varchar(500) COLLATE utf8_turkish_ci DEFAULT NULL,
  `correctanswer` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `hint` varchar(400) COLLATE utf8_turkish_ci DEFAULT NULL,
  `difficultylevel` enum('Easy','Medium','High') COLLATE utf8_turkish_ci DEFAULT 'Easy',
  `status` enum('Active','Inactive') COLLATE utf8_turkish_ci DEFAULT 'Inactive',
  PRIMARY KEY (`questionid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=5 ;

--
-- Tablo döküm verisi `questions`
--

INSERT INTO `questions` (`questionid`, `subjectid`, `questiontype`, `totalanswers`, `question`, `answer1`, `answer2`, `answer3`, `answer4`, `answer5`, `correctanswer`, `hint`, `difficultylevel`, `status`) VALUES
(1, 1, 'SingleAnswer', 5, '<p>Deneme Soruları Nelerdir?</p>', '<p>Ekibimizi bir şekilde karşıladılar</p>', '<p>Tam 3 yıldır bu işin peşinden koşturuyormuş.</p>', '<p>Koltuğunun altında bir dosya vardı.</p>', '<p>Deneme.</p>', '<p>Ekibimizi bir şekilde karşıladılar</p>\n', '3', '', 'Medium', 'Active'),
(2, 1, 'SingleAnswer', 4, '<p>&quot;Seni seviyor ve saygı duyuyorum.&quot; C&uuml;mlesindekine benzer bir anlatım bozukluğu hangisinde vardır?</p>', '<p>Elbette yarın gelebilir.</p>', '<p>G&ouml;r&uuml;şlerimi beğendiği gibi katılıyor da.</p>', '<p>Ben g&ouml;reve daha yeni başladım.</p>', '<p>Herkes rahatsız ve iyi değil.</p>', '', '2', '', 'Medium', 'Active'),
(3, 1, 'SingleAnswer', 4, '<p>Aşağıdaki c&uuml;mlelerin hangisinde bir anlatım bozukluğu vardır?</p>', '<p>Bari onu her g&uuml;n g&ouml;rseydin.</p>', '<p>&Ccedil;ocuğun sevin&ccedil;ten etekleri tutuştu.</p>', '<p>Bu filmin yarım kalmasını istemiyorum.</p>', '<p>Davul sesi gittik&ccedil;e artıyordu.</p>', '', '3', '', 'Medium', 'Active'),
(4, 1, 'SingleAnswer', 4, '<p>Aşağıdaki c&uuml;mlelerin hangisinde &quot;fazla&quot; s&ouml;zc&uuml;ğ&uuml;ne gerek yoktur?</p>', '<p>&Ccedil;ocuğa fazla kızmanıza gerek yok.</p>', '<p>Bu sene buralara fazla kar yağmadı</p>', '<p>&Ccedil;ocuklar, fazla biletiniz var mı?</p>', '<p>Bundan sonra daha fazla uyanık olmalısın.</p>', '', '3', '', 'Medium', 'Active');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `quiz`
--

CREATE TABLE IF NOT EXISTS `quiz` (
  `quizid` int(255) NOT NULL AUTO_INCREMENT,
  `quiztype` enum('Free','Paid') COLLATE utf8_turkish_ci DEFAULT 'Free',
  `quiz_for` varchar(222) COLLATE utf8_turkish_ci NOT NULL,
  `validitytype` enum('Days','Attempts','','') COLLATE utf8_turkish_ci NOT NULL DEFAULT 'Days',
  `validityvalue` int(255) NOT NULL DEFAULT '1',
  `quizcost` varchar(20) COLLATE utf8_turkish_ci NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `catid` int(255) DEFAULT NULL,
  `subcatid` int(255) DEFAULT NULL,
  `negativemarkstatus` enum('Active','Inactive') COLLATE utf8_turkish_ci DEFAULT NULL,
  `negativemark` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `difficultylevel` enum('Easy','Medium','High') COLLATE utf8_turkish_ci DEFAULT 'Easy',
  `hint` enum('Active','Inactive') COLLATE utf8_turkish_ci DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_turkish_ci DEFAULT 'Active',
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `deauration` varchar(512) COLLATE utf8_turkish_ci NOT NULL DEFAULT '10',
  `userattempts` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`quizid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `quiz`
--

INSERT INTO `quiz` (`quizid`, `quiztype`, `quiz_for`, `validitytype`, `validityvalue`, `quizcost`, `name`, `catid`, `subcatid`, `negativemarkstatus`, `negativemark`, `difficultylevel`, `hint`, `status`, `startdate`, `enddate`, `deauration`, `userattempts`) VALUES
(1, 'Free', '0', 'Days', 0, '0', 'Türkçe Paragraf Soruları', 1, 1, 'Inactive', '', 'Medium', 'Inactive', 'Active', '2015-03-23', '2015-04-15', '80', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `quizquestions`
--

CREATE TABLE IF NOT EXISTS `quizquestions` (
  `quizquestionid` int(255) NOT NULL AUTO_INCREMENT,
  `quizid` int(255) DEFAULT NULL,
  `subjectid` int(255) DEFAULT NULL,
  `totalquestion` int(255) DEFAULT NULL,
  PRIMARY KEY (`quizquestionid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=5 ;

--
-- Tablo döküm verisi `quizquestions`
--

INSERT INTO `quizquestions` (`quizquestionid`, `quizid`, `subjectid`, `totalquestion`) VALUES
(4, 1, 1, 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `quizsubscriptions`
--

CREATE TABLE IF NOT EXISTS `quizsubscriptions` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(255) NOT NULL,
  `quizid` int(255) NOT NULL,
  `validitytype` enum('Days','Attempts') COLLATE utf8_turkish_ci NOT NULL DEFAULT 'Days',
  `validityvalue` int(255) NOT NULL,
  `expirydate` date NOT NULL,
  `remainingattempts` int(11) NOT NULL DEFAULT '0',
  `status` enum('Active','Inactive') COLLATE utf8_turkish_ci NOT NULL DEFAULT 'Active',
  `dateofsubscription` date NOT NULL,
  `transaction_id` varchar(25) COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `payer_id` varchar(25) COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `payer_email` varchar(25) COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `payer_name` varchar(25) COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `quiz_for`
--

CREATE TABLE IF NOT EXISTS `quiz_for` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quizid` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(40) COLLATE utf8_turkish_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE utf8_turkish_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_turkish_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` mediumtext COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('042f2a2b3bd5e80604d5905c574fa98b', '185.53.44.119', 'Mozilla/5.0 (compatible; XoviBot/2.0; +http://www.xovibot.net/)', 1428297368, 'a:2:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}}'),
('04c8c316bfecb0ee5b807b3197911eae', '212.174.63.244', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36', 1428301343, 'a:2:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}}'),
('06396417d341fcfebf3cc8145fce754d', '207.46.13.63', 'msnbot-media/1.1 (+http://search.msn.com/msnbot.htm)', 1428327508, 'a:2:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}}'),
('0c9775c5df1910b8cb4a1158f74521e6', '88.224.98.208', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36', 1428437723, 'a:2:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}}'),
('106ce76e70b680621d942a6d372717a5', '5.9.151.67', 'Mozilla/5.0 (compatible; MegaIndex.ru/2.0; +https://www.megaindex.ru/?tab=linkAnalyze)', 1428267481, 'a:2:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}}'),
('1c06934d3256f56640f078719e4e9ce4', '207.46.13.4', 'msnbot-media/1.1 (+http://search.msn.com/msnbot.htm)', 1428216744, 'a:3:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}s:17:"flash:new:message";s:232:" <div class=''col-md-12''>\n										<div class=''alert alert-danger''>\n											<a href=''#'' class=''close'' data-dismiss=''alert''>&times;</a>\n											<strong>Error!</strong> Please Login to continue..\n										</div>\n									</div>";}'),
('228c8db1e5c4c7155ebec2471fbde530', '5.9.151.67', 'Mozilla/5.0 (compatible; MegaIndex.ru/2.0; +https://www.megaindex.ru/?tab=linkAnalyze)', 1428267479, 'a:2:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}}'),
('463c6f9f991ba930cc0ffe18427b9094', '5.9.151.67', 'Mozilla/5.0 (compatible; MegaIndex.ru/2.0; +https://www.megaindex.ru/?tab=linkAnalyze)', 1428267480, 'a:3:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}s:17:"flash:new:message";s:232:" <div class=''col-md-12''>\n										<div class=''alert alert-danger''>\n											<a href=''#'' class=''close'' data-dismiss=''alert''>&times;</a>\n											<strong>Error!</strong> Please Login to continue..\n										</div>\n									</div>";}'),
('4760b1fcf7303080571084adf794ce43', '5.9.151.67', 'Mozilla/5.0 (compatible; MegaIndex.ru/2.0; +https://www.megaindex.ru/?tab=linkAnalyze)', 1428267480, 'a:2:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}}'),
('4aba5e1bb11ebabcaf6737beeafb657a', '5.9.151.67', 'Mozilla/5.0 (compatible; MegaIndex.ru/2.0; +https://www.megaindex.ru/?tab=linkAnalyze)', 1428267479, 'a:2:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}}'),
('4ce5c35ffb9e54e3fdbeced7ec7c92a3', '95.15.102.35', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', 1428243652, 'a:2:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}}'),
('57bdc3f0247ce219320d97a9dcd72f6f', '5.9.151.67', 'Mozilla/5.0 (compatible; MegaIndex.ru/2.0; +https://www.megaindex.ru/?tab=linkAnalyze)', 1428267478, 'a:2:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}}'),
('6cf82e95c58e54d33a3da80a600db7fb', '207.46.13.63', 'msnbot-media/1.1 (+http://search.msn.com/msnbot.htm)', 1428327510, 'a:3:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}s:17:"flash:new:message";s:232:" <div class=''col-md-12''>\n										<div class=''alert alert-danger''>\n											<a href=''#'' class=''close'' data-dismiss=''alert''>&times;</a>\n											<strong>Error!</strong> Please Login to continue..\n										</div>\n									</div>";}'),
('75dcd745b40c469c0f7460b1e1767de4', '5.9.151.67', 'Mozilla/5.0 (compatible; MegaIndex.ru/2.0; +https://www.megaindex.ru/?tab=linkAnalyze)', 1428267493, 'a:2:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}}'),
('778ea8b90e829dffa479107629b2ce24', '88.229.1.204', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36', 1428268162, 'a:2:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}}'),
('80e1bff6f84d31dee93310674b44e908', '178.154.255.131', 'Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)', 1428241234, 'a:2:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}}'),
('8143fc6fe7442b896a454c9eb9e5b49f', '207.46.13.63', 'msnbot-media/1.1 (+http://search.msn.com/msnbot.htm)', 1428207629, 'a:3:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}s:17:"flash:new:message";s:232:" <div class=''col-md-12''>\n										<div class=''alert alert-danger''>\n											<a href=''#'' class=''close'' data-dismiss=''alert''>&times;</a>\n											<strong>Error!</strong> Please Login to continue..\n										</div>\n									</div>";}'),
('823198137361a92e2141d7e92b5f5783', '207.46.13.4', 'msnbot-media/1.1 (+http://search.msn.com/msnbot.htm)', 1428191150, 'a:3:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}s:17:"flash:new:message";s:232:" <div class=''col-md-12''>\n										<div class=''alert alert-danger''>\n											<a href=''#'' class=''close'' data-dismiss=''alert''>&times;</a>\n											<strong>Error!</strong> Please Login to continue..\n										</div>\n									</div>";}'),
('951e3e07e7d29d6e79cc04a6d207f26a', '178.154.255.143', 'Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)', 1428234229, 'a:2:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}}'),
('972590b748f003a14ea5dd7a683197ec', '178.154.255.143', 'Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)', 1428241211, 'a:2:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}}'),
('a1c46535d8c0708210079741684c825a', '178.154.255.143', 'Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)', 1428242503, 'a:2:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}}'),
('a30b70e56926b9b50be8b5bbb9d470c9', '85.106.252.156', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36', 1428394399, 'a:3:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}s:17:"flash:old:message";s:232:" <div class=''col-md-12''>\n										<div class=''alert alert-danger''>\n											<a href=''#'' class=''close'' data-dismiss=''alert''>&times;</a>\n											<strong>Error!</strong> Please Login to continue..\n										</div>\n									</div>";}'),
('a8392b6d0d630ddba4846904920c2e82', '178.154.255.143', 'Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)', 1428235058, 'a:2:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}}'),
('a855ac2aa6e654637f6f4e02b72ea9f6', '88.224.98.208', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0', 1428437209, 'a:8:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}s:8:"identity";s:15:"admin@admin.com";s:8:"username";s:18:"Administrator DOES";s:5:"email";s:15:"admin@admin.com";s:5:"image";s:12:"profil_1.png";s:7:"user_id";s:1:"1";s:14:"old_last_login";s:10:"1428437105";}'),
('ac972ef4f5d595dbc0863f64099d80c6', '217.69.133.248', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +http://go.mail.ru/help/robots)', 1428246192, 'a:2:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}}'),
('b2adf20cb7278a10bed90aa9d8a3a44a', '95.6.98.17', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36', 1428302380, 'a:2:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}}'),
('bac2882e118510160aafdcd928997209', '207.46.13.63', 'msnbot-media/1.1 (+http://search.msn.com/msnbot.htm)', 1428185393, 'a:2:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}}');
INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('cf81c66df13b84d8e1acae7771800fec', '178.154.255.131', 'Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)', 1428241210, 'a:3:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}s:17:"flash:new:message";s:232:" <div class=''col-md-12''>\n										<div class=''alert alert-danger''>\n											<a href=''#'' class=''close'' data-dismiss=''alert''>&times;</a>\n											<strong>Error!</strong> Please Login to continue..\n										</div>\n									</div>";}'),
('d456823774b68aaaee12c2cd7249b565', '178.154.255.143', 'Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)', 1428236249, 'a:2:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}}'),
('e1a8b7f4459fb062796286a70c4d7781', '85.101.7.206', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0', 1428260522, 'a:2:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}}'),
('eb3f7da6db12f623eb3863674711f2c7', '5.9.151.67', 'Mozilla/5.0 (compatible; MegaIndex.ru/2.0; +https://www.megaindex.ru/?tab=linkAnalyze)', 1428267415, 'a:2:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}}'),
('ff242d93abd5d5c0ab1127766d078c8e', '85.106.252.156', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36', 1428311789, 'a:2:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:56:"Welcome To Digi Online Examination System &#40;DOES&#41;";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2015-03-24";}}');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `subcategories`
--

CREATE TABLE IF NOT EXISTS `subcategories` (
  `subcatid` int(255) NOT NULL AUTO_INCREMENT,
  `catid` int(255) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_turkish_ci DEFAULT 'Active',
  PRIMARY KEY (`subcatid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `subcategories`
--

INSERT INTO `subcategories` (`subcatid`, `catid`, `name`, `status`) VALUES
(1, 1, 'Türkçe Soruları', 'Active');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `subjectid` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_turkish_ci DEFAULT 'Active',
  PRIMARY KEY (`subjectid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `subjects`
--

INSERT INTO `subjects` (`subjectid`, `name`, `status`) VALUES
(1, 'Türkçe Paragraf Soruları', 'Active');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `testimonials`
--

CREATE TABLE IF NOT EXISTS `testimonials` (
  `tid` int(222) NOT NULL AUTO_INCREMENT,
  `author` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `author_photo` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `description` longtext COLLATE utf8_turkish_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_turkish_ci NOT NULL DEFAULT 'Active',
  `added_date` date NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `activation_code` varchar(40) COLLATE utf8_turkish_ci DEFAULT NULL,
  `forgotten_password_code` varchar(40) COLLATE utf8_turkish_ci DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) COLLATE utf8_turkish_ci DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `group` int(222) NOT NULL DEFAULT '0',
  `company` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `image` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `date_of_registration` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=79 ;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `group`, `company`, `phone`, `image`, `date_of_registration`) VALUES
(1, '127.0.0.1', 'Administrator DOES', '$2y$08$XdaJTguakirQ32ghjwZpTOaKcVXie2GBFjCU/Ny2fhPygTIEjX8Xe', '', 'webtasarimkur@hotmail.com', '', '/YLq7vMwO/t/wonA8Mx8R.c021ee241c55d3065b', 1415604669, NULL, 1268889823, 1428437716, 1, 'Administrator', 'DOES', 0, '0', '99999999999', 'profil_1.png', '2014-06-22'),
(77, '88.224.103.155', 'Deneme dene', '$2y$08$Vya6.n7pB/TSj4oWeUyu6.2ibNClgdjW5rfs614mP37/0N8gLk8pi', NULL, 'mod@mod.com', 'b695134b70f3dd2b0cf6d953550b4391e19fd575', NULL, NULL, NULL, 1427138189, 1427993322, 1, 'Deneme', 'dene', 0, NULL, '9999999999', 'profil_77.png', '2015-03-23'),
(78, '88.224.103.155', 'user users', '$2y$08$gERqx19tUbyyYJVtFksto.EYVZ1SkzHSz74Gsgi1hilyfwSFqsCwW', NULL, 'webtasarimkur@hotmail.com', '1de2ba8a162bd4b810872cac79b6c124eb0c312b', NULL, NULL, NULL, 1427143496, 1428437598, 1, 'user', 'users', 12, NULL, '12345678999', 'profil_78_78.png', '2015-03-23');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=80 ;

--
-- Tablo döküm verisi `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(78, 77, 4),
(79, 78, 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_quiz_results`
--

CREATE TABLE IF NOT EXISTS `user_quiz_results` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `userid` int(255) NOT NULL,
  `email` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `username` varchar(225) COLLATE utf8_turkish_ci NOT NULL,
  `quiz_id` int(225) NOT NULL,
  `score` float NOT NULL,
  `total_questions` int(215) NOT NULL,
  `approx_rank` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `dateoftest` date NOT NULL,
  `timeoftest` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  `total_attempts` int(200) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `user_quiz_results`
--

INSERT INTO `user_quiz_results` (`id`, `userid`, `email`, `username`, `quiz_id`, `score`, `total_questions`, `approx_rank`, `dateoftest`, `timeoftest`, `total_attempts`) VALUES
(1, 78, 'user@user.com', 'user users', 1, 3, 4, '2000', '2015-03-24', '00:25', 14);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_quiz_results_history`
--

CREATE TABLE IF NOT EXISTS `user_quiz_results_history` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `userid` int(255) NOT NULL,
  `email` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `username` varchar(225) COLLATE utf8_turkish_ci NOT NULL,
  `quiz_id` int(225) NOT NULL,
  `score` float NOT NULL,
  `total_questions` int(215) NOT NULL,
  `dateoftest` date NOT NULL,
  `timeoftest` varchar(512) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=15 ;

--
-- Tablo döküm verisi `user_quiz_results_history`
--

INSERT INTO `user_quiz_results_history` (`id`, `userid`, `email`, `username`, `quiz_id`, `score`, `total_questions`, `dateoftest`, `timeoftest`) VALUES
(1, 78, 'user@user.com', 'user users', 1, 0, 1, '2015-03-23', '22:46'),
(2, 78, 'user@user.com', 'user users', 1, 0, 1, '2015-03-23', '22:48'),
(3, 78, 'user@user.com', 'user users', 1, 1, 1, '2015-03-23', '22:48'),
(4, 78, 'user@user.com', 'user users', 1, 1, 1, '2015-03-23', '22:49'),
(5, 78, 'user@user.com', 'user users', 1, 3, 4, '2015-03-24', '00:25'),
(6, 78, 'user@user.com', 'user users', 1, 2, 4, '2015-03-24', '10:52'),
(7, 78, 'user@user.com', 'user users', 1, 3, 4, '2015-03-24', '10:55'),
(8, 78, 'user@user.com', 'user users', 1, 1, 4, '2015-03-24', '14:35'),
(9, 78, 'user@user.com', 'user users', 1, 0, 4, '2015-04-02', '20:15'),
(10, 78, 'user@user.com', 'user users', 1, 3, 4, '2015-04-02', '20:21'),
(11, 78, 'user@user.com', 'user users', 1, 0, 4, '2015-04-02', '20:28'),
(12, 78, 'user@user.com', 'user users', 1, 0, 4, '2015-04-03', '21:11'),
(13, 78, 'user@user.com', 'user users', 1, 0, 4, '2015-04-03', '21:14'),
(14, 78, 'user@user.com', 'user users', 1, 0, 4, '2015-04-07', '23:06');

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
