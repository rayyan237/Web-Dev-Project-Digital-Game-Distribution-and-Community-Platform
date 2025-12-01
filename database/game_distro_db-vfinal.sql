-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2025 at 05:30 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `game_distro_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `chat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sent_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`chat_id`, `user_id`, `message`, `sent_at`) VALUES
(1, 3, 'Hi, this message should be added to the database.', '2025-11-26 01:54:23');

-- --------------------------------------------------------

--
-- Table structure for table `community_posts`
--

CREATE TABLE `community_posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category` enum('general','feedback','help','guide') NOT NULL DEFAULT 'general',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `community_posts`
--

INSERT INTO `community_posts` (`post_id`, `user_id`, `title`, `content`, `category`, `created_at`, `last_updated`) VALUES
(1, 3, 'aaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaa', 'guide', '2025-11-27 01:08:02', '2025-11-27 01:08:02'),
(2, 3, 'cccccccccccccccccccc', 'ccccccccccccccccccccccccccc', 'help', '2025-11-27 01:08:17', '2025-11-27 01:08:17'),
(4, 3, 'wwwwwwwwwwww', 'wwwwwwwwwwwww', 'help', '2025-11-28 01:27:28', '2025-11-28 01:27:28');

-- --------------------------------------------------------

--
-- Table structure for table `community_post_reactions`
--

CREATE TABLE `community_post_reactions` (
  `reaction_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reaction_type` enum('like','dislike') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `community_replies`
--

CREATE TABLE `community_replies` (
  `reply_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `game_id` int(11) NOT NULL COMMENT 'Primary Key.',
  `title` varchar(100) NOT NULL COMMENT 'Full name of the game.',
  `developer_name` varchar(100) NOT NULL COMMENT 'The primary developer name (can be simplified later).',
  `price` decimal(10,2) NOT NULL COMMENT 'Game price (e.g., 59.99).',
  `release_date` date NOT NULL COMMENT 'Date of launch (e.g., 2025-01-15).',
  `description` text NOT NULL COMMENT 'A full description of the game.',
  `average_rating` decimal(3,2) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_special_offer` tinyint(1) NOT NULL DEFAULT 0,
  `is_recommended` tinyint(1) NOT NULL DEFAULT 0,
  `min_os` varchar(100) DEFAULT 'Windows 10 or later 64-bit',
  `min_processor` varchar(150) DEFAULT 'Intel Core i5-6600K / AMD Ryzen R5 1600',
  `min_memory` varchar(50) DEFAULT '12 GB RAM',
  `min_graphics` varchar(150) DEFAULT 'GTX 1050 Ti / RX 580 / Arc A380',
  `min_directx` varchar(50) DEFAULT 'Version 12',
  `min_storage` varchar(50) DEFAULT '50 GB available space',
  `rec_os` varchar(100) DEFAULT 'Windows 10 or later 64-bit',
  `rec_processor` varchar(150) DEFAULT 'Intel Core i5-9600K / AMD Ryzen 5 3600',
  `rec_memory` varchar(50) DEFAULT '16 GB RAM',
  `rec_graphics` varchar(150) DEFAULT 'RTX 2070 / RX 5700 XT / Arc B570',
  `rec_directx` varchar(50) DEFAULT 'Version 12',
  `rec_storage` varchar(50) DEFAULT '50 GB available space',
  `header_image` varchar(255) DEFAULT NULL COMMENT 'Large landscape image for hero/carousel',
  `thumbnail_image` varchar(255) DEFAULT NULL COMMENT 'Small portrait image for grids'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`game_id`, `title`, `developer_name`, `price`, `release_date`, `description`, `average_rating`, `is_published`, `is_featured`, `is_special_offer`, `is_recommended`, `min_os`, `min_processor`, `min_memory`, `min_graphics`, `min_directx`, `min_storage`, `rec_os`, `rec_processor`, `rec_memory`, `rec_graphics`, `rec_directx`, `rec_storage`, `header_image`, `thumbnail_image`) VALUES
(1, 'Age of Wonders 4', 'Triumph Studios', 49.99, '2023-05-02', 'Rule a fantasy realm of your own design! Explore new magical realms in Age of Wonders’ signature blend of 4X strategy and turn-based tactical combat.', 4.50, 1, 0, 0, 0, 'Windows 10 or later 64-bit', 'Intel Core i5-6600K / AMD Ryzen R5 1600', '12 GB RAM', 'GTX 1050 Ti / RX 580 / Arc A380', 'Version 12', '50 GB available space', 'Windows 11 64-bit', 'Intel Core i7-8700K / AMD Ryzen 5 5600X', '20 GB RAM', 'RTX 3060 Ti / RX 6700 XT / Arc A770', 'Version 12', '70 GB available space', 'assets/images/games/Age of Wonders 4/banner.jpg', 'assets/images/games/Age of Wonders 4/thumbnail.jpg'),
(2, 'Among Us', 'Innersloth', 4.99, '2018-11-16', 'An online and local party game of teamwork and betrayal for 4-15 players... in space!', 4.80, 1, 0, 0, 0, 'Windows 11 64-bit', 'Intel Core i5-4460 / AMD Ryzen 3 1200', '16 GB RAM', 'GTX 1060 / RX 580 / Arc A750', 'Version 11', '70 GB available space', 'Windows 10 or later 64-bit', 'Intel Core i5-10600K / AMD Ryzen 5 5600', '24 GB RAM', 'RTX 3070 / RX 6800 / Arc A770', 'Version 12', '100 GB available space', 'assets/images/games/Among Us/banner.jpg', 'assets/images/games/Among Us/thumbnail.jpg'),
(3, 'Assetto Corsa', 'Kunos Simulazioni', 19.99, '2014-12-19', 'Assetto Corsa features an advanced DirectX 11 graphics engine that recreates an immersive environment, dynamic lighthing and realistic materials and surfaces.', 5.00, 1, 1, 0, 0, 'Windows 10 64-bit', 'Intel Core i5-2500K / AMD FX-8350', '6 GB RAM', 'GTX 970 / RX 470', 'Version 12', '100 GB available space', 'Windows 10 64-bit', 'Intel Core i7-6700K / AMD Ryzen 7 2700X', '32 GB RAM', 'RTX 2060 Super / RX 5700', 'Version 12', '125 GB available space', 'assets/images/games/Assetto Corsa/banner.jpg', 'assets/images/games/Assetto Corsa/thumbnail.jpg'),
(4, 'Battlefield 6', 'DICE', 59.99, '2021-11-19', 'Battlefield™ 2042 is a first-person shooter that marks the return to the iconic all-out warfare of the franchise.', 3.50, 1, 1, 0, 0, 'Windows 10 or later 64-bit', 'Intel Core i3-4340 / AMD FX-6300', '10 GB RAM', 'GTX 1650 / RX 5500 XT', 'Version 11', '25 GB available space', 'Windows 11 64-bit', 'Intel Core i5-9600K / AMD Ryzen 5 3600', '16 GB RAM', 'RTX 4060 / RX 7600 / Arc B580', 'Version 12', '40 GB available space', 'assets/images/games/Battlefield 6/banner.jpg', 'assets/images/games/Battlefield 6/thumbnail.jpg'),
(5, 'Blood Fresh Supply', 'Nightdive Studios', 9.99, '2019-05-09', 'Battle an army of sycophantic cultists, zombies, gargoyles, hellhounds, and an insatiable host of horrors in your quest to defeat the evil Tchernobog.', 4.70, 1, 0, 0, 0, 'Windows 11 64-bit', 'Intel Core i5-6600K / AMD Ryzen R5 1600', '8 GB RAM', 'GTX 750 Ti / R7 370', 'Version 12', '40 GB available space', 'Windows 10 or later 64-bit', 'Intel Core i7-8700K / AMD Ryzen 5 5600X', '20 GB RAM', 'GTX 1080 Ti / RX Vega 64', 'Version 12', '60 GB available space', 'assets/images/games/Blood Fresh Supply/banner.jpg', 'assets/images/games/Blood Fresh Supply/thumbnail.jpg'),
(6, 'Borderlands 2', 'Gearbox Software', 19.99, '2012-09-17', 'A new era of shoot and loot is about to begin. Play as one of four new vault hunters facing off against a massive new world of creatures, psychos and the evil mastermind, Handsome Jack.', 4.90, 1, 0, 0, 0, 'Windows 10 64-bit', 'Intel Core i5-4460 / AMD Ryzen 3 1200', '12 GB RAM', 'GTX 960 / RX 560 / Arc A380', 'Version 11', '60 GB available space', 'Windows 10 64-bit', 'Intel Core i5-10600K / AMD Ryzen 5 5600', '24 GB RAM', 'RTX 2070 / RX 5700 XT / Arc B570', 'Version 12', '80 GB available space', 'assets/images/games/Borderlands 2/banner.jpg', 'assets/images/games/Borderlands 2/thumbnail.jpg'),
(7, 'Celeste', 'Maddy Makes Games', 19.99, '2018-01-25', 'Help Madeline survive her inner demons on her journey to the top of Celeste Mountain, in this super-tight, hand-crafted platformer from the creators of TowerFall.', 4.90, 1, 0, 0, 0, 'Windows 10 or later 64-bit', 'Intel Core i5-2500K / AMD FX-8350', '16 GB RAM', 'GTX 1050 Ti / RX 580 / Arc A380', 'Version 12', '30 GB available space', 'Windows 11 64-bit', 'Intel Core i7-6700K / AMD Ryzen 7 2700X', '32 GB RAM', 'RTX 3060 Ti / RX 6700 XT / Arc A770', 'Version 12', '50 GB available space', 'assets/images/games/Celeste/banner.jpg', 'assets/images/games/Celeste/thumbnail.jpg'),
(8, 'Counter-Strike 2', 'Valve', 0.00, '2023-09-27', 'For over two decades, Counter-Strike has offered an elite competitive experience, one shaped by millions of players from across the globe.', 4.50, 1, 0, 0, 0, 'Windows 11 64-bit', 'Intel Core i3-4340 / AMD FX-6300', '6 GB RAM', 'GTX 1060 / RX 580 / Arc A750', 'Version 11', '50 GB available space', 'Windows 10 or later 64-bit', 'Intel Core i5-9600K / AMD Ryzen 5 3600', '16 GB RAM', 'RTX 3070 / RX 6800 / Arc A770', 'Version 12', '70 GB available space', 'assets/images/games/Counter-Strike 2/banner.jpg', 'assets/images/games/Counter-Strike 2/thumbnail.jpg'),
(9, 'Cyberpunk 2077', 'CD PROJEKT RED', 59.99, '2020-12-10', 'Cyberpunk 2077 is an open-world, action-adventure RPG set in the megalopolis of Night City, where you play as a cyberpunk mercenary wrapped up in a do-or-die fight for survival.', 4.40, 1, 0, 0, 0, 'Windows 10 64-bit', 'Intel Core i5-6600K / AMD Ryzen R5 1600', '10 GB RAM', 'GTX 970 / RX 470', 'Version 12', '70 GB available space', 'Windows 10 64-bit', 'Intel Core i7-8700K / AMD Ryzen 5 5600X', '20 GB RAM', 'RTX 2060 Super / RX 5700', 'Version 12', '100 GB available space', 'assets/images/games/Cyberpunk 2077/banner.jpg', 'assets/images/games/Cyberpunk 2077/thumbnail.jpg'),
(10, 'Dead by Daylight', 'Behaviour Interactive', 19.99, '2016-06-14', 'Dead by Daylight is a multiplayer (4vs1) horror game where one player takes on the role of the savage Killer, and the other four players play as Survivors.', 4.20, 1, 0, 1, 0, 'Windows 10 or later 64-bit', 'Intel Core i5-4460 / AMD Ryzen 3 1200', '8 GB RAM', 'GTX 1650 / RX 5500 XT', 'Version 11', '100 GB available space', 'Windows 11 64-bit', 'Intel Core i5-10600K / AMD Ryzen 5 5600', '24 GB RAM', 'RTX 4060 / RX 7600 / Arc B580', 'Version 12', '125 GB available space', 'assets/images/games/Dead by Daylight/banner.jpg', 'assets/images/games/Dead by Daylight/thumbnail.jpg'),
(11, 'Deus Ex Mankind Divided', 'Eidos Montréal', 29.99, '2016-08-23', 'Now an experienced covert operative, Adam Jensen is forced to operate in a world that has grown to despise his kind.', 4.30, 1, 0, 0, 0, 'Windows 11 64-bit', 'Intel Core i5-2500K / AMD FX-8350', '12 GB RAM', 'GTX 750 Ti / R7 370', 'Version 12', '25 GB available space', 'Windows 10 or later 64-bit', 'Intel Core i7-6700K / AMD Ryzen 7 2700X', '32 GB RAM', 'GTX 1080 Ti / RX Vega 64', 'Version 12', '40 GB available space', 'assets/images/games/Deus Ex Mankind Divided/banner.jpg', 'assets/images/games/Deus Ex Mankind Divided/thumbnail.jpg'),
(12, 'Don\'t Starve', 'Klei Entertainment', 9.99, '2013-04-23', 'Don’t Starve is an uncompromising wilderness survival game full of science and magic.', 4.80, 1, 0, 0, 0, 'Windows 10 64-bit', 'Intel Core i3-4340 / AMD FX-6300', '16 GB RAM', 'GTX 960 / RX 560 / Arc A380', 'Version 11', '40 GB available space', 'Windows 10 64-bit', 'Intel Core i5-9600K / AMD Ryzen 5 3600', '16 GB RAM', 'RTX 2070 / RX 5700 XT / Arc B570', 'Version 12', '60 GB available space', 'assets/images/games/Don\'t Starve/banner.jpg', 'assets/images/games/Don\'t Starve/thumbnail.jpg'),
(13, 'Dota 2', 'Valve', 0.00, '2013-07-09', 'Every day, millions of players worldwide enter battle as one of over a hundred Dota heroes.', 4.60, 1, 0, 1, 0, 'Windows 10 or later 64-bit', 'Intel Core i5-6600K / AMD Ryzen R5 1600', '6 GB RAM', 'GTX 1050 Ti / RX 580 / Arc A380', 'Version 12', '60 GB available space', 'Windows 11 64-bit', 'Intel Core i7-8700K / AMD Ryzen 5 5600X', '20 GB RAM', 'RTX 3060 Ti / RX 6700 XT / Arc A770', 'Version 12', '80 GB available space', 'assets/images/games/Dota 2/banner.jpg', 'assets/images/games/Dota 2/thumbnail.jpg'),
(14, 'Elden Ring', 'FromSoftware', 59.99, '2022-02-25', 'THE NEW FANTASY ACTION RPG. Rise, Tarnished, and be guided by grace to brandish the power of the Elden Ring and become an Elden Lord in the Lands Between.', 4.90, 1, 0, 0, 1, 'Windows 11 64-bit', 'Intel Core i5-4460 / AMD Ryzen 3 1200', '10 GB RAM', 'GTX 1060 / RX 580 / Arc A750', 'Version 11', '30 GB available space', 'Windows 10 or later 64-bit', 'Intel Core i5-10600K / AMD Ryzen 5 5600', '24 GB RAM', 'RTX 3070 / RX 6800 / Arc A770', 'Version 12', '50 GB available space', 'assets/images/games/Elden Ring/banner.jpg', 'assets/images/games/Elden Ring/thumbnail.jpg'),
(15, 'Euro Truck Simulator 2', 'SCS Software', 19.99, '2012-10-19', 'Travel across Europe as king of the road, a trucker who delivers important cargo across impressive distances!', 4.90, 1, 0, 0, 0, 'Windows 10 64-bit', 'Intel Core i5-2500K / AMD FX-8350', '8 GB RAM', 'GTX 970 / RX 470', 'Version 12', '50 GB available space', 'Windows 10 64-bit', 'Intel Core i7-6700K / AMD Ryzen 7 2700X', '32 GB RAM', 'RTX 2060 Super / RX 5700', 'Version 12', '70 GB available space', 'assets/images/games/Euro Truck Simulator 2/banner.jpg', 'assets/images/games/Euro Truck Simulator 2/thumbnail.jpg'),
(16, 'Fallout New Vegas', 'Obsidian Entertainment', 9.99, '2010-10-19', 'Welcome to Vegas. New Vegas. Enjoy your stay!', 4.90, 1, 0, 0, 0, 'Windows 10 or later 64-bit', 'Intel Core i3-4340 / AMD FX-6300', '12 GB RAM', 'GTX 1650 / RX 5500 XT', 'Version 11', '70 GB available space', 'Windows 11 64-bit', 'Intel Core i5-9600K / AMD Ryzen 5 3600', '16 GB RAM', 'RTX 4060 / RX 7600 / Arc B580', 'Version 12', '100 GB available space', 'assets/images/games/Fallout New Vegas/banner.jpg', 'assets/images/games/Fallout New Vegas/thumbnail.jpg'),
(17, 'Final Fantasy VII Rebirth', 'Square Enix', 69.99, '2024-02-29', 'Cloud and his comrades escape the city of Midgar in pursuit of the fallen hero, Sephiroth.', 4.70, 1, 0, 0, 0, 'Windows 11 64-bit', 'Intel Core i5-6600K / AMD Ryzen R5 1600', '16 GB RAM', 'GTX 750 Ti / R7 370', 'Version 12', '100 GB available space', 'Windows 10 or later 64-bit', 'Intel Core i7-8700K / AMD Ryzen 5 5600X', '20 GB RAM', 'GTX 1080 Ti / RX Vega 64', 'Version 12', '125 GB available space', 'assets/images/games/Final Fantasy VII Rebirth/banner.jpg', 'assets/images/games/Final Fantasy VII Rebirth/thumbnail.jpg'),
(18, 'Hollow Knight', 'Team Cherry', 14.99, '2017-02-24', 'Forge your own path in Hollow Knight! An epic action adventure through a vast ruined kingdom of insects and heroes.', 4.90, 1, 0, 0, 1, 'Windows 10 64-bit', 'Intel Core i5-4460 / AMD Ryzen 3 1200', '6 GB RAM', 'GTX 960 / RX 560 / Arc A380', 'Version 11', '25 GB available space', 'Windows 10 64-bit', 'Intel Core i5-10600K / AMD Ryzen 5 5600', '24 GB RAM', 'RTX 2070 / RX 5700 XT / Arc B570', 'Version 12', '40 GB available space', 'assets/images/games/Hollow Knight/banner.jpg', 'assets/images/games/Hollow Knight/thumbnail.jpg'),
(19, 'Left 4 Dead 2', 'Valve', 9.99, '2009-11-17', 'Set in the zombie apocalypse, Left 4 Dead 2 (L4D2) is the highly anticipated sequel to the award-winning Left 4 Dead.', 4.90, 1, 0, 0, 0, 'Windows 10 or later 64-bit', 'Intel Core i5-2500K / AMD FX-8350', '10 GB RAM', 'GTX 1050 Ti / RX 580 / Arc A380', 'Version 12', '40 GB available space', 'Windows 11 64-bit', 'Intel Core i7-6700K / AMD Ryzen 7 2700X', '32 GB RAM', 'RTX 3060 Ti / RX 6700 XT / Arc A770', 'Version 12', '60 GB available space', 'assets/images/games/Left 4 Dead 2/banner.jpg', 'assets/images/games/Left 4 Dead 2/thumbnail.jpg'),
(20, 'Phasmophobia', 'Kinetic Games', 13.99, '2020-09-18', 'Phasmophobia is a 4 player online co-op psychological horror. Paranormal activity is on the rise and it’s up to you and your team to use all the ghost hunting equipment at your disposal.', 4.80, 1, 0, 0, 0, 'Windows 11 64-bit', 'Intel Core i3-4340 / AMD FX-6300', '8 GB RAM', 'GTX 1060 / RX 580 / Arc A750', 'Version 11', '60 GB available space', 'Windows 10 or later 64-bit', 'Intel Core i5-9600K / AMD Ryzen 5 3600', '16 GB RAM', 'RTX 3070 / RX 6800 / Arc A770', 'Version 12', '80 GB available space', 'assets/images/games/Phasmophobia/banner.jpg', 'assets/images/games/Phasmophobia/thumbnail.jpg'),
(21, 'Portal 2', 'Valve', 9.99, '2011-04-18', 'The \"Perpetual Testing Initiative\" has been expanded to allow you to design co-op puzzles for you and your friends!', 5.00, 1, 0, 1, 0, 'Windows 10 64-bit', 'Intel Core i5-6600K / AMD Ryzen R5 1600', '12 GB RAM', 'GTX 970 / RX 470', 'Version 12', '30 GB available space', 'Windows 10 64-bit', 'Intel Core i7-8700K / AMD Ryzen 5 5600X', '20 GB RAM', 'RTX 2060 Super / RX 5700', 'Version 12', '50 GB available space', 'assets/images/games/Portal 2/banner.jpg', 'assets/images/games/Portal 2/thumbnail.jpg'),
(22, 'PUBG BATTLEGROUNDS', 'KRAFTON', 0.00, '2017-12-21', 'Play PUBG: BATTLEGROUNDS for free. Land on strategic locations, loot weapons and supplies, and survive to become the last team standing.', 4.00, 1, 0, 0, 0, 'Windows 10 or later 64-bit', 'Intel Core i5-4460 / AMD Ryzen 3 1200', '16 GB RAM', 'GTX 1650 / RX 5500 XT', 'Version 11', '50 GB available space', 'Windows 11 64-bit', 'Intel Core i5-10600K / AMD Ryzen 5 5600', '24 GB RAM', 'RTX 4060 / RX 7600 / Arc B580', 'Version 12', '70 GB available space', 'assets/images/games/PUBG BATTLEGROUNDS/banner.jpg', 'assets/images/games/PUBG BATTLEGROUNDS/thumbnail.jpg'),
(23, 'Resident Evil Village', 'CAPCOM', 39.99, '2021-05-07', 'Experience survival horror like never before in the eighth major installment in the storied Resident Evil franchise - Resident Evil Village.', 4.80, 1, 0, 0, 0, 'Windows 11 64-bit', 'Intel Core i5-2500K / AMD FX-8350', '6 GB RAM', 'GTX 750 Ti / R7 370', 'Version 12', '70 GB available space', 'Windows 10 or later 64-bit', 'Intel Core i7-6700K / AMD Ryzen 7 2700X', '32 GB RAM', 'GTX 1080 Ti / RX Vega 64', 'Version 12', '100 GB available space', 'assets/images/games/Resident Evil Village/banner.jpg', 'assets/images/games/Resident Evil Village/thumbnail.jpg'),
(24, 'RUST', 'Facepunch Studios', 39.99, '2018-02-08', 'The only aim in Rust is to survive. Everything wants you to die. The island’s wildlife and other inhabitants, the environment, other survivors.', 4.40, 1, 0, 1, 0, 'Windows 10 64-bit', 'Intel Core i3-4340 / AMD FX-6300', '10 GB RAM', 'GTX 960 / RX 560 / Arc A380', 'Version 11', '100 GB available space', 'Windows 10 64-bit', 'Intel Core i5-9600K / AMD Ryzen 5 3600', '16 GB RAM', 'RTX 2070 / RX 5700 XT / Arc B570', 'Version 12', '125 GB available space', 'assets/images/games/RUST/banner.jpg', 'assets/images/games/RUST/thumbnail.jpg'),
(25, 'Sid Meier\'s Civilization VI', 'Firaxis Games', 59.99, '2016-10-21', 'Civilization VI offers new ways to interact with your world, expand your empire across the map, advance your culture, and compete against history’s greatest leaders.', 4.60, 1, 0, 0, 0, 'Windows 10 or later 64-bit', 'Intel Core i5-6600K / AMD Ryzen R5 1600', '8 GB RAM', 'GTX 1050 Ti / RX 580 / Arc A380', 'Version 12', '25 GB available space', 'Windows 11 64-bit', 'Intel Core i7-8700K / AMD Ryzen 5 5600X', '20 GB RAM', 'RTX 3060 Ti / RX 6700 XT / Arc A770', 'Version 12', '40 GB available space', 'assets/images/games/Sid Meier\'s Civilization VI/banner.jpg', 'assets/images/games/Sid Meier\'s Civilization VI/thumbnail.jpg'),
(26, 'Stardew Valley', 'ConcernedApe', 14.99, '2016-02-26', 'You\'ve inherited your grandfather\'s old farm plot in Stardew Valley. Armed with hand-me-down tools and a few coins, you set out to begin your new life.', 4.90, 1, 0, 0, 0, 'Windows 11 64-bit', 'Intel Core i5-4460 / AMD Ryzen 3 1200', '12 GB RAM', 'GTX 1060 / RX 580 / Arc A750', 'Version 11', '40 GB available space', 'Windows 10 or later 64-bit', 'Intel Core i5-10600K / AMD Ryzen 5 5600', '24 GB RAM', 'RTX 3070 / RX 6800 / Arc A770', 'Version 12', '60 GB available space', 'assets/images/games/Stardew Valley/banner.jpg', 'assets/images/games/Stardew Valley/thumbnail.jpg'),
(27, 'Terraria', 'Re-Logic', 9.99, '2011-05-16', 'Dig, fight, explore, build! Nothing is impossible in this action-packed adventure game.', 4.90, 1, 0, 0, 0, 'Windows 10 64-bit', 'Intel Core i5-2500K / AMD FX-8350', '16 GB RAM', 'GTX 970 / RX 470', 'Version 12', '60 GB available space', 'Windows 10 64-bit', 'Intel Core i7-6700K / AMD Ryzen 7 2700X', '32 GB RAM', 'RTX 2060 Super / RX 5700', 'Version 12', '80 GB available space', 'assets/images/games/Terraria/banner.jpg', 'assets/images/games/Terraria/thumbnail.jpg'),
(28, 'The Witcher 3 Wild Hunt', 'CD PROJEKT RED', 39.99, '2015-05-18', 'You are Geralt of Rivia, mercenary monster slayer. Before you stands a war-torn, monster-infested continent you can explore at will.', 4.90, 1, 0, 0, 0, 'Windows 10 or later 64-bit', 'Intel Core i3-4340 / AMD FX-6300', '6 GB RAM', 'GTX 1650 / RX 5500 XT', 'Version 11', '30 GB available space', 'Windows 11 64-bit', 'Intel Core i5-9600K / AMD Ryzen 5 3600', '16 GB RAM', 'RTX 4060 / RX 7600 / Arc B580', 'Version 12', '50 GB available space', 'assets/images/games/The Witcher 3 Wild Hunt/banner.jpg', 'assets/images/games/The Witcher 3 Wild Hunt/thumbnail.jpg'),
(29, 'Trailmakers', 'Flashbulb', 24.99, '2020-09-18', 'Build the ultimate vehicle and explore a vast open world filled with challenges.', 4.70, 1, 0, 0, 0, 'Windows 11 64-bit', 'Intel Core i5-6600K / AMD Ryzen R5 1600', '10 GB RAM', 'GTX 750 Ti / R7 370', 'Version 12', '50 GB available space', 'Windows 10 or later 64-bit', 'Intel Core i7-8700K / AMD Ryzen 5 5600X', '20 GB RAM', 'GTX 1080 Ti / RX Vega 64', 'Version 12', '70 GB available space', 'assets/images/games/Trailmakers/banner.jpg', 'assets/images/games/Trailmakers/thumbnail.jpg'),
(30, 'Vampire Survivors', 'poncle', 4.99, '2022-10-20', 'Mow down thousands of night creatures and survive until dawn! Vampire Survivors is a gothic horror casual game with rogue-lite elements.', 4.90, 1, 0, 0, 0, 'Windows 10 64-bit', 'Intel Core i5-4460 / AMD Ryzen 3 1200', '8 GB RAM', 'GTX 960 / RX 560 / Arc A380', 'Version 11', '70 GB available space', 'Windows 10 64-bit', 'Intel Core i5-10600K / AMD Ryzen 5 5600', '24 GB RAM', 'RTX 2070 / RX 5700 XT / Arc B570', 'Version 12', '100 GB available space', 'assets/images/games/Vampire Survivors/banner.jpg', 'assets/images/games/Vampire Survivors/thumbnail.jpg'),
(31, 'World Of Warships', 'Wargaming Group', 0.00, '2017-11-15', 'Immerse yourself in thrilling naval battles and assemble an armada of over 600 ships from the first half of the 20th century.', 4.30, 1, 0, 1, 0, 'Windows 10 or later 64-bit', 'Intel Core i5-2500K / AMD FX-8350', '12 GB RAM', 'GTX 1050 Ti / RX 580 / Arc A380', 'Version 12', '100 GB available space', 'Windows 11 64-bit', 'Intel Core i7-6700K / AMD Ryzen 7 2700X', '32 GB RAM', 'RTX 3060 Ti / RX 6700 XT / Arc A770', 'Version 12', '125 GB available space', 'assets/images/games/World Of Warships/banner.jpg', 'assets/images/games/World Of Warships/thumbnail.jpg'),
(32, 'Worms W.M.D', 'Team17', 29.99, '2016-08-23', 'The worms are back in their most destructive game yet. With a gorgeous, hand-drawn 2D look, brand new weapons, the introduction of crafting, vehicles and buildings!', 4.60, 1, 0, 1, 0, 'Windows 11 64-bit', 'Intel Core i3-4340 / AMD FX-6300', '16 GB RAM', 'GTX 1060 / RX 580 / Arc A750', 'Version 11', '25 GB available space', 'Windows 10 or later 64-bit', 'Intel Core i5-9600K / AMD Ryzen 5 3600', '16 GB RAM', 'RTX 3070 / RX 6800 / Arc A770', 'Version 12', '40 GB available space', 'assets/images/games/Worms W.M.D/banner.jpg', 'assets/images/games/Worms W.M.D/thumbnail.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `game_genre`
--

CREATE TABLE `game_genre` (
  `junction_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game_genre`
--

INSERT INTO `game_genre` (`junction_id`, `game_id`, `genre_id`) VALUES
(1, 1, 4),
(2, 2, 1),
(3, 3, 5),
(4, 3, 6),
(5, 4, 1),
(6, 5, 1),
(7, 5, 9),
(8, 6, 1),
(9, 6, 3),
(10, 7, 2),
(11, 7, 13),
(12, 8, 1),
(13, 9, 3),
(14, 10, 1),
(15, 10, 9),
(16, 11, 1),
(17, 11, 3),
(18, 12, 2),
(19, 12, 5),
(20, 13, 10),
(21, 13, 4),
(22, 14, 3),
(23, 14, 1),
(24, 15, 5),
(25, 16, 3),
(26, 17, 3),
(27, 18, 2),
(28, 18, 1),
(29, 19, 1),
(30, 19, 9),
(31, 20, 9),
(32, 21, 7),
(33, 21, 2),
(34, 22, 1),
(35, 23, 1),
(36, 23, 9),
(37, 24, 2),
(38, 24, 1),
(39, 25, 4),
(40, 26, 5),
(41, 26, 3),
(42, 27, 2),
(43, 27, 12),
(44, 28, 3),
(45, 29, 5),
(46, 30, 1),
(47, 31, 1),
(48, 31, 5),
(49, 32, 4);

-- --------------------------------------------------------

--
-- Table structure for table `game_media`
--

CREATE TABLE `game_media` (
  `media_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `media_url` varchar(255) NOT NULL,
  `media_type` enum('screenshot','gif','thumbnail','video') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game_media`
--

INSERT INTO `game_media` (`media_id`, `game_id`, `media_url`, `media_type`) VALUES
(1, 1, 'assets/images/games/Age of Wonders 4/1.jpg', 'screenshot'),
(2, 1, 'assets/images/games/Age of Wonders 4/2.jpg', 'screenshot'),
(3, 1, 'assets/images/games/Age of Wonders 4/3.jpg', 'screenshot'),
(4, 2, 'assets/images/games/Among Us/1.jpg', 'screenshot'),
(5, 2, 'assets/images/games/Among Us/2.jpg', 'screenshot'),
(6, 2, 'assets/images/games/Among Us/3.jpg', 'screenshot'),
(7, 3, 'assets/images/games/Assetto Corsa/1.jpg', 'screenshot'),
(8, 3, 'assets/images/games/Assetto Corsa/2.jpg', 'screenshot'),
(9, 3, 'assets/images/games/Assetto Corsa/3.jpg', 'screenshot'),
(10, 4, 'assets/images/games/Battlefield 6/1.jpg', 'screenshot'),
(11, 4, 'assets/images/games/Battlefield 6/2.jpg', 'screenshot'),
(12, 4, 'assets/images/games/Battlefield 6/3.jpg', 'screenshot'),
(13, 5, 'assets/images/games/Blood Fresh Supply/1.jpg', 'screenshot'),
(14, 5, 'assets/images/games/Blood Fresh Supply/2.jpg', 'screenshot'),
(15, 5, 'assets/images/games/Blood Fresh Supply/3.jpg', 'screenshot'),
(16, 6, 'assets/images/games/Borderlands 2/1.jpg', 'screenshot'),
(17, 6, 'assets/images/games/Borderlands 2/2.jpg', 'screenshot'),
(18, 6, 'assets/images/games/Borderlands 2/3.jpg', 'screenshot'),
(19, 7, 'assets/images/games/Celeste/1.jpg', 'screenshot'),
(20, 7, 'assets/images/games/Celeste/2.jpg', 'screenshot'),
(21, 7, 'assets/images/games/Celeste/3.jpg', 'screenshot'),
(22, 8, 'assets/images/games/Counter-Strike 2/1.jpg', 'screenshot'),
(23, 8, 'assets/images/games/Counter-Strike 2/2.jpg', 'screenshot'),
(24, 8, 'assets/images/games/Counter-Strike 2/3.jpg', 'screenshot'),
(25, 9, 'assets/images/games/Cyberpunk 2077/1.jpg', 'screenshot'),
(26, 9, 'assets/images/games/Cyberpunk 2077/2.jpg', 'screenshot'),
(27, 9, 'assets/images/games/Cyberpunk 2077/3.jpg', 'screenshot'),
(28, 10, 'assets/images/games/Dead by Daylight/1.jpg', 'screenshot'),
(29, 10, 'assets/images/games/Dead by Daylight/2.jpg', 'screenshot'),
(30, 10, 'assets/images/games/Dead by Daylight/3.jpg', 'screenshot'),
(31, 11, 'assets/images/games/Deus Ex Mankind Divided/1.jpg', 'screenshot'),
(32, 11, 'assets/images/games/Deus Ex Mankind Divided/2.jpg', 'screenshot'),
(33, 11, 'assets/images/games/Deus Ex Mankind Divided/3.jpg', 'screenshot'),
(34, 12, 'assets/images/games/Don\'t Starve/1.jpg', 'screenshot'),
(35, 12, 'assets/images/games/Don\'t Starve/2.jpg', 'screenshot'),
(36, 12, 'assets/images/games/Don\'t Starve/3.jpg', 'screenshot'),
(37, 13, 'assets/images/games/Dota 2/1.jpg', 'screenshot'),
(38, 13, 'assets/images/games/Dota 2/2.jpg', 'screenshot'),
(39, 13, 'assets/images/games/Dota 2/3.jpg', 'screenshot'),
(40, 14, 'assets/images/games/Elden Ring/1.jpg', 'screenshot'),
(41, 14, 'assets/images/games/Elden Ring/2.jpg', 'screenshot'),
(42, 14, 'assets/images/games/Elden Ring/3.jpg', 'screenshot'),
(43, 15, 'assets/images/games/Euro Truck Simulator 2/1.jpg', 'screenshot'),
(44, 15, 'assets/images/games/Euro Truck Simulator 2/2.jpg', 'screenshot'),
(45, 15, 'assets/images/games/Euro Truck Simulator 2/3.jpg', 'screenshot'),
(46, 16, 'assets/images/games/Fallout New Vegas/1.jpg', 'screenshot'),
(47, 16, 'assets/images/games/Fallout New Vegas/2.jpg', 'screenshot'),
(48, 16, 'assets/images/games/Fallout New Vegas/3.jpg', 'screenshot'),
(49, 17, 'assets/images/games/Final Fantasy VII Rebirth/1.jpg', 'screenshot'),
(50, 17, 'assets/images/games/Final Fantasy VII Rebirth/2.jpg', 'screenshot'),
(51, 17, 'assets/images/games/Final Fantasy VII Rebirth/3.jpg', 'screenshot'),
(52, 18, 'assets/images/games/Hollow Knight/1.jpg', 'screenshot'),
(53, 18, 'assets/images/games/Hollow Knight/2.jpg', 'screenshot'),
(54, 18, 'assets/images/games/Hollow Knight/3.jpg', 'screenshot'),
(55, 19, 'assets/images/games/Left 4 Dead 2/1.jpg', 'screenshot'),
(56, 19, 'assets/images/games/Left 4 Dead 2/2.jpg', 'screenshot'),
(57, 19, 'assets/images/games/Left 4 Dead 2/3.jpg', 'screenshot'),
(58, 20, 'assets/images/games/Phasmophobia/1.jpg', 'screenshot'),
(59, 20, 'assets/images/games/Phasmophobia/2.jpg', 'screenshot'),
(60, 20, 'assets/images/games/Phasmophobia/3.jpg', 'screenshot'),
(61, 21, 'assets/images/games/Portal 2/1.jpg', 'screenshot'),
(62, 21, 'assets/images/games/Portal 2/2.jpg', 'screenshot'),
(63, 21, 'assets/images/games/Portal 2/3.jpg', 'screenshot'),
(64, 22, 'assets/images/games/PUBG BATTLEGROUNDS/1.jpg', 'screenshot'),
(65, 22, 'assets/images/games/PUBG BATTLEGROUNDS/2.jpg', 'screenshot'),
(66, 22, 'assets/images/games/PUBG BATTLEGROUNDS/3.jpg', 'screenshot'),
(67, 23, 'assets/images/games/Resident Evil Village/1.jpg', 'screenshot'),
(68, 23, 'assets/images/games/Resident Evil Village/2.jpg', 'screenshot'),
(69, 23, 'assets/images/games/Resident Evil Village/3.jpg', 'screenshot'),
(70, 24, 'assets/images/games/RUST/1.jpg', 'screenshot'),
(71, 24, 'assets/images/games/RUST/2.jpg', 'screenshot'),
(72, 24, 'assets/images/games/RUST/3.jpg', 'screenshot'),
(73, 25, 'assets/images/games/Sid Meier\'s Civilization VI/1.jpg', 'screenshot'),
(74, 25, 'assets/images/games/Sid Meier\'s Civilization VI/2.jpg', 'screenshot'),
(75, 25, 'assets/images/games/Sid Meier\'s Civilization VI/3.jpg', 'screenshot'),
(76, 26, 'assets/images/games/Stardew Valley/1.jpg', 'screenshot'),
(77, 26, 'assets/images/games/Stardew Valley/2.jpg', 'screenshot'),
(78, 26, 'assets/images/games/Stardew Valley/3.jpg', 'screenshot'),
(79, 27, 'assets/images/games/Terraria/1.jpg', 'screenshot'),
(80, 27, 'assets/images/games/Terraria/2.jpg', 'screenshot'),
(81, 27, 'assets/images/games/Terraria/3.jpg', 'screenshot'),
(82, 28, 'assets/images/games/The Witcher 3 Wild Hunt/1.jpg', 'screenshot'),
(83, 28, 'assets/images/games/The Witcher 3 Wild Hunt/2.jpg', 'screenshot'),
(84, 28, 'assets/images/games/The Witcher 3 Wild Hunt/3.jpg', 'screenshot'),
(85, 29, 'assets/images/games/Trailmakers/1.jpg', 'screenshot'),
(86, 29, 'assets/images/games/Trailmakers/2.jpg', 'screenshot'),
(87, 29, 'assets/images/games/Trailmakers/3.jpg', 'screenshot'),
(88, 30, 'assets/images/games/Vampire Survivors/1.jpg', 'screenshot'),
(89, 30, 'assets/images/games/Vampire Survivors/2.jpg', 'screenshot'),
(90, 30, 'assets/images/games/Vampire Survivors/3.jpg', 'screenshot'),
(91, 31, 'assets/images/games/World Of Warships/1.jpg', 'screenshot'),
(92, 31, 'assets/images/games/World Of Warships/2.jpg', 'screenshot'),
(93, 31, 'assets/images/games/World Of Warships/3.jpg', 'screenshot'),
(94, 32, 'assets/images/games/Worms W.M.D/1.jpg', 'screenshot'),
(95, 32, 'assets/images/games/Worms W.M.D/2.jpg', 'screenshot'),
(96, 32, 'assets/images/games/Worms W.M.D/3.jpg', 'screenshot'),
(98, 1, 'assets/videos/trailers/Age of Wonders 4.mp4', 'video'),
(99, 2, 'assets/videos/trailers/AmongUs.mp4', 'video'),
(100, 3, 'assets/videos/trailers/assetto corsa.mp4', 'video'),
(101, 4, 'assets/videos/trailers/BattleField6.mp4', 'video');

-- --------------------------------------------------------

--
-- Table structure for table `game_tag`
--

CREATE TABLE `game_tag` (
  `junction_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game_tag`
--

INSERT INTO `game_tag` (`junction_id`, `game_id`, `tag_id`) VALUES
(1, 1, 15),
(2, 1, 32),
(3, 2, 1),
(4, 2, 3),
(5, 3, 22),
(6, 3, 26),
(7, 4, 6),
(8, 4, 3),
(9, 5, 6),
(10, 5, 27),
(11, 6, 6),
(12, 6, 2),
(13, 7, 1),
(14, 7, 10),
(15, 8, 6),
(16, 8, 3),
(17, 8, 11),
(18, 9, 4),
(19, 9, 21),
(20, 10, 3),
(21, 10, 11),
(22, 11, 21),
(23, 11, 14),
(24, 12, 1),
(25, 12, 25),
(26, 13, 11),
(27, 13, 15),
(28, 14, 4),
(29, 14, 15),
(30, 15, 22),
(31, 15, 4),
(32, 16, 4),
(33, 16, 20),
(34, 17, 17),
(35, 17, 15),
(36, 18, 19),
(37, 18, 1),
(38, 19, 6),
(39, 19, 2),
(40, 20, 27),
(41, 20, 1),
(42, 21, 21),
(43, 21, 26),
(44, 22, 13),
(45, 22, 11),
(46, 23, 6),
(47, 23, 27),
(48, 24, 4),
(49, 24, 3),
(50, 25, 32),
(51, 26, 24),
(52, 26, 10),
(53, 27, 10),
(54, 27, 4),
(55, 28, 4),
(56, 28, 15),
(57, 29, 9),
(58, 29, 26),
(59, 30, 18),
(60, 30, 10),
(61, 31, 11),
(62, 31, 3),
(63, 32, 2),
(64, 32, 1);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genre_id` int(11) NOT NULL,
  `genre_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genre_id`, `genre_name`) VALUES
(1, 'Action'),
(2, 'Adventure'),
(8, 'Fighting'),
(9, 'Horror'),
(10, 'MOBA'),
(13, 'Platformer'),
(7, 'Puzzle'),
(3, 'Role-Playing (RPG)'),
(12, 'Sandbox'),
(5, 'Simulation'),
(6, 'Sports'),
(14, 'Stealth'),
(4, 'Strategy'),
(11, 'Survival');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `reset_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token_hash` varchar(64) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `used` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`id`, `user_id`, `token_hash`, `expires_at`, `created_at`, `used`) VALUES
(1, 3, '4eca9ce46f5f7783f744ee8c123e2638e1f3416c36d39f7bf0040e46bcaf75fb', '2025-11-25 08:42:51', '2025-11-25 06:42:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `comment` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `game_id`, `rating`, `comment`, `created_at`) VALUES
(132, 3, 1, 5, 'Fantastic 4X game! The blend of fantasy and tactical combat is highly addictive.', '2025-11-25 11:36:51'),
(133, 3, 2, 4, 'Great fun with friends, perfect for short, chaotic sessions. Sus is my new favorite word.', '2025-11-25 11:36:51'),
(134, 3, 3, 5, 'I love it.', '2025-11-30 18:06:13'),
(135, 3, 4, 4, 'Excellent graphics and sound design. The large-scale warfare feels immersive.', '2025-11-25 11:36:51'),
(136, 3, 5, 5, 'Pure 90s carnage. The atmosphere is tense and the level design is complex and rewarding.', '2025-11-25 11:36:51'),
(137, 3, 6, 5, 'The looting and shooting never gets old. Handsome Jack is one of the best antagonists in gaming.', '2025-11-25 11:36:51'),
(138, 3, 7, 5, 'An emotional masterpiece. The platforming difficulty is challenging but always fair.', '2025-11-25 11:36:51'),
(139, 3, 8, 5, 'The competitive FPS standard. Graphics update is clean and the hit registration feels crisp.', '2025-11-25 11:36:51'),
(140, 3, 9, 5, 'The visual detail in Night City is stunning. Took me 80 hours to finish the main story!', '2025-11-25 11:36:51'),
(141, 3, 10, 4, 'Tense multiplayer horror experience. Playing as the killer is genuinely stressful.', '2025-11-25 11:36:51'),
(142, 3, 11, 5, 'Jensen is a great protagonist. The future-noir aesthetic and political intrigue are brilliant.', '2025-11-25 11:36:51'),
(143, 3, 12, 5, 'Brutal but beautiful survival game. The art style is unique and charming.', '2025-11-25 11:36:51'),
(144, 3, 13, 4, 'The pinnacle of competitive MOBAs. Massive hero pool and complex strategy.', '2025-11-25 11:36:51'),
(145, 3, 14, 5, 'A generational masterpiece. The sense of discovery in the open world is unmatched.', '2025-11-25 11:36:51'),
(146, 3, 15, 5, 'Surprisingly addictive. Excellent simulation detail, especially when driving at night.', '2025-11-25 11:36:51'),
(147, 3, 16, 5, 'Still the best modern Fallout game. The writing and branching quests are excellent.', '2025-11-25 11:36:51'),
(148, 3, 17, 5, 'Incredible visuals and soundtrack. A truly epic continuation of the story.', '2025-11-25 11:36:51'),
(149, 3, 18, 5, 'Beautiful, haunting, and meticulously crafted. A perfect Metroidvania.', '2025-11-25 11:36:51'),
(150, 3, 19, 5, 'Timeless co-op zombie shooter. Still holds up better than most new titles.', '2025-11-25 11:36:51'),
(151, 3, 20, 5, 'A genuinely scary ghost-hunting simulator. Requires actual teamwork and deduction.', '2025-11-25 11:36:51'),
(152, 3, 21, 5, 'One of the best puzzle games ever made. GLaDOS is an iconic character.', '2025-11-25 11:36:51'),
(153, 3, 22, 4, 'The original battle royale formula. Great map variety and large player counts.', '2025-11-25 11:36:51'),
(154, 5, 3, 5, 'Didn\'t like this game at all.', '2025-11-30 18:12:52');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`) VALUES
(28, 'Anime'),
(25, 'Base Building'),
(9, 'Building'),
(22, 'Driving'),
(5, 'Early Access'),
(15, 'Fantasy'),
(24, 'Farming'),
(6, 'First-Person Shooter (FPS)'),
(12, 'FPS'),
(11, 'Free to Play'),
(32, 'Grand Strategy'),
(29, 'Hack and Slash'),
(1, 'Indie'),
(17, 'JRPG'),
(2, 'Local Co-op'),
(19, 'Metroidvania'),
(3, 'Online Multiplayer'),
(4, 'Open World'),
(26, 'Physics'),
(10, 'Pixel Graphics'),
(20, 'Post-apocalyptic'),
(27, 'Psychological Horror'),
(18, 'Roguelike'),
(21, 'Sci-Fi'),
(13, 'Shooter'),
(16, 'Story Rich'),
(8, 'Survival'),
(14, 'Tactical'),
(7, 'Third-Person'),
(23, 'Vehicular Combat'),
(30, 'WWI'),
(31, 'WWII');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'Primary Key. Always use a specific name like user_id.',
  `is_admin` int(1) NOT NULL DEFAULT 0,
  `time_stamp` date NOT NULL DEFAULT current_timestamp(),
  `username` varchar(50) NOT NULL COMMENT 'For login (e.g., "GamerTag123"). Required.',
  `email` varchar(100) NOT NULL COMMENT 'For login and recovery. Required.',
  `password_hash` varchar(255) NOT NULL COMMENT 'Crucial: Stores the secure HASHED password.',
  `display_name` varchar(100) NOT NULL COMMENT 'The friendly name users see (e.g., a real name or an alias).',
  `country` varchar(50) NOT NULL COMMENT 'User''s geographic location.',
  `age` int(7) NOT NULL COMMENT 'minimum ages are required by some games. like 18',
  `avatar_url` varchar(255) DEFAULT 'assets/images/avatars/default.jpg',
  `about` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `is_admin`, `time_stamp`, `username`, `email`, `password_hash`, `display_name`, `country`, `age`, `avatar_url`, `about`) VALUES
(3, 1, '2025-11-26', 'Zain', 'zainbinkhalid510@gmail.com', '$2y$12$oVTNqierbfDMj5UXWNS7mur1IuRQ9lAOxf7NGgS9gf1DJdJZdbTQu', 'Zain', 'Pakistan', 18, 'assets/images/avatars/default.png', 'I am the admin of this website.'),
(5, 0, '2025-11-30', 'test', 'quitekiller510@gmail.com', '$2y$12$vYS41LQpk14WdnUdDNBnZuXhNtCvdZC0h2AaQXXlCVstEG65.Pe12', 'test', 'China', 19, 'assets/images/avatars/default.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `user_id`, `game_id`, `added_date`) VALUES
(1, 3, 1, '2025-11-25 11:14:00'),
(2, 3, 2, '2025-11-25 11:14:00'),
(3, 3, 3, '2025-11-25 11:14:00'),
(4, 3, 4, '2025-11-25 11:14:00'),
(5, 3, 5, '2025-11-25 11:14:00'),
(6, 3, 6, '2025-11-25 11:14:00'),
(7, 3, 7, '2025-11-25 11:14:00'),
(8, 3, 8, '2025-11-25 11:14:00'),
(9, 3, 9, '2025-11-25 11:14:00'),
(10, 3, 10, '2025-11-25 11:14:00'),
(11, 3, 11, '2025-11-25 11:14:00'),
(12, 3, 12, '2025-11-25 11:14:00'),
(13, 3, 13, '2025-11-25 11:14:00'),
(14, 3, 14, '2025-11-25 11:14:00'),
(15, 3, 15, '2025-11-25 11:14:00'),
(16, 3, 16, '2025-11-25 11:14:00'),
(17, 3, 17, '2025-11-25 11:14:00'),
(18, 3, 18, '2025-11-25 11:14:00'),
(19, 3, 19, '2025-11-25 11:14:00'),
(20, 3, 20, '2025-11-25 11:14:00'),
(21, 3, 21, '2025-11-25 11:14:00'),
(22, 3, 22, '2025-11-25 11:14:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `fk_chat_user` (`user_id`);

--
-- Indexes for table `community_posts`
--
ALTER TABLE `community_posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `fk_post_user` (`user_id`);

--
-- Indexes for table `community_post_reactions`
--
ALTER TABLE `community_post_reactions`
  ADD PRIMARY KEY (`reaction_id`),
  ADD UNIQUE KEY `unique_reaction` (`post_id`,`user_id`),
  ADD KEY `fk_react_post` (`post_id`),
  ADD KEY `fk_react_user` (`user_id`);

--
-- Indexes for table `community_replies`
--
ALTER TABLE `community_replies`
  ADD PRIMARY KEY (`reply_id`),
  ADD KEY `fk_reply_post` (`post_id`),
  ADD KEY `fk_reply_user` (`user_id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_id`),
  ADD UNIQUE KEY `unique_title` (`title`);

--
-- Indexes for table `game_genre`
--
ALTER TABLE `game_genre`
  ADD PRIMARY KEY (`junction_id`),
  ADD KEY `fk_game_games_id` (`game_id`),
  ADD KEY `fk_genre_genre_id` (`genre_id`);

--
-- Indexes for table `game_media`
--
ALTER TABLE `game_media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `media_fk_game_games_id` (`game_id`);

--
-- Indexes for table `game_tag`
--
ALTER TABLE `game_tag`
  ADD PRIMARY KEY (`junction_id`),
  ADD KEY `tags_fk_game_games_id` (`game_id`),
  ADD KEY `fk_tag_tag_id` (`tag_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`),
  ADD UNIQUE KEY `unique_genre` (`genre_name`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`reset_id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `fk_reset_user` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_token_hash` (`token_hash`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_expires_at` (`expires_at`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD UNIQUE KEY `user_review_unique` (`user_id`,`game_id`),
  ADD KEY `fk_review_user` (`user_id`),
  ADD KEY `fk_review_game` (`game_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`),
  ADD UNIQUE KEY `unique_tag` (`tag_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `unique_username` (`username`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD UNIQUE KEY `user_wishlist_unique` (`user_id`,`game_id`),
  ADD KEY `fk_wish_user` (`user_id`),
  ADD KEY `fk_wish_game` (`game_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `community_posts`
--
ALTER TABLE `community_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `community_post_reactions`
--
ALTER TABLE `community_post_reactions`
  MODIFY `reaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `community_replies`
--
ALTER TABLE `community_replies`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.', AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `game_genre`
--
ALTER TABLE `game_genre`
  MODIFY `junction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `game_media`
--
ALTER TABLE `game_media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `game_tag`
--
ALTER TABLE `game_tag`
  MODIFY `junction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `reset_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key. Always use a specific name like user_id.', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD CONSTRAINT `fk_chat_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `community_posts`
--
ALTER TABLE `community_posts`
  ADD CONSTRAINT `fk_post_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `community_post_reactions`
--
ALTER TABLE `community_post_reactions`
  ADD CONSTRAINT `fk_react_post` FOREIGN KEY (`post_id`) REFERENCES `community_posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_react_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `community_replies`
--
ALTER TABLE `community_replies`
  ADD CONSTRAINT `fk_reply_post` FOREIGN KEY (`post_id`) REFERENCES `community_posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_reply_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `game_genre`
--
ALTER TABLE `game_genre`
  ADD CONSTRAINT `fk_game_games_id` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`),
  ADD CONSTRAINT `fk_genre_genre_id` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`);

--
-- Constraints for table `game_media`
--
ALTER TABLE `game_media`
  ADD CONSTRAINT `media_fk_game_games_id` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`);

--
-- Constraints for table `game_tag`
--
ALTER TABLE `game_tag`
  ADD CONSTRAINT `fk_tag_tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`),
  ADD CONSTRAINT `tags_fk_game_games_id` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`);

--
-- Constraints for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `fk_reset_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD CONSTRAINT `password_reset_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_review_game` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_review_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `fk_wish_game` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_wish_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
