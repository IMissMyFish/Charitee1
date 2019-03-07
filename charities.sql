CREATE TABLE `charities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(100) NOT NULL,
  `cname` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(30) NOT NULL,
  `zip` int(5) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bio` varchar(255),
  `cat` varchar(100) NOT NULL,
  `relig` int(2) NOT NULL,
  `pop` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
