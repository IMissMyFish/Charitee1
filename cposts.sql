CREATE TABLE `cposts` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`cid` varchar(100) NOT NULL,
`uname` varchar(100) NOT NULL,
`msg` varchar(256),
`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
