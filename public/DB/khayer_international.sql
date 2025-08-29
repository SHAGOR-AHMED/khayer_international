-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 28, 2025 at 11:49 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `khayer_international`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `name`, `email`, `phone`, `address`, `image`, `status`, `created_at`, `updated_at`) VALUES
(15, 'BAHAR KSA', 'akhayerint@gmail.com', '01971002526', 'Gulf Tower (Level- 4/B), 30 Purana Paltan Line (Beside Hotel Victory), Dhaka-1000', NULL, 1, '2025-08-28 22:02:15', '2025-08-28 22:02:15'),
(16, 'SALAUDDIN GULF TRAVELS', 'CORNEROFEARTH007@GMAIL.COM', '01921685258', 'NARAYANGANJ', NULL, 1, '2025-08-28 22:03:08', '2025-08-28 22:03:08'),
(17, 'MIR HOSSEN BAI', 'AKHAYERINT@GAMIL.COM', '01841364074', '22GAON', NULL, 1, '2025-08-28 22:04:05', '2025-08-28 22:04:05'),
(18, 'MONIR BAI', 'AKOFFICEWORK2235@GMAIL.COM', '01711364074', 'CUMILLA', NULL, 1, '2025-08-28 22:04:56', '2025-08-28 22:04:56'),
(19, 'AZAD TALTO', 'JAHANGIR22@GMAIL.COM', '01757344097', 'LAKSAM', NULL, 1, '2025-08-28 22:05:25', '2025-08-28 22:05:25'),
(20, 'AZIZ NIZ', 'MDABDULAZIZBD000@GMAIL.COM', '01922577015', 'CUMILLA', NULL, 1, '2025-08-28 22:05:52', '2025-08-28 22:05:52'),
(21, 'LOKMAN', 'LOKMAN@GAMIL.COM', '01711254514', 'CUMILLA', NULL, 1, '2025-08-28 22:06:17', '2025-08-28 22:06:17'),
(22, 'SAKIB JEDDAH', 'SAKIB@GMAIL.COM', '01401399032', 'CUMILLA', NULL, 1, '2025-08-28 22:06:42', '2025-08-28 22:06:42');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int NOT NULL,
  `sortname` varchar(3) NOT NULL,
  `con_name` varchar(150) NOT NULL,
  `phonecode` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `sortname`, `con_name`, `phonecode`) VALUES
(1, 'AF', 'Afghanistan', 93),
(2, 'AL', 'Albania', 355),
(3, 'DZ', 'Algeria', 213),
(4, 'AS', 'American Samoa', 1684),
(5, 'AD', 'Andorra', 376),
(6, 'AO', 'Angola', 244),
(7, 'AI', 'Anguilla', 1264),
(8, 'AQ', 'Antarctica', 0),
(9, 'AG', 'Antigua And Barbuda', 1268),
(10, 'AR', 'Argentina', 54),
(11, 'AM', 'Armenia', 374),
(12, 'AW', 'Aruba', 297),
(13, 'AU', 'Australia', 61),
(14, 'AT', 'Austria', 43),
(15, 'AZ', 'Azerbaijan', 994),
(16, 'BS', 'Bahamas The', 1242),
(17, 'BH', 'Bahrain', 973),
(18, 'BD', 'Bangladesh', 880),
(19, 'BB', 'Barbados', 1246),
(20, 'BY', 'Belarus', 375),
(21, 'BE', 'Belgium', 32),
(22, 'BZ', 'Belize', 501),
(23, 'BJ', 'Benin', 229),
(24, 'BM', 'Bermuda', 1441),
(25, 'BT', 'Bhutan', 975),
(26, 'BO', 'Bolivia', 591),
(27, 'BA', 'Bosnia and Herzegovina', 387),
(28, 'BW', 'Botswana', 267),
(29, 'BV', 'Bouvet Island', 0),
(30, 'BR', 'Brazil', 55),
(31, 'IO', 'British Indian Ocean Territory', 246),
(32, 'BN', 'Brunei', 673),
(33, 'BG', 'Bulgaria', 359),
(34, 'BF', 'Burkina Faso', 226),
(35, 'BI', 'Burundi', 257),
(36, 'KH', 'Cambodia', 855),
(37, 'CM', 'Cameroon', 237),
(38, 'CA', 'Canada', 1),
(39, 'CV', 'Cape Verde', 238),
(40, 'KY', 'Cayman Islands', 1345),
(41, 'CF', 'Central African Republic', 236),
(42, 'TD', 'Chad', 235),
(43, 'CL', 'Chile', 56),
(44, 'CN', 'China', 86),
(45, 'CX', 'Christmas Island', 61),
(46, 'CC', 'Cocos (Keeling) Islands', 672),
(47, 'CO', 'Colombia', 57),
(48, 'KM', 'Comoros', 269),
(49, 'CG', 'Congo', 242),
(50, 'CD', 'Congo The Democratic Republic Of The', 242),
(51, 'CK', 'Cook Islands', 682),
(52, 'CR', 'Costa Rica', 506),
(53, 'CI', 'Cote D\'Ivoire (Ivory Coast)', 225),
(54, 'HR', 'Croatia (Hrvatska)', 385),
(55, 'CU', 'Cuba', 53),
(56, 'CY', 'Cyprus', 357),
(57, 'CZ', 'Czech Republic', 420),
(58, 'DK', 'Denmark', 45),
(59, 'DJ', 'Djibouti', 253),
(60, 'DM', 'Dominica', 1767),
(61, 'DO', 'Dominican Republic', 1809),
(62, 'TP', 'East Timor', 670),
(63, 'EC', 'Ecuador', 593),
(64, 'EG', 'Egypt', 20),
(65, 'SV', 'El Salvador', 503),
(66, 'GQ', 'Equatorial Guinea', 240),
(67, 'ER', 'Eritrea', 291),
(68, 'EE', 'Estonia', 372),
(69, 'ET', 'Ethiopia', 251),
(70, 'XA', 'External Territories of Australia', 61),
(71, 'FK', 'Falkland Islands', 500),
(72, 'FO', 'Faroe Islands', 298),
(73, 'FJ', 'Fiji Islands', 679),
(74, 'FI', 'Finland', 358),
(75, 'FR', 'France', 33),
(76, 'GF', 'French Guiana', 594),
(77, 'PF', 'French Polynesia', 689),
(78, 'TF', 'French Southern Territories', 0),
(79, 'GA', 'Gabon', 241),
(80, 'GM', 'Gambia The', 220),
(81, 'GE', 'Georgia', 995),
(82, 'DE', 'Germany', 49),
(83, 'GH', 'Ghana', 233),
(84, 'GI', 'Gibraltar', 350),
(85, 'GR', 'Greece', 30),
(86, 'GL', 'Greenland', 299),
(87, 'GD', 'Grenada', 1473),
(88, 'GP', 'Guadeloupe', 590),
(89, 'GU', 'Guam', 1671),
(90, 'GT', 'Guatemala', 502),
(91, 'XU', 'Guernsey and Alderney', 44),
(92, 'GN', 'Guinea', 224),
(93, 'GW', 'Guinea-Bissau', 245),
(94, 'GY', 'Guyana', 592),
(95, 'HT', 'Haiti', 509),
(96, 'HM', 'Heard and McDonald Islands', 0),
(97, 'HN', 'Honduras', 504),
(98, 'HK', 'Hong Kong S.A.R.', 852),
(99, 'HU', 'Hungary', 36),
(100, 'IS', 'Iceland', 354),
(101, 'IN', 'India', 91),
(102, 'ID', 'Indonesia', 62),
(103, 'IR', 'Iran', 98),
(104, 'IQ', 'Iraq', 964),
(105, 'IE', 'Ireland', 353),
(106, 'IL', 'Israel', 972),
(107, 'IT', 'Italy', 39),
(108, 'JM', 'Jamaica', 1876),
(109, 'JP', 'Japan', 81),
(110, 'XJ', 'Jersey', 44),
(111, 'JO', 'Jordan', 962),
(112, 'KZ', 'Kazakhstan', 7),
(113, 'KE', 'Kenya', 254),
(114, 'KI', 'Kiribati', 686),
(115, 'KP', 'Korea North', 850),
(116, 'KR', 'Korea South', 82),
(117, 'KW', 'Kuwait', 965),
(118, 'KG', 'Kyrgyzstan', 996),
(119, 'LA', 'Laos', 856),
(120, 'LV', 'Latvia', 371),
(121, 'LB', 'Lebanon', 961),
(122, 'LS', 'Lesotho', 266),
(123, 'LR', 'Liberia', 231),
(124, 'LY', 'Libya', 218),
(125, 'LI', 'Liechtenstein', 423),
(126, 'LT', 'Lithuania', 370),
(127, 'LU', 'Luxembourg', 352),
(128, 'MO', 'Macau S.A.R.', 853),
(129, 'MK', 'Macedonia', 389),
(130, 'MG', 'Madagascar', 261),
(131, 'MW', 'Malawi', 265),
(132, 'MY', 'Malaysia', 60),
(133, 'MV', 'Maldives', 960),
(134, 'ML', 'Mali', 223),
(135, 'MT', 'Malta', 356),
(136, 'XM', 'Man (Isle of)', 44),
(137, 'MH', 'Marshall Islands', 692),
(138, 'MQ', 'Martinique', 596),
(139, 'MR', 'Mauritania', 222),
(140, 'MU', 'Mauritius', 230),
(141, 'YT', 'Mayotte', 269),
(142, 'MX', 'Mexico', 52),
(143, 'FM', 'Micronesia', 691),
(144, 'MD', 'Moldova', 373),
(145, 'MC', 'Monaco', 377),
(146, 'MN', 'Mongolia', 976),
(147, 'MS', 'Montserrat', 1664),
(148, 'MA', 'Morocco', 212),
(149, 'MZ', 'Mozambique', 258),
(150, 'MM', 'Myanmar', 95),
(151, 'NA', 'Namibia', 264),
(152, 'NR', 'Nauru', 674),
(153, 'NP', 'Nepal', 977),
(154, 'AN', 'Netherlands Antilles', 599),
(155, 'NL', 'Netherlands The', 31),
(156, 'NC', 'New Caledonia', 687),
(157, 'NZ', 'New Zealand', 64),
(158, 'NI', 'Nicaragua', 505),
(159, 'NE', 'Niger', 227),
(160, 'NG', 'Nigeria', 234),
(161, 'NU', 'Niue', 683),
(162, 'NF', 'Norfolk Island', 672),
(163, 'MP', 'Northern Mariana Islands', 1670),
(164, 'NO', 'Norway', 47),
(165, 'OM', 'Oman', 968),
(166, 'PK', 'Pakistan', 92),
(167, 'PW', 'Palau', 680),
(168, 'PS', 'Palestinian Territory Occupied', 970),
(169, 'PA', 'Panama', 507),
(170, 'PG', 'Papua new Guinea', 675),
(171, 'PY', 'Paraguay', 595),
(172, 'PE', 'Peru', 51),
(173, 'PH', 'Philippines', 63),
(174, 'PN', 'Pitcairn Island', 0),
(175, 'PL', 'Poland', 48),
(176, 'PT', 'Portugal', 351),
(177, 'PR', 'Puerto Rico', 1787),
(178, 'QA', 'Qatar', 974),
(179, 'RE', 'Reunion', 262),
(180, 'RO', 'Romania', 40),
(181, 'RU', 'Russia', 70),
(182, 'RW', 'Rwanda', 250),
(183, 'SH', 'Saint Helena', 290),
(184, 'KN', 'Saint Kitts And Nevis', 1869),
(185, 'LC', 'Saint Lucia', 1758),
(186, 'PM', 'Saint Pierre and Miquelon', 508),
(187, 'VC', 'Saint Vincent And The Grenadines', 1784),
(188, 'WS', 'Samoa', 684),
(189, 'SM', 'San Marino', 378),
(190, 'ST', 'Sao Tome and Principe', 239),
(191, 'SA', 'Saudi Arabia', 966),
(192, 'SN', 'Senegal', 221),
(193, 'RS', 'Serbia', 381),
(194, 'SC', 'Seychelles', 248),
(195, 'SL', 'Sierra Leone', 232),
(196, 'SG', 'Singapore', 65),
(197, 'SK', 'Slovakia', 421),
(198, 'SI', 'Slovenia', 386),
(199, 'XG', 'Smaller Territories of the UK', 44),
(200, 'SB', 'Solomon Islands', 677),
(201, 'SO', 'Somalia', 252),
(202, 'ZA', 'South Africa', 27),
(203, 'GS', 'South Georgia', 0),
(204, 'SS', 'South Sudan', 211),
(205, 'ES', 'Spain', 34),
(206, 'LK', 'Sri Lanka', 94),
(207, 'SD', 'Sudan', 249),
(208, 'SR', 'Suriname', 597),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 47),
(210, 'SZ', 'Swaziland', 268),
(211, 'SE', 'Sweden', 46),
(212, 'CH', 'Switzerland', 41),
(213, 'SY', 'Syria', 963),
(214, 'TW', 'Taiwan', 886),
(215, 'TJ', 'Tajikistan', 992),
(216, 'TZ', 'Tanzania', 255),
(217, 'TH', 'Thailand', 66),
(218, 'TG', 'Togo', 228),
(219, 'TK', 'Tokelau', 690),
(220, 'TO', 'Tonga', 676),
(221, 'TT', 'Trinidad And Tobago', 1868),
(222, 'TN', 'Tunisia', 216),
(223, 'TR', 'Turkey', 90),
(224, 'TM', 'Turkmenistan', 7370),
(225, 'TC', 'Turks And Caicos Islands', 1649),
(226, 'TV', 'Tuvalu', 688),
(227, 'UG', 'Uganda', 256),
(228, 'UA', 'Ukraine', 380),
(229, 'AE', 'United Arab Emirates', 971),
(230, 'GB', 'United Kingdom', 44),
(231, 'US', 'United States', 1),
(232, 'UM', 'United States Minor Outlying Islands', 1),
(233, 'UY', 'Uruguay', 598),
(234, 'UZ', 'Uzbekistan', 998),
(235, 'VU', 'Vanuatu', 678),
(236, 'VA', 'Vatican City State (Holy See)', 39),
(237, 'VE', 'Venezuela', 58),
(238, 'VN', 'Vietnam', 84),
(239, 'VG', 'Virgin Islands (British)', 1284),
(240, 'VI', 'Virgin Islands (US)', 1340),
(241, 'WF', 'Wallis And Futuna Islands', 681),
(242, 'EH', 'Western Sahara', 212),
(243, 'YE', 'Yemen', 967),
(244, 'YU', 'Yugoslavia', 38),
(245, 'ZM', 'Zambia', 260),
(246, 'ZW', 'Zimbabwe', 263);

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE `entries` (
  `id` bigint UNSIGNED NOT NULL,
  `agent_id` bigint UNSIGNED DEFAULT NULL,
  `rl_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'RL1717',
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` bigint UNSIGNED DEFAULT NULL,
  `kopil_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pc_ref_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medical_report` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gcc_medical_report` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` enum('PENDING','EMBASSY','MANPOWER','COLLECT','DELIVERED') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `mofa_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visa_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visa_issued_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `finger_ttc_note` longtext COLLATE utf8mb4_unicode_ci,
  `manpower_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivered_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_returned` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_cause` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `entries`
--

INSERT INTO `entries` (`id`, `agent_id`, `rl_no`, `country`, `client_id`, `kopil_no`, `pc_ref_no`, `medical_report`, `gcc_medical_report`, `note`, `status`, `mofa_no`, `visa_no`, `visa_issued_date`, `finger_ttc_note`, `manpower_date`, `delivered_date`, `is_returned`, `return_cause`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 21, 'RL1717', 'Saudi Arabia', 23, '0555454545', '05056565', 'FIT', 'FIT', NULL, 'PENDING', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, '2025-08-28 22:43:06', '2025-08-28 22:43:06'),
(2, 17, 'RL1717', 'Saudi Arabia', 28, '0545858585', '45454545', 'FIT', 'FIT', NULL, 'PENDING', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, '2025-08-28 22:44:53', '2025-08-28 22:44:53'),
(3, 18, 'RL1717', 'Saudi Arabia', 27, '0565252565', '05254522', 'FIT', 'FIT', NULL, 'PENDING', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, '2025-08-28 22:45:36', '2025-08-28 22:45:36'),
(4, 19, 'RL1717', 'Saudi Arabia', 26, '055458/2565', '45258595', 'FIT', 'FIT', NULL, 'PENDING', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, '2025-08-28 22:46:13', '2025-08-28 22:46:13'),
(5, 18, 'RL1717', 'Saudi Arabia', 25, '05565654585', '45452565', 'FIT', 'FIT', NULL, 'PENDING', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, '2025-08-28 22:46:47', '2025-08-28 22:46:47'),
(6, 18, 'RL1717', 'Saudi Arabia', 24, '055458522441', '454545', 'FIT', 'FIT', NULL, 'PENDING', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, '2025-08-28 22:47:30', '2025-08-28 22:47:30'),
(7, 22, 'RL1717', 'Saudi Arabia', 22, '0555522222222', '55522252555', 'FIT', 'FIT', NULL, 'PENDING', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, '2025-08-28 22:48:13', '2025-08-28 22:48:13'),
(8, 15, 'RL1717', 'Saudi Arabia', 21, '056352441', '5555555555', 'FIT', 'FIT', NULL, 'PENDING', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, '2025-08-28 22:48:41', '2025-08-28 22:48:41');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 2),
(6, '2025_08_17_180356_create_clients_table', 3),
(7, '2025_08_18_133234_create_agents_table', 4),
(8, '2025_08_20_225455_create_entries_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_expired_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `passport_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_original_passport_given` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `status` tinyint NOT NULL DEFAULT '1',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_doc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `dob`, `passport_expired_date`, `email_verified_at`, `passport_no`, `is_original_passport_given`, `address`, `gender`, `password`, `type`, `status`, `image`, `passport_doc`, `remember_token`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Solaman Badsha', 'solaman@hotmail.co.uk', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '$2y$12$mOpRpVjMsySNEIe4.ckVU.cLQ8NWjY6sy5sEDNp2tbXH6LrZdvm4y', 'admin', 0, NULL, NULL, NULL, NULL, '', '2025-08-13 11:51:20', '2025-08-20 20:00:50'),
(2, 'Admin-Solaman Badsha', 'admin@example.com', '01814944730', NULL, NULL, NULL, NULL, NULL, 'Dhaka, Bangladesh', 1, '$2y$12$IYtMNEo1Redn3633fROB7uz9ZjwM1djInm//D7HD4G4CP5Jppo7TS', 'admin', 1, 'admin/userImage/shagor_formal.jpg', NULL, NULL, '1', '', '2025-08-14 11:03:56', '2025-08-27 23:09:22'),
(3, 'Manager User', 'manager@example.com', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '$2y$12$NJqCy65OiFHmoJFR2HpItue3wDjIr2ebjF7JcZqOxpSWMYNiK08B.', 'manager', 0, NULL, NULL, NULL, '2', '', '2025-08-14 11:03:56', '2025-08-20 20:03:21'),
(21, 'MD BELAYET HOSSAIN', 'AKTOURSINT@GMAIL.COM', '01816366220', '02-02-1984', '25-02-2026', NULL, 'A13386045', 'NO', 'FENI', 1, '$2y$12$pqoA9q0CXyN88Toxac./xO3ViPdtR9yT6zbkGnlFV8rHzjLzHd69W', 'user', 1, NULL, NULL, NULL, '2', NULL, '2025-08-28 22:11:48', '2025-08-28 22:11:48'),
(22, 'MD SHAKIL AHAMED SUMON', 'SUMON@GMAIL.COM', '01401399032', '03-04-1993', '01-10-2034', NULL, 'A09268795', 'NO', 'KUSHTIA', 1, '$2y$12$PMWYWAwsyv9JU.iDAacXduIMnYKiEdbfezUAma15pS1iUZKSq0pRC', 'user', 1, NULL, NULL, NULL, '2', NULL, '2025-08-28 22:14:00', '2025-08-28 22:14:00'),
(23, 'LOVELY YEASMIN', 'LOVELY@GAMIL.COM', '01706729412', '10-11-1984', '21-11-2027', NULL, 'A05824968', 'NO', 'KISHOREGANJ', 2, '$2y$12$GH33Mxh/QODzYfcOjL2dSOJxpBQjcooO/IbyxHjVIiQs44X4wmNby', 'user', 1, NULL, NULL, NULL, '2', NULL, '2025-08-28 22:15:22', '2025-08-28 22:15:22'),
(24, 'MUS AFTARUN NESA', 'MUS@GMAIL.COM', '01711254574', '10-04-1993', '16-12-2029', NULL, 'A17226146', 'NO', 'HABIGANJ', 2, '$2y$12$HOTHzHGyUO8.YuPo4Hy9ze8eBRO4XxQ4wKvpJ/5Jz8c4BcGE9mI96', 'user', 1, NULL, NULL, NULL, '2', NULL, '2025-08-28 22:16:30', '2025-08-28 22:16:30'),
(25, 'FARHANA AKTHER', 'FARHANA@GMAIL.COM', '01711584875', '01-03-1998', '30-07-2027', NULL, 'B00707422', 'NO', 'HABIGANJ', 2, '$2y$12$ak013T6XKRNXmJO.jRSXB.xOtgJOHGtpe3U/JTqvDgq8rgdSPmAh6', 'user', 1, NULL, NULL, NULL, '2', NULL, '2025-08-28 22:17:47', '2025-08-28 22:17:47'),
(26, 'JAHANGIR ALAM', 'JANGIR@GAMIL.COM', '01752457485', '05-03-1985', '07-06-2027', NULL, 'EK0587403', 'NO', 'CUMILLA', 1, '$2y$12$LQadHHyC2kxDihIoSgLjf.lVdhc.7WL0U/4A6DGC2uI7mOk.xqLAO', 'user', 1, NULL, NULL, NULL, '2', NULL, '2025-08-28 22:19:06', '2025-08-28 22:19:06'),
(27, 'MST MALEKA AKTER', 'MST@GMAIL.COM', '01819524174', '01-01-2000', '11-01-2030', NULL, 'A17526623', 'NO', 'HABIGANJ', 2, '$2y$12$IwqNrhAp7I8Y.dbnEcxiS.QPMpaoAU6LW8.LOwWIUguhSuNoZHNRC', 'user', 1, NULL, NULL, NULL, '2', NULL, '2025-08-28 22:20:04', '2025-08-28 22:20:04'),
(28, 'ABDUL AHAD', 'ABDUL@GMAIL.COM', '01922588471', '27-10-1988', '11-03-2035', NULL, 'A18277860', 'NO', 'SYLHET', 1, '$2y$12$U2xD1hC66evspUwj5Ytv5.29sNXqSofM/pEVaTdMo4zMOL/L1gZgq', 'user', 1, NULL, NULL, NULL, '2', NULL, '2025-08-28 22:21:11', '2025-08-28 22:21:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agents_phone_unique` (`phone`),
  ADD UNIQUE KEY `agents_email_unique` (`email`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entries_agent_id_foreign` (`agent_id`),
  ADD KEY `entries_client_id_foreign` (`client_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `entries`
--
ALTER TABLE `entries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `entries`
--
ALTER TABLE `entries`
  ADD CONSTRAINT `entries_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`),
  ADD CONSTRAINT `entries_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
