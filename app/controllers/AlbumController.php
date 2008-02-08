<?php
/**
 * Контролер для управления фотоальбомами
 */
	class AlbumController extends CBaseController{
		const DEFAULT_ALBUM_PER_PAGE = 8;
		const DEFAULT_PHOTO_PER_PAGE = 8;
		
		function __construct($View=null, $params = array(), $vars = array()){
			$this -> setModel("Albums");
			parent::__construct($View, $params, $vars);
		}
		
		
		
		public function UserAction(){
			
			
			$request_user_id = (int)$this -> id;
			
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			
			$user_id = 0;
			if (isset($user['id']) && ((int)$user['id'] > 0)){
				// TODO:: user is not logged or something wrong at his session data
				$user_id = (int)$user['id'];
			} else {
				die("Нет доступа");
			}
			
			if (($request_user_id == 0) || ($request_user_id == $user_id)){
				// В своих  альбомах - показывать все, без каких либо фильтров и установить слева панель управления альбомами, + кнопки редактирования
				$owner = $user_id;
			} else {
				$owner = false;
			}
			
			$this->setModel("Albums");
			$this -> model -> resetSql();
			$this -> model -> where('user_id='.($request_user_id > 0?$request_user_id:$user_id));
			if ($owner === false){
				$this -> model -> where('access > 0');
			}
			$this -> view -> album_list = $this -> model -> getAll();
			
			
			$this->setModel("Photos");
			$this -> model -> resetSql();
			$this -> model -> pager();
			$this -> model -> cols('photos.user_id, 
								      photos.name,
								      photos.id as photos_id,
								      albums.name as album_name,
								      photos.album_id as album_id,
								      photos.creation_date, 
								      photos.thumbnail,
								      photos.voices as v,
								      photos.rating as r,
								      IF ((photos.voices > 0) AND (photos.is_rating > 0), photos.rating/photos.voices, 0) as photos_rating');
			$this -> model -> join('albums', 'albums.id=photos.album_id', 'LEFT');
			if ($owner === false){
				$this -> model -> where('photos.access > 0');
			}
			$this -> model -> where('photos.user_id = '.(int)($request_user_id > 0 ? $request_user_id : $user_id));
			$this -> model -> order("photos.creation_date DESC");
			
			if ( ($number = $this -> getParam('last_photo_per_page', self::DEFAULT_PHOTO_PER_PAGE)) === 0){
				$number = self::DEFAULT_PHOTO_PER_PAGE;
			}
			
			$this -> model -> limit($number, (int)$this -> pn*$number);
			$list = $this -> model -> getAll();
			$all = $this -> model -> foundRows();
			$this -> view -> pages_number = ceil($all / $number);
			$this -> view -> current_page_number = (int)$this -> pn;
			
			$login = trim($user['login']);
			
			foreach($list as $key => $value){
				$thumb = false;
				if (strlen($login) > 0){
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
					
					
				}
				$list[$key]['thumbnail'] = $thumb;
			}
			$this -> view -> photo_list = $list;
			
			
			
			$this -> view -> album_owner = $owner;
			$this -> view -> album_owner_id = (int)($request_user_id > 0 ? $request_user_id : $user_id);
			
			$this->view->content .= $this->view->render(VIEWS_PATH.'albums/photo_last_list.tpl.php');
			$this->view->display();
		}
		
		
		public function UploadAction(){
			// TODO:: album_id - проверять, этого ли пользователя альбом
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			$user_id = (int)$user['id'];
			$login = trim($user['login']);
			
			$this->setModel("Albums");
			$this -> model -> resetSql();
			$this -> model -> load($this -> album_id);
			$album = $this -> model -> getData();
			if (!isset($album['id']) || !isset($album['user_id']) || ((int)$album['id'] !== (int)$user_id)){
				// TODO:: current user try to add foto to album of another user.
			}
			
			if (!isset($_FILES['picture'])){
				// TODO:: error uploading picture - handle error hear
			}
			//TODO:: check type of uploaded images
			
			
			$uploadfile = false;
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
			
			$ok_thumb = false;
			if ($ok === true){
				$thumbs = $album . DIRECTORY_SEPARATOR . 'thumbs';
				$ok_thumb = $this -> checkDir($thumbs);
			}
			
			$p = pathinfo($_FILES['picture']['name']);
			$ext = strtolower(trim(isset($p['extension'])?$p['extension']:null));
			$fn = md5(uniqid(rand(), true)). ".".$ext;
			$thumb = false;
			$uploaded = false;
			if ($ok === true){
				$f = $images . DIRECTORY_SEPARATOR . $fn;
				if (move_uploaded_file($_FILES['picture']['tmp_name'], $f)) {
					$uploaded = true;
					// TODO:: write ti log if thumb size no specified
					$width = $this -> getParam('thumb_size', 99999);
					if ($width <= 0){
						$width = 100;
					}
					if ($ok_thumb === true){
						if ($this -> _imageResize($f, $thumbs . DIRECTORY_SEPARATOR . $fn, $width)){
							$thumb = true;
						} else {
							// TODO:: error resizing image
						}
					}
				} else {
					// TODO:: error uploading file
				}
			}
			
			if ($uploaded) {
				$this->setModel("Photos");
				$this -> model -> resetSql();
				$this -> model -> set('user_id', $user_id);
				$this -> model -> set('album_id', $this -> album_id);
				$this -> model -> set('name', $this -> pic_name);
				$this -> model -> set('path', $fn);
				$this -> model -> set('thumbnail', $fn);
				$this -> model -> set('is_rating', ($this -> rating == 'on')?1:0);
				$this -> model -> set('is_onmain', ($this -> on_main == 'on')?1:0);
				$this -> model -> set('access', (int)$this -> access);
				$this -> model -> set('voices', 0);
				$this -> model -> set('rating', 0);
				$this -> model -> set('creation_date', date("Y-m-d H:i:s"));
				$this -> model -> set('id', null);
				$this -> model -> save();
			}
			
			$router = getManager('CRouter');
			$router -> redirect($router -> createUrl('Album', 'UploadForm'));
		}
		
		
		/**
		 * Форма загрузки фотографии
		 */
		public function UploadFormAction(){
			
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			$user_id = (int)$user['id'];
			
			$this -> model -> resetSql();
			$this -> model -> order("albums.creation_date DESC");
			$this -> model -> where('albums.user_id='.(int)$user_id);
			$list = $this -> model -> getAll();
			$this -> view -> album_list = $list;
			
			
			$this->view->content .= $this->view->render(VIEWS_PATH.'albums/upload_form.tpl.php');
			$this->view->display();
			
		}
		
		
		/**
		 * Создание нового альбома (обработка сабмита)
		 */
		public function CreateAction(){
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			$user_id = (int)$user['id'];
			$login = trim($user['login']);
			
			$this -> setModel("Albums");
			$this -> model -> resetSql();
			$this -> model -> set('user_id', $user_id);
			$this -> model -> set('name', $this -> album_name);
			$this -> model -> set('access', (int)$this -> album_access);
			$this -> model -> set('is_onmain', 0);
			$this -> model -> set('thumbnail_id', 0);
			$this -> model -> set('creation_date', date("Y-m-d H:i:s"));
			
			$this -> model -> save();
			
			$router = getManager('CRouter');
			$router -> redirect($router -> createUrl('Album', 'CreateForm'));
		}
		
		
		/**
		 * Форма создания нового альбома
		 */
		public function CreateFormAction(){
			
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			$user_id = (int)$user['id'];
			
			$this -> model -> resetSql();
			$this -> model -> order("albums.creation_date DESC");
			$this -> model -> where('albums.user_id='.(int)$user_id);
			$list = $this -> model -> getAll();
			$this -> view -> album_list = $list;
			
			
			$this->view->content .= $this->view->render(VIEWS_PATH.'albums/create_form.tpl.php');
			$this->view->display();
			
		}
		
		public function ListSaveAction(){
			
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			$user_id = (int)$user['id'];
			$login = trim($user['login']);
			$album = USER_UPLOAD_DIR . DIRECTORY_SEPARATOR . $login . DIRECTORY_SEPARATOR . 'album' . DIRECTORY_SEPARATOR;
			$thumbs = $album . 'thumbs' . DIRECTORY_SEPARATOR;
			$images = $album . 'images' . DIRECTORY_SEPARATOR;
			clearstatcache();
			if (is_array($this -> album_id)){
				foreach ($this -> album_id as $album_id){
					$this->setModel("Albums");
					$this -> model -> resetSql();
					$this -> model -> load($album_id);
					// Проверка, является ли пользователем владельцем альбома
					if (((int)$this -> model -> id > 0) && ((int)$this -> model -> get('user_id') === $user_id)){
						if (isset($this -> delete[$album_id]) && ($this -> delete[$album_id] == "on")){
							// Delete album
							$this -> setModel("Photos");
							$this -> model -> where('album_id='.(int)$album_id);
							$list = $this -> model -> getAll();
							foreach($list as $item){
								$f = $thumbs . $item['path'];
								if (file_exists($f) && is_file($f)){
									unlink($f);
								}
								$f = $images . $item['thumbnail'];
								if (file_exists($f) && is_file($f)){
									unlink($f);
								}
								$this -> model -> id = $item['id'];
								$this -> model -> delete();
							}
							$this->setModel("Albums");
							$this -> model -> id = $album_id;
							$this -> model -> delete();
						} else {
							$this -> model -> set('access', (isset($this -> access[$album_id])?$this -> access[$album_id]:0));
							$this -> model -> set('name', (isset($this -> album_name[$album_id])?$this -> album_name[$album_id]:$this -> model -> get('name')));
							$this -> model -> save();
						}
					}
					
				}
			}
			
			$router = getManager('CRouter');
			$router -> redirect($router -> createUrl('Album', 'List'));
		}
		
		/**
		 * Вывод списка альбомов текущего пользователя с возможностью редактирования
		 */
		public function ListAction(){
			
			$session = getManager('CSession');
			$user = unserialize($session->read('user'));
			
			$user_id = 0;
			if (isset($user['id']) && ((int)$user['id'] > 0)){
				$user_id = (int)$user['id'];
			} else {
				// TODO:: user is not logged or something wrong at his session data
				die("Нет доступа");
			}
			
			
			
			$this -> model -> resetSql();
			//$this -> model -> pager();
			
			$this -> model -> order("albums.creation_date DESC");
			if ( ($number = $this -> getParam('own_albums_per_list', self::DEFAULT_ALBUM_PER_PAGE)) === 0){
				$number = self::DEFAULT_ALBUM_PER_PAGE;
			}
			
			//$this -> model -> limit($number, (int)$this -> pn*$number);
			$this -> model -> cols('albums.id, albums.name, albums.access, albums.is_onmain, albums.thumbnail_id, photos.thumbnail');
			$this -> model -> join('photos', 'photos.id=albums.thumbnail_id', 'LEFT');
			$this -> model -> where('albums.user_id='.(int)$user_id);
			$list = $this -> model -> getAll();
			//$all = $this -> model -> foundRows();
			$login = trim($user['login']);
			foreach($list as $key => $value){
				
				$thumb = false;
				if (strlen($login) > 0){
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
					
					
				}
				$list[$key]['thumbnail'] = $thumb;
			} 
			
			$this -> view -> album_list = $list;
			$this->view->content .= $this->view->render(VIEWS_PATH.'albums/albums_edit_list.tpl.php');
			$this->view->display();
		}
		
		
		/**
		 * Вывод топовых альбомов
		 * Кол-во для вывода берется из конфиг параметров: параметр top_per_page
		 */
		public function TopListAction(){
			$this -> model -> resetSql();
			$this -> model -> pager();
			$this -> model -> cols('albums.id, albums.user_id, albums.name, albums.creation_date, users.login, photos.thumbnail, IF (rate.voices > 0, rate.rating/rate.voices, 0) as album_rating');
			$this -> model -> join('users', 'users.id=albums.user_id', 'LEFT');
			$this -> model -> join('photos', 'photos.id=albums.thumbnail_id AND photos.album_id=albums.id', 'LEFT');
			$this -> model -> join('photos', 'rate.album_id = albums.id AND rate.is_rating > 0', 'LEFT', 'rate');
			$this -> model -> where("albums.access>0");
			$this -> model -> where("albums.is_onmain>0");
			$this -> model -> group('albums.id');
			$this -> model -> order("album_rating DESC");
			if ( ($number = $this -> getParam('albums_per_page', self::DEFAULT_ALBUM_PER_PAGE)) === 0){
				$number = self::DEFAULT_ALBUM_PER_PAGE;
			}
			$this -> model -> limit($number, (int)$this -> pn*$number);
			$list = $this -> model -> getAll();
			$all = $this -> model -> foundRows();
			$this -> view -> pages_number = ceil($all / $number);
			$this -> view -> current_page_number = (int)$this -> pn;
			$this -> view -> current_controller = 'Album';
			$this -> view -> current_action = 'TopList';
			$this -> showAlbums($list);
		}
		
		
		/**
		 * Вывод списка последних альбомов.
		 * Кол-во для вывода берется из конфиг параметров: параметр last_per_page
		 */
		public function LastListAction(){
			$this -> model -> resetSql();
			$this -> model -> pager();
			$this -> model -> cols('albums.id, albums.user_id, albums.name, albums.creation_date, users.login, photos.thumbnail');
			$this -> model -> join('users', 'users.id=albums.user_id', 'LEFT');
			$this -> model -> join('photos', 'photos.id=albums.thumbnail_id AND photos.album_id=albums.id', 'LEFT');
			$this -> model -> where("albums.access>0");
			$this -> model -> where("albums.is_onmain=1");
			$this -> model -> order("albums.creation_date DESC");
			if ( ($number = $this -> getParam('last_albums_per_page', self::DEFAULT_ALBUM_PER_PAGE)) === 0){
				$number = self::DEFAULT_ALBUM_PER_PAGE;
			}
			$this -> model -> limit($number, (int)$this -> pn*$number);
			$list = $this -> model -> getAll();
			$all = $this -> model -> foundRows();
			$this -> view -> pages_number = ceil($all / $number);
			$this -> view -> current_page_number = (int)$this -> pn;
			$this -> view -> current_controller = 'Album';
			$this -> view -> current_action = 'LastList';
			
			
			$this -> showAlbums($list);
		}
		
		private function showAlbums(&$list){
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
			$this -> view -> album_list = $list;
			$this -> view -> content .= $this->view->render(VIEWS_PATH.'albums/albums_list.tpl.php');
			$this->view->display();
			
		}
		
		public function checkDir($dir){
			clearstatcache();
			if (!file_exists($dir) || !is_dir($dir)){
				die(BACKTRACE());
				if (mkdir($dir)){
					chmod($dir, 0644);
					return true;
				} else {
					return false;
				}
			}
			return true;
		}
		
		/**
		 * Resize image
		 */
		private function _imageResize($fn, $new_fn, $toWidth){
			$p = pathinfo($fn);
			$ext = isset($p['extension'])?$p['extension']:null;
			list($width, $height) = getimagesize($fn);
			if ($toWidth < $width) {
				$percent = (float)$toWidth/$width;
				$newwidth = $width * $percent;
				$newheight = $height * $percent;
				$thumb = imagecreatetruecolor($newwidth, $newheight);
				$source = self::ImageMake($fn, $ext);
				if ($source == false){
					//error creating image source
					return false;
				}
				imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
				self::imageSave($thumb, $new_fn, $ext);
			}
		}
		
		function imageSave($resource, $name, $ext){
			switch ($ext) {
				case	'jpg'	:
									imagejpeg($resource, $name);
									break;
				case	'png'	:
									imagepng($resource, $name);
									break;
				case	'gif'	:
									imagegif($resource, $name);
									break;
				default			:
									break;
			}
		}
		
		function ImageMake($filename, $ext){
			$ext = strtolower(trim($ext));
			switch ($ext) {
				case	'jpg'	:
					$res = @imagecreatefromjpeg($filename);
					break;
				case	'png'	:
					$res = @imagecreatefrompng($filename);
					break;
				case	'gif'	:
					$res = @imagecreatefromgif($filename);
					break;
				default			:
					$res = false;
					break;
			}
			return $res;
		}
	}
?>