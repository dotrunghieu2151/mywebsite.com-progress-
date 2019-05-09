-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2019 at 01:16 PM
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
  `height` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amusement`
--

INSERT INTO `amusement` (`id`, `name`, `urlName`, `shortDes`, `description`, `height`) VALUES
(1, 'Les Tasses spinning cans', 'Les-Tasses-spinning-cans', 'Spin round and round, alone or with the family, in the spinning...', 'Spin round and round, alone or with the family, in the spinning cans and have a brilliant time! An attraction for the whole family. You’ll find it in the Panorama area of the Park. Adults and kids alike can enjoy this attraction together.', 'You can go on this ride: +90cm,You must be accompanied: 0-90cm'),
(2, 'Avió airplane ride', 'Avio-airplane-ride', 'Young and old will enjoy taking off in the Avió plane - the Park’s most stand-out attraction...', 'Young and old will enjoy taking off in the Avió plane - the Park’s most stand-out attraction and the first ever flight simulator. It is a replica of the first aircraft to fly from Barcelona to Madrid in 1927. Powered by its own propeller, since 1928 Avió has flown visitors on a flight of sensations that make the imagination soar.', 'You can go on this ride: +120cm,You must be accompanied: 0-120cm'),
(3, 'Muntanya Russa rollercoaster', 'Muntanya-Russa-rollercoaster', 'Tibidabo’s Muntanya Russa rollercoaster carries the most daring of visitors...', 'Tibidabo’s Muntanya Russa rollercoaster carries the most daring of visitors more than 500m above sea-level to see one of the best views over Barcelona while experiencing an intrepid journey through the woods at more than 80kph.', 'You can go on this ride: +130cm,You must be accompanied: 120-130cm,You cannot go on this ride: 0-120cm'),
(4, 'Hurakan', 'Hurakan', 'On this ride you\'ll experience 360-degree turns, speed and excitement.', 'On this ride you\'ll experience 360-degree turns, speed and excitement.', 'You can go on this ride: +140cm,You cannot go on this ride: 0-140 cm / +195cm'),
(5, 'L\'Embruixabruixes aerial railway', 'L\'Embruixabruixes-aerial-railway', 'This was the first and original attraction in the Park and was totally renovated in 2016...', 'This was the first and original attraction in the Park and was totally renovated in 2016 to incorporate virtual features using the latest technology: holograms, virtual environments, maps, LEDS and rear-view projections. Originally opened in 1915, this was the Park’s first big attraction, and was at that time called “The Aerial Railway”. Later, with the various renovation work, it was renamed “Aeromàgic” and “Witches and Wizards Den”. ', 'You can go on this ride: +120cm,You must be accompanied: 100-120cm,You cannot go on this ride: 0-100cm'),
(6, 'Diavolo', 'Diavolo', 'Feel like you’re flying over Barcelona...', 'Feel like you’re flying over Barcelona. Don\'t miss out on the combination of spins, ascents, heights and speed.', 'You can go on this ride: +120cm, You must be accompanied: 110-120cm,You cannot go on this ride: 0-110cm'),
(7, 'Giradabo', 'Giradabo', 'The Giradabo big wheel opened in 2014 and is situated on the highest part of the mountain...', 'The Giradabo big wheel opened in 2014 and is situated on the highest part of the mountain. It takes you up into the sky and offers incredible views of Barcelona, the sea and the surrounding areas. ', 'You can go on this ride: +130cm,You must be accompanied: 95-130cm,You cannot go on this ride: 0-95cm'),
(8, 'Automata Museum', 'Automata-Museum', 'Tibidabo’s Automata Museum houses more than 40 pieces from the 19th and 20th centuries...', 'Tibidabo’s Automata Museum houses more than 40 pieces from the 19th and 20th centuries, and is a real gem within Barcelona\'s Catalogue of Museums. Here you’ll find automata and models from different countries. The oldest is the Pallasso Mandolinista, which dates from 1880. The Park’s most recent acquisition was “The Gaüs Brothers or The Balancing of The World” in 2005, designed and build by the Museum’s curator Lluís Ribas.', 'You can go on this ride: +90cm,You must be accompanied: 0-90cm'),
(9, 'Interactive water fountains', 'Interactive-water-fountains', 'Interactive water show and entertainment with light, sound and colour effects...', 'Interactive water show and entertainment with light, sound and colour effects, where everyone is welcome to cool down in the water jets. We recommend wearing a swimsuit.', 'For everyone.'),
(10, 'Hotel Krueger', 'Hotel-Krueger', 'Do you like hair-raising situations?...', 'Do you like hair-raising situations? If so, enter the one-of-a-kind Hotel Krüeger and experience a terrifying visit within an abandoned hotel, full of atmosphere and decked out with the scariest characters from horror films, ensuring that all visitors encounter shocking situations. You won’t want to miss it!', 'For everyone.'),
(11, 'Carrousel', 'Carrousel', 'The Carrousel takes everyone through a fairy tale and fantasy...', 'The Carrousel takes everyone through a fairy tale and fantasy surrounded by an atmosphere of time. It is one of the Park’s classic attractions.', 'You can go on this ride: +90cm,You must be accompanied: 0-90cm'),
(12, 'Talaia vantage point', 'Talaia-vantage-point', 'Opened in 1921, the Talaia vantage point offers the best views of Barcelona from 550m above sea level...', 'Opened in 1921, the Talaia vantage point offers the best views of Barcelona from 550m above sea level. A veritable balcony over Barcelona where you can see the best sights of the city, the sea and the natural surroundings of the Collserola mountains.', 'You can go on this ride: +120cm,You must be accompanied: 80-120cm,You cannot go on this ride: 0-80cm'),
(13, 'VIRTUAL EXPRESS', 'VIRTUAL-EXPRESS', 'Discover the first attraction of virtual reality in Catalonia...', 'Discover the first attraction of virtual reality in Catalonia. A fantastic world will appear in your environment while you enjoy the journey with the classic fast train.', 'You can go on this ride: +120cm,You must be accompanied: 100-120cm,You cannot go on this ride: 0-100cm'),
(14, 'Marionetarium', 'Marionetarium', 'The Marionetarium is an intimate and cosy theatre...', 'The Marionetarium is an intimate and cosy theatre where you can watch different puppet shows put on by the Park in partnership with the Herta Frankel Puppet Company.', 'For everyone.'),
(15, 'The Balloons', 'The-Balloons', 'A ride for the whole family where you’re carried around in baskets.', 'A ride for the whole family where you’re carried around in baskets.', 'You can go on this ride: +90cm,You must be accompanied: 0-90cm'),
(16, 'Gold Mine', 'Gold-Mine', 'An exciting and breath-taking journey with big slopes in the middle of the American West.', 'An exciting and breath-taking journey with big slopes in the middle of the American West.', 'You can go on this ride: +130cm,You must be accompanied: 110-130cm,You cannot go on this ride: 0-110cm'),
(17, 'CreaTibi by LEGO® Education', 'CreaTibi-by-LEGO-Education', 'Educational play area CreaTibi by LEGO® Education...', 'Educational play area CreaTibi by LEGO® Education, where children can play and learn to build things with traditional Lego parts. You can register at the attraction itself for educational workshops. We offer workshops for three age groups: 3-5 years, 6-8 years and 9-12 years.', 'For everyone.'),
(18, 'Miramiralls', 'Miramiralls', 'Rediscover Tibidabo\'s famous Miramiralls hall of mirrors...', 'Rediscover Tibidabo\'s famous Miramiralls hall of mirrors located next to the Automata Museum, with its transforming, kaleidoscopic effects, distributed across 13 sets full of illusion, fun and smiles. A magic place where many films have been shot.', 'You can go on this ride: +90cm,You must be accompanied: 0-90cm'),
(19, 'Piratta', 'Piratta', 'On the Piratta pirate ship, you’ll lift off up into the sky and then swing up almost 180 degrees...', 'On the Piratta pirate ship, you’ll lift off up into the sky and then swing up almost 180 degrees. An intrepid adventure!', 'You can go on this ride: +120cm,You must be accompanied: 100-120cm,You cannot go on this ride: 0-100cm'),
(20, 'Dididado', 'Dididado', 'Dididado is a 4D cinema that gives you brand new experiences...', 'Dididado is a 4D cinema that gives you brand new experiences through the use of cutting-edge technology. The four dimensions are achieved by combining 3D visual technology, using special 3D glasses, with fourth dimension effects.', 'Recommended minimum height: 90cm'),
(21, 'Crash Cars', 'Crash-Cars', 'A classic attraction of amusement parks and fairs...', 'A classic attraction of amusement parks and fairs. Belt up and enjoy!', 'You can go on this ride: +140cm,You must be accompanied: 120-140cm,You cannot go on this ride: 0-120cm'),
(22, 'TibiCity', 'TibiCity', 'This attraction will let the little ones enjoy a tour...', 'This attraction will let the little ones enjoy a tour representing the concept of a Smart City, as in Barcelona. With the city police cars, ambulances, motorcycles... all we can find in a city like ours.', 'You can go on this ride: 110-150cm,You cannot go on this ride: 0-110cm / +150cm'),
(23, 'La Granota', 'La-Granota', 'Free-fall ride for children', 'Free-fall ride for children', 'You can go on this ride: +105cm,You cannot go on this ride: 0-105cm'),
(24, 'Choo-Choo Train', 'Choo-Choo-Train', 'Little ones will enjoy a journey on the Choo-Choo Train...', 'Little ones will enjoy a journey on the Choo-Choo Train, travelling past trees and things that will appeal to them.', 'You can go on this ride: +105cm,You must be accompanied: 0-105cm'),
(25, 'Viking', 'Viking', 'he Drakars Vikings are there to give the whole family a spin...', 'The Drakars Vikings are there to give the whole family a spin. Let yourself go on the waves and soak up the speed! Yeaah!', 'You can go on this ride: +120cm,You must be accompanied: 0-120cm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amusement`
--
ALTER TABLE `amusement`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amusement`
--
ALTER TABLE `amusement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
