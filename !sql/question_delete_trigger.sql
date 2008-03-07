delimiter $
create trigger question_delete before delete 
on questions 
FOR EACH ROW BEGIN 
delete from `answers` where `answers`.question_id = OLD.id; 
delete from `qq_tags` where `qq_tags`.question_id = OLD.id; 
end $
delimiter ;
