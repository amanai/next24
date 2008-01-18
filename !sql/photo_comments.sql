CREATE TABLE photo_comments
(
	id BIGINT NOT NULL AUTO_INCREMENT,
	user_id BIGINT NOT NULL,
	avatar_id BIGINT NOT NULL,
	warning_id BIGINT NOT NULL,
	photo_id BIGINT NOT NULL,
	text TEXT NOT NULL,
	mood VARCHAR(100) NOT NULL,
	creation_date INTEGER NOT NULL,
	adm_redacted TINYINT NOT NULL,
	PRIMARY KEY (id)
) 
;


