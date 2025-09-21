-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2025
-- Project Setup Script

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvc`
--
CREATE DATABASE IF NOT EXISTS `mvc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `mvc`;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `company_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `name`, `email`, `location`) VALUES
(11110001, 'Future Tech Corp', 'hr@futuretech.com', 'Bangkok'),
(11110002, 'Digital Groove', 'recruit@digitalgroove.com', 'Chiang Mai');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `candidate_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('กำลังศึกษา','จบแล้ว') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`candidate_id`, `first_name`, `last_name`, `email`, `password`, `status`) VALUES
(22220001, 'สมชาย', 'เรียนดี', 'somchai.r@email.com', 'pass123', 'จบแล้ว'),
(22220002, 'สมหญิง', 'ขยันยิ่ง', 'somying.k@email.com', 'pass123', 'กำลังศึกษา'),
(22220003, 'มานะ', 'ใจหาญ', 'mana.j@email.com', 'pass123', 'จบแล้ว'),
(22220004, 'ปิติ', 'รักเพื่อน', 'piti.r@email.com', 'pass123', 'กำลังศึกษา'),
(22220005, 'วีระ', 'กล้าหาญ', 'veera.k@email.com', 'pass123', 'จบแล้ว'),
(22220006, 'ชูใจ', 'มีสุข', 'chujai.m@email.com', 'pass123', 'กำลังศึกษา'),
(22220007, 'สมศักดิ์', 'รักเรียน', 'somsak.r@email.com', 'pass123', 'จบแล้ว'),
(22220008, 'อารี', 'ใจดี', 'aree.j@email.com', 'pass123', 'กำลังศึกษา'),
(22220009, 'สมพงษ์', 'อดทน', 'sompong.o@email.com', 'pass123', 'จบแล้ว'),
(22220010, 'วันดี', 'มีชัย', 'wandee.m@email.com', 'pass123', 'กำลังศึกษา');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `company_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `deadline` date NOT NULL,
  `status` enum('เปิด','ปิด') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'เปิด',
  `type` enum('งานปกติ','สหกิจศึกษา') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `title`, `description`, `company_id`, `deadline`, `status`, `type`) VALUES
(33330001, 'Backend Developer', 'Develop API services.', 11110001, '2025-10-31', 'เปิด', 'งานปกติ'),
(33330002, 'Frontend Developer (Intern)', 'Join our team for a co-op program.', 11110001, '2025-10-15', 'เปิด', 'สหกิจศึกษา'),
(33330003, 'UX/UI Designer', 'Design user-friendly interfaces.', 11110002, '2025-11-05', 'เปิด', 'งานปกติ'),
(33330004, 'Data Analyst (Intern)', 'Work with our data team.', 11110002, '2025-09-30', 'เปิด', 'สหกิจศึกษา'),
(33330005, 'Project Manager', 'Manage software projects.', 11110001, '2025-12-01', 'เปิด', 'งานปกติ'),
(33330006, 'QA Tester (Internship)', 'Test our applications.', 11110002, '2025-10-20', 'ปิด', 'สหกิจศึกษา'),
(33330007, 'Mobile Developer (iOS)', 'Develop iOS applications.', 11110001, '2025-11-15', 'เปิด', 'งานปกติ'),
(33330008, 'DevOps Engineer', 'Manage our cloud infrastructure.', 11110001, '2025-11-20', 'เปิด', 'งานปกติ'),
(33330009, 'Graphic Designer (Intern)', 'Create visual assets for marketing.', 11110002, '2025-11-01', 'เปิด', 'สหกิจศึกษา'),
(33330010, 'IT Support', 'Provide technical support to staff.', 11110002, '2025-10-25', 'เปิด', 'งานปกติ'),
(33330011, 'Expired Backend Job (For Testing)', 'This job has already expired.', 11110001, '2025-09-20', 'เปิด', 'งานปกติ'),
(33330012, 'Closed IoT Job (For Testing)', 'This job is manually closed.', 11110002, '2025-09-22', 'ปิด', 'งานปกติ');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `application_id` int(11) NOT NULL,
  `job_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `candidate_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `application_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`);

ALTER TABLE `candidates`
  ADD PRIMARY KEY (`candidate_id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `company_id` (`company_id`);

ALTER TABLE `applications`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `candidate_id` (`candidate_id`);

--
-- AUTO_INCREMENT for dumped tables
--

ALTER TABLE `applications`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`);

ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`),
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`candidate_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;