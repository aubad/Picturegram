-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 07, 2020 at 09:14 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `picturegram`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `CommentID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PostID` int(11) NOT NULL,
  `Comment` text NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`CommentID`, `UserID`, `PostID`, `Comment`, `Date`) VALUES
(1, 1, 1, 'Cras sagittis arcu orci, ut vestibulum neque ornare id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec eu leo vitae velit consequat consectetur a eu est.  ', '2020-11-01 05:38:27'),
(2, 1, 1, 'Nnon ullamcorper ante. Nulla aliquam volutpat ligula, vel pretium arcu interdum vel. Nam id varius nisi, ut fringilla diam. Vestibulum congue ultricies nisl eget malesuada. Donec eget dapibus tortor. ', '2020-11-01 05:38:27'),
(3, 1, 1, 'Aenean cursus scelerisque iaculis. Vivamus enim sem, pharetra placerat vulputate pellentesque, ornare in velit. Donec sollicitudin pharetra fringilla. Duis pretium malesuada nisi. Vivamus at varius lectus. Praesent est sem, lobortis nec dui et, efficitur aliquet metus. Quisque pharetra vulputate turpis a sagittis. ', '2020-11-01 05:38:27'),
(4, 1, 2, 'Venenatis vitae, tincidunt id nisi. Sed ipsum velit, sodales nec ultricies eget, sagittis eget lorem. Nam in congue nulla.', '2020-11-01 05:38:27'),
(5, 1, 2, 'Gotta love fresh veggies!', '2020-11-01 05:38:27'),
(6, 1, 2, 'So pretty', '2020-11-01 05:38:27'),
(7, 1, 3, 'Nostra, per inceptos himenaeos. Aenean laoreet tortor eros, sed pretium mi lacinia ut. Nunc imperdiet velit quam, quis aliquet augue imperdiet vel.', '2020-11-01 05:38:27'),
(8, 1, 3, 'In id risus justo. Aenean id elementum justo. Fusce rutrum ligula a ligula fermentum dapibus. Nunc non libero tincidunt leo lacinia blandit quis vel elit.\r\n', '2020-11-01 05:38:27'),
(9, 1, 3, 'Looks like you\'re on the ferry!', '2020-11-01 05:38:27'),
(10, 1, 4, 'Donec eu leo vitae velit consequat consectetur a eu est. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean laoreet tortor eros, sed pretium mi lacinia ut. Nunc imperdiet velit quam, quis aliquet augue imperdiet vel.', '2020-11-01 05:38:27'),
(11, 1, 4, 'Is this a winery?', '2020-11-01 05:39:19'),
(12, 1, 4, 'What a view!!', '2020-11-01 05:39:19'),
(13, 1, 4, 'REally like this!!', '2020-11-01 05:41:04'),
(14, 1, 5, 'Vivamus volutpat viverra ultrices. Pellentesque porta scelerisque auctor. Sed luctus, massa nec luctus fringilla, urna diam semper turpis, a cursus massa ligula vitae mi.\r\n', '2020-11-01 05:41:04'),
(15, 1, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing!! \r\n', '2020-11-01 05:41:04'),
(16, 1, 5, 'Strange, wonder how they got there??!', '2020-11-01 05:41:04'),
(28, 1, 1, 'test', '2020-11-10 23:51:03'),
(29, 1, 6, 'Amazing!!!!', '2020-11-11 09:33:55'),
(30, 6, 5, 'All I see is mud', '2020-11-26 10:36:06'),
(31, 6, 3, 'Beautiful', '2020-11-26 11:34:06'),
(32, 6, 8, '!!!!!!!!!!!!!', '2020-11-29 13:29:06'),
(33, 6, 5, 'test', '2020-12-05 10:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `LoginID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`LoginID`, `UserID`, `Username`, `Password`) VALUES
(1, 1, 'Lorem', 'testPassword'),
(2, 6, 'sabi123', '1234'),
(4, 8, 'frieza123', '1234'),
(5, 9, 'john123', '1234'),
(6, 10, 'nate123', '$2y$10$CO5d9tQ1t0UKCIHQvUlZ1u2/37.wphH38MabZw3c3KXWiolO0S9mi'),
(7, 11, 'fitz123', '$2y$10$MFMNc1954jspIp.jx5Og/uSUVK7llobahaVxNJxaL69SkYF6EC9/G');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `PostID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PostImage` varchar(50) NOT NULL,
  `Post` text NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`PostID`, `UserID`, `PostImage`, `Post`, `Date`) VALUES
(1, 1, 'sunset.jpg', 'Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos.', '2020-11-01 05:34:19'),
(2, 1, 'farm.jpg', 'Lorem ipsum dolor sit amet. Fusce ac nisi quis.', '2020-11-01 05:34:19'),
(3, 1, 'cityscape.jpg', 'Quisque consequat tellus diam, ut.Vestibulum non purus magna. Nam varius, justo dignissim dapibus sollicitudin.', '2020-11-01 05:36:34'),
(4, 1, 'valley1.jpg', 'Fusce libero ligula, feugiat sit. Ut non tincidunt odio, a.', '2020-11-01 05:36:34'),
(5, 1, 'poppies.jpg', 'Pellentesque pellentesque hendrerit rhoncus. Curabitur quis elementum lorem, finibus molestie.', '2020-11-01 05:37:50'),
(6, 1, 'space.jpg', 'Etiam ut felis congue lacus imperdiet egestas quis in odio. Nam rhoncus', '2020-11-11 09:21:23'),
(7, 6, 'home.jpg', 'Finals in a week !!!!!!!!!!!!!!!!!!!!!!!!', '2020-11-26 09:36:57'),
(8, 8, 'palmtrees.jpg', 'Sunset in St Martins', '2020-11-27 07:22:48'),
(9, 9, 'spacestation.jpg', 'Mondays', '2020-12-05 11:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `About` text NOT NULL,
  `AboutImage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Name`, `About`, `AboutImage`) VALUES
(1, 'Lorem Nullam', 'Lorem ipsum dolor sit amet,consectetur adipiscing', 'dal-about.jpg'),
(6, 'sabi', 'elit. Quisque id varius magna, scelerisque aliquet odio. Fusce vel scelerisque felis, a facilisis felis. Donec pharetra lacus nulla, vel lobortis turpis convallis porttitor. Quisque vehicula ut purus ac venenatis. Phasellus pharetra sit amet tellus sit amet accumsan. Vivamus in faucibus metus. Proin et tellus luctus ipsum finibus posuere. In vulputate urna orci, vel tristique quam ornare eget. Etiam eget odio felis. Vestibulum a eros eleifend, bibendum dui nec, tristique quam. Phasellus molestie ex ac ipsum posuere, sit amet pellentesque orci vulputate. Proin posuere augue at turp', 'about.jpg'),
(8, 'Frieza', 'Frieza (フリーザ Furīza) is the emperor of Universe 7, who controlled his own imperial army and is feared for his ruthlessness and power. He is the descendant of Chilled, the second son of King Cold, the younger brother of Cooler, and the father of Kuriza. Frieza is the catalyst antagonist of the entire franchise, as it is his actions that led to Goku arriving on Earth. He has made several comebacks since his fight with Goku on Namek, including multiple invasions of Earth. Recently, he has been chosen to represent Universe 7 as the tenth member of Team Universe 7 for the Tournament of Power as a replacement for Good Buu. This makes him the most recurring villain of the Dragon Ball series. After the events of the Tournament of Power, he is revived and recovers his title as Emperor of Universe 7.', 'frieza.jpg'),
(9, 'john', 'elit. Quisque id varius magna, scelerisque aliquet odio. Fusce vel scelerisque felis, a facilisis felis. Donec pharetra lacus nulla, vel lobortis turpis convallis porttitor. Quisque vehicula ut purus ac venenatis. Phasellus pharetra sit amet tellus sit amet accumsan. Vivamus in faucibus metus. Proin et tellus luctus ipsum finibus posuere. In vulputate urna orci, vel tristique quam ornare eget. Etiam eget odio felis. Vestibulum a eros eleifend, bibendum dui nec, tristique quam. Phasellus molestie ex ac ipsum posuere, sit amet pellentesque orci vulputate. Proin posuere augue at turp', 'about.jpg'),
(10, 'nate', 'elit. Quisque id varius magna, scelerisque aliquet odio. Fusce vel scelerisque felis, a facilisis felis. Donec pharetra lacus nulla, vel lobortis turpis convallis porttitor. Quisque vehicula ut purus ac venenatis. Phasellus pharetra sit amet tellus sit amet accumsan. Vivamus in faucibus metus. Proin et tellus luctus ipsum finibus posuere. In vulputate urna orci, vel tristique quam ornare eget. Etiam eget odio felis. Vestibulum a eros eleifend, bibendum dui nec, tristique quam. Phasellus molestie ex ac ipsum posuere, sit amet pellentesque orci vulputate. Proin posuere augue at turp', 'about.jpg'),
(11, 'Fitz', 'elit. Quisque id varius magna, scelerisque aliquet odio. Fusce vel scelerisque felis, a facilisis felis. Donec pharetra lacus nulla, vel lobortis turpis convallis porttitor. Quisque vehicula ut purus ac venenatis. Phasellus pharetra sit amet tellus sit amet accumsan. Vivamus in faucibus metus. Proin et tellus luctus ipsum finibus posuere. In vulputate urna orci, vel tristique quam ornare eget. Etiam eget odio felis. Vestibulum a eros eleifend, bibendum dui nec, tristique quam. Phasellus molestie ex ac ipsum posuere, sit amet pellentesque orci vulputate. Proin posuere augue at turp', 'about.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `PostID` (`PostID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`LoginID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`PostID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `LoginID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `PostID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`PostID`) REFERENCES `posts` (`PostID`);

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `UserID` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
