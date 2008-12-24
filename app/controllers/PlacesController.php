<?php
	class PlacesController extends SiteController{
		private $session;
		private $user;
		
		function __construct($view_class = null){
			if ($view_class === null){
				$view_class = "PlacesView";
			}
			$this->session=Project::getSession();
			parent::__construct($view_class);
			
			$this -> _view -> assign('tab_list', TabController::getOwnTabs(true));
			$this->user = Project::getUser() -> getShowedUser();
			$this -> _view -> assign('user_profile', $this-> user -> data());
			$this -> _view -> assign('session', $this->session);
			$this -> _view -> assign('user_default_avatar', $this-> user ->getUserAvatar($this-> user ->id));
		}		
		
		public function setViewVars() {
			$geo_type = new GeoTypeModel;
			$this->_view->assign('geo_types', $geo_type->loadAll());
			
			if ($this->session->geo_type_id) {
				$country = new CountryModel;
				$this->_view->assign('countries', $country->loadAll());
			}
			
			if ($this->session->country_id) {
				$city = new CityModel;
				$this->_view->assign('cities', $city->loadByCountry($this->session->country_id));
			}
			
			if ($this->session->geo_type_id&&$this->session->city_id) {
				$geo_subtype = new GeoSubtypeModel;
				$this->_view->assign('geo_subtypes', $geo_subtype->loadByType($this->session->geo_type_id));
			}
			
			if ($this->session->geo_subtype_id&&$this->session->city_id) {
				$geo_place = new GeoPlaceModel;
				$this->_view->assign('geo_places', $geo_place->load($this->session->geo_subtype_id, $this->session->city_id));
			}
			
			$this->_view->assign('my_places', $this->user->loadGeoPlaces());
			
		}
		
		public function IndexAction() {
			$this->setViewVars();
			
			$this->_view->ListPlaces();
			$this ->_view->parse();
		}
		
		public function EditPlaceAction() {
			$request=Project::getRequest();
			$this->setViewVars();
			
			$obj = new UsersGeoPlaceModel();
			$obj->load($request->id);
			
			if ($obj->user_id==$this->user->id) {
				$place = new GeoPlaceModel();
				$place->loadById($obj->geo_place_id);
				$this->_view->assign('place_name', $place->name);
				$this->_view->assign('edit_place', $obj);
			}
			
			
			$this->_view->ListPlaces();
			$this ->_view->parse();
		}
		
		public function DeletePlaceAction() {
			$request=Project::getRequest();
			
			if ($request->id) {
				$place = new UsersGeoPlaceModel();
				$place->delete($request->id);
			}
			
			Project::getResponse() -> redirect(Project::getRequest() -> createUrl("Places", "Index"));
		}
		
		public function ShowUsersAction() {
			$request=Project::getRequest();
			$this->setViewVars();
			
			if ($request->id) {
				$u=new UserModel();
				$this->_view->assign('users_list', $u->loadAllByPlaces($request->id));
				
				$place = new GeoPlaceModel();
				$place->loadById($request->id);
				$this->_view->assign('place_name', $place->name);
			} else {
				Project::getResponse() -> redirect(Project::getRequest() -> createUrl("Places", "Index"));
			}
			
			$this->_view->ListPlaces();
			$this ->_view->parse();
		}
		
		public function AddEntityAction() {
			$request=Project::getRequest();
			
			$this->setViewVars();
			$this->setFormParams();
			
			$geo_type = new GeoTypeModel();
			$geo_type->load($this->session->geo_type_id);
			$this->_view->assign('geo_type_name', $geo_type->name);
			
			$city = new CityModel();
			$city->load($this->session->city_id);
			$this->_view->assign('city_name', $city->name);
			
			$country = new CountryModel();
			$country->load($this->session->country_id);
			$this->_view->assign('country_name', $country->name);
			
			$place = new GeoPlaceModel();
			$place->loadById($this->session->geo_place_id);
			$this->_view->assign('place_name', $place->name);
			
			// Creating type
			if ($request->create_type) {
				$this -> _view -> clearFlashMessages();
				if ($request->type_name) {
					// Creating type
					$obj = new GeoSubtypeModel;
					$obj->name = htmlspecialchars($request->type_name);
					$obj->geo_type_id = $this->session->geo_type_id;
					$obj->save();
					Project::getResponse() -> redirect(Project::getRequest() -> createUrl("Places", "Index"));
				} else {
					$this -> _view -> addFlashMessage(FM::ERROR, 'Введите название типа');
				}
			}
			
			// Creating place
			if ($request->create_place) {
				$this -> _view -> clearFlashMessages();
				if ($request->place_name) {
					// Creating type
					$obj = new GeoPlaceModel();
					$obj->name = htmlspecialchars($request->place_name);
					$obj->geo_subtype_id = $this->session->geo_subtype_id;
					$obj->city_id = $this->session->city_id;
					$obj->user_id = $this-> user -> id;
					$obj->creation_date=date("Y-m-d H:i:s");
					$obj->save();
					Project::getResponse() -> redirect(Project::getRequest() -> createUrl("Places", "Index"));
				} else {
					$this -> _view -> addFlashMessage(FM::ERROR, 'Введите название места');
				}
			}
			
			// Adding place to user
			if ($request->create_object_at_user) {
				$obj = new UsersGeoPlaceModel();
				$obj->user_id = $this-> user -> id;
				$obj->geo_place_id = $this->session->geo_place_id;
				$obj->date_start = htmlspecialchars($request->year_begin);
				$obj->date_end = htmlspecialchars($request->year_end);
				$obj->surname = htmlspecialchars($request->surname);
				$obj->save();
				Project::getResponse() -> redirect(Project::getRequest() -> createUrl("Places", "Index"));
			}
			
			// Editing place at user
			if ($request->edit_object_at_user) {
				$obj = new UsersGeoPlaceModel();
				$obj->load($request->id);
				$obj->date_start = htmlspecialchars($request->year_begin);
				$obj->date_end = htmlspecialchars($request->year_end);
				$obj->surname = htmlspecialchars($request->surname);
				$obj->save();
				Project::getResponse() -> redirect(Project::getRequest() -> createUrl("Places", "Index"));
			}
			
			$this->_view->ListPlaces();
			$this ->_view->parse();
		}
		
		public function setFormParams() {
			$request=Project::getRequest();
			// Getting new params
			$this->session->geo_type_id=$request->geo_type_id;
			$this->session->country_id=$request->country_id;
			$this->session->city_id=$request->city_id;
			$this->session->geo_subtype_id=$request->geo_subtype_id;
			$this->session->geo_place_id=$request->geo_place_id;
		}
		
		public function ReloadDropDownsAction() {
			$request=Project::getRequest();
			
			$this->setFormParams();
			// Depends check
			$depends = $this->_view->getReverceDependsList($request->changed_list);
			
			foreach ($depends as $depend) {
				$name_id=$depend.'_id';
				$this->session->$name_id=0;
			}
			// Setting view vars
			$this->setViewVars();
			
			$this -> _view -> ReloadDropDowns($depends);
			$this -> _view -> ajax();
			//$response ->
		}
		
	}
?>