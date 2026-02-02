-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 23, 2025 at 04:17 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abdilahi`
--

-- --------------------------------------------------------

--
-- Table structure for table `antonyms`
--

CREATE TABLE `antonyms` (
  `id` bigint UNSIGNED NOT NULL,
  `word_id` bigint UNSIGNED NOT NULL,
  `antonym` text NOT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `antonyms`
--

INSERT INTO `antonyms` (`id`, `word_id`, `antonym`, `published_at`, `created_at`, `updated_at`, `expires_at`) VALUES
(1, 5, 'egg', NULL, '2025-10-16 07:45:10', '2025-10-16 07:45:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('b5a7a64024fa86d3a960b79a8fcc5ef2', 'i:1;', 1760627677),
('b5a7a64024fa86d3a960b79a8fcc5ef2:timer', 'i:1760627677;', 1760627677),
('dict_word_apple', 'a:7:{s:4:\"word\";s:5:\"apple\";s:13:\"pronunciation\";s:11:\"/ˈæp.əl/\";s:14:\"part_of_speech\";s:4:\"noun\";s:11:\"definitions\";a:12:{i:0;s:93:\"A common, round fruit produced by the tree Malus domestica, cultivated in temperate climates.\";i:1;s:221:\"Any of various tree-borne fruits or vegetables especially considered as resembling an apple; also (with qualifying words) used to form the names of other specific fruits such as custard apple, rose apple, thorn apple etc.\";i:2;s:126:\"The fruit of the Tree of Knowledge, eaten by Adam and Eve according to post-Biblical Christian tradition; the forbidden fruit.\";i:3;s:90:\"A tree of the genus Malus, especially one cultivated for its edible fruit; the apple tree.\";i:4;s:27:\"The wood of the apple tree.\";i:5;s:61:\"(in the plural) Short for apples and pears, slang for stairs.\";i:6;s:21:\"The ball in baseball.\";i:7;s:97:\"When smiling, the round, fleshy part of the cheeks between the eyes and the corners of the mouth.\";i:8;s:95:\"A Native American or red-skinned person who acts and/or thinks like a white (Caucasian) person.\";i:9;s:29:\"(ice hockey slang) An assist.\";i:10;s:21:\"To become apple-like.\";i:11;s:13:\"To form buds.\";}s:8:\"synonyms\";a:0:{}s:8:\"antonyms\";a:0:{}s:8:\"examples\";a:0:{}}', 1763214309),
('dict_word_banana', 'a:7:{s:4:\"word\";s:6:\"banana\";s:13:\"pronunciation\";s:15:\"/bəˈnɑːnə/\";s:14:\"part_of_speech\";s:4:\"noun\";s:11:\"definitions\";a:9:{i:0;s:98:\"An elongated curved tropical fruit that grows in bunches and has a creamy flesh and a smooth skin.\";i:1;s:207:\"The tropical tree-like plant which bears clusters of bananas. The plant, usually of the genus Musa but sometimes also including plants from Ensete, has large, elongated leaves and is related to the plantain.\";i:2;s:46:\"A yellow colour, like that of a banana\'s skin.\";i:3;s:203:\"(mildly) A person of Asian descent, especially a Chinese American, who has assimilated into Western culture or married a Caucasian (from the \"yellow\" outside and \"white\" inside). Compare coconut or Oreo.\";i:4;s:25:\"A banana equivalent dose.\";i:5;s:65:\"A catamorphism (from the use of banana brackets in the notation).\";i:6;s:10:\"The penis.\";i:7;s:14:\"A banana kick.\";i:8;s:53:\"Curved like a banana, especially of a ball in flight.\";}s:8:\"synonyms\";a:2:{i:0;s:7:\"Twinkie\";i:1;s:9:\"jook-sing\";}s:8:\"antonyms\";a:1:{i:0;s:3:\"egg\";}s:8:\"examples\";a:0:{}}', 1763214310),
('dict_word_computer', 'a:7:{s:4:\"word\";s:8:\"computer\";s:13:\"pronunciation\";s:16:\"/kəmˈpjuːtə/\";s:14:\"part_of_speech\";s:4:\"noun\";s:11:\"definitions\";a:3:{i:0;s:60:\"A person employed to perform computations; one who computes.\";i:1;s:83:\"(by restriction) A male computer, where the female computer is called a computress.\";i:2;s:332:\"A programmable electronic device that performs mathematical calculations and logical operations, especially one that can process, store and retrieve large amounts of data very quickly; now especially, a small one for personal or home use employed for manipulating text or graphics, accessing the Internet, or playing games or media.\";}s:8:\"synonyms\";a:5:{i:0;s:6:\"\'puter\";i:1;s:3:\"box\";i:2;s:10:\"calculator\";i:3;s:7:\"machine\";i:4;s:9:\"processor\";}s:8:\"antonyms\";a:0:{}s:8:\"examples\";a:0:{}}', 1763228977),
('dict_word_pear', 'a:7:{s:4:\"word\";s:4:\"pear\";s:13:\"pronunciation\";N;s:14:\"part_of_speech\";s:4:\"noun\";s:11:\"definitions\";a:6:{i:0;s:94:\"An edible fruit produced by the pear tree, similar to an apple but elongated towards the stem.\";i:1;s:38:\"A type of fruit tree (Pyrus communis).\";i:2;s:48:\"The wood of the pear tree (pearwood, pear wood).\";i:3;s:30:\"Choke pear (a torture device).\";i:4;s:23:\"Avocado, alligator pear\";i:5;s:60:\"A desaturated chartreuse yellow colour, like that of a pear.\";}s:8:\"synonyms\";a:1:{i:0;s:9:\"pear tree\";}s:8:\"antonyms\";a:0:{}s:8:\"examples\";a:0:{}}', 1763214331),
('dict_word_selfness', 'a:7:{s:4:\"word\";s:8:\"selfness\";s:13:\"pronunciation\";N;s:14:\"part_of_speech\";s:4:\"noun\";s:11:\"definitions\";a:3:{i:0;s:41:\"The state, quality, or condition of self.\";i:1;s:12:\"Personality.\";i:2;s:8:\"Egotism.\";}s:8:\"synonyms\";a:0:{}s:8:\"antonyms\";a:0:{}s:8:\"examples\";a:0:{}}', 1763214267),
('dict_word_semisweet', 'a:7:{s:4:\"word\";s:9:\"semisweet\";s:13:\"pronunciation\";N;s:14:\"part_of_speech\";s:9:\"adjective\";s:11:\"definitions\";a:1:{i:0;s:158:\"Partially sweet or sweetened, but having a distinct bitter component. Especially used to describe dark chocolate that is much less sugary than milk chocolate.\";}s:8:\"synonyms\";a:0:{}s:8:\"antonyms\";a:0:{}s:8:\"examples\";a:0:{}}', 1763214266),
('system_settings', 'O:24:\"App\\Models\\SystemSetting\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:15:\"system_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:20:{s:2:\"id\";i:1;s:12:\"system_title\";s:17:\"My Laravel System\";s:18:\"system_short_title\";s:10:\"LaravelSys\";s:11:\"system_logo\";s:29:\"uploads/systems/logo/logo.png\";s:14:\"system_favicon\";s:35:\"uploads/systems/favicon/favicon.png\";s:12:\"company_name\";s:15:\"My Company Ltd.\";s:15:\"company_address\";s:17:\"Dhaka, Bangladesh\";s:7:\"tagline\";s:16:\"Best Laravel App\";s:5:\"phone\";s:13:\"+880123456789\";s:5:\"email\";s:17:\"admin@example.com\";s:8:\"timezone\";s:10:\"Asia/Dhaka\";s:8:\"language\";s:2:\"en\";s:14:\"copyright_text\";s:47:\"© 2025 My Laravel System. All rights reserved.\";s:11:\"admin_title\";s:11:\"Admin Panel\";s:11:\"short_title\";s:8:\"AdminSys\";s:10:\"admin_logo\";s:28:\"uploads/admins/logo/logo.png\";s:13:\"admin_favicon\";s:34:\"uploads/admins/favicon/favicon.png\";s:20:\"admin_copyright_text\";s:19:\"© 2025 Admin Panel\";s:10:\"created_at\";s:19:\"2025-10-16 13:43:32\";s:10:\"updated_at\";s:19:\"2025-10-16 13:43:32\";}s:11:\"\0*\0original\";a:20:{s:2:\"id\";i:1;s:12:\"system_title\";s:17:\"My Laravel System\";s:18:\"system_short_title\";s:10:\"LaravelSys\";s:11:\"system_logo\";s:29:\"uploads/systems/logo/logo.png\";s:14:\"system_favicon\";s:35:\"uploads/systems/favicon/favicon.png\";s:12:\"company_name\";s:15:\"My Company Ltd.\";s:15:\"company_address\";s:17:\"Dhaka, Bangladesh\";s:7:\"tagline\";s:16:\"Best Laravel App\";s:5:\"phone\";s:13:\"+880123456789\";s:5:\"email\";s:17:\"admin@example.com\";s:8:\"timezone\";s:10:\"Asia/Dhaka\";s:8:\"language\";s:2:\"en\";s:14:\"copyright_text\";s:47:\"© 2025 My Laravel System. All rights reserved.\";s:11:\"admin_title\";s:11:\"Admin Panel\";s:11:\"short_title\";s:8:\"AdminSys\";s:10:\"admin_logo\";s:28:\"uploads/admins/logo/logo.png\";s:13:\"admin_favicon\";s:34:\"uploads/admins/favicon/favicon.png\";s:20:\"admin_copyright_text\";s:19:\"© 2025 Admin Panel\";s:10:\"created_at\";s:19:\"2025-10-16 13:43:32\";s:10:\"updated_at\";s:19:\"2025-10-16 13:43:32\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:2:{i:0;s:15:\"system_logo_url\";i:1;s:18:\"system_favicon_url\";}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:12:\"system_title\";i:1;s:18:\"system_short_title\";i:2;s:11:\"system_logo\";i:3;s:14:\"system_favicon\";i:4;s:12:\"company_name\";i:5;s:15:\"company_address\";i:6;s:7:\"tagline\";i:7;s:5:\"phone\";i:8;s:5:\"email\";i:9;s:8:\"timezone\";i:10;s:8:\"language\";i:11;s:14:\"copyright_text\";i:12;s:9:\"site_name\";i:13;s:13:\"designer_name\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 2075987611);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `definitions`
--

CREATE TABLE `definitions` (
  `id` bigint UNSIGNED NOT NULL,
  `word_id` bigint UNSIGNED NOT NULL,
  `definition` text NOT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `definitions`
--

INSERT INTO `definitions` (`id`, `word_id`, `definition`, `published_at`, `created_at`, `updated_at`, `expires_at`) VALUES
(1, 1, 'Partially sweet or sweetened, but having a distinct bitter component. Especially used to describe dark chocolate that is much less sugary than milk chocolate.', NULL, '2025-10-16 07:44:26', '2025-10-16 07:44:26', NULL),
(2, 2, 'The state, quality, or condition of self.', NULL, '2025-10-16 07:44:27', '2025-10-16 07:44:27', NULL),
(3, 2, 'Personality.', NULL, '2025-10-16 07:44:27', '2025-10-16 07:44:27', NULL),
(4, 2, 'Egotism.', NULL, '2025-10-16 07:44:27', '2025-10-16 07:44:27', NULL),
(5, 3, 'No definition available', NULL, '2025-10-16 07:45:02', '2025-10-16 07:45:02', NULL),
(6, 4, 'A common, round fruit produced by the tree Malus domestica, cultivated in temperate climates.', NULL, '2025-10-16 07:45:09', '2025-10-16 07:45:09', NULL),
(7, 4, 'Any of various tree-borne fruits or vegetables especially considered as resembling an apple; also (with qualifying words) used to form the names of other specific fruits such as custard apple, rose apple, thorn apple etc.', NULL, '2025-10-16 07:45:09', '2025-10-16 07:45:09', NULL),
(8, 4, 'The fruit of the Tree of Knowledge, eaten by Adam and Eve according to post-Biblical Christian tradition; the forbidden fruit.', NULL, '2025-10-16 07:45:09', '2025-10-16 07:45:09', NULL),
(9, 4, 'A tree of the genus Malus, especially one cultivated for its edible fruit; the apple tree.', NULL, '2025-10-16 07:45:09', '2025-10-16 07:45:09', NULL),
(10, 4, 'The wood of the apple tree.', NULL, '2025-10-16 07:45:09', '2025-10-16 07:45:09', NULL),
(11, 4, '(in the plural) Short for apples and pears, slang for stairs.', NULL, '2025-10-16 07:45:09', '2025-10-16 07:45:09', NULL),
(12, 4, 'The ball in baseball.', NULL, '2025-10-16 07:45:09', '2025-10-16 07:45:09', NULL),
(13, 4, 'When smiling, the round, fleshy part of the cheeks between the eyes and the corners of the mouth.', NULL, '2025-10-16 07:45:09', '2025-10-16 07:45:09', NULL),
(14, 4, 'A Native American or red-skinned person who acts and/or thinks like a white (Caucasian) person.', NULL, '2025-10-16 07:45:09', '2025-10-16 07:45:09', NULL),
(15, 4, '(ice hockey slang) An assist.', NULL, '2025-10-16 07:45:09', '2025-10-16 07:45:09', NULL),
(16, 4, 'To become apple-like.', NULL, '2025-10-16 07:45:09', '2025-10-16 07:45:09', NULL),
(17, 4, 'To form buds.', NULL, '2025-10-16 07:45:09', '2025-10-16 07:45:09', NULL),
(18, 5, 'An elongated curved tropical fruit that grows in bunches and has a creamy flesh and a smooth skin.', NULL, '2025-10-16 07:45:10', '2025-10-16 07:45:10', NULL),
(19, 5, 'The tropical tree-like plant which bears clusters of bananas. The plant, usually of the genus Musa but sometimes also including plants from Ensete, has large, elongated leaves and is related to the plantain.', NULL, '2025-10-16 07:45:10', '2025-10-16 07:45:10', NULL),
(20, 5, 'A yellow colour, like that of a banana\'s skin.', NULL, '2025-10-16 07:45:10', '2025-10-16 07:45:10', NULL),
(21, 5, '(mildly) A person of Asian descent, especially a Chinese American, who has assimilated into Western culture or married a Caucasian (from the \"yellow\" outside and \"white\" inside). Compare coconut or Oreo.', NULL, '2025-10-16 07:45:10', '2025-10-16 07:45:10', NULL),
(22, 5, 'A banana equivalent dose.', NULL, '2025-10-16 07:45:10', '2025-10-16 07:45:10', NULL),
(23, 5, 'A catamorphism (from the use of banana brackets in the notation).', NULL, '2025-10-16 07:45:10', '2025-10-16 07:45:10', NULL),
(24, 5, 'The penis.', NULL, '2025-10-16 07:45:10', '2025-10-16 07:45:10', NULL),
(25, 5, 'A banana kick.', NULL, '2025-10-16 07:45:10', '2025-10-16 07:45:10', NULL),
(26, 5, 'Curved like a banana, especially of a ball in flight.', NULL, '2025-10-16 07:45:10', '2025-10-16 07:45:10', NULL),
(27, 6, 'No definition available', NULL, '2025-10-16 07:45:29', '2025-10-16 07:45:29', NULL),
(28, 7, 'An edible fruit produced by the pear tree, similar to an apple but elongated towards the stem.', NULL, '2025-10-16 07:45:31', '2025-10-16 07:45:31', NULL),
(29, 7, 'A type of fruit tree (Pyrus communis).', NULL, '2025-10-16 07:45:31', '2025-10-16 07:45:31', NULL),
(30, 7, 'The wood of the pear tree (pearwood, pear wood).', NULL, '2025-10-16 07:45:31', '2025-10-16 07:45:31', NULL),
(31, 7, 'Choke pear (a torture device).', NULL, '2025-10-16 07:45:31', '2025-10-16 07:45:31', NULL),
(32, 7, 'Avocado, alligator pear', NULL, '2025-10-16 07:45:31', '2025-10-16 07:45:31', NULL),
(33, 7, 'A desaturated chartreuse yellow colour, like that of a pear.', NULL, '2025-10-16 07:45:31', '2025-10-16 07:45:31', NULL),
(34, 8, 'No definition available', NULL, '2025-10-16 07:48:13', '2025-10-16 07:48:13', NULL),
(35, 9, 'No definition available', NULL, '2025-10-16 07:48:35', '2025-10-16 07:48:35', NULL),
(36, 10, 'No definition available', NULL, '2025-10-16 07:49:28', '2025-10-16 07:49:28', NULL),
(37, 11, 'No definition available', NULL, '2025-10-16 08:17:32', '2025-10-16 08:17:32', NULL),
(38, 12, 'No definition available', NULL, '2025-10-16 08:23:30', '2025-10-16 08:23:30', NULL),
(39, 13, 'No definition available', NULL, '2025-10-16 08:37:33', '2025-10-16 08:37:33', NULL),
(40, 14, 'No definition available', NULL, '2025-10-16 08:46:33', '2025-10-16 08:46:33', NULL),
(41, 15, 'No definition available', NULL, '2025-10-16 08:47:06', '2025-10-16 08:47:06', NULL),
(42, 16, 'No definition available', NULL, '2025-10-16 08:53:32', '2025-10-16 08:53:32', NULL),
(43, 17, 'No definition available', NULL, '2025-10-16 08:55:16', '2025-10-16 08:55:16', NULL),
(44, 18, 'No definition available', NULL, '2025-10-16 09:03:05', '2025-10-16 09:03:05', NULL),
(45, 19, 'No definition available', NULL, '2025-10-16 09:05:37', '2025-10-16 09:05:37', NULL),
(46, 20, 'No definition available', NULL, '2025-10-16 11:42:15', '2025-10-16 11:42:15', NULL),
(47, 23, 'A person employed to perform computations; one who computes.', NULL, '2025-10-16 11:49:37', '2025-10-16 11:49:37', NULL),
(48, 23, '(by restriction) A male computer, where the female computer is called a computress.', NULL, '2025-10-16 11:49:37', '2025-10-16 11:49:37', NULL),
(49, 23, 'A programmable electronic device that performs mathematical calculations and logical operations, especially one that can process, store and retrieve large amounts of data very quickly; now especially, a small one for personal or home use employed for manipulating text or graphics, accessing the Internet, or playing games or media.', NULL, '2025-10-16 11:49:37', '2025-10-16 11:49:37', NULL),
(50, 25, 'No definition available', NULL, '2025-10-16 11:51:44', '2025-10-16 11:51:44', NULL),
(51, 26, 'No definition available', NULL, '2025-10-16 11:55:15', '2025-10-16 11:55:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `discussions`
--

CREATE TABLE `discussions` (
  `id` bigint UNSIGNED NOT NULL,
  `word_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `reply_count` int UNSIGNED NOT NULL DEFAULT '0',
  `like_count` int UNSIGNED NOT NULL DEFAULT '0',
  `dislike_count` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `is_deleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_pages`
--

CREATE TABLE `dynamic_pages` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `page_content` longtext,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `example_sentences`
--

CREATE TABLE `example_sentences` (
  `id` bigint UNSIGNED NOT NULL,
  `word_id` bigint UNSIGNED NOT NULL,
  `sentence` text NOT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_16_214246_add_two_factor_columns_to_users_table', 1),
(5, '2025_08_16_214309_create_personal_access_tokens_table', 1),
(6, '2025_08_20_190807_create_dynamic_pages_table', 1),
(7, '2025_08_23_174820_create_system_settings_table', 1),
(8, '2025_08_26_212011_create_permission_tables', 1),
(9, '2025_08_28_224149_add_description_and_is_active_to_roles_table', 1),
(10, '2025_08_28_224425_add_new_columns_to_roles_table', 1),
(11, '2025_10_03_000154_create_words_table', 1),
(12, '2025_10_03_000155_create_definitions_table', 1),
(13, '2025_10_03_000156_create_synonyms_table', 1),
(14, '2025_10_03_000157_create_antonyms_table', 1),
(15, '2025_10_03_000158_create_example_sentences_table', 1),
(16, '2025_10_03_000558_create_discussions_table', 1),
(17, '2025_10_03_000845_create_replies_table', 1),
(18, '2025_10_03_001051_create_reactions_table', 1),
(19, '2025_10_03_001436_create_system_notifications_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'guest-token', '053301d6d681c80796681ab749bc2958f7211230555169c812edab5ba847d210', '[\"*\"]', NULL, NULL, '2025-10-16 09:13:57', '2025-10-16 09:13:57'),
(2, 'App\\Models\\User', 2, 'guest-token', '03fe35ef200eb1441fab1d20ca667891807f8d281b081c2e017393f0ec2f2fc3', '[\"*\"]', NULL, NULL, '2025-10-16 09:35:49', '2025-10-16 09:35:49'),
(3, 'App\\Models\\User', 2, 'guest-token', '1d215223c98bcdae1846f51d15e2935ef07ad0f724b93ee22de08791ff093ea2', '[\"*\"]', NULL, NULL, '2025-10-16 09:35:55', '2025-10-16 09:35:55'),
(4, 'App\\Models\\User', 2, 'guest-token', 'ecb7e9571d0069383afa5f4c7b50941fe555ba56cfb9935bfe059f7607abeaa9', '[\"*\"]', NULL, NULL, '2025-10-16 09:35:57', '2025-10-16 09:35:57'),
(5, 'App\\Models\\User', 2, 'guest-token', 'c80436e645de30ca28e1a97704ba2b8cbc300c0f49f4b190c53a6ed5304b9eca', '[\"*\"]', NULL, NULL, '2025-10-16 09:35:58', '2025-10-16 09:35:58'),
(6, 'App\\Models\\User', 2, 'guest-token', '3e6279c0b63a10e12398a8c1d614cc5b092e78ac38e05760c804415449f6a706', '[\"*\"]', NULL, NULL, '2025-10-16 09:35:59', '2025-10-16 09:35:59'),
(7, 'App\\Models\\User', 2, 'guest-token', 'e3f9cc27eb08b515b7e5fd708f72110cfa7b348e38f7f2d49afa7baa53c015dc', '[\"*\"]', NULL, NULL, '2025-10-16 09:36:01', '2025-10-16 09:36:01'),
(8, 'App\\Models\\User', 2, 'guest-token', 'fe475fcf62643c89a8e5c74f3b15c737d331f5b920112263e03785c61066e790', '[\"*\"]', NULL, NULL, '2025-10-16 09:36:02', '2025-10-16 09:36:02'),
(9, 'App\\Models\\User', 3, 'guest-token', 'bd4189a258a30843eb8744a8b88b7cbdb703ce53cd05e588ff7aec84e66732ca', '[\"*\"]', NULL, NULL, '2025-10-16 09:36:15', '2025-10-16 09:36:15'),
(10, 'App\\Models\\User', 4, 'guest-token', 'cfa842bdd7b8b03d758041e483e61d8fd0d12af3683989500118249afee30c38', '[\"*\"]', '2025-10-16 09:36:50', NULL, '2025-10-16 09:36:19', '2025-10-16 09:36:50'),
(11, 'App\\Models\\User', 4, 'guest-token', '8c9e686515bfee9595b6d5f15efd67f25a6a66759644abe3b338bcb29180ed3b', '[\"*\"]', NULL, NULL, '2025-10-16 09:37:14', '2025-10-16 09:37:14'),
(12, 'App\\Models\\User', 4, 'guest-token', '0dfa36a2c49281b0df24ea08dc6d654c0fd5cae8b107d8b4e2713cf3eb54716f', '[\"*\"]', NULL, NULL, '2025-10-16 09:37:32', '2025-10-16 09:37:32'),
(13, 'App\\Models\\User', 5, 'guest-token', 'e615740f0d7b05df00265236b6d280ccba7c512495b2e6020b08ba9ad0c14362', '[\"*\"]', '2025-10-16 11:41:38', NULL, '2025-10-16 09:37:42', '2025-10-16 11:41:38'),
(14, 'App\\Models\\User', 2, 'guest-token', 'faa0880ec8bcdba3330e68cf0a455eb8c82539086e8a834bd6337632d1b11e68', '[\"*\"]', NULL, NULL, '2025-10-16 09:51:51', '2025-10-16 09:51:51'),
(15, 'App\\Models\\User', 2, 'guest-token', 'ce1ed9794093ac14953dac347514cfe4ea960f3e2aa84f4845bf82ffbbca7133', '[\"*\"]', NULL, NULL, '2025-10-16 09:52:08', '2025-10-16 09:52:08'),
(16, 'App\\Models\\User', 2, 'guest-token', '7958a92e3fa881da4f468a5de6a87ed3fb1fa715274851479d674f2fd2afc298', '[\"*\"]', NULL, NULL, '2025-10-16 09:52:09', '2025-10-16 09:52:09'),
(17, 'App\\Models\\User', 5, 'guest-token', 'f2557b0bec53ff25c60adb88113ed2c3f430d8eaf93a1efd203c3747ce82d1ac', '[\"*\"]', NULL, NULL, '2025-10-16 11:41:43', '2025-10-16 11:41:43');

-- --------------------------------------------------------

--
-- Table structure for table `reactions`
--

CREATE TABLE `reactions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `discussion_id` bigint UNSIGNED DEFAULT NULL,
  `reply_id` bigint UNSIGNED DEFAULT NULL,
  `reaction_type` enum('like','dislike') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` bigint UNSIGNED NOT NULL,
  `discussion_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `parent_reply_id` bigint UNSIGNED DEFAULT NULL,
  `message` text NOT NULL,
  `depth_level` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `reply_count` int UNSIGNED NOT NULL DEFAULT '0',
  `like_count` int UNSIGNED NOT NULL DEFAULT '0',
  `dislike_count` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `is_deleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `device_id` varchar(255) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `device_id`, `user_agent`, `payload`, `last_activity`) VALUES
('Igw3PjDveCTXyq9Emp7Vhnwhr1TSgUGYS3RkVK18', NULL, '172.16.200.34', NULL, 'PostmanRuntime/7.48.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieEE0ZFF0c3BzSE1mTHRyVFpsRjlpNW9ncWFPWkhMeG9XMWMxVktKNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xNzIuMTYuMjAwLjM0OjgwMDAvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1760629279),
('YLlfc494j1irLDZvZoUnUakFMUY9yJNKd40tPABW', 1, '172.16.200.34', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiVVVmQkhWc0wxTU83ZXl0aldnSTg1WGlDV05WNWJiTVZmMHUwbEhiZCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vMTcyLjE2LjIwMC4zNDo4MDAwL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTIkQWxHb3BXcm8xWlZzb2FRU1hxNTQvZXZ0OGNSM21nU0xjWGdSYmZPR0RucHo0bEVEeDZQM2kiO30=', 1760637342);

-- --------------------------------------------------------

--
-- Table structure for table `synonyms`
--

CREATE TABLE `synonyms` (
  `id` bigint UNSIGNED NOT NULL,
  `word_id` bigint UNSIGNED NOT NULL,
  `synonym` text NOT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `synonyms`
--

INSERT INTO `synonyms` (`id`, `word_id`, `synonym`, `published_at`, `created_at`, `updated_at`, `expires_at`) VALUES
(1, 5, 'Twinkie', NULL, '2025-10-16 07:45:10', '2025-10-16 07:45:10', NULL),
(2, 5, 'jook-sing', NULL, '2025-10-16 07:45:10', '2025-10-16 07:45:10', NULL),
(3, 7, 'pear tree', NULL, '2025-10-16 07:45:31', '2025-10-16 07:45:31', NULL),
(4, 23, '\'puter', NULL, '2025-10-16 11:49:37', '2025-10-16 11:49:37', NULL),
(5, 23, 'box', NULL, '2025-10-16 11:49:37', '2025-10-16 11:49:37', NULL),
(6, 23, 'calculator', NULL, '2025-10-16 11:49:37', '2025-10-16 11:49:37', NULL),
(7, 23, 'machine', NULL, '2025-10-16 11:49:37', '2025-10-16 11:49:37', NULL),
(8, 23, 'processor', NULL, '2025-10-16 11:49:37', '2025-10-16 11:49:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_notifications`
--

CREATE TABLE `system_notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `system_title` varchar(150) DEFAULT NULL,
  `system_short_title` varchar(100) DEFAULT NULL,
  `system_logo` varchar(255) NOT NULL DEFAULT 'uploads/systems/logo/logo.png',
  `system_favicon` varchar(255) NOT NULL DEFAULT 'uploads/systems/favicon/favicon.png',
  `company_name` varchar(100) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `timezone` varchar(50) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `copyright_text` text,
  `admin_title` varchar(150) DEFAULT NULL,
  `short_title` varchar(100) DEFAULT NULL,
  `admin_logo` varchar(255) NOT NULL DEFAULT 'uploads/admins/logo/logo.png',
  `admin_favicon` varchar(255) NOT NULL DEFAULT 'uploads/admins/favicon/favicon.png',
  `admin_copyright_text` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `system_title`, `system_short_title`, `system_logo`, `system_favicon`, `company_name`, `company_address`, `tagline`, `phone`, `email`, `timezone`, `language`, `copyright_text`, `admin_title`, `short_title`, `admin_logo`, `admin_favicon`, `admin_copyright_text`, `created_at`, `updated_at`) VALUES
(1, 'My Laravel System', 'LaravelSys', 'uploads/systems/logo/logo.png', 'uploads/systems/favicon/favicon.png', 'My Company Ltd.', 'Dhaka, Bangladesh', 'Best Laravel App', '+880123456789', 'admin@example.com', 'Asia/Dhaka', 'en', '© 2025 My Laravel System. All rights reserved.', 'Admin Panel', 'AdminSys', 'uploads/admins/logo/logo.png', 'uploads/admins/favicon/favicon.png', '© 2025 Admin Panel', '2025-10-16 07:43:32', '2025-10-16 07:43:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `two_factor_secret` text,
  `two_factor_recovery_codes` text,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `device_id` varchar(255) DEFAULT NULL,
  `is_guest` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_active` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `session_id`, `ip_address`, `device_id`, `is_guest`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `last_active`) VALUES
(1, 'Admin', 'admin@gmail.com', '2025-10-16 07:43:32', '$2y$12$AlGopWro1ZVsoaQSXq54/evt8cR3mgSLcXgRbfOGDnpz4lEDx6P3i', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'eJP97szBxA', NULL, NULL, '2025-10-16 07:43:32', '2025-10-16 07:43:32', NULL),
(2, 'G_user_1', NULL, NULL, NULL, NULL, NULL, NULL, '23456', '172.16.200.34', 'PostmanRuntime/7.48.0', 1, NULL, NULL, NULL, '2025-10-16 09:13:57', '2025-10-16 09:13:57', NULL),
(3, 'G_user_3', NULL, NULL, NULL, NULL, NULL, NULL, '234560', '172.16.200.34', 'PostmanRuntime/7.48.0', 1, NULL, NULL, NULL, '2025-10-16 09:36:15', '2025-10-16 09:36:15', NULL),
(4, 'G_user_4', NULL, NULL, NULL, NULL, NULL, NULL, '2345600', '172.16.200.34', 'PostmanRuntime/7.48.0', 1, NULL, NULL, NULL, '2025-10-16 09:36:19', '2025-10-16 09:36:19', NULL),
(5, 'Shakhawat Hossain', NULL, NULL, NULL, NULL, NULL, NULL, '45600', '172.16.200.34', 'PostmanRuntime/7.48.0', 1, NULL, NULL, NULL, '2025-10-16 09:37:42', '2025-10-16 09:41:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `words`
--

CREATE TABLE `words` (
  `id` bigint UNSIGNED NOT NULL,
  `word` varchar(255) NOT NULL,
  `pronunciation` text,
  `part_of_speech` text,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `words`
--

INSERT INTO `words` (`id`, `word`, `pronunciation`, `part_of_speech`, `published_at`, `created_at`, `updated_at`, `expires_at`) VALUES
(1, 'semisweet', NULL, 'adjective', '2025-10-16 07:44:26', '2025-10-16 07:44:26', '2025-10-16 07:44:26', NULL),
(2, 'selfness', NULL, 'noun', '2025-10-16 07:44:27', '2025-10-16 07:44:27', '2025-10-16 07:44:27', NULL),
(3, 'loricated', NULL, NULL, '2025-10-16 07:45:02', '2025-10-16 07:45:02', '2025-10-16 07:45:02', NULL),
(4, 'apple', '/ˈæp.əl/', 'noun', '2025-10-16 07:45:09', '2025-10-16 07:45:09', '2025-10-16 07:45:09', NULL),
(5, 'banana', '/bəˈnɑːnə/', 'noun', '2025-10-16 07:45:10', '2025-10-16 07:45:10', '2025-10-16 07:45:10', NULL),
(6, 'forgiver', NULL, NULL, '2025-10-16 07:45:29', '2025-10-16 07:45:29', '2025-10-16 07:45:29', NULL),
(7, 'pear', NULL, 'noun', '2025-10-16 07:45:31', '2025-10-16 07:45:31', '2025-10-16 07:45:31', NULL),
(8, 'diamagnets', NULL, NULL, '2025-10-16 07:48:13', '2025-10-16 07:48:13', '2025-10-16 07:48:13', NULL),
(9, 'fiddles', NULL, NULL, '2025-10-16 07:48:35', '2025-10-16 07:48:35', '2025-10-16 07:48:35', NULL),
(10, 'scuffles', NULL, NULL, '2025-10-16 07:49:28', '2025-10-16 07:49:28', '2025-10-16 07:49:28', NULL),
(11, 'jocose', NULL, NULL, '2025-10-16 08:17:32', '2025-10-16 08:17:32', '2025-10-16 08:17:32', NULL),
(12, 'transcendency', NULL, NULL, '2025-10-16 08:23:30', '2025-10-16 08:23:30', '2025-10-16 08:23:30', NULL),
(13, 'yogic', NULL, NULL, '2025-10-16 08:37:33', '2025-10-16 08:37:33', '2025-10-16 08:37:33', NULL),
(14, 'ministates', NULL, NULL, '2025-10-16 08:46:33', '2025-10-16 08:46:33', '2025-10-16 08:46:33', NULL),
(15, 'bravura', NULL, NULL, '2025-10-16 08:47:06', '2025-10-16 08:47:06', '2025-10-16 08:47:06', NULL),
(16, 'misassay', NULL, NULL, '2025-10-16 08:53:32', '2025-10-16 08:53:32', '2025-10-16 08:53:32', NULL),
(17, 'parkas', NULL, NULL, '2025-10-16 08:55:16', '2025-10-16 08:55:16', '2025-10-16 08:55:16', NULL),
(18, 'parklike', NULL, NULL, '2025-10-16 09:03:05', '2025-10-16 09:03:05', '2025-10-16 09:03:05', NULL),
(19, 'solicitously', NULL, NULL, '2025-10-16 09:05:37', '2025-10-16 09:05:37', '2025-10-16 09:05:37', NULL),
(20, 'phenoxy', NULL, NULL, '2025-10-16 11:42:15', '2025-10-16 11:42:15', '2025-10-16 11:42:15', NULL),
(23, 'computer', '/kəmˈpjuːtə/', 'noun', '2025-10-16 11:49:37', '2025-10-16 11:49:37', '2025-10-16 11:49:37', NULL),
(25, 'cat', NULL, NULL, '2025-10-16 11:51:44', '2025-10-16 11:51:44', '2025-10-16 11:51:44', NULL),
(26, 'carotinoids', NULL, NULL, '2025-10-16 11:55:15', '2025-10-16 11:55:15', '2025-10-16 11:55:15', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antonyms`
--
ALTER TABLE `antonyms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `antonyms_published_at_unique` (`published_at`),
  ADD KEY `antonyms_word_id_foreign` (`word_id`);
ALTER TABLE `antonyms` ADD FULLTEXT KEY `antonyms_antonym_fulltext` (`antonym`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `definitions`
--
ALTER TABLE `definitions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `definitions_published_at_unique` (`published_at`),
  ADD KEY `definitions_word_id_foreign` (`word_id`);
ALTER TABLE `definitions` ADD FULLTEXT KEY `definitions_definition_fulltext` (`definition`);

--
-- Indexes for table `discussions`
--
ALTER TABLE `discussions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discussions_word_id_foreign` (`word_id`),
  ADD KEY `discussions_user_id_foreign` (`user_id`);

--
-- Indexes for table `dynamic_pages`
--
ALTER TABLE `dynamic_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `example_sentences`
--
ALTER TABLE `example_sentences`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `example_sentences_published_at_unique` (`published_at`),
  ADD KEY `example_sentences_word_id_foreign` (`word_id`);
ALTER TABLE `example_sentences` ADD FULLTEXT KEY `example_sentences_sentence_fulltext` (`sentence`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `reactions`
--
ALTER TABLE `reactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reactions_user_id_discussion_id_reply_id_unique` (`user_id`,`discussion_id`,`reply_id`),
  ADD KEY `reactions_discussion_id_foreign` (`discussion_id`),
  ADD KEY `reactions_reply_id_foreign` (`reply_id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `replies_discussion_id_foreign` (`discussion_id`),
  ADD KEY `replies_user_id_foreign` (`user_id`),
  ADD KEY `replies_parent_reply_id_foreign` (`parent_reply_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `synonyms`
--
ALTER TABLE `synonyms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `synonyms_published_at_unique` (`published_at`),
  ADD KEY `synonyms_word_id_foreign` (`word_id`);
ALTER TABLE `synonyms` ADD FULLTEXT KEY `synonyms_synonym_fulltext` (`synonym`);

--
-- Indexes for table `system_notifications`
--
ALTER TABLE `system_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_session_id_unique` (`session_id`);

--
-- Indexes for table `words`
--
ALTER TABLE `words`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `words_word_unique` (`word`);
ALTER TABLE `words` ADD FULLTEXT KEY `words_word_fulltext` (`word`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antonyms`
--
ALTER TABLE `antonyms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `definitions`
--
ALTER TABLE `definitions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `discussions`
--
ALTER TABLE `discussions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dynamic_pages`
--
ALTER TABLE `dynamic_pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `example_sentences`
--
ALTER TABLE `example_sentences`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reactions`
--
ALTER TABLE `reactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `synonyms`
--
ALTER TABLE `synonyms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `system_notifications`
--
ALTER TABLE `system_notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `words`
--
ALTER TABLE `words`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `antonyms`
--
ALTER TABLE `antonyms`
  ADD CONSTRAINT `antonyms_word_id_foreign` FOREIGN KEY (`word_id`) REFERENCES `words` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `definitions`
--
ALTER TABLE `definitions`
  ADD CONSTRAINT `definitions_word_id_foreign` FOREIGN KEY (`word_id`) REFERENCES `words` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `discussions`
--
ALTER TABLE `discussions`
  ADD CONSTRAINT `discussions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `discussions_word_id_foreign` FOREIGN KEY (`word_id`) REFERENCES `words` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `example_sentences`
--
ALTER TABLE `example_sentences`
  ADD CONSTRAINT `example_sentences_word_id_foreign` FOREIGN KEY (`word_id`) REFERENCES `words` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reactions`
--
ALTER TABLE `reactions`
  ADD CONSTRAINT `reactions_discussion_id_foreign` FOREIGN KEY (`discussion_id`) REFERENCES `discussions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reactions_reply_id_foreign` FOREIGN KEY (`reply_id`) REFERENCES `replies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_discussion_id_foreign` FOREIGN KEY (`discussion_id`) REFERENCES `discussions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `replies_parent_reply_id_foreign` FOREIGN KEY (`parent_reply_id`) REFERENCES `replies` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `synonyms`
--
ALTER TABLE `synonyms`
  ADD CONSTRAINT `synonyms_word_id_foreign` FOREIGN KEY (`word_id`) REFERENCES `words` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
