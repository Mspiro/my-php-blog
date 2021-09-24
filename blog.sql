-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2021 at 08:50 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `articleId` int(30) NOT NULL,
  `articleTitle` varchar(300) NOT NULL,
  `articleSlug` text NOT NULL,
  `articleDescrip` text NOT NULL,
  `articleContent` longtext NOT NULL,
  `articleDate` datetime DEFAULT NULL,
  `articleEditDate` datetime DEFAULT NULL,
  `articleTags` varchar(300) DEFAULT NULL,
  `userid` int(30) NOT NULL,
  `articleImage` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`articleId`, `articleTitle`, `articleSlug`, `articleDescrip`, `articleContent`, `articleDate`, `articleEditDate`, `articleTags`, `userid`, `articleImage`) VALUES
(33, 'This is forth blog ', 'this-is-forth-blog', 'This is forth blog ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut tellus elementum sagittis vitae et leo. Ipsum faucibus vitae aliquet nec ullamcorper sit. Eget sit amet tellus cras adipiscing enim eu turpis egestas. Faucibus ornare suspendisse sed nisi. Velit sed ullamcorper morbi tincidunt ornare massa eget egestas. Eleifend mi in nulla posuere sollicitudin. Nisi est sit amet facilisis. Id diam vel quam elementum pulvinar etiam non quam. Sed turpis tincidunt id aliquet risus feugiat. Iaculis nunc sed augue lacus viverra vitae congue. Feugiat vivamus at augue eget arcu dictum varius. Odio eu feugiat pretium nibh ipsum consequat nisl.</p>\r\n<p>Commodo elit at imperdiet dui accumsan. Sed lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi. Scelerisque mauris pellentesque pulvinar pellentesque habitant morbi. Nibh cras pulvinar mattis nunc sed blandit. Libero enim sed faucibus turpis. Tincidunt eget nullam non nisi est sit amet facilisis. Est ultricies integer quis auctor elit sed vulputate mi sit. Lacus vestibulum sed arcu non odio euismod lacinia at quis. Enim tortor at auctor urna nunc id cursus. Morbi leo urna molestie at elementum eu facilisis. Turpis egestas integer eget aliquet nibh praesent tristique magna. Sociis natoque penatibus et magnis dis parturient montes nascetur.</p>\r\n<p>Ultrices mi tempus imperdiet nulla. Felis imperdiet proin fermentum leo. Consectetur libero id faucibus nisl tincidunt eget. Malesuada fames ac turpis egestas maecenas. Ipsum a arcu cursus vitae congue. Adipiscing at in tellus integer feugiat scelerisque varius. Iaculis at erat pellentesque adipiscing commodo elit at. Facilisis magna etiam tempor orci eu lobortis elementum nibh tellus. Elit duis tristique sollicitudin nibh sit amet commodo. Neque sodales ut etiam sit amet nisl. Aliquam nulla facilisi cras fermentum odio eu feugiat. At ultrices mi tempus imperdiet nulla malesuada pellentesque elit eget. Pulvinar mattis nunc sed blandit libero volutpat sed cras ornare. Adipiscing diam donec adipiscing tristique risus nec feugiat in. Eu volutpat odio facilisis mauris sit amet massa vitae tortor. Ullamcorper eget nulla facilisi etiam dignissim diam quis.</p>\r\n<p>Eros in cursus turpis massa tincidunt dui ut ornare. Sit amet mauris commodo quis. Est ullamcorper eget nulla facilisi etiam dignissim. Vitae purus faucibus ornare suspendisse sed. Aliquam eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis. Purus sit amet volutpat consequat mauris nunc congue nisi vitae. Quis varius quam quisque id diam vel quam. Ultricies tristique nulla aliquet enim tortor at. Ac placerat vestibulum lectus mauris ultrices. Euismod quis viverra nibh cras pulvinar mattis. Non diam phasellus vestibulum lorem sed risus ultricies tristique nulla. Ipsum suspendisse ultrices gravida dictum.</p>\r\n<p>Feugiat in ante metus dictum at tempor commodo. Morbi tincidunt ornare massa eget egestas. Ullamcorper malesuada proin libero nunc consequat. Augue ut lectus arcu bibendum at varius vel pharetra. Amet tellus cras adipiscing enim eu turpis egestas pretium. Augue eget arcu dictum varius. Ut sem nulla pharetra diam sit amet nisl suscipit adipiscing. Porttitor rhoncus dolor purus non enim praesent. Pharetra pharetra massa massa ultricies mi quis hendrerit. Et odio pellentesque diam volutpat. Consectetur a erat nam at lectus urna. Vestibulum lectus mauris ultrices eros. Praesent semper feugiat nibh sed pulvinar. Orci nulla pellentesque dignissim enim. Feugiat in ante metus dictum.</p>', '2021-08-10 14:55:27', NULL, 'Tag5,Tag6', 21, NULL),
(34, 'This is Fifth blog ', 'this-is-fifth-blog', 'This is Fifth blog', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut tellus elementum sagittis vitae et leo. Ipsum faucibus vitae aliquet nec ullamcorper sit. Eget sit amet tellus cras adipiscing enim eu turpis egestas. Faucibus ornare suspendisse sed nisi. Velit sed ullamcorper morbi tincidunt ornare massa eget egestas. Eleifend mi in nulla posuere sollicitudin. Nisi est sit amet facilisis. Id diam vel quam elementum pulvinar etiam non quam. Sed turpis tincidunt id aliquet risus feugiat. Iaculis nunc sed augue lacus viverra vitae congue. Feugiat vivamus at augue eget arcu dictum varius. Odio eu feugiat pretium nibh ipsum consequat nisl.</p>\r\n<p>Commodo elit at imperdiet dui accumsan. Sed lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi. Scelerisque mauris pellentesque pulvinar pellentesque habitant morbi. Nibh cras pulvinar mattis nunc sed blandit. Libero enim sed faucibus turpis. Tincidunt eget nullam non nisi est sit amet facilisis. Est ultricies integer quis auctor elit sed vulputate mi sit. Lacus vestibulum sed arcu non odio euismod lacinia at quis. Enim tortor at auctor urna nunc id cursus. Morbi leo urna molestie at elementum eu facilisis. Turpis egestas integer eget aliquet nibh praesent tristique magna. Sociis natoque penatibus et magnis dis parturient montes nascetur.</p>\r\n<p>Ultrices mi tempus imperdiet nulla. Felis imperdiet proin fermentum leo. Consectetur libero id faucibus nisl tincidunt eget. Malesuada fames ac turpis egestas maecenas. Ipsum a arcu cursus vitae congue. Adipiscing at in tellus integer feugiat scelerisque varius. Iaculis at erat pellentesque adipiscing commodo elit at. Facilisis magna etiam tempor orci eu lobortis elementum nibh tellus. Elit duis tristique sollicitudin nibh sit amet commodo. Neque sodales ut etiam sit amet nisl. Aliquam nulla facilisi cras fermentum odio eu feugiat. At ultrices mi tempus imperdiet nulla malesuada pellentesque elit eget. Pulvinar mattis nunc sed blandit libero volutpat sed cras ornare. Adipiscing diam donec adipiscing tristique risus nec feugiat in. Eu volutpat odio facilisis mauris sit amet massa vitae tortor. Ullamcorper eget nulla facilisi etiam dignissim diam quis.</p>\r\n<p>Eros in cursus turpis massa tincidunt dui ut ornare. Sit amet mauris commodo quis. Est ullamcorper eget nulla facilisi etiam dignissim. Vitae purus faucibus ornare suspendisse sed. Aliquam eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis. Purus sit amet volutpat consequat mauris nunc congue nisi vitae. Quis varius quam quisque id diam vel quam. Ultricies tristique nulla aliquet enim tortor at. Ac placerat vestibulum lectus mauris ultrices. Euismod quis viverra nibh cras pulvinar mattis. Non diam phasellus vestibulum lorem sed risus ultricies tristique nulla. Ipsum suspendisse ultrices gravida dictum.</p>\r\n<p>Feugiat in ante metus dictum at tempor commodo. Morbi tincidunt ornare massa eget egestas. Ullamcorper malesuada proin libero nunc consequat. Augue ut lectus arcu bibendum at varius vel pharetra. Amet tellus cras adipiscing enim eu turpis egestas pretium. Augue eget arcu dictum varius. Ut sem nulla pharetra diam sit amet nisl suscipit adipiscing. Porttitor rhoncus dolor purus non enim praesent. Pharetra pharetra massa massa ultricies mi quis hendrerit. Et odio pellentesque diam volutpat. Consectetur a erat nam at lectus urna. Vestibulum lectus mauris ultrices eros. Praesent semper feugiat nibh sed pulvinar. Orci nulla pellentesque dignissim enim. Feugiat in ante metus dictum.</p>', '2021-08-10 14:56:05', NULL, 'Tag3,Tag4', 21, NULL),
(36, 'This is article from demo6', 'this-is-article-from-demo6', 'This is article from demo6', '<p>This is article from demo6</p>', '2021-08-11 15:15:52', NULL, '', 24, NULL),
(37, 'First Artical from Demo9', 'first-artical-from-demo9', 'First Artical from Demo9', '<p>First Artical from Demo9First Artical from Demo9First Artical from Demo9First Artical from Demo9First Artical from Demo9</p>', '2021-09-07 14:47:03', NULL, 'TagDemo9', 25, NULL),
(96, 'This is first blog ', 'this-is-first-blog', 'This is first blog ', '<p>This is first blog This is first blog This is first blog This is first blog This is first blog This is first blog This is first blog This is first blog This is first blog This is first blog This is first blog This is first blog This is first blog&nbsp;</p>', '2021-09-21 19:40:27', '2021-09-24 10:32:31', 'Tag5,Tag6', 20, 'b536e6f62c86e152147332256f882d7c.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentId` int(30) NOT NULL,
  `userid` int(30) NOT NULL,
  `articleId` int(30) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentId`, `userid`, `articleId`, `comment`) VALUES
(1, 20, 54, 'This is my first comment'),
(2, 20, 54, 'This is my second comment'),
(3, 26, 54, 'This is my first comment'),
(4, 26, 53, 'This is my second comment'),
(5, 26, 54, 'another comment'),
(6, 20, 37, 'This is my first comment'),
(7, 20, 37, 'This is my first comment'),
(8, 20, 37, 'This is my second comment'),
(9, 20, 60, 'This is my first comment'),
(10, 20, 61, 'This is my first comment'),
(11, 20, 96, 'This is my first comment'),
(12, 20, 96, 'This is my first comment'),
(13, 20, 96, 'This is my first comment'),
(14, 20, 96, 'another comment'),
(15, 20, 96, 'another comment'),
(16, 20, 96, 'another comment'),
(17, 20, 34, 'This is my first comment'),
(18, 20, 34, 'another comment');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleid` int(30) NOT NULL,
  `role` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleid`, `role`) VALUES
(1, 'Admin'),
(2, 'Author'),
(8, 'Reader'),
(0, 'Unauthorized ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(30) NOT NULL,
  `username` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `profileid` int(30) NOT NULL,
  `roleid` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `email`, `profileid`, `roleid`) VALUES
(20, 'admin', '202cb962ac59075b964b07152d234b70', 'dhobale53@gmail.com', 6, 1),
(27, 'Meeninath', '202cb962ac59075b964b07152d234b70', 'demo@gmail.com', 12, 2),
(30, 'Vishal', '202cb962ac59075b964b07152d234b70', 'vishal@gmail.com', 13, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `profileid` int(30) NOT NULL,
  `userid` int(30) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `middleName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `displayProfile` text DEFAULT 'c4366c5874fde2c16822c3c36f2df8de.jpg',
  `mobile` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `city` varchar(300) DEFAULT NULL,
  `district` varchar(300) DEFAULT NULL,
  `state` varchar(300) DEFAULT NULL,
  `country` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`profileid`, `userid`, `firstName`, `middleName`, `lastName`, `displayProfile`, `mobile`, `email`, `city`, `district`, `state`, `country`) VALUES
(6, 20, 'Meeni', 'Navanath', 'Dhobale', 'c4366c5874fde2c16822c3c36f2df8de.jpg', '9325901116', 'dhobale53@gmail.com', 'Shrirampur', 'Ahmednagar', 'Maharashtra', 'India'),
(12, 27, 'Meeninath', 'Navanath', 'Dhobale', 'e1d4a85880de9ec5c5af80fda5d88c77.png', '1234567890', 'demo@gmail.com', 'Shrirampur', 'Ahmednagar', 'Maharashtra', 'India'),
(13, 30, 'Vishal', 'Dadasaheb', 'Bandre', '852c1cc2f56ece9084372ff0bee2edb3.png', '1234567890', 'vishal@gmail.com', 'Shrirampur', 'Ahmednagar', 'Maharashtra', 'India');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`articleId`),
  ADD KEY `userid` (`userid`),
  ADD KEY `userid_2` (`userid`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentId`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleid`),
  ADD UNIQUE KEY `role` (`role`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `roleid` (`roleid`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`profileid`),
  ADD KEY `userid` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `articleId` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentId` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleid` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `profileid` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
