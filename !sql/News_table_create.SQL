CREATE TABLE `feeds` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) default NULL,
  `name` varchar(50) default NULL,
  `url` text,
  `type` tinyint(4) default NULL,
  `state` tinyint(4) default NULL,
  `creation_date` datetime default NULL,
  `last_parse_date` datetime default NULL,
  PRIMARY KEY  (`id`)
)  ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE news_tree_feeds
(
	id BIGINT NOT NULL AUTO_INCREMENT,
	news_tree_id INTEGER,
	feed_id BIGINT,
	news_banner_id BIGINT,
	categoy_tag VARCHAR(255),
	PRIMARY KEY (id)
)  ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE news_tree
(
	id INTEGER NOT NULL AUTO_INCREMENT,
	parent_id BIGINT,
	user_id BIGINT,
	name VARCHAR(100),
	active TINYINT,
	PRIMARY KEY (id)
)  ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE news_subscribe
(
	id BIGINT NOT NULL AUTO_INCREMENT,
	user_id BIGINT,
	news_tree_feeds_id BIGINT,
	PRIMARY KEY (id)
)  ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE news_comments
(
	id BIGINT NOT NULL AUTO_INCREMENT,
	user_id BIGINT,
	avatar_id BIGINT,
	warning_id BIGINT,
	news_id BIGINT,
	text TEXT,
	mood VARCHAR(100),
	creation_date INTEGER,
	adm_redacted TINYINT,
	PRIMARY KEY (id)
)  ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE news_banners
(
	id BIGINT NOT NULL AUTO_INCREMENT,
	user_id BIGINT,
	code TEXT,
	state TINYINT,
	PRIMARY KEY (id)
)  ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `news` (
  `id` bigint(20) NOT NULL auto_increment,
  `news_tree_feeds_id` bigint(20) default NULL,
  `title` varchar(255) default NULL,
  `link` varchar(255) default NULL,
  `short_text` text,
  `full_text` text,
  `category` varchar(100) default NULL,
  `pub_date` datetime default NULL,
  `enclosure` varchar(255) default NULL,
  `enclosure_type` varchar(50) default NULL,
  `comments` bigint(20) default NULL,
  `views` bigint(20) default NULL,
  `favorite_users` bigint(20) default NULL,
  PRIMARY KEY  (`id`)
)  ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE favorite_news
(
	id BIGINT NOT NULL,
	user_id BIGINT,
	news_id BIGINT,
	PRIMARY KEY (id)
)  ENGINE=MyISAM DEFAULT CHARSET=utf8;


