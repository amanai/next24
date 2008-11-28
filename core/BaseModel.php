<?php
require_once(dirname(__FILE__). DIRECTORY_SEPARATOR. 'interfaces' . DIRECTORY_SEPARATOR . 'IDatabase.php');
abstract class BaseModel{
	protected $_pager = null;
	protected $_countRecords = 0;
	private $_ordering = false;
	private $_orderColumn;
	private $_orderDirection;
	
	
	
	protected $_changed = false;
	protected $_added = false;
	protected $_deleted = false;
	
	
	
	protected $_load_cache = false;
	protected $_load_all_cache = false;
	protected $_load_page_cache = false;
	protected $_cache_prefix = false;
	
	
	
	
	/**
	 * Table name
	 */
	protected $_table = null;
	protected $_prefix = null;
	protected $_data;
	protected $_client_id;
	
	
		function __construct($table, $prefix = null){
			$this -> _table = $table;
			$this -> _prefix = $prefix;
			$this -> clear();
		}
		
		function _caches($load = false, $all = false, $page = false){
			$DM = Project::getDatabaseManager();
			$this -> _load_cache = (bool)$load && $DM -> hasCache();
			$this -> _load_all_cache = (bool)$all && $DM -> hasCache();
			$this -> _load_page_cache = (bool)$page && $DM -> hasCache();
		}
						
		function load($id){
			$id = (int)$id;
			
			if ($this -> _load_cache === true){
				$cache = Project::getDatabaseManager() -> getCache();
				if ($cache !== null){
					$result = $cache -> get($this -> getCachePrefix('_' . $id));
					if (is_array($result)){
						$this -> bind($result);
						return $result;
					}
				}
			}
			$DE = Project::getDatabase(); // Get DB driver
			$result = array();
			$result = $DE -> selectRow("SELECT * FROM ".$this -> _table." WHERE id = ?d", $id); // Load 1 row
			$this -> bind($result); // Bind to internal variables at class
			if ($this -> _load_cache === true){
				$cache = Project::getDatabaseManager() -> getCache();
				if ($cache !== null){
					$cache -> set($this -> getCachePrefix('_' . $id), $result);
				}
			}
			return $result;
		}
		
		function loadAll($sortName = null, $sortOrder = null, $defaultSortName = "id"){
			if (is_null($sortName)){
				$sortName = $defaultSortName;
			}
			
			if ($this -> _load_all_cache === true){
				$cache = Project::getDatabaseManager() -> getCache();
				if ($cache !== null){
					$list = $cache -> get($this -> getCachePrefix('_list'));
					if (is_array($list)){
						return $list;
					}
				}
			}
			$DE = Project::getDatabase();
			$this -> checkPager();
			$sortOrder = $this -> getSortDirection($sortOrder);
			$result = $DE -> selectPage($this -> _countRecords, "SELECT * FROM ".$this -> _table." ORDER BY $sortName $sortOrder ");
			$this -> updatePagerAmount();
			if ($this -> _load_all_cache === true){
				$cache = Project::getDatabaseManager() -> getCache();
				if ($cache !== null){
					$cache -> set($this -> getCachePrefix('_list'), $result);
				}
			}
			return $result;
		}
		
		protected function getCachePrefix($data_key){
			return Project::getDatabaseManager() -> cachePrefix() . get_class($this) . $data_key;
		}
		
		
		function loadPage($sortName = null, $sortOrder = null, $defaultSortName = "id"){
			if (is_null($sortName)){
				$sortName = $defaultSortName;
			}
			$DE = Project::getDatabase();
			$this -> checkPager();
			$sortOrder = $this -> getSortDirection($sortOrder);
			$result = $DE -> selectPage($this -> _countRecords, "SELECT * FROM ".$this -> _table." ORDER BY $sortName $sortOrder LIMIT ?d, ?d ", $this -> _pager -> getStartLimit(), $this -> _pager -> getPageSize());
			$this -> updatePagerAmount();
			return $result;
		}
		
		function delete($id){
			$DE = Project::getDatabase();
			$DE -> query("DELETE FROM ".$this -> _table." WHERE id = ?d", $id);
		}
		
		function count(){
			$DE = Project::getDatabase();
			return (int)$DE -> selectCell("SELECT count(id) FROM ".$this -> _table);
		}
		
		function save(){
			if ($this -> _load_cache === true){
				$cache = Project::getDatabaseManager() -> getCache();
				if ($cache !== null){
					if ((int)$this -> id > 0){
						$cache -> delete($this -> getCachePrefix('_' . $this -> id));
					}
					$cache -> delete($this -> getCachePrefix('_list'));
				}
			}
			$DE = Project::getDatabase();
			
			if ((int)$this -> id > 0){
				$DE -> query('UPDATE '.$this -> _table.' SET ?a WHERE id = ?d', $this -> _data, $this -> id);
			} else {
				$this -> id = (int)$DE -> query('INSERT INTO '.$this -> _table.' (?#) VALUES(?a)', array_keys($this -> _data), array_values($this -> _data));
			}
			return $this -> id;
		}
		
		
		protected function checkPager(){
			if (!is_object($this -> _pager)){
				$this -> _pager = new DbPager();
			}
		}
		
		function __get($var){
			if (isset($this -> _data[$var])){
				return $this -> _data[$var];
			} else {
				return null;
			}
		}
		
		function __set($var, $val){
			$this -> _data[$var] = $val;
		}
		
		
		/**
		 * Bind result
		 */
		public function bind($result){
			if (!is_array($result)) {
				$result = array($result);
			}
			$this -> _data = array();
			foreach ($result as $key=>$value) {
				$this -> _data[$key] = $value;
			}
			if (isset($this -> _data['id'])){
				$this -> _data['id'] = (int)$this -> _data['id'];
			}
		}
		
		/**
		 * Bind result
		 */
		public function data(){
			return $this -> _data;
		}
		
		protected function getSortDirection($direction) {
			$direction = trim($direction);
			if (($direction == 'ASC') || ($direction == 'DESC')){
				return $direction;
			} else {
				return 'ASC';
			}
		}
		
		/**
		 * Set pager object
		 */
		public function setPager(IDbPager $oPager) {
			$this -> _pager = $oPager;
		}
		/**
		 * Get pager object
		 */
		public function getPager(){
			if (!is_object($this -> _pager)){
				$this -> _pager = new DbPager();
			}
			return $this -> _pager;
		}

		protected function updatePagerAmount(){
			$this -> _pager -> setFullAmount($this -> _countRecords);
		}
		
		/**
		 * Get count records
		 */
		public function getCountRecords(){
			return $this -> _countRecords;
		}
		
		public function clear(){
			$this -> _data = array();
		}
		
		/**
		 * Base functions
		 */
		
		public function changeOneValue($table_name, $id, $field, $value){
            $DE = Project::getDatabase();
            $sql = "
                UPDATE `$table_name` SET $field = '$value' 
                WHERE id = $id
            ";
            $result = $DE -> query($sql);
        }
        
        public function getOneRecord($table_name, $id){
            $DE = Project::getDatabase();
            $sql = "
                SELECT * FROM ".$table_name." 
                WHERE id = ?
            ";
            $result = $DE -> selectRow($sql, $id);
            return $result;
        }
        
        public function delOneRecord($table_name, $id){
            $DE = Project::getDatabase();
            $sql = "
                DELETE FROM ".$table_name." 
                WHERE id = ?
            ";
            $result = $DE -> query($sql, $id);
            return $result;
        }
        
        public function truncateTable($table_name){
            $DE = Project::getDatabase();
            $sql = "
                TRUNCATE TABLE `$table_name`
            ";
            $result = $DE -> query($sql);
            return $result;
        }
}
?>