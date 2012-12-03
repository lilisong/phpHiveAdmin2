CREATE TABLE IF NOT EXISTS `ehm_pha_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `password` varchar(100) NOT NULL,
  `onlydb` varchar(200) NOT NULL,
  `role` varchar(50) NOT NULL,
  `reduce` int(10) NOT NULL,
  `access_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
INSERT INTO `ehm_pha_user` (`user_id`, `username`, `password`, `role`) VALUES (1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'superadmin');

CREATE TABLE IF NOT EXISTS `ehm_pha_job` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `fingerprint` varchar(100) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `access_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;