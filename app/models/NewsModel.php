<?php
class NewsModel extends BaseModel{
    var $_aNewsTreeBreadCrumb = array();    
    var $_aNewsTreeChildren = array();    
    
    function __construct(){
        parent::__construct('news');
    }
    
    function changeOneValue($table_name, $id, $field, $value){
        $DE = Project::getDatabase();
        $sql = "
            UPDATE ".$table_name." SET ".$field." = ? 
            WHERE id = ?
        ";
        $result = $DE -> select($sql, $value, $id);
    }
    
    function getOneRecord($table_name, $id){
        $DE = Project::getDatabase();
        $sql = "
            SELECT * FROM ".$table_name." 
            WHERE id = ?
        ";
        $result = $DE -> selectRow($sql, $id);
        return $result;
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
            SELECT  ntf.*,  ntf.id as news_tree_feeds_id,
                    feeds.user_id as feeds_user_id, feeds.name as feeds_name, feeds.url, feeds.type, feeds.state as feeds_state, 
                    feeds.creation_date, feeds.last_parse_date, feeds.text_parse_type, 
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
    
    function getNewsTreeFeedsById($news_tree_feeds_id, $isFeedActive = true, $isNewsTreeActive = true, $isNewsBannersActive = true){
        $DE = Project::getDatabase();
        $result = array();
        $sql = "
            SELECT  ntf.*,  ntf.id as news_tree_feeds_id,
                    feeds.user_id as feeds_user_id, feeds.name as feeds_name, feeds.url, feeds.type, feeds.state as feeds_state, 
                    feeds.creation_date, feeds.last_parse_date, feeds.text_parse_type, 
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
        $sql .= " WHERE ntf.id = ".$news_tree_feeds_id;

        $result = $DE -> selectRow($sql);
        return $result;
    }
    
    function getNewsTreeFeedsByUserId($user_id, $isFeedActive = true, $isNewsTreeActive = true, $isNewsBannersActive = true){
        $DE = Project::getDatabase();
        $result = array();
        $sql = "
            SELECT  ntf.*,  ntf.id as news_tree_feeds_id,
                    feeds.user_id as feeds_user_id, feeds.name as feeds_name, feeds.url, feeds.type, feeds.state as feeds_state, 
                    feeds.creation_date, feeds.last_parse_date, feeds.text_parse_type, 
                    news_tree.parent_id, news_tree.user_id as news_tree_user_id, news_tree.name as news_tree_name, news_tree.state as news_tree_state, 
                    news_banners.user_id as news_banners_user_id, news_banners.code, news_banners.state as news_banners_state 
            FROM news_tree_feeds as ntf
            INNER JOIN feeds 
                ON ntf.feed_id = feeds.id AND feeds.user_id = ".$user_id;
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
    
    function getNewsByNewsTreeId($news_tree_id, $isFeedActive = true, $isNewsTreeActive = true, $isNewsBannersActive = true){
        $DE = Project::getDatabase();
        $result = array(); $addWhere = " AND (";
        
        $this -> getNewsTreeChildren($news_tree_id);
        $this -> _aNewsTreeChildren[] = $this -> getNewsTree($news_tree_id);
        //echo "<pre>";print_r($this -> _aNewsTreeChildren); echo "</pre><hr>";
        foreach ($this -> _aNewsTreeChildren as $news_tree){
            if ($news_tree) $addWhere .= " news_tree.id = ".$news_tree['id']." OR ";
        }
        if ($addWhere == ' AND (') $addWhere=""; else $addWhere = substr($addWhere, 0, -3)." ) ";
                
        $sql = "
            SELECT  ntf.*, ntf.id as news_tree_feeds_id,
                    feeds.user_id as feeds_user_id, feeds.name as feeds_name, feeds.url, feeds.type, feeds.state as feeds_state, 
                    feeds.creation_date, feeds.last_parse_date, feeds.text_parse_type, 
                    news_tree.parent_id, news_tree.user_id as news_tree_user_id, news_tree.name as news_tree_name, news_tree.state as news_tree_state, 
                    news_banners.user_id as news_banners_user_id, news_banners.code, news_banners.state as news_banners_state ,
                    news.id as news_id, news.title as news_title, news.link as news_link, news.short_text as news_short_text, 
                    news.full_text as news_full_text,  news.pub_date,  news.enclosure,  news.enclosure_type,  
                    news.comments,  news.views, news.favorite_users  
            FROM news_tree_feeds as ntf
            INNER JOIN feeds 
                ON ntf.feed_id = feeds.id ";
        if ($isFeedActive) $sql .= " AND feeds.state=1 ";
        $sql .= "
            INNER JOIN news_tree 
                ON ntf.news_tree_id = news_tree.id  ".$addWhere;
        if ($isNewsTreeActive) $sql .= " AND news_tree.state=1 ";
        $sql .= "
            INNER JOIN news 
                ON ntf.id = news.news_tree_feeds_id ";
        $sql .= "
            LEFT JOIN news_banners 
                ON ntf.news_banner_id = news_banners.id ";
        if ($isNewsBannersActive) $sql .= " AND news_banners.state=1 ";
//echo "<hr>".$sql;
        $result = $DE -> select($sql);
        return $result;
    }
    
    function getNewsById($news_id, $isNewsTreeActive = true, $isNewsBannersActive = true){
        $DE = Project::getDatabase();
        $result = array();
        $sql = "
            SELECT  ntf.*, ntf.id as news_tree_feeds_id,
                    news_tree.parent_id, news_tree.user_id as news_tree_user_id, news_tree.name as news_tree_name, news_tree.state as news_tree_state, 
                    news_banners.user_id as news_banners_user_id, news_banners.code, news_banners.state as news_banners_state ,
                    news.id as news_id, news.title as news_title, news.link as news_link, news.short_text as news_short_text, 
                    news.full_text as news_full_text,  news.pub_date,  news.enclosure,  news.enclosure_type,  
                    news.comments,  news.views, news.favorite_users
            FROM news
            INNER JOIN news_tree_feeds as ntf
                ON news.news_tree_feeds_id = ntf.id 
            INNER JOIN news_tree
                ON ntf.news_tree_id = news_tree.id ";
        if ($isNewsTreeActive) $sql .= " AND news_tree.state=1 ";
        $sql .= "
            LEFT JOIN news_banners 
                ON ntf.news_banner_id = news_banners.id ";
        if ($isNewsBannersActive) $sql .= " AND news_banners.state=1 ";
        $sql .= "
            WHERE news.id = ?
        ";
        $result = $DE -> selectRow($sql, $news_id);
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
    
    function getNewsTreeByParentId($parent_id){
        $DE = Project::getDatabase();
        $result = array();
        $sql = "
            SELECT *
            FROM news_tree
            WHERE parent_id = ?
        ";
        $result = $DE -> select($sql, $parent_id);
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
    
    function changeFeeds($id, $name, $url, $type, $state, $text_parse_type){
        $DE = Project::getDatabase();
        $addSql = ($text_parse_type<0)?"":" , `text_parse_type`='".$text_parse_type."'";
        $sql = "
            UPDATE `feeds` SET 
                `name`='".htmlspecialchars($name)."', `url`='".$url."' , `type`='".$type."' , `state`='".$state."' ".$addSql."
            WHERE id = ".$id."
        ";
        $DE -> query($sql);
    }
    
    function deleteFeeds($id){
        $DE = Project::getDatabase();
        $sql = "DELETE FROM `feeds` WHERE id = ".$id;
        $DE -> query($sql);
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
    
    function changeNewsBanner($id, $code, $state){
        $DE = Project::getDatabase();
        $sql = "
            UPDATE `news_banners` SET 
                `code`='".$code."', `state`='".$state."'
            WHERE id = ".$id."
        ";
        $DE -> query($sql);
    }
    
    function deleteNewsBanner($id){
        $DE = Project::getDatabase();
        $sql = "DELETE FROM `news_banners` WHERE id = ".$id;
        $DE -> query($sql);
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
    
    function deleteNewsTreeFeeds($id){
        $DE = Project::getDatabase();
        $sql = "DELETE FROM `news_tree_feeds` WHERE id = ".$id;
        $DE -> query($sql);
    }
    
    function changeNewsTreeFeeds($id, $news_tree_id, $feed_id, $news_banner_id, $category_tag){
        $DE = Project::getDatabase();
        $sql = "
            UPDATE `news_tree_feeds` SET 
                `news_tree_id`='".$news_tree_id."', `feed_id`='".$feed_id."' , `news_banner_id`='".$news_banner_id."' , `category_tag`='".$category_tag."'
            WHERE id = ".$id."
        ";
        $DE -> query($sql);
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
    
    function addNews($news_tree_feeds_id, $title, $link, $short_text, $full_text, $category, $pub_date, $enclosure, $enclosure_type, $comments, $views, $favorite_users, $text_parse_type){
        $DE = Project::getDatabase();
        switch ($text_parse_type){
            case 1:
                $full_text = htmlspecialchars(addslashes($full_text));
                break;
            case 2:
                $full_text = addslashes($full_text);
                break;
            default:
                $full_text = strip_tags(addslashes($full_text));
                break;
        }
        $sql = "
            INSERT INTO `news` (`news_tree_feeds_id` , `title` , `link` , `short_text` , `full_text` ,  `category` , `pub_date` , `enclosure`  ,
                 `enclosure_type` , `comments` , `views`  , `favorite_users` )
            VALUES (
            '".$news_tree_feeds_id."', '".addslashes($title)."',  '".urlencode($link)."', '".strip_tags(addslashes($short_text))."', 
            '".$full_text."', '".addslashes($category)."', '".$pub_date."', '".$enclosure."', '".$enclosure_type."', '".$comments."',  '".$views."', 
            '".$favorite_users."'
            );
        ";
        //echo $sql."<hr>";
        $DE -> query($sql);
        return mysql_insert_id();
    }
    
    function setParseDate($feed_id, $last_parse_date){
        $DE = Project::getDatabase();
        $sql = "
            UPDATE `feeds` SET `last_parse_date` = ? WHERE id = ?
        ";
        $DE -> query($sql, $last_parse_date, $feed_id);
    }
    
    // $lastDate - last date to keep this news in DB
    function deleteOldNews($lastDate){
        $DE = Project::getDatabase();
        $sql = "
            DELETE FROM `news` WHERE pub_date < ? 
        ";
        $DE -> query($sql, $lastDate);
    }
    
    function deleteNewsByNewsTreeFeedsId($news_tree_feeds_id){
        $DE = Project::getDatabase();
        $sql = "
            DELETE FROM `news` WHERE news_tree_feeds_id < ? 
        ";
        $DE -> query($sql, $news_tree_feeds_id);
    }
    
    function getNWordsFromText($text, $nWords){
        $sText = "";
        $aText = split(" ", $text, $nWords);
        if (is_array($aText) && count($aText)>0){
            array_pop($aText);
            $sText = implode(" ", $aText);
        }
        
        return $sText;
    }
    
    function getNewsTreeBreadCrumb($news_tree_id){
	    if ($news_tree_id){
            $newsTree = $this -> getNewsTree($news_tree_id);
            if ($newsTree){
                $this->_aNewsTreeBreadCrumb[] = $newsTree;
                $this->getNewsTreeBreadCrumb($newsTree['parent_id']);
            }
        }
	}
	
	function getNewsTreeChildren($news_tree_id){
	    //$newsTree = $this -> getNewsTree($news_tree_id);
	    //$parent_id = $newsTree['parent_id'];
        $aNewsTree = $this -> getNewsTreeByParentId($news_tree_id);
        foreach ($aNewsTree as $newsTree){
            $this->_aNewsTreeChildren[] = $newsTree;
            $this->getNewsTreeChildren($newsTree['id']);
        }
	}
	
}
?>