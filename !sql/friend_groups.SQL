CREATE TABLE friend_groups
(
	id BIGINT NOT NULL AUTO_INCREMENT,
	user_id BIGINT NOT NULL,
	name VARCHAR(100) NOT NULL,
	editable TINYINT NOT NULL,
	PRIMARY KEY (id)
) 
;


