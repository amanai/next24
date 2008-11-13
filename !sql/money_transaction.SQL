CREATE TABLE money_transaction
(
	id BIGINT NOT NULL,
	user_id BIGINT,
	partner_id BIGINT,
	amount DOUBLE,
	transaction_date DATETIME,
	description VARCHAR(200),
	PRIMARY KEY (id)
) 
;


