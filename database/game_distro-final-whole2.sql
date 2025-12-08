-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2025 at 09:43 AM
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
  `thumbnail_image` varchar(255) DEFAULT NULL COMMENT 'Small portrait image for grids',
  `download_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`game_id`, `title`, `developer_name`, `price`, `release_date`, `description`, `average_rating`, `is_published`, `is_featured`, `is_special_offer`, `is_recommended`, `min_os`, `min_processor`, `min_memory`, `min_graphics`, `min_directx`, `min_storage`, `rec_os`, `rec_processor`, `rec_memory`, `rec_graphics`, `rec_directx`, `rec_storage`, `header_image`, `thumbnail_image`, `download_url`) VALUES
(1, 'Age of Wonders 4', 'Triumph Studios', 49.99, '2023-05-02', 'Rule a fantasy realm of your own design! Explore new magical realms in Age of Wonders’ signature blend of 4X strategy and turn-based tactical combat.', 4.50, 1, 0, 0, 1, 'Windows 10 or later 64-bit', 'Intel Core i5-6600K / AMD Ryzen R5 1600', '12 GB RAM', 'GTX 1050 Ti / RX 580 / Arc A380', 'Version 12', '50 GB available space', 'Windows 11 64-bit', 'Intel Core i7-8700K / AMD Ryzen 5 5600X', '20 GB RAM', 'RTX 3060 Ti / RX 6700 XT / Arc A770', 'Version 12', '70 GB available space', 'assets/images/games/Age of Wonders 4/banner.jpg', 'assets/images/games/Age of Wonders 4/thumbnail.jpg', 'https://drive.google.com/uc?id=view'),
(2, 'Among Us', 'Innersloth', 4.99, '2018-11-16', 'An online and local party game of teamwork and betrayal for 4-15 players... in space!', 4.80, 1, 0, 0, 1, 'Windows 11 64-bit', 'Intel Core i5-4460 / AMD Ryzen 3 1200', '16 GB RAM', 'GTX 1060 / RX 580 / Arc A750', 'Version 11', '70 GB available space', 'Windows 10 or later 64-bit', 'Intel Core i5-10600K / AMD Ryzen 5 5600', '24 GB RAM', 'RTX 3070 / RX 6800 / Arc A770', 'Version 12', '100 GB available space', 'assets/images/games/Among Us/banner.jpg', 'assets/images/games/Among Us/thumbnail.jpg', NULL),
(3, 'Assetto Corsa', 'Kunos Simulazioni', 19.99, '2014-12-19', 'Assetto Corsa features an advanced DirectX 11 graphics engine that recreates an immersive environment, dynamic lighthing and realistic materials and surfaces.', 5.00, 1, 1, 0, 0, 'Windows 10 64-bit', 'Intel Core i5-2500K / AMD FX-8350', '6 GB RAM', 'GTX 970 / RX 470', 'Version 12', '100 GB available space', 'Windows 10 64-bit', 'Intel Core i7-6700K / AMD Ryzen 7 2700X', '32 GB RAM', 'RTX 2060 Super / RX 5700', 'Version 12', '125 GB available space', 'assets/images/games/Assetto Corsa/banner.jpg', 'assets/images/games/Assetto Corsa/thumbnail.jpg', NULL),
(4, 'Battlefield 6', 'DICE', 59.99, '2021-11-19', 'Battlefield™ 2042 is a first-person shooter that marks the return to the iconic all-out warfare of the franchise.', 3.50, 1, 1, 0, 0, 'Windows 10 or later 64-bit', 'Intel Core i3-4340 / AMD FX-6300', '10 GB RAM', 'GTX 1650 / RX 5500 XT', 'Version 11', '25 GB available space', 'Windows 11 64-bit', 'Intel Core i5-9600K / AMD Ryzen 5 3600', '16 GB RAM', 'RTX 4060 / RX 7600 / Arc B580', 'Version 12', '40 GB available space', 'assets/images/games/Battlefield 6/banner.jpg', 'assets/images/games/Battlefield 6/thumbnail.jpg', NULL),
(5, 'Blood Fresh Supply', 'Nightdive Studios', 9.99, '2019-05-09', 'Battle an army of sycophantic cultists, zombies, gargoyles, hellhounds, and an insatiable host of horrors in your quest to defeat the evil Tchernobog.', 4.70, 1, 0, 0, 0, 'Windows 11 64-bit', 'Intel Core i5-6600K / AMD Ryzen R5 1600', '8 GB RAM', 'GTX 750 Ti / R7 370', 'Version 12', '40 GB available space', 'Windows 10 or later 64-bit', 'Intel Core i7-8700K / AMD Ryzen 5 5600X', '20 GB RAM', 'GTX 1080 Ti / RX Vega 64', 'Version 12', '60 GB available space', 'assets/images/games/Blood Fresh Supply/banner.jpg', 'assets/images/games/Blood Fresh Supply/thumbnail.jpg', NULL),
(6, 'Borderlands 2', 'Gearbox Software', 19.99, '2012-09-17', 'A new era of shoot and loot is about to begin. Play as one of four new vault hunters facing off against a massive new world of creatures, psychos and the evil mastermind, Handsome Jack.', 4.90, 1, 0, 0, 0, 'Windows 10 64-bit', 'Intel Core i5-4460 / AMD Ryzen 3 1200', '12 GB RAM', 'GTX 960 / RX 560 / Arc A380', 'Version 11', '60 GB available space', 'Windows 10 64-bit', 'Intel Core i5-10600K / AMD Ryzen 5 5600', '24 GB RAM', 'RTX 2070 / RX 5700 XT / Arc B570', 'Version 12', '80 GB available space', 'assets/images/games/Borderlands 2/banner.jpg', 'assets/images/games/Borderlands 2/thumbnail.jpg', NULL),
(7, 'Celeste', 'Maddy Makes Games', 19.99, '2018-01-25', 'Help Madeline survive her inner demons on her journey to the top of Celeste Mountain, in this super-tight, hand-crafted platformer from the creators of TowerFall.', 4.90, 1, 0, 0, 0, 'Windows 10 or later 64-bit', 'Intel Core i5-2500K / AMD FX-8350', '16 GB RAM', 'GTX 1050 Ti / RX 580 / Arc A380', 'Version 12', '30 GB available space', 'Windows 11 64-bit', 'Intel Core i7-6700K / AMD Ryzen 7 2700X', '32 GB RAM', 'RTX 3060 Ti / RX 6700 XT / Arc A770', 'Version 12', '50 GB available space', 'assets/images/games/Celeste/banner.jpg', 'assets/images/games/Celeste/thumbnail.jpg', NULL),
(8, 'Counter-Strike 2', 'Valve', 0.00, '2023-09-27', 'For over two decades, Counter-Strike has offered an elite competitive experience, one shaped by millions of players from across the globe.', 4.50, 1, 0, 0, 0, 'Windows 11 64-bit', 'Intel Core i3-4340 / AMD FX-6300', '6 GB RAM', 'GTX 1060 / RX 580 / Arc A750', 'Version 11', '50 GB available space', 'Windows 10 or later 64-bit', 'Intel Core i5-9600K / AMD Ryzen 5 3600', '16 GB RAM', 'RTX 3070 / RX 6800 / Arc A770', 'Version 12', '70 GB available space', 'assets/images/games/Counter-Strike 2/banner.jpg', 'assets/images/games/Counter-Strike 2/thumbnail.jpg', NULL),
(9, 'Cyberpunk 2077', 'CD PROJEKT RED', 59.99, '2020-12-10', 'Cyberpunk 2077 is an open-world, action-adventure RPG set in the megalopolis of Night City, where you play as a cyberpunk mercenary wrapped up in a do-or-die fight for survival.', 4.40, 1, 1, 0, 0, 'Windows 10 64-bit', 'Intel Core i5-6600K / AMD Ryzen R5 1600', '10 GB RAM', 'GTX 970 / RX 470', 'Version 12', '70 GB available space', 'Windows 10 64-bit', 'Intel Core i7-8700K / AMD Ryzen 5 5600X', '20 GB RAM', 'RTX 2060 Super / RX 5700', 'Version 12', '100 GB available space', 'assets/images/games/Cyberpunk 2077/banner.jpg', 'assets/images/games/Cyberpunk 2077/thumbnail.jpg', NULL),
(10, 'Dead by Daylight', 'Behaviour Interactive', 19.99, '2016-06-14', 'Dead by Daylight is a multiplayer (4vs1) horror game where one player takes on the role of the savage Killer, and the other four players play as Survivors.', 4.20, 1, 0, 1, 0, 'Windows 10 or later 64-bit', 'Intel Core i5-4460 / AMD Ryzen 3 1200', '8 GB RAM', 'GTX 1650 / RX 5500 XT', 'Version 11', '100 GB available space', 'Windows 11 64-bit', 'Intel Core i5-10600K / AMD Ryzen 5 5600', '24 GB RAM', 'RTX 4060 / RX 7600 / Arc B580', 'Version 12', '125 GB available space', 'assets/images/games/Dead by Daylight/banner.jpg', 'assets/images/games/Dead by Daylight/thumbnail.jpg', NULL),
(11, 'Deus Ex Mankind Divided', 'Eidos Montréal', 29.99, '2016-08-23', 'Now an experienced covert operative, Adam Jensen is forced to operate in a world that has grown to despise his kind.', 4.30, 1, 0, 0, 0, 'Windows 11 64-bit', 'Intel Core i5-2500K / AMD FX-8350', '12 GB RAM', 'GTX 750 Ti / R7 370', 'Version 12', '25 GB available space', 'Windows 10 or later 64-bit', 'Intel Core i7-6700K / AMD Ryzen 7 2700X', '32 GB RAM', 'GTX 1080 Ti / RX Vega 64', 'Version 12', '40 GB available space', 'assets/images/games/Deus Ex Mankind Divided/banner.jpg', 'assets/images/games/Deus Ex Mankind Divided/thumbnail.jpg', NULL),
(12, 'Don\'t Starve', 'Klei Entertainment', 9.99, '2013-04-23', 'Don’t Starve is an uncompromising wilderness survival game full of science and magic.', 4.80, 1, 0, 0, 0, 'Windows 10 64-bit', 'Intel Core i3-4340 / AMD FX-6300', '16 GB RAM', 'GTX 960 / RX 560 / Arc A380', 'Version 11', '40 GB available space', 'Windows 10 64-bit', 'Intel Core i5-9600K / AMD Ryzen 5 3600', '16 GB RAM', 'RTX 2070 / RX 5700 XT / Arc B570', 'Version 12', '60 GB available space', 'assets/images/games/Don\'t Starve/banner.jpg', 'assets/images/games/Don\'t Starve/thumbnail.jpg', NULL),
(13, 'Dota 2', 'Valve', 0.00, '2013-07-09', 'Every day, millions of players worldwide enter battle as one of over a hundred Dota heroes.', 4.60, 1, 0, 1, 0, 'Windows 10 or later 64-bit', 'Intel Core i5-6600K / AMD Ryzen R5 1600', '6 GB RAM', 'GTX 1050 Ti / RX 580 / Arc A380', 'Version 12', '60 GB available space', 'Windows 11 64-bit', 'Intel Core i7-8700K / AMD Ryzen 5 5600X', '20 GB RAM', 'RTX 3060 Ti / RX 6700 XT / Arc A770', 'Version 12', '80 GB available space', 'assets/images/games/Dota 2/banner.jpg', 'assets/images/games/Dota 2/thumbnail.jpg', NULL),
(14, 'Elden Ring', 'FromSoftware', 59.99, '2022-02-25', 'THE NEW FANTASY ACTION RPG. Rise, Tarnished, and be guided by grace to brandish the power of the Elden Ring and become an Elden Lord in the Lands Between.', 4.90, 1, 0, 0, 0, 'Windows 11 64-bit', 'Intel Core i5-4460 / AMD Ryzen 3 1200', '10 GB RAM', 'GTX 1060 / RX 580 / Arc A750', 'Version 11', '30 GB available space', 'Windows 10 or later 64-bit', 'Intel Core i5-10600K / AMD Ryzen 5 5600', '24 GB RAM', 'RTX 3070 / RX 6800 / Arc A770', 'Version 12', '50 GB available space', 'assets/images/games/Elden Ring/banner.jpg', 'assets/images/games/Elden Ring/thumbnail.jpg', NULL),
(15, 'Euro Truck Simulator 2', 'SCS Software', 19.99, '2012-10-19', 'Travel across Europe as king of the road, a trucker who delivers important cargo across impressive distances!', 4.90, 1, 0, 0, 0, 'Windows 10 64-bit', 'Intel Core i5-2500K / AMD FX-8350', '8 GB RAM', 'GTX 970 / RX 470', 'Version 12', '50 GB available space', 'Windows 10 64-bit', 'Intel Core i7-6700K / AMD Ryzen 7 2700X', '32 GB RAM', 'RTX 2060 Super / RX 5700', 'Version 12', '70 GB available space', 'assets/images/games/Euro Truck Simulator 2/banner.jpg', 'assets/images/games/Euro Truck Simulator 2/thumbnail.jpg', NULL),
(16, 'Fallout New Vegas', 'Obsidian Entertainment', 9.99, '2010-10-19', 'Welcome to Vegas. New Vegas. Enjoy your stay!', 4.90, 1, 0, 0, 0, 'Windows 10 or later 64-bit', 'Intel Core i3-4340 / AMD FX-6300', '12 GB RAM', 'GTX 1650 / RX 5500 XT', 'Version 11', '70 GB available space', 'Windows 11 64-bit', 'Intel Core i5-9600K / AMD Ryzen 5 3600', '16 GB RAM', 'RTX 4060 / RX 7600 / Arc B580', 'Version 12', '100 GB available space', 'assets/images/games/Fallout New Vegas/banner.jpg', 'assets/images/games/Fallout New Vegas/thumbnail.jpg', NULL),
(17, 'Final Fantasy VII Rebirth', 'Square Enix', 69.99, '2024-02-29', 'Cloud and his comrades escape the city of Midgar in pursuit of the fallen hero, Sephiroth.', 4.70, 1, 0, 0, 0, 'Windows 11 64-bit', 'Intel Core i5-6600K / AMD Ryzen R5 1600', '16 GB RAM', 'GTX 750 Ti / R7 370', 'Version 12', '100 GB available space', 'Windows 10 or later 64-bit', 'Intel Core i7-8700K / AMD Ryzen 5 5600X', '20 GB RAM', 'GTX 1080 Ti / RX Vega 64', 'Version 12', '125 GB available space', 'assets/images/games/Final Fantasy VII Rebirth/banner.jpg', 'assets/images/games/Final Fantasy VII Rebirth/thumbnail.jpg', NULL),
(18, 'Hollow Knight', 'Team Cherry', 14.99, '2017-02-24', 'Forge your own path in Hollow Knight! An epic action adventure through a vast ruined kingdom of insects and heroes.', 4.90, 1, 0, 0, 0, 'Windows 10 64-bit', 'Intel Core i5-4460 / AMD Ryzen 3 1200', '6 GB RAM', 'GTX 960 / RX 560 / Arc A380', 'Version 11', '25 GB available space', 'Windows 10 64-bit', 'Intel Core i5-10600K / AMD Ryzen 5 5600', '24 GB RAM', 'RTX 2070 / RX 5700 XT / Arc B570', 'Version 12', '40 GB available space', 'assets/images/games/Hollow Knight/banner.jpg', 'assets/images/games/Hollow Knight/thumbnail.jpg', NULL),
(19, 'Left 4 Dead 2', 'Valve', 9.99, '2009-11-17', 'Set in the zombie apocalypse, Left 4 Dead 2 (L4D2) is the highly anticipated sequel to the award-winning Left 4 Dead.', 4.90, 1, 0, 0, 0, 'Windows 10 or later 64-bit', 'Intel Core i5-2500K / AMD FX-8350', '10 GB RAM', 'GTX 1050 Ti / RX 580 / Arc A380', 'Version 12', '40 GB available space', 'Windows 11 64-bit', 'Intel Core i7-6700K / AMD Ryzen 7 2700X', '32 GB RAM', 'RTX 3060 Ti / RX 6700 XT / Arc A770', 'Version 12', '60 GB available space', 'assets/images/games/Left 4 Dead 2/banner.jpg', 'assets/images/games/Left 4 Dead 2/thumbnail.jpg', NULL),
(20, 'Phasmophobia', 'Kinetic Games', 13.99, '2020-09-18', 'Phasmophobia is a 4 player online co-op psychological horror. Paranormal activity is on the rise and it’s up to you and your team to use all the ghost hunting equipment at your disposal.', 4.80, 1, 0, 0, 0, 'Windows 11 64-bit', 'Intel Core i3-4340 / AMD FX-6300', '8 GB RAM', 'GTX 1060 / RX 580 / Arc A750', 'Version 11', '60 GB available space', 'Windows 10 or later 64-bit', 'Intel Core i5-9600K / AMD Ryzen 5 3600', '16 GB RAM', 'RTX 3070 / RX 6800 / Arc A770', 'Version 12', '80 GB available space', 'assets/images/games/Phasmophobia/banner.jpg', 'assets/images/games/Phasmophobia/thumbnail.jpg', NULL),
(21, 'Portal 2', 'Valve', 9.99, '2011-04-18', 'The \"Perpetual Testing Initiative\" has been expanded to allow you to design co-op puzzles for you and your friends!', 5.00, 1, 0, 1, 0, 'Windows 10 64-bit', 'Intel Core i5-6600K / AMD Ryzen R5 1600', '12 GB RAM', 'GTX 970 / RX 470', 'Version 12', '30 GB available space', 'Windows 10 64-bit', 'Intel Core i7-8700K / AMD Ryzen 5 5600X', '20 GB RAM', 'RTX 2060 Super / RX 5700', 'Version 12', '50 GB available space', 'assets/images/games/Portal 2/banner.jpg', 'assets/images/games/Portal 2/thumbnail.jpg', NULL),
(22, 'PUBG BATTLEGROUNDS', 'KRAFTON', 0.00, '2017-12-21', 'Play PUBG: BATTLEGROUNDS for free. Land on strategic locations, loot weapons and supplies, and survive to become the last team standing.', 4.00, 1, 0, 0, 0, 'Windows 10 or later 64-bit', 'Intel Core i5-4460 / AMD Ryzen 3 1200', '16 GB RAM', 'GTX 1650 / RX 5500 XT', 'Version 11', '50 GB available space', 'Windows 11 64-bit', 'Intel Core i5-10600K / AMD Ryzen 5 5600', '24 GB RAM', 'RTX 4060 / RX 7600 / Arc B580', 'Version 12', '70 GB available space', 'assets/images/games/PUBG BATTLEGROUNDS/banner.jpg', 'assets/images/games/PUBG BATTLEGROUNDS/thumbnail.jpg', NULL),
(23, 'Resident Evil Village', 'CAPCOM', 39.99, '2021-05-07', 'Experience survival horror like never before in the eighth major installment in the storied Resident Evil franchise - Resident Evil Village.', 4.80, 1, 0, 0, 0, 'Windows 11 64-bit', 'Intel Core i5-2500K / AMD FX-8350', '6 GB RAM', 'GTX 750 Ti / R7 370', 'Version 12', '70 GB available space', 'Windows 10 or later 64-bit', 'Intel Core i7-6700K / AMD Ryzen 7 2700X', '32 GB RAM', 'GTX 1080 Ti / RX Vega 64', 'Version 12', '100 GB available space', 'assets/images/games/Resident Evil Village/banner.jpg', 'assets/images/games/Resident Evil Village/thumbnail.jpg', NULL),
(24, 'RUST', 'Facepunch Studios', 39.99, '2018-02-08', 'The only aim in Rust is to survive. Everything wants you to die. The island’s wildlife and other inhabitants, the environment, other survivors.', 4.40, 1, 0, 1, 0, 'Windows 10 64-bit', 'Intel Core i3-4340 / AMD FX-6300', '10 GB RAM', 'GTX 960 / RX 560 / Arc A380', 'Version 11', '100 GB available space', 'Windows 10 64-bit', 'Intel Core i5-9600K / AMD Ryzen 5 3600', '16 GB RAM', 'RTX 2070 / RX 5700 XT / Arc B570', 'Version 12', '125 GB available space', 'assets/images/games/RUST/banner.jpg', 'assets/images/games/RUST/thumbnail.jpg', NULL),
(25, 'Sid Meier\'s Civilization VI', 'Firaxis Games', 59.99, '2016-10-21', 'Civilization VI offers new ways to interact with your world, expand your empire across the map, advance your culture, and compete against history’s greatest leaders.', 4.60, 1, 0, 0, 0, 'Windows 10 or later 64-bit', 'Intel Core i5-6600K / AMD Ryzen R5 1600', '8 GB RAM', 'GTX 1050 Ti / RX 580 / Arc A380', 'Version 12', '25 GB available space', 'Windows 11 64-bit', 'Intel Core i7-8700K / AMD Ryzen 5 5600X', '20 GB RAM', 'RTX 3060 Ti / RX 6700 XT / Arc A770', 'Version 12', '40 GB available space', 'assets/images/games/Sid Meier\'s Civilization VI/banner.jpg', 'assets/images/games/Sid Meier\'s Civilization VI/thumbnail.jpg', NULL),
(26, 'Stardew Valley', 'ConcernedApe', 14.99, '2016-02-26', 'You\'ve inherited your grandfather\'s old farm plot in Stardew Valley. Armed with hand-me-down tools and a few coins, you set out to begin your new life.', 4.90, 1, 0, 0, 0, 'Windows 11 64-bit', 'Intel Core i5-4460 / AMD Ryzen 3 1200', '12 GB RAM', 'GTX 1060 / RX 580 / Arc A750', 'Version 11', '40 GB available space', 'Windows 10 or later 64-bit', 'Intel Core i5-10600K / AMD Ryzen 5 5600', '24 GB RAM', 'RTX 3070 / RX 6800 / Arc A770', 'Version 12', '60 GB available space', 'assets/images/games/Stardew Valley/banner.jpg', 'assets/images/games/Stardew Valley/thumbnail.jpg', NULL),
(27, 'Terraria', 'Re-Logic', 9.99, '2011-05-16', 'Dig, fight, explore, build! Nothing is impossible in this action-packed adventure game.', 4.90, 1, 0, 0, 0, 'Windows 10 64-bit', 'Intel Core i5-2500K / AMD FX-8350', '16 GB RAM', 'GTX 970 / RX 470', 'Version 12', '60 GB available space', 'Windows 10 64-bit', 'Intel Core i7-6700K / AMD Ryzen 7 2700X', '32 GB RAM', 'RTX 2060 Super / RX 5700', 'Version 12', '80 GB available space', 'assets/images/games/Terraria/banner.jpg', 'assets/images/games/Terraria/thumbnail.jpg', NULL),
(28, 'The Witcher 3 Wild Hunt', 'CD PROJEKT RED', 39.99, '2015-05-18', 'You are Geralt of Rivia, mercenary monster slayer. Before you stands a war-torn, monster-infested continent you can explore at will.', 4.90, 1, 0, 0, 0, 'Windows 10 or later 64-bit', 'Intel Core i3-4340 / AMD FX-6300', '6 GB RAM', 'GTX 1650 / RX 5500 XT', 'Version 11', '30 GB available space', 'Windows 11 64-bit', 'Intel Core i5-9600K / AMD Ryzen 5 3600', '16 GB RAM', 'RTX 4060 / RX 7600 / Arc B580', 'Version 12', '50 GB available space', 'assets/images/games/The Witcher 3 Wild Hunt/banner.jpg', 'assets/images/games/The Witcher 3 Wild Hunt/thumbnail.jpg', NULL),
(29, 'Trailmakers', 'Flashbulb', 24.99, '2020-09-18', 'Build the ultimate vehicle and explore a vast open world filled with challenges.', 4.70, 1, 0, 0, 0, 'Windows 11 64-bit', 'Intel Core i5-6600K / AMD Ryzen R5 1600', '10 GB RAM', 'GTX 750 Ti / R7 370', 'Version 12', '50 GB available space', 'Windows 10 or later 64-bit', 'Intel Core i7-8700K / AMD Ryzen 5 5600X', '20 GB RAM', 'GTX 1080 Ti / RX Vega 64', 'Version 12', '70 GB available space', 'assets/images/games/Trailmakers/banner.jpg', 'assets/images/games/Trailmakers/thumbnail.jpg', NULL),
(30, 'Vampire Survivors', 'poncle', 4.99, '2022-10-20', 'Mow down thousands of night creatures and survive until dawn! Vampire Survivors is a gothic horror casual game with rogue-lite elements.', 4.90, 1, 0, 0, 0, 'Windows 10 64-bit', 'Intel Core i5-4460 / AMD Ryzen 3 1200', '8 GB RAM', 'GTX 960 / RX 560 / Arc A380', 'Version 11', '70 GB available space', 'Windows 10 64-bit', 'Intel Core i5-10600K / AMD Ryzen 5 5600', '24 GB RAM', 'RTX 2070 / RX 5700 XT / Arc B570', 'Version 12', '100 GB available space', 'assets/images/games/Vampire Survivors/banner.jpg', 'assets/images/games/Vampire Survivors/thumbnail.jpg', NULL),
(31, 'World Of Warships', 'Wargaming Group', 0.00, '2017-11-15', 'Immerse yourself in thrilling naval battles and assemble an armada of over 600 ships from the first half of the 20th century.', 4.30, 1, 0, 1, 0, 'Windows 10 or later 64-bit', 'Intel Core i5-2500K / AMD FX-8350', '12 GB RAM', 'GTX 1050 Ti / RX 580 / Arc A380', 'Version 12', '100 GB available space', 'Windows 11 64-bit', 'Intel Core i7-6700K / AMD Ryzen 7 2700X', '32 GB RAM', 'RTX 3060 Ti / RX 6700 XT / Arc A770', 'Version 12', '125 GB available space', 'assets/images/games/World Of Warships/banner.jpg', 'assets/images/games/World Of Warships/thumbnail.jpg', NULL),
(32, 'Worms W.M.D', 'Team17', 29.99, '2016-08-23', 'The worms are back in their most destructive game yet. With a gorgeous, hand-drawn 2D look, brand new weapons, the introduction of crafting, vehicles and buildings!', 4.60, 1, 0, 1, 0, 'Windows 11 64-bit', 'Intel Core i3-4340 / AMD FX-6300', '16 GB RAM', 'GTX 1060 / RX 580 / Arc A750', 'Version 11', '25 GB available space', 'Windows 10 or later 64-bit', 'Intel Core i5-9600K / AMD Ryzen 5 3600', '16 GB RAM', 'RTX 3070 / RX 6800 / Arc A770', 'Version 12', '40 GB available space', 'assets/images/games/Worms W.M.D/banner.jpg', 'assets/images/games/Worms W.M.D/thumbnail.jpg', NULL),
(80, 'Absolum', 'Unknown Dev', 29.99, '2024-01-01', 'An exciting adventure game.', 4.50, 1, 0, 0, 1, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1060', 'DX11', '50 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA RTX 3060', 'DX12', '50 GB', 'assets/images/games/Absolum/banner.jpg', 'assets/images/games/Absolum/thumbnail.jpg', NULL),
(81, 'Anno', 'Ubisoft', 59.99, '2024-01-01', 'City building strategy.', 4.50, 1, 0, 0, 1, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1060', 'DX11', '50 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA RTX 3060', 'DX12', '50 GB', 'assets/images/games/Anno/banner.jpg', 'assets/images/games/Anno/thumbnail.jpg', NULL),
(82, 'Apex Legend', 'Respawn', 0.00, '2019-02-04', 'Battle royale shooter.', 4.60, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1060', 'DX11', '50 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA RTX 3060', 'DX12', '50 GB', 'assets/images/games/Apex Legend/banner.jpg', 'assets/images/games/Apex Legend/thumbnail.jpg', NULL),
(83, 'Batman', 'WB Games', 19.99, '2024-01-01', 'Action adventure hero game.', 4.50, 1, 1, 0, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1060', 'DX11', '50 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA RTX 3060', 'DX12', '50 GB', 'assets/images/games/Batman/banner.jpg', 'assets/images/games/Batman/thumbnail.jpg', NULL),
(84, 'Beam N.G', 'BeamNG', 24.99, '2015-05-29', 'Vehicle simulation game.', 4.80, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1060', 'DX11', '50 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA RTX 3060', 'DX12', '50 GB', 'assets/images/games/Beam N.G/banner.jpg', 'assets/images/games/Beam N.G/thumbnail.jpg', NULL),
(85, 'Blood Sports', 'Unknown Dev', 19.99, '2024-01-01', 'Action sports game.', 4.00, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1060', 'DX11', '50 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA RTX 3060', 'DX12', '50 GB', 'assets/images/games/Blood Sports/banner.jpg', 'assets/images/games/Blood Sports/thumbnail.jpg', NULL),
(86, 'Buckshot', 'Unknown Dev', 4.99, '2024-01-01', 'Indie horror strategy.', 4.50, 1, 0, 0, 0, 'Windows 10', 'Intel Core i3', '4 GB', 'Intel HD', 'DX11', '1 GB', 'Windows 11', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1050', 'DX11', '2 GB', 'assets/images/games/Buckshot/banner.jpg', 'assets/images/games/Buckshot/thumbnail.jpg', NULL),
(87, 'Chained Together', 'Unknown Dev', 14.99, '2024-01-01', 'Co-op platformer.', 4.20, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1060', 'DX11', '10 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA RTX 2060', 'DX12', '10 GB', 'assets/images/games/Chained Together/banner.jpg', 'assets/images/games/Chained Together/thumbnail.jpg', NULL),
(88, 'Command and Conquere', 'EA', 19.99, '2024-01-01', 'Real time strategy.', 4.50, 1, 0, 1, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1060', 'DX11', '30 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA RTX 3060', 'DX12', '30 GB', 'assets/images/games/Command and Conquere/banner.jpg', 'assets/images/games/Command and Conquere/thumbnail.jpg', NULL),
(89, 'Dark Souls III', 'FromSoftware', 59.99, '2016-04-12', 'Action RPG.', 4.80, 1, 0, 1, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 970', 'DX11', '50 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA GTX 1070', 'DX11', '50 GB', 'assets/images/games/Dark Souls III/banner.jpg', 'assets/images/games/Dark Souls III/thumbnail.jpg', NULL),
(90, 'Dark Tide', 'Fatshark', 39.99, '2022-11-30', 'Co-op shooter.', 4.10, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 970', 'DX12', '50 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA RTX 3060', 'DX12', '50 GB', 'assets/images/games/Dark Tide/banner.jpg', 'assets/images/games/Dark Tide/thumbnail.jpg', NULL),
(91, 'Dawn of War', 'Relic', 19.99, '2024-01-01', 'Strategy sci-fi game.', 4.50, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1060', 'DX11', '50 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA RTX 3060', 'DX12', '50 GB', 'assets/images/games/Dawn of War/banner.jpg', 'assets/images/games/Dawn of War/thumbnail.jpg', NULL),
(92, 'Destiny 2', 'Bungie', 0.00, '2017-09-06', 'Action MMO.', 4.40, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1050', 'DX11', '100 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA RTX 3060', 'DX12', '100 GB', 'assets/images/games/Destiny 2/banner.jpg', 'assets/images/games/Destiny 2/thumbnail.jpg', NULL),
(93, 'Dispatch', 'Unknown Dev', 19.99, '2024-01-01', 'Simulation game.', 4.00, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1060', 'DX11', '10 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA RTX 2060', 'DX12', '10 GB', 'assets/images/games/Dispatch/banner.jpg', 'assets/images/games/Dispatch/thumbnail.jpg', NULL),
(94, 'Don\'t Scream', 'Unknown Dev', 9.99, '2023-10-27', 'Microphone enabled horror.', 4.20, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1060', 'DX11', '10 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA RTX 3060', 'DX12', '10 GB', 'assets/images/games/Don\'t Scream/banner.jpg', 'assets/images/games/Don\'t Scream/thumbnail.jpg', NULL),
(95, 'EA Play', 'EA', 0.00, '2024-01-01', 'Subscription service.', 4.00, 1, 0, 0, 0, 'Windows 10', 'Any', '4 GB', 'Any', 'DX11', '100 MB', 'Windows 11', 'Any', '8 GB', 'Any', 'DX12', '100 MB', 'assets/images/games/EA Play/banner.jpg', 'assets/images/games/EA Play/thumbnail.jpg', NULL),
(96, 'Escape Simulator 2', 'Pine Studio', 19.99, '2024-01-01', 'Puzzle co-op game.', 4.50, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1060', 'DX11', '10 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA RTX 2060', 'DX12', '10 GB', 'assets/images/games/Escape Simulator 2/banner.jpg', 'assets/images/games/Escape Simulator 2/thumbnail.jpg', NULL),
(97, 'Fallout', 'Bethesda', 9.99, '1997-09-30', 'Classic RPG.', 4.60, 1, 0, 0, 0, 'Windows 7', 'Pentium', '1 GB', 'SVGA', 'DX9', '1 GB', 'Windows 10', 'Intel Core i3', '4 GB', 'Integrated', 'DX9', '1 GB', 'assets/images/games/Fallout/banner.jpg', 'assets/images/games/Fallout/thumbnail.jpg', NULL),
(98, 'FC25', 'EA Sports', 69.99, '2024-09-29', 'Football simulation.', 4.00, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1060', 'DX12', '50 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA RTX 3060', 'DX12', '50 GB', 'assets/images/games/FC25/banner.jpg', 'assets/images/games/FC25/thumbnail.jpg', NULL),
(99, 'Football Manager 26', 'Sports Interactive', 59.99, '2025-11-01', 'Sports management.', 4.70, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'Integrated', 'DX11', '10 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA GTX 1050', 'DX12', '10 GB', 'assets/images/games/Football Manager 26/banner.jpg', 'assets/images/games/Football Manager 26/thumbnail.jpg', NULL),
(100, 'For Honor', 'Ubisoft', 29.99, '2017-02-14', 'Action fighting game.', 4.30, 1, 0, 0, 0, 'Windows 10', 'Intel Core i3', '4 GB', 'NVIDIA GTX 660', 'DX11', '40 GB', 'Windows 11', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1060', 'DX11', '40 GB', 'assets/images/games/For Honor/banner.jpg', 'assets/images/games/For Honor/thumbnail.jpg', NULL),
(101, 'Ghost', 'Unknown Dev', 19.99, '2024-01-01', 'Mystery game.', 4.20, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1060', 'DX11', '20 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA RTX 2060', 'DX12', '20 GB', 'assets/images/games/Ghost/banner.jpg', 'assets/images/games/Ghost/thumbnail.jpg', NULL),
(102, 'GTA', 'Rockstar', 29.99, '2013-09-17', 'Open world action.', 4.70, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 970', 'DX11', '100 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA RTX 3060', 'DX12', '100 GB', 'assets/images/games/GTA/banner.jpg', 'assets/images/games/GTA/thumbnail.jpg', NULL),
(103, 'Guilty Gear', 'Arc System Works', 39.99, '2021-06-11', 'Fighting game.', 4.60, 1, 0, 0, 0, 'Windows 10', 'Intel Core i3', '4 GB', 'NVIDIA GTX 660', 'DX11', '20 GB', 'Windows 11', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1060', 'DX11', '20 GB', 'assets/images/games/Guilty Gear/banner.jpg', 'assets/images/games/Guilty Gear/thumbnail.jpg', NULL),
(104, 'Heart of Iron IV', 'Paradox', 39.99, '2016-06-06', 'Grand strategy.', 4.60, 1, 0, 0, 0, 'Windows 7', 'Intel Core i3', '4 GB', 'NVIDIA GTX 460', 'DX9', '2 GB', 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 960', 'DX11', '4 GB', 'assets/images/games/Heart of Iron IV/banner.jpg', 'assets/images/games/Heart of Iron IV/thumbnail.jpg', NULL),
(105, 'Hogwarts Legacy', 'Warner Bros', 59.99, '2023-02-10', 'Open world magic.', 4.50, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '16 GB', 'NVIDIA GTX 960', 'DX12', '85 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA GTX 1080', 'DX12', '85 GB', 'assets/images/games/Hogwarts Legacy/banner.jpg', 'assets/images/games/Hogwarts Legacy/thumbnail.jpg', NULL),
(106, 'iRacing', 'iRacing.com', 12.99, '2008-08-26', 'Motorsport simulation.', 4.60, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '16 GB', 'NVIDIA GTX 1060', 'DX11', '50 GB', 'Windows 11', 'Intel Core i7', '32 GB', 'NVIDIA RTX 3060', 'DX12', '50 GB', 'assets/images/games/iRacing/banner.jpg', 'assets/images/games/iRacing/thumbnail.jpg', NULL),
(107, 'It Takes 2', 'Hazelight', 39.99, '2021-03-26', 'Co-op adventure.', 4.80, 1, 0, 0, 0, 'Windows 10', 'Intel Core i3', '8 GB', 'NVIDIA GTX 660', 'DX11', '50 GB', 'Windows 11', 'Intel Core i5', '8 GB', 'NVIDIA GTX 980', 'DX11', '50 GB', 'assets/images/games/It Takes 2/banner.jpg', 'assets/images/games/It Takes 2/thumbnail.jpg', NULL),
(108, 'Jedi', 'Respawn', 49.99, '2019-11-15', 'Star Wars action.', 4.50, 1, 0, 0, 0, 'Windows 10', 'Intel Core i3', '8 GB', 'NVIDIA GTX 650', 'DX11', '55 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA GTX 1070', 'DX11', '55 GB', 'assets/images/games/Jedi/banner.jpg', 'assets/images/games/Jedi/thumbnail.jpg', NULL),
(109, 'Little Nightmare 3', 'Supermassive', 29.99, '2024-01-01', 'Horror adventure.', 4.50, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1050', 'DX11', '10 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA RTX 2060', 'DX12', '10 GB', 'assets/images/games/Little Nightmare 3/banner.jpg', 'assets/images/games/Little Nightmare 3/thumbnail.jpg', NULL),
(110, 'Mortal Combat', 'NetherRealm', 49.99, '2019-04-23', 'Fighting game.', 4.50, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1050', 'DX11', '60 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA GTX 1060', 'DX11', '60 GB', 'assets/images/games/Mortal Combat/banner.jpg', 'assets/images/games/Mortal Combat/thumbnail.jpg', NULL),
(111, 'Rematch', 'Unknown Dev', 9.99, '2024-01-01', 'Sports action.', 4.00, 1, 0, 0, 0, 'Windows 10', 'Intel Core i3', '4 GB', 'Integrated', 'DX11', '5 GB', 'Windows 11', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1050', 'DX12', '5 GB', 'assets/images/games/Rematch/banner.jpg', 'assets/images/games/Rematch/thumbnail.jpg', NULL),
(112, 'REPO', 'Unknown Dev', 14.99, '2024-01-01', 'Simulation.', 4.00, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1060', 'DX11', '20 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA RTX 3060', 'DX12', '20 GB', 'assets/images/games/REPO/banner.jpg', 'assets/images/games/REPO/thumbnail.jpg', NULL),
(113, 'Schedule', 'Unknown', 0.00, '2024-01-01', 'Utility application.', 4.00, 1, 0, 0, 0, 'Windows 10', 'Any', '4 GB', 'Integrated', 'DX11', '500 MB', 'Windows 11', 'Any', '8 GB', 'Integrated', 'DX12', '500 MB', 'assets/images/games/Schedule/banner.jpg', 'assets/images/games/Schedule/thumbnail.jpg', NULL),
(114, 'Silent Hill', 'Konami', 39.99, '2024-01-01', 'Psychological horror.', 4.80, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1060', 'DX11', '50 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA RTX 3060', 'DX12', '50 GB', 'assets/images/games/Silent Hill/banner.jpg', 'assets/images/games/Silent Hill/thumbnail.jpg', NULL),
(115, 'Sky', 'Thatgamecompany', 0.00, '2019-07-18', 'Social indie adventure.', 4.70, 1, 0, 0, 0, 'Windows 10', 'Intel Core i3', '4 GB', 'Intel HD', 'DX11', '5 GB', 'Windows 11', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1050', 'DX12', '5 GB', 'assets/images/games/Sky/banner.jpg', 'assets/images/games/Sky/thumbnail.jpg', NULL),
(116, 'Sonic Shadow', 'SEGA', 49.99, '2024-01-01', 'High speed platformer.', 4.50, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1060', 'DX11', '30 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA RTX 2060', 'DX12', '30 GB', 'assets/images/games/Sonic Shadow/banner.jpg', 'assets/images/games/Sonic Shadow/thumbnail.jpg', NULL),
(117, 'Spiderman', 'Insomniac', 59.99, '2022-08-12', 'Superhero action.', 4.80, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 950', 'DX12', '75 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA RTX 3070', 'DX12', '75 GB', 'assets/images/games/Spiderman/banner.jpg', 'assets/images/games/Spiderman/thumbnail.jpg', NULL),
(118, 'Split Fiction', 'Unknown Dev', 19.99, '2024-01-01', 'Action adventure.', 4.00, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1060', 'DX11', '20 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA RTX 3060', 'DX12', '20 GB', 'assets/images/games/Split Fiction/banner.jpg', 'assets/images/games/Split Fiction/thumbnail.jpg', NULL),
(119, 'Stellaris', 'Paradox', 39.99, '2016-05-09', 'Sci-fi strategy.', 4.70, 1, 0, 0, 0, 'Windows 7', 'Intel Core i3', '4 GB', 'NVIDIA GTX 460', 'DX9', '10 GB', 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1050', 'DX11', '10 GB', 'assets/images/games/Stellaris/banner.jpg', 'assets/images/games/Stellaris/thumbnail.jpg', NULL),
(120, 'Street Fighter', 'Capcom', 19.99, '2016-02-16', 'Fighting game.', 4.40, 1, 0, 0, 0, 'Windows 10', 'Intel Core i3', '6 GB', 'NVIDIA GTX 480', 'DX11', '30 GB', 'Windows 11', 'Intel Core i5', '8 GB', 'NVIDIA GTX 960', 'DX11', '30 GB', 'assets/images/games/Street Fighter/banner.jpg', 'assets/images/games/Street Fighter/thumbnail.jpg', NULL),
(121, 'Taken 8', 'Bandai Namco', 69.99, '2024-01-26', 'Fighting game.', 4.60, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1050', 'DX12', '100 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA RTX 2070', 'DX12', '100 GB', 'assets/images/games/Taken 8/banner.jpg', 'assets/images/games/Taken 8/thumbnail.jpg', NULL),
(122, 'VR Chat', 'VRChat', 0.00, '2017-02-01', 'Social VR.', 4.50, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '4 GB', 'NVIDIA GTX 970', 'DX11', '5 GB', 'Windows 11', 'Intel Core i7', '8 GB', 'NVIDIA GTX 1060', 'DX11', '5 GB', 'assets/images/games/VR Chat/banner.jpg', 'assets/images/games/VR Chat/thumbnail.jpg', NULL),
(123, 'War Rats', 'Unknown Dev', 9.99, '2024-01-01', 'Strategy game.', 4.00, 1, 0, 0, 0, 'Windows 10', 'Intel Core i3', '4 GB', 'Integrated', 'DX11', '2 GB', 'Windows 11', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1050', 'DX11', '2 GB', 'assets/images/games/War Rats/banner.jpg', 'assets/images/games/War Rats/thumbnail.jpg', NULL),
(124, 'Warborne', 'Unknown Dev', 14.99, '2024-01-01', 'Turn based strategy.', 4.20, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '8 GB', 'NVIDIA GTX 1050', 'DX11', '5 GB', 'Windows 11', 'Intel Core i7', '16 GB', 'NVIDIA GTX 1060', 'DX12', '5 GB', 'assets/images/games/Warborne/banner.jpg', 'assets/images/games/Warborne/thumbnail.jpg', NULL),
(125, 'Watch Dogs 2', 'Ubisoft', 49.99, '2016-11-29', 'Open world hacker.', 4.50, 1, 0, 0, 0, 'Windows 10', 'Intel Core i5', '6 GB', 'NVIDIA GTX 660', 'DX11', '27 GB', 'Windows 11', 'Intel Core i7', '8 GB', 'NVIDIA GTX 1060', 'DX11', '27 GB', 'assets/images/games/Watch Dogs 2/banner.jpg', 'assets/images/games/Watch Dogs 2/thumbnail.jpg', NULL);

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
(6, 5, 1),
(7, 5, 9),
(8, 6, 1),
(9, 6, 3),
(10, 7, 2),
(11, 7, 13),
(12, 8, 1),
(16, 11, 1),
(17, 11, 3),
(18, 12, 2),
(19, 12, 5),
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
(39, 25, 4),
(40, 26, 5),
(41, 26, 3),
(42, 27, 2),
(43, 27, 12),
(44, 28, 3),
(45, 29, 5),
(46, 30, 1),
(50, 80, 2),
(51, 81, 4),
(52, 81, 5),
(53, 82, 1),
(56, 84, 5),
(57, 85, 1),
(58, 85, 6),
(59, 86, 9),
(60, 86, 4),
(61, 87, 13),
(65, 90, 1),
(66, 91, 4),
(67, 92, 1),
(68, 92, 3),
(69, 93, 5),
(70, 94, 9),
(71, 96, 7),
(72, 96, 5),
(73, 97, 3),
(74, 98, 6),
(75, 98, 5),
(76, 99, 6),
(77, 99, 5),
(78, 99, 4),
(79, 100, 1),
(80, 100, 8),
(81, 101, 2),
(82, 102, 1),
(83, 102, 2),
(84, 103, 8),
(85, 104, 4),
(86, 105, 3),
(87, 105, 2),
(88, 106, 6),
(89, 106, 5),
(90, 107, 2),
(91, 107, 13),
(92, 108, 1),
(93, 108, 2),
(94, 109, 9),
(95, 109, 2),
(96, 110, 8),
(97, 111, 6),
(98, 111, 1),
(99, 112, 5),
(100, 114, 9),
(101, 115, 2),
(102, 116, 13),
(103, 116, 1),
(104, 117, 1),
(105, 117, 2),
(106, 118, 1),
(107, 118, 2),
(108, 119, 4),
(109, 120, 8),
(110, 121, 8),
(111, 122, 5),
(112, 123, 4),
(113, 124, 4),
(114, 125, 1),
(115, 125, 2),
(116, 3, 1),
(117, 3, 5),
(118, 3, 6),
(119, 3, 4),
(120, 83, 1),
(121, 83, 2),
(122, 83, 8),
(123, 83, 3),
(124, 4, 1),
(125, 4, 8),
(126, 4, 4),
(127, 4, 11),
(128, 9, 1),
(129, 9, 2),
(130, 9, 3),
(131, 9, 4),
(132, 88, 1),
(133, 88, 2),
(134, 88, 4),
(135, 88, 11),
(136, 89, 1),
(137, 89, 2),
(138, 89, 8),
(139, 89, 3),
(140, 10, 1),
(141, 10, 8),
(142, 10, 9),
(143, 10, 4),
(144, 10, 11),
(145, 13, 1),
(146, 13, 8),
(147, 13, 10),
(148, 13, 4),
(149, 24, 1),
(150, 24, 2),
(151, 24, 4),
(152, 24, 11),
(153, 31, 1),
(154, 31, 8),
(155, 31, 5),
(156, 31, 4),
(157, 32, 1),
(158, 32, 8),
(159, 32, 4);

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
(101, 4, 'assets/videos/trailers/BattleField6.mp4', 'video'),
(134, 1, 'assets/images/games/Age of Wonders 4/4.jpg', 'screenshot'),
(135, 2, 'assets/images/games/Among Us/4.jpg', 'screenshot'),
(136, 3, 'assets/images/games/Assetto Corsa/4.jpg', 'screenshot'),
(137, 4, 'assets/images/games/Battlefield 6/4.jpg', 'screenshot'),
(138, 5, 'assets/images/games/Blood Fresh Supply/4.jpg', 'screenshot'),
(139, 6, 'assets/images/games/Borderlands 2/4.jpg', 'screenshot'),
(140, 7, 'assets/images/games/Celeste/4.jpg', 'screenshot'),
(141, 8, 'assets/images/games/Counter-Strike 2/4.jpg', 'screenshot'),
(142, 9, 'assets/images/games/Cyberpunk 2077/4.jpg', 'screenshot'),
(143, 10, 'assets/images/games/Dead by Daylight/4.jpg', 'screenshot'),
(144, 11, 'assets/images/games/Deus Ex Mankind Divided/4.jpg', 'screenshot'),
(145, 12, 'assets/images/games/Don\'t Starve/4.jpg', 'screenshot'),
(146, 13, 'assets/images/games/Dota 2/4.jpg', 'screenshot'),
(147, 14, 'assets/images/games/Elden Ring/4.jpg', 'screenshot'),
(148, 15, 'assets/images/games/Euro Tuck Simulator 2/4.jpg', 'screenshot'),
(149, 16, 'assets/images/games/Fallout New Vegas/4.jpg', 'screenshot'),
(150, 17, 'assets/images/games/Final Fantasy VII Rebirth/4.jpg', 'screenshot'),
(151, 18, 'assets/images/games/Hollow Knight/4.jpg', 'screenshot'),
(152, 19, 'assets/images/games/Left 4 Dead 2/4.jpg', 'screenshot'),
(153, 20, 'assets/images/games/Phasmophobia/4.jpg', 'screenshot'),
(154, 21, 'assets/images/games/Portal 2/4.jpg', 'screenshot'),
(155, 22, 'assets/images/games/PUBG BATTLEGROUNDS/4.jpg', 'screenshot'),
(156, 23, 'assets/images/games/Resident Evil Village/4.jpg', 'screenshot'),
(157, 24, 'assets/images/games/RUST/4.jpg', 'screenshot'),
(158, 25, 'assets/images/games/Sid Meier\'s Civilization VI/4.jpg', 'screenshot'),
(159, 26, 'assets/images/games/Stardew Valley/4.jpg', 'screenshot'),
(160, 27, 'assets/images/games/Terraria/4.jpg', 'screenshot'),
(161, 28, 'assets/images/games/The Witcher 3 Wild Hunt/4.jpg', 'screenshot'),
(162, 29, 'assets/images/games/Trailmakerls/4.jpg', 'screenshot'),
(163, 30, 'assets/images/games/Vampire Survivors/4.jpg', 'screenshot'),
(164, 31, 'assets/images/games/World Of Warships/4.jpg', 'screenshot'),
(165, 32, 'assets/images/games/Worms W.M.D/4.jpg', 'screenshot'),
(166, 80, 'assets/images/games/Absolum/1.jpg', 'screenshot'),
(167, 80, 'assets/images/games/Absolum/2.jpg', 'screenshot'),
(168, 81, 'assets/images/games/Anno/1.jpg', 'screenshot'),
(169, 81, 'assets/images/games/Anno/2.jpg', 'screenshot'),
(170, 82, 'assets/images/games/Apex Legend/1.jpg', 'screenshot'),
(171, 82, 'assets/images/games/Apex Legend/2.jpg', 'screenshot'),
(172, 83, 'assets/images/games/Batman/1.jpg', 'screenshot'),
(173, 83, 'assets/images/games/Batman/2.jpg', 'screenshot'),
(174, 84, 'assets/images/games/Beam N.G/1.jpg', 'screenshot'),
(175, 84, 'assets/images/games/Beam N.G/2.jpg', 'screenshot'),
(176, 85, 'assets/images/games/Blood Sports/1.jpg', 'screenshot'),
(177, 85, 'assets/images/games/Blood Sports/2.jpg', 'screenshot'),
(178, 86, 'assets/images/games/Buckshot/1.jpg', 'screenshot'),
(179, 86, 'assets/images/games/Buckshot/2.jpg', 'screenshot'),
(180, 87, 'assets/images/games/Chained Together/1.jpg', 'screenshot'),
(181, 87, 'assets/images/games/Chained Together/2.jpg', 'screenshot'),
(182, 88, 'assets/images/games/Command and Conquere/1.jpg', 'screenshot'),
(183, 88, 'assets/images/games/Command and Conquere/2.jpg', 'screenshot'),
(184, 89, 'assets/images/games/Dark Souls III/1.jpg', 'screenshot'),
(185, 89, 'assets/images/games/Dark Souls III/2.jpg', 'screenshot'),
(186, 90, 'assets/images/games/Dark Tide/1.jpg', 'screenshot'),
(187, 90, 'assets/images/games/Dark Tide/2.jpg', 'screenshot'),
(188, 91, 'assets/images/games/Dawn of War/1.jpg', 'screenshot'),
(189, 91, 'assets/images/games/Dawn of War/2.jpg', 'screenshot'),
(190, 92, 'assets/images/games/Destiny 2/1.jpg', 'screenshot'),
(191, 92, 'assets/images/games/Destiny 2/2.jpg', 'screenshot'),
(192, 93, 'assets/images/games/Dispatch/1.jpg', 'screenshot'),
(193, 93, 'assets/images/games/Dispatch/2.jpg', 'screenshot'),
(194, 94, 'assets/images/games/Don\'t Scream/1.jpg', 'screenshot'),
(195, 94, 'assets/images/games/Don\'t Scream/2.jpg', 'screenshot'),
(196, 95, 'assets/images/games/EA Play/1.jpg', 'screenshot'),
(197, 95, 'assets/images/games/EA Play/2.jpg', 'screenshot'),
(198, 96, 'assets/images/games/Escape Simulator 2/1.jpg', 'screenshot'),
(199, 96, 'assets/images/games/Escape Simulator 2/2.jpg', 'screenshot'),
(200, 97, 'assets/images/games/Fallout/1.jpg', 'screenshot'),
(201, 97, 'assets/images/games/Fallout/2.jpg', 'screenshot'),
(202, 98, 'assets/images/games/FC25/1.jpg', 'screenshot'),
(203, 98, 'assets/images/games/FC25/2.jpg', 'screenshot'),
(204, 99, 'assets/images/games/Football Manager 26/1.jpg', 'screenshot'),
(205, 99, 'assets/images/games/Football Manager 26/2.jpg', 'screenshot'),
(206, 100, 'assets/images/games/For Honor/1.jpg', 'screenshot'),
(207, 100, 'assets/images/games/For Honor/2.jpg', 'screenshot'),
(208, 101, 'assets/images/games/Ghost/1.jpg', 'screenshot'),
(209, 101, 'assets/images/games/Ghost/2.jpg', 'screenshot'),
(210, 102, 'assets/images/games/GTA/1.jpg', 'screenshot'),
(211, 102, 'assets/images/games/GTA/2.jpg', 'screenshot'),
(212, 103, 'assets/images/games/Guilty Gear/1.jpg', 'screenshot'),
(213, 103, 'assets/images/games/Guilty Gear/2.jpg', 'screenshot'),
(214, 104, 'assets/images/games/Heart of Iron IV/1.jpg', 'screenshot'),
(215, 104, 'assets/images/games/Heart of Iron IV/2.jpg', 'screenshot'),
(216, 105, 'assets/images/games/Hogwarts Legacy/1.jpg', 'screenshot'),
(217, 105, 'assets/images/games/Hogwarts Legacy/2.jpg', 'screenshot'),
(218, 106, 'assets/images/games/iRacing/1.jpg', 'screenshot'),
(219, 106, 'assets/images/games/iRacing/2.jpg', 'screenshot'),
(220, 107, 'assets/images/games/It Takes 2/1.jpg', 'screenshot'),
(221, 107, 'assets/images/games/It Takes 2/2.jpg', 'screenshot'),
(222, 108, 'assets/images/games/Jedi/1.jpg', 'screenshot'),
(223, 108, 'assets/images/games/Jedi/2.jpg', 'screenshot'),
(224, 109, 'assets/images/games/Little Nightmare 3/1.jpg', 'screenshot'),
(225, 109, 'assets/images/games/Little Nightmare 3/2.jpg', 'screenshot'),
(226, 110, 'assets/images/games/Mortal Combat/1.jpg', 'screenshot'),
(227, 110, 'assets/images/games/Mortal Combat/2.jpg', 'screenshot'),
(228, 111, 'assets/images/games/Rematch/1.jpg', 'screenshot'),
(229, 111, 'assets/images/games/Rematch/2.jpg', 'screenshot'),
(230, 112, 'assets/images/games/REPO/1.jpg', 'screenshot'),
(231, 112, 'assets/images/games/REPO/2.jpg', 'screenshot'),
(232, 113, 'assets/images/games/Schedule/1.jpg', 'screenshot'),
(233, 113, 'assets/images/games/Schedule/2.jpg', 'screenshot'),
(234, 114, 'assets/images/games/Silent Hill/1.jpg', 'screenshot'),
(235, 114, 'assets/images/games/Silent Hill/2.jpg', 'screenshot'),
(236, 115, 'assets/images/games/Sky/1.jpg', 'screenshot'),
(237, 115, 'assets/images/games/Sky/2.jpg', 'screenshot'),
(238, 116, 'assets/images/games/Sonic Shadow/1.jpg', 'screenshot'),
(239, 116, 'assets/images/games/Sonic Shadow/2.jpg', 'screenshot'),
(240, 117, 'assets/images/games/Spiderman/1.jpg', 'screenshot'),
(241, 117, 'assets/images/games/Spiderman/2.jpg', 'screenshot'),
(242, 118, 'assets/images/games/Split Fiction/1.jpg', 'screenshot'),
(243, 118, 'assets/images/games/Split Fiction/2.jpg', 'screenshot'),
(244, 119, 'assets/images/games/Stellaris/1.jpg', 'screenshot'),
(245, 119, 'assets/images/games/Stellaris/2.jpg', 'screenshot'),
(246, 120, 'assets/images/games/Street Fighter/1.jpg', 'screenshot'),
(247, 120, 'assets/images/games/Street Fighter/2.jpg', 'screenshot'),
(248, 121, 'assets/images/games/Taken 8/1.jpg', 'screenshot'),
(249, 121, 'assets/images/games/Taken 8/2.jpg', 'screenshot'),
(250, 122, 'assets/images/games/VR Chat/1.jpg', 'screenshot'),
(251, 122, 'assets/images/games/VR Chat/2.jpg', 'screenshot'),
(252, 123, 'assets/images/games/War Rats/1.jpg', 'screenshot'),
(253, 123, 'assets/images/games/War Rats/2.jpg', 'screenshot'),
(254, 124, 'assets/images/games/Warborne/1.jpg', 'screenshot'),
(255, 124, 'assets/images/games/Warborne/2.jpg', 'screenshot'),
(256, 125, 'assets/images/games/Watch Dogs 2/1.jpg', 'screenshot'),
(257, 125, 'assets/images/games/Watch Dogs 2/2.jpg', 'screenshot'),
(262, 5, 'assets/videos/trailers/bloodfreshsupply.mp4', 'video'),
(263, 6, 'assets/videos/trailers/borderlands2.mp4', 'video'),
(264, 7, 'assets/videos/trailers/celeste.mp4', 'video'),
(265, 8, 'assets/videos/trailers/counterstrike2.mp4', 'video'),
(266, 9, 'assets/videos/trailers/cyberpunk2077.mp4', 'video'),
(267, 10, 'assets/videos/trailers/deadbydaylight.mp4', 'video'),
(268, 11, 'assets/videos/trailers/deusexmankind.mp4', 'video'),
(269, 12, 'assets/videos/trailers/don\'tstarve.mp4', 'video'),
(270, 13, 'assets/videos/trailers/dota2.mp4', 'video'),
(271, 14, 'assets/videos/trailers/eldenring.mp4', 'video'),
(272, 15, 'assets/videos/trailers/eurotrucksimulato.mp4', 'video'),
(273, 16, 'assets/videos/trailers/falloutnewvegas.mp4', 'video'),
(274, 17, 'assets/videos/trailers/finalfantasy.mp4', 'video'),
(275, 18, 'assets/videos/trailers/hollowknight.mp4', 'video'),
(276, 19, 'assets/videos/trailers/left4dead2.mp4', 'video'),
(277, 20, 'assets/videos/trailers/phasmophobia.mp4', 'video'),
(278, 21, 'assets/videos/trailers/portal2.mp4', 'video'),
(279, 22, 'assets/videos/trailers/pubgbattleground.mp4', 'video'),
(280, 23, 'assets/videos/trailers/residentevilvillage.mp4', 'video'),
(281, 25, 'assets/videos/trailers/sidmeier\'scivilizationVII.mp4', 'video'),
(282, 26, 'assets/videos/trailers/stardewvalley.mp4', 'video'),
(283, 27, 'assets/videos/trailers/terraria.mp4', 'video'),
(284, 28, 'assets/videos/trailers/thewitcher3wildhunt.mp4', 'video'),
(285, 29, 'assets/videos/trailers/trailmakers.mp4', 'video'),
(286, 30, 'assets/videos/trailers/vampiresurvivors.mp4', 'video'),
(287, 31, 'assets/videos/trailers/worldofwarships.mp4', 'video'),
(288, 32, 'assets/videos/trailers/wormswmd.mp4', 'video'),
(289, 80, 'assets/videos/trailers/absolum.mp4', 'video'),
(290, 81, 'assets/videos/trailers/anno.mp4', 'video'),
(291, 82, 'assets/videos/trailers/apexlegend.mp4', 'video'),
(292, 83, 'assets/videos/trailers/batman.mp4', 'video'),
(293, 84, 'assets/videos/trailers/beamng.mp4', 'video'),
(294, 85, 'assets/videos/trailers/bloodsports.mp4', 'video'),
(295, 86, 'assets/videos/trailers/buckshot.mp4', 'video'),
(296, 87, 'assets/videos/trailers/chainedtogether.mp4', 'video'),
(297, 88, 'assets/videos/trailers/commandandconquere.mp4', 'video'),
(298, 89, 'assets/videos/trailers/darksoulsIII.mp4', 'video'),
(299, 90, 'assets/videos/trailers/darktide.mp4', 'video'),
(300, 91, 'assets/videos/trailers/dawnofwar.mp4', 'video'),
(301, 92, 'assets/videos/trailers/destiny2.mp4', 'video'),
(302, 93, 'assets/videos/trailers/dispatch.mp4', 'video'),
(303, 96, 'assets/videos/trailers/escapesimulator2.mp4', 'video'),
(304, 97, 'assets/videos/trailers/fallout.mp4', 'video'),
(305, 98, 'assets/videos/trailers/fc25.mp4', 'video'),
(306, 99, 'assets/videos/trailers/footballmanager26.mp4', 'video'),
(307, 100, 'assets/videos/trailers/forhonor.mp4', 'video'),
(308, 101, 'assets/videos/trailers/ghost.mp4', 'video'),
(309, 102, 'assets/videos/trailers/gta.mp4', 'video'),
(310, 103, 'assets/videos/trailers/guiltygear.mp4', 'video'),
(311, 104, 'assets/videos/trailers/heartofironIV.mp4', 'video'),
(312, 105, 'assets/videos/trailers/hogwartslegacy.mp4', 'video'),
(313, 106, 'assets/videos/trailers/iracing.mp4', 'video'),
(314, 107, 'assets/videos/trailers/ittakes2.mp4', 'video'),
(315, 108, 'assets/videos/trailers/jedi.mp4', 'video'),
(316, 109, 'assets/videos/trailers/littlenightmare3.mp4', 'video'),
(317, 110, 'assets/videos/trailers/mortalcombat.mp4', 'video'),
(318, 111, 'assets/videos/trailers/rematch.mp4', 'video'),
(319, 112, 'assets/videos/trailers/repo.mp4', 'video'),
(320, 113, 'assets/videos/trailers/schedule.mp4', 'video'),
(321, 114, 'assets/videos/trailers/silenthill.mp4', 'video'),
(322, 115, 'assets/videos/trailers/sky.mp4', 'video'),
(323, 116, 'assets/videos/trailers/sonicshadow.mp4', 'video'),
(324, 117, 'assets/videos/trailers/spiderman.mp4', 'video'),
(325, 118, 'assets/videos/trailers/splitfiction.mp4', 'video'),
(326, 119, 'assets/videos/trailers/stellaris.mp4', 'video'),
(327, 120, 'assets/videos/trailers/streetfighter.mp4', 'video'),
(328, 121, 'assets/videos/trailers/taken8.mp4', 'video'),
(329, 122, 'assets/videos/trailers/vrchat.mp4', 'video'),
(330, 123, 'assets/videos/trailers/warrats.mp4', 'video'),
(331, 124, 'assets/videos/trailers/warborne.mp4', 'video'),
(332, 125, 'assets/videos/trailers/watchdogs2.mp4', 'video');

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
(9, 5, 6),
(10, 5, 27),
(11, 6, 6),
(12, 6, 2),
(13, 7, 1),
(14, 7, 10),
(15, 8, 6),
(16, 8, 3),
(17, 8, 11),
(22, 11, 21),
(23, 11, 14),
(24, 12, 1),
(25, 12, 25),
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
(65, 80, 1),
(66, 80, 16),
(67, 81, 25),
(68, 81, 9),
(69, 81, 14),
(70, 82, 6),
(71, 82, 3),
(72, 82, 11),
(73, 82, 21),
(77, 84, 22),
(78, 84, 26),
(79, 85, 3),
(80, 85, 13),
(81, 86, 27),
(82, 86, 14),
(83, 86, 1),
(84, 87, 2),
(85, 87, 3),
(86, 87, 26),
(94, 90, 6),
(95, 90, 3),
(96, 90, 21),
(97, 91, 21),
(98, 91, 14),
(99, 91, 25),
(100, 92, 6),
(101, 92, 3),
(102, 92, 11),
(103, 92, 21),
(104, 93, 1),
(105, 93, 14),
(106, 94, 27),
(107, 94, 1),
(108, 94, 6),
(109, 96, 7),
(110, 96, 2),
(111, 96, 3),
(112, 97, 20),
(113, 97, 16),
(114, 97, 4),
(115, 98, 3),
(116, 98, 26),
(117, 99, 14),
(118, 100, 29),
(119, 100, 7),
(120, 100, 3),
(121, 101, 1),
(122, 101, 16),
(123, 102, 4),
(124, 102, 13),
(125, 102, 22),
(126, 102, 7),
(127, 103, 28),
(128, 103, 3),
(129, 104, 32),
(130, 104, 31),
(131, 104, 14),
(132, 105, 15),
(133, 105, 4),
(134, 105, 16),
(135, 106, 22),
(136, 106, 3),
(137, 106, 26),
(138, 107, 2),
(139, 107, 16),
(140, 107, 7),
(141, 108, 21),
(142, 108, 7),
(143, 108, 16),
(144, 109, 27),
(145, 109, 1),
(146, 109, 7),
(147, 110, 3),
(148, 111, 1),
(149, 112, 1),
(150, 114, 27),
(151, 114, 8),
(152, 114, 16),
(153, 115, 1),
(154, 115, 3),
(155, 115, 15),
(156, 116, 7),
(157, 116, 28),
(158, 116, 26),
(159, 117, 4),
(160, 117, 7),
(161, 117, 16),
(162, 118, 1),
(163, 118, 16),
(164, 119, 32),
(165, 119, 21),
(166, 120, 3),
(167, 121, 3),
(168, 122, 3),
(169, 122, 11),
(170, 122, 28),
(171, 123, 14),
(172, 123, 1),
(173, 124, 14),
(174, 124, 1),
(175, 125, 4),
(176, 125, 13),
(177, 125, 14),
(178, 3, 22),
(179, 3, 26),
(180, 83, 4),
(181, 83, 16),
(182, 83, 7),
(183, 4, 6),
(184, 4, 3),
(185, 9, 4),
(186, 9, 21),
(187, 88, 25),
(188, 88, 14),
(189, 88, 30),
(190, 89, 15),
(191, 89, 29),
(192, 89, 16),
(193, 89, 7),
(194, 10, 11),
(195, 10, 3),
(196, 13, 15),
(197, 13, 11),
(198, 24, 3),
(199, 24, 4),
(200, 31, 11),
(201, 31, 3),
(202, 32, 1),
(203, 32, 2);

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
(3, 1, '2025-12-08', 'Zain', 'zainbinkhalid510@gmail.com', '$2y$12$oVTNqierbfDMj5UXWNS7mur1IuRQ9lAOxf7NGgS9gf1DJdJZdbTQu', 'Zain', 'Pakistan', 18, 'assets/images/avatars/default.png', 'I am the admin of this website.'),
(5, 0, '2025-12-03', 'test', 'quitekiller510@gmail.com', '$2y$12$vYS41LQpk14WdnUdDNBnZuXhNtCvdZC0h2AaQXXlCVstEG65.Pe12', 'test', 'China', 19, 'assets/images/avatars/default.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_library`
--

CREATE TABLE `user_library` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `purchase_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_library`
--

INSERT INTO `user_library` (`id`, `user_id`, `game_id`, `purchase_date`) VALUES
(1, 3, 3, '2025-12-08 11:35:18'),
(2, 3, 1, '2025-12-08 11:38:00');

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
-- Indexes for table `user_library`
--
ALTER TABLE `user_library`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_ownership` (`user_id`,`game_id`);

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
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.', AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `game_genre`
--
ALTER TABLE `game_genre`
  MODIFY `junction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `game_media`
--
ALTER TABLE `game_media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;

--
-- AUTO_INCREMENT for table `game_tag`
--
ALTER TABLE `game_tag`
  MODIFY `junction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key. Always use a specific name like user_id.', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_library`
--
ALTER TABLE `user_library`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
