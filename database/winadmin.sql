-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2024 at 06:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `winadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_11_22_044401_create_personal_access_tokens_table', 2),
(5, '2024_11_22_050058_create_tasks_table', 2),
(6, '2024_11_22_050642_create_task_users_table', 2),
(7, '2024_11_23_024837_create_customer_columns', 3),
(8, '2024_11_23_024838_create_subscriptions_table', 3),
(9, '2024_11_23_024839_create_subscription_items_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('dC9OVc5jNvXsf06JhiDMM4tAFUYK7vxOgS7CuGX7', 52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiR25vcU0xQVlPeFdqNzNCUDZqdW9hRE1yT2hSTmRQRE52VGtxQzJCTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1MjtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3MzIzMzc5NjI7fX0=', 1732338106),
('k1QOfZvRBSgtSsj4rcplKVR76SMvizDWzLbQ5zKY', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiem1Wb1hjQjJLZ3VteURkTDd3Y3RIUG1vTWR2aTkwWTdtS285QVI0ZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvdGFza3MvMiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzMyMzAxMzcxO319', 1732308744);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `stripe_id` varchar(255) NOT NULL,
  `stripe_status` varchar(255) NOT NULL,
  `stripe_price` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_items`
--

CREATE TABLE `subscription_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` bigint(20) UNSIGNED NOT NULL,
  `stripe_id` varchar(255) NOT NULL,
  `stripe_product` varchar(255) NOT NULL,
  `stripe_price` varchar(255) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `priority` enum('High','Medium','Low') NOT NULL DEFAULT 'Medium',
  `is_completed` tinyint(1) NOT NULL DEFAULT 0,
  `is_paid` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `description`, `due_date`, `priority`, `is_completed`, `is_paid`, `created_at`, `updated_at`, `status`) VALUES
(2, 1, 'Task Management System', 'Task Management System\nTask Management System\nTask Management System\nTask Management System', '2024-11-22', 'High', 0, 0, '2024-11-22 01:50:10', '2024-11-22 22:01:30', 1),
(3, 1, 'This is test Task of system', 'This is test Task of systemThis is test Task of systemThis is test Task of systemThis is test Task of system This is test Task of system', '2024-11-15', 'Medium', 0, 0, '2024-11-22 02:18:38', '2024-11-22 14:51:31', 1),
(4, 1, 'Some task of updates', 'Some task of updates Some task of updates Some task of updates Some task of updatesSome task of updates', '2024-11-09', 'High', 0, 0, '2024-11-22 04:04:57', '2024-11-22 14:41:20', 1),
(8, 1, 'nmen e emene', 'nehdm sbckjsbcm cjkdscbksdcnk sdc', '2024-11-22', 'Medium', 1, 0, '2024-11-22 11:35:31', '2024-11-22 14:59:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `task_users`
--

CREATE TABLE `task_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_users`
--

INSERT INTO `task_users` (`id`, `user_id`, `task_id`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 2, NULL, NULL, 1),
(2, 2, 2, NULL, NULL, 1),
(3, 2, 3, NULL, NULL, 1),
(4, 12, 3, NULL, NULL, 1),
(5, 27, 3, NULL, NULL, 1),
(6, 50, 3, NULL, NULL, 1),
(7, 2, 4, NULL, NULL, 1),
(8, 5, 4, NULL, NULL, 1),
(19, 3, 2, NULL, NULL, 1),
(20, 5, 2, NULL, NULL, 1),
(21, 4, 8, NULL, NULL, 1),
(22, 5, 8, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(255) DEFAULT NULL,
  `pm_type` varchar(255) DEFAULT NULL,
  `pm_last_four` varchar(4) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `stripe_id`, `pm_type`, `pm_last_four`, `trial_ends_at`) VALUES
(1, 'nirmala', 'nirmalabandara96@gmail.com', NULL, '$2y$12$C9/2Sc4kQJqouVAfIfH5ie08Tk0qpilBP55vtVhFGLjRBsHWhe0h.', NULL, '2024-11-21 08:48:00', '2024-11-22 22:56:21', 'cus_RGiLsutBBSNm9D', 'visa', '4242', NULL),
(2, 'Marquise Fahey', 'jasmin.trantow@example.net', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'QY1ZMSryYE', '2024-11-22 00:36:14', '2024-11-22 00:36:14', NULL, NULL, NULL, NULL),
(3, 'Brooks Quigley', 'hane.pietro@example.com', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', '1YA6emwxd0', '2024-11-22 00:36:14', '2024-11-22 00:36:14', NULL, NULL, NULL, NULL),
(4, 'Prof. Dexter Batz', 'tillman.justyn@example.com', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'o2FaNAVEC3', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(5, 'Mitchell Kulas V', 'ashton.schumm@example.net', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'GHkz8VROLS', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(6, 'Prof. Pansy Gulgowski Jr.', 'orin.doyle@example.com', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'a5DnRvvbBh', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(7, 'Breanna Rempel', 'adam.mohr@example.net', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'RVfc8g5v3M', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(8, 'Josiane Schaefer', 'spencer.wisozk@example.org', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', '8PVnJ4XkKW', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(9, 'Prof. Kory Johnston I', 'sdubuque@example.com', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'gflO24LFz5', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(10, 'Marley Rohan', 'lavinia.vandervort@example.net', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'yICMgBkPNP', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(11, 'Sherwood Vandervort', 'anthony57@example.org', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'LMPzMQu7hL', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(12, 'Mr. Ruben Stoltenberg PhD', 'darion02@example.com', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'HKT7iW0paf', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(13, 'Prof. Torrey Walter', 'xbeer@example.org', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'ZkF0tK21uf', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(14, 'Prof. Brandy Kovacek DDS', 'cthompson@example.com', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', '1f8jOVelhj', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(15, 'Prof. Christopher Lueilwitz DDS', 'carroll.lurline@example.com', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', '7wiJglJYVm', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(16, 'Margot Jast DVM', 'finn02@example.com', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'pHpRgWrvcS', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(17, 'Prof. Sylvester Bergnaum', 'king52@example.net', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'yVdMOlolWG', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(18, 'Taya Bernhard', 'nluettgen@example.net', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'btnwzxIUqS', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(19, 'Ambrose Douglas', 'hilpert.amie@example.net', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', '2ubZeNb2oI', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(20, 'Berniece Koss', 'leannon.jesus@example.org', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'e75QtJ5OsF', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(21, 'Liliana Vandervort I', 'matilda.wuckert@example.org', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'gzHgzu1K81', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(22, 'Gust Okuneva', 'uschamberger@example.net', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'VhD9q9FSlN', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(23, 'Elliott Ward', 'zherman@example.org', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', '1Ny1OAIcLJ', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(24, 'Prof. Kitty Trantow', 'pmohr@example.com', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'QmKJAw4td3', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(25, 'Marvin Kunze', 'orath@example.org', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'YkJcKGTJdb', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(26, 'Oswald Kub', 'elmo44@example.org', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'YSIf8irfMs', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(27, 'Justus Hahn DDS', 'larkin.jon@example.org', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'vIMpgJyQEE', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(28, 'Mrs. Karen Weissnat DDS', 'sven.schimmel@example.com', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'OLMKgjdhmU', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(29, 'Hermina McDermott', 'hansen.elaina@example.net', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'CDB5kLA6zU', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(30, 'Gabe Runte', 'josephine.okuneva@example.net', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', '2x5MCsWlRr', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(31, 'Kylie Durgan', 'bauch.aliya@example.net', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'XMbmvse2Tx', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(32, 'Prof. Eva Kiehn', 'darron.weissnat@example.net', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', '4Wg3vICSrW', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(33, 'Ayana Schumm I', 'gaylord.mylene@example.com', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'ok331limjf', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(34, 'Korbin Smitham PhD', 'hherzog@example.net', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'GW2JAkiwVn', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(35, 'Mrs. Marjory Reilly', 'gmayer@example.org', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'HOazdhNSZL', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(36, 'Tremaine Brekke', 'schoen.pearl@example.com', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'b6fWtVvk86', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(37, 'Mckenna Gusikowski', 'christa.greenholt@example.com', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'XPzWeaWWqZ', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(38, 'Ms. Bettie Monahan', 'robbie.borer@example.net', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'bTIKC2Fxjx', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(39, 'Ova Douglas', 'deja84@example.com', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'xpZofettFX', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(40, 'Shaylee Kemmer', 'mosinski@example.com', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'zKw1JekZ5O', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(41, 'Delores Harvey', 'davonte.breitenberg@example.org', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'pr2gCiPJAd', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(42, 'Murphy Cassin', 'obie15@example.net', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'Jwsnqyl8rh', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(43, 'King Steuber', 'cynthia.bashirian@example.net', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'Xy4GSP9yz8', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(44, 'Nikolas Muller', 'sharvey@example.net', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'ldKphTiD5I', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(45, 'Mrs. Lottie Zulauf I', 'treutel.zelma@example.net', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'FZAiminUAg', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(46, 'Quinten Adams', 'nico66@example.org', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'sQSjiYCHiw', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(47, 'Mr. Johann Keebler III', 'aeichmann@example.net', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'xIhHKqfu7Z', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(48, 'Dr. Cecilia Hickle', 'sydni41@example.com', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'ODO8XQOedC', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(49, 'Jean Heidenreich', 'maximo.halvorson@example.com', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'XMLNPreinB', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(50, 'Zakary Grady', 'woodrow94@example.com', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'pUmNyHFNnZ', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(51, 'Adriel Sporer DDS', 'dyundt@example.com', '2024-11-22 00:36:14', '$2y$12$4CP6R3.B5Gowz7coQHupcef0bedCmznkO4ubHjnBBgOs1O4SAxBi2', 'IrdW5xb30I', '2024-11-22 00:36:15', '2024-11-22 00:36:15', NULL, NULL, NULL, NULL),
(52, 'admin', 'admin@sample.com', NULL, '$2y$12$bluWAjWfmG1dpyJ9qCpSxeLDeMTtWcQgXzJ2mA8UK1iW798F7PwhW', NULL, '2024-11-22 23:28:21', '2024-11-22 23:28:21', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscriptions_stripe_id_unique` (`stripe_id`),
  ADD KEY `subscriptions_user_id_stripe_status_index` (`user_id`,`stripe_status`);

--
-- Indexes for table `subscription_items`
--
ALTER TABLE `subscription_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscription_items_stripe_id_unique` (`stripe_id`),
  ADD KEY `subscription_items_subscription_id_stripe_price_index` (`subscription_id`,`stripe_price`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_users`
--
ALTER TABLE `task_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_users_user_id_foreign` (`user_id`),
  ADD KEY `task_users_task_id_foreign` (`task_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_stripe_id_index` (`stripe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_items`
--
ALTER TABLE `subscription_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `task_users`
--
ALTER TABLE `task_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `task_users`
--
ALTER TABLE `task_users`
  ADD CONSTRAINT `task_users_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
