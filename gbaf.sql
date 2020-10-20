-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 20 oct. 2020 à 11:22
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gbaf`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `id_partenaire` int(11) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `dates` datetime NOT NULL,
  `texte` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `id_partenaire`, `prenom`, `dates`, `texte`) VALUES
(1, 2, 'Hervé', '2020-09-20 00:00:00', 'Illud tamen clausos vehementer angebat quod captis navigiis, quae frumenta vehebant per flumen, Isauri quidem alimentorum copiis adfluebant, ipsi vero solitarum rerum cibos iam consumendo inediae propinquantis aerumnas exitialis horrebant.'),
(2, 1, 'Denis', '2020-09-16 00:00:00', 'Sed maximum est in amicitia parem esse inferiori. Saepe enim excellentiae quaedam sunt, qualis erat Scipionis.'),
(3, 4, 'Marie', '2020-09-08 00:00:00', 'Victus universis caro ferina est lactisque abundans copia qua sustentantur, et herbae multiplices et siquae alites capi per aucupium possint, et plerosque mos vidimus frumenti usum et vini penitus ignorantes.'),
(4, 3, 'Laura', '2020-09-12 00:00:00', 'Procedente igitur mox tempore cum adventicium nihil inveniretur, relicta ora maritima in Lycaoniam adnexam Isauriae se contulerunt ibique densis intersaepientes itinera praetenturis provincialium et viatorum opibus pascebantur.'),
(68, 2, 'Smith', '2020-10-20 02:31:15', 'psfpsdfpsdfipsodfipodsofdofdfisdfidsfsidfaepfjpezripzkfd,vlsdkfqdsfipd'),
(69, 1, 'Carole', '2020-10-20 10:08:21', 'gdgsgsdfqdfsdfsdfsdf');

-- --------------------------------------------------------

--
-- Structure de la table `dislikes`
--

CREATE TABLE `dislikes` (
  `id` int(11) NOT NULL,
  `id_partenaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `dislikes`
--

INSERT INTO `dislikes` (`id`, `id_partenaire`) VALUES
(47, 2);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `id_partenaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id`, `id_partenaire`) VALUES
(34, 1);

-- --------------------------------------------------------

--
-- Structure de la table `partenaires`
--

CREATE TABLE `partenaires` (
  `id` int(11) NOT NULL,
  `logo` text NOT NULL,
  `nompart` varchar(255) NOT NULL,
  `texte` text NOT NULL,
  `textecomplet` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `partenaires`
--

INSERT INTO `partenaires` (`id`, `logo`, `nompart`, `texte`, `textecomplet`) VALUES
(1, 'images/formation_co.png', 'FORMATION & CO', 'Association française présente sur tout le territoire. Nous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement professionnel et personnalisé.', 'Association française présente sur tout le territoire. Nous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement professionnel et personnalisé.\r\nNotre proposition :\r\n- un financement jusqu\'à 30 000 € ;\r\n- un suivi personnalisé et gratuit ;\r\n- une lutte acharnée contre les freins sociétaux et les stéréotypes.\r\nLe financement est possible, peu importe le métier : coiffeur, banquier, éleveur de chèvres... . Nous collaborons avec des personnes talentueuses et motivées. Vous n\'avez pas de diplômes ? Ce n\'est pas un problème pour nous ! Nos financements s\'adressent à tous.'),
(2, 'images/protectpeople.png', 'PROTECTPEOPLE', 'Finance la solidarité nationale.\r\nNous appliquons le principe édifié par la Sécurité Sociale française en 1945 : permettre à chacun de bénéficier d\'une protection sociale.\r\n', 'Finance la solidarité nationale.\r\nNous appliquons le principe édifié par la Sécurité Sociale française en 1945 : permettre à chacun de bénéficier d\'une protection sociale.\r\nChez ProtectPeople, chacun cotise ses moyens et reçoit selon ses besoins. ProtectPeople est ouvert à tous, sans considération d\'âge ou d\'état de santé. Nous garantissons un accès aux soins et une retraite.\r\nChaque année, nous collectons et répartissons 300 milliards d\'euros.\r\nNotre mission est double :\r\n- sociale : nous garantissons la fiabilité des données sociales;\r\n- économique : nous apportons une contribution aux activités économiques.'),
(3, 'images/Dsa_france.png', 'DSA FRANCE', 'DSA France accélère la croissance du territoire et s\'engage avec les collectivités territoriales.\r\n', 'DSA France accélère la croissance du territoire et s\'engage avec les collectivités territoriales.\r\nNous accompagnons les entreprises dans les étapes clés de leur évolution.\r\nNotre philosophie : s\'adapter à chaque entreprise.\r\nNous les accompagnons pour voir plus grand et plus loin et proposons des solutions\r\nde financement adaptées à chaque étape de la vie des entreprises.'),
(4, 'images/CDE.png', 'CDE', 'La CDE(Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation.', 'La CDE(Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation. Son président est élu pour 3 ans par ses pairs, chefs d\'entreprises et présidents des CDE.');

-- --------------------------------------------------------

--
-- Structure de la table `salaries`
--

CREATE TABLE `salaries` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `question` text NOT NULL,
  `reponse` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `salaries`
--

INSERT INTO `salaries` (`id`, `nom`, `prenom`, `username`, `password`, `question`, `reponse`) VALUES
(16, 'Thibault', 'Yvon', 'yoyo', '$2y$10$B3nXQJ2ExEavvYLCskefXuPCgaBJWz6YfnH.HO7VaBQjgtThDxu6y', 'chien', '$2y$10$5.LlykDI13iUMJCrQMgEpOgMyltZR5Mc1EGYK4MU3wNi8dyL5bi06'),
(17, 'Dupuis', 'José', 'dudul', '$2y$10$pwXWUzshlOoEOAv5W1ekvOiS7IFnG/tUrsNL/byaj1Dg3OlbKaO8m', 'ville', '$2y$10$Cyi/1JPReuk5BpuyclBMS.N8rd5vW/EcDI8ouufxWHpGF5iqZYk9e'),
(18, 'Allard', 'Marc', 'koko', '$2y$10$/4t4mfLym3MtEgrb61OnEeqiugmyPJ0ArGgrSIj2BQbqi2lDJxB8e', 'fleur', '$2y$10$PMC/ZIsmilyNXbbWoSHL9eSeKJoqS0oikYDmFj7cQXF3JBO76K3H2'),
(19, 'Savoie', 'Julie', 'baba', '$2y$10$kiZNgcDfN.xjPRjiHsNP0.M9rbe/VjMiyDkS0/1lWnyEAhDFsZrN.', 'auto', '$2y$10$2Jwgwx.dY3Sv38SP0hm/RuxhbwcwSGiHwqlGSD8I6uBkDVjM4JuGK'),
(20, 'Bibard', 'Anne', 'kiki', '$2y$10$bxJke4SHRhOaO2aZikoEKexCmaFhldeCXv7JafyMEAlcm45e.2Ki6', '2+2', '$2y$10$r164SVQgobtmXODjBC93O.N4F1S2LveaT85b.o.Iagv8LGignexPi'),
(21, 'Moller', 'Jacques', 'popo', '$2y$10$Vx0pmHlKAQXf/4NwseHhpuTpGBfIfL/JsL8.qpC3C5768zTc3k5p2', 'livre', 'page'),
(22, 'Lalonde', 'Hervé', 'riri', '$2y$10$mMt6CDPRZ1H1EBK2SoXntOxuz6wCtnBS5ls7TXY2HPpJYc4dDJ43u', 'music', '$2y$10$OvSJl3805Kc3/vyxMgfbrOqkTtSYCN1giskQZePqQYVAnuDlp3Z9G'),
(23, 'Ingras', 'Michel', 'mimi', '$2y$10$W3iI5ttAH01439OHYrNWnuHJRIUzs5xJOvuG6wImhL7jIx/9/JaDC', 'table', '$2y$10$vsWPMrvwc6P2rVI8JIDi4ufS00xKbMnoqK7.9W/gI0s6/tmX7f3ku'),
(24, 'Smith', 'Alex', 'juju', '$2y$10$ocpFKujauFYiiizxJ1ouKOx2rTsceN9lQZKGUOxqI5XmYA4BnuT0.', 'musée', '$2y$10$cvsbsbz8h5SOAuB4hYTftunjdneVgnNWEz49bul4RvuSx2R9/s22W'),
(25, 'Martin', 'Monique', 'momo', '$2y$10$kVrAmJj.o9ms8CP0oFoha.a..nep0rc3U8BqyTFlvBJ6/04gBIx4a', 'tour', '$2y$10$aHI0uD7.Y2s/fJPspDTqmuJstJEcRQcyvcEc4BMOT5IPceQawaKyy'),
(26, 'Francais', 'Chantal', 'tata', '$2y$10$q61YtYq8WyQ4kvSYvH5rBuseRsXU/3hU4eWEx1qxb94D3prHD69Fy', 'lampe', '$2y$10$Wkb8PdCWddV.P2PrvojQlOF5eUq5e29TUGXSumuSfTGeaItJQaMda'),
(27, 'Blanc', 'Paul', 'papa', '$2y$10$ASoMwyV7FanCAU3ToMQ9QOk308Waw44p131e6ix8U6vDJ3yVlRH1i', 'couleur', '$2y$10$NS6maun3Qxig1Od4pdKXCuWdXvnYMQVS9SK7L0BTyr0.IQlM8GPVC'),
(28, 'Berger', 'Carole', 'roro', '$2y$10$yeH85mEj8yAP5F55cHrlteURnEbGaGbG0skVuMmB2EHm9rpK6sL.K', 'chat', '$2y$10$IlMyyW995.xNuqrTd7MGC.Z9cplz.R2tiafaxSVEhEsvHKB.ky6Re'),
(29, 'Berger', 'Carole', 'roro', '$2y$10$sfPAc7uX4jknqCTXDDwTzeb/vHDCo77gsywzJVNBULsMZGwRXCzHO', 'chat', '$2y$10$T3phHvLDdqBoDip91o3Ivu4pyMlTHFDYC/r/soFz7Y8/SeITJ/HUC');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `partenaires`
--
ALTER TABLE `partenaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT pour la table `dislikes`
--
ALTER TABLE `dislikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `partenaires`
--
ALTER TABLE `partenaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
