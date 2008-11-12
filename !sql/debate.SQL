CREATE TABLE debate_chat
(
	id INTEGER NOT NULL,
	user_id BIGINT,
	message VARCHAR(255),
	message_time DATETIME,
	PRIMARY KEY (id)
) 
;

CREATE TABLE debate_etaps
(
	id BIGINT NOT NULL,
	name VARCHAR(100),
	duration INTEGER,
	start DATETIME,
	passed INTEGER,
	is_pause TINYINT,
	pause_start DATETIME,
	pause_passed INTEGER,
	pause_passed_sum INTEGER,
	is_active TINYINT,
	ord INTEGER,
	PRIMARY KEY (id)
) 
;


CREATE TABLE debate_helper_cansay
(
	id INTEGER NOT NULL,
	helper_id BIGINT,
	PRIMARY KEY (id)
) 
;


CREATE TABLE debate_helpers_chat
(
	id INTEGER NOT NULL,
	user_id BIGINT,
	message VARCHAR(255),
	message_time DATETIME,
	debate_user_id BIGINT,
	PRIMARY KEY (id)
) 
;


CREATE TABLE debate_heper_check
(
	id INTEGER NOT NULL,
	helper_id BIGINT,
	debate_user_id BIGINT,
	PRIMARY KEY (id)
) 
;


CREATE TABLE debate_history
(
	id BIGINT NOT NULL,
	start_time DATETIME,
	theme VARCHAR(200),
	stake_amount DOUBLE,
	user_id_1 BIGINT,
	user_id_2 BIGINT,
	helper_id_1_1 BIGINT,
	helper_id_1_2 BIGINT,
	helper_id_2_1 BIGINT,
	helper_id_2_2 BIGINT,
	user1_vote INTEGER,
	user2_vote BIGINT,
	debate_protocol TEXT,
	PRIMARY KEY (id)
) 
;


CREATE TABLE debate_now
(
	id INTEGER NOT NULL,
	start_time DATETIME,
	debate_theme_id INTEGER,
	theme VARCHAR(200),
	stake_amount DOUBLE,
	user_id_1 BIGINT,
	user_id_2 BIGINT,
	helper_id_1_1 BIGINT,
	helper_id_1_2 BIGINT,
	helper_id_2_1 BIGINT,
	helper_id_2_2 BIGINT,
	is_ready_1 TINYINT,
	is_ready_2 TINYINT,
	helper_1_1_rate BIGINT,
	helper_1_2_rate BIGINT,
	helper_2_1_rate BIGINT,
	helper_2_2_rate BIGINT,
	PRIMARY KEY (id)
) 
;


CREATE TABLE debate_stakes
(
	id INTEGER NOT NULL,
	user_id INTEGER,
	debate_user_id BIGINT,
	stake_amount DOUBLE,
	debate_history_id BIGINT,
	PRIMARY KEY (id)
) 
;


CREATE TABLE debate_theme
(
	id INTEGER NOT NULL,
	user_id BIGINT,
	theme VARCHAR(200),
	votes INTEGER,
	PRIMARY KEY (id)
) 
;


CREATE TABLE debate_theme_vote
(
	id INTEGER NOT NULL,
	user_id BIGINT,
	debate_theme_id BIGINT,
	PRIMARY KEY (id)
) 
;


CREATE TABLE debate_user_vote
(
	id INTEGER NOT NULL,
	user_id BIGINT,
	debate_user_id BIGINT,
	PRIMARY KEY (id)
) 
;


CREATE TABLE debate_users_chat
(
	id INTEGER NOT NULL,
	user_id BIGINT,
	message VARCHAR(255),
	message_time DATETIME,
	PRIMARY KEY (id)
) 
;



