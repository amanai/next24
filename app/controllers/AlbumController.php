<?php
/**
 * Контролер для управления фотоальбомами
 */
	class AlbumController extends SiteController{
		private $DEFAULT_ALBUM_PER_PAGE = 8, $DEFAULT_PHOTO_PER_PAGE = 8;
		
		function __construct($view_class = null){
		    if ($this->getParam("album_per_page")) $this->DEFAULT_ALBUM_PER_PAGE = $this->getParam("album_per_page");
		    if ($this->getParam("photo_per_page")) $this->DEFAULT_ALBUM_PER_PAGE = $this->getParam("photo_per_page");
			if ($view_class === null){
				$view_class = "AlbumView";
			}
			parent::__construct($view_class);
		}
		
		public function UploadAction(){
			// TODO:: album_id - проверять, этого ли пользователя альбом
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			$request = Project::getRequest();
			$login = Project::getUser() -> getDbUser() -> login;
			
			$album_id = (int)$request -> album_id;
			$access = (int)$request -> pic_access;
		
			
			$album_model = new AlbumModel();
			$album_model -> load($album_id);
			if ((int)$album_model -> user_id !== $user_id){
				// This album not of current user - so can't upload photo in somebody else album
				$this -> _view -> addFlashMessage(FM::ERROR, "Ошибка доступа к загрузке фотографий");
				$this -> UploadFormAction($request -> getKeys());
				return;
			}
			
			if (!count($_FILES)){
				$this -> _view -> addFlashMessage(FM::ERROR, "Нет изображений для загрузки");
				$this -> UploadFormAction($request -> getKeys());
				return;
			}
			$ids = array(); $user_dir_size = HelpFunctions::getDirSize(USER_UPLOAD_DIR);
			foreach ($_FILES as $post_file){
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
				
				if (!$ok || !$ok_thumb){
					$this -> _view -> addFlashMessage(FM::ERROR, $post_file['name']." ошибка загрузки изображения в директорию пользователя");
					$this -> UploadFormAction($request -> getKeys());
					continue;
				}
				
				
				$p = pathinfo($post_file['name']);
				$ext = strtolower(trim(isset($p['extension'])?$p['extension']:null));
				$fn = md5(uniqid(rand(), true)). ".".$ext;
				$thumb = false;
				$uploaded = false;
				if ($ok === true){
					$f = $images . DIRECTORY_SEPARATOR . $fn;
					$max_image_size = $this->getParam('max_image_size');
					$max_userdir_size = $this->getParam('max_userdir_size');
					$max_photo_width = $this->getParam('max_photo_width');
					$user_dir_size += $post_file['size'];
					if ($max_image_size<$post_file['size']){
					    $this -> _view -> addFlashMessage(FM::ERROR, $post_file['name']." превышает максимальный размер фото (".$max_image_size." байт)");
					    continue;
					}elseif ($user_dir_size > $max_userdir_size){
					    $this -> _view -> addFlashMessage(FM::ERROR, "Вы превысили максимальный размер загруженных фото (".$max_userdir_size." байт)");
					    continue;
					}elseif (HelpFunctions::_imageResize($post_file['tmp_name'], $f, $max_photo_width, $ext)){
						//move_uploaded_file($post_file['tmp_name'], $f)
						//HelpFunctions::_imageResize($post_file['tmp_name'], $f, $max_photo_width)
						// TODO:: write tщ log if thumb size no specified
						$width = $this -> getParam('thumb_size', 99999);
						if ($width <= 0){
							$width = 100;
						}
						if ($ok_thumb === true){
							if (HelpFunctions::_imageResize($post_file['tmp_name'], $thumbs . DIRECTORY_SEPARATOR . $fn, $width, $ext)){
								$thumb = true;
							} else {
								// TODO:: error resizing image
							}
						}
					} else {
						$this -> _view -> addFlashMessage(FM::ERROR, $post_file['name']." ошибка загрузки изображения");
						$this -> UploadFormAction($request -> getKeys());
						continue;
					}
				}
				
				$photo_model = new PhotoModel;
				$photo_model -> user_id = $user_id;
				$photo_model -> album_id = $album_id;
				$photo_model -> path = $fn;
				$photo_model -> thumbnail = $fn;
				$photo_model -> access = $access;

				$photo_model -> name = '';
				$photo_model -> is_onmain = 0;
				$photo_model -> is_rating = 0;
				$photo_model -> voices = 0;
				$photo_model -> rating = 0;
				$photo_model -> creation_date = date("Y-m-d H:i:s");
				$ids[] = $photo_model -> save();
			}
			$c = new PhotoController;
			$c -> EditAction($ids, $album_id);
			$this -> setContent($c -> getContent());
			//Project::getResponse() -> redirect($request -> createUrl('Album', 'UploadForm'));
			
		}
		
		
		/**
		 * Форма загрузки фотографии
		 */
		public function UploadFormAction($info = array()){
			$this -> BaseSiteData();
			$this -> BaseAlbumData($info, 0, 'album_list');
			$this -> _view -> UploadForm($info);
			$this -> _view -> parse();
		}
		
		
		/**
		 * Создание нового альбома (обработка сабмита)
		 */
		public function CreateAction(){
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			$request = Project::getRequest();
			if (Project::getUser()->isMyArea()){
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
					$album_model -> user_id = $request_user_id;
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
			$this -> BaseAlbumData($info, 0);
			$this -> _view -> CreateForm($info);
			$this -> _view -> parse();
		}
		
		public function ListSaveAction(){
			
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			$login = Project::getUser() -> getDbUser() -> login;
			$request = Project::getRequest();
			
			if ($user_id !== $request_user_id){
				// Can't save somebody's album
				$this -> ListAction();
				return;
			}
			
			
			
			$album = USER_UPLOAD_DIR . DIRECTORY_SEPARATOR . $login . DIRECTORY_SEPARATOR . 'album' . DIRECTORY_SEPARATOR;
			$thumbs = $album . 'thumbs' . DIRECTORY_SEPARATOR;
			$images = $album . 'images' . DIRECTORY_SEPARATOR;
			clearstatcache();
			if (is_array($request -> album_id)){
				foreach ($request -> album_id as $album_id){
					$album_model = new AlbumModel;
					$album_model -> load($album_id);
					// Проверка, является ли пользователем владельцем альбома
					if (((int)$album_model -> id > 0) && ((int)$album_model -> user_id === $user_id)){
						if (isset($request -> delete[$album_id])){
							// Delete album
							$photo_model = new PhotoModel;
							
							$list = $photo_model -> loadByAlbum($album_id);
							foreach($list as $item){
								$f = $thumbs . $item['path'];
								if (file_exists($f) && is_file($f)){
									unlink($f);
								}
								$f = $images . $item['thumbnail'];
								if (file_exists($f) && is_file($f)){
									unlink($f);
								}
								$photo_model -> delete($item['id']);
							}
							$album_model -> delete($album_id);
						} else {
							$album_model -> is_onmain = isset($request -> is_onmain[$album_id])?1:0;
							$album_model -> access = isset($request -> album_access[$album_id])?$request -> album_access[$album_id]:(ACCESS::MYSELF);
							$album_model -> name = isset($request -> album_name[$album_id])?$request -> album_name[$album_id] : $album_model -> name;
							$album_model -> save();
							
						}
					}
				}
			}
			Project::getResponse() -> redirect($request -> createUrl('Album', 'List'));
		}
		
		/**
		 * Вывод списка альбомов
		 */
		public function ListAction(){
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;

			$info = array();
			$info['tab_name'] = 'Фотоальбомы';
			if (Project::getUser() -> isMyArea()){
				$info['can_edit'] = true;
				$info['access_list'] = HelpFunctions::getAccessList();
			}
			$this -> _list($info, "creation_date", "DESC", $this -> getParam('album_per_page', $this->DEFAULT_ALBUM_PER_PAGE), 'List');
			$this -> _view -> AlbumList($info);
			$this -> _view -> parse();
		}
		
		/**
		 * Вывод топовых альбомов
		 * Кол-во для вывода берется из конфиг параметров: параметр top_per_page
		 */
		public function TopListAction(){
			
			$info = array();
			if ((int)Project::getUser() -> getShowedUser() -> id <= 0){
				$tabs = TabController::getMainAlbumTabs(false, false, true);
			} else {
				$tabs = TabController::getOwnTabs(false, true);
			}
			$info['tab_list'] = $tabs;
			$info['left_panel'] = false;
			$this -> _list($info, "album_rating", "DESC", $this -> getParam('top_per_page', $this->DEFAULT_ALBUM_PER_PAGE), 'TopList');
			$this -> _view -> AlbumList($info);
			$this -> _view -> parse();
		}
		
		/**
		 * Вывод списка последних альбомов.
		 * Кол-во для вывода берется из конфиг параметров: параметр last_per_page
		 */
		public function LastListAction(){

			$info = array();
			if ((int)Project::getUser() -> getShowedUser() -> id <= 0){
				$info['left_panel'] = false;
				$tabs = TabController::getMainAlbumTabs(true);
			} else {
				$tabs = TabController::getOwnTabs(false, true);
			}

			$info['tab_list'] = $tabs;
			$this -> _list($info, "creation_date", "DESC", $this -> getParam('album_per_page', $this->DEFAULT_ALBUM_PER_PAGE), 'LastList');
			$this -> _view -> AlbumList($info);
			$this -> _view -> parse();
		}
		
		
		private function _list(&$info, $sortname, $sortorder, $per_page, $action){
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
			$info['album_list_pager'] = $pager_view -> show2($model -> getPager(), 'Album', $action);
			$this -> checkAlbumList($list);
			$info['album_list'] = $list;
			$this -> BaseAlbumData($info, 0);
			$this -> BaseSiteData();
		}
		
		
		protected function BaseAlbumData(&$info, $album_id, $album_list = false){
			$request_user_id = (int)Project::getUser() -> getShowedUser() -> id;
			$user_id = (int)Project::getUser() -> getDbUser() -> id;
			if (Project::getUser()->isMyArea()) {
				$v = new AlbumView();
				$v -> ControlPanel();
				$info['control_panel'] = $v -> parse();
			} else {
				$info['control_panel'] = null;
			}
			
			if ($request_user_id > 0){
				$info['tab_list'] = TabController::getOwnTabs(false, true);
			}
			
			
			$tmp = array();
			$album_model = new AlbumModel();
			$tmp['album_menu_list'] = $album_model -> loadByUser($request_user_id, $user_id);
			$tmp['album_id'] = $album_id;
			if (Project::getUser()->isMyArea()) {
				$tmp['album_owner'] = true;
			}
			$v = new AlbumView();
			$v -> AlbumMenu($tmp);
			$info['album_menu'] = $v -> parse();
			if ($album_list !== false){
				$info[$album_list] = $tmp['album_menu_list'];
			}
			
			
			
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
					if (($ok === true) && isset($value['thumbnail'])){
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
					chmod($dir, 0777);
					return true;
				} else {
					return false;
				}
			}
			return true;
		}
	}
?>