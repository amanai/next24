DELIMITER $
create trigger question_cat_delete before delete
ON questions_cat
FOR EACH ROW BEGIN
DELETE FROM `questions` WHERE `questions`.questions_cat_id = OLD.id;
END $
DELIMITER ;