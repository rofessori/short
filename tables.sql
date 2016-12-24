CREATE TABLE IF NOT EXISTS `kjeh_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(5) NOT NULL,
  `userid` int(11) NOT NULL,
  `filetype` varchar(32) NOT NULL,
  `filesize` int(11) NOT NULL,
  `edited` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `kjeh_urls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(5) NOT NULL,
  `userid` int(11) NOT NULL,
  `url` varchar(2048) NOT NULL,
  `edited` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `kjeh_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filekey` varchar(32) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `filekey` (`filekey`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
