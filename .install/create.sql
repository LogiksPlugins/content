CREATE TABLE `#DB_APPS#_contents` (
   `id` int(10) unsigned not null auto_increment,
   `reflink` varchar(75) not null,
   `title` varchar(255),
   `category` varchar(255),
   `tags` varchar(255),
   `text` text,
   `blocked` enum('true','false') default 'false',
   `userid` varchar(155) not null,
   `dtoc` datetime not null,
   `dtoe` datetime not null,
   PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
