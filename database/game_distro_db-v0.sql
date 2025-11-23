-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2025 at 10:16 PM
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
CREATE DATABASE IF NOT EXISTS `game_distro_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `game_distro_db`;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE IF NOT EXISTS `games` (
  `game_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.',
  `title` varchar(100) NOT NULL COMMENT 'Full name of the game.',
  `developer_name` varchar(100) NOT NULL COMMENT 'The primary developer name (can be simplified later).',
  `price` decimal(10,2) NOT NULL COMMENT 'Game price (e.g., 59.99).',
  `release_date` date NOT NULL COMMENT 'Date of launch (e.g., 2025-01-15).',
  `description` text NOT NULL COMMENT 'A full description of the game.',
  PRIMARY KEY (`game_id`),
  UNIQUE KEY `unique_title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `game_genre`
--

CREATE TABLE IF NOT EXISTS `game_genre` (
  `junction_id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  PRIMARY KEY (`junction_id`),
  KEY `fk_game_games_id` (`game_id`),
  KEY `fk_genre_genre_id` (`genre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `game_media`
--

CREATE TABLE IF NOT EXISTS `game_media` (
  `media_id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) NOT NULL,
  `media_url` varchar(255) NOT NULL,
  `media_type` enum('screenshot','gif','thumbnail','video') NOT NULL,
  PRIMARY KEY (`media_id`),
  KEY `media_fk_game_games_id` (`game_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `game_tag`
--

CREATE TABLE IF NOT EXISTS `game_tag` (
  `junction_id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`junction_id`),
  KEY `tags_fk_game_games_id` (`game_id`),
  KEY `fk_tag_tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `genre_id` int(11) NOT NULL AUTO_INCREMENT,
  `genre_name` varchar(50) NOT NULL,
  PRIMARY KEY (`genre_id`),
  UNIQUE KEY `unique_genre` (`genre_name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genre_id`, `genre_name`) VALUES
(1, 'Action'),
(2, 'Adventure'),
(8, 'Fighting'),
(9, 'Horror'),
(7, 'Puzzle'),
(3, 'Role-Playing (RPG)'),
(5, 'Simulation'),
(6, 'Sports'),
(4, 'Strategy');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(50) NOT NULL,
  PRIMARY KEY (`tag_id`),
  UNIQUE KEY `unique_tag` (`tag_name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`) VALUES
(9, 'Building'),
(5, 'Early Access'),
(6, 'First-Person Shooter (FPS)'),
(11, 'Free to Play'),
(1, 'Indie'),
(2, 'Local Co-op'),
(3, 'Online Multiplayer'),
(4, 'Open World'),
(10, 'Pixel Graphics'),
(8, 'Survival'),
(7, 'Third-Person');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key. Always use a specific name like user_id.',
  `username` varchar(50) NOT NULL COMMENT 'For login (e.g., "GamerTag123"). Required.',
  `email` varchar(100) NOT NULL COMMENT 'For login and recovery. Required.',
  `password_hash` varchar(255) NOT NULL COMMENT 'Crucial: Stores the secure HASHED password.',
  `display_name` varchar(100) NOT NULL COMMENT 'The friendly name users see (e.g., a real name or an alias).',
  `country` varchar(50) NOT NULL COMMENT 'User''s geographic location.',
  `age` int(7) NOT NULL COMMENT 'minimum ages are required by some games. like 18',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `unique_username` (`username`),
  UNIQUE KEY `unique_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password_hash`, `display_name`, `country`, `age`) VALUES
(1, 'testuser', 'test@example.com', '$2a$12$0YgXtgOHZhqeAEYQOe637eyfkBd6Wf0xWTHbEi4atJ1Z2zfSXBKoy', 'Test User', 'Unknown', 18);

--
-- Constraints for dumped tables
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
