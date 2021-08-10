"# my-php-blog"

<!--

-- version 5.1.1
-- https://www.phpmyadmin.net/

-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `articleId` int(30) NOT NULL,
  `articleTitle` varchar(300) DEFAULT NULL,
  `articleSlug` text NOT NULL,
  `articleDescrip` text DEFAULT NULL,
  `articleContent` longtext DEFAULT NULL,
  `articleDate` datetime DEFAULT NULL,
  `articleTags` varchar(300) DEFAULT NULL,
  `userid` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(30) NOT NULL,
  `categoryName` varchar(300) DEFAULT NULL,
  `categorySlug` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cat_links`
--

CREATE TABLE `cat_links` (
  `id` int(20) NOT NULL,
  `articleId` int(11) DEFAULT NULL,
  `categoryId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(30) NOT NULL,
  `username` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `email` varchar(300) DEFAULT NULL,
  `isAuther` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`articleId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `cat_links`
--
ALTER TABLE `cat_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `articleId` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cat_links`
--
ALTER TABLE `cat_links`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(30) NOT NULL AUTO_INCREMENT;
COMMIT;

  -->
