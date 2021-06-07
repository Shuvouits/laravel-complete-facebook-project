-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2020 at 06:10 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `computer`
--

-- --------------------------------------------------------

--
-- Table structure for table `apps_countries`
--

CREATE TABLE `apps_countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apps_countries`
--

INSERT INTO `apps_countries` (`id`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People\'s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People\'s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'ES', 'Spain'),
(203, 'LK', 'Sri Lanka'),
(204, 'SH', 'St. Helena'),
(205, 'PM', 'St. Pierre and Miquelon'),
(206, 'SD', 'Sudan'),
(207, 'SR', 'Suriname'),
(208, 'SJ', 'Svalbard and Jan Mayen Islands'),
(209, 'SZ', 'Swaziland'),
(210, 'SE', 'Sweden'),
(211, 'CH', 'Switzerland'),
(212, 'SY', 'Syrian Arab Republic'),
(213, 'TW', 'Taiwan'),
(214, 'TJ', 'Tajikistan'),
(215, 'TZ', 'Tanzania, United Republic of'),
(216, 'TH', 'Thailand'),
(217, 'TG', 'Togo'),
(218, 'TK', 'Tokelau'),
(219, 'TO', 'Tonga'),
(220, 'TT', 'Trinidad and Tobago'),
(221, 'TN', 'Tunisia'),
(222, 'TR', 'Turkey'),
(223, 'TM', 'Turkmenistan'),
(224, 'TC', 'Turks and Caicos Islands'),
(225, 'TV', 'Tuvalu'),
(226, 'UG', 'Uganda'),
(227, 'UA', 'Ukraine'),
(228, 'AE', 'United Arab Emirates'),
(229, 'GB', 'United Kingdom'),
(230, 'US', 'United States'),
(231, 'UM', 'United States minor outlying islands'),
(232, 'UY', 'Uruguay'),
(233, 'UZ', 'Uzbekistan'),
(234, 'VU', 'Vanuatu'),
(235, 'VA', 'Vatican City State'),
(236, 'VE', 'Venezuela'),
(237, 'VN', 'Vietnam'),
(238, 'VG', 'Virgin Islands (British)'),
(239, 'VI', 'Virgin Islands (U.S.)'),
(240, 'WF', 'Wallis and Futuna Islands'),
(241, 'EH', 'Western Sahara'),
(242, 'YE', 'Yemen'),
(243, 'ZR', 'Zaire'),
(244, 'ZM', 'Zambia'),
(245, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(200) NOT NULL,
  `sender_id` int(200) NOT NULL,
  `sender_fname` text NOT NULL,
  `sender_lname` text NOT NULL,
  `sender_data` varchar(200) NOT NULL,
  `receiver_id` int(200) NOT NULL,
  `receiver_fname` text NOT NULL,
  `receiver_lname` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `sender_id`, `sender_fname`, `sender_lname`, `sender_data`, `receiver_id`, `receiver_fname`, `receiver_lname`, `date`) VALUES
(175, 12, 'Washim', 'Akram', 'Hi virhat...??', 14, 'Virhat', 'Kholi', '2020-11-17 04:18:17'),
(176, 12, 'Washim', 'Akram', 'Hellow sachine..', 13, 'sachine', 'Tendulkar', '2020-11-17 04:18:37'),
(178, 16, 'Bishow', 'Kuri', 'hey shuvo', 11, 'shuvo', 'Bhowmik', '2020-11-29 03:20:38'),
(179, 12, 'Washim', 'Akram', 'Hi ricky. How are you??', 19, 'Ricky', 'Ponting', '2020-12-02 03:38:55'),
(180, 19, 'Ricky', 'Ponting', 'hellow washim vai??', 12, 'Washim', 'Akram', '2020-12-02 03:40:07'),
(181, 19, 'Ricky', 'Ponting', 'hi washim.. How are you??', 12, 'Washim', 'Akram', '2020-12-02 03:40:51'),
(182, 12, 'Washim', 'Akram', 'i am fine..', 19, 'Ricky', 'Ponting', '2020-12-02 03:41:12');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(200) NOT NULL,
  `post_id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `user_fname` text NOT NULL,
  `user_lname` text NOT NULL,
  `comment_data` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `post_id`, `user_id`, `user_fname`, `user_lname`, `comment_data`) VALUES
(24, 32, 14, 'Virhat', 'Kholi', 'Really the day was nice..'),
(27, 32, 12, 'Washim', 'Akram', 'Blue sky always gives a positive impact.'),
(28, 29, 14, 'Virhat', 'Kholi', 'This is my comment'),
(31, 33, 12, 'Washim', 'Akram', 'Looking nice'),
(32, 26, 12, 'Washim', 'Akram', 'Please someone comment my post.'),
(33, 26, 12, 'Washim', 'Akram', 'Another me'),
(36, 27, 14, 'Virhat', 'Kholi', 'Nice picture comment Update Washim vai..'),
(38, 27, 12, 'Washim', 'Akram', 'thanks virhat'),
(157, 26, 14, 'Virhat', 'Kholi', 'I am also Update my comment of your post'),
(161, 33, 14, 'Virhat', 'Kholi', 'Ajax comment try Update'),
(163, 36, 16, 'Bishow', 'Kuri', 'Nice comment'),
(164, 36, 11, 'shuvo', 'Bhowmik', 'Thank you..'),
(165, 36, 11, 'shuvo', 'Bhowmik', 'Again comment'),
(166, 38, 12, 'Washim', 'Akram', 'It is a nice post...');

-- --------------------------------------------------------

--
-- Table structure for table `demo`
--

CREATE TABLE `demo` (
  `id` int(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `friend_picture` varchar(200) NOT NULL,
  `friend_id` int(200) NOT NULL,
  `friend_email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `likedata`
--

CREATE TABLE `likedata` (
  `id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `user_fname` text NOT NULL,
  `user_lname` text NOT NULL,
  `post_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likedata`
--

INSERT INTO `likedata` (`id`, `user_id`, `user_fname`, `user_lname`, `post_id`) VALUES
(180, 14, 'Virhat', 'Kholi', 29),
(181, 14, 'Virhat', 'Kholi', 26),
(182, 14, 'Virhat', 'Kholi', 31),
(183, 14, 'Virhat', 'Kholi', 30),
(184, 14, 'Virhat', 'Kholi', 27),
(185, 12, 'Washim', 'Akram', 26),
(186, 12, 'Washim', 'Akram', 29),
(187, 14, 'Virhat', 'Kholi', 32),
(188, 14, 'Virhat', 'Kholi', 33),
(189, 14, 'Virhat', 'Kholi', 25),
(190, 12, 'Washim', 'Akram', 34),
(191, 15, 'Soib', 'Akhter', 35),
(192, 16, 'Bishow', 'Kuri', 36),
(194, 19, 'Ricky', 'Ponting', 38),
(195, 12, 'Washim', 'Akram', 38);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(200) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `mode` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `fname`, `lname`, `password`, `email`, `image`, `mode`) VALUES
(11, 'shuvo', 'Bhowmik', '12345678S', 'shuvobhowmik_cse11uits@yahoo.com', '126570428_3480950008655462_8205808223811224599_o.jpg', 'offline'),
(12, 'Washim', 'Akram', '123456789', 'washimakram@yahoo.com', 'Wasim-Akram-1280x720.jpg', 'offline'),
(13, 'sachine', 'Tendulkar', '123456789', 'sachinetendulkar@yahoo.com', '24sachin1.jpg', 'offline'),
(14, 'Virhat', 'Kholi', '123456789', 'virhatkholi@yahoo.com', 'Virat-Kohli-1.jpg', 'offline'),
(15, 'Soib', 'Akhter', '123456789S', 'soibakhter@yahoo.com', 'OIP.jpg', 'online'),
(16, 'Bishow', 'Kuri', '123456789', 'bishowkuri@yahoo.com', '119177621_3738813249481334_1729388930322960962_n.jpg', 'online'),
(19, 'Ricky', 'Ponting', 'R1234567', 'rickeyponting@yahoo.com', 'Ricky-Ponting.jpg', 'offline');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `ID` int(200) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Department` varchar(200) NOT NULL,
  `City` varchar(200) NOT NULL,
  `Phone` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`ID`, `Name`, `Department`, `City`, `Phone`) VALUES
(11310702, 'Shubhashish Bhowmik', 'C.S.E', 'Dhaka', '01751720590'),
(11310703, 'Protyay Roy', 'Economics', 'Jessore', '01719657016'),
(11310704, 'chandan k roy', 'Machanical Engineering', 'Aurban, USA', '01719657016'),
(11310705, 'Protic Roy', 'Civil', 'Khulna', '01717723557'),
(11310706, 'Avijit Bhowmik', 'English', 'Kolkatha', '01717723557');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `profilepic` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userlist`
--

CREATE TABLE `userlist` (
  `id` int(200) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `user_f_name` text NOT NULL,
  `user_l_name` text NOT NULL,
  `user_image` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `f_email` varchar(200) NOT NULL,
  `f_id` int(200) NOT NULL,
  `f_f_name` text NOT NULL,
  `f_l_name` text NOT NULL,
  `f_image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userlist`
--

INSERT INTO `userlist` (`id`, `user_email`, `user_id`, `user_f_name`, `user_l_name`, `user_image`, `status`, `f_email`, `f_id`, `f_f_name`, `f_l_name`, `f_image`) VALUES
(55, 'virhatkholi@yahoo.com', 14, 'Virhat', 'Kholi', 'Virat-Kohli-1.jpg', 'friend', 'sachinetendulkar@yahoo.com', 13, 'sachine', 'Tendulkar', '24sachin1.jpg'),
(56, 'sachinetendulkar@yahoo.com', 13, 'sachine', 'Tendulkar', '24sachin1.jpg', 'friend', 'washimakram@yahoo.com', 12, 'Washim', 'Akram', 'Wasim-Akram-1280x720.jpg'),
(58, 'washimakram@yahoo.com', 12, 'Washim', 'Akram', 'Wasim-Akram-1280x720.jpg', 'friend', 'shuvobhowmik_cse11uits@yahoo.com', 11, 'shuvo', 'Bhowmik', 'a.jpg'),
(59, 'virhatkholi@yahoo.com', 14, 'Virhat', 'Kholi', 'Virat-Kohli-1.jpg', 'friend', 'shuvobhowmik_cse11uits@yahoo.com', 11, 'shuvo', 'Bhowmik', 'a.jpg'),
(60, 'shuvobhowmik_cse11uits@yahoo.com', 11, 'shuvo', 'Bhowmik', '126570428_3480950008655462_8205808223811224599_o.jpg', 'friend', 'bishowkuri@yahoo.com', 16, 'Bishow', 'Kuri', 'a.jpg'),
(62, 'rickeyponting@yahoo.com', 19, 'Ricky', 'Ponting', 'Ricky-Ponting.jpg', 'friend', 'washimakram@yahoo.com', 12, 'Washim', 'Akram', 'Wasim-Akram-1280x720.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `userpost`
--

CREATE TABLE `userpost` (
  `id` int(200) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `message` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `choose` varchar(200) NOT NULL,
  `user_image` varchar(200) NOT NULL,
  `user_fname` varchar(200) NOT NULL,
  `user_lname` varchar(200) NOT NULL,
  `user_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userpost`
--

INSERT INTO `userpost` (`id`, `user_email`, `message`, `image`, `time`, `choose`, `user_image`, `user_fname`, `user_lname`, `user_id`) VALUES
(25, 'sachinetendulkar@yahoo.com', 'Hellow friends?? This is my first post', '24sachin1.jpg', '2020-11-08 06:55:43', 'Friend', '24sachin1.jpg', 'sachine', 'Tendulkar', 13),
(26, 'washimakram@yahoo.com', 'Hellow', '', '2020-11-08 06:56:48', 'Friend', 'Wasim-Akram-1280x720.jpg', 'Washim', 'Akram', 12),
(27, 'washimakram@yahoo.com', 'hi', 'Wasim-Akram-1280x720.jpg', '2020-11-08 06:57:22', 'Public', 'Wasim-Akram-1280x720.jpg', 'Washim', 'Akram', 12),
(29, 'virhatkholi@yahoo.com', 'Hello friends.. This is my second post', '', '2020-11-08 07:10:06', 'Friend', 'Virat-Kohli-1.jpg', 'Virhat', 'Kholi', 14),
(31, 'washimakram@yahoo.com', 'Hello .. I am Washim Akram and This post will be public...', '', '2020-11-08 08:19:33', 'Public', 'Wasim-Akram-1280x720.jpg', 'Washim', 'Akram', 12),
(33, 'virhatkholi@yahoo.com', 'Leader the nation', 'Virat-Kohli-Images-HD-13.jpg', '2020-11-09 10:43:32', 'Friend', 'Virat-Kohli-1.jpg', 'Virhat', 'Kholi', 14),
(34, 'shuvobhowmik_cse11uits@yahoo.com', 'This is my first post', '', '2020-11-18 03:09:12', 'Friend', 'a.jpg', 'shuvo', 'Bhowmik', 11),
(35, 'soibakhter@yahoo.com', 'Hello guys...This is my first post', 'OIP.jpg', '2020-11-20 02:23:06', 'Friend', 'OIP.jpg', 'Soib', 'Akhter', 15),
(36, 'shuvobhowmik_cse11uits@yahoo.com', 'Today is Sunday...Hello..', '', '2020-11-29 03:11:40', 'Friend', '126570428_3480950008655462_8205808223811224599_o.jpg', 'shuvo', 'Bhowmik', 11),
(38, 'rickeyponting@yahoo.com', 'Hello Everybody...Nice to meet you.', 'ricky-ponting (1).jpg', '2020-12-02 03:32:32', 'Friend', 'Ricky-Ponting.jpg', 'Ricky', 'Ponting', 19);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demo`
--
ALTER TABLE `demo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likedata`
--
ALTER TABLE `likedata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlist`
--
ALTER TABLE `userlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userpost`
--
ALTER TABLE `userpost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `demo`
--
ALTER TABLE `demo`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likedata`
--
ALTER TABLE `likedata`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `ID` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1131070014;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userlist`
--
ALTER TABLE `userlist`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `userpost`
--
ALTER TABLE `userpost`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
