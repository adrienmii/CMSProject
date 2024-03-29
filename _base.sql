-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  Dim 22 juil. 2018 à 16:07
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `EDULAB7`
--

-- --------------------------------------------------------

--
-- Structure de la table `chapter`
--

CREATE TABLE `chapter` (
  `id` int(11) NOT NULL,
  `label` varchar(120) NOT NULL,
  `description` varchar(120) DEFAULT NULL,
  `classe` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chapter`
--

INSERT INTO `chapter` (`id`, `label`, `description`, `classe`) VALUES
(1, 'Mathématiques', 'Cours de maths', 13),
(2, 'Python', '', 12),
(5, 'BDD', '', 14),
(6, 'Teetet', 'Rrrrr', 12);

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `id` int(10) NOT NULL,
  `classname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id`, `classname`) VALUES
(12, '3IW1'),
(13, 'MCSI5'),
(14, '4IW2');

-- --------------------------------------------------------

--
-- Structure de la table `classeteacher`
--

CREATE TABLE `classeteacher` (
  `id` int(100) NOT NULL,
  `classe` int(100) NOT NULL,
  `teacher` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `classeteacher`
--

INSERT INTO `classeteacher` (`id`, `classe`, `teacher`) VALUES
(3, 12, 2),
(6, 14, 11),
(8, 13, 8),
(9, 13, 9);

-- --------------------------------------------------------

--
-- Structure de la table `course`
--

CREATE TABLE `course` (
  `id` int(25) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `teacher` int(25) NOT NULL,
  `chapter` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `course`
--

INSERT INTO `course` (`id`, `title`, `content`, `teacher`, `chapter`) VALUES
(5, 'Les bases du Python', '<h1>Premiers&nbsp;pas avec l&#39;interpr&eacute;teur de commandes Python</h1>\r\n\r\n<p>Apr&egrave;s les premi&egrave;res notions th&eacute;oriques et l&#39;installation de Python, il est temps de d&eacute;couvrir un peu l&#39;interpr&eacute;teur de commandes de ce langage. M&ecirc;me si ces petits tests vous semblent anodins, vous d&eacute;couvrirez dans ce chapitre les premiers rudiments de la syntaxe du langage et je vous conseille fortement de me suivre pas &agrave; pas, surtout si vous &ecirc;tes face &agrave; votre premier langage de programmation.</p>\r\n\r\n<p>Comme tout langage de programmation, Python a une syntaxe claire : on ne peut pas lui envoyer n&#39;importe quelle information dans n&#39;importe quel ordre. Nous allons voir ici ce que Python mange&hellip; et ce qu&#39;il ne mange pas.</p>\r\n\r\n<h2>O&ugrave; est-ce qu&#39;on est, l&agrave; ?</h2>\r\n\r\n<p>Pour commencer, je vais vous demander de retourner dans l&#39;interpr&eacute;teur de commandes Python (je vous ai montr&eacute;, &agrave; la fin du chapitre pr&eacute;c&eacute;dent, comment y acc&eacute;der en fonction de votre syst&egrave;me d&#39;exploitation).</p>\r\n\r\n<p>Je vous rappelle les informations qui figurent dans cette fen&ecirc;tre, m&ecirc;me si elles peuvent &ecirc;tre diff&eacute;rentes chez vous en fonction de votre version et de votre syst&egrave;me d&#39;exploitation.</p>\r\n\r\n<blockquote>\r\n<pre>\r\n<samp>Python&nbsp;3.4.0&nbsp;(v3.4.0:04f714765c13,&nbsp;Mar&nbsp;16&nbsp;2014,&nbsp;19:24:06)&nbsp;[MSC&nbsp;v.1600&nbsp;32&nbsp;bit&nbsp;(Intel)]&nbsp;on&nbsp;win32\r\nType&nbsp;&quot;help&quot;,&nbsp;&quot;copyright&quot;,&nbsp;&quot;credits&quot;&nbsp;or&nbsp;&quot;license&quot;&nbsp;for&nbsp;more&nbsp;information.\r\n&gt;&gt;&gt;</samp></pre>\r\n</blockquote>\r\n\r\n<p>&Agrave; sa fa&ccedil;on, Python vous souhaite la bienvenue dans son interpr&eacute;teur de commandes.</p>\r\n\r\n<p>Attends, attends. C&#39;est quoi cet interpr&eacute;teur ?</p>\r\n\r\n<p>Souvenez-vous, au chapitre pr&eacute;c&eacute;dent, je vous ai donn&eacute; une br&egrave;ve explication sur la diff&eacute;rence entre langages compil&eacute;s et langages interpr&eacute;t&eacute;s. Eh bien, cet interpr&eacute;teur de commandes va nous permettre de tester directement du code. Je saisis une ligne d&#39;instructions, j&#39;appuie sur la touche&nbsp;<kbd>Entr&eacute;e</kbd>&nbsp;de mon clavier, je regarde ce que me r&eacute;pond Python (s&#39;il me dit quelque chose), puis j&#39;en saisis une deuxi&egrave;me, une troisi&egrave;me&hellip; Cet interpr&eacute;teur est particuli&egrave;rement utile pour comprendre les bases de Python et r&eacute;aliser nos premiers petits programmes. Le principal inconv&eacute;nient, c&#39;est que le code que vous saisissez n&#39;est pas sauvegard&eacute; (sauf si vous l&#39;enregistrez manuellement, mais chaque chose en son temps).</p>\r\n', 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `participateQCM`
--

CREATE TABLE `participateQCM` (
  `id` int(255) NOT NULL,
  `idUser` int(255) NOT NULL,
  `idQCM` int(255) NOT NULL,
  `mark` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `QCM`
--

CREATE TABLE `QCM` (
  `id` int(20) NOT NULL,
  `teacher` int(20) NOT NULL,
  `label` varchar(200) NOT NULL,
  `classe` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `QCM`
--

INSERT INTO `QCM` (`id`, `teacher`, `label`, `classe`) VALUES
(1, 6, 'QCM Test 2', 14),
(2, 6, 'ter', 12);

-- --------------------------------------------------------

--
-- Structure de la table `questionQCM`
--

CREATE TABLE `questionQCM` (
  `id` int(11) NOT NULL,
  `question` varchar(500) NOT NULL,
  `answer1` varchar(500) NOT NULL,
  `answer2` varchar(500) NOT NULL,
  `answer3` varchar(500) DEFAULT NULL,
  `answer4` varchar(500) DEFAULT NULL,
  `result` int(11) NOT NULL,
  `idQCM` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `questionQCM`
--

INSERT INTO `questionQCM` (`id`, `question`, `answer1`, `answer2`, `answer3`, `answer4`, `result`, `idQCM`) VALUES
(13, 'Ceci est une question test', 'Voila la réponse test 1', 'Voila la réponse test 2', '', '', 1, 1),
(26, 'Une autre question pour le QCM', 'Reponse 1', 'Reponse 2', 'Reponse 3', NULL, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `scheduleCourse`
--

CREATE TABLE `scheduleCourse` (
  `id` int(11) NOT NULL,
  `matiere` varchar(255) NOT NULL,
  `room` varchar(255) NOT NULL,
  `startHour` varchar(255) NOT NULL,
  `day` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `classID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `scheduleCourse`
--

INSERT INTO `scheduleCourse` (`id`, `matiere`, `room`, `startHour`, `day`, `week`, `classID`, `userID`) VALUES
(2, 'zer', 'zer', '08:00', 16, 29, 13, 6),
(4, 'TESTzfeezffzff', 'TEST', '08:00', 16, 29, 14, 9),
(5, 'Anglais', 'B35', '10:30', 18, 29, 14, 6),
(6, 'erz', 'zr', '09:15', 16, 29, 12, 6),
(7, 'EZFzfezfeezf', 'ZEF', '10:30', 16, 29, 12, 7);

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
  `courseTime` varchar(255) NOT NULL,
  `nbCoursePerDay` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `scheduleSettings`
--

INSERT INTO `scheduleSettings` (`id`, `days`, `firstHour`, `lastHour`, `lunchHour`, `lunchTime`, `courseTime`, `nbCoursePerDay`) VALUES
(1, 5, '08:00', '20:00', '13:00', '02:00', '01:15', 8);

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `sitename` varchar(200) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `logo` mediumtext NOT NULL,
  `theme` varchar(255) NOT NULL DEFAULT 'default'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `settings`
--

INSERT INTO `settings` (`id`, `sitename`, `address`, `logo`, `theme`) VALUES
(1, 'ESGI', '254 Rue du Faubourg Saint-Antoine, 75012 Paris 0198341092', 'LOGO-ESGI-300x203.jpg', 'default');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(250) NOT NULL,
  `pwd` char(60) NOT NULL,
  `token` char(15) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `classe` int(10) DEFAULT NULL,
  `date_inserted` varchar(100) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `pwd_changed` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `pwd`, `token`, `rank`, `status`, `classe`, `date_inserted`, `date_created`, `pwd_changed`) VALUES
(1, 'Istrateur', 'ADMIN', 'ad@ad.fr', '$2y$10$WxGeRBhys1fecnN2xVQlUeBN4XUnR4BhG5ubWm5Rm/xyZ5PevsIz6', 'cc4213e20cc4bf3', 1, 1, 0, NULL, NULL, 0),
(2, 'Admin', 'EDULAB', 'admin@test.fr', '$2y$10$w.Zml8kUVOx3OunNBubjBeC9.1OyPT/c3uweqC4DpdiSJdqJXMLJ2', '63e1e8fb64b28f5', 1, 0, NULL, '2018-04-23 14:41:56', '2018-07-21 17:04:12', 1),
(6, 'Teacher', 'EDULAB', 'teacher@test.fr', '$2y$10$CpTNQpA7bmLPKGfYVrW.Zetq1zIAnUOOVRx3joAuy11/sFFT7Ql96', '59b123001a94867', 2, 1, NULL, '2018-04-23 15:54:57', '2018-07-22 13:45:24', 0),
(7, 'Teacher1', 'EDULAB', 'teacher1@test.fr', '$2y$10$CpTNQpA7bmLPKGfYVrW.Zetq1zIAnUOOVRx3joAuy11/sFFT7Ql96', 'c48dc9b79070eab', 2, 1, NULL, '2018-04-23 16:15:48', '2018-07-18 19:49:11', 0),
(8, 'Teacher2', 'EDULAB', 'teacher2@test.fr', '$2y$10$CpTNQpA7bmLPKGfYVrW.Zetq1zIAnUOOVRx3joAuy11/sFFT7Ql96', '266f76650137d37', 2, 1, NULL, '2018-04-23 15:54:57', '2018-05-16 12:21:05', 0),
(9, 'Teacher3', 'EDULAB', 'teacher3@test.fr', '$2y$10$CpTNQpA7bmLPKGfYVrW.Zetq1zIAnUOOVRx3joAuy11/sFFT7Ql96', NULL, 2, 1, NULL, '2018-04-23 15:54:57', '2018-04-24 19:01:56', 0),
(10, 'Teacher4', 'EDULAB', 'teacher4@test.fr', '$2y$10$CpTNQpA7bmLPKGfYVrW.Zetq1zIAnUOOVRx3joAuy11/sFFT7Ql96', NULL, 2, 0, NULL, '2018-04-23 15:54:57', '2018-07-21 17:03:17', 0),
(11, 'Teacher5', 'EDULAB', 'teacher5@tetst.fr', '$2y$10$qwbwy9/L.N53gmGjI17EU.UvIDmmxzbxmfto5qy7CkpZHh8aa7VpG', '7bfa713ba3c357f', 2, 0, NULL, '2018-04-24 18:42:30', '2018-07-21 16:57:25', 0),
(12, 'Student1', 'EDULAB', 'student1@test.fr', '$2y$10$CpTNQpA7bmLPKGfYVrW.Zetq1zIAnUOOVRx3joAuy11/sFFT7Ql96', 'f0a90e58d584561', 3, 1, 14, '2018-04-26 09:13:51', '2018-07-18 20:29:27', 0),
(13, 'Student2', 'EDULAB', 'student2@test.fr', '$2y$10$CpTNQpA7bmLPKGfYVrW.Zetq1zIAnUOOVRx3joAuy11/sFFT7Ql96', 'bea6a187dac4a41', 3, 1, 14, '2018-04-26 11:43:31', '2018-07-18 12:04:56', 0),
(14, 'Student3', 'EDULAB', 'student3@test.fr', '$2y$10$CpTNQpA7bmLPKGfYVrW.Zetq1zIAnUOOVRx3joAuy11/sFFT7Ql96', '48455771be4438b', 3, 1, 12, '2018-04-28 16:33:18', '2018-07-18 12:27:33', 0),
(15, 'Student4', 'EDULAB', 'student4@test.fr', '$2y$10$40KKHvCPw9dSZdbEcHbAX.FxuZymrQLkgHTGIOsWhylEjs8JNR//C', 'd8d5bd1e7c46ffc', 3, 1, 0, '2018-04-28 16:45:18', '2018-04-29 15:40:13', 0),
(16, 'Student5', 'EDULAB', 'student5@test.fr', '$2y$10$kxNptCvYR1Vo2.50LY86cOpF.kd5S48O9B4i9f.RFib6fKLgKbd/a', 'b3e75245f008348', 3, 1, 0, '2018-04-28 16:47:04', '2018-04-29 15:40:18', 0),
(17, 'Student6', 'EDULAB', 'student6@test.fr', '$2y$10$S.5K.eQbPqA9e9Xc0C8VXOKuZNfeaYZt9iVz991jScbRLHfeUWU6K', '9960d73c7cc9951', 3, 1, 0, '2018-04-28 17:32:09', '2018-04-29 15:40:21', 0),
(18, 'Student7', 'EDULAB', 'student7@test.fr', '$2y$10$hJny31M1mpJr0fMr0xmz8eXjZXc5ClhcAJqYaxT6WB.8iyxnG39UK', '0433890b5aca277', 3, 1, 12, '2018-04-28 17:34:14', '2018-04-29 15:10:18', 0),
(19, 'Student8', 'EDULAB', 'student8@test.fr', '$2y$10$GHaCzAHXgSMo0LgftNbLvuqak8DltTaOkwqDFKTgykn8HFYMceMkK', 'b8e1654778f1045', 3, 1, 13, '2018-04-28 17:37:24', '2018-04-29 15:39:50', 0),
(20, 'Student9', 'EDULAB', 'student9@test.fr', '$2y$10$P5c1229g3k3SRLheuKXaYuiLN9eNJy1ayrRwciUnVYtoTKW6rQeBW', 'bf0ed08ff3bb4e7', 3, 1, 13, '2018-04-29 15:47:41', '2018-04-29 15:39:50', 0),
(77, 'Lala', 'LALA', 'lalala0@lala.fr', '$2y$10$RsDk6RcNZHNxf5dzb1Tr0.to1CFsAIO.0aPYVGoFU00NmAT90JLYi', 'e1bc6db5fcd35eb', 1, 0, 0, NULL, '2018-07-21 17:05:12', 0),
(78, 'Edulab', 'ADMIN', 'admin2@test.fr', '$2y$10$xBYwBKWlQ/8jkd18KJfkNeECIUW5czjwufku9ZClTxqe6vk84RaUC', '2038ac42fe53453', 1, 0, 0, NULL, '2018-07-21 17:34:37', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chapter`
--
ALTER TABLE `chapter`
  ADD KEY `id` (`id`);

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `classeteacher`
--
ALTER TABLE `classeteacher`
  ADD KEY `id` (`id`);

--
-- Index pour la table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `participateQCM`
--
ALTER TABLE `participateQCM`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `QCM`
--
ALTER TABLE `QCM`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `questionQCM`
--
ALTER TABLE `questionQCM`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `scheduleCourse`
--
ALTER TABLE `scheduleCourse`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `scheduleSettings`
--
ALTER TABLE `scheduleSettings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chapter`
--
ALTER TABLE `chapter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `classeteacher`
--
ALTER TABLE `classeteacher`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `participateQCM`
--
ALTER TABLE `participateQCM`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `QCM`
--
ALTER TABLE `QCM`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `questionQCM`
--
ALTER TABLE `questionQCM`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT pour la table `scheduleCourse`
--
ALTER TABLE `scheduleCourse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `scheduleSettings`
--
ALTER TABLE `scheduleSettings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;