CREATE DATABASE IF NOT EXISTS `blog` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `blog`;
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `articleId` int(30) NOT NULL,
  `articleTitle` varchar(300) DEFAULT NULL,
  `articleSlug` text NOT NULL,
  `articleDescrip` text DEFAULT NULL,
  `articleContent` longtext DEFAULT NULL,
  `articleDate` datetime DEFAULT NULL,
  `articleTags` varchar(300) DEFAULT NULL,
  `userid` int(30) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `categoryId` int(30) NOT NULL,
  `categoryName` varchar(300) DEFAULT NULL,
  `categorySlug` varchar(300) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
DROP TABLE IF EXISTS `cat_links`;
CREATE TABLE `cat_links` (
  `id` int(20) NOT NULL,
  `articleId` int(11) DEFAULT NULL,
  `categoryId` int(11) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userid` int(30) NOT NULL,
  `username` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `email` varchar(300) DEFAULT NULL,
  `isAuther` tinyint(1) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
ALTER TABLE `article`
ADD PRIMARY KEY (`articleId`);
ALTER TABLE `category`
ADD PRIMARY KEY (`categoryId`);
ALTER TABLE `cat_links`
ADD PRIMARY KEY (`id`);
ALTER TABLE `users`
ADD PRIMARY KEY (`userid`);
ALTER TABLE `article`
MODIFY `articleId` int(30) NOT NULL AUTO_INCREMENT;
ALTER TABLE `category`
MODIFY `categoryId` int(30) NOT NULL AUTO_INCREMENT;
ALTER TABLE `cat_links`
MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
ALTER TABLE `users`
MODIFY `userid` int(30) NOT NULL AUTO_INCREMENT;
COMMIT;