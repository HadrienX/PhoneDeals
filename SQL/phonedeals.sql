-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 08 Mars 2016 à 12:03
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `phonedeals`
--

-- --------------------------------------------------------

--
-- Structure de la table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(1, 'LG'),
(2, 'Nokia'),
(3, 'Samsung'),
(4, 'Sony'),
(5, 'Apple'),
(6, 'HTC'),
(7, 'Huawei');

-- --------------------------------------------------------

--
-- Structure de la table `capacity`
--

CREATE TABLE IF NOT EXISTS `capacity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `storage` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `capacity`
--

INSERT INTO `capacity` (`id`, `storage`) VALUES
(1, 16),
(2, 32),
(3, 64),
(4, 128);

-- --------------------------------------------------------

--
-- Structure de la table `color`
--

CREATE TABLE IF NOT EXISTS `color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `hex` varchar(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `color`
--

INSERT INTO `color` (`id`, `name`, `hex`) VALUES
(1, 'Noir', '#000'),
(2, 'Blanc', '#fff'),
(3, 'Bleu', '#3aabe5'),
(4, 'Rouge', '#e3161d'),
(5, 'Jaune', '#f8dd08'),
(6, 'Vert', '#96e264'),
(7, 'Rose', '#fe6868'),
(8, 'Marron', '#5c4745'),
(9, 'Or', '#e3d0ba'),
(10, 'Or Rose', '#edccbd'),
(11, 'Argent', '#d0d0d4'),
(12, 'Gris sidéral', '#9b9ba0'),
(13, 'Bordeaux', '#54161f'),
(14, 'Violet', '#663399');

-- --------------------------------------------------------

--
-- Structure de la table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(128) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(128) CHARACTER SET utf8 NOT NULL,
  `email` varchar(128) CHARACTER SET utf8 NOT NULL,
  `password` varchar(128) CHARACTER SET utf8 NOT NULL,
  `way_num` int(128) NOT NULL,
  `way_type` enum('Allée','Avenue','Boulevard','Carrrefour','Chemin','Chaussée','Cité','Corniche','Cours','Domaine','Descente','Ecart','Esplanade','Faubourg','Grande Rue','Hameau','Halle','Impasse','Lieu-dit','Lotissement','Marché','Montée','Passage','Place','Plaine','Plateau','Promenade','Parvis','Quartier','Quai','Résidence','Ruelle','Rocade','Rond-point','Route','Rue','Sente','Sentier','Square','Terre-plein','Traverse','Villa','Village') NOT NULL,
  `way_name` varchar(64) NOT NULL,
  `city` varchar(128) CHARACTER SET utf8 NOT NULL,
  `zip_code` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `register_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `member`
--

INSERT INTO `member` (`id`, `first_name`, `last_name`, `email`, `password`, `way_num`, `way_type`, `way_name`, `city`, `zip_code`, `admin`, `register_date`) VALUES
(1, 'admin', 'admin', 'admin', '$2y$12$16dPm1hnmD4Yxb3rls12aezUhvdJnTUnaXUyzG8xMa7Zfj4GC2PgO', 0, 'Allée', '', '', 0, 1, '0000-00-00'),
(2, 'Hadrien', 'Rannou', 'hadriien@live.fr', '$2y$12$J1uothrBpx2wmuGaFeSsKeMU70ltJUMMlXlj/c8JrDyzhcfoQJBmK', 24, 'Rue', 'Bois le Vent', 'Paris', 75016, 0, '2016-02-23'),
(3, 'Ange-Kévin', 'Zokpé', 'kzokpe@gmail.com', '$2y$12$PYrd0UA2Jvi7PdehR2WGaOOW8bl1LwA194j6aLnHVWYq/UvCvUD26', 0, '', '', '', 50000, 1, '2016-03-02');

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member` int(11) NOT NULL,
  `date` date NOT NULL,
  `paid_price` double NOT NULL,
  `paid_price_vat` double NOT NULL,
  `sent_method` enum('Normale','Express') CHARACTER SET utf8 NOT NULL,
  `phones` varchar(1024) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `member` (`member`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `order_phone`
--

CREATE TABLE IF NOT EXISTS `order_phone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paid_price` double NOT NULL,
  `paid_price_vat` double NOT NULL,
  `phone` int(11) NOT NULL,
  `color` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `member` (`phone`),
  KEY `phone` (`phone`),
  KEY `color` (`color`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `phone`
--

CREATE TABLE IF NOT EXISTS `phone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `brand` int(11) NOT NULL,
  `capacity` varchar(16) CHARACTER SET utf8 NOT NULL,
  `price` double NOT NULL,
  `color` varchar(16) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `brand` (`brand`,`capacity`,`color`),
  KEY `brand_2` (`brand`),
  KEY `capacity` (`capacity`,`color`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `phone`
--

INSERT INTO `phone` (`id`, `name`, `brand`, `capacity`, `price`, `color`, `description`) VALUES
(1, 'HTC One A9', 6, '16', 399, '11,12,13', 'Ecran 5" Full HD - 4G - Android™ 6.0 + HTC Sense™ - Processeur Octo-Core 4*1.5GHz&4*1.2GHz - Appareil Photo 13Mp Auto-Focus - ROM : 16 Go / RAM : 2 Go - Extensible par Micro SD jusqu''à 2 To - Nano SIM - DAS : Tête : 0.415 W/kg / Corps : 0.259 W/kg - Dolby Audio - Bluetooth 4.1 - Wi-Fi - Batterie 2150mAh - Double micro annulation du bruit - Garantie Constructeur : 2 Ans.'),
(2, 'HTC One M9', 6, '32', 627, '7,9,11', 'Etui folio offert hors produit "C le marché" - Ecran 5" - 4G - Android Lollipop 5.0 avec HTC Sense - Processeur Octo Core 4*2.0Ghz + 4*1.5Ghz - Appareil Photo 20Mp - ROM : 32Go / RAM : 3Go - Extensible par Micro SD jusqu''à 128Go - Nano SIM - Bluetooth 4.1 - NFC - Batterie 2840mAh - Coque monobloc en aluminium à la finition deux tons - DAS : 0.518W/kg'),
(3, 'iPhone 6S', 5, '16,64,128', 670, '9,10,11,12', 'Ecran 4.7'''' Retina HD - Résolution : 1334x750 - 7.1mm - Puce A9 avec coprocesseur de mouvement M9 - Architecture 64 bits - iOS 9 et iCloud - 4G LTE, Wi-Fi - NFC - Bluetooth - Appareil photo iSight 12Mps Tue Tone Flash, stabilisation optique de l’image - Enregistrement vidéo 4K / HD 1080p à 30 ou 60i/s - Caméra FaceTime HD - Touch ID Capteur d’empreinte digitale intégré au bouton principal'),
(4, 'Xperia Z5', 4, '32,64,128', 679, '1,2,6,10,9', 'Le Xperia Z5 vous permet de saisir chaque occasion de réaliser une photo exceptionnelle, avant qu''elle ne vous   échappe. Grâce à sa fonction Autofocus hybride, notre téléphone avec le meilleur appareil photo à ce jour est un virtuose aussi rapide que précis. Associée à un capteur 23 mégapixels ainsi qu''à un puissant zoom 5x, elle permet au Xperia Z5 de capturer les instants les plus fugaces avec une netteté déconcertante, dès la première tentative.'),
(5, 'Xperia C4', 4, '16,32,64,128', 348, '1,2,3', 'Le Xperia C4, c’est un appareil photo principal 13 mégapixels ultraperformant   doublé d’un appareil photo avant 5 mégapixels avec flash LED et objectif grand angle. Vous êtes paré pour prendre des photos et des vidéos PROselfie.'),
(6, 'Xperia E4g', 4, '16,32', 129, '1,2', 'Profitez d''un smartphone à prix accessible qui associe la 4G, un large écran lumineux et des composants puissants pour une expérience utilisateur optimale. '),
(7, 'Xperia M', 4, '16,32', 215, '1,2,14', 'Le design fin et épuré de l''Xperia™ M, inspiré de l''Xperia™ Z saura vous convaincre. Il assure une fiabilité exemplaire intégrant Android 4.1 et un appareil photo de 5 mégapixels qui vous permettra de capturer vos meilleurs instants.'),
(8, 'Xperia E3', 4, '16,32', 169, '1,2,8,9', 'Le smartphone Sony Xperia E3 est un milieu de gamme 4G à prix modéré. Équipé d''un écran de 4,5 pouces, il embarque un processeur Snapdragon 400 et un capteur photo 5 mégapixels.'),
(9, 'Xperia C5', 4, '16,32,64,128', 399.99, '1,2,3', 'Avec ses deux appareils photo\r\n13 mégapixels et son écran 6” ultra lumineux, le Xperia C5 Ultra Dual vous permet de réaliser de magnifiques selfies en toutes circonstances.'),
(10, 'Xperia E', 4, '16,32', 119.9, '1,2,7', 'Le smartphone Android pratique avant\r\ntout !'),
(11, 'Xperia T3', 4, '16,32', 229, '1,2,14', 'Découvrez le Sony XperiaTM T3, un\r\nsmartphone résistant à toute épreuve mêlant légèreté et finesse. Il dispose d''un bel écran HD de 5,3 pouces, un design fin et élégant, une bonne autonomie et un appareil photo de 8 Mégapixels pour profiter du meilleur du multimédia.'),
(12, 'Xperia Z', 4, '16,32', 699.99, '1,2,14', 'Une expérience unique en 4G !\r\nVéritable bijou technologique, le Sony XperiaTM Z associe à la fois performance et design. Doté d’un processeur quadruple cœur cadencé à 1,5 GHz et d’une connectivité 4G, vous êtes multitâches et surfez très rapidement, sans épuiser la batterie ! Vous apprécierez également les matières nobles (aluminium et verre trempé) utilisées dans la conception du téléphone.'),
(13, 'Xperia M4 Aqua', 4, '16,32', 314.36, '1,2,7', 'Un smartphone 4G étanche avec\r\nun écran 5 pouces, aussi beau qu’agréable à tenir en main. Toute l’expertise de Sony dans des appareils photos 13 Mégapixels et 5 Mégapixels. Une batterie puissante et des modes d’économie d’énergie efficaces.');

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` int(11) NOT NULL,
  `percent` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phone` (`phone`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `promotion`
--

INSERT INTO `promotion` (`id`, `phone`, `percent`) VALUES
(1, 3, 10);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`member`) REFERENCES `member` (`id`);

--
-- Contraintes pour la table `order_phone`
--
ALTER TABLE `order_phone`
  ADD CONSTRAINT `order_phone_ibfk_2` FOREIGN KEY (`phone`) REFERENCES `phone` (`id`),
  ADD CONSTRAINT `order_phone_ibfk_3` FOREIGN KEY (`color`) REFERENCES `color` (`id`);

--
-- Contraintes pour la table `phone`
--
ALTER TABLE `phone`
  ADD CONSTRAINT `phone_ibfk_1` FOREIGN KEY (`brand`) REFERENCES `brand` (`id`);

--
-- Contraintes pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD CONSTRAINT `promotion_ibfk_1` FOREIGN KEY (`phone`) REFERENCES `phone` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
