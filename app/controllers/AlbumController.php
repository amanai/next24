<?php
/**
 * Контролер для управления фотоальбомами
 */
	class AlbumController extends SiteController{
		const DEFAULT_ALBUM_PER_PAGE = 8;
		const DEFAULT_PHOTO_PER_PAGE = 8;
		
		function __construct($view_class = null){
			if ($view_class === null){
				$view_class = "AlbumView";
			}
			parent::__construct($view_class);
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
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			$request = Project::getRequest();
			if ($user_id === $request_user_id){
				// Album is for user - so can add/update
				$id = (int)$request -> id;
				$onmain = $request -> is_onmain;
				if ($onmain !== null){
					$onmain = 1;
				} else {
					$onmain = 0;
				}
				$name = trim($request -> album_name);
				$access = (int)$request -> album_access;
				$can_update = true;
				if (!strlen($name)){
					$can_update = false;
					$this -> _view -> addFlashMessage(FM::ERROR, "Название альбома не заполнено");
				}
				
				if ($can_update === true){
					$album_model = new AlbumModel;
					$album_model -> load($id);
					if ($album_model -> id <= 0){
						// For new albums no thumbnail
						$album_model -> thumbnail_id = 0;
					}
					$album_model -> user_id = $user_id;
					$album_model -> name = $name;
					$album_model -> access = $access;
					$album_model -> is_onmain = $onmain;
					$album_model -> creation_date = date("Y-m-d H:i:s");
					$album_model -> save();
					Project::getResponse() -> redirect($request -> createUrl('Album', 'CreateForm'));
				} else {
					$info = array();
					$info['album_name'] = $name;
					$info['album_access'] = $access;
					$info['album_is_onmain'] = $onmain;
					$this -> CreateFormAction($info);
				}
			} else {
				$this -> _view -> addFlashMessage(FM::ERROR, "Нет доступа");
				$this -> CreateFormAction();
			}
			return;
		}
		
		
		/**
		 * Форма создания нового альбома
		 */
		public function CreateFormAction($info = array()){
			$this -> BaseSiteData();
			$this -> BaseAlbumData($info);
			$this -> _view -> CreateForm($info);
			$this -> _view -> parse();
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
		 * Вывод списка альбомов
		 */
		public function ListAction(){
			$this -> BaseSiteData();
			$info = array();
			$info['tab_name'] = 'Последние альбомы';
			$this -> _list($info, "creation_date", "DESC", $this -> getParam('album_per_page', self::DEFAULT_ALBUM_PER_PAGE));
			$this -> _view -> AlbumList($info);
			$this -> _view -> parse();
		}
		
		/**
		 * Вывод топовых альбомов
		 * Кол-во для вывода берется из конфиг параметров: параметр top_per_page
		 */
		public function TopListAction(){
			
			$this -> BaseSiteData();
			$info = array();
			$info['tab_name'] = 'Топ альбомов';
			$this -> _list($info, "album_rating", "DESC", $this -> getParam('top_per_page', self::DEFAULT_ALBUM_PER_PAGE));
			$this -> _view -> AlbumList($info);
			$this -> _view -> parse();
		}
		
		/**
		 * Вывод списка последних альбомов.
		 * Кол-во для вывода берется из конфиг параметров: параметр last_per_page
		 */
		public function LastListAction(){
			$this -> ListAction();
		}
		
		
		private function _list(&$info, $sortname, $sortorder, $per_page){
			$request = Project::getRequest();
			
			if (Project::getUser() -> isMyArea()){
				$info['show_control_panel'] = true;
			} else {
				$info['show_control_panel'] = false;
			}
			$model = new AlbumModel();
			$pager = new DbPager($request -> getKeyByNumber(0), $per_page);
			$model -> setPager($pager);
			$list = $model -> loadAll(Project::getUser() -> getShowedUser() -> id, Project::getUser() -> getDbUser() -> id, $sortname, $sortorder);
			$pager_view = new SitePagerView();
			$info['album_list_pager'] = $pager_view -> show2($model -> getPager(), 'Album', 'TopList');
			$this -> checkAlbumList($list);
			$info['album_list'] = $list;
		}
		
		
		protected function BaseAlbumData(&$info, $album_id){
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			if ($request_user_id === $user_id) {
				$v = new AlbumView();
				$v -> ControlPanel();
				$info['control_panel'] = $v -> parse();
			} else {
				$info['control_panel'] = null;
			}
			
			$tmp = array();
			$album_model = new AlbumModel();
			$tmp['album_menu_list'] = $album_model -> loadByUser($request_user_id, $user_id);
			$tmp['album_id'] = $album_id;
			if ($request_user_id === $user_id) {
				$tmp['album_owner'] = true;
			}
			$v = new AlbumView();
			$v -> AlbumMenu($tmp);
			$info['album_menu'] = $v -> parse();
		}

		
		
		
		
		protected function checkAlbumList(&$list){
			
			foreach($list as $key => $value){
				$login = trim($value['login']);
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
							$thumb = Project::getRequest() -> getHost() . 'users/'.$login.'/album/thumbs/'.$value['thumbnail'];
						}
					}
					
					
				}
				$list[$key]['thumbnail'] = $thumb;
			}
		}
		
		static public function checkDir($dir){
			clearstatcache();
			if (!file_exists($dir) || !is_dir($dir)){
				if (mkdir($dir)){
					chmod($dir, 0644);
					return true;
				} else {
					return false;
				}
			}
			return true;
		}
	}
?>