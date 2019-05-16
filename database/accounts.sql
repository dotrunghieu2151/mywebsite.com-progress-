-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2019 at 09:24 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accounts`
--

-- --------------------------------------------------------

--
-- Table structure for table `amusement`
--

CREATE TABLE `amusement` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `urlName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `shortDes` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `height` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `amusement`
--

INSERT INTO `amusement` (`id`, `name`, `urlName`, `shortDes`, `description`, `height`, `price`, `quantity`) VALUES
(1, 'Les Tasses spinning cans', 'Les-Tasses-spinning-cans', 'Spin round and round, alone or with the family, in the spinning...', 'Spin round and round, alone or with the family, in the spinning cans and have a brilliant time! An attraction for the whole family. You’ll find it in the Panorama area of the Park. Adults and kids alike can enjoy this attraction together.', 'You can go on this ride: +90cm,You must be accompanied: 0-90cm', '10.00', 3),
(2, 'Avió airplane ride', 'Avio-airplane-ride', 'Young and old will enjoy taking off in the Avió plane...', 'Young and old will enjoy taking off in the Avió plane - the Park’s most stand-out attraction and the first ever flight simulator. It is a replica of the first aircraft to fly from Barcelona to Madrid in 1927. Powered by its own propeller, since 1928 Avió has flown visitors on a flight of sensations that make the imagination soar.', 'You can go on this ride: +120cm,You must be accompanied: 0-120cm', '15.00', 1),
(3, 'Muntanya Russa rollercoaster', 'Muntanya-Russa-rollercoaster', 'Tibidabo’s Muntanya Russa rollercoaster carries the most daring of visitors...', 'Tibidabo’s Muntanya Russa rollercoaster carries the most daring of visitors more than 500m above sea-level to see one of the best views over Barcelona while experiencing an intrepid journey through the woods at more than 80kph.', 'You can go on this ride: +130cm,You must be accompanied: 120-130cm,You cannot go on this ride: 0-120cm', '15.00', 5),
(4, 'Hurakan', 'Hurakan', 'On this ride you\'ll experience 360-degree turns, speed and excitement.', 'On this ride you\'ll experience 360-degree turns, speed and excitement.', 'You can go on this ride: +140cm,You cannot go on this ride: 0-140 cm / +195cm', '20.00', 6),
(5, 'L\'Embruixabruixes aerial railway', 'L\'Embruixabruixes-aerial-railway', 'This was the first and original attraction in the Park and was totally renovated in 2016...', 'This was the first and original attraction in the Park and was totally renovated in 2016 to incorporate virtual features using the latest technology: holograms, virtual environments, maps, LEDS and rear-view projections. Originally opened in 1915, this was the Park’s first big attraction, and was at that time called “The Aerial Railway”. Later, with the various renovation work, it was renamed “Aeromàgic” and “Witches and Wizards Den”. ', 'You can go on this ride: +120cm,You must be accompanied: 100-120cm,You cannot go on this ride: 0-100cm', '10.00', 20),
(6, 'Diavolo', 'Diavolo', 'Feel like you’re flying over Barcelona...', 'Feel like you’re flying over Barcelona. Don\'t miss out on the combination of spins, ascents, heights and speed.', 'You can go on this ride: +120cm, You must be accompanied: 110-120cm,You cannot go on this ride: 0-110cm', '15.00', 2),
(7, 'Giradabo', 'Giradabo', 'The Giradabo big wheel opened in 2014 and is situated on the highest part of the mountain...', 'The Giradabo big wheel opened in 2014 and is situated on the highest part of the mountain. It takes you up into the sky and offers incredible views of Barcelona, the sea and the surrounding areas. ', 'You can go on this ride: +130cm,You must be accompanied: 95-130cm,You cannot go on this ride: 0-95cm', '5.00', 3),
(8, 'Automata Museum', 'Automata-Museum', 'Tibidabo’s Automata Museum houses more than 40 pieces from the 19th and 20th centuries...', 'Tibidabo’s Automata Museum houses more than 40 pieces from the 19th and 20th centuries, and is a real gem within Barcelona\'s Catalogue of Museums. Here you’ll find automata and models from different countries. The oldest is the Pallasso Mandolinista, which dates from 1880. The Park’s most recent acquisition was “The Gaüs Brothers or The Balancing of The World” in 2005, designed and build by the Museum’s curator Lluís Ribas.', 'You can go on this ride: +90cm,You must be accompanied: 0-90cm', '10.00', 5),
(9, 'Interactive water fountains', 'Interactive-water-fountains', 'Interactive water show and entertainment with light, sound and colour effects...', 'Interactive water show and entertainment with light, sound and colour effects, where everyone is welcome to cool down in the water jets. We recommend wearing a swimsuit.', 'For everyone.', NULL, NULL),
(10, 'Hotel Krueger', 'Hotel-Krueger', 'Do you like hair-raising situations?...', 'Do you like hair-raising situations? If so, enter the one-of-a-kind Hotel Krüeger and experience a terrifying visit within an abandoned hotel, full of atmosphere and decked out with the scariest characters from horror films, ensuring that all visitors encounter shocking situations. You won’t want to miss it!', 'For everyone.', '25.00', 4),
(11, 'Carrousel', 'Carrousel', 'The Carrousel takes everyone through a fairy tale and fantasy...', 'The Carrousel takes everyone through a fairy tale and fantasy surrounded by an atmosphere of time. It is one of the Park’s classic attractions.', 'You can go on this ride: +90cm,You must be accompanied: 0-90cm', '15.00', 10),
(12, 'Talaia vantage point', 'Talaia-vantage-point', 'Opened in 1921, the Talaia vantage point offers the best views of Barcelona from 550m above sea level...', 'Opened in 1921, the Talaia vantage point offers the best views of Barcelona from 550m above sea level. A veritable balcony over Barcelona where you can see the best sights of the city, the sea and the natural surroundings of the Collserola mountains.', 'You can go on this ride: +120cm,You must be accompanied: 80-120cm,You cannot go on this ride: 0-80cm', '10.00', 2),
(13, 'VIRTUAL EXPRESS', 'VIRTUAL-EXPRESS', 'Discover the first attraction of virtual reality in Catalonia...', 'Discover the first attraction of virtual reality in Catalonia. A fantastic world will appear in your environment while you enjoy the journey with the classic fast train.', 'You can go on this ride: +120cm,You must be accompanied: 100-120cm,You cannot go on this ride: 0-100cm', '20.00', 2),
(14, 'Marionetarium', 'Marionetarium', 'The Marionetarium is an intimate and cosy theatre...', 'The Marionetarium is an intimate and cosy theatre where you can watch different puppet shows put on by the Park in partnership with the Herta Frankel Puppet Company.', 'For everyone.', '10.00', 5),
(15, 'The Balloons', 'The-Balloons', 'A ride for the whole family where you’re carried around in baskets.', 'A ride for the whole family where you’re carried around in baskets.', 'You can go on this ride: +90cm,You must be accompanied: 0-90cm', '10.00', 10),
(16, 'Gold Mine', 'Gold-Mine', 'An exciting and breath-taking journey with big slopes in the middle of the American West.', 'An exciting and breath-taking journey with big slopes in the middle of the American West.', 'You can go on this ride: +130cm,You must be accompanied: 110-130cm,You cannot go on this ride: 0-110cm', '15.00', 5),
(17, 'CreaTibi by LEGO® Education', 'CreaTibi-by-LEGO-Education', 'Educational play area CreaTibi by LEGO® Education...', 'Educational play area CreaTibi by LEGO® Education, where children can play and learn to build things with traditional Lego parts. You can register at the attraction itself for educational workshops. We offer workshops for three age groups: 3-5 years, 6-8 years and 9-12 years.', 'For everyone.', '5.00', 15),
(18, 'Miramiralls', 'Miramiralls', 'Rediscover Tibidabo\'s famous Miramiralls hall of mirrors...', 'Rediscover Tibidabo\'s famous Miramiralls hall of mirrors located next to the Automata Museum, with its transforming, kaleidoscopic effects, distributed across 13 sets full of illusion, fun and smiles. A magic place where many films have been shot.', 'You can go on this ride: +90cm,You must be accompanied: 0-90cm', '25.00', 3),
(19, 'Piratta', 'Piratta', 'On the Piratta pirate ship, you’ll lift off up into the sky and then swing up almost 180 degrees...', 'On the Piratta pirate ship, you’ll lift off up into the sky and then swing up almost 180 degrees. An intrepid adventure!', 'You can go on this ride: +120cm,You must be accompanied: 100-120cm,You cannot go on this ride: 0-100cm', '15.00', 15),
(20, 'Dididado', 'Dididado', 'Dididado is a 4D cinema that gives you brand new experiences...', 'Dididado is a 4D cinema that gives you brand new experiences through the use of cutting-edge technology. The four dimensions are achieved by combining 3D visual technology, using special 3D glasses, with fourth dimension effects.', 'Recommended minimum height: 90cm', '20.00', 2),
(21, 'Crash Cars', 'Crash-Cars', 'A classic attraction of amusement parks and fairs...', 'A classic attraction of amusement parks and fairs. Belt up and enjoy!', 'You can go on this ride: +140cm,You must be accompanied: 120-140cm,You cannot go on this ride: 0-120cm', '10.00', 14),
(22, 'TibiCity', 'TibiCity', 'This attraction will let the little ones enjoy a tour...', 'This attraction will let the little ones enjoy a tour representing the concept of a Smart City, as in Barcelona. With the city police cars, ambulances, motorcycles... all we can find in a city like ours.', 'You can go on this ride: 110-150cm,You cannot go on this ride: 0-110cm / +150cm', '10.00', 4),
(23, 'La Granota', 'La-Granota', 'Free-fall ride for children', 'Free-fall ride for children', 'You can go on this ride: +105cm,You cannot go on this ride: 0-105cm', '10.00', 5),
(24, 'Choo-Choo Train', 'Choo-Choo-Train', 'Little ones will enjoy a journey on the Choo-Choo Train...', 'Little ones will enjoy a journey on the Choo-Choo Train, travelling past trees and things that will appeal to them.', 'You can go on this ride: +105cm,You must be accompanied: 0-105cm', '5.00', 10),
(25, 'Viking', 'Viking', 'he Drakars Vikings are there to give the whole family a spin...', 'The Drakars Vikings are there to give the whole family a spin. Let yourself go on the waves and soak up the speed! Yeaah!', 'You can go on this ride: +120cm,You must be accompanied: 0-120cm', '5.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `phone` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `phone` text NOT NULL,
  `email` text NOT NULL,
  `address` text NOT NULL,
  `country` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `passreset`
--

CREATE TABLE `passreset` (
  `passResetId` int(11) NOT NULL,
  `passResetEmail` text NOT NULL,
  `passResetSelector` text NOT NULL,
  `passResetToken` longtext NOT NULL,
  `passResetExpire` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `urlName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `openTime` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `urlName`, `location`, `openTime`, `description`, `image`) VALUES
(1, 'Adventurers Club', 'adventurers-club', 'Panorcamic Aream', '10am-6pm', 'Adventurers Club is in Pla?a Tibidabo in front of the main entrance, serving a wide range of salads, tapas and sandwiches. It has a terrace, indoor dining room with air conditioning and Wi-Fi. Also, from 10.30 am to 11.30 am, enjoy its breakfast offer for only ?3,50: toasted cheese and ham sandwich + coffee or coffee with milk (only available when the amusement park opens). ', '/mywebsite.com/public/image/restaurants/res1.jpg'),
(2, 'Bar Estaci?', 'bar-estacio', 'Nivell 1', '1pm-5pm', 'You?ll find the Station Bar (Bar Estaci?) right in the heart of the Park, next to the Tibidabo Express ride. It serves a wide choice of burgers (including vegetarian) roast chicken, salads, chips, chicken nuggets and more. Has indoor dining room with air conditioning and Wi-Fi. ', '/mywebsite.com/public/image/restaurants/res2.jpg'),
(3, 'Barba Papa', 'barba-papa', 'New York', 'from 10.30 am until the Park closes.', 'Enjoy the best popcorn, classic toffee apples and marshmallows in the Panorama Area in front of the    Carrousel.', '/mywebsite.com/public/image/restaurants/res3.jpg'),
(4, 'Churreria', 'churreria', 'Boston', 'from 10.30 am until the Park closes', 'Have the classic Spanish breakfast or snack of churros and chocolate next to the Talaia ride. Also, from 10.30 am to 11.30 am, enjoy its breakfast offer for only ?3,50: 10 Spanish churros + hot chocolate (only available when the amusement park opens).', '/mywebsite.com/public/image/restaurants/res4.jpg'),
(5, 'Diavolo Patates', 'diavolo-patates', 'San Francisco', 'from 2 pm until 30 minutes before the Park closes.', 'New food stall located next to the Diavolo ride where you can try delicious homemade chips with a wide variety of toppings that you can choose so they are exactly how you like them.', '/mywebsite.com/public/image/restaurants/res5.jpg'),
(6, 'Enrique Tom?s', 'enrique-tomas', 'Los Santos', 'from 6:30 am to 5pm', 'The best ham - by Enrique Tom?s! You can taste exquisite ham, sandwiches and tapas whilst enjoying great views from Tibidabo?s mirador. An unbeatable combination! Next to the Ferris Wheel and a the main viewpoint of the panoramic area you will find the Enrique Tom?s center where you can taste sandwiches of Iberian ham or sausage, as well as different appetizers like olives, chips or dices of fuet or chorizo. Everything, accompanied by a refreshment, a beer or a glass of cava and the best views of the city, 500 meters above the sea.', '/mywebsite.com/public/image/restaurants/res6.jpg'),
(7, 'Iogurteria Danone', 'iogurteria-danone', 'New Mexico', 'from 2 pm until the Park closes (when we close at 10 pm or 11 pm). From 1 pm until de Park closes (when we close before 10 pm).', 'Sweeten your day even more with the range of products this food stand serves up. A perfect spot for a yoghurt shake, a coffee, cold drink and fabulous and delicious frozen yoghurts. You can even pick the toppings you love most.', '/mywebsite.com/public/image/restaurants/res7.jpg'),
(8, 'TELEPIZZA-Castle Tavern', 'telepizza-castle-tavern', 'New York', ' from 1 pm to 5 pm. August: from 1 pm until the Park closes.', 'Located next to the Mysterious Castle (Castell Misteri?s), the Telepizza caf? within Taverna del Castell serves a variety of pastas and pizzas to suit all tastes. Also serves options for vegetarians and coeliac sufferers. Come and take advantage of our 2-for-1 offer on pizzas! We have outdoor tables.', '/mywebsite.com/public/image/restaurants/res8.jpg'),
(9, 'Pirate Bar', 'pirate-bar', 'Chicago', 'From 11am to 12pm', 'Next to the Pirate ride, you\'ll find the Pirate Bar (Bar Piratta), serving frankfurters, hot dogs and sandwiches along with drinks.Has outdoor tables.', '/mywebsite.com/public/image/restaurants/res9.jpg'),
(10, 'La Terrassa de L\'Aeroport', 'la-terrassa-de-L\'Aeroport', 'New York', 'From 11am to 4pm', 'Under the Avi? airplane ride, you?ll find the Airport Terrace where you can have a variety of snacks such as hummus, focaccia bread, sandwiches and so on. Suitable for coeliac sufferers and vegetarians.', '/mywebsite.com/public/image/restaurants/res10.jpg'),
(11, 'La Gelateria', 'la-gelateria', 'South West', 'from 2 pm until one hour before the Park closes.', 'If you fancy a refreshing meal, in the pirate area of the Park you will find La Gelateria, with the best ice cream.', '/mywebsite.com/public/image/restaurants/res11.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `saletransaction`
--

CREATE TABLE `saletransaction` (
  `id` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ticketorder`
--

CREATE TABLE `ticketorder` (
  `id` int(11) NOT NULL,
  `amusementId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `transactionId` int(11) NOT NULL,
  `childrenNum` int(11) NOT NULL,
  `adultNum` int(11) NOT NULL,
  `seniorNum` int(11) NOT NULL,
  `weekendDiscount` int(11) DEFAULT NULL,
  `ageDiscount` int(11) DEFAULT NULL,
  `totalQuantity` int(11) NOT NULL,
  `totalPrice` decimal(10,2) NOT NULL,
  `ticketDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `accountEmail` varchar(100) NOT NULL,
  `selector` text NOT NULL,
  `validator` longtext NOT NULL,
  `expire` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amusement`
--
ALTER TABLE `amusement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passreset`
--
ALTER TABLE `passreset`
  ADD PRIMARY KEY (`passResetId`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saletransaction`
--
ALTER TABLE `saletransaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `ticketorder`
--
ALTER TABLE `ticketorder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `amusementId` (`amusementId`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `transactionId` (`transactionId`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amusement`
--
ALTER TABLE `amusement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `passreset`
--
ALTER TABLE `passreset`
  MODIFY `passResetId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `saletransaction`
--
ALTER TABLE `saletransaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ticketorder`
--
ALTER TABLE `ticketorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `saletransaction`
--
ALTER TABLE `saletransaction`
  ADD CONSTRAINT `saletransaction_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`id`);

--
-- Constraints for table `ticketorder`
--
ALTER TABLE `ticketorder`
  ADD CONSTRAINT `ticketorder_ibfk_1` FOREIGN KEY (`amusementId`) REFERENCES `amusement` (`id`),
  ADD CONSTRAINT `ticketorder_ibfk_2` FOREIGN KEY (`customerId`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `ticketorder_ibfk_3` FOREIGN KEY (`transactionId`) REFERENCES `saletransaction` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
