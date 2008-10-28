<?php
class NewsModel extends BaseModel{
		function __construct(){
			parent::__construct('news');
		}
		
		function getAllNews(){
			$DE = Project::getDatabase();
			$result = array();
			$result = $DE -> select("SELECT * FROM news_tree ORDER BY name");
            return $result;
		}
		
}
?>