-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 26 Mars 2016 à 01:57
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

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
(14, 'Violet', '#663399'),
(15, 'Orange', '#FFA500');

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
-- Structure de la table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member` int(11) NOT NULL,
  `date` date NOT NULL,
  `paid_price` double NOT NULL,
  `paid_price_vat` double NOT NULL,
  `sent_method` enum('Normale','Express') CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `member` (`member`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `orders`
--

INSERT INTO `orders` (`id`, `member`, `date`, `paid_price`, `paid_price_vat`, `sent_method`) VALUES
(1, 1, '0000-00-00', 123, 143, 'Express');

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
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `member` (`phone`),
  KEY `phone` (`phone`),
  KEY `color` (`color`),
  KEY `order_id` (`order_id`)
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Contenu de la table `phone`
--

INSERT INTO `phone` (`id`, `name`, `brand`, `capacity`, `price`, `color`, `description`) VALUES
(1, 'LG L Bello II', 1, '16', 109.99, '1,2', 'Héritée du design du G3, les touches de contrôle\r\nsituées sur la coque arrière font leur apparition sur le L Bello. Esthétiques et pratiques, elles remplacent les boutons sur le côté et s''avèrent bien plus pratique à utiliser au quotidien.'),
(2, 'LG G3S', 1, '16,32', 169.99, '1,2', 'Le nouveau LG G3 au design sobre, est\r\ntout simplement révolutionnaire, grâce à son grand écran QuadHD, un appareil photo de 13 Mégapixels et un processeur de 2,46GHz. Incarnant l''association parfaite de beauté et performance, il constitue le choix de l''excellence by LG.'),
(3, 'LG G4 Stylus', 1, '16,32,64,128', 184, '1,2', 'Le smartphone LG G4 Stylus est un\r\ntéléphone pratique à utiliser au quotidien grâce à son écran géant 5,7 pouces, son stylet, sa connectivité 4G, ses appareils photos performants...'),
(4, 'LG Spirit', 1, '16,32', 129, '1,2', 'Disposant d''un écran tactile HD de 4.7",\r\nle LG C70 Spirit est propulsé par un processeur Qualcomm Snapdragon 410 Quad-Core cadencé à 1.2 GHz et Android 5.0 Lollipop. Le smartphone LG Spirit vous garantit une expérience riche, en photo, vidéo, musique ou même en jeu. Le LG C70 Spirit est un passeport à prix réduit vers l''expérience multimédia mobile.'),
(5, 'LG Leon Y50', 1, '16,32', 115.5, '1,2', 'Le LG LEON 4G est un smartphone\r\nultra rapide et performant grâce à ses 4 coeurs ! Une fluidité optimale pour jouer et surfer sans limite ! Avec ses 1,09 cm d’épaisseur et son grand écran 4,5’’, le LG LEON 4G vous dévoile un design sophistiqué aux détails soignés.'),
(6, 'LG F60', 1, '16,32', 121, '1,2', 'LG F60 | ECRAN 4,5" (11,4CM) 800X480 | PROCESSEUR QUAD CORE 1,2 GHZ | BATTERIE 2100 MAH | APN 5MP | ANDROID 4.4.2 KITKAT | KNOCK CODE | 4G'),
(7, 'LG G2 Mini', 1, '16,32', 179, '1,2', 'Avec son design élégant et ses bords extrêmement fins et sans bouton, vous bénéficierez d''un grand écran dans un format mini.'),
(8, 'LG GFlex 2', 1, '16,32,64,128', 288, '1,2', ' Avec Android 5.0 Lollipop, votre téléphone LG montrera tout son potentiel : Mode Invité, mode « ne pas déranger », un accès rapide aux dernières applications et tous les avantages de ce tout dernier système d’exploitation.'),
(9, 'LG G5', 1, '16,32', 114.99, '1', 'Son large écran 5" vous permet une navigation plus intuitive et un affichage plus clair des applications.\r\nIl mettra en valeur toutes vos photos et vidéos.'),
(10, 'LG Nexus 5x', 1, '16,32', 350.19, '1,2,3', 'Fonctionne avec tous les opérateurs. Système : Android 6.0 Marshmallow Processeur : Hexa-core / 1,8 GHz / Qualcomm Snapdragon 808 / Processeur graphique (GPU) : Adreno 418 Mémoires :\r\nInterne : 32 Go / RAM : 2 GoAffichage : 5,2 pouces / LCD / Rés'),
(11, 'Nokia Lumia 920', 2, '16,32', 369, '1,2,4', 'Goûtez à l''Internet ultra rapide sur votre smartphone Nokia 4G. Regardez la télé, achetez en ligne et accédez aux réseaux sociaux et divertissement où que vous soyez et en un clin d’oeil. Les nouveaux Nokia Lumia 920 et 820 avec Windows Phone 8 sont prêts pour la 4G.'),
(12, 'Nokia Lumia 950', 2, '16,32,64,128', 569.99, '1', 'Des fonctionnalités haut de gamme, un design unique, et toute l’expérience Windows 10. Découvrez le smartphone qui fonctionne comme un PC et profitez de chaque moment pour accomplir de belles choses.'),
(13, 'Nokia Lumia 830', 2, '16,32,64,128', 349, '1,2,6,15', 'Le Nokia Lumia 830 est conçu pour une vie en mouvement. Prenez des photos épatantes avec l''appareil photo PureView, synchronisez votre vie numérique avec OneDrive et partagez vos grands moments sur vos réseaux sociaux préférés - c''est le smartphone idéal pour les gens qui aiment rester connectés.'),
(14, 'Nokia Lumia 435', 2, '16,32,64,128', 113.6, '1,2,15', 'Le Lumia 435 est robuste et facile à utiliser. Il dispose de la dernière version logicielle et des services Microsoft les plus appréciés comme Skype, Office, et OneDrive, déjà pré-installés et gratuits. Il s''agit d''une expérience smartphone inédite à ce niveau de prix, avec des services généralement destinés aux plus hauts de gamme.'),
(15, 'Nokia Lumia 532', 2, '16,32,64,128', 90.32, '1,2,6,15', 'Le Lumia 532 Double SIM est un\r\npuissant smartphone équipé de la dernière version logicielle et des meilleures fonctionnalités Windows. Il possède un processeur quadricœur Snapdragon et dispose des services Microsoft les plus populaires comme Skype, OneDrive, et Office : faites-en plus avec un smartphone réactif et simple à utiliser.'),
(16, 'Nokia Lumia 620', 2, '16,32,64,128', 69, '2,3,5,6,15', 'Avec un processeur double cœur de 1 GHz SnapDragon S4, un appareil photo autofocus 5 MP et toute une gamme de coloris.'),
(17, 'Nokia Lumia 1320', 2, '16,32,64', 249.99, '1,2,4,5', 'Le Nokia Lumia 1320 est le smartphone pour les professionnels : il embarque Microsoft Office, des applis professionnelles comme Microsoft Exchange, Office 365 et Lync, et une sécurité de niveau professionnel pour vous garantir confidentialité et sérénité.'),
(18, 'Nokia Lumia 640', 2, '16,32,64,128', 169, '1,2,3', 'Dès la sortie de sa boite, votre Lumia 640 4G Double SIM vous fait profiter de la gamme complète de services Microsoft gratuits qui y sont intégrés et prêts à fonctionner. Communiquez avec vos proches sur Skype, profitez de l''accès instantané à vos photos et musiques sur OneDrive, et modifiez vos fichiers avec Microsoft Office où que vous soyez. Il est équipé pour répondre à tous vos besoins, que ce soit pour le travail ou les loisirs.'),
(19, 'Nokia Lumia 1020', 2, '16,32', 356, '1,2,5', 'Le premier smartphone intégrant un appareil photo de 41 mégapixels. Une multitude des réglages sont à votre disposition dans différentes applications pour vous permettre de prendre des photos d’une qualité incomparable et de les retoucher à l’infini !'),
(20, 'Nokia Lumia 520', 2, '16,32,64', 59.9, '1,2,3,4,5', 'Laissez-vous surprendre par le design\r\nnovateur du Lumia 520. Equipé d''un écran de 4 pouces super sensitif et d''un appareil photo de 5 mégapixels, profitez de la nouvelle interface Windows Phone 8, de son confort d''utilisation et de sa simplicité.'),
(21, 'Samsung Grand Prime Value Edition', 3, '16,32,64,128', 193.38, '1,2,9', 'Le Samsung Galaxy Grand Prime VE est\r\nla nouvelle version de la gamme Samsung réservée aux grands écrans qui misent sur une interface intuitive et accessible. Le Grand Prime VE fonctionne sous android 5.1.1 et s''équipe d''un écran 5 pouces.'),
(22, 'Samsung J5', 3, '16,32,64,128', 184, '1,2,9', 'Le Samsung Galaxy J5 est un smartphone\r\nendurant et performant avec un design ultra fin. Doté d''une bonne configuration avec son processeur Quad-core cadencé à 1,2GHz, d’un écran tactile de 5 pouces HD Super AMOLED et animé par le système d’exploitation Android 5.1 (Lollipop), il saura vous convertir à l''univers Galaxy de la marque Samsung !'),
(23, 'Samsung A5', 3, '16,32,64', 279.99, '1,2,9', 'Accessible au plus grand nombre, le\r\nGalaxy A5 2016 adopte un design sobre et élégant fait de verre et de métal. Grâce à ses finitions travaillées, sa finesse et son verre Gorilla Glass 4, le Galaxy A5 est un smartphone moderne et soigné. Il sera disponible en noir, or ou blanc pour que chacun puisse choisir la combinaison qui lui correspond le plus.'),
(24, 'Samsung Galaxy S6', 3, '16,32', 596.03, '1,2', 'Le design délicat du Galaxy S6 est le\r\nfruit de nombreuses heures de recherche et de développement méticuleux de nos créateurs passionnés. Serti de métal, habillé de verre, et galbé à la perfection, le Galaxy S6 a été façonné avec soin pour un résultat à couper le souffle. Parce que sa perfection ne se limite pas à ses lignes, nos ingénieurs et ergonomes ont concentré tout leur savoir-faire au cœur du Galaxy S6 : son interface épurée et intuitive vous permet de profiter de performances inégalées.'),
(25, 'Samsung Galaxy Note 4', 3, '16,32', 549, '1,2', 'Son grand écran Super AMOLED QHD 5.7 pouces de 3 millions de pixels reproduit des images éclatantes, plus vivantes, avec des contrastes profonds. Le Galaxy Note 4 offre une fluidité exceptionnelle grâce des temps de réponse de l’écran allant de l’ordre du millionième de seconde pour une expérience unique.'),
(26, 'Samsung S4', 3, '16,32,64', 340, '1,2', 'Le Samsung GALAXY S4 a été\r\ndéveloppé pour s’adapter à de nouveaux modes de vie et se révèlera vite indispensable. Elégant et innovant, ce smartphone vous rapproche de vos amis et de votre famille, vous simplifie la vie grâce à une utilisation très intuitive et vous permet même de prendre soin de vous.'),
(27, 'Samsung Galaxy Grand Plus', 3, '16,32,64', 114.9, '1,2', 'Qui n''a jamais rêvé d''avoir un écran\r\nplus grand? Le Galaxy Grand vous propose un écran de 5" tout en conservant finesse et portabilité. Doté des capacités d''un smartphone et de nombreuses fonctions multimédia, il s''appuie sur un processeur de nouvelle génération pour offrir une expérience toujours plus fluide. Vous avez dit multitâche? Utilisez plusieurs applications grâce à la fonction partage d''écran ou lisez des vidéos en pop up pour ne rien perdre de\r\nl''action. Regardez des vidéos toute la journée, sans interruption : sa batterie longue durée satisfait les besoins du plus exigeant des amateurs de multimédia. Vous pouvez gérer facilement d''une main vos appels et vos messages en utilisant le clavier spécialement optimisé.'),
(28, 'Samsung Galaxy Trend 2 Lite', 3, '16,32,64,128', 88, '1,2,12', 'Élégant et polyvalent, le Samsung Galaxy Trend 2 lite noir vous accompagne partout. Grâce à sa batterie longue durée et son mode Ultra Économie d''Énergie vous restez connecté toute la journée .'),
(29, 'Samsung Galaxy Core Prime', 3, '16,32,64,128', 119, '1,2,12', 'Le Galaxy Core Prime procure une sensation de fluidité et de réactivité à la hauteur de vos attentes. Grâce à la compatibilité 4G et son processeur Quad Core 1.2 GHz, faites tout ce que vous souhaitez à pleine vitesse.'),
(30, 'Samsung Galaxy Alpha SM-G850', 3, '16,32', 369, '9,12', 'Samsung Galaxy Alpha : Concept,\r\ndesign et équilibre ! Laissez-vous séduire par le parfait équilibre entre l’élégance et le raffinement du smartphone Android Galaxy Alpha.'),
(31, 'Xperia Z5', 4, '32,64,128', 679, '1,2,6,10,9', 'Le Xperia Z5 vous permet de saisir chaque occasion de réaliser une photo exceptionnelle, avant qu''elle ne vous   échappe. Grâce à sa fonction Autofocus hybride, notre téléphone avec le meilleur appareil photo à ce jour est un virtuose aussi rapide que précis. Associée à un capteur 23 mégapixels ainsi qu''à un puissant zoom 5x, elle permet au Xperia Z5 de capturer les instants les plus fugaces avec une netteté déconcertante, dès la première tentative.'),
(32, 'Xperia C4', 4, '16,32,64,128', 348, '1,2,3', 'Le Xperia C4, c’est un appareil photo principal 13 mégapixels ultraperformant   doublé d’un appareil photo avant 5 mégapixels avec flash LED et objectif grand angle. Vous êtes paré pour prendre des photos et des vidéos PROselfie.'),
(33, 'Xperia E4g', 4, '16,32', 129, '1,2', 'Profitez d''un smartphone à prix accessible qui associe la 4G, un large écran lumineux et des composants puissants pour une expérience utilisateur optimale. '),
(34, 'Xperia M', 4, '16,32', 215, '1,2,14', 'Le design fin et épuré de l''Xperia™ M, inspiré de l''Xperia™ Z saura vous convaincre. Il assure une fiabilité exemplaire intégrant Android 4.1 et un appareil photo de 5 mégapixels qui vous permettra de capturer vos meilleurs instants.'),
(35, 'Xperia E3', 4, '16,32', 169, '1,2,8,9', 'Le smartphone Sony Xperia E3 est un milieu de gamme 4G à prix modéré. Équipé d''un écran de 4,5 pouces, il embarque un processeur Snapdragon 400 et un capteur photo 5 mégapixels.'),
(36, 'Xperia C5', 4, '16,32,64,128', 399.99, '1,2,3', 'Avec ses deux appareils photo\r\n13 mégapixels et son écran 6” ultra lumineux, le Xperia C5 Ultra Dual vous permet de réaliser de magnifiques selfies en toutes circonstances.'),
(37, 'Xperia E', 4, '16,32', 119.9, '1,2,7', 'Le smartphone Android pratique avant\r\ntout !'),
(38, 'Xperia T3', 4, '16,32', 229, '1,2,14', 'Découvrez le Sony XperiaTM T3, un\r\nsmartphone résistant à toute épreuve mêlant légèreté et finesse. Il dispose d''un bel écran HD de 5,3 pouces, un design fin et élégant, une bonne autonomie et un appareil photo de 8 Mégapixels pour profiter du meilleur du multimédia.'),
(39, 'Xperia Z', 4, '16,32', 699.99, '1,2,14', 'Une expérience unique en 4G !\r\nVéritable bijou technologique, le Sony XperiaTM Z associe à la fois performance et design. Doté d’un processeur quadruple cœur cadencé à 1,5 GHz et d’une connectivité 4G, vous êtes multitâches et surfez très rapidement, sans épuiser la batterie ! Vous apprécierez également les matières nobles (aluminium et verre trempé) utilisées dans la conception du téléphone.'),
(40, 'Xperia M4 Aqua', 4, '16,32', 314.36, '1,2,7', 'Un smartphone 4G étanche avec\r\nun écran 5 pouces, aussi beau qu’agréable à tenir en main. Toute l’expertise de Sony dans des appareils photos 13 Mégapixels et 5 Mégapixels. Une batterie puissante et des modes d’économie d’énergie efficaces.'),
(41, 'iPhone 6S Plus', 5, '16,32,64,128', 1077, '10,11,12', 'Plus grand que grand !'),
(42, 'iPhone 6S', 5, '16,64,128', 670, '9,10,11,12', 'Ecran 4.7'''' Retina HD - Résolution : 1334x750 - 7.1mm - Puce A9 avec coprocesseur de mouvement M9 - Architecture 64 bits - iOS 9 et iCloud - 4G LTE, Wi-Fi - NFC - Bluetooth - Appareil photo iSight 12Mps Tue Tone Flash, stabilisation optique de l’image - Enregistrement vidéo 4K / HD 1080p à 30 ou 60i/s - Caméra FaceTime HD - Touch ID Capteur d’empreinte digitale intégré au bouton principal'),
(43, 'iPhone 6 Plus', 5, '16,32,64,128', 956.49, '1,11,12', 'Plus grand que grand !'),
(44, 'iPhone 6', 5, '16,32,64,128', 576, '11,12', 'Plus grand que grand !'),
(45, 'iPhone 5S', 5, '16,32,64', 294.2, '11,12', 'A la pointe de la technologie, l''iPhone 5s intègre la puce A7 à l''architecture 64 bits, le capteur d''identité par empreinte digitale Touch ID, un nouvel appareil photo iSight de 8 Mégapixels, une nouvelle caméra FaceTime HD, une connectivité 4G LTE ultra-rapide, iOS 7 et iCloud. Il n''en reste pas moins tout aussi fin et léger.'),
(46, 'iPhone 5C', 5, '16,32', 159, '2,3,5,6', 'Vous n’avez jamais vu, ni tenu, un iPhone comme celui-ci. L’iPhone 5c est fièrement, absolument, génialement fait de plastique , la seule matière capable de donner vie de façon aussi éclatante à ses cinq couleurs exceptionnelles. Sa surface parfaitement lisse et uniforme recèle un cadre renforcé en métal qui lui confère son intégrité structurelle et cette solidité rassurante.'),
(47, 'iPhone 5', 5, '16,32,64', 189, '1,2', 'On a peine à croire qu’un iPhone aussi suréquipé – un écran plus grand, une puce plus rapide, une technologie sans fil ultra-rapide, un appareil photo iSight 8 mégapixels – puisse être aussi fin et léger. C’est pourtant vrai. L’iPhone 5 est le plus fin et le plus léger iPhone de tous les temps.'),
(48, 'iPhone 4S', 5, '16,32,64', 119, '1,2', 'Des nouveautés pour un iPhone toujours plus rapide, puissant et intelligent ! '),
(49, 'iPhone 4', 5, '16,32', 199.99, '1,2', 'Brillant, cristallin, lumineux... son écran Retina haute résolution donne le ton... L''iPhone 4 bénéficie en outre d''un appareil photo 5 mégapixels, des appels vidéo FaceTime et d''une batterie longue durée. '),
(50, 'iPhone 3GS', 5, '16,32', 189, '1,2', 'L''iPhone réunit trois appareils en un et offre les fonctions d''un téléphone portable révolutionnaire, d''un iPod à écran panoramique et d''un terminal internet encore jamais vu.'),
(51, 'HTC One A9', 6, '16', 399, '11,12,13', 'Ecran 5" Full HD - 4G - Android™ 6.0 + HTC Sense™ - Processeur Octo-Core 4*1.5GHz&4*1.2GHz - Appareil Photo 13Mp Auto-Focus - ROM : 16 Go / RAM : 2 Go - Extensible par Micro SD jusqu''à 2 To - Nano SIM - DAS : Tête : 0.415 W/kg / Corps : 0.259 W/kg - Dolby Audio - Bluetooth 4.1 - Wi-Fi - Batterie 2150mAh - Double micro annulation du bruit - Garantie Constructeur : 2 Ans.'),
(52, 'HTC One M9', 6, '32', 627, '7,9,11', 'Etui folio offert hors produit "C le marché" - Ecran 5" - 4G - Android Lollipop 5.0 avec HTC Sense - Processeur Octo Core 4*2.0Ghz + 4*1.5Ghz - Appareil Photo 20Mp - ROM : 32Go / RAM : 3Go - Extensible par Micro SD jusqu''à 128Go - Nano SIM - Bluetooth 4.1 - NFC - Batterie 2840mAh - Coque monobloc en aluminium à la finition deux tons - DAS : 0.518W/kg'),
(53, 'HTC One M8s', 6, '16,32,64,128', 379.9, '9,11,12', 'HTC One® M8s: Ecran 5", appareil photo Duo Camera 13 MPx et HTC EyeTM Experience, appareil photo frontal 5 MPx, HTC BoomSoundTM et Android Lollipop.'),
(54, 'HTC One mini 2', 6, '16,32,64,128', 351, '9,11,12', 'Compact et performant. Doté d''un écran compact de 4,3" et d''un design affiné, le HTC One mini offre les fonctionnalités primées et le design du HTC One. Son double haut-parleur stéréo en façade, son écran d''accueil interactif et son appareil photo haute sensibilité sont intégrés à un design en alluminium pour vous offrir un produit plus compact que jamais. '),
(55, 'HTC One', 6, '16,32', 359.99, '1,3,4', 'Habillé d’une coque monobloc tout en aluminium, le nouveau HTC One propose un design volontairement premium. Profitez de l’écran d''accueil qui affiche instantanément tous vos contenus favoris ainsi que de la galerie de photos interactive. Vous apprécierez également le double haut-parleur stéréo en façade pour un son pur et clair. Le nouveau HTC One est prêt à redéfinir votre expérience du Smartphone ! '),
(56, 'HTC Desire 820', 6, '16,32,64,128', 279.99, '2,3,12', 'Pour un affichage, des photos, de la musique et un style incroyables : c''est le HTC Desire 820. Grâce à son grand écran d''affichage de ’5,5'''', il vous sera possible de visionner davantage de contenus ”, prendre de superbes photos à l''aide de ses caméras jumelles (principale de 13 MP/ avant de 8 MP), et de profite davantage de son audio immersif grâce à ses doubles haut-parleurs stéréo avant. Faites davantage ce que vous aimez avec HTC Desire 820. '),
(57, 'HTC Desire 620', 6, '16,32,64,128', 169.99, '1,2', 'Changez de point de vue avec le HTC Desire 620, l''appareil photo équipé des meilleurs outils de sa catégorie avec un grand écran 5” et une puissance de traitement quadricœur. Faites des photos et des vidéos incroyables avec chaque face et diffusez, téléchargez, et visualisez le contenu HD instantanément avec la connexion LTE. '),
(58, ' HTC Desire 626', 6, '16,32,64,128', 237.09, '1,3,4,12', 'Obtenez tout ce que vous désirez et bien plus encore, avec un appareil photo principal de 13 MP, le meilleur de sa catégorie, qui vous permet de capturer sur le vif des moments de la vie en haute résolution. Profitez d''une performance de haute qualité grâce à son cadre élégant et mince. '),
(59, 'HTC 510', 6, '16,32,64,128', 254.96, '1,12', 'Ne laissez pas son prix modeste vous tromper. Doté d’un processeur 4G quad-core, le HTC Desire 510 affiche des graphismes riches, jongle entre plusieurs applications et offre une fluidité de jeu d’un smartphone haute gamme. ®. Découvrez vite le HTC Desire 510!'),
(60, 'HTC 310', 6, '16,32', 89.99, '1,12', 'Des fonctionnalités d''exception à un prix abordable : le processeur propulsera votre expérience mobile à une vitesse astronomique avec la mise à jour des flux sur votre écran d''accueil, en plus, la fonctionnalité de l''appareil photo crée des mini-films à partir de vos photos et vidéos. Placez la barre très haut avec le HTC Desire 310.'),
(61, 'Huawei Ascend G7', 7, '16,32', 220, '2,11,12', 'Un design compact, pour une pointe de style Une connexion 4G ultra rapide, pour une expérience sans limite Une batterie de 3 000 mAh, pour prolonger le plaisir Une prise de vue instantanée, pour ne rien manquer.'),
(62, 'Huawei Mate 8', 7, '32', 625.26, '1,9,12', 'Avec l’arrivée du Huawei Mate 8, l’apparence et la sensation de la série Mate s’élève à un autre niveau. Son écran 6” Full HD encore plus détaillé, encore plus coloré lui offre une taille encore plus fine et pratique. Le capteur d’empreinte redessiné, toujours plus rapide, toujours plus fiable, et son armature totalement en métal vous procurera une sensation unique dans le creux de vos mains.'),
(63, 'Huawei Mate S Titanium', 7, '32,64,128', 472.6, '1,9,12', 'Un design inspiré, une technologie à la pointe, le Huawei Mate S vous ouvre un Monde aux possibilités illimitées. Vous n''avez plus qu''à le toucher. Alliance entre la beauté et l''interactivité, ce smartphone va mettre tous vos sens en éveil.Préparez vous, la puissance est là.'),
(64, 'Huawei P8 Lite', 7, '16', 209, '1,9,12', 'Découvrez le Huawei P8 Lite. Un pur équilibre. Grâce à ses courbes soignées, ses 7.7 mm d’épaisseur, et son écran parcourant la quasi intégralité de la face du téléphone, le P8 Lite se logera parfaitement dans le creux de votre main. Son design va vous faire réaliser ce que signifie vraiment le mot « confort ». Voici le compagnon idéal pour vous accompagner au quotidien.'),
(65, 'Huawei Ascend Y530', 7, '16,32', 106.77, '1,9,12', 'Le Huawei Ascend Y530 est un smartphone simplement extra : design ergonomique, finition haut de gamme, écran IPS de 4,5 pouces, processeur Qualcomm Snapdragon S200 dual core 1,2 Ghz, Android Jelly Bean en version 4.3 et une toute nouvelle façon de naviguer avec l''interface utilisateur Huawei Emotion UI.\r\n'),
(66, 'Huawei G8', 7, '16,32', 349.9, '1,2', 'Le Huawei G8 est l''un des meilleurs smartphones Huawei du moment. Doté d''une connectivité 4G, ce téléphone portable de marque Chinoise dispose d''un très bon rapport qualité- prix. Meilleur mobile vous aide à acheter votre Huawei G8 Or au prix le moins cher du moment en comparant pour vous l''intégralité des tarifs proposés par les différentes boutiques en ligne Françaises et de confiance.'),
(67, 'Huawei Nexus 6P', 7, '16,32,64,128', 561.99, '11', 'Un écran AMOLED haute résolution WQHD de 5,7 pouces et des hauts-parleurs stéréo à l''avant, le tout inégré dans une coque élégante en aluminium et épaulé par Android 6.0 Marshmallow.'),
(68, 'Huawei Ascend P7', 7, '16', 336.12, '1,2,7', 'L’alliance subtile d’un design unique, d’une connectivité 4G ultra rapide et d’un appareil photo 13 mégapixels. Au-delà des possibilités, l’Ascend P7 redéfinit l’avenir de la technologie mobile.'),
(69, 'Huawei Ascend G6', 7, '16', 240, '2', 'Le Smartphone Ascend G6 permet de prendre de plus belles photos et « selfies » grâce à ses optiques de 8 et 5 mégapixels en frontal, d’en profiter simplement au travers de son interface « Simple UI » et de les partager plus vite avec ses proches grâce à sa connexion 4G de 150mbps'),
(70, 'Huawei P8 Lite', 7, '16', 209, '1,2', 'Découvrez le Huawei P8 Lite. Un pur équilibre. Grâce à ses courbes soignées, ses 7.7 mm d’épaisseur, et son écran parcourant la quasi intégralité de la face du téléphone, le P8 Lite se logera parfaitement dans le creux de votre main. Son design va vous faire réaliser ce que signifie vraiment le mot « confort ». Voici le compagnon idéal pour vous accompagner au quotidien.');

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
(1, 3, 15);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`member`) REFERENCES `member` (`id`);

--
-- Contraintes pour la table `order_phone`
--
ALTER TABLE `order_phone`
  ADD CONSTRAINT `order_phone_ibfk_4` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
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
