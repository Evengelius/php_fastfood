-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : Dim 12 juil. 2020 à 21:27
-- Version du serveur :  5.7.24
-- Version de PHP : 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fastfood`
--

-- --------------------------------------------------------

--
-- Structure de la table `boisson`
--

CREATE TABLE `boisson` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8 NOT NULL,
  `prix` decimal(4,2) NOT NULL,
  `description` text CHARACTER SET utf8,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no-img_boisson.png',
  `calories` int(11) UNSIGNED NOT NULL,
  `quantite_minimum` tinyint(3) UNSIGNED DEFAULT NULL,
  `quantite_stock` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `boisson`
--

INSERT INTO `boisson` (`id`, `nom`, `prix`, `description`, `image`, `calories`, `quantite_minimum`, `quantite_stock`) VALUES
(1, 'Coca-Cola - 33cl', '1.50', 'Boisson rafraîchissante à base de feuille de Coca et de noix de Kola. Parfaite pour se rafraichir et apprécier un moment entre amis!', 'coca_01.jpg', 140, NULL, 40),
(2, 'Coca-Cola - 50cl', '2.50', 'Boisson rafraîchissante à base de feuille de Coca et de noix de Kola. Parfaite pour se rafraichir et apprécier un moment entre amis!', 'coca_02.jpg', 210, NULL, 50),
(3, 'Pepsi - 33cl', '1.50', 'Boisson rafraîchissante et légère à base de feuille de Coca et de noix de Kola. Parfaite pour se rafraichir et apprécier un moment entre amis!', 'pepsi.jpg', 129, NULL, 60),
(4, 'Genuine - 50cl', '2.50', 'Boisson rafraîchissante à base de baies rouges. Idéale pour se relaxer après une journée de travail!', 'genuine.jpg', 92, NULL, 70),
(5, 'Eau plate - 25cl', '1.50', 'Eau minérale rafraichîssante récupérée directement à sa source dans les Ardennes. Parfaite pour se désaltérer ainsi que pour les coups de chaud!', 'water.jpg', 0, NULL, 80),
(6, 'Monster Energy', '2.50', 'Boisson rafraîchissante à base d\'oranges et de pulpe. C\'est la boisson idéale quand on fait du sport!Boisson rafraîchissante divers arômes fruités mais aussi à base de thé et de taurine.', 'monster.jpg', 200, NULL, 90);

-- --------------------------------------------------------

--
-- Structure de la table `boisson_ingredient`
--

CREATE TABLE `boisson_ingredient` (
  `boisson_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `quantite` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `burger`
--

CREATE TABLE `burger` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8 NOT NULL,
  `prix` decimal(4,2) NOT NULL,
  `description` text CHARACTER SET utf8,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no-img_burger.png',
  `recette` text CHARACTER SET utf8,
  `quantite_stock` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `burger`
--

INSERT INTO `burger` (`id`, `nom`, `prix`, `description`, `image`, `recette`, `quantite_stock`) VALUES
(1, 'Hamburger', '2.00', 'Hamburger classique mais indémodable avec une viande élevée en Belgique.', 'burger_01.jpg', 'Burger composé de: 1 pain blanc normal, 1 steak haché pur boeuf 50g, cornichons, sauce ketchup, sauce moutarde et des oignons coupés en dés.', 50),
(2, 'Cheeseburger', '2.50', 'Comment rendre un hamburger encore plus savoureux ? En y ajoutant une tranche d\'emmental pardi !', 'burger_02.jpg', 'Burger composé de: 1 pain blanc normal, 1 steak haché pur boeuf 50g, cornichons, sauce ketchup, sauce moutarde,des oignons coupés en dés et 1 tranche d\'emmental.', 60),
(3, 'Giant', '3.50', 'Ce burger au goût inimitable est la recette de notre succès.', 'burger_03.jpg', 'Burger composé de: 1 pain blanc normal, 2 steaks hachés pur boeuf 50g, salade, oignons courpés en dés, sauce giant et 2 tranches de cheddar.', 70),
(4, 'Giant Max', '4.50', 'Notre burger inimitable dans sa version encore plus grande, pour encore plus de plaisir.', 'burger_04.jpg', 'Burger composé de: 1 grand pain blanc, 2 steaks hachés pur boeuf 75g, salade, oignons coupés en dés, sauce giant et 2 tranches de cheddar.', 30),
(5, 'Bacon Max', '4.50', 'Notre burger au goût bacon pour les amateurs de barbecue.', 'burger_05.jpg', 'Burger composé de: 1 grand pain gris complet, 2 steaks hachés pur boeuf 75g, sauce barbecue, 2 tranches de bacon et 2 tranches de cheddar.', 90),
(6, 'Supreme Cheese', '5.00', 'Ce burger est notre spécialité pour les amateurs de fromage se trouvant parmi nos clients.', 'burger_06.jpg', 'Burger composé de: 1 grand pain aux céréales, 1 steak haché pur boeuf 100g, salade, oignons tranché en ronds, sauce supreme fromage, sauce ketchup, tomates, cornichons et 1 tranche de cheddar.', 80),
(7, 'Supreme Pepper', '5.00', 'Ce burger au goût légèrement piquant est idéal pour ceux qui aiment la diversité de nos recettes.', 'burger_07.jpg', 'Burger composé de: 1 grand pain aux céréales, 1 steak haché pur boeuf 100g, salade, oignons tranchés en ronds, sauce supreme pepper, tomates, cornichons et 1 tranche de cheddar.', 20),
(8, 'Supreme Chicken', '5.50', 'Notre célèbre supreme chicken avec son goût de poulet et ingrédients riches en saveurs fait des envieux dans le monde de la restauration.', 'burger_08.jpg', 'Burger composé de: 1 grand pain aux céréales, 1 croquette de poulet 100g cuite à la friteuse, oignons tranchés en ronds, sauce barbecue, sauce mayonnaise, 2 tranches de bacon, tomates et 1 tranche de cheddar.', 40),
(9, 'Fish Burger', '4.50', 'Notre célèbre burger au goût de la mer pour les amateurs de pêche et les personnes ne désirant pas manger de viande rouge.', 'burger_09.jpg', 'Burger composé de: 1 pain blanc normal, 1 croquette de Colin 60g cuite à la friteuse, salade, sauce mayonnaise et 1 tranche de cheddar.', 50),
(10, 'Chicken Burger', '4.50', 'Notre chicken burger est pour les amoureux de la ferme qui aiment le bon goût.', 'burger_10.jpg', 'Burger composé de: 1 pain blanc normal, 1 croquette de poulet 60g cuite à la friteuse, salade, oignons coupés en dés, sauce mayonnaise et 1 tranche de cheddar.', 10);

-- --------------------------------------------------------

--
-- Structure de la table `burger_ingredient`
--

CREATE TABLE `burger_ingredient` (
  `burger_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `quantite` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `burger_ingredient`
--

INSERT INTO `burger_ingredient` (`burger_id`, `ingredient_id`, `quantite`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 1, 1),
(9, 1, 1),
(10, 1, 1),
(4, 2, 1),
(5, 3, 1),
(6, 4, 1),
(7, 4, 1),
(8, 4, 1),
(1, 5, 1),
(2, 5, 1),
(3, 5, 2),
(4, 6, 2),
(5, 6, 2),
(6, 7, 1),
(7, 7, 1),
(9, 8, 1),
(10, 9, 1),
(8, 10, 1),
(8, 11, 2),
(9, 11, 2),
(10, 11, 1),
(1, 12, 1),
(2, 12, 1),
(6, 12, 1),
(1, 13, 1),
(2, 13, 1),
(3, 14, 2),
(4, 14, 2),
(5, 15, 2),
(8, 15, 1),
(6, 16, 2),
(7, 17, 2),
(2, 19, 1),
(10, 19, 1),
(3, 20, 2),
(4, 20, 2),
(5, 20, 2),
(6, 20, 1),
(7, 20, 1),
(8, 20, 1),
(9, 20, 1),
(1, 21, 1),
(2, 21, 1),
(3, 21, 1),
(4, 21, 1),
(10, 21, 1),
(6, 22, 1),
(7, 22, 1),
(8, 22, 1),
(3, 23, 1),
(4, 23, 1),
(6, 23, 1),
(7, 23, 1),
(8, 23, 1),
(9, 23, 2),
(10, 23, 1),
(6, 24, 2),
(7, 24, 2),
(8, 24, 2),
(5, 25, 3),
(8, 25, 2),
(1, 26, 1),
(2, 26, 1),
(6, 26, 2),
(7, 26, 2);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `nom` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `prenom` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `login` varchar(20) CHARACTER SET utf8 NOT NULL,
  `mot_de_passe` varchar(255) CHARACTER SET utf8 NOT NULL,
  `mail` varchar(100) CHARACTER SET utf8 NOT NULL,
  `adresse` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `code_postal` smallint(5) DEFAULT NULL,
  `ville` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `n_table` tinyint(3) UNSIGNED DEFAULT NULL,
  `heure` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `n_serveur` smallint(5) UNSIGNED DEFAULT NULL,
  `paye` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande_boisson`
--

CREATE TABLE `commande_boisson` (
  `commande_id` int(11) NOT NULL,
  `boisson_id` int(11) NOT NULL,
  `quantite` int(11) UNSIGNED NOT NULL,
  `view` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande_burger`
--

CREATE TABLE `commande_burger` (
  `commande_id` int(11) NOT NULL,
  `burger_id` int(11) NOT NULL,
  `quantite` int(11) UNSIGNED NOT NULL,
  `view` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` longtext CHARACTER SET utf8,
  `prix` decimal(4,2) NOT NULL,
  `calories` smallint(5) UNSIGNED NOT NULL,
  `quantite_stock` tinyint(3) UNSIGNED DEFAULT NULL,
  `quantite_minimum` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`id`, `nom`, `description`, `prix`, `calories`, `quantite_stock`, `quantite_minimum`) VALUES
(1, 'Pain blanc - normal', 'Pain blanc nourissant se mariant parfaitement avec des ingrédients judicieusement sélectionnés par nos experts du goût afin de réaliser des recettes délicieusement divine.', '0.25', 5, 0, 0),
(2, 'Pain blanc - grand', 'Pain blanc nourissant se mariant parfaitement avec des ingrédients judicieusement sélectionnés par nos experts du goût afin de réaliser des recettes délicieusement divine. Mais en plus GRAND.', '0.40', 8, 0, 0),
(3, 'pain gris - grand', 'Pain gris délicieux mais également bon pour la santé. Les saveurs se dégageant dans votre bouche en mangeant ce pain vous rappellera le pain traditionnel produit à la main par un vrai boulanger.', '0.45', 9, 0, 0),
(4, 'Pain aux céréales - grand', 'Pain complet réalisé avec soin par des artistes boulanger qui vous rappellera le goût de la campagne. Les recettes crées à partir de ce pain sont pour les gens n\'ayant pas peur d\'avoir une explosion de saveurs se produisant à l\'intérieur de leur bouche et de leur estomac.', '0.45', 7, 0, 0),
(5, 'Steak haché pur boeuf - 50g', 'Viande pur boeuf, provenant d\'éleveurs belges, cuite au grill à la perfection. Ce goût de la viande inimitable a fait de notre enseigne un leader national et reconnu pour sa qualité et son respect des différents acteurs qui participent à l\'élevage des bêtes pour vous procurer un goût et une qualité exceptionnelle.', '1.50', 16, 0, 0),
(6, 'Steak haché pur boeuf - 75g', 'Viande pur boeuf, provenant d\'éleveurs belges, cuite au grill à la perfection. Ce goût de la viande inimitable a fait de notre enseigne un leader national et reconnu pour sa qualité et son respect des différents acteurs qui participent à l\'élevage des bêtes pour vous procurer un goût et une qualité exceptionnelle.', '2.25', 24, 0, 0),
(7, 'Steak haché pur boeuf - 100g', 'Viande pur boeuf, provenant d\'éleveurs belges, cuite au grill à la perfection. Ce goût de la viande inimitable a fait de notre enseigne un leader national et reconnu pour sa qualité et son respect des différents acteurs qui participent à l\'élevage des bêtes pour vous procurer un goût et une qualité exceptionnelle. Cette viande exceptionnelle est proposée uniquement dans la recette de nos \'Supreme\'.', '3.00', 32, 0, 0),
(8, 'Croquette de colin - 60g', 'Cette croquette savoureuse de poisson cuite à la friteuse est idéale pour les personnes ne désirant pas manger de viande rouge. Notre enseigne travaille durement afin de s\'assurer que les colins à l\'origine de ces croquettes sont frais et de bonne qualité.', '2.00', 27, 0, 0),
(9, 'Croquette de poulet - 60g', 'Croquette de poulet fumante et savoureuse. Notre priorité est de vous proposer des ingrédients de la plus haute qualité. Pour cette raison, notre enseigne c\'est associée avec la ligue nationale belge des éleveurs de poulets (LNBEP). Ceci nous assure, ainsi qu\'à nos clients, la provenance des poulets, leur mode d\'élevage ainsi que la qualité et la tendresse de leur viande.', '1.75', 24, 0, 0),
(10, 'Croquette de poulet - 100g', 'Croquette de poulet fumante et savoureuse. Notre priorité est de vous proposer des ingrédients de la plus haute qualité. Pour cette raison, notre enseigne c\'est associée avec la ligue nationale belge des éleveurs de poulets (LNBEP). Ceci nous assure, ainsi qu\'à nos clients, la provenance des poulets, leur mode d\'élevage ainsi que la qualité et la tendresse de leur viande.', '2.89', 40, 0, 0),
(11, 'Sauce mayonnaise', 'Les ingrédients de cette sauce ont été soigneusement sélectionnés par nos experts afin de vous poroposer la meilleure mayonnaise possible. Cette sauce mayonnaise réalisée à l\'ancienne fera même rougir votre grand-mère.', '0.20', 12, 0, 0),
(12, 'Sauce ketchup', 'Sauce ketchup Heinz. C\'est notre plus grand plaisir que de vous annoncer que cette même sauce ketchup qui a bercée votre enfance, ansi que la nôtre, est disponible ici-même pour le plaisir de tout à chacuns.', '0.20', 8, 0, 0),
(13, 'Sauce moutarde', 'Sauce moutarde à l\'ancienne en provenance de Dijon. Cette sauce est parfaite accompagnée d\'un de nos hamburgers ou cheeseburgers', '0.20', 7, 0, 0),
(14, 'Sauce giant', 'Cette sauce au goût inimatable est la fierté de notre restaurant. Accompagné d\'un burger giant, ces deux-là forment le duo qui a porté notre enseigne depuis nos débuts jusqu\'à aujourd\'hui, où nous sommes reconnus comme le leader national de la restauration rapide.', '0.20', 11, 0, 0),
(15, 'Sauce barbecue', 'Cette sauce sucrée au goût fumé est l\'accompagnement rêvé pour toute viande et marinade. Couplée avec nos burgers au goût irrésistible, vous ne pourrez plus vous en passer.', '0.20', 11, 0, 0),
(16, 'Sauce supreme fromage', 'Cette sauce composée de 3 fromages différents est l\'accompagnement idéal pour notre supreme fromage, qui est l\'un des burgers préférés de nos consommateurs.', '0.20', 12, 0, 0),
(17, 'Sauce supreme pepper', 'Cette sauce légèrement piquante est notre sauce de choix pour accompagner notre supreme pepper. Son goût et sa texture feront fondre votre palais et vous donnera l\'envie de recommander un supreme pepper de plus.', '0.20', 10, 0, 0),
(18, 'Sauce diabolo', 'Cette sauce piquante est la sauce parfaite pour les amateurs de sensations fortes qui n\'ont pas froid aux yeux. Accompagné de notre nouveau burger, le diabolo, vous ne reviendrez pas de cet ascenseur émotionnel et gustatif proposé par la sauce diabolo.', '0.20', 9, 0, 0),
(19, 'Tranche de fromage emmental - 10g', 'Fromage d\'origine française. 1 tranche de fromage blanc emmental français (10g) se couple parfaitement avec notre notre classique et indémodable cheeseburger ainsi que notre supreme pepper.', '0.35', 10, 0, 0),
(20, 'Tranche de fromage cheddar - 10g', 'Fromage d\'origine française. 1 tranche de fromage orange cheddar français (10g) se marie parfaitement avec notre inimitable \'giant\' ainsi que la plupart de nos mets.', '0.35', 11, 0, 0),
(21, 'Oignons coupés en dés - 5g', 'Oignons en provenance d\'Espagne coupés en dés.', '0.20', 4, 0, 0),
(22, 'Oignons tranchés en ronds - 5g', 'Oignons en provenance d\'Espagne tranchés en ronds.', '0.20', 4, 0, 0),
(23, 'Salade - 10g', 'Salades élevées sous le soleil d\'Italie', '0.20', 0, 0, 0),
(24, 'Rondelle de tomate', 'Tomates élevées sous le soleil d\'Italie', '0.10', 2, 0, 0),
(25, 'Tranche de Bacon', 'Nos tranches de bacon viennnent de porcs élevés en Belgique. Ce goût de la viande inimitable a fait de notre enseigne un leader national et reconnu pour sa qualité et son respect des différents acteurs qui participent à l\'élevage des bêtes pour vous procurer un goût et une qualité exceptionnelle.', '0.25', 10, 0, 0),
(26, 'Rondelle de cornichon', 'Cornichons élevés sous le soleil d\'Espagne', '0.05', 3, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `r_table`
--

CREATE TABLE `r_table` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nb_place` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `serveur`
--

CREATE TABLE `serveur` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `boisson`
--
ALTER TABLE `boisson`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `boisson_ingredient`
--
ALTER TABLE `boisson_ingredient`
  ADD PRIMARY KEY (`ingredient_id`,`boisson_id`),
  ADD KEY `IDX_8AA0C38B933FE08C` (`ingredient_id`),
  ADD KEY `IDX_8AA0C38B734B8089` (`boisson_id`);

--
-- Index pour la table `burger`
--
ALTER TABLE `burger`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `burger_ingredient`
--
ALTER TABLE `burger_ingredient`
  ADD PRIMARY KEY (`ingredient_id`,`burger_id`),
  ADD KEY `IDX_3999A4C933FE08C` (`ingredient_id`),
  ADD KEY `IDX_3999A4C17CE5090` (`burger_id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_rgm2imc5ixgyg1mj5t4n1qib8` (`login`),
  ADD KEY `n_serveur` (`n_serveur`),
  ADD KEY `n_table` (`n_table`);

--
-- Index pour la table `commande_boisson`
--
ALTER TABLE `commande_boisson`
  ADD PRIMARY KEY (`commande_id`,`boisson_id`),
  ADD KEY `IDX_7D2CBAED82EA2E54` (`commande_id`),
  ADD KEY `IDX_7D2CBAED734B8089` (`boisson_id`);

--
-- Index pour la table `commande_burger`
--
ALTER TABLE `commande_burger`
  ADD PRIMARY KEY (`commande_id`,`burger_id`),
  ADD UNIQUE KEY `commande_id` (`commande_id`),
  ADD KEY `FK3u09lf1m0ujryhcd4nh8i8a2w` (`burger_id`);

--
-- Index pour la table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `r_table`
--
ALTER TABLE `r_table`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `serveur`
--
ALTER TABLE `serveur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `boisson`
--
ALTER TABLE `boisson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `burger`
--
ALTER TABLE `burger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `r_table`
--
ALTER TABLE `r_table`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `serveur`
--
ALTER TABLE `serveur`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `boisson_ingredient`
--
ALTER TABLE `boisson_ingredient`
  ADD CONSTRAINT `FK_8AA0C38B734B8089` FOREIGN KEY (`boisson_id`) REFERENCES `boisson` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8AA0C38B933FE08C` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `burger_ingredient`
--
ALTER TABLE `burger_ingredient`
  ADD CONSTRAINT `FK_3999A4C17CE5090` FOREIGN KEY (`burger_id`) REFERENCES `burger` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_3999A4C933FE08C` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`n_serveur`) REFERENCES `serveur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`n_table`) REFERENCES `r_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commande_boisson`
--
ALTER TABLE `commande_boisson`
  ADD CONSTRAINT `FK_7D2CBAED734B8089` FOREIGN KEY (`boisson_id`) REFERENCES `boisson` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_7D2CBAED82EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commande_burger`
--
ALTER TABLE `commande_burger`
  ADD CONSTRAINT `FK3u09lf1m0ujryhcd4nh8i8a2w` FOREIGN KEY (`burger_id`) REFERENCES `burger` (`id`),
  ADD CONSTRAINT `FKdwexs2162e71te2qe9f81ug9e` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
