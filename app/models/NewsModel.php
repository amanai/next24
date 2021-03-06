<?php
class NewsModel extends BaseModel{
    var $_aNewsTreeBreadCrumb = array();    
    var $_aNewsTreeChildren = array();    
    
    function __construct(){
        parent::__construct('news');
    }
    

    function getAllNews(){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            SELECT * 
            FROM news_tree 
            ORDER BY name
        ";
        $result = $DE -> select($sql);
        return $result;
    }
    
    /**
     * NewsTreeFeeds
     */
    
    function getAllNewsTreeFeeds($where="", $isFeedActive = true, $isNewsTreeActive = true, $isNewsBannersActive = true){
        $DE = Project::getDatabase();
        $result = array();
        $sql = "
            SELECT  ntf.*,  ntf.id as news_tree_feeds_id,
                    feeds.user_id as feeds_user_id, feeds.name as feeds_name, feeds.url, feeds.type, feeds.state as feeds_state, 
                    feeds.creation_date, feeds.last_parse_date, feeds.text_parse_type,  feeds.is_partner, 
                    news_tree.parent_id, news_tree.user_id as news_tree_user_id, news_tree.name as news_tree_name, news_tree.state as news_tree_state, 
                    news_banners.user_id as news_banners_user_id, news_banners.code, news_banners.state as news_banners_state, 
                    users.login as user_login 
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
        $sql .= "
            LEFT JOIN users 
                ON feeds.user_id = users.id ";
        $sql .= $where;
        $sql .= " ORDER BY feeds.creation_date ";
//echo $sql;
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
                    feeds.creation_date, feeds.last_parse_date, feeds.text_parse_type,  feeds.is_partner, 
                    news_tree.parent_id, news_tree.user_id as news_tree_user_id, news_tree.name as news_tree_name, news_tree.state as news_tree_state, 
                    news_banners.user_id as news_banners_user_id, news_banners.code, news_banners.state as news_banners_state,
                    users.login as user_login  
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
        $sql .= "
            LEFT JOIN users 
                ON feeds.user_id = users.id ";
        $sql .= " ORDER BY feeds.creation_date ";

        $result = $DE -> select($sql);
        return $result;
    }
    
    /**
     * END NewsTreeFeeds
     */
    
    
    /**
     * News
     */
    
    function getNewsByNewsTreeId($news_tree_id, $user_id=0, $isOnlySubscribeNewsTree = false, $isOnlyFavoriteNews = false, $page_settings=array(), $isFeedActive = true, $isNewsTreeActive = true, $isNewsBannersActive = true){
        $DE = Project::getDatabase();
        $result = array(); 
        if (is_array($page_settings) && count($page_settings)>0){
            $record_per_page = $page_settings['record_per_page'];
            $current_page_number = $page_settings['current_page_number'];
            $sqlLimit = " LIMIT ".(($current_page_number-1)*$record_per_page).", ".$record_per_page." ";;
        }else $sqlLimit ="";
        
        /*
        $this -> getNewsTreeChildren($news_tree_id);
        $this -> _aNewsTreeChildren[] = $this -> getNewsTree($news_tree_id);
        //echo "<pre>";print_r($this -> _aNewsTreeChildren); echo "</pre><hr>";
        foreach ($this -> _aNewsTreeChildren as $news_tree){
            if ($news_tree) $addWhere .= " news_tree.id = ".$news_tree['id']." OR ";
        }
        if ($addWhere == ' AND (') $addWhere=""; else $addWhere = substr($addWhere, 0, -3)." ) ";
        */

        $sql = "
            SELECT  ntf.*, ntf.id as news_tree_feeds_id,
                    feeds.user_id as feeds_user_id, feeds.name as feeds_name, feeds.url, feeds.type, feeds.state as feeds_state, 
                    feeds.creation_date, feeds.last_parse_date, feeds.text_parse_type, feeds.is_partner,  
                    news_tree.parent_id, news_tree.user_id as news_tree_user_id, news_tree.name as news_tree_name, news_tree.state as news_tree_state, 
                    news_banners.user_id as news_banners_user_id, news_banners.code, news_banners.state as news_banners_state ,
                    news.id as news_id, news.title as news_title, news.link as news_link, news.short_text as news_short_text, 
                    news.full_text as news_full_text,  news.pub_date,  news.enclosure,  news.enclosure_type,  
                    news.comments,  news.views, news.favorite_users,
                    favorite_news.id as favorite_news_id
            FROM news_tree_feeds as ntf
            INNER JOIN feeds 
                ON ntf.feed_id = feeds.id ";
        if ($isFeedActive) $sql .= " AND feeds.state=1 ";
        $sql .= "
            INNER JOIN news_tree 
                ON ntf.news_tree_id = news_tree.id ";//.$addWhere;
        if ($isNewsTreeActive) $sql .= " AND news_tree.state=1 ";
        $sql .= "
            INNER JOIN news 
                ON ntf.id = news.news_tree_feeds_id ";
        $sql .= "
            LEFT JOIN news_banners 
                ON ntf.news_banner_id = news_banners.id ";
        if ($isNewsBannersActive) $sql .= " AND news_banners.state=1 ";
        
        if ($isOnlySubscribeNewsTree){
            $sql .= "
            INNER JOIN news_subscribe 
                ON ntf.id = news_subscribe.news_tree_feeds_id AND news_subscribe.user_id = ".$user_id;
        }
        if ($isOnlyFavoriteNews){
            $sql .= "
            INNER JOIN favorite_news 
                ON news.id = favorite_news.news_id AND favorite_news.user_id = ".$user_id;
        }else{
            $sql .= "
            LEFT JOIN favorite_news 
                ON news.id = favorite_news.news_id AND favorite_news.user_id = ".$user_id;
        }
        $sql .= " WHERE news_tree.id = ".$news_tree_id. " AND (feeds.is_partner = 1 OR feeds.user_id = ".$user_id." ) ";
        $sql .= "
            ORDER BY pub_date DESC ".$sqlLimit;
//echo "<hr>".$sql."<hr>";
        $result = $DE -> select($sql);
        return $result;
    }
    
    function getNewsByNewsTreeFeedsId($news_tree_feeds_id, $user_id=0, $isOnlySubscribeNewsTree = false, $isOnlyFavoriteNews = false, $page_settings=array(), $isFeedActive = true, $isNewsTreeActive = true, $isNewsBannersActive = true){
        $DE = Project::getDatabase();
        $result = array();
        if (is_array($page_settings) && count($page_settings)>0){
            $record_per_page = $page_settings['record_per_page'];
            $current_page_number = $page_settings['current_page_number'];
            $sqlLimit = " LIMIT ".(($current_page_number-1)*$record_per_page).", ".$record_per_page." ";;
        }else $sqlLimit ="";
        
        $sql = "
            SELECT  ntf.*, ntf.id as news_tree_feeds_id,
                    feeds.user_id as feeds_user_id, feeds.name as feeds_name, feeds.url, feeds.type, feeds.state as feeds_state, 
                    feeds.creation_date, feeds.last_parse_date, feeds.text_parse_type, feeds.is_partner, 
                    news_tree.parent_id, news_tree.user_id as news_tree_user_id, news_tree.name as news_tree_name, news_tree.state as news_tree_state, 
                    news_banners.user_id as news_banners_user_id, news_banners.code, news_banners.state as news_banners_state ,
                    news.id as news_id, news.title as news_title, news.link as news_link, news.short_text as news_short_text, 
                    news.full_text as news_full_text,  news.pub_date,  news.enclosure,  news.enclosure_type,  
                    news.comments,  news.views, news.favorite_users,
                    favorite_news.id as favorite_news_id  
            FROM news_tree_feeds as ntf
            INNER JOIN feeds 
                ON ntf.feed_id = feeds.id ";
        if ($isFeedActive) $sql .= " AND feeds.state=1 ";
        $sql .= "
            INNER JOIN news_tree 
                ON ntf.news_tree_id = news_tree.id  ";
        if ($isNewsTreeActive) $sql .= " AND news_tree.state=1 ";
        $sql .= "
            INNER JOIN news 
                ON ntf.id = news.news_tree_feeds_id ";
        $sql .= "
            LEFT JOIN news_banners 
                ON ntf.news_banner_id = news_banners.id ";
        if ($isNewsBannersActive) $sql .= " AND news_banners.state=1 ";
        if ($isOnlySubscribeNewsTree){
            $sql .= "
            INNER JOIN news_subscribe 
                ON ntf.id = news_subscribe.news_tree_feeds_id AND news_subscribe.user_id = ".$user_id;
        }
        if ($isOnlyFavoriteNews){
            $sql .= "
            INNER JOIN favorite_news 
                ON news.id = favorite_news.news_id AND favorite_news.user_id = ".$user_id;
        }else{
            $sql .= "
            LEFT JOIN favorite_news 
                ON news.id = favorite_news.news_id AND favorite_news.user_id = ".$user_id;
        }
        $sql .= " WHERE ntf.id = ".$news_tree_feeds_id. " AND (feeds.is_partner = 1 OR feeds.user_id = ".$user_id." ) ";
        $sql .= "
            ORDER BY pub_date DESC ".$sqlLimit;
//echo "<hr>".$sql;
        $result = $DE -> select($sql);
        return $result;
    }
    
    function getNewsCountByNewsTreeFeedsId($news_tree_feeds_id, $user_id = 0, $isOnlySubscribeNewsTree = false, $isOnlyFavoriteNews = false, $isFeedActive = true, $isNewsTreeActive = true){
        $DE = Project::getDatabase();
        $result = array();
        $sql = "
            SELECT count(*) as c
            FROM news_tree_feeds as ntf
            INNER JOIN feeds 
                ON ntf.feed_id = feeds.id ";
        if ($isFeedActive) $sql .= " AND feeds.state=1 ";
        $sql .= "
            INNER JOIN news_tree 
                ON ntf.news_tree_id = news_tree.id  ";
        if ($isNewsTreeActive) $sql .= " AND news_tree.state=1 ";
        $sql .= "
            INNER JOIN news 
                ON ntf.id = news.news_tree_feeds_id ";
        if ($isOnlySubscribeNewsTree){
            $sql .= "
            INNER JOIN news_subscribe 
                ON ntf.id = news_subscribe.news_tree_feeds_id AND news_subscribe.user_id = ".$user_id;
        }
        if ($isOnlyFavoriteNews){
            $sql .= "
            INNER JOIN favorite_news 
                ON news.id = favorite_news.news_id AND favorite_news.user_id = ".$user_id;
        }
        $sql .= " WHERE ntf.id = ".$news_tree_feeds_id." AND (feeds.is_partner = 1 OR feeds.user_id = ".$user_id.") ";

        $result = $DE -> selectRow($sql);
        return $result['c'];
    }
    
    function getNewsCountByNewsTreeId($news_tree_id, $user_id = 0, $isOnlySubscribeNewsTree = false, $isOnlyFavoriteNews = false, $isFeedActive = true, $isNewsTreeActive = true){
        $DE = Project::getDatabase();
        $result = array();
        $sql = "
            SELECT count(*) as c
            FROM news_tree_feeds as ntf
            INNER JOIN feeds 
                ON ntf.feed_id = feeds.id ";
        if ($isFeedActive) $sql .= " AND feeds.state=1 ";
        $sql .= "
            INNER JOIN news_tree 
                ON ntf.news_tree_id = news_tree.id  ";
        if ($isNewsTreeActive) $sql .= " AND news_tree.state=1 ";
        $sql .= "
            INNER JOIN news 
                ON ntf.id = news.news_tree_feeds_id ";
        if ($isOnlySubscribeNewsTree){
            $sql .= "
            INNER JOIN news_subscribe 
                ON ntf.id = news_subscribe.news_tree_feeds_id AND news_subscribe.user_id = ".$user_id;
        }
        if ($isOnlyFavoriteNews){
            $sql .= "
            INNER JOIN favorite_news 
                ON news.id = favorite_news.news_id AND favorite_news.user_id = ".$user_id;
        }
        $sql .= " WHERE news_tree.id = ".$news_tree_id. " AND (feeds.is_partner = 1 OR feeds.user_id = ".$user_id." ) ";
//echo "<hr>".$sql;        
        $result = $DE -> selectRow($sql);
        return $result['c'];
    }
    
    function getNewsById($news_id, $user_id, $isNewsTreeActive = true, $isNewsBannersActive = true){
        $DE = Project::getDatabase();
        $result = array();
        $sql = "
            SELECT  ntf.*, ntf.id as news_tree_feeds_id,
                    news_tree.parent_id, news_tree.user_id as news_tree_user_id, news_tree.name as news_tree_name, news_tree.state as news_tree_state, 
                    news_banners.user_id as news_banners_user_id, news_banners.code, news_banners.state as news_banners_state ,
                    news.id as news_id, news.title as news_title, news.link as news_link, news.short_text as news_short_text, 
                    news.full_text as news_full_text,  news.pub_date,  news.enclosure,  news.enclosure_type,  
                    news.comments,  news.views, news.favorite_users,
                    feeds.user_id as feeds_user_id, feeds.name as feeds_name, feeds.url, feeds.type, feeds.state as feeds_state, 
                    feeds.creation_date, feeds.last_parse_date, feeds.text_parse_type,
                    favorite_news.id as favorite_news_id 
            FROM news
            INNER JOIN news_tree_feeds as ntf
                ON news.news_tree_feeds_id = ntf.id 
            INNER JOIN news_tree
                ON ntf.news_tree_id = news_tree.id 
            INNER JOIN feeds
                ON ntf.feed_id = feeds.id ";
        if ($isNewsTreeActive) $sql .= " AND news_tree.state=1 ";
        $sql .= "
            LEFT JOIN news_banners 
                ON ntf.news_banner_id = news_banners.id ";
        if ($isNewsBannersActive) $sql .= " AND news_banners.state=1 ";
        $sql .= "
            LEFT JOIN favorite_news 
                ON news.id = favorite_news.news_id AND favorite_news.user_id = ".$user_id;
        $sql .= "
            WHERE news.id = ?
        ";
//echo $sql;exit;
        $result = $DE -> selectRow($sql, $news_id);
        return $result;
    }
    
    
    /**
     * END News
     */

    function getFeedsByNewsTreeId($news_tree_id){
        $DE = Project::getDatabase();
        $result = array();
        $sql = "
            SELECT feeds.*, ntf.id as news_tree_feeds_id
            FROM news_tree_feeds as ntf
            INNER JOIN feeds 
                ON ntf.feed_id = feeds.id
            WHERE ntf.news_tree_id = ?
        ";
        $result = $DE -> select($sql, $news_tree_id);
        return $result;
    }
    
    /**
     * NewsTree
     */
    
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
    
    function getNewsTreeByListNewsSubscribe($aNewsSubscribe){
        $DE = Project::getDatabase();
        $addWhere = "WHERE";
        foreach ($aNewsSubscribe as $newsSubscribe){
            $addWhere .= " ntf.id = ".$newsSubscribe['news_tree_feeds_id']." OR";
        }
        $addWhere = ($addWhere=="WHERE")?"":substr($addWhere, 0, -2);
        
        $result = array();
        $sql = "
            SELECT news_tree.id
            FROM news_tree
            INNER JOIN news_tree_feeds as ntf
                ON ntf.news_tree_id = news_tree.id
            ".$addWhere."
            GROUP BY news_tree.id
        ";
        $result = $DE -> select($sql);
        return $result;
    }
    
    
    function getNewsTreeByUserFavorite($user_id){
        $DE = Project::getDatabase();
        $result = array();
        
        $sql = "
            SELECT news_tree.id
            FROM news_tree
            INNER JOIN news_tree_feeds as ntf
                ON ntf.news_tree_id = news_tree.id
            INNER JOIN news
                ON ntf.id = news.news_tree_feeds_id
            INNER JOIN favorite_news
                ON news.id = favorite_news.news_id
            GROUP BY news_tree.id
        ";
        $result = $DE -> select($sql);
        return $result;
    }
    
    function getAllNewsTree(){
        $DE = Project::getDatabase();
        
        $result = array();
        $sql = "
            SELECT news_tree.id
            FROM news_tree
            INNER JOIN news_tree_feeds as ntf
                ON ntf.news_tree_id = news_tree.id
            GROUP BY news_tree.id
        ";
        $result = $DE -> select($sql);
        return $result;
    }
    
    function addNewsTree($parent_id, $user_id, $name, $state){
        $DE = Project::getDatabase();
        $sql = "
            INSERT INTO `news_tree` (`parent_id` , `user_id` , `name` , `state`)
            VALUES (
            '".$parent_id."', '".$user_id."', '".htmlspecialchars($name)."', '".$state."'
            );
        ";
        $DE -> query($sql);
        return mysql_insert_id();
    }
    
    function changeNewsTree($news_tree_id, $parent_id, $user_id, $name, $state){
        $DE = Project::getDatabase();
        $sql = "
            UPDATE `news_tree` SET `parent_id` = '".$parent_id."' , `user_id` = '".$user_id."' , `name`='".htmlspecialchars($name)."' , `state`='".$state."'
            WHERE id = ?
        ";
        $DE -> query($sql, $news_tree_id);
        return mysql_insert_id();
    }
    
    function deleteNewsTree($news_tree_id){
        $DE = Project::getDatabase();
        $sql ="SELECT * FROM news_tree_feeds WHERE news_tree_id = ? ";
        $result = $DE->select($sql, $news_tree_id);
        if (!$result){ // no connection records
            $sql ="SELECT * FROM news_tree WHERE parent_id = ? ";
            $result = $DE->select($sql, $news_tree_id);
            if (!$result){ // no childrens
                $sql = "DELETE FROM `news_tree` WHERE id = ? ";
                $DE -> query($sql, $news_tree_id);
                return  true;
            }
        }
        return false;
    }
    
    function deleteNewsTreeCascade($news_tree_id){
        $DE = Project::getDatabase();
        $sql = "
            DELETE news_tree, news_tree_feeds, feeds, news_banners, news, news_subscribe, favorite_news 
            FROM  news_tree
            LEFT JOIN news_tree_feeds
                ON news_tree.id = news_tree_feeds.news_tree_id
            LEFT JOIN feeds
                ON news_tree_feeds.feed_id = feeds.id 
            LEFT JOIN news_banners
                ON news_tree_feeds.news_banner_id=news_banners.id
            LEFT JOIN news_subscribe
                ON news_tree_feeds.id=news_subscribe.news_tree_feeds_id
            LEFT JOIN news
                ON news_tree_feeds.id=news.id
            LEFT JOIN favorite_news
                ON favorite_news.news_id=news.id
            WHERE news_tree.id = ? 
        ";
        $DE -> query($sql, $news_tree_id);
        return mysql_insert_id();
    }
    
    function getUserById($user_id){
        $DE = Project::getDatabase();
        $sql = "SELECT * FROM users WHERE id = ? ";
        $result = $DE -> selectRow($sql, $user_id);
        return $result;
    }
    
    /**
     * END NewsTree
     */
    
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
    
    function addFeeds($user_id, $name, $url, $type, $state, $creation_date, $text_parse_type, $is_partner){
        $DE = Project::getDatabase();
        $sql = "
            INSERT INTO `feeds` (`user_id` , `name` , `url` , `type` , `state` , `creation_date` ,  `text_parse_type` , `is_partner` )
            VALUES (
            '".$user_id."', '".htmlspecialchars($name)."', '".$url."', '".$type."', '".$state."', '".$creation_date."', '".$text_parse_type."', '".$is_partner."'
            );
        ";
        $DE -> query($sql);
        return mysql_insert_id();
    }
    
    function changeFeeds($id, $name, $url, $type, $state, $text_parse_type, $is_partner){
        $DE = Project::getDatabase();
        $addSql = ($text_parse_type<0)?"":" , `text_parse_type`='".$text_parse_type."'";
        $sql = "
            UPDATE `feeds` SET 
                `name`='".htmlspecialchars($name)."', `url`='".$url."' , `type`='".$type."' , `state`='".$state."' , `is_partner`='".$is_partner."' 
                ".$addSql."
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
    
    function setNews_FavoriteUsers($news_id){
        $DE = Project::getDatabase();
        $sql = "
            SELECT count(*) as c
            FROM favorite_news
            WHERE news_id = ?
        ";
        $nFavoriteUsers = $DE -> selectRow($sql, $news_id);
        $nFavoriteUsers = $nFavoriteUsers['c'];
        $sql = "
            UPDATE news SET favorite_users=? WHERE id=?
        ";
        $DE -> query($sql, $nFavoriteUsers, $news_id);
    }
    
    function setNews_Views($news_id, $inc){
        $DE = Project::getDatabase();
        $sql = "
            UPDATE news 
            SET views = views+?
            WHERE id = ?
        ";
        $DE -> query($sql, $inc, $news_id);
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
            DELETE FROM news WHERE pub_date < ? AND favorite_users<1
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
    
    
    
    // get all parents. Ex.: mainCat -> cat1 -> cat2 -> lastCat
    function getNewsTreeBreadCrumb($news_tree_id){
	    if ($news_tree_id){
            $newsTree = $this -> getNewsTree($news_tree_id);
            if ($newsTree){
                $this->_aNewsTreeBreadCrumb[] = $newsTree;
                $this->getNewsTreeBreadCrumb($newsTree['parent_id']);
            }
        }
	}
	
	// get all leafs
	function getNewsTreeChildren($news_tree_id){
        $aNewsTree = $this -> getNewsTreeByParentId($news_tree_id);
        foreach ($aNewsTree as $newsTree){
            $this->_aNewsTreeChildren[] = $newsTree;
            $this->getNewsTreeChildren($newsTree['id']);
        }
	}
	
	
	
	function setNewsSubscribe($userId, $aNewsTreeFeedsId){
	    $DE = Project::getDatabase();
        $sql = "DELETE FROM `news_subscribe` WHERE user_id=? ";
        $DE -> query($sql, $userId);
        if (is_array($aNewsTreeFeedsId) && count($aNewsTreeFeedsId)>0){
            $sql = "INSERT INTO `news_subscribe` (  `user_id` , `news_tree_feeds_id` ) VALUES ";
            foreach ($aNewsTreeFeedsId as $newsTreeFeeds){
                $sql .= "(".$userId.", ".$newsTreeFeeds."),";
            }
            $sql = substr($sql, 0, -1);
            $DE -> query($sql, $userId);
        }
	}
	
	function getNewsSubscribeByUserId($userId){
	    $DE = Project::getDatabase();
        $result = array();
        $sql = "
            SELECT *
            FROM news_subscribe
            WHERE user_id = ?  
        ";
        $result = $DE -> select($sql, $userId);
        return $result;
	}
	
	function setNewsFavorite($news_id, $user_id){
	    $DE = Project::getDatabase();
	    $favoriteNews = $this -> getNewsFavorite($news_id, $user_id);
	    if ($favoriteNews){
	        $sql = "DELETE FROM `favorite_news` WHERE user_id = ".$user_id." AND news_id = ".$news_id;
	    }else{
	        $sql = "INSERT INTO `favorite_news` (  `user_id` , `news_id` ) VALUES (".$user_id.", ".$news_id.") ";
	    }
        $DE -> query($sql);
        $this -> setNews_FavoriteUsers($news_id);
	}
	
	function getNewsFavorite($news_id, $user_id){
	    $DE = Project::getDatabase();
        $result = array();
        $sql = "
            SELECT *
            FROM favorite_news
            WHERE user_id = ? AND news_id = ?  
        ";
        //echo $sql.$user_id." ".$news_id."\n";
        $result = $DE -> selectRow($sql, $user_id, $news_id);
        return $result;
	}
	
}
?>