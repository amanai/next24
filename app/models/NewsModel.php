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

    function getFeedsByNewsTreeId($news_tree_id){
        $DE = Project::getDatabase();
        $result = array();
        $sql = "
            SELECT feeds.*
            FROM news_tree_feeds as ntf
            INNER JOIN feeds 
                ON ntf.feed_id = feeds.id
            WHERE ntf.news_tree_id = ?
        ";
        $result = $DE -> select($sql, $news_tree_id);
        return $result;
    }
    
    function getNewsTree($news_tree_id){
        $DE = Project::getDatabase();
        $result = array();
        $sql = "
            SELECT *
            FROM news_tree
            WHERE id = ?
        ";
        $result = $DE -> selectRow($sql, $news_tree_id);
        return $result;
    }

}
?>