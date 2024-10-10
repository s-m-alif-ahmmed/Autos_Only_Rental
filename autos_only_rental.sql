-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2024 at 01:10 PM
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
-- Database: `autos_only_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `car_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `pickup_location` text DEFAULT NULL,
  `drop_location` text DEFAULT NULL,
  `pickup_date` date DEFAULT NULL,
  `drop_date` date DEFAULT NULL,
  `package` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Current' COMMENT 'Current/Completed/Canceled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `car_id`, `name`, `email`, `number`, `pickup_location`, `drop_location`, `pickup_date`, `drop_date`, `package`, `price`, `status`, `created_at`, `updated_at`) VALUES
(51, 2, 7, 'S M Alif Ahmmed', 'test@test.com', '01700000000', 'Tejgaon', 'Tejgaon', '2024-10-01', '2024-10-10', 'Rent Per Day', 200, 'Current', '2024-10-09 04:12:30', '2024-10-09 04:12:30');

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
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `drop_location` text DEFAULT NULL,
  `car_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slider_image` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `person` int(11) DEFAULT NULL,
  `seat` int(11) DEFAULT NULL,
  `engine_type` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `day_price` int(11) DEFAULT NULL,
  `week_price` int(11) DEFAULT NULL,
  `month_price` int(11) DEFAULT NULL,
  `is_available` varchar(255) DEFAULT 'No',
  `car_slug` varchar(255) DEFAULT NULL,
  `view` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Published' COMMENT 'Published/Draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `location_id`, `drop_location`, `car_type_id`, `name`, `slider_image`, `image`, `alt`, `quantity`, `person`, `seat`, `engine_type`, `description`, `day_price`, `week_price`, `month_price`, `is_available`, `car_slug`, `view`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, '[\"Khilgaon\"]', 3, 'Hyundai Tucson Accent', 'backend/images/car/slider-images/42345_car1.png', 'backend/images/car/car/60145_car4.png', 'hyundai-tucson-accent', 2, 5, 6, 'Petrol', '<h3>Refueling</h3>\r\n\r\n<p>Meh synth Schlitz, tempor duis single-origin coffee ea next level ethnic fingerstache fanny pack nostrud. Photo booth anim 8-bit hella, PBR 3 wolf moon beard Helvetica. Salvia esse nihil, flexitarian Truffaut synth art party deep v chillwave. Seitan High Life reprehenderit consectetur cupidatat kogi. Et leggings fanny pack, elit bespoke vinyl art party Pitchfork selfies master cleanse.</p>\r\n\r\n<h3>Car Wash</h3>\r\n\r\n<p>Craft beer elit seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa eiusmod Pinterest in do umami readymade swag. Selfies iPhone Kickstarter, drinking vinegar jean vinegar stumptown yr pop-up artisan sunt. Craft beer elit seitan exercitation, photo booth</p>\r\n\r\n<h3>No Smoking</h3>\r\n\r\n<p>Craft beer elit seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa eiusmod Pinterest in do umami readymade swag. Selfies iPhone Kickstarter, drinking vinegar jean vinegar stumptown yr pop-up artisan sunt. Craft beer elit seitan exercitation, photo booth</p>', 20, 600, 2000, 'No', '34808-hyundai-tucson-accent', NULL, 'Published', '2024-09-29 03:30:05', '2024-10-01 20:51:31'),
(3, 3, '[\"Tejgaon\",\"Banani\",\"Gulshan\"]', 4, 'Hyundai Tucson Accent', 'backend/images/car/slider-images/64268_car2.png', 'backend/images/car/car/86731_car5.png', 'hyundai-tucson-accent', 2, 5, 6, 'Petrol', '<p>&nbsp;dsfsdfd sfs fdsf&nbsp;</p>', 25, 700, 2500, 'No', '22621-hyundai-tucson-accent', NULL, 'Published', '2024-09-29 04:46:07', '2024-10-01 20:51:26'),
(4, 2, '[\"Khilgaon\",\"Banani\",\"Badda\"]', 3, 'Hyundai Tucson Accent', 'backend/images/car/slider-images/38857_car3.png', 'backend/images/car/car/95799_car6.png', 'hyundai-tucson-accent', 2, 5, 6, 'Petrol', '<p>&nbsp;sdfsdf sdf sdf sfs f</p>', 20, 600, 2000, 'Yes', '52826-hyundai-tucson-accent', NULL, 'Published', '2024-09-29 04:50:34', '2024-10-01 20:51:17'),
(5, 4, '[\"Tejgaon\",\"Khilgaon\",\"Gulshan\"]', 1, 'Hyundai Tucson Accent new', 'backend/images/car/slider-images/25690_car1.png', 'backend/images/car/car/93760_car7.png', 'hyundai-tucson-accent-new', 2, 5, 6, 'Petrol', '<p>s dfsfdsf sdfds fs</p>', 20, 600, 2000, 'No', '24832-hyundai-tucson-accent-new', NULL, 'Published', '2024-09-29 04:51:16', '2024-10-02 01:09:19'),
(6, 1, '[\"Tejgaon\",\"Banani\",\"Gulshan\"]', 1, 'Hyundai Tucson Accent test', 'backend/images/car/slider-images/21815_car1.png', 'backend/images/car/car/54526_car9.png', 'hyundai-tucson-accent-test', 2, 5, 6, 'Petrol', '<p>test</p>', 25, 700, 2500, 'Yes', '10525-hyundai-tucson-accent-test', NULL, 'Published', '2024-09-29 21:14:39', '2024-10-01 04:51:00'),
(7, 5, '[\"Tejgaon\",\"Khilgaon\",\"Banani\",\"Badda\",\"Gulshan\"]', 4, 'Hyundai Tucson Car', 'backend/images/car/slider-images/82670_car3.png', 'backend/images/car/car/32602_car8.png', 'hyundai-tucson-car', 2, 5, 6, 'Petrol', '<p>car</p>', 20, 600, 2000, 'Yes', '30986-hyundai-tucson-car', NULL, 'Published', '2024-10-01 04:39:17', '2024-10-01 04:39:17');

-- --------------------------------------------------------

--
-- Table structure for table `car_types`
--

CREATE TABLE `car_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `car_type_slug` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Published' COMMENT 'Published/Draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `car_types`
--

INSERT INTO `car_types` (`id`, `name`, `car_type_slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Van', 'van', 'Published', '2024-09-29 02:27:55', '2024-09-29 02:29:41'),
(3, 'Private Car', 'private-car', 'Published', '2024-10-01 04:17:33', '2024-10-01 04:17:33'),
(4, 'Zeep', 'zeep', 'Published', '2024-10-01 04:17:46', '2024-10-01 04:18:04');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `number`, `message`, `note`, `status`, `created_at`, `updated_at`) VALUES
(3, 'S M Alif Ahmmed', 'admin@admin.com', '01700000001', 'dsf dsf sf', NULL, 'Unread', '2024-09-30 00:31:19', '2024-09-30 00:31:19'),
(4, 'S M Alif Ahmmed', 'admin@admin.com', '01700000001', 'as dad asdad', NULL, 'Unread', '2024-09-30 01:01:22', '2024-09-30 01:01:22');

-- --------------------------------------------------------

--
-- Table structure for table `cookie_policies`
--

CREATE TABLE `cookie_policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cookie_policy` longtext DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Published' COMMENT 'Published/Draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_pages`
--

CREATE TABLE `dynamic_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `page_slug` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dynamic_pages`
--

INSERT INTO `dynamic_pages` (`id`, `title`, `content`, `page_slug`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Contact', '<p>Contact Page</p>', 'contact', 'Published', '2024-10-08 00:12:49', '2024-10-08 00:12:49');

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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Published' COMMENT 'Published/Draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `status`, `created_at`, `updated_at`) VALUES
(1, 'What cars do you have in your inventory?', 'Lorem ipsum dolor sit amet consectetur. Integer facilisi sit tortor lobortis amet. Risus vestibulum nec fringilla sed in tincidunt tempus porta. Vulputate ornare vitae turpis mauris. What cars do you have in your inventory?', 'Published', '2024-09-29 23:22:28', '2024-09-29 23:30:17'),
(2, 'What cars do you have in your inventory1?', 'Lorem ipsum dolor sit amet consectetur. Integer facilisi sit tortor lobortis amet. Risus vestibulum nec fringilla sed in tincidunt tempus porta. Vulputate ornare vitae turpis mauris.', 'Published', '2024-09-29 23:32:10', '2024-09-29 23:32:10'),
(3, 'What cars do you have in your inventory2?', 'Lorem ipsum dolor sit amet consectetur. Integer facilisi sit tortor lobortis amet. Risus vestibulum nec fringilla sed in tincidunt tempus porta. Vulputate ornare vitae turpis mauris.', 'Published', '2024-09-29 23:32:33', '2024-09-29 23:32:33'),
(4, 'What cars do you have in your inventory3?', 'Lorem ipsum dolor sit amet consectetur. Integer facilisi sit tortor lobortis amet. Risus vestibulum nec fringilla sed in tincidunt tempus porta. Vulputate ornare vitae turpis mauris.', 'Published', '2024-09-29 23:32:43', '2024-09-29 23:32:43'),
(5, 'What cars do you have in your inventory5?', 'Lorem ipsum dolor sit amet consectetur. Integer facilisi sit tortor lobortis amet. Risus vestibulum nec fringilla sed in tincidunt tempus porta. Vulputate ornare vitae turpis mauris.', 'Published', '2024-09-29 23:32:54', '2024-09-29 23:32:54');

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
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `location_slug` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Published' COMMENT 'Published/Draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location`, `location_slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Gulshan', 'gulshan', 'Published', '2024-09-29 02:27:40', '2024-09-29 02:27:40'),
(2, 'Badda', 'badda', 'Published', '2024-10-01 04:18:19', '2024-10-01 04:18:19'),
(3, 'Banani', 'banani', 'Published', '2024-10-01 04:18:32', '2024-10-01 04:18:32'),
(4, 'Khilgaon', 'khilgaon', 'Published', '2024-10-01 04:19:06', '2024-10-01 04:19:06'),
(5, 'Tejgaon', 'tejgaon', 'Published', '2024-10-01 04:19:20', '2024-10-01 04:19:20');

-- --------------------------------------------------------

--
-- Table structure for table `logos`
--

CREATE TABLE `logos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` text DEFAULT NULL,
  `slogan` text DEFAULT NULL,
  `copyright` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(4, '2024_09_28_044023_create_why_choose_contents_table', 1),
(5, '2024_09_28_044024_create_logos_table', 1),
(6, '2024_09_28_044025_create_locations_table', 1),
(7, '2024_09_28_044027_create_cars_table', 1),
(8, '2024_09_28_044028_create_more_images_table', 1),
(9, '2024_09_28_044029_create_faqs_table', 1),
(10, '2024_09_28_044031_create_cookie_policies_table', 1),
(11, '2024_09_28_044032_create_reviews_table', 1),
(12, '2024_09_28_044033_create_contacts_table', 1),
(13, '2024_09_28_044034_create_terms_table', 1),
(14, '2024_09_28_044036_create_bookings_table', 1),
(15, '2024_09_28_044037_create_privacy_policies_table', 1),
(16, '2024_09_29_065549_create_car_types_table', 1),
(17, '2024_10_08_044555_create_dynamic_pages_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `more_images`
--

CREATE TABLE `more_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `car_id` bigint(20) UNSIGNED DEFAULT NULL,
  `more_image` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `more_images`
--

INSERT INTO `more_images` (`id`, `car_id`, `more_image`, `created_at`, `updated_at`) VALUES
(7, 3, 'backend/images/car/more-images/99464.png', '2024-09-29 04:46:07', '2024-09-29 04:46:07'),
(8, 3, 'backend/images/car/more-images/17881.png', '2024-09-29 04:46:07', '2024-09-29 04:46:07'),
(9, 3, 'backend/images/car/more-images/21796.png', '2024-09-29 04:46:07', '2024-09-29 04:46:07'),
(10, 3, 'backend/images/car/more-images/63626.png', '2024-09-29 04:46:07', '2024-09-29 04:46:07'),
(14, 5, 'backend/images/car/more-images/29300.png', '2024-09-29 04:51:16', '2024-09-29 04:51:16'),
(15, 5, 'backend/images/car/more-images/69386.png', '2024-09-29 04:51:16', '2024-09-29 04:51:16'),
(16, 5, 'backend/images/car/more-images/9896.png', '2024-09-29 04:51:16', '2024-09-29 04:51:16'),
(17, 5, 'backend/images/car/more-images/71262.png', '2024-09-29 04:51:16', '2024-09-29 04:51:16'),
(25, 6, 'backend/images/car/more-images/15947.png', '2024-09-29 21:21:10', '2024-09-29 21:21:10'),
(26, 6, 'backend/images/car/more-images/39956.png', '2024-09-29 21:21:10', '2024-09-29 21:21:10'),
(27, 6, 'backend/images/car/more-images/50924.png', '2024-09-29 21:21:10', '2024-09-29 21:21:10'),
(28, 4, 'backend/images/car/more-images/5827.png', '2024-09-29 21:21:22', '2024-09-29 21:21:22'),
(29, 4, 'backend/images/car/more-images/88708.png', '2024-09-29 21:21:22', '2024-09-29 21:21:22'),
(30, 4, 'backend/images/car/more-images/38441.png', '2024-09-29 21:21:22', '2024-09-29 21:21:22'),
(31, 1, 'backend/images/car/more-images/93141.png', '2024-09-29 21:22:14', '2024-09-29 21:22:14'),
(32, 1, 'backend/images/car/more-images/97547.png', '2024-09-29 21:22:14', '2024-09-29 21:22:14'),
(33, 1, 'backend/images/car/more-images/23723.png', '2024-09-29 21:22:14', '2024-09-29 21:22:14'),
(34, 7, 'backend/images/car/more-images/8932.png', '2024-10-01 04:39:17', '2024-10-01 04:39:17'),
(35, 7, 'backend/images/car/more-images/50204.png', '2024-10-01 04:39:17', '2024-10-01 04:39:17'),
(36, 7, 'backend/images/car/more-images/2500.png', '2024-10-01 04:39:17', '2024-10-01 04:39:17'),
(37, 7, 'backend/images/car/more-images/62840.png', '2024-10-01 04:39:17', '2024-10-01 04:39:17');

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
-- Table structure for table `privacy_policies`
--

CREATE TABLE `privacy_policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `privacy_policy` longtext DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Published' COMMENT 'Published/Draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `car_id` bigint(20) UNSIGNED DEFAULT NULL,
  `booking_id` bigint(20) UNSIGNED DEFAULT NULL,
  `star` int(11) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Published' COMMENT 'Published/Draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `car_id`, `booking_id`, `star`, `review`, `status`, `created_at`, `updated_at`) VALUES
(11, 2, 7, 51, 5, 'Good', 'Published', '2024-10-09 04:12:43', '2024-10-09 04:12:43'),
(12, 2, 7, 51, 3, 'sadfsad', 'Published', '2024-10-09 04:31:56', '2024-10-09 04:31:56'),
(13, 2, 7, 51, 4, 'ad sad ad', 'Published', '2024-10-09 04:32:02', '2024-10-09 04:32:02');

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
('o4iySFPSxxw1iQQEjnKJ7SYsOIL9HYWIDVfFrgr3', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUnNpTk5xUVZGNTcyVllRQ0FreW9sV293WXhuUzVRR0s4ZWdyWkRmeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXItbGlzdGluZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1728470451);

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `term` longtext DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Published' COMMENT 'Published/Draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `role` varchar(255) DEFAULT 'User',
  `permission` text DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `photo`, `number`, `address`, `role`, `permission`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '01700000001', 'Badda, Gulshan', 'Admin', NULL, NULL, '$2y$12$eFHQDzBADNsDoLnsVv3hKusKyTWR/y6s2joTPjWemTUhdp/YPj8cu', NULL, '2024-09-29 02:26:15', '2024-09-29 02:26:15'),
(2, 'S M Alif Ahmmed', 'test@test.com', NULL, '01700000000', 'Badda, Gulshan', 'User', NULL, NULL, '$2y$12$U/HS0W3KrqdmH.Zrs4IdIOlsq3kR9uJE5DRfsVd.IsRjyNtwxyqWK', NULL, '2024-09-30 21:32:42', '2024-09-30 21:32:42'),
(4, 'S M Alif Ahmmed', 'smalifahmmed@gmail.com', NULL, '01700000005', 'Badda, Gulshan', 'User', NULL, NULL, '$2y$12$PuGQ7YXmSbeIZj0OWj4rDO26eRNlhZTadO9ETEX3EErQt69cGavfi', NULL, '2024-10-02 22:50:29', '2024-10-02 22:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `why_choose_contents`
--

CREATE TABLE `why_choose_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Published' COMMENT 'Published/Draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_types`
--
ALTER TABLE `car_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cookie_policies`
--
ALTER TABLE `cookie_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dynamic_pages`
--
ALTER TABLE `dynamic_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logos`
--
ALTER TABLE `logos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `more_images`
--
ALTER TABLE `more_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `why_choose_contents`
--
ALTER TABLE `why_choose_contents`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `car_types`
--
ALTER TABLE `car_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cookie_policies`
--
ALTER TABLE `cookie_policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dynamic_pages`
--
ALTER TABLE `dynamic_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `logos`
--
ALTER TABLE `logos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `more_images`
--
ALTER TABLE `more_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `why_choose_contents`
--
ALTER TABLE `why_choose_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
