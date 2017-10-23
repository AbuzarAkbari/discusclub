-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2017 at 11:51 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

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
-- Table structure for table `aantal_bekeken`
--

CREATE TABLE `aantal_bekeken` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_adres` varchar(50) NOT NULL,
  `bekeken_op` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aantal_bekeken`
--

INSERT INTO `aantal_bekeken` (`id`, `topic_id`, `user_id`, `ip_adres`, `bekeken_op`) VALUES
(1, 1, 1, '::1', '2017-10-13 12:07:07'),
(2, 1, 1, '::1', '2017-10-13 13:02:15'),
(3, 1, 1, '::1', '2017-10-13 13:07:27'),
(4, 1, 1, '::1', '2017-10-13 13:14:36'),
(5, 1, 1, '::1', '2017-10-18 13:52:46'),
(6, 1, 1, '::1', '2017-10-18 13:52:46'),
(7, 1, 1, '::1', '2017-10-18 13:52:46'),
(8, 1, 1, '::1', '2017-10-18 13:52:46'),
(9, 1, 1, '::1', '2017-10-18 13:52:55'),
(10, 1, 1, '::1', '2017-10-18 13:52:55'),
(11, 1, 1, '::1', '2017-10-18 13:52:56'),
(12, 1, 1, '::1', '2017-10-18 13:52:56'),
(13, 1, 1, '::1', '2017-10-18 13:52:56'),
(14, 1, 1, '::1', '2017-10-18 13:52:56'),
(15, 1, 1, '::1', '2017-10-18 13:52:56'),
(16, 1, 1, '::1', '2017-10-18 13:52:57'),
(17, 1, 1, '::1', '2017-10-18 13:52:57'),
(18, 1, 1, '::1', '2017-10-18 13:52:57'),
(19, 1, 1, '::1', '2017-10-18 13:52:57'),
(20, 1, 1, '::1', '2017-10-18 13:52:57'),
(21, 1, 1, '::1', '2017-10-18 13:55:00'),
(22, 1, 1, '::1', '2017-10-18 13:55:01'),
(23, 1, 1, '::1', '2017-10-18 13:55:02'),
(24, 1, 1, '::1', '2017-10-18 14:01:05'),
(25, 1, 1, '::1', '2017-10-18 14:01:12'),
(26, 1, 1, '::1', '2017-10-18 14:01:18'),
(27, 1, 1, '::1', '2017-10-18 14:01:25'),
(28, 1, 1, '::1', '2017-10-18 14:03:43'),
(29, 1, 1, '::1', '2017-10-18 14:03:56'),
(30, 1, 1, '::1', '2017-10-18 14:04:13'),
(31, 1, 1, '::1', '2017-10-18 14:05:00'),
(32, 1, 1, '::1', '2017-10-18 14:05:39'),
(33, 1, 1, '::1', '2017-10-18 14:05:51'),
(34, 1, 1, '::1', '2017-10-18 14:06:19'),
(35, 1, 1, '::1', '2017-10-18 14:08:26'),
(36, 1, 1, '::1', '2017-10-18 14:08:40'),
(37, 1, 1, '::1', '2017-10-18 14:08:49'),
(38, 1, 1, '::1', '2017-10-18 14:08:55'),
(39, 1, 1, '::1', '2017-10-18 14:09:03'),
(40, 1, 1, '::1', '2017-10-18 14:10:35'),
(41, 1, 1, '::1', '2017-10-18 14:10:39'),
(42, 1, 1, '::1', '2017-10-18 14:10:46'),
(43, 1, 1, '::1', '2017-10-18 14:11:56'),
(44, 1, 1, '::1', '2017-10-18 14:12:06'),
(45, 2, 1, '::1', '2017-10-18 14:13:58'),
(46, 2, 1, '::1', '2017-10-18 14:14:11'),
(47, 2, 1, '::1', '2017-10-18 14:15:01'),
(48, 2, 1, '::1', '2017-10-18 14:15:24'),
(49, 1, 1, '::1', '2017-10-18 14:15:36'),
(50, 4, 1, '::1', '2017-10-18 14:18:06'),
(51, 4, 1, '::1', '2017-10-18 14:18:11'),
(52, 1, 1, '::1', '2017-10-18 14:26:27'),
(53, 1, 1, '::1', '2017-10-18 14:32:12'),
(54, 1, 1, '::1', '2017-10-18 14:33:12'),
(55, 1, 1, '::1', '2017-10-18 14:33:28'),
(56, 5, 1, '::1', '2017-10-18 14:53:51'),
(57, 5, 1, '::1', '2017-10-18 14:53:54'),
(58, 1, 1, '::1', '2017-10-23 09:33:36'),
(59, 1, 1, '::1', '2017-10-23 09:33:54'),
(60, 1, 1, '::1', '2017-10-23 09:48:58');

-- --------------------------------------------------------

--
-- Table structure for table `berichten`
--

CREATE TABLE `berichten` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `bericht` text NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berichten`
--

INSERT INTO `berichten` (`id`, `topic_id`, `bericht`, `datum`) VALUES
(1, 1, 'Beste allen,\r\n\r\nWe zijn reeds een 6-tal maanden bezig met de opbouw van een geheel nieuwe DCH website.\r\nDit werd reeds aangekondigd in het clubblad, maar nu dus ook voor iedereen.\r\n\r\nAangezien dit een \"rotklus\" is neemt dat wel wat tijd in beslag.\r\nIndien er vrijwilligers zijn om hun mening te geven (via privé communicatie) die wel wat kennen van websites, dan hoor ik graag (via privé bericht)\r\n\r\nIk ben niet op zoek naar 100 mensen of zo, gewoon, het oogpunt van enkele leden is al meer dan welkom.\r\n\r\n\r\nDominique', '2017-10-13 11:43:26'),
(2, 1, 'De eerste personen hebben al een kijkje genomen en mening gegeven.\r\n\r\nAls er nog liefhebbers zijn hoor ik het graag.', '2017-10-13 11:49:32'),
(3, 1, 'klinkt gezellig.', '2017-10-13 12:04:20'),
(4, 1, 'test bericht', '2017-10-18 11:21:09');

-- --------------------------------------------------------

--
-- Table structure for table `categorieen`
--

CREATE TABLE `categorieen` (
  `id` int(11) NOT NULL,
  `categorie_naam` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorieen`
--

INSERT INTO `categorieen` (`id`, `categorie_naam`) VALUES
(1, 'Mededelingen en Nieuws'),
(2, 'Discus Vissen'),
(3, 'Wat nergens thuishoort'),
(4, 'Foto album (Toon hier uw foto\'s)'),
(5, 'Handel'),
(6, 'Discus Club Holland');

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `reply_auteur` varchar(255) NOT NULL,
  `reply_content` text NOT NULL,
  `reply_datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`id`, `topic_id`, `reply_auteur`, `reply_content`, `reply_datum`) VALUES
(2, 1, 'John Doe', '1', '2017-10-18 11:46:41'),
(3, 1, 'John Doe', 'asdasdas', '2017-10-18 11:51:00'),
(4, 2, 'John Doe', '&lt;p&gt;test bericht antwoord geval&lt;/p&gt;', '2017-10-18 14:14:11'),
(5, 4, 'John Doe', '<p>fruihsdfasdukfhisdjiuashiudhasiusdf</p>', '2017-10-18 14:18:11'),
(6, 5, 'John Doe', '<p>efdsfsdasdasdas</p>', '2017-10-18 14:53:54'),
(7, 1, 'John Doe', '<p>asfsdgfdgfasdasdafds</p>', '2017-10-23 09:33:43');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categorieen`
--

CREATE TABLE `sub_categorieen` (
  `id` int(11) NOT NULL,
  `sub_categorie_icon` varchar(100) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `sub_categorie_naam` varchar(100) NOT NULL,
  `sub_categorie_omschrijving` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_categorieen`
--

INSERT INTO `sub_categorieen` (`id`, `sub_categorie_icon`, `categorie_id`, `sub_categorie_naam`, `sub_categorie_omschrijving`) VALUES
(1, '<span class=\"glyphicon glyphicon-th-list\"></span>', 1, 'Mededelingen', 'Hier worden mededelingen neergezet die betrekking hebben over de veranderingen en problemen met de website. Lees eerst hier voordat u berichten plaatst.'),
(2, '<span class=\"glyphicon glyphicon-th-list\"></span>', 2, 'Algemene Discusvis vragen', 'Heeft U een vraag stel hem hier.'),
(3, '<span class=\"glyphicon glyphicon-th-list\"></span>', 3, 'Off Topic', 'Hier kan alles geplaatst worden wat nergens anders onder valt.'),
(4, '<span class=\"glyphicon glyphicon-th-list\"></span>', 4, 'Foto Album', 'Plaats hier uw aquarium foto\'s'),
(5, '<span class=\"glyphicon glyphicon-th-list\"></span>', 5, 'Te Koop', 'Heeft u als particulier iets te koop, dan kunt u hier een advertentie plaatsen. Alle advertenties die alleen verwijzen naar een commerciële websites, niet bestaande URL\'s of ouder zijn dan een maand worden verwijderd!'),
(6, '<span class=\"glyphicon glyphicon-th-list\"></span>', 6, 'Open Nederlands Kampioenschap Discusvissen 2013', 'Informatie en mededelingen over de Daphnia aquariumbeurs 2013 & Open Nederlands Kampioenschap Discusvissen 2013'),
(7, '<span class=\"glyphicon glyphicon-th-list\"></span>', 1, 'Even voorstellen', 'Een plek waar U zich als medegebruiker van dit forum zichzelf kan voorstellen.');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `sub_categorie_id` int(11) NOT NULL,
  `topic_icon` varchar(100) NOT NULL DEFAULT '<span class="glyphicon glyphicon-file"></span>',
  `topic_titel` varchar(100) NOT NULL,
  `topic_auteur` varchar(100) NOT NULL,
  `topic_content` text NOT NULL,
  `post_datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `sub_categorie_id`, `topic_icon`, `topic_titel`, `topic_auteur`, `topic_content`, `post_datum`) VALUES
(1, 1, '<span class=\"glyphicon glyphicon-file\"></span>', 'Nieuwe website DCH', 'Dominique Maes', '\"Het Water Gala\" komt met rasse schreden dichterbij, binnen iets meer dan een maand is het zo ver!\r\n\r\nEen beurs als deze is niet mogelijk zonder eerst vele handjes te hebben die helpen om op te bouwen.\r\nEr zijn inmiddels een flink aantal mensen die het kunnen beamen: meehelpen aan het opbouwen van dergelijke grootse beurs is een flinke karwij, is lastig, maar het belangrijkste is misschien: het is zo fantastisch mensen achter de schermen te leren kennen, je leert er zelf dingen bij, je leert interessante mensen kennen die je op vlak van de hobby best wel nog kunt contacteren later.\r\n\r\nWelnu, wij hadden jullie er graag bij gehad om te helpen!\r\n\r\nHeb je interesse om te komen helpen op onderstaande data, dan kunnen wij garanderen dat jijzelf achteraf vol fier en trots zal kunnen zeggen: ik heb meegeholpen aan die mega beurs, wat de vele duizenden bezoekers gaan zien, welnu, dat is deels mijn werk!\r\n\r\n\r\nKunt u zich vrij maken op :\r\n\r\nMaandag 19 september (belangrijk)\r\ndinsdag 20 september (belangrijk)\r\nwoensdag 21 september\r\ndonderdag 22 september\r\nvrijdag 23 september\r\n\r\nmaandag 26 september (super belangrijk, de afbraak moet op één dag kunnen gebeuren, hier hebben we NOOIT handen teveel!!!)\r\n\r\nGraag dan een seintje naar iemand van het bestuur, hetzij hier, hetzij via privé bericht, sms, email, facebook ah, van ons part mogen jullie zelfs te tamtam en rooksignalen gebruiken, zolang wij maar weten dat wij op jullie kunnen rekenen!\r\n\r\nNiet alleen namens het ganse bestuur, maar vooral namens een paar duizend bezoekers danken wij jullie alvast van harte voor de hulp!!!!', '2017-10-16 14:35:24'),
(2, 1, '<span class=\"glyphicon glyphicon-file\"></span>', 'test topic', 'test', 'test content', '2017-10-18 10:57:41'),
(4, 1, '<span class=\"glyphicon glyphicon-file\"></span>', 'Nieuw test topic', 'John Doe', '<p>fdsfsdfsdfsdfgsdfsd</p>', '2017-10-18 12:44:06'),
(5, 1, '<span class=\"glyphicon glyphicon-file\"></span>', 'een nieuw test topic', 'John Doe', '<p><i>sdujfnsdipfpoakfdnfjksdnf</i></p>', '2017-10-18 12:44:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aantal_bekeken`
--
ALTER TABLE `aantal_bekeken`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `berichten`
--
ALTER TABLE `berichten`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorieen`
--
ALTER TABLE `categorieen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categorieen`
--
ALTER TABLE `sub_categorieen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aantal_bekeken`
--
ALTER TABLE `aantal_bekeken`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `berichten`
--
ALTER TABLE `berichten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `categorieen`
--
ALTER TABLE `categorieen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `sub_categorieen`
--
ALTER TABLE `sub_categorieen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `aantal_bekeken`
--
ALTER TABLE `aantal_bekeken`
  ADD CONSTRAINT `aantal_bekeken_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
