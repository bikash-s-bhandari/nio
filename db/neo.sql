-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2017 at 03:00 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `neo`
--

-- --------------------------------------------------------

--
-- Table structure for table `default_admin`
--

CREATE TABLE IF NOT EXISTS `default_admin` (
  `id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_admin`
--

INSERT INTO `default_admin` (`id`, `role_id`, `username`, `email`, `password`, `salt`, `status`, `token`, `password_reset_code`, `fname`, `lname`, `created_at`) VALUES
(1, 1, 'admin', 'admin@gmail.com', 'db01cbbdfba7818313a77bbe82f0433d62fb9fda', 'X1g5', '1', '', '', 'bikash', 'bhandari', '2017-11-14 10:27:03');

-- --------------------------------------------------------

--
-- Table structure for table `default_landmarks`
--

CREATE TABLE IF NOT EXISTS `default_landmarks` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `website` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_landmarks`
--

INSERT INTO `default_landmarks` (`id`, `title`, `email`, `address`, `website`, `status`, `created_at`) VALUES
(1, 'name of land mark', 'test@gmail.com', 'Tinkune Park, Ring Road, Kathmandu, Nepal', 'this is website url', '1', '2017-11-14 11:09:05'),
(4, 'test ', 'test@gmail.com', 'Nepal Telecom, Gatthaghar, Madhyapur Thimi, Central Development Region, Nepal', '', '1', '2017-11-15 07:08:39');

-- --------------------------------------------------------

--
-- Table structure for table `default_news`
--

CREATE TABLE IF NOT EXISTS `default_news` (
  `id` int(11) NOT NULL,
  `cat_id` int(10) unsigned NOT NULL,
  `title` text NOT NULL,
  `sub_title` text NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_news`
--

INSERT INTO `default_news` (`id`, `cat_id`, `title`, `sub_title`, `content`, `author`, `flash`, `breaking`, `featured`, `order`, `publish_date`, `url`, `status`, `created_at`) VALUES
(1, 1, 'test news', '', '', '', 0, 0, 0, 0, '2017-11-07', '', 'publish', '2017-11-15 10:51:53'),
(2, 0, 'bikas', 'test', '<p>kjaskajskajskas</p>\r\n', 'bikash', 0, 0, 0, 0, '2017-11-30', '', 'publish', '2017-11-15 11:30:46'),
(3, 0, 'another test', '', '<p>hjasjakjsa</p>\r\n', 'padam', 0, 0, 0, 0, '2017-12-07', '', 'publish', '2017-11-15 11:37:48'),
(4, 0, 'jaksjaksa', 'bikashj', '<p>this is test</p>\r\n', 'anil', 0, 0, 0, 0, '2017-11-29', '', 'unpublish', '2017-11-15 11:38:13');

-- --------------------------------------------------------

--
-- Table structure for table `default_news_category`
--

CREATE TABLE IF NOT EXISTS `default_news_category` (
  `id` int(10) unsigned NOT NULL,
  `cat_title` varchar(100) NOT NULL,
  `parent_cat_id` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_news_category`
--

INSERT INTO `default_news_category` (`id`, `cat_title`, `parent_cat_id`, `priority`, `status`) VALUES
(5, 'Sports', 0, 10, '1'),
(6, 'Politics', 0, 20, '1'),
(7, 'Cricket', 5, 0, '1'),
(8, 'Football', 5, 0, '1'),
(11, 'test', 5, 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `default_pages`
--

CREATE TABLE IF NOT EXISTS `default_pages` (
  `id` int(10) unsigned NOT NULL,
  `cat_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `default_page_category`
--

CREATE TABLE IF NOT EXISTS `default_page_category` (
  `id` int(10) unsigned NOT NULL,
  `cat_title` varchar(100) NOT NULL,
  `parent_cat_id` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `default_roles`
--

CREATE TABLE IF NOT EXISTS `default_roles` (
  `id` int(10) unsigned NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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

CREATE TABLE IF NOT EXISTS `default_settings` (
  `id` int(10) unsigned NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_settings`
--

INSERT INTO `default_settings` (`id`, `app_name`, `sub_name`, `app_slogan`, `logo_url`, `about_app`, `contact_email`, `contact_phone`, `contact_address`, `website_url`, `copyright`, `facebook_url`, `youtube_url`, `twitter_url`, `google_url`, `update_at`) VALUES
(1, 'my app', 'test', 'this is for user app', '1510656144.png', 'this is cool apps', 'test@gmail.com', '9898989898', 'kathamndu,nepal', 'test...', 'sunbi', 'test', 'testv', 'testa', 'testn', '2017-11-14 10:42:24');

-- --------------------------------------------------------

--
-- Table structure for table `default_users`
--

CREATE TABLE IF NOT EXISTS `default_users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `password_reset_code` varchar(200) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `email_varified_link` varchar(255) NOT NULL,
  `is_varified` enum('0','1') NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `default_user_auth`
--

CREATE TABLE IF NOT EXISTS `default_user_auth` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `token` varchar(255) NOT NULL,
  `expire_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `default_admin`
--
ALTER TABLE `default_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `default_landmarks`
--
ALTER TABLE `default_landmarks`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `default_page_category`
--
ALTER TABLE `default_page_category`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `default_landmarks`
--
ALTER TABLE `default_landmarks`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `default_news`
--
ALTER TABLE `default_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `default_news_category`
--
ALTER TABLE `default_news_category`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `default_pages`
--
ALTER TABLE `default_pages`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `default_page_category`
--
ALTER TABLE `default_page_category`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `default_roles`
--
ALTER TABLE `default_roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `default_settings`
--
ALTER TABLE `default_settings`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `default_users`
--
ALTER TABLE `default_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `default_user_auth`
--
ALTER TABLE `default_user_auth`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
