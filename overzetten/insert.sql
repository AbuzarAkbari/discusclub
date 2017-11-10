INSERT INTO `role`(`name`) VALUES
('gast'),
('gebruiker'),
('lid'),
('redacteur'),
('admin');

INSERT INTO `image`(`path`) VALUES
('/default.png'),
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

INSERT INTO `sponsor`(`image_id`, `name`, `url`, `created_at`) VALUES
(2, 'eSHa Aquariumproducten', 'http://www.eshalabs.eu/nederlands/', NOW()),
(3, 'discus mania', 'http://discusmania.nl/', NOW()),
(4, 'hvp aqua', 'http://www.hvpaqua.nl/', NOW()),
(5, 'aquaria veldhuis', 'https://www.aquariaveldhuis.nl/nl/', NOW()),
(7, 'discus passie', 'http://www.discuspassie.nl/', NOW()),
(8, 'discusshop', 'https://discusshop.nl/', NOW()),
(9, 'jmd aqua light', 'http://www.jmbaqualight.nl/', NOW()),
(10, 'rock zolid', 'http://www.rockzolid.nl/', NOW()),
(11, 'osmose apparaat', 'https://www.osmoseapparaat.nl/', NOW()),
(12, 'Wesdijk', 'https://www.wesdijk.nl/', NOW()),
(13, 'koidream', 'https://www.koidream.com/', NOW()),
(14, 'daphnia boxtel', 'http://www.daphniaboxtel.nl/', NOW()),
(15, 'ruto', 'https://www.ruto.nl/', NOW()),
(16, 'discus vis totaal', 'http://www.discusvistotaal.nl/', NOW()),
(6, 'Discuscompleet', 'http://www.discuscompleet.nl/', NOW());

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