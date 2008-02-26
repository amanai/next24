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
		
		public function UploadFormAction(){
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			
			if (!isset($user['id']) || ((int)$user['id'] <= 0)){
				// TODO:: user is not logged or something wrong at his session data
				
			}
			$user_id = (int)$user['id'];
			$login = trim($user['login']);
			
			$this->setModel("Albums");
			$this -> model -> resetSql();
			$this -> model -> where('user_id='.(int)$user_id);
			$list = $this -> model -> getAll();
			$this -> view -> album_list = $list;
			
			$this->view->content .= $this->view->render(VIEWS_PATH.'albums/user_albums.tpl.php');
			$this->view->display();
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
			
			$info = array();
			$this -> BaseSiteData();
			
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			$photo_id = (int)Project::getRequest() -> getKeyByNumber(0);
			$login = Project::getRequest() -> getUsername();
			
			$model = new PhotoModel;
			$model -> load($photo_id);
			$this -> BaseAlbumData($info, $model -> album_id);
			
			$album_model = new AlbumModel;
			$album_model -> load($model -> album_id);
			
			$info['album_name'] = $album_model -> name;
			$info['album_id'] = $album_model -> id;
			$info['photo_id'] = $model -> id;
			$info['photo_name'] = $model -> name;
			$info['photo_rating'] = ($model -> voices > 0)? $model -> rating/$model -> voices : 0;
			$info['photo_voices'] = $model -> voices;
			$info['photo_creation_date'] = $model -> creation_date;
			$info['photo_file'] = $this -> checkFile($login, $model -> path, false);
			$info['photo_owner_login'] = $login;
			$info['can_vote'] = PhotoVote::canVote($user_id, $photo_id);
			$info['bottom_list'] = $this -> getPhotoBottomList($request_user_id, $model -> album_id, $login);
			$info['comment_list'] = $this -> getCommentList($model -> id, Project::getRequest() -> getKeyByNumber(1), $this -> getParam('comment_per_page'));
			$info['rate_url'] = Project::getRequest() -> createUrl('Photo', 'RatePhoto');
			$info['add_comment_url'] = Project::getRequest() -> createUrl('Photo', 'Comment');
			$info['element_id'] = $model -> id;
			$this -> _view -> Photo($info);
			$this -> _view -> parse();
			return;
		}
		
		public function getCommentList($photo_id, $page_number, $page_size){
			$controller = new BaseCommentController();
			return $controller -> CommentList('PhotoComment', $photo_id, $page_number, $page_size, 'Photo', 'CommentDelete');
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
		
		public function CommentDeleteAction(){
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			$user_id = (int)$user['id'];
			
			//TODO::avatar?warning?mood?
			$this -> setModel("PhotoComment");
			$this -> model -> delete($user_id, $this->id);
			
			$router = getManager('CRouter');
			$router -> redirect($router -> createUrl('Photo', 'View', array('id'=>$this->photo_id)));
			
		}
		
		public function CommentAction(){
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			$user_id = (int)$user['id'];
			
			//TODO::avatar?warning?mood?
			$this -> setModel("PhotoComment");
			$this -> model -> addComment($user_id, 0, 0, $this -> id, $this -> comment, 0);
			
			$router = getManager('CRouter');
			$router -> redirect($router -> createUrl('Photo', 'View', array('id'=>$this->id)));

		}
		
		public function SaveAction(){
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			$user_id = (int)$user['id'];
			$login = trim($user['login']);
			$album = USER_UPLOAD_DIR . DIRECTORY_SEPARATOR . $login . DIRECTORY_SEPARATOR . 'album' . DIRECTORY_SEPARATOR;
			$thumbs = $album . 'thumbs' . DIRECTORY_SEPARATOR;
			$images = $album . 'images' . DIRECTORY_SEPARATOR;
			clearstatcache();
			$album_id = 0;
			if (is_array($this -> photo_ids)){
				foreach ($this -> photo_ids as $photo_id){
					$photo_id = (int)$photo_id;
					$this->setModel("Photos");
					$this -> model -> resetSql();
					$this -> model -> load($photo_id);
					$photo_info = $this -> model -> getData();
					// Проверка, является ли пользователем владельцем альбома
					if (((int)$this -> model -> id > 0) && ((int)$this -> model -> get('user_id') === $user_id)){
						if (isset($this -> photo_del[$photo_id]) && ($this -> photo_del[$photo_id] == "on")){
							// Delete album
							$this -> setModel("PhotoComment");
							$this -> model -> deleteByItem($user_id, $photo_id);
							$f = $thumbs . $photo_info['path'];
							if (file_exists($f) && is_file($f)){
								unlink($f);
							}
							$f = $images . $photo_info['thumbnail'];
							if (file_exists($f) && is_file($f)){
								unlink($f);
							}
							$this -> setModel("Photos");
							$this -> model -> id = $photo_id;
							$this -> model -> delete();
						} else {
							$this -> model -> set('is_rating', (isset($this -> photo_rating[$photo_id])?1:0));
							$this -> model -> set('name', (isset($this -> photo_name[$photo_id])?$this -> photo_name[$photo_id]:$this -> model -> get('name')));
							$this -> model -> save();
							if ($album_id == 0){
								$album_id = (int)$this -> model -> get('album_id');
							}
						}
					}
					
				}
			}
			
			if ($album_id > 0){
				$this -> setModel("Albums");
				$this -> model -> load($album_id);
				$this -> model -> set('thumbnail_id', (int)$this -> thumb_photo);
				$this -> model -> save();
			}
			$router = getManager('CRouter');
			$router -> redirect($router -> createUrl('Photo', 'Edit', array('id'=>$album_id)));
			/*echo '<pre>';
			print_r($this -> thumb_photo);
			print_r($this -> photo_ids);
			print_r($this -> photo_rating);
			print_r($this -> photo_del);
			print_r($this -> photo_name);
			die;*/
		}
		
		public function EditAction(){
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			$user_id = (int)$user['id'];
			
			
			$this->setModel("Albums");
			$this -> model -> resetSql();
			
			$this -> model -> cols('user_id, thumbnail_id');
			$this -> model -> where('id='.(int)$this -> id);
			$o = $this -> model -> getOne();
			$owner_id = (int)$o['user_id'];
			$this -> view -> album_thumbnail_id = (int)$o['thumbnail_id'];
			$this->setModel("Users");
			$this -> model -> resetSql();
			$this -> model -> where('id='.(int)$owner_id);
			$user = $this -> model -> getOne();
			
			if (isset($user['login'])) {
				$login = trim($user['login']);
				if (strlen($login) == 0){
					// TODO:: something wrong - no user login, so we can't get directory with him uploads
				}
			}
			
			$this->setModel("Photos");
			$this -> model -> resetSql();
			$this -> model -> where('album_id='.(int)$this -> id);
			$this -> model -> where('user_id='.(int)$owner_id);
			if ($owner_id != $user_id){
				$this -> model -> where('access>0');
			}
			$list = $this -> model -> getAll();
			

			foreach($list as $key => $value){
				$thumb = false;
				$dir = USER_UPLOAD_DIR . DIRECTORY_SEPARATOR . $login;
				$err = false;
				$ok = $this -> checkDir($dir);
				if ($ok === true){
					$album = $dir . DIRECTORY_SEPARATOR . 'album';
					$ok = $this -> checkDir($album);
				}
				if ($ok === true){
					$images = $album . DIRECTORY_SEPARATOR . 'images';
					$ok = $this -> checkDir($images);
				}
				
				if ($ok === true){
					$thumbs = $album . DIRECTORY_SEPARATOR . 'thumbs';
					$ok = $this -> checkDir($thumbs);
				}
				
				if ($ok === true){
					
					$f = $thumbs . DIRECTORY_SEPARATOR . $value['thumbnail'];
					if (file_exists($f) && is_file($f)){
						$thumb = $f;
						// Replace back slashes
						$thumb = str_replace("\\", "/", $thumb);
					}
				}
				$list[$key]['thumbnail'] = $thumb;
			}
			
			$this -> view -> photo_list = $list;
			
			
			$this->setModel("Albums");
			$this -> model -> resetSql();
			$this -> model -> where('user_id='.(int)$owner_id);
			if ($owner_id != $user_id){
				$this -> model -> where('access>0');
			} else {
				$this -> view -> album_owner = true;
			}
			$this -> view -> album_list = $this -> model -> getAll();
			$this -> view -> album_id = (int)$this -> id;
			$this->view->content .= $this->view->render(VIEWS_PATH.'albums/photos_of_album_edit.tpl.php');
			$this->view->display();
			
		}
		
		public function AlbumAction(){
			$this -> BaseSiteData();
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			$album_id = (int)Project::getRequest() -> getKeyByNumber(0);
			
			$info = array();
			$this -> BaseAlbumData($info, $album_id);

		
			$photo_model = new PhotoModel;
			$pager = new DbPager(Project::getRequest() -> getValueByNumber(1), $this -> getParam('photo_per_page', self::DEFAULT_PHOTO_PER_PAGE));
			$photo_model -> setPager($pager);
			$list = $photo_model -> loadByAlbumUser($request_user_id, $album_id);
			$this -> checkImages($list);
			$info['photo_list'] = $list;
			$info['list_pager'] = $photo_model -> getPager();
			$info['list_controller'] = 'Photo';
			$info['list_action'] = 'Album';
			$info['list_user'] = null;
			$this -> _view -> PhotoList($info);
			$this -> _view -> parse();
		}

		private function checkImages(&$list){
			parent::checkAlbumList($list);
		}
		
		
		/**
		 * Вывод топовых фотографий
		 */
		public function TopListAction(){
			$this -> model -> resetSql();
			$this -> setModel('Photos');
			$this -> model -> pager();
			$this -> model -> cols('photos.id, 
								      photos.user_id, 
								      photos.name, 
								      photos.creation_date, 
								      users.login, 
								      photos.thumbnail,
								      photos.voices as v,
								      photos.rating as r,
								      IF (photos.voices > 0, photos.rating/photos.voices, 0) as photos_rating');
			$this -> model -> join('users', 'users.id=photos.user_id ', 'LEFT');
			$this -> model -> join('albums', 'albums.id=photos.album_id', 'LEFT');
			$this -> model -> where("photos.access>0");
			$this -> model -> where("photos.is_rating=1");
			$this -> model -> where("photos.is_onmain=1");
			$this -> model -> order("photos_rating DESC");
			if ( ($number = $this -> getParam('top_per_page', self::DEFAULT_PHOTO_PER_PAGE)) === 0){
				$number = self::DEFAULT_PHOTO_PER_PAGE;
			}
			$this -> model -> limit($number, (int)$this -> pn*$number);
			$list = $this -> model -> getAll();
			$all = $this -> model -> foundRows();
			$this -> view -> pages_number = ceil($all / $number);
			$this -> view -> current_page_number = (int)$this -> pn;
			
			foreach($list as $key => $value){
				$login = trim($value['login']);
				$thumb = false;
				if (strlen($login) > 0){
					$dir = USER_UPLOAD_DIR . DIRECTORY_SEPARATOR . $value['login'];
					$err = false;
					$ok = $this -> checkDir($dir);
					if ($ok === true){
						$album = $dir . DIRECTORY_SEPARATOR . 'album';
						$ok = $this -> checkDir($album);
					}
					if ($ok === true){
						$images = $album . DIRECTORY_SEPARATOR . 'images';
						$ok = $this -> checkDir($images);
					}
					
					if ($ok === true){
						$thumbs = $album . DIRECTORY_SEPARATOR . 'thumbs';
						$ok = $this -> checkDir($thumbs);
					}
					
					if ($ok === true){
						$f = $thumbs . DIRECTORY_SEPARATOR . $value['thumbnail'];
						if (file_exists($f) && is_file($f)){
							$thumb = $f;
							// Replace back slashes
							$thumb = str_replace("\\", "/", $thumb);
						}
					}
				}
				$list[$key]['thumbnail'] = $thumb;
			}
			$this -> view -> photo_list = $list;
			$this->view->content .= $this->view->render(VIEWS_PATH.'albums/photo_top_list.tpl.php');
			$this->view->display();
		}
	}
?>