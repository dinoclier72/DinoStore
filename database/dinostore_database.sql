-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 23 jan. 2023 à 23:56
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dinostore`
--

DELIMITER $$
--
-- Fonctions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `use_points` (`pointsToUse` INT, `idClient` INT) RETURNS INT(11) BEGIN
DECLARE totalPoints INT;
DECLARE pointPortion INT;
DECLARE idPortion INT;
SELECT SUM(points.quantity) FROM points WHERE points.id_client = idCLient INTO totalPoints;
IF totalPoints < pointsToUse THEN
SIGNAL SQLSTATE VALUE '99999' SET MESSAGE_TEXT = 'Pas assez de points pour l achat';
ELSE
boucle: WHILE pointsToUse > 0 DO
SELECT points.id_points,points.quantity FROM points WHERE points.id_client = 8 GROUP BY points.expiry_date HAVING points.expiry_date = min(points.expiry_date) INTO idPortion, pointPortion;
IF pointPortion > pointsToUse THEN
UPDATE points SET points.quantity = pointPortion-pointsToUSe WHERE points.id_points = idPortion;
SET pointsToUse = 0;
ELSE
DELETE FROM points WHERE points.id_points = idPortion;
SET pointsToUse = pointsToUse - pointPortion;
END IF;
END WHILE boucle;
END IF;
RETURN pointsToUse;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `address`
--

CREATE TABLE `address` (
  `id_address` int(11) NOT NULL,
  `country` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `id_rank` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `client_name`, `id_rank`) VALUES
(1, 'Jean Michel', 1),
(2, 'Jean Patrick', 1),
(3, 'Michel LeGrand', 1),
(4, 'Melon Husk', 1),
(5, 'Jey Founet', 1),
(6, 'Holly Wood', 1),
(7, 'Mike Oak', 1),
(8, 'Ben Dover', 1),
(9, 'Gwen Tillaite Stabwond', 1),
(10, 'George', 1),
(11, '_ L inquisiteur', 1);

-- --------------------------------------------------------

--
-- Structure de la table `client_lives_at`
--

CREATE TABLE `client_lives_at` (
  `id_address` int(11) NOT NULL,
  `id_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `commande_info`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `commande_info` (
`id_orders` int(11)
,`client_name` varchar(50)
,`order_status_name` varchar(50)
,`product_name` varchar(50)
,`quantity` int(11)
,`price` decimal(16,2)
,`status_order_product_name` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure de la table `company`
--

CREATE TABLE `company` (
  `id_company` int(11) NOT NULL,
  `company_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `company`
--

INSERT INTO `company` (`id_company`, `company_name`) VALUES
(1, 'louis vuitton'),
(2, 'Dior'),
(3, 'YSL'),
(4, 'Lancôme'),
(5, 'Leonidas'),
(6, 'L\'Oréal'),
(7, 'Sephora');

-- --------------------------------------------------------

--
-- Structure de la table `courier`
--

CREATE TABLE `courier` (
  `id_courier` int(11) NOT NULL,
  `country` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `id_facture` int(11) NOT NULL,
  `date_facture` date DEFAULT current_timestamp(),
  `frais_service` int(11) NOT NULL DEFAULT 0,
  `frais_livraison` int(11) NOT NULL DEFAULT 0,
  `promotion` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `membership_rank`
--

CREATE TABLE `membership_rank` (
  `id_rank` int(11) NOT NULL,
  `rank_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `membership_rank`
--

INSERT INTO `membership_rank` (`id_rank`, `rank_name`) VALUES
(1, 'SILVER'),
(2, 'GOLD'),
(3, 'PLATINUM'),
(4, 'ULTIMATE');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id_orders` int(11) NOT NULL,
  `id_orders_status` int(11) DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id_orders`, `id_orders_status`, `id_client`) VALUES
(1, 1, 8),
(2, 1, 10);

-- --------------------------------------------------------

--
-- Structure de la table `orders_status`
--

CREATE TABLE `orders_status` (
  `id_orders_status` int(11) NOT NULL,
  `order_status_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `orders_status`
--

INSERT INTO `orders_status` (`id_orders_status`, `order_status_name`) VALUES
(1, 'to buy'),
(2, 'bought'),
(3, 'packed'),
(4, 'shipped'),
(5, 'arrived'),
(6, 'delivered'),
(7, 'done');

-- --------------------------------------------------------

--
-- Structure de la table `parcel`
--

CREATE TABLE `parcel` (
  `id_parcel` int(11) NOT NULL,
  `dispatch_date` date DEFAULT current_timestamp(),
  `arrival_date` date DEFAULT NULL,
  `delivery_fee` int(11) DEFAULT 0,
  `id_address` int(11) DEFAULT NULL,
  `id_courier` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `payment`
--

CREATE TABLE `payment` (
  `id_payment` int(11) NOT NULL,
  `method` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `amount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `payment_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `points`
--

CREATE TABLE `points` (
  `id_points` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `expiry_date` date DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `points`
--

INSERT INTO `points` (`id_points`, `quantity`, `expiry_date`, `id_client`) VALUES
(1, 100, NULL, 8);

--
-- Déclencheurs `points`
--
DELIMITER $$
CREATE TRIGGER `membership_promote_to_gold` AFTER INSERT ON `points` FOR EACH ROW UPDATE client SET client.id_rank = 2 WHERE client.id_client = ANY(SELECT points.id_client FROM points GROUP BY id_client HAVING SUM(points.quantity) > 300) AND client.id_rank < 2
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `membership_promote_to_platinum` AFTER INSERT ON `points` FOR EACH ROW UPDATE client SET client.id_rank = 3 WHERE client.id_client = ANY(SELECT points.id_client FROM points GROUP BY id_client HAVING SUM(points.quantity) > 1000) AND client.id_rank < 3
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `record_points_history` BEFORE INSERT ON `points` FOR EACH ROW INSERT INTO points_history (points_history.action,points_history.quantity,points_history.id_client) VALUES ('ajout de points',NEW.quantity,NEW.id_client)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `points_history`
--

CREATE TABLE `points_history` (
  `id_history` int(11) NOT NULL,
  `action` varchar(50) NOT NULL,
  `quantity` int(11) DEFAULT 0,
  `action_date` date DEFAULT current_timestamp(),
  `id_client` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `points_history`
--

INSERT INTO `points_history` (`id_history`, `action`, `quantity`, `action_date`, `id_client`) VALUES
(1, 'creation du compte', 100, '2023-01-22', 8);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `id_company` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id_product`, `product_name`, `id_company`) VALUES
(1, 'Fleur d or', 2),
(2, 'Parfum de la force', 4),
(3, 'LV x YK - Sac Neverfull MM', 1),
(4, 'Or de vie', 2),
(5, 'savon edition prestige', 2),
(6, 'brique', 3),
(7, 'Fond De Teint Accord Parfait', 6),
(8, 'Blur Jam Silicone-Free Smoothing Primer', 7);

-- --------------------------------------------------------

--
-- Structure de la table `product_order`
--

CREATE TABLE `product_order` (
  `quantity` int(11) NOT NULL,
  `price` decimal(16,2) NOT NULL DEFAULT 0.00,
  `id_status_order_product` int(11) DEFAULT NULL,
  `id_parcel` int(11) DEFAULT NULL,
  `id_orders` int(11) NOT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `product_order`
--

INSERT INTO `product_order` (`quantity`, `price`, `id_status_order_product`, `id_parcel`, `id_orders`, `id_product`) VALUES
(1, '50.00', 2, NULL, 1, 1),
(5, '255.00', 2, NULL, 1, 2),
(1, '600.00', 2, NULL, 1, 3),
(5, '0.00', 5, NULL, 1, 4),
(1, '40.00', 2, NULL, 2, 1),
(1, '2500.00', 8, NULL, 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `redeemable`
--

CREATE TABLE `redeemable` (
  `id_redeemable` int(11) NOT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `redeemable_name` varchar(50) NOT NULL,
  `id_rank` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `redeemable_tracker`
--

CREATE TABLE `redeemable_tracker` (
  `id_redeemable` int(11) NOT NULL,
  `id_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `socials`
--

CREATE TABLE `socials` (
  `id_socials` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `social_name` varchar(50) NOT NULL,
  `id_client` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `socials`
--

INSERT INTO `socials` (`id_socials`, `type`, `social_name`, `id_client`) VALUES
(1, 'instagram', 'MichouX', 1),
(2, 'facebook', 'Jean-Michel', 1),
(3, 'tik toc', 'michou', 1);

-- --------------------------------------------------------

--
-- Structure de la table `status_order_product`
--

CREATE TABLE `status_order_product` (
  `id_status_order_product` int(11) NOT NULL,
  `status_order_product_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `status_order_product`
--

INSERT INTO `status_order_product` (`id_status_order_product`, `status_order_product_name`) VALUES
(1, 'in stock'),
(2, 'available'),
(3, 'not available'),
(4, 'out of stock'),
(5, 'free gift'),
(6, 'packed'),
(7, 'dispatched'),
(8, 'arrived'),
(9, 'delivered'),
(10, 'other');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `quantity` int(11) NOT NULL DEFAULT 0,
  `unit_price` decimal(16,2) NOT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la vue `commande_info`
--
DROP TABLE IF EXISTS `commande_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `commande_info`  AS SELECT `orders`.`id_orders` AS `id_orders`, `client`.`client_name` AS `client_name`, `orders_status`.`order_status_name` AS `order_status_name`, `product`.`product_name` AS `product_name`, `product_order`.`quantity` AS `quantity`, `product_order`.`price` AS `price`, `status_order_product`.`status_order_product_name` AS `status_order_product_name` FROM (((((`orders` join `product_order` on(`orders`.`id_orders` = `product_order`.`id_orders`)) join `product` on(`product_order`.`id_product` = `product`.`id_product`)) join `client` on(`orders`.`id_client` = `client`.`id_client`)) join `status_order_product` on(`product_order`.`id_status_order_product` = `status_order_product`.`id_status_order_product`)) join `orders_status` on(`orders`.`id_orders_status` = `orders_status`.`id_orders_status`)) ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id_address`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `client_lives_at`
--
ALTER TABLE `client_lives_at`
  ADD PRIMARY KEY (`id_address`,`id_client`);

--
-- Index pour la table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id_company`);

--
-- Index pour la table `courier`
--
ALTER TABLE `courier`
  ADD PRIMARY KEY (`id_courier`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id_facture`);

--
-- Index pour la table `membership_rank`
--
ALTER TABLE `membership_rank`
  ADD PRIMARY KEY (`id_rank`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_orders`);

--
-- Index pour la table `orders_status`
--
ALTER TABLE `orders_status`
  ADD PRIMARY KEY (`id_orders_status`);

--
-- Index pour la table `parcel`
--
ALTER TABLE `parcel`
  ADD PRIMARY KEY (`id_parcel`);

--
-- Index pour la table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id_payment`);

--
-- Index pour la table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`id_points`);

--
-- Index pour la table `points_history`
--
ALTER TABLE `points_history`
  ADD PRIMARY KEY (`id_history`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Index pour la table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id_orders`,`id_product`);

--
-- Index pour la table `redeemable`
--
ALTER TABLE `redeemable`
  ADD PRIMARY KEY (`id_redeemable`);

--
-- Index pour la table `redeemable_tracker`
--
ALTER TABLE `redeemable_tracker`
  ADD PRIMARY KEY (`id_redeemable`,`id_client`);

--
-- Index pour la table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id_socials`);

--
-- Index pour la table `status_order_product`
--
ALTER TABLE `status_order_product`
  ADD PRIMARY KEY (`id_status_order_product`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`unit_price`,`id_product`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `address`
--
ALTER TABLE `address`
  MODIFY `id_address` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `company`
--
ALTER TABLE `company`
  MODIFY `id_company` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `courier`
--
ALTER TABLE `courier`
  MODIFY `id_courier` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `id_facture` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `membership_rank`
--
ALTER TABLE `membership_rank`
  MODIFY `id_rank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_orders` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `orders_status`
--
ALTER TABLE `orders_status`
  MODIFY `id_orders_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `parcel`
--
ALTER TABLE `parcel`
  MODIFY `id_parcel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `payment`
--
ALTER TABLE `payment`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `points`
--
ALTER TABLE `points`
  MODIFY `id_points` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `points_history`
--
ALTER TABLE `points_history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `redeemable`
--
ALTER TABLE `redeemable`
  MODIFY `id_redeemable` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `socials`
--
ALTER TABLE `socials`
  MODIFY `id_socials` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `status_order_product`
--
ALTER TABLE `status_order_product`
  MODIFY `id_status_order_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
