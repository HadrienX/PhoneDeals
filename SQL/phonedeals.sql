-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Sam 13 Février 2016 à 19:47
-- Version du serveur :  5.5.42
-- Version de PHP :  7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `phonedeals`
--

-- --------------------------------------------------------

--
-- Structure de la table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(128) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `brand`
--

INSERT INTO `brand` (`id`, `brand_name`) VALUES
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

CREATE TABLE `capacity` (
  `id` int(11) NOT NULL,
  `storage` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `hex` varchar(7) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `color`
--

INSERT INTO `color` (`id`, `name`, `hex`) VALUES
(1, 'Noir', '#000'),
(2, 'Blanc', '#fff'),
(3, 'Bleu', '#1c63df'),
(4, 'Rouge', '#e3161d'),
(5, 'Jaune', '#f8dd08'),
(6, 'Vert', '#a0e86d'),
(7, 'Rose', '#fd7071'),
(8, 'Marron', '#5c4745'),
(9, 'Or', '#9b9ba0'),
(10, 'Or Rose', '#cfa8a1'),
(11, 'Argent', '#d0d0d4'),
(12, 'Gris sidéral', '#9b9ba0'),
(13, 'Bordeaux', '#54161f');

-- --------------------------------------------------------

--
-- Structure de la table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
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
  `register_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `member`
--

INSERT INTO `member` (`id`, `first_name`, `last_name`, `email`, `password`, `way_num`, `way_type`, `way_name`, `city`, `zip_code`, `admin`, `register_date`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 0, 'Allée', '', '', 0, 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `member` int(11) NOT NULL,
  `date` date NOT NULL,
  `paid_price` double NOT NULL,
  `paid_price_vat` double NOT NULL,
  `sent_method` enum('normale','express') CHARACTER SET utf8 NOT NULL,
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `phone`
--

CREATE TABLE `phone` (
  `id` int(11) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `brand` int(11) NOT NULL,
  `capacity` varchar(16) CHARACTER SET utf8 NOT NULL,
  `price` double NOT NULL,
  `color` varchar(16) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `phone`
--

INSERT INTO `phone` (`id`, `name`, `brand`, `capacity`, `price`, `color`, `description`) VALUES
(1, 'HTC One A9', 6, '16', 399, '11,12,13', 'Ecran 5" Full HD - 4G - Android™ 6.0 + HTC Sense™ - Processeur Octo-Core 4*1.5GHz&4*1.2GHz - Appareil Photo 13Mp Auto-Focus - ROM : 16 Go / RAM : 2 Go - Extensible par Micro SD jusqu''à 2 To - Nano SIM - DAS : Tête : 0.415 W/kg / Corps : 0.259 W/kg - Dolby Audio - Bluetooth 4.1 - Wi-Fi - Batterie 2150mAh - Double micro annulation du bruit - Garantie Constructeur : 2 Ans.'),
(2, 'HTC One M9', 6, '32', 627, '7,9,11', 'Etui folio offert hors produit "C le marché" - Ecran 5" - 4G - Android Lollipop 5.0 avec HTC Sense - Processeur Octo Core 4*2.0Ghz + 4*1.5Ghz - Appareil Photo 20Mp - ROM : 32Go / RAM : 3Go - Extensible par Micro SD jusqu''à 128Go - Nano SIM - Bluetooth 4.1 - NFC - Batterie 2840mAh - Coque monobloc en aluminium à la finition deux tons - DAS : 0.518W/kg'),
(3, 'iPhone 6S', 5, '16,64,128', 670, '9,10,11,12', 'Ecran 4.7'''' Retina HD - Résolution : 1334x750 - 7.1mm - Puce A9 avec coprocesseur de mouvement M9 - Architecture 64 bits - iOS 9 et iCloud - 4G LTE, Wi-Fi - NFC - Bluetooth - Appareil photo iSight 12Mps Tue Tone Flash, stabilisation optique de l’image - Enregistrement vidéo 4K / HD 1080p à 30 ou 60i/s - Caméra FaceTime HD - Touch ID Capteur d’empreinte digitale intégré au bouton principal');

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE `promotion` (
  `id` int(11) NOT NULL,
  `phone` int(11) NOT NULL,
  `pourcent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `capacity`
--
ALTER TABLE `capacity`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member` (`member`,`phone`),
  ADD KEY `member_2` (`member`),
  ADD KEY `phone` (`phone`);

--
-- Index pour la table `phone`
--
ALTER TABLE `phone`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand` (`brand`,`capacity`,`color`),
  ADD KEY `brand_2` (`brand`),
  ADD KEY `capacity` (`capacity`,`color`);

--
-- Index pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phone` (`phone`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `capacity`
--
ALTER TABLE `capacity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `phone`
--
ALTER TABLE `phone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`member`) REFERENCES `member` (`id`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`phone`) REFERENCES `phone` (`id`);

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
