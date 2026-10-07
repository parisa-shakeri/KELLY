-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 07, 2026 at 09:04 PM
-- Server version: 8.4.7
-- PHP Version: 8.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kelly_portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', 'admin1234', '2026-10-02 10:45:41');

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

DROP TABLE IF EXISTS `contact_info`;
CREATE TABLE IF NOT EXISTS `contact_info` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_url` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_info`
--

INSERT INTO `contact_info` (`id`, `address`, `phone`, `email`, `map_url`) VALUES
(1, 'New York, USA', '+1 123 456 7890', 'email@example.com', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40\r\n              .710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!\r\n              2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus\r\n\" frameborder=\"0\" style=\"border:0; width: 100%; height: 270px;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy\r\n              =\"no-referrer-when-downgrade\">');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `is_read`, `created_at`) VALUES
(2, 'pari', 'pariiiisa1381@gmail.com', 'abs]c', 'qwertyuiop[aasdfghjkl;\'zxcvbnm,./', 0, '2026-10-02 14:26:29');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

DROP TABLE IF EXISTS `education`;
CREATE TABLE IF NOT EXISTS `education` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `degree` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_year` year DEFAULT NULL,
  `end_year` year DEFAULT NULL,
  `institution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `degree`, `start_year`, `end_year`, `institution`, `description`, `sort_order`) VALUES
(1, 'Master of Fine Arts & Graphic Design', '2015', '2016', 'Rochester Institute of Technology', 'Qui deserunt veniam. Et sed aliquam labore tempore sed quisquam iusto autem sit.', 1),
(2, 'Bachelor of Fine Arts & Graphic Design', '2010', '2014', 'Rochester Institute of Technology', 'Quia nobis sequi est occaecati aut. Repudiandae et iusto quae reiciendis et quis Eius vel ratione eius unde vitae rerum voluptates asperiores voluptatem Quo voluptas ut.', 2),
(4, 'bachelor', '2020', '2024', 'maz', 'ewasrtdyui', 2);

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

DROP TABLE IF EXISTS `experience`;
CREATE TABLE IF NOT EXISTS `experience` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `job_title` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_year` year DEFAULT NULL,
  `end_year` year DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`id`, `job_title`, `start_year`, `end_year`, `company`, `location`, `description`, `sort_order`) VALUES
(1, 'Senior Graphic Design Specialist', '2019', '2024', 'Experion', 'New York, NY', 'Le1ad in the design, development, and implementation of graphic, layout, and production communication materials. Delegate tasks to the 7 members of the design team and provide counsel on all aspects of the project.', 1),
(2, 'Graphic Design Specialist', '2017', '2019', 'Stepping Stone Advertising', 'New York, NY', 'Developed numerous marketing programs including logos, brochures, infographics, presentations, and advertisements. Managed up to 5 projects or tasks at a given time while under pressure.', 2),
(3, 'Graphic Design Specialist', '2015', '2017', 'Studio Shodwe', 'New York, NY', 'Created numerous graphic design solutions for print and digital media. Developed design concepts and maintained brand consistency across multiple projects.', 3),
(4, 'abc', '2000', '2001', 'asd', 'poiu', 'qwertyuiopasdfghjkl', 2);

-- --------------------------------------------------------

--
-- Table structure for table `experience_items`
--

DROP TABLE IF EXISTS `experience_items`;
CREATE TABLE IF NOT EXISTS `experience_items` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `experience_id` int UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experience_items`
--

INSERT INTO `experience_items` (`id`, `experience_id`, `description`, `sort_order`) VALUES
(1, 1, 'Le1ad in the design, development, and implementation of the graphic, layout, and production communication materials', 1),
(2, 1, 'Delegate tasks to the 7 members of the design team and provide counsel on all aspects of the project.', 2),
(3, 1, 'Supervise the assessment of all graphic materials in order to ensure quality and accuracy of the design', 3),
(4, 1, 'Oversee the efficient use of production project budgets ranging from $2,000 - $25,000', 4),
(5, 2, 'Developed numerous marketing programs (logos, brochures, infographics, presentations, and advertisements).', 1),
(6, 2, 'Managed up to 5 projects or tasks at a given time while under pressure', 2),
(7, 2, 'Recommended and consulted with clients on the most appropriate graphic design', 3),
(8, 2, 'Created 4+ design presentations and proposals a month for clients and account managers', 4),
(10, 3, 'Developed visual concepts and layouts based on client requirements.', 2),
(11, 3, 'Collaborated with clients and team members to deliver design projects on time.', 3);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_categories`
--

DROP TABLE IF EXISTS `portfolio_categories`;
CREATE TABLE IF NOT EXISTS `portfolio_categories` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolio_categories`
--

INSERT INTO `portfolio_categories` (`id`, `name`, `slug`, `sort_order`) VALUES
(1, 'App', 'app', 1),
(2, 'Card', 'card', 2),
(3, 'Web', 'web', 3);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_images`
--

DROP TABLE IF EXISTS `portfolio_images`;
CREATE TABLE IF NOT EXISTS `portfolio_images` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_id` int UNSIGNED DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolio_images`
--

INSERT INTO `portfolio_images` (`id`, `project_id`, `image`, `sort_order`) VALUES
(1, 1, 'assets/img/masonry-portfolio/masonry-portfolio-1.jpg', 1),
(2, 1, 'assets/img/masonry-portfolio/masonry-portfolio-2.jpg', 2),
(3, 2, 'assets/img/masonry-portfolio/masonry-portfolio-3.jpg', 1),
(4, 2, 'assets/img/masonry-portfolio/masonry-portfolio-4.jpg', 2),
(5, 3, 'assets/img/masonry-portfolio/masonry-portfolio-5.jpg', 1),
(6, 3, 'assets/img/masonry-portfolio/masonry-portfolio-6.jpg', 2),
(7, 4, 'assets/img/masonry-portfolio/masonry-portfolio-7.jpg', 1),
(8, 4, 'assets/img/masonry-portfolio/masonry-portfolio-8.jpg', 2),
(9, 5, 'assets/img/masonry-portfolio/masonry-portfolio-9.jpg', 1),
(10, 5, 'assets/img/masonry-portfolio/masonry-portfolio-1.jpg', 2),
(11, 6, 'assets/img/masonry-portfolio/masonry-portfolio-2.jpg', 1),
(12, 6, 'assets/img/masonry-portfolio/masonry-portfolio-3.jpg', 2),
(13, 7, 'assets/img/masonry-portfolio/masonry-portfolio-4.jpg', 1),
(14, 7, 'assets/img/masonry-portfolio/masonry-portfolio-5.jpg', 2),
(15, 8, 'assets/img/masonry-portfolio/masonry-portfolio-6.jpg', 1),
(16, 8, 'assets/img/masonry-portfolio/masonry-portfolio-7.jpg', 2),
(17, 9, 'assets/img/masonry-portfolio/masonry-portfolio-8.jpg', 1),
(18, 9, 'assets/img/masonry-portfolio/masonry-portfolio-9.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_projects`
--

DROP TABLE IF EXISTS `portfolio_projects`;
CREATE TABLE IF NOT EXISTS `portfolio_projects` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int UNSIGNED DEFAULT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `client` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_date` date DEFAULT NULL,
  `project_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolio_projects`
--

INSERT INTO `portfolio_projects` (`id`, `category_id`, `title`, `short_description`, `description`, `client`, `project_date`, `project_url`, `main_image`) VALUES
(1, 1, 'App 1', 'Lorem ipsum, dolor sit amet consectetur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Example Client', '2024-01-01', 'https://example.com', 'assets/img/masonry-portfolio/masonry-portfolio-1.jpg'),
(2, 2, 'Product 1', 'Lorem ipsum, dolor sit amet consectetur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Example Client', '2024-02-01', 'https://example.com', 'assets/img/masonry-portfolio/masonry-portfolio-2.jpg'),
(3, 3, 'Branding 1', 'Lorem ipsum, dolor sit amet consectetur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Example Client', '2024-03-01', 'https://example.com', 'assets/img/masonry-portfolio/masonry-portfolio-3.jpg'),
(4, 1, 'App 2', 'Lorem ipsum, dolor sit amet consectetur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Example Client', '2024-04-01', 'https://example.com', 'assets/img/masonry-portfolio/masonry-portfolio-4.jpg'),
(5, 2, 'Product 2', 'Lorem ipsum, dolor sit amet consectetur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Example Client', '2024-05-01', 'https://example.com', 'assets/img/masonry-portfolio/masonry-portfolio-5.jpg'),
(6, 3, 'Branding 2', 'Lorem ipsum, dolor sit amet consectetur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Example Client', '2024-06-01', 'https://example.com', 'assets/img/masonry-portfolio/masonry-portfolio-6.jpg'),
(7, 1, 'App 3', 'Lorem ipsum, dolor sit amet consectetur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Example Client', '2024-07-01', 'https://example.com', 'assets/img/masonry-portfolio/masonry-portfolio-7.jpg'),
(8, 2, 'Product 3', 'Lorem ipsum, dolor sit amet consectetur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Example Client', '2024-08-01', 'https://example.com', 'assets/img/masonry-portfolio/masonry-portfolio-8.jpg'),
(9, 3, 'Branding 3', 'Lorem ipsum, dolor sit amet consectetur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Example Client', '2024-09-01', 'https://example.com', 'assets/img/masonry-portfolio/masonry-portfolio-9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int DEFAULT NULL,
  `degree` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `freelance_status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `name`, `role`, `description`, `image`, `birth_date`, `mobile`, `city`, `address`, `email`, `age`, `degree`, `website`, `freelance_status`) VALUES
(2, 'Kelly Adams', 'UI/UX Designer & Web Developer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Officiis eligendi itaque labore et dolorum mollitia officiis optio vero. Quisquam sunt adipisci omnis et ut. Nulla accusantium dolor incidunt officia tempore. Et eius omnis. Cupiditate ut dicta maxime officiis quidem quia. Sed et consectetur qui quia repellendus itaque neque.', 'assets/img/profile-img.jpg', '1995-05-01', '+123 456 7890', 'New York, USA', 'New York, USA', 'emdgfhjail@example.com', 24, 'Master', 'www.example.com', 'Not Available');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `style_class` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `icon`, `style_class`, `sort_order`) VALUES
(1, 'Lorem Ipsum', 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi.', 'bi bi-activity', 'item-cyan', 1),
(2, 'Sed ut perspiciatis', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.', 'bi bi-broadcast', 'item-orange', 2),
(3, 'Magni Dolores', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia.', 'bi bi-easel', 'item-teal', 3),
(4, 'Nemo Enim', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis.', 'bi bi-bounding-box-circles', 'item-red', 4),
(5, 'Dele Cardo', 'Quis consequatur saepe eligendi voluptatem consequatur doloribus enim qui.', 'bi bi-calendar4-week', 'item-indigo', 5),
(6, 'Divera Don', 'Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur.', 'bi bi-chat-square-text', 'item-pink', 6),
(7, 'mnhg', 'rytrytkygi', 'fhjy', NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
CREATE TABLE IF NOT EXISTS `skills` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percentage` int UNSIGNED DEFAULT NULL,
  `sort_order` int UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `percentage`, `sort_order`) VALUES
(1, 'HTML', 100, 1),
(2, 'CSS', 90, 2),
(3, 'JavaScript', 75, 3),
(4, 'PHP', 80, 4),
(5, 'WordPress/CMS', 90, 5),
(6, 'Photoshop', 55, 6),
(7, 'python', 55, 0);

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

DROP TABLE IF EXISTS `social_links`;
CREATE TABLE IF NOT EXISTS `social_links` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `platform` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `sort_order` int UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `platform`, `url`, `icon`, `is_active`, `sort_order`) VALUES
(1, 'Twitter', '#', 'bi bi-twitter-x', 1, 1),
(2, 'Facebook', '#', 'bi bi-facebook', 1, 2),
(3, 'Instagram', '#', 'bi bi-instagram', 1, 3),
(4, 'LinkedIn', '#', 'bi bi-linkedin', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `stats`
--

DROP TABLE IF EXISTS `stats`;
CREATE TABLE IF NOT EXISTS `stats` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` int DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stats`
--

INSERT INTO `stats` (`id`, `title`, `value`, `icon`, `sort_order`) VALUES
(1, 'Clients', 232, 'bi bi-emoji-smile', 1),
(2, 'Projects', 521, 'bi bi-journal-richtext', 2),
(3, 'Hours Of Support', 1453, 'bi bi-headset', 3),
(4, 'Workers', 32, 'bi bi-people', 4);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `rating` float DEFAULT NULL,
  `sort_order` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `role`, `image`, `message`, `rating`, `sort_order`) VALUES
(1, 'Saul Goodman', 'CEO & Founder', 'assets/img/testimonials/testimonials-1.jpg', 'Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus.', 5, 1),
(2, 'Sara Wilsson', 'Designer', 'assets/img/testimonials/testimonials-2.jpg', 'Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua.', 5, 2),
(3, 'Jena Karlis', 'Store Owner', 'assets/img/testimonials/testimonials-3.jpg', 'Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram.', 5, 3),
(4, 'Matt Brandon', 'Freelancer', 'assets/img/testimonials/testimonials-4.jpg', 'Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum.', 5, 4),
(5, 'John Larson', 'Entrepreneur', 'assets/img/testimonials/testimonials-5.jpg', 'Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat.', 5, 5);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `portfolio_images`
--
ALTER TABLE `portfolio_images`
  ADD CONSTRAINT `portfolio_images_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `portfolio_projects` (`id`);

--
-- Constraints for table `portfolio_projects`
--
ALTER TABLE `portfolio_projects`
  ADD CONSTRAINT `portfolio_projects_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `portfolio_categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
