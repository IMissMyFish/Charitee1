CREATE TABLE `fundraiser` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255),
  `date2` date NOT NULL,
  `current` int(7) NOT NULL,
  `goal` int(7) NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 AUTO_INCREMENT=3;
