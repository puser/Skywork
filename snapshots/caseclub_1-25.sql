-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 50.63.229.113
-- Generation Time: Jan 25, 2012 at 09:09 AM
-- Server version: 5.0.92
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `caseclub`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` int(11) NOT NULL auto_increment,
  `challenge_id` int(11) default NULL,
  `user_id` int(11) default NULL,
  `file_location` varchar(150) default NULL,
  `name` varchar(100) default NULL,
  `type` enum('D','C','R') default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` VALUES(20, 12, 15, '72f3ff99b8d39d2f9ac17dd95d27b7b7.PDF', 'Ingvar Kamprad and IKEA.PDF', 'C');
INSERT INTO `attachments` VALUES(21, 13, 17, 'f84a04e755c85c32db1535660535a208.PDF', 'Ingvar Kamprad and IKEA.PDF', 'C');
INSERT INTO `attachments` VALUES(22, 15, 15, '7580644ccb37f51525ddd29d2fba8fd7.PDF', 'Ingvar Kamprad and IKEA.PDF', 'C');
INSERT INTO `attachments` VALUES(23, 12, 18, 'b63bfb8689588e3a79807ca557a22975.PDF', 'file name', 'R');
INSERT INTO `attachments` VALUES(24, 18, 16, '375f79513d0dac410152792a3cb82c45.PDF', 'Matching DELL Computer.PDF', 'C');
INSERT INTO `attachments` VALUES(25, 23, 15, 'd7894841eef0aeacbb47a56a907c3be8.PDF', 'Ingvar Kamprad and IKEA.PDF', 'C');
INSERT INTO `attachments` VALUES(26, 23, 15, 'bd13ea5f876749acd59b999145be9ec2.mobileprovision', 'the name of this file.', 'R');
INSERT INTO `attachments` VALUES(27, 23, 17, 'd5ea23b6581a93cb483196a8e78c228f.jar', 'file name', 'R');
INSERT INTO `attachments` VALUES(28, 23, 17, '29d478b3587b919e66c52213e5e1ef78.jpg', 'new file name', 'R');
INSERT INTO `attachments` VALUES(29, 24, 15, '93d72de7650904e30f016b874fa1e5b1.PDF', 'Ingvar Kamprad and IKEA.PDF', 'C');
INSERT INTO `attachments` VALUES(30, 24, 15, '082c6f866857193d26cce795d4fd59db.pdf', 'test file upload', 'R');
INSERT INTO `attachments` VALUES(31, 24, 15, '6b45c8dc6c7cd01803c439588a6029b5.jpg', 'second test file upload', 'R');
INSERT INTO `attachments` VALUES(34, 25, 15, 'e814ad93c4b17558d9782ae1d15ec69f.cnf', 'test attach', 'R');
INSERT INTO `attachments` VALUES(33, 24, 16, '376f783ede78405716fa75b07ba66ff4.pdf', 'Google ', 'R');
INSERT INTO `attachments` VALUES(35, 26, 15, '212ccaf160ffedd23bb29a437bfc52d3.PDF', 'Ingvar Kamprad and IKEA.PDF', 'C');
INSERT INTO `attachments` VALUES(36, 27, 16, '2f0662703e9d61c03aa16acc51e67d7d.PDF', 'Fire at Mann Gulch.PDF', 'C');
INSERT INTO `attachments` VALUES(37, 28, 16, 'e257ba207dfdea948c9fbd6d7214200d.PDF', 'P&G-GBS.PDF', 'C');
INSERT INTO `attachments` VALUES(38, 29, 15, 'e98cc11b5a4c01a95f58023324829883.PDF', 'Ingvar Kamprad and IKEA.PDF', 'C');
INSERT INTO `attachments` VALUES(39, 29, 15, '9d2c11f1d2c3582001dff02cd4d491b2.pdf', 'brinca 12-21.pdf', 'D');
INSERT INTO `attachments` VALUES(40, 30, 19, 'fef0e8aa1fd888af31d74cd216e6cfbe.pdf', 'Los Chanceros PDF.pdf', 'C');
INSERT INTO `attachments` VALUES(44, 30, 15, 'b41cd3222f02e22b78194e2a587bdfab.pdf', 'attachment', 'R');
INSERT INTO `attachments` VALUES(42, 30, 19, '166f6af9dede6be762ffc73d6c078ffa.pdf', 'Document 2', 'R');
INSERT INTO `attachments` VALUES(43, 30, 19, '4a3cc424896c08c5c4bea34ce15355a9.pdf', 'Document 1', 'R');
INSERT INTO `attachments` VALUES(50, 42, 19, '2af823c8a58ae6e8bcca1169b6f39a97.docx', 'Test Case.docx', 'C');
INSERT INTO `attachments` VALUES(49, 37, 19, 'bfc504428987e8406ff66038e5faa7a1.PDF', 'P&G-GBS.PDF', 'C');
INSERT INTO `attachments` VALUES(47, 34, 19, '5c5ed733b682975f289e9face04e3567.docx', 'Explanation', 'R');
INSERT INTO `attachments` VALUES(48, 35, 15, '17117070d66d20ecdac4feadbb192f61.pdf', 'iBookstoreAssetGuide.pdf', 'C');
INSERT INTO `attachments` VALUES(56, 57, 19, '515f311806c9c0635be7ddd802ef9520.docx', 'Test Case.docx', 'C');
INSERT INTO `attachments` VALUES(55, 54, 19, '80a075168c8c9a58a89940687c836fa5.docx', 'Test Case.docx', 'C');
INSERT INTO `attachments` VALUES(57, 58, 19, 'c992ad00e907edd41e11c1c2af3360e6.docx', 'Test Case.docx', 'C');
INSERT INTO `attachments` VALUES(58, 58, 19, '5522d7e0d4606876f96ab6a4469706cd.docx', 'Explanation', 'R');
INSERT INTO `attachments` VALUES(59, 64, 15, 'bc9c7002bc1bf8c40e59ada1c619b7e7.PDF', 'Ingvar Kamprad and IKEA.PDF', 'C');
INSERT INTO `attachments` VALUES(60, 67, 19, '8e1c6b54549f9ff69a20b9a8f34627ec.docx', 'Test Case.docx', 'C');
INSERT INTO `attachments` VALUES(61, 70, 15, '404b138b0602bf5a0a62e3e64c026735.PDF', 'Ingvar Kamprad and IKEA.PDF', 'C');
INSERT INTO `attachments` VALUES(62, 70, 19, '4f03ce0ca0a2cb3fbcde3a5398c535ae.jpg', 'a koala for your viewing pleasure', 'R');
INSERT INTO `attachments` VALUES(63, 70, 19, '6fab5a3b41d8309b5ce872b4ec2ea830.jpg', 'and penguins', 'R');

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--

CREATE TABLE `challenges` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `challenge_type` enum('T','N','A') default NULL,
  `allow_attachments` tinyint(4) default NULL,
  `name` varchar(100) default NULL,
  `answers_due` date default NULL,
  `responses_due` date default NULL,
  `status` enum('D','C') default NULL,
  `date_created` timestamp NULL default NULL,
  `date_modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `challenges`
--

INSERT INTO `challenges` VALUES(28, 16, 'N', 1, '8765re', '2011-12-28', '2011-12-29', 'C', NULL, '2011-12-28 12:01:43');
INSERT INTO `challenges` VALUES(27, 16, 'N', 0, 'asdf', '2011-12-22', '2011-12-23', 'D', NULL, '2011-12-22 13:16:17');
INSERT INTO `challenges` VALUES(26, 15, 'A', 1, 'Anonymous Challenge', '2011-12-21', '2011-12-23', 'C', '2011-12-22 01:33:19', '2011-12-22 01:33:19');
INSERT INTO `challenges` VALUES(25, 15, 'A', 1, 'testing ui changes', '2011-12-23', '2011-12-26', 'C', NULL, '2011-12-21 02:56:14');
INSERT INTO `challenges` VALUES(24, 15, 'N', 1, 'Ben & Sean Test Challenge', '2011-12-15', '2011-12-19', 'C', '2011-12-20 15:23:41', '2011-12-20 15:23:41');
INSERT INTO `challenges` VALUES(18, 16, 'N', 1, 'Sean Challenge Test 2', '2011-11-25', '2011-12-10', 'C', NULL, '2011-12-11 12:23:20');
INSERT INTO `challenges` VALUES(19, 16, 'T', 1, 'Test2', '2011-12-28', '2012-01-20', 'C', NULL, '2012-01-20 03:56:29');
INSERT INTO `challenges` VALUES(20, 16, 'N', 1, '56476', '2011-12-15', '2011-12-17', 'C', NULL, '2011-12-13 12:32:44');
INSERT INTO `challenges` VALUES(38, 19, 'N', NULL, 'ytgfhggsfasd', '2012-01-09', '2012-01-20', 'C', NULL, '2012-01-20 03:56:29');
INSERT INTO `challenges` VALUES(22, 15, 'N', NULL, 'redundant group test', '2011-12-13', '2012-01-20', 'C', NULL, '2012-01-20 03:56:29');
INSERT INTO `challenges` VALUES(23, 15, 'N', 1, 'invitation testing', '2011-12-14', '2011-12-22', 'C', '2011-12-20 15:30:29', '2011-12-20 15:30:29');
INSERT INTO `challenges` VALUES(29, 15, 'N', 1, 'test draft challenge (no template)', '2012-01-03', '2012-01-05', 'C', NULL, '2012-01-01 12:04:30');
INSERT INTO `challenges` VALUES(30, 19, 'N', 1, 'Alpha Final', '2011-12-30', '2012-01-02', 'C', '2012-01-02 01:21:57', '2012-01-02 01:21:57');
INSERT INTO `challenges` VALUES(31, 19, 'T', 0, '', '2012-01-15', '2012-01-20', 'C', NULL, '2012-01-20 03:56:29');
INSERT INTO `challenges` VALUES(32, 19, 'N', NULL, 'fhjgjkh', '2012-01-03', '2012-01-20', 'C', NULL, '2012-01-20 03:56:29');
INSERT INTO `challenges` VALUES(37, 19, 'N', 1, 'XYZ Challenge', '2012-01-09', '2012-01-10', 'C', NULL, '2012-01-09 18:25:27');
INSERT INTO `challenges` VALUES(34, 19, 'N', 1, 'Test Challenge 3', '2012-01-04', '2012-01-20', 'C', NULL, '2012-01-20 03:56:29');
INSERT INTO `challenges` VALUES(35, 15, 'N', 0, 'testing invitations', '2012-01-05', '2012-01-16', 'C', '2012-01-06 03:28:02', '2012-01-06 03:28:02');
INSERT INTO `challenges` VALUES(39, 15, 'N', 0, 'test challenge for 1/10', '2012-01-09', '2012-01-12', 'C', '2012-01-10 05:15:22', '2012-01-10 05:15:22');
INSERT INTO `challenges` VALUES(40, 15, 'N', 0, 'test save', '2012-01-10', '2012-01-20', 'C', NULL, '2012-01-20 03:56:29');
INSERT INTO `challenges` VALUES(42, 19, 'N', 0, 'Test For Emails', '2012-01-11', '2012-01-13', 'C', NULL, '2012-01-10 06:56:54');
INSERT INTO `challenges` VALUES(48, 15, 'T', 1, 'test template', '2012-01-13', '2012-01-20', 'C', NULL, '2012-01-20 03:56:29');
INSERT INTO `challenges` VALUES(51, 15, 'N', 1, 'test template', '2012-01-13', '2012-01-20', 'C', NULL, '2012-01-20 03:56:29');
INSERT INTO `challenges` VALUES(52, 18, 'T', NULL, '', '2012-01-13', '2012-01-20', 'D', NULL, '2012-01-20 03:56:29');
INSERT INTO `challenges` VALUES(53, 18, 'T', NULL, '', '2012-01-13', '2012-01-20', 'D', NULL, '2012-01-20 03:56:29');
INSERT INTO `challenges` VALUES(54, 19, 'N', 0, 'Example Name', '2012-01-13', '2012-01-20', 'C', NULL, '2012-01-20 03:56:29');
INSERT INTO `challenges` VALUES(58, 19, 'N', 1, 'Testing CCO Create Challenge 2', '2012-01-16', '2012-01-17', 'C', '2012-01-17 03:40:45', '2012-01-17 03:40:45');
INSERT INTO `challenges` VALUES(57, 19, 'A', 1, 'Testing CCO Create Challenge 1', '2012-01-15', '2012-01-16', 'C', NULL, '2012-01-15 09:45:06');
INSERT INTO `challenges` VALUES(59, 19, 'N', NULL, 'Testing CCO Create Challenge 3', '2012-01-15', '2012-01-20', 'C', NULL, '2012-01-20 03:56:29');
INSERT INTO `challenges` VALUES(61, 19, 'N', 0, 'Test different browser: Safari', '2012-01-16', '2012-01-20', 'C', NULL, '2012-01-20 03:56:29');
INSERT INTO `challenges` VALUES(69, 19, 'N', 1, 'Test Challenge Notifications', '2012-01-24', '2012-01-24', 'C', NULL, '2012-01-24 05:44:36');
INSERT INTO `challenges` VALUES(64, 15, 'N', 1, 'testing validation', '2012-01-19', '2012-01-21', 'C', NULL, '2012-01-17 02:39:04');
INSERT INTO `challenges` VALUES(67, 19, 'N', 1, 'Testing Agree/Disagree w Ben', '2012-01-21', '2012-01-23', 'C', '2012-01-23 16:34:36', '2012-01-23 16:34:36');
INSERT INTO `challenges` VALUES(68, 19, 'N', 0, 'Test Receive or Not Receive Email', '2012-01-21', '2012-01-21', 'C', NULL, '2012-01-21 14:51:35');
INSERT INTO `challenges` VALUES(70, 15, 'N', 1, 'IE browser test template', '2012-01-24', '2012-01-25', 'C', NULL, '2012-01-24 14:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `challenges_groups`
--

CREATE TABLE `challenges_groups` (
  `challenge_id` int(11) NOT NULL default '0',
  `group_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`challenge_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `challenges_groups`
--

INSERT INTO `challenges_groups` VALUES(18, 5);
INSERT INTO `challenges_groups` VALUES(18, 6);
INSERT INTO `challenges_groups` VALUES(20, 5);
INSERT INTO `challenges_groups` VALUES(22, 4);
INSERT INTO `challenges_groups` VALUES(23, 6);
INSERT INTO `challenges_groups` VALUES(24, 7);
INSERT INTO `challenges_groups` VALUES(25, 4);
INSERT INTO `challenges_groups` VALUES(26, 7);
INSERT INTO `challenges_groups` VALUES(28, 7);
INSERT INTO `challenges_groups` VALUES(30, 7);
INSERT INTO `challenges_groups` VALUES(32, 10);
INSERT INTO `challenges_groups` VALUES(34, 9);
INSERT INTO `challenges_groups` VALUES(35, 9);
INSERT INTO `challenges_groups` VALUES(37, 5);
INSERT INTO `challenges_groups` VALUES(38, 5);
INSERT INTO `challenges_groups` VALUES(38, 6);
INSERT INTO `challenges_groups` VALUES(38, 9);
INSERT INTO `challenges_groups` VALUES(39, 7);
INSERT INTO `challenges_groups` VALUES(42, 7);
INSERT INTO `challenges_groups` VALUES(48, 9);
INSERT INTO `challenges_groups` VALUES(48, 10);
INSERT INTO `challenges_groups` VALUES(51, 4);
INSERT INTO `challenges_groups` VALUES(51, 19);
INSERT INTO `challenges_groups` VALUES(57, 7);
INSERT INTO `challenges_groups` VALUES(58, 7);
INSERT INTO `challenges_groups` VALUES(61, 13);
INSERT INTO `challenges_groups` VALUES(64, 13);
INSERT INTO `challenges_groups` VALUES(67, 7);
INSERT INTO `challenges_groups` VALUES(68, 7);
INSERT INTO `challenges_groups` VALUES(69, 7);
INSERT INTO `challenges_groups` VALUES(70, 7);
INSERT INTO `challenges_groups` VALUES(70, 10);

-- --------------------------------------------------------

--
-- Table structure for table `challenge_questions`
--

CREATE TABLE `challenge_questions` (
  `id` int(11) NOT NULL auto_increment,
  `challenge_id` int(11) default NULL,
  `section` varchar(150) default NULL,
  `question` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=127 ;

--
-- Dumping data for table `challenge_questions`
--

INSERT INTO `challenge_questions` VALUES(70, 26, 'First', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit?');
INSERT INTO `challenge_questions` VALUES(98, 39, 'question 1', 'first question goes here?');
INSERT INTO `challenge_questions` VALUES(66, 25, 'test question', 'question question question?');
INSERT INTO `challenge_questions` VALUES(67, 25, 'other question', 'question. question question?');
INSERT INTO `challenge_questions` VALUES(64, 24, 'Final Question', 'This is a third question for the test challenge.');
INSERT INTO `challenge_questions` VALUES(63, 24, 'Another Question', 'Here is a second question. Answer in the space provided.');
INSERT INTO `challenge_questions` VALUES(62, 24, 'Challenge Theme', 'This is a question regarding the challenge. Provide some test data?');
INSERT INTO `challenge_questions` VALUES(43, 18, 'Question 1', 'This is Question 1');
INSERT INTO `challenge_questions` VALUES(44, 18, 'Question 2', 'This is Question 2');
INSERT INTO `challenge_questions` VALUES(45, 18, 'Question 3', 'This is Question 3');
INSERT INTO `challenge_questions` VALUES(46, 18, 'Question 4', 'This is Question 4');
INSERT INTO `challenge_questions` VALUES(47, 18, 'This is Question 5', '');
INSERT INTO `challenge_questions` VALUES(48, 18, 'This is Question 6', '');
INSERT INTO `challenge_questions` VALUES(49, 18, 'This is Question 7', '');
INSERT INTO `challenge_questions` VALUES(50, 19, 'Test', 'Test 1');
INSERT INTO `challenge_questions` VALUES(97, 37, 'Different', 'What could they have done differently to make a better decision?');
INSERT INTO `challenge_questions` VALUES(54, 20, '32456', 'wsdgfh');
INSERT INTO `challenge_questions` VALUES(58, 23, 'question one', 'why does something something?');
INSERT INTO `challenge_questions` VALUES(59, 23, 'question two', 'how can something something?');
INSERT INTO `challenge_questions` VALUES(96, 37, 'Decisions', 'Did the company make the right decision?');
INSERT INTO `challenge_questions` VALUES(74, 27, '68787', 'hgfjkfhkhjgkjhkf');
INSERT INTO `challenge_questions` VALUES(71, 26, 'Second', 'Nam convallis turpis eget elit malesuada a vulputate neque fermentum?');
INSERT INTO `challenge_questions` VALUES(72, 26, 'Third', 'Aenean et orci lorem, ac fringilla magna. Maecenas at odio sapien?');
INSERT INTO `challenge_questions` VALUES(78, 28, '987654', '098765432');
INSERT INTO `challenge_questions` VALUES(79, 28, '09876543', '098765432');
INSERT INTO `challenge_questions` VALUES(82, 30, 'A Question', 'What is this?');
INSERT INTO `challenge_questions` VALUES(83, 30, 'This is Question 2?', 'What is this?');
INSERT INTO `challenge_questions` VALUES(84, 30, 'This is Question 3?', 'What is this?');
INSERT INTO `challenge_questions` VALUES(92, 35, 'test question', 'question question?');
INSERT INTO `challenge_questions` VALUES(86, 29, 'q1 test', 'question question?');
INSERT INTO `challenge_questions` VALUES(95, 37, 'Your Thoughts', 'What are your initial thoughts on this case? ');
INSERT INTO `challenge_questions` VALUES(93, 35, 'question', 'next test question');
INSERT INTO `challenge_questions` VALUES(94, 35, 'testing', 'test for the back button navigation');
INSERT INTO `challenge_questions` VALUES(99, 39, 'question two', 'Second Test Question?');
INSERT INTO `challenge_questions` VALUES(102, 42, 'A question', 'A question 1 A question 1 A question 1 A question 1 A question 1 A question 1');
INSERT INTO `challenge_questions` VALUES(110, 51, 'q1', 'q1');
INSERT INTO `challenge_questions` VALUES(126, 48, 'q2 templ updated', 'tpl submit test');
INSERT INTO `challenge_questions` VALUES(111, 57, 'Question 1', 'Question 1 Question');
INSERT INTO `challenge_questions` VALUES(112, 58, 'Quesiton 1', 'Question 1 Question');
INSERT INTO `challenge_questions` VALUES(113, 58, 'Pregunta NÃºmero Dos', 'Â¿QuÃ© piensas de la situaciÃ³n en Iraq?');
INSERT INTO `challenge_questions` VALUES(114, 58, 'Uy', 'Â¿Donde estÃ¡ la biblioteca?');
INSERT INTO `challenge_questions` VALUES(115, 58, 'Tengo hambre', 'Â¿Me pasas esa hamburguesa? Â¡Que tengo hambre!');
INSERT INTO `challenge_questions` VALUES(116, 61, '234565768', '23456768');
INSERT INTO `challenge_questions` VALUES(118, 64, 'q1', 'validated.');
INSERT INTO `challenge_questions` VALUES(119, 64, 'q2', 'question?');
INSERT INTO `challenge_questions` VALUES(120, 67, 'Question 1', 'Question 1 Question');
INSERT INTO `challenge_questions` VALUES(121, 67, 'Question 2', 'Question 2 Question');
INSERT INTO `challenge_questions` VALUES(122, 68, 'Example Question', 'dsfad');
INSERT INTO `challenge_questions` VALUES(123, 69, 'Question 1', 'Question 1 Question');
INSERT INTO `challenge_questions` VALUES(124, 70, 'q1', 'q1 first question');
INSERT INTO `challenge_questions` VALUES(125, 70, 'second', 'second question');
INSERT INTO `challenge_questions` VALUES(107, 48, 'q1', 'q1');

-- --------------------------------------------------------

--
-- Table structure for table `challenge_responses`
--

CREATE TABLE `challenge_responses` (
  `id` int(11) NOT NULL auto_increment,
  `question_id` int(11) default NULL,
  `response_id` int(11) default NULL,
  `user_id` int(11) default NULL,
  `response_type` enum('A','D') default NULL,
  `response_body` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=179 ;

--
-- Dumping data for table `challenge_responses`
--

INSERT INTO `challenge_responses` VALUES(13, 23, NULL, 15, NULL, 'Here is a test response. The quick brown fox jumps over the lazy dog. This is a response.\n\nMore text can go on different lines.');
INSERT INTO `challenge_responses` VALUES(14, 24, NULL, 15, NULL, 'This is the response to the second question. \n\nLorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.\n\nLorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.');
INSERT INTO `challenge_responses` VALUES(15, NULL, 13, 17, 'D', 'here\\''s some text regarding why I disagree');
INSERT INTO `challenge_responses` VALUES(16, NULL, 14, 17, 'A', '');
INSERT INTO `challenge_responses` VALUES(17, 19, NULL, 18, NULL, 'Response text.\n\nResponse text.');
INSERT INTO `challenge_responses` VALUES(18, 20, NULL, 18, NULL, 'test');
INSERT INTO `challenge_responses` VALUES(19, 21, NULL, 18, NULL, 'test');
INSERT INTO `challenge_responses` VALUES(20, NULL, 13, 18, 'D', 'this is why i disagree');
INSERT INTO `challenge_responses` VALUES(21, NULL, 14, 18, 'A', 'this why i agree');
INSERT INTO `challenge_responses` VALUES(22, NULL, 14, 18, NULL, NULL);
INSERT INTO `challenge_responses` VALUES(23, NULL, 14, 18, NULL, NULL);
INSERT INTO `challenge_responses` VALUES(24, 31, NULL, 16, NULL, 'Test quesiton');
INSERT INTO `challenge_responses` VALUES(25, 58, NULL, 15, NULL, 'because of lots of different reasons.');
INSERT INTO `challenge_responses` VALUES(26, 59, NULL, 15, NULL, 'by doing some things in a specific way.');
INSERT INTO `challenge_responses` VALUES(27, 58, NULL, 17, NULL, 'here are some reasons:\n\n1) because something something something\n2) for another reason, too');
INSERT INTO `challenge_responses` VALUES(28, 59, NULL, 17, NULL, 'this can be done in a certain way.\n\nhere are some details:\n1) detail one\n2) second detail');
INSERT INTO `challenge_responses` VALUES(29, NULL, 27, 18, 'A', 'this is a good answer!');
INSERT INTO `challenge_responses` VALUES(30, NULL, 28, 18, 'A', 'another good answer!!');
INSERT INTO `challenge_responses` VALUES(31, NULL, 25, 18, 'D', 'i don\\''t like this one,');
INSERT INTO `challenge_responses` VALUES(32, NULL, 26, 18, 'D', 'this is terrible too');
INSERT INTO `challenge_responses` VALUES(33, 62, NULL, 15, NULL, 'This is my response to the first question. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales sapien a erat faucibus sed suscipit lacus dapibus. Nulla congue, nisi faucibus luctus pretium, neque nulla euismod massa, eu mollis massa felis vel ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam ligula enim, vestibulum at interdum sed, tincidunt nec felis. In pretium feugiat magna vitae porttitor. Cras lobortis elementum neque ac tincidunt. Nunc mollis lorem ac lacus luctus mattis molestie tortor tincidunt. Sed egestas, ligula in fermentum vestibulum, urna turpis ultrices quam, nec porta neque arcu vel risus. Donec nisl augue, blandit cursus hendrerit sit amet, euismod id nibh. Quisque at nunc nec nulla mattis pulvinar. Etiam ullamcorper ultricies massa, sed semper nunc vehicula vel. Cras eu mi dui. Donec elementum, nisi eu ornare bibendum, lectus nunc ornare eros, convallis pharetra nunc tortor sed arcu. Morbi a ligula urna, ornare porttitor mi. Vivamus vitae libero nibh, vitae adipiscing justo.');
INSERT INTO `challenge_responses` VALUES(34, 63, NULL, 15, NULL, 'Morbi egestas imperdiet pulvinar. Integer nibh nisl, faucibus nec tempus vitae, mattis eu est. Vestibulum sed lorem eu elit tincidunt aliquam. Nulla quis nisl eros. Duis vitae ultricies quam. Cras pharetra mauris vel nisi pellentesque sit amet tincidunt orci hendrerit. Duis fermentum augue ante, quis ultrices erat. Donec vitae turpis metus, sit amet placerat elit. Morbi sapien orci, vestibulum eget tincidunt at, semper id nunc. Phasellus ante nibh, sagittis a adipiscing et, porta nec odio. Sed ut lectus id ipsum congue rhoncus ac vitae felis. Nunc ante neque, ullamcorper nec tristique eu, posuere ut urna. Etiam faucibus dolor et lacus placerat laoreet. Suspendisse ornare quam sed mauris consectetur quis suscipit turpis tincidunt. Sed cursus ultricies felis vitae pulvinar.');
INSERT INTO `challenge_responses` VALUES(35, 62, NULL, 15, NULL, 'This is my response to the first question. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales sapien a erat faucibus sed suscipit lacus dapibus. Nulla congue, nisi faucibus luctus pretium, neque nulla euismod massa, eu mollis massa felis vel ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam ligula enim, vestibulum at interdum sed, tincidunt nec felis. In pretium feugiat magna vitae porttitor. Cras lobortis elementum neque ac tincidunt. Nunc mollis lorem ac lacus luctus mattis molestie tortor tincidunt. Sed egestas, ligula in fermentum vestibulum, urna turpis ultrices quam, nec porta neque arcu vel risus. Donec nisl augue, blandit cursus hendrerit sit amet, euismod id nibh. Quisque at nunc nec nulla mattis pulvinar. Etiam ullamcorper ultricies massa, sed semper nunc vehicula vel. Cras eu mi dui. Donec elementum, nisi eu ornare bibendum, lectus nunc ornare eros, convallis pharetra nunc tortor sed arcu. Morbi a ligula urna, ornare porttitor mi. Vivamus vitae libero nibh, vitae adipiscing justo.');
INSERT INTO `challenge_responses` VALUES(36, 64, NULL, 15, NULL, 'Etiam mi ipsum, facilisis sed pharetra a, facilisis ut sem. Sed nulla mauris, pharetra vel consequat convallis, tristique a orci. Nulla facilisi. Aliquam sagittis dignissim eros quis scelerisque. Aenean bibendum odio ac justo fringilla nec molestie augue porta. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse mauris felis, iaculis nec malesuada id, elementum sit amet felis. Praesent in nibh magna, et euismod ipsum. Aliquam non turpis scelerisque velit lacinia accumsan in in sapien. Suspendisse ut felis et quam ornare ullamcorper.\n\nInteger eu ligula dui. Vestibulum ac orci sit amet magna pretium adipiscing ut sed odio. Mauris tortor magna, semper ac posuere pharetra, egestas blandit neque. Mauris vitae dapibus magna. Proin vel ante eu justo volutpat sodales. In sodales arcu vitae felis pulvinar in condimentum augue dignissim. Nulla sed consequat ipsum. Duis suscipit fermentum mauris non placerat.');
INSERT INTO `challenge_responses` VALUES(37, 62, NULL, 19, NULL, 'Test Data Test Data Test Data Test Data Test Data Test Data Test Data ');
INSERT INTO `challenge_responses` VALUES(38, 63, NULL, 19, NULL, 'Test Data 2 Test Data 2 Test Data 2 Test Data 2 Test Data 2 Test Data 2 Test Data 2 Test Data 2 Test Data 2 ');
INSERT INTO `challenge_responses` VALUES(39, 64, NULL, 19, NULL, 'Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 \n\nTest Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 \n\n\nTest Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 ');
INSERT INTO `challenge_responses` VALUES(40, NULL, 37, 15, 'A', 'this is a good response');
INSERT INTO `challenge_responses` VALUES(41, NULL, 38, 15, 'D', 'disagree text');
INSERT INTO `challenge_responses` VALUES(42, NULL, 39, 15, 'A', '');
INSERT INTO `challenge_responses` VALUES(43, NULL, 33, 16, 'A', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales sapien a erat faucibus sed suscipit lacus dapibus. Nulla congue, nisi faucibus luctus pretium, neque nulla euismod massa, eu mollis massa felis vel ante. Nicely put.');
INSERT INTO `challenge_responses` VALUES(44, NULL, 34, 16, 'D', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales sapien a erat faucibus sed suscipit lacus dapibus. Nulla congue, nisi faucibus luctus pretium, neque nulla euismod massa, eu mollis massa felis vel ante.Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales sapien a erat faucibus sed suscipit lacus dapibus. Nulla congue, nisi faucibus luctus pretium, neque nulla euismod massa, eu mollis massa felis vel ante.Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales sapien a erat faucibus sed suscipit lacus dapibus. Nulla congue, nisi faucibus luctus pretium, neque nulla euismod massa, eu mollis massa felis vel ante.');
INSERT INTO `challenge_responses` VALUES(45, NULL, 33, 16, 'A', '');
INSERT INTO `challenge_responses` VALUES(46, NULL, 34, 16, 'A', '');
INSERT INTO `challenge_responses` VALUES(47, NULL, 36, 16, 'A', '');
INSERT INTO `challenge_responses` VALUES(48, NULL, 33, 16, 'A', '');
INSERT INTO `challenge_responses` VALUES(49, NULL, 34, 16, 'D', 'assdg');
INSERT INTO `challenge_responses` VALUES(50, NULL, 36, 16, 'D', 'astafg');
INSERT INTO `challenge_responses` VALUES(51, 66, NULL, 15, NULL, 'response response test');
INSERT INTO `challenge_responses` VALUES(52, 67, NULL, 15, NULL, 'new response');
INSERT INTO `challenge_responses` VALUES(53, 70, NULL, 15, NULL, 'test response.');
INSERT INTO `challenge_responses` VALUES(54, 70, NULL, 19, NULL, 'kdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfj kdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfj kdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfj\n\n\n\n\nkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfj');
INSERT INTO `challenge_responses` VALUES(55, 71, NULL, 19, NULL, 'kdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfj');
INSERT INTO `challenge_responses` VALUES(56, 72, NULL, 19, NULL, 'kdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfj');
INSERT INTO `challenge_responses` VALUES(57, 70, NULL, 19, NULL, 'kdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfj kdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfj kdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfj\n\n\n\n\nkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfj');
INSERT INTO `challenge_responses` VALUES(58, 71, NULL, 15, NULL, 'response to second question');
INSERT INTO `challenge_responses` VALUES(59, 72, NULL, 15, NULL, 'response to third question\n\ntext text');
INSERT INTO `challenge_responses` VALUES(60, 70, NULL, 15, NULL, 'test response.');
INSERT INTO `challenge_responses` VALUES(61, 71, NULL, 15, NULL, 'response to second question');
INSERT INTO `challenge_responses` VALUES(62, NULL, 54, 15, 'A', '');
INSERT INTO `challenge_responses` VALUES(63, NULL, 55, 15, 'A', '');
INSERT INTO `challenge_responses` VALUES(64, NULL, 56, 15, 'D', 'disagree');
INSERT INTO `challenge_responses` VALUES(65, NULL, 54, 16, 'A', '');
INSERT INTO `challenge_responses` VALUES(66, NULL, 55, 16, 'D', 'cgdf');
INSERT INTO `challenge_responses` VALUES(67, NULL, 56, 16, 'D', 'dfag');
INSERT INTO `challenge_responses` VALUES(68, NULL, 53, 16, 'A', '');
INSERT INTO `challenge_responses` VALUES(69, NULL, 58, 16, 'A', '');
INSERT INTO `challenge_responses` VALUES(70, NULL, 59, 16, 'A', '');
INSERT INTO `challenge_responses` VALUES(71, NULL, 27, 16, 'A', '');
INSERT INTO `challenge_responses` VALUES(72, NULL, 28, 16, 'A', '');
INSERT INTO `challenge_responses` VALUES(73, 82, NULL, 19, NULL, 'JSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkg\n\n\n\n\n\nJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkg\n');
INSERT INTO `challenge_responses` VALUES(74, 83, NULL, 19, NULL, 'Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer \n\nAnswer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer ');
INSERT INTO `challenge_responses` VALUES(75, 84, NULL, 19, NULL, 'Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer ');
INSERT INTO `challenge_responses` VALUES(76, 82, NULL, 19, NULL, 'JSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkg\n\n\n\n\n\nJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkg\n');
INSERT INTO `challenge_responses` VALUES(77, 82, NULL, 19, NULL, 'JSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkg\n\n\n\n\n\nJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkg\n');
INSERT INTO `challenge_responses` VALUES(78, 82, NULL, 15, NULL, 'test response to question 1.');
INSERT INTO `challenge_responses` VALUES(79, 83, NULL, 15, NULL, 'Donec molestie, quam non lacinia mattis, purus ipsum condimentum ligula, id interdum nunc odio in metus. Curabitur commodo rhoncus nisi, ac rutrum turpis rutrum vitae.');
INSERT INTO `challenge_responses` VALUES(80, 84, NULL, 15, NULL, ' Morbi nec elit lorem, id adipiscing felis. Phasellus enim nulla, vehicula vel tempor sit amet, blandit quis ante. Nulla consectetur ligula at velit gravida lobortis. Ut dui odio, imperdiet sed placerat vitae, pellentesque a augue.');
INSERT INTO `challenge_responses` VALUES(81, NULL, 73, 15, 'A', '');
INSERT INTO `challenge_responses` VALUES(82, NULL, 74, 15, 'D', 'i disagree with this answer.');
INSERT INTO `challenge_responses` VALUES(83, NULL, 75, 15, 'A', '');
INSERT INTO `challenge_responses` VALUES(85, 92, NULL, 15, NULL, 'question 1 answer');
INSERT INTO `challenge_responses` VALUES(86, 93, NULL, 15, NULL, 'question two response\n\nupdated...');
INSERT INTO `challenge_responses` VALUES(87, 92, NULL, 15, NULL, 'question 1 answer ##2');
INSERT INTO `challenge_responses` VALUES(88, 92, NULL, 19, NULL, 'hdfgdskfjd');
INSERT INTO `challenge_responses` VALUES(89, 93, NULL, 19, NULL, 'Answering this question');
INSERT INTO `challenge_responses` VALUES(90, 94, NULL, 19, NULL, 'testing this answer too!');
INSERT INTO `challenge_responses` VALUES(91, 92, NULL, 19, NULL, 'hdfgdskfjd');
INSERT INTO `challenge_responses` VALUES(92, 93, NULL, 19, NULL, 'Answering this question');
INSERT INTO `challenge_responses` VALUES(93, 93, NULL, 19, NULL, 'Answering this question');
INSERT INTO `challenge_responses` VALUES(94, 94, NULL, 19, NULL, 'testing this answer too!');
INSERT INTO `challenge_responses` VALUES(95, 94, NULL, 15, NULL, 'final answer');
INSERT INTO `challenge_responses` VALUES(114, NULL, 85, 19, 'A', 'This is good');
INSERT INTO `challenge_responses` VALUES(113, NULL, 95, 18, 'A', 'agreement.');
INSERT INTO `challenge_responses` VALUES(111, NULL, 85, 18, 'A', '');
INSERT INTO `challenge_responses` VALUES(112, NULL, 86, 18, 'D', 'gdf;kl');
INSERT INTO `challenge_responses` VALUES(115, NULL, 86, 19, 'D', '12345678910');
INSERT INTO `challenge_responses` VALUES(116, NULL, 95, 19, 'A', 'Cool');
INSERT INTO `challenge_responses` VALUES(117, 95, NULL, 19, NULL, 'Answer to question 1');
INSERT INTO `challenge_responses` VALUES(118, 96, NULL, 19, NULL, 'No');
INSERT INTO `challenge_responses` VALUES(119, 97, NULL, 19, NULL, 'fkjasdhfjkds');
INSERT INTO `challenge_responses` VALUES(120, 98, NULL, 15, NULL, 'test response for question 1.');
INSERT INTO `challenge_responses` VALUES(121, 98, NULL, 19, NULL, 'hdtkjasdhkj');
INSERT INTO `challenge_responses` VALUES(122, 99, NULL, 19, NULL, 'djshgfjdks');
INSERT INTO `challenge_responses` VALUES(123, 99, NULL, 15, NULL, 'test response for second question.\n\ntest test.');
INSERT INTO `challenge_responses` VALUES(124, NULL, 121, 15, 'A', 'comment');
INSERT INTO `challenge_responses` VALUES(125, NULL, 122, 15, 'D', 'disagree for q2');
INSERT INTO `challenge_responses` VALUES(126, NULL, 120, 19, 'A', 'Good');
INSERT INTO `challenge_responses` VALUES(127, NULL, 123, 19, 'D', '765432');
INSERT INTO `challenge_responses` VALUES(128, 102, NULL, 19, NULL, '3254yjfghsfgdhgd');
INSERT INTO `challenge_responses` VALUES(129, 111, NULL, 19, NULL, 'Question 1 Response Question 1 Response Question 1 Response Question 1 Response Question 1 Response Question 1 Response Quest ');
INSERT INTO `challenge_responses` VALUES(130, 112, NULL, 19, NULL, 'Question Answer');
INSERT INTO `challenge_responses` VALUES(131, 113, NULL, 19, NULL, 'EstÃ¡ horrible ');
INSERT INTO `challenge_responses` VALUES(132, 114, NULL, 19, NULL, 'Por ahÃ­, bobo');
INSERT INTO `challenge_responses` VALUES(133, 115, NULL, 19, NULL, 'Â¡Sigue con hambre!');
INSERT INTO `challenge_responses` VALUES(134, 118, NULL, 15, NULL, '\ntesting long answer.\n\ntesting long answer.\ntesting long answer.\ntesting long answer.\n\n\ntesting long answer.\ntesting long answer.\ntesting long answer.\ntesting long answer.\ntesting long answer.\ntesting long answer.\ntesting long answer.\ntesting long answer.\ntesting long answer.\ntesting long answer.\n\n\ntesting long answer.\n\n\n\n\n\n\n\n\n\n');
INSERT INTO `challenge_responses` VALUES(135, 112, NULL, 15, NULL, 'test response for question. test test. test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.');
INSERT INTO `challenge_responses` VALUES(136, 113, NULL, 15, NULL, 'responding to question 2.');
INSERT INTO `challenge_responses` VALUES(137, 114, NULL, 15, NULL, 'question 3 response.');
INSERT INTO `challenge_responses` VALUES(138, 115, NULL, 15, NULL, 'response to question 4.');
INSERT INTO `challenge_responses` VALUES(139, NULL, 130, 15, 'A', '');
INSERT INTO `challenge_responses` VALUES(140, NULL, 131, 15, 'A', 'responding to q2');
INSERT INTO `challenge_responses` VALUES(141, NULL, 132, 15, 'D', 'disagreeing');
INSERT INTO `challenge_responses` VALUES(142, NULL, 133, 15, 'A', '');
INSERT INTO `challenge_responses` VALUES(143, 118, NULL, 19, NULL, '768748847');
INSERT INTO `challenge_responses` VALUES(144, 119, NULL, 19, NULL, '97876543');
INSERT INTO `challenge_responses` VALUES(145, 120, NULL, 19, NULL, 'Question 1 Answer Question 1 Answer Question 1 Answer Question 1 Answer Question 1 Answer ');
INSERT INTO `challenge_responses` VALUES(146, 121, NULL, 19, NULL, 'Question 1 Answer Question 1 Answer Question 1 Answer Question 1 Answer Question 1 Answer ');
INSERT INTO `challenge_responses` VALUES(147, 120, NULL, 15, NULL, 'test response to question 1. test response to question 1. test response to question 1. test response to question 1. test response to question 1. test response to question 1. test response to question 1. test response to question 1. test response to question 1. test response to question 1. test response to question 1. test response to question 1.');
INSERT INTO `challenge_responses` VALUES(161, NULL, 160, 19, NULL, NULL);
INSERT INTO `challenge_responses` VALUES(172, 125, NULL, 15, NULL, 'q2');
INSERT INTO `challenge_responses` VALUES(160, 121, NULL, 15, NULL, 'test response...');
INSERT INTO `challenge_responses` VALUES(151, NULL, 147, 19, 'A', '');
INSERT INTO `challenge_responses` VALUES(171, 124, NULL, 15, NULL, 'question 1');
INSERT INTO `challenge_responses` VALUES(164, NULL, 145, 15, 'A', 'test');
INSERT INTO `challenge_responses` VALUES(170, 123, NULL, 19, NULL, 'kljhhdfkjdf');
INSERT INTO `challenge_responses` VALUES(169, NULL, 146, 15, 'D', 'disagreement... 23');
INSERT INTO `challenge_responses` VALUES(173, 124, NULL, 19, NULL, 'blah blah IE sucks');
INSERT INTO `challenge_responses` VALUES(174, 125, NULL, 19, NULL, 'blah blah IE sucks');
INSERT INTO `challenge_responses` VALUES(175, NULL, 171, 19, 'A', '23456');
INSERT INTO `challenge_responses` VALUES(176, NULL, 172, 19, 'D', 'disagree with this answer');
INSERT INTO `challenge_responses` VALUES(177, NULL, 173, 15, 'D', 'changed my mind on this one');
INSERT INTO `challenge_responses` VALUES(178, NULL, 174, 15, 'D', 'still don\\''t agree with this.');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL auto_increment,
  `owner_id` int(11) default NULL,
  `group_name` varchar(100) default NULL,
  `date_created` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` VALUES(4, 15, 'First Case Test Group', '2011-12-28 06:33:46', NULL);
INSERT INTO `groups` VALUES(5, 18, 'Another Test Group', '2011-12-28 09:01:25', NULL);
INSERT INTO `groups` VALUES(6, 15, 'Third Case Group (updated)', '2012-01-13 03:52:48', NULL);
INSERT INTO `groups` VALUES(7, 15, 'Ben & Sean Group', '2011-12-15 13:07:46', NULL);
INSERT INTO `groups` VALUES(9, 15, 'invite test', '2011-12-28 09:45:14', NULL);
INSERT INTO `groups` VALUES(10, 19, 'Test Group Sean Daly', '2012-01-03 11:35:17', NULL);
INSERT INTO `groups` VALUES(12, 19, 'Test Group SD 2', '2012-01-10 06:53:05', NULL);
INSERT INTO `groups` VALUES(13, 19, 'Test Group 3', '2012-01-11 17:52:08', NULL);
INSERT INTO `groups` VALUES(14, 19, 'Test Group 4', '2012-01-11 17:52:33', NULL);
INSERT INTO `groups` VALUES(15, 19, 'Test Group 5', '2012-01-11 17:52:42', NULL);
INSERT INTO `groups` VALUES(16, 19, 'Test Group 6', '2012-01-11 17:52:50', NULL);
INSERT INTO `groups` VALUES(17, 19, 'Test Group 7', '2012-01-11 17:53:02', NULL);
INSERT INTO `groups` VALUES(18, 19, 'Test Group 8', '2012-01-11 17:53:09', NULL);
INSERT INTO `groups` VALUES(19, 19, 'Test Group 9', '2012-01-11 17:53:22', NULL);
INSERT INTO `groups` VALUES(20, 19, 'Test Group 10', '2012-01-11 17:53:38', NULL);
INSERT INTO `groups` VALUES(22, 19, 'Test Group 30', '2012-01-13 06:39:05', NULL);
INSERT INTO `groups` VALUES(23, 19, 'Test Group 2', '2012-01-21 17:34:36', NULL);
INSERT INTO `groups` VALUES(24, 15, 'test group... updated name.', '2012-01-13 03:54:59', NULL);
INSERT INTO `groups` VALUES(25, 19, 'wetag', '2012-01-13 05:36:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `abbreviation` char(2) NOT NULL,
  `state` varchar(255) default NULL,
  PRIMARY KEY  (`abbreviation`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` VALUES('AL', 'Alabama');
INSERT INTO `states` VALUES('AK', 'Alaska');
INSERT INTO `states` VALUES('AZ', 'Arizona');
INSERT INTO `states` VALUES('AR', 'Arkansas');
INSERT INTO `states` VALUES('CA', 'California');
INSERT INTO `states` VALUES('CO', 'Colorado');
INSERT INTO `states` VALUES('CT', 'Connecticut');
INSERT INTO `states` VALUES('DE', 'Delaware');
INSERT INTO `states` VALUES('DC', 'District Of Columbia');
INSERT INTO `states` VALUES('FL', 'Florida');
INSERT INTO `states` VALUES('GA', 'Georgia');
INSERT INTO `states` VALUES('HI', 'Hawaii');
INSERT INTO `states` VALUES('ID', 'Idaho');
INSERT INTO `states` VALUES('IL', 'Illinois');
INSERT INTO `states` VALUES('IN', 'Indiana');
INSERT INTO `states` VALUES('IA', 'Iowa');
INSERT INTO `states` VALUES('KS', 'Kansas');
INSERT INTO `states` VALUES('KY', 'Kentucky');
INSERT INTO `states` VALUES('LA', 'Louisiana');
INSERT INTO `states` VALUES('ME', 'Maine');
INSERT INTO `states` VALUES('MD', 'Maryland');
INSERT INTO `states` VALUES('MA', 'Massachusetts');
INSERT INTO `states` VALUES('MI', 'Michigan');
INSERT INTO `states` VALUES('MN', 'Minnesota');
INSERT INTO `states` VALUES('MS', 'Mississippi');
INSERT INTO `states` VALUES('MO', 'Missouri');
INSERT INTO `states` VALUES('MT', 'Montana');
INSERT INTO `states` VALUES('NE', 'Nebraska');
INSERT INTO `states` VALUES('NV', 'Nevada');
INSERT INTO `states` VALUES('NH', 'New Hampshire');
INSERT INTO `states` VALUES('NJ', 'New Jersey');
INSERT INTO `states` VALUES('NM', 'New Mexico');
INSERT INTO `states` VALUES('NY', 'New York');
INSERT INTO `states` VALUES('NC', 'North Carolina');
INSERT INTO `states` VALUES('ND', 'North Dakota');
INSERT INTO `states` VALUES('OH', 'Ohio');
INSERT INTO `states` VALUES('OK', 'Oklahoma');
INSERT INTO `states` VALUES('OR', 'Oregon');
INSERT INTO `states` VALUES('PA', 'Pennsylvania');
INSERT INTO `states` VALUES('RI', 'Rhode Island');
INSERT INTO `states` VALUES('SC', 'South Carolina');
INSERT INTO `states` VALUES('SD', 'South Dakota');
INSERT INTO `states` VALUES('TN', 'Tennessee');
INSERT INTO `states` VALUES('TX', 'Texas');
INSERT INTO `states` VALUES('UT', 'Utah');
INSERT INTO `states` VALUES('VT', 'Vermont');
INSERT INTO `states` VALUES('VA', 'Virginia');
INSERT INTO `states` VALUES('WA', 'Washington');
INSERT INTO `states` VALUES('WV', 'West Virginia');
INSERT INTO `states` VALUES('WI', 'Wisconsin');
INSERT INTO `states` VALUES('WY', 'Wyoming');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `user_type` enum('L','P') default NULL,
  `login` varchar(100) default NULL,
  `password` varchar(80) default NULL,
  `firstname` varchar(75) default NULL,
  `lastname` varchar(75) default NULL,
  `city` varchar(100) default NULL,
  `state` varchar(50) default NULL,
  `email` varchar(75) default NULL,
  `search_visible` tinyint(4) default '1',
  `notify_responses` tinyint(4) default NULL,
  `notify_challenges` tinyint(4) default '1',
  `notify_expiration` tinyint(4) default '1',
  `notify_groups` tinyint(4) default '1',
  `invite_token` varchar(150) default NULL,
  `date_created` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(15, 'L', 'ben.rawn@gmail.com', 'fb173bca049d421666e0776ecc5686e15b6d8196', 'Benjamin', 'Rawn', 'Santa Fe', 'NM', 'ben.rawn@gmail.com', 1, 0, 1, 1, 1, NULL, '2012-01-17 03:51:29');
INSERT INTO `users` VALUES(21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '8b59da5156c4355e463cd70e02e4c16c3639160e', '2012-01-11 17:54:39');
INSERT INTO `users` VALUES(22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, 1, '11d540c0a4a154853f0a33e21a6617a032ef8b5c', '2012-01-11 18:11:52');
INSERT INTO `users` VALUES(17, NULL, 'test@benrawn.com', 'fb173bca049d421666e0776ecc5686e15b6d8196', 'Ben', 'Testuser', NULL, NULL, 'test@benrawn.com', 1, NULL, 1, 1, 1, NULL, '2011-12-09 04:46:29');
INSERT INTO `users` VALUES(18, 'P', 'ben@benrawn.com', 'fb173bca049d421666e0776ecc5686e15b6d8196', 'Test', 'User', NULL, NULL, 'ben@benrawn.com', 1, NULL, 1, 1, 1, NULL, '2012-01-25 07:50:14');
INSERT INTO `users` VALUES(19, 'L', 'sean.c.daly@gmail.com', 'fb173bca049d421666e0776ecc5686e15b6d8196', 'Sean', 'Daly', 'Miami', 'FL', 'sean.c.daly@gmail.com', 1, 0, 1, 1, 1, '', '2012-01-21 14:49:58');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `user_id` int(11) NOT NULL default '0',
  `group_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`user_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` VALUES(2, 3);
INSERT INTO `users_groups` VALUES(15, 4);
INSERT INTO `users_groups` VALUES(15, 5);
INSERT INTO `users_groups` VALUES(15, 6);
INSERT INTO `users_groups` VALUES(15, 7);
INSERT INTO `users_groups` VALUES(15, 9);
INSERT INTO `users_groups` VALUES(15, 24);
INSERT INTO `users_groups` VALUES(15, 25);
INSERT INTO `users_groups` VALUES(17, 4);
INSERT INTO `users_groups` VALUES(17, 6);
INSERT INTO `users_groups` VALUES(18, 5);
INSERT INTO `users_groups` VALUES(18, 6);
INSERT INTO `users_groups` VALUES(18, 7);
INSERT INTO `users_groups` VALUES(18, 9);
INSERT INTO `users_groups` VALUES(18, 24);
INSERT INTO `users_groups` VALUES(19, 4);
INSERT INTO `users_groups` VALUES(19, 6);
INSERT INTO `users_groups` VALUES(19, 7);
INSERT INTO `users_groups` VALUES(19, 12);
INSERT INTO `users_groups` VALUES(19, 13);
INSERT INTO `users_groups` VALUES(19, 14);
INSERT INTO `users_groups` VALUES(19, 15);
INSERT INTO `users_groups` VALUES(19, 16);
INSERT INTO `users_groups` VALUES(19, 17);
INSERT INTO `users_groups` VALUES(19, 18);
INSERT INTO `users_groups` VALUES(19, 19);
INSERT INTO `users_groups` VALUES(19, 20);
INSERT INTO `users_groups` VALUES(19, 22);
INSERT INTO `users_groups` VALUES(19, 23);
INSERT INTO `users_groups` VALUES(19, 25);

-- --------------------------------------------------------

--
-- Table structure for table `user_invite_statuses`
--

CREATE TABLE `user_invite_statuses` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `group_id` int(11) default NULL,
  `challenge_id` int(11) default NULL,
  `status` enum('P','N','D','C','R') default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`,`challenge_id`,`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=105 ;

--
-- Dumping data for table `user_invite_statuses`
--

INSERT INTO `user_invite_statuses` VALUES(6, 17, NULL, 12, 'D');
INSERT INTO `user_invite_statuses` VALUES(7, 15, NULL, 13, 'D');
INSERT INTO `user_invite_statuses` VALUES(8, 18, NULL, 12, 'D');
INSERT INTO `user_invite_statuses` VALUES(9, 15, NULL, 12, 'D');
INSERT INTO `user_invite_statuses` VALUES(10, 16, NULL, 12, 'D');
INSERT INTO `user_invite_statuses` VALUES(11, 16, NULL, 15, 'D');
INSERT INTO `user_invite_statuses` VALUES(12, 16, NULL, 20, 'D');
INSERT INTO `user_invite_statuses` VALUES(13, 15, NULL, 14, 'D');
INSERT INTO `user_invite_statuses` VALUES(14, 15, NULL, 16, 'D');
INSERT INTO `user_invite_statuses` VALUES(15, 15, NULL, 15, 'D');
INSERT INTO `user_invite_statuses` VALUES(16, 15, NULL, 20, 'D');
INSERT INTO `user_invite_statuses` VALUES(17, 15, NULL, 22, 'D');
INSERT INTO `user_invite_statuses` VALUES(18, 15, NULL, 17, 'D');
INSERT INTO `user_invite_statuses` VALUES(21, 15, 6, 23, 'D');
INSERT INTO `user_invite_statuses` VALUES(22, 17, NULL, 23, 'D');
INSERT INTO `user_invite_statuses` VALUES(23, 18, NULL, 23, 'D');
INSERT INTO `user_invite_statuses` VALUES(24, 15, NULL, 24, 'D');
INSERT INTO `user_invite_statuses` VALUES(25, 16, NULL, 24, 'D');
INSERT INTO `user_invite_statuses` VALUES(26, 16, NULL, 22, 'D');
INSERT INTO `user_invite_statuses` VALUES(27, 16, NULL, 23, 'D');
INSERT INTO `user_invite_statuses` VALUES(28, 15, NULL, 25, 'D');
INSERT INTO `user_invite_statuses` VALUES(29, 15, NULL, 26, 'D');
INSERT INTO `user_invite_statuses` VALUES(30, 16, NULL, 26, 'D');
INSERT INTO `user_invite_statuses` VALUES(31, 16, NULL, 25, 'D');
INSERT INTO `user_invite_statuses` VALUES(32, 19, NULL, 26, 'D');
INSERT INTO `user_invite_statuses` VALUES(40, 18, NULL, 28, 'D');
INSERT INTO `user_invite_statuses` VALUES(41, 19, NULL, 23, 'D');
INSERT INTO `user_invite_statuses` VALUES(42, 19, NULL, 30, 'D');
INSERT INTO `user_invite_statuses` VALUES(43, 15, NULL, 30, 'D');
INSERT INTO `user_invite_statuses` VALUES(44, 19, NULL, 24, 'D');
INSERT INTO `user_invite_statuses` VALUES(45, 19, NULL, 22, 'D');
INSERT INTO `user_invite_statuses` VALUES(46, 15, NULL, 29, 'D');
INSERT INTO `user_invite_statuses` VALUES(91, 19, NULL, 68, 'D');
INSERT INTO `user_invite_statuses` VALUES(48, 0, 0, NULL, 'P');
INSERT INTO `user_invite_statuses` VALUES(49, 15, 10, 32, 'P');
INSERT INTO `user_invite_statuses` VALUES(50, 19, NULL, 29, 'D');
INSERT INTO `user_invite_statuses` VALUES(51, 19, NULL, 34, 'D');
INSERT INTO `user_invite_statuses` VALUES(52, 15, NULL, 34, 'D');
INSERT INTO `user_invite_statuses` VALUES(53, 15, NULL, 35, 'C');
INSERT INTO `user_invite_statuses` VALUES(54, 19, NULL, 35, 'D');
INSERT INTO `user_invite_statuses` VALUES(55, 19, NULL, 32, 'D');
INSERT INTO `user_invite_statuses` VALUES(56, 19, NULL, 25, 'D');
INSERT INTO `user_invite_statuses` VALUES(57, 18, NULL, 35, 'D');
INSERT INTO `user_invite_statuses` VALUES(58, 19, NULL, 37, 'D');
INSERT INTO `user_invite_statuses` VALUES(59, 19, NULL, 38, 'D');
INSERT INTO `user_invite_statuses` VALUES(60, 15, NULL, 39, 'D');
INSERT INTO `user_invite_statuses` VALUES(61, 19, NULL, 39, 'D');
INSERT INTO `user_invite_statuses` VALUES(62, 15, NULL, 40, 'D');
INSERT INTO `user_invite_statuses` VALUES(63, 19, NULL, 40, 'D');
INSERT INTO `user_invite_statuses` VALUES(64, 0, 0, NULL, 'P');
INSERT INTO `user_invite_statuses` VALUES(65, 0, 0, NULL, 'P');
INSERT INTO `user_invite_statuses` VALUES(66, 0, 0, NULL, 'P');
INSERT INTO `user_invite_statuses` VALUES(67, 19, NULL, 42, 'C');
INSERT INTO `user_invite_statuses` VALUES(68, 21, 0, NULL, 'P');
INSERT INTO `user_invite_statuses` VALUES(69, 22, 0, NULL, 'P');
INSERT INTO `user_invite_statuses` VALUES(70, 0, 0, NULL, 'P');
INSERT INTO `user_invite_statuses` VALUES(71, 0, 0, NULL, 'P');
INSERT INTO `user_invite_statuses` VALUES(72, 0, 0, NULL, 'P');
INSERT INTO `user_invite_statuses` VALUES(77, 19, NULL, 54, 'D');
INSERT INTO `user_invite_statuses` VALUES(78, 19, NULL, 51, 'D');
INSERT INTO `user_invite_statuses` VALUES(79, 19, NULL, 57, 'C');
INSERT INTO `user_invite_statuses` VALUES(80, 19, NULL, 59, 'D');
INSERT INTO `user_invite_statuses` VALUES(81, 19, NULL, 58, 'D');
INSERT INTO `user_invite_statuses` VALUES(82, 19, NULL, 61, 'D');
INSERT INTO `user_invite_statuses` VALUES(83, 15, NULL, 57, 'D');
INSERT INTO `user_invite_statuses` VALUES(84, 15, NULL, 64, 'D');
INSERT INTO `user_invite_statuses` VALUES(85, 15, NULL, 59, 'D');
INSERT INTO `user_invite_statuses` VALUES(86, 15, NULL, 61, 'D');
INSERT INTO `user_invite_statuses` VALUES(87, 15, NULL, 58, 'D');
INSERT INTO `user_invite_statuses` VALUES(88, 19, NULL, 64, 'D');
INSERT INTO `user_invite_statuses` VALUES(89, 19, NULL, 67, 'D');
INSERT INTO `user_invite_statuses` VALUES(90, 15, NULL, 67, 'D');
INSERT INTO `user_invite_statuses` VALUES(95, 17, NULL, 25, 'D');
INSERT INTO `user_invite_statuses` VALUES(96, 15, NULL, 69, 'D');
INSERT INTO `user_invite_statuses` VALUES(98, 19, NULL, 69, 'C');
INSERT INTO `user_invite_statuses` VALUES(99, 15, NULL, 70, 'D');
INSERT INTO `user_invite_statuses` VALUES(100, 19, NULL, 70, 'D');
INSERT INTO `user_invite_statuses` VALUES(101, 27, 7, NULL, 'P');
