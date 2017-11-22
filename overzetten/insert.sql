INSERT INTO `role`(`name`) VALUES
('gast'),
('gebruiker'),
('lid'),
('redacteur'),
('admin');

INSERT INTO `image`(`path`) VALUES
('/default.jpg'),
('/sponsor/ESHA-Banner_NL_discus_03B15.gif'),
('/sponsor/discusmania-toekan.gif'),
('/sponsor/banner-HVP-Aqua.gif'),
('/sponsor/Veldhuis-banner.jpg'),
('/sponsor/Dicuscompleet-banner.jpg'),
('/sponsor/discuspassi-banner-3.jpg'),
('/sponsor/Discusshop-banner.jpg'),
('/sponsor/Aqua-light-banner.jpg'),
('/sponsor/Rockzolid-banner.jpg'),
('/sponsor/osmoseapparaat-banner.jpg'),
('/sponsor/Wesdijk-banner.jpg'),
('/sponsor/Koidream-banner.jpg'),
('/sponsor/DCH-banner-AquaVaria-2014.jpg'),
('/sponsor/RUTO-banner.jpg'),
('/sponsor/discusvistotaal.gif'),
('/messenger_background/default.jpg');

INSERT INTO `state` (`name`) VALUES
('open'),
('closed'),
('pinned');

INSERT INTO `sponsor`(`image_id`, `name`, `url`, `created_at`, `iban`, `email`, `phone`) VALUES
(2, 'eSHa Aquariumproducten', 'http://www.eshalabs.eu/nederlands/', NOW(), "vervang in db", "example@example.com", "0123456789"),
(3, 'discus mania', 'http://discusmania.nl/', NOW(), "vervang in db", "example@example.com", "0123456789"),
(4, 'hvp aqua', 'http://www.hvpaqua.nl/', NOW(), "vervang in db", "example@example.com", "0123456789"),
(5, 'aquaria veldhuis', 'https://www.aquariaveldhuis.nl/nl/', NOW(), "vervang in db", "example@example.com", "0123456789"),
(7, 'discus passie', 'http://www.discuspassie.nl/', NOW(), "vervang in db", "example@example.com", "0123456789"),
(8, 'discusshop', 'https://discusshop.nl/', NOW(), "vervang in db", "example@example.com", "0123456789"),
(9, 'jmd aqua light', 'http://www.jmbaqualight.nl/', NOW(), "vervang in db", "example@example.com", "0123456789"),
(10, 'rock zolid', 'http://www.rockzolid.nl/', NOW(), "vervang in db", "example@example.com", "0123456789"),
(11, 'osmose apparaat', 'https://www.osmoseapparaat.nl/', NOW(), "vervang in db", "example@example.com", "0123456789"),
(12, 'Wesdijk', 'https://www.wesdijk.nl/', NOW(), "vervang in db", "example@example.com", "0123456789"),
(13, 'koidream', 'https://www.koidream.com/', NOW(), "vervang in db", "example@example.com", "0123456789"),
(14, 'daphnia boxtel', 'http://www.daphniaboxtel.nl/', NOW(), "vervang in db", "example@example.com", "0123456789"),
(15, 'ruto', 'https://www.ruto.nl/', NOW(), "vervang in db", "example@example.com", "0123456789"),
(16, 'discus vis totaal', 'http://www.discusvistotaal.nl/', NOW(), "vervang in db", "example@example.com", "0123456789"),
(6, 'Discuscompleet', 'http://www.discuscompleet.nl/', NOW(), "vervang in db", "example@example.com", "0123456789");

INSERT INTO `page`(`uri`, `name`, `content`, `image_id`) VALUES
("houden-van", "houden van", "<p>You think water moves fast? You should see ice. It moves like it has a mind.
                Like it knows it killed the world once and got a taste for murder. After the avalanche,
                it took us a week to climb out. Now, I don't know exactly when we turned on each other,
                but I know that seven of us survived the slide... and only five made it out. Now we took an oath,
                that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't.
                Nature is lethal but it doesn't hold a candle to man.<br><br>
                Like it knows it killed the world once and got a taste for murder. After the avalanche,
                it took us a week to climb out. Now, I don't know exactly when we turned on each other,
                but I know that seven of us survived the slide... and only five made it out. Now we took an oath,
                that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't.
                Nature is lethal but it doesn't hold a candle to man.<br><br>
                Like it knows it killed the world once and got a taste for murder. After the avalanche,
                it took us a week to climb out. Now, I don't know exactly when we turned on each other,
                but I know that seven of us survived the slide... and only five made it out. Now we took an oath,
                that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't.
                Nature is lethal but it doesn't hold a candle to man.</p>", 1),
("kweken", "kweken", "<p>You think water moves fast? You should see ice. It moves like it has a mind.
                Like it knows it killed the world once and got a taste for murder. After the avalanche,
                it took us a week to climb out. Now, I don't know exactly when we turned on each other,
                but I know that seven of us survived the slide... and only five made it out. Now we took an oath,
                that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't.
                Nature is lethal but it doesn't hold a candle to man.<br><br>
                Like it knows it killed the world once and got a taste for murder. After the avalanche,
                it took us a week to climb out. Now, I don't know exactly when we turned on each other,
                but I know that seven of us survived the slide... and only five made it out. Now we took an oath,
                that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't.
                Nature is lethal but it doesn't hold a candle to man.<br><br>
                Like it knows it killed the world once and got a taste for murder. After the avalanche,
                it took us a week to climb out. Now, I don't know exactly when we turned on each other,
                but I know that seven of us survived the slide... and only five made it out. Now we took an oath,
                that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't.
                Nature is lethal but it doesn't hold a candle to man.</p>", 1),
("ziektes", "ziektes", "<p>You think water moves fast? You should see ice. It moves like it has a mind.
                Like it knows it killed the world once and got a taste for murder. After the avalanche,
                it took us a week to climb out. Now, I don't know exactly when we turned on each other,
                but I know that seven of us survived the slide... and only five made it out. Now we took an oath,
                that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't.
                Nature is lethal but it doesn't hold a candle to man.<br><br>
                Like it knows it killed the world once and got a taste for murder. After the avalanche,
                it took us a week to climb out. Now, I don't know exactly when we turned on each other,
                but I know that seven of us survived the slide... and only five made it out. Now we took an oath,
                that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't.
                Nature is lethal but it doesn't hold a candle to man.<br><br>
                Like it knows it killed the world once and got a taste for murder. After the avalanche,
                it took us a week to climb out. Now, I don't know exactly when we turned on each other,
                but I know that seven of us survived the slide... and only five made it out. Now we took an oath,
                that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't.
                Nature is lethal but it doesn't hold a candle to man.</p>", 1);