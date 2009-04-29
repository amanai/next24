<?php
require_once(dirname(__FILE__). DIRECTORY_SEPARATOR . 'AlbumController.php');
/**
 * Контролер для управления фотоальбомами
 */
	class PhotoController extends AlbumController{
		const DEFAULT_PHOTO_PER_PAGE = 8;
		


		function __construct($view_class = null){
			if ($view_class === null){
				$view_class = "PhotoView";
			}
			parent::__construct($view_class);
		}
		
		
		static public function getAlbumUrl($album_id, $username){
			return Project::getRequest() -> createUrl('Photo', 'Album', array($album_id), $username);
		}
		
		static public function getAlbumEditUrl($album_id, $username){
			return Project::getRequest() -> createUrl('Photo', 'Edit', array($album_id), $username);
		}
		
		static public function getPhotoUrl($photo_id, $username){
			return Project::getRequest() -> createUrl('Photo', 'View', array($photo_id), $username);
		}
		
		public function RatePhotoAction(){
			$photo_id = (int)Project::getRequest() -> id;
			$vote_model = new PhotoVote;
			$photo_model = new PhotoModel;
			$photo_model -> load($photo_id);
			if (((int)$photo_model -> id > 0) && $vote_model -> addVote((int)Project::getUser() -> getDbUser() -> id, $photo_id, $_SERVER['REMOTE_ADDR'])){
				$photo_model -> rating += (int)Project::getRequest() -> rate_value;
				$photo_model -> voices++;
				$photo_model -> save();
				
			}
			Project::getResponse() -> redirect($this -> getPhotoUrl($photo_id, Project::getUser() -> getShowedUser() -> login));
		}
		
		public function ViewAction(){
			$request = Project::getRequest();
			$info = array();
			$this -> BaseSiteData();
			
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			$photo_id = (int)$request -> getKeyByNumber(0);
			$login = $request -> getUsername();
			
			$model = new PhotoModel;
			$model -> load($photo_id);
			$this -> BaseAlbumData($info, $model -> album_id);
			
			$album_model = new AlbumModel;
			$album_model -> load($model -> album_id);
			
			$info['user_id'] = $user_id;
			$info['album_name'] = $album_model -> name;
			$info['album_id'] = $album_model -> id;
			$info['photo_id'] = $model -> id;
			$info['photo_name'] = $model -> name;
			$info['photo_rating'] = ($model -> voices > 0)? $model -> rating/$model -> voices : 0;
			$info['photo_voices'] = $model -> voices;
			$info['photo_creation_date'] = $model -> creation_date;
			$info['photo_file'] = $this -> checkFile($login, $model -> path, false);
			$info['photo_owner_login'] = $login;
			if ((int)$model -> is_rating == 1){
				$info['have_rating'] = true;
			} else {
				$info['have_rating'] = false;
			}
			$info['can_vote'] = PhotoVote::canVote($user_id, $photo_id);
			$info['bottom_list'] = $this -> getPhotoBottomList($request_user_id, $model -> album_id, $login);
			
			$controller = new BaseCommentController();
			$info['comment_list'] = $controller -> CommentList(
																$model -> id,  // Id of comment item
																$request -> getKeyByNumber(1), // current page number
																$this -> getParam('comment_per_page'),  // page size
																'Photo', 'View', 'photo', array($model -> id) // current view params
																);
			
			
			$info['rate_url'] = $request -> createUrl('Photo', 'RatePhoto');
			$info['add_comment_url'] = $request -> createUrl('Photo', 'Comment');
			$info['add_comment_element_id'] = $model -> id;
			$info['add_comment_id'] = 0;

			$info['element_id'] = $model -> id;
			$this -> _view -> Photo($info);
			$this -> _view -> parse();
			return;
		}
		
		static public function getPhotoBottomList($user_id, $album_id, $login){
			$photo_model = new PhotoModel;
			$list = $photo_model -> loadByAlbumUser($user_id, $album_id);
			foreach ($list as &$item){
				$item['thumbnail'] = self::checkFile($login, $item['thumbnail'], $thumb_file = true);
			}
			$info = array();
			$info['photo_list'] = $list;
			$view = new PhotoView;
			$view -> BottomList($info);
			return $view -> parse();
		}
		
		static public function checkFile($login, $fname, $thumb_file = false){
			
			$ret = false;
			if (strlen($login) > 0){
				$dir = USER_UPLOAD_DIR . DIRECTORY_SEPARATOR . $login;
				$err = false;
				$ok = self::checkDir($dir);
				if ($ok === true){
					$album = $dir . DIRECTORY_SEPARATOR . 'album';
					$ok = self::checkDir($album);
				}
				if ($ok === true){
					$images = $album . DIRECTORY_SEPARATOR . 'images';
					$ok = self::checkDir($images);
				}
				
				if (($ok === true) && ($thumb_file === true)){
					$thumbs = $album . DIRECTORY_SEPARATOR . 'thumbs';
					$ok = self::checkDir($thumbs);
				}
				if ($ok === true){
					if ($thumb_file === true){
						$f = $thumbs . DIRECTORY_SEPARATOR . $fname;
					} else {
						$f = $images . DIRECTORY_SEPARATOR . $fname;
					}
					if (file_exists($f) && is_file($f)){
						$ret = Project::getRequest() -> getHost() . 'users/'.$login.'/album/'. ( ($thumb_file === true) ? 'thumbs' : 'images' ) . '/' . $fname;
					}
				}
			}
			return $ret;
		}
		
		
		/**
		 * Delete comment
		 */
		public function CommentDeleteAction(){
			$request = Project::getRequest();
			
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			
			$photo_id = $request -> getKeyByNumber(0);
			$comment_id = $request -> getKeyByNumber(1);
			$comment_model = new PhotoCommentModel($comment_id);
			$photo_model = new PhotoModel;
			$photo_model -> load($photo_id);
			
			if (($comment_model -> id > 0) && ($photo_model -> id > 0) && ($comment_model -> photo_id == $photo_model -> id)){
				if (($comment_model -> user_id == $user_id) || ($photo_model -> user_id == $user_id)){
					$comment_model -> delete($comment_model -> user_id, $comment_id);
				}
			}
			Project::getResponse() -> redirect($this -> getPhotoUrl($photo_id, Project::getUser() -> getShowedUser() -> login));
			//TODO::avatar?warning?mood?
		}
		
		/**
		 * Add or edit comment
		 */
		public function CommentAction(){
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			
			$request = Project::getRequest();
			$comment_id = (int)$request -> id;
			$photo_id = (int)$request -> element_id;
			$text = $request -> comment;
			
			$photo_model = new PhotoModel;
			$photo_model -> load($photo_id);
			$comment_model = new PhotoCommentModel($comment_id);
			if ($photo_model -> id > 0){
				$comment_model -> addComment($user_id, 0, 0, $photo_id, $text, 0);
			}
			Project::getResponse() -> redirect($this -> getPhotoUrl($photo_id, Project::getUser() -> getShowedUser() -> login));
		}
		
		public function SaveAction(){
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			$login = Project::getUser() -> getDbUser() -> login;
			$request = Project::getRequest();
			
			$album = USER_UPLOAD_DIR . DIRECTORY_SEPARATOR . $login . DIRECTORY_SEPARATOR . 'album' . DIRECTORY_SEPARATOR;
			$thumbs = $album . 'thumbs' . DIRECTORY_SEPARATOR;
			$images = $album . 'images' . DIRECTORY_SEPARATOR;
			clearstatcache();
			$album_id = 0;
			if (is_array($request -> photo_id)){
				foreach ($request -> photo_id as $photo_id){
					$photo_id = (int)$photo_id;
					$photo_model = new PhotoModel;
					$photo_model -> load($photo_id);
					
					// Проверка, является ли пользователем владельцем альбома
					if (((int)$photo_model -> id > 0) && ((int)$photo_model -> user_id === $user_id)){
						if (isset($request -> photo_del[$photo_id])){
							// Delete album
							
							$f = $thumbs . $photo_model -> path;
							if (file_exists($f) && is_file($f)){
								unlink($f);
							}
							$f = $images . $photo_model -> thumbnail;
							if (file_exists($f) && is_file($f)){
								unlink($f);
							}
							$photo_model -> delete($photo_id);
						} else {
							$photo_model -> is_rating = isset($request -> is_rating[$photo_id])?1:0;
							$photo_model -> is_onmain = isset($request -> is_onmain[$photo_id])?1:0;
							$photo_model -> access = (int)$request -> photo_access[$photo_id];
							$photo_model -> name = isset($request -> photo_name[$photo_id])?$request -> photo_name[$photo_id]:$photo_model -> name;
							$photo_model -> save();
							if ($album_id == 0){
								$album_id = (int)$photo_model -> album_id;
							}
						}
					}
					
				}
			}
			
			if ($album_id > 0){
				$album_model = new AlbumModel;
				$album_model -> load($album_id);
				$album_model -> thumbnail_id = (int)$request -> thumb_photo;
				$album_model -> save();
			}
			Project::getResponse() -> redirect($this -> getAlbumUrl($album_id, $login));
			
		}
		
		public function EditAction($filter = array(), $album_id = null){
			$this -> AlbumAction($edit = true, $filter, $album_id);
		}
		
		public function AlbumAction($edit = false, $filter = array(), $album_id = null){
			$this -> BaseSiteData();
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			$album_id = ((int)$album_id > 0) ? $album_id : (int)Project::getRequest() -> getKeyByNumber(0);
			$info = array();

			if (($request_user_id === $user_id) && ($edit === true)){
				$info['can_edit'] = true;
				$info['access_list'] = HelpFunctions::getAccessList();
			}
			
			if ((int)Project::getUser() -> getShowedUser() -> id <= 0){
				$tabs = TabController::getMainAlbumTabs(false, false, true);
			} else {
			//	$tabs = TabController::getOwnTabs(false, true);
				$tabs = TabController::getOwnTabs(false, false, true);
			}
			$info['tab_list'] = $tabs;
			
			$album_model = new AlbumModel;
			$album_model -> load($album_id);
			$info['thumbnail_id'] = (int)$album_model -> thumbnail_id;
			
			$this -> BaseAlbumData($info, $album_id);

		
			$photo_model = new PhotoModel;
			$photo_model -> filter = $filter;
			
			$pager = new DbPager(Project::getRequest() -> getKeyByNumber(1), $this -> getParam('photo_per_page', self::DEFAULT_PHOTO_PER_PAGE));
			$photo_model -> setPager($pager);
			$list = $photo_model -> loadByAlbumUser($request_user_id, $album_id);

			$this -> checkImages($list);
			$info['photo_list'] = $list;
			$info['list_pager'] = $photo_model -> getPager();
			$info['list_controller'] = 'Photo';
			$info['list_action'] = 'Album';
			$info['list_user'] = null;
			$info['user_id'] = $user_id;
			$this->_view->assign('current_album_name', $album_model->name);
			$this -> _view -> PhotoList($info);
			$this -> _view -> parse();
		}
		
		function LastListAction($info = array()){
			
			$this -> BaseSiteData();
			
			$info['tab_list'] = TabController:: getMainAlbumTabs(false, true, false);
			
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			$album_id = (isset($album_id) && ((int)$album_id > 0)) ? $album_id : (int)Project::getRequest() -> getKeyByNumber(0);

			
			$this -> BaseAlbumData($info, $album_id);
			
			

		
			$photo_model = new PhotoModel;
			$pager = new DbPager(Project::getRequest() -> getValueByNumber(1), $this -> getParam('last_photo_per_page', self::DEFAULT_PHOTO_PER_PAGE));
			$photo_model -> setPager($pager);
			$list = $photo_model -> loadAll($request_user_id, $album_id);
			$this -> checkImages($list);
			$info['photo_list'] = $list;
			
			$info['list_pager'] = $photo_model -> getPager();
			$info['list_controller'] = 'Photo';
			$info['list_action'] = 'Album';
			$info['list_user'] = null;
			$this -> _view -> LastList($info);
			$this -> _view -> parse();
		}

		private function checkImages(&$list){
			parent::checkAlbumList($list);
		}
		
		
		/**
		 * Вывод топовых фотографий
		 */
		public function TopListAction(){
			$info = array();
			$info['left_panel'] = false;
			$this -> LastListAction($info);
		}
	}
?>