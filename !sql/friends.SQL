CREATE TABLE friends
(
	id BIGINT NOT NULL AUTO_INCREMENT,
	friend_id BIGINT NOT NULL,
	group_id BIGINT NOT NULL,
	user_id BIGINT NOT NULL,
	note VARCHAR(100) NOT NULL,
	is_mutual TINYINT NOT NULL,
	PRIMARY KEY (id)
) 
;


