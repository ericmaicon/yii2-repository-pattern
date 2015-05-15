CREATE TABLE `sms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sms` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
