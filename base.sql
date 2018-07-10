-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  mar. 10 juil. 2018 à 15:18
-- Version du serveur :  5.6.38
-- Version de PHP :  7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `edulab`
--

-- --------------------------------------------------------

--
-- Structure de la table `scheduleSettings`
--

CREATE TABLE `scheduleSettings` (
  `id` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  `firstHour` varchar(255) NOT NULL,
  `lastHour` varchar(255) NOT NULL,
  `lunchHour` varchar(255) NOT NULL,
  `lunchTime` varchar(255) NOT NULL,
  `courseTime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `scheduleSettings`
--

INSERT INTO `scheduleSettings` (`id`, `days`, `firstHour`, `lastHour`, `lunchHour`, `lunchTime`, `courseTime`) VALUES
(4, 5, '08:00', '17:00', '12:00', '01:00', '01:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `scheduleSettings`
--
ALTER TABLE `scheduleSettings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `scheduleSettings`
--
ALTER TABLE `scheduleSettings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
