-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 10 juin 2024 à 15:37
-- Version du serveur : 8.0.30
-- Version de PHP : 8.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sacs`
--
CREATE DATABASE IF NOT EXISTS `sacs` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sacs`;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_category` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_category`, `name`, `description`) VALUES
(2, 'sac à main ', 'xskul:cim!vùplomilkujhgfd'),
(3, 'Sac à dos', ' Sac à dos féminin élégant et léger, idéal pour les femmes qui suivent la tendance. Un cartable pratique pour les filles, parfait pour les voyages, les loisirs et le collège.\r\n             '),
(4, 'Sac de voyage', 'Sac à main de voyage féminin, élégant et léger, tendance et pratique pour les femmes. Idéal comme sac à dos pour le voyage, les loisirs et le collège.'),
(5, 'Sac caba', 'Sac caba féminin élégant et léger, tendance, idéal pour les femmes actives. Un sac à dos adapté pour le travail, les voyages et les loisirs, parfait pour les étudiantes'),
(6, 'Sac soiré', '\r\nSac à main  féminin, élégant et léger, tendance et pratique pour les femmes. Idéal comme sac intemporel pour le\r\nvoyage, les loisirs et le collège.');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id_produit` int NOT NULL,
  `category_id` int DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `couleur` enum('multi','rose','noir','marron','vert','bleu') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `price` float NOT NULL,
  `stock` int NOT NULL,
  `promo` enum('oui','non') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'non'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_produit`, `category_id`, `name`, `couleur`, `detail`, `date`, `image`, `price`, `stock`, `promo`) VALUES
(1, 2, 'Sac Prunelle', 'noir', 'Sac &agrave; main de voyage f&eacute;minin, &eacute;l&eacute;gant et l&eacute;ger, tendance et pratique pour les femmes. Id&eacute;al comme sac &agrave; dos pour le voyage, les loisirs et le coll&egrave;ge.', '2024-02-16', 'image8.jpeg', 50, 2, 'oui'),
(2, 0, 'Sac soiré', 'multi', 'Élégant et raffiné, ce sac de soirée est l’accessoire parfait pour toute tenue de gala. Avec son design épuré et sa chaîne délicate, il allie fonctionnalité et sophistication.', '2024-02-16', 'sac1.png', 50, 3, 'non'),
(3, 0, 'Sac de voyage ', 'rose', 'Sac à main de voyage féminin, élégant et léger, tendance et pratique pour les femmes. Idéal comme sac à dos pour le voyage, les loisirs et le collège.', '2009-12-16', 'Sacvoyage4.jpg', 70, 4, 'non'),
(4, 0, 'Sac caba ', 'noir', 'Sac caba féminin élégant et léger, tendance, idéal pour les femmes actives. Un sac à dos adapté pour le travail, les voyages et les loisirs, parfait pour les étudiantes', '2024-05-17', 'image(2).jpeg', 50, 3, ''),
(5, 0, 'Sac à dos', 'marron', 'Sac à dos féminin élégant et léger, idéal pour les femmes qui suivent la tendance. Un cartable pratique pour les filles, parfait pour les voyages, les loisirs et le collège.', '2024-05-17', 'image(5).jpeg', 30, 3, ''),
(6, 0, 'Sac Voyage', 'rose', 'Sac à main de voyage féminin, élégant et léger, tendance et pratique pour les femmes. Idéal comme sac à dos pour le voyage, les loisirs et le collège.', '2024-05-17', 'Sacvoyage4.jpg', 50, 2, ''),
(7, 0, 'Sac soiré', 'bleu', 'Élégant et raffiné, ce sac de soirée est l’accessoire parfait pour toute tenue de gala. Avec son design épuré et sa chaîne délicate, il allie fonctionnalité et sophistication.', '2024-05-17', 'image11.jpeg', 50, 3, 'non'),
(8, 4, 'Sac Tanya', 'marron', 'Sac &agrave; main de voyage f&eacute;minin, &eacute;l&eacute;gant et l&eacute;ger, tendance et pratique pour les femmes. Id&eacute;al comme sac &agrave; dos pour le\r\nvoyage, les loisirs et le coll&egrave;ge.', '2024-05-27', '591104df12cbe59279262a87aa3af464.jpg', 70, 4, 'oui'),
(9, 4, 'Sac de voyage', 'rose', '&lt;input type=&quot;checkbox&quot; name=&quot;promo&quot; class=&quot;form-check-input&quot; id=&quot;flexRadioDefault1&quot; value=&quot;oui&quot; &lt;?php if (isset($produit[&#039;promo&#039;])', '2024-05-27', '8079684f88ed33a1b4f0c95a25a079cb.jpg', 70, 4, 'oui'),
(10, 1, 'Sac fany', 'marron', '&Eacute;l&eacute;gant et raffin&eacute;, ce sac de soir&eacute;e est l&rsquo;accessoire parfait pour toute tenue de gala. Avec son design &eacute;pur&eacute; et sa cha&icirc;ne d&eacute;licate, il allie fonctionnalit&eacute; et sophistication.', '2024-05-30', 'Capture d’écran 2024-02-20 164449.png', 40, 3, 'oui'),
(11, 4, 'Eunice', 'multi', 'Sac &agrave; main de voyage f&eacute;minin, &eacute;l&eacute;gant et l&eacute;ger, tendance et pratique pour les femmes. Id&eacute;al comme sac &agrave; dos pour le voyage, les loisirs et le coll&egrave;ge.', '2024-06-04', '32619c193db8f46ce65ae41c19121f0a.jpg', 70, 5, 'oui'),
(12, 6, 'Maeva', 'bleu', '&Eacute;l&eacute;gant et raffin&eacute;, ce sac de soir&eacute;e est l&rsquo;accessoire parfait pour toute tenue de gala. Avec son design &eacute;pur&eacute; et sa cha&icirc;ne d&eacute;licate, il allie fonctionnalit&eacute; et sophistication.', '2024-06-04', 'Image(4).jpeg', 40, 5, 'oui');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `nom` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `mdp` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `civility` enum('femme','homme') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `adresse` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `zipCode` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `country` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `role` enum('ROLE_USER','ROLE_ADMIN') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'ROLE_USER'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `prenom`, `nom`, `email`, `mdp`, `civility`, `adresse`, `zipCode`, `country`, `role`) VALUES
(1, 'christelle', 'kambemba', 'christelle.kambemba@colombbus.org', '$2y$10$nYKbLZ/gqeb7iiW.jW/R/edTseewwhSyd4qU.GE2cspsYBe2rV4Ae', 'femme', '23 square du nouveau belleville', '75020', 'France', 'ROLE_ADMIN'),
(2, 'Gwladys', 'Jacobin', 'gwladys.jacobin@colombbus.org', '$2y$10$eZjxXYSrY4HYvzRjyaOyteE1mlCBo1lxq7bSBpDj6I7EZtMkw/xOm', 'femme', '23 square du nouveau belleville', '75020', 'France', 'ROLE_USER'),
(3, 'Eunice', 'Priscillia', 'eunice.priscillia@colombbus.org', '$2y$10$mfcDg1dWUPVJTNiIS0wdCesuPziZfSdi2f9fBS82LLJ9HbI829AOu', 'femme', '23 square du nouveau belleville', '75020', 'France', 'ROLE_USER'),
(4, 'Prunelle', 'Katsho', 'prunelle.katsho@colombbus.org', '$2y$10$1ki4l7FuDUHf10awsCIq4u3FlTdrCp9bolZr67wh6Rfl2uLN24RGq', 'femme', '23 square du nouveau belleville', '75020', 'France', 'ROLE_USER'),
(5, 'Jérusalem', 'Gemeda', 'jerusalem.gemeda@colombbus.org', '$2y$10$qqTSazhuyFssETRFmro0Ke4neRhxRC8gSapv9HoYvNJrekXxUOBBG', 'femme', '23 square du nouveau belleville', '75020', 'France', 'ROLE_ADMIN'),
(6, 'Tresor', 'NGUNDU', 'tresorkayenga1@gmail.com', '$2y$10$o3gdDXrGECikQr.VoYOCfe81sOkvJvDQOfzIX.pD/qhGALu3Cxc8q', 'homme', '23 square du nouveau belleville', '75020', 'France', 'ROLE_USER');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id_produit` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
