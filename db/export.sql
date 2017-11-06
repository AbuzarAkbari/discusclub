-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 06, 2017 at 03:28 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `title`, `created_at`, `user_id`, `deleted_at`) VALUES
(1, 'dinges', '2017-11-06 15:25:47', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `album_reply`
--

CREATE TABLE `album_reply` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `last_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `album_reply`
--

INSERT INTO `album_reply` (`id`, `user_id`, `album_id`, `content`, `created_at`, `deleted_at`, `last_changed`) VALUES
(1, 2, 1, 'geile fotos jonge', '2017-11-06 15:25:47', NULL, '2017-11-06 15:25:47');

-- --------------------------------------------------------

--
-- Table structure for table `approval_signup`
--

CREATE TABLE `approval_signup` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aquarium`
--

CREATE TABLE `aquarium` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aquarium_reply`
--

CREATE TABLE `aquarium_reply` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `last_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `aquarium_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Mededelingen en Nieuws'),
(2, 'Discus Vissen'),
(3, 'Wat nergens thuishoort'),
(4, 'Foto album (Toon hier uw foto\'s)'),
(5, 'Handel'),
(6, 'Discus Club Holland');

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `forgot`
--

CREATE TABLE `forgot` (
  `id` int(11) NOT NULL,
  `token` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `path` text NOT NULL,
  `album_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `path`, `album_id`) VALUES
(1, '/default.png', NULL),
(2, '/sponsor/ESHA-Banner_NL_discus_03B15.gif', NULL),
(3, '/sponsor/discusmania-toekan.gif', NULL),
(4, '/sponsor/banner-HVP-Aqua.gif', NULL),
(5, '/sponsor/Veldhuis-banner.jpg', NULL),
(6, '/sponsor/Dicuscompleet-banner.jpg', NULL),
(7, '/sponsor/discuspassi-banner-3.jpg', NULL),
(8, '/sponsor/Discusshop-banner.jpg', NULL),
(9, '/sponsor/Aqua-light-banner.jpg', NULL),
(10, '/sponsor/Rockzolid-banner.jpg', NULL),
(11, '/sponsor/osmoseapparaat-banner.jpg', NULL),
(12, '/sponsor/Wesdijk-banner.jpg', NULL),
(13, '/sponsor/Koidream-banner.jpg', NULL),
(14, '/sponsor/DCH-banner-AquaVaria-2014.jpg', NULL),
(15, '/sponsor/RUTO-banner.jpg', NULL),
(16, '/sponsor/discusvistotaal.gif', NULL),
(17, '/messenger_background/default.jpg', NULL),
(18, '/default.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ip`
--

CREATE TABLE `ip` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ip`
--

INSERT INTO `ip` (`id`, `ip_address`, `blocked`, `user_id`, `created_at`) VALUES
(1, '127.0.0.1', 0, NULL, '2017-11-06 15:26:52'),
(2, '127.0.0.1', 0, 1, '2017-11-06 15:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `opened` tinyint(1) NOT NULL DEFAULT '0',
  `user_id_1` int(11) NOT NULL,
  `user_id_2` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `message`, `created_at`, `opened`, `user_id_1`, `user_id_2`, `image_id`) VALUES
(1, 'bla', '2017-11-06 15:25:47', 0, 1, 2, NULL),
(2, 'dinges', '2017-11-06 15:25:47', 0, 2, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `last_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `sub_category_id`, `title`, `content`, `created_at`, `last_changed`, `deleted_at`) VALUES
(1, 1, 'dinges enzo', 'bla bla bla...', '2017-11-06 15:25:47', '2017-11-06 15:25:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news_reply`
--

CREATE TABLE `news_reply` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `news_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `last_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news_reply`
--

INSERT INTO `news_reply` (`id`, `user_id`, `content`, `news_id`, `created_at`, `deleted_at`, `last_changed`) VALUES
(1, 1, 'reactie dinges enzo bla bla', 1, '2017-11-06 15:25:47', NULL, '2017-11-06 15:25:47');

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `topic_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `last_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'gast'),
(2, 'gebruiker'),
(3, 'lid'),
(4, 'redacteur'),
(5, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

CREATE TABLE `sponsor` (
  `id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `url` varchar(256) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `option` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sponsor`
--

INSERT INTO `sponsor` (`id`, `image_id`, `name`, `url`, `created_at`, `deleted_at`, `approved`, `option`) VALUES
(1, 2, 'eSHa Aquariumproducten', 'http://www.eshalabs.eu/nederlands/', '2017-11-06 15:25:47', NULL, 0, 1),
(2, 3, 'discus mania', 'http://discusmania.nl/', '2017-11-06 15:25:47', NULL, 0, 1),
(3, 4, 'hvp aqua', 'http://www.hvpaqua.nl/', '2017-11-06 15:25:47', NULL, 0, 1),
(4, 5, 'aquaria veldhuis', 'https://www.aquariaveldhuis.nl/nl/', '2017-11-06 15:25:47', NULL, 0, 1),
(5, 7, 'discus passie', 'http://www.discuspassie.nl/', '2017-11-06 15:25:47', NULL, 0, 1),
(6, 8, 'discusshop', 'https://discusshop.nl/', '2017-11-06 15:25:47', NULL, 0, 1),
(7, 9, 'jmd aqua light', 'http://www.jmbaqualight.nl/', '2017-11-06 15:25:47', NULL, 0, 1),
(8, 10, 'rock zolid', 'http://www.rockzolid.nl/', '2017-11-06 15:25:47', NULL, 0, 1),
(9, 11, 'osmose apparaat', 'https://www.osmoseapparaat.nl/', '2017-11-06 15:25:47', NULL, 0, 1),
(10, 12, 'Wesdijk', 'https://www.wesdijk.nl/', '2017-11-06 15:25:47', NULL, 0, 1),
(11, 13, 'koidream', 'https://www.koidream.com/', '2017-11-06 15:25:47', NULL, 0, 1),
(12, 14, 'daphnia boxtel', 'http://www.daphniaboxtel.nl/', '2017-11-06 15:25:47', NULL, 0, 1),
(13, 15, 'ruto', 'https://www.ruto.nl/', '2017-11-06 15:25:47', NULL, 0, 1),
(14, 16, 'discus vis totaal', 'http://www.discusvistotaal.nl/', '2017-11-06 15:25:47', NULL, 0, 1),
(15, 6, 'Discuscompleet', 'http://www.discuscompleet.nl/', '2017-11-06 15:25:47', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `name`) VALUES
(1, 'open'),
(2, 'closed'),
(3, 'pinned');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `category_id`, `name`, `description`) VALUES
(1, 1, 'Mededelingen', 'Hier worden mededelingen neergezet die betrekking hebben over de veranderingen en problemen met de website. Lees eerst hier voordat u berichten plaatst.'),
(2, 2, 'Algemene Discusvis vragen', 'Heeft U een vraag stel hem hier.'),
(3, 3, 'Off Topic', 'Hier kan alles geplaatst worden wat nergens anders onder valt.'),
(4, 4, 'Foto Album', 'Plaats hier uw aquarium foto\'s'),
(5, 5, 'Te Koop', 'Heeft u als particulier iets te koop, dan kunt u hier een advertentie plaatsen. Alle advertenties die alleen verwijzen naar een commerciële websites, niet bestaande URL\'s of ouder zijn dan een maand worden verwijderd!'),
(6, 6, 'Open Nederlands Kampioenschap Discusvissen 2013', 'Informatie en mededelingen over de Daphnia aquariumbeurs 2013 & Open Nederlands Kampioenschap Discusvissen 2013'),
(7, 1, 'Even voorstellen', 'Een plek waar U zich als medegebruiker van dit forum zichzelf kan voorstellen.');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `state_id` int(11) NOT NULL DEFAULT '1',
  `last_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`id`, `sub_category_id`, `title`, `user_id`, `content`, `created_at`, `state_id`, `last_changed`, `deleted_at`) VALUES
(1, 1, 'Nieuwe website DCH', 1, '\"Het Water Gala\" komt met rasse schreden dichterbij, binnen iets meer dan een maand is het zo ver!\r\n\r\nEen beurs als deze is niet mogelijk zonder eerst vele handjes te hebben die helpen om op te bouwen.\r\nEr zijn inmiddels een flink aantal mensen die het kunnen beamen: meehelpen aan het opbouwen van dergelijke grootse beurs is een flinke karwij, is lastig, maar het belangrijkste is misschien: het is zo fantastisch mensen achter de schermen te leren kennen, je leert er zelf dingen bij, je leert interessante mensen kennen die je op vlak van de hobby best wel nog kunt contacteren later.\r\n\r\nWelnu, wij hadden jullie er graag bij gehad om te helpen!\r\n\r\nHeb je interesse om te komen helpen op onderstaande data, dan kunnen wij garanderen dat jijzelf achteraf vol fier en trots zal kunnen zeggen: ik heb meegeholpen aan die mega beurs, wat de vele duizenden bezoekers gaan zien, welnu, dat is deels mijn werk!\r\n\r\n\r\nKunt u zich vrij maken op :\r\n\r\nMaandag 19 september (belangrijk)\r\ndinsdag 20 september (belangrijk)\r\nwoensdag 21 september\r\ndonderdag 22 september\r\nvrijdag 23 september\r\n\r\nmaandag 26 september (super belangrijk, de afbraak moet op één dag kunnen gebeuren, hier hebben we NOOIT handen teveel!!!)\r\n\r\nGraag dan een seintje naar iemand van het bestuur, hetzij hier, hetzij via privé bericht, sms, email, facebook ah, van ons part mogen jullie zelfs te tamtam en rooksignalen gebruiken, zolang wij maar weten dat wij op jullie kunnen rekenen!\r\n\r\nNiet alleen namens het ganse bestuur, maar vooral namens een paar duizend bezoekers danken wij jullie alvast van harte voor de hulp!!!!', '2017-10-16 12:35:24', 3, '2017-10-16 12:35:24', NULL),
(2, 1, 'test topic', 1, 'bla', '2017-10-18 08:57:41', 1, '2017-10-18 08:57:41', NULL),
(3, 1, 'Nieuw test topic', 1, '<p>fdsfsdfsdfsdfgsdfsd</p>', '2017-10-18 10:44:06', 1, '2017-10-18 10:44:06', NULL),
(4, 1, 'een nieuw test topic', 1, '<p><i>sdujfnsdipfpoakfdnfjksdnf</i></p>', '2017-10-18 10:44:42', 1, '2017-10-18 10:44:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `first_name` varchar(256) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '2',
  `created_at` timestamp NULL DEFAULT NULL,
  `last_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `signature` text,
  `birthdate` date DEFAULT NULL,
  `city` varchar(256) DEFAULT NULL,
  `profile_img` int(11) NOT NULL DEFAULT '1',
  `news` tinyint(1) NOT NULL DEFAULT '0',
  `messenger_img` int(11) NOT NULL DEFAULT '17',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `postal_code` varchar(6) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `iban` varchar(20) DEFAULT NULL,
  `house_number` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `first_name`, `last_name`, `username`, `password`, `role_id`, `created_at`, `last_changed`, `signature`, `birthdate`, `city`, `profile_img`, `news`, `messenger_img`, `deleted_at`, `address`, `postal_code`, `phone`, `iban`, `house_number`) VALUES
(1, 'john_doe@example.com', 'john', 'doe', 'test', '$2y$10$9UNJC27kiVGmXrn5WUeyPeSktXXF1uTRE2mX8bgOISy2GTLC57pBm', 5, '2017-11-06 15:25:47', '2017-11-06 15:28:03', NULL, NULL, NULL, 1, 0, 17, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'jane_doe@example.com', 'jane', 'doe', 'bla', '$2y$10$9UNJC27kiVGmXrn5WUeyPeSktXXF1uTRE2mX8bgOISy2GTLC57pBm', 5, '2017-11-06 15:25:47', '2017-11-06 15:25:47', NULL, NULL, NULL, 1, 0, 17, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `view`
--

CREATE TABLE `view` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic_id` int(11) NOT NULL,
  `ip_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_album_user1_idx` (`user_id`);

--
-- Indexes for table `album_reply`
--
ALTER TABLE `album_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_album_reply_user1_idx` (`user_id`),
  ADD KEY `fk_album_reply_album1_idx` (`album_id`);

--
-- Indexes for table `approval_signup`
--
ALTER TABLE `approval_signup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_approval_signup_user1_idx` (`user_id`);

--
-- Indexes for table `aquarium`
--
ALTER TABLE `aquarium`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_aquarium_user1_idx` (`user_id`);

--
-- Indexes for table `aquarium_reply`
--
ALTER TABLE `aquarium_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_aquarium_reply_user1_idx` (`user_id`),
  ADD KEY `fk_aquarium_reply_aquarium1_idx` (`aquarium_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`user_id`,`topic_id`),
  ADD KEY `fk_user_has_topics_topics1_idx` (`topic_id`),
  ADD KEY `fk_user_has_topics_user1_idx` (`user_id`);

--
-- Indexes for table `forgot`
--
ALTER TABLE `forgot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_forgot_user1_idx` (`user_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_image_album1_idx` (`album_id`);

--
-- Indexes for table `ip`
--
ALTER TABLE `ip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ip_user1_idx` (`user_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_message_user1_idx` (`user_id_1`),
  ADD KEY `fk_message_user2_idx` (`user_id_2`),
  ADD KEY `fk_message_image1_idx` (`image_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_news_sub_category1_idx` (`sub_category_id`);

--
-- Indexes for table `news_reply`
--
ALTER TABLE `news_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_news_reply_user1_idx` (`user_id`),
  ADD KEY `fk_news_reply_news1_idx` (`news_id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reply_user1_idx` (`user_id`),
  ADD KEY `fk_reply_topics1_idx` (`topic_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sponsor_image1_idx` (`image_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sub_categorieen_categorieen1_idx` (`category_id`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_topics_sub_categorieen1_idx` (`sub_category_id`),
  ADD KEY `fk_topics_user1_idx` (`user_id`),
  ADD KEY `fk_topics_state1_idx` (`state_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD KEY `fk_user_role1_idx` (`role_id`),
  ADD KEY `fk_user_image1_idx` (`profile_img`),
  ADD KEY `fk_user_image2_idx` (`messenger_img`);

--
-- Indexes for table `view`
--
ALTER TABLE `view`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_aantal_bekeken_topics1_idx` (`topic_id`),
  ADD KEY `fk_ips_ip1_idx` (`ip_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `album_reply`
--
ALTER TABLE `album_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `approval_signup`
--
ALTER TABLE `approval_signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aquarium`
--
ALTER TABLE `aquarium`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aquarium_reply`
--
ALTER TABLE `aquarium_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `forgot`
--
ALTER TABLE `forgot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ip`
--
ALTER TABLE `ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `news_reply`
--
ALTER TABLE `news_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `view`
--
ALTER TABLE `view`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `fk_album_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `album_reply`
--
ALTER TABLE `album_reply`
  ADD CONSTRAINT `fk_album_reply_album1` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_album_reply_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `approval_signup`
--
ALTER TABLE `approval_signup`
  ADD CONSTRAINT `fk_approval_signup_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `aquarium`
--
ALTER TABLE `aquarium`
  ADD CONSTRAINT `fk_aquarium_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `aquarium_reply`
--
ALTER TABLE `aquarium_reply`
  ADD CONSTRAINT `fk_aquarium_reply_aquarium1` FOREIGN KEY (`aquarium_id`) REFERENCES `aquarium` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_aquarium_reply_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `fk_user_has_topics_topics1` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_has_topics_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `forgot`
--
ALTER TABLE `forgot`
  ADD CONSTRAINT `fk_forgot_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_image_album1` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ip`
--
ALTER TABLE `ip`
  ADD CONSTRAINT `fk_ip_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_message_image1` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_message_user1` FOREIGN KEY (`user_id_1`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_message_user2` FOREIGN KEY (`user_id_2`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `fk_news_sub_category1` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `news_reply`
--
ALTER TABLE `news_reply`
  ADD CONSTRAINT `fk_news_reply_news1` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_news_reply_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `fk_reply_topics1` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reply_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD CONSTRAINT `fk_sponsor_image1` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `fk_sub_categorieen_categorieen1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `fk_topics_state1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_topics_sub_categorieen1` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_topics_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_image1` FOREIGN KEY (`profile_img`) REFERENCES `image` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_image2` FOREIGN KEY (`messenger_img`) REFERENCES `image` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `view`
--
ALTER TABLE `view`
  ADD CONSTRAINT `fk_aantal_bekeken_topics1` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ips_ip1` FOREIGN KEY (`ip_id`) REFERENCES `ip` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
