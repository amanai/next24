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
    
    function getAllNewsTreeFeeds($isFeedActive = true, $isNewsTreeActive = true, $isNewsBannersActive = true){
        $DE = Project::getDatabase();
        $result = array();
        $sql = "
            SELECT  ntf.*, 
                    feeds.user_id as feeds_user_id, feeds.name as feeds_name, feeds.url, feeds.type, feeds.state as feeds_state, 
                    feeds.creation_date, feeds.last_parse_date, 
                    news_tree.parent_id, news_tree.user_id as news_tree_user_id, news_tree.name as news_tree_name, news_tree.state as news_tree_state, 
                    news_banners.user_id as news_banners_user_id, news_banners.code, news_banners.state as news_banners_state 
            FROM news_tree_feeds as ntf
            INNER JOIN feeds 
                ON ntf.feed_id = feeds.id ";
        if ($isFeedActive) $sql .= " AND feeds.state=1 ";
        $sql .= "
            INNER JOIN news_tree 
                ON ntf.news_tree_id = news_tree.id ";
        if ($isNewsTreeActive) $sql .= " AND news_tree.state=1 ";
        $sql .= "
            LEFT JOIN news_banners 
                ON ntf.news_banner_id = news_banners.id ";
        if ($isNewsBannersActive) $sql .= " AND news_banners.state=1 ";

        $result = $DE -> select($sql);
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
    
    // check is this element have children (is last element in tree hierarchy)
    function isLeaf($elementId){
        $DE = Project::getDatabase();
        $result = array();
        $sql = "
            SELECT *
            FROM news_tree
            WHERE parent_id = ?
        ";
        $result = $DE -> selectRow($sql, $elementId);
        if (count($result)>0)  return false;
        return true;        
    }
    
    function addFeeds($user_id, $name, $url, $type, $state, $creation_date){
        $DE = Project::getDatabase();
        $sql = "
            INSERT INTO `feeds` (`user_id` , `name` , `url` , `type` , `state` , `creation_date` )
            VALUES (
            '".$user_id."', '".htmlspecialchars($name)."', '".$url."', '".$type."', '".$state."', '".$creation_date."'
            );
        ";
        $DE -> query($sql);
        return mysql_insert_id();
    }
    
    function addNewsBanner($user_id, $code, $state){
        $DE = Project::getDatabase();
        $sql = "
            INSERT INTO `news_banners` (`user_id` , `code`, `state` )
            VALUES (
            '".$user_id."', '".$code."', '".$state."'
            );
        ";
        $DE -> query($sql);
        return mysql_insert_id();
    }
    
    function addNewsTreeFeeds($news_tree_id, $feed_id, $news_banner_id, $category_tag){
        $DE = Project::getDatabase();
        $sql = "
            INSERT INTO `news_tree_feeds` (`news_tree_id` , `feed_id` , `news_banner_id` , `category_tag` )
            VALUES (
            '".$news_tree_id."', '".$feed_id."', '".$news_banner_id."', '".$category_tag."'
            );
        ";
        $DE -> query($sql);
        return mysql_insert_id();
    }
    
    function getNewsSame($news_tree_feeds_id, $title, $link, $full_text, $category, $pub_date){
        $DE = Project::getDatabase();
        $result = array();
        $sql = "
            SELECT *
            FROM news
            WHERE news_tree_feeds_id = ?  AND title LIKE ? AND link LIKE ? AND full_text LIKE ? AND category LIKE ? AND pub_date LIKE ?
        ";
        $result = $DE -> select($sql, $news_tree_feeds_id, $title, $link, $full_text, $category, $pub_date);
        return $result;
    }
    
    function addNews($news_tree_feeds_id, $title, $link, $short_text, $full_text, $category, $pub_date, $enclosure, $enclosure_type, $comments, $views, $favorite_users){
        $DE = Project::getDatabase();
        $sql = "
            INSERT INTO `news` (`news_tree_feeds_id` , `title` , `link` , `short_text` , `full_text` ,  `category` , `pub_date` , `enclosure`  ,
                 `enclosure_type` , `comments` , `views`  , `favorite_users` )
            VALUES (
            '".$news_tree_feeds_id."', '".htmlspecialchars($title)."',  '".urlencode($link)."', '".htmlspecialchars($short_text)."', 
            '".htmlspecialchars($full_text)."', '".htmlspecialchars($category)."', '".$pub_date."', '".$enclosure."', '".$enclosure_type."', '".$comments."',  '".$views."', 
            '".$favorite_users."'
            );
        ";
        $DE -> query($sql);
        return mysql_insert_id();
    }
    
    function ReadFile($url){
        $handle = fopen($url, "rb");
        $contents = '';
        while (!feof($handle)) {
          $str = fread($handle, 8192);
          $contents .= $str;
          echo $str;
        }
        fclose($handle);

        return $contents;
    }

}
?>