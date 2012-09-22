-- MySQL dump 10.13  Distrib 5.5.23, for osx10.6 (i386)
--
-- Host: localhost    Database: caseclub
-- ------------------------------------------------------
-- Server version	5.5.23

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `challenge_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `file_location` varchar(150) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type` enum('D','C','R') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachments`
--

LOCK TABLES `attachments` WRITE;
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
INSERT INTO `attachments` VALUES (20,12,15,'72f3ff99b8d39d2f9ac17dd95d27b7b7.PDF','Ingvar Kamprad and IKEA.PDF','C'),(21,13,17,'f84a04e755c85c32db1535660535a208.PDF','Ingvar Kamprad and IKEA.PDF','C'),(22,15,15,'7580644ccb37f51525ddd29d2fba8fd7.PDF','Ingvar Kamprad and IKEA.PDF','C'),(23,12,18,'b63bfb8689588e3a79807ca557a22975.PDF','file name','R'),(24,18,16,'375f79513d0dac410152792a3cb82c45.PDF','Matching DELL Computer.PDF','C'),(25,23,15,'d7894841eef0aeacbb47a56a907c3be8.PDF','Ingvar Kamprad and IKEA.PDF','C'),(26,23,15,'bd13ea5f876749acd59b999145be9ec2.mobileprovision','the name of this file.','R'),(27,23,17,'d5ea23b6581a93cb483196a8e78c228f.jar','file name','R'),(28,23,17,'29d478b3587b919e66c52213e5e1ef78.jpg','new file name','R'),(29,24,15,'93d72de7650904e30f016b874fa1e5b1.PDF','Ingvar Kamprad and IKEA.PDF','C'),(30,24,15,'082c6f866857193d26cce795d4fd59db.pdf','test file upload','R'),(31,24,15,'6b45c8dc6c7cd01803c439588a6029b5.jpg','second test file upload','R'),(34,25,15,'e814ad93c4b17558d9782ae1d15ec69f.cnf','test attach','R'),(33,24,16,'376f783ede78405716fa75b07ba66ff4.pdf','Google ','R'),(35,26,15,'212ccaf160ffedd23bb29a437bfc52d3.PDF','Ingvar Kamprad and IKEA.PDF','C'),(36,27,16,'2f0662703e9d61c03aa16acc51e67d7d.PDF','Fire at Mann Gulch.PDF','C'),(37,28,16,'e257ba207dfdea948c9fbd6d7214200d.PDF','P&G-GBS.PDF','C'),(38,29,15,'e98cc11b5a4c01a95f58023324829883.PDF','Ingvar Kamprad and IKEA.PDF','C'),(39,29,15,'9d2c11f1d2c3582001dff02cd4d491b2.pdf','brinca 12-21.pdf','D'),(40,30,19,'fef0e8aa1fd888af31d74cd216e6cfbe.pdf','Los Chanceros PDF.pdf','C'),(44,30,15,'b41cd3222f02e22b78194e2a587bdfab.pdf','attachment','R'),(42,30,19,'166f6af9dede6be762ffc73d6c078ffa.pdf','Document 2','R'),(43,30,19,'4a3cc424896c08c5c4bea34ce15355a9.pdf','Document 1','R'),(50,42,19,'2af823c8a58ae6e8bcca1169b6f39a97.docx','Test Case.docx','C'),(49,37,19,'bfc504428987e8406ff66038e5faa7a1.PDF','P&G-GBS.PDF','C'),(47,34,19,'5c5ed733b682975f289e9face04e3567.docx','Explanation','R'),(48,35,15,'17117070d66d20ecdac4feadbb192f61.pdf','iBookstoreAssetGuide.pdf','C'),(56,57,19,'515f311806c9c0635be7ddd802ef9520.docx','Test Case.docx','C'),(55,54,19,'80a075168c8c9a58a89940687c836fa5.docx','Test Case.docx','C'),(57,58,19,'c992ad00e907edd41e11c1c2af3360e6.docx','Test Case.docx','C'),(58,58,19,'5522d7e0d4606876f96ab6a4469706cd.docx','Explanation','R'),(59,64,15,'bc9c7002bc1bf8c40e59ada1c619b7e7.PDF','Ingvar Kamprad and IKEA.PDF','C'),(60,67,19,'8e1c6b54549f9ff69a20b9a8f34627ec.docx','Test Case.docx','C'),(61,70,15,'404b138b0602bf5a0a62e3e64c026735.PDF','Ingvar Kamprad and IKEA.PDF','C'),(62,70,19,'4f03ce0ca0a2cb3fbcde3a5398c535ae.jpg','a koala for your viewing pleasure','R'),(63,70,19,'6fab5a3b41d8309b5ce872b4ec2ea830.jpg','and penguins','R');
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `challenge_questions`
--

DROP TABLE IF EXISTS `challenge_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `challenge_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `challenge_id` int(11) DEFAULT NULL,
  `section` varchar(150) DEFAULT NULL,
  `question` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=127 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `challenge_questions`
--

LOCK TABLES `challenge_questions` WRITE;
/*!40000 ALTER TABLE `challenge_questions` DISABLE KEYS */;
INSERT INTO `challenge_questions` VALUES (70,26,'First','Lorem ipsum dolor sit amet, consectetur adipiscing elit?'),(98,39,'question 1','first question goes here?'),(66,25,'test question','question question question?'),(67,25,'other question','question. question question?'),(64,24,'Final Question','This is a third question for the test challenge.'),(63,24,'Another Question','Here is a second question. Answer in the space provided.'),(62,24,'Challenge Theme','This is a question regarding the challenge. Provide some test data?'),(43,18,'Question 1','This is Question 1'),(44,18,'Question 2','This is Question 2'),(45,18,'Question 3','This is Question 3'),(46,18,'Question 4','This is Question 4'),(47,18,'This is Question 5',''),(48,18,'This is Question 6',''),(49,18,'This is Question 7',''),(50,19,'Test','Test 1'),(97,37,'Different','What could they have done differently to make a better decision?'),(54,20,'32456','wsdgfh'),(58,23,'question one','why does something something?'),(59,23,'question two','how can something something?'),(96,37,'Decisions','Did the company make the right decision?'),(74,27,'68787','hgfjkfhkhjgkjhkf'),(71,26,'Second','Nam convallis turpis eget elit malesuada a vulputate neque fermentum?'),(72,26,'Third','Aenean et orci lorem, ac fringilla magna. Maecenas at odio sapien?'),(78,28,'987654','098765432'),(79,28,'09876543','098765432'),(82,30,'A Question','What is this?'),(83,30,'This is Question 2?','What is this?'),(84,30,'This is Question 3?','What is this?'),(92,35,'test question','question question?'),(86,29,'q1 test','question question?'),(95,37,'Your Thoughts','What are your initial thoughts on this case? '),(93,35,'question','next test question'),(94,35,'testing','test for the back button navigation'),(99,39,'question two','Second Test Question?'),(102,42,'A question','A question 1 A question 1 A question 1 A question 1 A question 1 A question 1'),(110,51,'q1','q1'),(126,48,'q2 templ updated','tpl submit test'),(111,57,'Question 1','Question 1 Question'),(112,58,'Quesiton 1','Question 1 Question'),(113,58,'Pregunta NÃºmero Dos','Â¿QuÃ© piensas de la situaciÃ³n en Iraq?'),(114,58,'Uy','Â¿Donde estÃ¡ la biblioteca?'),(115,58,'Tengo hambre','Â¿Me pasas esa hamburguesa? Â¡Que tengo hambre!'),(116,61,'234565768','23456768'),(118,64,'q1','validated.'),(119,64,'q2','question?'),(120,67,'Question 1','Question 1 Question'),(121,67,'Question 2','Question 2 Question'),(122,68,'Example Question','dsfad'),(123,69,'Question 1','Question 1 Question'),(124,70,'q1','q1 first question'),(125,70,'second','second question'),(107,48,'q1','q1');
/*!40000 ALTER TABLE `challenge_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `challenge_responses`
--

DROP TABLE IF EXISTS `challenge_responses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `challenge_responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) DEFAULT NULL,
  `response_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `response_type` enum('A','D') DEFAULT NULL,
  `response_body` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=179 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `challenge_responses`
--

LOCK TABLES `challenge_responses` WRITE;
/*!40000 ALTER TABLE `challenge_responses` DISABLE KEYS */;
INSERT INTO `challenge_responses` VALUES (13,23,NULL,15,NULL,'Here is a test response. The quick brown fox jumps over the lazy dog. This is a response.\n\nMore text can go on different lines.'),(14,24,NULL,15,NULL,'This is the response to the second question. \n\nLorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.\n\nLorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.'),(15,NULL,13,17,'D','here\\\'s some text regarding why I disagree'),(16,NULL,14,17,'A',''),(17,19,NULL,18,NULL,'Response text.\n\nResponse text.'),(18,20,NULL,18,NULL,'test'),(19,21,NULL,18,NULL,'test'),(20,NULL,13,18,'D','this is why i disagree'),(21,NULL,14,18,'A','this why i agree'),(22,NULL,14,18,NULL,NULL),(23,NULL,14,18,NULL,NULL),(24,31,NULL,16,NULL,'Test quesiton'),(25,58,NULL,15,NULL,'because of lots of different reasons.'),(26,59,NULL,15,NULL,'by doing some things in a specific way.'),(27,58,NULL,17,NULL,'here are some reasons:\n\n1) because something something something\n2) for another reason, too'),(28,59,NULL,17,NULL,'this can be done in a certain way.\n\nhere are some details:\n1) detail one\n2) second detail'),(29,NULL,27,18,'A','this is a good answer!'),(30,NULL,28,18,'A','another good answer!!'),(31,NULL,25,18,'D','i don\\\'t like this one,'),(32,NULL,26,18,'D','this is terrible too'),(33,62,NULL,15,NULL,'This is my response to the first question. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales sapien a erat faucibus sed suscipit lacus dapibus. Nulla congue, nisi faucibus luctus pretium, neque nulla euismod massa, eu mollis massa felis vel ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam ligula enim, vestibulum at interdum sed, tincidunt nec felis. In pretium feugiat magna vitae porttitor. Cras lobortis elementum neque ac tincidunt. Nunc mollis lorem ac lacus luctus mattis molestie tortor tincidunt. Sed egestas, ligula in fermentum vestibulum, urna turpis ultrices quam, nec porta neque arcu vel risus. Donec nisl augue, blandit cursus hendrerit sit amet, euismod id nibh. Quisque at nunc nec nulla mattis pulvinar. Etiam ullamcorper ultricies massa, sed semper nunc vehicula vel. Cras eu mi dui. Donec elementum, nisi eu ornare bibendum, lectus nunc ornare eros, convallis pharetra nunc tortor sed arcu. Morbi a ligula urna, ornare porttitor mi. Vivamus vitae libero nibh, vitae adipiscing justo.'),(34,63,NULL,15,NULL,'Morbi egestas imperdiet pulvinar. Integer nibh nisl, faucibus nec tempus vitae, mattis eu est. Vestibulum sed lorem eu elit tincidunt aliquam. Nulla quis nisl eros. Duis vitae ultricies quam. Cras pharetra mauris vel nisi pellentesque sit amet tincidunt orci hendrerit. Duis fermentum augue ante, quis ultrices erat. Donec vitae turpis metus, sit amet placerat elit. Morbi sapien orci, vestibulum eget tincidunt at, semper id nunc. Phasellus ante nibh, sagittis a adipiscing et, porta nec odio. Sed ut lectus id ipsum congue rhoncus ac vitae felis. Nunc ante neque, ullamcorper nec tristique eu, posuere ut urna. Etiam faucibus dolor et lacus placerat laoreet. Suspendisse ornare quam sed mauris consectetur quis suscipit turpis tincidunt. Sed cursus ultricies felis vitae pulvinar.'),(35,62,NULL,15,NULL,'This is my response to the first question. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales sapien a erat faucibus sed suscipit lacus dapibus. Nulla congue, nisi faucibus luctus pretium, neque nulla euismod massa, eu mollis massa felis vel ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam ligula enim, vestibulum at interdum sed, tincidunt nec felis. In pretium feugiat magna vitae porttitor. Cras lobortis elementum neque ac tincidunt. Nunc mollis lorem ac lacus luctus mattis molestie tortor tincidunt. Sed egestas, ligula in fermentum vestibulum, urna turpis ultrices quam, nec porta neque arcu vel risus. Donec nisl augue, blandit cursus hendrerit sit amet, euismod id nibh. Quisque at nunc nec nulla mattis pulvinar. Etiam ullamcorper ultricies massa, sed semper nunc vehicula vel. Cras eu mi dui. Donec elementum, nisi eu ornare bibendum, lectus nunc ornare eros, convallis pharetra nunc tortor sed arcu. Morbi a ligula urna, ornare porttitor mi. Vivamus vitae libero nibh, vitae adipiscing justo.'),(36,64,NULL,15,NULL,'Etiam mi ipsum, facilisis sed pharetra a, facilisis ut sem. Sed nulla mauris, pharetra vel consequat convallis, tristique a orci. Nulla facilisi. Aliquam sagittis dignissim eros quis scelerisque. Aenean bibendum odio ac justo fringilla nec molestie augue porta. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse mauris felis, iaculis nec malesuada id, elementum sit amet felis. Praesent in nibh magna, et euismod ipsum. Aliquam non turpis scelerisque velit lacinia accumsan in in sapien. Suspendisse ut felis et quam ornare ullamcorper.\n\nInteger eu ligula dui. Vestibulum ac orci sit amet magna pretium adipiscing ut sed odio. Mauris tortor magna, semper ac posuere pharetra, egestas blandit neque. Mauris vitae dapibus magna. Proin vel ante eu justo volutpat sodales. In sodales arcu vitae felis pulvinar in condimentum augue dignissim. Nulla sed consequat ipsum. Duis suscipit fermentum mauris non placerat.'),(37,62,NULL,19,NULL,'Test Data Test Data Test Data Test Data Test Data Test Data Test Data '),(38,63,NULL,19,NULL,'Test Data 2 Test Data 2 Test Data 2 Test Data 2 Test Data 2 Test Data 2 Test Data 2 Test Data 2 Test Data 2 '),(39,64,NULL,19,NULL,'Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 \n\nTest Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 \n\n\nTest Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 Test Data 3 '),(40,NULL,37,15,'A','this is a good response'),(41,NULL,38,15,'D','disagree text'),(42,NULL,39,15,'A',''),(43,NULL,33,16,'A','Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales sapien a erat faucibus sed suscipit lacus dapibus. Nulla congue, nisi faucibus luctus pretium, neque nulla euismod massa, eu mollis massa felis vel ante. Nicely put.'),(44,NULL,34,16,'D','Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales sapien a erat faucibus sed suscipit lacus dapibus. Nulla congue, nisi faucibus luctus pretium, neque nulla euismod massa, eu mollis massa felis vel ante.Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales sapien a erat faucibus sed suscipit lacus dapibus. Nulla congue, nisi faucibus luctus pretium, neque nulla euismod massa, eu mollis massa felis vel ante.Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales sapien a erat faucibus sed suscipit lacus dapibus. Nulla congue, nisi faucibus luctus pretium, neque nulla euismod massa, eu mollis massa felis vel ante.'),(45,NULL,33,16,'A',''),(46,NULL,34,16,'A',''),(47,NULL,36,16,'A',''),(48,NULL,33,16,'A',''),(49,NULL,34,16,'D','assdg'),(50,NULL,36,16,'D','astafg'),(51,66,NULL,15,NULL,'response response test'),(52,67,NULL,15,NULL,'new response'),(53,70,NULL,15,NULL,'test response.'),(54,70,NULL,19,NULL,'kdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfj kdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfj kdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfj\n\n\n\n\nkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfj'),(55,71,NULL,19,NULL,'kdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfj'),(56,72,NULL,19,NULL,'kdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfj'),(57,70,NULL,19,NULL,'kdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfj kdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfj kdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfj\n\n\n\n\nkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfjkdjdshfjdshfj'),(58,71,NULL,15,NULL,'response to second question'),(59,72,NULL,15,NULL,'response to third question\n\ntext text'),(60,70,NULL,15,NULL,'test response.'),(61,71,NULL,15,NULL,'response to second question'),(62,NULL,54,15,'A',''),(63,NULL,55,15,'A',''),(64,NULL,56,15,'D','disagree'),(65,NULL,54,16,'A',''),(66,NULL,55,16,'D','cgdf'),(67,NULL,56,16,'D','dfag'),(68,NULL,53,16,'A',''),(69,NULL,58,16,'A',''),(70,NULL,59,16,'A',''),(71,NULL,27,16,'A',''),(72,NULL,28,16,'A',''),(73,82,NULL,19,NULL,'JSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkg\n\n\n\n\n\nJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkg\n'),(74,83,NULL,19,NULL,'Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer \n\nAnswer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer '),(75,84,NULL,19,NULL,'Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer Answer '),(76,82,NULL,19,NULL,'JSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkg\n\n\n\n\n\nJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkg\n'),(77,82,NULL,19,NULL,'JSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkg\n\n\n\n\n\nJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkgJSRHJAehdhlljsdghlgslkg\n'),(78,82,NULL,15,NULL,'test response to question 1.'),(79,83,NULL,15,NULL,'Donec molestie, quam non lacinia mattis, purus ipsum condimentum ligula, id interdum nunc odio in metus. Curabitur commodo rhoncus nisi, ac rutrum turpis rutrum vitae.'),(80,84,NULL,15,NULL,' Morbi nec elit lorem, id adipiscing felis. Phasellus enim nulla, vehicula vel tempor sit amet, blandit quis ante. Nulla consectetur ligula at velit gravida lobortis. Ut dui odio, imperdiet sed placerat vitae, pellentesque a augue.'),(81,NULL,73,15,'A',''),(82,NULL,74,15,'D','i disagree with this answer.'),(83,NULL,75,15,'A',''),(85,92,NULL,15,NULL,'question 1 answer'),(86,93,NULL,15,NULL,'question two response\n\nupdated...'),(87,92,NULL,15,NULL,'question 1 answer ##2'),(88,92,NULL,19,NULL,'hdfgdskfjd'),(89,93,NULL,19,NULL,'Answering this question'),(90,94,NULL,19,NULL,'testing this answer too!'),(91,92,NULL,19,NULL,'hdfgdskfjd'),(92,93,NULL,19,NULL,'Answering this question'),(93,93,NULL,19,NULL,'Answering this question'),(94,94,NULL,19,NULL,'testing this answer too!'),(95,94,NULL,15,NULL,'final answer'),(114,NULL,85,19,'A','This is good'),(113,NULL,95,18,'A','agreement.'),(111,NULL,85,18,'A',''),(112,NULL,86,18,'D','gdf;kl'),(115,NULL,86,19,'D','12345678910'),(116,NULL,95,19,'A','Cool'),(117,95,NULL,19,NULL,'Answer to question 1'),(118,96,NULL,19,NULL,'No'),(119,97,NULL,19,NULL,'fkjasdhfjkds'),(120,98,NULL,15,NULL,'test response for question 1.'),(121,98,NULL,19,NULL,'hdtkjasdhkj'),(122,99,NULL,19,NULL,'djshgfjdks'),(123,99,NULL,15,NULL,'test response for second question.\n\ntest test.'),(124,NULL,121,15,'A','comment'),(125,NULL,122,15,'D','disagree for q2'),(126,NULL,120,19,'A','Good'),(127,NULL,123,19,'D','765432'),(128,102,NULL,19,NULL,'3254yjfghsfgdhgd'),(129,111,NULL,19,NULL,'Question 1 Response Question 1 Response Question 1 Response Question 1 Response Question 1 Response Question 1 Response Quest '),(130,112,NULL,19,NULL,'Question Answer'),(131,113,NULL,19,NULL,'EstÃ¡ horrible '),(132,114,NULL,19,NULL,'Por ahÃ­, bobo'),(133,115,NULL,19,NULL,'Â¡Sigue con hambre!'),(134,118,NULL,15,NULL,'\ntesting long answer.\n\ntesting long answer.\ntesting long answer.\ntesting long answer.\n\n\ntesting long answer.\ntesting long answer.\ntesting long answer.\ntesting long answer.\ntesting long answer.\ntesting long answer.\ntesting long answer.\ntesting long answer.\ntesting long answer.\ntesting long answer.\n\n\ntesting long answer.\n\n\n\n\n\n\n\n\n\n'),(135,112,NULL,15,NULL,'test response for question. test test. test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.test response for question. test test.'),(136,113,NULL,15,NULL,'responding to question 2.'),(137,114,NULL,15,NULL,'question 3 response.'),(138,115,NULL,15,NULL,'response to question 4.'),(139,NULL,130,15,'A',''),(140,NULL,131,15,'A','responding to q2'),(141,NULL,132,15,'D','disagreeing'),(142,NULL,133,15,'A',''),(143,118,NULL,19,NULL,'768748847'),(144,119,NULL,19,NULL,'97876543'),(145,120,NULL,19,NULL,'Question 1 Answer Question 1 Answer Question 1 Answer Question 1 Answer Question 1 Answer '),(146,121,NULL,19,NULL,'Question 1 Answer Question 1 Answer Question 1 Answer Question 1 Answer Question 1 Answer '),(147,120,NULL,15,NULL,'test response to question 1. test response to question 1. test response to question 1. test response to question 1. test response to question 1. test response to question 1. test response to question 1. test response to question 1. test response to question 1. test response to question 1. test response to question 1. test response to question 1.'),(161,NULL,160,19,NULL,NULL),(172,125,NULL,15,NULL,'q2'),(160,121,NULL,15,NULL,'test response...'),(151,NULL,147,19,'A',''),(171,124,NULL,15,NULL,'question 1'),(164,NULL,145,15,'A','test'),(170,123,NULL,19,NULL,'kljhhdfkjdf'),(169,NULL,146,15,'D','disagreement... 23'),(173,124,NULL,19,NULL,'blah blah IE sucks'),(174,125,NULL,19,NULL,'blah blah IE sucks'),(175,NULL,171,19,'A','23456'),(176,NULL,172,19,'D','disagree with this answer'),(177,NULL,173,15,'D','changed my mind on this one'),(178,NULL,174,15,'D','still don\\\'t agree with this.');
/*!40000 ALTER TABLE `challenge_responses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `challenges`
--

DROP TABLE IF EXISTS `challenges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `challenges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `challenge_type` enum('T','N','A') DEFAULT NULL,
  `allow_attachments` tinyint(4) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `answers_due` date DEFAULT NULL,
  `responses_due` date DEFAULT NULL,
  `status` enum('D','C') DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `challenges`
--

LOCK TABLES `challenges` WRITE;
/*!40000 ALTER TABLE `challenges` DISABLE KEYS */;
INSERT INTO `challenges` VALUES (28,16,'N',1,'8765re','2011-12-28','2011-12-29','C',NULL,'2011-12-28 12:01:43'),(27,16,'N',0,'asdf','2011-12-22','2011-12-23','D',NULL,'2011-12-22 13:16:17'),(26,15,'A',1,'Anonymous Challenge','2011-12-21','2011-12-23','C','2011-12-22 01:33:19','2011-12-22 01:33:19'),(25,15,'A',1,'testing ui changes','2011-12-23','2011-12-26','C',NULL,'2011-12-21 02:56:14'),(24,15,'N',1,'Ben & Sean Test Challenge','2011-12-15','2011-12-19','C','2011-12-20 15:23:41','2011-12-20 15:23:41'),(18,16,'N',1,'Sean Challenge Test 2','2011-11-25','2011-12-10','C',NULL,'2011-12-11 12:23:20'),(19,16,'T',1,'Test2','2011-12-28','2012-01-20','C',NULL,'2012-01-20 03:56:29'),(20,16,'N',1,'56476','2011-12-15','2011-12-17','C',NULL,'2011-12-13 12:32:44'),(38,19,'N',NULL,'ytgfhggsfasd','2012-01-09','2012-01-20','C',NULL,'2012-01-20 03:56:29'),(22,15,'N',NULL,'redundant group test','2011-12-13','2012-01-20','C',NULL,'2012-01-20 03:56:29'),(23,15,'N',1,'invitation testing','2011-12-14','2011-12-22','C','2011-12-20 15:30:29','2011-12-20 15:30:29'),(29,15,'N',1,'test draft challenge (no template)','2012-01-03','2012-01-05','C',NULL,'2012-01-01 12:04:30'),(30,19,'N',1,'Alpha Final','2011-12-30','2012-01-02','C','2012-01-02 01:21:57','2012-01-02 01:21:57'),(31,19,'T',0,'','2012-01-15','2012-01-20','C',NULL,'2012-01-20 03:56:29'),(32,19,'N',NULL,'fhjgjkh','2012-01-03','2012-01-20','C',NULL,'2012-01-20 03:56:29'),(37,19,'N',1,'XYZ Challenge','2012-01-09','2012-01-10','C',NULL,'2012-01-09 18:25:27'),(34,19,'N',1,'Test Challenge 3','2012-01-04','2012-01-20','C',NULL,'2012-01-20 03:56:29'),(35,15,'N',0,'testing invitations','2012-01-05','2012-01-16','C','2012-01-06 03:28:02','2012-01-06 03:28:02'),(39,15,'N',0,'test challenge for 1/10','2012-01-09','2012-01-12','C','2012-01-10 05:15:22','2012-01-10 05:15:22'),(40,15,'N',0,'test save','2012-01-10','2012-01-20','C',NULL,'2012-01-20 03:56:29'),(42,19,'N',0,'Test For Emails','2012-01-11','2012-01-13','C',NULL,'2012-01-10 06:56:54'),(48,15,'T',1,'test template','2012-01-13','2012-01-20','C',NULL,'2012-01-20 03:56:29'),(51,15,'N',1,'test template','2012-01-13','2012-01-20','C',NULL,'2012-01-20 03:56:29'),(52,18,'T',NULL,'','2012-01-13','2012-01-20','D',NULL,'2012-01-20 03:56:29'),(53,18,'T',NULL,'','2012-01-13','2012-01-20','D',NULL,'2012-01-20 03:56:29'),(54,19,'N',0,'Example Name','2012-01-13','2012-01-20','C',NULL,'2012-01-20 03:56:29'),(58,19,'N',1,'Testing CCO Create Challenge 2','2012-01-16','2012-01-17','C','2012-01-17 03:40:45','2012-01-17 03:40:45'),(57,19,'A',1,'Testing CCO Create Challenge 1','2012-01-15','2012-01-16','C',NULL,'2012-01-15 09:45:06'),(59,19,'N',NULL,'Testing CCO Create Challenge 3','2012-01-15','2012-01-20','C',NULL,'2012-01-20 03:56:29'),(61,19,'N',0,'Test different browser: Safari','2012-01-16','2012-01-20','C',NULL,'2012-01-20 03:56:29'),(69,19,'N',1,'Test Challenge Notifications','2012-01-24','2012-01-24','C',NULL,'2012-01-24 05:44:36'),(64,15,'N',1,'testing validation','2012-01-19','2012-01-21','C',NULL,'2012-01-17 02:39:04'),(67,19,'N',1,'Testing Agree/Disagree w Ben','2012-01-21','2012-01-23','C','2012-01-23 16:34:36','2012-01-23 16:34:36'),(68,19,'N',0,'Test Receive or Not Receive Email','2012-01-21','2012-01-21','C',NULL,'2012-01-21 14:51:35'),(70,15,'N',1,'IE browser test template','2012-01-24','2012-01-25','C',NULL,'2012-01-24 14:34:38');
/*!40000 ALTER TABLE `challenges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `challenges_classes`
--

DROP TABLE IF EXISTS `challenges_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `challenges_classes` (
  `challenge_id` int(11) NOT NULL DEFAULT '0',
  `class_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`challenge_id`,`class_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `challenges_classes`
--

LOCK TABLES `challenges_classes` WRITE;
/*!40000 ALTER TABLE `challenges_classes` DISABLE KEYS */;
INSERT INTO `challenges_classes` VALUES (18,5),(18,6),(20,5),(22,4),(23,6),(24,7),(25,4),(26,7),(28,7),(30,7),(32,10),(34,9),(35,9),(37,5),(38,5),(38,6),(38,9),(39,7),(42,7),(48,9),(48,10),(51,4),(51,19),(57,7),(58,7),(61,13),(64,13),(67,7),(68,7),(69,7),(70,7),(70,10);
/*!40000 ALTER TABLE `challenges_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) DEFAULT NULL,
  `group_name` varchar(100) DEFAULT NULL,
  `public` tinyint(4) DEFAULT NULL,
  `auth_token` varchar(150) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes`
--

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
INSERT INTO `classes` VALUES (4,15,'First Case Test Group',NULL,NULL,'2011-12-28 06:33:46',NULL),(34,NULL,NULL,NULL,'688e3510a8b2ad602f7003346244c1936d91c4c7','2012-06-29 10:08:53',NULL),(6,15,'Third Case Group (updated)',NULL,NULL,'2012-01-13 03:52:48',NULL),(7,15,'Ben & Sean Group',NULL,'38cc83577bf3fb53acb6d7c5a509363c2b1a2d87','2012-06-29 08:09:33',NULL),(9,15,'invite test',NULL,'a754dac16e4befd56370fe7ef30a287e12813bf6','2012-06-28 23:20:36',NULL),(10,19,'Test Group Sean Daly',NULL,NULL,'2012-01-03 11:35:17',NULL),(12,19,'Test Group SD 2',NULL,NULL,'2012-01-10 06:53:05',NULL),(13,19,'Test Group 3',NULL,NULL,'2012-01-11 17:52:08',NULL),(14,19,'Test Group 4',NULL,NULL,'2012-01-11 17:52:33',NULL),(15,19,'Test Group 5',NULL,NULL,'2012-01-11 17:52:42',NULL),(16,19,'Test Group 6',NULL,NULL,'2012-01-11 17:52:50',NULL),(17,19,'Test Group 7',NULL,NULL,'2012-01-11 17:53:02',NULL),(18,19,'Test Group 8',NULL,NULL,'2012-01-11 17:53:09',NULL),(19,19,'Test Group 9',NULL,NULL,'2012-01-11 17:53:22',NULL),(20,19,'Test Group 10',NULL,NULL,'2012-01-11 17:53:38',NULL),(22,19,'Test Group 30',NULL,NULL,'2012-01-13 06:39:05',NULL),(23,19,'Test Group 2',NULL,NULL,'2012-01-21 17:34:36',NULL),(24,15,'test group... updated name.',NULL,NULL,'2012-01-13 03:54:59',NULL),(25,19,'wetag',NULL,NULL,'2012-01-13 05:36:19',NULL),(29,15,'test_class_new',1,'0705b82172b7f66cab7b671a6f2d5612985d63fa','2012-06-28 22:50:58',NULL),(30,15,'test test new token',0,NULL,'2012-06-28 23:03:33',NULL),(31,15,'test new token test',0,'66eb4dbec02c256c21be5754a626ab196ada8fde','2012-06-28 23:04:56',NULL),(32,15,'new new test token',0,'ed959271431aeba66fd5a1822bccf86653c8b72e','2012-06-28 23:09:32',NULL),(33,15,'final token test',0,'9d732ecb774c9a8c0eb708f80467cb33be46af58','2012-06-28 23:12:57',NULL),(35,15,'test newer update',1,'c69833119e8f4ebd8d47a85ecfbcc5043a1baed8','2012-06-29 10:15:15',NULL),(36,15,'Friday Test Class',1,'e23cd6d41c5b17fc01a0cceab1e3c57b3917a46f','2012-06-29 11:26:12',NULL);
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `states` (
  `abbreviation` char(2) NOT NULL,
  `state` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`abbreviation`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES ('AL','Alabama'),('AK','Alaska'),('AZ','Arizona'),('AR','Arkansas'),('CA','California'),('CO','Colorado'),('CT','Connecticut'),('DE','Delaware'),('DC','District Of Columbia'),('FL','Florida'),('GA','Georgia'),('HI','Hawaii'),('ID','Idaho'),('IL','Illinois'),('IN','Indiana'),('IA','Iowa'),('KS','Kansas'),('KY','Kentucky'),('LA','Louisiana'),('ME','Maine'),('MD','Maryland'),('MA','Massachusetts'),('MI','Michigan'),('MN','Minnesota'),('MS','Mississippi'),('MO','Missouri'),('MT','Montana'),('NE','Nebraska'),('NV','Nevada'),('NH','New Hampshire'),('NJ','New Jersey'),('NM','New Mexico'),('NY','New York'),('NC','North Carolina'),('ND','North Dakota'),('OH','Ohio'),('OK','Oklahoma'),('OR','Oregon'),('PA','Pennsylvania'),('RI','Rhode Island'),('SC','South Carolina'),('SD','South Dakota'),('TN','Tennessee'),('TX','Texas'),('UT','Utah'),('VT','Vermont'),('VA','Virginia'),('WA','Washington'),('WV','West Virginia'),('WI','Wisconsin'),('WY','Wyoming');
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_invite_statuses`
--

DROP TABLE IF EXISTS `user_invite_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_invite_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `challenge_id` int(11) DEFAULT NULL,
  `status` enum('P','N','D','C','R') DEFAULT NULL,
  `permissions` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`challenge_id`,`class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_invite_statuses`
--

LOCK TABLES `user_invite_statuses` WRITE;
/*!40000 ALTER TABLE `user_invite_statuses` DISABLE KEYS */;
INSERT INTO `user_invite_statuses` VALUES (6,17,NULL,12,'D',NULL),(7,15,NULL,13,'D',NULL),(8,18,NULL,12,'D',NULL),(9,15,NULL,12,'D',NULL),(10,16,NULL,12,'D',NULL),(11,16,NULL,15,'D',NULL),(12,16,NULL,20,'D',NULL),(13,15,NULL,14,'D',NULL),(14,15,NULL,16,'D',NULL),(15,15,NULL,15,'D',NULL),(16,15,NULL,20,'D',NULL),(17,15,NULL,22,'D',NULL),(18,15,NULL,17,'D',NULL),(21,15,6,23,'D',NULL),(22,17,NULL,23,'D',NULL),(23,18,NULL,23,'D',NULL),(24,15,NULL,24,'D',NULL),(25,16,NULL,24,'D',NULL),(26,16,NULL,22,'D',NULL),(27,16,NULL,23,'D',NULL),(28,15,NULL,25,'D',NULL),(29,15,NULL,26,'D',NULL),(30,16,NULL,26,'D',NULL),(31,16,NULL,25,'D',NULL),(32,19,NULL,26,'D',NULL),(40,18,NULL,28,'D',NULL),(41,19,NULL,23,'D',NULL),(42,19,NULL,30,'D',NULL),(43,15,NULL,30,'D',NULL),(44,19,NULL,24,'D',NULL),(45,19,NULL,22,'D',NULL),(46,15,NULL,29,'D',NULL),(91,19,NULL,68,'D',NULL),(48,0,0,NULL,'P',NULL),(49,15,10,32,'P',NULL),(50,19,NULL,29,'D',NULL),(51,19,NULL,34,'D',NULL),(52,15,NULL,34,'D',NULL),(53,15,NULL,35,'C',NULL),(54,19,NULL,35,'D',NULL),(55,19,NULL,32,'D',NULL),(56,19,NULL,25,'D',NULL),(57,18,NULL,35,'D',NULL),(58,19,NULL,37,'D',NULL),(59,19,NULL,38,'D',NULL),(60,15,NULL,39,'D',NULL),(61,19,NULL,39,'D',NULL),(62,15,NULL,40,'D',NULL),(63,19,NULL,40,'D',NULL),(64,0,0,NULL,'P',NULL),(65,0,0,NULL,'P',NULL),(66,0,0,NULL,'P',NULL),(67,19,NULL,42,'C',NULL),(68,21,0,NULL,'P',NULL),(69,22,0,NULL,'P',NULL),(70,0,0,NULL,'P',NULL),(71,0,0,NULL,'P',NULL),(72,0,0,NULL,'P',NULL),(77,19,NULL,54,'D',NULL),(78,19,NULL,51,'D',NULL),(79,19,NULL,57,'C',NULL),(80,19,NULL,59,'D',NULL),(81,19,NULL,58,'D',NULL),(82,19,NULL,61,'D',NULL),(83,15,NULL,57,'D',NULL),(84,15,NULL,64,'D',NULL),(85,15,NULL,59,'D',NULL),(86,15,NULL,61,'D',NULL),(87,15,NULL,58,'D',NULL),(88,19,NULL,64,'D',NULL),(89,19,NULL,67,'D',NULL),(90,15,NULL,67,'D',NULL),(95,17,NULL,25,'D',NULL),(96,15,NULL,69,'D',NULL),(98,19,NULL,69,'C',NULL),(99,15,NULL,70,'D',NULL),(100,19,NULL,70,'D',NULL),(101,27,7,NULL,'P',NULL),(105,33,NULL,NULL,'P','['),(106,34,NULL,NULL,'P','['),(107,34,NULL,NULL,'P','L'),(108,34,7,NULL,'P','L'),(109,35,9,NULL,'P','L'),(110,36,9,NULL,'P',NULL),(111,37,36,NULL,'P',NULL),(112,38,7,NULL,'P','L');
/*!40000 ALTER TABLE `user_invite_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` enum('L','P') DEFAULT NULL,
  `login` varchar(100) DEFAULT NULL,
  `password` varchar(80) DEFAULT NULL,
  `firstname` varchar(75) DEFAULT NULL,
  `lastname` varchar(75) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  `search_visible` tinyint(4) DEFAULT '1',
  `notify_responses` tinyint(4) DEFAULT NULL,
  `notify_challenges` tinyint(4) DEFAULT '1',
  `notify_expiration` tinyint(4) DEFAULT '1',
  `notify_groups` tinyint(4) DEFAULT '1',
  `invite_token` varchar(150) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (15,'L','ben.rawn@gmail.com','fb173bca049d421666e0776ecc5686e15b6d8196','Benjamin','Rawn','Santa Fe','NM','ben.rawn@gmail.com',0,0,1,1,1,NULL,'2012-06-29 11:23:57'),(33,'L','undefined',NULL,'undefined','undefined',NULL,NULL,'undefined',1,NULL,1,1,1,'a82fb43c32a6ba86a40ff806d33e1b18a3fc4c01','2012-06-29 08:37:07'),(34,'L','ben@benrawn.com',NULL,'new','professor',NULL,NULL,'ben@benrawn.com',1,NULL,1,1,1,'91807d8b44c89a496177fb4cf257f8753004c43e','2012-06-29 08:38:30'),(19,'L','sean.c.daly@gmail.com','fb173bca049d421666e0776ecc5686e15b6d8196','Sean','Daly','Miami','FL','sean.c.daly@gmail.com',1,0,1,1,1,'','2012-01-21 14:49:58'),(36,'P','student@test.com',NULL,'test ','student',NULL,NULL,'student@test.com',1,NULL,1,1,1,'ce145ff63a46db91d92f38d6710442f8f13c0247','2012-06-29 10:20:15'),(35,'L','test@test.com',NULL,'test','test',NULL,NULL,'test@test.com',1,NULL,1,1,1,'9757d2f41a4333f07afa72cf70a63c9d38fe9aed','2012-06-29 10:18:49'),(37,'P','new_test@benrawn.com',NULL,'new','teststudent',NULL,NULL,'new_test@benrawn.com',1,NULL,1,1,1,'115c9510a81e94336e807c2d8d218e563c8ac6f6','2012-06-29 11:30:00'),(38,'L','testemail@email.com',NULL,'Professor','Test',NULL,NULL,'testemail@email.com',1,NULL,1,1,1,'fa7d7d5d5ab105ed40ab4df2ddc0c68a249846d8','2012-06-29 11:32:57');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_classes`
--

DROP TABLE IF EXISTS `users_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_classes` (
  `user_id` int(11) NOT NULL DEFAULT '0',
  `class_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`class_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_classes`
--

LOCK TABLES `users_classes` WRITE;
/*!40000 ALTER TABLE `users_classes` DISABLE KEYS */;
INSERT INTO `users_classes` VALUES (2,3),(15,4),(15,5),(15,6),(15,7),(15,9),(15,24),(15,25),(15,35),(15,36),(17,4),(17,6),(18,5),(18,6),(18,9),(18,24),(19,4),(19,6),(19,12),(19,13),(19,14),(19,15),(19,16),(19,17),(19,18),(19,19),(19,20),(19,22),(19,23),(19,25);
/*!40000 ALTER TABLE `users_classes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-07-05 21:32:11
