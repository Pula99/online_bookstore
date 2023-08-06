/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.11-MariaDB : Database - bookstore
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `books` */

DROP TABLE IF EXISTS `books`;

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(100) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `publisher` varchar(50) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `isbn_no` int(11) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT 0.00,
  `discount` decimal(11,2) DEFAULT 0.00,
  `status` varchar(15) DEFAULT 'active',
  `handled_by` int(11) DEFAULT 0,
  `c_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `books` */

insert  into `books`(`book_id`,`book_name`,`author`,`publisher`,`category_id`,`isbn_no`,`price`,`discount`,`status`,`handled_by`,`c_date`) values 
(1,'Station Eleven','Emily St. John Mandel','Penguin',2,23111,4500.00,0.00,'active',1,'2023-08-04 09:18:34'),
(2,'Golu Hadawatha','Karunasena Jayalath','MD Gunasena',2,5443343,1500.00,200.00,'active',1,'2023-08-04 09:23:08'),
(6,'Twilight','Tend','',3,6667,4200.00,0.00,'active',1,'2023-08-04 10:14:07'),
(7,'New book 2','New Author 2','',1,334455,450.00,0.00,'active',1,'2023-08-04 12:17:54'),
(8,'The Giver','Lois Lowry','Gunasena',1,445454355,12.00,2.00,'active',1,'2023-08-06 19:29:09'),
(9,'The Wright Brothers','David McCulloh','',4,455433,20.00,4.99,'active',1,'2023-08-06 19:29:58'),
(10,'Radical Gardening','George Mckey','Booli',5,453333,13.00,0.00,'active',1,'2023-08-06 19:30:47'),
(11,'Red Queen','Victoria Aveyard','',2,6643444,14.00,1.99,'active',1,'2023-08-06 19:31:23'),
(12,'To Kill A Mockingbird','Harper Lee','Penguin',6,5454545,15.00,0.00,'active',1,'2023-08-06 19:32:15'),
(13,'Harry Potter','JK Rowling','Warner Bros',3,664435,16.00,3.00,'active',1,'2023-08-06 19:32:52'),
(14,'Heroes of the olympus','Rick Riordran','Rick',3,66444,9.98,0.00,'active',1,'2023-08-06 19:33:33'),
(15,'Shattered','Dick Francis','Penguin',6,545445,12.00,0.00,'active',1,'2023-08-06 19:35:39'),
(16,'Book 3','Author','',6,1234454,12.00,2.00,'active',1,'2023-08-06 21:28:40');

/*Table structure for table `bookstore_user` */

DROP TABLE IF EXISTS `bookstore_user`;

CREATE TABLE `bookstore_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(45) NOT NULL,
  `user_type` varchar(15) DEFAULT 'customer',
  `status` varchar(15) NOT NULL DEFAULT 'active',
  `c_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `bookstore_user` */

insert  into `bookstore_user`(`user_id`,`first_name`,`last_name`,`address`,`email`,`password`,`user_type`,`status`,`c_date`) values 
(1,'Nadun','Bandara','Kandy','nadun.snt@gmail.com','1234','admin','active','2023-08-01 03:15:25'),
(2,'Gayan','Bandara','no.45/1, Kotugodalla Rd, Kandy','gayan@gmail.com','Gayan@123','customer','active','2023-08-02 22:28:21'),
(3,'Hashan','Dissnayake','Kandy','hashan@gmail.com','Hashan@123','customer','active','2023-08-06 21:23:38');

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(20) DEFAULT NULL,
  `status` varchar(15) DEFAULT 'active',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `categories` */

insert  into `categories`(`category_id`,`category_name`,`status`) values 
(1,'Sci Fi','active'),
(2,'Romance','active'),
(3,'Fantacy','active'),
(4,'Biogrphy','active'),
(5,'Gardening','active'),
(6,'Adventure','active'),
(7,'Comedy/Kids','active'),
(8,'Horror','active'),
(9,'New Category','active');

/*Table structure for table `inquiry` */

DROP TABLE IF EXISTS `inquiry`;

CREATE TABLE `inquiry` (
  `inquiry_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(20) DEFAULT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `bookname` varchar(50) DEFAULT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `c_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`inquiry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `inquiry` */

insert  into `inquiry`(`inquiry_id`,`fname`,`lname`,`email`,`bookname`,`comment`,`c_date`) values 
(1,'Rashith','Hettiarachchi','rashith@gmail.com','','','2023-08-06 16:44:18'),
(2,'Rashith','Hettiarachchi','user1@gmail.com','Survivors','Others','2023-08-06 21:18:33');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
