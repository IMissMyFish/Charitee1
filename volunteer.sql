CREATE TABLE `volunteer` (
  `vid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255),
  `date1` date NOT NULL,
  `date2` date NOT NULL,
  PRIMARY KEY (`vid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
