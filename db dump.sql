-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Värd: db
-- Tid vid skapande: 23 feb 2023 kl 16:18
-- Serverversion: 8.0.31
-- PHP-version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `ReceptDB`
--
CREATE DATABASE IF NOT EXISTS `ReceptDB` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `ReceptDB`;

-- --------------------------------------------------------

--
-- Tabellstruktur `Ingredients`
--

CREATE TABLE `Ingredients` (
  `id` int NOT NULL,
  `Ingredient` varchar(90) NOT NULL,
  `amount` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `IngredientsTillRecept`
--

CREATE TABLE `IngredientsTillRecept` (
  `id` int NOT NULL,
  `recept_id` int NOT NULL,
  `Ingredients_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `instructions`
--

CREATE TABLE `instructions` (
  `id` int NOT NULL,
  `description` mediumtext,
  `timer` tinyint DEFAULT '0',
  `time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `instructionsTillRecept`
--

CREATE TABLE `instructionsTillRecept` (
  `id` int NOT NULL,
  `instructions_id` int NOT NULL,
  `recept_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `recept`
--

CREATE TABLE `recept` (
  `id` int NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `description` mediumtext,
  `stars` decimal(2,2) NOT NULL DEFAULT '0.00',
  `port` int NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `User_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `tags`
--

CREATE TABLE `tags` (
  `id` int NOT NULL,
  `name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `tagsTillRecept`
--

CREATE TABLE `tagsTillRecept` (
  `id` int NOT NULL,
  `recept_id` int NOT NULL,
  `tags_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `User`
--

CREATE TABLE `User` (
  `id` int NOT NULL,
  `mail` varchar(45) NOT NULL,
  `password` varchar(128) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumpning av Data i tabell `User`
--

INSERT INTO `User` (`id`, `mail`, `password`, `name`) VALUES
(7, 'josef.forkman@telia.com', '$2y$10$1oI.hOGuIYrqYR7WeHd1teJD4X9OrjKmOoeikSUruwEZHDGCtov3m', 'Josef'),
(10, 'strand.vatten@outlook.com', '$2y$10$oEYUlxNQ8rMYX1YbrmK3Duz/9ML9wlfaCAjR1JJapfZoFU.cw9Nza', 'Strandberg');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `Ingredients`
--
ALTER TABLE `Ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `IngredientsTillRecept`
--
ALTER TABLE `IngredientsTillRecept`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_IngredientsTillRecept_recept1_idx` (`recept_id`),
  ADD KEY `fk_IngredientsTillRecept_Ingredients1_idx` (`Ingredients_id`);

--
-- Index för tabell `instructions`
--
ALTER TABLE `instructions`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `instructionsTillRecept`
--
ALTER TABLE `instructionsTillRecept`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_instructionsTillRecept_instructions1_idx` (`instructions_id`),
  ADD KEY `fk_instructionsTillRecept_recept1_idx` (`recept_id`);

--
-- Index för tabell `recept`
--
ALTER TABLE `recept`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_recept_User_idx` (`User_id`);

--
-- Index för tabell `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `tagsTillRecept`
--
ALTER TABLE `tagsTillRecept`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tagsTillRecept_recept1_idx` (`recept_id`),
  ADD KEY `fk_tagsTillRecept_tags1_idx` (`tags_id`);

--
-- Index för tabell `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail_UNIQUE` (`mail`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `Ingredients`
--
ALTER TABLE `Ingredients`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `IngredientsTillRecept`
--
ALTER TABLE `IngredientsTillRecept`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `instructions`
--
ALTER TABLE `instructions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `instructionsTillRecept`
--
ALTER TABLE `instructionsTillRecept`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `recept`
--
ALTER TABLE `recept`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `tagsTillRecept`
--
ALTER TABLE `tagsTillRecept`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `User`
--
ALTER TABLE `User`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `IngredientsTillRecept`
--
ALTER TABLE `IngredientsTillRecept`
  ADD CONSTRAINT `ingredientstillrecept_ibfk_1` FOREIGN KEY (`recept_id`) REFERENCES `recept` (`id`),
  ADD CONSTRAINT `ingredientstillrecept_ibfk_2` FOREIGN KEY (`Ingredients_id`) REFERENCES `Ingredients` (`id`);

--
-- Restriktioner för tabell `instructionsTillRecept`
--
ALTER TABLE `instructionsTillRecept`
  ADD CONSTRAINT `instructionstillrecept_ibfk_1` FOREIGN KEY (`instructions_id`) REFERENCES `instructions` (`id`),
  ADD CONSTRAINT `instructionstillrecept_ibfk_2` FOREIGN KEY (`recept_id`) REFERENCES `recept` (`id`);

--
-- Restriktioner för tabell `recept`
--
ALTER TABLE `recept`
  ADD CONSTRAINT `recept_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `User` (`id`);

--
-- Restriktioner för tabell `tagsTillRecept`
--
ALTER TABLE `tagsTillRecept`
  ADD CONSTRAINT `tagstillrecept_ibfk_1` FOREIGN KEY (`recept_id`) REFERENCES `recept` (`id`),
  ADD CONSTRAINT `tagstillrecept_ibfk_2` FOREIGN KEY (`tags_id`) REFERENCES `tags` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
