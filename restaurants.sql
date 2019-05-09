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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
