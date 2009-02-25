<?php
class BlogModelSocieties extends BaseModel{
		function __construct($modelName='blog_societies'){
			parent::__construct($modelName);
		}
		
		function loadByUserId($user_id){
			$result = Project::getDatabase() -> selectRow("SELECT * FROM blog_societies WHERE user_id = ?d LIMIT 1", $user_id);
			$this -> bind($result);
			return $result;
		}
		
		function deletePostsByUb_tree_id($ub_tree_id){
		    $sql ="
		      DELETE FROM `blog_banners_societies`
		      WHERE ub_tree_id = '".$ub_tree_id."'
		    ";
		    Project::getDatabase() -> query($sql);
		}
		
		
		
		/* blog_banner */
		
		function getBlogBannerById($id){
		    $sql ="
		      SELECT * FROM `blog_banners_societies`
		      WHERE id = '".$id."'
		    ";
		    return Project::getDatabase() -> selectRow($sql);		    
		}
		
		function changeBlogBanner($id, $code){
		    $sql ="
		      UPDATE `blog_banners_societies` SET code = '".stripslashes($code)."'
		      WHERE id = '".$id."'
		    ";
		    Project::getDatabase() -> query($sql);		    
		}
		
		function addBlogBanner($code){
		    $sql ="
		      INSERT INTO `blog_banners_societies` (code)
		      VALUES ('".stripslashes($code)."')
		    ";
		    Project::getDatabase() -> query($sql);	
		    return mysql_insert_id();	    
		}
		
		/* END blog_banner */
}
?>