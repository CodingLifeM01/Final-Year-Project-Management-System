-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2025 at 06:05 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `Account_ID` varchar(20) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`Account_ID`, `Password`) VALUES
('Admin001', 'admin123'),
('L0001', 'lecturer@123'),
('L0002', 'lecturer@456'),
('N00012345', 'student@123456'),
('N00056789', 'student@789');

-- --------------------------------------------------------

--
-- Table structure for table `approvement`
--

CREATE TABLE `approvement` (
  `Approvement_ID` int(3) NOT NULL,
  `Title_ID` int(3) NOT NULL,
  `Supervisor_ID` int(3) NOT NULL,
  `User_ID` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `Comment_ID` int(3) NOT NULL,
  `Content` text NOT NULL,
  `Written_By` int(3) NOT NULL,
  `Title_ID` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`Comment_ID`, `Content`, `Written_By`, `Title_ID`) VALUES
(12, 'You need a correction on Test.png', 2, 10),
(13, 'This is second comment.', 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `folder`
--

CREATE TABLE `folder` (
  `File_No` int(3) NOT NULL,
  `File_Name` varchar(100) NOT NULL,
  `File_Path` varchar(100) NOT NULL,
  `File_Description` text DEFAULT NULL,
  `File_Upload_Date` date NOT NULL,
  `Title_ID` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `folder`
--

INSERT INTO `folder` (`File_No`, `File_Name`, `File_Path`, `File_Description`, `File_Upload_Date`, `Title_ID`) VALUES
(42, 'Test.png', 'upload/Test.png', '', '2024-01-23', 10),
(43, 'Picture.pdf', 'upload/Picture.pdf', 'This is a picture.', '2024-01-23', 10),
(44, 'Test.png', 'upload/Test.png', 'abcd', '2024-01-23', 6),
(45, 'ABC.png', 'upload/ABC.png', 'bkjdcsks', '2024-05-08', 10),
(47, 'a', 'upload/ABC.png', 'bd', '2025-02-09', 6);

-- --------------------------------------------------------

--
-- Table structure for table `programme`
--

CREATE TABLE `programme` (
  `Programme_ID` varchar(4) NOT NULL,
  `Programme_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programme`
--

INSERT INTO `programme` (`Programme_ID`, `Programme_Name`) VALUES
('P101', 'Diploma In Computer Science'),
('P102', 'Diploma In Information Technology');

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

CREATE TABLE `title` (
  `Title_ID` int(3) NOT NULL,
  `Title_Name` varchar(100) NOT NULL,
  `Title_Taken` char(1) NOT NULL,
  `Taken_By` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`Title_ID`, `Title_Name`, `Title_Taken`, `Taken_By`) VALUES
(1, 'Online Claim Forms', 'N', NULL),
(2, 'Beginning Typing Software', 'N', NULL),
(3, 'Piano Learning System Grade 2', 'N', NULL),
(4, 'Student Talent Analysis', 'N', NULL),
(5, 'NU Alert System', 'N', NULL),
(6, 'Timetabling System', 'Y', 3),
(7, 'Cocu proposal system', 'N', NULL),
(8, 'Payroll System', 'N', NULL),
(9, 'Online Voting System', 'N', NULL),
(10, 'Game Software', 'Y', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_ID` int(3) NOT NULL,
  `User_Name` varchar(100) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Phone` varchar(12) DEFAULT NULL,
  `Role` varchar(11) NOT NULL,
  `Programme` varchar(4) DEFAULT NULL,
  `Birth` date DEFAULT NULL,
  `Account_ID` varchar(20) NOT NULL,
  `Supervisor_ID` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_ID`, `User_Name`, `Email`, `Phone`, `Role`, `Programme`, `Birth`, `Account_ID`, `Supervisor_ID`) VALUES
(1, 'Steven Wong', 'n00012345@student.edu.my', '012-12312312', 'Student', 'P101', '2000-11-11', 'N00012345', 2),
(2, 'Mr. John', 'L0001@super.edu.my', '012-9876543', 'Supervisor', NULL, '1979-01-02', 'L0001', NULL),
(3, 'Amelia', 'n00056789@student.edu.my', '012-1231234', 'Student', 'P102', '2004-08-09', 'N00056789', 2),
(4, 'Mrs. Cody', NULL, NULL, 'Coordinator', NULL, NULL, 'Admin001', NULL),
(5, 'Mrs Rani', 'rani@nalai.edu.my', '013-2456789', 'Supervisor', NULL, '1990-01-01', 'L0002', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`Account_ID`);

--
-- Indexes for table `approvement`
--
ALTER TABLE `approvement`
  ADD PRIMARY KEY (`Approvement_ID`),
  ADD KEY `APPROVEMENT_TITLE_FK` (`Title_ID`),
  ADD KEY `APPROVEMENT_USER_FK` (`User_ID`),
  ADD KEY `APPROVEMENT_SUPERVISOR_FK` (`Supervisor_ID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`Comment_ID`),
  ADD KEY `COMMENT_USER_FK` (`Written_By`),
  ADD KEY `COMMENT_TITLE_FK` (`Title_ID`);

--
-- Indexes for table `folder`
--
ALTER TABLE `folder`
  ADD PRIMARY KEY (`File_No`),
  ADD KEY `FOLDER_TITLE_FK` (`Title_ID`);

--
-- Indexes for table `programme`
--
ALTER TABLE `programme`
  ADD PRIMARY KEY (`Programme_ID`);

--
-- Indexes for table `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`Title_ID`),
  ADD KEY `TITLE_USER_FK` (`Taken_By`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`),
  ADD KEY `USER_ACCOUNT_FK` (`Account_ID`),
  ADD KEY `USER_SUPERVISOR_FK` (`Supervisor_ID`),
  ADD KEY `USER_PROGRAMME_FK` (`Programme`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approvement`
--
ALTER TABLE `approvement`
  MODIFY `Approvement_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=312;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `Comment_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `folder`
--
ALTER TABLE `folder`
  MODIFY `File_No` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approvement`
--
ALTER TABLE `approvement`
  ADD CONSTRAINT `APPROVEMENT_SUPERVISOR_FK` FOREIGN KEY (`Supervisor_ID`) REFERENCES `users` (`User_ID`),
  ADD CONSTRAINT `APPROVEMENT_TITLE_FK` FOREIGN KEY (`Title_ID`) REFERENCES `title` (`Title_ID`),
  ADD CONSTRAINT `APPROVEMENT_USER_FK` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `COMMENT_TITLE_FK` FOREIGN KEY (`Title_ID`) REFERENCES `title` (`Title_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `COMMENT_USER_FK` FOREIGN KEY (`Written_By`) REFERENCES `users` (`User_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `folder`
--
ALTER TABLE `folder`
  ADD CONSTRAINT `FOLDER_TITLE_FK` FOREIGN KEY (`Title_ID`) REFERENCES `title` (`Title_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `title`
--
ALTER TABLE `title`
  ADD CONSTRAINT `TITLE_USER_FK` FOREIGN KEY (`Taken_By`) REFERENCES `users` (`User_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `USER_ACCOUNT_FK` FOREIGN KEY (`Account_ID`) REFERENCES `account` (`Account_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `USER_PROGRAMME_FK` FOREIGN KEY (`Programme`) REFERENCES `programme` (`Programme_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `USER_SUPERVISOR_FK` FOREIGN KEY (`Supervisor_ID`) REFERENCES `users` (`User_ID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
