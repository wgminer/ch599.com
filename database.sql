CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(64) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

INSERT INTO `genres` (`id`, `name`, `slug`) VALUES
(1, 'House', 'house'),
(2, 'Breaks', 'breaks'),
(3, 'Nu Disco', 'nu-disco'),
(4, 'Dubstep', 'dubstep'),
(5, 'Hip Hop', 'hip-hop'),
(6, 'Chill Out', 'chill-out'),
(7, 'Deep House', 'deep-house'),
(8, 'Minimal', 'minimal'),
(9, 'Drum & Bass', 'drum-and-bass'),
(10, 'Rock', 'rock'),
(11, 'Progressive House', 'progressive-house'),
(12, 'Electro House', 'electro-house'),
(13, 'Psy-Trance', 'psy-trance'),
(14, 'Electronica', 'electronica'),
(15, 'R&B', 'r-and-b'),
(16, 'Tech House', 'tech-house'),
(17, 'Glitch Hop', 'glitch-hop'),
(18, 'Techno', 'techno'),
(19, 'Hard Dance', 'hard-dance'),
(20, 'Trance', 'trance'),
(21, 'Trap', 'trap'),
(22, 'Hardcore', 'hardcore'),
(23, 'Garage', 'garage'),
(24, 'Indie Dance', 'indie-dance'),
(25, 'Oldies', 'oldies');

CREATE TABLE `statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'Published'),
(2, 'Draft'),
(3, 'Error');

CREATE TABLE `songs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `status_id` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `highlighted` int(11) NOT NULL,
  `source` varchar(255) NOT NULL,
  `source_url` varchar(255) NOT NULL,
  `source_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE `annotations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `song_id` int(11) NOT NULL,
  `time` varchar(255) NOT NULL,
  `timestamp` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;