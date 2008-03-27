DELIMITER $
create trigger article_delete before delete
ON articles
FOR EACH ROW BEGIN
DELETE FROM `article_comment` WHERE `article_comment`.article_id = OLD.id;
END $
DELIMITER ;