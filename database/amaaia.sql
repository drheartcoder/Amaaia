-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 13, 2019 at 01:28 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amaaia`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `flat_no` varchar(255) NOT NULL,
  `building_name` varchar(255) NOT NULL,
  `address` varchar(555) NOT NULL,
  `city` varchar(255) NOT NULL,
  `post_code` varchar(50) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `default_address` enum('1','2') NOT NULL COMMENT '1-not a default address,2-default address',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `flat_no`, `building_name`, `address`, `city`, `post_code`, `state`, `country`, `default_address`, `created_at`, `updated_at`) VALUES
(4, 3, '123', 'Megento', 'Php services', 'Nashik', '422001', 'Maharashtra', 'India', '1', '2018-06-08 05:08:50', '2018-06-08 05:08:50'),
(5, 1, '22', 'Habitat', 'Indira Nagar', 'Nashik', '422001', 'Maharashtra', 'India', '2', '2018-06-10 22:33:16', '2018-06-20 18:10:30'),
(6, 13, 'Plot No 4', 'Gayatri Socity', 'samarth chowk , upendra nagar,', 'Nashik', '422008', 'maharashtra', 'India', '2', '2018-06-18 07:27:47', '2018-06-20 17:38:12'),
(8, 13, 'Plot No 6', 'manmohan socity', 'Uttam Nagar ,Pavan Nagar, Cidco', 'Nashik', '422008', 'Maharashtra', 'India', '1', '2018-06-18 07:31:52', '2018-06-20 17:38:12'),
(10, 13, 'Plot No 9', 'kaveri', 'pavan nagar', 'nashik', '422008', 'maharashtra', 'india', '1', '2018-06-20 05:19:35', '2018-06-20 17:38:12'),
(11, 13, 'Plot No 5', 'pooja apartment', 'Pavan Nagar', 'Nashik', '422008', 'Maharashtra', 'India', '1', '2018-06-20 05:20:50', '2018-06-20 17:38:12');

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_password_resets`
--

INSERT INTO `admin_password_resets` (`email`, `token`, `created_at`) VALUES
('adolf.rebelo@gmail.com', '013eadbffe788741e5b8d6f893cf9b9345b4762804d956143e65e994b3bc4829', '2018-04-19 00:41:41'),
('admin@webwing.com', '59abdd28a4252cbfdae25a30d09e3a3ae1600888b829aa401bcba011531cc151', '2018-04-22 23:05:55'),
('wuvip@twocowmail.net', '793dd92261870b991dfa77ac5e52793c97bc01677a397d21c95527045729a443', '2018-04-23 00:16:35'),
('sagars@webwingtechnologies.com', '9c212a9c29918c1f15b0c742d2a7c6cc28d5cccfbdf97340e3ed6e714ce33f01', '2018-05-16 01:40:05'),
('vevi@ethersportz.info', '1ac2e55b21718e9d1a817971649c29afbbc38f8933fe96bab8c77471551b9089', '2018-05-18 07:21:59'),
('dev@webwingtechnologies.com', 'db7f6e86fe6cab2519266b226eb75b4f5332fef5634454e662d4a1fa97a8715d', '2018-08-02 12:08:02');

-- --------------------------------------------------------

--
-- Table structure for table `api_details`
--

CREATE TABLE `api_details` (
  `id` int(11) NOT NULL,
  `dimond_api_key` varchar(255) NOT NULL,
  `dimond_api_secret` varchar(255) NOT NULL,
  `ccavenue_api_key` varchar(255) NOT NULL,
  `ccavenue_api_secret` varchar(255) NOT NULL,
  `sms_api_key` varchar(255) NOT NULL,
  `sms_api_secret` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `api_details`
--

INSERT INTO `api_details` (`id`, `dimond_api_key`, `dimond_api_secret`, `ccavenue_api_key`, `ccavenue_api_secret`, `sms_api_key`, `sms_api_secret`, `created_at`, `updated_at`) VALUES
(1, 'rgsd15f151tgrf5g165g65ef1gh65t1gh5h', 'as465f465sdf45f45sd', 'a1sd65ad656sdf5asdf4sd5', 'a4d56as4d5as4df', 'nfhk4465dfgdfhfh165dfgh', 'dfg45dfg5sd54f5', '2018-04-30 06:59:29', '2018-04-30 07:07:09');

-- --------------------------------------------------------

--
-- Table structure for table `band_setting`
--

CREATE TABLE `band_setting` (
  `id` int(11) NOT NULL,
  `band_setting` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `band_setting`
--

INSERT INTO `band_setting` (`id`, `band_setting`, `slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Bar Setting', 'bar_setting', '1', '2018-04-21 05:32:03', '2018-04-21 05:34:15', NULL),
(3, 'Channel Setting', 'channel_setting', '1', '2018-04-21 05:34:45', '0000-00-00 00:00:00', NULL),
(4, 'Flush Setting', 'flush-setting', '1', '2018-04-21 05:35:15', '2018-05-17 03:47:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `user_type` enum('1','2','3','') NOT NULL COMMENT '1-admin,2-user,3-supplier',
  `account_holder_name` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `ifsc_code` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`id`, `user_id`, `user_type`, `account_holder_name`, `bank_name`, `branch`, `account_number`, `ifsc_code`, `created_at`, `updated_at`) VALUES
(1, 9, '1', 'Sagar', 'SBI', 'Nashik', '123456789', '56123', '2018-05-09 11:09:14', '2018-05-24 10:21:20'),
(3, 8, '2', 'Sagar', 'SBi', 'nashik', '123456789', 'sbi123', '2018-05-09 07:48:37', '2018-05-24 10:11:47'),
(4, 8, '3', 'Sagar', 'IOB', 'nashik', '123456789', 'sbi123', '2018-05-09 07:53:05', '2018-05-10 03:33:26'),
(5, 1, '2', 'Sagar Pawara', 'Bank Of Maharashtra', '', '454545', '4545455', '2018-05-10 04:20:36', '2018-06-21 20:06:39'),
(7, 1, '1', 'Admin Bank', 'SBI', 'Nashik', '9876543210', 'SBI123', '2018-05-24 05:40:05', '2018-05-24 05:40:18'),
(8, 13, '2', 'Anna Adam', 'Bank Of India', '', '852369852147852', 'NK0258452', '2018-06-18 13:40:23', '2018-06-18 13:40:23');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(50) NOT NULL,
  `blog_category_id` int(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `blog_image` varchar(255) NOT NULL,
  `no_of_views` int(11) NOT NULL DEFAULT '0',
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=block 1=unblock',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `blog_category_id`, `title`, `slug`, `description`, `blog_image`, `no_of_views`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 7, 'Beauty of London', 'beauty-of-london', '<p><span style=\"color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>There</strong> are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc</span></p>\r\n<p><span style=\"color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\"><span style=\"color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat <strong>predefined</strong> chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to <span style=\"text-decoration: underline;\">generate</span> Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always <strong>free</strong> from repetition, injected humour, or non-characteristic words etc</span></span></p>', '15367270975b9898390ca89.png', 12, '1', '2018-04-19 23:54:26', '2018-09-12 10:08:17', NULL),
(2, 8, 'Discover the Hong kong', 'discover-the-hong-kong', '<p><strong style=\"margin: 0px; padding: 0px; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">Lorem Ipsum</strong><span style=\"color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>\r\n<p><span style=\"color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\"><strong style=\"margin: 0px; padding: 0px; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Lorem Ipsum</strong><span style=\"color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></span></p>', '15367270805b9898286dce2.png', 9, '1', '2018-04-25 08:05:30', '2018-09-12 10:08:00', NULL),
(3, 9, 'The Amazing tokyo', 'the-amazing-tokyo', '<div style=\"font-size: 25px; font-weight: bold;\">Run in circles</div>\r\n<div style=\"font-size: 15px; font-weight: bold;\">Loved it, hated it, loved it, hated it claws in your leg cats go for world domination take a big fluffing crap</div>\r\n<p><span id=\"selectable\" style=\"color: #000000; font-family: Raleway, sans-serif; font-size: medium; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial;\"><span class=\"tooltiplink\" title=\"By: Anonymous \">Meow for food, then when human fills food dish, take a few bites of food and continue meowing</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Rune Tynan\">See owner, run in terror</span>&nbsp;cat snacks chew foot, or&nbsp;<span class=\"tooltiplink\" title=\"By: Jocelin Sanchez\">kitten is playing with dead mouse</span>&nbsp;or missing until dinner time&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">plan steps for world domination</span>&nbsp;but&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">bathe private parts with tongue then lick owner\'s face</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">White cat sleeps on a black shirt</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">paw at your fat belly</span>&nbsp;or&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">munch, munch, chomp, chomp</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">eat a plant, kill a hand</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">drool</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">Grab pompom in mouth and put in water dish</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">pet my belly, you know you want to; seize the hand and shred it!</span>&nbsp;so&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">purrrrrr</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Bram Stege\">if it fits, i sits</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">Pelt around the house and up and down stairs chasing phantoms</span>&nbsp;missing until dinner time&nbsp;<span class=\"tooltiplink\" title=\"By: Babs Saul\">curl up and sleep on the freshly laundered towels</span>&nbsp;so&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">destroy house in 5 seconds</span>&nbsp;for&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">somehow manage to catch a bird but have no idea what to do next, so play with it until it dies of shock</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">Lick sellotape</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">bleghbleghvomit my furball really tie the room together</span>&nbsp;but&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">jump on human and sleep on her all night long be long in the bed, purr in the morning and then give a bite to every human around for not waking up request food, purr loud scratch the walls, the floor, the windows, the humans</span>, so&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">it\'s 3am, time to create some chaos&nbsp;</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">Eats owners hair then claws head</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">have secret plans</span>&nbsp;yet&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">chase dog then run away</span>&nbsp;and&nbsp;<span class=\"tooltiplink\" title=\"By: Rune Tynan\">see owner, run in terror</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">hide head under blanket so no one can see</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">Stuff and things</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">demand to have some of whatever the human is cooking, then sniff the offering and walk away</span>, or&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">touch water with paw then recoil in horror</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Babs Saul\">curl up and sleep on the freshly laundered towels</span>&nbsp;or&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">scoot butt on the rug</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Fae \">refuse to drink water except out of someone\'s glass</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">i love cuddles</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">Poop in the plant pot</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">i like cats because they are fat and fluffy</span>, or&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">jump five feet high and sideways when a shadow moves</span>&nbsp;for&nbsp;<span class=\"tooltiplink\" title=\"By: Alejandra Larrosa\">sleep in the bathroom sink</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">Plays league of legends</span>&nbsp;sweet beast sun bathe, or&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">destroy house in 5 seconds</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">Cereal boxes make for five star accommodation&nbsp;</span><span class=\"tooltiplink\" title=\"By: Anonymous \">put butt in owner\'s face</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">Stares at human while pushing stuff off a table</span>&nbsp;<span class=\"tooltiplink\" title=\"By: R J\">be a nyan cat, feel great about it, be annoying 24/7 poop rainbows in litter box all day</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">meowing chowing and wowing</span>&nbsp;chase mice, yet&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">it\'s 3am, time to create some chaos&nbsp;</span><span class=\"tooltiplink\" title=\"By: Anonymous \">sleep everywhere, but not in my bed</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Steve Reinke\">chill on the couch table</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">Show belly</span>&nbsp;nap all day&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">scratch</span>&nbsp;claw drapes, so&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">purrr purr littel cat, little cat purr purr</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Jay Sylvano\">hiss at vacuum cleaner</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Thecatgod \">Make meme, make cute face</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Andie Bee\">try to jump onto window and fall while scratching at wall</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">always ensure to lay down in such a manner that tail can lightly brush human\'s nose&nbsp;</span>yet&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">trip on catnip</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">Toy mouse squeak roll over</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">peer out window, chatter at birds, lure them to mouth</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">Chew on cable</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">if human is on laptop sit on the keyboard</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">Scratch leg; meow for can opener to feed me</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Peter Tracy\">sit and stare</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">Sleeps on my head</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">Take a big fluffing crap </span><span class=\"tooltiplink\" title=\"By: Anonymous \">i am the best</span>&nbsp;for&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">attack the child</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Lacey Lurz\">Lick human with sandpaper tongue</span><span class=\"tooltiplink\" title=\"By: Anonymous \">meow to be let out</span>&nbsp;stretch&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">purr for no reason</span>,&nbsp;<span class=\"tooltiplink\" title=\"By: Zara Wheeler\">poop in a handbag look delicious and drink the soapy mopping up water then puke giant foamy fur-balls</span>&nbsp;or&nbsp;<span class=\"tooltiplink\" title=\"By: R J\">be a nyan cat, feel great about it, be annoying 24/7 poop rainbows in litter box all day</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Alice Coolaid\">Love and coo around boyfriend who purrs and makes the perfect moonlight eyes so i can purr and swat the glittery gleaming yarn to him (the yarn is from a $125 sweater)</span>&nbsp;lick butt.&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">Poop in the plant pot</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">Vommit food and eat it again</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">pee in the shoe</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">i am the best</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Kevin Brodeur\">cat is love, cat is life</span>&nbsp;for&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">the door is opening! how exciting oh, it\'s you, meh</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">Run outside as soon as door open</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">cereal boxes make for five star accommodation&nbsp;</span><span class=\"tooltiplink\" title=\"By: Anonymous \">litter kitter kitty litty little kitten big roar roar feed me</span>.&nbsp;<br /><br /><span class=\"tooltiplink\" title=\"By: Anonymous \">Vommit food and eat it again</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">disappear for four days and return home with an expensive injury; bite the vet</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">Ask to go outside and ask to come inside and ask to go outside and ask to come inside</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Kevin Brodeur\">cat is love, cat is life</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">Meow for food, then when human fills food dish, take a few bites of food and continue meowing</span>&nbsp;stick butt in face.&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">Eat grass, throw it back up</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">open the door, let me out, let me out, let me-out, let me-aow, let meaow, meaow!</span>&nbsp;so&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">mesmerizing birds</span>&nbsp;for&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">you call this cat food</span>.&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">Cat ass trophy</span>&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">walk on car leaving trail of paw prints on hood and windshield</span>&nbsp;but&nbsp;<span class=\"tooltiplink\" title=\"By: Anonymous \">cat fur is the new</span><br /></span></p>', '15367270555b98980f5efbf.png', 15, '1', '2018-04-25 08:06:56', '2018-09-12 10:07:35', NULL),
(4, 7, 'The Miracle of Singapore', 'the-miracle-of-singapore', '<p style=\"box-sizing: border-box; margin: 0px 0px 1.66667em; padding: 0px; line-height: inherit; font-size: 18px; color: #2a2c2e; font-family: ShopifySans, Helvetica, Arial, \'Lucida Grande\', sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\"><span style=\"box-sizing: border-box; font-weight: 400;\">Lorem ipsum has become the industry standard for design mockups and prototypes. By adding a little bit of Latin to a mockup, you’re able to show clients a more complete version of your design without actually having to invest time and effort drafting copy.</span></p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 1.66667em; padding: 0px; line-height: inherit; font-size: 18px; color: #2a2c2e; font-family: ShopifySans, Helvetica, Arial, \'Lucida Grande\', sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\"><strong style=\"box-sizing: border-box;\"><span style=\"box-sizing: border-box; font-weight: 400;\">But despite all its benefits, seeing the same random Latin text in every design can get a little boring for you and your clients. So if you have a client who’s got a sense of humour or if you’re just tired of going the traditional route in your mockups, here are 15 creative and funny lorem ipsum text generators that are sure to lighten the mood at any client meeting.</span></strong></p>', '15367270335b9897f928f4d.png', 82, '1', '2018-04-27 03:14:28', '2018-09-12 10:07:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `category_name`, `slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 'Ring', 'ring', '1', '2018-04-17 18:30:00', '2018-05-10 06:01:48', NULL),
(8, 'Breslate', 'breslate', '1', '2018-04-18 05:47:50', '2018-04-18 06:03:38', NULL),
(9, 'three', 'three', '1', '2018-04-25 08:04:54', '2018-04-25 08:04:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_comment`
--

CREATE TABLE `blog_comment` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_comment`
--

INSERT INTO `blog_comment` (`id`, `blog_id`, `user_id`, `title`, `comment`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 1, 'Demo Title', 'Demo Messages', '2018-05-14 08:21:14', '2018-05-14 08:21:14', NULL),
(2, 4, 1, 'Demo Title', 'Demo Messages', '2018-05-14 08:21:28', '2018-05-14 08:21:28', NULL),
(3, 4, 1, 'Demo Title', 'Qwerty', '2018-05-14 08:24:33', '2018-05-14 08:24:33', NULL),
(4, 2, 1, 'My ttitle', 'My mesage', '2018-05-16 23:26:20', '2018-05-16 23:26:20', NULL),
(5, 4, 1, '', 'test comment', '2018-05-17 00:25:13', '2018-05-17 00:25:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_gift_cards`
--

CREATE TABLE `cart_gift_cards` (
  `id` int(11) NOT NULL,
  `cart_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_gift_card_id` int(11) NOT NULL,
  `gift_card_code` varchar(255) NOT NULL,
  `amount` float(20,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cart_product`
--

CREATE TABLE `cart_product` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_size_id` int(11) NOT NULL,
  `product_metal_id` int(11) NOT NULL,
  `product_gemstone_id` int(11) NOT NULL,
  `product_insurance_id` int(11) DEFAULT NULL,
  `product_quantity` int(11) NOT NULL,
  `name_on_product` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_product`
--

INSERT INTO `cart_product` (`id`, `cart_id`, `product_id`, `product_size_id`, `product_metal_id`, `product_gemstone_id`, `product_insurance_id`, `product_quantity`, `name_on_product`, `created_at`, `updated_at`) VALUES
(61, 13, 26, 132, 104, 100, NULL, 5, NULL, '2018-06-19 05:26:57', '2018-06-19 05:27:13'),
(62, 13, 43, 0, 88, 89, NULL, 1, NULL, '2018-06-19 05:27:24', '2018-06-19 05:27:24'),
(63, 13, 28, 127, 57, 59, NULL, 1, NULL, '2018-06-19 05:27:40', '2018-06-19 05:27:40');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `product_type` enum('1','2') NOT NULL COMMENT '1=classic, 2=luxure',
  `category_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `product_type`, `category_name`, `slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', 'Diamond', 'diamond', '1', '2018-04-24 03:13:06', '2018-04-27 04:32:22', NULL),
(2, '1', 'Jewellery', 'jewellery', '1', '2018-04-24 03:13:23', '2018-04-24 03:13:23', NULL),
(3, '1', 'Fashion Jewellery', 'fashion-jewellery', '1', '2018-04-24 03:13:41', '2018-04-24 03:13:41', NULL),
(4, '2', 'Diamond', 'diamond-1', '1', '2018-04-24 03:13:51', '2018-04-27 04:33:16', NULL),
(5, '2', 'Jewellery', 'jewellery-1', '1', '2018-04-24 03:15:34', '2018-04-30 08:56:25', NULL),
(6, '2', 'Fashion Jewellery', 'fashion-jewellery-1', '1', '2018-04-24 03:16:02', '2018-04-24 03:16:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '1=active 2=blocked',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`id`, `name`, `description`, `image`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(13, 'Versace', 'Versace', '15265516225afd544640c20.png', 'versace', '1', '2018-05-17 04:37:02', '2018-05-18 11:16:18'),
(14, 'Armaani', 'Armaani', '15265516435afd545baa580.png', 'armaani', '1', '2018-05-17 04:37:23', '2018-05-18 11:16:26'),
(15, 'Collection For Everyday', 'COLLECTION FOR EVERYDAY', '15396118035bc49c9b0b068.jpg', 'collection-for-everyday', '1', '2018-10-15 19:26:43', '2018-10-15 19:26:43'),
(16, 'Collection For Formal', 'COLLECTION FOR FORMAL', '15396119015bc49cfd61408.jpg', 'collection-for-formal', '1', '2018-10-15 19:28:21', '2018-10-15 19:28:21'),
(17, 'Collection for wedding', 'Collection for wedding', '15396120505bc49d92e1b67.jpg', 'collection-for-wedding', '1', '2018-10-15 19:30:50', '2018-10-15 19:30:50');

-- --------------------------------------------------------

--
-- Table structure for table `contact_enquiry`
--

CREATE TABLE `contact_enquiry` (
  `id` int(11) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(60) NOT NULL,
  `message` varchar(500) NOT NULL,
  `status` enum('0','1') NOT NULL COMMENT '0 - Admin not responded, 2- Admin respnded',
  `admin_reply` varchar(555) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_enquiry`
--

INSERT INTO `contact_enquiry` (`id`, `first_name`, `last_name`, `email`, `contact_no`, `message`, `status`, `admin_reply`, `created_at`, `updated_at`) VALUES
(1, 'Vishal', 'Pawar', 'Jackhens123@gmail.com', '9898989898', 'This is an enquiry from user', '1', 'This is a reply from admin', '2018-04-18 18:30:00', '2018-04-19 05:48:59'),
(2, 'Deepak', 'Salunke', 'deepak@webwing.com', '9876543210', 'Testing contact form', '0', '0', '2018-05-14 01:09:08', '2018-05-14 01:09:08'),
(3, 'Deepak Salunke', '', 'deepaks@webwingtechnologies.com', '9638527410', 'Testing ask your question form', '0', '0', '2018-05-14 04:32:26', '2018-05-14 04:32:26'),
(4, 'Deepak Salunke', '', 'deepaks@webwingtechnologies.com', '9638527410', 'Testing', '0', '0', '2018-05-14 04:33:10', '2018-05-14 04:33:10'),
(5, 'Deepak Salunke', '', 'deepaks@webwingtechnologies.com', '9638527410', 'testing', '0', '0', '2018-05-14 04:33:54', '2018-05-14 04:33:54'),
(6, 'sagar', 'pawara', 'sagarpawara@gmail.com', '', 'kdfjd fjkdsjfksd', '0', '0', '2018-05-14 07:10:17', '2018-05-14 07:10:17'),
(7, 'Deepak', 'Salunke', 'deepak@gmail.com', '8527419630', 'Contact us form on about us page', '0', '0', '2018-05-23 01:24:00', '2018-05-23 01:24:00'),
(8, 'Deepak', 'Salunke', 'deepak@gmail.com', '9638527410', 'Qwerty', '0', '0', '2018-05-23 04:58:24', '2018-05-23 04:58:24'),
(9, 'Deepak', 'Salunke', 'deepak@gmail.com', '9638527410', 'qwerty', '0', '0', '2018-05-23 05:21:43', '2018-05-23 05:21:43'),
(10, 'Deepak', 'Salunke', 'deepak@gmail.com', '9638527410', 'Qwerty', '0', '0', '2018-05-23 05:26:03', '2018-05-23 05:26:03'),
(11, 'Deepak', 'Salunke', 'deepak@gmail.com', '9638527410', 'Qwerty', '0', '0', '2018-05-23 05:30:39', '2018-05-23 05:30:39'),
(12, 'Deepak', 'Salunke', 'deepak@gmail.com', '9638527410', 'Qwerty', '0', '0', '2018-05-23 05:31:08', '2018-05-23 05:31:08'),
(13, 'Deepak', 'Salunke', 'deepak@gmail.com', '9638527410', 'Qwerty', '0', '0', '2018-05-23 05:31:41', '2018-05-23 05:31:41'),
(14, 'dssd', 'sdsd', 'sddsds@gmail.com', '89898998', 'dsdsd', '0', '0', '2018-05-29 07:51:50', '2018-05-29 07:51:50'),
(15, 'dssd', 'sddsdsd', 'djsdjkd@gmail.com', '89898998', '8898989', '0', '0', '2018-05-29 07:52:14', '2018-05-29 07:52:14'),
(16, 'dsds', 'dssdsd', 'dsfsdf@gmail.com', '89898989', 'sdfs fkf krekr ewk erjwk sdjksdjksd', '0', '0', '2018-06-22 08:27:15', '2018-06-22 08:27:15'),
(17, 'dsds', 'sdsdsd', 'sdsdsd@gmail.com', '89899844', 'sdsd', '0', '0', '2018-06-22 08:29:22', '2018-06-22 08:29:22'),
(18, 'sdsdsdsd', 'dsssdsd', 'dssdsd@gmail.com', '89898989', 'sdsdsdsdsd', '0', '0', '2018-06-22 08:31:48', '2018-06-22 08:31:48'),
(19, 'sdds', 'dsds', 'dds@gmail.com', '89899889', 'dssdsdsd', '0', '0', '2018-06-22 08:36:14', '2018-06-22 08:36:14');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `CountryCode` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=block,1=active',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `CountryCode`, `name`, `phonecode`, `is_active`, `updated_at`) VALUES
(1, 'AF', 'Afghanistan', 93, '1', '2017-11-28 23:45:12'),
(2, 'AL', 'Albania', 355, '1', '2017-11-28 23:45:12'),
(3, 'DZ', 'Algeria', 213, '1', '2017-11-28 23:45:12'),
(4, 'AS', 'American Samoa', 1684, '1', '2017-11-28 23:45:12'),
(5, 'AD', 'Andorra', 376, '1', '2017-11-28 23:45:12'),
(6, 'AO', 'Angola', 244, '1', '2017-11-28 23:45:12'),
(7, 'AI', 'Anguilla', 1264, '1', '2017-11-28 23:45:12'),
(8, 'AQ', 'Antarctica', 0, '1', '2017-11-28 23:45:12'),
(9, 'AG', 'Antigua And Barbuda', 1268, '1', '2017-11-28 23:45:12'),
(10, 'AR', 'Argentina', 54, '1', '2017-11-28 23:45:12'),
(11, 'AM', 'Armenia', 374, '1', '2017-11-03 14:39:54'),
(12, 'AW', 'Aruba', 297, '1', '2017-11-03 14:39:54'),
(13, 'AU', 'Australia', 61, '1', '2017-11-03 14:39:54'),
(14, 'AT', 'Austria', 43, '1', '2017-11-03 14:39:54'),
(15, 'AZ', 'Azerbaijan', 994, '1', '2017-11-03 14:39:54'),
(16, 'BS', 'Bahamas The', 1242, '1', '2017-11-03 14:39:54'),
(17, 'BH', 'Bahrain', 973, '1', '2017-11-03 14:39:54'),
(18, 'BD', 'Bangladesh', 880, '1', '2017-11-03 14:39:54'),
(19, 'BB', 'Barbados', 1246, '1', '2017-11-03 14:39:54'),
(20, 'BY', 'Belarus', 375, '1', '2017-11-03 14:39:54'),
(21, 'BE', 'Belgium', 32, '1', '2017-11-03 14:40:05'),
(22, 'BZ', 'Belize', 501, '1', '2017-11-03 14:40:05'),
(23, 'BJ', 'Benin', 229, '1', '2017-11-03 14:40:05'),
(24, 'BM', 'Bermuda', 1441, '1', '2017-11-03 14:40:05'),
(25, 'BT', 'Bhutan', 975, '1', '2017-11-03 14:40:05'),
(26, 'BO', 'Bolivia', 591, '1', '2017-11-03 14:40:05'),
(27, 'BA', 'Bosnia and Herzegovina', 387, '1', '2017-11-03 14:40:05'),
(28, 'BW', 'Botswana', 267, '1', '2017-11-03 14:40:05'),
(29, 'BV', 'Bouvet Island', 0, '1', '2017-11-03 14:40:05'),
(30, 'BR', 'Brazil', 55, '1', '2017-11-03 14:40:05'),
(31, 'IO', 'British Indian Ocean Territory', 246, '1', '2017-10-18 11:44:41'),
(32, 'BN', 'Brunei', 673, '1', '2017-10-18 11:44:41'),
(33, 'BG', 'Bulgaria', 359, '1', '2017-10-18 11:44:41'),
(34, 'BF', 'Burkina Faso', 226, '1', '2017-10-18 11:44:41'),
(35, 'BI', 'Burundi', 257, '1', '2017-10-18 11:44:41'),
(36, 'KH', 'Cambodia', 855, '1', '2017-10-18 11:44:41'),
(37, 'CM', 'Cameroon', 237, '1', '2017-10-18 11:44:41'),
(38, 'CA', 'Canada', 1, '1', '2017-10-18 11:44:41'),
(39, 'CV', 'Cape Verde', 238, '1', '2017-10-18 11:44:41'),
(40, 'KY', 'Cayman Islands', 1345, '1', '2017-10-18 11:44:41'),
(41, 'CF', 'Central African Republic', 236, '1', '2017-10-18 11:44:41'),
(42, 'TD', 'Chad', 235, '1', '2017-10-18 11:44:41'),
(43, 'CL', 'Chile', 56, '1', '2017-10-18 11:44:41'),
(44, 'CN', 'China', 86, '1', '2017-10-18 11:44:41'),
(45, 'CX', 'Christmas Island', 61, '1', '2017-10-18 11:44:41'),
(46, 'CC', 'Cocos (Keeling) Islands', 672, '1', '2017-10-18 11:44:41'),
(47, 'CO', 'Colombia', 57, '1', '2017-10-18 11:44:41'),
(48, 'KM', 'Comoros', 269, '1', '2017-10-18 11:44:41'),
(49, 'CG', 'Republic Of The Congo', 242, '1', '2017-10-18 11:44:41'),
(50, 'CD', 'Democratic Republic Of The Congo', 242, '1', '2017-10-18 11:44:41'),
(51, 'CK', 'Cook Islands', 682, '1', '2017-10-18 11:44:41'),
(52, 'CR', 'Costa Rica', 506, '1', '2017-10-18 11:44:41'),
(53, 'CI', 'Cote D\'Ivoire (Ivory Coast)', 225, '1', '2017-10-18 11:44:41'),
(54, 'HR', 'Croatia (Hrvatska)', 385, '1', '2017-10-18 11:44:41'),
(55, 'CU', 'Cuba', 53, '1', '2017-10-18 11:44:41'),
(56, 'CY', 'Cyprus', 357, '1', '2017-10-18 11:44:41'),
(57, 'CZ', 'Czech Republic', 420, '1', '2017-10-18 11:44:41'),
(58, 'DK', 'Denmark', 45, '1', '2017-10-18 11:44:41'),
(59, 'DJ', 'Djibouti', 253, '1', '2017-10-18 11:44:41'),
(60, 'DM', 'Dominica', 1767, '1', '2017-10-18 11:44:41'),
(61, 'DO', 'Dominican Republic', 1809, '1', '2017-10-18 11:44:41'),
(62, 'TP', 'East Timor', 670, '1', '2017-10-18 11:44:41'),
(63, 'EC', 'Ecuador', 593, '1', '2017-10-18 11:44:41'),
(64, 'EG', 'Egypt', 20, '1', '2017-10-18 11:44:41'),
(65, 'SV', 'El Salvador', 503, '1', '2017-10-18 11:44:41'),
(66, 'GQ', 'Equatorial Guinea', 240, '1', '2017-10-18 11:44:41'),
(67, 'ER', 'Eritrea', 291, '1', '2017-10-18 11:44:41'),
(68, 'EE', 'Estonia', 372, '1', '2017-10-18 11:44:41'),
(69, 'ET', 'Ethiopia', 251, '1', '2017-10-18 11:44:41'),
(70, 'XA', 'External Territories of Australia', 61, '1', '2017-10-18 11:44:41'),
(71, 'FK', 'Falkland Islands', 500, '1', '2017-10-18 11:44:41'),
(72, 'FO', 'Faroe Islands', 298, '1', '2017-10-18 11:44:41'),
(73, 'FJ', 'Fiji Islands', 679, '1', '2017-10-18 11:44:41'),
(74, 'FI', 'Finland', 358, '1', '2017-10-18 11:44:41'),
(75, 'FR', 'France', 33, '1', '2017-10-18 11:44:41'),
(76, 'GF', 'French Guiana', 594, '1', '2017-10-18 11:44:41'),
(77, 'PF', 'French Polynesia', 689, '1', '2017-10-18 11:44:41'),
(78, 'TF', 'French Southern Territories', 0, '1', '2017-10-18 11:44:41'),
(79, 'GA', 'Gabon', 241, '1', '2017-10-18 11:44:41'),
(80, 'GM', 'Gambia The', 220, '1', '2017-10-18 11:44:41'),
(81, 'GE', 'Georgia', 995, '1', '2017-10-18 11:44:41'),
(82, 'DE', 'Germany', 49, '1', '2017-10-18 11:44:41'),
(83, 'GH', 'Ghana', 233, '1', '2017-10-18 11:44:41'),
(84, 'GI', 'Gibraltar', 350, '1', '2017-10-18 11:44:41'),
(85, 'GR', 'Greece', 30, '1', '2017-10-18 11:44:41'),
(86, 'GL', 'Greenland', 299, '1', '2017-10-18 11:44:41'),
(87, 'GD', 'Grenada', 1473, '1', '2017-10-18 11:44:41'),
(88, 'GP', 'Guadeloupe', 590, '1', '2017-10-18 11:44:41'),
(89, 'GU', 'Guam', 1671, '1', '2017-10-18 11:44:41'),
(90, 'GT', 'Guatemala', 502, '1', '2017-10-18 11:44:41'),
(91, 'XU', 'Guernsey and Alderney', 44, '1', '2017-10-18 11:44:41'),
(92, 'GN', 'Guinea', 224, '1', '2017-10-18 11:44:41'),
(93, 'GW', 'Guinea-Bissau', 245, '1', '2017-10-18 11:44:41'),
(94, 'GY', 'Guyana', 592, '1', '2017-10-18 11:44:41'),
(95, 'HT', 'Haiti', 509, '1', '2017-10-18 11:44:41'),
(96, 'HM', 'Heard and McDonald Islands', 0, '1', '2017-10-18 11:44:41'),
(97, 'HN', 'Honduras', 504, '1', '2017-10-18 11:44:41'),
(98, 'HK', 'Hong Kong S.A.R.', 852, '1', '2017-10-18 11:44:41'),
(99, 'HU', 'Hungary', 36, '1', '2017-10-18 11:44:41'),
(100, 'IS', 'Iceland', 354, '1', '2017-10-18 11:44:41'),
(101, 'IN', 'India', 91, '1', '2017-10-18 11:44:41'),
(102, 'ID', 'Indonesia', 62, '1', '2017-10-18 11:44:41'),
(103, 'IR', 'Iran', 98, '1', '2017-10-18 11:44:41'),
(104, 'IQ', 'Iraq', 964, '1', '2017-10-18 11:44:41'),
(105, 'IE', 'Ireland', 353, '1', '2017-10-18 11:44:41'),
(106, 'IL', 'Israel', 972, '1', '2017-10-18 11:44:41'),
(107, 'IT', 'Italy', 39, '1', '2017-10-18 11:44:41'),
(108, 'JM', 'Jamaica', 1876, '1', '2017-10-18 11:44:41'),
(109, 'JP', 'Japan', 81, '1', '2017-10-18 11:44:41'),
(110, 'XJ', 'Jersey', 44, '1', '2017-10-18 11:44:41'),
(111, 'JO', 'Jordan', 962, '1', '2017-10-18 11:44:41'),
(112, 'KZ', 'Kazakhstan', 7, '1', '2017-10-18 11:44:41'),
(113, 'KE', 'Kenya', 254, '1', '2017-10-18 11:44:41'),
(114, 'KI', 'Kiribati', 686, '1', '2017-10-18 11:44:41'),
(115, 'KP', 'Korea North', 850, '1', '2017-10-18 11:44:41'),
(116, 'KR', 'Korea South', 82, '1', '2017-10-18 11:44:41'),
(117, 'KW', 'Kuwait', 965, '1', '2017-10-18 11:44:41'),
(118, 'KG', 'Kyrgyzstan', 996, '1', '2017-10-18 11:44:41'),
(119, 'LA', 'Laos', 856, '1', '2017-10-18 11:44:41'),
(120, 'LV', 'Latvia', 371, '1', '2017-10-18 11:44:41'),
(121, 'LB', 'Lebanon', 961, '1', '2017-10-18 11:44:41'),
(122, 'LS', 'Lesotho', 266, '1', '2017-10-18 11:44:41'),
(123, 'LR', 'Liberia', 231, '1', '2017-10-18 11:44:41'),
(124, 'LY', 'Libya', 218, '1', '2017-10-18 11:44:41'),
(125, 'LI', 'Liechtenstein', 423, '1', '2017-10-18 11:44:41'),
(126, 'LT', 'Lithuania', 370, '1', '2017-10-18 11:44:41'),
(127, 'LU', 'Luxembourg', 352, '1', '2017-10-18 11:44:41'),
(128, 'MO', 'Macau S.A.R.', 853, '1', '2017-10-18 11:44:41'),
(129, 'MK', 'Macedonia', 389, '1', '2017-10-18 11:44:41'),
(130, 'MG', 'Madagascar', 261, '1', '2017-10-18 11:44:41'),
(131, 'MW', 'Malawi', 265, '1', '2017-10-18 11:44:41'),
(132, 'MY', 'Malaysia', 60, '1', '2017-10-18 11:44:41'),
(133, 'MV', 'Maldives', 960, '1', '2017-10-18 11:44:41'),
(134, 'ML', 'Mali', 223, '1', '2017-10-18 11:44:41'),
(135, 'MT', 'Malta', 356, '1', '2017-10-18 11:44:41'),
(136, 'XM', 'Man (Isle of)', 44, '1', '2017-10-18 11:44:41'),
(137, 'MH', 'Marshall Islands', 692, '1', '2017-10-18 11:44:41'),
(138, 'MQ', 'Martinique', 596, '1', '2017-10-18 11:44:41'),
(139, 'MR', 'Mauritania', 222, '1', '2017-10-18 11:44:41'),
(140, 'MU', 'Mauritius', 230, '1', '2017-10-18 11:44:41'),
(141, 'YT', 'Mayotte', 269, '1', '2017-10-18 11:44:41'),
(142, 'MX', 'Mexico', 52, '1', '2017-10-18 11:44:41'),
(143, 'FM', 'Micronesia', 691, '1', '2017-10-18 11:44:41'),
(144, 'MD', 'Moldova', 373, '1', '2017-10-18 11:44:41'),
(145, 'MC', 'Monaco', 377, '1', '2017-10-18 11:44:41'),
(146, 'MN', 'Mongolia', 976, '1', '2017-10-18 11:44:41'),
(147, 'MS', 'Montserrat', 1664, '1', '2017-10-18 11:44:41'),
(148, 'MA', 'Morocco', 212, '1', '2017-10-18 11:44:41'),
(149, 'MZ', 'Mozambique', 258, '1', '2017-10-18 11:44:41'),
(150, 'MM', 'Myanmar', 95, '1', '2017-10-18 11:44:41'),
(151, 'NA', 'Namibia', 264, '1', '2017-10-18 11:44:41'),
(152, 'NR', 'Nauru', 674, '1', '2017-10-18 11:44:41'),
(153, 'NP', 'Nepal', 977, '1', '2017-10-18 11:44:41'),
(154, 'AN', 'Netherlands Antilles', 599, '1', '2017-10-18 11:44:41'),
(155, 'NL', 'Netherlands The', 31, '1', '2017-10-18 11:44:41'),
(156, 'NC', 'New Caledonia', 687, '1', '2017-10-18 11:44:41'),
(157, 'NZ', 'New Zealand', 64, '1', '2017-10-18 11:44:41'),
(158, 'NI', 'Nicaragua', 505, '1', '2017-10-18 11:44:41'),
(159, 'NE', 'Niger', 227, '1', '2017-10-18 11:44:41'),
(160, 'NG', 'Nigeria', 234, '1', '2017-10-18 11:44:41'),
(161, 'NU', 'Niue', 683, '1', '2017-10-18 11:44:41'),
(162, 'NF', 'Norfolk Island', 672, '1', '2017-10-18 11:44:41'),
(163, 'MP', 'Northern Mariana Islands', 1670, '1', '2017-10-18 11:44:41'),
(164, 'NO', 'Norway', 47, '1', '2017-10-18 11:44:41'),
(165, 'OM', 'Oman', 968, '1', '2017-10-18 11:44:41'),
(166, 'PK', 'Pakistan', 92, '1', '2017-10-18 11:44:41'),
(167, 'PW', 'Palau', 680, '1', '2017-10-18 11:44:41'),
(168, 'PS', 'Palestinian Territory Occupied', 970, '1', '2017-10-18 11:44:41'),
(169, 'PA', 'Panama', 507, '1', '2017-10-18 11:44:41'),
(170, 'PG', 'Papua new Guinea', 675, '1', '2017-10-18 11:44:41'),
(171, 'PY', 'Paraguay', 595, '1', '2017-10-18 11:44:41'),
(172, 'PE', 'Peru', 51, '1', '2017-10-18 11:44:41'),
(173, 'PH', 'Philippines', 63, '1', '2017-10-18 11:44:41'),
(174, 'PN', 'Pitcairn Island', 0, '1', '2017-10-18 11:44:41'),
(175, 'PL', 'Poland', 48, '1', '2017-10-18 11:44:41'),
(176, 'PT', 'Portugal', 351, '1', '2017-10-18 11:44:41'),
(177, 'PR', 'Puerto Rico', 1787, '1', '2017-10-18 11:44:41'),
(178, 'QA', 'Qatar', 974, '1', '2017-10-18 11:44:41'),
(179, 'RE', 'Reunion', 262, '1', '2017-10-18 11:44:41'),
(180, 'RO', 'Romania', 40, '1', '2017-10-18 11:44:41'),
(181, 'RU', 'Russia', 70, '1', '2017-10-18 11:44:41'),
(182, 'RW', 'Rwanda', 250, '1', '2017-10-18 11:44:41'),
(183, 'SH', 'Saint Helena', 290, '1', '2017-10-18 11:44:41'),
(184, 'KN', 'Saint Kitts And Nevis', 1869, '1', '2017-10-18 11:44:41'),
(185, 'LC', 'Saint Lucia', 1758, '1', '2017-10-18 11:44:41'),
(186, 'PM', 'Saint Pierre and Miquelon', 508, '1', '2017-10-18 11:44:41'),
(187, 'VC', 'Saint Vincent And The Grenadines', 1784, '1', '2017-10-18 11:44:41'),
(188, 'WS', 'Samoa', 684, '1', '2017-10-18 11:44:41'),
(189, 'SM', 'San Marino', 378, '1', '2017-10-18 11:44:41'),
(190, 'ST', 'Sao Tome and Principe', 239, '1', '2017-10-18 11:44:41'),
(191, 'SA', 'Saudi Arabia', 966, '1', '2017-10-18 11:44:41'),
(192, 'SN', 'Senegal', 221, '1', '2017-10-18 11:44:41'),
(193, 'RS', 'Serbia', 381, '1', '2017-10-18 11:44:41'),
(194, 'SC', 'Seychelles', 248, '1', '2017-10-18 11:44:41'),
(195, 'SL', 'Sierra Leone', 232, '1', '2017-10-18 11:44:41'),
(196, 'SG', 'Singapore', 65, '1', '2017-10-18 11:44:41'),
(197, 'SK', 'Slovakia', 421, '1', '2017-10-18 11:44:41'),
(198, 'SI', 'Slovenia', 386, '1', '2017-10-18 11:44:41'),
(199, 'XG', 'Smaller Territories of the UK', 44, '1', '2017-10-18 11:44:41'),
(200, 'SB', 'Solomon Islands', 677, '1', '2017-10-18 11:44:41'),
(201, 'SO', 'Somalia', 252, '1', '2017-10-18 11:44:41'),
(202, 'ZA', 'South Africa', 27, '1', '2017-10-18 11:44:41'),
(203, 'GS', 'South Georgia', 0, '1', '2017-10-18 11:44:41'),
(204, 'SS', 'South Sudan', 211, '1', '2017-10-18 11:44:41'),
(205, 'ES', 'Spain', 34, '1', '2017-10-18 11:44:41'),
(206, 'LK', 'Sri Lanka', 94, '1', '2017-10-18 11:44:41'),
(207, 'SD', 'Sudan', 249, '1', '2017-10-18 11:44:41'),
(208, 'SR', 'Suriname', 597, '1', '2017-10-18 11:44:41'),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 47, '1', '2017-10-18 11:44:41'),
(210, 'SZ', 'Swaziland', 268, '1', '2017-10-18 11:44:41'),
(211, 'SE', 'Sweden', 46, '1', '2017-10-18 11:44:41'),
(212, 'CH', 'Switzerland', 41, '1', '2017-10-18 11:44:41'),
(213, 'SY', 'Syria', 963, '1', '2017-10-18 11:44:41'),
(214, 'TW', 'Taiwan', 886, '1', '2017-10-18 11:44:41'),
(215, 'TJ', 'Tajikistan', 992, '1', '2017-10-18 11:44:41'),
(216, 'TZ', 'Tanzania', 255, '1', '2017-10-18 11:44:41'),
(217, 'TH', 'Thailand', 66, '1', '2017-10-18 11:44:41'),
(218, 'TG', 'Togo', 228, '1', '2017-10-18 11:44:41'),
(219, 'TK', 'Tokelau', 690, '1', '2017-10-18 11:44:41'),
(220, 'TO', 'Tonga', 676, '1', '2017-10-18 11:44:41'),
(221, 'TT', 'Trinidad And Tobago', 1868, '1', '2017-10-18 11:44:41'),
(222, 'TN', 'Tunisia', 216, '1', '2017-10-18 11:44:41'),
(223, 'TR', 'Turkey', 90, '1', '2017-10-18 11:44:41'),
(224, 'TM', 'Turkmenistan', 7370, '1', '2017-10-18 11:44:41'),
(225, 'TC', 'Turks And Caicos Islands', 1649, '1', '2017-10-18 11:44:41'),
(226, 'TV', 'Tuvalu', 688, '1', '2017-10-18 11:44:41'),
(227, 'UG', 'Uganda', 256, '1', '2017-10-18 11:44:41'),
(228, 'UA', 'Ukraine', 380, '1', '2017-10-18 11:44:41'),
(229, 'AE', 'United Arab Emirates', 971, '1', '2017-10-18 11:44:41'),
(230, 'GB', 'United Kingdom', 44, '1', '2017-10-18 11:44:41'),
(231, 'US', 'United States', 1, '1', '2017-10-18 11:44:41'),
(232, 'UM', 'United States Minor Outlying Islands', 1, '1', '2017-10-18 11:44:41'),
(233, 'UY', 'Uruguay', 598, '1', '2017-10-18 11:44:41'),
(234, 'UZ', 'Uzbekistan', 998, '1', '2017-10-18 11:44:41'),
(235, 'VU', 'Vanuatu', 678, '1', '2017-10-18 11:44:41'),
(236, 'VA', 'Vatican City State (Holy See)', 39, '1', '2017-10-18 11:44:41'),
(237, 'VE', 'Venezuela', 58, '1', '2017-10-18 11:44:41'),
(238, 'VN', 'Vietnam', 84, '1', '2017-10-18 11:44:41'),
(239, 'VG', 'Virgin Islands (British)', 1284, '1', '2017-10-18 11:44:41'),
(240, 'VI', 'Virgin Islands (US)', 1340, '1', '2017-10-18 11:44:41'),
(241, 'WF', 'Wallis And Futuna Islands', 681, '1', '2017-10-18 11:44:41'),
(242, 'EH', 'Western Sahara', 212, '1', '2017-10-18 11:44:41'),
(243, 'YE', 'Yemen', 967, '1', '2017-10-18 11:44:41'),
(244, 'YU', 'Yugoslavia', 38, '1', '2017-10-18 11:44:41'),
(245, 'ZM', 'Zambia', 260, '1', '2017-10-18 11:44:41'),
(246, 'ZW', 'Zimbabwe', 263, '1', '2017-10-18 11:44:41');

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE `email_template` (
  `id` int(11) NOT NULL,
  `template_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `template_subject` text COLLATE utf8_unicode_ci NOT NULL,
  `template_from` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `template_from_mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `template_html` text COLLATE utf8_unicode_ci NOT NULL,
  `template_variables` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NA' COMMENT '~ Separated',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`id`, `template_name`, `template_subject`, `template_from`, `template_from_mail`, `template_html`, `template_variables`, `created_at`, `updated_at`) VALUES
(1, 'Contact Enquiry reply', 'Amaaia : Contact Enquiry reply', 'Amaaia - Admin', 'admin@support.com', '<table style=\"margin-bottom: 0;\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center;\">##SUBJECT##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #f6929b; font-family: \'Latomedium\',sans-serif;\">##USERNAME##,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">\r\n<p>Amaaia admin replied to your enquiry -</p>\r\n<p>##REPLY##</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">&nbsp;</td>\r\n</tr>\r\n<!-- <tr>\r\n			<td class=\"listed-btn\"><a href=\"##VERIFICATION_LINK##\">Verify Account</a></td>\r\n		</tr> -->\r\n<tr>\r\n<td height=\"40\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n<!-- </table> --></table>', '##USERNAME##~##REPLY##', '2018-04-18 18:30:00', '2018-06-25 05:22:56'),
(3, 'Forgot Password', 'Amaaia : Forgot Password', 'Amaaia - Admin', 'admin@support.com', '<table style=\"margin-bottom: 0;\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center;\">##SUBJECT##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #f6929b; font-family: \'Latomedium\',sans-serif;\">##USER_NAME##,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">You are recently requested a password reset,Please click on below link to reset your account password.</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td class=\"listed-btn\"><a style=\"border: 1px solid #f6929b; color: #f6929b; display: block; font-size: 15px; letter-spacing: 0.4px; margin: 0 auto; max-width: 204px; padding: 9px 4px; height: initial; text-align: center; text-transform: uppercase; text-decoration: none; width: 100%;\" href=\"##SITE_URL##\">Reset Password</a></td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>', '##USERNAME##~##REPLY##', '2018-04-18 09:00:00', '2018-06-25 05:23:15'),
(4, 'Account Verification', 'Amaaia : Account Verification', 'Admin Amaaia', 'admin@webwing.com', '<table style=\"margin-bottom: 0;\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center;\">##SUBJECT##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #f6929b; font-family: \'Latomedium\',sans-serif;\">##FIRST_NAME##,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">Congratulations! You are successfully registered as ##USER_TYPE## on ##PROJECT_NAME##. Thank you for choosing ##PROJECT_NAME##. Please click on below button to verify your account.</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td class=\"listed-btn\"><a style=\"border: 1px solid #f6929b; color: #f6929b; display: block; font-size: 15px; letter-spacing: 0.4px; margin: 0 auto; max-width: 204px; padding: 9px 4px; height: initial; text-align: center; text-transform: uppercase; text-decoration: none; width: 100%;\" href=\"##VERIFICATION_LINK##\">Verify Account</a></td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n<!-- </table> --></table>', '##FIRST_NAME##~##USER_TYPE##~##PROJECT_NAME##~##VERIFICATION_LINK##', '2018-04-26 18:30:00', '2018-06-25 05:22:37'),
(5, 'Send Gift Card', 'Amaaia : Received Gift Card', 'Admin Amaaia', 'admin@webwing.com', '<table style=\"margin-bottom: 0;\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center;\">##SUBJECT##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello dear customer<span style=\"color: #f6929b; font-family: \'Latomedium\',sans-serif;\">,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">\r\n<p>##SENDER_NAME## has sent you gift card ##CARD_NAME## on ##WEBSITE_NAME## with amount of Rs ##AMOUNT##. Your gift card code is ##GIFT_CARD_CODE##, which is required while placing order. If you don\'t have an account with email ##EMAIL##, then register after that only you can use this gift card. You required ##MOBILE_NO## mobile no. while using this gift card.</p>\r\n<p>You can register yourself on ##SIGNUP_LINK##.</p>\r\n<p>Visit ##PROJECT_LINK## for details.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td class=\"listed-btn\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n<!-- </table> --></table>', '##FIRST_NAME##~##USER_TYPE##~##PROJECT_NAME##~##VERIFICATION_LINK##', '2018-05-30 18:30:00', '2018-06-25 05:22:16');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`, `status`, `created_at`, `updated_at`) VALUES
(1, 'How to identify original Diamond?', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates quisquam quas, ipsa nisi at sint dicta iste soluta magni earum iure optio atque expedita inventore dolores et debitis corporis illum. Reprehenderit neque maxime enim in temporibus nihil soluta porro perspiciatis.', '1', '2018-04-19 00:53:30', '2018-05-14 09:15:49'),
(2, 'What is Platanium?', 'Secoin encaustic cement tiles are hand-made, aesthetic tiles with many colored patterns used for floor and wall coverings. Our tiles are made with two layers: The first layer (about 2-3mm thick) is a mixture of white cement, pigment, stone powder and additives which is hand-poured into divider mould to create desired patterned. The second layer is made of grey cement and sand to ensure the strength of tiles.', '1', '2018-04-21 05:04:48', '2018-05-14 09:15:43');

-- --------------------------------------------------------

--
-- Table structure for table `front_pages`
--

CREATE TABLE `front_pages` (
  `id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_description` text NOT NULL,
  `slug` varchar(300) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(500) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `front_pages`
--

INSERT INTO `front_pages` (`id`, `page_title`, `page_description`, `slug`, `meta_keyword`, `meta_title`, `meta_description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'About Us', '<div style=\"margin: 0px 28.7969px 0px 14.3906px; padding: 0px; width: 436.797px; text-align: left; float: right; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">&nbsp;</div>\r\n<div style=\"margin: 0px 14.3906px 0px 28.7969px; padding: 0px; width: 436.797px; text-align: left; float: left; color: #000000; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">\r\n<h2 style=\"margin: 0px 0px 10px; padding: 0px; font-weight: 400; line-height: 24px; font-family: DauphinPlain; font-size: 24px; text-align: left;\">What is Lorem Ipsum?</h2>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify;\"><strong style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify;\">&nbsp;</p>\r\n<h2 style=\"margin: 0px 0px 10px; padding: 0px; font-weight: 400; line-height: 24px; font-family: DauphinPlain; font-size: 24px;\">Where does it come from?</h2>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify;\">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n</div>', 'about-us', 'About Us', 'About Us', 'About Us', '1', '2018-04-18 00:47:16', '2018-04-18 00:47:16', NULL),
(3, 'Terms of Use', '<div class=\"terms-condition-wrapper\">\r\n   <div class=\"container\">\r\n       <div class=\"terms-condition-inner\">\r\n        <div class=\"welcome-to-travel\">\r\n            <h1> Lorem ipsum dolor sit amet </h1>\r\n            <p class=\"terms-margin-botto\">\r\n                These terms and conditions outline the rules and regulations for the use of Accommodation Portal\'s Website. Accommodation Portal is located at:\r\n            </p>\r\n            <p class=\"terms-margin-botto add\">\r\n                2708 Burwell Heights Road, Warren, TX 77664 United States\r\n            </p>\r\n            <p class=\"terms-margin-botto\">\r\n                By accessing this website we assume you accept these terms and conditions in full. Do not continue to use Accommodation Portal\'s website if you do not accept all of the terms and conditions stated on this page.\r\n            </p>\r\n            <p class=\"terms-margin-botto\">\r\n                The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and any or all Agreements: \"Client\", \"You\" and \"You\" By accessing this website we assume you accept these terms and conditions in full. Do not continue to use Accommodation Portal\'s website if you do not accept all of the terms and conditions stated on this page. By accessing this website we assume you accept these terms and conditions in full. Do not continue to use Accommodation Portal\'s website if you do not accept all of the terms and conditions stated on this page. By accessing this website we assume you accept these terms and conditions in full. Do not continue to use Accommodation Portal\'s website if you do not accept all of the terms and conditions stated on this page.\r\n\r\n            </p>\r\n        </div>\r\n        <div class=\"cookies-block\">\r\n            <h1> Lorem ipsum </h1>\r\n            <p class=\"terms-margin-botto m-b-0\">\r\n                employ the use of cookies. By using Accommodation Portal\'s website you consent to the use of cookies in accordance with Accommodation Portal\'s privacy policy.\r\n            </p>\r\n            <p class=\"terms-margin-botto\">\r\n                Most of the modern day interactive web sites use cookies to enable us to retrieve user details for each visit. Cookies are used in some areas of our site to enable the functionality of this area and ease of use for those people visiting. Some of our affiliate / advertising partners may also use cookies\r\n            </p>\r\n\r\n        </div>\r\n        <div class=\"cookies-block\">\r\n            <h1> Lorem ipsum dolor </h1>\r\n            <p class=\"terms-margin-botto\">\r\n                Most of the modern day interactive web sites use cookies to enable us to retrieve user details for each visit. Cookies are used in some areas of our site to enable the functionality of this area and ease of use for those people visiting. Some of our affiliate / advertising partners may also use cookies enable the functionality of this area and ease of use for those people visiting. Some of our affiliate / advertising partners may also use cookies\r\n            </p>\r\n            <p class=\"terms-margin-botto m-b-0\">\r\n                You must not:\r\n            </p>\r\n            <div class=\"boolet-block\">\r\n                <span class=\"yellow-circle\"><i class=\"fa fa-circle\" aria-hidden=\"true\"></i></span>\r\n                <span class=\"yellow-circle\"><i class=\"fa fa-circle\" aria-hidden=\"true\"></i></span>\r\n                <span class=\"yellow-circle\"><i class=\"fa fa-circle\" aria-hidden=\"true\"></i></span>\r\n            </div>\r\n\r\n            <div class=\"boolet-text-block\">\r\n                <div class=\"boolet-text\"> Republish material from http://www.example.com Sell, rent or sub-license material from http://www.example.com Reproduce, duplicate or copy material from http://www.example.com </div>\r\n            </div>\r\n        </div>\r\n        <p class=\"terms-margin-botto\">\r\n            Redistribute content from Accommodation Portal (unless content is specifically made for redistribution).\r\n        </p>\r\n        <div class=\"cookies-block\">\r\n            <h1> Lorem ipsum amet </h1>\r\n            <ul>\r\n                <li>\r\n                    This Agreement shall begin on the date hereof.\r\n                </li>\r\n                <li>\r\n                    Certain parts of this website offer the opportunity for users to post and exchange opinions, information, material and data (\'Comments\') in a asof the website. Accommodation Portal does not screen, edit, publish or review Comments prior to their appearance on the website and comments do not reflect the views or opinions of Accommodation Portal, its agents or affiliates. Comments reflect the view and opinion of the person who posts such view or opinion. To the extent permitted by applicable laws Accommodation Portal shall not be responsible or liable for the Comments or for any loss cost, liability, damages or expenses caused and or suffered as a result of any use of and/or posting of and/appearance of the Comments on this website.\r\n                </li>\r\n                <li>\r\n                    Accommodation Portal reserves the right to monitor all Comments and to remove any Comments which it considers in its absolute discretion to be inappropriate, offensive or otherwise in breach of these Terms and Conditions.\r\n                </li>\r\n                <li>\r\n                    You warrant and represent that:\r\n                    <ul>\r\n                        <li>\r\n                            You are entitled to post the Comments on our website and have all necessary licenses and consents to do so;\r\n                        </li>\r\n                        <li>\r\n                            The Comments do not infringe any intellectual property right, including without limitation copyright, patent or trademark, or other proprietary right of any third party;\r\n                        </li>\r\n                        <li>\r\n                            The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material or material which is an invasion of \r\n                            privacy\r\n                        </li>\r\n                        <li>\r\n                            The Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.\r\n                        </li>\r\n                        <li>\r\n                            You hereby grant to Accommodation Portal a non-exclusive royalty-free license to use, reproduce, edit and authorize others to use, reproduce     \r\n                            and edit any of your Comments in any and all forms, formats or media.\r\n                        </li>\r\n                    </ul>\r\n                </li>\r\n            </ul>\r\n        </div>\r\n        <div class=\"cookies-block\">\r\n         <h1> Lorem ipsum dolor </h1>\r\n         <p class=\"terms-margin-botto\">\r\n            We reserve the right at any time and in its sole discretion to request that you remove all links or any particular link to our Web site. You agree to \r\n            immediately remove all links to our Web site upon such request. We also reserve the right to amend these terms and conditions and its linking\r\n            policy at any time. By continuing to link to our Web site, you agree to be bound to and abide by these linking terms and conditions\r\n        </p>\r\n    </div>\r\n    <div class=\"cookies-block no-mrgi\">\r\n     <h1> Lorem ipsum dolor sit amet </h1>\r\n     <p class=\"terms-margin-botto no-mrgi\">\r\n        If you find any link on our Web site or any linked web site objectionable for any reason, you may contact us about this. We will consider requests to\r\n        remove links but will have no obligation to do so or to respond directly to you. Whilst we endeavour to ensure that the information on this website\r\n        is correct, we do not warrant its completeness or accuracy; nor do we commit to ensuring that the website remains available or that the material\r\n        on the website is kept up to date.\r\n    </p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', 'terms-of-use', 'terms-of-use', 'terms-of-use', 'terms-of-use', '1', '2018-04-18 00:48:19', '2018-05-16 00:43:20', NULL),
(4, 'Privacy Policy', '<div class=\"terms-condition-wrapper\">\r\n   <div class=\"container\">\r\n       <div class=\"terms-condition-inner\">\r\n        <div class=\"welcome-to-travel\">\r\n            <h1> Lorem ipsum dolor sit amet </h1>\r\n            <p class=\"terms-margin-botto\">\r\n                These terms and conditions outline the rules and regulations for the use of Accommodation Portal\'s Website. Accommodation Portal is located at:\r\n            </p>\r\n            <p class=\"terms-margin-botto add\">\r\n                2708 Burwell Heights Road, Warren, TX 77664 United States\r\n            </p>\r\n            <p class=\"terms-margin-botto\">\r\n                By accessing this website we assume you accept these terms and conditions in full. Do not continue to use Accommodation Portal\'s website if you do not accept all of the terms and conditions stated on this page.\r\n            </p>\r\n            <p class=\"terms-margin-botto\">\r\n                The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and any or all Agreements: \"Client\", \"You\" and \"You\" By accessing this website we assume you accept these terms and conditions in full. Do not continue to use Accommodation Portal\'s website if you do not accept all of the terms and conditions stated on this page. By accessing this website we assume you accept these terms and conditions in full. Do not continue to use Accommodation Portal\'s website if you do not accept all of the terms and conditions stated on this page. By accessing this website we assume you accept these terms and conditions in full. Do not continue to use Accommodation Portal\'s website if you do not accept all of the terms and conditions stated on this page.\r\n\r\n            </p>\r\n        </div>\r\n        <div class=\"cookies-block\">\r\n            <h1> Lorem ipsum </h1>\r\n            <p class=\"terms-margin-botto m-b-0\">\r\n                employ the use of cookies. By using Accommodation Portal\'s website you consent to the use of cookies in accordance with Accommodation Portal\'s privacy policy.\r\n            </p>\r\n            <p class=\"terms-margin-botto\">\r\n                Most of the modern day interactive web sites use cookies to enable us to retrieve user details for each visit. Cookies are used in some areas of our site to enable the functionality of this area and ease of use for those people visiting. Some of our affiliate / advertising partners may also use cookies\r\n            </p>\r\n\r\n        </div>\r\n        <div class=\"cookies-block\">\r\n            <h1> Lorem ipsum dolor </h1>\r\n            <p class=\"terms-margin-botto\">\r\n                Most of the modern day interactive web sites use cookies to enable us to retrieve user details for each visit. Cookies are used in some areas of our site to enable the functionality of this area and ease of use for those people visiting. Some of our affiliate / advertising partners may also use cookies enable the functionality of this area and ease of use for those people visiting. Some of our affiliate / advertising partners may also use cookies\r\n            </p>\r\n            <p class=\"terms-margin-botto m-b-0\">\r\n                You must not:\r\n            </p>\r\n            <div class=\"boolet-block\">\r\n                <span class=\"yellow-circle\"><i class=\"fa fa-circle\" aria-hidden=\"true\"></i></span>\r\n                <span class=\"yellow-circle\"><i class=\"fa fa-circle\" aria-hidden=\"true\"></i></span>\r\n                <span class=\"yellow-circle\"><i class=\"fa fa-circle\" aria-hidden=\"true\"></i></span>\r\n            </div>\r\n\r\n            <div class=\"boolet-text-block\">\r\n                <div class=\"boolet-text\"> Republish material from http://www.example.com Sell, rent or sub-license material from http://www.example.com Reproduce, duplicate or copy material from http://www.example.com </div>\r\n            </div>\r\n        </div>\r\n        <p class=\"terms-margin-botto\">\r\n            Redistribute content from Accommodation Portal (unless content is specifically made for redistribution).\r\n        </p>\r\n        <div class=\"cookies-block\">\r\n            <h1> Lorem ipsum amet </h1>\r\n            <ul>\r\n                <li>\r\n                    This Agreement shall begin on the date hereof.\r\n                </li>\r\n                <li>\r\n                    Certain parts of this website offer the opportunity for users to post and exchange opinions, information, material and data (\'Comments\') in a asof the website. Accommodation Portal does not screen, edit, publish or review Comments prior to their appearance on the website and comments do not reflect the views or opinions of Accommodation Portal, its agents or affiliates. Comments reflect the view and opinion of the person who posts such view or opinion. To the extent permitted by applicable laws Accommodation Portal shall not be responsible or liable for the Comments or for any loss cost, liability, damages or expenses caused and or suffered as a result of any use of and/or posting of and/appearance of the Comments on this website.\r\n                </li>\r\n                <li>\r\n                    Accommodation Portal reserves the right to monitor all Comments and to remove any Comments which it considers in its absolute discretion to be inappropriate, offensive or otherwise in breach of these Terms and Conditions.\r\n                </li>\r\n                <li>\r\n                    You warrant and represent that:\r\n                    <ul>\r\n                        <li>\r\n                            You are entitled to post the Comments on our website and have all necessary licenses and consents to do so;\r\n                        </li>\r\n                        <li>\r\n                            The Comments do not infringe any intellectual property right, including without limitation copyright, patent or trademark, or other proprietary right of any third party;\r\n                        </li>\r\n                        <li>\r\n                            The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material or material which is an invasion of \r\n                            privacy\r\n                        </li>\r\n                        <li>\r\n                            The Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.\r\n                        </li>\r\n                        <li>\r\n                            You hereby grant to Accommodation Portal a non-exclusive royalty-free license to use, reproduce, edit and authorize others to use, reproduce     \r\n                            and edit any of your Comments in any and all forms, formats or media.\r\n                        </li>\r\n                    </ul>\r\n                </li>\r\n            </ul>\r\n        </div>\r\n        <div class=\"cookies-block\">\r\n         <h1> Lorem ipsum dolor </h1>\r\n         <p class=\"terms-margin-botto\">\r\n            We reserve the right at any time and in its sole discretion to request that you remove all links or any particular link to our Web site. You agree to \r\n            immediately remove all links to our Web site upon such request. We also reserve the right to amend these terms and conditions and its linking\r\n            policy at any time. By continuing to link to our Web site, you agree to be bound to and abide by these linking terms and conditions\r\n        </p>\r\n    </div>\r\n    <div class=\"cookies-block no-mrgi\">\r\n     <h1> Lorem ipsum dolor sit amet </h1>\r\n     <p class=\"terms-margin-botto no-mrgi\">\r\n        If you find any link on our Web site or any linked web site objectionable for any reason, you may contact us about this. We will consider requests to\r\n        remove links but will have no obligation to do so or to respond directly to you. Whilst we endeavour to ensure that the information on this website\r\n        is correct, we do not warrant its completeness or accuracy; nor do we commit to ensuring that the website remains available or that the material\r\n        on the website is kept up to date.\r\n    </p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', 'privacy-policy', 'privacy-policy', 'privacy-policy', 'privacy-policy', '1', '2018-04-18 00:48:19', '2018-05-16 00:43:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gemstone`
--

CREATE TABLE `gemstone` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `color` varchar(60) NOT NULL,
  `quality` varchar(60) NOT NULL,
  `shape` varchar(60) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gemstone`
--

INSERT INTO `gemstone` (`id`, `type`, `color`, `quality`, `shape`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Diamonds', '', '', '', 'diamonds', '1', '2018-09-29 13:55:34', '2018-09-29 13:55:34'),
(6, 'Pearls', '', '', '', 'pearls', '1', '2018-09-29 13:55:49', '2018-09-29 13:55:49'),
(7, 'Emeralds', '', '', '', 'emeralds', '1', '2018-09-29 13:56:08', '2018-09-29 13:56:08'),
(8, 'Others', '', '', '', 'others', '1', '2018-09-29 13:56:16', '2018-09-29 13:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `gemstone_colors`
--

CREATE TABLE `gemstone_colors` (
  `id` int(11) NOT NULL,
  `gemstone_color` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gemstone_colors`
--

INSERT INTO `gemstone_colors` (`id`, `gemstone_color`, `slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'Blue', 'red', '1', '2018-05-25 04:09:30', '2018-05-25 10:02:58', NULL),
(6, 'Pink', 'pink', '1', '2018-05-25 04:09:30', '2018-05-25 10:02:41', NULL),
(8, 'Yellow', 'blue', '1', '2018-05-25 04:09:30', '2018-06-22 04:22:24', NULL),
(12, 'White', 'white', '1', '2018-09-29 13:53:37', '2018-09-29 13:53:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gemstone_qualities`
--

CREATE TABLE `gemstone_qualities` (
  `id` int(11) NOT NULL,
  `gemstone_quality` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gemstone_qualities`
--

INSERT INTO `gemstone_qualities` (`id`, `gemstone_quality`, `slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'IF', 'VVS1', '1', '2018-05-25 04:15:33', '2018-09-29 13:48:58', NULL),
(6, 'VVS', 'VVS2', '1', '2018-05-25 04:15:33', '2018-09-29 13:49:05', NULL),
(7, 'SI', 'VVS3', '1', '2018-05-25 04:15:33', '2018-09-29 13:49:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gemstone_shapes`
--

CREATE TABLE `gemstone_shapes` (
  `id` int(11) NOT NULL,
  `shape_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gemstone_shapes`
--

INSERT INTO `gemstone_shapes` (`id`, `shape_name`, `slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Oval', 'Oval', '1', '2018-04-24 23:57:12', '2018-04-24 23:57:12', NULL),
(3, 'Round', 'Circle', '1', '2018-04-24 23:57:12', '2018-09-29 13:57:54', NULL),
(4, 'Square', 'Square', '1', '2018-04-24 23:57:12', '2018-04-24 23:57:12', NULL),
(5, 'Triangle', 'Triangle', '1', '2018-04-24 23:57:12', '2018-09-29 13:59:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gift_cards`
--

CREATE TABLE `gift_cards` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `description` varchar(555) NOT NULL,
  `image` text NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `amount` float(20,2) NOT NULL,
  `amount_usd` float(20,2) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gift_cards`
--

INSERT INTO `gift_cards` (`id`, `title`, `description`, `image`, `code`, `amount`, `amount_usd`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Gift Card 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', '7c8e2c96731fb64f1bb67d3de7cc9d9e1a3e8048.jpg', NULL, 2500.00, 69.00, '1', '2018-11-13 11:27:08', '2018-11-13 11:27:08'),
(2, 'Gift Card 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', '0acadbdc40427c4847d2eabe3062b74a788656c0.jpg', NULL, 5000.00, 69.00, '1', '2018-11-13 11:28:00', '2018-11-13 11:28:00'),
(3, 'Gift Card 3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '75d1008d9e67d47745e8b4f4612f3f9e058d5d0d.jpg', NULL, 1000.00, 69.00, '1', '2018-11-13 11:28:37', '2018-11-13 11:28:37'),
(4, 'Gift Card 4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', '56cbbd722288c7afd0b18202447d4054eb7ffaf1.jpg', NULL, 10000.00, 69.00, '1', '2018-11-13 11:29:16', '2018-11-13 11:29:16');

-- --------------------------------------------------------

--
-- Table structure for table `insurance_details`
--

CREATE TABLE `insurance_details` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `price` float(20,2) NOT NULL,
  `description` text NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1' COMMENT '0-active,1-inactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `insurance_details`
--

INSERT INTO `insurance_details` (`id`, `company_name`, `price`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'HDFC ERGO', 4.00, '<p><strong style=\"margin: 0px; padding: 0px; font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '1', '2018-04-18 05:01:30', '2018-05-29 04:45:08'),
(2, 'LIC', 4.50, '<p><strong style=\"margin: 0px; padding: 0px; font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '1', '2018-04-18 00:14:15', '2018-05-29 04:45:16'),
(3, 'Humana', 5.00, '<ul class=\"padding-bottom-10\" style=\"box-sizing: border-box; margin: 0px 0px 2rem; padding-bottom: 1rem; color: #333333; font-family: Lato, sans-serif; font-size: 16px;\">\r\n<li style=\"box-sizing: border-box;\">Very affordable premiums that can cost half of what is charged for an Affordable Care Act health plan</li>\r\n<li style=\"box-sizing: border-box;\">Premium savings can be used to buy other care such as dental or vision coverage</li>\r\n<li style=\"box-sizing: border-box;\">Typically has broad network of healthcare providers and is accepted at many of the top hospitals and cancer centers in the U.S.</li>\r\n<li style=\"box-sizing: border-box; text-align: left;\">Applications for insurance can be made any time during the year</li>\r\n</ul>', '1', '2018-04-25 07:41:44', '2018-05-29 06:03:43');

-- --------------------------------------------------------

--
-- Table structure for table `look`
--

CREATE TABLE `look` (
  `id` int(11) NOT NULL,
  `look` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `look`
--

INSERT INTO `look` (`id`, `look`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Traditional', 'traditional', '1', '2018-05-17 04:37:44', '2018-05-17 04:37:44'),
(4, 'Contemporary', 'contemporary', '1', '2018-05-17 04:37:52', '2018-05-17 04:37:52');

-- --------------------------------------------------------

--
-- Table structure for table `metals`
--

CREATE TABLE `metals` (
  `id` int(11) NOT NULL,
  `metal_name` varchar(255) NOT NULL,
  `metal_color` varchar(255) NOT NULL,
  `metal_quality` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `metals`
--

INSERT INTO `metals` (`id`, `metal_name`, `metal_color`, `metal_quality`, `slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Silver', 'Yellow', '14k', 'silver-yellow-14k', '1', '2018-05-17 04:38:54', '2018-05-17 10:51:56', NULL),
(2, 'Gold', 'White', '18k', 'gold-white-18k', '1', '2018-05-17 04:39:09', '2018-05-17 10:51:59', NULL),
(3, 'Platinum', 'Rose Gold', '22k', 'platinum-rose-gold-22k', '1', '2018-05-17 04:39:23', '2018-05-17 10:52:02', NULL),
(4, 'Palladium', 'Two Tone', '24k', 'palladium', '1', '2018-05-17 04:39:37', '2018-05-25 03:26:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `metal_colors`
--

CREATE TABLE `metal_colors` (
  `id` int(11) NOT NULL,
  `metal_color` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `metal_colors`
--

INSERT INTO `metal_colors` (`id`, `metal_color`, `slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Yellow', 'red', '1', '2018-04-17 18:30:00', '2018-04-21 00:35:49', NULL),
(2, 'White', 'white', '1', '2018-04-21 00:36:01', '2018-04-21 00:36:01', NULL),
(3, 'Rose Gold', 'rose-gold', '1', '2018-04-21 00:36:16', '2018-04-21 00:36:16', NULL),
(4, 'Two Tone', 'two-tone', '1', '2018-04-21 00:36:29', '2018-05-25 03:52:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `metal_detailings`
--

CREATE TABLE `metal_detailings` (
  `id` int(11) NOT NULL,
  `metal_detailing_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `metal_detailings`
--

INSERT INTO `metal_detailings` (`id`, `metal_detailing_name`, `slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Milgrain', 'milgrain-millegrain', '1', '2018-04-16 18:30:00', '2018-09-29 14:04:36', NULL),
(2, 'Matte', 'mattebrushedsatin', '1', '2018-04-17 08:08:33', '2018-09-29 14:04:51', NULL),
(3, 'Filigree', 'filigree', '1', '2018-04-17 08:12:58', '2018-04-17 08:12:58', NULL),
(4, 'Hand Engraving', 'hand-engraving', '1', '2018-04-17 08:13:21', '2018-04-17 08:13:21', NULL),
(5, 'Hammered', 'hammered', '1', '2018-04-17 08:13:38', '2018-04-17 08:13:38', NULL),
(6, 'Pierced', 'piercedopen-work', '0', '2018-04-17 08:14:05', '2018-09-29 14:05:23', NULL),
(7, 'Rope', 'rope', '0', '2018-04-17 08:14:18', '2018-09-29 14:05:19', NULL),
(8, 'Surprise Diamond', 'surprise-diamond', '0', '2018-04-17 08:14:37', '2018-09-29 14:05:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `metal_qualities`
--

CREATE TABLE `metal_qualities` (
  `id` int(11) NOT NULL,
  `quality_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `metal_qualities`
--

INSERT INTO `metal_qualities` (`id`, `quality_name`, `slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '14K', '14k', '1', '2018-04-17 07:21:58', '2018-04-17 07:23:12', NULL),
(2, '18K', '18k', '1', '2018-04-17 07:22:25', '2018-04-17 07:23:12', NULL),
(3, '24K', '24k', '1', '2018-04-17 07:22:33', '2018-05-25 03:55:28', NULL),
(5, '22K', '22K', '1', '2018-04-17 07:22:25', '2018-04-17 07:23:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `newletters`
--

CREATE TABLE `newletters` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `newletters`
--

INSERT INTO `newletters` (`id`, `email`, `created_at`, `updated_at`) VALUES
(3, 'shankar@webwing.com', '2018-04-24 05:01:09', '0000-00-00 00:00:00'),
(4, 'pankaj@webwing.com', '2018-04-24 05:01:09', '0000-00-00 00:00:00'),
(5, 'chetand@webwing.com', '2018-04-24 05:01:10', '0000-00-00 00:00:00'),
(6, 'sagars@webwing.com', '2018-04-24 05:01:10', '0000-00-00 00:00:00'),
(7, 'manojb@webwing.com', '2018-04-24 05:01:11', '0000-00-00 00:00:00'),
(8, 'arjun@webwing.com', '2018-04-24 05:01:11', '0000-00-00 00:00:00'),
(9, 'jayantm@webwing.com', '2018-04-24 05:01:12', '0000-00-00 00:00:00'),
(10, 'yogeshk@webwing.com', '2018-04-24 05:01:12', '0000-00-00 00:00:00'),
(11, 'nayans@webwing.com', '2018-04-24 05:01:13', '0000-00-00 00:00:00'),
(12, 'bhaveshm@webwing.com', '2018-04-24 05:01:13', '0000-00-00 00:00:00'),
(13, 'pranavs@webwing.com', '2018-04-24 05:01:14', '0000-00-00 00:00:00'),
(14, 'tejuss@webwing.com', '2018-04-24 05:01:14', '0000-00-00 00:00:00'),
(15, 'snehalk@webwing.com', '2018-04-24 05:01:15', '0000-00-00 00:00:00'),
(16, 'jait@webwing.com', '2018-04-24 05:01:15', '0000-00-00 00:00:00'),
(17, 'rahuln@webwing.com', '2018-04-24 05:01:16', '0000-00-00 00:00:00'),
(18, 'tushara@webwing.com', '2018-04-24 05:01:16', '0000-00-00 00:00:00'),
(19, 'sagarh@webwing.com', '2018-04-24 05:01:17', '0000-00-00 00:00:00'),
(20, 'rohinij@webwing.com', '2018-04-24 05:01:17', '0000-00-00 00:00:00'),
(21, 'yogeshmk@webwing.com', '2018-04-24 05:01:18', '0000-00-00 00:00:00'),
(22, 'shitalvm@webwing.com', '2018-04-24 05:01:18', '0000-00-00 00:00:00'),
(23, 'deepalis@webwing.com', '2018-04-24 05:01:19', '0000-00-00 00:00:00'),
(24, 'snehala@webwing.com', '2018-04-24 05:01:19', '0000-00-00 00:00:00'),
(25, 'amang@webwing.com', '2018-04-24 05:01:20', '0000-00-00 00:00:00'),
(26, 'tusharpc@webwing.com', '2018-04-24 05:01:20', '0000-00-00 00:00:00'),
(27, 'swapnilb@webwing.com', '2018-04-24 05:01:21', '0000-00-00 00:00:00'),
(28, 'imran@webwing.com', '2018-04-24 05:01:21', '0000-00-00 00:00:00'),
(29, 'nileshv@webwing.com', '2018-04-24 05:01:22', '0000-00-00 00:00:00'),
(30, 'amolb@webwing.com', '2018-04-24 05:01:22', '0000-00-00 00:00:00'),
(31, 'poojad@webwing.com', '2018-04-24 05:01:23', '0000-00-00 00:00:00'),
(32, 'akshayg@webwing.com', '2018-04-24 05:01:23', '0000-00-00 00:00:00'),
(33, 'deepaks@webwing.com', '2018-04-24 05:01:24', '0000-00-00 00:00:00'),
(34, 'prashantp@webwing.com', '2018-04-24 05:01:24', '0000-00-00 00:00:00'),
(35, 'poojaj@webwing.com', '2018-04-24 05:01:25', '0000-00-00 00:00:00'),
(36, 'taiyyabp@webwing.com', '2018-04-24 05:01:25', '0000-00-00 00:00:00'),
(37, 'monaliw@webwing.com', '2018-04-24 05:01:26', '0000-00-00 00:00:00'),
(38, 'atulb@webwing.com', '2018-04-24 05:01:26', '0000-00-00 00:00:00'),
(39, 'ashwinig@webwing.com', '2018-04-24 05:01:27', '0000-00-00 00:00:00'),
(40, 'deepakb@webwing.com', '2018-04-24 05:01:27', '0000-00-00 00:00:00'),
(41, 'priyankak@webwing.com', '2018-04-24 05:01:28', '0000-00-00 00:00:00'),
(42, 'padmashrij@webwing.com', '2018-04-24 05:01:28', '0000-00-00 00:00:00'),
(43, 'noshina@webwing.com', '2018-04-24 05:01:29', '0000-00-00 00:00:00'),
(44, 'preranab@webwing.com', '2018-04-24 05:01:29', '0000-00-00 00:00:00'),
(45, 'deeptip@webwing.com', '2018-04-24 05:01:30', '0000-00-00 00:00:00'),
(46, 'sagarp@webwing.com', '2018-04-24 05:01:30', '0000-00-00 00:00:00'),
(47, 'bhagyashrim@webwing.com', '2018-04-24 05:01:31', '0000-00-00 00:00:00'),
(48, 'mayurc@webwing.com', '2018-04-24 05:01:31', '0000-00-00 00:00:00'),
(49, 'kavitag@webwing.com', '2018-04-24 05:01:32', '0000-00-00 00:00:00'),
(50, 'bhushanp@webwing.com', '2018-04-24 05:01:32', '0000-00-00 00:00:00'),
(51, 'mayur@webwing.com', '2018-04-24 05:01:33', '0000-00-00 00:00:00'),
(52, 'swapnilj@webwing.com', '2018-04-24 05:01:33', '0000-00-00 00:00:00'),
(53, 'poojak@webwing.com', '2018-04-24 05:01:34', '0000-00-00 00:00:00'),
(54, 'umeshw@webwing.com', '2018-04-24 05:01:34', '0000-00-00 00:00:00'),
(55, 'vrajeshp@webwing.com', '2018-04-24 05:01:35', '0000-00-00 00:00:00'),
(56, 'amita@webwing.com', '2018-04-24 05:01:35', '0000-00-00 00:00:00'),
(57, 'disha@webwing.com', '2018-04-24 05:01:36', '0000-00-00 00:00:00'),
(58, 'niteshk@webwing.com', '2018-04-24 05:01:36', '0000-00-00 00:00:00'),
(59, 'gauravs@webwing.com', '2018-04-24 05:01:37', '0000-00-00 00:00:00'),
(60, 'dattuh@webwing.com', '2018-04-24 05:01:37', '0000-00-00 00:00:00'),
(61, 'sayalib@webwing.com', '2018-04-24 05:01:38', '0000-00-00 00:00:00'),
(62, 'yogeshs@webwing.com', '2018-04-24 05:01:38', '0000-00-00 00:00:00'),
(63, 'swanandp@webwing.com', '2018-04-24 05:01:39', '0000-00-00 00:00:00'),
(64, 'vaibhavs@webwing.com', '2018-04-24 05:01:39', '0000-00-00 00:00:00'),
(65, 'niranjanv@webwing.com', '2018-04-24 05:01:40', '0000-00-00 00:00:00'),
(66, 'nadeems@webwing.com', '2018-04-24 05:01:40', '0000-00-00 00:00:00'),
(67, 'priyankar@webwing.com', '2018-04-24 05:01:41', '0000-00-00 00:00:00'),
(82, 'sagars@mail.com', '2018-05-07 07:35:25', '2018-05-07 07:35:25'),
(83, 'sagar@mail.com', '2018-05-07 07:35:37', '2018-05-07 07:35:37'),
(84, 'saga1r@mail.com', '2018-05-07 07:37:10', '2018-05-07 07:37:10'),
(85, 'saga1rq@mail.com', '2018-05-07 07:39:22', '2018-05-07 07:39:22'),
(88, 'deepak@mail.co', '2018-05-07 07:40:29', '2018-05-07 07:40:29'),
(89, 'sagarsasda@mail.com', '2018-05-07 07:41:43', '2018-05-07 07:41:43'),
(90, 'sagar12@mail.com', '2018-05-07 22:52:42', '2018-05-07 22:52:42'),
(91, 'sagar123@mail.com', '2018-05-07 22:52:54', '2018-05-07 22:52:54'),
(92, 'sagar@webwing.com', '2018-05-07 22:56:38', '2018-05-07 22:56:38'),
(93, 'abcd@gmail.com', '2018-05-08 04:57:24', '2018-05-08 04:57:24'),
(94, 'sdsdsddsds@mail.com', '2018-05-09 23:24:11', '2018-05-09 23:24:11'),
(95, 'sagar@mail', '2018-05-09 23:27:20', '2018-05-09 23:27:20'),
(96, 'assasasa@mail.com', '2018-05-09 23:40:51', '2018-05-09 23:40:51'),
(97, 'dev@webwingtechnologies.com', '2018-06-21 10:35:19', '2018-06-21 10:35:19'),
(98, 'dssd@gmail.com', '2018-06-22 08:24:51', '2018-06-22 08:24:51'),
(99, 'dsdsd@gmail.com', '2018-06-22 08:26:22', '2018-06-22 08:26:22');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `receiver_user_id` int(11) NOT NULL,
  `receiver_user_type` enum('1','2','3','') NOT NULL COMMENT '1-admin,2-user,3-supplier',
  `notification_message` text NOT NULL,
  `notification_url` text,
  `is_read` enum('0','1','','') NOT NULL COMMENT '0-unread,1-read',
  `type` enum('1','2','3','4') DEFAULT NULL COMMENT '1-pending,2-order placed,3-accepted,4-rejected',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `receiver_user_id`, `receiver_user_type`, `notification_message`, `notification_url`, `is_read`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, '2', '<p>Your order placed successfully with order id AM-1529582501</p>', 'my_orders/AM-1529582501', '1', '2', '2018-06-21 12:02:08', '2018-06-22 14:58:06'),
(2, 1, '1', '<p>New order placed with AM-1529582501.</p>', 'orders/view/AM-1529582501', '1', '2', '2018-06-21 12:02:08', '2018-06-22 14:58:06'),
(3, 54, '3', '<p>New order placed with AM-1529582501.</p>', '/orders/view/AM-1529582501', '1', '2', '2018-06-21 12:02:08', '2018-06-22 14:58:06'),
(4, 1, '2', '<p>Your order placed successfully with order id AM-1529583445</p>', 'my_orders/AM-1529583445', '1', '2', '2018-06-21 12:17:47', '2018-06-22 14:58:06'),
(5, 1, '1', '<p>New order placed with AM-1529583445.</p>', 'orders/view/AM-1529583445', '1', '2', '2018-06-21 12:17:50', '2018-06-22 14:58:06'),
(6, 8, '3', '<p>New order placed with AM-1529583445.</p>', '/orders/view/AM-1529583445', '0', '2', '2018-06-21 12:17:50', '2018-06-22 14:58:06'),
(7, 54, '3', '<p>New order placed with AM-1529583445.</p>', '/orders/view/AM-1529583445', '1', '2', '2018-06-21 12:17:50', '2018-06-22 14:58:06'),
(8, 1, '1', '<p>Nayan Pawar has requested to replace product Promise Solitire Ring</p>', 'replacement_products', '1', '2', '2018-06-21 12:22:26', '2018-06-22 14:58:06'),
(9, 1, '2', 'Admin Webwing has accepted your product replacement request for product Promise Solitire Ring.', 'my_orders/details/MzQ=', '1', '2', '2018-06-21 12:24:39', '2018-06-22 14:58:06'),
(10, 1, '2', 'Your payment of Rs 9999999999 for replacement product Promise Solitire Ring has been sent to your wallet. Please check wallet.', 'my_orders/details/MzQ=', '1', '2', '2018-06-21 12:25:15', '2018-06-22 14:58:06'),
(11, 1, '2', 'Your payment of Rs 344850 for replacement product Promise Solitire Ring has been sent to your wallet. Please check wallet.', 'my_orders/details/MzQ=', '1', '2', '2018-06-21 12:34:35', '2018-06-22 14:58:06'),
(12, 1, '1', '<p>Nayan Pawar has requested to return product Promise Solitire Ring</p>', 'return_product/view/Mg==/MzQ=', '1', '2', '2018-06-21 12:36:11', '2018-06-22 14:58:06'),
(13, 1, '2', 'Admin Webwing has accepted your product return request for product Promise Solitire Ring.', 'my_orders/details/MzQ=', '1', '2', '2018-06-21 12:36:30', '2018-06-22 14:58:06'),
(14, 1, '2', 'Your payment of Rs 344850 for return product Promise Solitire Ring has been sent to your wallet. Please check wallet.', 'my_orders/details/MzQ=', '1', '2', '2018-06-21 12:36:55', '2018-06-22 14:58:06'),
(15, 1, '2', '<p>Order with AM-1529583445  status changed to Cancelled.</p>', 'my_orders/AM-1529583445', '1', '2', '2018-06-22 04:21:59', '2018-06-22 14:58:06'),
(16, 1, '1', '<p>Order with AM-1529583445  status changed to Cancelled.</p>', '/orders/view/AM-1529583445', '1', '2', '2018-06-22 04:22:02', '2018-06-22 14:58:06'),
(17, 8, '3', '<p>Order with AM-1529583445  status changed to Cancelled.</p>', '/orders/view/AM-1529583445', '0', '2', '2018-06-22 04:22:02', '2018-06-22 14:58:06'),
(18, 54, '3', '<p>Order with AM-1529583445  status changed to Cancelled.</p>', '/orders/view/AM-1529583445', '1', '2', '2018-06-22 04:22:02', '2018-09-19 16:49:22'),
(19, 1, '2', '<p>Order with AM-1529582501  status changed to Cancelled.</p>', 'my_orders/AM-1529582501', '1', '2', '2018-06-22 04:25:23', '2018-06-22 14:58:06'),
(20, 1, '1', '<p>Order with AM-1529582501  status changed to Cancelled.</p>', '/orders/view/AM-1529582501', '1', '2', '2018-06-22 04:25:26', '2018-06-22 14:58:06'),
(21, 54, '3', '<p>Order with AM-1529582501  status changed to Cancelled.</p>', '/orders/view/AM-1529582501', '1', '2', '2018-06-22 04:25:26', '2018-09-19 16:49:22'),
(22, 1, '2', '<p>Your order placed successfully with order id AM-1529641812</p>', 'my_orders/AM-1529641812', '1', '2', '2018-06-22 04:30:31', '2018-06-22 14:58:06'),
(23, 1, '1', '<p>New order placed with AM-1529641812.</p>', 'orders/view/AM-1529641812', '1', '2', '2018-06-22 04:30:33', '2018-06-22 14:58:06'),
(24, 8, '3', '<p>New order placed with AM-1529641812.</p>', '/orders/view/AM-1529641812', '0', '2', '2018-06-22 04:30:33', '2018-06-22 14:58:06'),
(25, 1, '3', '<p>New order placed with AM-1529641812.</p>', '/orders/view/AM-1529641812', '1', '2', '2018-06-22 04:30:33', '2018-06-25 13:00:07'),
(26, 1, '2', '<p>Your order placed successfully with order id AM-1529641947</p>', 'my_orders/MjQ=', '1', '2', '2018-06-22 04:35:52', '2018-06-22 14:58:06'),
(27, 1, '1', '<p>New order placed with AM-1529641947.</p>', 'orders/view/MjQ=', '1', '2', '2018-06-22 04:35:54', '2018-06-22 14:58:06'),
(28, 8, '3', '<p>New order placed with AM-1529641947.</p>', 'orders/view/AM-1529641947', '0', '2', '2018-06-22 04:35:54', '2018-06-22 14:58:06'),
(29, 1, '2', '<p>Order with AM-1529641947  status changed to Cancelled.</p>', 'my_orders/AM-1529641947', '1', '2', '2018-06-22 04:57:18', '2018-06-22 14:58:06'),
(30, 1, '1', '<p>Order with AM-1529641947  status changed to Cancelled.</p>', '/orders/view/AM-1529641947', '1', '2', '2018-06-22 04:57:20', '2018-06-25 08:55:00'),
(31, 8, '3', '<p>Order with AM-1529641947  status changed to Cancelled.</p>', '/orders/view/AM-1529641947', '0', '2', '2018-06-22 04:57:20', '2018-06-22 14:58:06'),
(32, 1, '2', '<p>Order with AM-1529641812  status changed to Cancelled.</p>', 'my_orders/AM-1529641812', '1', '2', '2018-06-22 04:57:57', '2018-06-22 14:58:06'),
(33, 1, '1', '<p>Order with AM-1529641812  status changed to Cancelled.</p>', '/orders/view/AM-1529641812', '1', '2', '2018-06-22 04:57:58', '2018-06-25 08:55:00'),
(34, 8, '3', '<p>Order with AM-1529641812  status changed to Cancelled.</p>', '/orders/view/AM-1529641812', '0', '2', '2018-06-22 04:57:58', '2018-06-22 14:58:06'),
(35, 1, '3', '<p>Order with AM-1529641812  status changed to Cancelled.</p>', '/orders/view/AM-1529641812', '1', '2', '2018-06-22 04:57:59', '2018-06-25 13:00:07'),
(36, 1, '2', '<p>Order with AM-1529641773  status changed to Cancelled.</p>', 'my_orders/AM-1529641773', '1', '2', '2018-06-22 05:16:09', '2018-06-22 14:58:06'),
(37, 1, '1', '<p>Order with AM-1529641773  status changed to Cancelled.</p>', '/orders/view/AM-1529641773', '1', '2', '2018-06-22 05:16:11', '2018-06-25 08:55:00'),
(38, 8, '3', '<p>Order with AM-1529641773  status changed to Cancelled.</p>', '/orders/view/AM-1529641773', '0', '2', '2018-06-22 05:16:11', '2018-06-22 14:58:06'),
(39, 13, '2', '<p>Order with AM-1529571229  status changed to Cancelled.</p>', 'my_orders/AM-1529571229', '0', '2', '2018-06-22 05:16:25', '2018-06-22 14:58:06'),
(40, 1, '1', '<p>Order with AM-1529571229  status changed to Cancelled.</p>', '/orders/view/AM-1529571229', '1', '2', '2018-06-22 05:16:27', '2018-06-25 08:55:00'),
(41, 8, '3', '<p>Order with AM-1529571229  status changed to Cancelled.</p>', '/orders/view/AM-1529571229', '0', '2', '2018-06-22 05:16:27', '2018-06-22 14:58:06'),
(42, 13, '2', '<p>Order with AM-1529555686  status changed to Cancelled.</p>', 'my_orders/AM-1529555686', '0', '2', '2018-06-22 05:41:22', '2018-06-22 14:58:06'),
(43, 1, '1', '<p>Order with AM-1529555686  status changed to Cancelled.</p>', '/orders/view/AM-1529555686', '1', '2', '2018-06-22 05:41:25', '2018-06-25 08:55:00'),
(44, 8, '3', '<p>Order with AM-1529555686  status changed to Cancelled.</p>', '/orders/view/AM-1529555686', '0', '2', '2018-06-22 05:41:25', '2018-06-22 14:58:06'),
(45, 8, '3', '<p>Order with AM-1529555686  status changed to Cancelled.</p>', '/orders/view/AM-1529555686', '0', '2', '2018-06-22 05:41:26', '2018-06-22 14:58:06'),
(46, 1, '2', '<p>Your order placed successfully with order id AM-1529646743</p>', 'my_orders/MjU=', '1', '2', '2018-06-22 05:54:25', '2018-06-22 14:58:06'),
(47, 1, '1', '<p>New order placed with AM-1529646743.</p>', 'orders/view/MjU=', '1', '2', '2018-06-22 05:54:27', '2018-06-25 08:55:00'),
(48, 8, '3', '<p>New order placed with AM-1529646743.</p>', 'orders/view/AM-1529646743', '0', '2', '2018-06-22 05:54:27', '2018-06-22 14:58:06'),
(49, 8, '3', '<p>New order placed with AM-1529646743.</p>', 'orders/view/AM-1529646743', '0', '2', '2018-06-22 05:54:27', '2018-06-22 14:58:06'),
(50, 8, '3', '<p>New order placed with AM-1529646743.</p>', 'orders/view/AM-1529646743', '0', '2', '2018-06-22 05:54:27', '2018-06-22 14:58:06'),
(51, 1, '2', '<p>Your order placed successfully with order id AM-1529646985</p>', 'my_orders/MjY=', '1', '2', '2018-06-22 05:56:47', '2018-06-22 14:58:06'),
(52, 1, '1', '<p>New order placed with AM-1529646985.</p>', 'orders/view/MjY=', '1', '2', '2018-06-22 05:56:49', '2018-06-22 14:58:06'),
(53, 8, '3', '<p>New order placed with AM-1529646985.</p>', 'orders/view/AM-1529646985', '0', '2', '2018-06-22 05:56:49', '2018-06-22 14:58:06'),
(54, 1, '3', '<p>New order placed with AM-1529646985.</p>', 'orders/view/AM-1529646985', '1', '2', '2018-06-22 05:56:49', '2018-06-25 10:05:44'),
(55, 1, '1', '<p>fsdfds is registered as a User</p>', 'user/customers/view/MjQ=', '1', '2', '2018-06-22 07:14:09', '2018-06-25 08:55:00'),
(56, 1, '1', '<p>dsdsd is registered as a User</p>', 'user/customers/view/MjU=', '1', '2', '2018-06-22 07:15:29', '2018-06-25 08:55:00'),
(57, 1, '1', '<p>dsd is registered as a User</p>', 'user/customers/view/MjY=', '1', '2', '2018-06-22 07:18:53', '2018-06-25 08:55:00'),
(58, 1, '1', '<p>dsdsd is registered as a User</p>', 'user/customers/view/Mjc=', '1', '2', '2018-06-22 07:22:07', '2018-06-25 08:55:00'),
(59, 1, '1', '<p>dssd is registered as a User</p>', 'user/customers/view/Mjg=', '1', '2', '2018-06-22 07:29:48', '2018-06-25 08:55:00'),
(60, 1, '1', '<p>dssdds is registered as a User</p>', 'user/customers/view/Mjk=', '1', '2', '2018-06-22 07:30:58', '2018-06-25 08:55:00'),
(61, 1, '1', '<p>dfs is registered as a User</p>', 'user/customers/view/MzA=', '1', '2', '2018-06-22 07:32:12', '2018-06-25 08:55:00'),
(62, 1, '1', '<p>dsdssd is registered as a User</p>', 'user/customers/view/MzE=', '1', '2', '2018-06-22 08:21:58', '2018-06-25 08:55:00'),
(63, 1, '1', '<p>dsdds is registered as a User</p>', 'user/customers/view/MzI=', '1', '2', '2018-06-22 08:23:00', '2018-06-25 08:55:00'),
(64, 1, '1', '<p>sagar is registered as a User</p>', 'user/customers/view/MzM=', '1', '2', '2018-06-22 08:35:13', '2018-06-25 08:55:00'),
(65, 1, '2', '<p>Order with AM-1529646985  status changed to Confirmed.</p>', 'my_orders/AM-1529646985', '1', '2', '2018-06-22 13:13:56', '2018-06-22 14:58:06'),
(66, 1, '1', '<p>Order with AM-1529646985  status changed to Confirmed.</p>', '/orders/view/AM-1529646985', '1', '2', '2018-06-22 13:13:58', '2018-06-25 08:55:00'),
(67, 8, '3', '<p>Order with AM-1529646985  status changed to Confirmed.</p>', '/orders/view/AM-1529646985', '0', '2', '2018-06-22 13:13:58', '2018-06-22 14:58:06'),
(68, 1, '3', '<p>Order with AM-1529646985  status changed to Confirmed.</p>', '/orders/view/AM-1529646985', '1', '2', '2018-06-22 13:13:58', '2018-06-25 13:00:07'),
(69, 1, '2', '<p>Order with AM-1529646985  status changed to Dispatched.</p>', 'my_orders/AM-1529646985', '1', '2', '2018-06-22 13:14:04', '2018-06-22 14:58:06'),
(70, 1, '1', '<p>Order with AM-1529646985  status changed to Dispatched.</p>', '/orders/view/AM-1529646985', '1', '2', '2018-06-22 13:14:06', '2018-06-25 08:55:00'),
(71, 8, '3', '<p>Order with AM-1529646985  status changed to Dispatched.</p>', '/orders/view/AM-1529646985', '0', '2', '2018-06-22 13:14:06', '2018-06-22 14:58:06'),
(72, 1, '3', '<p>Order with AM-1529646985  status changed to Dispatched.</p>', '/orders/view/AM-1529646985', '1', '2', '2018-06-22 13:14:06', '2018-06-25 13:00:07'),
(73, 1, '2', '<p>Order with AM-1529646985  status changed to Delivered.</p>', 'my_orders/AM-1529646985', '1', '2', '2018-06-22 13:14:12', '2018-06-22 14:58:06'),
(74, 1, '1', '<p>Order with AM-1529646985  status changed to Delivered.</p>', '/orders/view/AM-1529646985', '1', '2', '2018-06-22 13:14:14', '2018-06-25 08:55:00'),
(75, 8, '3', '<p>Order with AM-1529646985  status changed to Delivered.</p>', '/orders/view/AM-1529646985', '0', '2', '2018-06-22 13:14:14', '2018-06-22 14:58:06'),
(76, 1, '3', '<p>Order with AM-1529646985  status changed to Delivered.</p>', '/orders/view/AM-1529646985', '1', '2', '2018-06-22 13:14:14', '2018-06-25 10:01:19'),
(77, 1, '2', '<p>Order with AM-1529646985  status changed to Completed.</p>', 'my_orders/AM-1529646985', '1', '2', '2018-06-22 13:14:20', '2018-06-22 14:58:06'),
(78, 1, '1', '<p>Order with AM-1529646985  status changed to Completed.</p>', '/orders/view/AM-1529646985', '1', '2', '2018-06-22 13:14:22', '2018-06-25 08:55:00'),
(79, 8, '3', '<p>Order with AM-1529646985  status changed to Completed.</p>', '/orders/view/AM-1529646985', '0', '2', '2018-06-22 13:14:22', '2018-06-22 14:58:06'),
(80, 1, '3', '<p>Order with AM-1529646985  status changed to Completed.</p>', '/orders/view/AM-1529646985', '1', '2', '2018-06-22 13:14:22', '2018-06-25 10:01:10'),
(81, 1, '2', '<p>Order with AM-1529646743  status changed to Confirmed.</p>', 'my_orders/AM-1529646743', '1', '2', '2018-06-22 13:14:28', '2018-06-22 14:58:06'),
(82, 1, '1', '<p>Order with AM-1529646743  status changed to Confirmed.</p>', '/orders/view/AM-1529646743', '1', '2', '2018-06-22 13:14:30', '2018-06-25 08:55:00'),
(83, 8, '3', '<p>Order with AM-1529646743  status changed to Confirmed.</p>', '/orders/view/AM-1529646743', '0', '2', '2018-06-22 13:14:30', '2018-06-22 14:58:06'),
(84, 8, '3', '<p>Order with AM-1529646743  status changed to Confirmed.</p>', '/orders/view/AM-1529646743', '0', '2', '2018-06-22 13:14:30', '2018-06-22 14:58:06'),
(85, 8, '3', '<p>Order with AM-1529646743  status changed to Confirmed.</p>', '/orders/view/AM-1529646743', '0', '2', '2018-06-22 13:14:30', '2018-06-22 14:58:06'),
(86, 1, '2', '<p>Order with AM-1529646743  status changed to Dispatched.</p>', 'my_orders/AM-1529646743', '1', '2', '2018-06-22 13:14:36', '2018-06-22 14:58:06'),
(87, 1, '1', '<p>Order with AM-1529646743  status changed to Dispatched.</p>', '/orders/view/AM-1529646743', '1', '2', '2018-06-22 13:14:38', '2018-06-25 08:55:00'),
(88, 8, '3', '<p>Order with AM-1529646743  status changed to Dispatched.</p>', '/orders/view/AM-1529646743', '0', '2', '2018-06-22 13:14:38', '2018-06-22 14:58:06'),
(89, 8, '3', '<p>Order with AM-1529646743  status changed to Dispatched.</p>', '/orders/view/AM-1529646743', '0', '2', '2018-06-22 13:14:38', '2018-06-22 14:58:06'),
(90, 8, '3', '<p>Order with AM-1529646743  status changed to Dispatched.</p>', '/orders/view/AM-1529646743', '0', '2', '2018-06-22 13:14:38', '2018-06-22 14:58:06'),
(91, 1, '2', '<p>Order with AM-1529646743  status changed to Delivered.</p>', 'my_orders/AM-1529646743', '1', '2', '2018-06-22 13:15:59', '2018-06-22 14:58:06'),
(92, 1, '1', '<p>Order with AM-1529646743  status changed to Delivered.</p>', '/orders/view/AM-1529646743', '1', '2', '2018-06-22 13:16:02', '2018-06-25 08:55:00'),
(93, 8, '3', '<p>Order with AM-1529646743  status changed to Delivered.</p>', '/orders/view/AM-1529646743', '0', '2', '2018-06-22 13:16:02', '2018-06-22 14:58:06'),
(94, 8, '3', '<p>Order with AM-1529646743  status changed to Delivered.</p>', '/orders/view/AM-1529646743', '0', '2', '2018-06-22 13:16:02', '2018-06-22 14:58:06'),
(95, 8, '3', '<p>Order with AM-1529646743  status changed to Delivered.</p>', '/orders/view/AM-1529646743', '0', '2', '2018-06-22 13:16:02', '2018-06-22 14:58:06'),
(96, 1, '2', '<p>Order with AM-1529646743  status changed to Completed.</p>', 'my_orders/AM-1529646743', '1', '2', '2018-06-22 13:16:08', '2018-06-22 14:58:06'),
(97, 1, '1', '<p>Order with AM-1529646743  status changed to Completed.</p>', '/orders/view/AM-1529646743', '1', '2', '2018-06-22 13:16:10', '2018-06-25 08:55:00'),
(98, 8, '3', '<p>Order with AM-1529646743  status changed to Completed.</p>', '/orders/view/AM-1529646743', '0', '2', '2018-06-22 13:16:10', '2018-06-22 14:58:06'),
(99, 8, '3', '<p>Order with AM-1529646743  status changed to Completed.</p>', '/orders/view/AM-1529646743', '0', '2', '2018-06-22 13:16:10', '2018-06-22 14:58:06'),
(100, 8, '3', '<p>Order with AM-1529646743  status changed to Completed.</p>', '/orders/view/AM-1529646743', '0', '2', '2018-06-22 13:16:10', '2018-06-22 14:58:06'),
(101, 1, '1', '<p>Nayan Pawar has requested to return product Promise Solitire Ring</p>', 'return_product/view/Mw==/NDU=', '1', '2', '2018-06-22 13:16:41', '2018-06-22 14:58:06'),
(102, 1, '2', 'Admin Webwing has rejected your product return request for product Promise Solitire Ring.', 'my_orders/details/NDU=', '1', '2', '2018-06-22 13:32:57', '2018-06-22 14:58:06'),
(103, 1, '1', '<p>Nayan Pawar has requested to replace product Classic Solitaire Bangle</p>', 'replacement_products', '1', '2', '2018-06-22 13:38:31', '2018-06-25 08:55:00'),
(104, 1, '1', '<p>Nayan Pawar has requested to replace product Brown Dimond Ring</p>', 'replacement_products', '1', '2', '2018-06-22 13:45:50', '2018-06-25 08:55:00'),
(105, 1, '2', 'Admin Webwing has accepted your product replacement request for product Classic Solitaire Bangle.', 'my_orders/details/NDY=', '1', '2', '2018-06-22 13:55:45', '2018-06-22 14:58:06'),
(106, 1, '2', '<p>Your order placed successfully with order id AM-9467333531</p>', 'my_orders/Mjc=', '1', '2', '2018-06-22 14:03:05', '2018-06-22 14:58:06'),
(107, 1, '1', '<p>New order placed with AM-9467333531.</p>', 'orders/view/Mjc=', '1', '2', '2018-06-22 14:03:07', '2018-06-25 08:55:00'),
(108, 8, '3', '<p>New order placed with AM-9467333531.</p>', 'orders/view/AM-9467333531', '0', '2', '2018-06-22 14:03:07', '2018-06-22 14:58:06'),
(109, 54, '3', '<p>New order placed with AM-9467333531.</p>', 'orders/view/AM-9467333531', '1', '2', '2018-06-22 14:03:07', '2018-09-19 16:49:22'),
(110, 1, '2', '<p>Your order placed successfully with order id AM-9081670779</p>', 'my_orders/Mjg=', '1', '2', '2018-06-22 14:39:25', '2018-06-22 14:58:06'),
(111, 1, '1', '<p>New order placed with AM-9081670779.</p>', 'orders/new/view/Mjg=', '1', '2', '2018-06-22 14:39:27', '2018-06-25 08:55:00'),
(112, 54, '3', '<p>New order placed with AM-9081670779.</p>', 'orders/view/AM-9081670779', '1', '2', '2018-06-22 14:39:28', '2018-09-19 16:49:22'),
(113, 1, '1', '<p>sagar is registered as a User</p>', 'user/customers/view/MzQ=', '1', NULL, '2018-06-25 04:33:21', '2018-06-25 08:55:00'),
(114, 1, '1', '<p>sagar is registered as a User</p>', 'user/customers/view/MzU=', '1', NULL, '2018-06-25 04:34:56', '2018-06-25 08:55:00'),
(115, 1, '2', '<p>Your order placed successfully with order id AM-0264140216</p>', 'my_orders/Mjk=', '1', '2', '2018-06-25 10:55:15', '2018-06-25 11:48:31'),
(116, 1, '1', '<p>New order placed with AM-0264140216.</p>', 'orders/new/view/Mjk=', '1', '2', '2018-06-25 10:55:18', '2018-06-26 09:54:40'),
(117, 8, '3', '<p>New order placed with AM-0264140216.</p>', 'orders/new/view/AM-0264140216', '0', '1', '2018-06-25 10:55:18', '2018-06-25 10:55:18'),
(118, 54, '3', '<p>New order placed with AM-0264140216.</p>', 'orders/new/view/AM-0264140216', '1', '1', '2018-06-25 10:55:18', '2018-09-19 16:49:22'),
(119, 1, '1', '<p>dsfsd is registered as a Supplier</p>', 'user/suppliers/view/NTU=', '1', NULL, '2018-06-25 11:25:44', '2018-06-26 09:54:40'),
(120, 1, '1', '<p>dssd is registered as a Supplier</p>', 'user/suppliers/view/NTY=', '1', NULL, '2018-06-25 11:28:50', '2018-06-25 11:30:50'),
(121, 1, '1', '<p>Nitin is registered as a User</p>', 'user/customers/view/MzY=', '1', NULL, '2018-06-25 12:04:41', '2018-06-26 09:54:40'),
(122, 1, '3', '<p>Nayan Pawar has requested to return product Classic Solitaire Bangle</p>', 'orders/return/view/NA==/NDY=', '1', NULL, '2018-06-25 12:58:43', '2018-06-25 13:00:07'),
(123, 1, '3', '<p>Nayan Pawar has requested to return product Classic Solitaire Bangle</p>', 'orders/return/view/NA==/NDY=', '1', NULL, '2018-06-25 12:58:44', '2018-06-25 12:59:05'),
(124, 1, '2', 'Admin Webwing has accepted your product return request for product Classic Solitaire Bangle.', 'my_orders/details/NDY=', '1', '3', '2018-06-25 13:30:51', '2018-06-25 14:41:03'),
(125, 1, '3', 'Admin Webwing has accepted your product return request for product Classic Solitaire Bangle.', 'my_orders/details/NDY=', '1', '3', '2018-06-25 13:30:51', '2018-06-25 13:31:15'),
(126, 1, '2', 'Admin Webwing has accepted your product return request for product Classic Solitaire Bangle.', 'my_orders/details/NDY=', '1', '3', '2018-06-25 13:32:31', '2018-06-25 14:41:03'),
(127, 1, '3', 'Admin Webwing has accepted your product return request for product Classic Solitaire Bangle.', 'orders/return/view/NDY=', '1', '3', '2018-06-25 13:32:31', '2018-06-25 13:32:56'),
(128, 1, '2', '<p>Admin Webwing has accepted product return request for product Classic Solitaire Bangle.</p>', 'my_orders/details/NDY=', '1', '3', '2018-06-25 13:54:00', '2018-06-25 14:41:03'),
(129, 1, '3', '<p>Admin Webwing has accepted product return request for product Classic Solitaire Bangle.</p>', 'orders/return/view//NA==/NDY=', '1', '3', '2018-06-25 13:54:00', '2018-06-25 13:54:14'),
(130, 1, '2', '<p>Admin Webwing has accepted product return request for product Classic Solitaire Bangle.</p>', 'my_orders/details/NDY=', '1', '3', '2018-06-25 13:55:03', '2018-06-25 14:41:03'),
(131, 1, '3', '<p>Admin Webwing has accepted product return request for product Classic Solitaire Bangle.</p>', 'orders/return/view/NA==/NDY=', '1', '3', '2018-06-25 13:55:03', '2018-06-25 13:55:29'),
(132, 1, '2', '<p>Admin Webwing has rejected product return request for product Classic Solitaire Bangle.</p>', 'my_orders/details/NDY=', '1', '4', '2018-06-25 13:59:56', '2018-06-25 14:41:03'),
(133, 1, '3', '<p>Admin Webwing has rejected product return request for product Classic Solitaire Bangle.</p>', 'orders/return/view/NA==/NDY=', '1', '4', '2018-06-25 13:59:59', '2018-06-25 14:00:26'),
(134, 1, '2', 'Your payment for return product Classic Solitaire Bangle has been released. Please check your account.', 'my_orders/details/NDY=', '1', '3', '2018-06-25 14:25:54', '2018-06-25 14:41:03'),
(135, 1, '3', 'Classic Solitaire Bangle has been returned.', 'return/view/NDY=', '1', '3', '2018-06-25 14:25:56', '2018-06-25 14:26:40'),
(136, 1, '2', 'Your payment for return product Classic Solitaire Bangle has been released. Please check your account.', 'my_orders/details/NDY=', '1', '3', '2018-06-25 14:31:19', '2018-06-25 14:41:03'),
(137, 1, '2', 'Your payment for return product Classic Solitaire Bangle has been released. Please check your account.', 'my_orders/details/NDY=', '1', '3', '2018-06-25 14:32:07', '2018-06-25 14:41:03'),
(138, 1, '3', '<p>Product Classic Solitaire Bangle has been returned.</p>', 'return/view/NA==/NDY=', '1', '3', '2018-06-25 14:32:08', '2018-06-25 14:33:15'),
(139, 1, '2', 'Your payment for return product Classic Solitaire Bangle has been released. Please check your account.', 'my_orders/details/NDY=', '1', '3', '2018-06-25 14:34:49', '2018-06-25 14:41:03'),
(140, 1, '3', '<p>Product Classic Solitaire Bangle has been returned.</p>', 'orders/return/view/NA==/NDY=', '1', '3', '2018-06-25 14:34:51', '2018-06-25 14:35:03'),
(141, 1, '2', 'Admin Webwing has rejected product Classic Solitaire Bangle.', 'my_orders/details/NDY=', '1', '4', '2018-06-25 14:39:16', '2018-06-25 14:41:03'),
(142, 1, '2', 'Admin Webwing has rejected product Classic Solitaire Bangle.', 'my_orders/details/NDY=', '1', '4', '2018-06-25 14:39:17', '2018-06-25 14:41:03'),
(143, 1, '2', 'Admin Webwing has rejected product Classic Solitaire Bangle.', 'my_orders/details/NDY=', '1', '4', '2018-06-25 14:41:32', '2018-06-25 14:42:26'),
(144, 1, '3', 'Admin Webwing has rejected product Classic Solitaire Bangle.', 'return/view/NA==/NDY=', '1', '4', '2018-06-25 14:41:35', '2018-06-25 14:41:50'),
(145, 1, '2', 'Admin Webwing has rejected product Classic Solitaire Bangle.', 'my_orders/details/NDY=', '1', '4', '2018-06-25 14:43:02', '2018-06-25 14:53:38'),
(146, 1, '3', 'Admin Webwing has rejected product Classic Solitaire Bangle.', 'orders/return/view/NA==/NDY=', '1', '4', '2018-06-25 14:43:03', '2018-06-25 14:43:11'),
(147, 8, '3', '<p>Nayan Pawar has requested to return product 18 Kt Yellow Gold Bangle</p>', 'orders/return/view/NQ==/NDQ=', '0', NULL, '2018-06-25 14:54:27', '2018-06-25 14:54:27'),
(148, 8, '3', '<p>Nayan Pawar has requested to return product 18 Kt Yellow Gold Bangle</p>', 'orders/return/view/NQ==/NDQ=', '0', NULL, '2018-06-25 14:54:27', '2018-06-25 14:54:27'),
(149, 8, '3', '<p>Nayan Pawar has requested to return product 18 Kt Yellow Gold Bangle</p>', 'orders/return/view/Ng==/NDQ=', '0', NULL, '2018-06-25 14:55:52', '2018-06-25 14:55:52'),
(150, 1, '1', '<p>Nayan Pawar has requested to return product 18 Kt Yellow Gold Bangle</p>', 'return_product/view/Ng==/NDQ=', '1', NULL, '2018-06-25 14:55:52', '2018-06-25 14:56:07'),
(151, 1, '2', '<p>Your order placed successfully with order id AM-0517857812</p>', 'my_orders/MzE=', '1', '2', '2018-06-26 04:26:59', '2018-06-26 04:32:45'),
(152, 1, '1', '<p>New order placed with AM-0517857812.</p>', 'orders/new/view/MzE=', '1', '2', '2018-06-26 04:27:01', '2018-06-26 09:54:40'),
(153, 8, '3', '<p>New order placed with AM-0517857812.</p>', 'orders/new/view/MzE=', '0', '1', '2018-06-26 04:27:01', '2018-06-26 04:27:01'),
(154, 1, '1', '<p>Rohini Jagtap has added new Classic product - old ring</p>', 'products/supplier/view/NTc=', '1', NULL, '2018-06-26 04:28:44', '2018-06-26 04:28:56'),
(155, 1, '3', '<p>Your product old ring approved by admin.</p>', 'product/jewellery/view/NTc=', '1', NULL, '2018-06-26 04:29:03', '2018-06-26 09:34:10'),
(156, 1, '2', '<p>Your order placed successfully with order id AM-6039556786</p>', 'my_orders/MzI=', '1', '2', '2018-06-26 04:30:44', '2018-06-26 04:32:45'),
(157, 1, '1', '<p>New order placed with AM-6039556786.</p>', 'orders/new/view/MzI=', '1', '2', '2018-06-26 04:30:46', '2018-06-26 04:30:59'),
(158, 1, '3', '<p>New order placed with AM-6039556786.</p>', 'orders/new/view/MzI=', '1', '1', '2018-06-26 04:30:46', '2018-06-26 04:31:20'),
(159, 1, '2', '<p>Order with AM-6039556786  status changed to Confirmed.</p>', 'my_orders/AM-6039556786', '1', '2', '2018-06-26 04:31:34', '2018-06-26 04:32:45'),
(160, 1, '1', '<p>Order with AM-6039556786  status changed to Confirmed.</p>', '/orders/view/AM-6039556786', '1', '2', '2018-06-26 04:31:36', '2018-06-26 09:54:40'),
(161, 1, '3', '<p>Order with AM-6039556786  status changed to Confirmed.</p>', '/orders/view/AM-6039556786', '1', '2', '2018-06-26 04:31:36', '2018-06-26 09:34:10'),
(162, 1, '2', '<p>Your order placed successfully with order id AM-1187035513</p>', 'my_orders/MzM=', '1', '2', '2018-06-26 04:31:40', '2018-06-26 04:32:45'),
(163, 1, '1', '<p>New order placed with AM-1187035513.</p>', 'orders/new/view/MzM=', '1', '2', '2018-06-26 04:31:42', '2018-06-26 09:54:40'),
(164, 8, '3', '<p>New order placed with AM-1187035513.</p>', 'orders/new/view/MzM=', '0', '1', '2018-06-26 04:31:42', '2018-06-26 04:31:42'),
(165, 1, '2', '<p>Order with AM-1187035513  status changed to Confirmed.</p>', 'my_orders/AM-1187035513', '1', '2', '2018-06-26 04:31:45', '2018-06-26 04:32:45'),
(166, 1, '1', '<p>Order with AM-1187035513  status changed to Confirmed.</p>', '/orders/view/AM-1187035513', '1', '2', '2018-06-26 04:31:47', '2018-06-26 09:54:40'),
(167, 8, '3', '<p>Order with AM-1187035513  status changed to Confirmed.</p>', '/orders/view/AM-1187035513', '0', '2', '2018-06-26 04:31:47', '2018-06-26 04:31:47'),
(168, 1, '2', '<p>Order with AM-1187035513  status changed to Dispatched.</p>', 'my_orders/AM-1187035513', '1', '3', '2018-06-26 04:31:55', '2018-06-26 04:32:45'),
(169, 1, '1', '<p>Order with AM-1187035513  status changed to Dispatched.</p>', '/orders/view/AM-1187035513', '1', '3', '2018-06-26 04:31:57', '2018-06-26 09:54:40'),
(170, 8, '3', '<p>Order with AM-1187035513  status changed to Dispatched.</p>', '/orders/view/AM-1187035513', '0', '3', '2018-06-26 04:31:57', '2018-06-26 04:31:57'),
(171, 1, '2', '<p>Order with AM-6039556786  status changed to Dispatched.</p>', 'my_orders/AM-6039556786', '1', '3', '2018-06-26 04:32:05', '2018-06-26 04:32:45'),
(172, 1, '1', '<p>Order with AM-6039556786  status changed to Dispatched.</p>', '/orders/view/AM-6039556786', '1', '3', '2018-06-26 04:32:06', '2018-06-26 09:54:40'),
(173, 1, '3', '<p>Order with AM-6039556786  status changed to Dispatched.</p>', '/orders/view/AM-6039556786', '1', '3', '2018-06-26 04:32:07', '2018-06-26 09:34:10'),
(174, 1, '2', '<p>Order with AM-6039556786  status changed to Delivered.</p>', 'my_orders/AM-6039556786', '1', '3', '2018-06-26 04:32:15', '2018-06-26 04:32:45'),
(175, 1, '1', '<p>Order with AM-6039556786  status changed to Delivered.</p>', '/orders/view/AM-6039556786', '1', '3', '2018-06-26 04:32:18', '2018-06-26 09:54:40'),
(176, 1, '3', '<p>Order with AM-6039556786  status changed to Delivered.</p>', '/orders/view/AM-6039556786', '1', '3', '2018-06-26 04:32:18', '2018-06-26 09:34:10'),
(177, 1, '2', '<p>Order with AM-6039556786  status changed to Completed.</p>', 'my_orders/AM-6039556786', '1', '3', '2018-06-26 04:32:28', '2018-06-26 04:32:45'),
(178, 1, '1', '<p>Order with AM-6039556786  status changed to Completed.</p>', '/orders/view/AM-6039556786', '1', '3', '2018-06-26 04:32:30', '2018-06-26 09:54:40'),
(179, 1, '3', '<p>Order with AM-6039556786  status changed to Completed.</p>', '/orders/view/AM-6039556786', '1', '3', '2018-06-26 04:32:30', '2018-06-26 09:34:10'),
(180, 1, '3', '<p>Nayan Pawar has requested to return product old ring</p>', 'orders/return/view/Nw==/NTQ=', '1', NULL, '2018-06-26 04:33:19', '2018-06-26 04:33:38'),
(181, 1, '1', '<p>Nayan Pawar has requested to return product old ring</p>', 'return_product/view/Nw==/NTQ=', '1', NULL, '2018-06-26 04:33:19', '2018-06-26 04:33:28'),
(182, 1, '2', '<p>Admin Webwing has accepted product return request for product old ring.</p>', 'my_orders/details/NTQ=', '1', '3', '2018-06-26 04:34:55', '2018-06-26 04:35:26'),
(183, 1, '3', '<p>Admin Webwing has accepted product return request for product old ring.</p>', 'orders/return/view/Nw==/NTQ=', '1', '3', '2018-06-26 04:34:55', '2018-06-26 04:35:09'),
(184, 1, '2', 'Your payment of Rs 4 for return product old ring has been sent to your wallet. Please check wallet.', 'my_orders/details/NTQ=', '1', '3', '2018-06-26 04:35:58', '2018-06-26 04:36:30'),
(185, 1, '3', '<p>Product old ring has been returned.</p>', 'orders/return/view/Nw==/NTQ=', '1', '3', '2018-06-26 04:36:00', '2018-06-26 04:36:22'),
(186, 1, '2', '<p>Admin Webwing has rejected product return request for product old ring.</p>', 'my_orders/details/NTQ=', '1', '4', '2018-06-26 04:37:02', '2018-06-26 04:38:14'),
(187, 1, '3', '<p>Admin Webwing has rejected product return request for product old ring.</p>', 'orders/return/view/Nw==/NTQ=', '1', '4', '2018-06-26 04:37:04', '2018-06-26 04:37:15'),
(188, 1, '2', 'Admin Webwing has rejected product old ring.', 'my_orders/details/NTQ=', '1', '4', '2018-06-26 04:37:55', '2018-06-26 04:38:14'),
(189, 1, '3', 'Admin Webwing has rejected product old ring.', 'orders/return/view/Nw==/NTQ=', '1', '4', '2018-06-26 04:37:57', '2018-06-26 04:38:07'),
(190, 1, '2', '<p>Your order placed successfully with order id AM-9892738921</p>', 'my_orders/MzQ=', '0', '2', '2018-06-26 05:11:22', '2018-06-26 05:11:22'),
(191, 1, '1', '<p>New order placed with AM-9892738921.</p>', 'orders/new/view/MzQ=', '1', '2', '2018-06-26 05:11:24', '2018-06-26 09:54:40'),
(192, 54, '3', '<p>New order placed with AM-9892738921.</p>', 'orders/new/view/MzQ=', '1', '1', '2018-06-26 05:11:24', '2018-09-19 16:49:22'),
(193, 1, '2', '<p>Your order placed successfully with order id AM-4912878423</p>', 'my_orders/MzU=', '0', '2', '2018-06-26 05:14:33', '2018-06-26 05:14:33'),
(194, 1, '1', '<p>New order placed with AM-4912878423.</p>', 'orders/new/view/MzU=', '1', '2', '2018-06-26 05:14:34', '2018-06-26 09:54:40'),
(195, 1, '3', '<p>New order placed with AM-4912878423.</p>', 'orders/new/view/MzU=', '1', '1', '2018-06-26 05:14:35', '2018-06-26 09:34:10'),
(196, 1, '2', '<p>Your order placed successfully with order id AM-5434900343</p>', 'my_orders/Mzg=', '0', '2', '2018-06-26 05:18:27', '2018-06-26 05:18:27'),
(197, 1, '1', '<p>New order placed with AM-5434900343.</p>', 'orders/new/view/Mzg=', '1', '2', '2018-06-26 05:18:27', '2018-06-26 09:54:40'),
(198, 8, '3', '<p>New order placed with AM-5434900343.</p>', 'orders/new/view/Mzg=', '0', '1', '2018-06-26 05:18:27', '2018-06-26 05:18:27'),
(199, 1, '2', 'Your payment of Rs 3 for return product old ring has been sent to your wallet. Please check wallet.', 'my_orders/details/NTQ=', '0', '3', '2018-06-26 13:20:57', '2018-06-26 13:20:57'),
(200, 1, '3', '<p>Product old ring has been returned.</p>', 'orders/return/view/Nw==/NTQ=', '1', '3', '2018-06-26 13:20:59', '2018-06-27 04:43:07'),
(201, 1, '2', 'Your payment for return product Classic Solitaire Bangle has been released. Please check your account.', 'my_orders/details/NDY=', '0', '3', '2018-06-26 13:28:09', '2018-06-26 13:28:09'),
(202, 1, '3', '<p>Product Classic Solitaire Bangle has been returned.</p>', 'orders/return/view/NA==/NDY=', '1', '3', '2018-06-26 13:28:12', '2018-06-27 04:43:07'),
(203, 1, '1', '<p>Trial is registered as a Supplier</p>', 'user/suppliers/view/NTc=', '1', NULL, '2018-09-29 15:40:56', '2018-10-01 17:12:22'),
(204, 1, '1', '<p>raj is registered as a Supplier</p>', 'user/suppliers/view/NTg=', '1', NULL, '2018-09-29 15:45:00', '2018-10-01 17:12:22'),
(205, 58, '3', '<p>Your product Classic Ring approved by admin.</p>', 'product/jewellery/view/NjE=', '0', NULL, '2018-09-29 16:30:30', '2018-09-29 16:30:30'),
(206, 58, '3', '<p>Your product Classic Ring approved by admin.</p>', 'product/jewellery/view/NjI=', '0', NULL, '2018-09-29 17:00:09', '2018-09-29 17:00:09'),
(207, 58, '3', '<p>Your product Classic Necklace approved by admin.</p>', 'product/jewellery/view/NjM=', '0', NULL, '2018-09-29 17:00:13', '2018-09-29 17:00:13'),
(208, 1, '3', '<p>Your product Classic Ring approvel request rejected by admin.</p>', 'product/jewellery/view/Nzc=', '0', NULL, '2018-10-12 13:19:43', '2018-10-12 13:19:43'),
(209, 1, '2', '<p>Your order placed successfully with order id AM-5707497982</p>', 'my_orders/Mzk=', '0', '2', '2018-10-20 10:10:15', '2018-10-20 10:10:15'),
(210, 1, '1', '<p>New order placed with AM-5707497982.</p>', 'orders/new/view/Mzk=', '0', '2', '2018-10-20 10:10:16', '2018-10-20 10:10:16'),
(211, 1, '3', '<p>New order placed with AM-5707497982.</p>', 'orders/new/view/Mzk=', '0', '1', '2018-10-20 10:10:16', '2018-10-20 10:10:16'),
(212, 0, '1', '<p>Your product VA1011 approved by admin.</p>', 'product/jewellery/view/ODI=', '0', NULL, '2018-10-31 06:34:18', '2018-10-31 06:34:18'),
(213, 0, '1', '<p>Your product VA1011 approved by admin.</p>', 'product/jewellery/view/ODM=', '0', NULL, '2018-10-31 06:40:22', '2018-10-31 06:40:22');

-- --------------------------------------------------------

--
-- Table structure for table `notification_template`
--

CREATE TABLE `notification_template` (
  `id` int(11) NOT NULL,
  `template_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `template_html` text COLLATE utf8_unicode_ci NOT NULL,
  `template_variables` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NA' COMMENT '~ Separated',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notification_template`
--

INSERT INTO `notification_template` (`id`, `template_name`, `template_html`, `template_variables`, `created_at`, `updated_at`) VALUES
(1, 'Product Approval', '<p>Your product ##PRODUCT_NAME## approved by admin.</p>', '##NAME##~##USER_TYPE##', '2018-04-22 18:30:00', '2018-05-04 00:48:41'),
(2, 'Adding new product', '<p>##SUPPLIER_NAME## has added new ##PRODUCT_TYPE## product - ##PRODUCT_NAME##</p>', '##SUPPLIER_NAME##~##PRODUCT_TYPE##~##PRODUCT_NAME##', '2018-05-02 18:30:00', '2018-05-03 04:00:20'),
(3, 'Adding new product', '<p>##SUPPLIER_NAME## has added new ##PRODUCT_TYPE## product - ##PRODUCT_NAME##</p>', '##SUPPLIER_NAME##~##PRODUCT_TYPE##~##PRODUCT_NAME##', '2018-05-02 18:30:00', '2018-05-03 04:00:20'),
(4, 'Product Approval Rejection', '<p>Your product ##PRODUCT_NAME## approvel request rejected by admin.</p>', '##NAME##~##USER_TYPE##', '2018-04-22 18:30:00', '2018-05-04 00:49:39'),
(5, 'New Registration', '<p>##NAME## is registered as a ##USER_TYPE##</p>', '##NAME##~##USER_TYPE##', '2018-04-22 09:00:00', '2018-04-27 05:04:12'),
(6, 'website commission', '##ADMIN_NAME## has set website commission - ##PERCENT##%', '##ADMIN_NAME##~##PERCENT##', '2018-05-04 18:30:00', '2018-05-04 18:30:00'),
(7, 'send OTP', '##OTP## is OTP to valiadte your gift card.', '##ADMIN_NAME##~##PERCENT##', '2018-05-08 22:42:11', '2018-05-04 18:30:00'),
(8, 'Product return request', '<p>##USER_NAME## has requested to return product ##PRODUCT_NAME##</p>', '##USER_NAME##~##PRODUCT_NAME##', '2018-05-04 18:30:00', '2018-06-02 06:46:39'),
(9, 'Your Order Placed successfully', '<p>Your order placed successfully with order id ##ORDER_ID##</p>', '##ORDER_ID##', '2018-05-04 18:30:00', '2018-06-04 03:06:57'),
(10, 'Admin: New Order Placed', '<p>New order placed with ##ORDER_ID##.</p>', '##ORDER_ID##', '2018-05-04 18:30:00', '2018-06-04 03:50:05'),
(11, 'Supplier: New Order Placed', '<p>New order placed with ##ORDER_ID##.</p>', '##ORDER_ID##', '2018-05-04 18:30:00', '2018-06-04 03:50:05'),
(12, 'Product return request acceptance and rejection', '<p>##ADMIN_NAME## has ##STATUS## product return request for product ##PRODUCT_NAME##.</p>', '##ADMIN_NAME##~##STATUS##~##PRODUCT_NAME##', '2018-06-03 18:30:00', '2018-06-25 13:53:48'),
(13, 'Return amount to wallet', 'Your payment of Rs ##AMOUNT## for return product ##PRODUCT_NAME## has been sent to your wallet. Please check wallet.', '##AMOUNT##~##PRODUCT_NAME##', '2018-06-04 18:30:00', '2018-06-04 18:30:00'),
(14, 'Return amount to Bank account', 'Your payment for return product ##PRODUCT_NAME## has been released. Please check your account.', '##PRODUCT_NAME##', NULL, NULL),
(15, 'Product return rejection', '##ADMIN_NAME## has ##STATUS## product ##PRODUCT_NAME##.', '##ADMIN_NAME##~##STATUS##~##PRODUCT_NAME##', '2018-06-03 18:30:00', '2018-06-03 18:30:00'),
(16, 'Your Order status changed to ##STATUS##', '<p>Order with ##ORDER_ID##  status changed to ##STATUS##.</p>', '##ORDER_ID##~##STATUS##', '2018-05-04 18:30:00', '2018-06-04 03:06:57'),
(17, 'Admin: Order status changed to ##STATUS##', '<p>Order with ##ORDER_ID##  status changed to ##STATUS##.</p>', '##ORDER_ID##~##STATUS##', '2018-05-04 18:30:00', '2018-06-04 03:50:05'),
(18, 'Supplier: Order status changed to ##STATUS##', '<p>Order with ##ORDER_ID##  status changed to ##STATUS##.</p>', '##ORDER_ID##~##STATUS##', '2018-05-04 18:30:00', '2018-06-04 03:50:05'),
(19, 'Valuation Request', '##USER_NAME## has requested for product valuation.', '##USER_NAME##', '2018-05-04 18:30:00', '2018-06-04 03:50:05'),
(20, 'Product replacement request', '<p>##USER_NAME## has requested to replace product ##PRODUCT_NAME##</p>', '##USER_NAME##~##PRODUCT_NAME##', '2018-05-04 18:30:00', '2018-06-02 06:46:39'),
(21, 'Product replacement request acceptance and rejection', '<p>##ADMIN_NAME## has ##STATUS## your product replacement request for product ##PRODUCT_NAME##.</p>', '##ADMIN_NAME##~##STATUS##~##PRODUCT_NAME##', '2018-06-03 18:30:00', '2018-06-25 13:53:31'),
(22, 'Replacement amount to wallet', 'Your payment of Rs ##AMOUNT## for replacement product ##PRODUCT_NAME## has been sent to your wallet. Please check wallet.', '##AMOUNT##~##PRODUCT_NAME##', '2018-06-04 18:30:00', '2018-06-04 18:30:00'),
(23, 'Product replacement rejection', '##ADMIN_NAME## has ##STATUS## your product ##PRODUCT_NAME##.', '##ADMIN_NAME##~##STATUS##~##PRODUCT_NAME##', '2018-06-03 18:30:00', '2018-06-03 18:30:00'),
(24, 'Return product notification to supplier', '<p>Product ##PRODUCT_NAME## has been returned.</p>', '##PRODUCT_NAME##', '2018-06-04 18:30:00', '2018-06-25 14:26:58');

-- --------------------------------------------------------

--
-- Table structure for table `occasions`
--

CREATE TABLE `occasions` (
  `id` int(11) NOT NULL,
  `occasion_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `occasions`
--

INSERT INTO `occasions` (`id`, `occasion_name`, `slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Casual', 'casual', '1', '2018-05-17 04:34:35', '2018-05-17 10:51:14', NULL),
(2, 'Cocktail', 'cocktail', '1', '2018-05-17 04:34:41', '2018-05-17 10:51:20', NULL),
(3, 'Engagement', 'engagement', '1', '2018-05-17 04:34:48', '2018-05-17 10:51:24', NULL),
(4, 'Wedding', 'wedding', '1', '2018-05-17 04:34:53', '2018-09-29 14:00:19', NULL),
(5, 'Formal', 'formal', '1', '2018-05-17 04:35:00', '2018-09-29 14:00:52', NULL),
(6, 'Fun', 'fun', '1', '2018-05-17 04:35:06', '2018-05-17 10:51:35', NULL),
(7, 'Destination', 'destination', '1', '2018-05-17 04:35:12', '2018-05-17 10:51:38', NULL),
(8, 'Religious', 'religious', '1', '2018-05-17 04:35:17', '2018-05-17 10:51:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `order_fname` varchar(255) NOT NULL,
  `order_lname` varchar(255) NOT NULL,
  `order_email` varchar(255) NOT NULL,
  `order_contact_no` varchar(255) NOT NULL,
  `order_flat_no` varchar(255) NOT NULL,
  `order_building_name` varchar(255) NOT NULL,
  `order_city` varchar(255) NOT NULL,
  `order_state` varchar(255) NOT NULL,
  `order_country` varchar(255) NOT NULL,
  `order_address` varchar(255) NOT NULL,
  `order_post_code` varchar(255) NOT NULL,
  `order_payment_method` enum('1','2') NOT NULL COMMENT '1=online, 2=wire_transfer',
  `order_subtotal` float(20,2) NOT NULL,
  `order_base_cost` float(20,2) DEFAULT '0.00' COMMENT 'order cost without discount',
  `order_cost` float(20,2) NOT NULL,
  `order_usd_value` float(20,2) NOT NULL DEFAULT '0.00',
  `order_return_date` timestamp NULL DEFAULT NULL,
  `cancellation_reason` text NOT NULL,
  `status` enum('1','2','3','4','5','0','6') NOT NULL DEFAULT '0' COMMENT '0- placed, 1-pending/inprocess, 2- confirmed, 3-dispatched, 4-delivered, 5-complete, 6-cancel',
  `comment` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `user_id`, `address_id`, `order_fname`, `order_lname`, `order_email`, `order_contact_no`, `order_flat_no`, `order_building_name`, `order_city`, `order_state`, `order_country`, `order_address`, `order_post_code`, `order_payment_method`, `order_subtotal`, `order_base_cost`, `order_cost`, `order_usd_value`, `order_return_date`, `cancellation_reason`, `status`, `comment`, `created_at`, `updated_at`) VALUES
(1, 'AM-1529493343', 13, 6, 'Anna', 'Adam', 'anna.adam51@yahoo.com', '+919921840141', 'Plot No 4', 'Gayatri Socity', 'Nashik', 'maharashtra', 'India', 'samarth chowk , upendra nagar,', '422008', '1', 123.76, 0.00, 129.32, 69.00, '2018-07-20 11:15:43', '', '1', NULL, '2018-05-29 21:55:15', '2018-06-26 05:25:56'),
(2, 'AM-1529493385', 13, 6, 'Anna', 'Adam', 'anna.adam51@yahoo.com', '+919921840141', 'Plot No 4', 'Gayatri Socity', 'Nashik', 'maharashtra', 'India', 'samarth chowk , upendra nagar,', '422008', '1', 123.75, 0.00, 129.32, 69.00, '2018-07-20 11:16:25', '', '1', NULL, '2018-05-22 11:16:25', '2018-06-26 05:26:01'),
(3, 'AM-1529493415', 13, 6, 'Anna', 'Adam', 'anna.adam51@yahoo.com', '+919921840141', 'Plot No 4', 'Gayatri Socity', 'Nashik', 'maharashtra', 'India', 'samarth chowk , upendra nagar,', '422008', '1', 123.75, 0.00, 129.32, 69.00, '2018-07-20 11:16:55', '', '0', NULL, '2018-06-20 11:16:55', '2018-06-20 11:16:55'),
(4, 'AM-1529493427', 13, 6, 'Anna', 'Adam', 'anna.adam51@yahoo.com', '+919921840141', 'Plot No 4', 'Gayatri Socity', 'Nashik', 'maharashtra', 'India', 'samarth chowk , upendra nagar,', '422008', '1', 123.75, 0.00, 129.32, 69.00, '2018-07-20 11:17:07', '', '0', NULL, '2018-06-20 11:17:07', '2018-06-20 11:17:07'),
(5, 'AM-1529493448', 13, 6, 'Anna', 'Adam', 'anna.adam51@yahoo.com', '+919921840141', 'Plot No 4', 'Gayatri Socity', 'Nashik', 'maharashtra', 'India', 'samarth chowk , upendra nagar,', '422008', '2', 123.75, 0.00, 129.32, 69.00, '2018-07-20 11:17:28', '', '5', NULL, '2018-06-20 11:17:28', '2018-06-20 11:20:48'),
(6, 'AM-1529496580', 13, 6, 'Dharmendra', 'Kumar', 'anna.adam51@yahoo.com', '+919922276924', 'Plot No 4', 'Gayatri Socity', 'Nashik', 'maharashtra', 'India', 'samarth chowk , upendra nagar,', '422008', '1', 689700.00, 0.00, 689700.00, 69.00, '2018-07-20 17:39:40', '', '1', NULL, '2018-06-20 17:39:40', '2018-06-20 17:40:05'),
(7, 'AM-1529497321', 13, 6, 'Vipul', 'Sharma', 'vipul@gmail.com', '+919922276924', 'Plot No 4', 'Gayatri Socity', 'Nashik', 'maharashtra', 'India', 'samarth chowk , upendra nagar,', '422008', '1', 126.50, 0.00, 126.50, 69.00, '2018-07-20 17:52:01', '', '1', NULL, '2018-06-16 17:52:01', '2018-06-20 12:23:51'),
(8, 'AM-1529499186', 13, 6, 'Anna', 'Adam', 'anna.adam51@yahoo.com', '+919921840141', 'Plot No 4', 'Gayatri Socity', 'Nashik', 'maharashtra', 'India', 'samarth chowk , upendra nagar,', '422008', '1', 344850.00, 0.00, 358644.00, 69.00, '2018-07-20 18:23:06', '', '5', NULL, '2018-06-20 18:23:06', '2018-06-20 18:38:12'),
(9, 'AM-1529501131', 13, 6, 'Anna', 'Adam', 'anna.adam51@yahoo.com', '+919921840141', 'Plot No 4', 'Gayatri Socity', 'Nashik', 'maharashtra', 'India', 'samarth chowk , upendra nagar,', '422008', '2', 72105.00, 0.00, 75349.73, 69.00, '2018-07-20 18:55:31', '', '5', NULL, '2018-06-20 18:55:31', '2018-06-21 18:42:12'),
(10, 'AM-1529555686', 13, 11, 'Webwing Technologies', 'Ltd', 'dev@webwingtechnologies.com', '+919923266699', 'Plot No 5', 'pooja apartment', 'Nashik', 'Maharashtra', 'India', 'Pavan Nagar', '422008', '1', 1748285.00, 0.00, 1749486.75, 69.00, '2018-07-21 10:04:46', 'dsdds', '6', NULL, '2018-06-21 10:04:46', '2018-06-22 05:41:22'),
(11, 'AM-1529556422', 13, 6, 'Anna', 'Adam', 'anna.adam51@yahoo.com', '+919921840141', 'Plot No 4', 'Gayatri Socity', 'Nashik', 'maharashtra', 'India', 'samarth chowk , upendra nagar,', '422008', '1', 36052.50, 0.00, 37674.86, 69.00, '2018-07-21 10:17:02', '\r\nJoke of the day:\r\nSponsored by: CostPerKg.com\r\nCheck cost per kilo of an item\r\nMorning at the office after Halloween:\r\n\r\nJosh: \r\n\r\n- Bro, you sick? I saw a Doctor coming out of your house yesterday.\r\n\r\nLeonard: © www.lettercount.com - come back tomorrow\r\n\r\n- Nah bro. I saw a soldier come out of your house yesterday, you at war?\r\nThis is a free online calculator which counts the number of characters or letters in a text, useful for your tweets on Twitter, as well as a multitude of other applications.', '6', NULL, '2018-06-21 10:17:02', '2018-06-21 05:44:37'),
(12, 'AM-1529564378', 13, 6, 'Webwing Technologies', 'Ltd', 'dev@webwingtechnologies.com', '+919923266699', 'Plot No 4', 'Gayatri Socity', 'Nashik', 'maharashtra', 'India', 'samarth chowk , upendra nagar,', '422008', '1', 43234068.00, 0.00, 43234068.00, 69.00, '2018-07-21 12:29:38', 'test', '6', NULL, '2018-06-21 12:29:38', '2018-06-21 12:31:46'),
(13, 'AM-1529565961', 13, 6, 'Anna', 'Adam', 'anna.adam51@yahoo.com', '+919921840141', 'Plot No 4', 'Gayatri Socity', 'Nashik', 'maharashtra', 'India', 'samarth chowk , upendra nagar,', '422008', '2', 24035.00, 0.00, 24996.40, 69.00, '2018-07-21 12:56:01', 'When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address When Student email address then and wrong password then should not show the 500 ip address', '6', NULL, '2018-06-21 12:56:01', '2018-06-21 12:59:55'),
(14, 'AM-1529566029', 13, 6, 'Anna', 'Adam', 'anna.adam51@yahoo.com', '+919921840141', 'Plot No 4', 'Gayatri Socity', 'Nashik', 'maharashtra', 'India', 'samarth chowk , upendra nagar,', '422008', '1', 36052.50, 0.00, 37674.86, 69.00, '2018-07-21 12:57:09', '', '5', NULL, '2018-06-21 12:57:09', '2018-06-21 18:39:18'),
(15, 'AM-1529570794', 13, 6, 'Webwing Technologies', 'Ltd', 'dev@webwingtechnologies.com', '+919923266699', 'Plot No 4', 'Gayatri Socity', 'Nashik', 'maharashtra', 'India', 'samarth chowk , upendra nagar,', '422008', '2', 2758800.00, 0.00, 2758800.00, 69.00, '2018-07-21 18:16:34', '', '5', NULL, '2018-06-21 18:16:34', '2018-06-21 18:46:33'),
(16, 'AM-1529571229', 13, 6, 'Webwing Technologies', 'Ltd', 'dev@webwingtechnologies.com', '+919923266699', 'Plot No 4', 'Gayatri Socity', 'Nashik', 'maharashtra', 'India', 'samarth chowk , upendra nagar,', '422008', '1', 253000.00, 0.00, 253000.00, 69.00, '2018-07-21 18:23:49', 'dd', '6', NULL, '2018-06-21 18:23:49', '2018-06-22 05:16:25'),
(17, 'AM-1529573334', 13, 11, 'Webwing Technologies', 'Ltd', 'dev@webwingtechnologies.com', '+919923266699', 'Plot No 5', 'pooja apartment', 'Nashik', 'Maharashtra', 'India', 'Pavan Nagar', '422008', '1', 10617832.00, 0.00, 10618914.00, 69.00, '2018-07-21 18:58:54', '', '5', NULL, '2018-06-21 18:58:54', '2018-06-21 19:00:25'),
(18, 'AM-1529575295', 13, 6, 'Anna', 'Adam', 'anna.adam51@yahoo.com', '+919638527412', 'Plot No 4', 'Gayatri Socity', 'Nashik', 'maharashtra', 'India', 'samarth chowk , upendra nagar,', '422008', '1', 36052.50, 0.00, 36052.50, 69.00, '2018-07-21 19:31:35', '', '5', NULL, '2018-06-21 19:31:35', '2018-06-21 19:34:14'),
(19, 'AM-1529576977', 1, 5, 'Anna', 'Adam', 'anna.adam51@yahoo.com', '+919638527412', '22', 'Habitat', 'Nashik', 'Maharashtra', 'India', 'Indira Nagar', '422001', '1', 392920.00, 0.00, 408877.16, 69.00, '2018-07-21 19:59:37', '', '5', NULL, '2018-06-21 19:59:37', '2018-06-21 20:01:39'),
(20, 'AM-1529582501', 1, 5, 'vishal', 'patil', 'vishal@gmail.com', '+37699598998', '22', 'Habitat', 'Nashik', 'Maharashtra', 'India', 'Indira Nagar', '422001', '1', 126.50, 0.00, 126.50, 69.00, '2018-07-21 12:01:41', 'asdasdsdadsdsdsd', '6', NULL, '2018-06-21 12:01:41', '2018-06-22 04:25:23'),
(21, 'AM-1529583445', 1, 5, 'Ramesh', 'Pawar', 'ramesh@gmail.com', '+3769898989', '22', 'Habitat', 'Nashik', 'Maharashtra', 'India', 'Indira Nagar', '422001', '1', 1724376.50, 0.00, 1724376.50, 69.00, '2018-07-21 12:17:25', 'new cancellation reason.', '6', NULL, '2018-06-21 12:17:25', '2018-06-22 04:21:59'),
(22, 'AM-1529641773', 1, 5, 'abc', 'abc', 'abc@mail.com', '+9115154513214', '22', 'Habitat', 'Nashik', 'Maharashtra', 'India', 'Indira Nagar', '422001', '1', 344850.00, 0.00, 344850.00, 69.00, '2018-07-22 04:29:33', 'dsdsdsd', '6', NULL, '2018-06-22 04:29:33', '2018-06-22 05:16:09'),
(23, 'AM-1529641812', 1, 5, 'Vishram', 'Pawar', 'visharam@gmail.com', '+919922276924', '22', 'Habitat', 'Nashik', 'Maharashtra', 'India', 'Indira Nagar', '422001', '1', 713658.00, 0.00, 713658.00, 69.00, '2018-07-22 04:30:12', '', '6', NULL, '2018-06-22 04:30:12', '2018-06-22 04:57:57'),
(24, 'AM-1529641947', 1, 5, 'nayan', 'pawar', 'nayan@gmail.com', '+3765416549841654', '22', 'Habitat', 'Nashik', 'Maharashtra', 'India', 'Indira Nagar', '422001', '1', 344850.00, 0.00, 344850.00, 69.00, '2018-07-22 04:32:27', '', '6', NULL, '2018-06-22 04:32:27', '2018-06-22 04:57:18'),
(25, 'AM-1529646743', 1, 5, 'Ronit', 'Kumar', 'ronit@gmail.com', '+919922276924', '22', 'Habitat', 'Nashik', 'Maharashtra', 'India', 'Indira Nagar', '422001', '1', 394185.00, 0.00, 394185.00, 69.00, '2018-07-22 05:52:23', '', '5', NULL, '2018-06-22 05:52:23', '2018-06-22 13:16:08'),
(26, 'AM-1529646985', 1, 5, 'Vinit', 'patil', 'vinit@gmail.com', '+919922276924', '22', 'Habitat', 'Nashik', 'Maharashtra', 'India', 'Indira Nagar', '422001', '1', 713658.00, 0.00, 713658.00, 69.00, '2018-07-22 05:56:25', '', '5', NULL, '2018-06-22 05:56:25', '2018-06-22 13:14:20'),
(27, 'AM-9467333531', 1, 5, 'sagar', 'pawar', 'sagar@mail.com', '+911245678912', '22', 'Habitat', 'Nashik', 'Maharashtra', 'India', 'Indira Nagar', '422001', '2', 396919.38, 0.00, 396919.38, 69.00, '2018-07-22 14:02:58', '', '0', NULL, '2018-06-22 14:02:58', '2018-06-22 14:02:58'),
(28, 'AM-9081670779', 1, 5, 'Nayan', 'Pawar', 'nayan@gmail.com', '+918458458544', '22', 'Habitat', 'Nashik', 'Maharashtra', 'India', 'Indira Nagar', '422001', '1', 52069.38, 0.00, 52069.38, 69.00, '2018-07-22 14:38:58', '', '1', NULL, '2018-06-22 14:38:58', '2018-06-22 14:39:18'),
(29, 'AM-0264140216', 1, 5, 'Nayan', 'Pawar', 'nayan@gmail.com', '+918458458544', '22', 'Habitat', 'Nashik', 'Maharashtra', 'India', 'Indira Nagar', '422001', '1', 689826.50, 0.00, 689826.50, 69.00, '2018-07-25 10:54:42', '', '1', NULL, '2018-06-25 10:54:42', '2018-06-25 10:55:05'),
(30, 'AM-1396978260', 1, 5, 'Nayan', 'Pawar', 'nayan@gmail.com', '+918458458544', '22', 'Habitat', 'Nashik', 'Maharashtra', 'India', 'Indira Nagar', '422001', '1', 344850.00, 0.00, 358644.00, 69.00, '2018-07-26 04:24:57', '', '1', NULL, '2018-06-26 04:24:57', '2018-06-26 04:25:18'),
(31, 'AM-0517857812', 1, 5, 'Nayan', 'Pawar', 'poyabusoza@yk20.com', '+918458458544', '22', 'Habitat', 'Nashik', 'Maharashtra', 'India', 'Indira Nagar', '422001', '1', 344850.00, 0.00, 358644.00, 69.00, '2018-07-26 04:26:38', '', '1', NULL, '2018-06-26 04:26:38', '2018-06-26 04:26:52'),
(32, 'AM-6039556786', 1, 5, 'Oldy', 'Pawar', 'nayan@gmail.com', '+918458458544', '22', 'Habitat', 'Nashik', 'Maharashtra', 'India', 'Indira Nagar', '422001', '1', 12.66, 0.00, 12.66, 69.00, '2018-07-26 04:30:17', '', '5', NULL, '2018-06-26 04:30:17', '2018-06-26 04:32:28'),
(33, 'AM-1187035513', 1, 5, 'Nayan', 'Pawar', 'poyabusoza@yk20.com', '+918458458544', '22', 'Habitat', 'Nashik', 'Maharashtra', 'India', 'Indira Nagar', '422001', '1', 24035.00, 0.00, 24035.00, 69.00, '2018-07-26 04:31:20', '', '3', NULL, '2018-06-26 04:31:20', '2018-06-26 04:31:55'),
(34, 'AM-9892738921', 1, 5, 'Nayan', 'Pawar', 'poyabusoza@yk20.com', '+918458458544', '22', 'Habitat', 'Nashik', 'Maharashtra', 'India', 'Indira Nagar', '422001', '1', 126.50, 0.00, 126.50, 69.00, '2018-07-26 05:10:55', '', '1', NULL, '2018-06-26 05:10:55', '2018-06-26 05:11:14'),
(35, 'AM-4912878423', 1, 5, 'Nayan', 'Pawar', 'poyabusoza@yk20.com', '+918458458544', '22', 'Habitat', 'Nashik', 'Maharashtra', 'India', 'Indira Nagar', '422001', '1', 6.33, 0.00, 6.33, 69.00, '2018-07-26 05:14:15', '', '1', NULL, '2018-06-26 05:14:15', '2018-06-26 05:14:27'),
(36, 'AM-2373601838', 1, 5, 'Nayan', 'Pawar', 'nayan@gmail.com', '+918458458544', '22', 'Habitat', 'Nashik', 'Maharashtra', 'India', 'Indira Nagar', '422001', '1', 344850.00, 0.00, 344850.00, 69.00, '2018-07-26 05:17:41', '', '0', NULL, '2018-06-26 05:17:41', '2018-06-26 05:17:41'),
(37, 'AM-6497786683', 1, 5, 'Nayan', 'Pawar', 'nayan@gmail.com', '+918458458544', '22', 'Habitat', 'Nashik', 'Maharashtra', 'India', 'Indira Nagar', '422001', '2', 344850.00, 0.00, 344850.00, 69.00, '2018-07-26 05:17:53', '', '0', NULL, '2018-06-26 05:17:53', '2018-06-26 05:17:53'),
(38, 'AM-5434900343', 1, 5, 'Nayan', 'Pawar', 'nayan@gmail.com', '+918458458544', '22', 'Habitat', 'Nashik', 'Maharashtra', 'India', 'Indira Nagar', '422001', '2', 344850.00, 0.00, 344850.00, 69.00, '2018-07-26 05:18:22', '', '0', NULL, '2018-06-26 05:18:22', '2018-06-26 05:18:22'),
(39, 'AM-5707497982', 1, 5, 'Nayan', 'Pawar', 'nayan@gmail.com', '+918458458544', '22', 'Habitat', 'Nashik', 'Maharashtra', 'India', 'Indira Nagar', '422001', '2', 7.32, 0.00, 7.32, 69.00, '2018-11-19 10:10:09', '', '0', NULL, '2018-10-20 10:10:09', '2018-10-20 10:10:09');

-- --------------------------------------------------------

--
-- Table structure for table `order_gift_cards`
--

CREATE TABLE `order_gift_cards` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_gift_card_id` int(11) NOT NULL,
  `gift_card_code` varchar(255) NOT NULL,
  `amount` float(20,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_gift_cards`
--

INSERT INTO `order_gift_cards` (`id`, `order_id`, `user_id`, `user_gift_card_id`, `gift_card_code`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'AM-1529493343', 13, 40, 'BVQ4QSM91IGE', 50.00, '2018-06-20 11:15:43', '2018-06-20 11:15:43'),
(2, 'AM-1529493385', 13, 40, 'BVQ4QSM91IGE', 50.00, '2018-06-20 11:16:25', '2018-06-20 11:16:25'),
(3, 'AM-1529493415', 13, 40, 'BVQ4QSM91IGE', 50.00, '2018-06-20 11:16:55', '2018-06-20 11:16:55'),
(4, 'AM-1529493427', 13, 40, 'BVQ4QSM91IGE', 50.00, '2018-06-20 11:17:07', '2018-06-20 11:17:07'),
(5, 'AM-1529493448', 13, 40, 'BVQ4QSM91IGE', 50.00, '2018-06-20 11:17:28', '2018-06-20 11:17:28'),
(6, 'AM-1529499186', 13, 42, '4NEWCBMAASZR', 250.00, '2018-06-20 18:23:06', '2018-06-20 18:23:06'),
(7, 'AM-1529556422', 13, 43, 'E24RTH8XNUP2', 250.00, '2018-06-21 10:17:02', '2018-06-21 10:17:02'),
(8, 'AM-1396978260', 1, 1, 'GIFT123', 4000.00, '2018-06-26 04:24:57', '2018-06-26 04:24:57'),
(9, 'AM-0517857812', 1, 1, 'GIFT123', 4000.00, '2018-06-26 04:26:38', '2018-06-26 04:26:38');

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_uid` varchar(255) DEFAULT NULL,
  `item_number` varchar(255) NOT NULL,
  `product_supplier_id` int(11) NOT NULL DEFAULT '0',
  `product_category_id` int(11) DEFAULT NULL,
  `product_subcategory_id` int(11) DEFAULT NULL,
  `product_line_id` int(11) DEFAULT NULL,
  `product_setting_id` int(11) DEFAULT NULL,
  `product_ring_shoulder_id` int(11) DEFAULT NULL,
  `product_metal_detailing_id` int(11) DEFAULT NULL,
  `product_brand_id` int(11) DEFAULT NULL,
  `product_brand_name` varchar(255) DEFAULT NULL,
  `product_look_id` int(11) DEFAULT NULL,
  `product_band_setting_id` int(11) DEFAULT NULL,
  `product_shank_type_id` int(11) NOT NULL,
  `product_metal_id` int(11) DEFAULT NULL,
  `product_gemstone_id` int(11) DEFAULT NULL,
  `product_insurance_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_category_name` varchar(255) DEFAULT NULL,
  `product_subcategory_name` varchar(255) DEFAULT NULL,
  `product_line_name` varchar(255) DEFAULT NULL,
  `product_setting_name` varchar(255) DEFAULT NULL,
  `product_ring_shoulder_name` varchar(255) DEFAULT NULL,
  `product_metal_detailing_name` varchar(255) DEFAULT NULL,
  `product_band_setting_name` varchar(255) DEFAULT NULL,
  `product_look_name` varchar(255) DEFAULT NULL,
  `product_shank_type_name` varchar(255) NOT NULL,
  `product_metal_weight` float(20,2) DEFAULT '0.00',
  `product_height` float(20,2) DEFAULT '0.00',
  `product_width` float(20,2) DEFAULT '0.00',
  `product_length` float(20,2) DEFAULT '0.00',
  `product_quantity` int(11) DEFAULT NULL,
  `product_code` varchar(255) DEFAULT NULL,
  `product_type` enum('1','2') DEFAULT NULL COMMENT '1-classic, 2-luxury',
  `product_delivery_date` varchar(255) DEFAULT NULL,
  `allow_product_home_trial` enum('1','2') DEFAULT NULL COMMENT '1-yes, 2-no',
  `name_on_product` varchar(255) DEFAULT NULL,
  `product_insurance_company` varchar(255) DEFAULT NULL,
  `product_discount` float(20,2) DEFAULT '0.00',
  `product_additional_markup` float(20,2) DEFAULT '0.00',
  `product_supplier_markup` float(20,2) DEFAULT '0.00',
  `product_transaction_charges` float(20,2) DEFAULT '0.00',
  `product_market_orientation` float(20,2) DEFAULT '0.00',
  `product_gst` float(20,2) DEFAULT '0.00',
  `product_insurance` float(20,2) DEFAULT '0.00',
  `discount_on_product` float(20,2) DEFAULT '0.00',
  `additional_markup_on_product` float(20,2) DEFAULT '0.00',
  `supplier_markup_on_product` float(20,2) DEFAULT '0.00',
  `transaction_charges_on_product` float(20,2) DEFAULT '0.00',
  `market_orientation_on_product` float(20,2) DEFAULT '0.00',
  `gst_on_product` float(20,2) DEFAULT '0.00',
  `insurance_on_product` float(20,2) DEFAULT '0.00',
  `product_price` float(20,2) DEFAULT '0.00',
  `product_base_price` float(20,2) NOT NULL DEFAULT '0.00',
  `product_final_price` float(20,2) DEFAULT '0.00',
  `product_metal_type` varchar(255) DEFAULT NULL,
  `product_metal_color` varchar(255) DEFAULT NULL,
  `product_metal_quality` varchar(255) DEFAULT NULL,
  `product_gemstone_type` varchar(255) NOT NULL,
  `product_gemstone_color` varchar(255) NOT NULL,
  `product_gemstone_quality` varchar(255) NOT NULL,
  `product_gemstone_shape` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`id`, `user_id`, `order_id`, `product_id`, `product_uid`, `item_number`, `product_supplier_id`, `product_category_id`, `product_subcategory_id`, `product_line_id`, `product_setting_id`, `product_ring_shoulder_id`, `product_metal_detailing_id`, `product_brand_id`, `product_brand_name`, `product_look_id`, `product_band_setting_id`, `product_shank_type_id`, `product_metal_id`, `product_gemstone_id`, `product_insurance_id`, `product_name`, `product_category_name`, `product_subcategory_name`, `product_line_name`, `product_setting_name`, `product_ring_shoulder_name`, `product_metal_detailing_name`, `product_band_setting_name`, `product_look_name`, `product_shank_type_name`, `product_metal_weight`, `product_height`, `product_width`, `product_length`, `product_quantity`, `product_code`, `product_type`, `product_delivery_date`, `allow_product_home_trial`, `name_on_product`, `product_insurance_company`, `product_discount`, `product_additional_markup`, `product_supplier_markup`, `product_transaction_charges`, `product_market_orientation`, `product_gst`, `product_insurance`, `discount_on_product`, `additional_markup_on_product`, `supplier_markup_on_product`, `transaction_charges_on_product`, `market_orientation_on_product`, `gst_on_product`, `insurance_on_product`, `product_price`, `product_base_price`, `product_final_price`, `product_metal_type`, `product_metal_color`, `product_metal_quality`, `product_gemstone_type`, `product_gemstone_color`, `product_gemstone_quality`, `product_gemstone_shape`, `created_at`, `updated_at`) VALUES
(1, 13, 'AM-1529493343', 52, 'xf007492', 'AM-11BF2E7916DDFD75', 54, 2, 2, 6, 4, 0, 5, 1, 'Abc', 4, 0, 0, 123, 116, 2, 'Juana Leaf Linked Bracelet', 'Jewellery', 'Bracelets & Bangles', 'Tennis Bracelet', 'Bezel Setting', '', '', '', 'Contemporary', '', 1.50, 4.50, 3.50, 2.50, 1, 'UE00543-2Y0001', '1', '5-10', '2', '', 'LIC', 10.00, 10.00, 3.00, 10.00, 2.00, 10.00, 4.50, 13.75, 10.00, 3.00, 10.00, 2.00, 12.50, 5.57, 100.00, 137.50, 123.75, 'Gold', 'Rose Gold', '14K', 'Diamond', 'Blue', 'VVS2', 'Oval', '2018-06-20 11:15:43', '2018-06-20 11:15:43'),
(2, 13, 'AM-1529493385', 52, 'xf007492', 'AM-314E9C5609E390A1', 54, 2, 2, 6, 4, 0, 5, 1, 'Abc', 4, 0, 0, 123, 116, 2, 'Juana Leaf Linked Bracelet', 'Jewellery', 'Bracelets & Bangles', 'Tennis Bracelet', 'Bezel Setting', '', '', '', 'Contemporary', '', 1.50, 4.50, 3.50, 2.50, 1, 'UE00543-2Y0001', '1', '5-10', '2', '', 'LIC', 10.00, 10.00, 3.00, 10.00, 2.00, 10.00, 4.50, 13.75, 10.00, 3.00, 10.00, 2.00, 12.50, 5.57, 100.00, 137.50, 123.75, 'Gold', 'Rose Gold', '14K', 'Diamond', 'Blue', 'VVS2', 'Oval', '2018-06-20 11:16:25', '2018-06-20 11:16:25'),
(3, 13, 'AM-1529493415', 52, 'xf007492', 'AM-4C87B3C949CDE9E7', 54, 2, 2, 6, 4, 0, 5, 1, 'Abc', 4, 0, 0, 123, 116, 2, 'Juana Leaf Linked Bracelet', 'Jewellery', 'Bracelets & Bangles', 'Tennis Bracelet', 'Bezel Setting', '', '', '', 'Contemporary', '', 1.50, 4.50, 3.50, 2.50, 1, 'UE00543-2Y0001', '1', '5-10', '2', '', 'LIC', 10.00, 10.00, 3.00, 10.00, 2.00, 10.00, 4.50, 13.75, 10.00, 3.00, 10.00, 2.00, 12.50, 5.57, 100.00, 137.50, 123.75, 'Gold', 'Rose Gold', '14K', 'Diamond', 'Blue', 'VVS2', 'Oval', '2018-06-20 11:16:55', '2018-06-20 11:16:55'),
(4, 13, 'AM-1529493427', 52, 'xf007492', 'AM-A3951CF44EA28C56', 54, 2, 2, 6, 4, 0, 5, 1, 'Abc', 4, 0, 0, 123, 116, 2, 'Juana Leaf Linked Bracelet', 'Jewellery', 'Bracelets & Bangles', 'Tennis Bracelet', 'Bezel Setting', '', '', '', 'Contemporary', '', 1.50, 4.50, 3.50, 2.50, 1, 'UE00543-2Y0001', '1', '5-10', '2', '', 'LIC', 10.00, 10.00, 3.00, 10.00, 2.00, 10.00, 4.50, 13.75, 10.00, 3.00, 10.00, 2.00, 12.50, 5.57, 100.00, 137.50, 123.75, 'Gold', 'Rose Gold', '14K', 'Diamond', 'Blue', 'VVS2', 'Oval', '2018-06-20 11:17:07', '2018-06-20 11:17:07'),
(5, 13, 'AM-1529493448', 52, 'xf007492', 'AM-4698250ACA8C7DAF', 54, 2, 2, 6, 4, 0, 5, 1, 'Abc', 4, 0, 0, 123, 116, 2, 'Juana Leaf Linked Bracelet', 'Jewellery', 'Bracelets & Bangles', 'Tennis Bracelet', 'Bezel Setting', '', '', '', 'Contemporary', '', 1.50, 4.50, 3.50, 2.50, 1, 'UE00543-2Y0001', '1', '5-10', '2', '', 'LIC', 10.00, 10.00, 3.00, 10.00, 2.00, 10.00, 4.50, 13.75, 10.00, 3.00, 10.00, 2.00, 12.50, 5.57, 100.00, 137.50, 123.75, 'Gold', 'Rose Gold', '14K', 'Diamond', 'Blue', 'VVS2', 'Oval', '2018-06-20 11:17:28', '2018-06-20 11:17:28'),
(6, 13, 'AM-1529496580', 25, 'kb090035', 'AM-62B5346336A9E331', 8, 2, 1, 1, 2, 4, 4, 1, 'Abc', 4, 3, 9, 101, 97, 0, 'Promise Solitire Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Prong or Claw Setting', 'Claw Set', 'Claw Set', 'Channel Setting', 'Contemporary', 'Euro Shank', 2.00, 2.00, 2.00, 2.00, 2, '454554', '1', '10-20', '2', '', '', 5.00, 50.00, 3.00, 10.00, 2.00, 10.00, 0.00, 18150.00, 100000.00, 6000.00, 20000.00, 4000.00, 33000.00, 0.00, 200000.00, 363000.00, 344850.00, 'Gold', 'Yellow', '22K', 'Diamond', 'Pink', 'VVS3', 'Square', '2018-06-20 17:39:40', '2018-06-20 17:39:40'),
(7, 13, 'AM-1529497321', 54, 'by699969', 'AM-ACEAF3785D8C7576', 54, 2, 1, 2, 0, 5, 0, 0, '', 4, 3, 15, 127, 118, 0, 'Ring 1', 'Jewellery', 'Rings', 'Bands', '', 'Double', 'Double', 'Channel Setting', 'Contemporary', 'Tapered', 2.00, 0.00, 0.00, 0.00, 1, 'IM454545445', '1', '10-20', '2', '', '', 0.00, 0.00, 3.00, 10.00, 2.00, 10.00, 0.00, 0.00, 0.00, 3.00, 10.00, 2.00, 11.50, 0.00, 100.00, 126.50, 126.50, 'Gold', 'Rose Gold', '18K', 'Others', 'Pink', 'VVS1', 'Oval', '2018-06-20 17:52:01', '2018-06-20 17:52:01'),
(8, 13, 'AM-1529499186', 25, 'kb090035', 'AM-F284417C8F30D2FB', 8, 2, 1, 1, 2, 4, 4, 1, 'Abc', 4, 3, 9, 101, 97, 1, 'Promise Solitire Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Prong or Claw Setting', 'Claw Set', 'Claw Set', 'Channel Setting', 'Contemporary', 'Euro Shank', 2.00, 2.00, 2.00, 2.00, 1, '454554', '1', '10-20', '2', '', 'HDFC ERGO', 5.00, 50.00, 3.00, 10.00, 2.00, 10.00, 4.00, 18150.00, 100000.00, 6000.00, 20000.00, 4000.00, 33000.00, 13794.00, 200000.00, 363000.00, 344850.00, 'Gold', 'Yellow', '22K', 'Diamond', 'Pink', 'VVS3', 'Square', '2018-06-20 18:23:06', '2018-06-20 18:23:06'),
(9, 13, 'AM-1529501131', 26, 'ow472387', 'AM-C789D6CF76AAF2AA', 8, 2, 1, 3, 4, 5, 4, 1, 'Abc', 4, 2, 6, 104, 100, 2, 'Silver Dimond Halo Ring', 'Jewellery', 'Rings', 'Accent Rings', 'Bezel Setting', 'Double', 'Double', 'Bar Setting', 'Contemporary', 'Straight Shank', 2.00, 2.00, 2.00, 2.00, 3, '4545', '1', '10-20', '2', '', 'LIC', 5.00, 0.00, 3.00, 10.00, 2.00, 10.00, 4.50, 1265.00, 0.00, 600.00, 2000.00, 400.00, 2300.00, 1081.58, 20000.00, 25300.00, 24035.00, 'Platinum', 'White', '22K', 'Pearls', 'Blue', 'VVS3', 'Square', '2018-06-20 18:55:31', '2018-06-20 18:55:31'),
(10, 13, 'AM-1529555686', 26, 'ow472387', 'AM-538D5D0B6590BC25', 8, 2, 1, 3, 4, 5, 4, 1, 'Abc', 4, 2, 6, 104, 100, 3, 'Silver Dimond Halo Ring', 'Jewellery', 'Rings', 'Accent Rings', 'Bezel Setting', 'Double', 'Double', 'Bar Setting', 'Contemporary', 'Straight Shank', 2.00, 2.00, 2.00, 2.00, 1, '4545', '1', '10-20', '2', 'Sachin kale', 'Humana', 5.00, 0.00, 3.00, 10.00, 2.00, 10.00, 5.00, 1265.00, 0.00, 600.00, 2000.00, 400.00, 2300.00, 1201.75, 20000.00, 25300.00, 24035.00, 'Platinum', 'White', '22K', 'Pearls', 'Blue', 'VVS3', 'Square', '2018-06-21 10:04:46', '2018-06-21 10:04:46'),
(11, 13, 'AM-1529555686', 25, 'kb090035', 'AM-7586AEF9F98B52A4', 8, 2, 1, 1, 2, 4, 4, 1, 'Abc', 4, 3, 9, 101, 97, 0, 'Promise Solitire Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Prong or Claw Setting', 'Claw Set', 'Claw Set', 'Channel Setting', 'Contemporary', 'Euro Shank', 2.00, 2.00, 2.00, 2.00, 5, '454554', '1', '10-20', '2', '', '', 5.00, 50.00, 3.00, 10.00, 2.00, 10.00, 0.00, 18150.00, 100000.00, 6000.00, 20000.00, 4000.00, 33000.00, 0.00, 200000.00, 363000.00, 344850.00, 'Gold', 'Yellow', '22K', 'Diamond', 'Pink', 'VVS3', 'Square', '2018-06-21 10:04:46', '2018-06-21 10:04:46'),
(12, 13, 'AM-1529556422', 28, 'ep856071', 'AM-717C113165751EC3', 8, 2, 1, 1, 4, 4, 1, 2, 'pqr', 3, 4, 10, 57, 59, 2, 'Stackable Birthstone Name Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Bezel Setting', 'Claw Set', 'Claw Set', 'Flush Setting', 'Traditional', 'Cathedral Shank', 2.00, 2.00, 2.00, 2.00, 1, '4545', '1', '0-5', '2', '', 'LIC', 5.00, 0.00, 3.00, 10.00, 2.00, 10.00, 4.50, 1897.50, 0.00, 900.00, 3000.00, 600.00, 3450.00, 1622.36, 30000.00, 37950.00, 36052.50, 'Silver', 'White', '18K', 'Pearls', 'Blue', 'VVS2', 'triangle', '2018-06-21 10:17:02', '2018-06-21 10:17:02'),
(13, 13, 'AM-1529564378', 26, 'ow472387', 'AM-FDA2942F64CC58C8', 8, 2, 1, 3, 4, 5, 4, 1, 'Abc', 4, 2, 6, 104, 100, 0, 'Silver Dimond Halo Ring', 'Jewellery', 'Rings', 'Accent Rings', 'Bezel Setting', 'Double', 'Double', 'Bar Setting', 'Contemporary', 'Straight Shank', 2.00, 2.00, 2.00, 2.00, 6, '4545', '1', '10-20', '2', '', '', 5.00, 0.00, 3.00, 10.00, 2.00, 10.00, 0.00, 1265.00, 0.00, 600.00, 2000.00, 400.00, 2300.00, 0.00, 20000.00, 25300.00, 24035.00, 'Platinum', 'White', '22K', 'Pearls', 'Blue', 'VVS3', 'Square', '2018-06-21 12:29:38', '2018-06-21 12:29:38'),
(14, 13, 'AM-1529564378', 48, 'yl155238', 'AM-1649E2906DCAB902', 1, 2, 2, 6, 0, 0, 3, 0, '', 4, 0, 0, 115, 112, 0, 'Esita Beaded Gold Drop Earrings85', 'Jewellery', 'Bracelets & Bangles', 'Tennis Bracelet', '', '', '', '', 'Contemporary', '', 1.50, 4.50, 3.50, 2.50, 1, 'UE00543-2Y0000', '1', '0-5', '2', '', '', 10.00, 10.00, 3.00, 10.00, 2.00, 10.00, 0.00, 13.42, 10.00, 3.00, 10.00, 2.00, 12.50, 0.00, 100.00, 134.20, 120.78, 'Palladium', 'White', '14K', 'Diamond', 'Blue', 'VVS2', 'Circle', '2018-06-21 12:29:38', '2018-06-21 12:29:38'),
(15, 13, 'AM-1529564378', 52, 'xf007492', 'AM-C77BBDAE1A141EC5', 54, 2, 2, 6, 4, 0, 5, 1, 'Abc', 4, 0, 0, 123, 116, 0, 'Juana Leaf Linked Bracelet', 'Jewellery', 'Bracelets & Bangles', 'Tennis Bracelet', 'Bezel Setting', '', '', '', 'Contemporary', '', 1.50, 4.50, 3.50, 2.50, 1, 'UE00543-2Y0001', '1', '5-10', '2', '', '', 10.00, 10.00, 3.00, 10.00, 2.00, 10.00, 0.00, 13.75, 10.00, 3.00, 10.00, 2.00, 12.50, 0.00, 100.00, 137.50, 123.75, 'Gold', 'Rose Gold', '14K', 'Diamond', 'Blue', 'VVS2', 'Oval', '2018-06-21 12:29:38', '2018-06-21 12:29:38'),
(16, 13, 'AM-1529564378', 53, 'cu017530', 'AM-2CC0C40705A04765', 1, 2, 2, 6, 4, 0, 3, 1, 'Abc', 4, 0, 0, 125, 117, 0, 'Esita Beaded Gold Drop Earrings88', 'Jewellery', 'Bracelets & Bangles', 'Tennis Bracelet', 'Bezel Setting', '', '', '', 'Contemporary', '', 1.50, 4.50, 3.50, 2.50, 5, 'UE00543-2Y0003', '1', '0-5', '2', '', '', 10.00, 10.00, 3.00, 10.00, 2.00, 10.00, 0.00, 13.42, 10.00, 3.00, 10.00, 2.00, 12.50, 0.00, 100.00, 134.20, 120.78, 'Gold', 'Rose Gold', '14K', 'Others', 'Gold', 'VVS2', 'Oval', '2018-06-21 12:29:38', '2018-06-21 12:29:38'),
(17, 13, 'AM-1529564378', 49, 'yx072368', 'AM-451A0549BD3B8A10', 1, 2, 3, 11, 4, 0, 5, 1, 'Abc', 4, 0, 0, 117, 113, 0, 'Esita Beaded Gold Drop Earrings87', 'Jewellery', 'Earrings', 'Studs', 'Bezel Setting', '', '', '', 'Contemporary', '', 1.50, 4.50, 3.50, 2.50, 1, 'UE00543-2Y0000', '1', '0-5', '2', '', '', 0.00, 0.00, 3.00, 10.00, 2.00, 10.00, 0.00, 0.00, 0.00, 3.00, 10.00, 2.00, 11.50, 0.00, 100.00, 123.20, 123.20, 'Gold', 'Rose Gold', '14K', 'Diamond', 'Blue', 'VVS1', 'Circle', '2018-06-21 12:29:38', '2018-06-21 12:29:38'),
(18, 13, 'AM-1529564378', 45, 'td735372', 'AM-23DEC3868BAC3AA6', 8, 3, 7, 2, 4, 10, 3, 1, 'Abc', 4, 2, 13, 93, 92, 0, 'new product 199', 'Fashion Jewellery', 'Antique', 'Bands', 'Bezel Setting', 'Channel', 'Channel', 'Bar Setting', 'Contemporary', 'Bypass Shank', 2.00, 2.00, 2.00, 0.00, 1, 'sdkfhk', '1', '10-20', '1', '', '', 5.00, 0.00, 3.00, 10.00, 2.00, 10.00, 0.00, 0.63, 0.00, 0.30, 1.00, 0.20, 1.15, 0.00, 10.00, 12.65, 12.02, 'Gold', 'Two Tone', '14K', 'Others', 'Pink', 'VVS3', 'triangle', '2018-06-21 12:29:38', '2018-06-21 12:29:38'),
(19, 13, 'AM-1529564378', 25, 'kb090035', 'AM-2436DE4780AC424B', 8, 2, 1, 1, 2, 4, 4, 1, 'Abc', 4, 3, 9, 101, 97, 0, 'Promise Solitire Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Prong or Claw Setting', 'Claw Set', 'Claw Set', 'Channel Setting', 'Contemporary', 'Euro Shank', 2.00, 2.00, 2.00, 2.00, 5, '454554', '1', '10-20', '2', '', '', 5.00, 50.00, 3.00, 10.00, 2.00, 10.00, 0.00, 18150.00, 100000.00, 6000.00, 20000.00, 4000.00, 33000.00, 0.00, 200000.00, 363000.00, 344850.00, 'Gold', 'Yellow', '22K', 'Diamond', 'Pink', 'VVS3', 'Square', '2018-06-21 12:29:38', '2018-06-21 12:29:38'),
(20, 13, 'AM-1529564378', 27, 'ek974312', 'AM-BFA50F9F016A9985', 8, 2, 1, 3, 4, 6, 5, 1, 'Abc', 4, 2, 13, 56, 58, 0, 'Brown Dimond Ring', 'Jewellery', 'Rings', 'Accent Rings', 'Bezel Setting', 'Flared', 'Flared', 'Bar Setting', 'Contemporary', 'Bypass Shank', 4.00, 5.00, 2.00, 2.00, 5, '45454', '1', '5-10', '1', '', '', 5.00, 0.00, 3.00, 10.00, 2.00, 10.00, 0.00, 1265.00, 0.00, 600.00, 2000.00, 400.00, 2300.00, 0.00, 20000.00, 25300.00, 24035.00, 'Palladium', 'Two Tone', '22K', 'Pearls', 'Pink', 'VVS3', 'Circle', '2018-06-21 12:29:38', '2018-06-21 12:29:38'),
(21, 13, 'AM-1529564378', 28, 'ep856071', 'AM-F7859778110CF899', 8, 2, 1, 1, 4, 4, 1, 2, 'pqr', 3, 4, 10, 57, 59, 0, 'Stackable Birthstone Name Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Bezel Setting', 'Claw Set', 'Claw Set', 'Flush Setting', 'Traditional', 'Cathedral Shank', 2.00, 2.00, 2.00, 2.00, 5, '4545', '1', '0-5', '2', '', '', 5.00, 0.00, 3.00, 10.00, 2.00, 10.00, 0.00, 1897.50, 0.00, 900.00, 3000.00, 600.00, 3450.00, 0.00, 30000.00, 37950.00, 36052.50, 'Silver', 'White', '18K', 'Pearls', 'Blue', 'VVS2', 'triangle', '2018-06-21 12:29:38', '2018-06-21 12:29:38'),
(22, 13, 'AM-1529564378', 43, 'ng459297', 'AM-7BC03CFE4DD84BC7', 8, 2, 2, 7, 2, 0, 4, 2, 'pqr', 4, 0, 0, 88, 89, 0, '18 Kt Yellow Gold Bangle', 'Jewellery', 'Bracelets & Bangles', 'Bangles', 'Prong or Claw Setting', '', '', '', 'Contemporary', '', 40.00, 5.00, 5.00, 5.00, 5, 'IM45454545', '1', '5-10', '2', '', '', 0.00, 0.00, 3.00, 10.00, 2.00, 10.00, 0.00, 0.00, 0.00, 600.00, 2000.00, 400.00, 2300.00, 0.00, 20000.00, 25300.00, 25300.00, 'Gold', 'Two Tone', '18K', 'Pearls', 'Gold', 'VVS4', 'Circle', '2018-06-21 12:29:38', '2018-06-21 12:29:38'),
(23, 13, 'AM-1529564378', 44, 'yy812268', 'AM-D45E48E979C179BE', 1, 2, 2, 7, 6, 0, 8, 2, 'pqr', 3, 0, 0, 113, 111, 0, 'Classic Solitaire Bangle', 'Jewellery', 'Bracelets & Bangles', 'Bangles', 'Cluster Setting', '', '', '', 'Traditional', '', 2.00, 2.00, 2.00, 2.00, 111, 'IM00545', '1', '5-10', '2', '', '', 12.00, 15.00, 3.00, 10.00, 2.00, 10.00, 0.00, 50292.00, 45000.00, 9000.00, 30000.00, 6000.00, 39000.00, 0.00, 300000.00, 419100.00, 368808.00, 'Gold', 'Rose Gold', '18K', 'Without Accents', 'Gold', 'VVS4', 'Oval', '2018-06-21 12:29:38', '2018-06-21 12:29:38'),
(24, 13, 'AM-1529565961', 27, 'ek974312', 'AM-E581E0BE5D775A63', 8, 2, 1, 3, 4, 6, 5, 1, 'Abc', 4, 2, 13, 56, 58, 1, 'Brown Dimond Ring', 'Jewellery', 'Rings', 'Accent Rings', 'Bezel Setting', 'Flared', 'Flared', 'Bar Setting', 'Contemporary', 'Bypass Shank', 4.00, 5.00, 2.00, 2.00, 1, '45454', '1', '5-10', '1', 'bhushan pagar', 'HDFC ERGO', 5.00, 0.00, 3.00, 10.00, 2.00, 10.00, 4.00, 1265.00, 0.00, 600.00, 2000.00, 400.00, 2300.00, 961.40, 20000.00, 25300.00, 24035.00, 'Palladium', 'Two Tone', '22K', 'Pearls', 'Pink', 'VVS3', 'Circle', '2018-06-21 12:56:01', '2018-06-21 12:56:01'),
(25, 13, 'AM-1529566029', 28, 'ep856071', 'AM-541788626EC4C13E', 8, 2, 1, 1, 4, 4, 1, 2, 'pqr', 3, 4, 10, 57, 59, 2, 'Stackable Birthstone Name Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Bezel Setting', 'Claw Set', 'Claw Set', 'Flush Setting', 'Traditional', 'Cathedral Shank', 2.00, 2.00, 2.00, 2.00, 1, '4545', '1', '0-5', '2', '', 'LIC', 5.00, 0.00, 3.00, 10.00, 2.00, 10.00, 4.50, 1897.50, 0.00, 900.00, 3000.00, 600.00, 3450.00, 1622.36, 30000.00, 37950.00, 36052.50, 'Silver', 'White', '18K', 'Pearls', 'Blue', 'VVS2', 'triangle', '2018-06-21 12:57:09', '2018-06-21 12:57:09'),
(26, 13, 'AM-1529570794', 25, 'kb090035', 'AM-0ABDC1CF95709E84', 8, 2, 1, 1, 2, 4, 4, 1, 'Abc', 4, 3, 9, 101, 97, 0, 'Promise Solitire Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Prong or Claw Setting', 'Claw Set', 'Claw Set', 'Channel Setting', 'Contemporary', 'Euro Shank', 2.00, 2.00, 2.00, 2.00, 8, '454554', '1', '10-20', '2', '', '', 5.00, 50.00, 3.00, 10.00, 2.00, 10.00, 0.00, 18150.00, 100000.00, 6000.00, 20000.00, 4000.00, 33000.00, 0.00, 200000.00, 363000.00, 344850.00, 'Gold', 'Yellow', '22K', 'Diamond', 'Pink', 'VVS3', 'Square', '2018-06-21 18:16:34', '2018-06-21 18:16:34'),
(27, 13, 'AM-1529571229', 43, 'ng459297', 'AM-5C5F5D002C6ED870', 8, 2, 2, 7, 2, 0, 4, 2, 'pqr', 4, 0, 0, 88, 89, 0, '18 Kt Yellow Gold Bangle', 'Jewellery', 'Bracelets & Bangles', 'Bangles', 'Prong or Claw Setting', '', '', '', 'Contemporary', '', 40.00, 5.00, 5.00, 5.00, 10, 'IM45454545', '1', '5-10', '2', '', '', 0.00, 0.00, 3.00, 10.00, 2.00, 10.00, 0.00, 0.00, 0.00, 600.00, 2000.00, 400.00, 2300.00, 0.00, 20000.00, 25300.00, 25300.00, 'Gold', 'Two Tone', '18K', 'Pearls', 'Gold', 'VVS4', 'Circle', '2018-06-21 18:23:49', '2018-06-21 18:23:49'),
(28, 13, 'AM-1529573334', 43, 'ng459297', 'AM-7D8329F557EC1581', 8, 2, 2, 7, 2, 0, 4, 2, 'pqr', 4, 0, 0, 88, 89, 0, '18 Kt Yellow Gold Bangle', 'Jewellery', 'Bracelets & Bangles', 'Bangles', 'Prong or Claw Setting', '', '', '', 'Contemporary', '', 40.00, 5.00, 5.00, 5.00, 10, 'IM45454545', '1', '5-10', '2', '', '', 0.00, 0.00, 3.00, 10.00, 2.00, 10.00, 0.00, 0.00, 0.00, 600.00, 2000.00, 400.00, 2300.00, 0.00, 20000.00, 25300.00, 25300.00, 'Gold', 'Two Tone', '18K', 'Pearls', 'Gold', 'VVS4', 'Circle', '2018-06-21 18:58:54', '2018-06-21 18:58:54'),
(29, 13, 'AM-1529573334', 27, 'ek974312', 'AM-588F68F1F7C7335B', 8, 2, 1, 3, 4, 6, 5, 1, 'Abc', 4, 2, 13, 56, 58, 2, 'Brown Dimond Ring', 'Jewellery', 'Rings', 'Accent Rings', 'Bezel Setting', 'Flared', 'Flared', 'Bar Setting', 'Contemporary', 'Bypass Shank', 4.00, 5.00, 2.00, 2.00, 1, '45454', '1', '5-10', '1', 'Nilesh', 'LIC', 5.00, 0.00, 3.00, 10.00, 2.00, 10.00, 4.50, 1265.00, 0.00, 600.00, 2000.00, 400.00, 2300.00, 1081.58, 20000.00, 25300.00, 24035.00, 'Palladium', 'Two Tone', '22K', 'Pearls', 'Pink', 'VVS3', 'Circle', '2018-06-21 18:58:54', '2018-06-21 18:58:54'),
(30, 13, 'AM-1529573334', 25, 'kb090035', 'AM-7C97F3D7A025CD13', 8, 2, 1, 1, 2, 4, 4, 1, 'Abc', 4, 3, 9, 101, 97, 0, 'Promise Solitire Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Prong or Claw Setting', 'Claw Set', 'Claw Set', 'Channel Setting', 'Contemporary', 'Euro Shank', 2.00, 2.00, 2.00, 2.00, 28, '454554', '1', '10-20', '2', '', '', 5.00, 50.00, 3.00, 10.00, 2.00, 10.00, 0.00, 18150.00, 100000.00, 6000.00, 20000.00, 4000.00, 33000.00, 0.00, 200000.00, 363000.00, 344850.00, 'Gold', 'Yellow', '22K', 'Diamond', 'Pink', 'VVS3', 'Square', '2018-06-21 18:58:54', '2018-06-21 18:58:54'),
(31, 13, 'AM-1529573334', 28, 'ep856071', 'AM-EC81A61D700E9865', 8, 2, 1, 1, 4, 4, 1, 2, 'pqr', 3, 4, 10, 57, 59, 0, 'Stackable Birthstone Name Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Bezel Setting', 'Claw Set', 'Claw Set', 'Flush Setting', 'Traditional', 'Cathedral Shank', 2.00, 2.00, 2.00, 2.00, 19, '4545', '1', '0-5', '2', '', '', 5.00, 0.00, 3.00, 10.00, 2.00, 10.00, 0.00, 1897.50, 0.00, 900.00, 3000.00, 600.00, 3450.00, 0.00, 30000.00, 37950.00, 36052.50, 'Silver', 'White', '18K', 'Pearls', 'Blue', 'VVS2', 'triangle', '2018-06-21 18:58:54', '2018-06-21 18:58:54'),
(32, 13, 'AM-1529575295', 28, 'ep856071', 'AM-DD8EA64C273079CE', 8, 2, 1, 1, 4, 4, 1, 2, 'pqr', 3, 4, 10, 57, 59, 0, 'Stackable Birthstone Name Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Bezel Setting', 'Claw Set', 'Claw Set', 'Flush Setting', 'Traditional', 'Cathedral Shank', 2.00, 2.00, 2.00, 2.00, 1, '4545', '1', '0-5', '2', '', '', 5.00, 0.00, 3.00, 10.00, 2.00, 10.00, 0.00, 1897.50, 0.00, 900.00, 3000.00, 600.00, 3450.00, 0.00, 30000.00, 37950.00, 36052.50, 'Silver', 'White', '18K', 'Pearls', 'Blue', 'VVS2', 'triangle', '2018-06-21 19:31:35', '2018-06-21 19:31:35'),
(33, 1, 'AM-1529576977', 26, 'ow472387', 'AM-041FEA25276B1881', 8, 2, 1, 3, 4, 5, 4, 1, 'Abc', 4, 2, 6, 104, 100, 2, 'Silver Dimond Halo Ring', 'Jewellery', 'Rings', 'Accent Rings', 'Bezel Setting', 'Double', 'Double', 'Bar Setting', 'Contemporary', 'Straight Shank', 2.00, 2.00, 2.00, 2.00, 2, '4545', '1', '10-20', '2', '', 'LIC', 5.00, 0.00, 3.00, 10.00, 2.00, 10.00, 4.50, 1265.00, 0.00, 600.00, 2000.00, 400.00, 2300.00, 1081.58, 20000.00, 25300.00, 24035.00, 'Platinum', 'White', '22K', 'Pearls', 'Blue', 'VVS3', 'Square', '2018-06-21 19:59:37', '2018-06-21 19:59:37'),
(34, 1, 'AM-1529576977', 25, 'kb090035', 'AM-4CECBE0DC32DFACF', 8, 2, 1, 1, 2, 4, 4, 1, 'Abc', 4, 3, 9, 101, 97, 1, 'Promise Solitire Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Prong or Claw Setting', 'Claw Set', 'Claw Set', 'Channel Setting', 'Contemporary', 'Euro Shank', 2.00, 2.00, 2.00, 2.00, 1, '454554', '1', '10-20', '2', '', 'HDFC ERGO', 5.00, 50.00, 3.00, 10.00, 2.00, 10.00, 4.00, 18150.00, 100000.00, 6000.00, 20000.00, 4000.00, 33000.00, 13794.00, 200000.00, 363000.00, 344850.00, 'Gold', 'Yellow', '22K', 'Diamond', 'Pink', 'VVS3', 'Square', '2018-06-21 19:59:37', '2018-06-21 19:59:37'),
(35, 1, 'AM-1529582501', 54, 'by699969', 'AM-28CD2CBBBBC406A5', 54, 2, 1, 2, 0, 5, 0, 0, '', 4, 3, 15, 127, 118, 0, 'Ring 1', 'Jewellery', 'Rings', 'Bands', '', 'Double', 'Double', 'Channel Setting', 'Contemporary', 'Tapered', 2.00, 0.00, 0.00, 0.00, 1, 'IM454545445', '1', '10-20', '2', '', '', 0.00, 0.00, 3.00, 10.00, 2.00, 10.00, 0.00, 0.00, 0.00, 3.00, 10.00, 2.00, 11.50, 0.00, 100.00, 126.50, 126.50, 'Gold', 'Rose Gold', '18K', 'Others', 'Pink', 'VVS1', 'Oval', '2018-06-21 12:01:41', '2018-06-21 12:01:41'),
(36, 1, 'AM-1529583445', 25, 'kb090035', 'AM-47698CDFA05AB3BE', 8, 2, 1, 1, 2, 4, 4, 1, 'Abc', 4, 3, 9, 101, 97, 0, 'Promise Solitire Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Prong or Claw Setting', 'Claw Set', 'Claw Set', 'Channel Setting', 'Contemporary', 'Euro Shank', 2.00, 2.00, 2.00, 2.00, 5, '454554', '1', '10-20', '2', '', '', 5.00, 50.00, 3.00, 10.00, 2.00, 10.00, 0.00, 18150.00, 100000.00, 6000.00, 20000.00, 4000.00, 33000.00, 0.00, 200000.00, 363000.00, 344850.00, 'Gold', 'Yellow', '22K', 'Diamond', 'Pink', 'VVS3', 'Square', '2018-06-21 12:17:26', '2018-06-21 12:17:26'),
(37, 1, 'AM-1529583445', 54, 'by699969', 'AM-32E30B664FC381AA', 54, 2, 1, 2, 0, 5, 0, 0, '', 4, 3, 15, 127, 118, 0, 'Ring 1', 'Jewellery', 'Rings', 'Bands', '', 'Double', 'Double', 'Channel Setting', 'Contemporary', 'Tapered', 2.00, 0.00, 0.00, 0.00, 1, 'IM454545445', '1', '10-20', '2', '', '', 0.00, 0.00, 3.00, 10.00, 2.00, 10.00, 0.00, 0.00, 0.00, 3.00, 10.00, 2.00, 11.50, 0.00, 100.00, 126.50, 126.50, 'Gold', 'Rose Gold', '18K', 'Others', 'Pink', 'VVS1', 'Oval', '2018-06-21 12:17:26', '2018-06-21 12:17:26'),
(38, 1, 'AM-1529641773', 25, 'kb090035', 'AM-7D4A5091C1B04A99', 8, 2, 1, 1, 2, 4, 4, 1, 'Abc', 4, 3, 9, 101, 97, 0, 'Promise Solitire Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Prong or Claw Setting', 'Claw Set', 'Claw Set', 'Channel Setting', 'Contemporary', 'Euro Shank', 2.00, 2.00, 2.00, 2.00, 1, '454554', '1', '10-20', '2', '', '', 5.00, 50.00, 3.00, 10.00, 2.00, 10.00, 0.00, 18150.00, 100000.00, 6000.00, 20000.00, 4000.00, 33000.00, 0.00, 200000.00, 363000.00, 344850.00, 'Gold', 'Yellow', '22K', 'Diamond', 'Pink', 'VVS3', 'Square', '2018-06-22 04:29:33', '2018-06-22 04:29:33'),
(39, 1, 'AM-1529641812', 25, 'kb090035', 'AM-96591217792EE735', 8, 2, 1, 1, 2, 4, 4, 1, 'Abc', 4, 3, 9, 101, 97, 0, 'Promise Solitire Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Prong or Claw Setting', 'Claw Set', 'Claw Set', 'Channel Setting', 'Contemporary', 'Euro Shank', 2.00, 2.00, 2.00, 2.00, 1, '454554', '1', '10-20', '2', '', '', 5.00, 50.00, 3.00, 10.00, 2.00, 10.00, 0.00, 18150.00, 100000.00, 6000.00, 20000.00, 4000.00, 33000.00, 0.00, 200000.00, 363000.00, 344850.00, 'Gold', 'Yellow', '22K', 'Diamond', 'Pink', 'VVS3', 'Square', '2018-06-22 04:30:12', '2018-06-22 04:30:12'),
(40, 1, 'AM-1529641812', 44, 'yy812268', 'AM-B22C64E1C0E3E6DF', 1, 2, 2, 7, 6, 0, 8, 2, 'pqr', 3, 0, 0, 113, 111, 0, 'Classic Solitaire Bangle', 'Jewellery', 'Bracelets & Bangles', 'Bangles', 'Cluster Setting', '', '', '', 'Traditional', '', 2.00, 2.00, 2.00, 2.00, 1, 'IM00545', '1', '5-10', '2', '', '', 12.00, 15.00, 3.00, 10.00, 2.00, 10.00, 0.00, 50292.00, 45000.00, 9000.00, 30000.00, 6000.00, 39000.00, 0.00, 300000.00, 419100.00, 368808.00, 'Gold', 'Rose Gold', '18K', 'Without Accents', 'Gold', 'VVS4', 'Oval', '2018-06-22 04:30:12', '2018-06-22 04:30:12'),
(41, 1, 'AM-1529641947', 25, 'kb090035', 'AM-74662564F953FA23', 8, 2, 1, 1, 2, 4, 4, 1, 'Abc', 4, 3, 9, 101, 97, 0, 'Promise Solitire Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Prong or Claw Setting', 'Claw Set', 'Claw Set', 'Channel Setting', 'Contemporary', 'Euro Shank', 2.00, 2.00, 2.00, 2.00, 1, '454554', '1', '10-20', '2', '', '', 5.00, 50.00, 3.00, 10.00, 2.00, 10.00, 0.00, 18150.00, 100000.00, 6000.00, 20000.00, 4000.00, 33000.00, 0.00, 200000.00, 363000.00, 344850.00, 'Gold', 'Yellow', '22K', 'Diamond', 'Pink', 'VVS3', 'Square', '2018-06-22 04:32:27', '2018-06-22 04:32:27'),
(42, 1, 'AM-1529646743', 25, 'kb090035', 'AM-43636AAA4AEC729F', 8, 2, 1, 1, 2, 4, 4, 1, 'Abc', 4, 3, 9, 101, 97, 0, 'Promise Solitire Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Prong or Claw Setting', 'Claw Set', 'Claw Set', 'Channel Setting', 'Contemporary', 'Euro Shank', 2.00, 2.00, 2.00, 2.00, 1, '454554', '1', '10-20', '2', '', '', 5.00, 50.00, 3.00, 10.00, 2.00, 10.00, 0.00, 18150.00, 100000.00, 6000.00, 20000.00, 4000.00, 33000.00, 0.00, 200000.00, 363000.00, 344850.00, 'Gold', 'Yellow', '22K', 'Diamond', 'Pink', 'VVS3', 'Square', '2018-06-22 05:52:23', '2018-06-22 05:52:23'),
(43, 1, 'AM-1529646743', 27, 'ek974312', 'AM-9F51AFDFBBEC7512', 8, 2, 1, 3, 4, 6, 5, 1, 'Abc', 4, 2, 13, 56, 58, 0, 'Brown Dimond Ring', 'Jewellery', 'Rings', 'Accent Rings', 'Bezel Setting', 'Flared', 'Flared', 'Bar Setting', 'Contemporary', 'Bypass Shank', 4.00, 5.00, 2.00, 2.00, 1, '45454', '1', '5-10', '1', '', '', 5.00, 0.00, 3.00, 10.00, 2.00, 10.00, 0.00, 1265.00, 0.00, 600.00, 2000.00, 400.00, 2300.00, 0.00, 20000.00, 25300.00, 24035.00, 'Palladium', 'Two Tone', '22K', 'Pearls', 'Pink', 'VVS3', 'Circle', '2018-06-22 05:52:24', '2018-06-22 05:52:24'),
(44, 1, 'AM-1529646743', 43, 'ng459297', 'AM-ABE3D1BB79F890E9', 8, 2, 2, 7, 2, 0, 4, 2, 'pqr', 4, 0, 0, 88, 89, 0, '18 Kt Yellow Gold Bangle', 'Jewellery', 'Bracelets & Bangles', 'Bangles', 'Prong or Claw Setting', '', '', '', 'Contemporary', '', 40.00, 5.00, 5.00, 5.00, 1, 'IM45454545', '1', '5-10', '2', '', '', 0.00, 0.00, 3.00, 10.00, 2.00, 10.00, 0.00, 0.00, 0.00, 600.00, 2000.00, 400.00, 2300.00, 0.00, 20000.00, 25300.00, 25300.00, 'Gold', 'Two Tone', '18K', 'Pearls', 'Gold', 'VVS4', 'Circle', '2018-06-22 05:52:24', '2018-06-22 05:52:24'),
(45, 1, 'AM-1529646985', 25, 'kb090035', 'AM-BC0B87F070C76EE4', 8, 2, 1, 1, 2, 4, 4, 1, 'Abc', 4, 3, 9, 101, 97, 0, 'Promise Solitire Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Prong or Claw Setting', 'Claw Set', 'Claw Set', 'Channel Setting', 'Contemporary', 'Euro Shank', 2.00, 2.00, 2.00, 2.00, 1, '454554', '1', '10-20', '2', '', '', 5.00, 50.00, 3.00, 10.00, 2.00, 10.00, 0.00, 18150.00, 100000.00, 6000.00, 20000.00, 4000.00, 33000.00, 0.00, 200000.00, 363000.00, 344850.00, 'Gold', 'Yellow', '22K', 'Diamond', 'Pink', 'VVS3', 'Square', '2018-06-22 05:56:25', '2018-06-22 05:56:25'),
(46, 1, 'AM-1529646985', 44, 'yy812268', 'AM-8ABF8735F06862BB', 1, 2, 2, 7, 6, 0, 8, 2, 'pqr', 3, 0, 0, 113, 111, 0, 'Classic Solitaire Bangle', 'Jewellery', 'Bracelets & Bangles', 'Bangles', 'Cluster Setting', '', '', '', 'Traditional', '', 2.00, 2.00, 2.00, 2.00, 1, 'IM00545', '1', '5-10', '2', '', '', 12.00, 15.00, 3.00, 10.00, 2.00, 10.00, 0.00, 50292.00, 45000.00, 9000.00, 30000.00, 6000.00, 39000.00, 0.00, 300000.00, 419100.00, 368808.00, 'Gold', 'Rose Gold', '18K', 'Without Accents', 'Gold', 'VVS4', 'Oval', '2018-06-22 05:56:25', '2018-06-22 05:56:25'),
(47, 1, 'AM-9467333531', 25, 'kb090035', 'AM-D43F5C9CC193B501', 8, 2, 1, 1, 2, 4, 4, 1, 'Abc', 4, 3, 9, 101, 97, 0, 'Promise Solitire Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Prong or Claw Setting', 'Claw Set', 'Claw Set', 'Channel Setting', 'Contemporary', 'Euro Shank', 2.00, 2.00, 2.00, 2.00, 1, '454554', '1', '10-20', '2', '', '', 5.00, 50.00, 3.00, 10.00, 2.00, 10.00, 0.00, 18150.00, 100000.00, 6000.00, 20000.00, 4000.00, 33000.00, 0.00, 200000.00, 363000.00, 344850.00, 'Gold', 'Yellow', '22K', 'Diamond', 'Pink', 'VVS3', 'Square', '2018-06-22 14:02:58', '2018-06-22 14:02:58'),
(48, 1, 'AM-9467333531', 46, 'ao384801', 'AM-72D1CCD496F04BA1', 54, 2, 3, 14, 4, 0, 3, 1, 'Abc', 3, 0, 0, 109, 107, 0, 'Lavy Beaded Gold Jhumkas', 'Jewellery', 'Earrings', 'Chandbali', 'Bezel Setting', '', '', '', 'Traditional', '', 1.50, 4.50, 3.50, 2.50, 1, 'UE00628-2Y0000', '1', '5-10', '2', '', '', 6.00, 4.00, 3.00, 10.00, 2.00, 10.00, 0.00, 3323.57, 1692.68, 1269.51, 4231.70, 846.34, 5035.72, 0.00, 42317.00, 55392.95, 52069.38, 'Gold', 'Rose Gold', '14K', 'Diamond', 'Blue', 'VVS1', 'Circle', '2018-06-22 14:02:58', '2018-06-22 14:02:58'),
(49, 1, 'AM-9081670779', 46, 'ao384801', 'AM-B13BB649D4F33ED8', 54, 2, 3, 14, 4, 0, 3, 1, 'Abc', 3, 0, 0, 109, 107, 0, 'Lavy Beaded Gold Jhumkas', 'Jewellery', 'Earrings', 'Chandbali', 'Bezel Setting', '', '', '', 'Traditional', '', 1.50, 4.50, 3.50, 2.50, 1, 'UE00628-2Y0000', '1', '5-10', '2', '', '', 6.00, 4.00, 3.00, 10.00, 2.00, 10.00, 0.00, 3323.57, 1692.68, 1269.51, 4231.70, 846.34, 5035.72, 0.00, 42317.00, 55392.95, 52069.38, 'Gold', 'Rose Gold', '14K', 'Diamond', 'Blue', 'VVS1', 'Circle', '2018-06-22 14:38:59', '2018-06-22 14:38:59'),
(50, 1, 'AM-0264140216', 25, 'kb090035', 'AM-44CF81F8B9AEF714', 8, 2, 1, 1, 2, 4, 4, 1, 'Abc', 4, 3, 9, 101, 97, 0, 'Promise Solitire Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Prong or Claw Setting', 'Claw Set', 'Claw Set', 'Channel Setting', 'Contemporary', 'Euro Shank', 2.00, 2.00, 2.00, 2.00, 2, '454554', '1', '10-20', '2', '', '', 5.00, 50.00, 3.00, 10.00, 2.00, 10.00, 0.00, 18150.00, 100000.00, 6000.00, 20000.00, 4000.00, 33000.00, 0.00, 200000.00, 363000.00, 344850.00, 'Gold', 'Yellow', '22K', 'Diamond', 'Pink', 'VVS3', 'Square', '2018-06-25 10:54:42', '2018-06-25 10:54:42'),
(51, 1, 'AM-0264140216', 54, 'by699969', 'AM-9FB888B1D6B3BE1A', 54, 2, 1, 2, 0, 5, 0, 0, '', 4, 3, 15, 127, 118, 0, 'Ring 1', 'Jewellery', 'Rings', 'Bands', '', 'Double', 'Double', 'Channel Setting', 'Contemporary', 'Tapered', 2.00, 0.00, 0.00, 0.00, 1, 'IM454545445', '1', '10-20', '2', '', '', 0.00, 0.00, 3.00, 10.00, 2.00, 10.00, 0.00, 0.00, 0.00, 3.00, 10.00, 2.00, 11.50, 0.00, 100.00, 126.50, 126.50, 'Gold', 'Rose Gold', '18K', 'Others', 'Pink', 'VVS1', 'Oval', '2018-06-25 10:54:43', '2018-06-25 10:54:43'),
(52, 1, 'AM-1396978260', 25, 'kb090035', 'AM-2CDA7DB0DA61D35F', 8, 2, 1, 1, 2, 4, 4, 1, 'Abc', 4, 3, 9, 101, 97, 1, 'Promise Solitire Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Prong or Claw Setting', 'Claw Set', 'Claw Set', 'Channel Setting', 'Contemporary', 'Euro Shank', 2.00, 2.00, 2.00, 2.00, 1, '454554', '1', '10-20', '2', '', 'HDFC ERGO', 5.00, 50.00, 3.00, 10.00, 2.00, 10.00, 4.00, 18150.00, 100000.00, 6000.00, 20000.00, 4000.00, 33000.00, 13794.00, 200000.00, 363000.00, 344850.00, 'Gold', 'Yellow', '22K', 'Diamond', 'Pink', 'VVS3', 'Square', '2018-06-26 04:24:57', '2018-06-26 04:24:57'),
(53, 1, 'AM-0517857812', 25, 'kb090035', 'AM-12220C59AB42CFE0', 8, 2, 1, 1, 2, 4, 4, 1, 'Abc', 4, 3, 9, 101, 97, 1, 'Promise Solitire Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Prong or Claw Setting', 'Claw Set', 'Claw Set', 'Channel Setting', 'Contemporary', 'Euro Shank', 2.00, 2.00, 2.00, 2.00, 1, '454554', '1', '10-20', '2', '', 'HDFC ERGO', 5.00, 50.00, 3.00, 10.00, 2.00, 10.00, 4.00, 18150.00, 100000.00, 6000.00, 20000.00, 4000.00, 33000.00, 13794.00, 200000.00, 363000.00, 344850.00, 'Gold', 'Yellow', '22K', 'Diamond', 'Pink', 'VVS3', 'Square', '2018-06-26 04:26:38', '2018-06-26 04:26:38'),
(54, 1, 'AM-6039556786', 57, 'ii219321', 'AM-E008E1F12C6166FB', 1, 2, 1, 1, 8, 4, 5, 2, 'pqr', 3, 3, 6, 131, 121, 0, 'old ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Tension Setting', 'Claw Set', 'Claw Set', 'Channel Setting', 'Traditional', 'Straight Shank', 2.00, 2.00, 2.00, 2.00, 2, 'IM45454545', '1', '5-10', '2', '', '', 0.00, 0.00, 3.00, 10.00, 2.00, 10.00, 0.00, 0.00, 0.00, 0.15, 0.50, 0.10, 0.57, 0.00, 5.00, 6.33, 6.33, 'Gold', 'Two Tone', '22K', 'Others', 'Gold', 'VVS1', 'Oval', '2018-06-26 04:30:17', '2018-06-26 04:30:17'),
(55, 1, 'AM-1187035513', 27, 'ek974312', 'AM-2C396DB7FB204C01', 8, 2, 1, 3, 4, 6, 5, 1, 'Abc', 4, 2, 13, 56, 58, 0, 'Brown Dimond Ring', 'Jewellery', 'Rings', 'Accent Rings', 'Bezel Setting', 'Flared', 'Flared', 'Bar Setting', 'Contemporary', 'Bypass Shank', 4.00, 5.00, 2.00, 2.00, 1, '45454', '1', '5-10', '1', '', '', 5.00, 0.00, 3.00, 10.00, 2.00, 10.00, 0.00, 1265.00, 0.00, 600.00, 2000.00, 400.00, 2300.00, 0.00, 20000.00, 25300.00, 24035.00, 'Palladium', 'Two Tone', '22K', 'Pearls', 'Pink', 'VVS3', 'Circle', '2018-06-26 04:31:20', '2018-06-26 04:31:20'),
(56, 1, 'AM-9892738921', 54, 'by699969', 'AM-2CFC18BF6517DD2E', 54, 2, 1, 2, 0, 5, 0, 0, '', 4, 3, 15, 127, 118, 0, 'Ring 1', 'Jewellery', 'Rings', 'Bands', '', 'Double', 'Double', 'Channel Setting', 'Contemporary', 'Tapered', 2.00, 0.00, 0.00, 0.00, 1, 'IM454545445', '1', '10-20', '2', '', '', 0.00, 0.00, 3.00, 10.00, 2.00, 10.00, 0.00, 0.00, 0.00, 3.00, 10.00, 2.00, 11.50, 0.00, 100.00, 126.50, 126.50, 'Gold', 'Rose Gold', '18K', 'Others', 'Pink', 'VVS1', 'Oval', '2018-06-26 05:10:55', '2018-06-26 05:10:55'),
(57, 1, 'AM-4912878423', 57, 'ii219321', 'AM-55506BD2ED461799', 1, 2, 1, 1, 8, 4, 5, 2, 'pqr', 3, 3, 6, 131, 121, 0, 'old ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Tension Setting', 'Claw Set', 'Claw Set', 'Channel Setting', 'Traditional', 'Straight Shank', 2.00, 2.00, 2.00, 2.00, 1, 'IM45454545', '1', '5-10', '2', '', '', 0.00, 0.00, 3.00, 10.00, 2.00, 10.00, 0.00, 0.00, 0.00, 0.15, 0.50, 0.10, 0.57, 0.00, 5.00, 6.33, 6.33, 'Gold', 'Two Tone', '22K', 'Others', 'Gold', 'VVS1', 'Oval', '2018-06-26 05:14:15', '2018-06-26 05:14:15'),
(58, 1, 'AM-2373601838', 25, 'kb090035', 'AM-8BC3030EC5F82406', 8, 2, 1, 1, 2, 4, 4, 1, 'Abc', 4, 3, 9, 101, 97, 0, 'Promise Solitire Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Prong or Claw Setting', 'Claw Set', 'Claw Set', 'Channel Setting', 'Contemporary', 'Euro Shank', 2.00, 2.00, 2.00, 2.00, 1, '454554', '1', '10-20', '2', '', '', 5.00, 50.00, 3.00, 10.00, 2.00, 10.00, 0.00, 18150.00, 100000.00, 6000.00, 20000.00, 4000.00, 33000.00, 0.00, 200000.00, 363000.00, 344850.00, 'Gold', 'Yellow', '22K', 'Diamond', 'Pink', 'VVS3', 'Square', '2018-06-26 05:17:41', '2018-06-26 05:17:41'),
(59, 1, 'AM-6497786683', 25, 'kb090035', 'AM-B137D5B3EA9946EF', 8, 2, 1, 1, 2, 4, 4, 1, 'Abc', 4, 3, 9, 101, 97, 0, 'Promise Solitire Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Prong or Claw Setting', 'Claw Set', 'Claw Set', 'Channel Setting', 'Contemporary', 'Euro Shank', 2.00, 2.00, 2.00, 2.00, 1, '454554', '1', '10-20', '2', '', '', 5.00, 50.00, 3.00, 10.00, 2.00, 10.00, 0.00, 18150.00, 100000.00, 6000.00, 20000.00, 4000.00, 33000.00, 0.00, 200000.00, 363000.00, 344850.00, 'Gold', 'Yellow', '22K', 'Diamond', 'Pink', 'VVS3', 'Square', '2018-06-26 05:17:53', '2018-06-26 05:17:53'),
(60, 1, 'AM-5434900343', 25, 'kb090035', 'AM-CD6E7D8790636D6B', 8, 2, 1, 1, 2, 4, 4, 1, 'Abc', 4, 3, 9, 101, 97, 0, 'Promise Solitire Ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Prong or Claw Setting', 'Claw Set', 'Claw Set', 'Channel Setting', 'Contemporary', 'Euro Shank', 2.00, 2.00, 2.00, 2.00, 1, '454554', '1', '10-20', '2', '', '', 5.00, 50.00, 3.00, 10.00, 2.00, 10.00, 0.00, 18150.00, 100000.00, 6000.00, 20000.00, 4000.00, 33000.00, 0.00, 200000.00, 363000.00, 344850.00, 'Gold', 'Yellow', '22K', 'Diamond', 'Pink', 'VVS3', 'Square', '2018-06-26 05:18:22', '2018-06-26 05:18:22'),
(61, 1, 'AM-5707497982', 57, 'ii219321', 'AM-94F20577BEC6AF7A', 1, 2, 1, 1, 8, 4, 5, 2, '', 3, 3, 6, 131, 121, 0, 'old ring', 'Jewellery', 'Rings', 'Solitare Rings', 'Tension Setting', 'Claw Set', 'Claw Set', 'Channel Setting', 'Traditional', 'Straight', 2.00, 2.00, 2.00, 2.00, 1, 'IM45454545', '1', '5-10', '2', '', '', 0.00, 0.00, 3.00, 10.00, 20.00, 10.00, 0.00, 0.00, 0.00, 0.15, 0.50, 1.00, 0.66, 0.00, 5.00, 7.32, 7.32, 'Gold', 'Two Tone', '22K', '', '', 'IF', 'Oval', '2018-10-20 10:10:09', '2018-10-20 10:10:09');

-- --------------------------------------------------------

--
-- Table structure for table `order_wallet`
--

CREATE TABLE `order_wallet` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `wallet_id` int(11) NOT NULL,
  `total_wallet_balance` float(20,2) NOT NULL DEFAULT '0.00',
  `used_wallet_balance` float(20,2) NOT NULL DEFAULT '0.00',
  `remaining_wallet_balance` float(20,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_wallet`
--

INSERT INTO `order_wallet` (`id`, `order_id`, `user_id`, `wallet_id`, `total_wallet_balance`, `used_wallet_balance`, `remaining_wallet_balance`, `created_at`, `updated_at`) VALUES
(1, 'AM-1529496580', 13, 7, 150000.00, 150000.00, 0.00, '2018-06-20 17:39:40', '2018-06-20 17:39:40'),
(2, 'AM-1529499186', 13, 7, 1000.00, 1000.00, 0.00, '2018-06-20 18:23:06', '2018-06-20 18:23:06'),
(3, 'AM-1529555686', 13, 7, 344850.00, 344850.00, 0.00, '2018-06-21 10:04:46', '2018-06-21 10:04:46'),
(4, 'AM-1529641812', 1, 1, 344850.00, 344850.00, 0.00, '2018-06-22 04:30:12', '2018-06-22 04:30:12'),
(5, 'AM-1396978260', 1, 1, 44850.00, 44850.00, 0.00, '2018-06-26 04:24:57', '2018-06-26 04:24:57'),
(6, 'AM-0517857812', 1, 1, 44850.00, 44850.00, 0.00, '2018-06-26 04:26:38', '2018-06-26 04:26:38'),
(7, 'AM-9892738921', 1, 1, 4.00, 4.00, 0.00, '2018-06-26 05:10:55', '2018-06-26 05:10:55');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `uid` varchar(50) NOT NULL COMMENT 'Unique randomly generated id',
  `added_by_user_type` enum('1','3') NOT NULL COMMENT '1-admin,3-supplier',
  `added_by_user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `product_line_id` int(11) DEFAULT NULL,
  `setting_id` int(11) DEFAULT NULL,
  `shank_type_id` int(11) NOT NULL DEFAULT '0',
  `band_setting_id` int(11) NOT NULL DEFAULT '0',
  `ring_shoulder_id` int(11) NOT NULL DEFAULT '0',
  `product_metal_detailing_id` int(11) DEFAULT NULL,
  `product_brand_id` int(11) DEFAULT NULL,
  `look_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `metal_weight` double(20,2) NOT NULL DEFAULT '0.00',
  `product_height` double(20,2) NOT NULL DEFAULT '0.00',
  `product_width` double(20,2) NOT NULL DEFAULT '0.00',
  `product_length` double(20,2) NOT NULL DEFAULT '0.00',
  `quantity` varchar(50) DEFAULT NULL,
  `discount` double(20,2) NOT NULL DEFAULT '0.00' COMMENT 'in %',
  `product_price` double(20,2) NOT NULL DEFAULT '0.00',
  `admin_price` double(20,2) NOT NULL DEFAULT '0.00',
  `base_price` double(20,2) NOT NULL DEFAULT '0.00',
  `final_price` double(20,2) NOT NULL DEFAULT '0.00',
  `additional_markup` double(20,2) NOT NULL DEFAULT '0.00' COMMENT 'in %',
  `product_code` varchar(255) NOT NULL,
  `keywords` varchar(555) NOT NULL,
  `product_description` varchar(555) NOT NULL,
  `product_specification` varchar(555) NOT NULL,
  `video_url` text,
  `product_type` enum('1','2') NOT NULL COMMENT '1=Classic, 2=luxury',
  `type` enum('1','2') NOT NULL COMMENT '1=jewellery, 2=diamond',
  `admin_approval` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0=not approved,1=approved, 2=rejected',
  `status` enum('0','1') NOT NULL COMMENT '0=Inactive,1=active',
  `allow_product_home_trial` enum('1','2') NOT NULL COMMENT '1=No, 2=Yes',
  `slug` varchar(255) NOT NULL,
  `delivery_date` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `uid`, `added_by_user_type`, `added_by_user_id`, `category_id`, `subcategory_id`, `product_line_id`, `setting_id`, `shank_type_id`, `band_setting_id`, `ring_shoulder_id`, `product_metal_detailing_id`, `product_brand_id`, `look_id`, `product_name`, `metal_weight`, `product_height`, `product_width`, `product_length`, `quantity`, `discount`, `product_price`, `admin_price`, `base_price`, `final_price`, `additional_markup`, `product_code`, `keywords`, `product_description`, `product_specification`, `video_url`, `product_type`, `type`, `admin_approval`, `status`, `allow_product_home_trial`, `slug`, `delivery_date`, `created_at`, `updated_at`) VALUES
(25, 'kb090035', '3', 8, 2, 1, 1, 2, 9, 3, 4, 4, 1, 4, 'Promise Solitire Ring', 2.00, 2.00, 2.00, 2.00, '5', 5.00, 200000.00, 206000.00, 402600.00, 382470.00, 50.00, '454554', '', 'A ring is a round band, usually of metal, worn as an ornamental piece of jewellery around the finger, or sometimes the toe; it is the most common current meaning of the word \"ring\". Strictly speaking a normal ring is a finger ring (which may be hyphenated); other types of rings worn as ornaments are earrings, bracelets for the wrist, armlets or arm rings, toe rings and torc or neck rings, but except perhaps for toe rings, the plain term \"ring\" is not normally used to refer to these.', 'A ring is a round band, usually of metal, worn as an ornamental piece of jewellery around the finger, or sometimes the toe; it is the most common current meaning of the word \"ring\". Strictly speaking a normal ring is a finger ring (which may be hyphenated); other types of rings worn as ornaments are earrings, bracelets for the wrist, armlets or arm rings, toe rings and torc or neck rings, but except perhaps for toe rings, the plain term \"ring\" is not normally used to refer to these.', 'https://www.youtube.com/embed/u6MbVNy5Upc', '1', '1', '1', '1', '2', 'promise-solitire-ring', '10-20', '2018-05-17 01:17:45', '2018-11-30 05:27:27'),
(26, 'ow472387', '3', 8, 2, 1, 3, 4, 6, 2, 5, 4, 1, 4, 'Silver Dimond Halo Ring', 2.00, 2.00, 2.00, 2.00, '5', 5.00, 20000.00, 20600.00, 29260.00, 27797.00, 0.00, '4545', '', 'A ring is a round band, usually of metal, worn as an ornamental piece of jewellery around the finger, or sometimes the toe; it is the most common current meaning of the word \"ring\". Strictly speaking a normal ring is a finger ring (which may be hyphenated); other types of rings worn as ornaments are earrings, bracelets for the wrist, armlets or arm rings, toe rings and torc or neck rings, but except perhaps for toe rings, the plain term \"ring\" is not normally used to refer to these.', 'A ring is a round band, usually of metal, worn as an ornamental piece of jewellery around the finger, or sometimes the toe; it is the most common current meaning of the word \"ring\". Strictly speaking a normal ring is a finger ring (which may be hyphenated); other types of rings worn as ornaments are earrings, bracelets for the wrist, armlets or arm rings, toe rings and torc or neck rings, but except perhaps for toe rings, the plain term \"ring\" is not normally used to refer to these.', 'https://www.youtube.com/embed/u6MbVNy5Upc', '1', '1', '1', '0', '2', 'silver-dimond-halo-ring', '10-20', '2018-05-17 01:21:12', '2018-11-30 05:27:28'),
(27, 'ek974312', '3', 8, 2, 1, 3, 4, 13, 2, 6, 5, 1, 4, 'Brown Dimond Ring', 4.00, 5.00, 2.00, 2.00, '5', 5.00, 20000.00, 20600.00, 29260.00, 27797.00, 0.00, '45454', '', 'A ring is a round band, usually of metal, worn as an ornamental piece of jewellery around the finger, or sometimes the toe; it is the most common current meaning of the word \"ring\". Strictly speaking a normal ring is a finger ring (which may be hyphenated); other types of rings worn as ornaments are earrings, bracelets for the wrist, armlets or arm rings, toe rings and torc or neck rings, but except perhaps for toe rings, the plain term \"ring\" is not normally used to refer to these.', 'A ring is a round band, usually of metal, worn as an ornamental piece of jewellery around the finger, or sometimes the toe; it is the most common current meaning of the word \"ring\". Strictly speaking a normal ring is a finger ring (which may be hyphenated); other types of rings worn as ornaments are earrings, bracelets for the wrist, armlets or arm rings, toe rings and torc or neck rings, but except perhaps for toe rings, the plain term \"ring\" is not normally used to refer to these.', 'https://www.youtube.com/embed/u6MbVNy5Upc', '1', '1', '1', '1', '1', 'brown-dimond-ring-1', '5-10', '2018-05-17 01:22:29', '2018-11-30 05:27:28'),
(28, 'ep856071', '3', 8, 2, 1, 1, 4, 10, 4, 4, 1, 2, 3, 'Stackable Birthstone Name Ring', 2.00, 2.00, 2.00, 2.00, '5', 5.00, 30000.00, 30900.00, 43890.00, 41695.50, 0.00, '4545', '', 'A ring is a round band, usually of metal, worn as an ornamental piece of jewellery around the finger, or sometimes the toe; it is the most common current meaning of the word \"ring\". Strictly speaking a normal ring is a finger ring (which may be hyphenated); other types of rings worn as ornaments are earrings, bracelets for the wrist, armlets or arm rings, toe rings and torc or neck rings, but except perhaps for toe rings, the plain term \"ring\" is not normally used to refer to these.', 'A ring is a round band, usually of metal, worn as an ornamental piece of jewellery around the finger, or sometimes the toe; it is the most common current meaning of the word \"ring\". Strictly speaking a normal ring is a finger ring (which may be hyphenated); other types of rings worn as ornaments are earrings, bracelets for the wrist, armlets or arm rings, toe rings and torc or neck rings, but except perhaps for toe rings, the plain term \"ring\" is not normally used to refer to these.', 'https://www.youtube.com/embed/u6MbVNy5Upc', '1', '1', '1', '1', '2', 'stackable-birthstone-name-ring-1', '0-5', '2018-05-17 01:24:47', '2018-11-30 05:27:28'),
(29, 'yo250655', '3', 8, 2, 4, 19, 6, 0, 0, 0, 1, 1, 4, 'Gold Y Necklace', 2.00, 2.00, 2.00, 2.00, '5', 5.00, 2.00, 2.06, 2.93, 2.78, 0.00, '4454545', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unch', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unch', 'https://www.youtube.com/embed/u6MbVNy5Upc', '1', '1', '1', '0', '2', 'gold-y-necklace-1', '10-20', '2018-05-19 05:13:30', '2018-11-30 05:27:28'),
(43, 'ng459297', '3', 8, 2, 2, 7, 2, 0, 0, 0, 4, 2, 4, '18 Kt Yellow Gold Bangle', 40.00, 5.00, 5.00, 5.00, '5', 0.00, 20000.00, 20600.00, 29260.00, 29260.00, 0.00, 'IM45454545', '', 'lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum', 'lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem', 'https://www.youtube.com/embed/u6MbVNy5Upc', '1', '1', '1', '1', '2', '18-kt-yellow-gold-bangle', '5-10', '2018-05-29 05:01:16', '2018-11-30 05:27:28'),
(44, 'yy812268', '1', 1, 2, 2, 7, 6, 0, 0, 0, 8, 2, 3, 'Classic Solitaire Bangle', 2.00, 2.00, 2.00, 2.00, '5', 12.00, 300000.00, 300000.00, 478500.00, 421080.00, 15.00, 'IM00545', '', 'Classic Solitaire Bangle\r\nClassic Solitaire Bangle\r\nClassic Solitaire Bangle\r\nClassic Solitaire Bangle\r\nClassic Solitaire Bangle', 'Classic Solitaire Bangle\r\nClassic Solitaire Bangle\r\nClassic Solitaire Bangle\r\nClassic Solitaire Bangle\r\nClassic Solitaire Bangle\r\nClassic Solitaire Bangle', 'https://www.youtube.com/embed/u6MbVNy5Upc', '1', '1', '1', '1', '2', 'classic-solitaire-bangle', '5-10', '2018-05-29 05:11:51', '2018-11-30 05:27:28'),
(45, 'td735372', '3', 8, 3, 7, 2, 4, 13, 2, 10, 3, 1, 4, 'new product 199', 2.00, 2.00, 2.00, 0.00, '5', 5.00, 10.00, 10.30, 15.73, 14.94, 0.00, 'sdkfhk', '', '2df', 'jkhjkhk', NULL, '1', '1', '1', '1', '1', 'new-product-199', '10-20', '2018-05-29 22:44:47', '2018-11-30 05:27:28'),
(46, 'ao384801', '3', 54, 2, 3, 14, 4, 0, 0, 0, 3, 1, 3, 'Lavy Beaded Gold Jhumkas', 1.50, 4.50, 3.50, 2.50, '5', 6.00, 42317.00, 43586.51, 63771.72, 59945.42, 4.00, 'UE00628-2Y0000', '', 'Fetra projects Locations filter not working properly', 'Fetra projects Locations filter not working properly', 'https://www.youtube.com/embed/z-GH_hFwA50', '1', '1', '1', '1', '2', 'lavy-beaded-gold-jhumkas-1', '5-10', '2018-06-19 08:46:39', '2018-11-30 05:27:28'),
(47, 'xw436943', '3', 54, 2, 3, 14, 6, 0, 0, 0, 5, 1, 4, 'Esita Beaded Gold Drop Earrings', 1.50, 4.50, 3.50, 2.50, '5', 8.00, 17326.00, 17845.78, 25729.11, 23670.78, 2.00, 'UE00543-2Y0000', '', 'ross Browser Testing, Selenium Testing, and Mobile Testing | Sauce Labs', 'ross Browser Testing, Selenium Testing, and Mobile Testing | Sauce Labs', 'https://www.youtube.com/embed/z-GH_hFwA50', '1', '1', '1', '1', '2', 'esita-beaded-gold-drop-earrings', '5-10', '2018-06-19 08:49:52', '2018-11-30 05:27:28'),
(48, 'yl155238', '1', 1, 2, 2, 6, NULL, 0, 0, 0, 3, NULL, 4, 'Esita Beaded Gold Drop Earrings85', 1.50, 4.50, 3.50, 2.50, '5', 10.00, 100.00, 100.00, 154.00, 138.60, 10.00, 'UE00543-2Y0000', '', 'Fetra projects Locations filter not working properly', 'Locations filter not working properly', 'https://www.youtube.com/embed/z-GH_hFwA50', '1', '1', '1', '1', '2', 'esita-beaded-gold-drop-earrings85', '0-5', '2018-06-20 07:21:09', '2018-11-30 05:27:28'),
(49, 'yx072368', '1', 1, 2, 3, 11, 4, 0, 0, 0, 5, 1, 4, 'Esita Beaded Gold Drop Earrings87', 1.50, 4.50, 3.50, 2.50, '5', 0.00, 100.00, 100.00, 143.00, 143.00, 0.00, 'UE00543-2Y0000', '', 'insurance amount should display the propers', 'insurance amount should display the propers', 'https://www.youtube.com/embed/z-GH_hFwA50', '1', '1', '1', '1', '2', 'esita-beaded-gold-drop-earrings87', '0-5', '2018-06-20 08:49:34', '2018-11-30 05:27:28'),
(50, 'iz167138', '3', 54, 2, 6, 27, 4, 0, 0, 0, 3, 1, 4, 'Butterfly Flexi Ring', 1.50, 4.50, 3.50, 2.50, '5', 0.00, 100.00, 103.00, 146.30, 146.30, 0.00, 'UE00543-2Y0000', '', 'Cloud-based platform for automated testing of web and mobile applications. Access web browsers, mobile emulators and simulators, and real mobile devices.', 'Cloud-based platform for automated testing of web and mobile applications. Access web browsers, mobile emulators and simulators, and real mobile devices.', 'https://www.youtube.com/embed/z-GH_hFwA50', '1', '1', '1', '1', '2', 'butterfly-flexi-ring', '0-5', '2018-06-20 10:11:37', '2018-11-30 05:27:28'),
(51, 'em855109', '3', 54, 2, 3, 12, 6, 0, 0, 0, 5, 1, 4, 'Arlette Butterfly Stud Earrings', 1.50, 4.50, 3.50, 2.50, '5', 10.00, 100.00, 103.00, 157.30, 141.57, 10.00, 'UE00543-2Y0001', '', 'Cloud-based platform for automated testing of web and mobile applications. Access web browsers, mobile emulators and simulators, and real mobile devices.', 'Cloud-based platform for automated testing of web and mobile applications. Access web browsers, mobile emulators and simulators, and real mobile devices.', 'https://www.youtube.com/embed/z-GH_hFwA50', '1', '1', '1', '1', '2', 'arlette-butterfly-stud-earrings', '5-10', '2018-06-20 10:22:07', '2018-11-30 05:27:28'),
(52, 'xf007492', '3', 54, 2, 2, 6, 4, 0, 0, 0, 5, 1, 4, 'Juana Leaf Linked Bracelet', 1.50, 4.50, 3.50, 2.50, '5', 10.00, 100.00, 103.00, 157.30, 141.57, 10.00, 'UE00543-2Y0001', '', 'Juana Leaf Linked Bracelet', 'Juana Leaf Linked Bracelet', 'https://www.youtube.com/embed/z-GH_hFwA50', '1', '1', '1', '1', '2', 'juana-leaf-linked-bracelet', '5-10', '2018-06-20 10:44:22', '2018-11-30 05:27:28'),
(53, 'cu017530', '1', 1, 2, 2, 6, 4, 0, 0, 0, 3, 1, 4, 'Esita Beaded Gold Drop Earrings88', 1.50, 4.50, 3.50, 2.50, '5', 10.00, 100.00, 100.00, 154.00, 138.60, 10.00, 'UE00543-2Y0003', '', 'Juana Leaf Linked Bracelet', 'Juana Leaf Linked Bracelet', 'https://www.youtube.com/embed/z-GH_hFwA50', '1', '1', '1', '1', '2', 'esita-beaded-gold-drop-earrings88', '0-5', '2018-06-20 10:51:39', '2018-11-30 05:27:28'),
(54, 'by699969', '3', 54, 2, 1, 2, NULL, 15, 3, 5, NULL, NULL, 4, 'Ring 1', 2.00, 0.00, 0.00, 0.00, '5', 0.00, 100.00, 103.00, 146.30, 146.30, 0.00, 'IM454545445', '', 'dd', 'dssd', NULL, '1', '1', '1', '1', '2', 'ring-1', '10-20', '2018-06-20 11:28:20', '2018-11-30 05:27:28'),
(55, 'ns373011', '1', 1, 2, 2, 6, NULL, 0, 0, 0, NULL, NULL, 4, 'Test product1', 1.50, 4.50, 3.50, 2.50, '5', 0.00, 2500.00, 2500.00, 3575.00, 3575.00, 0.00, '46464', '', 'When Student email address then and wrong password then should not show the 500 ip address', 'When Student email address then and wrong password then should not show the 500 ip address', NULL, '1', '1', '1', '1', '2', 'test-product1', '0-5', '2018-06-21 11:11:07', '2018-11-30 05:27:28'),
(56, 'ae626768', '1', 1, 2, 6, 27, 6, 0, 0, 0, NULL, 2, 4, 'Product count 3', 2.00, 2.00, 2.00, 2.00, '5', 0.00, 5000.00, 5000.00, 7150.00, 7150.00, 0.00, 'Imfssfd', '', 'dsf', 'sdfsd', NULL, '1', '1', '1', '1', '2', 'product-count-3', '5-10', '2018-06-22 05:29:51', '2018-11-30 05:27:28'),
(57, 'ii219321', '3', 1, 2, 1, 1, 8, 6, 3, 4, 5, 2, 3, 'old ring', 2.00, 2.00, 2.00, 2.00, '5', 0.00, 5.00, 5.15, 7.32, 7.32, 0.00, 'IM45454545', '', 'ds', 'dsdsd', NULL, '1', '1', '1', '1', '2', 'old-ring', '5-10', '2018-06-26 04:28:43', '2018-11-30 05:27:28'),
(59, 'dt176785', '3', 1, 2, 1, 1, 2, 6, 2, 4, 4, 1, 3, 'Gold ring G2', 2.00, 2.00, 2.00, 2.00, '5', 0.00, 12000.00, 12360.00, 17556.00, 17556.00, 0.00, 'IM45454545', '', 't is a long established fact that a reader will be distracted by the readable content ', 't is a long established fact that a reader will be distracted by the readable content ', 'https://www.youtube.com/watch?v=Hnj_EMDUfjY', '1', '1', '1', '0', '1', 'gold-ring-g2', '10-12 days', '2018-07-10 07:11:54', '2018-11-30 05:27:29'),
(60, 'xc050863', '3', 8, 2, 1, 2, 2, 6, 2, 14, 1, 1, 3, 'abcd', 2.00, 2.00, 2.00, 2.00, '5', 0.00, 102020.00, 105080.60, 149255.26, 149255.26, 0.00, 'ksdvfhvfhvh', '', 'asjdjhbafhdshb', 'sbjkdbjfhfvbdhbfhb', 'abc.com', '1', '1', '1', '0', '1', 'abcd', '1 day', '2018-07-25 12:48:17', '2018-11-30 05:27:29'),
(74, 'yb168381', '1', 0, 2, 4, 19, 4, 0, 0, 0, 3, 0, 3, 'Classic Necklace', 13.00, 3.00, 300.00, 34.00, '5', 0.00, 100.00, 100.00, 143.00, 143.00, 0.00, '3', '', 'classic necklace', 'good pretty beautiful', NULL, '1', '1', '1', '1', '1', 'classic-necklace', '15 days', '2018-10-09 20:36:47', '2018-11-30 05:27:29'),
(75, 'av463188', '1', 0, 2, 3, 9, 0, 0, 0, 0, 4, 0, 4, 'Classic Bracelet', 14.00, 4.00, 209.00, 549.00, '5', 0.00, 100.00, 100.00, 143.00, 143.00, 0.00, '4', '', 'classic bracelet', 'good pretty beautiful', NULL, '1', '1', '1', '1', '2', 'classic-bracelet', '5 days', '2018-10-09 20:36:47', '2018-11-30 05:27:29'),
(76, 'ex851747', '1', 0, 2, 6, 28, 6, 0, 0, 0, 5, 0, 3, 'Classic Cufflink', 15.00, 5.00, 80.00, 398.00, '5', 0.00, 100.00, 100.00, 143.00, 143.00, 0.00, '5', '', 'classic cufflink', 'good bad ugly', NULL, '1', '1', '1', '1', '1', 'classic-cufflink', '5 days', '2018-10-09 20:36:47', '2018-11-30 05:27:29'),
(77, 'tv257479', '1', 0, 2, 2, 13, 0, 7, 0, 0, 2, 0, 4, 'VA1008', 3.32, 1.00, 1.00, 500.00, '1', 0.00, 1.00, 1.00, 1.43, 1.43, 0.00, 'VA1007', '', 'Formal wear', 'Stone- 32 & Dia wt 0.34 cts ', '-', '1', '1', '0', '0', '2', 'va1008', '5-10 days', '2018-10-29 06:24:40', '2018-11-30 05:27:29'),
(78, 'fd162136', '1', 0, 2, 2, 13, 0, 7, 0, 0, 2, 0, 4, 'VA1009', 3.32, 1.00, 1.00, 500.00, '1', 0.00, 1.00, 1.00, 1.43, 1.43, 0.00, 'VA1007', '', 'Formal wear', 'Stone- 32 & Dia wt 0.34 cts ', '-', '1', '1', '0', '0', '2', 'va1009', '5-10 days', '2018-10-29 06:32:50', '2018-11-30 05:27:29'),
(79, 'ko171582', '1', 0, 2, 2, 13, 0, 7, 0, 0, 2, 0, 4, 'VA1010', 3.32, 1.00, 1.00, 500.00, '1', 0.00, 1.00, 1.00, 1.43, 1.43, 0.00, 'VA1007', '', 'Formal wear', 'Stone- 32 & Dia wt 0.34 cts ', 'https://www.youtube.com/watch?v=wKNmM_sYsls', '1', '1', '0', '0', '2', 'va1010', '5-10 days', '2018-10-29 07:14:00', '2018-11-30 05:27:29'),
(81, 'pt140612', '3', 1, 2, 2, 13, 0, 7, 0, 0, 2, 0, 4, 'VA1012', 3.32, 1.00, 1.00, 500.00, '1', 0.00, 1.00, 1.03, 1.46, 1.46, 0.00, 'VA1007', '', 'Formal wear', 'Stone- 32 & Dia wt 0.34 cts ', '', '1', '1', '0', '0', '2', 'va1012', '5-10 days', '2018-10-29 07:18:00', '2018-11-30 05:27:29'),
(84, 'we668979', '1', 0, 2, 2, 13, 0, 7, 0, 0, 2, 0, 4, 'VA1011', 3.32, 1.00, 1.00, 500.00, '1', 0.00, 1.00, 1.00, 1.43, 1.43, 0.00, 'VA1007', '', 'Formal wear', 'Stone- 32 & Dia wt 0.34 cts ', 'https://www.youtube.com/watch?v=iuLlaQ8NNkc', '1', '1', '1', '1', '2', 'va1011', '5-10 days', '2018-10-31 06:44:34', '2018-11-30 05:27:29');

-- --------------------------------------------------------

--
-- Table structure for table `product_brands`
--

CREATE TABLE `product_brands` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_clarities`
--

CREATE TABLE `product_clarities` (
  `id` int(11) NOT NULL,
  `clarity_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_collections`
--

CREATE TABLE `product_collections` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `collection_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_collections`
--

INSERT INTO `product_collections` (`id`, `product_id`, `collection_id`, `created_at`, `updated_at`) VALUES
(242, 29, 14, '2018-05-27 23:15:05', '2018-05-27 23:15:05'),
(243, 29, 13, '2018-05-27 23:15:05', '2018-05-27 23:15:05'),
(267, 27, 14, '2018-05-29 00:14:54', '2018-05-29 00:14:54'),
(268, 27, 13, '2018-05-29 00:14:54', '2018-05-29 00:14:54'),
(269, 28, 14, '2018-05-29 00:15:29', '2018-05-29 00:15:29'),
(278, 37, 14, '2018-05-29 01:31:30', '2018-05-29 01:31:30'),
(280, 38, 13, '2018-05-29 04:10:07', '2018-05-29 04:10:07'),
(283, 41, 14, '2018-05-29 04:40:09', '2018-05-29 04:40:09'),
(285, 43, 14, '2018-05-29 05:01:17', '2018-05-29 05:01:17'),
(290, 45, 14, '2018-05-29 22:44:47', '2018-05-29 22:44:47'),
(293, 25, 14, '2018-06-11 00:16:53', '2018-06-11 00:16:53'),
(295, 26, 14, '2018-06-11 04:07:03', '2018-06-11 04:07:03'),
(297, 47, 14, '2018-06-19 08:49:52', '2018-06-19 08:49:52'),
(298, 47, 13, '2018-06-19 08:49:52', '2018-06-19 08:49:52'),
(299, 46, 14, '2018-06-19 08:51:08', '2018-06-19 08:51:08'),
(301, 44, 14, '2018-06-19 09:45:29', '2018-06-19 09:45:29'),
(302, 48, 14, '2018-06-20 07:21:09', '2018-06-20 07:21:09'),
(303, 49, 14, '2018-06-20 08:49:34', '2018-06-20 08:49:34'),
(304, 49, 13, '2018-06-20 08:49:34', '2018-06-20 08:49:34'),
(305, 50, 14, '2018-06-20 10:11:37', '2018-06-20 10:11:37'),
(306, 51, 14, '2018-06-20 10:22:07', '2018-06-20 10:22:07'),
(307, 52, 14, '2018-06-20 10:44:22', '2018-06-20 10:44:22'),
(308, 53, 14, '2018-06-20 10:51:39', '2018-06-20 10:51:39'),
(309, 54, 13, '2018-06-20 11:28:20', '2018-06-20 11:28:20'),
(310, 55, 14, '2018-06-21 11:11:07', '2018-06-21 11:11:07'),
(311, 56, 14, '2018-06-22 05:29:52', '2018-06-22 05:29:52'),
(312, 57, 14, '2018-06-26 04:28:44', '2018-06-26 04:28:44'),
(315, 59, 13, '2018-07-10 07:11:54', '2018-07-10 07:11:54'),
(316, 59, 14, '2018-07-10 07:11:54', '2018-07-10 07:11:54'),
(317, 60, 13, '2018-07-25 12:48:17', '2018-07-25 12:48:17'),
(329, 72, 13, '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(330, 73, 14, '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(331, 74, 13, '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(332, 75, 14, '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(333, 76, 13, '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(334, 77, 15, '2018-10-29 06:24:41', '2018-10-29 06:24:41'),
(335, 78, 15, '2018-10-29 06:32:50', '2018-10-29 06:32:50'),
(336, 79, 15, '2018-10-29 07:14:00', '2018-10-29 07:14:00'),
(337, 80, 15, '2018-10-29 07:16:00', '2018-10-29 07:16:00'),
(338, 81, 15, '2018-10-29 07:18:00', '2018-10-29 07:18:00'),
(339, 82, 15, '2018-10-31 06:30:54', '2018-10-31 06:30:54'),
(340, 83, 15, '2018-10-31 06:39:11', '2018-10-31 06:39:11'),
(341, 84, 15, '2018-10-31 06:44:34', '2018-10-31 06:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `product_finishes`
--

CREATE TABLE `product_finishes` (
  `id` int(11) NOT NULL,
  `finish_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_florescences`
--

CREATE TABLE `product_florescences` (
  `id` int(11) NOT NULL,
  `florescence_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_gemstone`
--

CREATE TABLE `product_gemstone` (
  `id` int(11) NOT NULL,
  `gemstone_type_id` int(11) NOT NULL,
  `gemstone_color_id` int(11) NOT NULL,
  `gemstone_quality_id` int(11) NOT NULL,
  `gemstone_shape_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_gemstone`
--

INSERT INTO `product_gemstone` (`id`, `gemstone_type_id`, `gemstone_color_id`, `gemstone_quality_id`, `gemstone_shape_id`, `product_id`, `created_at`, `updated_at`) VALUES
(4, 1, 5, 6, 3, 36, '2018-05-25 05:37:11', '2018-05-25 05:37:11'),
(5, 3, 8, 5, 2, 36, '2018-05-25 05:37:11', '2018-05-25 05:37:11'),
(6, 1, 8, 5, 2, 36, '2018-05-25 05:37:11', '2018-05-25 05:37:11'),
(14, 1, 8, 5, 2, 40, '2018-05-27 23:01:19', '2018-05-27 23:01:19'),
(15, 2, 8, 7, 5, 40, '2018-05-27 23:01:19', '2018-05-27 23:01:19'),
(16, 1, 8, 6, 2, 40, '2018-05-27 23:01:19', '2018-05-27 23:01:19'),
(28, 3, 5, 5, 2, 39, '2018-05-27 23:07:51', '2018-05-27 23:07:51'),
(29, 3, 8, 7, 2, 39, '2018-05-27 23:07:51', '2018-05-27 23:07:51'),
(30, 1, 7, 7, 5, 39, '2018-05-27 23:07:51', '2018-05-27 23:07:51'),
(33, 1, 8, 6, 2, 29, '2018-05-27 23:15:05', '2018-05-27 23:15:05'),
(34, 4, 7, 8, 5, 29, '2018-05-27 23:15:05', '2018-05-27 23:15:05'),
(35, 1, 5, 6, 4, 29, '2018-05-27 23:15:05', '2018-05-27 23:15:05'),
(42, 1, 8, 6, 2, 30, '2018-05-28 03:45:12', '2018-05-28 03:45:12'),
(44, 1, 5, 8, 5, 32, '2018-05-28 03:47:47', '2018-05-28 03:47:47'),
(45, 3, 8, 6, 2, 32, '2018-05-28 03:47:47', '2018-05-28 03:47:47'),
(47, 3, 8, 6, 4, 31, '2018-05-28 06:12:05', '2018-05-28 06:12:05'),
(53, 1, 8, 6, 2, 33, '2018-05-28 06:17:14', '2018-05-28 06:17:14'),
(54, 1, 8, 6, 4, 34, '2018-05-28 06:55:27', '2018-05-28 06:55:27'),
(56, 3, 7, 6, 4, 36, '2018-05-28 07:08:47', '2018-05-28 07:08:47'),
(58, 2, 6, 7, 3, 27, '2018-05-29 00:14:54', '2018-05-29 00:14:54'),
(59, 2, 5, 6, 5, 28, '2018-05-29 00:15:30', '2018-05-29 00:15:30'),
(60, 4, 7, 6, 4, 28, '2018-05-29 00:15:30', '2018-05-29 00:15:30'),
(70, 1, 5, 6, 2, 35, '2018-05-29 00:44:18', '2018-05-29 00:44:18'),
(71, 3, 5, 5, 2, 35, '2018-05-29 00:44:18', '2018-05-29 00:44:18'),
(72, 3, 8, 5, 3, 35, '2018-05-29 00:44:18', '2018-05-29 00:44:18'),
(80, 1, 7, 7, 2, 37, '2018-05-29 01:31:31', '2018-05-29 01:31:31'),
(81, 1, 7, 6, 2, 37, '2018-05-29 01:31:31', '2018-05-29 01:31:31'),
(83, 3, 8, 6, 2, 38, '2018-05-29 04:10:07', '2018-05-29 04:10:07'),
(84, 1, 8, 6, 2, 39, '2018-05-29 04:35:28', '2018-05-29 04:35:28'),
(85, 1, 7, 8, 5, 40, '2018-05-29 04:37:39', '2018-05-29 04:37:39'),
(86, 2, 7, 6, 4, 40, '2018-05-29 04:37:39', '2018-05-29 04:37:39'),
(87, 2, 8, 7, 5, 41, '2018-05-29 04:40:09', '2018-05-29 04:40:09'),
(88, 1, 8, 5, 2, 42, '2018-05-29 04:46:30', '2018-05-29 04:46:30'),
(89, 2, 7, 8, 3, 43, '2018-05-29 05:01:17', '2018-05-29 05:01:17'),
(92, 3, 6, 7, 5, 45, '2018-05-29 07:36:04', '2018-05-29 07:36:04'),
(94, 1, 5, 5, 3, 45, '2018-05-29 22:44:47', '2018-05-29 22:44:47'),
(97, 1, 6, 7, 4, 25, '2018-06-11 00:16:53', '2018-06-11 00:16:53'),
(98, 4, 8, 8, 2, 25, '2018-06-11 00:16:53', '2018-06-11 00:16:53'),
(100, 2, 8, 7, 4, 26, '2018-06-11 04:07:03', '2018-06-11 04:07:03'),
(104, 4, 7, 7, 2, 47, '2018-06-19 08:49:52', '2018-06-19 08:49:52'),
(105, 1, 8, 7, 4, 47, '2018-06-19 08:49:52', '2018-06-19 08:49:52'),
(106, 2, 7, 8, 4, 47, '2018-06-19 08:49:52', '2018-06-19 08:49:52'),
(107, 1, 5, 5, 3, 46, '2018-06-19 08:51:08', '2018-06-19 08:51:08'),
(108, 2, 5, 5, 3, 46, '2018-06-19 08:51:08', '2018-06-19 08:51:08'),
(109, 1, 8, 5, 3, 46, '2018-06-19 08:51:08', '2018-06-19 08:51:08'),
(111, 4, 7, 8, 2, 44, '2018-06-19 09:45:29', '2018-06-19 09:45:29'),
(112, 1, 5, 6, 3, 48, '2018-06-20 07:21:09', '2018-06-20 07:21:09'),
(113, 1, 5, 5, 3, 49, '2018-06-20 08:49:34', '2018-06-20 08:49:34'),
(114, 1, 5, 5, 2, 50, '2018-06-20 10:11:37', '2018-06-20 10:11:37'),
(115, 1, 5, 5, 3, 51, '2018-06-20 10:22:07', '2018-06-20 10:22:07'),
(116, 1, 5, 6, 2, 52, '2018-06-20 10:44:22', '2018-06-20 10:44:22'),
(117, 3, 7, 6, 2, 53, '2018-06-20 10:51:39', '2018-06-20 10:51:39'),
(118, 3, 6, 5, 2, 54, '2018-06-20 11:28:20', '2018-06-20 11:28:20'),
(119, 1, 5, 6, 3, 55, '2018-06-21 11:11:07', '2018-06-21 11:11:07'),
(120, 3, 5, 6, 4, 56, '2018-06-22 05:29:52', '2018-06-22 05:29:52'),
(121, 3, 7, 5, 2, 57, '2018-06-26 04:28:44', '2018-06-26 04:28:44'),
(122, 1, 5, 5, 2, 58, '2018-07-03 05:39:38', '2018-07-03 05:39:38'),
(123, 2, 6, 7, 5, 58, '2018-07-03 05:39:38', '2018-07-03 05:39:38'),
(124, 1, 5, 5, 2, 59, '2018-07-10 07:11:54', '2018-07-10 07:11:54'),
(125, 2, 6, 7, 5, 59, '2018-07-10 07:11:54', '2018-07-10 07:11:54'),
(126, 1, 5, 5, 2, 60, '2018-07-25 12:48:17', '2018-07-25 12:48:17'),
(128, 5, 12, 7, 3, 61, '2018-09-29 16:43:57', '2018-09-29 16:43:57'),
(129, 5, 12, 7, 3, 62, '2018-09-29 16:58:29', '2018-09-29 16:58:29'),
(130, 5, 12, 7, 4, 63, '2018-09-29 16:58:38', '2018-09-29 16:58:38'),
(131, 5, 12, 7, 3, 61, '2018-10-03 11:38:28', '2018-10-03 11:38:28'),
(132, 5, 12, 7, 3, 61, '2018-10-09 15:24:15', '2018-10-09 15:24:15'),
(133, 5, 12, 7, 2, 62, '2018-10-09 15:24:15', '2018-10-09 15:24:15'),
(134, 5, 12, 7, 4, 63, '2018-10-09 15:24:15', '2018-10-09 15:24:15'),
(135, 5, 12, 7, 5, 64, '2018-10-09 15:24:15', '2018-10-09 15:24:15'),
(136, 5, 12, 7, 3, 65, '2018-10-09 15:24:15', '2018-10-09 15:24:15'),
(137, 5, 12, 7, 3, 66, '2018-10-09 15:24:15', '2018-10-09 15:24:15'),
(138, 5, 12, 7, 3, 67, '2018-10-09 16:20:13', '2018-10-09 16:20:13'),
(139, 5, 12, 7, 2, 68, '2018-10-09 16:20:13', '2018-10-09 16:20:13'),
(140, 5, 12, 7, 4, 69, '2018-10-09 16:20:13', '2018-10-09 16:20:13'),
(141, 5, 12, 7, 5, 70, '2018-10-09 16:20:13', '2018-10-09 16:20:13'),
(142, 5, 12, 7, 3, 71, '2018-10-09 16:20:13', '2018-10-09 16:20:13'),
(143, 5, 12, 7, 3, 72, '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(144, 5, 12, 7, 2, 73, '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(145, 5, 12, 7, 4, 74, '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(146, 5, 12, 7, 5, 75, '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(147, 5, 12, 7, 3, 76, '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(148, 5, 12, 7, 3, 77, '2018-10-10 14:23:23', '2018-10-10 14:23:23'),
(149, 5, 5, 6, 3, 77, '2018-10-29 06:24:41', '2018-10-29 06:24:41'),
(150, 5, 5, 6, 3, 78, '2018-10-29 06:32:50', '2018-10-29 06:32:50'),
(151, 5, 5, 6, 3, 79, '2018-10-29 07:14:01', '2018-10-29 07:14:01'),
(152, 5, 5, 6, 3, 80, '2018-10-29 07:16:00', '2018-10-29 07:16:00'),
(153, 5, 5, 6, 3, 81, '2018-10-29 07:18:00', '2018-10-29 07:18:00'),
(154, 5, 5, 6, 3, 82, '2018-10-31 06:30:54', '2018-10-31 06:30:54'),
(155, 5, 5, 6, 3, 83, '2018-10-31 06:39:11', '2018-10-31 06:39:11'),
(156, 5, 5, 6, 3, 84, '2018-10-31 06:44:34', '2018-10-31 06:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `product_grading_reports`
--

CREATE TABLE `product_grading_reports` (
  `id` int(11) NOT NULL,
  `grading_report_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(48, 25, '8c956cfe7e6b8fe95fb1bce8376df6d93b619f95.jpg', '2018-05-17 01:17:46', '2018-05-17 01:17:46'),
(49, 25, '6ec85d34eef8c44515be896040f4d4a43be18ad7.png', '2018-05-17 01:17:46', '2018-05-17 01:17:46'),
(50, 26, '6b3ebf0bd7f85c7de2aa35f7151888c12b3c6798.png', '2018-05-17 01:21:13', '2018-05-17 01:21:13'),
(51, 26, 'c10a69db01cfaa210e125bf0571012e036654560.jpg', '2018-05-17 01:21:13', '2018-05-17 01:21:13'),
(52, 27, '934a5cbe744cae746a265b6f2969954c78f6ccf8.png', '2018-05-17 01:22:30', '2018-05-17 01:22:30'),
(53, 27, '2f1442432debc54cce8478797786c3399bdbe9da.png', '2018-05-17 01:22:30', '2018-05-17 01:22:30'),
(54, 27, '3eb538f2376228ae8a23523df535a6e840de2c19.png', '2018-05-17 01:22:30', '2018-05-17 01:22:30'),
(57, 28, '467e874a0063fd66b450c49a0d64520683dcf095.png', '2018-05-17 01:24:48', '2018-05-17 01:24:48'),
(58, 28, 'b0a125fdc3de512bb15b9aee168f51d29e5bf437.png', '2018-05-18 06:16:30', '2018-05-18 06:16:30'),
(59, 29, '1e12a3e71b8cfc4f9385fc0a698535f066a94f7e.jpg', '2018-05-19 05:13:30', '2018-05-19 05:13:30'),
(60, 29, 'ad17464c38df67a71a7783f7e56b8ad35df98875.jpg', '2018-05-19 05:13:30', '2018-05-19 05:13:30'),
(68, 37, '15384b114c525c6d504c0c13c1126c411441420f.jpg', '2018-05-29 00:46:24', '2018-05-29 00:46:24'),
(69, 38, 'fdae3bb193b1760a3ca5e8528c8c58937011feff.jpg', '2018-05-29 03:32:48', '2018-05-29 03:32:48'),
(74, 43, '72e992bf40214859b0a61bbb1808f0a99ee39602.jpg', '2018-05-29 05:01:17', '2018-05-29 05:01:17'),
(75, 43, '999de75f071c929416e33f9b47a7dffb20953a03.jpg', '2018-05-29 05:01:17', '2018-05-29 05:01:17'),
(76, 44, 'a5f73198b8a4cd7831ca20eaa1dc462df3cfb374.jpg', '2018-05-29 05:11:51', '2018-05-29 05:11:51'),
(77, 44, 'c630453dd844628c346f0952ec58df86860a2185.jpg', '2018-05-29 05:11:51', '2018-05-29 05:11:51'),
(78, 45, '870cd7bd5e299ae5a9f25a4373611a2dbaebc109.jpg', '2018-05-29 22:44:47', '2018-05-29 22:44:47'),
(79, 46, '71226544f98cccd433ff1b6f7a3a031c00e2cddf.jpg', '2018-06-19 08:46:40', '2018-06-19 08:46:40'),
(80, 46, '640700696b7563f39a9e29581f0d6f12de794bf7.jpg', '2018-06-19 08:46:40', '2018-06-19 08:46:40'),
(81, 46, '611bc6cd487542880aa14c042bfc3a5e54cb688a.jpg', '2018-06-19 08:46:40', '2018-06-19 08:46:40'),
(82, 47, 'f281edcd9309a971fbbb8a3442872a30cecd5da1.jpg', '2018-06-19 08:49:52', '2018-06-19 08:49:52'),
(83, 47, 'f2996cf50bff18b5dab09c1148d34ad565d9eac5.jpg', '2018-06-19 08:49:52', '2018-06-19 08:49:52'),
(84, 47, '17c142e4408ef3fbd7c21a8f1a9ebb7fa6b27f5d.jpg', '2018-06-19 08:49:52', '2018-06-19 08:49:52'),
(85, 48, 'adf01c63b17c23e8badfbb9dfaf3f1b29de898a1.jpg', '2018-06-20 07:21:09', '2018-06-20 07:21:09'),
(86, 48, 'f7b88104f3368ea705f986f1126d8aa145e04388.jpg', '2018-06-20 07:21:09', '2018-06-20 07:21:09'),
(87, 48, 'a2dbb6aada0a0557b73bab5df0345902b2234117.jpg', '2018-06-20 07:21:09', '2018-06-20 07:21:09'),
(88, 49, 'feae9d89437b2f9ac23208d622a35074957cf1f9.jpg', '2018-06-20 08:49:34', '2018-06-20 08:49:34'),
(89, 49, 'f7bdba6d4e179da881f3c7eeafddad9c7962afeb.jpg', '2018-06-20 08:49:34', '2018-06-20 08:49:34'),
(90, 49, 'b900c6c437f664382802137811e0aa1791f55aa6.jpg', '2018-06-20 08:49:34', '2018-06-20 08:49:34'),
(91, 49, '44b47ecc32427dd5fcc03fe6cf0b6ce50bc23110.jpg', '2018-06-20 08:49:34', '2018-06-20 08:49:34'),
(92, 50, '3e31322a2a830f544c66d63cc454a88ebb16a583.jpg', '2018-06-20 10:11:37', '2018-06-20 10:11:37'),
(93, 50, '06900cf53aae2805c78e10375d80e9d0f54aea4d.jpg', '2018-06-20 10:11:37', '2018-06-20 10:11:37'),
(94, 50, 'e01b85f838bcf6e610852ec064d94c91fc33f95f.jpg', '2018-06-20 10:11:37', '2018-06-20 10:11:37'),
(95, 51, 'b431a2682d363bbae3a4d56e7d0f51db6e7c4288.jpg', '2018-06-20 10:22:07', '2018-06-20 10:22:07'),
(96, 51, '9a19c6027092952d79a91f7d786406884cc59011.jpg', '2018-06-20 10:22:07', '2018-06-20 10:22:07'),
(97, 52, '75ea09ac1864a3b92f94e5074ca8c37861d25935.jpg', '2018-06-20 10:44:22', '2018-06-20 10:44:22'),
(98, 52, '167ac7245856ac08fc5dfca67cf09b2f3f4a07ad.jpg', '2018-06-20 10:44:22', '2018-06-20 10:44:22'),
(99, 52, '51b78ad8b3dcb3eeb09cc8f558260fe85e6cf547.jpg', '2018-06-20 10:44:22', '2018-06-20 10:44:22'),
(100, 53, 'a883c650cb07fc24e8b1e48924e1563a01e4db80.jpg', '2018-06-20 10:51:39', '2018-06-20 10:51:39'),
(101, 53, '183f3dbf216020c68bb29b355fb5dbae81ac9b2c.jpg', '2018-06-20 10:51:39', '2018-06-20 10:51:39'),
(102, 54, '38d3e0cda67e7c089ae189c7721d30d62e90a282.jpg', '2018-06-20 11:28:20', '2018-06-20 11:28:20'),
(103, 54, '8c326f8d4bbb54eff87bad120120fc6c8bf942ba.jpg', '2018-06-20 11:28:20', '2018-06-20 11:28:20'),
(104, 55, '5a9bb3b05eae8b66c00f71c4eea32de5a1b08cc4.jpg', '2018-06-21 11:11:07', '2018-06-21 11:11:07'),
(105, 56, '8ef5dee97d5eeb79b2a2025fd463637069dbd432.jpg', '2018-06-22 05:29:52', '2018-06-22 05:29:52'),
(106, 56, '1469a1fa159830e89c934a751546adca6f9f8487.jpg', '2018-06-22 05:29:52', '2018-06-22 05:29:52'),
(107, 57, 'dd7972fb262513089aeecef1d2503e9c73d62bdc.jpg', '2018-06-26 04:28:44', '2018-06-26 04:28:44'),
(108, 57, 'b243f1bfba300aa3bdad367e969432a77076083a.jpg', '2018-06-26 04:28:44', '2018-06-26 04:28:44'),
(111, 59, 'im45454545-122-image-1.jpg', '2018-07-10 07:11:54', '2018-07-10 07:11:54'),
(112, 59, 'non-scaled-image-width-1200.jpg', '2018-07-10 07:11:54', '2018-07-13 04:45:31'),
(113, 60, 'anc.jpg', '2018-07-25 12:48:17', '2018-07-25 12:48:17'),
(147, 72, 'ring1.jpeg', '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(148, 72, 'ring2.jpeg', '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(149, 72, 'ring3.jpeg', '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(150, 73, 'earring1.jpeg', '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(151, 73, 'earring2.jpeg', '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(152, 73, 'earring3.jpeg', '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(153, 74, 'necklace1.jpeg', '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(154, 74, 'necklace2.jpeg', '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(155, 74, 'necklace3.jpeg', '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(156, 75, 'bracelet1.jpeg', '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(157, 75, 'bracelet2.jpeg', '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(158, 75, 'bracelet3.jpeg', '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(159, 76, 'cufflink1.jpeg', '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(160, 76, 'cufflink2.jpeg', '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(161, 76, 'cufflink3.jpeg', '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(162, 77, 'va1008.jpg', '2018-10-29 06:24:40', '2018-10-29 06:24:40'),
(163, 78, 'va1009.jpg', '2018-10-29 06:32:50', '2018-10-29 06:32:50'),
(164, 79, 'va1010.jpg', '2018-10-29 07:14:00', '2018-10-29 07:14:00'),
(165, 80, 'va1011.jpg', '2018-10-29 07:16:00', '2018-10-29 07:16:00'),
(166, 81, 'va1012.jpg', '2018-10-29 07:18:00', '2018-10-29 07:18:00'),
(167, 82, 'va10111.jpg', '2018-10-31 06:30:54', '2018-10-31 06:30:54'),
(168, 83, 'VA101111.jpg', '2018-10-31 06:39:11', '2018-10-31 06:39:11'),
(169, 84, 'VA1011110.jpg', '2018-10-31 06:44:34', '2018-10-31 06:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `product_inclusion`
--

CREATE TABLE `product_inclusion` (
  `id` int(11) NOT NULL,
  `inclusion_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_key_to_symbols`
--

CREATE TABLE `product_key_to_symbols` (
  `id` int(11) NOT NULL,
  `key_to_symbol_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL COMMENT '1-Active, 0-Inactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_lines`
--

CREATE TABLE `product_lines` (
  `id` int(11) NOT NULL,
  `product_type` enum('1','2') NOT NULL COMMENT '1=classic, luxury',
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `product_line_name` varchar(255) NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_lines`
--

INSERT INTO `product_lines` (`id`, `product_type`, `category_id`, `sub_category_id`, `product_line_name`, `image`, `slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', 2, 1, 'Solitare Rings', NULL, 'solitare-rings-1', '1', '2018-05-14 01:06:23', '2018-10-03 16:06:51', NULL),
(2, '1', 2, 1, 'Bands', NULL, 'bands', '1', '2018-05-14 01:07:19', '2018-05-14 01:07:19', NULL),
(3, '1', 2, 1, 'Accent Rings', NULL, 'accent-rings', '1', '2018-05-14 01:07:45', '2018-05-14 01:07:45', NULL),
(4, '1', 2, 1, 'Three Stone or Side Stone Rings', NULL, 'three-stone-or-side-stone-rings', '1', '2018-05-14 01:08:07', '2018-05-14 01:08:07', NULL),
(5, '1', 2, 1, 'Others', NULL, 'others', '1', '2018-05-14 01:08:52', '2018-05-14 01:08:52', NULL),
(6, '1', 2, 3, 'Tennis Bracelet', NULL, 'tennis-bracelet-1', '1', '2018-05-14 01:09:34', '2018-10-03 16:14:48', NULL),
(7, '1', 2, 3, 'Bangles', NULL, 'bangles-1', '1', '2018-05-14 01:09:55', '2018-10-03 16:14:37', NULL),
(9, '1', 2, 3, 'Charm Bracelets', NULL, 'charm-bracelets-1', '1', '2018-05-14 01:11:50', '2018-10-03 16:14:10', NULL),
(10, '1', 2, 2, 'Others', NULL, 'others-1', '1', '2018-05-14 01:12:16', '2018-05-14 01:12:16', NULL),
(11, '1', 2, 2, 'Studs', NULL, 'studs-1', '1', '2018-05-14 01:13:21', '2018-10-03 16:13:49', NULL),
(12, '1', 2, 2, 'Drops', NULL, 'drops-1', '1', '2018-05-14 01:22:42', '2018-10-03 16:13:35', NULL),
(13, '1', 2, 2, 'Hoops', NULL, 'hoops-1', '1', '2018-05-14 01:23:00', '2018-10-03 16:13:19', NULL),
(14, '1', 2, 2, 'Chandbali', NULL, 'chandbali-1', '1', '2018-05-14 01:34:55', '2018-10-03 16:13:05', NULL),
(15, '1', 2, 2, 'Chandeliers', NULL, 'chandeliers', '1', '2018-05-14 01:35:18', '2018-10-03 17:34:41', NULL),
(16, '1', 2, 2, 'Jhumkas', NULL, 'jhumkas-1', '1', '2018-05-14 01:35:54', '2018-10-03 16:12:00', NULL),
(17, '1', 2, 3, 'Others', NULL, 'others-2', '1', '2018-05-14 01:36:15', '2018-05-14 01:36:15', NULL),
(18, '1', 2, 4, 'Choker', NULL, 'choker', '1', '2018-05-14 01:37:08', '2018-05-14 01:37:08', NULL),
(19, '1', 2, 4, 'Long Lines', NULL, 'long-lines', '1', '2018-05-14 01:37:25', '2018-05-14 01:37:25', NULL),
(20, '1', 2, 4, 'Round the Neck', NULL, 'round-the-neck', '1', '2018-05-14 01:37:50', '2018-05-14 01:37:50', NULL),
(21, '1', 2, 4, 'Others', NULL, 'others-3', '1', '2018-05-14 01:38:07', '2018-05-14 01:38:07', NULL),
(23, '1', 2, 5, 'Personalised Pendants', NULL, 'personalised-pendants', '1', '2018-05-14 01:38:51', '2018-05-14 01:38:51', NULL),
(24, '1', 2, 5, 'Solitare Pendants', NULL, 'solitare-pendants', '1', '2018-05-14 01:39:12', '2018-05-14 01:39:12', NULL),
(25, '1', 2, 5, 'Lockets', NULL, 'lockets', '1', '2018-05-14 01:39:33', '2018-05-14 01:39:33', NULL),
(26, '1', 2, 5, 'Others', NULL, 'others-4', '1', '2018-05-14 01:40:04', '2018-05-14 01:40:04', NULL),
(27, '1', 2, 6, 'Solitare Cufflinks', NULL, 'solitare-cufflinks', '1', '2018-05-14 01:40:33', '2018-05-14 01:40:33', NULL),
(28, '1', 2, 6, 'Personalised Cufflinks', NULL, 'personalised-cufflinks', '1', '2018-05-14 01:40:50', '2018-10-03 14:09:56', NULL),
(29, '1', 2, 2, 'Solitaire', '', 'solitaire', '1', '2018-10-15 18:43:44', '2018-10-15 18:43:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_measurements`
--

CREATE TABLE `product_measurements` (
  `id` int(11) NOT NULL,
  `measurement_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_metals`
--

CREATE TABLE `product_metals` (
  `id` int(11) NOT NULL,
  `metal_name_id` int(11) NOT NULL,
  `metal_color_id` int(11) NOT NULL,
  `metal_quality_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_metals`
--

INSERT INTO `product_metals` (`id`, `metal_name_id`, `metal_color_id`, `metal_quality_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 3, 32, '2018-05-25 04:36:49', '2018-05-25 04:36:49'),
(2, 3, 2, 5, 32, '2018-05-25 04:36:49', '2018-05-25 04:36:49'),
(4, 2, 3, 1, 34, '2018-05-25 05:29:40', '2018-05-25 05:29:40'),
(6, 3, 2, 5, 36, '2018-05-25 05:37:11', '2018-05-25 05:37:11'),
(13, 2, 4, 2, 40, '2018-05-27 23:01:19', '2018-05-27 23:01:19'),
(22, 1, 1, 3, 39, '2018-05-27 23:07:51', '2018-05-27 23:07:51'),
(25, 3, 4, 5, 29, '2018-05-27 23:15:05', '2018-05-27 23:15:05'),
(26, 3, 2, 5, 29, '2018-05-27 23:15:05', '2018-05-27 23:15:05'),
(33, 2, 4, 1, 30, '2018-05-28 03:45:12', '2018-05-28 03:45:12'),
(35, 4, 3, 2, 32, '2018-05-28 03:47:47', '2018-05-28 03:47:47'),
(36, 3, 2, 5, 32, '2018-05-28 03:47:47', '2018-05-28 03:47:47'),
(38, 4, 4, 1, 31, '2018-05-28 06:12:05', '2018-05-28 06:12:05'),
(49, 2, 4, 1, 33, '2018-05-28 06:17:14', '2018-05-28 06:17:14'),
(50, 2, 4, 1, 33, '2018-05-28 06:17:14', '2018-05-28 06:17:14'),
(51, 2, 2, 2, 34, '2018-05-28 06:55:27', '2018-05-28 06:55:27'),
(52, 4, 2, 5, 34, '2018-05-28 06:55:27', '2018-05-28 06:55:27'),
(54, 4, 4, 2, 36, '2018-05-28 07:08:47', '2018-05-28 07:08:47'),
(56, 4, 4, 5, 27, '2018-05-29 00:14:54', '2018-05-29 00:14:54'),
(57, 1, 2, 2, 28, '2018-05-29 00:15:29', '2018-05-29 00:15:29'),
(58, 4, 2, 1, 28, '2018-05-29 00:15:29', '2018-05-29 00:15:29'),
(65, 2, 3, 1, 35, '2018-05-29 00:44:18', '2018-05-29 00:44:18'),
(66, 2, 4, 2, 35, '2018-05-29 00:44:18', '2018-05-29 00:44:18'),
(75, 2, 4, 1, 37, '2018-05-29 01:31:31', '2018-05-29 01:31:31'),
(76, 3, 4, 5, 37, '2018-05-29 01:31:31', '2018-05-29 01:31:31'),
(79, 4, 3, 2, 38, '2018-05-29 04:10:07', '2018-05-29 04:10:07'),
(80, 2, 1, 2, 38, '2018-05-29 04:10:07', '2018-05-29 04:10:07'),
(81, 2, 4, 2, 39, '2018-05-29 04:35:28', '2018-05-29 04:35:28'),
(82, 3, 4, 5, 39, '2018-05-29 04:35:28', '2018-05-29 04:35:28'),
(83, 2, 4, 2, 40, '2018-05-29 04:37:39', '2018-05-29 04:37:39'),
(84, 2, 2, 5, 40, '2018-05-29 04:37:39', '2018-05-29 04:37:39'),
(85, 4, 2, 2, 41, '2018-05-29 04:40:09', '2018-05-29 04:40:09'),
(86, 4, 4, 2, 42, '2018-05-29 04:46:30', '2018-05-29 04:46:30'),
(87, 2, 4, 5, 42, '2018-05-29 04:46:30', '2018-05-29 04:46:30'),
(88, 2, 4, 2, 43, '2018-05-29 05:01:17', '2018-05-29 05:01:17'),
(93, 2, 4, 1, 45, '2018-05-29 07:36:04', '2018-05-29 07:36:04'),
(96, 4, 3, 1, 45, '2018-05-29 22:44:47', '2018-05-29 22:44:47'),
(101, 2, 1, 5, 25, '2018-06-11 00:16:53', '2018-06-11 00:16:53'),
(102, 4, 2, 2, 25, '2018-06-11 00:16:53', '2018-06-11 00:16:53'),
(104, 3, 2, 5, 26, '2018-06-11 04:07:03', '2018-06-11 04:07:03'),
(107, 4, 3, 2, 47, '2018-06-19 08:49:52', '2018-06-19 08:49:52'),
(108, 3, 3, 1, 47, '2018-06-19 08:49:52', '2018-06-19 08:49:52'),
(109, 2, 3, 1, 46, '2018-06-19 08:51:08', '2018-06-19 08:51:08'),
(110, 2, 4, 2, 46, '2018-06-19 08:51:08', '2018-06-19 08:51:08'),
(113, 2, 3, 2, 44, '2018-06-19 09:45:29', '2018-06-19 09:45:29'),
(114, 2, 3, 2, 44, '2018-06-19 09:45:29', '2018-06-19 09:45:29'),
(115, 4, 2, 1, 48, '2018-06-20 07:21:09', '2018-06-20 07:21:09'),
(116, 4, 2, 2, 48, '2018-06-20 07:21:09', '2018-06-20 07:21:09'),
(117, 2, 3, 1, 49, '2018-06-20 08:49:34', '2018-06-20 08:49:34'),
(118, 2, 4, 2, 49, '2018-06-20 08:49:34', '2018-06-20 08:49:34'),
(119, 2, 3, 1, 50, '2018-06-20 10:11:37', '2018-06-20 10:11:37'),
(120, 4, 3, 1, 50, '2018-06-20 10:11:37', '2018-06-20 10:11:37'),
(121, 4, 4, 1, 51, '2018-06-20 10:22:07', '2018-06-20 10:22:07'),
(122, 2, 3, 1, 51, '2018-06-20 10:22:07', '2018-06-20 10:22:07'),
(123, 2, 3, 1, 52, '2018-06-20 10:44:22', '2018-06-20 10:44:22'),
(124, 2, 3, 1, 52, '2018-06-20 10:44:22', '2018-06-20 10:44:22'),
(125, 2, 3, 1, 53, '2018-06-20 10:51:39', '2018-06-20 10:51:39'),
(126, 2, 3, 1, 53, '2018-06-20 10:51:39', '2018-06-20 10:51:39'),
(127, 2, 3, 2, 54, '2018-06-20 11:28:20', '2018-06-20 11:28:20'),
(128, 2, 3, 1, 55, '2018-06-21 11:11:07', '2018-06-21 11:11:07'),
(129, 2, 3, 1, 55, '2018-06-21 11:11:07', '2018-06-21 11:11:07'),
(130, 2, 4, 2, 56, '2018-06-22 05:29:52', '2018-06-22 05:29:52'),
(131, 2, 4, 5, 57, '2018-06-26 04:28:44', '2018-06-26 04:28:44'),
(132, 1, 1, 1, 58, '2018-07-03 05:39:38', '2018-07-03 05:39:38'),
(133, 2, 3, 3, 58, '2018-07-03 05:39:38', '2018-07-03 05:39:38'),
(134, 1, 1, 1, 59, '2018-07-10 07:11:54', '2018-07-10 07:11:54'),
(135, 2, 3, 3, 59, '2018-07-10 07:11:54', '2018-07-10 07:11:54'),
(136, 1, 4, 3, 60, '2018-07-25 12:48:17', '2018-07-25 12:48:17'),
(138, 2, 2, 1, 61, '2018-09-29 16:43:57', '2018-09-29 16:43:57'),
(139, 2, 2, 1, 62, '2018-09-29 16:58:29', '2018-09-29 16:58:29'),
(140, 1, 2, 5, 63, '2018-09-29 16:58:38', '2018-09-29 16:58:38'),
(141, 2, 2, 1, 61, '2018-10-03 11:38:28', '2018-10-03 11:38:28'),
(142, 2, 2, 1, 61, '2018-10-09 15:24:15', '2018-10-09 15:24:15'),
(143, 2, 1, 2, 62, '2018-10-09 15:24:15', '2018-10-09 15:24:15'),
(144, 1, 2, 2, 63, '2018-10-09 15:24:15', '2018-10-09 15:24:15'),
(145, 2, 2, 5, 64, '2018-10-09 15:24:15', '2018-10-09 15:24:15'),
(146, 2, 2, 1, 65, '2018-10-09 15:24:15', '2018-10-09 15:24:15'),
(147, 2, 2, 1, 66, '2018-10-09 15:24:15', '2018-10-09 15:24:15'),
(148, 2, 2, 1, 67, '2018-10-09 16:20:13', '2018-10-09 16:20:13'),
(149, 2, 1, 2, 68, '2018-10-09 16:20:13', '2018-10-09 16:20:13'),
(150, 1, 2, 2, 69, '2018-10-09 16:20:13', '2018-10-09 16:20:13'),
(151, 2, 2, 5, 70, '2018-10-09 16:20:13', '2018-10-09 16:20:13'),
(152, 2, 2, 1, 71, '2018-10-09 16:20:13', '2018-10-09 16:20:13'),
(153, 2, 2, 1, 72, '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(154, 2, 1, 2, 73, '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(155, 1, 2, 2, 74, '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(156, 2, 2, 5, 75, '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(157, 2, 2, 1, 76, '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(158, 2, 2, 1, 77, '2018-10-10 14:23:23', '2018-10-10 14:23:23'),
(159, 2, 2, 2, 77, '2018-10-29 06:24:41', '2018-10-29 06:24:41'),
(160, 2, 2, 2, 78, '2018-10-29 06:32:50', '2018-10-29 06:32:50'),
(161, 2, 2, 2, 79, '2018-10-29 07:14:01', '2018-10-29 07:14:01'),
(162, 2, 2, 2, 80, '2018-10-29 07:16:00', '2018-10-29 07:16:00'),
(163, 2, 2, 2, 81, '2018-10-29 07:18:00', '2018-10-29 07:18:00'),
(164, 2, 2, 2, 82, '2018-10-31 06:30:54', '2018-10-31 06:30:54'),
(165, 2, 2, 2, 83, '2018-10-31 06:39:11', '2018-10-31 06:39:11'),
(166, 2, 2, 2, 84, '2018-10-31 06:44:34', '2018-10-31 06:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `product_occasions`
--

CREATE TABLE `product_occasions` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `occasion_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_occasions`
--

INSERT INTO `product_occasions` (`id`, `product_id`, `occasion_id`, `created_at`, `updated_at`) VALUES
(238, 29, 7, '2018-05-27 23:15:05', '2018-05-27 23:15:05'),
(239, 29, 3, '2018-05-27 23:15:05', '2018-05-27 23:15:05'),
(240, 29, 4, '2018-05-27 23:15:05', '2018-05-27 23:15:05'),
(266, 27, 4, '2018-05-29 00:14:53', '2018-05-29 00:14:53'),
(267, 27, 5, '2018-05-29 00:14:53', '2018-05-29 00:14:53'),
(268, 28, 4, '2018-05-29 00:15:29', '2018-05-29 00:15:29'),
(269, 28, 5, '2018-05-29 00:15:29', '2018-05-29 00:15:29'),
(282, 37, 1, '2018-05-29 01:31:30', '2018-05-29 01:31:30'),
(283, 37, 2, '2018-05-29 01:31:30', '2018-05-29 01:31:30'),
(285, 38, 2, '2018-05-29 04:10:07', '2018-05-29 04:10:07'),
(288, 41, 1, '2018-05-29 04:40:09', '2018-05-29 04:40:09'),
(290, 43, 1, '2018-05-29 05:01:17', '2018-05-29 05:01:17'),
(291, 43, 7, '2018-05-29 05:01:17', '2018-05-29 05:01:17'),
(292, 43, 3, '2018-05-29 05:01:17', '2018-05-29 05:01:17'),
(300, 45, 1, '2018-05-29 22:44:47', '2018-05-29 22:44:47'),
(305, 25, 4, '2018-06-11 00:16:53', '2018-06-11 00:16:53'),
(306, 25, 5, '2018-06-11 00:16:53', '2018-06-11 00:16:53'),
(309, 26, 4, '2018-06-11 04:07:03', '2018-06-11 04:07:03'),
(310, 26, 5, '2018-06-11 04:07:03', '2018-06-11 04:07:03'),
(312, 47, 1, '2018-06-19 08:49:52', '2018-06-19 08:49:52'),
(313, 47, 2, '2018-06-19 08:49:52', '2018-06-19 08:49:52'),
(314, 46, 1, '2018-06-19 08:51:08', '2018-06-19 08:51:08'),
(317, 44, 1, '2018-06-19 09:45:29', '2018-06-19 09:45:29'),
(318, 44, 7, '2018-06-19 09:45:29', '2018-06-19 09:45:29'),
(319, 48, 1, '2018-06-20 07:21:09', '2018-06-20 07:21:09'),
(320, 49, 1, '2018-06-20 08:49:34', '2018-06-20 08:49:34'),
(321, 49, 2, '2018-06-20 08:49:34', '2018-06-20 08:49:34'),
(322, 50, 1, '2018-06-20 10:11:37', '2018-06-20 10:11:37'),
(323, 51, 1, '2018-06-20 10:22:07', '2018-06-20 10:22:07'),
(324, 52, 1, '2018-06-20 10:44:22', '2018-06-20 10:44:22'),
(325, 53, 1, '2018-06-20 10:51:39', '2018-06-20 10:51:39'),
(326, 54, 2, '2018-06-20 11:28:20', '2018-06-20 11:28:20'),
(327, 55, 1, '2018-06-21 11:11:07', '2018-06-21 11:11:07'),
(328, 56, 1, '2018-06-22 05:29:52', '2018-06-22 05:29:52'),
(329, 57, 2, '2018-06-26 04:28:44', '2018-06-26 04:28:44'),
(332, 59, 1, '2018-07-10 07:11:54', '2018-07-10 07:11:54'),
(333, 59, 2, '2018-07-10 07:11:54', '2018-07-10 07:11:54'),
(334, 60, 1, '2018-07-25 12:48:17', '2018-07-25 12:48:17'),
(346, 72, 1, '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(347, 73, 4, '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(348, 74, 4, '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(349, 75, 6, '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(350, 76, 2, '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(351, 77, 4, '2018-10-29 06:24:40', '2018-10-29 06:24:40'),
(352, 78, 4, '2018-10-29 06:32:50', '2018-10-29 06:32:50'),
(353, 79, 4, '2018-10-29 07:14:00', '2018-10-29 07:14:00'),
(354, 80, 4, '2018-10-29 07:16:00', '2018-10-29 07:16:00'),
(355, 81, 4, '2018-10-29 07:18:00', '2018-10-29 07:18:00'),
(356, 82, 4, '2018-10-31 06:30:54', '2018-10-31 06:30:54'),
(357, 83, 4, '2018-10-31 06:39:11', '2018-10-31 06:39:11'),
(358, 84, 4, '2018-10-31 06:44:34', '2018-10-31 06:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `product_quantities`
--

CREATE TABLE `product_quantities` (
  `id` int(11) NOT NULL,
  `quantity_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `size_name`, `created_at`, `updated_at`) VALUES
(23, 24, '2', '2018-05-17 00:54:52', '2018-05-17 00:54:52'),
(24, 24, '3', '2018-05-17 00:54:52', '2018-05-17 00:54:52'),
(27, 23, '4', '2018-05-17 01:08:44', '2018-05-17 01:08:44'),
(28, 23, '2', '2018-05-17 01:08:44', '2018-05-17 01:08:44'),
(95, 34, '2', '2018-05-24 05:02:43', '2018-05-24 05:02:43'),
(96, 34, '4', '2018-05-24 05:02:43', '2018-05-24 05:02:43'),
(97, 34, '6', '2018-05-24 05:02:43', '2018-05-24 05:02:43'),
(98, 34, '8', '2018-05-24 05:02:43', '2018-05-24 05:02:43'),
(99, 34, '10', '2018-05-24 05:02:43', '2018-05-24 05:02:43'),
(100, 34, '12', '2018-05-24 05:02:43', '2018-05-24 05:02:43'),
(101, 34, '14', '2018-05-24 05:02:43', '2018-05-24 05:02:43'),
(102, 34, '16', '2018-05-24 05:02:43', '2018-05-24 05:02:43'),
(103, 34, '18', '2018-05-24 05:02:43', '2018-05-24 05:02:43'),
(104, 34, '20', '2018-05-24 05:02:43', '2018-05-24 05:02:43'),
(105, 34, '22', '2018-05-24 05:02:43', '2018-05-24 05:02:43'),
(106, 34, '24', '2018-05-24 05:02:43', '2018-05-24 05:02:43'),
(107, 34, '26', '2018-05-24 05:02:44', '2018-05-24 05:02:44'),
(108, 34, '28', '2018-05-24 05:02:44', '2018-05-24 05:02:44'),
(109, 34, '30', '2018-05-24 05:02:44', '2018-05-24 05:02:44'),
(110, 34, '32', '2018-05-24 05:02:44', '2018-05-24 05:02:44'),
(111, 34, '34', '2018-05-24 05:02:44', '2018-05-24 05:02:44'),
(112, 34, '36', '2018-05-24 05:02:44', '2018-05-24 05:02:44'),
(113, 34, '38', '2018-05-24 05:02:44', '2018-05-24 05:02:44'),
(114, 34, '40', '2018-05-24 05:02:44', '2018-05-24 05:02:44'),
(115, 34, '42', '2018-05-24 05:02:44', '2018-05-24 05:02:44'),
(126, 27, '2', '2018-05-29 00:14:54', '2018-05-29 00:14:54'),
(127, 28, '2', '2018-05-29 00:15:30', '2018-05-29 00:15:30'),
(128, 25, '2', '2018-06-11 00:16:54', '2018-06-11 00:16:54'),
(129, 25, '4', '2018-06-11 00:16:54', '2018-06-11 00:16:54'),
(130, 25, '5', '2018-06-11 00:16:54', '2018-06-11 00:16:54'),
(132, 26, '2', '2018-06-11 04:07:03', '2018-06-11 04:07:03'),
(133, 44, '2.5', '2018-06-19 09:45:29', '2018-06-19 09:45:29'),
(134, 48, '2.5', '2018-06-20 07:21:09', '2018-06-20 07:21:09'),
(135, 49, '2.5', '2018-06-20 08:49:34', '2018-06-20 08:49:34'),
(136, 50, '2.5', '2018-06-20 10:11:37', '2018-06-20 10:11:37'),
(137, 51, '2.5', '2018-06-20 10:22:07', '2018-06-20 10:22:07'),
(138, 52, '2.5', '2018-06-20 10:44:22', '2018-06-20 10:44:22'),
(139, 53, '2.5', '2018-06-20 10:51:39', '2018-06-20 10:51:39'),
(140, 58, '1', '2018-07-03 05:39:38', '2018-07-03 05:39:38'),
(141, 58, '2', '2018-07-03 05:39:38', '2018-07-03 05:39:38'),
(142, 58, '3', '2018-07-03 05:39:38', '2018-07-03 05:39:38'),
(143, 59, '1', '2018-07-10 07:11:54', '2018-07-10 07:11:54'),
(144, 59, '2', '2018-07-10 07:11:54', '2018-07-10 07:11:54'),
(145, 59, '3', '2018-07-10 07:11:54', '2018-07-10 07:11:54'),
(146, 60, '1', '2018-07-25 12:48:17', '2018-07-25 12:48:17'),
(147, 60, '2', '2018-07-25 12:48:17', '2018-07-25 12:48:17'),
(148, 60, '3', '2018-07-25 12:48:17', '2018-07-25 12:48:17'),
(153, 61, '1', '2018-09-29 16:43:57', '2018-09-29 16:43:57'),
(154, 61, '2', '2018-09-29 16:43:57', '2018-09-29 16:43:57'),
(155, 61, '3', '2018-09-29 16:43:57', '2018-09-29 16:43:57'),
(156, 61, '4', '2018-09-29 16:43:57', '2018-09-29 16:43:57'),
(157, 62, '1', '2018-09-29 16:58:29', '2018-09-29 16:58:29'),
(158, 62, ' 2', '2018-09-29 16:58:29', '2018-09-29 16:58:29'),
(159, 62, ' 3', '2018-09-29 16:58:29', '2018-09-29 16:58:29'),
(160, 62, ' 4', '2018-09-29 16:58:29', '2018-09-29 16:58:29'),
(161, 63, '3', '2018-09-29 16:58:38', '2018-09-29 16:58:38'),
(162, 61, '1', '2018-10-03 11:38:28', '2018-10-03 11:38:28'),
(163, 61, ' 2', '2018-10-03 11:38:28', '2018-10-03 11:38:28'),
(164, 61, ' 3', '2018-10-03 11:38:28', '2018-10-03 11:38:28'),
(165, 61, ' 4', '2018-10-03 11:38:28', '2018-10-03 11:38:28'),
(166, 61, '1', '2018-10-09 15:24:15', '2018-10-09 15:24:15'),
(167, 61, ' 2', '2018-10-09 15:24:15', '2018-10-09 15:24:15'),
(168, 61, ' 3', '2018-10-09 15:24:15', '2018-10-09 15:24:15'),
(169, 61, ' 4', '2018-10-09 15:24:15', '2018-10-09 15:24:15'),
(170, 62, '2', '2018-10-09 15:24:15', '2018-10-09 15:24:15'),
(171, 63, '3', '2018-10-09 15:24:15', '2018-10-09 15:24:15'),
(172, 64, '4', '2018-10-09 15:24:15', '2018-10-09 15:24:15'),
(173, 65, '5', '2018-10-09 15:24:15', '2018-10-09 15:24:15'),
(174, 66, '6', '2018-10-09 15:24:15', '2018-10-09 15:24:15'),
(175, 67, '1', '2018-10-09 16:20:13', '2018-10-09 16:20:13'),
(176, 67, ' 2', '2018-10-09 16:20:13', '2018-10-09 16:20:13'),
(177, 67, ' 3', '2018-10-09 16:20:13', '2018-10-09 16:20:13'),
(178, 67, ' 4', '2018-10-09 16:20:13', '2018-10-09 16:20:13'),
(179, 68, '2', '2018-10-09 16:20:13', '2018-10-09 16:20:13'),
(180, 69, '3', '2018-10-09 16:20:13', '2018-10-09 16:20:13'),
(181, 70, '4', '2018-10-09 16:20:13', '2018-10-09 16:20:13'),
(182, 71, '5', '2018-10-09 16:20:13', '2018-10-09 16:20:13'),
(183, 72, '1', '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(184, 72, ' 2', '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(185, 72, ' 3', '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(186, 72, ' 4', '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(187, 73, '2', '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(188, 74, '3', '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(189, 75, '4', '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(190, 76, '5', '2018-10-09 20:36:47', '2018-10-09 20:36:47'),
(191, 77, '1', '2018-10-10 14:23:23', '2018-10-10 14:23:23'),
(192, 77, ' 2', '2018-10-10 14:23:23', '2018-10-10 14:23:23'),
(193, 77, ' 3', '2018-10-10 14:23:23', '2018-10-10 14:23:23'),
(194, 77, ' 4', '2018-10-10 14:23:23', '2018-10-10 14:23:23');

-- --------------------------------------------------------

--
-- Table structure for table `product_views`
--

CREATE TABLE `product_views` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_views`
--

INSERT INTO `product_views` (`id`, `product_id`, `ip`, `created_at`, `updated_at`) VALUES
(1, 25, '192.168.1.53', '2018-06-11 00:10:01', '2018-06-11 00:10:01'),
(2, 28, '192.168.1.53', '2018-06-11 01:11:12', '2018-06-11 01:11:12'),
(3, 26, '192.168.1.53', '2018-06-11 01:38:26', '2018-06-11 01:38:26'),
(4, 27, '192.168.1.53', '2018-06-11 01:39:18', '2018-06-11 01:39:18'),
(5, 43, '192.168.1.53', '2018-06-11 01:40:48', '2018-06-11 01:40:48'),
(6, 26, '192.168.1.7', '2018-06-11 01:52:55', '2018-06-11 01:52:55'),
(7, 26, '192.168.1.59', '2018-06-11 01:53:36', '2018-06-11 01:53:36'),
(8, 26, '192.168.1.60', '2018-06-11 01:54:06', '2018-06-11 01:54:06'),
(9, 26, '192.168.1.60', '2018-06-11 01:54:06', '2018-06-11 01:54:06'),
(10, 26, '192.168.1.60', '2018-06-11 01:54:06', '2018-06-11 01:54:06'),
(11, 26, '192.168.1.60', '2018-06-11 01:54:06', '2018-06-11 01:54:06'),
(12, 26, '192.168.1.60', '2018-06-11 01:54:06', '2018-06-11 01:54:06'),
(13, 26, '192.168.1.60', '2018-06-11 01:54:06', '2018-06-11 01:54:06'),
(14, 26, '192.168.1.53', '2018-06-11 01:38:26', '2018-06-11 01:38:26'),
(15, 25, '192.168.1.53', '2018-06-11 00:10:01', '2018-06-11 00:10:01'),
(16, 26, '192.168.1.7', '2018-06-11 01:52:55', '2018-06-11 01:52:55'),
(17, 25, '192.168.1.53', '2018-06-11 00:10:01', '2018-06-11 00:10:01'),
(18, 28, '192.168.1.53', '2018-06-11 01:11:12', '2018-06-11 01:11:12'),
(19, 27, '192.168.1.53', '2018-06-11 01:39:18', '2018-06-11 01:39:18'),
(20, 43, '192.168.1.53', '2018-06-11 01:40:48', '2018-06-11 01:40:48'),
(21, 43, '192.168.1.53', '2018-06-11 01:40:48', '2018-06-11 01:40:48'),
(22, 43, '192.168.1.53', '2018-06-11 01:40:48', '2018-06-11 01:40:48'),
(23, 43, '192.168.1.53', '2018-06-11 01:40:48', '2018-06-11 01:40:48'),
(24, 27, '192.168.1.55', '2018-06-11 05:31:11', '2018-06-11 05:31:11'),
(25, 25, '192.168.1.59', '2018-06-11 05:57:46', '2018-06-11 05:57:46'),
(26, 25, '103.69.226.62', '2018-06-18 06:28:03', '2018-06-18 06:28:03'),
(27, 43, '103.69.226.62', '2018-06-18 09:06:40', '2018-06-18 09:06:40'),
(28, 26, '103.69.226.62', '2018-06-18 09:09:57', '2018-06-18 09:09:57'),
(29, 28, '103.69.226.62', '2018-06-18 09:16:31', '2018-06-18 09:16:31'),
(30, 46, '103.69.226.62', '2018-06-19 09:04:11', '2018-06-19 09:04:11'),
(31, 47, '103.69.226.62', '2018-06-19 09:24:49', '2018-06-19 09:24:49'),
(32, 27, '103.69.226.62', '2018-06-20 05:54:54', '2018-06-20 05:54:54'),
(33, 48, '103.69.226.62', '2018-06-20 07:24:19', '2018-06-20 07:24:19'),
(34, 49, '103.69.226.62', '2018-06-20 09:02:48', '2018-06-20 09:02:48'),
(35, 51, '103.69.226.62', '2018-06-20 10:22:51', '2018-06-20 10:22:51'),
(36, 52, '103.69.226.62', '2018-06-20 11:06:42', '2018-06-20 11:06:42'),
(37, 54, '103.69.226.62', '2018-06-20 17:18:26', '2018-06-20 17:18:26'),
(38, 45, '103.69.226.62', '2018-06-21 10:02:44', '2018-06-21 10:02:44'),
(39, 53, '103.69.226.62', '2018-06-21 11:04:08', '2018-06-21 11:04:08'),
(40, 44, '103.69.226.62', '2018-06-21 11:06:10', '2018-06-21 11:06:10'),
(41, 54, '::1', '2018-06-21 12:01:10', '2018-06-21 12:01:10'),
(42, 25, '::1', '2018-06-22 04:08:05', '2018-06-22 04:08:05'),
(43, 44, '::1', '2018-06-22 04:29:40', '2018-06-22 04:29:40'),
(44, 27, '::1', '2018-06-22 05:18:41', '2018-06-22 05:18:41'),
(45, 43, '::1', '2018-06-22 05:51:52', '2018-06-22 05:51:52'),
(46, 46, '192.168.1.53', '2018-06-22 12:34:56', '2018-06-22 12:34:56'),
(47, 46, '::1', '2018-06-22 14:16:32', '2018-06-22 14:16:32'),
(48, 57, '192.168.1.153', '2018-06-26 04:29:16', '2018-06-26 04:29:16'),
(49, 57, '::1', '2018-06-26 04:30:03', '2018-06-26 04:30:03'),
(50, 25, '192.168.1.55', '2018-06-26 05:17:31', '2018-06-26 05:17:31'),
(51, 25, '192.168.1.153', '2018-06-27 04:45:51', '2018-06-27 04:45:51'),
(52, 27, '192.168.1.153', '2018-06-27 04:46:21', '2018-06-27 04:46:21'),
(53, 28, '192.168.1.59', '2018-08-10 10:01:59', '2018-08-10 10:01:59'),
(54, 45, '103.69.225.247', '2018-08-20 15:36:46', '2018-08-20 15:36:46'),
(55, 49, '216.74.245.26', '2018-08-28 04:26:35', '2018-08-28 04:26:35'),
(56, 25, '216.74.245.26', '2018-08-28 04:27:28', '2018-08-28 04:27:28'),
(57, 25, '42.106.216.32', '2018-09-20 12:50:11', '2018-09-20 12:50:11'),
(58, 25, '182.70.37.33', '2018-09-20 14:47:16', '2018-09-20 14:47:16'),
(59, 27, '121.46.95.98', '2018-09-24 18:56:38', '2018-09-24 18:56:38'),
(60, 49, '121.46.95.98', '2018-09-24 18:56:59', '2018-09-24 18:56:59'),
(61, 54, '49.36.1.58', '2018-09-29 16:29:34', '2018-09-29 16:29:34'),
(62, 61, '49.36.1.58', '2018-09-29 16:30:56', '2018-09-29 16:30:56'),
(63, 49, '49.36.1.58', '2018-09-29 16:45:59', '2018-09-29 16:45:59'),
(64, 62, '49.36.1.58', '2018-09-29 17:00:24', '2018-09-29 17:00:24'),
(65, 63, '49.36.1.58', '2018-09-29 17:00:34', '2018-09-29 17:00:34'),
(66, 25, '49.36.1.58', '2018-09-29 17:14:52', '2018-09-29 17:14:52'),
(67, 25, '223.229.140.119', '2018-10-01 14:33:36', '2018-10-01 14:33:36'),
(68, 25, '223.229.128.148', '2018-10-03 14:22:37', '2018-10-03 14:22:37'),
(69, 48, '1.186.237.179', '2018-10-03 15:47:10', '2018-10-03 15:47:10'),
(70, 43, '1.186.237.179', '2018-10-03 15:48:42', '2018-10-03 15:48:42'),
(71, 52, '1.186.237.179', '2018-10-03 15:48:50', '2018-10-03 15:48:50'),
(72, 55, '1.186.237.179', '2018-10-03 15:48:55', '2018-10-03 15:48:55'),
(73, 44, '1.186.237.179', '2018-10-03 15:49:09', '2018-10-03 15:49:09'),
(74, 53, '1.186.237.179', '2018-10-03 15:49:20', '2018-10-03 15:49:20'),
(75, 25, '182.70.38.44', '2018-10-04 12:14:42', '2018-10-04 12:14:42'),
(76, 25, '110.227.199.1', '2018-10-08 13:44:46', '2018-10-08 13:44:46'),
(77, 72, '49.36.1.198', '2018-10-09 20:41:23', '2018-10-09 20:41:23'),
(78, 25, '49.36.1.198', '2018-10-09 20:43:09', '2018-10-09 20:43:09'),
(79, 27, '49.36.1.198', '2018-10-09 20:45:04', '2018-10-09 20:45:04'),
(80, 27, '182.70.38.44', '2018-10-10 12:12:39', '2018-10-10 12:12:39'),
(81, 72, '182.70.38.44', '2018-10-10 12:12:59', '2018-10-10 12:12:59'),
(82, 72, '1.186.248.34', '2018-10-10 12:15:25', '2018-10-10 12:15:25'),
(83, 57, '1.186.248.34', '2018-10-10 12:15:55', '2018-10-10 12:15:55'),
(84, 72, '121.46.95.98', '2018-10-10 12:37:36', '2018-10-10 12:37:36'),
(85, 25, '121.46.95.98', '2018-10-10 14:28:52', '2018-10-10 14:28:52'),
(86, 57, '121.46.95.98', '2018-10-10 14:30:08', '2018-10-10 14:30:08'),
(87, 57, '192.168.1.55', '2018-10-20 10:09:06', '2018-10-20 10:09:06'),
(88, 82, '192.168.1.53', '2018-10-31 06:34:25', '2018-10-31 06:34:25'),
(89, 83, '192.168.1.53', '2018-10-31 06:40:36', '2018-10-31 06:40:36'),
(90, 84, '192.168.1.53', '2018-10-31 06:44:49', '2018-10-31 06:44:49');

-- --------------------------------------------------------

--
-- Table structure for table `replacement_product_request`
--

CREATE TABLE `replacement_product_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL COMMENT 'order_id of orders tbl',
  `order_product_id` int(11) NOT NULL COMMENT 'id of  order_product tbl',
  `user_wallet_id` int(11) NOT NULL DEFAULT '0',
  `usd_value` float(20,2) NOT NULL DEFAULT '0.00',
  `reason` varchar(100) NOT NULL,
  `delivery_method` varchar(100) NOT NULL,
  `mobile_number` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `status` enum('1','2','3','4','5') NOT NULL COMMENT '1-requested,2-request accepted,3-request rejected,4-product accepted and return amount,5-product rejected',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `replacement_product_request`
--

INSERT INTO `replacement_product_request` (`id`, `user_id`, `product_id`, `order_id`, `order_product_id`, `user_wallet_id`, `usd_value`, `reason`, `delivery_method`, `mobile_number`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 13, 52, 'AM-1529493448', 5, 18, 69.00, 'Defective', 'Amaaia Pickup', '+919922276924', 'dffs', '4', '2018-06-20 18:17:41', '2018-06-20 18:18:40'),
(2, 13, 28, 'AM-1529566029', 25, 24, 69.00, 'Damaged', 'Amaaia Pickup', '+919921840141', 'it should display the completed spellings currently, display the complete currently, display the', '4', '2018-06-21 18:52:52', '2018-06-21 19:07:30'),
(3, 13, 26, 'AM-1529501131', 9, 25, 69.00, 'Defective', 'Amaaia Pickup', '+919921840141', 'it should display the completed', '4', '2018-06-21 19:11:35', '2018-06-21 19:21:34'),
(4, 1, 25, 'AM-1529576977', 34, 1, 69.00, 'Defective', 'Amaaia Pickup', '+919922276924', 'sdjfksdf krewjkwrj rkwjkr ewkjrew rejwkrejwk rewkj rewkrjewk rwejkrjwekrj ewkksdfj skfj sfkfj kfsk ksfjks k', '2', '2018-06-21 12:22:26', '2018-06-21 12:35:43'),
(5, 1, 44, 'AM-1529646985', 46, 0, 69.00, 'Defective', 'Amaaia Pickup', '+9189898998', 'dsd ddskj klsd dskljsdksdlsd', '5', '2018-06-22 13:38:31', '2018-06-22 13:57:31'),
(6, 1, 27, 'AM-1529646743', 43, 0, 69.00, 'Defective', 'Self Shipment', '+9948989898989', 'dsf sdfks fjkf jksfjksjfk sdjfskd fsjkdfjks fjsdk', '1', '2018-06-22 13:45:50', '2018-06-22 13:45:50');

-- --------------------------------------------------------

--
-- Table structure for table `return_product_request`
--

CREATE TABLE `return_product_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL COMMENT 'order_id of orders tbl',
  `order_product_id` int(11) NOT NULL COMMENT 'id of  order_product tbl',
  `user_wallet_id` int(11) NOT NULL DEFAULT '0',
  `usd_value` float(20,2) NOT NULL DEFAULT '0.00',
  `bank_transferred_amt` float(20,2) NOT NULL DEFAULT '0.00' COMMENT 'In case of refund payment method 1',
  `receipt` varchar(500) DEFAULT NULL,
  `reason` varchar(100) NOT NULL,
  `delivery_method` varchar(100) NOT NULL,
  `refund_payment_method` enum('1','2') NOT NULL COMMENT '1-Add In Amaaia Wallet,2-Add in Bank Account',
  `mobile_number` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `status` enum('1','2','3','4','5') NOT NULL COMMENT '1-requested,2-request accepted,3-request rejected,4-product accepted and return amount,5-product rejected',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `return_product_request`
--

INSERT INTO `return_product_request` (`id`, `user_id`, `product_id`, `order_id`, `order_product_id`, `user_wallet_id`, `usd_value`, `bank_transferred_amt`, `receipt`, `reason`, `delivery_method`, `refund_payment_method`, `mobile_number`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 26, 'AM-1529576977', 33, 0, 69.00, 3000.00, 'a9661f24e1ddd0c39ecb76393947ab855d91c84d.jpg', 'Defective', 'Self Shipment', '2', '+919922276924', 'dsd kdsjfkls flsfjlsf', '4', '2018-06-21 10:48:18', '2018-06-21 11:24:56'),
(2, 1, 25, 'AM-1529576977', 34, 1, 69.00, 0.00, NULL, 'Defective', 'Amaaia Pickup', '1', '+919922276924', 'dssf fsfs fsf sfsdf sdf sfsd fdsfdsfs', '4', '2018-06-21 12:36:11', '2018-06-21 12:36:54'),
(3, 1, 25, 'AM-1529646985', 45, 0, 69.00, 0.00, NULL, 'Damaged', 'Amaaia Pickup', '1', '+919922276924', 'ddsds dkjsdksd sdjksdjk', '2', '2018-06-22 13:16:41', '2018-06-26 13:27:18'),
(4, 1, 44, 'AM-1529646985', 46, 0, 69.00, 130.00, '72fd15fccb06f7eae93dc09146a23fdfe979fa3c.jpg', 'Defective', 'Self Shipment', '2', '+9189898989', 'ds fdsf dsf sfdsfds sd fsdf sfs fsdf sdfsd', '4', '2018-06-25 12:58:43', '2018-06-26 13:28:09'),
(6, 1, 43, 'AM-1529646743', 44, 0, 69.00, 0.00, NULL, 'Defective', 'Self Shipment', '2', '+918898998', 'sdfj sdfkljsd fsdk', '1', '2018-06-25 14:55:52', '2018-06-25 14:55:52'),
(7, 1, 57, 'AM-6039556786', 54, 7, 69.00, 0.00, NULL, 'Defective', 'Self Shipment', '1', '+9189898998', 'ds sdfsdfsd sdf fds', '4', '2018-06-26 04:33:19', '2018-06-26 13:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `review_and_rating`
--

CREATE TABLE `review_and_rating` (
  `id` int(11) NOT NULL,
  `order_product_id` int(11) NOT NULL COMMENT 'id of order_product tbl',
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review` varchar(555) NOT NULL,
  `rating` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review_and_rating`
--

INSERT INTO `review_and_rating` (`id`, `order_product_id`, `product_id`, `user_id`, `review`, `rating`, `created_at`, `updated_at`) VALUES
(1, 34, 25, 1, 'galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum', '5', '2018-06-21 20:02:38', '2018-06-21 20:02:38');

-- --------------------------------------------------------

--
-- Table structure for table `ring_shoulder_type`
--

CREATE TABLE `ring_shoulder_type` (
  `id` int(11) NOT NULL,
  `ring_shoulder_type` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ring_shoulder_type`
--

INSERT INTO `ring_shoulder_type` (`id`, `ring_shoulder_type`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Claw Set', 'claw-set', '0', '2018-05-17 04:53:16', '2018-09-29 14:12:56'),
(5, 'Double', 'double', '0', '2018-05-17 04:53:24', '2018-09-29 14:12:39'),
(6, 'Flared', 'flared', '0', '2018-05-17 04:53:29', '2018-09-29 14:12:34'),
(7, 'Open', 'open', '0', '2018-05-17 04:53:35', '2018-09-29 14:13:08'),
(8, 'Overlapping', 'overlapping', '0', '2018-05-17 04:53:40', '2018-09-29 14:12:30'),
(9, 'Parallel', 'parallel', '1', '2018-05-17 04:53:47', '2018-05-17 04:53:47'),
(10, 'Channel', 'channel', '1', '2018-05-17 04:54:00', '2018-05-17 04:54:00'),
(11, 'Solid', 'solid', '0', '2018-05-17 04:54:05', '2018-09-29 14:12:20'),
(12, 'Split', 'split', '1', '2018-05-17 04:54:12', '2018-05-17 04:54:12'),
(13, 'Tapering', 'tapering', '1', '2018-05-17 04:54:21', '2018-05-17 04:54:21'),
(14, 'Twisted', 'twisted', '1', '2018-05-17 04:54:27', '2018-05-17 04:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting`, `slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Prong Setting', 'prong-setting', '1', '2018-04-21 03:44:09', '2018-09-29 14:02:05', NULL),
(3, 'Pave Setting', 'pave-setting', '1', '2018-04-26 04:54:47', '2018-09-29 14:01:43', NULL),
(4, 'Bezel Setting', 'bezel-setting', '1', '2018-04-26 04:54:54', '2018-04-26 04:54:54', NULL),
(5, 'Three Stone Setting', 'three-stone-setting', '1', '2018-04-26 04:55:01', '2018-04-26 04:55:01', NULL),
(6, 'Cluster Setting', 'cluster-setting', '1', '2018-04-26 04:55:08', '2018-04-26 04:55:08', NULL),
(7, 'Halo Setting', 'halo-setting', '1', '2018-04-26 04:55:14', '2018-04-26 04:55:14', NULL),
(8, 'Tension Setting', 'tension-setting', '1', '2018-04-26 04:55:21', '2018-04-26 04:55:21', NULL),
(9, 'Invisible Setting', 'invisible-setting', '1', '2018-04-26 04:55:27', '2018-04-26 04:55:27', NULL),
(10, 'Illusion Setting', 'illusion-setting', '1', '2018-10-08 13:57:47', '2018-10-08 13:57:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shank_types`
--

CREATE TABLE `shank_types` (
  `id` int(11) NOT NULL,
  `shank_type` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shank_types`
--

INSERT INTO `shank_types` (`id`, `shank_type`, `slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'Straight', 'straight', '1', '2018-05-17 04:51:33', '2018-09-29 14:07:35', NULL),
(7, 'Comfort Fit', 'comfort-fit', '1', '2018-05-17 04:51:39', '2018-09-29 14:07:47', NULL),
(8, 'Traditional', 'traditional', '1', '2018-05-17 04:51:46', '2018-09-29 14:08:01', NULL),
(9, 'Euro', 'euro', '1', '2018-05-17 04:51:54', '2018-09-29 14:08:13', NULL),
(10, 'Cathedral', 'cathedral', '1', '2018-05-17 04:52:00', '2018-09-29 14:08:21', NULL),
(11, 'Split', 'split', '1', '2018-05-17 04:52:06', '2018-09-29 14:08:28', NULL),
(12, 'Knife Edge', 'knife-edge', '0', '2018-05-17 04:52:12', '2018-09-29 14:10:25', NULL),
(13, 'Bypass', 'bypass', '0', '2018-05-17 04:52:18', '2018-09-29 14:10:48', NULL),
(14, 'Criss Cross', 'criss-cross', '1', '2018-05-17 04:52:24', '2018-09-29 14:08:50', NULL),
(15, 'Tapered', 'tapered', '1', '2018-05-17 04:52:36', '2018-09-29 14:10:17', NULL),
(16, 'Reverse Tapered', 'reverse-tapered', '0', '2018-05-17 04:52:42', '2018-09-29 14:10:03', NULL),
(17, 'Freeform', 'freeform', '0', '2018-05-17 04:52:47', '2018-09-29 14:09:57', NULL),
(18, 'Pinched', 'pinched', '0', '2018-05-17 04:52:53', '2018-09-29 14:09:35', NULL),
(19, 'Flair', 'flair', '0', '2018-05-17 04:52:59', '2018-09-29 14:09:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(13, 15, '2018-06-19 05:26:57', '2018-06-19 05:26:57'),
(14, 1, '2018-11-30 05:26:15', '2018-11-30 05:26:15');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `site_address` varchar(255) NOT NULL,
  `site_contact_number` varchar(255) DEFAULT NULL,
  `site_status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=offline, 1=online',
  `meta_desc` text NOT NULL,
  `meta_keyword` varchar(500) NOT NULL,
  `site_email_address` varchar(255) DEFAULT NULL,
  `fb_url` varchar(255) NOT NULL,
  `twitter_url` varchar(255) NOT NULL,
  `google_plus_url` varchar(500) NOT NULL,
  `linkedin_url` varchar(500) NOT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `pintrest_url` varchar(255) NOT NULL,
  `lat` text,
  `lon` text,
  `currency_rate` double(10,2) NOT NULL,
  `transaction_charges` varchar(50) DEFAULT NULL COMMENT 'in (%)',
  `gst` double(10,2) NOT NULL,
  `product_return_days` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_name`, `site_address`, `site_contact_number`, `site_status`, `meta_desc`, `meta_keyword`, `site_email_address`, `fb_url`, `twitter_url`, `google_plus_url`, `linkedin_url`, `youtube_url`, `instagram_url`, `pintrest_url`, `lat`, `lon`, `currency_rate`, `transaction_charges`, `gst`, `product_return_days`, `created_at`, `updated_at`) VALUES
(1, 'Amaaia', '4th Floor, Bhandari Jewellery, Beside Kalika Mandir, Mumbai Naka, Matoshree Nagar, Nashik, Maharashtra 422001', '9876543210', '1', 'meta description', 'meta keyword', 'demo@webwing.com', 'https://facebook.com', 'https://twitter.com', 'https://gmail.com', 'https://www.linkedin.com/', NULL, 'https://www.instagram.com/', 'https://www.pinterest.com/', '19.991083', '73.78282899999999', 69.00, '10', 10.00, 30, '2018-04-13 06:48:30', '2018-08-10 10:00:31');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `product_type` enum('1','2') NOT NULL COMMENT '1=classic, 2=luxure',
  `category_id` int(11) NOT NULL,
  `subcategory_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `market_orientation_markup` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `product_type`, `category_id`, `subcategory_name`, `slug`, `market_orientation_markup`, `description`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', 2, 'Rings', 'rings', '20.00', 'A ring is a round band, usually of metal, worn as an ornamental piece of jewellery around the finger, or sometimes the toe; it is the most common current meaning of the word \"ring\". Strictly speaking a normal ring is a finger ring (which may be hyphenated); other types of rings worn as ornaments are earrings, bracelets for the wrist, armlets or arm rings, toe rings and torc or neck rings, but except perhaps for toe rings, the plain term \"ring\" is not normally used to refer to these.', 'efbe4882aa931537a92bf54737421c6e7c7d2ee9.jpg', '1', '2018-04-24 03:17:46', '2018-09-29 13:26:10', NULL),
(2, '1', 2, 'Earrings', 'earrings', '20.00', 'An earring is jewelry you wear on your ear. Your favorite earrings might be tiny white pearls, or they might be long feathers that dangle to your shoulders.', 'acdd11b976174107d08d9e04f9241cadf483ec6e.jpg', '1', '2018-04-24 03:18:20', '2018-10-15 18:45:37', NULL),
(3, '1', 2, 'Bracelets', 'bracelets', '20.00', 'Bangles are rigid bracelets, usually from metal, wood, glass or plastic. They are traditional ornaments worn mostly by South Asian women in India, Nepal, Pakistan and Bangladesh. It is common to see a new bride wearing glass bangles at her wedding, the traditional view is that the honeymoon will end when the last bangle breaks. Bangles also have a very traditional value in Hinduism and it is considered inauspicious to be bare armed for a married woman.', '0ec49d99fa739508f46c30c2570399a6706e6076.jpg', '1', '2018-04-24 03:18:37', '2018-10-15 18:49:59', NULL),
(4, '1', 2, 'Necklaces', 'necklaces', '20.00', 'A necklace is an article of jewelry that is worn around the neck. Necklaces may have been one of the earliest types of adornment worn by humans.[1] They often serve ceremonial, religious, magical, or funerary purposes and are also used as symbols of wealth and status, given that they are commonly made of precious metals and stones.', 'ea34e3549a0df8eda521d3bccbd99f43d65e3e01.jpg', '1', '2018-04-24 03:18:57', '2018-09-29 13:29:47', NULL),
(5, '1', 2, 'Pendants', 'pendants-1', '20.00', 'The word pendant derives from the Latin word pendere and Old French word pendr, both of which translate to \"to hang down\". It comes in the form of a loose-hanging piece of jewellery, generally attached by a small loop to a necklace, which may be known as a \"pendant necklace\". A pendant earring is an earring with a piece hanging down. In modern French, pendant is the gerund form of pendre (\" to hang\") and also means \"during\".', '9769818f97dbb6a251a84112e411d485b1b60d64.jpg', '1', '2018-04-24 03:19:47', '2018-09-29 13:30:02', NULL),
(6, '1', 2, 'Cufflinks', 'cufflinks-1', '20.00', 'Cufflinks are items of jewelry that are used to secure the cuffs of dress shirts. Cufflinks can be manufactured from a variety of different materials, such as glass, stone, leather, metal, precious metal or combinations of these. Securing of the cufflinks is usually achieved via toggles or reverses based on the design of the front section, which can be folded into position. There are also variants with chains or a rigid, bent rear section.', 'bc0be0f8f51569c7bae9e84c6e7b9f8b92268469.jpg', '1', '2018-04-24 03:20:06', '2018-09-29 13:30:17', NULL),
(7, '1', 3, 'Treated Diamond Jewellery', 'treated-diamond-jewellery', '30.00', 'A true antique (Latin: antiquus; \"old\", \"ancient\") is an item perceived as having value because of its aesthetic or historical significance, and often defined as at least 100 years old (or some other limit), although the term is often used loosely to describe any objects that are old.[1] An antique is usually an item that is collected or desirable because of its age, beauty, rarity, condition, utility, personal emotional connection, and/or other unique features.', '8ae297e3a60a52eddb294d9f34bebaf2beb8378a.jpg', '1', '2018-05-19 07:55:02', '2018-09-29 13:32:40', NULL),
(8, '1', 3, 'Brown Diamond Jewellery', 'brown-diamond-jewellery', '30.00', 'A bead is a small, decorative object that is formed in a variety of shapes and sizes of a material such as stone, bone, shell, glass, plastic, wood or pearl and with a small hole for threading or stringing. Beads range in size from under 1 millimetre (0.039 in) to over 1 centimetre (0.39 in) in diameter. A pair of beads made from Nassarius sea snail shells, approximately 100,000 years old, are thought to be the earliest known examples of jewellery. Beadwork is the art or craft of making things with beads.', 'f170614d8f8bb7663663076dc21fc63ec404c7a8.jpg', '1', '2018-05-19 07:55:14', '2018-09-29 13:35:12', NULL),
(9, '1', 3, 'Fun Jewellery', 'fun-jewellery', '30.00', 'A wedding is a ceremony where two people are united in marriage. Wedding traditions and customs vary greatly between cultures, ethnic groups, religions, countries, and social classes. Most wedding ceremonies involve an exchange of marriage vows by the couple, presentation of a gift (offering, rings, symbolic item, flowers, money), and a public proclamation of marriage by an authority figure or celebrant. Special wedding garments are often worn, and the ceremony is sometimes followed by a wedding reception.', 'f2b023ebf60c398f96a9705029f7b6efc209d529.jpg', '1', '2018-05-19 07:55:29', '2018-09-29 13:36:56', NULL),
(10, '1', 3, 'Men\'s Jewellery', 'mens-jewellery', '30.00', 'Fashion is a popular style, especially in clothing, footwear, lifestyle products, accessories, makeup, hairstyle and body. Fashion is a distinctive and often constant trend in the style in which a person dresses. It is the prevailing styles in behaviour and the newest creations of designers, technologists, engineers, and design managers.', '5c6f06813c4c32860ecae52d1a02ec9016c9d12e.jpg', '1', '2018-05-19 07:55:44', '2018-09-29 13:37:28', NULL),
(11, '1', 3, 'Jadau Jewellery', 'jadau-jewellery', '30.00', 'Meenakari is the art of coloring and ornamenting the surface of metals by fusing over it brilliant colors that are decorated in an intricate design.', '3d33bb7aa9ec4adef2b40380c0ed4126de994de3.jpg', '1', '2018-05-19 07:56:21', '2018-09-29 13:38:57', NULL),
(12, '1', 3, 'Pearl Jewellery', 'pearl-jewellery', '30.00', 'Navaratna (Sanskrit: नवरत्न) is a Sanskrit compound word meaning \"nine gems\". Jewellery created in this style has important cultural significance in Hinduism, Jainism, Buddhism, and Sikhism, among other religions.', '3a658985f937bc291381e2f2d9d88ecb80337ad6.jpg', '1', '2018-05-19 07:57:54', '2018-09-29 13:39:37', NULL),
(13, '1', 3, 'Silver Jewellery', 'silver-jewellery', '10.00', 'SILVER JEWELLERY', 'b31d2c5a3562b876e185c6868155418574411c38.jpg', '1', '2018-10-15 16:35:00', '2018-10-15 16:35:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `country_phone_code_id` int(11) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `password_reset_code` mediumtext,
  `remember_token` varchar(100) DEFAULT NULL,
  `profile_image` varchar(100) DEFAULT NULL,
  `is_email_verified` enum('0','1') NOT NULL COMMENT '0=unverified, 1=verified',
  `is_admin_verified` enum('0','1') NOT NULL COMMENT '0=unverified, 1=verified',
  `status` enum('0','1') NOT NULL COMMENT '0=inactive, 1=active',
  `admin_commission` double(10,2) DEFAULT '0.00' COMMENT '%',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `first_name`, `last_name`, `country_phone_code_id`, `address`, `mobile_number`, `email`, `password`, `password_reset_code`, `remember_token`, `profile_image`, `is_email_verified`, `is_admin_verified`, `status`, `admin_commission`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Rohini', 'Jagtap', 101, 'Pune, Maharashtra, India', '1234567893', 'supplier@webwingtechnologies.com', '$2y$10$dxKYo50g99bhpU1u.ScIs.DxDQ7cP8fuFn/tXEzSCHZ4YrOA16ZAu', NULL, 'xwr9JkZTj11O6UKfJ5AYDu0dda2NUl0SxwYo1lJBsFNtDnWWz3tve0nxbkyO', 'ebfd3addded30d73c55fe7f69719e29add5233f4.jpg', '1', '1', '1', 3.00, '2018-04-11 18:30:00', '2018-10-20 05:50:47', NULL),
(2, 'Dsds', 'Dsds', NULL, 'Adelaide SA, Australia', '89898989', 'dssdd@gmail.com', '$2y$10$yY9Hobru1yJ3eu/cgmnOWeI5UextoTicG.14Jt7S0eGQJFz7Dh0HO', NULL, '87215dc9c31047de2ef17e19db3d9c4c', NULL, '0', '0', '1', 3.00, '2018-04-23 01:55:12', '2018-05-28 08:43:34', NULL),
(3, 'Abc', 'Dssd', NULL, 'Adfo, Markaz Edfo, Egypt', '8989899', 'nujawebar@1webmail.info', '$2y$10$9MqfNxio1zQV5MjE9SQr4e2Dh69ym84CjH6SCAuS1wuAAFUe0gylG', NULL, NULL, NULL, '1', '0', '1', 3.00, '2018-04-23 03:57:57', '2018-05-28 08:43:34', NULL),
(4, 'Jj', 'Dsjk', NULL, 'sdsda, Overbrook Road, Elyria, OH, USA', '9999999', 'jisu@2ether.net', '$2y$10$3L4UNAHlnsOzZCB1mYmBc.w0un3NA9dnESfYZJo4wd8HRSvs0tdBq', NULL, NULL, NULL, '1', '0', '1', 3.00, '2018-04-23 04:12:11', '2018-05-28 08:43:34', NULL),
(5, 'Prashant', 'Patil', NULL, 'Pune, Maharashtra, India', '8989898', 'fokexupi@one2mail.info', '$2y$10$Oah8skeGixHKqfvC/NWxAOmMlKTOZ5BB0FhneUApA9io0KadfaSim', NULL, NULL, NULL, '1', '0', '1', 3.00, '2018-04-23 05:32:07', '2018-05-28 08:43:34', NULL),
(6, 'Riwa', 'Patil', 0, 'dsd', '8989899', 'riwa@emailure.net', '$2y$10$REjM7b63nZFng.Sv1cIBpeRPBAa1LdjnXp3X8qVi7HYHe/iu2T1wq', NULL, 'fa9a635a0eac21e12260f05d1afc7c4e', NULL, '0', '1', '1', 3.00, '2018-04-23 06:18:01', '2018-05-28 08:43:34', NULL),
(7, 'Ab', 'D', 0, 'SDJ/201, Ambazari Road, Corporation Colony, Ambazari, Nagpur, Maharashtra, India', '898945454', 'zegukeb@eth2btc.info', '$2y$10$tqubDCmEoJrVP0Dd9tNgnuQXBE/korSN9TifJK..cI6n78FC9acBO', NULL, 'JKWA1Iknqra7tsYkN0VobYQhGFFwS2aGI5HkEZ6NNRMpueNtkj3Aa7F6gciT', NULL, '0', '1', '1', 3.00, '2018-04-23 06:19:38', '2018-05-28 08:43:34', NULL),
(8, 'Dsd', 'Jkjkjk', 101, 'Nashik, Maharashtra, India', '89899898', 'supplier@webwing.com', '$2y$10$dxKYo50g99bhpU1u.ScIs.DxDQ7cP8fuFn/tXEzSCHZ4YrOA16ZAu', NULL, 'BlrN97ACFZrdSC5Ki0JlGS528X22L4Zy1a3XhFywK6nkcoccfdDZ7FqIicRp', 'dc650f35b5dc8ae7111cc9aac0c5a74423f70326.png', '1', '1', '1', 3.00, '2018-04-23 06:22:45', '2018-06-25 14:26:00', NULL),
(9, 'Hhh', 'Bk', 101, 'DKD Bridge, Tbilisi, Georgia', '98989898', 'fazoga@carbtc.net', '$2y$10$a1HEv11kyLW2bRda0xlXxup.1BOxQIKdygwopn7w/Ysd5yFoeonXu', NULL, '7jru2qykAG1628cfLfzamLbU2gpQzlqLA4V5tfYfwnnxyRrrMFTLwh1T7fwr', NULL, '0', '1', '1', 3.00, '2018-04-24 05:16:43', '2018-05-28 08:43:34', NULL),
(10, 'Bbb', 'Djshsd', 101, 'sdd', '88778788', 'lafekajuwa@2ether.net', '$2y$10$vvbFkbsdQEdTtENwu9njkuXNn8DATTxfvrWcBTfi78iDr/tDaCqgy', NULL, 'evLwUKkPGgLEUYoXfsCbxyuVykX1HlHfPNGnAMRvCe7gBA9lJgSyevZlzEQv', NULL, '1', '1', '1', 3.00, '2018-04-24 05:22:06', '2018-05-28 08:43:34', NULL),
(11, 'Nnn', 'Ddd', 101, 'Ankara, Turkey', '9889898', 'wugovo@one2mail.info', '$2y$10$m/mF0SGUB7n3sviqxPfDJe6eM1tHlGRRE5Y4CZa2tEi8VCntrsDdW', NULL, 'c4iRT5KeXsBQrOqSCb9gsVBX9nvjjMkx01kc4SzA6w9es6hR9N5i0ydvWFzC', '12e9ba7fe7d3c72f5f3f934e65bf3df436dc583e.jpeg', '0', '0', '1', 3.00, '2018-04-24 05:57:20', '2018-05-28 08:43:34', NULL),
(12, 'Uuu', 'Dsdds', 101, 'dsdsd', '89898989', 'wazo@carbtc.net', '$2y$10$R9tOfWpOtLOSTvDB70NxuOTmEPdF.GQQZQPUOmVZNQvdgCgXml/mK', NULL, '23cf43b908db9536a0b3ae7f6c52fb65', NULL, '0', '0', '1', 3.00, '2018-04-25 01:22:39', '2018-05-28 08:43:34', NULL),
(13, 'Nisha', 'Pawar', 101, 'Avenida Corrientes 780, Buenos Aires, Argentina', '89898988', 'yexokak@emailure.net', '$2y$10$0UIkR/KdSM3H8ReIEBi6ZO53mAvtrIJF28J.bWKPkFSnWSfTdRyyC', NULL, 'DoDMn6YTfYblgqlBImrhnbvRmFVYTwr0ifcg30WT1c4wHs8d86tYdDJBoWlU', NULL, '0', '0', '1', 3.00, '2018-04-25 01:25:11', '2018-05-28 08:43:34', NULL),
(14, 'Nnn', 'Dsdsd', 101, 'Pune, Maharashtra, India', '99556565656', 'motelupe@aditus.info', '$2y$10$Ipqze.7OLCkhQPs2qTSis.vsDEyNS2soK..12Spbfx8JkytC6E/fa', NULL, 'cvo5Mzp2b6DtxqrGIxB5X1bV1LKA43GvBHUnxr0jX8Hhde978sECF64HD2hz', NULL, '1', '0', '1', 3.00, '2018-05-02 22:25:51', '2018-05-28 08:43:34', NULL),
(15, 'Ddds', 'Sdds', 229, 'dfds', '8989898989', 'zimu@aditus.info', '$2y$10$HZml.UTCzG/FCCoydtl8hOwZ0o2Q1Um1PqqW1q/HEuMtCsZrmQ9I.', NULL, 'eb07bb7e4064c77bd329b4aeb82d432c', NULL, '0', '0', '1', 3.00, '2018-05-18 03:27:26', '2018-05-28 08:43:34', NULL),
(16, 'Dss', 'Dsd', 13, 'fj', '89898989', 'bibuforimu@storiqax.top', '$2y$10$c8v.octYl2Gq/u1k6vfQAO20ycnIA/zuf3pBY97I3aaeyrkFpNqQ2', NULL, 'c152f3b5a0b0371a087fc79fd6d1ce28', NULL, '0', '0', '1', 3.00, '2018-05-18 03:36:24', '2018-05-28 08:43:34', NULL),
(17, 'Dssd', 'Dssd', 229, '5454', '89898998', 'cidoced@bitwhites.top', '$2y$10$D9QHZgDwiXPvYeZlNuw7feLorITrvI.KigkbqlBZTNbvIl5GkYwqy', NULL, '9e77e4f426077a6274cdfc3937041dd8', NULL, '0', '0', '1', 3.00, '2018-05-18 03:37:57', '2018-05-28 08:43:34', NULL),
(18, 'Dsd', 'Sdsd', 12, 'D. S. Senanayake Mawatha, Colombo, Sri Lanka', '8989899', 'vijeh@ethersportz.info', '$2y$10$dhI1Cnb4LYY08GoZ91qlMuhyUFOFz23S18UnSLnutHVfaIAbL9s3C', NULL, '399217672a4c81b156f9b2f38c3b4266', NULL, '0', '0', '1', 3.00, '2018-05-18 03:39:06', '2018-05-28 08:43:34', NULL),
(19, 'Dfsdfs', 'Fsdf', 19, '413 West 34th Street, New York, NY, USA', '89898989', 'wusose@b2bx.net', '$2y$10$0Ajh7JJvWoY3KiInuSJsLuorXVbvkAJ5qzyuhFrPkNYqjD8pRSAWe', NULL, '3c4c1ca3d71234fbc4badee243e361c6', NULL, '0', '0', '1', 3.00, '2018-05-18 03:41:20', '2018-05-28 08:43:34', NULL),
(20, 'Dseew', 'Dsd', 1, 'Avenida Corrientes 4545, Buenos Aires, Argentina', '9898989', 'wipinidaca@aditus.info', '$2y$10$cNsDdBItOwkzD.eQ9nlua.q7Ubo6ht4c11zpB6spsaquHShLbnRGO', NULL, 'ece5724bd0fd940ee1f79326f91e161a', NULL, '0', '0', '1', 3.00, '2018-05-18 03:43:19', '2018-05-28 08:43:34', NULL),
(21, 'Ssd', 'Sdsd', 10, 'D. S. Senanayake Mawatha, Colombo, Sri Lanka', '8989899', 'nulehe@stelliteop.info', '$2y$10$Ls8hroCStLdtPZvq5fc/ouH1BkaGCJjhKb4.CR1jqMzs7JD6dUIrm', NULL, 'f4b3606e5ca3b928dd28a543d55f3d7f', NULL, '0', '0', '1', 3.00, '2018-05-18 03:44:58', '2018-05-28 08:43:34', NULL),
(22, 'Dsds', 'Sdsdsd', 1, 'Avenida Corrientes 4486, Buenos Aires, Argentina', '89898945', 'zeherulel@ethersportz.info', '$2y$10$.RVlkIZdm.LqBpc.lnude.9w.1evTFUZLcJlLIdT.Yk8VcUwh1u0G', NULL, 'c5765810d44b365e14b0bd50e2e4d19c', NULL, '0', '0', '1', 3.00, '2018-05-18 03:46:49', '2018-05-28 08:43:34', NULL),
(23, 'Dsds', 'Dssd', 12, '454', '8989889', 'tihi@gifto12.com', '$2y$10$gJbaCnn2APk1w3D0liVEBOukPprejji1Jxz1x037O6oQtc48hhDXq', NULL, 'f60a3f1db64198774f04d2eb9612c777', NULL, '0', '0', '1', 3.00, '2018-05-18 03:50:50', '2018-05-28 08:43:34', NULL),
(24, 'Deepu', 'Bari', 101, 'Nashik, Maharashtra, India', '898563222', 'patuwe@storiqax.com', '$2y$10$KRu6QGjjbs7hb8pfWPF27ec3/Gqdvd6HXYSkzdws179A1nEnW1beS', NULL, '4a0e717aa57a714b2c56f7218b09484c', NULL, '0', '0', '1', 3.00, '2018-05-18 04:10:02', '2018-05-28 08:43:34', NULL),
(25, 'Deepu', 'Salunke', 101, 'Nashik, Maharashtra, India', '113654875', 'yevelo@bitwhites.top', '$2y$10$9CgP9xGky.KyN1lSsJXiVuQa1vE3xOgNbYtDWGsMQYlOVTheTztSG', NULL, '20e33a3ec58621208173b0742d3a3af5', NULL, '0', '0', '1', 3.00, '2018-05-18 04:15:41', '2018-05-28 08:43:34', NULL),
(26, 'Sagar', 'Pawar', 101, 'Nashik, Maharashtra, India', '1236545878', 'loboko@2odem.com', '$2y$10$g7h66AfkxorhuGCx6EH0u.4dCpruTpbbZ75FrpRrIa/.FpJRPXtUC', NULL, '94e4b1337fc31f6c0bcb93406f102d7a', NULL, '0', '0', '1', 3.00, '2018-05-18 04:19:04', '2018-05-28 08:43:34', NULL),
(27, 'Deepu', 'Salunke', 101, 'Satpur Colony, Nashik, Maharashtra, India', '123654852', 'vevi@ethersportz.info', '$2y$10$y6mVzp/ZlwoxflI8KHGx8.36Nc.s3cfMepHWGtjt65CUZA/nR3z8m', NULL, '094f9ca287e69f6fef36d37fbe097b65', NULL, '0', '0', '1', 3.00, '2018-05-18 07:26:57', '2018-05-28 08:43:34', NULL),
(28, 'Deepu', 'Salunke', 101, 'Satpur Colony, Nashik, Maharashtra, India', '123456789', 'suju@storiqax.com', '$2y$10$ntMuVeElozZFXsGC0ADdM.1LgeP6tSJRXTSPmcXlZBUBMRlwsvrFe', NULL, '531274a8143874ecacb2dbcd5ec7f2fe', NULL, '0', '0', '1', 3.00, '2018-05-18 07:31:22', '2018-05-28 08:43:34', NULL),
(29, 'Sagar', 'Sainkar', 101, 'Nashik, Maharashtra, India', '3256985452', 'sagars@webwingtechnologies.com', '$2y$10$IcKu4ZWMMCFDfm.u.06UHuD0DKpZDyraAETwV75nXVaYZrCvMdqvm', NULL, '634c76c1c040f990ecb074b01e3e403a', NULL, '0', '0', '1', 3.00, '2018-05-18 07:33:33', '2018-05-28 08:43:34', NULL),
(30, 'Deepu', 'Deepu', 101, 'Nashville, TN, USA', '1234567896', 'heki@aditus.info', '$2y$10$vFHYH8QoX29gEETv.npQZuDewb0NHvO/4WUrYyR0ZbBo8DcVmCqeS', NULL, '4c252f0b8105ddb8321f6feba75eac20', NULL, '0', '0', '1', 3.00, '2018-05-18 07:37:33', '2018-05-28 08:43:34', NULL),
(31, 'Deepu', 'Deepu', 101, 'Nashville, TN, USA', '1234567896', 'codirug@aditus.info', '$2y$10$zGneE/aIUl2Y2glkEdceXe.pfAG.fk4PagqOPGErcXPbnLlPVQEjW', NULL, 'a8e014f580c3852490ed125e8f8529d0', NULL, '0', '0', '1', 3.00, '2018-05-18 07:38:24', '2018-05-28 08:43:34', NULL),
(32, 'Deepu', 'Deepu', 101, 'Nashville, TN, USA', '1234567896', 'buhihayufu@stelliteop.info', '$2y$10$aXvWxufvQrfo2SALpUzb2.l3kRZ3WeXwi/4TR1XR/Mi8R5eld0O7K', NULL, '2edd141e1fd6496b35bf7984270b2a4d', NULL, '0', '0', '1', 3.00, '2018-05-18 07:43:15', '2018-05-28 08:43:34', NULL),
(33, 'Deepu', 'Deepu', 101, 'Nashik, Maharashtra, India', '1236549874', 'mevuj@stelliteop.info', '$2y$10$xbmP0erxPEbsfLt7gecK0OQvZABhX8qhNg55drcor95mJYnByrmci', NULL, '87fc4cf342d55b0bd0c25f35700c3243', NULL, '0', '0', '1', 3.00, '2018-05-18 07:44:58', '2018-05-28 08:43:34', NULL),
(34, 'Admin', 'Admin', 101, 'Nashik, Maharashtra, India', '123654987', 'migola@ethersportz.info', '$2y$10$U20roXvh6LvyihCWBmoBxezv4PebU0a5ko2xDzW9xlkUsxzLIxEfG', NULL, 'f0d23efea847cc6eeba0d7d80897990c', NULL, '0', '0', '1', 3.00, '2018-05-18 07:47:24', '2018-05-28 08:43:34', NULL),
(35, 'DSSDDS', 'DSSD', 9, 'dsds, Godowa, Poland', '89898998', 'yogixuma@ethersportz.info', '$2y$10$rCAe4/.xWJDeBClvDm5AdeaVCBpKTne.Nc7fq8CBxfwsKsdo7VK7S', NULL, '40e566555e7321c6090908876767d670', NULL, '0', '0', '1', 3.00, '2018-05-18 08:16:34', '2018-05-28 08:43:34', NULL),
(36, 'Dsds', 'Dssd', 27, 'Davis School District, UT, USA', '898989988', 'dapo@stelliteop.info', '$2y$10$htvIw.I5zL8K0W/LnCA4M.S306LkHIsdaSwKpqzBCq6zCXosbX.L2', NULL, '9d3dec3027dac9201ce6f188b8ba0385', NULL, '0', '0', '1', 3.00, '2018-05-18 08:18:31', '2018-05-28 08:43:34', NULL),
(37, 'Dsds', 'Dsds', 27, 'df', '89898989', 'viso@b2bx.net', '$2y$10$UeaIsG0ra9d6Bh/Cb/.X1uNaZvXM28nCAXGWt2XOjCX4rv43qvQ2.', NULL, 'b3e0072151baf7913e4f633c29ac0f94', NULL, '0', '0', '1', 3.00, '2018-05-18 08:19:47', '2018-05-28 08:43:34', NULL),
(38, 'Sdf', 'Sdfsdf', 15, 'FDS, Germany', '8989898998', 'xakobi@2odem.com', '$2y$10$fz/KneYPmByRK2EXxCnKtOfSyqSBUSj7eODh9JWpBku.3jWSdrfae', NULL, '51d41ad7b59db31a8c8d653ec16d16ef', NULL, '0', '0', '1', 3.00, '2018-05-18 08:21:04', '2018-05-28 08:43:34', NULL),
(39, 'Fsdf', 'Sdfds', 1, 'FDS, Germany', '89898998', 'fukaful@bitwhites.top', '$2y$10$RDvT1h.zXrZErd9XhZINCuML.v8H6eY2Jgdo6Pk8nrrtA7nJgy0cC', NULL, '732c0f8b2db5563ee0612af5a358c342', NULL, '0', '0', '1', 3.00, '2018-05-18 08:22:00', '2018-05-28 08:43:34', NULL),
(40, 'Dsdsd', 'Dssd', 15, 'Paseo de la Castellana, 45, Madrid, Spain', '8989889', 'jizenanim@gifto12.com', '$2y$10$jd69ROeCv.SRLVyqXXLo3OYQn3Jj7hRe7ZOHr0aQZSesaT5yNevEW', NULL, 'bb7e0b43027cb916dafefe70814fa8f5', NULL, '0', '0', '1', 3.00, '2018-05-18 08:25:59', '2018-05-28 08:43:34', NULL),
(41, 'Dsds', 'Ffds', 101, 'Dobbs Ferry Union Free School District, Greenburgh, NY, USA', '89898998', 'zoforof@b2bx.net', '$2y$10$YheFUEsYc4mxCkrck1VWM.0zeLuVdZQI0/dzXj7oXCMJe69h0lQ6i', NULL, 'd27dd00fb1522215fe4c38ab1aa11a15', NULL, '0', '0', '1', 3.00, '2018-05-18 08:28:07', '2018-05-28 08:43:34', NULL),
(42, 'Fsdfds', 'Fdsf', 191, '4545', '898989788', 'bepin@gifto12.com', '$2y$10$H0lw7lInNTB8p//93dY/cer75cbGdGhP7gFbDbl/COTP1XKmojBmG', NULL, '6407abcc9f5be48d48fb0720695385a3', NULL, '0', '0', '1', 3.00, '2018-05-18 08:30:24', '2018-05-28 08:43:34', NULL),
(43, 'Dds', 'Dssd', 1, 'd', '8989899898', 'voja@aditus.info', '$2y$10$l4OkCL./thMzXSiDQRsdD.wrNY7Eg1w4so3sgqcRI25GkUWQQhmkG', NULL, 'd85bf2d5eedbaee626d3686963ac2a6c', NULL, '0', '0', '1', 3.00, '2018-05-18 08:32:00', '2018-05-28 08:43:34', NULL),
(44, 'Ds', 'Sdsd', 27, 'dsd', '798888989', 'lalaf@gifto12.com', '$2y$10$oORHthhLlut0ySMHLfRJl.RQswC7VsT65m5cu3R13R4cKI/3pUQKC', NULL, 'e3dbe53d84075ce2b0fc0e1bc5c690cb', NULL, '0', '0', '1', 3.00, '2018-05-18 08:33:14', '2018-05-28 08:43:34', NULL),
(45, 'Sdsd', 'Sd', 27, 'Jalan Margonda Raya No.4D, Kemiri Muka, Depok City, West Java, Indonesia', '98988989', 'lupu@storiqax.com', '$2y$10$O18l0Xsr9y6SeOYdPAMtSeUnsZVA8QjwnVVm2zPe1.AVeaPjzk7Ha', NULL, '4d498190603425c1b753a15310490a72', NULL, '0', '0', '1', 3.00, '2018-05-18 08:34:32', '2018-05-28 08:43:34', NULL),
(46, 'Dss', 'Sdsd', 15, 'D. S. Senanayake Mawatha, Colombo, Sri Lanka', '8989889', 'bupu@gifto12.com', '$2y$10$CJUJ1I2ZA8YbwvaSm8LAKe1/9gclM57bQ66tGhtamwJhO/1oibIc6', NULL, 'ad68e89157e5913ef95a7c6e79093af9', NULL, '0', '0', '1', 3.00, '2018-05-18 08:35:43', '2018-05-28 08:43:34', NULL),
(47, 'Dsd', 'Gfdg', 101, 'SDD Souza Chawl, Jagannath Mandir Road, Satya Nagar, Sathi D Souza Nagar, Sakinaka, Mumbai, Maharashtra, India', '89898998', 'xorud@stelliteop.info', '$2y$10$rYdel6F7DJk..kyF47JVmuLNF4rTzZ/A24lguvrbQ5SzekQ9SGtcO', NULL, 'fb74b14c94781fed575bf3380034fae9', NULL, '0', '0', '1', 3.00, '2018-05-18 08:37:59', '2018-05-28 08:43:34', NULL),
(48, 'Dsf', 'Sfdsf', 5, 'Delhi, India', '8989988989', 'femariku@storiqax.top', '$2y$10$c6qSz/CKSWmmCJNFO4Pl8eyT6Pq6n7RaL0YDyXTcc1PyXSF2MIalG', NULL, '438e82632218038017f6bf4a8c47dedd', NULL, '0', '0', '1', 3.00, '2018-05-18 08:39:42', '2018-05-28 08:43:34', NULL),
(49, 'Dssd', 'Dssd', 14, 'Delhi, India', '89898989', 'bajinux@gifto12.com', '$2y$10$/Dk/ZSuHaTIyq1JlDv8TSu2AuKRwAV0X3ujPxANwXOOTa5NaBWEKy', NULL, '4073e3a40a36b61c6301c47c7e5e888a', NULL, '0', '0', '1', 3.00, '2018-05-18 08:42:17', '2018-05-28 08:43:34', NULL),
(50, 'Dssd', 'Dssd', 14, 'Delhi, India', '89898989', 'jomi@2odem.com', '$2y$10$alBh.CxPV1LXIooJcEd4fuKJDcb/0rOEPFQSvM7zlSCTQQCOU19Mi', NULL, '6c28cb5217bad1c6d4e79465d410bd95', NULL, '0', '0', '1', 3.00, '2018-05-18 08:44:26', '2018-05-28 08:43:34', NULL),
(51, 'Dssd', 'Dssd', 15, 'SD, USA', '89898989', 'penup@bitwhites.top', '$2y$10$krUYeu8EWWrgNrrVdeR0ruBEbuQpUh54FNOqx3JVn2goXkPE3718G', NULL, '156589bd1a9ba473bbc7da325085061d', NULL, '0', '0', '1', 3.00, '2018-05-18 08:45:50', '2018-05-28 08:43:34', NULL),
(52, 'Dsd', 'Dssd', 1, 'DSK Vishwa, Dhayari, Pune, Maharashtra, India', '898988998', 'naluy@2odem.com', '$2y$10$gS4xLj/XEYpxnmiPsk73KuO9OXVb77alYotqHQq03RvHBqV.bX.Eq', NULL, '64fcfb1b14b148bf4d97b5298c97dcc6', NULL, '0', '0', '1', 3.00, '2018-05-18 08:50:29', '2018-05-28 08:43:34', NULL),
(53, 'Fdsd', 'Fdsfds', 19, 'Australia', '8989898', 'xadaruk@storiqax.top', '$2y$10$tstvPw1jzZ.yNTX7Mae8T.C3sZ5PTZFi9zNT6eZblILnH9hq4Zazu', NULL, NULL, NULL, '1', '0', '1', 3.00, '2018-05-18 08:52:10', '2018-05-28 08:43:23', NULL),
(54, 'Salsa', 'Derrick', 101, 'Pune, Maharashtra, India', '9987456325', 'salsa.derrick@yahoo.com', '$2y$10$olprxtse72q2MunSWak3eODf2i9Q7z7FhzJWWjgbpFaWYfqXiF1bW', NULL, 'mkOLfP2TlbbKmqhRTYWi5gJcwTQE2Dhu4gpF3Kluv4ITtKoSp2LpTgpLGKt8', '32d5597a4cdd90e9c1aa46bbaa29f54044d7d0f7.jpg', '1', '1', '1', 3.00, '2018-06-01 15:29:20', '2018-10-09 10:41:01', NULL),
(55, 'Dsfsd', 'Sdjfsdjkf', 229, 'Dubai - United Arab Emirates', '+9+99+9+', 'xajenenim@sfamo.com', '$2y$10$GQ1NF3LCYymKuKQyoYReS.PHl7dIaQ2gfb1fRsuY.aFuT0ye7E0Be', NULL, '3d7826bfde0a2d6d45f27297138a1a12', NULL, '0', '0', '1', 0.00, '2018-06-25 11:25:38', '2018-06-25 11:25:38', NULL),
(56, 'Dssd', 'Dsdssd', 2, 'dsds', '89898998', 'gise@nickrizos.com', '$2y$10$38Ci3ga78DKMhzAL.2lFceWl8DuntplECfzng5bbkZA6nC1aA4Zim', NULL, NULL, NULL, '1', '1', '1', 0.00, '2018-06-25 11:28:46', '2018-06-25 11:31:32', NULL),
(57, 'Trial', 'Trial', 101, 'trial', '9812345', 'trial@trial.com', '$2y$10$ROlna3aCw04pMiK23Nl6quRsjzbP7k2eud6ORxNPhHwjFRwNOFJ22', NULL, '4ceba14f458288a99d21c2b2e6e8ee44', NULL, '0', '1', '1', 0.00, '2018-09-29 15:40:51', '2018-09-29 15:41:17', NULL),
(58, 'Raj', 'Jhaveri', 101, '102b grand paradi', '9820647707', 'r.jhaveri@hotmail.com', '$2y$10$4thAwtaOtIuQjJ0S9TmViOO7pg5T5VnEWgeN1nxb0b5iG3okPU9s.', NULL, NULL, NULL, '1', '1', '1', 0.00, '2018-09-29 15:44:56', '2018-09-29 15:45:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_business_details`
--

CREATE TABLE `supplier_business_details` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `business_name` varchar(255) NOT NULL,
  `business_reg_no` varchar(255) NOT NULL,
  `pan_no` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country_phone_code_id` int(11) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_business_details`
--

INSERT INTO `supplier_business_details` (`id`, `supplier_id`, `business_name`, `business_reg_no`, `pan_no`, `email`, `country_phone_code_id`, `mobile_number`, `created_at`, `updated_at`) VALUES
(1, 8, 'abcd', 'ksdfjkls', 'fjdsfsd454', 'ewew@gmail.com', 101, '78454587', '2018-04-23 23:19:18', '2018-05-03 04:50:49'),
(2, 7, 'dsdsds', 'sdsdsdfsdfsdf', 'sdsdsdsdsd', 'dsd@gmail.com', 101, '8989898989', '2018-04-23 23:45:01', '2018-04-23 23:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_password_resets`
--

CREATE TABLE `supplier_password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier_password_resets`
--

INSERT INTO `supplier_password_resets` (`email`, `token`, `created_at`) VALUES
('admin@webwing.com', '4b6883c2ded88c15f0e648fadea7a43082d229ede70641c6aedff9db529bf423', '2018-04-22 23:11:47'),
('gise@nickrizos.com', '529c639133e0feca90f951aa1614febb05aedc6aefd2dcb40445c34efd37a7f7', '2018-06-25 11:31:38');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(20) NOT NULL,
  `tracking_id` varchar(50) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `user_id` int(12) NOT NULL,
  `product_id` int(12) NOT NULL,
  `user_gift_card_id` int(11) DEFAULT NULL COMMENT 'id of user_gift_cards tbl',
  `return_product_request_id` int(11) NOT NULL DEFAULT '0',
  `replacement_product_request_id` int(11) NOT NULL,
  `bank_ref_no` varchar(50) DEFAULT NULL,
  `order_status` varchar(50) DEFAULT NULL,
  `payment_status` enum('0','1','2','3','4','5') NOT NULL DEFAULT '0' COMMENT '0-hold 1-Success 2-Failure 3-Aborted 4-Invalid 5-pending',
  `card_name` varchar(50) DEFAULT NULL,
  `currency` varchar(20) DEFAULT NULL,
  `amount` double(20,2) NOT NULL DEFAULT '0.00',
  `billing_name` varchar(30) DEFAULT NULL,
  `billing_address` text,
  `billing_city` varchar(50) DEFAULT NULL,
  `billing_country` varchar(50) DEFAULT NULL,
  `billing_email` varchar(50) DEFAULT NULL,
  `delivery_tel` varchar(255) NOT NULL,
  `delivery_country` varchar(255) NOT NULL,
  `delivery_zip` varchar(255) NOT NULL,
  `delivery_state` varchar(255) NOT NULL,
  `delivery_city` varchar(255) NOT NULL,
  `delivery_address` text NOT NULL,
  `delivery_name` varchar(255) NOT NULL,
  `billing_tel` varchar(255) NOT NULL,
  `billing_zip` varchar(255) NOT NULL,
  `billing_state` varchar(255) NOT NULL,
  `status_message` varchar(255) NOT NULL,
  `status_code` varchar(255) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `failure_message` varchar(255) NOT NULL,
  `trans_type` enum('1','2','3','4') NOT NULL DEFAULT '1' COMMENT '1-product,2-gift card,3-return,4-replacement',
  `transaction_usd_value` double(20,2) NOT NULL DEFAULT '0.00' COMMENT 'current usd price',
  `trans_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `response_data` text,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `tracking_id`, `order_id`, `user_id`, `product_id`, `user_gift_card_id`, `return_product_request_id`, `replacement_product_request_id`, `bank_ref_no`, `order_status`, `payment_status`, `card_name`, `currency`, `amount`, `billing_name`, `billing_address`, `billing_city`, `billing_country`, `billing_email`, `delivery_tel`, `delivery_country`, `delivery_zip`, `delivery_state`, `delivery_city`, `delivery_address`, `delivery_name`, `billing_tel`, `billing_zip`, `billing_state`, `status_message`, `status_code`, `payment_mode`, `failure_message`, `trans_type`, `transaction_usd_value`, `trans_date`, `response_data`, `created_at`, `updated_at`) VALUES
(1, '', 'AM-1527774592', 1, 0, NULL, 0, 0, NULL, NULL, '5', NULL, NULL, 31610.62, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-22 11:15:38', NULL, '2018-05-31 08:19:52', '2018-05-31 08:19:52'),
(2, '', 'AM-1527774695', 1, 0, NULL, 0, 0, NULL, NULL, '0', NULL, NULL, 31610.62, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-05-31 08:21:35', '2018-05-31 08:21:35'),
(3, '', 'AM-1527774978', 1, 0, NULL, 0, 0, NULL, NULL, '0', NULL, NULL, 31610.62, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-05-31 08:26:18', '2018-05-31 08:26:18'),
(4, '', 'AM-1527852575', 1, 0, NULL, 0, 0, NULL, NULL, '0', NULL, NULL, 31610.62, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-01 05:59:36', '2018-06-01 05:59:36'),
(5, '307003841404', 'AM-1527915975', 1, 0, NULL, 0, 0, '1527915996497', 'Success', '1', 'AvenuesTest', 'INR', 1699929.38, 'Nayan Pawar', 'Indira nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 60.56, '2018-06-07 05:54:00', '{\"order_id\":\"AM-1527915975\",\"tracking_id\":\"307003841404\",\"bank_ref_no\":\"1527915996497\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"1699929.38\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"1699929.38\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"02\\/06\\/2018 10:36:40\",\"bin_country\":\"\\u0005\\u0005\\u0005\\u0005\\u0005\"}', '2018-06-01 23:36:15', '2018-06-02 01:41:10'),
(6, '095003194210', 'AM-1527928875', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 1719929.38, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-02 03:11:15', '2018-06-02 03:11:15'),
(7, '006620823342', 'AM-1527929057', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 1719929.38, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-02 03:14:18', '2018-06-02 03:14:18'),
(8, '123719019020', 'AM-1527929350', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 1719929.38, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-02 03:19:10', '2018-06-02 03:19:10'),
(9, '307003842031', 'CS-2018-cb67252753790f3e', 0, 0, 24, 0, 0, '1527936469340', 'Success', '1', 'AvenuesTest', 'INR', 50.00, 'Nayan Pawar', 'Nashik, Maharashtra, India', 'dndd', 'India', 'dsdds@gmail.com', '89898998', 'India', '4545455', 'maharashtra', 'dndd', 'Nashik, Maharashtra, India', 'Nayan Pawar', '89898998', '4545455', 'maharashtra', 'Y', 'null', 'Net Banking', '', '2', 60.56, '2018-06-07 05:54:00', '{\"order_id\":\"CS-2018-cb67252753790f3e\",\"tracking_id\":\"307003842031\",\"bank_ref_no\":\"1527936469340\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"50.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Nashik, Maharashtra, India\",\"billing_city\":\"dndd\",\"billing_state\":\"maharashtra\",\"billing_zip\":\"4545455\",\"billing_country\":\"India\",\"billing_tel\":\"89898998\",\"billing_email\":\"dsdds@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Nashik, Maharashtra, India\",\"delivery_city\":\"dndd\",\"delivery_state\":\"maharashtra\",\"delivery_zip\":\"4545455\",\"delivery_country\":\"India\",\"delivery_tel\":\"89898998\",\"merchant_param1\":\"\",\"merchant_param2\":\"gift_card\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"50.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"02\\/06\\/2018 16:17:54\",\"bin_country\":\"\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\",\"user_gift_card_id\":24,\"trans_type\":\"2\"}', '2018-06-02 05:18:05', '2018-06-02 05:18:05'),
(10, '307003842037', 'CS-2018-30ec6bc2227eb8d8', 0, 0, 25, 0, 0, '1527936645248', 'Success', '1', 'AvenuesTest', 'INR', 250.00, 'Nayan Pawar', 'Nashik, Maharashtra, India', 'jalgaon', 'India', 'adssd@gmail.com', '89898998', 'India', '422001', 'Maharashtra', 'jalgaon', 'Nashik, Maharashtra, India', 'Nayan Pawar', '89898998', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '2', 60.56, '2018-06-07 05:54:00', '{\"order_id\":\"CS-2018-30ec6bc2227eb8d8\",\"tracking_id\":\"307003842037\",\"bank_ref_no\":\"1527936645248\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"250.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Nashik, Maharashtra, India\",\"billing_city\":\"jalgaon\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"89898998\",\"billing_email\":\"adssd@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Nashik, Maharashtra, India\",\"delivery_city\":\"jalgaon\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"89898998\",\"merchant_param1\":\"\",\"merchant_param2\":\"gift_card\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"250.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"02\\/06\\/2018 16:20:49\",\"bin_country\":\"\\b\\b\\b\\b\\b\\b\\b\\b\",\"user_gift_card_id\":25,\"trans_type\":\"2\",\"user_id\":1}', '2018-06-02 05:21:01', '2018-06-02 05:21:01'),
(11, '307003842043', 'CS-2018-f274abe5ab91acef', 1, 0, 26, 0, 0, '1527936765225', 'Success', '1', 'AvenuesTest', 'INR', 100.00, 'Nayan Pawar', 'Nashik, Maharashtra, India', 'Pune', 'India', 'badds@gmail.com', '89898998', 'India', '4545454', 'Maharashtra', 'Pune', 'Nashik, Maharashtra, India', 'Nayan Pawar', '89898998', '4545454', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '2', 60.56, '2018-06-07 05:54:00', '{\"order_id\":\"CS-2018-f274abe5ab91acef\",\"tracking_id\":\"307003842043\",\"bank_ref_no\":\"1527936765225\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"100.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Nashik, Maharashtra, India\",\"billing_city\":\"Pune\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"4545454\",\"billing_country\":\"India\",\"billing_tel\":\"89898998\",\"billing_email\":\"badds@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Nashik, Maharashtra, India\",\"delivery_city\":\"Pune\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"4545454\",\"delivery_country\":\"India\",\"delivery_tel\":\"89898998\",\"merchant_param1\":\"\",\"merchant_param2\":\"gift_card\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"100.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"02\\/06\\/2018 16:22:49\",\"bin_country\":\"\\f\\f\\f\\f\\f\\f\\f\\f\\f\\f\\f\\f\",\"user_gift_card_id\":26,\"trans_type\":\"2\",\"user_id\":1}', '2018-06-02 05:23:01', '2018-06-02 05:23:01'),
(12, '307003842057', 'CS-2018-af4c8eea109493ba', 1, 0, 27, 0, 0, '1527937277737', 'Success', '1', 'AvenuesTest', 'INR', 50.00, 'Nayan Pawar', 'Nashik, Maharashtra, India', 'Malegaon', 'India', 'dsdsd@gmail.com', '7878787887', 'India', '45454545', 'Maharashtra', 'Malegaon', 'Nashik, Maharashtra, India', 'Nayan Pawar', '7878787887', '45454545', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '2', 60.56, '2018-06-07 05:54:00', '{\"order_id\":\"CS-2018-af4c8eea109493ba\",\"tracking_id\":\"307003842057\",\"bank_ref_no\":\"1527937277737\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"50.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Nashik, Maharashtra, India\",\"billing_city\":\"Malegaon\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"45454545\",\"billing_country\":\"India\",\"billing_tel\":\"7878787887\",\"billing_email\":\"dsdsd@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Nashik, Maharashtra, India\",\"delivery_city\":\"Malegaon\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"45454545\",\"delivery_country\":\"India\",\"delivery_tel\":\"7878787887\",\"merchant_param1\":\"\",\"merchant_param2\":\"gift_card\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"50.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"02\\/06\\/2018 16:31:22\",\"bin_country\":\"\\u0010\\u0010\\u0010\\u0010\\u0010\\u0010\\u0010\\u0010\\u0010\\u0010\\u0010\\u0010\\u0010\\u0010\\u0010\\u0010\",\"user_gift_card_id\":27,\"trans_type\":\"2\",\"user_id\":1}', '2018-06-02 05:31:34', '2018-06-02 05:31:34'),
(13, '883777700834', 'AM-1528087612', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 18244.25, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-03 23:16:52', '2018-06-03 23:16:52'),
(14, '307003844487', 'AM-1528087687', 1, 0, NULL, 0, 0, '1528087705016', 'Success', '1', 'AvenuesTest', 'INR', 18244.25, 'Nayan Pawar', 'Indira nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 60.56, '2018-06-07 05:54:00', '{\"order_id\":\"AM-1528087687\",\"tracking_id\":\"307003844487\",\"bank_ref_no\":\"1528087705016\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"18244.25\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"18244.25\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"04\\/06\\/2018 10:18:30\",\"bin_country\":\"\\t\\t\\t\\t\\t\\t\\t\\t\\t\"}', '2018-06-03 23:18:07', '2018-06-04 00:13:29'),
(15, '307003844665', 'AM-1528091089', 1, 0, NULL, 0, 0, '1528091106509', 'Success', '1', 'AvenuesTest', 'INR', 18244.25, 'Nayan Pawar', 'Indira nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 60.56, '2018-06-07 05:54:00', '{\"order_id\":\"AM-1528091089\",\"tracking_id\":\"307003844665\",\"bank_ref_no\":\"1528091106509\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"18244.25\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"18244.25\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"04\\/06\\/2018 11:15:11\",\"bin_country\":\"\\t\\t\\t\\t\\t\\t\\t\\t\\t\"}', '2018-06-04 00:14:49', '2018-06-04 01:32:06'),
(16, '307003845111', 'AM-1528096774', 1, 0, NULL, 0, 0, '1528096798882', 'Success', '1', 'AvenuesTest', 'INR', 18244.25, 'Nayan Pawar', 'Indira nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 60.56, '2018-06-07 05:54:00', '{\"order_id\":\"AM-1528096774\",\"tracking_id\":\"307003845111\",\"bank_ref_no\":\"1528096798882\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"18244.25\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"18244.25\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"04\\/06\\/2018 12:50:03\",\"bin_country\":\"\\t\\t\\t\\t\\t\\t\\t\\t\\t\"}', '2018-06-04 01:49:34', '2018-06-04 01:50:04'),
(17, '918552351319', 'AM-1528113647', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-04 06:30:48', '2018-06-04 06:30:48'),
(18, '712343117929', 'AM-1528114534', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-04 06:45:34', '2018-06-04 06:45:34'),
(19, '307003847293', 'CS-2018-9ee57308fe1e8318', 1, 0, 28, 0, 0, '1528114788503', 'Success', '1', 'AvenuesTest', 'INR', 100.00, 'Nayan Pawar', 'Nashik, Maharashtra, India', 'vsabv', 'India', 'sagirixu@yk20.com', '9850401386', 'India', '1241565', 'sdlfknfdnjknbf', 'vsabv', 'Nashik, Maharashtra, India', 'Nayan Pawar', '9850401386', '1241565', 'sdlfknfdnjknbf', 'Y', 'null', 'Net Banking', '', '2', 60.56, '2018-06-07 05:54:00', '{\"order_id\":\"CS-2018-9ee57308fe1e8318\",\"tracking_id\":\"307003847293\",\"bank_ref_no\":\"1528114788503\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"100.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Nashik, Maharashtra, India\",\"billing_city\":\"vsabv\",\"billing_state\":\"sdlfknfdnjknbf\",\"billing_zip\":\"1241565\",\"billing_country\":\"India\",\"billing_tel\":\"9850401386\",\"billing_email\":\"sagirixu@yk20.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Nashik, Maharashtra, India\",\"delivery_city\":\"vsabv\",\"delivery_state\":\"sdlfknfdnjknbf\",\"delivery_zip\":\"1241565\",\"delivery_country\":\"India\",\"delivery_tel\":\"9850401386\",\"merchant_param1\":\"\",\"merchant_param2\":\"gift_card\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"100.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"04\\/06\\/2018 17:49:54\",\"bin_country\":\"\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\",\"user_gift_card_id\":28,\"trans_type\":\"2\",\"user_id\":1}', '2018-06-04 06:49:58', '2018-06-04 06:49:58'),
(20, '211458627432', 'AM-1528116127', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-04 07:12:07', '2018-06-04 07:12:07'),
(21, '307003847415', 'AM-1528116234', 1, 0, NULL, 0, 0, '1528116246376', 'Success', '1', 'AvenuesTest', 'INR', 221350.00, 'Nayan Pawar', 'Indira nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 60.56, '2018-06-07 05:54:00', '{\"order_id\":\"AM-1528116234\",\"tracking_id\":\"307003847415\",\"bank_ref_no\":\"1528116246376\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"221350.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"221350.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"04\\/06\\/2018 18:14:11\",\"bin_country\":\"\\t\\t\\t\\t\\t\\t\\t\\t\\t\",\"trans_type\":\"2\"}', '2018-06-04 07:13:55', '2018-06-04 07:34:02'),
(22, '639171064344', 'AM-1528118619', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 21185.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-04 07:53:39', '2018-06-04 07:53:39'),
(23, '713109105131', 'AM-1528119053', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 21185.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-04 08:00:53', '2018-06-04 08:00:53'),
(24, '478379026261', 'AM-1528120059', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 21185.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-04 08:17:39', '2018-06-04 08:17:39'),
(25, '011331611761', 'AM-1528262499', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 1159712.50, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-05 23:51:40', '2018-06-05 23:51:40'),
(26, '981989207601', 'AM-1528262908', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 21185.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-05 23:58:28', '2018-06-05 23:58:28'),
(27, '060974461312', 'AM-1528263164', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 21185.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 00:02:44', '2018-06-06 00:02:44'),
(28, '668279526155', 'AM-1528263695', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 00:11:35', '2018-06-06 00:11:35'),
(29, '492760596927', 'AM-1528263783', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 00:13:03', '2018-06-06 00:13:03'),
(30, '043330550949', 'AM-1528263787', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 00:13:07', '2018-06-06 00:13:07'),
(31, '771554008955', 'AM-1528265317', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 00:38:38', '2018-06-06 00:38:38'),
(32, '558593738440', 'AM-1528265344', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 00:39:04', '2018-06-06 00:39:04'),
(33, '132404073032', 'AM-1528265413', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 00:40:13', '2018-06-06 00:40:13'),
(34, '240082472148', 'AM-1528265558', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 00:42:38', '2018-06-06 00:42:38'),
(35, '175871831121', 'AM-1528265706', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 00:45:06', '2018-06-06 00:45:06'),
(36, '379712758750', 'AM-1528265837', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 00:47:18', '2018-06-06 00:47:18'),
(37, '336192777968', 'AM-1528266200', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 00:53:20', '2018-06-06 00:53:20'),
(38, '522034809620', 'AM-1528266270', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 00:54:30', '2018-06-06 00:54:30'),
(39, '936936258527', 'AM-1528266312', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 00:55:12', '2018-06-06 00:55:12'),
(40, '990566913085', 'AM-1528266324', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 00:55:25', '2018-06-06 00:55:25'),
(41, '092539130607', 'AM-1528266381', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 00:56:21', '2018-06-06 00:56:21'),
(42, '802939484700', 'AM-1528266537', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 00:58:58', '2018-06-06 00:58:58'),
(43, '076491983091', 'AM-1528267345', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:12:25', '2018-06-06 01:12:25'),
(44, '132016875973', 'AM-1528267429', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:13:49', '2018-06-06 01:13:49'),
(45, '619072613020', 'AM-1528267484', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:14:44', '2018-06-06 01:14:44'),
(46, '839758330964', 'AM-1528267510', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:15:10', '2018-06-06 01:15:10'),
(47, '702189710945', 'AM-1528267533', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:15:33', '2018-06-06 01:15:33'),
(48, '430993519623', 'AM-1528267550', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:15:51', '2018-06-06 01:15:51'),
(49, '301910625664', 'AM-1528267570', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:16:10', '2018-06-06 01:16:10'),
(50, '031120849490', 'AM-1528267594', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:16:34', '2018-06-06 01:16:34'),
(51, '717806500968', 'AM-1528267624', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:17:04', '2018-06-06 01:17:04'),
(52, '180466208192', 'AM-1528267639', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:17:19', '2018-06-06 01:17:19'),
(53, '530837032579', 'AM-1528267663', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:17:43', '2018-06-06 01:17:43'),
(54, '514905671712', 'AM-1528267753', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:19:13', '2018-06-06 01:19:13'),
(55, '589026151973', 'AM-1528267784', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:19:44', '2018-06-06 01:19:44'),
(56, '359423172950', 'AM-1528267816', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:20:16', '2018-06-06 01:20:16'),
(57, '574130131117', 'AM-1528267839', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:20:39', '2018-06-06 01:20:39'),
(58, '619322759123', 'AM-1528267883', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:21:24', '2018-06-06 01:21:24'),
(59, '138288160538', 'AM-1528267901', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:21:41', '2018-06-06 01:21:41'),
(60, '711508170230', 'AM-1528267930', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:22:10', '2018-06-06 01:22:10'),
(61, '798300951271', 'AM-1528267962', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:22:42', '2018-06-06 01:22:42'),
(62, '608308055809', 'AM-1528267983', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:23:03', '2018-06-06 01:23:03'),
(63, '640602000452', 'AM-1528268026', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:23:46', '2018-06-06 01:23:46'),
(64, '688849655778', 'AM-1528268060', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:24:20', '2018-06-06 01:24:20'),
(65, '938942265878', 'AM-1528268117', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:25:17', '2018-06-06 01:25:17'),
(66, '831667320799', 'AM-1528268232', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:27:12', '2018-06-06 01:27:12'),
(67, '858702341998', 'AM-1528268380', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:29:40', '2018-06-06 01:29:40'),
(68, '159118754443', 'AM-1528268497', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 242535.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:31:37', '2018-06-06 01:31:37'),
(69, '903365576306', 'AM-1528268541', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 242535.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:32:22', '2018-06-06 01:32:22'),
(70, '463220441330', 'AM-1528268536', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 242535.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:32:16', '2018-06-06 01:32:16'),
(71, '307003851977', 'AM-1528268660', 1, 0, NULL, 0, 0, '1528268666455', 'Success', '1', 'AvenuesTest', 'INR', 263720.00, 'Nayan Pawar', 'Indira nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 60.56, '2018-06-07 05:54:00', '{\"order_id\":\"AM-1528268660\",\"tracking_id\":\"307003851977\",\"bank_ref_no\":\"1528268666455\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"263720.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"263720.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"06\\/06\\/2018 12:34:32\",\"bin_country\":\"\\t\\t\\t\\t\\t\\t\\t\\t\\t\",\"trans_type\":\"2\"}', '2018-06-06 01:34:21', '2018-06-06 01:34:40'),
(72, '828748500875', 'AM-1528268713', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 263720.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:35:14', '2018-06-06 01:35:14'),
(73, '261016866005', 'AM-1528268732', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 263720.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:35:32', '2018-06-06 01:35:32'),
(74, '083460214007', 'AM-1528268790', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 263720.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:36:31', '2018-06-06 01:36:31'),
(75, '804485425541', 'AM-1528268848', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 263720.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:37:28', '2018-06-06 01:37:28'),
(76, '802630885662', 'AM-1528268948', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 263720.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:39:09', '2018-06-06 01:39:09'),
(77, '008989837139', 'AM-1528269040', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 263720.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:40:40', '2018-06-06 01:40:40'),
(78, '918164940771', 'AM-1528269083', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 263720.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:41:23', '2018-06-06 01:41:23'),
(79, '999667147044', 'AM-1528269103', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 263720.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:41:43', '2018-06-06 01:41:43'),
(80, '440155493385', 'AM-1528269222', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 263720.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:43:42', '2018-06-06 01:43:42'),
(81, '338913545064', 'AM-1528269297', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 263720.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:44:57', '2018-06-06 01:44:57'),
(82, '853880800882', 'AM-1528269321', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 263720.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:45:21', '2018-06-06 01:45:21'),
(83, '559518140747', 'AM-1528269361', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 263720.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:46:01', '2018-06-06 01:46:01'),
(84, '482577585835', 'AM-1528269416', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 263720.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:46:56', '2018-06-06 01:46:56'),
(85, '965406823560', 'AM-1528269485', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 284905.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:48:05', '2018-06-06 01:48:05'),
(86, '307003852037', 'AM-1528269506', 1, 0, NULL, 0, 0, '1528269503037', 'Success', '1', 'AvenuesTest', 'INR', 284905.00, 'Nayan Pawar', 'Indira nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 60.56, '2018-06-07 05:54:00', '{\"order_id\":\"AM-1528269506\",\"tracking_id\":\"307003852037\",\"bank_ref_no\":\"1528269503037\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"284905.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"284905.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"06\\/06\\/2018 12:48:29\",\"bin_country\":\"\\t\\t\\t\\t\\t\\t\\t\\t\\t\",\"trans_type\":\"2\"}', '2018-06-06 01:48:27', '2018-06-06 01:48:36'),
(87, '381661426896', 'AM-1528269532', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 284905.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:48:52', '2018-06-06 01:48:52'),
(88, '820523498223', 'AM-1528269637', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 284905.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:50:37', '2018-06-06 01:50:37'),
(89, '848174255558', 'AM-1528269693', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 284905.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:51:34', '2018-06-06 01:51:34'),
(90, '117591819367', 'AM-1528269723', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 284905.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:52:04', '2018-06-06 01:52:04'),
(91, '248400656276', 'AM-1528269743', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 284905.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:52:24', '2018-06-06 01:52:24'),
(92, '150353592384', 'AM-1528269760', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 284905.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:52:41', '2018-06-06 01:52:41'),
(93, '656345123305', 'AM-1528269777', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 284905.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:52:57', '2018-06-06 01:52:57'),
(94, '332105113185', 'AM-1528269788', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 284905.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:53:09', '2018-06-06 01:53:09'),
(95, '333955502011', 'AM-1528269889', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 284905.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:54:49', '2018-06-06 01:54:49'),
(96, '307003852059', 'AM-1528269908', 1, 0, NULL, 0, 0, '1528269908169', 'Success', '1', 'AvenuesTest', 'INR', 284905.00, 'Nayan Pawar', 'Indira nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 60.56, '2018-06-07 05:54:00', '{\"order_id\":\"AM-1528269908\",\"tracking_id\":\"307003852059\",\"bank_ref_no\":\"1528269908169\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"284905.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"284905.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"06\\/06\\/2018 12:55:14\",\"bin_country\":\"\\t\\t\\t\\t\\t\\t\\t\\t\\t\",\"trans_type\":\"2\"}', '2018-06-06 01:55:08', '2018-06-06 01:55:21'),
(97, '192408033746', 'AM-1528269910', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 284905.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:55:10', '2018-06-06 01:55:10'),
(98, '307003852067', 'AM-1528270112', 1, 0, NULL, 0, 0, '1528270110178', 'Success', '1', 'AvenuesTest', 'INR', 284905.00, 'Nayan Pawar', 'Indira nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 60.56, '2018-06-07 05:54:00', '{\"order_id\":\"AM-1528270112\",\"tracking_id\":\"307003852067\",\"bank_ref_no\":\"1528270110178\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"284905.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"284905.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"06\\/06\\/2018 12:58:36\",\"bin_country\":\"\\t\\t\\t\\t\\t\\t\\t\\t\\t\",\"trans_type\":\"2\"}', '2018-06-06 01:58:33', '2018-06-06 01:58:44'),
(99, '534499397614', 'AM-1528270179', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 284905.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 01:59:39', '2018-06-06 01:59:39'),
(100, '032753053402', 'AM-1528270226', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 284905.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 02:00:27', '2018-06-06 02:00:27'),
(101, '963343535891', 'AM-1528270243', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 284905.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 02:00:43', '2018-06-06 02:00:43'),
(102, '179229581737', 'AM-1528270261', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 284905.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 02:01:01', '2018-06-06 02:01:01'),
(103, '929625547881', 'AM-1528270284', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 284905.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 02:01:24', '2018-06-06 02:01:24'),
(104, '262317097305', 'AM-1528270310', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 284905.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 02:01:51', '2018-06-06 02:01:51'),
(105, '734432389089', 'AM-1528274504', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 284905.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 03:11:45', '2018-06-06 03:11:45'),
(106, '840579479912', 'AM-1528274744', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 03:15:44', '2018-06-06 03:15:44'),
(107, '189967427046', 'AM-1528274802', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 03:16:43', '2018-06-06 03:16:43'),
(108, '245040833862', 'AM-1528274837', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 60.56, '2018-06-07 05:54:00', NULL, '2018-06-06 03:17:17', '2018-06-06 03:17:17');
INSERT INTO `transactions` (`transaction_id`, `tracking_id`, `order_id`, `user_id`, `product_id`, `user_gift_card_id`, `return_product_request_id`, `replacement_product_request_id`, `bank_ref_no`, `order_status`, `payment_status`, `card_name`, `currency`, `amount`, `billing_name`, `billing_address`, `billing_city`, `billing_country`, `billing_email`, `delivery_tel`, `delivery_country`, `delivery_zip`, `delivery_state`, `delivery_city`, `delivery_address`, `delivery_name`, `billing_tel`, `billing_zip`, `billing_state`, `status_message`, `status_code`, `payment_mode`, `failure_message`, `trans_type`, `transaction_usd_value`, `trans_date`, `response_data`, `created_at`, `updated_at`) VALUES
(109, '307003852757', 'CS-2018-6ada2649f48329e6', 1, 0, 29, 0, 0, '1528280492519', 'Success', '1', 'AvenuesTest', 'INR', 50.00, 'Nayan Pawar', 'Nashik, Maharashtra, India', 'Dhule', 'India', 'toceyi@creazionisa.com', '9922276924', 'India', '422001', 'Maharashtra', 'Dhule', 'Nashik, Maharashtra, India', 'Nayan Pawar', '9922276924', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '2', 60.56, '2018-06-07 05:54:00', '{\"order_id\":\"CS-2018-6ada2649f48329e6\",\"tracking_id\":\"307003852757\",\"bank_ref_no\":\"1528280492519\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"50.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Nashik, Maharashtra, India\",\"billing_city\":\"Dhule\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"9922276924\",\"billing_email\":\"toceyi@creazionisa.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Nashik, Maharashtra, India\",\"delivery_city\":\"Dhule\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"9922276924\",\"merchant_param1\":\"\",\"merchant_param2\":\"gift_card\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"50.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"06\\/06\\/2018 15:51:39\",\"bin_country\":\"\\u0003\\u0003\\u0003\",\"user_gift_card_id\":29,\"trans_type\":\"2\",\"user_id\":1}', '2018-06-06 04:51:55', '2018-06-06 04:51:55'),
(110, '003968351886', 'AM-1528352064', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 681758.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 67.00, '2018-06-11 12:06:56', NULL, '2018-06-07 00:44:25', '2018-06-07 00:44:25'),
(111, '307003857478', 'CS-2018-29190552650d91e5', 1, 0, 30, 0, 0, '1528369972405', 'Success', '1', 'AvenuesTest', 'INR', 50.00, 'Nayan Pawar', 'Nashik, Maharashtra, India', 'Nashik', 'India', 'djksdjksd@gmail.com', '898988998', 'India', '4555444', 'Maharashtra', 'Nashik', 'Nashik, Maharashtra, India', 'Nayan Pawar', '898988998', '4555444', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '2', 67.00, '2018-06-11 12:06:53', '{\"order_id\":\"CS-2018-29190552650d91e5\",\"tracking_id\":\"307003857478\",\"bank_ref_no\":\"1528369972405\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"50.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Nashik, Maharashtra, India\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"4555444\",\"billing_country\":\"India\",\"billing_tel\":\"898988998\",\"billing_email\":\"djksdjksd@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Nashik, Maharashtra, India\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"4555444\",\"delivery_country\":\"India\",\"delivery_tel\":\"898988998\",\"merchant_param1\":\"\",\"merchant_param2\":\"gift_card\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"50.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"07\\/06\\/2018 16:42:59\",\"bin_country\":\"\\u0004\\u0004\\u0004\\u0004\",\"user_gift_card_id\":30,\"trans_type\":\"2\",\"user_id\":1}', '2018-06-07 05:43:15', '2018-06-07 05:43:15'),
(112, '307003857487', 'CS-2018-e6294d7856c03df1', 1, 0, 31, 0, 0, '1528370066618', 'Success', '1', 'AvenuesTest', 'INR', 100.00, 'Nayan Pawar', 'Nashik, Maharashtra, India', 'Nahsik', 'India', 'dsdsd@gmail.com', '89899898', 'India', '45454545', 'Maharashtra', 'Nahsik', 'Nashik, Maharashtra, India', 'Nayan Pawar', '89899898', '45454545', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '2', 67.00, '2018-06-11 12:06:51', '{\"order_id\":\"CS-2018-e6294d7856c03df1\",\"tracking_id\":\"307003857487\",\"bank_ref_no\":\"1528370066618\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"100.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Nashik, Maharashtra, India\",\"billing_city\":\"Nahsik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"45454545\",\"billing_country\":\"India\",\"billing_tel\":\"89899898\",\"billing_email\":\"dsdsd@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Nashik, Maharashtra, India\",\"delivery_city\":\"Nahsik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"45454545\",\"delivery_country\":\"India\",\"delivery_tel\":\"89899898\",\"merchant_param1\":\"\",\"merchant_param2\":\"gift_card\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"100.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"07\\/06\\/2018 16:44:33\",\"bin_country\":\"\\u0006\\u0006\\u0006\\u0006\\u0006\\u0006\",\"user_gift_card_id\":31,\"trans_type\":\"2\",\"user_id\":1}', '2018-06-07 05:44:45', '2018-06-07 05:44:45'),
(113, '307003857497', 'CS-2018-fad65b9b34b6aa60', 1, 0, 33, 0, 0, '1528370164532', 'Success', '1', 'AvenuesTest', 'INR', 50.00, 'Nayan Pawar', 'Nashik, Maharashtra, India', '454545', 'India', 'DSDDS@GMAIL.COM', '4554857878', 'India', 'DSSD', 'DSSDSD', '454545', 'Nashik, Maharashtra, India', 'Nayan Pawar', '4554857878', 'DSSD', 'DSSDSD', 'Y', 'null', 'Net Banking', '', '2', 67.00, '2018-06-11 12:06:48', '{\"order_id\":\"CS-2018-fad65b9b34b6aa60\",\"tracking_id\":\"307003857497\",\"bank_ref_no\":\"1528370164532\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"50.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Nashik, Maharashtra, India\",\"billing_city\":\"454545\",\"billing_state\":\"DSSDSD\",\"billing_zip\":\"DSSD\",\"billing_country\":\"India\",\"billing_tel\":\"4554857878\",\"billing_email\":\"DSDDS@GMAIL.COM\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Nashik, Maharashtra, India\",\"delivery_city\":\"454545\",\"delivery_state\":\"DSSDSD\",\"delivery_zip\":\"DSSD\",\"delivery_country\":\"India\",\"delivery_tel\":\"4554857878\",\"merchant_param1\":\"\",\"merchant_param2\":\"gift_card\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"50.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"07\\/06\\/2018 16:46:11\",\"bin_country\":\"\\u0006\\u0006\\u0006\\u0006\\u0006\\u0006\",\"user_gift_card_id\":33,\"trans_type\":\"2\",\"user_id\":1}', '2018-06-07 05:46:52', '2018-06-07 05:46:52'),
(114, '307003857514', 'CS-2018-50c626357c993f0a', 1, 0, 34, 0, 0, '1528370337629', 'Success', '1', 'AvenuesTest', 'INR', 50.00, 'Nayan Pawar', 'Nashik, Maharashtra, India', 'dsds', 'India', 'sdsd@gmail.com', '78787878', 'India', '45454545', 'dsksd', 'dsds', 'Nashik, Maharashtra, India', 'Nayan Pawar', '78787878', '45454545', 'dsksd', 'Y', 'null', 'Net Banking', '', '2', 67.00, '2018-06-11 12:06:46', '{\"order_id\":\"CS-2018-50c626357c993f0a\",\"tracking_id\":\"307003857514\",\"bank_ref_no\":\"1528370337629\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"50.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Nashik, Maharashtra, India\",\"billing_city\":\"dsds\",\"billing_state\":\"dsksd\",\"billing_zip\":\"45454545\",\"billing_country\":\"India\",\"billing_tel\":\"78787878\",\"billing_email\":\"sdsd@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Nashik, Maharashtra, India\",\"delivery_city\":\"dsds\",\"delivery_state\":\"dsksd\",\"delivery_zip\":\"45454545\",\"delivery_country\":\"India\",\"delivery_tel\":\"78787878\",\"merchant_param1\":\"\",\"merchant_param2\":\"gift_card\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"50.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"07\\/06\\/2018 16:49:04\",\"bin_country\":\"\\t\\t\\t\\t\\t\\t\\t\\t\\t\",\"user_gift_card_id\":34,\"trans_type\":\"2\",\"user_id\":1}', '2018-06-07 05:49:15', '2018-06-07 05:49:15'),
(115, '307003857525', 'CS-2018-8f176c0ecbb28a8f', 1, 0, 35, 0, 0, '1528370422136', 'Success', '1', 'AvenuesTest', 'INR', 50.00, 'Nayan Pawar', 'Nashik, Maharashtra, India', 'dss', 'Jamaica', 'dsd@gmail.com', '898998', 'Jamaica', '544545', 'sdksdjk', 'dss', 'Nashik, Maharashtra, India', 'Nayan Pawar', '898998', '544545', 'sdksdjk', 'Y', 'null', 'Net Banking', '', '2', 67.00, '2018-06-11 12:06:44', '{\"order_id\":\"CS-2018-8f176c0ecbb28a8f\",\"tracking_id\":\"307003857525\",\"bank_ref_no\":\"1528370422136\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"50.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Nashik, Maharashtra, India\",\"billing_city\":\"dss\",\"billing_state\":\"sdksdjk\",\"billing_zip\":\"544545\",\"billing_country\":\"Jamaica\",\"billing_tel\":\"898998\",\"billing_email\":\"dsd@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Nashik, Maharashtra, India\",\"delivery_city\":\"dss\",\"delivery_state\":\"sdksdjk\",\"delivery_zip\":\"544545\",\"delivery_country\":\"Jamaica\",\"delivery_tel\":\"898998\",\"merchant_param1\":\"\",\"merchant_param2\":\"gift_card\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"50.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"07\\/06\\/2018 16:50:29\",\"bin_country\":\"\\f\\f\\f\\f\\f\\f\\f\\f\\f\\f\\f\\f\",\"user_gift_card_id\":35,\"trans_type\":\"2\",\"user_id\":1}', '2018-06-07 05:50:40', '2018-06-07 05:50:40'),
(116, '307003857545', 'CS-2018-3556eb80446e9fe0', 1, 0, 36, 0, 0, '1528370766853', 'Success', '1', 'AvenuesTest', 'INR', 50.00, 'Nayan Pawar', 'Nashik, Maharashtra, India', 'ddsjk', 'India', 'dsdsd@gmail.com', '89899898', 'India', '454545', 'dskfjkdl', 'ddsjk', 'Nashik, Maharashtra, India', 'Nayan Pawar', '89899898', '454545', 'dskfjkdl', 'Y', 'null', 'Net Banking', '', '2', 67.00, '2018-06-07 05:56:31', '{\"order_id\":\"CS-2018-3556eb80446e9fe0\",\"tracking_id\":\"307003857545\",\"bank_ref_no\":\"1528370766853\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"50.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Nashik, Maharashtra, India\",\"billing_city\":\"ddsjk\",\"billing_state\":\"dskfjkdl\",\"billing_zip\":\"454545\",\"billing_country\":\"India\",\"billing_tel\":\"89899898\",\"billing_email\":\"dsdsd@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Nashik, Maharashtra, India\",\"delivery_city\":\"ddsjk\",\"delivery_state\":\"dskfjkdl\",\"delivery_zip\":\"454545\",\"delivery_country\":\"India\",\"delivery_tel\":\"89899898\",\"merchant_param1\":\"\",\"merchant_param2\":\"gift_card\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"50.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"07\\/06\\/2018 16:56:14\",\"bin_country\":\"\\u0004\\u0004\\u0004\\u0004\",\"user_gift_card_id\":36,\"trans_type\":\"2\",\"user_id\":1}', '2018-06-07 05:56:31', '2018-06-07 05:56:31'),
(117, '564599457205', 'AM-1528453996', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 681758.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 67.00, NULL, NULL, '2018-06-08 05:03:16', '2018-06-08 05:03:16'),
(118, '196432255779', 'AM-1528454370', 3, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 67.00, NULL, NULL, '2018-06-08 05:09:31', '2018-06-08 05:09:31'),
(119, '307003861337', 'CS-2018-9adfdd36a5075d9d', 1, 0, 37, 0, 0, '1528465446589', 'Success', '1', 'AvenuesTest', 'INR', 50.00, 'Nayan Pawar', 'Indira nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '2', 67.00, '2018-06-08 08:14:29', '{\"order_id\":\"CS-2018-9adfdd36a5075d9d\",\"tracking_id\":\"307003861337\",\"bank_ref_no\":\"1528465446589\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"50.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"gift_card\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"50.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"08\\/06\\/2018 19:14:14\",\"bin_country\":\"\\u0004\\u0004\\u0004\\u0004\",\"user_gift_card_id\":37,\"trans_type\":\"2\",\"user_id\":1}', '2018-06-08 08:14:29', '2018-06-08 08:14:29'),
(120, '548866815357', 'AM-1528689995', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 681758.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 67.00, NULL, NULL, '2018-06-10 22:36:35', '2018-06-10 22:36:35'),
(121, '', '', 1, 25, NULL, 1, 0, NULL, 'Success', '1', NULL, 'INR', 1200.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'bank', '', '3', 69.00, '2018-06-11 06:31:43', NULL, '2018-06-11 06:31:43', '2018-06-11 06:31:43'),
(122, '', '', 1, 25, NULL, 0, 1, NULL, 'Success', '1', NULL, 'INR', 1000.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '4', 69.00, '2018-06-11 07:02:33', NULL, '2018-06-11 07:02:33', '2018-06-11 07:02:33'),
(123, '307003884841', 'CS-2018-d9a895ad11294408', 1, 0, 38, 0, 0, '1529304372077', 'Success', '1', 'AvenuesTest', 'INR', 250.00, 'Nayan Pawar', 'uttam nagar new Nashik', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422008', 'Maharashtra', 'Nashik', 'uttam nagar new Nashik', 'Nayan Pawar', '8458458544', '422008', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '2', 69.00, '2018-06-18 06:46:21', '{\"order_id\":\"CS-2018-d9a895ad11294408\",\"tracking_id\":\"307003884841\",\"bank_ref_no\":\"1529304372077\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"250.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"uttam nagar new Nashik\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"uttam nagar new Nashik\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"gift_card\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"250.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"18\\/06\\/2018 12:16:24\",\"bin_country\":\"\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\",\"user_gift_card_id\":38,\"trans_type\":\"2\",\"user_id\":1}', '2018-06-18 06:46:21', '2018-06-18 06:46:21'),
(124, '307003885281', 'AM-1529310448', 13, 0, NULL, 0, 0, '1529310479574', 'Success', '1', 'AvenuesTest', 'INR', 231060.75, 'Anna Adam', 'samarth chowk , upendra nagar,', 'Nashik', 'India', 'anna.adam51@yahoo.com', '9638527412', 'India', '422008', 'maharashtra', 'Nashik', 'samarth chowk , upendra nagar,', 'Anna Adam', '9638527412', '422008', 'maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529310448\",\"tracking_id\":\"307003885281\",\"bank_ref_no\":\"1529310479574\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"231060.75\",\"billing_name\":\"Anna Adam\",\"billing_address\":\"samarth chowk , upendra nagar,\",\"billing_city\":\"Nashik\",\"billing_state\":\"maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9638527412\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Anna Adam\",\"delivery_address\":\"samarth chowk , upendra nagar,\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9638527412\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"231060.75\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"18\\/06\\/2018 13:58:12\",\"bin_country\":\"\\u0001\",\"trans_type\":\"2\"}', '2018-06-18 08:27:28', '2018-06-18 08:28:12'),
(125, '', '', 13, 25, NULL, 2, 0, NULL, 'Success', '1', NULL, 'INR', 20000.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '3', 69.00, '2018-06-18 08:47:58', NULL, '2018-06-18 08:47:58', '2018-06-18 08:47:58'),
(126, '307003885428', 'AM-1529312934', 13, 0, NULL, 0, 0, '1529312961454', 'Success', '1', 'AvenuesTest', 'INR', 22300.00, 'Anna Adam', 'samarth chowk , upendra nagar,', 'Nashik', 'India', 'anna.adam51@yahoo.com', '9638527412', 'India', '422008', 'maharashtra', 'Nashik', 'samarth chowk , upendra nagar,', 'Anna Adam', '9638527412', '422008', 'maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529312934\",\"tracking_id\":\"307003885428\",\"bank_ref_no\":\"1529312961454\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"22300.0\",\"billing_name\":\"Anna Adam\",\"billing_address\":\"samarth chowk , upendra nagar,\",\"billing_city\":\"Nashik\",\"billing_state\":\"maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9638527412\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Anna Adam\",\"delivery_address\":\"samarth chowk , upendra nagar,\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9638527412\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"22300.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"18\\/06\\/2018 14:39:34\",\"bin_country\":\"\\u0005\\u0005\\u0005\\u0005\\u0005\",\"trans_type\":\"2\"}', '2018-06-18 09:08:54', '2018-06-18 09:09:28'),
(127, '175810695276', 'AM-1529313050', 13, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 21185.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 69.00, NULL, NULL, '2018-06-18 09:10:50', '2018-06-18 09:10:50'),
(128, '255072535024', 'AM-1529313472', 13, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 21185.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 69.00, NULL, NULL, '2018-06-18 09:17:52', '2018-06-18 09:17:52'),
(129, '525104755016', 'AM-1529314444', 13, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 221350.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 69.00, NULL, NULL, '2018-06-18 09:34:04', '2018-06-18 09:34:04'),
(130, '', '', 13, 25, NULL, 3, 0, NULL, 'Success', '1', NULL, 'INR', 25000.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '3', 69.00, '2018-06-18 10:24:48', NULL, '2018-06-18 10:24:48', '2018-06-18 10:24:48'),
(131, '', '', 13, 25, NULL, 0, 1, NULL, 'Success', '1', NULL, 'INR', 180000.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '4', 69.00, '2018-06-18 10:57:09', NULL, '2018-06-18 10:57:09', '2018-06-18 10:57:09'),
(132, '', '', 13, 25, NULL, 1, 0, NULL, 'Success', '1', NULL, 'INR', 180000.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '3', 69.00, '2018-06-18 10:58:15', NULL, '2018-06-18 10:58:15', '2018-06-18 10:58:15'),
(133, '664742912662', 'AM-1529324889', 13, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 22300.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 69.00, NULL, NULL, '2018-06-18 12:28:09', '2018-06-18 12:28:09'),
(134, '011589741433', 'AM-1529325580', 13, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 66097.20, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 69.00, NULL, NULL, '2018-06-18 12:39:40', '2018-06-18 12:39:40'),
(135, '812497902245', 'AM-1529325595', 13, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 66097.20, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 69.00, NULL, NULL, '2018-06-18 12:39:55', '2018-06-18 12:39:55'),
(136, '307003887235', 'AM-1529326063', 13, 0, NULL, 0, 0, '1529326194356', 'Success', '1', 'AvenuesTest', 'INR', 23192.00, 'Anna Adam', 'Uttam Nagar ,Pavan Nagar, Cidco', 'Nashik', 'India', 'anna.adam51@yahoo.com', '9638527412', 'India', '422008', 'Maharashtra', 'Nashik', 'Uttam Nagar ,Pavan Nagar, Cidco', 'Anna Adam', '9638527412', '422008', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529326063\",\"tracking_id\":\"307003887235\",\"bank_ref_no\":\"1529326194356\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"23192.0\",\"billing_name\":\"Anna Adam\",\"billing_address\":\"Uttam Nagar ,Pavan Nagar, Cidco\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9638527412\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Anna Adam\",\"delivery_address\":\"Uttam Nagar ,Pavan Nagar, Cidco\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9638527412\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"23192.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"18\\/06\\/2018 18:20:07\",\"bin_country\":\"\\u0003\\u0003\\u0003\",\"trans_type\":\"2\"}', '2018-06-18 12:47:43', '2018-06-18 12:50:00'),
(137, '738496573080', 'AM-1529326280', 13, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 21185.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 69.00, NULL, NULL, '2018-06-18 12:51:20', '2018-06-18 12:51:20'),
(138, '307003887396', 'AM-1529329089', 13, 0, NULL, 0, 0, '1529329145877', 'Success', '1', 'AvenuesTest', 'INR', 722935.00, 'Anna Adam', 'Uttam Nagar ,Pavan Nagar, Cidco', 'Nashik', 'India', 'anna.adam51@yahoo.com', '9638527412', 'India', '422008', 'Maharashtra', 'Nashik', 'Uttam Nagar ,Pavan Nagar, Cidco', 'Anna Adam', '9638527412', '422008', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529329089\",\"tracking_id\":\"307003887396\",\"bank_ref_no\":\"1529329145877\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"722935.0\",\"billing_name\":\"Anna Adam\",\"billing_address\":\"Uttam Nagar ,Pavan Nagar, Cidco\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9638527412\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Anna Adam\",\"delivery_address\":\"Uttam Nagar ,Pavan Nagar, Cidco\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9638527412\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"722935.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"18\\/06\\/2018 19:09:19\",\"bin_country\":\"\\u0001\",\"trans_type\":\"2\"}', '2018-06-18 13:38:09', '2018-06-18 13:39:09'),
(139, '', '', 13, 25, NULL, 0, 3, NULL, 'Success', '1', NULL, 'INR', 20000.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '4', 69.00, '2018-06-19 04:35:46', NULL, '2018-06-19 04:35:46', '2018-06-19 04:35:46'),
(140, '307003887886', 'AM-1529384478', 13, 0, NULL, 0, 0, '1529384493442', 'Success', '1', 'AvenuesTest', 'INR', 13366.38, 'Anna Adam', 'Uttam Nagar ,Pavan Nagar, Cidco', 'Nashik', 'India', 'anna.adam51@yahoo.com', '9638527412', 'India', '422008', 'Maharashtra', 'Nashik', 'Uttam Nagar ,Pavan Nagar, Cidco', 'Anna Adam', '9638527412', '422008', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529384478\",\"tracking_id\":\"307003887886\",\"bank_ref_no\":\"1529384493442\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"13366.38\",\"billing_name\":\"Anna Adam\",\"billing_address\":\"Uttam Nagar ,Pavan Nagar, Cidco\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9638527412\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Anna Adam\",\"delivery_address\":\"Uttam Nagar ,Pavan Nagar, Cidco\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9638527412\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"13366.38\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"19\\/06\\/2018 10:31:46\",\"bin_country\":\"\\u0001\",\"trans_type\":\"2\"}', '2018-06-19 05:01:18', '2018-06-19 05:01:37'),
(141, '', '', 13, 26, NULL, 0, 5, NULL, 'Success', '1', NULL, 'INR', 15000.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '4', 69.00, '2018-06-19 07:16:32', NULL, '2018-06-19 07:16:32', '2018-06-19 07:16:32'),
(142, '', '', 13, 26, NULL, 2, 0, NULL, 'Success', '1', NULL, 'INR', 15000.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'bank', '', '3', 69.00, '2018-06-19 07:20:58', NULL, '2018-06-19 07:20:58', '2018-06-19 07:20:58'),
(143, '307003888700', 'CS-2018-f6919be33e0ea4e3', 13, 0, 39, 0, 0, '1529397277514', 'Success', '1', 'AvenuesTest', 'INR', 250.00, 'Nilesh Vibhute', 'Pune, Maharashtra, India', 'Pune', 'India', 'anna.adam51@yahoo.com', '9638527412', 'India', '422008', 'Maharashtra', 'Pune', 'Pune, Maharashtra, India', 'Nilesh Vibhute', '9638527412', '422008', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '2', 69.00, '2018-06-19 08:34:45', '{\"order_id\":\"CS-2018-f6919be33e0ea4e3\",\"tracking_id\":\"307003888700\",\"bank_ref_no\":\"1529397277514\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"250.0\",\"billing_name\":\"Nilesh Vibhute\",\"billing_address\":\"Pune, Maharashtra, India\",\"billing_city\":\"Pune\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9638527412\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Nilesh Vibhute\",\"delivery_address\":\"Pune, Maharashtra, India\",\"delivery_city\":\"Pune\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9638527412\",\"merchant_param1\":\"\",\"merchant_param2\":\"gift_card\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"250.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"19\\/06\\/2018 14:04:50\",\"bin_country\":\"\\u0002\\u0002\",\"user_gift_card_id\":39,\"trans_type\":\"2\",\"user_id\":13}', '2018-06-19 08:34:45', '2018-06-19 08:34:45'),
(144, '307003888903', 'AM-1529399833', 13, 0, NULL, 0, 0, '1529399853491', 'Success', '1', 'AvenuesTest', 'INR', 46292.02, 'Anna Adam', 'Uttam Nagar ,Pavan Nagar, Cidco', 'Nashik', 'India', 'anna.adam51@yahoo.com', '9638527412', 'India', '422008', 'Maharashtra', 'Nashik', 'Uttam Nagar ,Pavan Nagar, Cidco', 'Anna Adam', '9638527412', '422008', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529399833\",\"tracking_id\":\"307003888903\",\"bank_ref_no\":\"1529399853491\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"46292.02\",\"billing_name\":\"Anna Adam\",\"billing_address\":\"Uttam Nagar ,Pavan Nagar, Cidco\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9638527412\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Anna Adam\",\"delivery_address\":\"Uttam Nagar ,Pavan Nagar, Cidco\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9638527412\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"46292.02\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"19\\/06\\/2018 14:47:46\",\"bin_country\":\"\\u0001\",\"trans_type\":\"2\"}', '2018-06-19 09:17:13', '2018-06-19 09:17:40'),
(145, '307003888940', 'AM-1529400342', 13, 0, NULL, 0, 0, '1529400426656', 'Success', '1', 'AvenuesTest', 'INR', 18606.11, 'Anna Adam', 'Uttam Nagar ,Pavan Nagar, Cidco', 'Nashik', 'India', 'anna.adam51@yahoo.com', '9638527412', 'India', '422008', 'Maharashtra', 'Nashik', 'Uttam Nagar ,Pavan Nagar, Cidco', 'Anna Adam', '9638527412', '422008', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529400342\",\"tracking_id\":\"307003888940\",\"bank_ref_no\":\"1529400426656\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"18606.11\",\"billing_name\":\"Anna Adam\",\"billing_address\":\"Uttam Nagar ,Pavan Nagar, Cidco\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9638527412\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Anna Adam\",\"delivery_address\":\"Uttam Nagar ,Pavan Nagar, Cidco\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9638527412\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"18606.11\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"19\\/06\\/2018 14:57:20\",\"bin_country\":\"\\u0001\",\"trans_type\":\"2\"}', '2018-06-19 09:25:42', '2018-06-19 09:27:09'),
(146, '', '', 13, 47, NULL, 3, 0, NULL, 'Success', '1', NULL, 'INR', 15000.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '3', 69.00, '2018-06-19 10:12:53', NULL, '2018-06-19 10:12:53', '2018-06-19 10:12:53'),
(147, '307003889331', 'AM-1529403984', 13, 0, NULL, 0, 0, '1529404038737', 'Success', '1', 'AvenuesTest', 'INR', 22300.00, 'Anna Adam', 'samarth chowk , upendra nagar,', 'Nashik', 'India', 'anna.adam51@yahoo.com', '9638527412', 'India', '422008', 'maharashtra', 'Nashik', 'samarth chowk , upendra nagar,', 'Anna Adam', '9638527412', '422008', 'maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529403984\",\"tracking_id\":\"307003889331\",\"bank_ref_no\":\"1529404038737\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"22300.0\",\"billing_name\":\"Anna Adam\",\"billing_address\":\"samarth chowk , upendra nagar,\",\"billing_city\":\"Nashik\",\"billing_state\":\"maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9638527412\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Anna Adam\",\"delivery_address\":\"samarth chowk , upendra nagar,\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9638527412\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"22300.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"19\\/06\\/2018 15:57:31\",\"bin_country\":\"\\u0005\\u0005\\u0005\\u0005\\u0005\",\"trans_type\":\"2\"}', '2018-06-19 10:26:24', '2018-06-19 10:27:30'),
(148, '307003889391', 'AM-1529404673', 1, 0, NULL, 0, 0, '1529404689572', 'Success', '1', 'AvenuesTest', 'INR', 138876.07, 'Nayan Pawar', 'Indira Nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira Nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529404673\",\"tracking_id\":\"307003889391\",\"bank_ref_no\":\"1529404689572\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"138876.07\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira Nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira Nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"138876.07\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"19\\/06\\/2018 16:08:23\",\"bin_country\":\"\\u0007\\u0007\\u0007\\u0007\\u0007\\u0007\\u0007\",\"trans_type\":\"2\"}', '2018-06-19 10:37:53', '2018-06-19 10:38:13'),
(149, '307003889511', 'AM-1529405900', 13, 0, NULL, 0, 0, '1529405913907', 'Success', '1', 'AvenuesTest', 'INR', 44511.56, 'Anna Adam', 'Uttam Nagar ,Pavan Nagar, Cidco', 'Nashik', 'India', 'anna.adam51@yahoo.com', '9638527412', 'India', '422008', 'Maharashtra', 'Nashik', 'Uttam Nagar ,Pavan Nagar, Cidco', 'Anna Adam', '9638527412', '422008', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529405900\",\"tracking_id\":\"307003889511\",\"bank_ref_no\":\"1529405913907\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"44511.56\",\"billing_name\":\"Anna Adam\",\"billing_address\":\"Uttam Nagar ,Pavan Nagar, Cidco\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9638527412\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Anna Adam\",\"delivery_address\":\"Uttam Nagar ,Pavan Nagar, Cidco\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9638527412\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"44511.56\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"19\\/06\\/2018 16:28:47\",\"bin_country\":\"\\u0001\",\"trans_type\":\"2\"}', '2018-06-19 10:58:20', '2018-06-19 10:58:58'),
(150, '307003890531', 'AM-1529409014', 13, 0, NULL, 0, 0, '1529409045311', 'Success', '1', 'AvenuesTest', 'INR', 63555.00, 'Anna Adam', 'Uttam Nagar ,Pavan Nagar, Cidco', 'Nashik', 'United States', 'anna.adam51@yahoo.com', '9638527412', 'United States', '422008', 'Maharashtra', 'Nashik', 'Uttam Nagar ,Pavan Nagar, Cidco', 'Anna Adam', '9638527412', '422008', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529409014\",\"tracking_id\":\"307003890531\",\"bank_ref_no\":\"1529409045311\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"63555.0\",\"billing_name\":\"Anna Adam\",\"billing_address\":\"Uttam Nagar ,Pavan Nagar, Cidco\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"United States\",\"billing_tel\":\"9638527412\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Anna Adam\",\"delivery_address\":\"Uttam Nagar ,Pavan Nagar, Cidco\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"United States\",\"delivery_tel\":\"9638527412\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"63555.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"19\\/06\\/2018 17:20:58\",\"bin_country\":\"\\u0003\\u0003\\u0003\",\"trans_type\":\"2\"}', '2018-06-19 11:50:15', '2018-06-19 11:50:54'),
(151, '307003890593', 'AM-1529409874', 13, 0, NULL, 0, 0, '1529409907799', 'Success', '1', 'AvenuesTest', 'INR', 34740.00, 'Anna Adam', 'samarth chowk , upendra nagar,', 'Nashik', 'India', 'anna.adam51@yahoo.com', '9638527412', 'India', '422008', 'maharashtra', 'Nashik', 'samarth chowk , upendra nagar,', 'Anna Adam', '9638527412', '422008', 'maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529409874\",\"tracking_id\":\"307003890593\",\"bank_ref_no\":\"1529409907799\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"34740.0\",\"billing_name\":\"Anna Adam\",\"billing_address\":\"samarth chowk , upendra nagar,\",\"billing_city\":\"Nashik\",\"billing_state\":\"maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9638527412\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Anna Adam\",\"delivery_address\":\"samarth chowk , upendra nagar,\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9638527412\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"34740.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"19\\/06\\/2018 17:35:21\",\"bin_country\":\"\\u0005\\u0005\\u0005\\u0005\\u0005\",\"trans_type\":\"2\"}', '2018-06-19 12:04:34', '2018-06-19 12:05:17'),
(152, '', '', 13, 46, NULL, 5, 0, NULL, 'Success', '1', NULL, 'INR', 100000.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '3', 69.00, '2018-06-19 12:55:28', NULL, '2018-06-19 12:55:28', '2018-06-19 12:55:28'),
(153, '160727674319', 'AM-1529414002', 13, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 344377.32, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 69.00, NULL, NULL, '2018-06-19 13:13:23', '2018-06-19 13:13:23'),
(154, '307003891573', 'AM-1529472462', 1, 0, NULL, 0, 0, '1529472479485', 'Success', '1', 'AvenuesTest', 'INR', 627050.00, 'Nayan Pawar', 'Indira Nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira Nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529472462\",\"tracking_id\":\"307003891573\",\"bank_ref_no\":\"1529472479485\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"627050.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira Nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira Nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"627050.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"20\\/06\\/2018 10:58:13\",\"bin_country\":\"\\t\\t\\t\\t\\t\\t\\t\\t\\t\",\"trans_type\":\"2\"}', '2018-06-20 05:27:42', '2018-06-20 05:28:04'),
(155, '307003891629', 'AM-1529473103', 13, 0, NULL, 0, 0, '1529473121067', 'Success', '1', 'AvenuesTest', 'INR', 52624.00, 'Anna Adam', 'samarth chowk , upendra nagar,', 'Nashik', 'India', 'anna.adam51@yahoo.com', '9638527412', 'India', '422008', 'maharashtra', 'Nashik', 'samarth chowk , upendra nagar,', 'Anna Adam', '9638527412', '422008', 'maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529473103\",\"tracking_id\":\"307003891629\",\"bank_ref_no\":\"1529473121067\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"52624.0\",\"billing_name\":\"Anna Adam\",\"billing_address\":\"samarth chowk , upendra nagar,\",\"billing_city\":\"Nashik\",\"billing_state\":\"maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9638527412\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Anna Adam\",\"delivery_address\":\"samarth chowk , upendra nagar,\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9638527412\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"52624.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"20\\/06\\/2018 11:08:54\",\"bin_country\":\"\\u0005\\u0005\\u0005\\u0005\\u0005\",\"trans_type\":\"2\"}', '2018-06-20 05:38:23', '2018-06-20 05:38:55');
INSERT INTO `transactions` (`transaction_id`, `tracking_id`, `order_id`, `user_id`, `product_id`, `user_gift_card_id`, `return_product_request_id`, `replacement_product_request_id`, `bank_ref_no`, `order_status`, `payment_status`, `card_name`, `currency`, `amount`, `billing_name`, `billing_address`, `billing_city`, `billing_country`, `billing_email`, `delivery_tel`, `delivery_country`, `delivery_zip`, `delivery_state`, `delivery_city`, `delivery_address`, `delivery_name`, `billing_tel`, `billing_zip`, `billing_state`, `status_message`, `status_code`, `payment_mode`, `failure_message`, `trans_type`, `transaction_usd_value`, `trans_date`, `response_data`, `created_at`, `updated_at`) VALUES
(156, '307003891723', 'AM-1529474831', 13, 0, NULL, 0, 0, '1529474848646', 'Success', '1', 'AvenuesTest', 'INR', 208644.00, 'Anna Adam', '4th Floor, Bhandari Jewellery,Beside Kalika Mandir, Mumbai Naka,', 'Nashik', 'India', 'anna.adam51@yahoo.com', '9638527412', 'India', '422001', 'Maharashtra', 'Nashik', '4th Floor, Bhandari Jewellery,Beside Kalika Mandir, Mumbai Naka,', 'Anna Adam', '9638527412', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529474831\",\"tracking_id\":\"307003891723\",\"bank_ref_no\":\"1529474848646\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"208644.0\",\"billing_name\":\"Anna Adam\",\"billing_address\":\"4th Floor, Bhandari Jewellery,Beside Kalika Mandir, Mumbai Naka,\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"9638527412\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Anna Adam\",\"delivery_address\":\"4th Floor, Bhandari Jewellery,Beside Kalika Mandir, Mumbai Naka,\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"9638527412\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"208644.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"20\\/06\\/2018 11:37:42\",\"bin_country\":\"\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\",\"trans_type\":\"2\"}', '2018-06-20 06:07:11', '2018-06-20 06:08:57'),
(157, '307003892367', 'AM-1529484102', 13, 0, NULL, 0, 0, '1529484116850', 'Success', '1', 'AvenuesTest', 'INR', 129.32, 'Anna Adam', 'samarth chowk , upendra nagar,', 'Nashik', 'India', 'anna.adam51@yahoo.com', '9638527412', 'India', '422008', 'maharashtra', 'Nashik', 'samarth chowk , upendra nagar,', 'Anna Adam', '9638527412', '422008', 'maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529484102\",\"tracking_id\":\"307003892367\",\"bank_ref_no\":\"1529484116850\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"129.32\",\"billing_name\":\"Anna Adam\",\"billing_address\":\"samarth chowk , upendra nagar,\",\"billing_city\":\"Nashik\",\"billing_state\":\"maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9638527412\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Anna Adam\",\"delivery_address\":\"samarth chowk , upendra nagar,\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9638527412\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"129.32\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"20\\/06\\/2018 14:12:11\",\"bin_country\":\"\\u0007\\u0007\\u0007\\u0007\\u0007\\u0007\\u0007\",\"trans_type\":\"2\"}', '2018-06-20 08:41:42', '2018-06-20 08:42:04'),
(158, '307003893989', 'CS-2018-ef24e5370bc7b377', 1, 0, 40, 0, 0, '1529493134601', 'Success', '1', 'AvenuesTest', 'INR', 50.00, 'Nayan Pawar', 'pavan nagar cidco', 'nashik', 'India', 'nayan@gmail.com', '9921840141', 'India', '422008', 'maharashtra', 'nashik', 'pavan nagar cidco', 'Nayan Pawar', '9921840141', '422008', 'maharashtra', 'Y', 'null', 'Net Banking', '', '2', 69.00, '2018-06-20 11:12:22', '{\"order_id\":\"CS-2018-ef24e5370bc7b377\",\"tracking_id\":\"307003893989\",\"bank_ref_no\":\"1529493134601\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"50.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"pavan nagar cidco\",\"billing_city\":\"nashik\",\"billing_state\":\"maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9921840141\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"pavan nagar cidco\",\"delivery_city\":\"nashik\",\"delivery_state\":\"maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9921840141\",\"merchant_param1\":\"\",\"merchant_param2\":\"gift_card\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"50.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"20\\/06\\/2018 16:42:28\",\"bin_country\":\"\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\",\"user_gift_card_id\":40,\"trans_type\":\"2\",\"user_id\":1}', '2018-06-20 11:12:22', '2018-06-20 11:12:22'),
(159, '910115666903', 'AM-1529493343', 13, 0, NULL, 0, 0, NULL, '0', '1', NULL, NULL, -149920.68, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 69.00, '2018-06-26 05:28:47', NULL, '2018-06-20 11:15:43', '2018-06-20 11:15:43'),
(160, '290896933920', 'AM-1529493385', 13, 0, NULL, 0, 0, NULL, '0', '1', NULL, NULL, -149920.68, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 69.00, '2018-06-26 05:29:02', NULL, '2018-06-20 11:16:25', '2018-06-20 11:16:25'),
(161, '492091574720', 'AM-1529493415', 13, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, -149920.68, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 69.00, NULL, NULL, '2018-06-20 11:16:55', '2018-06-20 11:16:55'),
(162, '655135253288', 'AM-1529493427', 13, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, -149920.68, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 69.00, NULL, NULL, '2018-06-20 11:17:07', '2018-06-20 11:17:07'),
(163, '655516696684', 'AM-1529493448', 13, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, -149920.68, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 69.00, NULL, NULL, '2018-06-20 11:17:28', '2018-06-20 11:17:28'),
(164, '307003894323', 'AM-1529496580', 13, 0, NULL, 0, 0, '1529496599949', 'Success', '1', 'AvenuesTest', 'INR', 539700.00, 'Anna Adam', 'samarth chowk , upendra nagar,', 'Nashik', 'India', 'anna.adam51@yahoo.com', '9638527412', 'India', '422008', 'maharashtra', 'Nashik', 'samarth chowk , upendra nagar,', 'Anna Adam', '9638527412', '422008', 'maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529496580\",\"tracking_id\":\"307003894323\",\"bank_ref_no\":\"1529496599949\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"539700.0\",\"billing_name\":\"Anna Adam\",\"billing_address\":\"samarth chowk , upendra nagar,\",\"billing_city\":\"Nashik\",\"billing_state\":\"maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9638527412\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Anna Adam\",\"delivery_address\":\"samarth chowk , upendra nagar,\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9638527412\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"539700.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"20\\/06\\/2018 17:40:14\",\"bin_country\":\"\\u0003\\u0003\\u0003\",\"trans_type\":\"2\"}', '2018-06-20 17:39:40', '2018-06-20 17:40:05'),
(165, '307003894406', 'AM-1529497321', 13, 0, NULL, 0, 0, '1529497330639', 'Success', '1', 'AvenuesTest', 'INR', 126.50, 'Anna Adam', 'samarth chowk , upendra nagar,', 'Nashik', 'India', 'anna.adam51@yahoo.com', '9638527412', 'India', '422008', 'maharashtra', 'Nashik', 'samarth chowk , upendra nagar,', 'Anna Adam', '9638527412', '422008', 'maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529497321\",\"tracking_id\":\"307003894406\",\"bank_ref_no\":\"1529497330639\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"126.5\",\"billing_name\":\"Anna Adam\",\"billing_address\":\"samarth chowk , upendra nagar,\",\"billing_city\":\"Nashik\",\"billing_state\":\"maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9638527412\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Anna Adam\",\"delivery_address\":\"samarth chowk , upendra nagar,\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9638527412\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"126.5\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"20\\/06\\/2018 17:52:24\",\"bin_country\":\"\\t\\t\\t\\t\\t\\t\\t\\t\\t\",\"trans_type\":\"2\"}', '2018-06-20 17:52:01', '2018-06-20 17:52:12'),
(166, '307003894495', 'CS-2018-34ed5d22e0e51633', 1, 0, 41, 0, 0, '1529498639812', 'Success', '1', 'AvenuesTest', 'INR', 100.00, 'Nayan Pawar', 'Mumbai Naka Old agra', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422008', 'maharashtra', 'Nashik', 'Mumbai Naka Old agra', 'Nayan Pawar', '8458458544', '422008', 'maharashtra', 'Y', 'null', 'Net Banking', '', '2', 69.00, '2018-06-20 18:14:07', '{\"order_id\":\"CS-2018-34ed5d22e0e51633\",\"tracking_id\":\"307003894495\",\"bank_ref_no\":\"1529498639812\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"100.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Mumbai Naka Old agra\",\"billing_city\":\"Nashik\",\"billing_state\":\"maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Mumbai Naka Old agra\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"gift_card\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"100.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"20\\/06\\/2018 18:14:13\",\"bin_country\":\"\\u0002\\u0002\",\"user_gift_card_id\":41,\"trans_type\":\"2\",\"user_id\":1}', '2018-06-20 18:14:07', '2018-06-20 18:14:07'),
(167, '307003894527', 'CS-2018-aa1d382202947702', 1, 0, 42, 0, 0, '1529498818321', 'Success', '1', 'AvenuesTest', 'INR', 250.00, 'Nayan Pawar', 'uttam nagar', 'Nashik', 'India', 'nayan@gmail.com', '9921840141', 'India', '422001', 'Maharashtra', 'Nashik', 'uttam nagar', 'Nayan Pawar', '9921840141', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '2', 69.00, '2018-06-20 18:17:05', '{\"order_id\":\"CS-2018-aa1d382202947702\",\"tracking_id\":\"307003894527\",\"bank_ref_no\":\"1529498818321\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"250.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"uttam nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"9921840141\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"uttam nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"9921840141\",\"merchant_param1\":\"\",\"merchant_param2\":\"gift_card\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"250.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"20\\/06\\/2018 18:17:12\",\"bin_country\":\"\\u0004\\u0004\\u0004\\u0004\",\"user_gift_card_id\":42,\"trans_type\":\"2\",\"user_id\":1}', '2018-06-20 18:17:05', '2018-06-20 18:17:05'),
(168, '', '', 13, 52, NULL, 0, 1, NULL, 'Success', '1', NULL, 'INR', 1000.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '4', 69.00, '2018-06-20 18:18:40', NULL, '2018-06-20 18:18:40', '2018-06-20 18:18:40'),
(169, '307003894549', 'AM-1529499186', 13, 0, NULL, 0, 0, '1529499209693', 'Success', '1', 'AvenuesTest', 'INR', 357394.00, 'Anna Adam', 'samarth chowk , upendra nagar,', 'Nashik', 'India', 'anna.adam51@yahoo.com', '9921840141', 'India', '422008', 'maharashtra', 'Nashik', 'samarth chowk , upendra nagar,', 'Anna Adam', '9921840141', '422008', 'maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529499186\",\"tracking_id\":\"307003894549\",\"bank_ref_no\":\"1529499209693\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"357394.0\",\"billing_name\":\"Anna Adam\",\"billing_address\":\"samarth chowk , upendra nagar,\",\"billing_city\":\"Nashik\",\"billing_state\":\"maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9921840141\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Anna Adam\",\"delivery_address\":\"samarth chowk , upendra nagar,\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9921840141\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"357394.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"20\\/06\\/2018 18:23:43\",\"bin_country\":\"\\u0003\\u0003\\u0003\",\"trans_type\":\"2\"}', '2018-06-20 18:23:06', '2018-06-20 18:23:34'),
(170, '', '', 13, 25, NULL, 2, 0, NULL, 'Success', '1', NULL, 'INR', 344850.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '3', 69.00, '2018-06-20 18:40:33', NULL, '2018-06-20 18:40:33', '2018-06-20 18:40:33'),
(171, '140901380312', 'AM-1529501131', 13, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, -269500.28, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 69.00, NULL, NULL, '2018-06-20 18:55:31', '2018-06-20 18:55:31'),
(172, '307003895386', 'CS-2018-fed4079454aa0326', 1, 0, 43, 0, 0, '1529555298106', 'Success', '1', 'AvenuesTest', 'INR', 250.00, 'Nayan Pawar', 'Nashik', 'Nashik', 'India', 'nayan@gmail.com', '9921840141', 'India', '422008', 'Maharashtra', 'Nashik', 'Nashik', 'Nayan Pawar', '9921840141', '422008', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '2', 69.00, '2018-06-21 09:58:26', '{\"order_id\":\"CS-2018-fed4079454aa0326\",\"tracking_id\":\"307003895386\",\"bank_ref_no\":\"1529555298106\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"250.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Nashik\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9921840141\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Nashik\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9921840141\",\"merchant_param1\":\"\",\"merchant_param2\":\"gift_card\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"250.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"21\\/06\\/2018 09:58:32\",\"bin_country\":\"\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\\u000e\",\"user_gift_card_id\":43,\"trans_type\":\"2\",\"user_id\":1}', '2018-06-21 09:58:26', '2018-06-21 09:58:26'),
(173, '307003895398', 'AM-1529555686', 13, 0, NULL, 0, 0, '1529555716904', 'Success', '1', 'AvenuesTest', 'INR', 1404636.75, 'Anna Adam', 'Pavan Nagar', 'Nashik', 'India', 'anna.adam51@yahoo.com', '9638527412', 'India', '422008', 'Maharashtra', 'Nashik', 'Pavan Nagar', 'Anna Adam', '9638527412', '422008', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529555686\",\"tracking_id\":\"307003895398\",\"bank_ref_no\":\"1529555716904\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"1404636.75\",\"billing_name\":\"Anna Adam\",\"billing_address\":\"Pavan Nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9638527412\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Anna Adam\",\"delivery_address\":\"Pavan Nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9638527412\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"1404636.75\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"21\\/06\\/2018 10:05:30\",\"bin_country\":\"\\u0005\\u0005\\u0005\\u0005\\u0005\",\"trans_type\":\"2\"}', '2018-06-21 10:04:46', '2018-06-21 10:05:21'),
(174, '307003895425', 'AM-1529556422', 13, 0, NULL, 0, 0, '1529556440187', 'Success', '1', 'AvenuesTest', 'INR', 37424.86, 'Anna Adam', 'samarth chowk , upendra nagar,', 'Nashik', 'India', 'anna.adam51@yahoo.com', '9638527412', 'India', '422008', 'maharashtra', 'Nashik', 'samarth chowk , upendra nagar,', 'Anna Adam', '9638527412', '422008', 'maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529556422\",\"tracking_id\":\"307003895425\",\"bank_ref_no\":\"1529556440187\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"37424.86\",\"billing_name\":\"Anna Adam\",\"billing_address\":\"samarth chowk , upendra nagar,\",\"billing_city\":\"Nashik\",\"billing_state\":\"maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9638527412\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Anna Adam\",\"delivery_address\":\"samarth chowk , upendra nagar,\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9638527412\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"37424.86\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"21\\/06\\/2018 10:17:34\",\"bin_country\":\"\\u0003\\u0003\\u0003\",\"trans_type\":\"2\"}', '2018-06-21 10:17:02', '2018-06-21 10:17:28'),
(175, '307003895913', 'CS-2018-d9d7cca4895cdd8d', 1, 0, 44, 0, 0, '1529563098414', 'Success', '1', 'AvenuesTest', 'INR', 50000.00, 'Nayan Pawar', 'Nashik', 'nashik', 'India', 'nayan@gmail.com', '9921840141', 'India', '422008', 'Maharashtra', 'nashik', 'Nashik', 'Nayan Pawar', '9921840141', '422008', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '2', 69.00, '2018-06-21 12:08:26', '{\"order_id\":\"CS-2018-d9d7cca4895cdd8d\",\"tracking_id\":\"307003895913\",\"bank_ref_no\":\"1529563098414\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"50000.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Nashik\",\"billing_city\":\"nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9921840141\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Nashik\",\"delivery_city\":\"nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9921840141\",\"merchant_param1\":\"\",\"merchant_param2\":\"gift_card\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"50000.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"21\\/06\\/2018 12:08:32\",\"bin_country\":\"\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\",\"user_gift_card_id\":44,\"trans_type\":\"2\",\"user_id\":1}', '2018-06-21 12:08:26', '2018-06-21 12:08:26'),
(176, '307003896043', 'AM-1529564378', 13, 0, NULL, 0, 0, '1529564401688', 'Success', '1', 'AvenuesTest', 'INR', 43234069.15, 'Anna Adam', 'samarth chowk , upendra nagar,', 'Nashik', 'India', 'anna.adam51@yahoo.com', '9638527412', 'India', '422008', 'maharashtra', 'Nashik', 'samarth chowk , upendra nagar,', 'Anna Adam', '9638527412', '422008', 'maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529564378\",\"tracking_id\":\"307003896043\",\"bank_ref_no\":\"1529564401688\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"4.323406915E7\",\"billing_name\":\"Anna Adam\",\"billing_address\":\"samarth chowk , upendra nagar,\",\"billing_city\":\"Nashik\",\"billing_state\":\"maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9638527412\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Anna Adam\",\"delivery_address\":\"samarth chowk , upendra nagar,\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9638527412\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"4.323406915E7\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"21\\/06\\/2018 12:30:15\",\"bin_country\":\"\\t\\t\\t\\t\\t\\t\\t\\t\\t\",\"trans_type\":\"2\"}', '2018-06-21 12:29:38', '2018-06-21 12:30:07'),
(177, '858395640184', 'AM-1529565961', 13, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 24996.40, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 69.00, NULL, NULL, '2018-06-21 12:56:01', '2018-06-21 12:56:01'),
(178, '307003896220', 'AM-1529566029', 13, 0, NULL, 0, 0, '1529566046855', 'Success', '1', 'AvenuesTest', 'INR', 37674.86, 'Anna Adam', 'samarth chowk , upendra nagar,', 'Nashik', 'India', 'anna.adam51@yahoo.com', '9638527412', 'India', '422008', 'maharashtra', 'Nashik', 'samarth chowk , upendra nagar,', 'Anna Adam', '9638527412', '422008', 'maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529566029\",\"tracking_id\":\"307003896220\",\"bank_ref_no\":\"1529566046855\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"37674.86\",\"billing_name\":\"Anna Adam\",\"billing_address\":\"samarth chowk , upendra nagar,\",\"billing_city\":\"Nashik\",\"billing_state\":\"maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9638527412\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Anna Adam\",\"delivery_address\":\"samarth chowk , upendra nagar,\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9638527412\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"37674.86\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"21\\/06\\/2018 12:57:41\",\"bin_country\":\"\\u0003\\u0003\\u0003\",\"trans_type\":\"2\"}', '2018-06-21 12:57:09', '2018-06-21 12:57:30'),
(179, '113750100831', 'AM-1529570794', 13, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 2758800.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 69.00, NULL, NULL, '2018-06-21 18:16:34', '2018-06-21 18:16:34'),
(180, '307003896587', 'AM-1529571229', 13, 0, NULL, 0, 0, '1529571239229', 'Success', '1', 'AvenuesTest', 'INR', 253000.00, 'Anna Adam', 'samarth chowk , upendra nagar,', 'Nashik', 'India', 'anna.adam51@yahoo.com', '9638527412', 'India', '422008', 'maharashtra', 'Nashik', 'samarth chowk , upendra nagar,', 'Anna Adam', '9638527412', '422008', 'maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529571229\",\"tracking_id\":\"307003896587\",\"bank_ref_no\":\"1529571239229\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"253000.0\",\"billing_name\":\"Anna Adam\",\"billing_address\":\"samarth chowk , upendra nagar,\",\"billing_city\":\"Nashik\",\"billing_state\":\"maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9638527412\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Anna Adam\",\"delivery_address\":\"samarth chowk , upendra nagar,\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9638527412\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"253000.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"21\\/06\\/2018 14:24:13\",\"bin_country\":\"\\u0003\\u0003\\u0003\",\"trans_type\":\"2\"}', '2018-06-21 18:23:49', '2018-06-21 18:24:04'),
(181, '', '', 13, 25, NULL, 3, 0, NULL, 'Success', '1', NULL, 'INR', 99999999.99, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '3', 69.00, '2018-06-21 18:48:55', NULL, '2018-06-21 18:48:55', '2018-06-21 18:48:55'),
(182, '307003896771', 'AM-1529573334', 13, 0, NULL, 0, 0, '1529573342802', 'Success', '1', 'AvenuesTest', 'INR', 10618914.07, 'Anna Adam', 'Pavan Nagar', 'Nashik', 'India', 'anna.adam51@yahoo.com', '9638527412', 'India', '422008', 'Maharashtra', 'Nashik', 'Pavan Nagar', 'Anna Adam', '9638527412', '422008', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529573334\",\"tracking_id\":\"307003896771\",\"bank_ref_no\":\"1529573342802\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"1.061891407E7\",\"billing_name\":\"Anna Adam\",\"billing_address\":\"Pavan Nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9638527412\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Anna Adam\",\"delivery_address\":\"Pavan Nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9638527412\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"1.061891407E7\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"21\\/06\\/2018 14:59:17\",\"bin_country\":\"\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\",\"trans_type\":\"2\"}', '2018-06-21 18:58:54', '2018-06-21 18:59:06'),
(183, '', '', 13, 25, NULL, 4, 0, NULL, 'Success', '1', NULL, 'INR', 99999999.99, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '3', 69.00, '2018-06-21 19:03:10', NULL, '2018-06-21 19:03:10', '2018-06-21 19:03:10'),
(184, '', '', 13, 28, NULL, 0, 2, NULL, 'Success', '1', NULL, 'INR', 99999999.99, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '4', 69.00, '2018-06-21 19:07:30', NULL, '2018-06-21 19:07:30', '2018-06-21 19:07:30'),
(185, '', '', 13, 26, NULL, 0, 3, NULL, 'Success', '1', NULL, 'INR', 24035.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '4', 69.00, '2018-06-21 19:21:34', NULL, '2018-06-21 19:21:34', '2018-06-21 19:21:34'),
(186, '307003896989', 'AM-1529575295', 13, 0, NULL, 0, 0, '1529575311152', 'Success', '1', 'AvenuesTest', 'INR', 36052.50, 'Anna Adam', 'samarth chowk , upendra nagar,', 'Nashik', 'India', 'anna.adam51@yahoo.com', '9638527412', 'India', '422008', 'maharashtra', 'Nashik', 'samarth chowk , upendra nagar,', 'Anna Adam', '9638527412', '422008', 'maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529575295\",\"tracking_id\":\"307003896989\",\"bank_ref_no\":\"1529575311152\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"36052.5\",\"billing_name\":\"Anna Adam\",\"billing_address\":\"samarth chowk , upendra nagar,\",\"billing_city\":\"Nashik\",\"billing_state\":\"maharashtra\",\"billing_zip\":\"422008\",\"billing_country\":\"India\",\"billing_tel\":\"9638527412\",\"billing_email\":\"anna.adam51@yahoo.com\",\"delivery_name\":\"Anna Adam\",\"delivery_address\":\"samarth chowk , upendra nagar,\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"maharashtra\",\"delivery_zip\":\"422008\",\"delivery_country\":\"India\",\"delivery_tel\":\"9638527412\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"36052.5\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"21\\/06\\/2018 15:32:05\",\"bin_country\":\"\\u0005\\u0005\\u0005\\u0005\\u0005\",\"trans_type\":\"2\"}', '2018-06-21 19:31:35', '2018-06-21 19:32:01'),
(187, '', '', 13, 28, NULL, 5, 0, NULL, 'Success', '1', NULL, 'INR', 36000.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '3', 69.00, '2018-06-21 19:45:39', NULL, '2018-06-21 19:45:39', '2018-06-21 19:45:39'),
(188, '307003897191', 'AM-1529576977', 1, 0, NULL, 0, 0, '1529576989591', 'Success', '1', 'AvenuesTest', 'INR', 408877.15, 'Nayan Pawar', 'Indira Nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira Nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529576977\",\"tracking_id\":\"307003897191\",\"bank_ref_no\":\"1529576989591\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"408877.15\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira Nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira Nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"408877.15\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"21\\/06\\/2018 16:00:04\",\"bin_country\":\"\\u0007\\u0007\\u0007\\u0007\\u0007\\u0007\\u0007\",\"trans_type\":\"2\"}', '2018-06-21 19:59:37', '2018-06-21 19:59:52'),
(189, '', '', 1, 26, NULL, 1, 0, NULL, 'Success', '1', NULL, 'INR', 9999999999.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '3', 69.00, '2018-06-21 10:49:00', NULL, '2018-06-21 10:49:00', '2018-06-21 10:49:00'),
(190, '', '', 1, 26, NULL, 1, 0, NULL, 'Success', '1', NULL, 'INR', 9999999999.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '3', 69.00, '2018-06-21 11:00:49', NULL, '2018-06-21 11:00:49', '2018-06-21 11:00:49'),
(191, '', '', 1, 26, NULL, 1, 0, NULL, 'Success', '1', NULL, 'INR', 9999999999.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '3', 69.00, '2018-06-21 11:05:13', NULL, '2018-06-21 11:05:13', '2018-06-21 11:05:13'),
(192, '', '', 1, 26, NULL, 1, 0, NULL, 'Success', '1', NULL, 'INR', 9999999999.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '3', 69.00, '2018-06-21 11:06:55', NULL, '2018-06-21 11:06:55', '2018-06-21 11:06:55'),
(193, '', '', 1, 26, NULL, 1, 0, NULL, 'Success', '1', NULL, 'INR', 9999999999.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '3', 69.00, '2018-06-21 11:08:43', NULL, '2018-06-21 11:08:43', '2018-06-21 11:08:43'),
(194, '', '', 1, 26, NULL, 1, 0, NULL, 'Success', '1', NULL, 'INR', 2403.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '3', 69.00, '2018-06-21 11:20:41', NULL, '2018-06-21 11:20:41', '2018-06-21 11:20:41'),
(195, '', '', 1, 26, NULL, 1, 0, NULL, 'Success', '1', NULL, 'INR', 24035.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '3', 69.00, '2018-06-21 11:22:01', NULL, '2018-06-21 11:22:01', '2018-06-21 11:22:01'),
(196, '', '', 1, 26, NULL, 1, 0, NULL, 'Success', '1', NULL, 'INR', 3000.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'bank', '', '3', 69.00, '2018-06-21 11:24:56', NULL, '2018-06-21 11:24:56', '2018-06-21 11:24:56'),
(197, '307003898569', 'AM-1529582501', 1, 0, NULL, 0, 0, '1529582512704', 'Success', '1', 'AvenuesTest', 'INR', 126.50, 'Nayan Pawar', 'Indira Nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira Nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529582501\",\"tracking_id\":\"307003898569\",\"bank_ref_no\":\"1529582512704\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"126.5\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira Nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira Nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"126.5\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"21\\/06\\/2018 17:32:07\",\"bin_country\":\"\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\",\"trans_type\":\"2\"}', '2018-06-21 12:01:42', '2018-06-21 12:01:55'),
(198, '307003898668', 'AM-1529583445', 1, 0, NULL, 0, 0, '1529583455949', 'Success', '1', 'AvenuesTest', 'INR', 1724376.50, 'Nayan Pawar', 'Indira Nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira Nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529583445\",\"tracking_id\":\"307003898668\",\"bank_ref_no\":\"1529583455949\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"1724376.5\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira Nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira Nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"1724376.5\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"21\\/06\\/2018 17:47:50\",\"bin_country\":\"\\u0007\\u0007\\u0007\\u0007\\u0007\\u0007\\u0007\",\"trans_type\":\"2\"}', '2018-06-21 12:17:26', '2018-06-21 12:17:38'),
(199, '', '', 1, 25, NULL, 0, 4, NULL, 'Success', '1', NULL, 'INR', 9999999999.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '4', 69.00, '2018-06-21 12:25:15', NULL, '2018-06-21 12:25:15', '2018-06-21 12:25:15'),
(200, '', '', 1, 25, NULL, 0, 4, NULL, 'Success', '1', NULL, 'INR', 344850.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '4', 69.00, '2018-06-21 12:34:35', NULL, '2018-06-21 12:34:35', '2018-06-21 12:34:35'),
(201, '', '', 1, 25, NULL, 2, 0, NULL, 'Success', '1', NULL, 'INR', 344850.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '3', 69.00, '2018-06-21 12:36:54', NULL, '2018-06-21 12:36:54', '2018-06-21 12:36:54'),
(202, '055365930992', 'AM-1529641773', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 344850.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 69.00, NULL, NULL, '2018-06-22 04:29:33', '2018-06-22 04:29:33'),
(203, '307003899431', 'AM-1529641812', 1, 0, NULL, 0, 0, '1529641823495', 'Success', '1', 'AvenuesTest', 'INR', 368808.00, 'Nayan Pawar', 'Indira Nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira Nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529641812\",\"tracking_id\":\"307003899431\",\"bank_ref_no\":\"1529641823495\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"368808.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira Nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira Nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"368808.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"22\\/06\\/2018 10:00:38\",\"bin_country\":\"\\t\\t\\t\\t\\t\\t\\t\\t\\t\",\"trans_type\":\"2\"}', '2018-06-22 04:30:12', '2018-06-22 04:30:25'),
(204, '307003899436', 'AM-1529641947', 1, 0, NULL, 0, 0, '1529642110638', 'Success', '1', 'AvenuesTest', 'INR', 344850.00, 'Nayan Pawar', 'Indira Nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira Nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529641947\",\"tracking_id\":\"307003899436\",\"bank_ref_no\":\"1529642110638\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"344850.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira Nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira Nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"344850.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"22\\/06\\/2018 10:05:25\",\"bin_country\":\"\\t\\t\\t\\t\\t\\t\\t\\t\\t\",\"trans_type\":\"2\"}', '2018-06-22 04:32:27', '2018-06-22 04:35:47'),
(205, '307003899721', 'AM-1529646743', 1, 0, NULL, 0, 0, '1529646754617', 'Success', '1', 'AvenuesTest', 'INR', 394185.00, 'Nayan Pawar', 'Indira Nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira Nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1529646743\",\"tracking_id\":\"307003899721\",\"bank_ref_no\":\"1529646754617\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"394185.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira Nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira Nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"394185.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"22\\/06\\/2018 11:22:49\",\"bin_country\":\"\\t\\t\\t\\t\\t\\t\\t\\t\\t\",\"trans_type\":\"2\"}', '2018-06-22 05:52:24', '2018-06-22 05:54:20'),
(206, '307003899741', 'AM-1529646985', 1, 0, NULL, 0, 0, '1529647000433', 'Success', '5', 'AvenuesTest', 'INR', 713658.00, 'Nayan Pawar', 'Indira Nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira Nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '2018-06-22 11:16:08', '{\"order_id\":\"AM-1529646985\",\"tracking_id\":\"307003899741\",\"bank_ref_no\":\"1529647000433\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"713658.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira Nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira Nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"713658.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"22\\/06\\/2018 11:26:55\",\"bin_country\":\"\\t\\t\\t\\t\\t\\t\\t\\t\\t\",\"trans_type\":\"2\"}', '2018-06-22 05:56:25', '2018-06-22 05:56:42'),
(207, '965902860966', 'AM-9467333531', 1, 0, NULL, 0, 0, NULL, '0', '5', NULL, NULL, 396919.38, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 69.00, '2018-06-22 14:03:07', NULL, '2018-06-22 14:02:58', '2018-06-22 14:03:07');
INSERT INTO `transactions` (`transaction_id`, `tracking_id`, `order_id`, `user_id`, `product_id`, `user_gift_card_id`, `return_product_request_id`, `replacement_product_request_id`, `bank_ref_no`, `order_status`, `payment_status`, `card_name`, `currency`, `amount`, `billing_name`, `billing_address`, `billing_city`, `billing_country`, `billing_email`, `delivery_tel`, `delivery_country`, `delivery_zip`, `delivery_state`, `delivery_city`, `delivery_address`, `delivery_name`, `billing_tel`, `billing_zip`, `billing_state`, `status_message`, `status_code`, `payment_mode`, `failure_message`, `trans_type`, `transaction_usd_value`, `trans_date`, `response_data`, `created_at`, `updated_at`) VALUES
(208, '307003902163', 'AM-9081670779', 1, 0, NULL, 0, 0, '1529678353852', 'Success', '1', 'AvenuesTest', 'INR', 52069.38, 'Nayan Pawar', 'Indira Nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira Nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-9081670779\",\"tracking_id\":\"307003902163\",\"bank_ref_no\":\"1529678353852\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"52069.38\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira Nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira Nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"52069.38\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"22\\/06\\/2018 20:09:28\",\"bin_country\":\"\\t\\t\\t\\t\\t\\t\\t\\t\\t\",\"trans_type\":\"2\"}', '2018-06-22 14:38:59', '2018-06-22 14:39:18'),
(209, '307003905581', 'CS-2018-c5910ae4748997d3', 1, 0, 45, 0, 0, '1529904476990', 'Success', '1', 'AvenuesTest', 'INR', 50000.00, 'Nayan Pawar', 'asasa', 'asasass', 'India', 'nayan@gmail.com', '8458458544', 'India', 'sasasas', 'asasasa', 'asasass', 'asasa', 'Nayan Pawar', '8458458544', 'sasasas', 'asasasa', 'Y', 'null', 'Net Banking', '', '2', 69.00, '2018-06-25 05:28:05', '{\"order_id\":\"CS-2018-c5910ae4748997d3\",\"tracking_id\":\"307003905581\",\"bank_ref_no\":\"1529904476990\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"50000.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"asasa\",\"billing_city\":\"asasass\",\"billing_state\":\"asasasa\",\"billing_zip\":\"sasasas\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"asasa\",\"delivery_city\":\"asasass\",\"delivery_state\":\"asasasa\",\"delivery_zip\":\"sasasas\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"gift_card\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"50000.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"25\\/06\\/2018 10:58:13\",\"bin_country\":\"\\u0010\\u0010\\u0010\\u0010\\u0010\\u0010\\u0010\\u0010\\u0010\\u0010\\u0010\\u0010\\u0010\\u0010\\u0010\\u0010\",\"user_gift_card_id\":45,\"trans_type\":\"2\",\"user_id\":1}', '2018-06-25 05:28:05', '2018-06-25 05:28:05'),
(210, '307003905589', 'CS-2018-1d8761c993f5a888', 1, 0, 46, 0, 0, '1529904578474', 'Success', '1', 'AvenuesTest', 'INR', 50000.00, 'Nayan Pawar', 'iiioiokiki', 'asasas', 'India', 'nayan@gmail.com', '8458458544', 'India', 'asasa', 'asasasasas', 'asasas', 'iiioiokiki', 'Nayan Pawar', '8458458544', 'asasa', 'asasasasas', 'Y', 'null', 'Net Banking', '', '2', 69.00, '2018-06-25 05:29:47', '{\"order_id\":\"CS-2018-1d8761c993f5a888\",\"tracking_id\":\"307003905589\",\"bank_ref_no\":\"1529904578474\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"50000.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"iiioiokiki\",\"billing_city\":\"asasas\",\"billing_state\":\"asasasasas\",\"billing_zip\":\"asasa\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"iiioiokiki\",\"delivery_city\":\"asasas\",\"delivery_state\":\"asasasasas\",\"delivery_zip\":\"asasa\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"gift_card\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"50000.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"25\\/06\\/2018 10:59:55\",\"bin_country\":\"\\u0006\\u0006\\u0006\\u0006\\u0006\\u0006\",\"user_gift_card_id\":46,\"trans_type\":\"2\",\"user_id\":1}', '2018-06-25 05:29:47', '2018-06-25 05:29:47'),
(211, '307003906526', 'CS-2018-f56a7449cf7bc41a', 1, 0, 47, 0, 0, '1529918346242', 'Success', '1', 'AvenuesTest', 'INR', 100.00, 'Nayan Pawar', 'Mumbai naka', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422220', 'Maharashtra', 'Nashik', 'Mumbai naka', 'Nayan Pawar', '8458458544', '422220', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '2', 69.00, '2018-06-25 09:19:20', '{\"order_id\":\"CS-2018-f56a7449cf7bc41a\",\"tracking_id\":\"307003906526\",\"bank_ref_no\":\"1529918346242\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"100.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Mumbai naka\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422220\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Mumbai naka\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422220\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"gift_card\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"100.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"25\\/06\\/2018 14:49:22\",\"bin_country\":\"\\u0004\\u0004\\u0004\\u0004\",\"user_gift_card_id\":47,\"trans_type\":\"2\",\"user_id\":1}', '2018-06-25 09:19:20', '2018-06-25 09:19:20'),
(212, '307003907126', 'AM-0264140216', 1, 0, NULL, 0, 0, '1529924097816', 'Success', '1', 'AvenuesTest', 'INR', 689826.50, 'Nayan Pawar', 'Indira Nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira Nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-0264140216\",\"tracking_id\":\"307003907126\",\"bank_ref_no\":\"1529924097816\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"689826.5\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira Nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira Nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"689826.5\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"25\\/06\\/2018 16:25:14\",\"bin_country\":\"\\t\\t\\t\\t\\t\\t\\t\\t\\t\",\"trans_type\":\"2\"}', '2018-06-25 10:54:43', '2018-06-25 10:55:05'),
(213, '', '', 1, 44, NULL, 4, 0, NULL, 'Success', '1', NULL, 'INR', 5000.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'bank', '', '3', 69.00, '2018-06-25 14:25:54', NULL, '2018-06-25 14:25:54', '2018-06-25 14:25:54'),
(214, '', '', 1, 44, NULL, 4, 0, NULL, 'Success', '1', NULL, 'INR', 1000.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'bank', '', '3', 69.00, '2018-06-25 14:31:19', NULL, '2018-06-25 14:31:19', '2018-06-25 14:31:19'),
(215, '', '', 1, 44, NULL, 4, 0, NULL, 'Success', '1', NULL, 'INR', 1000.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'bank', '', '3', 69.00, '2018-06-25 14:32:07', NULL, '2018-06-25 14:32:07', '2018-06-25 14:32:07'),
(216, '', '', 1, 44, NULL, 4, 0, NULL, 'Success', '1', NULL, 'INR', 1500.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'bank', '', '3', 69.00, '2018-06-25 14:34:49', NULL, '2018-06-25 14:34:49', '2018-06-25 14:34:49'),
(217, '307003909208', 'AM-1396978260', 1, 0, NULL, 0, 0, '1529987115504', 'Success', '1', 'AvenuesTest', 'INR', 309794.00, 'Nayan Pawar', 'Indira Nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira Nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1396978260\",\"tracking_id\":\"307003909208\",\"bank_ref_no\":\"1529987115504\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"309794.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira Nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira Nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"309794.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"26\\/06\\/2018 09:55:32\",\"bin_country\":\"\\t\\t\\t\\t\\t\\t\\t\\t\\t\",\"trans_type\":\"2\"}', '2018-06-26 04:24:57', '2018-06-26 04:25:18'),
(218, '307003909210', 'AM-0517857812', 1, 0, NULL, 0, 0, '1529987209115', 'Success', '1', 'AvenuesTest', 'INR', 309794.00, 'Nayan Pawar', 'Indira Nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira Nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-0517857812\",\"tracking_id\":\"307003909210\",\"bank_ref_no\":\"1529987209115\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"309794.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira Nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira Nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"309794.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"26\\/06\\/2018 09:57:06\",\"bin_country\":\"\\t\\t\\t\\t\\t\\t\\t\\t\\t\",\"trans_type\":\"2\"}', '2018-06-26 04:26:38', '2018-06-26 04:26:52'),
(219, '307003909219', 'AM-6039556786', 1, 0, NULL, 0, 0, '1529987428463', 'Success', '1', 'AvenuesTest', 'INR', 12.66, 'Nayan Pawar', 'Indira Nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira Nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-6039556786\",\"tracking_id\":\"307003909219\",\"bank_ref_no\":\"1529987428463\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"12.66\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira Nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira Nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"12.66\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"26\\/06\\/2018 10:00:45\",\"bin_country\":\"\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\",\"trans_type\":\"2\"}', '2018-06-26 04:30:17', '2018-06-26 04:30:33'),
(220, '307003909224', 'AM-1187035513', 1, 0, NULL, 0, 0, '1529987491822', 'Success', '1', 'AvenuesTest', 'INR', 24035.00, 'Nayan Pawar', 'Indira Nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira Nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-1187035513\",\"tracking_id\":\"307003909224\",\"bank_ref_no\":\"1529987491822\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"24035.0\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira Nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira Nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"24035.0\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"26\\/06\\/2018 10:01:49\",\"bin_country\":\"\\u000b\\u000b\\u000b\\u000b\\u000b\\u000b\\u000b\\u000b\\u000b\\u000b\\u000b\",\"trans_type\":\"2\"}', '2018-06-26 04:31:20', '2018-06-26 04:31:34'),
(221, '', '', 1, 57, NULL, 7, 0, NULL, 'Success', '1', NULL, 'INR', 4.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '3', 69.00, '2018-06-26 04:35:58', NULL, '2018-06-26 04:35:58', '2018-06-26 04:35:58'),
(222, '307003909325', 'AM-9892738921', 1, 0, NULL, 0, 0, '1529989871409', 'Success', '1', 'AvenuesTest', 'INR', 122.50, 'Nayan Pawar', 'Indira Nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira Nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-9892738921\",\"tracking_id\":\"307003909325\",\"bank_ref_no\":\"1529989871409\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"122.5\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira Nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira Nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"122.5\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"26\\/06\\/2018 10:41:28\",\"bin_country\":\"\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\\u000f\",\"trans_type\":\"2\"}', '2018-06-26 05:10:55', '2018-06-26 05:11:14'),
(223, '307003909338', 'AM-4912878423', 1, 0, NULL, 0, 0, '1529990064695', 'Success', '1', 'AvenuesTest', 'INR', 6.33, 'Nayan Pawar', 'Indira Nagar', 'Nashik', 'India', 'nayan@gmail.com', '8458458544', 'India', '422001', 'Maharashtra', 'Nashik', 'Indira Nagar', 'Nayan Pawar', '8458458544', '422001', 'Maharashtra', 'Y', 'null', 'Net Banking', '', '1', 69.00, '0000-00-00 00:00:00', '{\"order_id\":\"AM-4912878423\",\"tracking_id\":\"307003909338\",\"bank_ref_no\":\"1529990064695\",\"order_status\":\"Success\",\"failure_message\":\"\",\"payment_mode\":\"Net Banking\",\"card_name\":\"AvenuesTest\",\"status_code\":\"null\",\"status_message\":\"Y\",\"currency\":\"INR\",\"amount\":\"6.33\",\"billing_name\":\"Nayan Pawar\",\"billing_address\":\"Indira Nagar\",\"billing_city\":\"Nashik\",\"billing_state\":\"Maharashtra\",\"billing_zip\":\"422001\",\"billing_country\":\"India\",\"billing_tel\":\"8458458544\",\"billing_email\":\"nayan@gmail.com\",\"delivery_name\":\"Nayan Pawar\",\"delivery_address\":\"Indira Nagar\",\"delivery_city\":\"Nashik\",\"delivery_state\":\"Maharashtra\",\"delivery_zip\":\"422001\",\"delivery_country\":\"India\",\"delivery_tel\":\"8458458544\",\"merchant_param1\":\"\",\"merchant_param2\":\"product\",\"merchant_param3\":\"\",\"merchant_param4\":\"\",\"merchant_param5\":\"\",\"vault\":\"N\",\"offer_type\":\"null\",\"offer_code\":\"null\",\"discount_value\":\"0.0\",\"mer_amount\":\"6.33\",\"eci_value\":\"null\",\"retry\":\"N\",\"response_code\":\"0\",\"billing_notes\":\"\",\"trans_date\":\"26\\/06\\/2018 10:44:42\",\"bin_country\":\"\\u0001\",\"trans_type\":\"2\"}', '2018-06-26 05:14:15', '2018-06-26 05:14:27'),
(224, '401755964365', 'AM-2373601838', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 344850.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 69.00, NULL, NULL, '2018-06-26 05:17:41', '2018-06-26 05:17:41'),
(225, '438573169855', 'AM-6497786683', 1, 0, NULL, 0, 0, NULL, '0', '0', NULL, NULL, 344850.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 69.00, NULL, NULL, '2018-06-26 05:17:53', '2018-06-26 05:17:53'),
(226, '505454511569', 'AM-5434900343', 1, 0, NULL, 0, 0, NULL, '0', '5', NULL, NULL, 344850.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 69.00, '2018-06-26 05:18:27', NULL, '2018-06-26 05:18:22', '2018-06-26 05:18:27'),
(227, '', '', 1, 57, NULL, 7, 0, NULL, 'Success', '1', NULL, 'INR', 3.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'wallet', '', '3', 69.00, '2018-06-26 13:20:57', NULL, '2018-06-26 13:20:57', '2018-06-26 13:20:57'),
(228, '', '', 1, 44, NULL, 4, 0, NULL, 'Success', '1', NULL, 'INR', 130.00, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 'bank', '', '3', 69.00, '2018-06-26 13:28:09', NULL, '2018-06-26 13:28:09', '2018-06-26 13:28:09'),
(229, '052600633372', 'AM-5707497982', 1, 0, NULL, 0, 0, NULL, '0', '5', NULL, NULL, 7.32, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', 69.00, '2018-10-20 10:10:16', NULL, '2018-10-20 10:10:09', '2018-10-20 10:10:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` enum('1','2') NOT NULL COMMENT '1-Male,2-Female',
  `country_phone_code_id` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `password_reset_code` mediumtext,
  `remember_token` varchar(100) DEFAULT NULL,
  `profile_image` varchar(100) DEFAULT NULL,
  `is_email_verified` enum('0','1') NOT NULL COMMENT '0=unverified, 1=verified',
  `status` enum('0','1') NOT NULL COMMENT '0=active, 1=inactive',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `gender`, `country_phone_code_id`, `address`, `mobile_number`, `email`, `password`, `password_reset_code`, `remember_token`, `profile_image`, `is_email_verified`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Nayan', 'Pawar', '2', '101', 'Nashik, Maharashtra, India', '8458458544', 'nayan@gmail.com', '$2y$10$n6NHnlo7Nzjms6EmIaUhPuVlNTcgCN94wz/SUxRPwxQAtXF6oiTUe', NULL, 'ernYLZZCQw7leP57O47G1noAn1DDY4LxDnbzoDN3P44seAOWtHVqjETsA3T5', '84c95fa0cdecb26c8b865390166b95ffbd162ad7.jpg', '1', '1', '2018-04-23 18:30:00', '2018-11-12 05:46:17', NULL),
(3, 'Deepak', 'Bari', '1', '101', 'Pune, Maharashtra, India', '9922276924', 'yove@aditus.info', '$2y$10$JEWVS8ScA6PzNVb7QFF2CuT.OtLWgKbZcMazmVpuvT6y/R1a6u4DW', NULL, 'Uueq4qkwuzraYMmPvPi53cZyjkrPraqqpBl9NDIxcYCoEcVg0OTXXbr13xYC', NULL, '1', '1', '2018-05-07 08:04:47', '2018-05-30 12:08:01', NULL),
(4, 'Dsds', 'Dsds', '1', '101', 'SD, USA', '89898989', 'dev@webwingtechnologies.com', '$2y$10$6Am6KtVCSVDi/.H468QsfOz2Z7jew5mU5337l0e/TKGM08QlXpEbC', NULL, NULL, NULL, '0', '1', '2018-05-07 22:54:32', '2018-05-07 22:54:32', NULL),
(5, 'Ds', 'Dssd', '1', '101', 'DSK Vishwa, Dhayari, Pune, Maharashtra, India', '9898989', 'juyunayas@bitwhites.top', '$2y$10$3K39WiIISi2LbcAkkcoKZOmGrQ1ROQQzvd5YVGSg5.ta6ztL9dZ1u', NULL, 'C9aiHoXH7NQ3zILPrxQ6TWucxZT8Gs29y27uPvKQsidCAOzyH7X2EaGnqyEW', NULL, '0', '1', '2018-05-07 23:28:45', '2018-05-08 05:13:50', NULL),
(6, 'Sdds', 'Dssd', '1', '101', 'Delhi, India', '9898989', 'koko@stelliteop.info', '$2y$10$ut4lqhR/x0L0SA98q7zKGOB3/jqbdzxc60yDGgd3WgcoI6t5UAYEa', NULL, NULL, NULL, '0', '1', '2018-05-08 00:23:51', '2018-05-08 00:23:51', NULL),
(7, 'Dsds', 'Dssd', '1', '101', 'SD, USA', '99898998', 'kukubiwa@air2token.com', '$2y$10$YlShiHy46W1UH8AJialHm.QlxiX3bqrbksVULPmtIPUBgO.cXVDFG', NULL, NULL, NULL, '1', '1', '2018-05-08 00:33:29', '2018-05-08 00:58:06', NULL),
(8, 'Yatin', 'Pawar', '1', '101', 'DFW Airport, Grapevine, TX, USA', '4578787', 'yatin@gmail.com', '$2y$10$TIlIAoXGAMWjJIuWD5P1B.HOWJ9/.BENfPyAHkLiXYsstPcxcKEVC', NULL, '868219f9605c334fc94a3af5b64f1a96', NULL, '0', '1', '2018-05-08 01:44:51', '2018-05-08 01:44:51', NULL),
(9, 'Ds', 'Dssd', '1', '101', 'SDJ/201, Ambazari Road, Corporation Colony, Ambazari, Nagpur, Maharashtra, India', '999565656', 'abcd@gmail.com', '$2y$10$MKmy8dED6YKWNN71iqXK..MOtys16ReaG7Wt9ZQ8ET4hncczgF3b6', NULL, 'bc77b1b5102ea27e889658952db1b961', NULL, '0', '1', '2018-05-08 04:41:48', '2018-05-08 04:41:48', NULL),
(10, 'Deepak', 'Salunke', '1', '101', 'Nashik Railway Track Road, Nawle Colony, Government Colony, Nashik, Maharashtra, India', '9876543210', 'yocijekem@2odem.com', '$2y$10$p174v4clY5qMtfAXm93k3O9u2ZNL55KWRXM6htxXeYPTbb/BVdQJ.', NULL, '7dfda1fc186c634e650950609384f4c9', NULL, '0', '1', '2018-05-18 07:24:41', '2018-05-18 07:24:41', NULL),
(11, 'Ds', 'Sdsdsd', '1', '15', 'DD2/21 Cao Thắng, phường 5, District 3, Ho Chi Minh City, Vietnam', '89898989', 'gukovecu@2odem.com', '$2y$10$JTEF01iddQI0wEsgSSHoRugY1XhFtzsSrhmf6wYHuEiZhwWW1gj9W', NULL, '33004091b238306b68aaece0725caf6c', NULL, '0', '1', '2018-05-28 07:17:37', '2018-05-28 07:17:37', NULL),
(12, 'Dssd', 'Sdsd', '1', '101', 'Administration Drive, Denton, TX, USA', '98898989', 'rp7254653@gmail.com', '$2y$10$2nRFoeaiHAJ6LaWk4B.nOuTVomRFeDKdlaaVkXnHihWjUHkIZSi06', NULL, 'YHAGcHkzGFOjsCrHyTRr1SEYocLrdjVOAUCbf2SNJbNgwliTV3ThZzFfkTrw', NULL, '1', '1', '2018-05-28 23:23:46', '2018-05-29 05:04:15', NULL),
(13, 'Anna', 'Adam', '1', '101', 'Pune International Airport Area, Lohgaon, Pune, Maharashtra, India', '9638527412', 'anna.adam51@yahoo.com', '$2y$10$8rA5s7SBBPPCFHfcXjxfCe0GnsDfajZ5xj/.kfg2k9AzyiLzttMNO', NULL, 'CwgVXyPnuHHxYJqozang0wjD68ncfh5cpQ9YRCRS6oqtrQsQQ2EFYQDSOBjL', '8ef120300e450aaa3b36b7063467bff20ec0f820.jpg', '1', '1', '2018-06-07 13:26:01', '2018-06-21 10:28:14', NULL),
(14, 'Mahesh', 'Kale', '1', '101', 'Nashik - Pune Road, Bodhale Nagar, RTO Colony, Ganesh Baba Nagar, Nashik, Maharashtra, India', '9921840141', 'sachin@o3enzyme.com', '$2y$10$haQzWry2mRNcH/CFj6UDmOCReVQxfRk6itvKaskYL4x4lfwhP2zQy', NULL, 'aag2L28hKs88pwqMkgkNjniRdoqp1IkITVAT94OSXCr6whI76tNPd2BcLmuu', NULL, '1', '1', '2018-06-08 14:38:14', '2018-06-08 15:07:46', NULL),
(15, 'Yeyu', 'Yin', '1', '101', 'Nashik, Maharashtra, India', '7058025510', 'yeyuyin@99pubblicita.com', '$2y$10$acGwbPPF6ucFRM1gTFGMDep2Q7FlYgQ7hKwD2GrEYBoqhTZ7KJCOS', NULL, 'V4fqSYFpA6fZVdKe19ZWiQIUWzY5KdXuluOHmj4HqEuq62TUDsnc1ojMPGXb', NULL, '1', '1', '2018-06-19 05:25:56', '2018-06-19 05:28:02', NULL),
(16, 'Sagar', 'Pawar', '1', '101', 'Nashik, Maharashtra, India', '9850401386', 'xikovi@l0real.net', '$2y$10$wA2JKFXluTbzmtqV5woBluzYuTi7xwARvo6rSwu8sueMoBgnXUP0y', NULL, '8adcd8cbf428ecf21ffe716684d5740f', NULL, '0', '1', '2018-06-21 11:29:38', '2018-06-21 11:29:38', NULL),
(17, 'Sagar', 'Pawar', '1', '101', 'Nashville, TN, USA', '121546546465', 'zawix@taylorventuresllc.com', '$2y$10$Nc1Cujtx3.hN6rnIocS1v.ktm0mfF5uJxkLKLqF8.bTrol6fQ333q', NULL, '8934a1544bcb6052e6520fc55f0b7dbb', NULL, '0', '1', '2018-06-21 11:34:22', '2018-06-21 11:34:22', NULL),
(18, 'Sagar', 'Pawar', '1', '101', 'Nashik, Maharashtra, India', '9850401386', 'luvodo@99pubblicita.com', '$2y$10$yBDxOhnCWWh5HUBL3oNjguMbQKQmdYIzgnnTEZxThrrnomYPWlFPO', NULL, '4151c618cdac69ac31d66dd0bba76417', NULL, '0', '1', '2018-06-21 11:51:41', '2018-06-21 11:51:41', NULL),
(19, 'Sagar', 'Pawar', '1', '101', 'Nashik, Maharashtra, India', '9850401386', 'fomutupuz@loketa.com', '$2y$10$ah6XzlQBNlxbyi74mU7Ni.jD4kUYuuNv7kHUwL43E3CYlvflT0H9y', NULL, '8fc89782f41dfb9be0f2b1b4d869ebd8', NULL, '0', '1', '2018-06-21 11:53:58', '2018-06-21 11:53:58', NULL),
(20, 'Sagar', 'Pawar', '1', '101', 'Nashik, Maharashtra, India', '9850401386', 'yaradibek@o3enzyme.com', '$2y$10$lh0Wd2z036YUettXV7go4.llFSrhxHFMpo3iobad9puif.yIeu0fi', NULL, '4321a8aa8e60700946254c41c798fc25', NULL, '0', '1', '2018-06-21 11:54:40', '2018-06-21 11:54:40', NULL),
(21, 'Sagar', 'Pawar', '1', '101', 'Nashik, Maharashtra, India', '9850401386', 'raxepipu@shinnemo.com', '$2y$10$/QqcMv7NUuHCS4s1F42KZOigwTi4zxqI3JDkmPqPrdxhnp/MRYr1C', NULL, '60113ab09087d69e951d15693159760f', NULL, '0', '1', '2018-06-21 11:55:32', '2018-06-21 11:55:32', NULL),
(22, 'Sagar', 'Pawar', '1', '101', 'Nashik, Maharashtra, India', '9850401386', 'birajat@trimsj.com', '$2y$10$25G9we7JHTSM2YUd15h6YOapE7y8.tM4sD29ht6oO7YQYghYl76UC', NULL, '4a8fb9d24f5f4c1feeb52a8d2cce8b6b', NULL, '0', '1', '2018-06-21 11:56:23', '2018-06-21 11:56:23', NULL),
(23, 'Sagar', 'Pawar', '1', '101', 'Nashik, Maharashtra, India', '9850401386', 'geyi@99pubblicita.com', '$2y$10$yqSAoJD8Uu0NXjWW26I1YuOPjZLhuhA5Sq1FVlR7buXwtRnYlw5ai', NULL, '49008708b89cfbfd1b07ccd54641979a', NULL, '0', '1', '2018-06-21 11:58:44', '2018-06-21 11:58:44', NULL),
(24, 'Fsdfds', 'Fdsfds', '1', '5', '898989', '89898998', 'fsdfsdsdf@gmail.com', '$2y$10$wE5TRxTPkcKpP73ppmrXBeuBUekZVhi8kBXDc8OO.kRQFCUmps6b2', NULL, '60e7989cc0683646ad766e3522dbcda0', NULL, '0', '1', '2018-06-22 07:14:01', '2018-06-22 07:14:01', NULL),
(25, 'Dsdsd', 'Dsds', '1', '229', 'sdkfjsdfj', '89898998', 'dsdsd@gmailc.om', '$2y$10$YP0JchMScIj2GxiO5jtrdeWV/A5N1Zd/miHjxV.NExGHEL5r7uD56', NULL, '9b0b64ab34068815171479c5e1fa714b', NULL, '0', '1', '2018-06-22 07:15:24', '2018-06-22 07:15:24', NULL),
(26, 'Dsd', 'Ddssdd', '1', '101', 'dsksdlk', '857897878', 'sdklfjsdkl@gmail.com', '$2y$10$WWrXIGNxTmoMlOJO7Uu3Aubd.vSykB9HnK5V9CGMwLa6vMJYXkSK6', NULL, 'ce646ad3bf78599a5d30b77b6532b95c', NULL, '0', '1', '2018-06-22 07:18:48', '2018-06-22 07:18:48', NULL),
(27, 'Dsdsd', 'Sdfksdfsd', '1', '8', 'Adsf', '89989898', 'dkfhsdfhk@gmail.com', '$2y$10$4EBziF5L63tnNiPMf3PPYuzacNJtWs/CRh6GgkFt/TqiDAylBfrqG', NULL, 'dc43427b0cfa79ee5933cb4a80a5d825', NULL, '0', '1', '2018-06-22 07:22:02', '2018-06-22 07:22:02', NULL),
(28, 'Dssd', 'Sdsdsd', '1', '101', 'Davis School District, UT, USA', '989898998', 'dfsdf@gmail.com', '$2y$10$tHKKhAXQbhlve6ZnYmH26eOOu1HnquZ5I19NOYCcrGAbWeyhfDITS', NULL, '543ab9efb389773cda55dc2433adef5c', NULL, '0', '1', '2018-06-22 07:29:42', '2018-06-22 07:29:42', NULL),
(29, 'Dssdds', 'Dfsdfsd', '1', '101', 'dfsd', '89899898', 'djsdj@gmail.com', '$2y$10$23E13Uh1xsDBEQNdsuGxMeZBApvuTu.DmIp3bJ7NTZPo6JA4LsuAS', NULL, '8e1ee62f9dac32ca61ab15a40a1db8b6', NULL, '0', '1', '2018-06-22 07:30:53', '2018-06-22 07:30:53', NULL),
(30, 'Dfs', 'Fsddfs', '1', '101', 'sdsda, Overbrook Road, Elyria, OH, USA', '89899889', 'fds@gnaum.com', '$2y$10$aDwlgjSUdZGsCtjHC/ts2eFdzPfdHBOAnnb3PTrVQgl5fUmyqLRqS', NULL, 'e6418927678f7a03debe628bd56e404d', NULL, '0', '1', '2018-06-22 07:32:08', '2018-06-22 07:32:08', NULL),
(31, 'Dsdssd', 'Sdsd', '1', '101', 'DFW Airport, Grapevine, TX, USA', '89899889', 'dsdsdsds@gmail.com', '$2y$10$ZqieBvG9JfOa3UTLnqSx2u2xJt2Ro1Wgu8Yqw.LoFE05.4fehxVHW', NULL, 'a525d78a0af138478fb93c3d42158b61', NULL, '0', '1', '2018-06-22 08:21:53', '2018-06-22 08:21:53', NULL),
(32, 'Dsdds', 'Dssdsd', '1', '101', 'Ad', '89899889', 'dsd@gmail.com', '$2y$10$/8/imMQBcCcRjZnCDerKv.LTJP9LMZarFfqC1hkw5Eik3vYjOFR3u', NULL, '027740623e6b7cdacf382d3df95d411d', NULL, '0', '1', '2018-06-22 08:22:55', '2018-06-22 08:22:55', NULL),
(33, 'Sagar', 'Pawar', '1', '101', 'Nashik, Maharashtra, India', '9850401386', 'poyabusoza@yk20.com', '$2y$10$.ettLQ9wf5n0hQBsUS3n1ect.3JtDZADJADPfNdhkWzhXJa00fq.e', NULL, '64443352360648ac22edcc1b67c5d988', NULL, '0', '1', '2018-06-22 08:35:09', '2018-06-22 08:35:09', NULL),
(34, 'Sagar', 'Pawar', '1', '101', 'Nashik, Maharashtra, India', '12165454554', 'sagar@mail.com', '$2y$10$wWkP.9HiZZPOTRIu39D1Nu9Oo8hR5ZyaK5JpHP2SPOCDm5NnAMfCi', NULL, '5721c0d258ec5bf04304976df603e493', NULL, '0', '1', '2018-06-25 04:33:15', '2018-06-25 04:33:15', NULL),
(35, 'Sagar', 'Pawar', '1', '101', 'Nashik, Maharashtra, India', '124152454', 'sagar@mail2.com', '$2y$10$UgZ6G7IJQZ1pLj5l6aWs6.K1KLfJJrdjt40OS7QykGMnR9rm230dy', NULL, '63783db8dc4ffb1b7e288044ed93f07e', NULL, '0', '1', '2018-06-25 04:34:51', '2018-06-25 04:34:51', NULL),
(36, 'Nitin', 'Patil', '1', '101', 'Avenida Corrientes 2284, Buenos Aires, Argentina', '99922454545', 'bofofofuhu@loketa.com', '$2y$10$6tIqzxmPQ6Hy27lpEA3/WOzMkO0F2ZTKrhqXAUMWE.h02eZqmVlxO', NULL, NULL, NULL, '1', '1', '2018-06-25 12:04:34', '2018-06-25 12:05:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_password_resets`
--

CREATE TABLE `users_password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_password_resets`
--

INSERT INTO `users_password_resets` (`email`, `token`, `created_at`) VALUES
('kaju@b2bx.net', 'b2a2d803cc2333f58c1842410b71e2a8787aca365a43ea8a1c94ed105e9434b0', '2018-05-07 23:48:48'),
('vevi@ethersportz.info', 'bef6870e90dc9035e7581c6d398bb24d06dae37d4a6dee06bd2b48b065cc36f2', '2018-05-18 07:23:06'),
('rp7254653@gmail.com', 'df54c57ad26488491415e5b33532115bbad78460f3ec15d6de4e0b29f5a0a877', '2018-05-28 23:40:41'),
('nayan@gmail.com', '71e92b491a2885fc82890d00128c63c382c21ff5b87b1f1ba3db7db5447539c1', '2018-06-21 18:35:48');

-- --------------------------------------------------------

--
-- Table structure for table `user_gift_cards`
--

CREATE TABLE `user_gift_cards` (
  `id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `gift_card_id` int(11) NOT NULL,
  `user_to_email` varchar(255) NOT NULL,
  `user_to_phone` varchar(255) NOT NULL,
  `gift_card_code` varchar(255) NOT NULL,
  `amount` float(20,2) NOT NULL,
  `is_used` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1-used, 0-unused',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_gift_cards`
--

INSERT INTO `user_gift_cards` (`id`, `from_user_id`, `gift_card_id`, `user_to_email`, `user_to_phone`, `gift_card_code`, `amount`, `is_used`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'nayan@gmail.com', '+918149905936', 'GIFT123', 4000.00, '1', '2018-05-21 11:23:53', '2018-06-26 04:26:52'),
(2, 1, 1, 'deepak@gmail.com', '+918149905936', 'GIFT456', 400.00, '0', '2018-05-21 09:52:44', '2018-05-22 09:22:03'),
(5, 1, 1, 'mmm@gmail.com', '898988989', '', 250.00, '0', '2018-05-31 05:37:20', '2018-06-01 10:21:41'),
(6, 1, 1, 'mangesh@gmail.com', '89898989', '', 250.00, '0', '2018-05-31 05:43:02', '2018-05-31 05:43:02'),
(7, 1, 2, 'vishal@gmail.com', '89898989', 'SPL8S7VV3JIG', 50.00, '0', '2018-05-31 06:16:08', '2018-05-31 06:16:08'),
(8, 1, 3, 'nilesh@gmail.com', '89898998', 'W9F4NCXI5OLV', 100.00, '0', '2018-05-31 06:19:07', '2018-05-31 06:19:07'),
(9, 1, 2, 'nnnn@gmail.com', '8989898', 'A1S1UESNAP7N', 50.00, '0', '2018-05-31 06:33:27', '2018-05-31 06:33:27'),
(10, 1, 3, 'sagar@gmail.com', '+10189898989', 'PFR76ZLRKKBL', 100.00, '0', '2018-05-31 06:40:04', '2018-05-31 06:40:04'),
(11, 1, 2, 'shital@gmail.com', '+919922276924', '3P963D5U2F0U', 50.00, '0', '2018-05-31 06:44:08', '2018-05-31 06:44:08'),
(12, 1, 3, 'vipul@gmail.com', '+9189898998', '2Y60O5KUH414', 100.00, '0', '2018-05-31 07:28:19', '2018-05-31 07:28:19'),
(13, 1, 2, 'bozacipac@larjem.com', '+919922276924', 'GZOCTKA2REAE', 50.00, '0', '2018-05-31 08:29:56', '2018-05-31 08:29:56'),
(14, 1, 2, 'bozacipac@larjem.com', '+919922276924', 'F4BWEDX7984U', 50.00, '0', '2018-05-31 08:30:16', '2018-05-31 08:30:16'),
(15, 1, 2, 'bozacipac@larjem.com', '+919922276924', '4IDKA1JDAWLF', 50.00, '0', '2018-05-31 08:31:02', '2018-05-31 08:31:02'),
(16, 1, 2, 'bozacipac@larjem.com', '+919922276924', 'V3OUPXUUNFGC', 50.00, '0', '2018-05-31 08:32:03', '2018-05-31 08:32:03'),
(17, 1, 2, 'bozacipac@larjem.com', '+919922276924', '5S07J3250WKZ', 50.00, '0', '2018-05-31 08:32:16', '2018-05-31 08:32:16'),
(18, 1, 2, 'mdmsm@gmail.com', '+9189898989', 'MWOG8OIYM1K5', 50.00, '0', '2018-06-01 00:18:11', '2018-06-01 00:18:11'),
(19, 1, 2, 'nannnnn@gmail.com', '+9189898998', 'F6X46BLJMYFN', 50.00, '0', '2018-06-02 04:56:49', '2018-06-02 04:56:49'),
(20, 1, 2, 'mmmd@gmail.com', '+91898898989', 'TS4FYEZSYDRP', 50.00, '0', '2018-06-02 05:03:03', '2018-06-02 05:03:03'),
(21, 1, 2, 'ndsdsd@gmail.com', '+918989899889', 'NDERPB9NTSZQ', 50.00, '0', '2018-06-02 05:08:05', '2018-06-02 05:08:05'),
(22, 1, 2, 'dssd@gmail.com', '+9178787887', 'P8PSTPVSFL2M', 50.00, '0', '2018-06-02 05:09:12', '2018-06-02 05:09:12'),
(23, 1, 2, 'jjjdd@gmail.com', '+9189899898', 'ZTA51MEXAZ0C', 50.00, '0', '2018-06-02 05:12:15', '2018-06-02 05:12:15'),
(24, 1, 2, 'mdmsmds@gmail.com', '+9189898985', 'RKQV8YUKHUUT', 50.00, '0', '2018-06-02 05:18:00', '2018-06-02 05:18:00'),
(25, 1, 1, 'sshhshs@gmail.com', '+9178978787878', 'JZFYRZEU62MO', 250.00, '0', '2018-06-02 05:20:56', '2018-06-02 05:20:56'),
(26, 1, 3, 'mmss@gmail.com', '+9189898998', 'FGJJ3IOB4YOI', 100.00, '0', '2018-06-02 05:22:56', '2018-06-02 05:22:56'),
(27, 1, 2, 'djdjsd@gmail.com', '+917878787878', 'S713RUJZUI8F', 50.00, '0', '2018-06-02 05:31:28', '2018-06-02 05:31:28'),
(28, 1, 3, 'sagirixu@yk20.com', '+919850401386', 'ZRU40X6PEXP0', 100.00, '0', '2018-06-04 06:49:51', '2018-06-04 06:49:51'),
(29, 1, 2, 'toceyi@creazionisa.com', '+919922276924', '148CJSFDMI4O', 50.00, '0', '2018-06-06 04:51:45', '2018-06-06 04:51:45'),
(30, 1, 2, 'dsdsd@gmail.com', '+91989898998', '7WROBRXLFYPA', 50.00, '0', '2018-06-07 05:43:05', '2018-06-07 05:43:05'),
(31, 1, 3, 'dsdddddd@gmail.com', '+9189899898', '1TUWCL9RKLKQ', 100.00, '0', '2018-06-07 05:44:40', '2018-06-07 05:44:40'),
(32, 1, 2, 'dds@gmail.com', '+24698899898', 'DKNSRBN4DCWP', 50.00, '0', '2018-06-07 05:46:19', '2018-06-07 05:46:19'),
(33, 1, 2, 'dds@gmail.com', '+24698899898', 'CVMTTQ0L5VAC', 50.00, '0', '2018-06-07 05:46:47', '2018-06-07 05:46:47'),
(34, 1, 2, 'dssdds@gmail.com', '+9189898998', 'YNRUVO7IG736', 50.00, '0', '2018-06-07 05:49:11', '2018-06-07 05:49:11'),
(35, 1, 2, 'ndnd@gmail.com', '+9189989898', 'MA8UDPG35FPZ', 50.00, '0', '2018-06-07 05:50:35', '2018-06-07 05:50:35'),
(36, 1, 2, 'dsdsdssdds@gmail.com', '+9189899898', 'PBMID6BCH8CZ', 50.00, '0', '2018-06-07 05:56:27', '2018-06-07 05:56:27'),
(37, 1, 2, 'dsdsdsd@gmail.com', '+9189898989', 'NGPDXSS02LIG', 50.00, '0', '2018-06-08 08:14:20', '2018-06-08 08:14:20'),
(38, 1, 1, 'anna.adam51@yahoo.com', '+919921840141', 'VLTCAOSH56UK', 250.00, '1', '2018-06-18 06:46:17', '2018-06-18 08:28:12'),
(39, 13, 1, 'nayan@gmail.com', '+918888230299', 'N83CUXO37QBS', 250.00, '0', '2018-06-19 08:34:41', '2018-06-19 08:34:41'),
(40, 1, 2, 'anna.adam51@yahoo.com', '+919921840141', 'BVQ4QSM91IGE', 50.00, '1', '2018-06-20 11:12:18', '2018-06-20 11:17:28'),
(41, 1, 3, 'anna.adam51@yahoo.com', '+919638527412', '29HH5F58QDZ4', 100.00, '0', '2018-06-20 18:14:03', '2018-06-20 18:14:03'),
(42, 1, 1, 'anna.adam51@yahoo.com', '+919921840141', '4NEWCBMAASZR', 250.00, '1', '2018-06-20 18:17:01', '2018-06-20 18:23:34'),
(43, 1, 1, 'anna.adam51@yahoo.com', '+919921840141', 'E24RTH8XNUP2', 250.00, '1', '2018-06-21 09:58:22', '2018-06-21 10:17:28'),
(44, 1, 4, 'anna.adam51@yahoo.com', '+919921840141', 'IH83HCIUPRDJ', 50000.00, '0', '2018-06-21 12:08:22', '2018-06-21 12:08:22'),
(45, 1, 4, 'jevoxelel@yk20.com', '+91121216512165156', 'CRJ9DQ50IT1K', 50000.00, '0', '2018-06-25 05:28:00', '2018-06-25 05:28:00'),
(46, 1, 4, 'jevoxelel@yk20.com', '+9115241465456121', 'TBYFQ4ZKS5ZR', 50000.00, '0', '2018-06-25 05:29:41', '2018-06-25 05:29:41'),
(47, 1, 3, 'xapuzu@shinnemo.com', '+919922276924', 'YX58N14KQGVH', 100.00, '0', '2018-06-25 09:19:11', '2018-06-25 09:19:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `insurance_id` int(11) NOT NULL,
  `status` enum('1','2','3','4','5','6','7','8','9','10') NOT NULL COMMENT '1-Pending/in process, 2-Confirmed, 3-Dispatched,4-Delivered,5-Completed,6-Returned requested,7-Return processing,8-Return accepted,9-Return Rejected,10-Refunded ',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_otp`
--

CREATE TABLE `user_otp` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `expired_on` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_otp`
--

INSERT INTO `user_otp` (`id`, `user_id`, `otp`, `expired_on`, `created_at`, `updated_at`) VALUES
(1, 1, '368843', '2018-06-26 04:37:23', '2018-05-10 06:40:02', '2018-06-26 04:22:23'),
(2, 13, '898954', '2018-06-21 12:23:55', '2018-06-18 07:15:57', '2018-06-21 12:08:55');

-- --------------------------------------------------------

--
-- Table structure for table `user_wallet`
--

CREATE TABLE `user_wallet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `amount_debited` decimal(50,2) NOT NULL DEFAULT '0.00',
  `amount_credited` decimal(50,2) NOT NULL DEFAULT '0.00',
  `transaction_status` enum('1','2','3') NOT NULL COMMENT '1=success, 2=failure, 3=pending',
  `type` enum('1','2') NOT NULL COMMENT '1-return,2-replacement',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_wallet`
--

INSERT INTO `user_wallet` (`id`, `user_id`, `order_id`, `product_id`, `amount_debited`, `amount_credited`, `transaction_status`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 'AM-1529576977', 25, '0.00', '44850.00', '1', '1', '2018-06-21 12:36:54', '2018-06-26 04:24:43'),
(2, 2, 'AM-1529641812', 0, '44850.00', '0.00', '1', '1', '2018-06-22 04:30:25', '2018-06-26 04:24:31'),
(4, 1, 'AM-0517857812', 0, '44850.00', '0.00', '1', '1', '2018-06-26 04:26:52', '2018-06-26 04:26:52'),
(5, 1, 'AM-6039556786', 57, '0.00', '4.00', '1', '1', '2018-06-26 04:35:58', '2018-06-26 04:35:58'),
(6, 1, 'AM-9892738921', 0, '4.00', '0.00', '1', '1', '2018-06-26 05:11:14', '2018-06-26 05:11:14'),
(7, 1, 'AM-6039556786', 57, '0.00', '3.00', '1', '1', '2018-06-26 13:20:56', '2018-06-26 13:20:56');

-- --------------------------------------------------------

--
-- Table structure for table `valuation`
--

CREATE TABLE `valuation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time DEFAULT NULL,
  `mobile_number` varchar(50) NOT NULL,
  `product_description` varchar(555) NOT NULL,
  `product_image` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `valuation`
--

INSERT INTO `valuation` (`id`, `user_id`, `appointment_date`, `appointment_time`, `mobile_number`, `product_description`, `product_image`, `created_at`, `updated_at`) VALUES
(1, 1, '2018-06-30', '19:30:00', '+919922276924', 'dsd dksd dkdsd djskj kdjkdjs jdkdjs dsjksdjk djksdj', 'b5f5878516bd1e726f8d3b197112574c90a73586.png', '2018-06-06 08:31:11', '2018-06-06 08:31:11'),
(2, 1, '2018-06-20', '19:31:00', '+91898989889', 'dsdsd', '62d9ead3b4eb393608bcc9f98a406b579606e02a.jpg', '2018-06-06 08:31:31', '2018-06-06 08:31:31'),
(3, 1, '2018-06-29', '10:22:00', '+919922276924', 'djkf sdkfjdk jsdk', '177fa8c59af543fc67f2fbb5a6913ef842323fe9.jpeg', '2018-06-06 23:22:38', '2018-06-06 23:22:38'),
(4, 3, '2018-06-20', '11:00:00', '+919922276924', 'dsssdsd sdkjfsdk kejwkej kwejkwjwkjwek  dsssdsd sdkjfsdk kejwkej kwejkwjwkjwek  dsssdsd sdkjfsdk kejwkej kwejkwjwkjwek  dsssdsd sdkjfsdk kejwkej kwejkwjwkjwek  dsssdsd sdkjfsdk kejwkej kwejkwjwkjwek  dsssdsd sdkjfsdk kejwkej kwejkwjwkjwek  dsssdsd sdkjfsdk kejwkej kwejkwjwkjwek  dsssdsd sdkjfsdk kejwkej kwejkwjwkjwek  dsssdsd sdkjfsdk kejwkej kwejkwjwkjwek  dsssdsd sdkjfsdk kejwkej kwejkwjwkjwek  dsssdsd sdkjfsdk kejwkej kwejkwjwkjwek  dsssdsd sdkjfsdk kejwkej kwejkwjwkjwek', '952167cbf45b280c4b10ddfab8828715fc4b2958.jpg', '2018-06-07 00:01:34', '2018-06-07 00:01:34'),
(5, 3, '2018-06-22', '11:40:00', '+919922276924', 'Just want to know about product.', '705affa5b7c4f4782b7685bbc8469ca25bc11b10.jpg', '2018-06-07 00:40:40', '2018-06-07 00:40:40'),
(6, 3, '2018-06-14', '11:41:00', '+919922276924', 'another product valuation request', '1faca234faa6f63eb55b43205e952eff0a6b7007.png', '2018-06-07 00:41:49', '2018-06-07 00:41:49'),
(7, 1, '2018-06-27', '13:00:00', '+919922276924', 'd dkdslkdl dklsk ews dks ldksld', '8db1467be739dcf7a234a7a713727fd19a0dacd7.jpg', '2018-06-07 01:08:20', '2018-06-07 01:08:20'),
(8, 13, '2018-06-18', '16:32:00', '+919921840141', 'time pick should working on keyboard functionality time pick should working on keyboard functionality time pick should working on keyboard functionality time pick should working on', '21cd43d6fdf9325bc1abe6871a245ec9d3b639df.jpg', '2018-06-18 11:22:24', '2018-06-18 11:22:24'),
(9, 13, '2018-06-20', '15:52:00', '+919921840141', 'time pick should working on keyboard functionality', 'c479c4311c2a3da6d8a9141d0ec063af171d72e3.jpg', '2018-06-18 11:25:31', '2018-06-18 11:25:31'),
(10, 13, '2018-06-20', '17:09:00', '+919921840141', 'When Student login then should not display the 500 ip address', 'ab48f2a49365b91626d6eaf0067242eceaeedeaa.jpg', '2018-06-18 11:44:29', '2018-06-18 11:44:29'),
(11, 13, '2018-06-20', '17:19:00', '+919921840141', 'Product Id	ow472387\r\nBrand	Abc\r\nApproximate Metal Weight	2 gms\r\nHome trial	No\r\nHeight	2 mm\r\nWidth	2 mm\r\nLength	2 mm', 'e05d702525c1208782fac86888bbc9e9f89bd6fb.jpg', '2018-06-18 12:08:24', '2018-06-18 12:08:24'),
(12, 13, '2018-06-20', '17:39:00', '+919921840141', 'it should display the ------ line when id not presentit should display the ------ line when id not presentit should display the ------ line when id not presentit should display the ------ line when id not presentit should display the ------ line when id not presentit should display the ------ line when id not presentit should display the ------ line when id not presentit should display the ------ line when id not presentit should display the ------ line when id not', 'cf1e3b9adf5df1d71d8af67f63a0cfcef1f5ac49.jpg', '2018-06-18 12:10:22', '2018-06-18 12:10:22'),
(13, 13, '2018-06-04', '18:58:00', '+911122336655449', 'Xyz', '366552309ef8be7c1e12a6dd93806504304a4aa5.jpg', '2018-06-18 13:28:50', '2018-06-18 13:28:50');

-- --------------------------------------------------------

--
-- Table structure for table `web_admin`
--

CREATE TABLE `web_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `password_reset_code` mediumtext,
  `contact` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `profile_image` varchar(100) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `web_admin`
--

INSERT INTO `web_admin` (`id`, `user_name`, `first_name`, `last_name`, `email`, `password`, `password_reset_code`, `contact`, `remember_token`, `profile_image`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'webwing_admin', 'Admin', 'Webwing', 'dev@webwingtechnologies.com', '$2y$10$VT2InjcyvH9krq1FCZueKOgnn1.MFuuoL.qo1ji98kbjEPJkciZfu', NULL, '123456789', '9bli54JOPvbjNX15SHZKvELxgFZmFV9G9gYC9nDI169MNVmFxAO2BuiYSQZt', 'e47520d531954630878b5676a1a795b64ebe541b.png', 'Pune, Maharashtra, India', '2018-04-11 18:30:00', '2018-10-20 05:40:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wish_list`
--

CREATE TABLE `wish_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_type` enum('1','2','','') NOT NULL COMMENT '1-classic,2-luxure',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wish_list`
--

INSERT INTO `wish_list` (`id`, `user_id`, `product_id`, `product_type`, `created_at`, `updated_at`) VALUES
(32, 13, 25, '1', '2018-06-18 06:49:41', '2018-06-18 06:49:41'),
(33, 13, 47, '1', '2018-06-20 09:36:18', '2018-06-20 09:36:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_details`
--
ALTER TABLE `api_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `band_setting`
--
ALTER TABLE `band_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_comment`
--
ALTER TABLE `blog_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_gift_cards`
--
ALTER TABLE `cart_gift_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_product`
--
ALTER TABLE `cart_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_enquiry`
--
ALTER TABLE `contact_enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_template`
--
ALTER TABLE `email_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_pages`
--
ALTER TABLE `front_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gemstone`
--
ALTER TABLE `gemstone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gemstone_colors`
--
ALTER TABLE `gemstone_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gemstone_qualities`
--
ALTER TABLE `gemstone_qualities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gemstone_shapes`
--
ALTER TABLE `gemstone_shapes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gift_cards`
--
ALTER TABLE `gift_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insurance_details`
--
ALTER TABLE `insurance_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `look`
--
ALTER TABLE `look`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metals`
--
ALTER TABLE `metals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metal_colors`
--
ALTER TABLE `metal_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metal_detailings`
--
ALTER TABLE `metal_detailings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metal_qualities`
--
ALTER TABLE `metal_qualities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newletters`
--
ALTER TABLE `newletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_template`
--
ALTER TABLE `notification_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `occasions`
--
ALTER TABLE `occasions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_gift_cards`
--
ALTER TABLE `order_gift_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_wallet`
--
ALTER TABLE `order_wallet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_brands`
--
ALTER TABLE `product_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_clarities`
--
ALTER TABLE `product_clarities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_collections`
--
ALTER TABLE `product_collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_finishes`
--
ALTER TABLE `product_finishes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_florescences`
--
ALTER TABLE `product_florescences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_gemstone`
--
ALTER TABLE `product_gemstone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_grading_reports`
--
ALTER TABLE `product_grading_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_inclusion`
--
ALTER TABLE `product_inclusion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_key_to_symbols`
--
ALTER TABLE `product_key_to_symbols`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_lines`
--
ALTER TABLE `product_lines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_measurements`
--
ALTER TABLE `product_measurements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_metals`
--
ALTER TABLE `product_metals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_occasions`
--
ALTER TABLE `product_occasions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_quantities`
--
ALTER TABLE `product_quantities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_views`
--
ALTER TABLE `product_views`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `replacement_product_request`
--
ALTER TABLE `replacement_product_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_product_request`
--
ALTER TABLE `return_product_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_and_rating`
--
ALTER TABLE `review_and_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ring_shoulder_type`
--
ALTER TABLE `ring_shoulder_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shank_types`
--
ALTER TABLE `shank_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_business_details`
--
ALTER TABLE `supplier_business_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_gift_cards`
--
ALTER TABLE `user_gift_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_otp`
--
ALTER TABLE `user_otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_wallet`
--
ALTER TABLE `user_wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `valuation`
--
ALTER TABLE `valuation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_admin`
--
ALTER TABLE `web_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wish_list`
--
ALTER TABLE `wish_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `api_details`
--
ALTER TABLE `api_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `band_setting`
--
ALTER TABLE `band_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `blog_comment`
--
ALTER TABLE `blog_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart_gift_cards`
--
ALTER TABLE `cart_gift_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_product`
--
ALTER TABLE `cart_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `contact_enquiry`
--
ALTER TABLE `contact_enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `email_template`
--
ALTER TABLE `email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `front_pages`
--
ALTER TABLE `front_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gemstone`
--
ALTER TABLE `gemstone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `gemstone_colors`
--
ALTER TABLE `gemstone_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `gemstone_qualities`
--
ALTER TABLE `gemstone_qualities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gemstone_shapes`
--
ALTER TABLE `gemstone_shapes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gift_cards`
--
ALTER TABLE `gift_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `insurance_details`
--
ALTER TABLE `insurance_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `look`
--
ALTER TABLE `look`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `metals`
--
ALTER TABLE `metals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `metal_colors`
--
ALTER TABLE `metal_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `metal_detailings`
--
ALTER TABLE `metal_detailings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `metal_qualities`
--
ALTER TABLE `metal_qualities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `newletters`
--
ALTER TABLE `newletters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `notification_template`
--
ALTER TABLE `notification_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `occasions`
--
ALTER TABLE `occasions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `order_gift_cards`
--
ALTER TABLE `order_gift_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `order_wallet`
--
ALTER TABLE `order_wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `product_brands`
--
ALTER TABLE `product_brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_clarities`
--
ALTER TABLE `product_clarities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_collections`
--
ALTER TABLE `product_collections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=342;

--
-- AUTO_INCREMENT for table `product_finishes`
--
ALTER TABLE `product_finishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_florescences`
--
ALTER TABLE `product_florescences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_gemstone`
--
ALTER TABLE `product_gemstone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `product_grading_reports`
--
ALTER TABLE `product_grading_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `product_inclusion`
--
ALTER TABLE `product_inclusion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_key_to_symbols`
--
ALTER TABLE `product_key_to_symbols`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_lines`
--
ALTER TABLE `product_lines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `product_measurements`
--
ALTER TABLE `product_measurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_metals`
--
ALTER TABLE `product_metals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `product_occasions`
--
ALTER TABLE `product_occasions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=359;

--
-- AUTO_INCREMENT for table `product_quantities`
--
ALTER TABLE `product_quantities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `product_views`
--
ALTER TABLE `product_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `replacement_product_request`
--
ALTER TABLE `replacement_product_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `return_product_request`
--
ALTER TABLE `return_product_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `review_and_rating`
--
ALTER TABLE `review_and_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ring_shoulder_type`
--
ALTER TABLE `ring_shoulder_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `shank_types`
--
ALTER TABLE `shank_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `supplier_business_details`
--
ALTER TABLE `supplier_business_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user_gift_cards`
--
ALTER TABLE `user_gift_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_otp`
--
ALTER TABLE `user_otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_wallet`
--
ALTER TABLE `user_wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `valuation`
--
ALTER TABLE `valuation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `web_admin`
--
ALTER TABLE `web_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wish_list`
--
ALTER TABLE `wish_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
