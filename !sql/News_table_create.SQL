CREATE TABLE feeds
(
	id BIGINT NOT NULL AUTO_INCREMENT,
	user_id BIGINT,
	url TEXT,
	type TINYINT,
	state TINYINT,
	creation_date INTEGER,
	last_parse_date INTEGER,
	PRIMARY KEY (id)
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


CREATE TABLE news
(
	id BIGINT NOT NULL AUTO_INCREMENT,
	news_tree_feeds_id BIGINT,
	title VARCHAR(255),
	short_text TEXT,
	full_text TEXT,
	views BIGINT,
	comments BIGINT,
	event_date DATETIME,
	creation_date DATETIME,
	favorite_users BIGINT,
	PRIMARY KEY (id)
)  ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE favorite_news
(
	id BIGINT NOT NULL,
	user_id BIGINT,
	news_id BIGINT,
	PRIMARY KEY (id)
)  ENGINE=MyISAM DEFAULT CHARSET=utf8;


