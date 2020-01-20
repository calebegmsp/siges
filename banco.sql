-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 03-Dez-2019 às 11:28
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bancoacademico`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

DROP TABLE IF EXISTS `aluno`;
CREATE TABLE IF NOT EXISTS `aluno` (
  `CDALUNO` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `NOME` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NMATRICULA` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `STATUS` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CDALUNO`)
) ENGINE=MyISAM AUTO_INCREMENT=20190022 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`CDALUNO`, `NOME`, `NMATRICULA`, `STATUS`, `updated_at`, `created_at`) VALUES
(20190001, 'CALEBE GOMES PEREIRA', '20190001', 'AT', '2019-09-10 06:00:08', '2019-09-10 02:59:26'),
(20190002, 'VANILSON DA SILVA LESA', '20190002', 'TR', '2019-09-10 03:00:35', '2019-09-10 03:00:35'),
(20190003, 'ERIKLES CARDOSO BONFIM', '20190003', 'DE', '2019-09-10 03:01:17', '2019-09-10 03:01:17'),
(20190004, 'FRANCE NÁDIA SANTOS MORAIS', '20190004', 'AT', '2019-09-10 03:01:50', '2019-09-10 03:01:50'),
(20170005, 'GUILHERME RAMOS CORREIA', '20170005', 'AT', '2019-09-17 15:14:00', '2019-09-17 15:14:00'),
(20190020, 'ABRAÃO LICON', '20190020', 'CD', '2019-11-19 16:47:03', '2019-11-19 16:47:03'),
(20190021, 'MONALYZA DA SILVA LIMA', '20190021', 'AT', '2019-11-29 02:25:46', '2019-11-29 02:24:26');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `CDCURSO` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `NOMECURSO` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `VALORCURSO` decimal(7,2) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CDCURSO`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`CDCURSO`, `NOMECURSO`, `VALORCURSO`, `updated_at`, `created_at`) VALUES
(1, 'ANÁLISE E DESENVOLVIMENTO DE SISTEMAS', '10.00', '2019-09-10 12:46:23', '2019-09-10 12:46:44'),
(4, 'AGRONOMIA', '50.00', '2019-09-16 16:58:33', '2019-09-16 16:58:33'),
(5, 'QUÍMICA', '20.00', '2019-09-17 12:05:50', '2019-09-17 12:05:50'),
(10, 'CIÊNCIA DA COMPUTAÇÃO', '60.00', '2019-11-19 15:23:39', '2019-11-19 15:23:39'),
(9, 'AGROINDUSTRIA', '22.00', '2019-11-22 20:14:44', '2019-11-19 14:54:05');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

DROP TABLE IF EXISTS `disciplina`;
CREATE TABLE IF NOT EXISTS `disciplina` (
  `CDDISCIPLINA` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `NOMEDISCIPLINA` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CDCURSO` int(11) NOT NULL,
  `CDPROFESSOR` int(11) DEFAULT NULL,
  `VALOR` decimal(7,2) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CDDISCIPLINA`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`CDDISCIPLINA`, `NOMEDISCIPLINA`, `CDCURSO`, `CDPROFESSOR`, `VALOR`, `updated_at`, `created_at`) VALUES
(2, 'ALGORITMO', 1, 9, '50.00', '2019-11-23 03:48:49', '2019-09-16 18:48:52'),
(3, 'ENGENHARIA DE SOFTWARE', 1, 9, '30.00', '2019-09-16 21:52:00', '2019-09-16 18:48:52'),
(6, 'LABORATÓRIO DE PROGRAMAÇÃO WEB II', 1, 1, '50.00', '2019-11-05 15:57:57', '2019-11-05 15:57:57'),
(7, 'TÓPICOS AVANÇADOS EM BANCO DE DADOS', 1, 1, '12.00', '2019-11-22 19:31:40', '2019-11-06 03:49:15'),
(13, 'FUNDAMENTOS DE BANCO DE DADOS', 1, 1, '0.40', '2019-11-29 02:26:52', '2019-11-29 02:25:05'),
(10, 'RELAÇÕES INTERPESSOAIS', 1, 9, '14.00', '2019-11-23 03:48:02', '2019-11-19 15:22:33'),
(12, 'ENGENHARIA DE SOFTWARE', 1, 9, '20.00', '2019-11-23 03:47:38', '2019-11-22 21:58:16');

-- --------------------------------------------------------

--
-- Estrutura da tabela `frequencia`
--

DROP TABLE IF EXISTS `frequencia`;
CREATE TABLE IF NOT EXISTS `frequencia` (
  `CDFREQUENCIA` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `CDMATDISCIPLINA` int(11) NOT NULL,
  `DATA` date NOT NULL,
  `FALTAS` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CDFREQUENCIA`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `frequencia`
--

INSERT INTO `frequencia` (`CDFREQUENCIA`, `CDMATDISCIPLINA`, `DATA`, `FALTAS`, `created_at`, `updated_at`) VALUES
(60, 90, '2019-11-28', 0, '2019-11-29 04:40:05', '2019-11-29 04:40:05'),
(59, 89, '2019-11-28', 2, '2019-11-29 04:40:05', '2019-11-29 04:40:05'),
(58, 94, '2019-11-28', 0, '2019-11-29 04:40:05', '2019-11-29 04:40:05'),
(57, 93, '2019-11-28', 4, '2019-11-29 04:40:05', '2019-11-29 04:40:05'),
(56, 92, '2019-11-28', 0, '2019-11-29 04:40:05', '2019-11-29 04:40:05'),
(55, 91, '2019-11-28', 0, '2019-11-29 04:40:05', '2019-11-29 04:40:05'),
(7, 77, '2019-11-29', 3, '2019-11-28 19:23:29', '2019-11-29 03:08:00'),
(8, 75, '2019-11-29', 1, '2019-11-28 19:23:29', '2019-11-29 03:08:27'),
(9, 85, '2019-11-29', 4, '2019-11-28 19:23:29', '2019-11-28 19:23:29'),
(10, 83, '2019-11-29', 1, '2019-11-28 19:23:29', '2019-11-29 03:08:42'),
(11, 81, '2019-11-29', 4, '2019-11-28 19:23:29', '2019-11-28 19:23:29'),
(12, 79, '2019-11-29', 4, '2019-11-28 19:23:29', '2019-11-28 19:23:29'),
(13, 77, '2019-11-30', 4, '2019-11-29 02:00:42', '2019-11-29 02:00:42'),
(14, 75, '2019-11-30', 0, '2019-11-29 02:00:42', '2019-11-29 02:00:42'),
(15, 85, '2019-11-30', 0, '2019-11-29 02:00:42', '2019-11-29 02:00:42'),
(16, 83, '2019-11-30', 0, '2019-11-29 02:00:42', '2019-11-29 02:00:42'),
(17, 81, '2019-11-30', 0, '2019-11-29 02:00:42', '2019-11-29 02:00:42'),
(18, 79, '2019-11-30', 0, '2019-11-29 02:00:42', '2019-11-29 02:00:42'),
(19, 77, '2019-12-01', 0, '2019-11-29 02:01:07', '2019-11-29 02:01:07'),
(20, 75, '2019-12-01', 2, '2019-11-29 02:01:07', '2019-11-29 02:01:07'),
(21, 85, '2019-12-01', 0, '2019-11-29 02:01:07', '2019-11-29 02:01:07'),
(22, 83, '2019-12-01', 0, '2019-11-29 02:01:07', '2019-11-29 02:01:07'),
(23, 81, '2019-12-01', 4, '2019-11-29 02:01:07', '2019-11-29 02:01:07'),
(24, 79, '2019-12-01', 4, '2019-11-29 02:01:07', '2019-11-29 02:01:07'),
(25, 77, '2019-12-02', 0, '2019-11-29 02:01:26', '2019-11-29 02:01:26'),
(26, 75, '2019-12-02', 0, '2019-11-29 02:01:26', '2019-11-29 02:01:26'),
(27, 85, '2019-12-02', 0, '2019-11-29 02:01:26', '2019-11-29 02:01:26'),
(28, 83, '2019-12-02', 0, '2019-11-29 02:01:26', '2019-11-29 02:01:26'),
(29, 81, '2019-12-02', 0, '2019-11-29 02:01:26', '2019-11-29 02:01:26'),
(30, 79, '2019-12-02', 0, '2019-11-29 02:01:26', '2019-11-29 02:01:26'),
(31, 77, '2019-12-03', 0, '2019-11-29 02:01:56', '2019-11-29 02:01:56'),
(32, 75, '2019-12-03', 0, '2019-11-29 02:01:56', '2019-11-29 02:01:56'),
(33, 85, '2019-12-03', 0, '2019-11-29 02:01:56', '2019-11-29 02:01:56'),
(34, 83, '2019-12-03', 1, '2019-11-29 02:01:56', '2019-11-29 02:01:56'),
(35, 81, '2019-12-03', 0, '2019-11-29 02:01:56', '2019-11-29 02:01:56'),
(36, 79, '2019-12-03', 0, '2019-11-29 02:01:56', '2019-11-29 02:01:56'),
(37, 77, '2019-12-04', 1, '2019-11-29 02:04:55', '2019-11-29 02:04:55'),
(38, 75, '2019-12-04', 0, '2019-11-29 02:04:55', '2019-11-29 02:04:55'),
(39, 85, '2019-12-04', 0, '2019-11-29 02:04:55', '2019-11-29 02:04:55'),
(40, 83, '2019-12-04', 0, '2019-11-29 02:04:55', '2019-11-29 02:04:55'),
(41, 81, '2019-12-04', 0, '2019-11-29 02:04:55', '2019-11-29 02:04:55'),
(42, 79, '2019-12-04', 0, '2019-11-29 02:04:55', '2019-11-29 02:04:55'),
(43, 77, '2019-12-05', 1, '2019-11-29 02:05:14', '2019-11-29 03:09:35'),
(44, 75, '2019-12-05', 0, '2019-11-29 02:05:14', '2019-11-29 02:05:14'),
(45, 85, '2019-12-05', 0, '2019-11-29 02:05:14', '2019-11-29 02:05:14'),
(46, 83, '2019-12-05', 0, '2019-11-29 02:05:14', '2019-11-29 02:05:14'),
(47, 81, '2019-12-05', 0, '2019-11-29 02:05:14', '2019-11-29 02:05:14'),
(48, 79, '2019-12-05', 0, '2019-11-29 02:05:14', '2019-11-29 02:05:14'),
(49, 77, '2019-12-06', 0, '2019-11-29 02:05:39', '2019-11-29 02:05:39'),
(50, 75, '2019-12-06', 0, '2019-11-29 02:05:39', '2019-11-29 02:05:39'),
(51, 85, '2019-12-06', 0, '2019-11-29 02:05:39', '2019-11-29 02:05:39'),
(52, 83, '2019-12-06', 0, '2019-11-29 02:05:39', '2019-11-29 02:05:39'),
(53, 81, '2019-12-06', 0, '2019-11-29 02:05:39', '2019-11-29 02:05:39'),
(54, 79, '2019-12-06', 0, '2019-11-29 02:05:39', '2019-11-29 02:05:39'),
(72, 90, '2019-11-29', 0, '2019-11-29 04:44:25', '2019-11-29 04:44:25'),
(71, 89, '2019-11-29', 1, '2019-11-29 04:44:25', '2019-11-29 04:44:25'),
(70, 94, '2019-11-29', 0, '2019-11-29 04:44:25', '2019-11-29 04:44:25'),
(69, 93, '2019-11-29', 0, '2019-11-29 04:44:25', '2019-11-29 04:44:25'),
(68, 92, '2019-11-29', 2, '2019-11-29 04:44:25', '2019-11-29 04:44:25'),
(67, 91, '2019-11-29', 1, '2019-11-29 04:44:25', '2019-11-29 04:44:25');

-- --------------------------------------------------------

--
-- Estrutura da tabela `matdisciplina`
--

DROP TABLE IF EXISTS `matdisciplina`;
CREATE TABLE IF NOT EXISTS `matdisciplina` (
  `CDMATDISCIPLINA` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `CDMATRICULA` int(11) DEFAULT NULL,
  `CDDISCIPLINA` int(11) DEFAULT NULL,
  `MEDIA` decimal(7,2) DEFAULT NULL,
  `STATUS` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CDPROFESSOR` int(11) DEFAULT NULL,
  `VALOR` decimal(7,2) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CDMATDISCIPLINA`),
  KEY `CDMATRICULA` (`CDMATRICULA`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `matdisciplina`
--

INSERT INTO `matdisciplina` (`CDMATDISCIPLINA`, `CDMATRICULA`, `CDDISCIPLINA`, `MEDIA`, `STATUS`, `CDPROFESSOR`, `VALOR`, `updated_at`, `created_at`) VALUES
(82, 25, 7, '9.25', 'MT', 1, '10.00', '2019-11-24 06:45:29', '2019-11-24 06:45:29'),
(81, 26, 6, '7.75', 'MT', 1, '10.00', '2019-11-24 06:45:20', '2019-11-24 06:45:20'),
(80, 26, 7, '6.10', 'MT', 1, '10.00', '2019-11-24 06:45:20', '2019-11-24 06:45:20'),
(85, 24, 6, '5.35', 'MT', 1, '10.00', '2019-11-24 06:45:39', '2019-11-24 06:45:39'),
(86, 23, 2, '9.25', 'MT', 9, '60.00', '2019-11-27 23:35:24', '2019-11-27 23:35:24'),
(79, 27, 6, '8.25', 'MT', 1, '10.00', '2019-11-24 06:45:12', '2019-11-24 06:45:12'),
(78, 27, 7, '8.50', 'MT', 1, '10.00', '2019-11-24 06:45:12', '2019-11-24 06:45:12'),
(77, 23, 6, '9.95', 'MT', 1, '10.00', '2019-11-23 16:46:39', '2019-11-23 16:46:39'),
(76, 23, 7, '8.25', 'MT', 1, '10.00', '2019-11-23 16:46:39', '2019-11-23 16:46:39'),
(84, 24, 7, '6.95', 'MT', 1, '10.00', '2019-11-24 06:45:39', '2019-11-24 06:45:39'),
(75, 22, 6, '9.15', 'MT', 1, '10.00', '2019-11-23 16:46:29', '2019-11-23 16:46:29'),
(74, 22, 7, '8.20', 'MT', 1, '10.00', '2019-11-23 16:46:29', '2019-11-23 16:46:29'),
(83, 25, 6, '7.70', 'MT', 1, '10.00', '2019-11-24 06:45:29', '2019-11-24 06:45:29'),
(87, 22, 2, '9.80', 'MT', 9, '10.00', '2019-11-27 23:35:34', '2019-11-27 23:35:34'),
(88, 28, 13, '10.00', 'MT', 1, '0.10', '2019-11-29 02:26:29', '2019-11-29 02:26:29'),
(89, 26, 13, '7.30', 'MT', 1, '0.01', '2019-11-29 04:28:07', '2019-11-29 04:28:07'),
(90, 27, 13, '6.85', 'MT', 1, '0.01', '2019-11-29 04:28:20', '2019-11-29 04:28:20'),
(91, 23, 13, '9.90', 'MT', 1, '0.01', '2019-11-29 04:30:07', '2019-11-29 04:30:07'),
(92, 22, 13, '8.30', 'MT', 1, '0.01', '2019-11-29 04:30:24', '2019-11-29 04:30:24'),
(93, 24, 13, '6.00', 'MT', 1, '0.01', '2019-11-29 04:30:37', '2019-11-29 04:30:37'),
(94, 25, 13, '9.05', 'MT', 1, '0.01', '2019-11-29 04:30:50', '2019-11-29 04:30:50');

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula`
--

DROP TABLE IF EXISTS `matricula`;
CREATE TABLE IF NOT EXISTS `matricula` (
  `CDMATRICULA` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `CDCURSO` int(11) DEFAULT NULL,
  `CDALUNO` int(11) DEFAULT NULL,
  `CDSEMESTRE` int(11) DEFAULT NULL,
  `VALOR` decimal(7,2) DEFAULT NULL,
  `CDTURMA` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CDMATRICULA`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `matricula`
--

INSERT INTO `matricula` (`CDMATRICULA`, `CDCURSO`, `CDALUNO`, `CDSEMESTRE`, `VALOR`, `CDTURMA`, `updated_at`, `created_at`) VALUES
(26, 1, 20170005, 10, '10.00', 6, '2019-11-24 06:37:56', '2019-11-24 06:37:56'),
(27, 1, 20190002, 10, '10.00', 6, '2019-11-24 06:38:08', '2019-11-24 06:38:08'),
(24, 1, 20190003, 10, '20.00', 6, '2019-11-24 06:37:28', '2019-11-24 06:37:28'),
(28, 1, 20190021, 10, '0.01', 3, '2019-11-29 02:26:02', '2019-11-29 02:26:02'),
(25, 1, 20190004, 10, '20.00', 6, '2019-11-24 06:37:45', '2019-11-24 06:37:45'),
(23, 1, 20190020, 10, '20.00', 6, '2019-11-23 16:46:06', '2019-11-23 16:46:06'),
(22, 1, 20190001, 10, '20.00', 6, '2019-11-23 16:45:49', '2019-11-23 16:45:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(15, '2014_10_12_000000_create_users_table', 3),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_09_03_114049_create_aluno_table', 1),
(4, '2019_09_03_114049_create_curso_table', 1),
(5, '2019_09_03_114049_create_disciplina_table', 1),
(6, '2019_09_03_114049_create_matdisciplina_table', 1),
(7, '2019_09_03_114049_create_matricula_table', 1),
(8, '2019_09_03_114049_create_nota_table', 1),
(9, '2019_09_03_114049_create_professor_table', 1),
(10, '2019_09_03_114049_create_semestre_table', 1),
(11, '2019_09_03_114049_create_turma_table', 1),
(12, '2019_11_16_164330_create_roles_table', 2),
(13, '2019_11_16_164402_create_user_roles_table', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `nota`
--

DROP TABLE IF EXISTS `nota`;
CREATE TABLE IF NOT EXISTS `nota` (
  `CDNOTA` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `CDMATDISCIPLINA` int(11) DEFAULT NULL,
  `NOTA` decimal(7,2) DEFAULT NULL,
  `REFERENCIA` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `STATUS` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CDNOTA`)
) ENGINE=MyISAM AUTO_INCREMENT=260 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `nota`
--

INSERT INTO `nota` (`CDNOTA`, `CDMATDISCIPLINA`, `NOTA`, `REFERENCIA`, `STATUS`, `created_at`, `updated_at`) VALUES
(250, 76, '8.50', 'Prova 2', NULL, '2019-12-03 14:22:32', '2019-12-03 14:22:32'),
(249, 78, '8.00', 'Prova 1', NULL, '2019-12-03 14:22:14', '2019-12-03 14:22:14'),
(248, 80, '7.00', 'Prova 1', NULL, '2019-12-03 14:22:14', '2019-12-03 14:22:14'),
(247, 82, '10.00', 'Prova 1', NULL, '2019-12-03 14:22:14', '2019-12-03 14:22:14'),
(241, 94, '9.50', 'Prova 2', NULL, '2019-11-29 04:37:13', '2019-12-02 18:26:35'),
(240, 93, '5.20', 'Prova 2', NULL, '2019-11-29 04:37:13', '2019-12-02 18:26:35'),
(239, 92, '8.10', 'Prova 2', NULL, '2019-11-29 04:37:13', '2019-12-02 18:26:35'),
(238, 91, '10.00', 'Prova 2', NULL, '2019-11-29 04:37:13', '2019-12-02 18:26:35'),
(236, 89, '7.20', 'Prova 1', NULL, '2019-11-29 04:36:41', '2019-12-02 18:27:36'),
(237, 90, '5.50', 'Prova 1', NULL, '2019-11-29 04:36:41', '2019-12-02 18:27:36'),
(235, 94, '8.60', 'Prova 1', NULL, '2019-11-29 04:36:41', '2019-12-02 18:27:36'),
(234, 93, '6.80', 'Prova 1', NULL, '2019-11-29 04:36:41', '2019-12-02 18:27:36'),
(233, 92, '8.50', 'Prova 1', NULL, '2019-11-29 04:36:41', '2019-12-02 18:27:36'),
(232, 91, '9.80', 'Prova 1', NULL, '2019-11-29 04:36:41', '2019-12-02 18:27:36'),
(231, 88, '10.00', 'Prova 2', NULL, '2019-11-29 02:31:56', '2019-11-29 02:31:56'),
(230, 88, '10.00', 'Prova 1', NULL, '2019-11-29 02:31:40', '2019-11-29 02:31:40'),
(211, 79, '9.80', 'Prova 2', NULL, '2019-11-26 19:02:52', '2019-11-28 14:22:00'),
(210, 81, '10.00', 'Prova 2', NULL, '2019-11-26 19:02:52', '2019-11-28 14:22:00'),
(209, 83, '8.80', 'Prova 2', NULL, '2019-11-26 19:02:52', '2019-11-28 14:22:00'),
(208, 85, '5.70', 'Prova 2', NULL, '2019-11-26 19:02:52', '2019-11-28 14:22:00'),
(207, 75, '9.50', 'Prova 2', NULL, '2019-11-26 19:02:52', '2019-11-28 14:22:00'),
(206, 77, '10.00', 'Prova 2', NULL, '2019-11-26 19:02:52', '2019-11-28 14:22:00'),
(246, 84, '7.50', 'Prova 1', NULL, '2019-12-03 14:22:14', '2019-12-03 14:22:14'),
(245, 74, '8.90', 'Prova 1', NULL, '2019-12-03 14:22:14', '2019-12-03 14:22:14'),
(244, 76, '8.00', 'Prova 1', NULL, '2019-12-03 14:22:14', '2019-12-03 14:22:14'),
(243, 90, '8.20', 'Prova 2', NULL, '2019-11-29 04:37:13', '2019-12-02 18:26:35'),
(242, 89, '7.40', 'Prova 2', NULL, '2019-11-29 04:37:13', '2019-12-02 18:26:35'),
(205, 79, '6.70', 'Prova 1', NULL, '2019-11-26 19:00:55', '2019-11-28 14:22:14'),
(204, 81, '5.50', 'Prova 1', NULL, '2019-11-26 19:00:55', '2019-11-28 14:22:14'),
(203, 83, '6.60', 'Prova 1', NULL, '2019-11-26 19:00:55', '2019-11-28 14:22:14'),
(202, 85, '5.00', 'Prova 1', NULL, '2019-11-26 19:00:55', '2019-11-28 14:22:14'),
(201, 75, '8.80', 'Prova 1', NULL, '2019-11-26 19:00:55', '2019-11-28 14:22:14'),
(200, 77, '9.90', 'Prova 1', NULL, '2019-11-26 19:00:55', '2019-11-28 14:22:14'),
(251, 74, '7.50', 'Prova 2', NULL, '2019-12-03 14:22:32', '2019-12-03 14:22:32'),
(252, 84, '6.40', 'Prova 2', NULL, '2019-12-03 14:22:32', '2019-12-03 14:22:32'),
(253, 82, '8.50', 'Prova 2', NULL, '2019-12-03 14:22:32', '2019-12-03 14:22:32'),
(254, 80, '5.20', 'Prova 2', NULL, '2019-12-03 14:22:32', '2019-12-03 14:22:32'),
(255, 78, '9.00', 'Prova 2', NULL, '2019-12-03 14:22:32', '2019-12-03 14:22:32'),
(256, 86, '10.00', 'Prova 1', NULL, '2019-12-03 14:24:11', '2019-12-03 14:24:11'),
(257, 87, '10.00', 'Prova 1', NULL, '2019-12-03 14:24:11', '2019-12-03 14:24:11'),
(258, 86, '8.50', 'Prova 2', NULL, '2019-12-03 14:24:26', '2019-12-03 14:24:26'),
(259, 87, '9.60', 'Prova 2', NULL, '2019-12-03 14:24:26', '2019-12-03 14:24:26');

--
-- Acionadores `nota`
--
DROP TRIGGER IF EXISTS `nota_AFTER_DELETE`;
DELIMITER $$
CREATE TRIGGER `nota_AFTER_DELETE` AFTER DELETE ON `nota` FOR EACH ROW BEGIN
UPDATE matdisciplina SET 
	matdisciplina.MEDIA = (SELECT AVG(nota.NOTA) FROM nota WHERE nota.CDMATDISCIPLINA = old.CDMATDISCIPLINA) 
                            WHERE matdisciplina.CDMATDISCIPLINA = old.CDMATDISCIPLINA;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `nota_AFTER_INSERT`;
DELIMITER $$
CREATE TRIGGER `nota_AFTER_INSERT` AFTER INSERT ON `nota` FOR EACH ROW BEGIN
UPDATE matdisciplina SET 
	matdisciplina.MEDIA = (SELECT AVG(nota.NOTA) FROM nota WHERE nota.CDMATDISCIPLINA = NEW.CDMATDISCIPLINA) 
                            WHERE matdisciplina.CDMATDISCIPLINA = new.CDMATDISCIPLINA;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `nota_AFTER_UPDATE`;
DELIMITER $$
CREATE TRIGGER `nota_AFTER_UPDATE` AFTER UPDATE ON `nota` FOR EACH ROW BEGIN
UPDATE matdisciplina SET 
							matdisciplina.MEDIA = (SELECT AVG(nota.NOTA) FROM nota WHERE nota.CDMATDISCIPLINA = NEW.CDMATDISCIPLINA) 
                            WHERE matdisciplina.CDMATDISCIPLINA = new.CDMATDISCIPLINA;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

DROP TABLE IF EXISTS `professor`;
CREATE TABLE IF NOT EXISTS `professor` (
  `CDPROFESSOR` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `NOME` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IDUSER` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CDPROFESSOR`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`CDPROFESSOR`, `NOME`, `IDUSER`, `updated_at`, `created_at`) VALUES
(1, 'FÁBIO DOS SANTOS LIMA', 2, '2019-11-28 11:54:34', '2019-09-10 12:16:18'),
(9, 'GEORGE GABRIEL MENDES DOURADO', 3, '2019-11-22 17:11:21', '2019-11-22 20:11:21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `semestre`
--

DROP TABLE IF EXISTS `semestre`;
CREATE TABLE IF NOT EXISTS `semestre` (
  `CDSEMESTRE` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ANO` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CDSEMESTRE`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `semestre`
--

INSERT INTO `semestre` (`CDSEMESTRE`, `ANO`, `updated_at`, `created_at`) VALUES
(3, '2019.1', '2019-09-17 12:01:24', '2019-09-17 12:01:24'),
(4, '2019.2', '2019-09-17 12:01:35', '2019-09-17 12:01:35'),
(7, '2017.2', '2019-09-17 15:18:15', '2019-09-17 15:18:15'),
(8, '2018.1', '2019-09-17 15:22:09', '2019-09-17 15:22:09'),
(9, '2018.2', '2019-09-17 15:22:17', '2019-09-17 15:22:17'),
(10, '2020.1', '2019-11-06 03:52:37', '2019-11-06 03:52:37');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

DROP TABLE IF EXISTS `turma`;
CREATE TABLE IF NOT EXISTS `turma` (
  `CDTURMA` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `NOMETURMA` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CDTURMA`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`CDTURMA`, `NOMETURMA`, `created_at`, `updated_at`) VALUES
(2, '4DS', '2019-09-10 13:28:42', '2019-09-10 16:29:51'),
(3, '3DS', '2019-09-17 12:01:45', '2019-09-17 12:01:45'),
(6, '5DS', '2019-11-21 17:56:02', '2019-11-21 17:56:02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissao` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `permissao`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Calebe Pereira', 'calebegpiloes@gmail.com', '2019-11-16 20:02:14', '$2y$10$RKW8VvPGYYzmahyR6JLq1uOp/7Bfnk2gEb.w2ygD.1Ef/P570fSyi', 1, NULL, '2019-11-16 20:02:14', '2019-11-22 19:59:07'),
(2, 'Fábio dos Santos Lima', 'fabio@gmail.com', NULL, '$2y$10$JFSlYowa1bua00Fa5L5pN.e9p6qcnaVno3v859f9Ex3G11l1xU886', 2, NULL, '2019-11-16 21:21:03', '2019-11-22 21:00:11'),
(3, 'George Gabriel Mendes Dourado', 'george@gmail.com', NULL, '$2y$10$x4yRoT8buL6.o1c9VwuPwejjuBCkcxGRq1AfyDh8uwhj4iu81lJiG', 2, NULL, '2019-11-22 20:07:49', '2019-11-22 21:01:27'),
(4, 'Fabio', 'fabioadm@gmail.com', NULL, '$2y$10$KiyfXEi9FAMnzDfBEUs4S.kQ31Dth3tS41wHxvW.yTWFgyEeWxRGS', 1, NULL, '2019-12-03 14:19:12', '2019-12-03 14:19:12');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
