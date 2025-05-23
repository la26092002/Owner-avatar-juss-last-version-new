-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: May 23, 2025 at 03:08 AM
-- Server version: 5.7.44
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_color`
--

CREATE TABLE `tbl_color` (
  `color_id` int(11) NOT NULL,
  `color_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_color`
--

INSERT INTO `tbl_color` (`color_id`, `color_name`) VALUES
(31, 'Noir'),
(32, 'Rouge'),
(33, 'Orange'),
(34, 'Bleu');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country`
--

CREATE TABLE `tbl_country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_country`
--

INSERT INTO `tbl_country` (`country_id`, `country_name`) VALUES
(1, 'Afghanistan'),
(2, 'Albania'),
(3, 'Algeria'),
(4, 'American Samoa'),
(5, 'Andorra'),
(6, 'Angola'),
(7, 'Anguilla'),
(8, 'Antarctica'),
(9, 'Antigua and Barbuda'),
(10, 'Argentina'),
(11, 'Armenia'),
(12, 'Aruba'),
(13, 'Australia'),
(14, 'Austria'),
(15, 'Azerbaijan'),
(16, 'Bahamas'),
(17, 'Bahrain'),
(18, 'Bangladesh'),
(19, 'Barbados'),
(20, 'Belarus'),
(21, 'Belgium'),
(22, 'Belize'),
(23, 'Benin'),
(24, 'Bermuda'),
(25, 'Bhutan'),
(26, 'Bolivia'),
(27, 'Bosnia and Herzegovina'),
(28, 'Botswana'),
(29, 'Bouvet Island'),
(30, 'Brazil'),
(31, 'British Indian Ocean Territory'),
(32, 'Brunei Darussalam'),
(33, 'Bulgaria'),
(34, 'Burkina Faso'),
(35, 'Burundi'),
(36, 'Cambodia'),
(37, 'Cameroon'),
(38, 'Canada'),
(39, 'Cape Verde'),
(40, 'Cayman Islands'),
(41, 'Central African Republic'),
(42, 'Chad'),
(43, 'Chile'),
(44, 'China'),
(45, 'Christmas Island'),
(46, 'Cocos (Keeling) Islands'),
(47, 'Colombia'),
(48, 'Comoros'),
(49, 'Congo'),
(50, 'Cook Islands'),
(51, 'Costa Rica'),
(52, 'Croatia (Hrvatska)'),
(53, 'Cuba'),
(54, 'Cyprus'),
(55, 'Czech Republic'),
(56, 'Denmark'),
(57, 'Djibouti'),
(58, 'Dominica'),
(59, 'Dominican Republic'),
(60, 'East Timor'),
(61, 'Ecuador'),
(62, 'Egypt'),
(63, 'El Salvador'),
(64, 'Equatorial Guinea'),
(65, 'Eritrea'),
(66, 'Estonia'),
(67, 'Ethiopia'),
(68, 'Falkland Islands (Malvinas)'),
(69, 'Faroe Islands'),
(70, 'Fiji'),
(71, 'Finland'),
(72, 'France'),
(73, 'France, Metropolitan'),
(74, 'French Guiana'),
(75, 'French Polynesia'),
(76, 'French Southern Territories'),
(77, 'Gabon'),
(78, 'Gambia'),
(79, 'Georgia'),
(80, 'Germany'),
(81, 'Ghana'),
(82, 'Gibraltar'),
(83, 'Guernsey'),
(84, 'Greece'),
(85, 'Greenland'),
(86, 'Grenada'),
(87, 'Guadeloupe'),
(88, 'Guam'),
(89, 'Guatemala'),
(90, 'Guinea'),
(91, 'Guinea-Bissau'),
(92, 'Guyana'),
(93, 'Haiti'),
(94, 'Heard and Mc Donald Islands'),
(95, 'Honduras'),
(96, 'Hong Kong'),
(97, 'Hungary'),
(98, 'Iceland'),
(99, 'India'),
(100, 'Isle of Man'),
(101, 'Indonesia'),
(102, 'Iran (Islamic Republic of)'),
(103, 'Iraq'),
(104, 'Ireland'),
(105, 'Israel'),
(106, 'Italy'),
(107, 'Ivory Coast'),
(108, 'Jersey'),
(109, 'Jamaica'),
(110, 'Japan'),
(111, 'Jordan'),
(112, 'Kazakhstan'),
(113, 'Kenya'),
(114, 'Kiribati'),
(115, 'Korea, Democratic People\'s Republic of'),
(116, 'Korea, Republic of'),
(117, 'Kosovo'),
(118, 'Kuwait'),
(119, 'Kyrgyzstan'),
(120, 'Lao People\'s Democratic Republic'),
(121, 'Latvia'),
(122, 'Lebanon'),
(123, 'Lesotho'),
(124, 'Liberia'),
(125, 'Libyan Arab Jamahiriya'),
(126, 'Liechtenstein'),
(127, 'Lithuania'),
(128, 'Luxembourg'),
(129, 'Macau'),
(130, 'Macedonia'),
(131, 'Madagascar'),
(132, 'Malawi'),
(133, 'Malaysia'),
(134, 'Maldives'),
(135, 'Mali'),
(136, 'Malta'),
(137, 'Marshall Islands'),
(138, 'Martinique'),
(139, 'Mauritania'),
(140, 'Mauritius'),
(141, 'Mayotte'),
(142, 'Mexico'),
(143, 'Micronesia, Federated States of'),
(144, 'Moldova, Republic of'),
(145, 'Monaco'),
(146, 'Mongolia'),
(147, 'Montenegro'),
(148, 'Montserrat'),
(149, 'Morocco'),
(150, 'Mozambique'),
(151, 'Myanmar'),
(152, 'Namibia'),
(153, 'Nauru'),
(154, 'Nepal'),
(155, 'Netherlands'),
(156, 'Netherlands Antilles'),
(157, 'New Caledonia'),
(158, 'New Zealand'),
(159, 'Nicaragua'),
(160, 'Niger'),
(161, 'Nigeria'),
(162, 'Niue'),
(163, 'Norfolk Island'),
(164, 'Northern Mariana Islands'),
(165, 'Norway'),
(166, 'Oman'),
(167, 'Pakistan'),
(168, 'Palau'),
(169, 'Palestine'),
(170, 'Panama'),
(171, 'Papua New Guinea'),
(172, 'Paraguay'),
(173, 'Peru'),
(174, 'Philippines'),
(175, 'Pitcairn'),
(176, 'Poland'),
(177, 'Portugal'),
(178, 'Puerto Rico'),
(179, 'Qatar'),
(180, 'Reunion'),
(181, 'Romania'),
(182, 'Russian Federation'),
(183, 'Rwanda'),
(184, 'Saint Kitts and Nevis'),
(185, 'Saint Lucia'),
(186, 'Saint Vincent and the Grenadines'),
(187, 'Samoa'),
(188, 'San Marino'),
(189, 'Sao Tome and Principe'),
(190, 'Saudi Arabia'),
(191, 'Senegal'),
(192, 'Serbia'),
(193, 'Seychelles'),
(194, 'Sierra Leone'),
(195, 'Singapore'),
(196, 'Slovakia'),
(197, 'Slovenia'),
(198, 'Solomon Islands'),
(199, 'Somalia'),
(200, 'South Africa'),
(201, 'South Georgia South Sandwich Islands'),
(202, 'Spain'),
(203, 'Sri Lanka'),
(204, 'St. Helena'),
(205, 'St. Pierre and Miquelon'),
(206, 'Sudan'),
(207, 'Suriname'),
(208, 'Svalbard and Jan Mayen Islands'),
(209, 'Swaziland'),
(210, 'Sweden'),
(211, 'Switzerland'),
(212, 'Syrian Arab Republic'),
(213, 'Taiwan'),
(214, 'Tajikistan'),
(215, 'Tanzania, United Republic of'),
(216, 'Thailand'),
(217, 'Togo'),
(218, 'Tokelau'),
(219, 'Tonga'),
(220, 'Trinidad and Tobago'),
(221, 'Tunisia'),
(222, 'Turkey'),
(223, 'Turkmenistan'),
(224, 'Turks and Caicos Islands'),
(225, 'Tuvalu'),
(226, 'Uganda'),
(227, 'Ukraine'),
(228, 'United Arab Emirates'),
(229, 'United Kingdom'),
(230, 'United States'),
(231, 'United States minor outlying islands'),
(232, 'Uruguay'),
(233, 'Uzbekistan'),
(234, 'Vanuatu'),
(235, 'Vatican City State'),
(236, 'Venezuela'),
(237, 'Vietnam'),
(238, 'Virgin Islands (British)'),
(239, 'Virgin Islands (U.S.)'),
(240, 'Wallis and Futuna Islands'),
(241, 'Western Sahara'),
(242, 'Yemen'),
(243, 'Zaire'),
(244, 'Zambia'),
(245, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `cust_id` int(11) NOT NULL,
  `cust_name` varchar(100) NOT NULL,
  `cust_cname` varchar(100) NOT NULL,
  `cust_email` varchar(100) NOT NULL,
  `cust_phone` varchar(50) NOT NULL,
  `cust_country` int(11) NOT NULL,
  `cust_address` text NOT NULL,
  `cust_city` varchar(100) NOT NULL,
  `cust_state` varchar(100) NOT NULL,
  `cust_zip` varchar(30) NOT NULL,
  `cust_password` varchar(100) NOT NULL,
  `cust_token` varchar(255) NOT NULL,
  `cust_datetime` varchar(100) NOT NULL,
  `cust_timestamp` varchar(100) NOT NULL,
  `cust_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`cust_id`, `cust_name`, `cust_cname`, `cust_email`, `cust_phone`, `cust_country`, `cust_address`, `cust_city`, `cust_state`, `cust_zip`, `cust_password`, `cust_token`, `cust_datetime`, `cust_timestamp`, `cust_status`) VALUES
(1, 'Liam Moore', 'WV Company', 'liam@mail.com', '7458965410', 230, '788 Cottonwood Lane', 'Nashville', 'TN', '37072', '5f4dcc3b5aa765d61d8327deb882cf99', '0081e99a29cacd4b553db15c5c5c047e', '2022-03-17 11:09:34', '1647544174', 1),
(2, 'Chad N. Carney', 'none', 'chad@mail.com', '4785690000', 230, '469 Diamond Street', 'Charlotte', 'NC', '28808', '5f4dcc3b5aa765d61d8327deb882cf99', 'ca87666426f4bc5c5128a96dabfecefb', '2022-03-17 11:15:26', '1647544526', 1),
(3, 'Jean Collins', 'none', 'jean@mail.com', '1478523698', 230, '1508 Crosswind Drive', 'Owensboro', 'KY', '13040', '5f4dcc3b5aa765d61d8327deb882cf99', '6b3439bf95644a36a1ed92bef374ebb7', '2022-03-20 10:29:39', '1647797379', 1),
(4, 'Annie Young', 'XYZ Company', 'annie@mail.com', '7770001144', 230, '79 Burwell Heights Road', 'Beaumont', 'TX', '77400', '5f4dcc3b5aa765d61d8327deb882cf99', 'fc8f07537cdd6b3f89eb94f1cad78060', '2022-03-20 10:31:35', '1647797495', 1),
(5, 'Matthew Morales', 'ABC Company', 'matthew@mail.com', '7896587450', 230, '81 Felosa Drive', 'Mira Loma', 'CA', '91002', '5f4dcc3b5aa765d61d8327deb882cf99', 'c391105908fe01a636bfa5fc39eed33d', '2022-03-20 10:33:15', '1647797595', 1),
(6, 'August F. Freels', 'none', 'august@mail.com', '1478547850', 230, '96 Johnny Lane', 'Milwaukee', 'WI', '55550', '5f4dcc3b5aa765d61d8327deb882cf99', 'decc1fc2c5dd9935df82c0233002ce66', '2022-03-20 10:34:08', '1647797648', 1),
(7, 'Carl M. Dineen', 'none', 'carl@mail.com', '789878987', 230, '77 Lyndon Street', 'Kutztown', 'PA', '19855', '5f4dcc3b5aa765d61d8327deb882cf99', 'c79bac688e70cc9665a2164c57ec172c', '2022-03-20 10:35:02', '1647797702', 1),
(8, 'Benjamin B. Louque', 'none', 'benjamin@mail.com', '7777889955', 230, '32 Bridge Street', 'Tulsa', 'OK', '74220', '5f4dcc3b5aa765d61d8327deb882cf99', '5a0e096368f9669508af7b7203382b07', '2022-03-20 10:36:31', '1647797791', 1),
(9, 'Joe K. Richardson', 'none', 'joe@mail.com', '4444445555', 230, '17 Derek Drive', 'Youngstown', 'OH', '44500', '5f4dcc3b5aa765d61d8327deb882cf99', 'e74ac0178d7833988d4b1625c42ba26e', '2022-03-20 10:37:18', '1647797838', 1),
(10, 'Will Williams', 'Test Company', 'williams@mail.com', '7410000000', 230, '39 Marcus Street', 'Anniston', 'AL', '37207', '5f4dcc3b5aa765d61d8327deb882cf99', '941c9265fb920f691cf01b12a15f80f8', '2022-03-20 11:15:59', '1647800159', 1),
(12, 'chelali', 'mascara', 'youneschelali2000@gmail.com', '0556502055', 3, 'mascara', 'mascara', 'gg', '29000', 'b59c67bf196a4758191e42f76670ceba', 'f4d88c1cfe5872bf17249ef7849c9443', '2024-07-19 08:28:11', '1746370403', 1),
(13, 'Boufera Mostafa', '', 'Bouferamos@gmail.com', '0675211822', 3, '102 ghriss', 'mascara', 'ghriss', '29500', 'e10adc3949ba59abbe56e057f20f883e', '12853ae873a61ff9a3ab8752b3b226ce', '2024-08-02 09:47:10', '1722617230', 1),
(18, 'mohamed toua', '', 'adawatcom29@gmail.com', '0556502114', 0, 'la guare', '', '', '', '84c381b4c592df98364ea4362e9323b8', '', '2024-08-30 11:13:17', '', 1),
(19, 'younes chelali', '', 'youneschell2000@gmail.com', '0556502057', 0, 'mascara 600\r\n\r\n', '', '', '', '4297f44b13955235245b2497399d7a93', '', '2025-05-04 12:18:30', '', 1),
(20, 'Elhadj Larbi Benyakhou', '', 'larbibenyakhou.info@gmail.com', '78877887', 0, 'sidi said, MASCARA', '', '', '', 'ba97dc2f7eb2f4014a250fee92718a73', '8cea565bc6e6b98aabb0ed979be8e85e', '2025-05-11 03:52:36', '1746931956', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_message`
--

CREATE TABLE `tbl_customer_message` (
  `customer_message_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `order_detail` text NOT NULL,
  `cust_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer_message`
--

INSERT INTO `tbl_customer_message` (`customer_message_id`, `subject`, `message`, `order_detail`, `cust_id`) VALUES
(0, 'hh', 'hhhhhh', '\nCustomer Name: test<br>\nCustomer Email: test@gmail.com<br>\nPayment Method: Bank Deposit<br>\nPayment Date: 2024-08-04 11:32:20<br>\nPayment Details: <br>\nTransaction Details: <br>Bank Deposit Transaction Info<br>\nPaid Amount: 379<br>\nPayment Status: Completed<br>\nShipping Status: Completed<br>\nPayment Id: 1722796340<br>\n            \n<br><b><u>Product Item 1</u></b><br>\nProduct Name: Bose QuietComfort 45 Bluetooth Wireless Headphones<br>\nSize: One Size for All<br>\nColor: Black<br>\nQuantity: 1<br>\nUnit Price: 279<br>\n            ', 16),
(0, 'hh', 'hhhhhh', '\nCustomer Name: test<br>\nCustomer Email: test@gmail.com<br>\nPayment Method: Bank Deposit<br>\nPayment Date: 2024-08-04 11:32:20<br>\nPayment Details: <br>\nTransaction Details: <br>Bank Deposit Transaction Info<br>\nPaid Amount: 379<br>\nPayment Status: Completed<br>\nShipping Status: Completed<br>\nPayment Id: 1722796340<br>\n            \n<br><b><u>Product Item 1</u></b><br>\nProduct Name: Bose QuietComfort 45 Bluetooth Wireless Headphones<br>\nSize: One Size for All<br>\nColor: Black<br>\nQuantity: 1<br>\nUnit Price: 279<br>\n            ', 16),
(0, 'hh', 'hhhhhh', '\nCustomer Name: test<br>\nCustomer Email: bouferamos@gmail.com<br>\nPayment Method: Bank Deposit<br>\nPayment Date: 2024-08-04 11:32:20<br>\nPayment Details: <br>\nTransaction Details: <br>Bank Deposit Transaction Info<br>\nPaid Amount: 379<br>\nPayment Status: Completed<br>\nShipping Status: Completed<br>\nPayment Id: 1722796340<br>\n            \n<br><b><u>Product Item 1</u></b><br>\nProduct Name: Bose QuietComfort 45 Bluetooth Wireless Headphones<br>\nSize: One Size for All<br>\nColor: Black<br>\nQuantity: 1<br>\nUnit Price: 279<br>\n            ', 16),
(0, 'hh', 'hhhhhh', '\nCustomer Name: test<br>\nCustomer Email: bouferamos@gmail.com<br>\nPayment Method: Bank Deposit<br>\nPayment Date: 2024-08-04 11:32:20<br>\nPayment Details: <br>\nTransaction Details: <br>Bank Deposit Transaction Info<br>\nPaid Amount: 379<br>\nPayment Status: Completed<br>\nShipping Status: Completed<br>\nPayment Id: 1722796340<br>\n            \n<br><b><u>Product Item 1</u></b><br>\nProduct Name: Bose QuietComfort 45 Bluetooth Wireless Headphones<br>\nSize: One Size for All<br>\nColor: Black<br>\nQuantity: 1<br>\nUnit Price: 279<br>\n            ', 16),
(0, 'hh', 'hhhhhh', '\nCustomer Name: test<br>\nCustomer Email: bouferamos@gmail.com<br>\nPayment Method: Bank Deposit<br>\nPayment Date: 2024-08-04 11:32:20<br>\nPayment Details: <br>Transaction Details: <br>Bank Deposit Transaction Info<br>\nPaid Amount: 379<br>\nPayment Status: Completed<br>\nShipping Status: Completed<br>\nPayment Id: 1722796340<br>\n<br><b><u>Product Item 1</u></b><br>\nProduct Name: Bose QuietComfort 45 Bluetooth Wireless Headphones<br>\nSize: One Size for All<br>\nColor: Black<br>\nQuantity: 1<br>\nUnit Price: 279<br>', 16);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_end_category`
--

CREATE TABLE `tbl_end_category` (
  `ecat_id` int(11) NOT NULL,
  `ecat_name` varchar(255) NOT NULL,
  `mcat_id` int(11) NOT NULL,
  `tcat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_end_category`
--

INSERT INTO `tbl_end_category` (`ecat_id`, `ecat_name`, `mcat_id`, `tcat_id`) VALUES
(44, '2nd cat 1', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faq`
--

CREATE TABLE `tbl_faq` (
  `faq_id` int(11) NOT NULL,
  `faq_title` varchar(255) NOT NULL,
  `faq_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_faq`
--

INSERT INTO `tbl_faq` (`faq_id`, `faq_title`, `faq_content`) VALUES
(2, 'Qu\'est-ce que les tissus de la marque JUUSS ?', '<p><font color=\"#0a0a0a\">Les tissus sont le fruit de recherches scientifiques poussées, spécifiquement conçus pour filtrer de manière sélective la lumière ultraviolette. Contrairement aux vêtements traditionnels qui bloquent tous les</font></p><p><font color=\"#0a0a0a\">rayons du soleil, les maillot de bain JUUSS permettent à une partie des rayons UV-A de traverser le tissu, assurant ainsi un bronze naturel sans laisser de traces de maillot.</font></p><p><font color=\"#0a0a0a\">Cette innovation révolutionnaire permet un bronzage homogène tout en protégeant la peau des rayons UV-B, responsables des coups de soleil et du vieillissement cutané.</font></p><p><font color=\"#0a0a0a\">Le tissu est breveté et constitue une avancée majeure dans l\'industrie des vêtements solaires.</font></p>\r\n'),
(3, 'Comment fonctionne la filtration UV ?', '<p>Les tissus de la marque JUUSS utilisent une combinaison unique de fibres de polyester et de polyamide, spécialement conçue pour gérer les longueurs d’onde des rayons UV.</p><p>Voici le détail de ce mécanisme :</p><p>Les rayons UV-B (qui provoquent des coups de soleil et sont associés à un risque accru de cancer de la peau) sont bloqués à 92%, garantissant une protection maximale.</p><p>Les rayons UV-A, qui sont essentiels pour le bronzage, passent à travers le tissu de façon contrôlée, jusqu’à 20%. Cela permet d\'obtenir un bronzage progressif tout en préservant la santé de la peau.</p><p>En bref, les maillots de bain JUUSS filtre précisément les rayons solaires, assurant une protection totale contre les effets nocifs des UV-B tout en permettant un bronze doux et uniforme.</p>\r\n'),
(4, 'Sans UV-B, comment peut-on bronzer ?', '<div>Les tissus de la marque JUUSS fonctionnent en régulant l\'exposition de la peau aux rayons UV-A, nécessaires au processus de bronzage.</div><div>Grâce à la conception innovante du tissu, le tricotage fin et les micro-pores dans la structure du matériau permettent aux rayons UV-A d’atteindre la peau de façon mesurée. Voici comment cela se passe :</div><div>Pré-sélection des longueurs d\'onde : Le tissu filtre avec précision les rayons nocifs, tout en laissant passer suffisamment d’UV-A pour déclencher le bronzage.</div><div>Les utilisateurs portant des vêtements de la marque JUUSS peuvent profiter du soleil sans craindre les effets néfastes des UV-B.</div><div>En portant un maillot de bain ou un t-shirt JUUSS, vous ressentirez un confort maximal, sans sensation de chaleur excessive ni de brûlures.</div><div>Après quelques heures d’exposition modérée, les résultats sont visibles : un bronzage doré et uniforme commence à se développer.</div><div>La technologie permet donc d’obtenir un bronzage esthétique et progressif, sans avoir besoin de changer fréquemment de position au soleil pour éviter les traces.</div>'),
(5, 'Pourquoi la marque JUUSS est une protection solaire efficace ?', '<p>Les vêtements de la maqreu JUUSS ne se contentent pas de filtrer les UV, ils offrent également un niveau de protection active tout au long de la journée.</p><p>Contrairement aux crèmes solaires qui nécessitent des réapplications fréquentes, les maillots de bains JUUSS intègrent une barrière permanente contre les UV-B :</p><p>Résistance à l’eau et au frottement : Le tissu reste efficace même après des lavages répétés ou une utilisation dans des environnements agressifs (piscines, eau salée).</p><p>Confort durable : Le porteur n’a pas besoin de réappliquer de la crème ou de s’inquiéter de la diminution de la protection au cours de la journée.</p><p>Les fibres du tissu sont conçues pour être respirantes, évacuant la chaleur et l’humidité, tout en assurant une coupe ajustée qui épouse la silhouette sans gêner les mouvements.</p>'),
(0, 'Comment obtenir un bronzage optimal ?', '<p>Pour tirer le meilleur parti de la technologie et obtenir un bronzage uniforme, il est recommandé de suivre ces étapes :</p><p>Commencez par des expositions courtes : Durant les premiers jours de vacances ou au début de la saison estivale, il est conseillé de s’exposer progressivement.</p><p>Les tissus de la marque JUUSS permettront à votre peau de bronzer en douceur sans excès de chaleur.</p><p>Utilisez les mailots de bain JUUSS pendant les périodes les plus intenses de la journée : Ce tissu est conçu pour protéger efficacement même pendant les heures où le soleil est à son maximum</p><p>(généralement entre 11 h et 16 h). Cependant, pour optimiser la sécurité, il est toujours conseillé d\'éviter les pics d’intensité solaire.</p><p>Patience et résultats durables : Contrairement à une exposition directe, qui peut provoquer des rougeurs ou des brûlures, les tissus de la marque JUUSS favorise un bronzage progressif.</p><p>Après quelques jours, vous obtiendrez une teinte dorée uniforme sans les effets néfastes liés à une exposition prolongée.</p>'),
(0, 'Les maillots JUUSS sont-il efficace contre les coups de soleil ?', '<p>Oui, la marque JUUSS offre une protection renforcée contre les coups de soleil, en bloquant 92% des rayons UV-B.</p><p>Les vêtements de la marque JUUSS sont particulièrement recommandés pour les personnes ayant une peau sensible ou</p><p>pour celles qui souhaitent éviter les risques liés aux expositions solaires prolongées sans protection.</p>'),
(0, 'En conclusion, pourquoi choisir JUUSS ?', '<p>En combinant une technologie de filtration UV avancée avec un confort optimal et une protection durable, les maillots de bain JUUSS représentent la solution idéale pour ceux qui souhaitent profiter des</p><p>bienfaits du soleil tout en évitant les effets indésirables d\'une exposition excessive.</p><p>Nos produits permettent à la peau de bronzer progressivement tout en restant protégée des rayons les plus nocifs.</p><p>Que vous soyez sur la plage ou au bord d\'une piscine, JUUSS est votre allié pour un bronzage sécurisé, sans traces, et esthétique.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_language`
--

CREATE TABLE `tbl_language` (
  `lang_id` int(11) NOT NULL,
  `lang_name` varchar(255) NOT NULL,
  `lang_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_language`
--

INSERT INTO `tbl_language` (`lang_id`, `lang_name`, `lang_value`) VALUES
(1, 'Currency', 'EUR'),
(2, 'Search Product', 'Rechercher un Produit'),
(3, 'Search', 'Rechercher '),
(4, 'Submit', 'Soumettre'),
(5, 'Update', 'Mettre à jour'),
(6, 'Read More', 'En Savoir Plus'),
(7, 'Serial', 'Série'),
(8, 'Photo', 'Photo'),
(9, 'Login', 'Connexion'),
(10, 'Customer Login', 'Connexion Client'),
(11, 'Click here to login', 'Cliquez ici pour vous connecter'),
(12, 'Back to Login Page', 'Retour à la Page de Connexion'),
(13, 'Logged in as', 'Connecté en tant que'),
(14, 'Logout', 'Déconnexion'),
(15, 'Register', 'S\'inscrire'),
(16, 'Customer Registration', 'Inscription du Client'),
(17, 'Registration Successful', 'Inscription Réussie'),
(18, 'Cart', 'Panier'),
(19, 'View Cart', 'Voir le Panier'),
(20, 'Update Cart', 'Mettre à jour le Panier'),
(21, 'Back to Cart', 'Retour au Panier'),
(22, 'Checkout', 'Passer à la Caisse'),
(23, 'Proceed to Checkout', 'Passez à la caisse'),
(24, 'Orders', 'Commandes '),
(25, 'Order History', 'Historique des Commandes'),
(26, 'Order Details', 'Détails de la Commande'),
(27, 'Payment Date and Time', 'Date et Heure de l\'achat'),
(28, 'Transaction ID', 'Numéro de TRANSACTION'),
(29, 'Paid Amount', 'Montant Payé'),
(30, 'Payment Status', 'Statut du l\'achat'),
(31, 'Payment Method', 'Méthode de Paiement'),
(32, 'Payment ID', 'Identifiant de PAIEMENT'),
(33, 'Payment Section', 'Section de Paiement'),
(34, 'Select Payment Method', 'Sélectionnez Le Mode de Paiement'),
(35, 'Select a Method', 'Sélectionnez une Méthode'),
(36, 'PayPal', 'PayPal'),
(37, 'Stripe', 'Stripe'),
(38, 'Bank Deposit', 'Dépôt Bancaire'),
(39, 'Card Number', 'Numéro de Carte'),
(40, 'CVV', 'CVV'),
(41, 'Month', 'Mois'),
(42, 'Year', 'Année'),
(43, 'Send to this Details', 'Envoyer à ces détails'),
(44, 'Transaction Information', 'Informations Sur les Transactions'),
(45, 'Include transaction id and other information correctly', 'Incluez correctement l\'identifiant de transaction et d\'autres informations'),
(46, 'Pay Now', 'Payez Maintenant'),
(47, 'Product Name', 'Nom du Produit'),
(48, 'Product Details', 'Détails du Produit'),
(49, 'Categories', 'Catégories'),
(50, 'Category:', 'Catégorie:'),
(51, 'All Products Under', 'Tous Les Produits Sous'),
(52, 'Select Size', 'Sélectionnez la Taille'),
(53, 'Select Color', 'Sélectionnez la Couleur'),
(54, 'Product Price', 'Prix du Produit'),
(55, 'Quantity', 'Quantité'),
(56, 'Out of Stock', 'Rupture de Stock'),
(57, 'Share This', 'Partagez Ceci'),
(58, 'Share This Product', 'Partager Ce Produit'),
(59, 'Product Description', 'Description du Produit'),
(60, 'Features', 'Caractéristiques'),
(61, 'Conditions', 'Conditions Générales'),
(62, 'Return Policy', 'Politique de Retour'),
(63, 'Reviews', 'Avis'),
(64, 'Review', 'Révision'),
(65, 'Give a Review', 'Donnez votre Avis'),
(66, 'Write your comment (Optional)', 'Ecrivez votre commentaire (Facultatif)'),
(67, 'Submit Review', 'Soumettre un Avis'),
(68, 'You already have given a rating!', 'Vous avez déjà donné une note!'),
(69, 'You must have to login to give a review', 'Vous devez vous connecter pour donner un avis'),
(70, 'No description found', 'Aucune description trouvée'),
(71, 'No feature found', 'Aucune fonctionnalité trouvée'),
(72, 'No condition found', 'Aucune condition trouvée'),
(73, 'No return policy found', 'Aucune politique de retour trouvée'),
(74, 'Review not found', 'Avis non trouvé'),
(75, 'Customer Name', 'Nom du Client'),
(76, 'Comment', 'Commentaire'),
(77, 'Comments', 'Commentaires'),
(78, 'Rating', 'Classement'),
(79, 'Previous', 'Précédent'),
(80, 'Next', 'Suivant'),
(81, 'Sub Total', 'Total Partiel'),
(82, 'Total', 'Total'),
(83, 'Action', 'Actions'),
(84, 'Shipping Cost', 'Frais de Port'),
(85, 'Continue Shopping', 'Continuer vos Achats'),
(86, 'Update Billing Address', 'Mettre à Jour l\'Adresse de Facturation'),
(87, 'Update Shipping Address', 'Mettre à Jour L\'Adresse de Livraison'),
(88, 'Update Billing and Shipping Info', 'Mettre à jour les Informations de Facturation et d\'Expédition'),
(89, 'Dashboard', 'Tableau de Bord'),
(90, 'Welcome to the Dashboard', 'Bienvenue sur le tableau de bord'),
(91, 'Back to Dashboard', 'Retour au Tableau de bord'),
(92, 'Subscribe', 'S\'abonner'),
(93, 'Subscribe To Our Newsletter', 'Abonnez-Vous À Notre Newsletter'),
(94, 'Email Address', 'Adresse E-Mail'),
(95, 'Enter Your Email Address', 'Entrez Votre Adresse E-Mail'),
(96, 'Password', 'Mot de Passe'),
(97, 'Forget Password', 'Oublier le Mot de Passe'),
(98, 'Retype Password', 'Retapez le Mot de Passe'),
(99, 'Update Password', 'Mettre à Jour le Mot de Passe'),
(100, 'New Password', 'Nouveau Mot de Passe'),
(101, 'Retype New Password', 'Retapez Un Nouveau Mot De Passe'),
(102, 'Full Name', 'Nom Complet'),
(103, 'Company Name', 'Nom de l\'Entreprise'),
(104, 'Phone Number', 'Numéro de Téléphone'),
(105, 'Address', 'Address'),
(106, 'Country', 'Pays'),
(107, 'City', 'Ville'),
(108, 'State', 'État'),
(109, 'Zip Code', 'Code Postal'),
(110, 'About Us', 'À Propos De Nous'),
(111, 'Featured Posts', 'NOS COUP DE ?'),
(112, 'Popular Posts', 'Messages Populaires'),
(113, 'Recent Posts', 'Articles Récents'),
(114, 'Contact Information', 'Informations de Contact'),
(115, 'Contact Form', 'Formulaire de Contact'),
(116, 'Our Office', 'Notre Bureau'),
(117, 'Update Profile', 'Mettre à Jour le Profil'),
(118, 'Send Message', 'Envoyer Un Message'),
(119, 'Message', 'Message'),
(120, 'Find Us On Map', 'Trouvez-Nous Sur La Carte'),
(121, 'Congratulation! Payment is successful.', 'Bravo! L\'achat est réussi.'),
(122, 'Billing and Shipping Information is updated successfully.', 'Les informations de facturation et d\'expédition sont mises à jour avec succès.'),
(123, 'Customer Name can not be empty.', 'Le nom du client ne peut pas être vide.'),
(124, 'Phone Number can not be empty.', 'Phone Number can not be empty.'),
(125, 'Address can not be empty.', 'L\'adresse ne peut pas être vide'),
(126, 'You must have to select a country.', 'Vous devez sélectionner un pays.'),
(127, 'City can not be empty.', 'La ville ne peut pas être vide.'),
(128, 'State can not be empty.', 'L\'État ne peut pas être vide.'),
(129, 'Zip Code can not be empty.', 'Le code postal ne peut pas être vide.'),
(130, 'Profile Information is updated successfully.', 'Les informations du profil ont été mises à jour avec succès.'),
(131, 'Email Address can not be empty', 'L\'adresse e-mail ne peut pas être vide.'),
(132, 'Email and/or Password can not be empty.', 'L\'e-mail et/ou le mot de passe ne peuvent pas être vides.'),
(133, 'Email Address does not match.', 'L\'adresse e-mail ne correspond pas.'),
(134, 'Email address must be valid.', 'L\'adresse e-mail doit être valide.'),
(135, 'You email address is not found in our system.', 'Votre adresse e-mail n\'est pas trouvée dans notre système.'),
(136, 'Please check your email and confirm your subscription.', 'Veuillez vérifier votre e-mail et confirmer votre abonnement.'),
(137, 'Your email is verified successfully. You can now login to our website.', 'Votre e-mail a été vérifié avec succès. Vous pouvez maintenant vous connecter à notre site web.'),
(138, 'Password can not be empty.', 'Le mot de passe ne peut pas être vide.'),
(139, 'Passwords do not match.', 'Les mots de passe ne correspondent pas.'),
(140, 'Please enter new and retype passwords.', 'Veuillez entrer et retaper les nouveaux mots de passe.'),
(141, 'Password is updated successfully.', 'Le mot de passe a été mis à jour avec succès.\r\n'),
(142, 'To reset your password, please click on the link below.', 'Pour réinitialiser votre mot de passe, veuillez cliquer sur le lien ci-dessous.'),
(143, 'PASSWORD RESET REQUEST - YOUR WEBSITE.COM', 'DEMANDE DE RÉINITIALISATION DU MOT DE PASSE - juusstanthrough.com\r\n\r\n\r\n'),
(144, 'The password reset email time (24 hours) has expired. Please again try to reset your password.', 'Le délai pour réinitialiser le mot de passe (24 heures) a expiré. Veuillez essayer de réinitialiser votre mot de passe à nouveau.'),
(145, 'A confirmation link is sent to your email address. You will get the password reset information in there.', 'Un lien de confirmation a été envoyé à votre adresse e-mail. Vous recevrez les informations pour réinitialiser votre mot de passe à cet endroit.'),
(146, 'Password is reset successfully. You can now login.', 'Le mot de passe a été réinitialisé avec succès. Vous pouvez maintenant vous connecter.'),
(147, 'Email Address Already Exists', 'L\'adresse e-mail existe déjà.'),
(148, 'Sorry! Your account is inactive. Please contact to the administrator.', 'Désolé ! Votre compte est inactif. Veuillez contacter l\'administrateur.'),
(149, 'Change Password', 'Changer le Mot de Passe'),
(150, 'Registration Email Confirmation for YOUR WEBSITE', 'Confirmation d\'inscription par e-mail pour VOTRE SITE.'),
(151, 'Thank you for your registration! Your account has been created. To active your account click on the link below:', 'Merci pour votre inscription ! Votre compte a été créé. Pour activer votre compte, cliquez sur le lien ci-dessous :'),
(152, 'Your registration is completed. Please check your email address to follow the process to confirm your registration.', 'Votre inscription est terminée. Veuillez vérifier votre adresse e-mail pour suivre le processus de confirmation de votre inscription.'),
(153, 'No Product Found', 'Aucun Produit Trouvé'),
(154, 'Add to Cart', 'Ajouter au panier'),
(155, 'Related Products', 'Produits Connexes'),
(156, 'See all related products from below', 'Voir tous les produits connexes ci-dessous'),
(157, 'Size', 'Taille'),
(158, 'Color', 'Couleur'),
(159, 'Price', 'Prix'),
(160, 'Please login as customer to checkout', 'Veuillez vous connecter en tant que client pour passer à la caisse'),
(161, 'Billing Address', 'Adresse de Facturation'),
(162, 'Shipping Address', 'Adresse de Livraison'),
(163, 'Rating is Submitted Successfully!', 'La notation a été soumise avec succès!');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mid_category`
--

CREATE TABLE `tbl_mid_category` (
  `mcat_id` int(11) NOT NULL,
  `mcat_name` varchar(255) NOT NULL,
  `tcat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_mid_category`
--

INSERT INTO `tbl_mid_category` (`mcat_id`, `mcat_name`, `tcat_id`) VALUES
(6, 'cat 4', 1),
(7, 'cat 3', 1),
(8, 'cat 2', 1),
(23, 'cat 1', 11);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `size` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `unit_price` varchar(50) NOT NULL,
  `payment_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_page`
--

CREATE TABLE `tbl_page` (
  `id` int(11) NOT NULL,
  `about_title` varchar(255) NOT NULL,
  `about_content` text NOT NULL,
  `about_banner` varchar(255) NOT NULL,
  `about_meta_title` varchar(255) NOT NULL,
  `about_meta_keyword` text NOT NULL,
  `about_meta_description` text NOT NULL,
  `faq_title` varchar(255) NOT NULL,
  `faq_banner` varchar(255) NOT NULL,
  `faq_meta_title` varchar(255) NOT NULL,
  `faq_meta_keyword` text NOT NULL,
  `faq_meta_description` text NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_banner` varchar(255) NOT NULL,
  `blog_meta_title` varchar(255) NOT NULL,
  `blog_meta_keyword` text NOT NULL,
  `blog_meta_description` text NOT NULL,
  `contact_title` varchar(255) NOT NULL,
  `contact_banner` varchar(255) NOT NULL,
  `contact_meta_title` varchar(255) NOT NULL,
  `contact_meta_keyword` text NOT NULL,
  `contact_meta_description` text NOT NULL,
  `pgallery_title` varchar(255) NOT NULL,
  `pgallery_banner` varchar(255) NOT NULL,
  `pgallery_meta_title` varchar(255) NOT NULL,
  `pgallery_meta_keyword` text NOT NULL,
  `pgallery_meta_description` text NOT NULL,
  `vgallery_title` varchar(255) NOT NULL,
  `vgallery_banner` varchar(255) NOT NULL,
  `vgallery_meta_title` varchar(255) NOT NULL,
  `vgallery_meta_keyword` text NOT NULL,
  `vgallery_meta_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_page`
--

INSERT INTO `tbl_page` (`id`, `about_title`, `about_content`, `about_banner`, `about_meta_title`, `about_meta_keyword`, `about_meta_description`, `faq_title`, `faq_banner`, `faq_meta_title`, `faq_meta_keyword`, `faq_meta_description`, `blog_title`, `blog_banner`, `blog_meta_title`, `blog_meta_keyword`, `blog_meta_description`, `contact_title`, `contact_banner`, `contact_meta_title`, `contact_meta_keyword`, `contact_meta_description`, `pgallery_title`, `pgallery_banner`, `pgallery_meta_title`, `pgallery_meta_keyword`, `pgallery_meta_description`, `vgallery_title`, `vgallery_banner`, `vgallery_meta_title`, `vgallery_meta_keyword`, `vgallery_meta_description`) VALUES
(1, 'À Propos De Nous', '<h1 style=\"text-align: center; border: 0px solid; margin-top: 1.5rem; margin-bottom: 0px;\">Notre Histoire</h1><h4 style=\"text-align: center; border: 0px solid; margin-top: 1.5rem; margin-bottom: 0px;\">L’avancée du bronzage avec JUUSS</h4><p style=\"text-align: center; border: 0px solid; margin-top: 1.5rem; margin-bottom: 0px;\">Après plus de 30 ans d’informations aux dangers des rayons UV et les effets nocifs du bronzage,</p><p style=\"text-align: center; border: 0px solid; margin-top: 1.5rem; margin-bottom: 0px;\">une vision audacieuse est née: libérer les passionnés de soleil des contraintes liées</p><p style=\"text-align: center; border: 0px solid; margin-top: 1.5rem; margin-bottom: 0px;\">aux crèmes solaires, aux marques de maillots et aux expositions risquées, c’est ainsi qu’est née JUUSS,</p><p style=\"text-align: center; border: 0px solid; margin-top: 1.5rem; margin-bottom: 0px;\">une marque de vêtements révolutionnaires intégrant la technologie d’aujourd’hui et l\'innovation au service du bien-être.</p><p style=\"text-align: center; border: 0px solid; margin-top: 1.5rem; margin-bottom: 0px;\">JUUSS propose une nouvelle manière de profiter du soleil en toute sécurité.</p><p style=\"text-align: center; border: 0px solid; margin-top: 1.5rem; margin-bottom: 0px;\">Contrairement aux vêtements classiques, les tissus de la marque JUUSS sont conçus pour laisser passer</p><p style=\"text-align: center; border: 0px solid; margin-top: 1.5rem; margin-bottom: 0px;\">une dose précise de rayons UV-A, essentiels pour un bronzage naturel et uniforme, tout en bloquant jusqu\'à 92% des rayons UV-B,</p><p style=\"text-align: center; border: 0px solid; margin-top: 1.5rem; margin-bottom: 0px;\">responsables des coups de soleil et des risques cutanés.</p><h4 style=\"text-align: center; border: 0px solid; margin-top: 1.5rem; margin-bottom: 0px;\">Un lifestyle réinventé</h4><p style=\"text-align: center; border: 0px solid; margin-top: 1.5rem; margin-bottom: 0px;\">La marque JUUSS a débuté avec une gamme élégante de maillots de bain pour femmes.</p><p style=\"text-align: center; border: 0px solid; margin-top: 1.5rem; margin-bottom: 0px;\">Aujourd\'hui, JUUSS s\'impose comme une référence pour les amateurs de plein air, que ce soit pour une journée à la plage ou une séance de yoga en plein soleil.</p><h4 style=\"text-align: center; border: 0px solid; margin-top: 1.5rem; margin-bottom: 0px;\">Pourquoi choisir JUUSS ?</h4><p style=\"text-align: center; border: 0px solid; margin-top: 1.5rem; margin-bottom: 0px;\">1. Protection avancée : Grâce à la technologie, JUUSS offre un confort optimal et une barrière efficace contre les rayons UV-B.</p><p style=\"text-align: center; border: 0px solid; margin-top: 1.5rem; margin-bottom: 0px;\">2. Style et sécurité : Les collections combinent design élégant et innovation scientifique, permettant aux utilisateurs de bronzer sans traces ni surchauffe.</p><p style=\"text-align: center; border: 0px solid; margin-top: 1.5rem; margin-bottom: 0px;\">3. Durabilité : Résistants à l\'eau et aux lavages répétés, les vêtements JUUSS garantissent une protection continue, sans perte d\'efficacité.</p><h4 style=\"text-align: center; border: 0px solid; margin-top: 1.5rem; margin-bottom: 0px;\">L\'expérience client</h4><p style=\"text-align: center; border: 0px solid; margin-top: 1.5rem; margin-bottom: 0px;\">JUUSS, c\'est plus qu\'une marque. C\'est un engagement à transformer votre expérience du bronzage.</p><p style=\"text-align: center; border: 0px solid; margin-top: 1.5rem; margin-bottom: 0px;\">En adoptant JUUSS, vous choisissez une solution esthétique, fonctionnelle et respectueuse de votre peau.</p><h4 style=\"text-align: center; border: 0px solid; margin-top: 1.5rem; margin-bottom: 0px;\">Conclusion</h4><p style=\"text-align: center; border: 0px solid; margin-top: 1.5rem; margin-bottom: 0px;\">JUUSS redéfinit la manière de profiter du soleil : fini les contraintes, place au plaisir.</p><p style=\"text-align: center; border: 0px solid; margin-top: 1.5rem; margin-bottom: 0px;\">Laissez-vous séduire par des vêtements qui travaillent pour vous, tout en protégeant votre santé et en sublimant votre bronzage.</p>\r\n', 'about-banner.jpeg', 'JUUSS - À Propos De Nous', 'à propos, à propos de nous, à propos JUUSS , à propos du commerce électronique Projet JUUSS', '', 'FAQ', 'faq-banner.jpeg', 'JUUSS - FAQ', '', '', 'Blog', 'blog-banner.jpg', 'Ecommerce - Blog', '', '', 'Contactez-Nous', 'contact-banner.jpeg', 'JUUSS - Contact', '', '', 'Photo Gallery', 'pgallery-banner.jpg', 'Ecommerce - Photo Gallery', '', '', 'Video Gallery', 'vgallery-banner.jpg', 'Ecommerce - Video Gallery', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `payment_date` varchar(50) NOT NULL,
  `txnid` varchar(255) NOT NULL,
  `paid_amount` int(11) NOT NULL,
  `bank_transaction_info` text NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `payment_status` varchar(25) NOT NULL,
  `shipping_status` varchar(20) NOT NULL,
  `payment_id` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_photo`
--

CREATE TABLE `tbl_photo` (
  `id` int(11) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_photo`
--

INSERT INTO `tbl_photo` (`id`, `caption`, `photo`) VALUES
(2, 'Photo 2', 'photo-2.png'),
(3, 'Photo 3', 'photo-3.png'),
(4, 'Photo 4', 'photo-4.png'),
(5, 'Photo 5', 'photo-5.jpg'),
(6, 'Photo 6', 'photo-6.png'),
(7, 'tim', 'photo-7.png'),
(8, 'moh', 'photo-8.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post`
--

CREATE TABLE `tbl_post` (
  `post_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_slug` varchar(255) NOT NULL,
  `post_content` text NOT NULL,
  `post_date` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `total_view` int(11) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_post`
--

INSERT INTO `tbl_post` (`post_id`, `post_title`, `post_slug`, `post_content`, `post_date`, `photo`, `category_id`, `total_view`, `meta_title`, `meta_keyword`, `meta_description`) VALUES
(1, 'Cu vel choro exerci pri et oratio iisque', 'cu-vel-choro-exerci-pri-et-oratio-iisque', '<p>Lorem ipsum dolor sit amet, qui case probo velit no, an postea scaevola partiendo mei. Id mea fuisset perpetua referrentur. Ut everti ceteros mei, alii discere eum no, duo id malis iuvaret. Ad sint everti accusam vel, ea viderer suscipiantur pri. Brute option minimum in cum, ignota iuvaret an pro.</p>\r\n\r\n<p>Solum atqui intellegebat mea an. Ne ius alterum aliquam. Ea nec populo aliquid mentitum, vis in meliore atomorum, sanctus consequat vituperatoribus duo ea. Ad doctus pertinacia ius, virtute fuisset id has, eum ut modo principes. Qui eu labore adversarium, oporteat delicata qui ut, an qui meliore principes. Id aliquid dolorum nam.</p>\r\n\r\n<p>Reque pericula philosophia ut mei, volumus eligendi mandamus has an. In nobis consulatu pri, has at timeam scaevola, has simul quaeque et. Te nec sale accumsan. Dolorem prodesset efficiendi sea ea.</p>\r\n\r\n<p>Et habeo modus debitis pri, vel quis fierent albucius ne. Ea animal meliore usu, nec etiam dolorum atomorum at, nam in audire mandamus omittantur. Cu ius dicam officiis molestiae, mea volumus officiis cotidieque no. Ut vel possim interpretaris, idque probatus antiopam has ad. Facilisi qualisque te sea, no dolorum mnesarchum usu.</p>\r\n\r\n<p>Eum tota graeci impetus an, eirmod invenire rationibus ne mel. Ignota habemus eum ex, vis omnesque delicata perpetua an. Sit id modo invidunt sapientem, ne eum vocibus dolores phaedrum. Case praesent appellantur eu per.</p>\r\n', '05-09-2017', 'news-1.jpg', 3, 14, 'Cu vel choro exerci pri et oratio iisque', '', ''),
(2, 'Epicurei necessitatibus eu facilisi postulant ', 'epicurei-necessitatibus-eu-facilisi-postulant-', '<p>Lorem ipsum dolor sit amet, qui case probo velit no, an postea scaevola partiendo mei. Id mea fuisset perpetua referrentur. Ut everti ceteros mei, alii discere eum no, duo id malis iuvaret. Ad sint everti accusam vel, ea viderer suscipiantur pri. Brute option minimum in cum, ignota iuvaret an pro.</p>\r\n\r\n<p>Solum atqui intellegebat mea an. Ne ius alterum aliquam. Ea nec populo aliquid mentitum, vis in meliore atomorum, sanctus consequat vituperatoribus duo ea. Ad doctus pertinacia ius, virtute fuisset id has, eum ut modo principes. Qui eu labore adversarium, oporteat delicata qui ut, an qui meliore principes. Id aliquid dolorum nam.</p>\r\n\r\n<p>Reque pericula philosophia ut mei, volumus eligendi mandamus has an. In nobis consulatu pri, has at timeam scaevola, has simul quaeque et. Te nec sale accumsan. Dolorem prodesset efficiendi sea ea.</p>\r\n\r\n<p>Et habeo modus debitis pri, vel quis fierent albucius ne. Ea animal meliore usu, nec etiam dolorum atomorum at, nam in audire mandamus omittantur. Cu ius dicam officiis molestiae, mea volumus officiis cotidieque no. Ut vel possim interpretaris, idque probatus antiopam has ad. Facilisi qualisque te sea, no dolorum mnesarchum usu.</p>\r\n\r\n<p>Eum tota graeci impetus an, eirmod invenire rationibus ne mel. Ignota habemus eum ex, vis omnesque delicata perpetua an. Sit id modo invidunt sapientem, ne eum vocibus dolores phaedrum. Case praesent appellantur eu per.</p>\r\n', '05-09-2017', 'news-2.jpg', 3, 6, 'Epicurei necessitatibus eu facilisi postulant ', '', ''),
(3, 'Mei ut errem legimus periculis eos liber', 'mei-ut-errem-legimus-periculis-eos-liber', '<p>Lorem ipsum dolor sit amet, qui case probo velit no, an postea scaevola partiendo mei. Id mea fuisset perpetua referrentur. Ut everti ceteros mei, alii discere eum no, duo id malis iuvaret. Ad sint everti accusam vel, ea viderer suscipiantur pri. Brute option minimum in cum, ignota iuvaret an pro.</p>\r\n\r\n<p>Solum atqui intellegebat mea an. Ne ius alterum aliquam. Ea nec populo aliquid mentitum, vis in meliore atomorum, sanctus consequat vituperatoribus duo ea. Ad doctus pertinacia ius, virtute fuisset id has, eum ut modo principes. Qui eu labore adversarium, oporteat delicata qui ut, an qui meliore principes. Id aliquid dolorum nam.</p>\r\n\r\n<p>Reque pericula philosophia ut mei, volumus eligendi mandamus has an. In nobis consulatu pri, has at timeam scaevola, has simul quaeque et. Te nec sale accumsan. Dolorem prodesset efficiendi sea ea.</p>\r\n\r\n<p>Et habeo modus debitis pri, vel quis fierent albucius ne. Ea animal meliore usu, nec etiam dolorum atomorum at, nam in audire mandamus omittantur. Cu ius dicam officiis molestiae, mea volumus officiis cotidieque no. Ut vel possim interpretaris, idque probatus antiopam has ad. Facilisi qualisque te sea, no dolorum mnesarchum usu.</p>\r\n\r\n<p>Eum tota graeci impetus an, eirmod invenire rationibus ne mel. Ignota habemus eum ex, vis omnesque delicata perpetua an. Sit id modo invidunt sapientem, ne eum vocibus dolores phaedrum. Case praesent appellantur eu per.</p>\r\n', '05-09-2017', 'news-3.jpg', 3, 1, 'Mei ut errem legimus periculis eos liber', '', ''),
(4, 'Id pro unum pertinax oportere vel', 'id-pro-unum-pertinax-oportere-vel', '<p>Lorem ipsum dolor sit amet, qui case probo velit no, an postea scaevola partiendo mei. Id mea fuisset perpetua referrentur. Ut everti ceteros mei, alii discere eum no, duo id malis iuvaret. Ad sint everti accusam vel, ea viderer suscipiantur pri. Brute option minimum in cum, ignota iuvaret an pro.</p>\r\n\r\n<p>Solum atqui intellegebat mea an. Ne ius alterum aliquam. Ea nec populo aliquid mentitum, vis in meliore atomorum, sanctus consequat vituperatoribus duo ea. Ad doctus pertinacia ius, virtute fuisset id has, eum ut modo principes. Qui eu labore adversarium, oporteat delicata qui ut, an qui meliore principes. Id aliquid dolorum nam.</p>\r\n\r\n<p>Reque pericula philosophia ut mei, volumus eligendi mandamus has an. In nobis consulatu pri, has at timeam scaevola, has simul quaeque et. Te nec sale accumsan. Dolorem prodesset efficiendi sea ea.</p>\r\n\r\n<p>Et habeo modus debitis pri, vel quis fierent albucius ne. Ea animal meliore usu, nec etiam dolorum atomorum at, nam in audire mandamus omittantur. Cu ius dicam officiis molestiae, mea volumus officiis cotidieque no. Ut vel possim interpretaris, idque probatus antiopam has ad. Facilisi qualisque te sea, no dolorum mnesarchum usu.</p>\r\n\r\n<p>Eum tota graeci impetus an, eirmod invenire rationibus ne mel. Ignota habemus eum ex, vis omnesque delicata perpetua an. Sit id modo invidunt sapientem, ne eum vocibus dolores phaedrum. Case praesent appellantur eu per.</p>\r\n', '05-09-2017', 'news-4.jpg', 4, 0, 'Id pro unum pertinax oportere vel', '', ''),
(5, 'Tollit cetero cu usu etiam evertitur', 'tollit-cetero-cu-usu-etiam-evertitur', '<p>Lorem ipsum dolor sit amet, qui case probo velit no, an postea scaevola partiendo mei. Id mea fuisset perpetua referrentur. Ut everti ceteros mei, alii discere eum no, duo id malis iuvaret. Ad sint everti accusam vel, ea viderer suscipiantur pri. Brute option minimum in cum, ignota iuvaret an pro.</p>\r\n\r\n<p>Solum atqui intellegebat mea an. Ne ius alterum aliquam. Ea nec populo aliquid mentitum, vis in meliore atomorum, sanctus consequat vituperatoribus duo ea. Ad doctus pertinacia ius, virtute fuisset id has, eum ut modo principes. Qui eu labore adversarium, oporteat delicata qui ut, an qui meliore principes. Id aliquid dolorum nam.</p>\r\n\r\n<p>Reque pericula philosophia ut mei, volumus eligendi mandamus has an. In nobis consulatu pri, has at timeam scaevola, has simul quaeque et. Te nec sale accumsan. Dolorem prodesset efficiendi sea ea.</p>\r\n\r\n<p>Et habeo modus debitis pri, vel quis fierent albucius ne. Ea animal meliore usu, nec etiam dolorum atomorum at, nam in audire mandamus omittantur. Cu ius dicam officiis molestiae, mea volumus officiis cotidieque no. Ut vel possim interpretaris, idque probatus antiopam has ad. Facilisi qualisque te sea, no dolorum mnesarchum usu.</p>\r\n\r\n<p>Eum tota graeci impetus an, eirmod invenire rationibus ne mel. Ignota habemus eum ex, vis omnesque delicata perpetua an. Sit id modo invidunt sapientem, ne eum vocibus dolores phaedrum. Case praesent appellantur eu per.</p>\r\n', '05-09-2017', 'news-5.jpg', 4, 24, 'Tollit cetero cu usu etiam evertitur', '', ''),
(6, 'Omnes ornatus qui et te aeterno', 'omnes-ornatus-qui-et-te-aeterno', '<p>Lorem ipsum dolor sit amet, qui case probo velit no, an postea scaevola partiendo mei. Id mea fuisset perpetua referrentur. Ut everti ceteros mei, alii discere eum no, duo id malis iuvaret. Ad sint everti accusam vel, ea viderer suscipiantur pri. Brute option minimum in cum, ignota iuvaret an pro.</p>\r\n\r\n<p>Solum atqui intellegebat mea an. Ne ius alterum aliquam. Ea nec populo aliquid mentitum, vis in meliore atomorum, sanctus consequat vituperatoribus duo ea. Ad doctus pertinacia ius, virtute fuisset id has, eum ut modo principes. Qui eu labore adversarium, oporteat delicata qui ut, an qui meliore principes. Id aliquid dolorum nam.</p>\r\n\r\n<p>Reque pericula philosophia ut mei, volumus eligendi mandamus has an. In nobis consulatu pri, has at timeam scaevola, has simul quaeque et. Te nec sale accumsan. Dolorem prodesset efficiendi sea ea.</p>\r\n\r\n<p>Et habeo modus debitis pri, vel quis fierent albucius ne. Ea animal meliore usu, nec etiam dolorum atomorum at, nam in audire mandamus omittantur. Cu ius dicam officiis molestiae, mea volumus officiis cotidieque no. Ut vel possim interpretaris, idque probatus antiopam has ad. Facilisi qualisque te sea, no dolorum mnesarchum usu.</p>\r\n\r\n<p>Eum tota graeci impetus an, eirmod invenire rationibus ne mel. Ignota habemus eum ex, vis omnesque delicata perpetua an. Sit id modo invidunt sapientem, ne eum vocibus dolores phaedrum. Case praesent appellantur eu per.</p>\r\n', '05-09-2017', 'news-6.jpg', 4, 2, 'Omnes ornatus qui et te aeterno', '', ''),
(7, 'Vix tale noluisse voluptua ad ne', 'vix-tale-noluisse-voluptua-ad-ne', '<p>Lorem ipsum dolor sit amet, qui case probo velit no, an postea scaevola partiendo mei. Id mea fuisset perpetua referrentur. Ut everti ceteros mei, alii discere eum no, duo id malis iuvaret. Ad sint everti accusam vel, ea viderer suscipiantur pri. Brute option minimum in cum, ignota iuvaret an pro.</p>\r\n\r\n<p>Solum atqui intellegebat mea an. Ne ius alterum aliquam. Ea nec populo aliquid mentitum, vis in meliore atomorum, sanctus consequat vituperatoribus duo ea. Ad doctus pertinacia ius, virtute fuisset id has, eum ut modo principes. Qui eu labore adversarium, oporteat delicata qui ut, an qui meliore principes. Id aliquid dolorum nam.</p>\r\n\r\n<p>Reque pericula philosophia ut mei, volumus eligendi mandamus has an. In nobis consulatu pri, has at timeam scaevola, has simul quaeque et. Te nec sale accumsan. Dolorem prodesset efficiendi sea ea.</p>\r\n\r\n<p>Et habeo modus debitis pri, vel quis fierent albucius ne. Ea animal meliore usu, nec etiam dolorum atomorum at, nam in audire mandamus omittantur. Cu ius dicam officiis molestiae, mea volumus officiis cotidieque no. Ut vel possim interpretaris, idque probatus antiopam has ad. Facilisi qualisque te sea, no dolorum mnesarchum usu.</p>\r\n\r\n<p>Eum tota graeci impetus an, eirmod invenire rationibus ne mel. Ignota habemus eum ex, vis omnesque delicata perpetua an. Sit id modo invidunt sapientem, ne eum vocibus dolores phaedrum. Case praesent appellantur eu per.</p>\r\n', '05-09-2017', 'news-7.jpg', 2, 0, 'Vix tale noluisse voluptua ad ne', '', ''),
(8, 'Liber utroque vim an ne his brute', 'liber-utroque-vim-an-ne-his-brute', '<p>Lorem ipsum dolor sit amet, qui case probo velit no, an postea scaevola partiendo mei. Id mea fuisset perpetua referrentur. Ut everti ceteros mei, alii discere eum no, duo id malis iuvaret. Ad sint everti accusam vel, ea viderer suscipiantur pri. Brute option minimum in cum, ignota iuvaret an pro.</p>\r\n\r\n<p>Solum atqui intellegebat mea an. Ne ius alterum aliquam. Ea nec populo aliquid mentitum, vis in meliore atomorum, sanctus consequat vituperatoribus duo ea. Ad doctus pertinacia ius, virtute fuisset id has, eum ut modo principes. Qui eu labore adversarium, oporteat delicata qui ut, an qui meliore principes. Id aliquid dolorum nam.</p>\r\n\r\n<p>Reque pericula philosophia ut mei, volumus eligendi mandamus has an. In nobis consulatu pri, has at timeam scaevola, has simul quaeque et. Te nec sale accumsan. Dolorem prodesset efficiendi sea ea.</p>\r\n\r\n<p>Et habeo modus debitis pri, vel quis fierent albucius ne. Ea animal meliore usu, nec etiam dolorum atomorum at, nam in audire mandamus omittantur. Cu ius dicam officiis molestiae, mea volumus officiis cotidieque no. Ut vel possim interpretaris, idque probatus antiopam has ad. Facilisi qualisque te sea, no dolorum mnesarchum usu.</p>\r\n\r\n<p>Eum tota graeci impetus an, eirmod invenire rationibus ne mel. Ignota habemus eum ex, vis omnesque delicata perpetua an. Sit id modo invidunt sapientem, ne eum vocibus dolores phaedrum. Case praesent appellantur eu per.</p>\r\n', '05-09-2017', 'news-8.jpg', 2, 12, 'Liber utroque vim an ne his brute', '', ''),
(9, 'Nostrum copiosae argumentum has', 'nostrum-copiosae-argumentum-has', '<p>Lorem ipsum dolor sit amet, qui case probo velit no, an postea scaevola partiendo mei. Id mea fuisset perpetua referrentur. Ut everti ceteros mei, alii discere eum no, duo id malis iuvaret. Ad sint everti accusam vel, ea viderer suscipiantur pri. Brute option minimum in cum, ignota iuvaret an pro.</p>\r\n\r\n<p>Solum atqui intellegebat mea an. Ne ius alterum aliquam. Ea nec populo aliquid mentitum, vis in meliore atomorum, sanctus consequat vituperatoribus duo ea. Ad doctus pertinacia ius, virtute fuisset id has, eum ut modo principes. Qui eu labore adversarium, oporteat delicata qui ut, an qui meliore principes. Id aliquid dolorum nam.</p>\r\n\r\n<p>Reque pericula philosophia ut mei, volumus eligendi mandamus has an. In nobis consulatu pri, has at timeam scaevola, has simul quaeque et. Te nec sale accumsan. Dolorem prodesset efficiendi sea ea.</p>\r\n\r\n<p>Et habeo modus debitis pri, vel quis fierent albucius ne. Ea animal meliore usu, nec etiam dolorum atomorum at, nam in audire mandamus omittantur. Cu ius dicam officiis molestiae, mea volumus officiis cotidieque no. Ut vel possim interpretaris, idque probatus antiopam has ad. Facilisi qualisque te sea, no dolorum mnesarchum usu.</p>\r\n\r\n<p>Eum tota graeci impetus an, eirmod invenire rationibus ne mel. Ignota habemus eum ex, vis omnesque delicata perpetua an. Sit id modo invidunt sapientem, ne eum vocibus dolores phaedrum. Case praesent appellantur eu per.</p>\r\n', '05-09-2017', 'news-9.jpg', 1, 12, 'Nostrum copiosae argumentum has', '', ''),
(10, 'An labores explicari qui eu', 'an-labores-explicari-qui-eu', '<p>Lorem ipsum dolor sit amet, qui case probo velit no, an postea scaevola partiendo mei. Id mea fuisset perpetua referrentur. Ut everti ceteros mei, alii discere eum no, duo id malis iuvaret. Ad sint everti accusam vel, ea viderer suscipiantur pri. Brute option minimum in cum, ignota iuvaret an pro.</p>\r\n\r\n<p>Solum atqui intellegebat mea an. Ne ius alterum aliquam. Ea nec populo aliquid mentitum, vis in meliore atomorum, sanctus consequat vituperatoribus duo ea. Ad doctus pertinacia ius, virtute fuisset id has, eum ut modo principes. Qui eu labore adversarium, oporteat delicata qui ut, an qui meliore principes. Id aliquid dolorum nam.</p>\r\n\r\n<p>Reque pericula philosophia ut mei, volumus eligendi mandamus has an. In nobis consulatu pri, has at timeam scaevola, has simul quaeque et. Te nec sale accumsan. Dolorem prodesset efficiendi sea ea.</p>\r\n\r\n<p>Et habeo modus debitis pri, vel quis fierent albucius ne. Ea animal meliore usu, nec etiam dolorum atomorum at, nam in audire mandamus omittantur. Cu ius dicam officiis molestiae, mea volumus officiis cotidieque no. Ut vel possim interpretaris, idque probatus antiopam has ad. Facilisi qualisque te sea, no dolorum mnesarchum usu.</p>\r\n\r\n<p>Eum tota graeci impetus an, eirmod invenire rationibus ne mel. Ignota habemus eum ex, vis omnesque delicata perpetua an. Sit id modo invidunt sapientem, ne eum vocibus dolores phaedrum. Case praesent appellantur eu per.</p>\r\n', '05-09-2017', 'news-10.jpg', 1, 4, 'An labores explicari qui eu', '', ''),
(11, 'Lorem ipsum dolor sit amet', 'lorem-ipsum-dolor-sit-amet', '<p>Lorem ipsum dolor sit amet, qui case probo velit no, an postea scaevola partiendo mei. Id mea fuisset perpetua referrentur. Ut everti ceteros mei, alii discere eum no, duo id malis iuvaret. Ad sint everti accusam vel, ea viderer suscipiantur pri. Brute option minimum in cum, ignota iuvaret an pro.</p>\r\n\r\n<p>Solum atqui intellegebat mea an. Ne ius alterum aliquam. Ea nec populo aliquid mentitum, vis in meliore atomorum, sanctus consequat vituperatoribus duo ea. Ad doctus pertinacia ius, virtute fuisset id has, eum ut modo principes. Qui eu labore adversarium, oporteat delicata qui ut, an qui meliore principes. Id aliquid dolorum nam.</p>\r\n\r\n<p>Reque pericula philosophia ut mei, volumus eligendi mandamus has an. In nobis consulatu pri, has at timeam scaevola, has simul quaeque et. Te nec sale accumsan. Dolorem prodesset efficiendi sea ea.</p>\r\n\r\n<p>Et habeo modus debitis pri, vel quis fierent albucius ne. Ea animal meliore usu, nec etiam dolorum atomorum at, nam in audire mandamus omittantur. Cu ius dicam officiis molestiae, mea volumus officiis cotidieque no. Ut vel possim interpretaris, idque probatus antiopam has ad. Facilisi qualisque te sea, no dolorum mnesarchum usu.</p>\r\n\r\n<p>Eum tota graeci impetus an, eirmod invenire rationibus ne mel. Ignota habemus eum ex, vis omnesque delicata perpetua an. Sit id modo invidunt sapientem, ne eum vocibus dolores phaedrum. Case praesent appellantur eu per.</p>\r\n', '05-09-2017', 'news-11.jpg', 1, 18, 'Lorem ipsum dolor sit amet', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_old_price` varchar(10) NOT NULL,
  `p_current_price` varchar(10) NOT NULL,
  `p_qty` int(10) NOT NULL,
  `p_featured_photo` varchar(255) NOT NULL,
  `p_description` text NOT NULL,
  `p_short_description` text NOT NULL,
  `p_feature` text NOT NULL,
  `p_condition` text NOT NULL,
  `p_return_policy` text NOT NULL,
  `p_total_view` int(11) NOT NULL,
  `p_is_featured` int(1) NOT NULL,
  `p_is_active` int(1) NOT NULL,
  `ecat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`p_id`, `p_name`, `p_old_price`, `p_current_price`, `p_qty`, `p_featured_photo`, `p_description`, `p_short_description`, `p_feature`, `p_condition`, `p_return_policy`, `p_total_view`, `p_is_featured`, `p_is_active`, `ecat_id`) VALUES
(7, 'Regatta Girls Katrisse Quick Dry One Piece Swimming Costume | Fruugo UK', '40', '25', 123, 'product-featured-7-1747963869.jpg', '<p><a data-ved=\"0CBcQjhxqFwoTCODL8KC4uI0DFQAAAAAdAAAAABAX\" rel=\"noopener\" target=\"_blank\" href=\"https://www.fruugo.co.uk/regatta-girls-katrisse-quick-dry-one-piece-swimming-costume/p-137066178-607289854\" class=\"Hnk30e indIKd\"><h1 class=\"tE7R7 indIKd q23Yce fA1vYb cS4Vcb-pGL6qe-fwJd0c\">Regatta Girls Katrisse Quick Dry One Piece Swimming Costume | Fruugo UK</h1></a></p>', '<p><a data-ved=\"0CBcQjhxqFwoTCODL8KC4uI0DFQAAAAAdAAAAABAX\" rel=\"noopener\" target=\"_blank\" href=\"https://www.fruugo.co.uk/regatta-girls-katrisse-quick-dry-one-piece-swimming-costume/p-137066178-607289854\" class=\"Hnk30e indIKd\"><h1 class=\"tE7R7 indIKd q23Yce fA1vYb cS4Vcb-pGL6qe-fwJd0c\">Regatta Girls Katrisse Quick Dry One Piece Swimming Costume | Fruugo UK</h1></a></p>', '<p><a data-ved=\"0CBcQjhxqFwoTCODL8KC4uI0DFQAAAAAdAAAAABAX\" rel=\"noopener\" target=\"_blank\" href=\"https://www.fruugo.co.uk/regatta-girls-katrisse-quick-dry-one-piece-swimming-costume/p-137066178-607289854\" class=\"Hnk30e indIKd\"><h1 class=\"tE7R7 indIKd q23Yce fA1vYb cS4Vcb-pGL6qe-fwJd0c\">Regatta Girls Katrisse Quick Dry One Piece Swimming Costume | Fruugo UK</h1></a></p>', '<p><a data-ved=\"0CBcQjhxqFwoTCODL8KC4uI0DFQAAAAAdAAAAABAX\" rel=\"noopener\" target=\"_blank\" href=\"https://www.fruugo.co.uk/regatta-girls-katrisse-quick-dry-one-piece-swimming-costume/p-137066178-607289854\" class=\"Hnk30e indIKd\"><h1 class=\"tE7R7 indIKd q23Yce fA1vYb cS4Vcb-pGL6qe-fwJd0c\">Regatta Girls Katrisse Quick Dry One Piece Swimming Costume | Fruugo UK</h1></a></p>', '<p><a data-ved=\"0CBcQjhxqFwoTCODL8KC4uI0DFQAAAAAdAAAAABAX\" rel=\"noopener\" target=\"_blank\" href=\"https://www.fruugo.co.uk/regatta-girls-katrisse-quick-dry-one-piece-swimming-costume/p-137066178-607289854\" class=\"Hnk30e indIKd\"><h1 class=\"tE7R7 indIKd q23Yce fA1vYb cS4Vcb-pGL6qe-fwJd0c\">Regatta Girls Katrisse Quick Dry One Piece Swimming Costume | Fruugo UK</h1></a></p>', 4, 0, 1, 44),
(8, 'Regatta Girls Katrisse Quick Dry One Piece Swimming Costume', '50', '30', 232, 'product-featured-8-1747964015.jpg', '<h1 class=\"mb-8 js-product-title\" title=\"Regatta Girls Katrisse Quick Dry One Piece Swimming Costume\">Regatta Girls Katrisse Quick Dry One Piece Swimming Costume</h1><p></p>', '<h1 class=\"mb-8 js-product-title\" title=\"Regatta Girls Katrisse Quick Dry One Piece Swimming Costume\">Regatta Girls Katrisse Quick Dry One Piece Swimming Costume</h1><p></p>', '<h1 class=\"mb-8 js-product-title\" title=\"Regatta Girls Katrisse Quick Dry One Piece Swimming Costume\">Regatta Girls Katrisse Quick Dry One Piece Swimming Costume</h1><p></p>', '<h1 class=\"mb-8 js-product-title\" title=\"Regatta Girls Katrisse Quick Dry One Piece Swimming Costume\">Regatta Girls Katrisse Quick Dry One Piece Swimming Costume</h1><p></p>', '<h1 class=\"mb-8 js-product-title\" title=\"Regatta Girls Katrisse Quick Dry One Piece Swimming Costume\">Regatta Girls Katrisse Quick Dry One Piece Swimming Costume</h1><p></p>', 2, 1, 1, 44),
(9, 'Magical Change Color Beach Shorts Men Swimming Trunks Swimwear Quick Dry Bathing', '50', '40', 30, 'product-featured-9-1747964202.jpg', '<p>Magical Change Color Beach Shorts Men Swimming Trunks Swimwear Quick Dry Bathing<br></p>', '<p>Magical Change Color Beach Shorts Men Swimming Trunks Swimwear Quick Dry Bathing<br></p>', '<p>Magical Change Color Beach Shorts Men Swimming Trunks Swimwear Quick Dry Bathing<br></p>', '<p>Magical Change Color Beach Shorts Men Swimming Trunks Swimwear Quick Dry Bathing<br></p>', '<p>Magical Change Color Beach Shorts Men Swimming Trunks Swimwear Quick Dry Bathing<br></p>', 0, 0, 1, 44),
(10, 'Magical Change Color Beach Shorts Men Swimming Trunks Swimwear Quick Dry Bathing', '30', '20', 102, 'product-featured-10-1747964516.jpg', '<p>ALWAYS CHECK THE SIZE CHART (IN IMAGE SECTION ABOVE). SIZES PROVIDED ARE\r\n UK SIZES, BE SURE TO MEASURE AND CHECK THE SIZE CHART BEFORE ORDERING. \r\nStand out from the crowd with these Arena  Team Swim Jammer Solid apart \r\nof the Arena\'s Capsules&nbsp;Collection. These are the perfect choice for \r\nyour regular and intensive swimmers. Made with Arena\'s MaxLife Eco \r\nfabric which provides elasticity for an excellent fit with power \r\nretention performance. These Jammers deliver maximum resistance to \r\nchlorine and UV rays as well as providing an excellent elasticity fit \r\nwith power retention performance. Additional features include quick \r\ndrying properties along with a front lining for extra comfort. 45cm leg \r\nlength. Features  MaxLife Eco Fabric Quick Drying Front lined for \r\ncomfort 50+ UV Protection 45cm Leg 100% Polyester (53% of which is \r\nrecycled) </p>', '<p>ALWAYS CHECK THE SIZE CHART (IN IMAGE SECTION ABOVE). SIZES PROVIDED ARE\r\n UK SIZES, BE SURE TO MEASURE AND CHECK THE SIZE CHART BEFORE ORDERING. \r\nStand out from the crowd with these Arena  Team Swim Jammer Solid apart \r\nof the Arena\'s Capsules&nbsp;Collection. These are the perfect choice for \r\nyour regular and intensive swimmers. Made with Arena\'s MaxLife Eco \r\nfabric which provides elasticity for an excellent fit with power \r\nretention performance. These Jammers deliver maximum resistance to \r\nchlorine and UV rays as well as providing an excellent elasticity fit \r\nwith power retention performance. Additional features include quick \r\ndrying properties along with a front lining for extra comfort. 45cm leg \r\nlength. Features  MaxLife Eco Fabric Quick Drying Front lined for \r\ncomfort 50+ UV Protection 45cm Leg 100% Polyester (53% of which is \r\nrecycled) </p>', '<p>ALWAYS CHECK THE SIZE CHART (IN IMAGE SECTION ABOVE). SIZES PROVIDED ARE\r\n UK SIZES, BE SURE TO MEASURE AND CHECK THE SIZE CHART BEFORE ORDERING. \r\nStand out from the crowd with these Arena  Team Swim Jammer Solid apart \r\nof the Arena\'s Capsules&nbsp;Collection. These are the perfect choice for \r\nyour regular and intensive swimmers. Made with Arena\'s MaxLife Eco \r\nfabric which provides elasticity for an excellent fit with power \r\nretention performance. These Jammers deliver maximum resistance to \r\nchlorine and UV rays as well as providing an excellent elasticity fit \r\nwith power retention performance. Additional features include quick \r\ndrying properties along with a front lining for extra comfort. 45cm leg \r\nlength. Features  MaxLife Eco Fabric Quick Drying Front lined for \r\ncomfort 50+ UV Protection 45cm Leg 100% Polyester (53% of which is \r\nrecycled) </p>', '<p>ALWAYS CHECK THE SIZE CHART (IN IMAGE SECTION ABOVE). SIZES PROVIDED ARE\r\n UK SIZES, BE SURE TO MEASURE AND CHECK THE SIZE CHART BEFORE ORDERING. \r\nStand out from the crowd with these Arena  Team Swim Jammer Solid apart \r\nof the Arena\'s Capsules&nbsp;Collection. These are the perfect choice for \r\nyour regular and intensive swimmers. Made with Arena\'s MaxLife Eco \r\nfabric which provides elasticity for an excellent fit with power \r\nretention performance. These Jammers deliver maximum resistance to \r\nchlorine and UV rays as well as providing an excellent elasticity fit \r\nwith power retention performance. Additional features include quick \r\ndrying properties along with a front lining for extra comfort. 45cm leg \r\nlength. Features  MaxLife Eco Fabric Quick Drying Front lined for \r\ncomfort 50+ UV Protection 45cm Leg 100% Polyester (53% of which is \r\nrecycled) </p>', '<p>ALWAYS CHECK THE SIZE CHART (IN IMAGE SECTION ABOVE). SIZES PROVIDED ARE\r\n UK SIZES, BE SURE TO MEASURE AND CHECK THE SIZE CHART BEFORE ORDERING. \r\nStand out from the crowd with these Arena  Team Swim Jammer Solid apart \r\nof the Arena\'s Capsules&nbsp;Collection. These are the perfect choice for \r\nyour regular and intensive swimmers. Made with Arena\'s MaxLife Eco \r\nfabric which provides elasticity for an excellent fit with power \r\nretention performance. These Jammers deliver maximum resistance to \r\nchlorine and UV rays as well as providing an excellent elasticity fit \r\nwith power retention performance. Additional features include quick \r\ndrying properties along with a front lining for extra comfort. 45cm leg \r\nlength. Features  MaxLife Eco Fabric Quick Drying Front lined for \r\ncomfort 50+ UV Protection 45cm Leg 100% Polyester (53% of which is \r\nrecycled) </p>', 13, 1, 1, 44),
(11, 'Arena Boy\'s Starfish Swim Jammer- Navy Blue/Turquiose - Boys', '40', '20', 123, 'product-featured-11-1747965015.jpg', '<p>ALWAYS CHECK THE SIZE CHART (IN IMAGE SECTION ABOVE). SIZES PROVIDED ARE\r\n UK SIZES, BE SURE TO MEASURE AND CHECK THE SIZE CHART BEFORE ORDERING. \r\nThe  Arena Starfish swim Jammers are a great choice for young club \r\nswimmers that require a durable swimsuit for training sessions. These \r\narena Starfish Jammers feature a geometric print side panel that really \r\nstands out against the Navy Blue base fabric. The  Arena Starfish swim \r\njammers have an internal draw cord so that you get a secure fit, a front\r\n lining is included for added comfort. This Jammer is made with Arena\'s \r\nMaxLife Eco fabric, which is the evolution of arena’s premium fabric for\r\n regular and intensive swimmers, delivering maximum resistance to \r\nchlorinated water. While maintaining the same benefits as the standard \r\nfibres used in the original MaxLife, the new ecological version features\r\n more than 50% recycled polyester. The fabric is made from PET plastic \r\nbottles, the production process has been optimized to save energy, \r\nreduce CO2 emissions and minimize water usage. Its construction is based\r\n on specifically engineered PE yarns, providing elasticity and combining\r\n an excellent fit with power retention performance. Additional features \r\ninclude its quick drying properties and 50+ UV protection, this is the \r\nperfect suit for the intensive swimmer\r\n Key Features:  Chlorine Resistant 50+ UV Protection 36 cm Leg Length \r\nQuick Drying Front Lining Material: MaxLife Eco 49% Polyester, 51% \r\nRecycled Polyester </p>', '<p>ALWAYS CHECK THE SIZE CHART (IN IMAGE SECTION ABOVE). SIZES PROVIDED ARE\r\n UK SIZES, BE SURE TO MEASURE AND CHECK THE SIZE CHART BEFORE ORDERING. \r\nThe  Arena Starfish swim Jammers are a great choice for young club \r\nswimmers that require a durable swimsuit for training sessions. These \r\narena Starfish Jammers feature a geometric print side panel that really \r\nstands out against the Navy Blue base fabric. The  Arena Starfish swim \r\njammers have an internal draw cord so that you get a secure fit, a front\r\n lining is included for added comfort. This Jammer is made with Arena\'s \r\nMaxLife Eco fabric, which is the evolution of arena’s premium fabric for\r\n regular and intensive swimmers, delivering maximum resistance to \r\nchlorinated water. While maintaining the same benefits as the standard \r\nfibres used in the original MaxLife, the new ecological version features\r\n more than 50% recycled polyester. The fabric is made from PET plastic \r\nbottles, the production process has been optimized to save energy, \r\nreduce CO2 emissions and minimize water usage. Its construction is based\r\n on specifically engineered PE yarns, providing elasticity and combining\r\n an excellent fit with power retention performance. Additional features \r\ninclude its quick drying properties and 50+ UV protection, this is the \r\nperfect suit for the intensive swimmer\r\n Key Features:  Chlorine Resistant 50+ UV Protection 36 cm Leg Length \r\nQuick Drying Front Lining Material: MaxLife Eco 49% Polyester, 51% \r\nRecycled Polyester </p>', '<p>ALWAYS CHECK THE SIZE CHART (IN IMAGE SECTION ABOVE). SIZES PROVIDED ARE\r\n UK SIZES, BE SURE TO MEASURE AND CHECK THE SIZE CHART BEFORE ORDERING. \r\nThe  Arena Starfish swim Jammers are a great choice for young club \r\nswimmers that require a durable swimsuit for training sessions. These \r\narena Starfish Jammers feature a geometric print side panel that really \r\nstands out against the Navy Blue base fabric. The  Arena Starfish swim \r\njammers have an internal draw cord so that you get a secure fit, a front\r\n lining is included for added comfort. This Jammer is made with Arena\'s \r\nMaxLife Eco fabric, which is the evolution of arena’s premium fabric for\r\n regular and intensive swimmers, delivering maximum resistance to \r\nchlorinated water. While maintaining the same benefits as the standard \r\nfibres used in the original MaxLife, the new ecological version features\r\n more than 50% recycled polyester. The fabric is made from PET plastic \r\nbottles, the production process has been optimized to save energy, \r\nreduce CO2 emissions and minimize water usage. Its construction is based\r\n on specifically engineered PE yarns, providing elasticity and combining\r\n an excellent fit with power retention performance. Additional features \r\ninclude its quick drying properties and 50+ UV protection, this is the \r\nperfect suit for the intensive swimmer\r\n Key Features:  Chlorine Resistant 50+ UV Protection 36 cm Leg Length \r\nQuick Drying Front Lining Material: MaxLife Eco 49% Polyester, 51% \r\nRecycled Polyester </p>', '<p>ALWAYS CHECK THE SIZE CHART (IN IMAGE SECTION ABOVE). SIZES PROVIDED ARE\r\n UK SIZES, BE SURE TO MEASURE AND CHECK THE SIZE CHART BEFORE ORDERING. \r\nThe  Arena Starfish swim Jammers are a great choice for young club \r\nswimmers that require a durable swimsuit for training sessions. These \r\narena Starfish Jammers feature a geometric print side panel that really \r\nstands out against the Navy Blue base fabric. The  Arena Starfish swim \r\njammers have an internal draw cord so that you get a secure fit, a front\r\n lining is included for added comfort. This Jammer is made with Arena\'s \r\nMaxLife Eco fabric, which is the evolution of arena’s premium fabric for\r\n regular and intensive swimmers, delivering maximum resistance to \r\nchlorinated water. While maintaining the same benefits as the standard \r\nfibres used in the original MaxLife, the new ecological version features\r\n more than 50% recycled polyester. The fabric is made from PET plastic \r\nbottles, the production process has been optimized to save energy, \r\nreduce CO2 emissions and minimize water usage. Its construction is based\r\n on specifically engineered PE yarns, providing elasticity and combining\r\n an excellent fit with power retention performance. Additional features \r\ninclude its quick drying properties and 50+ UV protection, this is the \r\nperfect suit for the intensive swimmer\r\n Key Features:  Chlorine Resistant 50+ UV Protection 36 cm Leg Length \r\nQuick Drying Front Lining Material: MaxLife Eco 49% Polyester, 51% \r\nRecycled Polyester </p>', '<p>ALWAYS CHECK THE SIZE CHART (IN IMAGE SECTION ABOVE). SIZES PROVIDED ARE\r\n UK SIZES, BE SURE TO MEASURE AND CHECK THE SIZE CHART BEFORE ORDERING. \r\nThe  Arena Starfish swim Jammers are a great choice for young club \r\nswimmers that require a durable swimsuit for training sessions. These \r\narena Starfish Jammers feature a geometric print side panel that really \r\nstands out against the Navy Blue base fabric. The  Arena Starfish swim \r\njammers have an internal draw cord so that you get a secure fit, a front\r\n lining is included for added comfort. This Jammer is made with Arena\'s \r\nMaxLife Eco fabric, which is the evolution of arena’s premium fabric for\r\n regular and intensive swimmers, delivering maximum resistance to \r\nchlorinated water. While maintaining the same benefits as the standard \r\nfibres used in the original MaxLife, the new ecological version features\r\n more than 50% recycled polyester. The fabric is made from PET plastic \r\nbottles, the production process has been optimized to save energy, \r\nreduce CO2 emissions and minimize water usage. Its construction is based\r\n on specifically engineered PE yarns, providing elasticity and combining\r\n an excellent fit with power retention performance. Additional features \r\ninclude its quick drying properties and 50+ UV protection, this is the \r\nperfect suit for the intensive swimmer\r\n Key Features:  Chlorine Resistant 50+ UV Protection 36 cm Leg Length \r\nQuick Drying Front Lining Material: MaxLife Eco 49% Polyester, 51% \r\nRecycled Polyester </p>', 0, 1, 1, 44),
(12, 'Arena Kiko Pro Swim Jammer - Black/Multi - Boys', '50', '30', 123, 'product-featured-12-1747965218.jpg', '<p>ALWAYS CHECK THE SIZE CHART (IN IMAGE SECTION ABOVE). SIZES PROVIDED ARE\r\n UK SIZES, BE SURE TO MEASURE AND CHECK THE SIZE CHART BEFORE ORDERING. \r\nThese Arena Kiko Pro Swim Jammer feature a geometric print that ensures \r\nyou will stand out from the crowd on your next visit to the pool.&nbsp; These\r\n Arena jammers have an internal draw cord so that you get a secure fit, \r\na&nbsp;front lining is included for added comfort. This Jammer is made with \r\nArena\'s MaxLife, 100% polyester fabric. This material is an exclusive \r\nfrom Arena MaxLife Eco which is the evolution of arena’s premium fabric \r\nfor regular and intensive swimmers, delivering maximum resistance to \r\nchlorinated water. While maintaining the same benefits as the standard \r\nfibres used in the original MaxLife, the new ecological version features\r\n more than 50% recycled polyester, obtained from PET Bottles and \r\nproduced adopting a circular economy approach that helps save energy, \r\nreduce CO2 emissions and minimize water usage during the process. Its \r\nconstruction is based on specifically engineered PE yarns, providing \r\nelasticity and combining an excellent fit with power retention \r\nperformance. Additional features include its quick drying properties and\r\n 50+ UV protection,&nbsp;this is the perfect suit for the intensive swimmer\r\n&nbsp; Key Features:  45cm Leg Length Quick Drying 50+ UV Protection&nbsp; Front \r\nLining Material: MaxLife Eco, 100% Polyester Fabric </p>', '<p>ALWAYS CHECK THE SIZE CHART (IN IMAGE SECTION ABOVE). SIZES PROVIDED ARE\r\n UK SIZES, BE SURE TO MEASURE AND CHECK THE SIZE CHART BEFORE ORDERING. \r\nThese Arena Kiko Pro Swim Jammer feature a geometric print that ensures \r\nyou will stand out from the crowd on your next visit to the pool.&nbsp; These\r\n Arena jammers have an internal draw cord so that you get a secure fit, \r\na&nbsp;front lining is included for added comfort. This Jammer is made with \r\nArena\'s MaxLife, 100% polyester fabric. This material is an exclusive \r\nfrom Arena MaxLife Eco which is the evolution of arena’s premium fabric \r\nfor regular and intensive swimmers, delivering maximum resistance to \r\nchlorinated water. While maintaining the same benefits as the standard \r\nfibres used in the original MaxLife, the new ecological version features\r\n more than 50% recycled polyester, obtained from PET Bottles and \r\nproduced adopting a circular economy approach that helps save energy, \r\nreduce CO2 emissions and minimize water usage during the process. Its \r\nconstruction is based on specifically engineered PE yarns, providing \r\nelasticity and combining an excellent fit with power retention \r\nperformance. Additional features include its quick drying properties and\r\n 50+ UV protection,&nbsp;this is the perfect suit for the intensive swimmer\r\n&nbsp; Key Features:  45cm Leg Length Quick Drying 50+ UV Protection&nbsp; Front \r\nLining Material: MaxLife Eco, 100% Polyester Fabric </p>', '<p>ALWAYS CHECK THE SIZE CHART (IN IMAGE SECTION ABOVE). SIZES PROVIDED ARE\r\n UK SIZES, BE SURE TO MEASURE AND CHECK THE SIZE CHART BEFORE ORDERING. \r\nThese Arena Kiko Pro Swim Jammer feature a geometric print that ensures \r\nyou will stand out from the crowd on your next visit to the pool.&nbsp; These\r\n Arena jammers have an internal draw cord so that you get a secure fit, \r\na&nbsp;front lining is included for added comfort. This Jammer is made with \r\nArena\'s MaxLife, 100% polyester fabric. This material is an exclusive \r\nfrom Arena MaxLife Eco which is the evolution of arena’s premium fabric \r\nfor regular and intensive swimmers, delivering maximum resistance to \r\nchlorinated water. While maintaining the same benefits as the standard \r\nfibres used in the original MaxLife, the new ecological version features\r\n more than 50% recycled polyester, obtained from PET Bottles and \r\nproduced adopting a circular economy approach that helps save energy, \r\nreduce CO2 emissions and minimize water usage during the process. Its \r\nconstruction is based on specifically engineered PE yarns, providing \r\nelasticity and combining an excellent fit with power retention \r\nperformance. Additional features include its quick drying properties and\r\n 50+ UV protection,&nbsp;this is the perfect suit for the intensive swimmer\r\n&nbsp; Key Features:  45cm Leg Length Quick Drying 50+ UV Protection&nbsp; Front \r\nLining Material: MaxLife Eco, 100% Polyester Fabric </p>', '<p>ALWAYS CHECK THE SIZE CHART (IN IMAGE SECTION ABOVE). SIZES PROVIDED ARE\r\n UK SIZES, BE SURE TO MEASURE AND CHECK THE SIZE CHART BEFORE ORDERING. \r\nThese Arena Kiko Pro Swim Jammer feature a geometric print that ensures \r\nyou will stand out from the crowd on your next visit to the pool.&nbsp; These\r\n Arena jammers have an internal draw cord so that you get a secure fit, \r\na&nbsp;front lining is included for added comfort. This Jammer is made with \r\nArena\'s MaxLife, 100% polyester fabric. This material is an exclusive \r\nfrom Arena MaxLife Eco which is the evolution of arena’s premium fabric \r\nfor regular and intensive swimmers, delivering maximum resistance to \r\nchlorinated water. While maintaining the same benefits as the standard \r\nfibres used in the original MaxLife, the new ecological version features\r\n more than 50% recycled polyester, obtained from PET Bottles and \r\nproduced adopting a circular economy approach that helps save energy, \r\nreduce CO2 emissions and minimize water usage during the process. Its \r\nconstruction is based on specifically engineered PE yarns, providing \r\nelasticity and combining an excellent fit with power retention \r\nperformance. Additional features include its quick drying properties and\r\n 50+ UV protection,&nbsp;this is the perfect suit for the intensive swimmer\r\n&nbsp; Key Features:  45cm Leg Length Quick Drying 50+ UV Protection&nbsp; Front \r\nLining Material: MaxLife Eco, 100% Polyester Fabric </p>', '<p>ALWAYS CHECK THE SIZE CHART (IN IMAGE SECTION ABOVE). SIZES PROVIDED ARE\r\n UK SIZES, BE SURE TO MEASURE AND CHECK THE SIZE CHART BEFORE ORDERING. \r\nThese Arena Kiko Pro Swim Jammer feature a geometric print that ensures \r\nyou will stand out from the crowd on your next visit to the pool.&nbsp; These\r\n Arena jammers have an internal draw cord so that you get a secure fit, \r\na&nbsp;front lining is included for added comfort. This Jammer is made with \r\nArena\'s MaxLife, 100% polyester fabric. This material is an exclusive \r\nfrom Arena MaxLife Eco which is the evolution of arena’s premium fabric \r\nfor regular and intensive swimmers, delivering maximum resistance to \r\nchlorinated water. While maintaining the same benefits as the standard \r\nfibres used in the original MaxLife, the new ecological version features\r\n more than 50% recycled polyester, obtained from PET Bottles and \r\nproduced adopting a circular economy approach that helps save energy, \r\nreduce CO2 emissions and minimize water usage during the process. Its \r\nconstruction is based on specifically engineered PE yarns, providing \r\nelasticity and combining an excellent fit with power retention \r\nperformance. Additional features include its quick drying properties and\r\n 50+ UV protection,&nbsp;this is the perfect suit for the intensive swimmer\r\n&nbsp; Key Features:  45cm Leg Length Quick Drying 50+ UV Protection&nbsp; Front \r\nLining Material: MaxLife Eco, 100% Polyester Fabric </p>', 5, 1, 1, 44);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_color`
--

CREATE TABLE `tbl_product_color` (
  `id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_color`
--

INSERT INTO `tbl_product_color` (`id`, `color_id`, `p_id`) VALUES
(110, 2, 39),
(111, 11, 42),
(159, 2, 77),
(163, 17, 79),
(164, 2, 78),
(167, 3, 80),
(168, 2, 81),
(172, 1, 82),
(173, 2, 82),
(174, 4, 82),
(223, 21, 85),
(224, 22, 85),
(225, 23, 85),
(226, 1, 83),
(227, 2, 83),
(228, 3, 83),
(229, 4, 83),
(230, 5, 83),
(231, 6, 83),
(232, 8, 83),
(233, 14, 83),
(234, 17, 83),
(235, 18, 83),
(236, 12, 89),
(237, 27, 91),
(241, 2, 88),
(242, 8, 88),
(243, 17, 88),
(244, 2, 90),
(245, 6, 90),
(246, 25, 90),
(247, 27, 90),
(248, 28, 90),
(253, 5, 96),
(254, 24, 96),
(257, 3, 87),
(258, 17, 87),
(262, 5, 98),
(264, 14, 100),
(265, 2, 106),
(266, 3, 86),
(275, 1, 58),
(276, 2, 58),
(289, 32, 8),
(292, 33, 10),
(293, 34, 11),
(294, 31, 7),
(295, 34, 12),
(296, 32, 9),
(297, 33, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_photo`
--

CREATE TABLE `tbl_product_photo` (
  `pp_id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_photo`
--

INSERT INTO `tbl_product_photo` (`pp_id`, `photo`, `p_id`) VALUES
(106, '106.jpg', 83),
(107, '107.jpg', 83),
(110, '110.jpg', 85),
(111, '111.jpg', 85),
(114, '114.jpg', 87),
(115, '115.jpg', 87),
(116, '116.jpg', 88),
(117, '117.jpg', 88),
(118, '118.jpg', 89),
(119, '119.jpg', 89),
(120, '120.jpg', 90),
(121, '121.jpg', 91),
(127, '127.jpg', 96),
(129, '129.jpg', 98),
(130, '130.jpg', 98),
(131, '131.jpg', 100),
(138, '138.jpg', 8),
(139, '139.jpg', 8),
(140, '140.jpg', 9),
(141, '141.jpg', 9),
(142, '142.jpg', 10),
(143, '143.jpg', 10),
(144, '144.jpg', 10),
(145, '145.jpg', 11),
(146, '146.jpg', 12),
(147, '147.jpg', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_size`
--

CREATE TABLE `tbl_product_size` (
  `id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_size`
--

INSERT INTO `tbl_product_size` (`id`, `size_id`, `p_id`) VALUES
(133, 27, 39),
(134, 8, 42),
(249, 1, 79),
(250, 2, 79),
(251, 3, 79),
(252, 1, 78),
(253, 2, 78),
(254, 3, 78),
(255, 4, 78),
(256, 5, 78),
(259, 26, 80),
(262, 3, 82),
(263, 4, 82),
(340, 15, 85),
(341, 16, 85),
(342, 17, 85),
(343, 18, 85),
(344, 19, 85),
(345, 20, 85),
(346, 21, 85),
(347, 22, 85),
(348, 23, 85),
(349, 24, 85),
(350, 25, 85),
(351, 1, 83),
(352, 2, 83),
(353, 3, 83),
(354, 4, 83),
(355, 5, 83),
(356, 6, 83),
(357, 7, 83),
(358, 3, 89),
(359, 4, 89),
(360, 5, 89),
(361, 6, 89),
(362, 7, 89),
(363, 2, 91),
(364, 3, 91),
(365, 4, 91),
(366, 5, 91),
(367, 6, 91),
(370, 3, 88),
(371, 4, 88),
(372, 5, 88),
(373, 6, 88),
(374, 7, 88),
(375, 1, 90),
(376, 2, 90),
(377, 3, 90),
(378, 4, 90),
(381, 3, 96),
(382, 4, 96),
(383, 5, 96),
(384, 6, 96),
(385, 7, 96),
(399, 29, 87),
(400, 30, 87),
(401, 31, 87),
(402, 32, 87),
(403, 33, 87),
(404, 34, 87),
(405, 35, 87),
(406, 36, 87),
(407, 37, 87),
(408, 38, 87),
(409, 39, 87),
(430, 4, 98),
(431, 5, 98),
(432, 6, 98),
(433, 7, 98),
(436, 3, 100),
(437, 4, 100),
(438, 5, 100),
(439, 6, 100),
(444, 2, 8),
(447, 2, 10),
(448, 3, 10),
(449, 4, 10),
(450, 5, 10),
(451, 96, 11),
(452, 2, 7),
(453, 3, 12),
(454, 4, 12),
(455, 5, 12),
(456, 6, 12),
(457, 3, 9),
(458, 4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `rt_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service`
--

CREATE TABLE `tbl_service` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_service`
--

INSERT INTO `tbl_service` (`id`, `title`, `content`, `photo`) VALUES
(1, 'BRONZAGE SANS EFFORT', 'Découvrez le secret pour un bronzage\r\néclatant et homogène, même en portant\r\nun maillot de bain', 'service-68295edb19ecd.png'),
(3, 'PROTECTION SIMPLIFIÉE', 'Protégez votre peau des rougeurs,\r\ndes brûlures et du vieillissement prématuré,\r\nà l’image d’un écran solaire SPF35 efficace', 'service-68295f093ac8a.png'),
(4, 'IMPACT POSITIF', 'Nos maillots de bain préservent l’équilibre fragile de\r\nl’écosystème en réduisant l’impact des résidus de\r\nprotections solaires classiques sur l’environnement.', 'service-68295f274107f.png'),
(5, 'RAPIDITÉ', 'Profitez d’un séchage ultra-rapide !\r\nNos maillots de bain respirants laissent l’air\r\ncirculer librement à travers les fibres du tissu.', 'service-68296212e6dac.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `footer_about` text NOT NULL,
  `footer_copyright` text NOT NULL,
  `contact_address` text NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_phone` varchar(255) NOT NULL,
  `contact_fax` varchar(255) NOT NULL,
  `contact_map_iframe` text NOT NULL,
  `receive_email` varchar(255) NOT NULL,
  `receive_email_subject` varchar(255) NOT NULL,
  `receive_email_thank_you_message` text NOT NULL,
  `forget_password_message` text NOT NULL,
  `total_recent_post_footer` int(10) NOT NULL,
  `total_popular_post_footer` int(10) NOT NULL,
  `total_recent_post_sidebar` int(11) NOT NULL,
  `total_popular_post_sidebar` int(11) NOT NULL,
  `total_featured_product_home` int(11) NOT NULL,
  `total_latest_product_home` int(11) NOT NULL,
  `total_popular_product_home` int(11) NOT NULL,
  `meta_title_home` text NOT NULL,
  `meta_keyword_home` text NOT NULL,
  `meta_description_home` text NOT NULL,
  `banner_login` varchar(255) NOT NULL,
  `banner_registration` varchar(255) NOT NULL,
  `banner_forget_password` varchar(255) NOT NULL,
  `banner_reset_password` varchar(255) NOT NULL,
  `banner_search` varchar(255) NOT NULL,
  `banner_cart` varchar(255) NOT NULL,
  `banner_checkout` varchar(255) NOT NULL,
  `banner_product_category` varchar(255) NOT NULL,
  `banner_blog` varchar(255) NOT NULL,
  `cta_title` varchar(255) NOT NULL,
  `cta_content` text NOT NULL,
  `cta_read_more_text` varchar(255) NOT NULL,
  `cta_read_more_url` varchar(255) NOT NULL,
  `cta_photo` varchar(255) NOT NULL,
  `featured_product_title` varchar(255) NOT NULL,
  `featured_product_subtitle` varchar(255) NOT NULL,
  `latest_product_title` varchar(255) NOT NULL,
  `latest_product_subtitle` varchar(255) NOT NULL,
  `popular_product_title` varchar(255) NOT NULL,
  `popular_product_subtitle` varchar(255) NOT NULL,
  `testimonial_title` varchar(255) NOT NULL,
  `testimonial_subtitle` varchar(255) NOT NULL,
  `testimonial_photo` varchar(255) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_subtitle` varchar(255) NOT NULL,
  `newsletter_text` text NOT NULL,
  `paypal_email` varchar(255) NOT NULL,
  `stripe_public_key` varchar(255) NOT NULL,
  `stripe_secret_key` varchar(255) NOT NULL,
  `bank_detail` text NOT NULL,
  `before_head` text NOT NULL,
  `after_body` text NOT NULL,
  `before_body` text NOT NULL,
  `home_service_on_off` int(11) NOT NULL,
  `home_welcome_on_off` int(11) NOT NULL,
  `home_featured_product_on_off` int(11) NOT NULL,
  `home_latest_product_on_off` int(11) NOT NULL,
  `home_popular_product_on_off` int(11) NOT NULL,
  `home_testimonial_on_off` int(11) NOT NULL,
  `home_blog_on_off` int(11) NOT NULL,
  `newsletter_on_off` int(11) NOT NULL,
  `ads_above_welcome_on_off` int(1) NOT NULL,
  `ads_above_featured_product_on_off` int(1) NOT NULL,
  `ads_above_latest_product_on_off` int(1) NOT NULL,
  `ads_above_popular_product_on_off` int(1) NOT NULL,
  `ads_above_testimonial_on_off` int(1) NOT NULL,
  `ads_category_sidebar_on_off` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `logo`, `favicon`, `footer_about`, `footer_copyright`, `contact_address`, `contact_email`, `contact_phone`, `contact_fax`, `contact_map_iframe`, `receive_email`, `receive_email_subject`, `receive_email_thank_you_message`, `forget_password_message`, `total_recent_post_footer`, `total_popular_post_footer`, `total_recent_post_sidebar`, `total_popular_post_sidebar`, `total_featured_product_home`, `total_latest_product_home`, `total_popular_product_home`, `meta_title_home`, `meta_keyword_home`, `meta_description_home`, `banner_login`, `banner_registration`, `banner_forget_password`, `banner_reset_password`, `banner_search`, `banner_cart`, `banner_checkout`, `banner_product_category`, `banner_blog`, `cta_title`, `cta_content`, `cta_read_more_text`, `cta_read_more_url`, `cta_photo`, `featured_product_title`, `featured_product_subtitle`, `latest_product_title`, `latest_product_subtitle`, `popular_product_title`, `popular_product_subtitle`, `testimonial_title`, `testimonial_subtitle`, `testimonial_photo`, `blog_title`, `blog_subtitle`, `newsletter_text`, `paypal_email`, `stripe_public_key`, `stripe_secret_key`, `bank_detail`, `before_head`, `after_body`, `before_body`, `home_service_on_off`, `home_welcome_on_off`, `home_featured_product_on_off`, `home_latest_product_on_off`, `home_popular_product_on_off`, `home_testimonial_on_off`, `home_blog_on_off`, `newsletter_on_off`, `ads_above_welcome_on_off`, `ads_above_featured_product_on_off`, `ads_above_latest_product_on_off`, `ads_above_popular_product_on_off`, `ads_above_testimonial_on_off`, `ads_category_sidebar_on_off`) VALUES
(1, 'logo.png', 'favicon.png', '<p>Lorem ipsum dolor sit amet, omnis signiferumque in mei, mei ex enim concludaturque. Senserit salutandi euripidis no per, modus maiestatis scribentur est an.Â Ea suas pertinax has.</p>\r\n', 'Copyright © 2025 - JUUSS — Développé par MoovConseils', '12 square bulsunce \r\nMarseille 13001', 'JUUSS@gmail.com', '+33661042145', '', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3236.1061451697047!2d5.376274017553178!3d43.296482655030265!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12c93a24d9be149d%3A0xf5c09e72c2cf5f0b!2s12%20Square%20Bulsunce%2C%2013001%20Marseille!5e0!3m2!1sfr!2sfr!4v1693491105671!5m2!1sfr!2sfr\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>\r\n\r\n', 'JUUSS@gmail.com', 'Message électronique du visiteur du site JUUSS', 'Merci d\'avoir envoyé un e-mail. Nous vous contacterons sous peu. ', 'Un lien de confirmation est envoyé à votre adresse e-mail. Vous y obtiendrez les informations de réinitialisation du mot de passe.', 4, 4, 5, 5, 10, 6, 8, 'JUUSS', 'vente articles de plage, boutique de plage, short de bain, maillot de bain, JUSS, vêtements plage été, accessoires plage', 'JUSS est une boutique en ligne spécialisée dans la vente d’articles de plage : shorts, maillots de bain, vêtements d\'été et accessoires. Découvrez notre collection tendance pour profiter pleinement de vos vacances au soleil.', 'banner_login.jpeg', 'banner_registration.jpeg', 'banner_forget_password.jpeg', 'banner_reset_password.jpeg', 'banner_search.jpeg', 'banner_cart.jpeg', 'banner_checkout.jpeg', 'banner_product_category.jpeg', 'banner_blog.jpg', 'Welcome To Our Ecommerce Website', 'Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has. Latine propriae quo no, unum ridens expetenda id sit, \r\nat usu eius eligendi singulis. Sea ocurreret principes ne. At nonumy aperiri pri, nam quodsi copiosae intellegebat et, ex deserunt euripidis usu. ', 'Read More', '#', 'cta.jpg', 'Produits Phares', 'Notre liste des Meilleurs Produits en vedette', 'Derniers Produits', 'Notre liste de produits récemment ajoutés', 'Produits Populaires', 'Produits populaires basés sur le choix du client', 'Testimonials', 'See what our clients tell about us', 'testimonial.jpg', 'Latest Blog', 'See all our latest articles and news from below', 'Inscrivez-vous à notre newsletter pour connaître les dernières promotions et réductions.', 'admin@ecom.com', 'pk_test_0SwMWadgu8DwmEcPdUPRsZ7b', 'sk_test_TFcsLJ7xxUtpALbDo1L5c1PN', 'Bank Name: WestView Bank\r\nAccount Number: CA100270589600\r\nBranch Name: CA Branch\r\nCountry: USA', '', '<div id=\"fb-root\"></div>\r\n<script>(function(d, s, id) {\r\n  var js, fjs = d.getElementsByTagName(s)[0];\r\n  if (d.getElementById(id)) return;\r\n  js = d.createElement(s); js.id = id;\r\n  js.src = \"//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=323620764400430\";\r\n  fjs.parentNode.insertBefore(js, fjs);\r\n}(document, \'script\', \'facebook-jssdk\'));</script>', '', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shipping_cost`
--

CREATE TABLE `tbl_shipping_cost` (
  `shipping_cost_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `amount` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_shipping_cost`
--

INSERT INTO `tbl_shipping_cost` (`shipping_cost_id`, `country_id`, `amount`) VALUES
(1, 228, '11'),
(2, 167, '10'),
(3, 13, '8'),
(4, 230, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shipping_cost_all`
--

CREATE TABLE `tbl_shipping_cost_all` (
  `sca_id` int(11) NOT NULL,
  `amount` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_shipping_cost_all`
--

INSERT INTO `tbl_shipping_cost_all` (`sca_id`, `amount`) VALUES
(1, '100');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_size`
--

CREATE TABLE `tbl_size` (
  `size_id` int(11) NOT NULL,
  `size_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_size`
--

INSERT INTO `tbl_size` (`size_id`, `size_name`) VALUES
(2, 'S'),
(3, 'M'),
(4, 'L'),
(5, 'XL'),
(6, 'XXL'),
(7, '3XL'),
(8, '31'),
(9, '32'),
(10, '33'),
(11, '34'),
(12, '35'),
(13, '36'),
(14, '37'),
(15, '38'),
(16, '39'),
(17, '40'),
(18, '41'),
(19, '42'),
(20, '43'),
(21, '44'),
(22, '45'),
(23, '46'),
(24, '47'),
(25, '48'),
(26, 'Free Size'),
(27, 'One Size for All'),
(28, '10'),
(29, '12 Months'),
(30, '2T'),
(31, '3T'),
(32, '4T'),
(33, '5T'),
(34, '6 Years'),
(35, '7 Years'),
(36, '8 Years'),
(37, '10 Years'),
(38, '12 Years'),
(39, '14 Years'),
(40, '256 GB'),
(41, '128 GB'),
(42, '14 Plus'),
(43, '16 Plus'),
(44, '18 Plus'),
(45, 'xxs'),
(46, 'blue'),
(91, 'noir'),
(92, 'test'),
(93, '4xs'),
(95, '40ans'),
(96, 'XS');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `button_text` varchar(255) NOT NULL,
  `button_url` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`id`, `photo`, `heading`, `content`, `button_text`, `button_url`, `position`) VALUES
(1, 'slider-1.jpg', '', 'L\'avancée', 'En savoir plus', 'about.php', 'Right');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_social`
--

CREATE TABLE `tbl_social` (
  `social_id` int(11) NOT NULL,
  `social_name` varchar(30) NOT NULL,
  `social_url` varchar(255) NOT NULL,
  `social_icon` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_social`
--

INSERT INTO `tbl_social` (`social_id`, `social_name`, `social_url`, `social_icon`) VALUES
(1, 'Facebook', 'https://www.facebook.com/#', 'fa fa-facebook'),
(2, 'Twitter', 'https://www.twitter.com/#', 'fa fa-twitter'),
(3, 'LinkedIn', '', 'fa fa-linkedin'),
(4, 'Google Plus', '', 'fa fa-google-plus'),
(5, 'Pinterest', '', 'fa fa-pinterest'),
(6, 'YouTube', 'https://www.youtube.com/#', 'fa fa-youtube'),
(7, 'Instagram', 'https://www.instagram.com/#', 'fa fa-instagram'),
(8, 'Tumblr', '', 'fa fa-tumblr'),
(9, 'Flickr', '', 'fa fa-flickr'),
(10, 'Reddit', '', 'fa fa-reddit'),
(11, 'Snapchat', '', 'fa fa-snapchat'),
(12, 'WhatsApp', 'https://www.whatsapp.com/#', 'fa fa-whatsapp'),
(13, 'Quora', '', 'fa fa-quora'),
(14, 'StumbleUpon', '', 'fa fa-stumbleupon'),
(15, 'Delicious', '', 'fa fa-delicious'),
(16, 'Digg', '', 'fa fa-digg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscriber`
--

CREATE TABLE `tbl_subscriber` (
  `subs_id` int(11) NOT NULL,
  `subs_email` varchar(255) NOT NULL,
  `subs_date` varchar(100) NOT NULL,
  `subs_date_time` varchar(100) NOT NULL,
  `subs_hash` varchar(255) NOT NULL,
  `subs_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subscriber`
--

INSERT INTO `tbl_subscriber` (`subs_id`, `subs_email`, `subs_date`, `subs_date_time`, `subs_hash`, `subs_active`) VALUES
(2, 'kimberly@mail.com', '2022-03-20', '2022-03-20 10:26:07', '61f3af9cac686555a4bff9e565f88c47', 1),
(3, 'gregobn@mail.com', '2022-03-20', '2022-03-20 10:27:21', '72d6fc3a9e9ed33dfc30b10f4de82f34', 1),
(4, 'morgan.sarahh5@mail.com', '2022-03-20', '2022-03-20 10:27:48', 'bcdeda095a6c882803fc3aaf4a17f08e', 1),
(5, 'greenwd1154@mail.com', '2022-03-20', '2022-03-20 10:28:09', '279ecfe9debbb091c664641f534857ee', 1),
(6, 'awsm785@mail.com', '2022-03-20', '2022-03-20 10:28:21', '94096ae01fc65e71c50c7843d096e041', 1),
(7, 'younesch2000@mail.com', '2024-08-28', '2024-08-28 01:43:06', '9b42176701d81e14a5f3c3c8df79424c', 0),
(8, 'younesch2@mail.com', '2024-08-28', '2024-08-28 01:45:50', 'ff4d51dd2c936fbbf53fce8e90d43ae6', 0),
(14, 'younesch00@mail.com', '2024-08-28', '2024-08-28 01:50:16', 'efee5fa82bc0a3401d05886f20e00fdb', 1),
(15, 'youneschell2000@gmail.com', '2024-08-28', '2024-08-28 01:50:52', '35b990987987ab12a53ba6ae7cff8f31', 1),
(16, 'latbibenyakhou@gmail.com', '2025-05-19', '2025-05-19 05:55:58', '5059722d643a5ceb762c083d5551e011', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_top_category`
--

CREATE TABLE `tbl_top_category` (
  `tcat_id` int(11) NOT NULL,
  `tcat_name` varchar(255) NOT NULL,
  `show_on_menu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_top_category`
--

INSERT INTO `tbl_top_category` (`tcat_id`, `tcat_name`, `show_on_menu`) VALUES
(1, 'HAUT DE MAILLOT', 1),
(11, 'BAS DE MAILLOT', 1),
(12, 'UNE PIÉCE', 1),
(13, 'BANDEAU', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(10) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `role` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `full_name`, `email`, `phone`, `password`, `photo`, `role`, `status`) VALUES
(1, 'Administrator', 'admin@mail.com', '0556502057', 'ba97dc2f7eb2f4014a250fee92718a73', 'user-1.png', 'Super Admin', 'Active'),
(5, 'admin2', 'admin2@mail.com', '', '712de6fedcf8002b6a2185b0deef969c', '', 'Admin', 'Active'),
(6, 'admin3', 'admin3@mail.com', '', 'f18d728469ef4f76ea324e7886b9a1ca', '', 'Admin', 'Active'),
(7, 'admin4', 'admin4@mail.com', '', '0f16f83f885e58ed957bcf365913e17d', '', 'Admin', 'Active'),
(8, 'admin5', 'admin5@mail.com', '', '4d0d5ad094e5c36606fa39cf45acb931', '', 'Admin', 'Active'),
(9, 'admin6', 'admin6@mail.com', '', '351bd4a7f46515e5476ba2ca6deb641b', '', 'Admin', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_video`
--

CREATE TABLE `tbl_video` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `iframe_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_video`
--

INSERT INTO `tbl_video` (`id`, `title`, `iframe_code`) VALUES
(1, 'Video 1', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/L3XAFSMdVWU\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>'),
(2, 'Video 2', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/sinQ06YzbJI\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>'),
(4, 'Video 3', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/ViZNgU-Yt-Y\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_color`
--
ALTER TABLE `tbl_color`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `tbl_country`
--
ALTER TABLE `tbl_country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `tbl_end_category`
--
ALTER TABLE `tbl_end_category`
  ADD PRIMARY KEY (`ecat_id`);

--
-- Indexes for table `tbl_mid_category`
--
ALTER TABLE `tbl_mid_category`
  ADD PRIMARY KEY (`mcat_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_photo`
--
ALTER TABLE `tbl_photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `tbl_product_color`
--
ALTER TABLE `tbl_product_color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product_photo`
--
ALTER TABLE `tbl_product_photo`
  ADD PRIMARY KEY (`pp_id`);

--
-- Indexes for table `tbl_product_size`
--
ALTER TABLE `tbl_product_size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_service`
--
ALTER TABLE `tbl_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_size`
--
ALTER TABLE `tbl_size`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subscriber`
--
ALTER TABLE `tbl_subscriber`
  ADD PRIMARY KEY (`subs_id`);

--
-- Indexes for table `tbl_top_category`
--
ALTER TABLE `tbl_top_category`
  ADD PRIMARY KEY (`tcat_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_color`
--
ALTER TABLE `tbl_color`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_country`
--
ALTER TABLE `tbl_country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_end_category`
--
ALTER TABLE `tbl_end_category`
  MODIFY `ecat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_mid_category`
--
ALTER TABLE `tbl_mid_category`
  MODIFY `mcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tbl_photo`
--
ALTER TABLE `tbl_photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_product_color`
--
ALTER TABLE `tbl_product_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT for table `tbl_product_photo`
--
ALTER TABLE `tbl_product_photo`
  MODIFY `pp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `tbl_product_size`
--
ALTER TABLE `tbl_product_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=459;

--
-- AUTO_INCREMENT for table `tbl_service`
--
ALTER TABLE `tbl_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_size`
--
ALTER TABLE `tbl_size`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_subscriber`
--
ALTER TABLE `tbl_subscriber`
  MODIFY `subs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_top_category`
--
ALTER TABLE `tbl_top_category`
  MODIFY `tcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
