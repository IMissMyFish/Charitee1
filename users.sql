   CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(30) NOT NULL,
  `age` int(3) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `bio` varchar(256),
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
