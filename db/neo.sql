-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2017 at 02:13 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `neo`
--

-- --------------------------------------------------------

--
-- Table structure for table `default_admin`
--

CREATE TABLE `default_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(4) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `token` varchar(255) NOT NULL,
  `password_reset_code` varchar(200) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_admin`
--

INSERT INTO `default_admin` (`id`, `role_id`, `username`, `email`, `password`, `salt`, `status`, `token`, `password_reset_code`, `fname`, `lname`, `created_at`) VALUES
(1, 1, 'admin', 'admin@gmail.com', 'db01cbbdfba7818313a77bbe82f0433d62fb9fda', 'X1g5', '1', '', '', 'bikash', 'bhandary', '2017-11-14 10:27:03'),
(7, 2, 'padam.khanal', 'padam@gmail.com', '933d8a95e14c0198ad96075eab6a735528b9466e', '4gvR', '1', '', '', 'padam', 'khanal', '2017-11-20 05:51:01');

-- --------------------------------------------------------

--
-- Table structure for table `default_ambassador_message`
--

CREATE TABLE `default_ambassador_message` (
  `id` int(11) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(200) NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_ambassador_message`
--

INSERT INTO `default_ambassador_message` (`id`, `name`, `image`, `message`, `created_at`) VALUES
(1, 'test message', 'tri-banner-background--the-resiliency-institute-2.jpeg', '<p>this is message</p>\r\n', '2017-12-17 06:11:30');

-- --------------------------------------------------------

--
-- Table structure for table `default_ci_sessions`
--

CREATE TABLE `default_ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_ci_sessions`
--

INSERT INTO `default_ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('pnpk0prkbm02q3s60u40pdaugj', '::1', 1511344808, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313334343830383b),
('knvotc1hmh69ru1rnv8pf7d5nn', '::1', 1511344810, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313334343831303b757365725f69647c733a313a2231223b656d61696c7c733a31353a2261646d696e40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b666e616d657c733a363a2262696b617368223b6c6e616d657c733a383a226268616e64617279223b726f6c657c733a31303a22737570657261646d696e223b69735f6c6f676765645f696e7c623a313b),
('cu18gos2r7vdhs6ljumdavea5j', '::1', 1511344810, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313334343831303b),
('nthbou48l5vpef1rlgv9kmrcmr', '::1', 1511344846, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313334343834363b),
('cnvk5ggknv49h9107fmdupeu4n', '::1', 1511344848, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313334343834383b757365725f69647c733a313a2231223b656d61696c7c733a31353a2261646d696e40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b666e616d657c733a363a2262696b617368223b6c6e616d657c733a383a226268616e64617279223b726f6c657c733a31303a22737570657261646d696e223b69735f6c6f676765645f696e7c623a313b),
('uippf7m9rd6p46dj2j1hbn93bo', '::1', 1511344868, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313334343836383b757365725f69647c733a313a2231223b656d61696c7c733a31353a2261646d696e40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b666e616d657c733a363a2262696b617368223b6c6e616d657c733a383a226268616e64617279223b726f6c657c733a31303a22737570657261646d696e223b69735f6c6f676765645f696e7c623a313b),
('8uhh4ulq7mpblgqpvf4fhtlfif', '::1', 1511344868, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313334343836383b);

-- --------------------------------------------------------

--
-- Table structure for table `default_counselor`
--

CREATE TABLE `default_counselor` (
  `id` int(10) UNSIGNED NOT NULL,
  `cat_id` int(11) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('0','1') NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_counselor`
--

INSERT INTO `default_counselor` (`id`, `cat_id`, `title`, `description`, `status`, `image`, `created_at`) VALUES
(3, 5, 'राहदानी (MRP)', '<p><span> <span>नेपालको राहदानी विभागमा पठाईने छ । नेपालबाट राहदानी तयार हुन झण्डै ६ देखि ८ हप्ता लाग्ने र तयार भई दूतावासमा आइसकेपछि वितरण गरिने छ ।</span></span></p>\r\n', '1', 'tri-banner-background--the-resiliency-institute-2.jpeg', '2017-12-15 10:48:26'),
(4, 5, 'पेश गर्नु पर्ने आवश्यक कागजातहरु', '<p [removed]=\"box-sizing: border-box; border: 0px; font-family: inherit; font-style: inherit; font-weight: inherit; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; color: rgb(64, 64, 64); text-decoration-line: none;\" target=\"_blank\"> http://nepalpassport.gov.np/ </a>गई त्यहां उल्लेख गरिए अनुसारको फाराम  भरी रितपूर्वकको फोटो टांस गरी तीन प्रति भरिएको फाराम दूतावासमा बुझाउने ।</p>\r\n\r\n<ul [removed]: none; color: rgb(64, 64, 64);\">\r\n <li [removed]: inherit; font-weight: inherit; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; list-style-type: square;\">फाराममा हस्ताक्षर गर्ने खण्डमा कालो मसीले आफ्नो हस्ताक्षर गरी निर्दिष्ट स्थानमा ल्याप्चे लगाएको हुनुपर्ने ।</li>\r\n <li [removed]: inherit; font-weight: inherit; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; list-style-type: square;\">पुरानो राहदानीको सक्कल तथा प्रतिलिपि ।</li>\r\n <li [removed]: inherit; font-weight: inherit; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; list-style-type: square;\">नेपाली नागरिकताको प्रमाणपत्रको सक्कल र प्रतिलिपि ।</li>\r\n <li [removed]: inherit; font-weight: inherit; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; list-style-type: square;\">हालै खिचिएको पासपोर्ट साइजका ५ प्रति रंगिन फोटाहरु / फोटाहरु किनारा नभएको-अनुहारको भागले सम्पूर्ण फोटोको ७० देखि ८० प्रतिशत भाग कभर गरेको र दुवै कान स्पष्ट देखिने हुनुपर्दछ ।</li>\r\n <li [removed]: inherit; font-weight: inherit; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; list-style-type: square;\">शुल्क: ओमानी रियल  २०.००</li>\r\n</ul>\r\n', '1', '', '2017-12-15 10:49:22');

-- --------------------------------------------------------

--
-- Table structure for table `default_counselor_category`
--

CREATE TABLE `default_counselor_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `cat_title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(200) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_counselor_category`
--

INSERT INTO `default_counselor_category` (`id`, `cat_title`, `slug`, `image`, `status`, `priority`) VALUES
(5, 'PASSPORT', 'passport', 'profile_test_icon__74443.jpg', '1', 10),
(6, 'TRAVEL DOCUMENT', 'travel-document', '', '1', 0),
(7, 'Power of Attorney', 'power-of-attorney', '', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `default_events`
--

CREATE TABLE `default_events` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `image` varchar(100) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` varchar(50) DEFAULT NULL,
  `end_time` varchar(50) DEFAULT NULL,
  `status` enum('0','1') NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_events`
--

INSERT INTO `default_events` (`id`, `name`, `address`, `email`, `phone`, `description`, `image`, `start_date`, `end_date`, `start_time`, `end_time`, `status`, `create_at`) VALUES
(4, 'Event Name here', 'kathamandu', 'event@gmail.com', '12345612212', '<p>helo worlld here</p>\r\n', 'tri-banner-background--the-resiliency-institute-2.jpeg', '2017-12-26', '2018-01-24', '04:30 PM', '06:15 PM', '1', '2017-12-17 09:51:48');

-- --------------------------------------------------------

--
-- Table structure for table `default_landmarks`
--

CREATE TABLE `default_landmarks` (
  `id` int(10) UNSIGNED NOT NULL,
  `cat_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `longitude` varchar(200) DEFAULT NULL,
  `latitude` varchar(200) DEFAULT NULL,
  `website` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_landmarks`
--

INSERT INTO `default_landmarks` (`id`, `cat_id`, `title`, `email`, `address`, `longitude`, `latitude`, `website`, `image`, `status`, `created_at`) VALUES
(1, 2, 'kathamdnu hospital', 'bikash.bhandari05@gmail.com', 'Nepal', '84.124', '28.395', '', '', '1', '2017-12-03 15:13:48'),
(2, 4, 'Prasadi', 'prasadi@gmail.com', 'Prasadi Academy, Jawalakhel, Central Development Region, Nepal', '85.317', '27.671', '', '', '1', '2017-12-04 09:36:45'),
(3, 2, 'Bir Hospital', 'bir@gmail.com', 'Bir Hospital, Kathmandu, Central Development Region, Nepal', '85.314', '27.705', '', '1512380878.jpeg', '1', '2017-12-04 09:47:58');

-- --------------------------------------------------------

--
-- Table structure for table `default_landmark_category`
--

CREATE TABLE `default_landmark_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `cat_title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `priority` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_landmark_category`
--

INSERT INTO `default_landmark_category` (`id`, `cat_title`, `slug`, `image`, `priority`, `status`) VALUES
(2, 'Hospitals', 'hospital', '', 10, '1'),
(4, 'College', 'college', '', 20, '1');

-- --------------------------------------------------------

--
-- Table structure for table `default_navigation_groups`
--

CREATE TABLE `default_navigation_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `abbrev` varchar(100) NOT NULL,
  `priority` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_navigation_groups`
--

INSERT INTO `default_navigation_groups` (`id`, `title`, `abbrev`, `priority`, `status`) VALUES
(3, 'about page', 'about-page', 10, '1'),
(4, 'test page', 'test-page', 10, '1');

-- --------------------------------------------------------

--
-- Table structure for table `default_news`
--

CREATE TABLE `default_news` (
  `id` int(11) NOT NULL,
  `cat_id` int(10) UNSIGNED NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `sub_title` text NOT NULL,
  `slug` text NOT NULL,
  `content` text NOT NULL,
  `author` varchar(220) NOT NULL,
  `flash` int(11) NOT NULL,
  `breaking` int(11) NOT NULL,
  `featured` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `publish_date` date NOT NULL,
  `url` text NOT NULL,
  `status` enum('publish','unpublish') NOT NULL DEFAULT 'unpublish',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_news`
--

INSERT INTO `default_news` (`id`, `cat_id`, `sub_cat_id`, `title`, `sub_title`, `slug`, `content`, `author`, `flash`, `breaking`, `featured`, `order`, `publish_date`, `url`, `status`, `created_at`) VALUES
(1, 6, 7, 'Cricket News and Editorial', 'Sheffield Shield: Weatherald brilliance helps SA chase down 325', 'cricket-news-and-editorials-1510828163', '<p><span>Having already scored a century in the first innings, Weatherald brought up his second century of the game during the chase</span></p>\r\n', 'padam khanal', 0, 0, 0, 0, '2017-11-29', '', 'publish', '2017-11-16 10:29:23'),
(2, 6, 0, 'Stoneman, Cook lead dominant batting display', '', 'stoneman-cook-lead-dominant-batting-display-1510829906', '<p>asasasas</p>\r\n', 'bikash', 0, 0, 0, 0, '2017-11-24', '', 'publish', '2017-11-16 10:58:26'),
(3, 5, 8, 'helo bro', 'final test', 'final-test-1510831569', '<p>helo there</p>\r\n', 'padam', 0, 0, 0, 0, '2017-12-09', '', 'publish', '2017-11-16 11:26:09'),
(4, 6, 0, 'my name is ', 'Sunt nobis ex adipisci quae ', 'my-name-is-1512285603', '<p><span [removed] rgb(102, 102, 102); font-family: Verdana, Geneva, sans-serif; font-size: 10px;\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</span></p>\r\n', 'Vel corrupti est quo quidem sint magnam nisi eos et', 0, 0, 0, 0, '2017-12-21', '', 'publish', '2017-12-03 07:20:03'),
(5, 6, 0, 'Ex eum minus labore dolor in eos minus ', 'Amet tempora iure corrupti rerum laborum dolorem ', 'Qui dolorem anim dolores assumenda odit dignissimo-1512285722', '<p><span>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</span></p>\r\n', 'snil pant', 0, 0, 0, 0, '0000-00-00', '', 'publish', '2017-12-03 07:22:02'),
(6, 6, 0, 'Est voluptate nostrud aliquip quia officia omnis et ut unde', 'Ullamco ullamco officia optio alias alias', 'est-voluptate-nostrud-aliquip-quia-officia-omnis-et-ut-unde-1512285828', '<p><span [removed] rgb(102, 102, 102); font-family: Verdana, Geneva, sans-serif; font-size: 10px;\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</span></p>\r\n', 'harish saud', 0, 0, 0, 0, '0000-00-00', '', 'publish', '2017-12-03 07:23:48');

-- --------------------------------------------------------

--
-- Table structure for table `default_news_category`
--

CREATE TABLE `default_news_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `cat_title` varchar(100) NOT NULL,
  `parent_cat_id` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `priority` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_news_category`
--

INSERT INTO `default_news_category` (`id`, `cat_title`, `parent_cat_id`, `slug`, `priority`, `status`) VALUES
(6, 'Politics', 0, '', 20, '1'),
(7, 'Cricket', 5, '', 0, '1'),
(8, 'Football', 5, '', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `default_pages`
--

CREATE TABLE `default_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `nav_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_link` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `meta_title` varchar(100) NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_pages`
--

INSERT INTO `default_pages` (`id`, `nav_id`, `title`, `slug`, `content`, `image_link`, `status`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`, `created_by`) VALUES
(3, 7, 'test page', 'test-page', '<p>this is test page</p>', '', '1', '', '', '', '2017-11-20 06:24:30', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `default_page_navigation`
--

CREATE TABLE `default_page_navigation` (
  `id` int(10) UNSIGNED NOT NULL,
  `nav_group_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(200) NOT NULL,
  `priority` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_page_navigation`
--

INSERT INTO `default_page_navigation` (`id`, `nav_group_id`, `title`, `url`, `priority`, `status`) VALUES
(7, 3, 'category 2', '', 10, '1'),
(10, 4, 'category 3', '', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `default_roles`
--

CREATE TABLE `default_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_roles`
--

INSERT INTO `default_roles` (`id`, `role`) VALUES
(1, 'superadmin'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `default_settings`
--

CREATE TABLE `default_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_name` varchar(100) NOT NULL,
  `sub_name` varchar(100) NOT NULL,
  `app_slogan` tinytext NOT NULL,
  `logo_url` text NOT NULL,
  `about_app` text NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `contact_phone` varchar(15) NOT NULL,
  `contact_address` varchar(255) NOT NULL,
  `website_url` text NOT NULL,
  `copyright` varchar(100) NOT NULL,
  `facebook_url` text NOT NULL,
  `youtube_url` text NOT NULL,
  `twitter_url` text NOT NULL,
  `google_url` text NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_settings`
--

INSERT INTO `default_settings` (`id`, `app_name`, `sub_name`, `app_slogan`, `logo_url`, `about_app`, `contact_email`, `contact_phone`, `contact_address`, `website_url`, `copyright`, `facebook_url`, `youtube_url`, `twitter_url`, `google_url`, `update_at`) VALUES
(1, 'my app', 'test', 'this is for user app', '1510656144.png', 'this is cool apps', 'test@gmail.com', '9898989898', 'kathamndu,nepal', 'test...', 'sunbi', 'test', 'testv', 'testa', 'testn', '2017-11-14 10:42:24');

-- --------------------------------------------------------

--
-- Table structure for table `default_sliders`
--

CREATE TABLE `default_sliders` (
  `id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_sliders`
--

INSERT INTO `default_sliders` (`id`, `title`, `image`, `status`, `created_at`) VALUES
(10, '', '1513510784_du.jpg', '1', '0000-00-00 00:00:00'),
(11, '', '1513510784_3S.jpg', '1', '0000-00-00 00:00:00'),
(12, '', '1513511453_yj.jpg', '1', '0000-00-00 00:00:00'),
(13, '', '1513511454_D3.jpg', '1', '0000-00-00 00:00:00'),
(14, '', '1513511454_uM.jpg', '1', '0000-00-00 00:00:00'),
(15, '', '1513511454_E2.jpg', '1', '0000-00-00 00:00:00'),
(16, '', '1513511454_2A.jpg', '1', '0000-00-00 00:00:00'),
(17, '', '1513511906_DP.jpg', '1', '0000-00-00 00:00:00'),
(18, '', '1513511907_Fu.jpg', '1', '0000-00-00 00:00:00'),
(19, '', '1513511907_gi.jpg', '1', '0000-00-00 00:00:00'),
(20, '', '1513512203_bT.jpg', '1', '0000-00-00 00:00:00'),
(21, '', '1513512204_Tv.jpg', '1', '0000-00-00 00:00:00'),
(22, '', '1513512204_pI.jpg', '1', '0000-00-00 00:00:00'),
(23, '', '1513512252_sI.jpg', '1', '0000-00-00 00:00:00'),
(24, '', '1513512253_U9.jpg', '1', '0000-00-00 00:00:00'),
(25, '', '1513512253_US.jpg', '1', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `default_sos`
--

CREATE TABLE `default_sos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `default_users`
--

CREATE TABLE `default_users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `password_reset_code` varchar(200) DEFAULT NULL,
  `status` enum('0','1') NOT NULL,
  `last_login` datetime NOT NULL,
  `email_varified_link` varchar(255) NOT NULL,
  `is_varified` enum('0','1') NOT NULL,
  `photo` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_users`
--

INSERT INTO `default_users` (`id`, `full_name`, `email`, `password`, `address`, `password_reset_code`, `status`, `last_login`, `email_varified_link`, `is_varified`, `photo`, `created_at`, `updated_at`) VALUES
(3, 'bikash', 'bikash.bhandari05@gmail.com', '$2y$11$./dlbdc59lfRNcwqg43Yv.7BnxSjhWUcQ.kAKnkj4f6EifjQlGz5O', '', NULL, '1', '2017-12-06 07:38:15', '', '', '', '2017-12-20 00:00:00', '0000-00-00 00:00:00'),
(11, 'surya', 'surya@gmail.coc', '$2y$11$9lzR2YODkAsUlWdho63c7OFzcwOwsJdUA6JcERb8mlArmFN/OaToS', 'kathmandu', NULL, '0', '0000-00-00 00:00:00', '', '0', 'http://localhost/nio/uploads/photo1512542173', '2017-12-06 07:36:13', '0000-00-00 00:00:00'),
(12, 'surya', 'surya@gmail.com', '$2y$11$UAiEDNudJWlkoXQwvUEQ6OpcMnJyOsk57qVOGpVhI2kHPvs5zsxh6', 'kathmandu', NULL, '0', '0000-00-00 00:00:00', '', '0', 'uploads/photo1512542214', '2017-12-06 07:36:54', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `default_user_auth`
--

CREATE TABLE `default_user_auth` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(255) NOT NULL,
  `expire_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_user_auth`
--

INSERT INTO `default_user_auth` (`id`, `user_id`, `token`, `expire_at`, `created_at`, `updated_at`) VALUES
(8, 3, 'pwxkr#s7M3gsCQffh9icRN39tGuN2yURuuT4VluGV@uOWhtVSr3DotHjpf62', '2017-12-05 00:29:06', '0000-00-00 00:00:00', '2017-12-04 12:29:06'),
(9, 3, 'ziBxd!Qn8opLWi!JL2D#i@hs@JUVV4ehynn8S2RrtQgdCPNOobMcanDKa8yU', '2017-12-06 20:02:01', '0000-00-00 00:00:00', '2017-12-06 08:02:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `default_admin`
--
ALTER TABLE `default_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `default_ci_sessions`
--
ALTER TABLE `default_ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `default_counselor`
--
ALTER TABLE `default_counselor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `default_counselor_category`
--
ALTER TABLE `default_counselor_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `default_events`
--
ALTER TABLE `default_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `default_landmarks`
--
ALTER TABLE `default_landmarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `default_landmark_category`
--
ALTER TABLE `default_landmark_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `default_navigation_groups`
--
ALTER TABLE `default_navigation_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `default_news`
--
ALTER TABLE `default_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `default_news_category`
--
ALTER TABLE `default_news_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `default_pages`
--
ALTER TABLE `default_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nav_id` (`nav_id`);

--
-- Indexes for table `default_page_navigation`
--
ALTER TABLE `default_page_navigation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nav_group_id` (`nav_group_id`);

--
-- Indexes for table `default_roles`
--
ALTER TABLE `default_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `default_settings`
--
ALTER TABLE `default_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `default_sliders`
--
ALTER TABLE `default_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `default_sos`
--
ALTER TABLE `default_sos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `default_users`
--
ALTER TABLE `default_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `default_user_auth`
--
ALTER TABLE `default_user_auth`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `default_admin`
--
ALTER TABLE `default_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `default_counselor`
--
ALTER TABLE `default_counselor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `default_counselor_category`
--
ALTER TABLE `default_counselor_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `default_events`
--
ALTER TABLE `default_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `default_landmarks`
--
ALTER TABLE `default_landmarks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `default_landmark_category`
--
ALTER TABLE `default_landmark_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `default_navigation_groups`
--
ALTER TABLE `default_navigation_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `default_news`
--
ALTER TABLE `default_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `default_news_category`
--
ALTER TABLE `default_news_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `default_pages`
--
ALTER TABLE `default_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `default_page_navigation`
--
ALTER TABLE `default_page_navigation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `default_roles`
--
ALTER TABLE `default_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `default_settings`
--
ALTER TABLE `default_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `default_sliders`
--
ALTER TABLE `default_sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `default_sos`
--
ALTER TABLE `default_sos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `default_users`
--
ALTER TABLE `default_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `default_user_auth`
--
ALTER TABLE `default_user_auth`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `default_landmarks`
--
ALTER TABLE `default_landmarks`
  ADD CONSTRAINT `default_landmarks_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `default_landmark_category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `default_pages`
--
ALTER TABLE `default_pages`
  ADD CONSTRAINT `default_pages_ibfk_1` FOREIGN KEY (`nav_id`) REFERENCES `default_page_navigation` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `default_page_navigation`
--
ALTER TABLE `default_page_navigation`
  ADD CONSTRAINT `default_page_navigation_ibfk_1` FOREIGN KEY (`nav_group_id`) REFERENCES `default_navigation_groups` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
