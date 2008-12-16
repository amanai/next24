<?php
class BlogModel extends BaseModel{
		function __construct($modelName='blog'){
			parent::__construct($modelName);
		}
		
		function loadByUserId($user_id){
			$result = Project::getDatabase() -> selectRow("SELECT * FROM blog WHERE user_id = ?d LIMIT 1", $user_id);
			$this -> bind($result);
			return $result;
		}
		
		function deletePostsByUb_tree_id($ub_tree_id){
		    $sql ="
		      DELETE FROM `blog_post`
		      WHERE ub_tree_id = '".$ub_tree_id."'
		    ";
		    Project::getDatabase() -> query($sql);
		}
		
		
		
		/* blog_banner */
		
		function getBlogBannerById($id){
		    $sql ="
		      SELECT * FROM `blog_banners`
		      WHERE id = '".$id."'
		    ";
		    return Project::getDatabase() -> selectRow($sql);		    
		}
		
		function changeBlogBanner($id, $code){
		    $sql ="
		      UPDATE `blog_banners` SET code = '".stripslashes($code)."'
		      WHERE id = '".$id."'
		    ";
		    Project::getDatabase() -> query($sql);		    
		}
		
		function addBlogBanner($code){
		    $sql ="
		      INSERT INTO `blog_banners` (code)
		      VALUES ('".stripslashes($code)."')
		    ";
		    Project::getDatabase() -> query($sql);	
		    return mysql_insert_id();	    
		}
		
		/* END blog_banner */
}
?>