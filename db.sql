POSTS

title
slug
youtube_id
text
type - set, song
user - 
timestamp


TAGS

title
type (genre, hash)
post_id

USERS

username
password
permissions
bio
photo



CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_title` varchar(255) NOT NULL,
  `post_slug` varchar(255) NOT NULL,
  `post_media` varchar(255) NOT NULL,
  `post_img` varchar(255) NOT NULL,
  `post_text` text NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_type` varchar(255) NOT NULL,
  `post_source` varchar(255) NOT NULL,
  `post_status` varchar(255) NOT NULL,
  `post_mini_url` varchar(5) NOT NULL,
  `post_created` datetime NOT NULL,
  `post_updated` datetime NOT NULL,
  PRIMARY KEY (`post_id`),
  UNIQUE KEY `post_media` (`post_media`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_slug` varchar(255) NOT NULL,
  `user_email` varchar(254) NOT NULL,
  `user_password` varchar(64) NOT NULL,
  `user_photo` varchar(255) NOT NULL,
  `user_bio` text NOT NULL,
  `user_created` datetime NOT NULL,
  `user_updated` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
