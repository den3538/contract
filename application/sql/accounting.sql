-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 05, 2017 at 10:42 PM
-- Server version: 5.5.50-log
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accounting`
--

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE IF NOT EXISTS `contract` (
  `id` int(11) NOT NULL,
  `kind_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `cipher` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `conclusion` date NOT NULL,
  `registration` date NOT NULL,
  `note` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contract`
--

INSERT INTO `contract` (`id`, `kind_id`, `status_id`, `cipher`, `name`, `conclusion`, `registration`, `note`, `amount`, `start`, `end`) VALUES
(1, 2, 5, 45464654, 'Авто-Мойка', '2017-05-10', '2017-05-21', 'Привет', 555, '2017-05-05', '2017-05-07'),
(2, 2, 1, 4555586, 'Мото-Битва', '2017-06-02', '2017-06-04', 'Второй', 888, '2017-06-15', '2017-06-30'),
(3, 1, 1, 762121651, 'Тест', '2017-04-01', '2017-05-20', 'Привет', 232323, '2017-04-05', '2017-05-26');

-- --------------------------------------------------------

--
-- Table structure for table `counterparty`
--

CREATE TABLE IF NOT EXISTS `counterparty` (
  `id` int(11) NOT NULL,
  `contract_id` int(11) NOT NULL,
  `side` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `account` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `counterparty`
--

INSERT INTO `counterparty` (`id`, `contract_id`, `side`, `name`, `bank`, `account`) VALUES
(1, 1, 'Вторая', 'Прима', 'Альфа', 232332);

-- --------------------------------------------------------

--
-- Table structure for table `kind`
--

CREATE TABLE IF NOT EXISTS `kind` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kind`
--

INSERT INTO `kind` (`id`, `name`) VALUES
(1, 'Предварительный'),
(2, 'Основной'),
(3, 'Дополнительный'),
(4, 'Рамочный'),
(5, 'Опционный'),
(6, 'Поименованный'),
(7, 'Непоименованный'),
(8, 'Реальный'),
(9, 'Консенсуальный'),
(10, 'Простой'),
(11, 'Смешанный'),
(12, 'Возмездный'),
(13, 'Безвозмездный'),
(14, 'Двусторонний'),
(15, 'Многосторонний'),
(16, 'Взаимный'),
(17, 'Публичный'),
(18, 'Непубличный'),
(19, 'Взаимосогласованный'),
(20, 'Присоединения');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `name`) VALUES
(1, 'Бухгалтер'),
(2, 'Главный бухгалтер'),
(3, 'Арматурщик'),
(4, 'Землекоп'),
(5, 'Асфальтоукладчик'),
(6, 'Штукатур'),
(7, 'Каменщик'),
(8, 'Маляр'),
(9, 'Машинист крана'),
(10, 'Монтажник'),
(11, 'Плотник'),
(12, 'Электромонтажник'),
(13, 'Инженер по эксплуатации зданий'),
(14, 'Прораб'),
(15, 'Начальник бригады'),
(16, 'Инженер-проектировщик'),
(17, 'Инженер производственно-технического отдела'),
(18, 'Главный инженер'),
(19, 'Инженер-сметчик'),
(20, 'Инженер по охране труда');

-- --------------------------------------------------------

--
-- Table structure for table `responsibility`
--

CREATE TABLE IF NOT EXISTS `responsibility` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `responsibility`
--

INSERT INTO `responsibility` (`id`, `name`) VALUES
(1, 'Материальная'),
(2, 'Уголовная'),
(3, 'Административная'),
(4, 'Гражданско-правовая'),
(5, 'Дисциплинарная');

-- --------------------------------------------------------

--
-- Table structure for table `responsible`
--

CREATE TABLE IF NOT EXISTS `responsible` (
  `id` int(11) NOT NULL,
  `contract_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `responsibility_id` int(11) NOT NULL,
  `note` varchar(255) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `responsible`
--

INSERT INTO `responsible` (`id`, `contract_id`, `staff_id`, `responsibility_id`, `note`, `start`, `end`) VALUES
(1, 1, 1, 4, 'Привет Мир', '2017-05-13', '2017-05-23');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `salary` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `post_id`, `name`, `address`, `phone`, `salary`) VALUES
(1, 5, 'Петров Иван Иванович', 'Переулок Переулок', '+380980898438', 5200);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Черновик'),
(2, 'Утвержден'),
(3, 'Закрыт'),
(4, 'Расторгнут'),
(5, 'Аннулирован');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Cipher` (`cipher`),
  ADD KEY `kind_id` (`kind_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `counterparty`
--
ALTER TABLE `counterparty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contract_id` (`contract_id`);

--
-- Indexes for table `kind`
--
ALTER TABLE `kind`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `responsibility`
--
ALTER TABLE `responsibility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `responsible`
--
ALTER TABLE `responsible`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contract_id` (`contract_id`),
  ADD KEY `responsibility_id` (`responsibility_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `counterparty`
--
ALTER TABLE `counterparty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kind`
--
ALTER TABLE `kind`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `responsibility`
--
ALTER TABLE `responsibility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `responsible`
--
ALTER TABLE `responsible`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `contract`
--
ALTER TABLE `contract`
  ADD CONSTRAINT `contract_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `contract_ibfk_1` FOREIGN KEY (`kind_id`) REFERENCES `kind` (`id`);

--
-- Constraints for table `counterparty`
--
ALTER TABLE `counterparty`
  ADD CONSTRAINT `counterparty_ibfk_1` FOREIGN KEY (`contract_id`) REFERENCES `contract` (`id`);

--
-- Constraints for table `responsible`
--
ALTER TABLE `responsible`
  ADD CONSTRAINT `responsible_ibfk_3` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`),
  ADD CONSTRAINT `responsible_ibfk_1` FOREIGN KEY (`contract_id`) REFERENCES `contract` (`id`),
  ADD CONSTRAINT `responsible_ibfk_2` FOREIGN KEY (`responsibility_id`) REFERENCES `responsibility` (`id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
