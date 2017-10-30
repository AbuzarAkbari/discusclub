INSERT INTO `role`(`name`) VALUES
('gast'),
('gebruiker'),
('lid'),
('redacteur'),
('admin');

INSERT INTO `image`(`path`) VALUES
('http://via.placeholder.com/350x350'),
('/images/sponsor/ESHA-Banner_NL_discus_03B15.gif'),
('/images/sponsor/discusmania-toekan.gif'),
('/images/sponsor/banner-HVP-Aqua.gif'),
('/images/sponsor/Veldhuis-banner.jpg'),
('/images/sponsor/Dicuscompleet-banner.jpg'),
('/images/sponsor/discuspassi-banner-3.jpg'),
('/images/sponsor/Discusshop-banner.jpg'),
('/images/sponsor/Aqua-light-banner.jpg'),
('/images/sponsor/Rockzolid-banner.jpg'),
('/images/sponsor/osmoseapparaat-banner.jpg'),
('/images/sponsor/Wesdijk-banner.jpg'),
('/images/sponsor/Koidream-banner.jpg'),
('/images/sponsor/DCH-banner-AquaVaria-2014.jpg'),
('/images/sponsor/RUTO-banner.jpg'),
('/images/sponsor/discusvistotaal.gif');

INSERT INTO `user` (`first_name`, `last_name`, `email`, `username`, `password`, `role_id`) VALUES
('john', 'doe', 'john_doe@example.com', 'test', '$2y$10$9UNJC27kiVGmXrn5WUeyPeSktXXF1uTRE2mX8bgOISy2GTLC57pBm', 5),
('jane', 'doe', 'jane_doe@example.com', 'bla', '$2y$10$9UNJC27kiVGmXrn5WUeyPeSktXXF1uTRE2mX8bgOISy2GTLC57pBm', 5);

INSERT INTO `category` (`name`) VALUES
('Mededelingen en Nieuws'),
('Discus Vissen'),
('Wat nergens thuishoort'),
('Foto album (Toon hier uw foto\'s)'),
('Handel'),
('Discus Club Holland');

INSERT INTO `sub_category` (`category_id`, `name`, `description`) VALUES
(1, 'Mededelingen', 'Hier worden mededelingen neergezet die betrekking hebben over de veranderingen en problemen met de website. Lees eerst hier voordat u berichten plaatst.'),
(2, 'Algemene Discusvis vragen', 'Heeft U een vraag stel hem hier.'),
(3, 'Off Topic', 'Hier kan alles geplaatst worden wat nergens anders onder valt.'),
(4, 'Foto Album', 'Plaats hier uw aquarium foto\'s'),
(5, 'Te Koop', 'Heeft u als particulier iets te koop, dan kunt u hier een advertentie plaatsen. Alle advertenties die alleen verwijzen naar een commerciële websites, niet bestaande URL\'s of ouder zijn dan een maand worden verwijderd!'),
(6, 'Open Nederlands Kampioenschap Discusvissen 2013', 'Informatie en mededelingen over de Daphnia aquariumbeurs 2013 & Open Nederlands Kampioenschap Discusvissen 2013'),
(1, 'Even voorstellen', 'Een plek waar U zich als medegebruiker van dit forum zichzelf kan voorstellen.');

INSERT INTO `state` (`name`) VALUES
('open'),
('closed'),
('pinned');

INSERT INTO `topic` (`sub_category_id`, `title`, `user_id`, `content`, `created_at`, `last_changed`) VALUES
(1, 'Nieuwe website DCH', 1, '\"Het Water Gala\" komt met rasse schreden dichterbij, binnen iets meer dan een maand is het zo ver!\r\n\r\nEen beurs als deze is niet mogelijk zonder eerst vele handjes te hebben die helpen om op te bouwen.\r\nEr zijn inmiddels een flink aantal mensen die het kunnen beamen: meehelpen aan het opbouwen van dergelijke grootse beurs is een flinke karwij, is lastig, maar het belangrijkste is misschien: het is zo fantastisch mensen achter de schermen te leren kennen, je leert er zelf dingen bij, je leert interessante mensen kennen die je op vlak van de hobby best wel nog kunt contacteren later.\r\n\r\nWelnu, wij hadden jullie er graag bij gehad om te helpen!\r\n\r\nHeb je interesse om te komen helpen op onderstaande data, dan kunnen wij garanderen dat jijzelf achteraf vol fier en trots zal kunnen zeggen: ik heb meegeholpen aan die mega beurs, wat de vele duizenden bezoekers gaan zien, welnu, dat is deels mijn werk!\r\n\r\n\r\nKunt u zich vrij maken op :\r\n\r\nMaandag 19 september (belangrijk)\r\ndinsdag 20 september (belangrijk)\r\nwoensdag 21 september\r\ndonderdag 22 september\r\nvrijdag 23 september\r\n\r\nmaandag 26 september (super belangrijk, de afbraak moet op één dag kunnen gebeuren, hier hebben we NOOIT handen teveel!!!)\r\n\r\nGraag dan een seintje naar iemand van het bestuur, hetzij hier, hetzij via privé bericht, sms, email, facebook ah, van ons part mogen jullie zelfs te tamtam en rooksignalen gebruiken, zolang wij maar weten dat wij op jullie kunnen rekenen!\r\n\r\nNiet alleen namens het ganse bestuur, maar vooral namens een paar duizend bezoekers danken wij jullie alvast van harte voor de hulp!!!!', '2017-10-16 14:35:24', '2017-10-16 14:35:24'),
(1, 'test topic', 1, "bla", '2017-10-18 10:57:41', '2017-10-18 10:57:41'),
(1, 'Nieuw test topic', 1, '<p>fdsfsdfsdfsdfgsdfsd</p>', '2017-10-18 12:44:06', '2017-10-18 12:44:06'),
(1, 'een nieuw test topic', 1, '<p><i>sdujfnsdipfpoakfdnfjksdnf</i></p>', '2017-10-18 12:44:42', '2017-10-18 12:44:42');

INSERT INTO `album`(`title`, `user_id`) VALUES
('dinges', 1);

INSERT INTO `image`(`path`, `album_id`) VALUES
('http://via.placeholder.com/350x350', 1);

-- INSERT INTO `album_has_image`(`album_id`, `image_id`) VALUES
-- (1, 1);

INSERT INTO `message`(`title`, `message`) VALUES
('titel', 'bla');

INSERT INTO `user_has_message`(`message_id`, `user_id_1`, `user_id_2`) VALUES
(1, 2, 1),
(1, 1, 2);

INSERT INTO `sponsor`(`image_id`, `name`, `url`) VALUES
(2, 'eSHa Aquariumproducten', 'http://www.eshalabs.eu/nederlands/'),
(3, 'discus mania', 'http://discusmania.nl/'),
(4, 'hvp aqua', 'http://www.hvpaqua.nl/'),
(5, 'aquaria veldhuis', 'https://www.aquariaveldhuis.nl/nl/'),
(7, 'discus passie', 'http://www.discuspassie.nl/'),
(8, 'discusshop', 'https://discusshop.nl/'),
(9, 'jmd aqua light', 'http://www.jmbaqualight.nl/'),
(10, 'rock zolid', 'http://www.rockzolid.nl/'),
(11, 'osmose apparaat', 'https://www.osmoseapparaat.nl/'),
(12, 'Wesdijk', 'https://www.wesdijk.nl/'),
(13, 'koidream', 'https://www.koidream.com/'),
(14, 'daphnia boxtel', 'http://www.daphniaboxtel.nl/'),
(15, 'ruto', 'https://www.ruto.nl/'),
(16, 'discus vis totaal', 'http://www.discusvistotaal.nl/'),
(6, 'Discuscompleet', 'http://www.discuscompleet.nl/');

INSERT INTO `news`(`sub_category_id`, `title`, `content`) VALUES
(1, 'dinges enzo', 'bla bla bla...');

INSERT INTO `news_reply`(`user_id`, `news_id`, `content`) VALUES
(1, 1, "reactie dinges enzo bla bla");