<?php
require_once(dirname(__FILE__). DIRECTORY_SEPARATOR . 'AlbumController.php');
/**
 * Контролер для управления фотоальбомами
 */
	class PhotoController extends AlbumController{
		const DEFAULT_PHOTO_PER_PAGE = 8;
		function __construct($View=null, $params = array(), $vars = array()){
			$this->setModel("Photos");
			parent::__construct($View, $params, $vars);
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
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			$user_id = (int)$user['id'];
			
			$this->setModel("PhotoVotes");
			$can_rate = $this -> model -> canVote($user_id, $this -> id);;
			
			if ($can_rate = true){
				$this -> model -> addVote($user_id, $this -> id);
				
				$this -> setModel("Photos");
				$this -> model -> resetSql();
				$this -> model -> load($this -> id);
				$this -> model -> set('voices', ($this -> model -> get('voices') + 1));
				$this -> model -> set('rating', ($this -> model -> get('rating') + $this -> rate_value));
				$this -> model -> save();
			}
			
			$router = getManager('CRouter');
			$router -> redirect($router -> createUrl('Photo', 'View', array('id' => $this -> id)));
		}
		
		public function ViewAction(){
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			
			$this->setModel("Photos");
			$this -> model -> resetSql();
			$this -> model -> load($this -> id);
			$photo = $this -> model -> getData();
			if (count($photo) == 0){
				// TODO:: No foto id or wrong id (isn't already exists)
				die("No foto info");
			}
			
			if (isset($photo['album_id']) && ((int)$photo['album_id'] > 0)){
				$this->setModel("Albums");
				$this -> model -> resetSql();
				$this -> model -> load($photo['album_id']);
				if ((int)$this -> model -> id <= 0){
					// TODO:: id is not exists at DB
					die("No album");
				}
				$album_id = (int)$photo['album_id'];
			} else {
				// TODO:: wrong relation to album
				die("No album");
			}
			
			$this -> view -> album_info = $this -> model -> getData();
			
			if (isset($photo['user_id']) && ((int)$photo['user_id'] > 0)){
				$user_id = (int)$photo['user_id'];
			} else {
				// TODO:: No user id assigned to this photo or photo is not exists???
				die("No user");
			}
			
			
			if ($photo['user_id'] == $user['id']){
				$this -> view -> photo_owner = true;
			}
			$this->setModel("Users");
			$this -> model -> resetSql();
			$this -> model -> where('id='.(int)$user_id);
			$user = $this -> model -> getOne();
			if (isset($user['login'])) {
				$login = trim($user['login']);
				if (strlen($login) == 0){
					// TODO:: something wrong - no user login, so we can't get directory with him uploads
					die("No user data folder");
				}
			}
			
			$image = false;
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
				$f = $images . DIRECTORY_SEPARATOR . $photo['path'];
				if (file_exists($f) && is_file($f)){
					$image = $f;
					// Replace back slashes
					$image = str_replace("\\", "/", $image);
				}
			}
			$photo['path'] = $image;
			
			
			
			
			$this -> view -> photo_info = $photo;
			
			$this->setModel("PhotoVotes");
			$this -> view -> can_rate = $this -> model -> canVote($user_id, $this -> id);;
			
			
			
			if ($ok === true){
				$thumbs = $album . DIRECTORY_SEPARATOR . 'thumbs';
				$ok = $this -> checkDir($thumbs);
			}
			$this->setModel("Photos");
			$this -> model -> resetSql();
			$this -> model -> where('album_id='.(int)$album_id);
			if ($photo['user_id'] != $user['id']){
				$this -> model -> where('access>0');
			}
			$list = $this -> model -> getAll();
			foreach($list as $key => $value){
				$thumb = false;
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
			$this -> model -> where('user_id='.(int)$user_id);
			if ($photo['user_id'] != $user['id']){
				$this -> model -> where('access>0');
			}
			$this -> view -> album_list = $this -> model -> getAll();
			$this -> view -> album_id = (int)$this -> id;
			
			
			
			$this->setModel("PhotoComment");
			$this -> model -> resetSql();
			$list = $this -> model -> loadByItem($this -> id);
			$this -> view -> comment_list = $list;
			$this->view->content .= $this->view->render(VIEWS_PATH.'albums/photos_view.tpl.php');
			$this->view->display();
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
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			$user_id = (int)$user['id'];
			
			
			$this->setModel("Albums");
			$this -> model -> resetSql();
			
			$this -> model -> cols('user_id');
			$this -> model -> where('id='.(int)$this -> id);
			$o = $this -> model -> getOne();
			$owner_id = (int)$o['user_id'];
			
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
			$this->view->content .= $this->view->render(VIEWS_PATH.'albums/photos_of_album.tpl.php');
			$this->view->display();
			
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