CREATE PROCEDURE `sp_get_path_by_key`(in id int, out path varchar(100))
begin
declare v1 varchar(100);
set v1 = (select articles_tree.`key` from articles_tree where articles_tree.`id` = id);
set path='';
while(v1 <> '') do
set path = concat((select articles_tree.`name` from articles_tree where articles_tree.`key`=v1), ' > ', path);
set v1 = substring(v1 from 1 for (LENGTH(v1)-4));
end while;
set path = substring(path from 1 for (LENGTH(path)-2));
end