-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2019 at 11:19 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ewallet`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `title`) VALUES
(4, 3, 'test'),
(5, 3, 'edit example id'),
(6, 3, 'Fuller Gilliam'),
(7, 3, 'Education'),
(13, 4, 'sadsadsad'),
(24, 24, 'Consequatur Elit'),
(25, 27, 'Ut d ullaccxc'),
(26, 1, 'Sheila Mckee'),
(35, 1, 'Pascale Dalton'),
(52, 28, 'asdfasdfEx consequatur Facilis dolor placeat earum necessitatibus in est incididunt eaque dolorem in'),
(63, 1, 'Callum Vincent');

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `field_name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `category_id`, `field_name`, `description`) VALUES
(30, 25, 'Phelan Downs', 'Consequat Quas similique architecto dolore dicta quia voluptas excepteur sit'),
(38, 35, 'Upton Holland', 'Non irure id aliquid veniam'),
(59, 26, 'Emerald Baxter', 'Laboris ullam irure saepe neque assumenda'),
(60, 52, 'Orlando Crawford', 'Odit fuga Enim nihil lorem culpa obcaecati et commodi ratione maxime error exercitation nulla'),
(61, 52, 'Christian Livingston', 'Pariatur Non sint accusamus quisquam voluptatem aut qui nulla accusantium atque et delectus adipisci illo occaecat commodo qui'),
(72, 26, 'Lara Berg', 'Pariatur Similique enim obcaecati in in enim qui aut qui nostrum laborum Est Nam ab fuga Sed'),
(82, 35, 'Lucas Travis', 'Sapiente blanditiis ea voluptate laborum ullamco ut delectus'),
(85, 63, 'Shana Bender', 'Ipsum nihil ea provident fugiat qui in molestiae consequatur nostrud aut'),
(87, 63, 'Ezra Stewart', 'Aut dolore perferendis officia ea eu ipsam est pariatur Quia'),
(90, 26, 'Pascale Fuller', 'Dolor molestiae facere exercitation cupiditate porro ex');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `token`) VALUES
(1, 'Prajwol Rupakheti', 'prajwol199@gmail.com', 'd11b0e594756c95007b5e29b9a429640', '53UquU'),
(2, 'Jared Small', 'patiquge@mailinator.net', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', ''),
(3, 'Ram', 'ram1@gmail.com', '4641999a7679fcaef2df0e26d11e3c72', ''),
(4, 'Sheila Randall', 'holygizyj@mailinator.net', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', ''),
(5, 'Sarah White', 'hefykoqogi@mailinator.net', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', ''),
(6, 'Gloria Jenkins', 'bodi@mailinator.net', '866cce8db4d5d743fb7c34976945b41d', ''),
(7, 'Seth Langley', 'nolucanit@mailinator.net', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', ''),
(8, 'Ramona Avila', 'bafitog@mailinator.net', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', ''),
(9, 'Tad Santana', 'nozixilyv@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', ''),
(10, 'Emmanuel Carver', 'bafotap@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', ''),
(11, 'Gwendolyn Zamora', 'wavyfof@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', ''),
(24, 'Holmes Stephenson', 'cimokupace@mailinator.net', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', ''),
(27, 'Justina Mills', 'nonok@mailinator.net', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', ''),
(28, 'Morgan Malone', 'naxum@mailinator.net', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', ''),
(29, 'Kelly Delacruz', 'lalotox@mailinator.net', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', ''),
(30, 'Laith Church', 'kolutusy@mailinator.net', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', ''),
(31, 'Inez Brown', 'hymo@mailinator.net', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
