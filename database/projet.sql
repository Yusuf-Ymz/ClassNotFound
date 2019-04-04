-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 04 avr. 2019 à 15:39
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `subject` text NOT NULL,
  `publication_date` date NOT NULL,
  PRIMARY KEY (`answer_id`),
  KEY `question_id` (`question_id`),
  KEY `author_id_answers` (`author_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `answers`
--

INSERT INTO `answers` (`answer_id`, `author_id`, `question_id`, `subject`, `publication_date`) VALUES
(1, 2, 1, 'You can find documentation on the javadoc website :)', '2019-03-06'),
(2, 1, 1, 'Okay thank you', '2019-03-06'),
(3, 2, 1, 'Need anything else ?', '2019-03-07'),
(4, 1, 1, 'Can you provide the link plz ?', '2019-03-07'),
(5, 2, 1, 'javadoc.com/foreach', '2019-03-07'),
(6, 2, 2, 'What version are you using ?', '2019-03-05'),
(7, 1, 2, 'Version 1.6', '2019-03-12'),
(8, 2, 2, 'You can check out my YT channel I have a series of videos dedicated to Blender', '2019-03-13'),
(9, 1, 2, 'Thanks I\'ll check it out ! :)', '2019-03-13'),
(10, 2, 2, 'You\'re welcome !', '2019-03-13'),
(11, 2, 3, 'Wich country do you live in ?', '2019-03-21'),
(12, 1, 3, 'In Belgium', '2019-03-22'),
(13, 2, 3, 'Well do you have a bachelor in computer science ?', '2019-03-22'),
(14, 1, 3, 'Yes I do', '2019-03-23'),
(15, 2, 3, 'You could go for a master in AI if any school in belgium are proposing one, if not then you might need to change country to pursue your studies.', '2019-03-24'),
(16, 2, 4, 'Are you lactose intolerant ? ', '2019-03-11'),
(17, 1, 4, 'No I\'m not', '2019-03-18'),
(18, 2, 4, 'Then you can use this recipe:\r\n- milk\r\n- chocolate\r\n- eggs\r\n- flour', '2019-03-19'),
(19, 1, 4, 'Ok thank you', '2019-03-19'),
(20, 2, 4, 'You are welcome', '2019-03-22'),
(21, 2, 5, 'PS: I\'m not an IT student so I need to learn from scratch', '2019-03-15'),
(22, 1, 5, 'There is plenty of documentation on the official PHP.net website', '2019-03-22'),
(23, 2, 5, 'Any other recommendations ?', '2019-03-22'),
(24, 1, 5, 'You can check this guy on Youtube: [link]', '2019-03-22'),
(25, 2, 5, 'Great thanks', '2019-03-22');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `idx_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(5, '3D Graphics'),
(3, 'AI'),
(2, 'Algorithms'),
(4, 'Big Data'),
(1, 'General'),
(6, 'Web');

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `suspended` tinyint(1) NOT NULL,
  PRIMARY KEY (`member_id`),
  UNIQUE KEY `idx_login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`member_id`, `login`, `lastname`, `firstname`, `mail`, `password`, `admin`, `suspended`) VALUES
(1, 'yusuf.yilmaz', 'Yilmaz', 'Yusuf', 'yusuf.yilmaz@student.vinci.be', '$2y$10$Apvf/0QLDpIKl3CmZ3ysJeh2xKtwQ7ITvJiuzmY1tLL6TYcjyMjde', 0, 0),
(2, 'antoine.honinckx', 'Honinckx', 'Antoine', 'antoine.honinckx@student.vinci.be', '$2y$10$Apvf/0QLDpIKl3CmZ3ysJeh2xKtwQ7ITvJiuzmY1tLL6TYcjyMjde', 1, 0),
(3, 'suspended', 'test', 'test', 'test@gmail.com', '$2y$10$Apvf/0QLDpIKl3CmZ3ysJeh2xKtwQ7ITvJiuzmY1tLL6TYcjyMjde', 0, 1),
(4, 'register', 'test', 'test', 'test@gmail.com', '$2y$10$xtsnOsQX40QOWHtelxes4uEGPoG/L4FoeTmUvBPhgsYUK0mXESKMa', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `best_answer_id` int(11) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `subject` text NOT NULL,
  `state` set('solved','duplicated') DEFAULT NULL,
  `publication_date` date NOT NULL,
  PRIMARY KEY (`question_id`),
  KEY `category_id` (`category_id`),
  KEY `best_answer_id` (`best_answer_id`),
  KEY `author_id_questions` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`question_id`, `author_id`, `category_id`, `best_answer_id`, `title`, `subject`, `state`, `publication_date`) VALUES
(1, 2, 2, NULL, 'How to do a foreach in Java ?', 'Hello,\r\n\r\nHow to do a foreach in Java ?\r\n\r\nThx', NULL, '2019-03-06'),
(2, 1, 5, NULL, 'Blender help!', 'I was wondering how to use blender, do you have tips ?\r\n\r\nThank you :)', NULL, '2019-03-05'),
(3, 2, 3, NULL, 'AI career', 'What kind of studies do you have to do in order to have a career in AI ?', NULL, '2019-03-21'),
(4, 1, 1, NULL, 'How to make cookies ?', 'Do you guys have any recipe for cookies ?', NULL, '2019-03-11'),
(5, 2, 6, NULL, 'Where to learn PHP ?', 'What sites can I use to learn PHP ?', NULL, '2019-03-06');

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

DROP TABLE IF EXISTS `votes`;
CREATE TABLE IF NOT EXISTS `votes` (
  `member_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `liked` tinyint(1) NOT NULL,
  PRIMARY KEY (`member_id`,`answer_id`),
  KEY `answer_id` (`answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `votes`
--

INSERT INTO `votes` (`member_id`, `answer_id`, `liked`) VALUES
(1, 1, 1),
(2, 12, 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `author_id` FOREIGN KEY (`author_id`) REFERENCES `members` (`member_id`),
  ADD CONSTRAINT `question_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`);

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `author_id_questions` FOREIGN KEY (`author_id`) REFERENCES `members` (`member_id`),
  ADD CONSTRAINT `best_answer_id` FOREIGN KEY (`best_answer_id`) REFERENCES `answers` (`answer_id`),
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Contraintes pour la table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `answer_id` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`answer_id`),
  ADD CONSTRAINT `member_id` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
