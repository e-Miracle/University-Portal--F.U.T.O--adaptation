-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 07, 2021 at 07:36 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_hostel`
--

DROP TABLE IF EXISTS `book_hostel`;
CREATE TABLE IF NOT EXISTS `book_hostel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hostel_id` int(11) DEFAULT NULL,
  `room` int(11) DEFAULT NULL,
  `invoice_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `bed` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `load` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `code`, `load`, `semester`, `type`, `level`) VALUES
(2, 'Algebra and Trigonometry', 'MTH110', 3, 1, 'Core', 1),
(3, 'Calculus', 'MTH112', 3, 1, 'Core', 1),
(4, 'Mechanics, Thermal Physics', 'PHY111', 3, 1, 'Core', 1),
(5, 'General Chemistry I', 'CHM111', 3, 1, 'Core', 1),
(6, 'Use of English ', 'GST111', 2, 1, 'Core', 1),
(7, 'Philosophy and Logic', 'GST112', 2, 1, 'Core', 1),
(8, 'Programming Essentials', 'CSC111', 3, 1, 'Mandatory', 1),
(9, 'Practical Physics', 'PHY109', 2, 1, 'Elective', 1),
(10, 'Vibration, Wave and Optics', 'PHY113', 3, 1, 'Elective', 1),
(11, 'Peace Studies & Conflict Resolution', 'GST121', 2, 2, 'Core', 1),
(12, 'Nigeria People and Culture', 'GST122', 2, 2, 'Core', 1),
(13, 'History and Philosophy of Science', 'GST123', 2, 2, 'Core', 1),
(14, 'Vectors, Geometry and Statistics', 'MTH123', 3, 2, 'Core', 1),
(15, 'Differential Equation and Dynamics', 'MTH125', 3, 2, 'Core', 1),
(16, 'General Chemistry II', 'CHM122', 3, 2, 'Elective', 1),
(17, 'Electromagnetism and Modern Physics', 'PHY124', 4, 2, 'Core', 1),
(18, 'Introduction to Software Packages', 'CSC120', 3, 2, 'Core', 1),
(19, 'Structural Programming in PASCAL', 'CSC211', 3, 1, 'Core', 2),
(20, 'Symbolic Programming in FORTRAN', 'CSC212', 3, 1, 'Core', 2),
(21, 'Linear Algebra', 'MTH230', 3, 1, 'Core', 2),
(22, 'Probability Distribution', 'MTH219', 3, 1, 'Core', 2),
(23, 'Information Technology: Design, Policy and Application', 'CSC217', 3, 1, 'Mandatory', 2),
(24, 'Information Interfaces & Presentation', 'CSC237', 3, 1, 'Elective', 2),
(25, 'Assembly Language Programming I', 'CSC222', 3, 2, 'Core', 2),
(26, 'Introduction to Data Processing', 'CSC220', 3, 2, 'Core', 2),
(27, 'Electromagnetism and Electronics', 'PHY224', 3, 2, 'Core', 2),
(28, 'Introductory Numerical Analysis', 'MTH227', 3, 2, 'Core', 2),
(29, 'Introduction to C and C++ Programming', 'CSC224', 3, 2, 'Mandatory', 2),
(30, 'Applied Statistics', 'MTH228', 3, 2, 'Elective', 2),
(31, 'Data Structures', 'CSC313', 3, 1, 'Core', 3),
(32, 'Digital Computer Design', 'CSC316', 3, 1, 'Core', 3),
(33, 'Introduction to Formal Language', 'CSC318', 3, 1, 'Core', 3),
(34, 'Numerical Linear Algebra', 'MTH317', 3, 1, 'Core', 3),
(35, 'Operations Research', 'CSC314', 3, 1, 'Core', 3),
(36, 'Web Technology & Applications', 'CSC311', 3, 1, 'Elective', 3),
(37, 'Assembly Language II or C Programming', 'CSC312', 3, 1, 'Mandatory', 3),
(38, 'Human Computer Interaction', 'CSC333', 3, 1, 'Elective', 3),
(39, 'Discrete Mathematics, Network & Graph Theory', 'CSC328', 3, 2, 'Core', 3),
(40, 'Computer Architecture', 'CSC326', 3, 2, 'Core', 3),
(41, 'Compiler Construction', 'CSC325', 3, 2, 'Core', 3),
(42, 'Systems Analysis and Design', 'CSC321', 3, 2, 'Core', 3),
(43, 'Research Methodology', 'CSC329', 3, 2, 'Mandatory', 3),
(44, 'Electronics', 'PHY326', 3, 2, 'Elective', 3),
(45, 'Economics of Information Technology', 'CSC323', 3, 2, 'Elective', 3),
(46, 'Research Seminar', 'CSC419', 3, 1, 'Core', 4),
(47, 'Operating Systems', 'CSC411', 3, 1, 'Core', 4),
(48, 'Design & Analysis of Computer Algorithms', 'CSC418', 3, 1, 'Core', 4),
(49, 'Systems Programming', 'CSC432', 3, 1, 'Core', 4),
(50, 'Database Management', 'CSC413', 3, 1, 'Mandatory', 4),
(51, 'Artificial Intelligence', 'CSC415', 3, 1, 'Elective', 4),
(52, 'Advanced Programming Concepts', 'CSC412', 3, 1, 'Elective', 4),
(53, 'Management Science', 'CSC414', 3, 1, 'Elective', 4),
(54, 'Project', 'CSC499', 6, 2, 'Core', 4),
(55, 'Software Engineering', 'CSC421', 3, 2, 'Core', 4),
(56, 'Concept of Programming Languages', 'CSC422', 3, 2, 'Core', 4),
(57, 'Data Communications and Networks', 'CSC427', 3, 2, 'Core', 4),
(58, 'Graph Theory and Applications', 'CSC428', 3, 2, 'Elective', 4),
(59, 'Simulations & Probability Models in OR', 'CSC424', 3, 2, 'Elective', 4),
(60, 'Advanced Digital Computer Design', 'CSC426', 3, 2, 'Elective', 4),
(61, 'Introduction to Business I', 'BUS111', 3, 1, 'Elective', 1),
(62, 'Introduction to Business I', 'BUS121', 3, 2, 'Elective', 1),
(63, 'Principles of Management I', 'BUS211', 3, 1, 'Elective', 2),
(64, 'Principles of Management II', 'BUS221', 3, 2, 'Elective', 2),
(65, 'Entrepreneurship Development', 'CED300', 3, 1, 'Mandatory', 3),
(66, 'Introduction to Computing', 'CSC110', 3, 1, 'Core', 1),
(67, 'Introduction to Computing', 'CSC110', 3, 1, 'Core', 1);

-- --------------------------------------------------------

--
-- Table structure for table `course_reg`
--

DROP TABLE IF EXISTS `course_reg`;
CREATE TABLE IF NOT EXISTS `course_reg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_reg`
--

INSERT INTO `course_reg` (`id`, `course_id`, `user_id`, `faculty_id`, `department_id`, `level_id`, `semester_id`, `session_id`, `created_on`, `status`) VALUES
(36, 9, 1, 1, 1, 1, 1, 1, '2021-04-06 17:51:30', 1),
(35, 6, 1, 1, 1, 1, 1, 1, '2021-04-06 17:51:30', 1),
(34, 4, 1, 1, 1, 1, 1, 1, '2021-04-06 17:51:30', 1),
(33, 3, 1, 1, 1, 1, 1, 1, '2021-04-06 17:51:30', 1),
(32, 2, 1, 1, 1, 1, 1, 1, '2021-04-06 17:51:30', 1),
(31, 1, 1, 1, 1, 1, 1, 1, '2021-04-06 17:51:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `abbrev` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `faculty_id`, `name`, `abbrev`, `status`) VALUES
(1, 1, 'AGRICULTURAL AND BIORESOURCE ENGINEERING', 'ABE', 1);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
CREATE TABLE IF NOT EXISTS `faculty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `abbrev` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `name`, `abbrev`, `status`) VALUES
(1, 'SCHOOL OF ENGINEERING AND ENGINEERING TECHNOLOGY', 'SEET', 1),
(2, 'SCHOOL OF BIOLOGICAL SCIENCE', 'SOBS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

DROP TABLE IF EXISTS `grade`;
CREATE TABLE IF NOT EXISTS `grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `a` int(11) NOT NULL,
  `b` int(11) NOT NULL,
  `c` int(11) NOT NULL,
  `d` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hostels`
--

DROP TABLE IF EXISTS `hostels`;
CREATE TABLE IF NOT EXISTS `hostels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `rooms` int(11) NOT NULL,
  `beds` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(30) NOT NULL,
  `type` enum('SIWES','HOSTEL','SCHOOL FEE','PART SCHOOL FEE','ACCEPTANCE') NOT NULL,
  `reference` varchar(50) NOT NULL,
  `detail` text NOT NULL,
  `channel` varchar(30) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `updated_on` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `user_id`, `type`, `reference`, `detail`, `channel`, `amount`, `created_on`, `status`, `updated_on`) VALUES
(1, '1', 'SCHOOL FEE', 'EF5538504F76ED5C922D0E31BC43AB', '2020/2021 SCHOOL FEE INVOICE FOR 100 LEVEL', 'PAYSTACK', 50000, '2021-04-01 17:50:52', 1, NULL),
(2, '1', 'HOSTEL', '7A76489C562B8855DF0BC198', '2020/2021 HOSTEL INVOICE FOR <b> 20161966093 </b>', 'PAYSTACK', 20000, '2021-04-01 18:49:47', 0, NULL),
(3, '1', 'SIWES', '2F0A622741A73F96684C15F8', '200 SIWES INVOICE FOR <b> 20161966093 </b>', 'PAYSTACK', 700, '2021-04-02 09:14:47', 0, NULL),
(4, '1', 'SCHOOL FEE', '3EF83FBDD40E65A2928A8250E1', '2020/2021 SCHOOL FEE INVOICE FOR 300 LEVEL', 'PAYSTACK', 50000, '2021-04-02 19:33:12', 0, NULL),
(5, '201698733FE', 'ACCEPTANCE', '2782436F85A3B8A81264', '2020/2021 ACCEPTANCE FEE INVOICE FOR <b> 201698733FE </b>', 'PAYSTACK', 4000, '2021-04-06 22:11:36', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_role`
--

DROP TABLE IF EXISTS `lecturer_role`;
CREATE TABLE IF NOT EXISTS `lecturer_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `faculty` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturer_role`
--

INSERT INTO `lecturer_role` (`id`, `user_id`, `faculty`, `department`, `level_id`, `course_id`, `status`) VALUES
(1, 2, 1, 1, 1, 1, 1),
(3, 2, 2, 2, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

DROP TABLE IF EXISTS `level`;
CREATE TABLE IF NOT EXISTS `level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `numeric` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `name`, `numeric`) VALUES
(1, '100', 100),
(2, '200', 200),
(3, '300', 300),
(4, '400', 400);

-- --------------------------------------------------------

--
-- Table structure for table `lga`
--

DROP TABLE IF EXISTS `lga`;
CREATE TABLE IF NOT EXISTS `lga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `state_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=770 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lga`
--

INSERT INTO `lga` (`id`, `name`, `state_id`, `status`) VALUES
(1, 'Aba North', 1, 1),
(2, 'Aba South', 1, 1),
(3, 'Arochukwu', 1, 1),
(4, 'Bende', 1, 1),
(5, 'Ikwuano', 1, 1),
(6, 'Isiala-Ngwa North', 1, 1),
(7, 'Isiala-Ngwa South', 1, 1),
(8, 'Isuikwato', 1, 1),
(9, 'Obi Nwa', 1, 1),
(10, 'Ohafia', 1, 1),
(11, 'Osisioma', 1, 1),
(12, 'Ngwa', 1, 1),
(13, 'Ugwunagbo', 1, 1),
(14, 'Ukwa East', 1, 1),
(15, 'Ukwa West', 1, 1),
(16, 'Umuahia North', 1, 1),
(17, 'Umuahia South', 1, 1),
(18, 'Umu-Neochi', 1, 1),
(19, 'Demsa', 2, 1),
(20, 'Fufore', 2, 1),
(21, 'Ganaye', 2, 1),
(22, 'Gireri', 2, 1),
(23, 'Gombi', 2, 1),
(24, 'Guyuk', 2, 1),
(25, 'Hong', 2, 1),
(26, 'Jada', 2, 1),
(27, 'Lamurde', 2, 1),
(28, 'Madagali', 2, 1),
(29, 'Maiha', 2, 1),
(30, 'Mayo-Belwa', 2, 1),
(31, 'Michika', 2, 1),
(32, 'Mubi North', 2, 1),
(33, 'Mubi South', 2, 1),
(34, 'Numan', 2, 1),
(35, 'Shelleng', 2, 1),
(36, 'Song', 2, 1),
(37, 'Toungo', 2, 1),
(38, 'Yola North', 2, 1),
(39, 'Yola South', 2, 1),
(40, 'Aguata', 3, 1),
(41, 'Anambra East', 3, 1),
(42, 'Anambra West', 3, 1),
(43, 'Anaocha', 3, 1),
(44, 'Awka North', 3, 1),
(45, 'Awka South', 3, 1),
(46, 'Ayamelum', 3, 1),
(47, 'Dunukofia', 3, 1),
(48, 'Ekwusigo', 3, 1),
(49, 'Idemili North', 3, 1),
(50, 'Idemili south', 3, 1),
(51, 'Ihiala', 3, 1),
(52, 'Njikoka', 3, 1),
(53, 'Nnewi North', 3, 1),
(54, 'Nnewi South', 3, 1),
(55, 'Ogbaru', 3, 1),
(56, 'Onitsha North', 3, 1),
(57, 'Onitsha South', 3, 1),
(58, 'Orumba North', 3, 1),
(59, 'Orumba South', 3, 1),
(60, 'Oyi', 3, 1),
(61, 'Abak', 4, 1),
(62, 'Eastern Obolo', 4, 1),
(63, 'Eket', 4, 1),
(64, 'Esit Eket', 4, 1),
(65, 'Essien Udim', 4, 1),
(66, 'Etim Ekpo', 4, 1),
(67, 'Etinan', 4, 1),
(68, 'Ibeno', 4, 1),
(69, 'Ibesikpo Asutan', 4, 1),
(70, 'Ibiono Ibom', 4, 1),
(71, 'Ika', 4, 1),
(72, 'Ikono', 4, 1),
(73, 'Ikot Abasi', 4, 1),
(74, 'Ikot Ekpene', 4, 1),
(75, 'Ini', 4, 1),
(76, 'Itu', 4, 1),
(77, 'Mbo', 4, 1),
(78, 'Mkpat Enin', 4, 1),
(79, 'Nsit Atai', 4, 1),
(80, 'Nsit Ibom', 4, 1),
(81, 'Nsit Ubium', 4, 1),
(82, 'Obot Akara', 4, 1),
(83, 'Okobo', 4, 1),
(84, 'Onna', 4, 1),
(85, 'Oron', 4, 1),
(86, 'Oruk Anam', 4, 1),
(87, 'Udung Uko', 4, 1),
(88, 'Ukanafun', 4, 1),
(89, 'Uruan', 4, 1),
(90, 'Urue-Offong/Oruko ', 4, 1),
(91, 'Uyo', 4, 1),
(92, 'Alkaleri', 5, 1),
(93, 'Bauchi', 5, 1),
(94, 'Bogoro', 5, 1),
(95, 'Damban', 5, 1),
(96, 'Darazo', 5, 1),
(97, 'Dass', 5, 1),
(98, 'Ganjuwa', 5, 1),
(99, 'Giade', 5, 1),
(100, 'Itas/Gadau', 5, 1),
(101, 'Jama\'are', 5, 1),
(102, 'Katagum', 5, 1),
(103, 'Kirfi', 5, 1),
(104, 'Misau', 5, 1),
(105, 'Ningi', 5, 1),
(106, 'Shira', 5, 1),
(107, 'Tafawa-Balewa', 5, 1),
(108, 'Toro', 5, 1),
(109, 'Warji', 5, 1),
(110, 'Zaki', 5, 1),
(111, 'Brass', 6, 1),
(112, 'Ekeremor', 6, 1),
(113, 'Kolokuma/Opokuma', 6, 1),
(114, 'Nembe', 6, 1),
(115, 'Ogbia', 6, 1),
(116, 'Sagbama', 6, 1),
(117, 'Southern Jaw', 6, 1),
(118, 'Yenegoa', 6, 1),
(119, 'Ado', 7, 1),
(120, 'Agatu', 7, 1),
(121, 'Apa', 7, 1),
(122, 'Buruku', 7, 1),
(123, 'Gboko', 7, 1),
(124, 'Guma', 7, 1),
(125, 'Gwer East', 7, 1),
(126, 'Gwer West', 7, 1),
(127, 'Katsina-Ala', 7, 1),
(128, 'Konshisha', 7, 1),
(129, 'Kwande', 7, 1),
(130, 'Logo', 7, 1),
(131, 'Makurdi', 7, 1),
(132, 'Obi', 7, 1),
(133, 'Ogbadibo', 7, 1),
(134, 'Oju', 7, 1),
(135, 'Okpokwu', 7, 1),
(136, 'Ohimini', 7, 1),
(137, 'Oturkpo', 7, 1),
(138, 'Tarka', 7, 1),
(139, 'Ukum', 7, 1),
(140, 'Ushongo', 7, 1),
(141, 'Vandeikya', 7, 1),
(142, 'Abadam', 8, 1),
(143, 'Askira/Uba', 8, 1),
(144, 'Bama', 8, 1),
(145, 'Bayo', 8, 1),
(146, 'Biu', 8, 1),
(147, 'Chibok', 8, 1),
(148, 'Damboa', 8, 1),
(149, 'Dikwa', 8, 1),
(150, 'Gubio', 8, 1),
(151, 'Guzamala', 8, 1),
(152, 'Gwoza', 8, 1),
(153, 'Hawul', 8, 1),
(154, 'Jere', 8, 1),
(155, 'Kaga', 8, 1),
(156, 'Kala/Balge', 8, 1),
(157, 'Konduga', 8, 1),
(158, 'Kukawa', 8, 1),
(159, 'Kwaya Kusar', 8, 1),
(160, 'Mafa', 8, 1),
(161, 'Magumeri', 8, 1),
(162, 'Maiduguri', 8, 1),
(163, 'Marte', 8, 1),
(164, 'Mobbar', 8, 1),
(165, 'Monguno', 8, 1),
(166, 'Ngala', 8, 1),
(167, 'Nganzai', 8, 1),
(168, 'Shani', 8, 1),
(169, 'Akpabuyo', 9, 1),
(170, 'Odukpani', 9, 1),
(171, 'Akamkpa', 9, 1),
(172, 'Biase', 9, 1),
(173, 'Abi', 9, 1),
(174, 'Ikom', 9, 1),
(175, 'Yarkur', 9, 1),
(176, 'Odubra', 9, 1),
(177, 'Boki', 9, 1),
(178, 'Ogoja', 9, 1),
(179, 'Yala', 9, 1),
(180, 'Obanliku', 9, 1),
(181, 'Obudu', 9, 1),
(182, 'Calabar South', 9, 1),
(183, 'Etung', 9, 1),
(184, 'Bekwara', 9, 1),
(185, 'Bakassi', 9, 1),
(186, 'Calabar Municipality', 9, 1),
(187, 'Oshimili', 10, 1),
(188, 'Aniocha', 10, 1),
(189, 'Aniocha South', 10, 1),
(190, 'Ika South', 10, 1),
(191, 'Ika North-East', 10, 1),
(192, 'Ndokwa West', 10, 1),
(193, 'Ndokwa East', 10, 1),
(194, 'Isoko south', 10, 1),
(195, 'Isoko North', 10, 1),
(196, 'Bomadi', 10, 1),
(197, 'Burutu', 10, 1),
(198, 'Ughelli South', 10, 1),
(199, 'Ughelli North', 10, 1),
(200, 'Ethiope West', 10, 1),
(201, 'Ethiope East', 10, 1),
(202, 'Sapele', 10, 1),
(203, 'Okpe', 10, 1),
(204, 'Warri North', 10, 1),
(205, 'Warri South', 10, 1),
(206, 'Uvwie', 10, 1),
(207, 'Udu', 10, 1),
(208, 'Warri Central', 10, 1),
(209, 'Ukwani', 10, 1),
(210, 'Oshimili North', 10, 1),
(211, 'Patani', 10, 1),
(212, 'Afikpo South', 11, 1),
(213, 'Afikpo North', 11, 1),
(214, 'Onicha', 11, 1),
(215, 'Ohaozara', 11, 1),
(216, 'Abakaliki', 11, 1),
(217, 'Ishielu', 11, 1),
(218, 'lkwo', 11, 1),
(219, 'Ezza', 11, 1),
(220, 'Ezza South', 11, 1),
(221, 'Ohaukwu', 11, 1),
(222, 'Ebonyi', 11, 1),
(223, 'Ivo', 11, 1),
(224, 'Enugu South,', 12, 1),
(225, 'Igbo-Eze South', 12, 1),
(226, 'Enugu North', 12, 1),
(227, 'Nkanu', 12, 1),
(228, 'Udi Agwu', 12, 1),
(229, 'Oji-River', 12, 1),
(230, 'Ezeagu', 12, 1),
(231, 'IgboEze North', 12, 1),
(232, 'Isi-Uzo', 12, 1),
(233, 'Nsukka', 12, 1),
(234, 'Igbo-Ekiti', 12, 1),
(235, 'Uzo-Uwani', 12, 1),
(236, 'Enugu Eas', 12, 1),
(237, 'Aninri', 12, 1),
(238, 'Nkanu East', 12, 1),
(239, 'Udenu.', 12, 1),
(240, 'Esan North-East', 13, 1),
(241, 'Esan Central', 13, 1),
(242, 'Esan West', 13, 1),
(243, 'Egor', 13, 1),
(244, 'Ukpoba', 13, 1),
(245, 'Central', 13, 1),
(246, 'Etsako Central', 13, 1),
(247, 'Igueben', 13, 1),
(248, 'Oredo', 13, 1),
(249, 'Ovia SouthWest', 13, 1),
(250, 'Ovia South-East', 13, 1),
(251, 'Orhionwon', 13, 1),
(252, 'Uhunmwonde', 13, 1),
(253, 'Etsako East', 13, 1),
(254, 'Esan South-East', 13, 1),
(255, 'Ado', 14, 1),
(256, 'Ekiti-East', 14, 1),
(257, 'Ekiti-West', 14, 1),
(258, 'Emure/Ise/Orun', 14, 1),
(259, 'Ekiti South-West', 14, 1),
(260, 'Ikare', 14, 1),
(261, 'Irepodun', 14, 1),
(262, 'Ijero,', 14, 1),
(263, 'Ido/Osi', 14, 1),
(264, 'Oye', 14, 1),
(265, 'Ikole', 14, 1),
(266, 'Moba', 14, 1),
(267, 'Gbonyin', 14, 1),
(268, 'Efon', 14, 1),
(269, 'Ise/Orun', 14, 1),
(270, 'Ilejemeje.', 14, 1),
(271, 'Abaji', 15, 1),
(272, 'Abuja Municipal', 15, 1),
(273, 'Bwari', 15, 1),
(274, 'Gwagwalada', 15, 1),
(275, 'Kuje', 15, 1),
(276, 'Kwali', 15, 1),
(277, 'Akko', 16, 1),
(278, 'Balanga', 16, 1),
(279, 'Billiri', 16, 1),
(280, 'Dukku', 16, 1),
(281, 'Kaltungo', 16, 1),
(282, 'Kwami', 16, 1),
(283, 'Shomgom', 16, 1),
(284, 'Funakaye', 16, 1),
(285, 'Gombe', 16, 1),
(286, 'Nafada/Bajoga', 16, 1),
(287, 'Yamaltu/Delta.', 16, 1),
(288, 'Aboh-Mbaise', 17, 1),
(289, 'Ahiazu-Mbaise', 17, 1),
(290, 'Ehime-Mbano', 17, 1),
(291, 'Ezinihitte', 17, 1),
(292, 'Ideato North', 17, 1),
(293, 'Ideato South', 17, 1),
(294, 'Ihitte/Uboma', 17, 1),
(295, 'Ikeduru', 17, 1),
(296, 'Isiala Mbano', 17, 1),
(297, 'Isu', 17, 1),
(298, 'Mbaitoli', 17, 1),
(299, 'Mbaitoli', 17, 1),
(300, 'Ngor-Okpala', 17, 1),
(301, 'Njaba', 17, 1),
(302, 'Nwangele', 17, 1),
(303, 'Nkwerre', 17, 1),
(304, 'Obowo', 17, 1),
(305, 'Oguta', 17, 1),
(306, 'Ohaji/Egbema', 17, 1),
(307, 'Okigwe', 17, 1),
(308, 'Orlu', 17, 1),
(309, 'Orsu', 17, 1),
(310, 'Oru East', 17, 1),
(311, 'Oru West', 17, 1),
(312, 'Owerri-Municipal', 17, 1),
(313, 'Owerri North', 17, 1),
(314, 'Owerri West', 17, 1),
(315, 'Auyo', 18, 1),
(316, 'Babura', 18, 1),
(317, 'Birni Kudu', 18, 1),
(318, 'Biriniwa', 18, 1),
(319, 'Buji', 18, 1),
(320, 'Dutse', 18, 1),
(321, 'Gagarawa', 18, 1),
(322, 'Garki', 18, 1),
(323, 'Gumel', 18, 1),
(324, 'Guri', 18, 1),
(325, 'Gwaram', 18, 1),
(326, 'Gwiwa', 18, 1),
(327, 'Hadejia', 18, 1),
(328, 'Jahun', 18, 1),
(329, 'Kafin Hausa', 18, 1),
(330, 'Kaugama Kazaure', 18, 1),
(331, 'Kiri Kasamma', 18, 1),
(332, 'Kiyawa', 18, 1),
(333, 'Maigatari', 18, 1),
(334, 'Malam Madori', 18, 1),
(335, 'Miga', 18, 1),
(336, 'Ringim', 18, 1),
(337, 'Roni', 18, 1),
(338, 'Sule-Tankarkar', 18, 1),
(339, 'Taura', 18, 1),
(340, 'Yankwashi', 18, 1),
(341, 'Birni-Gwari', 19, 1),
(342, 'Chikun', 19, 1),
(343, 'Giwa', 19, 1),
(344, 'Igabi', 19, 1),
(345, 'Ikara', 19, 1),
(346, 'jaba', 19, 1),
(347, 'Jema\'a', 19, 1),
(348, 'Kachia', 19, 1),
(349, 'Kaduna North', 19, 1),
(350, 'Kaduna South', 19, 1),
(351, 'Kagarko', 19, 1),
(352, 'Kajuru', 19, 1),
(353, 'Kaura', 19, 1),
(354, 'Kauru', 19, 1),
(355, 'Kubau', 19, 1),
(356, 'Kudan', 19, 1),
(357, 'Lere', 19, 1),
(358, 'Makarfi', 19, 1),
(359, 'Sabon-Gari', 19, 1),
(360, 'Sanga', 19, 1),
(361, 'Soba', 19, 1),
(362, 'Zango-Kataf', 19, 1),
(363, 'Zaria', 19, 1),
(364, 'Ajingi', 20, 1),
(365, 'Albasu', 20, 1),
(366, 'Bagwai', 20, 1),
(367, 'Bebeji', 20, 1),
(368, 'Bichi', 20, 1),
(369, 'Bunkure', 20, 1),
(370, 'Dala', 20, 1),
(371, 'Dambatta', 20, 1),
(372, 'Dawakin Kudu', 20, 1),
(373, 'Dawakin Tofa', 20, 1),
(374, 'Doguwa', 20, 1),
(375, 'Fagge', 20, 1),
(376, 'Gabasawa', 20, 1),
(377, 'Garko', 20, 1),
(378, 'Garum', 20, 1),
(379, 'Mallam', 20, 1),
(380, 'Gaya', 20, 1),
(381, 'Gezawa', 20, 1),
(382, 'Gwale', 20, 1),
(383, 'Gwarzo', 20, 1),
(384, 'Kabo', 20, 1),
(385, 'Kano Municipal', 20, 1),
(386, 'Karaye', 20, 1),
(387, 'Kibiya', 20, 1),
(388, 'Kiru', 20, 1),
(389, 'kumbotso', 20, 1),
(390, 'Kunchi', 20, 1),
(391, 'Kura', 20, 1),
(392, 'Madobi', 20, 1),
(393, 'Makoda', 20, 1),
(394, 'Minjibir', 20, 1),
(395, 'Nasarawa', 20, 1),
(396, 'Rano', 20, 1),
(397, 'Rimin Gado', 20, 1),
(398, 'Rogo', 20, 1),
(399, 'Shanono', 20, 1),
(400, 'Sumaila', 20, 1),
(401, 'Takali', 20, 1),
(402, 'Tarauni', 20, 1),
(403, 'Tofa', 20, 1),
(404, 'Tsanyawa', 20, 1),
(405, 'Tudun Wada', 20, 1),
(406, 'Ungogo', 20, 1),
(407, 'Warawa', 20, 1),
(408, 'Wudil', 20, 1),
(409, 'Bakori', 21, 1),
(410, 'Batagarawa', 21, 1),
(411, 'Batsari', 21, 1),
(412, 'Baure', 21, 1),
(413, 'Bindawa', 21, 1),
(414, 'Charanchi', 21, 1),
(415, 'Dandume', 21, 1),
(416, 'Danja', 21, 1),
(417, 'Dan Musa', 21, 1),
(418, 'Daura', 21, 1),
(419, 'Dutsi', 21, 1),
(420, 'Dutsin-Ma', 21, 1),
(421, 'Faskari', 21, 1),
(422, 'Funtua', 21, 1),
(423, 'Ingawa', 21, 1),
(424, 'Jibia', 21, 1),
(425, 'Kafur', 21, 1),
(426, 'Kaita', 21, 1),
(427, 'Kankara', 21, 1),
(428, 'Kankia', 21, 1),
(429, 'Katsina', 21, 1),
(430, 'Kurfi', 21, 1),
(431, 'Kusada', 21, 1),
(432, 'Mai\'Adua', 21, 1),
(433, 'Malumfashi', 21, 1),
(434, 'Mani', 21, 1),
(435, 'Mashi', 21, 1),
(436, 'Matazuu', 21, 1),
(437, 'Musawa', 21, 1),
(438, 'Rimi', 21, 1),
(439, 'Sabuwa', 21, 1),
(440, 'Safana', 21, 1),
(441, 'Sandamu', 21, 1),
(442, 'Zango', 21, 1),
(443, 'Aleiro', 22, 1),
(444, 'Arewa-Dandi', 22, 1),
(445, 'Argungu', 22, 1),
(446, 'Augie', 22, 1),
(447, 'Bagudo', 22, 1),
(448, 'Birnin Kebbi', 22, 1),
(449, 'Bunza', 22, 1),
(450, 'Dandi', 22, 1),
(451, 'Fakai', 22, 1),
(452, 'Gwandu', 22, 1),
(453, 'Jega', 22, 1),
(454, 'Kalgo', 22, 1),
(455, 'Koko/Besse', 22, 1),
(456, 'Maiyama', 22, 1),
(457, 'Ngaski', 22, 1),
(458, 'Sakaba', 22, 1),
(459, 'Shanga', 22, 1),
(460, 'Suru', 22, 1),
(461, 'Wasagu/Danko', 22, 1),
(462, 'Yauri', 22, 1),
(463, 'Zuru', 22, 1),
(464, 'Adavi', 23, 1),
(465, 'Ajaokuta', 23, 1),
(466, 'Ankpa', 23, 1),
(467, 'Bassa', 23, 1),
(468, 'Dekina', 23, 1),
(469, 'Ibaji', 23, 1),
(470, 'Idah', 23, 1),
(471, 'Igalamela-Odolu', 23, 1),
(472, 'Ijumu', 23, 1),
(473, 'Kabba/Bunu', 23, 1),
(474, 'Kogi', 23, 1),
(475, 'Lokoja', 23, 1),
(476, 'Mopa-Muro', 23, 1),
(477, 'Ofu', 23, 1),
(478, 'Ogori/Mangongo', 23, 1),
(479, 'Okehi', 23, 1),
(480, 'Okene', 23, 1),
(481, 'Olamabolo', 23, 1),
(482, 'Omala', 23, 1),
(483, 'Yagba East', 23, 1),
(484, 'Yagba West', 23, 1),
(485, 'Asa', 24, 1),
(486, 'Baruten', 24, 1),
(487, 'Edu', 24, 1),
(488, 'Ekiti', 24, 1),
(489, 'Ifelodun', 24, 1),
(490, 'Ilorin East', 24, 1),
(491, 'Ilorin West', 24, 1),
(492, 'Irepodun', 24, 1),
(493, 'Isin', 24, 1),
(494, 'Kaiama', 24, 1),
(495, 'Moro', 24, 1),
(496, 'Offa', 24, 1),
(497, 'Oke-Ero', 24, 1),
(498, 'Oyun', 24, 1),
(499, 'Pategi', 24, 1),
(500, 'Agege', 25, 1),
(501, 'Ajeromi-Ifelodun', 25, 1),
(502, 'Alimosho', 25, 1),
(503, 'Amuwo-Odofin', 25, 1),
(504, 'Apapa', 25, 1),
(505, 'Badagry', 25, 1),
(506, 'Epe', 25, 1),
(507, 'Eti-Osa', 25, 1),
(508, 'Ibeju/Lekki', 25, 1),
(509, 'Ifako-Ijaye', 25, 1),
(510, 'Ikeja', 25, 1),
(511, 'Ikorodu', 25, 1),
(512, 'Kosofe', 25, 1),
(513, 'Lagos Island', 25, 1),
(514, 'Lagos Mainland', 25, 1),
(515, 'Mushin', 25, 1),
(516, 'Ojo', 25, 1),
(517, 'Oshodi-Isolo', 25, 1),
(518, 'Shomolu', 25, 1),
(519, 'Surulere', 25, 1),
(520, 'Akwanga', 26, 1),
(521, 'Awe', 26, 1),
(522, 'Doma', 26, 1),
(523, 'Karu', 26, 1),
(524, 'Keana', 26, 1),
(525, 'Keffi', 26, 1),
(526, 'Kokona', 26, 1),
(527, 'Lafia', 26, 1),
(528, 'Nasarawa', 26, 1),
(529, 'Nasarawa-Eggon', 26, 1),
(530, 'Obi', 26, 1),
(531, 'Toto', 26, 1),
(532, 'Wamba', 26, 1),
(533, 'Agaie', 27, 1),
(534, 'Agwara', 27, 1),
(535, 'Bida', 27, 1),
(536, 'Borgu', 27, 1),
(537, 'Bosso', 27, 1),
(538, 'Chanchaga', 27, 1),
(539, 'Edati', 27, 1),
(540, 'Gbako', 27, 1),
(541, 'Gurara', 27, 1),
(542, 'Katcha', 27, 1),
(543, 'Kontagora', 27, 1),
(544, 'Lapai', 27, 1),
(545, 'Lavun', 27, 1),
(546, 'Magama', 27, 1),
(547, 'Mariga', 27, 1),
(548, 'Mashegu', 27, 1),
(549, 'Mokwa', 27, 1),
(550, 'Muya', 27, 1),
(551, 'Pailoro', 27, 1),
(552, 'Rafi', 27, 1),
(553, 'Rijau', 27, 1),
(554, 'Shiroro', 27, 1),
(555, 'Suleja', 27, 1),
(556, 'Tafa', 27, 1),
(557, 'Wushishi', 27, 1),
(558, 'Abeokuta North', 28, 1),
(559, 'Abeokuta South', 28, 1),
(560, 'Ado-Odo/Ota', 28, 1),
(561, 'Egbado North', 28, 1),
(562, 'Egbado South', 28, 1),
(563, 'Ewekoro', 28, 1),
(564, 'Ifo', 28, 1),
(565, 'Ijebu East', 28, 1),
(566, 'Ijebu North', 28, 1),
(567, 'Ijebu North East', 28, 1),
(568, 'Ijebu Ode', 28, 1),
(569, 'Ikenne', 28, 1),
(570, 'Imeko-Afon', 28, 1),
(571, 'Ipokia', 28, 1),
(572, 'Obafemi-Owode', 28, 1),
(573, 'Ogun Waterside', 28, 1),
(574, 'Odeda', 28, 1),
(575, 'Odogbolu', 28, 1),
(576, 'Remo North', 28, 1),
(577, 'Shagamu', 28, 1),
(578, 'Akoko North East', 29, 1),
(579, 'Akoko North West', 29, 1),
(580, 'Akoko South Akure East', 29, 1),
(581, 'Akoko South West', 29, 1),
(582, 'Akure North', 29, 1),
(583, 'Akure South', 29, 1),
(584, 'Ese-Odo', 29, 1),
(585, 'Idanre', 29, 1),
(586, 'Ifedore', 29, 1),
(587, 'Ilaje', 29, 1),
(588, 'Ile-Oluji', 29, 1),
(589, 'Okeigbo', 29, 1),
(590, 'Irele', 29, 1),
(591, 'Odigbo', 29, 1),
(592, 'Okitipupa', 29, 1),
(593, 'Ondo East', 29, 1),
(594, 'Ondo West', 29, 1),
(595, 'Ose', 29, 1),
(596, 'Owo', 29, 1),
(597, 'Aiyedade', 30, 1),
(598, 'Aiyedire', 30, 1),
(599, 'Atakumosa East', 30, 1),
(600, 'Atakumosa West', 30, 1),
(601, 'Boluwaduro', 30, 1),
(602, 'Boripe', 30, 1),
(603, 'Ede North', 30, 1),
(604, 'Ede South', 30, 1),
(605, 'Egbedore', 30, 1),
(606, 'Ejigbo', 30, 1),
(607, 'Ife Central', 30, 1),
(608, 'Ife East', 30, 1),
(609, 'Ife North', 30, 1),
(610, 'Ife South', 30, 1),
(611, 'Ifedayo', 30, 1),
(612, 'Ifelodun', 30, 1),
(613, 'Ila', 30, 1),
(614, 'Ilesha East', 30, 1),
(615, 'Ilesha West', 30, 1),
(616, 'Irepodun', 30, 1),
(617, 'Irewole', 30, 1),
(618, 'Isokan', 30, 1),
(619, 'Iwo', 30, 1),
(620, 'Obokun', 30, 1),
(621, 'Odo-Otin', 30, 1),
(622, 'Ola-Oluwa', 30, 1),
(623, 'Olorunda', 30, 1),
(624, 'Oriade', 30, 1),
(625, 'Orolu', 30, 1),
(626, 'Osogbo', 30, 1),
(627, 'Afijio', 31, 1),
(628, 'Akinyele', 31, 1),
(629, 'Atiba', 31, 1),
(630, 'Atigbo', 31, 1),
(631, 'Egbeda', 31, 1),
(632, 'Ibadan Central', 31, 1),
(633, 'Ibadan North', 31, 1),
(634, 'Ibadan North West', 31, 1),
(635, 'Ibadan South East', 31, 1),
(636, 'Ibadan South West', 31, 1),
(637, 'Ibarapa Central', 31, 1),
(638, 'Ibarapa East', 31, 1),
(639, 'Ibarapa North', 31, 1),
(640, 'Ido', 31, 1),
(641, 'Irepo', 31, 1),
(642, 'Iseyin', 31, 1),
(643, 'Itesiwaju', 31, 1),
(644, 'Iwajowa', 31, 1),
(645, 'Kajola', 31, 1),
(646, 'Lagelu Ogbomosho North', 31, 1),
(647, 'Ogbmosho South', 31, 1),
(648, 'Ogo Oluwa', 31, 1),
(649, 'Olorunsogo', 31, 1),
(650, 'Oluyole', 31, 1),
(651, 'Ona-Ara', 31, 1),
(652, 'Orelope', 31, 1),
(653, 'Ori Ire', 31, 1),
(654, 'Oyo East', 31, 1),
(655, 'Oyo West', 31, 1),
(656, 'Saki East', 31, 1),
(657, 'Saki West', 31, 1),
(658, 'Surulere', 31, 1),
(659, 'Barikin Ladi', 32, 1),
(660, 'Bassa', 32, 1),
(661, 'Bokkos', 32, 1),
(662, 'Jos East', 32, 1),
(663, 'Jos North', 32, 1),
(664, 'Jos South', 32, 1),
(665, 'Kanam', 32, 1),
(666, 'Kanke', 32, 1),
(667, 'Langtang North', 32, 1),
(668, 'Langtang South', 32, 1),
(669, 'Mangu', 32, 1),
(670, 'Mikang', 32, 1),
(671, 'Pankshin', 32, 1),
(672, 'Qua\'an Pan', 32, 1),
(673, 'Riyom', 32, 1),
(674, 'Shendam', 32, 1),
(675, 'Wase', 32, 1),
(676, 'Abua/Odual', 33, 1),
(677, 'Ahoada East', 33, 1),
(678, 'Ahoada West', 33, 1),
(679, 'Akuku Toru', 33, 1),
(680, 'Andoni', 33, 1),
(681, 'Asari-Toru', 33, 1),
(682, 'Bonny', 33, 1),
(683, 'Degema', 33, 1),
(684, 'Emohua', 33, 1),
(685, 'Eleme', 33, 1),
(686, 'Etche', 33, 1),
(687, 'Gokana', 33, 1),
(688, 'Ikwerre', 33, 1),
(689, 'Khana', 33, 1),
(690, 'Obia/Akpor', 33, 1),
(691, 'Ogba/Egbema/Ndoni', 33, 1),
(692, 'Ogu/Bolo', 33, 1),
(693, 'Okrika', 33, 1),
(694, 'Omumma', 33, 1),
(695, 'Opobo/Nkoro', 33, 1),
(696, 'Oyigbo', 33, 1),
(697, 'Port-Harcourt', 33, 1),
(698, 'Tai', 33, 1),
(699, 'Binji', 34, 1),
(700, 'Bodinga', 34, 1),
(701, 'Dange-shnsi', 34, 1),
(702, 'Gada', 34, 1),
(703, 'Goronyo', 34, 1),
(704, 'Gudu', 34, 1),
(705, 'Gawabawa', 34, 1),
(706, 'Illela', 34, 1),
(707, 'Isa', 34, 1),
(708, 'Kware', 34, 1),
(709, 'kebbe', 34, 1),
(710, 'Rabah', 34, 1),
(711, 'Sabon birni', 34, 1),
(712, 'Shagari', 34, 1),
(713, 'Silame', 34, 1),
(714, 'Sokoto North', 34, 1),
(715, 'Sokoto South', 34, 1),
(716, 'Tambuwal', 34, 1),
(717, 'Tqngaza', 34, 1),
(718, 'Tureta', 34, 1),
(719, 'Wamako', 34, 1),
(720, 'Wurno', 34, 1),
(721, 'Yabo', 34, 1),
(722, 'Ardo-kola', 35, 1),
(723, 'Bali', 35, 1),
(724, 'Donga', 35, 1),
(725, 'Gashaka', 35, 1),
(726, 'Cassol', 35, 1),
(727, 'Ibi', 35, 1),
(728, 'Jalingo', 35, 1),
(729, 'Karin-Lamido', 35, 1),
(730, 'Kurmi', 35, 1),
(731, 'Lau', 35, 1),
(732, 'Sardauna', 35, 1),
(733, 'Takum', 35, 1),
(734, 'Ussa', 35, 1),
(735, 'Wukari', 35, 1),
(736, 'Yorro', 35, 1),
(737, 'Zing', 35, 1),
(738, 'Bade', 36, 1),
(739, 'Bursari', 36, 1),
(740, 'Damaturu', 36, 1),
(741, 'Fika', 36, 1),
(742, 'Fune', 36, 1),
(743, 'Geidam', 36, 1),
(744, 'Gujba', 36, 1),
(745, 'Gulani', 36, 1),
(746, 'Jakusko', 36, 1),
(747, 'Karasuwa', 36, 1),
(748, 'Karawa', 36, 1),
(749, 'Machina', 36, 1),
(750, 'Nangere', 36, 1),
(751, 'Nguru Potiskum', 36, 1),
(752, 'Tarmua', 36, 1),
(753, 'Yunusari', 36, 1),
(754, 'Yusufari', 36, 1),
(755, 'Anka', 37, 1),
(756, 'Bakura', 37, 1),
(757, 'Birnin Magaji', 37, 1),
(758, 'Bukkuyum', 37, 1),
(759, 'Bungudu', 37, 1),
(760, 'Gummi', 37, 1),
(761, 'Gusau', 37, 1),
(762, 'Kaura', 37, 1),
(763, 'Namoda', 37, 1),
(764, 'Maradun', 37, 1),
(765, 'Maru', 37, 1),
(766, 'Shinkafi', 37, 1),
(767, 'Talata Mafara', 37, 1),
(768, 'Tsafe', 37, 1),
(769, 'Zurmi', 37, 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

DROP TABLE IF EXISTS `password_reset`;
CREATE TABLE IF NOT EXISTS `password_reset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(50) NOT NULL,
  `p_hash` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`id`, `user_id`, `hash`, `p_hash`, `created_on`, `status`) VALUES
(1, 1, '0329e962bf', 'DONE', '2021-04-01 15:15:19', 1),
(2, 1, 'f48125be1d', 'DONE', '2021-04-01 15:15:49', 1),
(3, 1, 'cc0d605161', 'DONE', '2021-04-01 15:16:55', 1),
(4, 1, 'a73a5ccc7d', 'DONE', '2021-04-01 15:41:03', 1),
(5, 1, '96c0c38ace', 'DONE', '2021-04-02 09:16:20', 1),
(6, 1, 'a10cf6578f', 'DONE', '2021-04-02 09:18:52', 1),
(7, 1, '68285d210a', 'DONE', '2021-04-02 09:27:30', 1),
(8, 2, 'b4c3590d57', 'DONE', '2021-04-02 22:15:13', 1),
(9, 2, 'e9a5fb7ee0', 'DONE', '2021-04-02 22:15:42', 1),
(10, 2, '865e5811c6', 'DONE', '2021-04-02 22:20:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pre_admission`
--

DROP TABLE IF EXISTS `pre_admission`;
CREATE TABLE IF NOT EXISTS `pre_admission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jamb_reg` varchar(30) NOT NULL,
  `faculty` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `jamb` text NOT NULL,
  `direct_entry` tinyint(1) NOT NULL DEFAULT '0',
  `session` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `accepted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pre_admission`
--

INSERT INTO `pre_admission` (`id`, `jamb_reg`, `faculty`, `department`, `jamb`, `direct_entry`, `session`, `status`, `accepted`) VALUES
(1, '201698733FE', '1', '1', '{\r\ndsdsds}', 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

DROP TABLE IF EXISTS `results`;
CREATE TABLE IF NOT EXISTS `results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `course_reg_id` int(11) NOT NULL,
  `practical` int(11) DEFAULT NULL,
  `test` int(11) DEFAULT NULL,
  `exam` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `result_csv`
--

DROP TABLE IF EXISTS `result_csv`;
CREATE TABLE IF NOT EXISTS `result_csv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `csv` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result_csv`
--

INSERT INTO `result_csv` (`id`, `user_id`, `csv`, `status`) VALUES
(1, 2, 'assets/uploads/propics/16174606636aa7cf1917Book1.csv', 1),
(2, 2, 'assets/uploads/propics/1617461014135099839dBook1.csv', 1),
(3, 2, 'assets/uploads/propics/16174610525e828440f0Book1.csv', 1),
(4, 2, 'assets/uploads/propics/161746109321c97baa31Book1.csv', 1),
(5, 2, 'assets/uploads/propics/1617461262fd1ecb9e65Book1.csv', 1),
(6, 2, 'assets/uploads/propics/1617461301203cb05dbbBook1.csv', 1),
(7, 2, 'assets/uploads/propics/1617461314998915d42fBook1.csv', 1),
(8, 2, 'assets/uploads/propics/16175426519ada85a873Book1.csv', 1),
(9, 2, 'assets/uploads/propics/16175428135cf365d338Book1.csv', 1),
(10, 2, 'assets/uploads/csv/result/161754290814f2dfa211Book1.csv', 1),
(11, 2, 'assets/uploads/csv/result/1617543257d043c1cf6aBook1.csv', 1),
(12, 2, 'assets/uploads/csv/result/1617543352549e4e78e9Book1.csv', 1),
(13, 2, 'assets/uploads/csv/result/1617543356e8329a8654Book1.csv', 1),
(14, 2, 'assets/uploads/csv/result/16175434252eae2f0432Book1.csv', 1),
(15, 2, 'assets/uploads/csv/result/16175434443fd92c81fdBook1.csv', 1),
(16, 2, 'assets/uploads/csv/result/16175435300c2e5f6cf3Book1.csv', 1),
(17, 2, 'assets/uploads/csv/result/16175435598c5a35b9afBook1.csv', 1),
(18, 2, 'assets/uploads/csv/result/1617543573a9be195ec0Book1.csv', 1),
(19, 2, 'assets/uploads/csv/result/16175435787c13ff6d46Book1.csv', 1),
(20, 2, 'assets/uploads/csv/result/1617543625bd9067da91Book1.csv', 1),
(21, 2, 'assets/uploads/csv/result/1617543657fe28906d9cBook1.csv', 1),
(22, 2, 'assets/uploads/csv/result/161754371584f56c46f2Book1.csv', 1),
(23, 2, 'assets/uploads/csv/result/1617543735833ab5771eBook1.csv', 1),
(24, 2, 'assets/uploads/csv/result/16175437696a5b348364Book1.csv', 1),
(25, 2, 'assets/uploads/csv/result/1617543781e2554d3283Book1.csv', 1),
(26, 2, 'assets/uploads/csv/result/16175438311d94d3222aBook1.csv', 1),
(27, 2, 'assets/uploads/csv/result/16175443763483eb15ccBook1.csv', 1),
(28, 2, 'assets/uploads/csv/result/1617544395fecc197f39Book1.csv', 1),
(29, 2, 'assets/uploads/csv/result/16175444099c32d999b7Book1.csv', 1),
(30, 2, 'assets/uploads/csv/result/16175444257e3624e063Book1.csv', 1),
(31, 2, 'assets/uploads/csv/result/1617544444ee93e41a01Book1.csv', 1),
(32, 2, 'assets/uploads/csv/result/1617544462fc5fd6cd4cBook1.csv', 1),
(33, 2, 'assets/uploads/csv/result/1617544479e3bba6e1eaBook1.csv', 1),
(34, 2, 'assets/uploads/csv/result/1617544531c2b5b20165Book1.csv', 1),
(35, 2, 'assets/uploads/csv/result/1617544541b71e728723Book1.csv', 1),
(36, 2, 'assets/uploads/csv/result/16175445531225948c7aBook1.csv', 1),
(37, 2, 'assets/uploads/csv/result/1617544568e8c15b88c4Book1.csv', 1),
(38, 2, 'assets/uploads/csv/result/161754458009c6c27cc4Book1.csv', 1),
(39, 2, 'assets/uploads/csv/result/161761647196b33f21a7Book1.csv', 1),
(40, 2, 'assets/uploads/csv/result/16176165884655b875feBook1.csv', 1),
(41, 2, 'assets/uploads/csv/result/1617616995e40e200105Book1.csv', 1),
(42, 2, 'assets/uploads/csv/result/16176170921de592e6acBook1.csv', 1),
(43, 2, 'assets/uploads/csv/result/1617617118b955d61ce2Book1.csv', 1),
(44, 2, 'assets/uploads/csv/result/1617617232d894fff5e5Book1.csv', 1),
(45, 2, 'assets/uploads/csv/result/16176173067bd08cd554Book1.csv', 1),
(46, 2, 'assets/uploads/csv/result/161761790140064351a5Book1.csv', 1),
(47, 2, 'assets/uploads/csv/result/1617617902d390a5dbc7Book1.csv', 1),
(48, 2, 'assets/uploads/csv/result/161765343571bb90f1c2Book1.csv', 1),
(49, 2, 'assets/uploads/csv/result/1617653604f8f08df619Book1.csv', 1),
(50, 2, 'assets/uploads/csv/result/1617653715a0ae547339Book1.csv', 1),
(51, 2, 'assets/uploads/csv/result/1617653756a6321717f9Book1.csv', 1),
(52, 2, 'assets/uploads/csv/result/16176538549e7b8bb19eBook1.csv', 1);

-- --------------------------------------------------------

--
-- Table structure for table `school_decision`
--

DROP TABLE IF EXISTS `school_decision`;
CREATE TABLE IF NOT EXISTS `school_decision` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hostel` int(11) NOT NULL,
  `school_fee` int(11) NOT NULL,
  `siwes` int(11) NOT NULL,
  `acceptance` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_decision`
--

INSERT INTO `school_decision` (`id`, `hostel`, `school_fee`, `siwes`, `acceptance`, `status`) VALUES
(1, 20000, 50000, 700, 4000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `school_fee_breakdown`
--

DROP TABLE IF EXISTS `school_fee_breakdown`;
CREATE TABLE IF NOT EXISTS `school_fee_breakdown` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_fee_breakdown`
--

INSERT INTO `school_fee_breakdown` (`id`, `type`, `amount`, `status`) VALUES
(1, 'STUDENTS HEALTH INSURANCE/MEDICAL', 5000, 1),
(2, 'STUDENTS HEALTH INSURANCE/MEDICAL', 40000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `school_session`
--

DROP TABLE IF EXISTS `school_session`;
CREATE TABLE IF NOT EXISTS `school_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `semester` enum('FIRST SEMESTER','SECOND SEMESTER') NOT NULL,
  `semester_code` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-inactive, 1-active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_session`
--

INSERT INTO `school_session` (`id`, `name`, `semester`, `semester_code`, `status`) VALUES
(1, '2020/2021', 'FIRST SEMESTER', 1, 1),
(3, '2021/2022', 'FIRST SEMESTER', 1, 0),
(4, '2021/2022', 'SECOND SEMESTER', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(120) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `user_id`, `hash`, `user_agent`, `ip`, `created_on`) VALUES
(1, 1, '631c03132f482543b46d644aa48250cada494f7afc8c1d0b35a77bb9b5f0fc28', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', '::1', '2021-04-07 08:02:37'),
(2, 2, '3e3af4768b077fcddfdb5bf06a9da5576989725334f26423691efde6ba18a863', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', '::1', '2021-04-07 08:11:57');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `country_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `name`, `country_id`, `status`) VALUES
(1, 'Abia', 1, 1),
(2, 'Adamawa', 1, 1),
(3, 'Anambra', 1, 1),
(4, 'Akwa Ibom', 1, 1),
(5, 'Bauchi', 1, 1),
(6, 'Bayelsa', 1, 1),
(7, 'Benue', 1, 1),
(8, 'Borno', 1, 1),
(9, 'Cross River', 1, 1),
(10, 'Delta', 1, 1),
(11, 'Ebonyi', 1, 1),
(12, 'Enugu', 1, 1),
(13, 'Edo', 1, 1),
(14, 'Ekiti', 1, 1),
(15, 'FCT - Abuja', 1, 1),
(16, 'Gombe', 1, 1),
(17, 'Imo', 1, 1),
(18, 'Jigawa', 1, 1),
(19, 'Kaduna', 1, 1),
(20, 'Kano', 1, 1),
(21, 'Katsina', 1, 1),
(22, 'Kebbi', 1, 1),
(23, 'Kogi', 1, 1),
(24, 'Kwara', 1, 1),
(25, 'Lagos', 1, 1),
(26, 'Nasarawa', 1, 1),
(27, 'Niger', 1, 1),
(28, 'Ogun', 1, 1),
(29, 'Ondo', 1, 1),
(30, 'Osun', 1, 1),
(31, 'Oyo', 1, 1),
(32, 'Plateau', 1, 1),
(33, 'Rivers', 1, 1),
(34, 'Sokoto', 1, 1),
(35, 'Taraba', 1, 1),
(36, 'Yobe', 1, 1),
(37, 'Zamfara', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `mname` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `photo` text,
  `sex` enum('male','female','other') NOT NULL,
  `dob` varchar(50) NOT NULL,
  `reg_no` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `type` enum('student','lecturer','admin') NOT NULL DEFAULT 'student',
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `local_government` varchar(100) NOT NULL,
  `blood_group` varchar(5) NOT NULL,
  `genotype` varchar(5) NOT NULL,
  `faculty` int(11) DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `phone1` varchar(50) NOT NULL,
  `sponsor_name` varchar(100) DEFAULT NULL,
  `sponsor_email` varchar(100) DEFAULT NULL,
  `sponsor_phone` varchar(100) DEFAULT NULL,
  `sponsor_address` varchar(255) DEFAULT NULL,
  `sponsor_relationship` varchar(50) DEFAULT NULL,
  `nok_name` varchar(100) NOT NULL,
  `nok_email` varchar(100) NOT NULL,
  `nok_phone` varchar(100) NOT NULL,
  `nok_address` varchar(255) NOT NULL,
  `nok_relationship` varchar(50) NOT NULL,
  `medical_record` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `mname`, `email`, `photo`, `sex`, `dob`, `reg_no`, `password`, `type`, `address1`, `address2`, `nationality`, `state`, `local_government`, `blood_group`, `genotype`, `faculty`, `department`, `level`, `phone1`, `sponsor_name`, `sponsor_email`, `sponsor_phone`, `sponsor_address`, `sponsor_relationship`, `nok_name`, `nok_email`, `nok_phone`, `nok_address`, `nok_relationship`, `medical_record`, `status`) VALUES
(1, 'bube', 'chibuzo', '', 'test@test.com', 'assets/uploads/propics/16172252714f05773f1cw_KyzoYy.jpg', 'male', '0011-11-11', '20161966093', '$2y$12$d1hICD0IVEFYCXaj//2Pt.7XahkyohoJiYkaMT6F9QRF9vCI8V0zO', 'student', 'mfedkfdjkvnjknvdnjk', 'kjfnjkdnfjkdnjkfdjkfndjkfnjkdfn', '1', '17', '288', 'O+', 'AA', 1, 1, 1, '08108506562', 'nn', 'nkkkn', 'jnknjk', 'kkklkkmlk', 'father', 'kkmlkmlmkl', 'kmklmlkmlkm', 'klmkmklm', 'kmklmmmlmk', 'brother', '', 1),
(2, 'lec', 'turer', '', 'a@a.com', NULL, 'male', '0111-11-11', NULL, '$2y$12$MzccI8Y8HlT6z7a6xXAN.u46fZaNMPePr9PTEvnlEOOVuCXeY4mIu', 'admin', 'fefedfef', 'fefefrf', '1', '2', '19', 'O+', 'AA', 1, 1, 1, '08108506562', 'bibi', 'brbrbr', 'brrbr', 'eferregreer', 'erre', 'rrgrg', 'rrgregr', 'grgreg', 'rgrgrg', 'mother', 'grgrg', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
