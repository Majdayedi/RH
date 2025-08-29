-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2025 at 04:24 PM
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
-- Database: `rh_project`
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
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` char(36) NOT NULL,
  `legal_name` varchar(255) NOT NULL,
  `trade_name` varchar(255) DEFAULT NULL,
  `registration_number` varchar(255) NOT NULL,
  `tax_id` varchar(255) NOT NULL,
  `incorporation_date` date NOT NULL,
  `legal_structure` varchar(255) NOT NULL,
  `jurisdiction` varchar(255) NOT NULL,
  `industry` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `headquarters_address` text NOT NULL,
  `country` varchar(2) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `certificate_of_incorporation` varchar(255) DEFAULT NULL,
  `tax_registration_certificate` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `legal_name`, `trade_name`, `registration_number`, `tax_id`, `incorporation_date`, `legal_structure`, `jurisdiction`, `industry`, `is_active`, `headquarters_address`, `country`, `phone`, `email`, `website`, `certificate_of_incorporation`, `tax_registration_certificate`, `logo`, `created_at`, `updated_at`) VALUES
('0198e7b6-4029-71b4-9651-9a84869c8927', 'Jacobi-Runolfsson', 'LLC', 'REG-30644', 'TAX-46586', '2014-02-04', 'pariatur', 'Tokelau', 'nam', 1, '6934 Blair Underpass\nLake Tressaberg, MO 42113', 'NZ', '540-973-5093', 'magali.hoppe@example.org', 'http://thiel.com/sint-expedita-veniam-hic-natus-voluptatem-asperiores.html', 'scurl', 'stl', 'company/logos/barca.webp', '2025-08-26 17:48:57', '2025-08-26 17:48:57'),
('0198e7b6-40b1-7205-9e69-a44dba5b882d', 'Pagac Ltd', 'PLC', 'REG-77497', 'TAX-21495', '2000-10-28', 'quia', 'Fiji', 'odit', 1, '6304 Germaine Motorway Apt. 676\nLaviniaberg, NJ 99622', 'CD', '626-376-0342', 'jarvis.emmerich@example.com', 'http://ruecker.org/', '3g2', 'unityweb', 'company/logos/samsung.png', '2025-08-26 17:48:57', '2025-08-26 17:48:57'),
('0198e7b6-40b3-72be-bc00-e595269fe215', 'Towne, Maggio and Stroman', 'Group', 'REG-82029', 'TAX-74429', '2010-05-08', 'qui', 'Italy', 'rerum', 1, '247 Florence Courts\nWelchborough, MN 27181-9661', 'LV', '+1-980-200-2791', 'jbaumbach@example.org', 'http://bartell.com/neque-officiis-aspernatur-reprehenderit-dicta-nesciunt-et-totam', 'kpt', 'ecma', 'company/logos/microsoft.png', '2025-08-26 17:48:57', '2025-08-26 17:48:57'),
('0198e7b6-40b4-7101-87de-fe11c6c97578', 'Borer Group', 'Group', 'REG-70055', 'TAX-65891', '1991-12-17', 'quis', 'American Samoa', 'exercitationem', 1, '855 Gulgowski Plains Suite 561\nWest Buck, AR 12070-2107', 'NF', '+1-878-414-7419', 'mack.zulauf@example.org', 'http://www.bogisich.info/distinctio-quis-in-natus-amet-necessitatibus-quia-dolores-atque', 'wmlc', 'gca', 'company/logos/samsung.png', '2025-08-26 17:48:57', '2025-08-26 17:48:57'),
('0198e7b6-40b5-7160-8cdd-8aace8ff1902', 'Heaney Inc', 'Ltd', 'REG-58737', 'TAX-04723', '2008-12-19', 'consequatur', 'French Polynesia', 'enim', 1, '4022 Greenfelder Bridge\nPort Tyree, FL 71006', 'CK', '475-940-8159', 'kenton61@example.net', 'http://kuphal.com/nostrum-veniam-beatae-necessitatibus-modi', 'rdz', 'eot', 'company/logos/microsoft.png', '2025-08-26 17:48:57', '2025-08-26 17:48:57'),
('0198e7b6-40b6-73da-a331-3709100c7b9c', 'Schinner, Dibbert and Block', 'LLC', 'REG-05236', 'TAX-07708', '1974-12-02', 'vel', 'Christmas Island', 'doloribus', 1, '852 Nina Dam\nIsabellehaven, AR 36143', 'TT', '1-559-559-1817', 'turcotte.joany@example.org', 'https://www.walsh.com/iusto-itaque-inventore-possimus-libero', 'iges', 'xdp', 'company/logos/samsung.png', '2025-08-26 17:48:57', '2025-08-26 17:48:57'),
('0198e7b6-40b8-7031-b875-4c80f20cfb76', 'Halvorson-Hand', 'and Sons', 'REG-83078', 'TAX-48802', '1978-10-08', 'quas', 'Belgium', 'magnam', 1, '67840 Rice Crossroad Apt. 854\nDarienshire, ME 19371-2701', 'BT', '1-956-461-5159', 'elmo21@example.com', 'http://www.kris.com/corporis-ea-fugit-asperiores-voluptatem', 'see', 'fpx', 'company/logos/asm.png', '2025-08-26 17:48:57', '2025-08-26 17:48:57'),
('0198e7b6-40ba-70cd-aefa-a0135bf75084', 'Schneider, Jast and Beatty', 'LLC', 'REG-00969', 'TAX-50303', '1981-09-20', 'et', 'Antarctica (the territory South of 60 deg S)', 'vel', 1, '874 Allene Shore\nCadestad, MA 98022-3655', 'LA', '(445) 349-1542', 'pferry@example.org', 'http://www.homenick.info/expedita-repudiandae-et-consequatur-aut-quo-quia', 'vsd', 'pls', 'company/logos/telnet.png', '2025-08-26 17:48:57', '2025-08-26 17:48:57'),
('0198e7b6-40bb-7272-b111-dd9eed2e15a0', 'Stark-Schimmel', 'LLC', 'REG-10142', 'TAX-31277', '2004-06-20', 'ut', 'Moldova', 'nesciunt', 1, '800 Gregory Groves Apt. 247\nNoemietown, WY 91720-2257', 'AW', '1-980-580-0455', 'junior.marks@example.net', 'http://www.johns.com/accusamus-architecto-sunt-voluptas-dolorem-quam-et.html', 'potm', 'uvvz', 'company/logos/telnet.png', '2025-08-26 17:48:57', '2025-08-26 17:48:57'),
('0198e7b6-40bd-71b8-bead-66a859bd3ba1', 'Kunde, Weber and Jast', 'Inc', 'REG-56492', 'TAX-21415', '2020-04-27', 'enim', 'Guam', 'molestiae', 1, '34989 Murray Summit Suite 124\nLake Haven, CT 94447', 'BY', '(747) 351-2633', 'opurdy@example.net', 'http://mosciski.org/ut-quam-culpa-esse-facilis-dolor-dicta-mollitia.html', 'svgz', 'potm', 'company/logos/telnet.png', '2025-08-26 17:48:57', '2025-08-26 17:48:57'),
('0198e7b6-40c5-7230-8a88-79bf47916b63', 'Davis-Runolfsson', 'Ltd', 'REG-06309', 'TAX-02329', '2018-05-26', 'repudiandae', 'Netherlands', 'reiciendis', 0, '387 Elvie Meadows\nPort Betsyville, SC 88451', 'IT', '1-267-520-6707', 'murphy.henderson@example.net', 'http://blick.com/molestias-molestias-fugiat-consequatur-minus-atque', 'mp2a', 'lbd', 'company/logos/microsoft.png', '2025-08-26 17:48:57', '2025-08-26 17:48:57'),
('0198e7b6-40c6-70af-b72d-3c3836bc14f5', 'Metz-Weimann', 'Inc', 'REG-73130', 'TAX-05988', '1989-01-09', 'rerum', 'United Kingdom', 'hic', 0, '47906 Charlotte Ramp Suite 275\nWymanmouth, HI 57955-0599', 'GN', '1-567-275-4194', 'ludie.ullrich@example.net', 'http://www.lueilwitz.com/', 'wmx', 'ppm', 'company/logos/asm.png', '2025-08-26 17:48:57', '2025-08-26 17:48:57'),
('0198e7b6-40c8-7300-8476-1b50afe6e4a5', 'Cassin, Lebsack and Greenholt', 'and Sons', 'REG-56877', 'TAX-14757', '1983-09-26', 'sint', 'Bosnia and Herzegovina', 'molestiae', 0, '5816 Jenkins Mills Suite 672\nPort Jamirport, MT 22882', 'AO', '(772) 308-1112', 'raegan08@example.net', 'http://jast.com/', 'pgn', 'msh', 'company/logos/microsoft.png', '2025-08-26 17:48:57', '2025-08-26 17:48:57'),
('0198e7b6-40c9-735c-9922-beedb67de586', 'Beahan, Smitham and Rohan', 'LLC', 'REG-72614', 'TAX-51679', '1998-02-03', 'sint', 'Reunion', 'quasi', 0, '540 Eusebio Grove Suite 118\nAlexandroland, MI 95351-7301', 'SX', '845-580-4175', 'peggie.armstrong@example.org', 'http://ferry.com/qui-ipsam-iste-voluptatem-facere.html', 'docm', 'latex', 'company/logos/microsoft.png', '2025-08-26 17:48:57', '2025-08-26 17:48:57'),
('0198e7b6-40cb-72ee-9edf-3c99942d5230', 'Luettgen Inc', 'Ltd', 'REG-51091', 'TAX-46386', '2025-06-18', 'natus', 'Kiribati', 'officia', 0, '1140 Lynn Corner Apt. 239\nLynnfort, TN 84545', 'FO', '715-787-9410', 'adella.stokes@example.net', 'http://www.hudson.com/', 'vcd', 'igl', 'company/logos/telnet.png', '2025-08-26 17:48:57', '2025-08-26 17:48:57'),
('0198eb9e-9ac3-71fe-9662-5f3cef81de00', 'asm', 'asm', '22114', 'rq-1234', '2003-02-01', 'LLC', 'aaaa', 'Healthcare', 1, 'centre ville sfax', 'tu', '+216 55 771 406', 'majdayedi08@gmail.com', 'https://meet.google.com/ypm-rhfy-gqw?pli=1', 'company/certificate_of_incorporations/K5xaMgmthUJvqIWX9ogxRlLerbJ2ri6KEN5HVcJL.png', 'company/tax_registration_certificates/tSyjiJS654t53AwfKjw9BQyRtkDYQN43sSHOJTlt.png', 'company/logos/N50XIYvXAAHEpTXlvO4ivW00XVqhGUJgNSpw4FK1.png', '2025-08-27 12:01:36', '2025-08-27 12:18:15');

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
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` char(36) NOT NULL,
  `company_id` char(36) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `schema` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`schema`)),
  `created_by` char(36) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `company_id`, `title`, `description`, `schema`, `created_by`, `is_active`, `created_at`, `updated_at`) VALUES
('0198ebb5-2a35-73d6-a191-780f752fe739', '0198eb9e-9ac3-71fe-9662-5f3cef81de00', 'Employee Satisfaction Survey', 'Please rate your satisfaction with various aspects of your work experience', '{\n  \"pages\": [\n    {\n      \"id\": \"page-1\",\n      \"title\": \"Page 1\",\n      \"questions\": [\n        {\n          \"id\": \"section-1756301172435\",\n          \"type\": \"section-title\",\n          \"label\": \"Employee Satisfaction Survey\",\n          \"description\": \"Please rate your satisfaction with various aspects of your work experience\"\n        },\n        {\n          \"id\": \"q-overall-satisfaction-1756301172435\",\n          \"type\": \"satisfaction\",\n          \"label\": \"Overall job satisfaction\",\n          \"required\": true,\n          \"scaleType\": \"5-point\"\n        },\n        {\n          \"id\": \"q-work-environment-1756301172435\",\n          \"type\": \"satisfaction\",\n          \"label\": \"Work environment satisfaction\",\n          \"required\": true,\n          \"scaleType\": \"5-point\"\n        },\n        {\n          \"id\": \"q-management-1756301172435\",\n          \"type\": \"satisfaction\",\n          \"label\": \"Management support satisfaction\",\n          \"required\": true,\n          \"scaleType\": \"5-point\"\n        },\n        {\n          \"id\": \"q-workload-1756301172435\",\n          \"type\": \"radio-group\",\n          \"label\": \"How would you rate your current workload?\",\n          \"required\": true,\n          \"options\": [\n            \"Too light\",\n            \"Just right\",\n            \"Too heavy\",\n            \"Overwhelming\"\n          ]\n        },\n        {\n          \"id\": \"q-recommend-1756301172435\",\n          \"type\": \"radio-group\",\n          \"label\": \"Would you recommend this company as a great place to work?\",\n          \"required\": true,\n          \"options\": [\n            \"Definitely yes\",\n            \"Probably yes\",\n            \"Probably no\",\n            \"Definitely no\"\n          ]\n        },\n        {\n          \"id\": \"q-comments-1756301172435\",\n          \"type\": \"textarea\",\n          \"label\": \"Additional comments or suggestions\",\n          \"required\": false,\n          \"placeholder\": \"Share any additional feedback...\"\n        }\n      ]\n    }\n  ],\n  \"totalPages\": 1,\n  \"createdAt\": \"2025-08-27T13:26:15.154Z\"\n}', '0198ebb3-50b3-7211-b75d-c68aa68d67c5', 1, '2025-08-27 12:26:15', '2025-08-27 12:27:04'),
('0198ebb5-4ebd-7028-90ee-a6866ca293d8', '0198eb9e-9ac3-71fe-9662-5f3cef81de00', 'Employee Satisfaction Survey', 'Please rate your satisfaction with various aspects of your work experience', '{\n  \"pages\": [\n    {\n      \"id\": \"page-1\",\n      \"title\": \"Page 1\",\n      \"questions\": [\n        {\n          \"id\": \"section-1756301172435\",\n          \"type\": \"section-title\",\n          \"label\": \"Employee Satisfaction Survey\",\n          \"description\": \"Please rate your satisfaction with various aspects of your work experience\"\n        },\n        {\n          \"id\": \"q-overall-satisfaction-1756301172435\",\n          \"type\": \"satisfaction\",\n          \"label\": \"Overall job satisfaction\",\n          \"required\": true,\n          \"scaleType\": \"5-point\"\n        },\n        {\n          \"id\": \"q-work-environment-1756301172435\",\n          \"type\": \"satisfaction\",\n          \"label\": \"Work environment satisfaction\",\n          \"required\": true,\n          \"scaleType\": \"5-point\"\n        },\n        {\n          \"id\": \"q-management-1756301172435\",\n          \"type\": \"satisfaction\",\n          \"label\": \"Management support satisfaction\",\n          \"required\": true,\n          \"scaleType\": \"5-point\"\n        },\n        {\n          \"id\": \"q-workload-1756301172435\",\n          \"type\": \"radio-group\",\n          \"label\": \"How would you rate your current workload?\",\n          \"required\": true,\n          \"options\": [\n            \"Too light\",\n            \"Just right\",\n            \"Too heavy\",\n            \"Overwhelming\"\n          ]\n        },\n        {\n          \"id\": \"q-recommend-1756301172435\",\n          \"type\": \"radio-group\",\n          \"label\": \"Would you recommend this company as a great place to work?\",\n          \"required\": true,\n          \"options\": [\n            \"Definitely yes\",\n            \"Probably yes\",\n            \"Probably no\",\n            \"Definitely no\"\n          ]\n        },\n        {\n          \"id\": \"q-comments-1756301172435\",\n          \"type\": \"textarea\",\n          \"label\": \"Additional comments or suggestions\",\n          \"required\": false,\n          \"placeholder\": \"Share any additional feedback...\"\n        }\n      ]\n    }\n  ],\n  \"totalPages\": 1,\n  \"createdAt\": \"2025-08-27T13:26:19.653Z\"\n}', '0198ebb3-50b3-7211-b75d-c68aa68d67c5', 0, '2025-08-27 12:26:24', '2025-08-27 12:26:24'),
('0198ebb5-51ee-71c5-afc9-f3b144e35e06', '0198eb9e-9ac3-71fe-9662-5f3cef81de00', 'Employee Satisfaction Survey', 'Please rate your satisfaction with various aspects of your work experience', '{\n  \"pages\": [\n    {\n      \"id\": \"page-1\",\n      \"title\": \"Page 1\",\n      \"questions\": [\n        {\n          \"id\": \"section-1756301172435\",\n          \"type\": \"section-title\",\n          \"label\": \"Employee Satisfaction Survey\",\n          \"description\": \"Please rate your satisfaction with various aspects of your work experience\"\n        },\n        {\n          \"id\": \"q-overall-satisfaction-1756301172435\",\n          \"type\": \"satisfaction\",\n          \"label\": \"Overall job satisfaction\",\n          \"required\": true,\n          \"scaleType\": \"5-point\"\n        },\n        {\n          \"id\": \"q-work-environment-1756301172435\",\n          \"type\": \"satisfaction\",\n          \"label\": \"Work environment satisfaction\",\n          \"required\": true,\n          \"scaleType\": \"5-point\"\n        },\n        {\n          \"id\": \"q-management-1756301172435\",\n          \"type\": \"satisfaction\",\n          \"label\": \"Management support satisfaction\",\n          \"required\": true,\n          \"scaleType\": \"5-point\"\n        },\n        {\n          \"id\": \"q-workload-1756301172435\",\n          \"type\": \"radio-group\",\n          \"label\": \"How would you rate your current workload?\",\n          \"required\": true,\n          \"options\": [\n            \"Too light\",\n            \"Just right\",\n            \"Too heavy\",\n            \"Overwhelming\"\n          ]\n        },\n        {\n          \"id\": \"q-recommend-1756301172435\",\n          \"type\": \"radio-group\",\n          \"label\": \"Would you recommend this company as a great place to work?\",\n          \"required\": true,\n          \"options\": [\n            \"Definitely yes\",\n            \"Probably yes\",\n            \"Probably no\",\n            \"Definitely no\"\n          ]\n        },\n        {\n          \"id\": \"q-comments-1756301172435\",\n          \"type\": \"textarea\",\n          \"label\": \"Additional comments or suggestions\",\n          \"required\": false,\n          \"placeholder\": \"Share any additional feedback...\"\n        }\n      ]\n    }\n  ],\n  \"totalPages\": 1,\n  \"createdAt\": \"2025-08-27T13:26:20.673Z\"\n}', '0198ebb3-50b3-7211-b75d-c68aa68d67c5', 0, '2025-08-27 12:26:25', '2025-08-27 12:26:25'),
('0198ebb5-54e2-70bb-b162-3a735bc9ecb5', '0198eb9e-9ac3-71fe-9662-5f3cef81de00', 'Employee Satisfaction Survey', 'Please rate your satisfaction with various aspects of your work experience', '{\n  \"pages\": [\n    {\n      \"id\": \"page-1\",\n      \"title\": \"Page 1\",\n      \"questions\": [\n        {\n          \"id\": \"section-1756301172435\",\n          \"type\": \"section-title\",\n          \"label\": \"Employee Satisfaction Survey\",\n          \"description\": \"Please rate your satisfaction with various aspects of your work experience\"\n        },\n        {\n          \"id\": \"q-overall-satisfaction-1756301172435\",\n          \"type\": \"satisfaction\",\n          \"label\": \"Overall job satisfaction\",\n          \"required\": true,\n          \"scaleType\": \"5-point\"\n        },\n        {\n          \"id\": \"q-work-environment-1756301172435\",\n          \"type\": \"satisfaction\",\n          \"label\": \"Work environment satisfaction\",\n          \"required\": true,\n          \"scaleType\": \"5-point\"\n        },\n        {\n          \"id\": \"q-management-1756301172435\",\n          \"type\": \"satisfaction\",\n          \"label\": \"Management support satisfaction\",\n          \"required\": true,\n          \"scaleType\": \"5-point\"\n        },\n        {\n          \"id\": \"q-workload-1756301172435\",\n          \"type\": \"radio-group\",\n          \"label\": \"How would you rate your current workload?\",\n          \"required\": true,\n          \"options\": [\n            \"Too light\",\n            \"Just right\",\n            \"Too heavy\",\n            \"Overwhelming\"\n          ]\n        },\n        {\n          \"id\": \"q-recommend-1756301172435\",\n          \"type\": \"radio-group\",\n          \"label\": \"Would you recommend this company as a great place to work?\",\n          \"required\": true,\n          \"options\": [\n            \"Definitely yes\",\n            \"Probably yes\",\n            \"Probably no\",\n            \"Definitely no\"\n          ]\n        },\n        {\n          \"id\": \"q-comments-1756301172435\",\n          \"type\": \"textarea\",\n          \"label\": \"Additional comments or suggestions\",\n          \"required\": false,\n          \"placeholder\": \"Share any additional feedback...\"\n        }\n      ]\n    }\n  ],\n  \"totalPages\": 1,\n  \"createdAt\": \"2025-08-27T13:26:21.478Z\"\n}', '0198ebb3-50b3-7211-b75d-c68aa68d67c5', 0, '2025-08-27 12:26:26', '2025-08-27 12:26:26'),
('0198ebb5-5761-70db-971d-f753fde970d9', '0198eb9e-9ac3-71fe-9662-5f3cef81de00', 'Employee Satisfaction Survey', 'Please rate your satisfaction with various aspects of your work experience', '{\n  \"pages\": [\n    {\n      \"id\": \"page-1\",\n      \"title\": \"Page 1\",\n      \"questions\": [\n        {\n          \"id\": \"section-1756301172435\",\n          \"type\": \"section-title\",\n          \"label\": \"Employee Satisfaction Survey\",\n          \"description\": \"Please rate your satisfaction with various aspects of your work experience\"\n        },\n        {\n          \"id\": \"q-overall-satisfaction-1756301172435\",\n          \"type\": \"satisfaction\",\n          \"label\": \"Overall job satisfaction\",\n          \"required\": true,\n          \"scaleType\": \"5-point\"\n        },\n        {\n          \"id\": \"q-work-environment-1756301172435\",\n          \"type\": \"satisfaction\",\n          \"label\": \"Work environment satisfaction\",\n          \"required\": true,\n          \"scaleType\": \"5-point\"\n        },\n        {\n          \"id\": \"q-management-1756301172435\",\n          \"type\": \"satisfaction\",\n          \"label\": \"Management support satisfaction\",\n          \"required\": true,\n          \"scaleType\": \"5-point\"\n        },\n        {\n          \"id\": \"q-workload-1756301172435\",\n          \"type\": \"radio-group\",\n          \"label\": \"How would you rate your current workload?\",\n          \"required\": true,\n          \"options\": [\n            \"Too light\",\n            \"Just right\",\n            \"Too heavy\",\n            \"Overwhelming\"\n          ]\n        },\n        {\n          \"id\": \"q-recommend-1756301172435\",\n          \"type\": \"radio-group\",\n          \"label\": \"Would you recommend this company as a great place to work?\",\n          \"required\": true,\n          \"options\": [\n            \"Definitely yes\",\n            \"Probably yes\",\n            \"Probably no\",\n            \"Definitely no\"\n          ]\n        },\n        {\n          \"id\": \"q-comments-1756301172435\",\n          \"type\": \"textarea\",\n          \"label\": \"Additional comments or suggestions\",\n          \"required\": false,\n          \"placeholder\": \"Share any additional feedback...\"\n        }\n      ]\n    }\n  ],\n  \"totalPages\": 1,\n  \"createdAt\": \"2025-08-27T13:26:21.650Z\"\n}', '0198ebb3-50b3-7211-b75d-c68aa68d67c5', 0, '2025-08-27 12:26:26', '2025-08-27 12:26:26'),
('0198ebb5-5a8c-7012-b1f2-94c16b38eda1', '0198eb9e-9ac3-71fe-9662-5f3cef81de00', 'Employee Satisfaction Survey', 'Please rate your satisfaction with various aspects of your work experience', '{\n  \"pages\": [\n    {\n      \"id\": \"page-1\",\n      \"title\": \"Page 1\",\n      \"questions\": [\n        {\n          \"id\": \"section-1756301172435\",\n          \"type\": \"section-title\",\n          \"label\": \"Employee Satisfaction Survey\",\n          \"description\": \"Please rate your satisfaction with various aspects of your work experience\"\n        },\n        {\n          \"id\": \"q-overall-satisfaction-1756301172435\",\n          \"type\": \"satisfaction\",\n          \"label\": \"Overall job satisfaction\",\n          \"required\": true,\n          \"scaleType\": \"5-point\"\n        },\n        {\n          \"id\": \"q-work-environment-1756301172435\",\n          \"type\": \"satisfaction\",\n          \"label\": \"Work environment satisfaction\",\n          \"required\": true,\n          \"scaleType\": \"5-point\"\n        },\n        {\n          \"id\": \"q-management-1756301172435\",\n          \"type\": \"satisfaction\",\n          \"label\": \"Management support satisfaction\",\n          \"required\": true,\n          \"scaleType\": \"5-point\"\n        },\n        {\n          \"id\": \"q-workload-1756301172435\",\n          \"type\": \"radio-group\",\n          \"label\": \"How would you rate your current workload?\",\n          \"required\": true,\n          \"options\": [\n            \"Too light\",\n            \"Just right\",\n            \"Too heavy\",\n            \"Overwhelming\"\n          ]\n        },\n        {\n          \"id\": \"q-recommend-1756301172435\",\n          \"type\": \"radio-group\",\n          \"label\": \"Would you recommend this company as a great place to work?\",\n          \"required\": true,\n          \"options\": [\n            \"Definitely yes\",\n            \"Probably yes\",\n            \"Probably no\",\n            \"Definitely no\"\n          ]\n        },\n        {\n          \"id\": \"q-comments-1756301172435\",\n          \"type\": \"textarea\",\n          \"label\": \"Additional comments or suggestions\",\n          \"required\": false,\n          \"placeholder\": \"Share any additional feedback...\"\n        }\n      ]\n    }\n  ],\n  \"totalPages\": 1,\n  \"createdAt\": \"2025-08-27T13:26:21.805Z\"\n}', '0198ebb3-50b3-7211-b75d-c68aa68d67c5', 0, '2025-08-27 12:26:27', '2025-08-27 12:26:27'),
('0198ebb5-5d8a-720b-a272-56d6cf7b3f11', '0198eb9e-9ac3-71fe-9662-5f3cef81de00', 'Employee Satisfaction Survey', 'Please rate your satisfaction with various aspects of your work experience', '{\n  \"pages\": [\n    {\n      \"id\": \"page-1\",\n      \"title\": \"Page 1\",\n      \"questions\": [\n        {\n          \"id\": \"section-1756301172435\",\n          \"type\": \"section-title\",\n          \"label\": \"Employee Satisfaction Survey\",\n          \"description\": \"Please rate your satisfaction with various aspects of your work experience\"\n        },\n        {\n          \"id\": \"q-overall-satisfaction-1756301172435\",\n          \"type\": \"satisfaction\",\n          \"label\": \"Overall job satisfaction\",\n          \"required\": true,\n          \"scaleType\": \"5-point\"\n        },\n        {\n          \"id\": \"q-work-environment-1756301172435\",\n          \"type\": \"satisfaction\",\n          \"label\": \"Work environment satisfaction\",\n          \"required\": true,\n          \"scaleType\": \"5-point\"\n        },\n        {\n          \"id\": \"q-management-1756301172435\",\n          \"type\": \"satisfaction\",\n          \"label\": \"Management support satisfaction\",\n          \"required\": true,\n          \"scaleType\": \"5-point\"\n        },\n        {\n          \"id\": \"q-workload-1756301172435\",\n          \"type\": \"radio-group\",\n          \"label\": \"How would you rate your current workload?\",\n          \"required\": true,\n          \"options\": [\n            \"Too light\",\n            \"Just right\",\n            \"Too heavy\",\n            \"Overwhelming\"\n          ]\n        },\n        {\n          \"id\": \"q-recommend-1756301172435\",\n          \"type\": \"radio-group\",\n          \"label\": \"Would you recommend this company as a great place to work?\",\n          \"required\": true,\n          \"options\": [\n            \"Definitely yes\",\n            \"Probably yes\",\n            \"Probably no\",\n            \"Definitely no\"\n          ]\n        },\n        {\n          \"id\": \"q-comments-1756301172435\",\n          \"type\": \"textarea\",\n          \"label\": \"Additional comments or suggestions\",\n          \"required\": false,\n          \"placeholder\": \"Share any additional feedback...\"\n        }\n      ]\n    }\n  ],\n  \"totalPages\": 1,\n  \"createdAt\": \"2025-08-27T13:26:21.985Z\"\n}', '0198ebb3-50b3-7211-b75d-c68aa68d67c5', 0, '2025-08-27 12:26:28', '2025-08-27 12:26:28');

-- --------------------------------------------------------

--
-- Table structure for table `form_analytics`
--

CREATE TABLE `form_analytics` (
  `form_id` char(36) NOT NULL,
  `submission_count` int(11) NOT NULL DEFAULT 0,
  `summary_stats` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`summary_stats`)),
  `last_submission_at` timestamp NULL DEFAULT NULL
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
(1, '0001_01_01_000000_create_companies_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '0001_01_01_000003_create_users_table', 1),
(5, '2025_07_07_005357_create_forms_table', 1),
(6, '2025_07_07_005415_create_questions_table', 1),
(7, '2025_07_07_005448_create_submissions_table', 1),
(8, '2025_07_07_010406_create_answers_table', 1),
(9, '2025_07_07_131751_create_sessions_table', 1),
(10, '2025_07_07_192346_create_personal_access_tokens_table', 1),
(11, '2025_07_15_122725_drop_old_form_tables', 1),
(12, '2025_07_15_122817_create_surveyjs_tables', 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` char(36) NOT NULL,
  `form_id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL COMMENT 'Respondent',
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`data`)),
  `status` enum('PENDING','APPROVED','REJECTED') NOT NULL DEFAULT 'PENDING',
  `reviewed_by` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `form_id`, `user_id`, `data`, `status`, `reviewed_by`, `created_at`, `updated_at`) VALUES
('0198ebb6-f01b-7290-96d5-3e3fefed24f6', '0198ebb5-2a35-73d6-a191-780f752fe739', '0198ebaf-d194-7148-9cbf-e30fbfb8a069', '{\"answers\":[{\"questionId\":\"q-overall-satisfaction-1756301172435\",\"answer\":\"1\",\"fieldType\":\"satisfaction\",\"pageId\":\"page-1\",\"label\":\"Overall job satisfaction\",\"required\":true},{\"questionId\":\"q-work-environment-1756301172435\",\"answer\":\"5\",\"fieldType\":\"satisfaction\",\"pageId\":\"page-1\",\"label\":\"Work environment satisfaction\",\"required\":true},{\"questionId\":\"q-management-1756301172435\",\"answer\":\"3\",\"fieldType\":\"satisfaction\",\"pageId\":\"page-1\",\"label\":\"Management support satisfaction\",\"required\":true},{\"questionId\":\"q-workload-1756301172435\",\"answer\":\"Just right\",\"fieldType\":\"radio-group\",\"pageId\":\"page-1\",\"label\":\"How would you rate your current workload?\",\"required\":true},{\"questionId\":\"q-recommend-1756301172435\",\"answer\":\"Probably yes\",\"fieldType\":\"radio-group\",\"pageId\":\"page-1\",\"label\":\"Would you recommend this company as a great place to work?\",\"required\":true},{\"questionId\":\"q-comments-1756301172435\",\"answer\":null,\"fieldType\":\"textarea\",\"pageId\":\"page-1\",\"label\":\"Additional comments or suggestions\",\"required\":false}],\"form_type\":\"single-page\",\"total_pages\":1,\"submitted_at\":\"2025-08-27T13:28:11.475211Z\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/139.0.0.0 Safari\\/537.36\"}', 'PENDING', NULL, '2025-08-27 12:28:11', '2025-08-27 12:28:11'),
('0198ebb7-32d7-7022-9b8b-c7eb8b694dc5', '0198ebb5-2a35-73d6-a191-780f752fe739', '0198ebaf-d194-7148-9cbf-e30fbfb8a069', '{\"answers\":[{\"questionId\":\"q-overall-satisfaction-1756301172435\",\"answer\":\"1\",\"fieldType\":\"satisfaction\",\"pageId\":\"page-1\",\"label\":\"Overall job satisfaction\",\"required\":true},{\"questionId\":\"q-work-environment-1756301172435\",\"answer\":\"4\",\"fieldType\":\"satisfaction\",\"pageId\":\"page-1\",\"label\":\"Work environment satisfaction\",\"required\":true},{\"questionId\":\"q-management-1756301172435\",\"answer\":\"4\",\"fieldType\":\"satisfaction\",\"pageId\":\"page-1\",\"label\":\"Management support satisfaction\",\"required\":true},{\"questionId\":\"q-workload-1756301172435\",\"answer\":\"Too light\",\"fieldType\":\"radio-group\",\"pageId\":\"page-1\",\"label\":\"How would you rate your current workload?\",\"required\":true},{\"questionId\":\"q-recommend-1756301172435\",\"answer\":\"Definitely yes\",\"fieldType\":\"radio-group\",\"pageId\":\"page-1\",\"label\":\"Would you recommend this company as a great place to work?\",\"required\":true},{\"questionId\":\"q-comments-1756301172435\",\"answer\":null,\"fieldType\":\"textarea\",\"pageId\":\"page-1\",\"label\":\"Additional comments or suggestions\",\"required\":false}],\"form_type\":\"single-page\",\"total_pages\":1,\"submitted_at\":\"2025-08-27T13:28:28.626465Z\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/139.0.0.0 Safari\\/537.36\"}', 'PENDING', NULL, '2025-08-27 12:28:28', '2025-08-27 12:28:28'),
('0198ebb7-6a5b-70f2-ae36-a44eec8ad930', '0198ebb5-2a35-73d6-a191-780f752fe739', '0198ebaf-d194-7148-9cbf-e30fbfb8a069', '{\"answers\":[{\"questionId\":\"q-overall-satisfaction-1756301172435\",\"answer\":\"3\",\"fieldType\":\"satisfaction\",\"pageId\":\"page-1\",\"label\":\"Overall job satisfaction\",\"required\":true},{\"questionId\":\"q-work-environment-1756301172435\",\"answer\":\"5\",\"fieldType\":\"satisfaction\",\"pageId\":\"page-1\",\"label\":\"Work environment satisfaction\",\"required\":true},{\"questionId\":\"q-management-1756301172435\",\"answer\":\"3\",\"fieldType\":\"satisfaction\",\"pageId\":\"page-1\",\"label\":\"Management support satisfaction\",\"required\":true},{\"questionId\":\"q-workload-1756301172435\",\"answer\":\"Too light\",\"fieldType\":\"radio-group\",\"pageId\":\"page-1\",\"label\":\"How would you rate your current workload?\",\"required\":true},{\"questionId\":\"q-recommend-1756301172435\",\"answer\":\"Definitely no\",\"fieldType\":\"radio-group\",\"pageId\":\"page-1\",\"label\":\"Would you recommend this company as a great place to work?\",\"required\":true},{\"questionId\":\"q-comments-1756301172435\",\"answer\":null,\"fieldType\":\"textarea\",\"pageId\":\"page-1\",\"label\":\"Additional comments or suggestions\",\"required\":false}],\"form_type\":\"single-page\",\"total_pages\":1,\"submitted_at\":\"2025-08-27T13:28:42.837290Z\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/139.0.0.0 Safari\\/537.36\"}', 'PENDING', NULL, '2025-08-27 12:28:42', '2025-08-27 12:28:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `matricule` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('employee','hr_staff','hr_admin','manager') NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `company_id` char(36) NOT NULL,
  `department` varchar(255) NOT NULL,
  `hr_role` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `matricule`, `email`, `password`, `role`, `first_name`, `company_id`, `department`, `hr_role`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
('0198e7b6-4222-717e-ade8-ab4bc4073197', 'EMP-23324', 'test@example.com', '$2y$12$u9RvPuOAbGMByiDsKRJ9Xuwy6zX8M0bY8IAVwIShZfzb.Ybo/49V2', 'employee', 'Test User', '0198e7b6-4029-71b4-9651-9a84869c8927', 'Finance', NULL, 1, 'dJsiRjtU89', '2025-08-26 17:48:58', '2025-08-26 17:48:58'),
('0198e7b9-6e18-7343-b77d-b5ab08b56468', '320', 'majdayedi08@gmail.com', '$2y$12$MMzEa8WMYTIOWSqX7oF./upTtFMn5qlP0ojly7xGK0YjmPxaCRLMC', 'hr_staff', 'majd', '0198e7b6-4029-71b4-9651-9a84869c8927', 'developpement', NULL, 1, NULL, '2025-08-26 17:52:26', '2025-08-26 17:52:26'),
('0198ebaf-d194-7148-9cbf-e30fbfb8a069', '230', 'majdayedi55@gmail.com', '$2y$12$ctJpj7deiqHK8aEaw.UXhO4cjsyLR7jVzZEoNXMBtMS84iGD4uv5S', 'employee', 'majd', '0198eb9e-9ac3-71fe-9662-5f3cef81de00', 'it', NULL, 1, NULL, '2025-08-27 12:20:25', '2025-08-27 12:20:25'),
('0198ebb0-9ff3-7123-945d-d1fbb351a552', '231', 'majd@gmail.com', '$2y$12$eSAQdRlrmCvOHlqsrGtJcuw3FBZCUugFDWxpKC.56rUYILtMQOIV.', 'hr_staff', 'bassem', '0198eb9e-9ac3-71fe-9662-5f3cef81de00', 'it', NULL, 1, NULL, '2025-08-27 12:21:17', '2025-08-27 12:21:17'),
('0198ebb3-50b3-7211-b75d-c68aa68d67c5', '232', 'majdayedi5@gmail.com', '$2y$12$OlDdKGYGkS4kmF26txNQrutv.NBydA/jSaEsDt5QckkitRLeqrEDa', 'hr_staff', 'majd', '0198eb9e-9ac3-71fe-9662-5f3cef81de00', 'it', NULL, 1, NULL, '2025-08-27 12:24:14', '2025-08-27 12:24:14');

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
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_registration_number_unique` (`registration_number`),
  ADD UNIQUE KEY `companies_tax_id_unique` (`tax_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forms_company_id_foreign` (`company_id`),
  ADD KEY `forms_created_by_foreign` (`created_by`);

--
-- Indexes for table `form_analytics`
--
ALTER TABLE `form_analytics`
  ADD PRIMARY KEY (`form_id`);

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
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submissions_form_id_foreign` (`form_id`),
  ADD KEY `submissions_user_id_foreign` (`user_id`),
  ADD KEY `submissions_reviewed_by_foreign` (`reviewed_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_matricule_unique` (`matricule`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_company_id_foreign` (`company_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `forms`
--
ALTER TABLE `forms`
  ADD CONSTRAINT `forms_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `forms_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `form_analytics`
--
ALTER TABLE `form_analytics`
  ADD CONSTRAINT `form_analytics_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `submissions_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `submissions_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `submissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
