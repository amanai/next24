CREATE TABLE albums
(
	id BIGINT NOT NULL AUTO_INCREMENT,
	user_id BIGINT NOT NULL,
	thumbnail_id BIGINT NOT NULL,
	name VARCHAR(255) NOT NULL,
	access TINYINT NOT NULL,
	is_onmain TINYINT NOT NULL,
	PRIMARY KEY (id)
) 
;


