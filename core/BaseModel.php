<?php
require_once(dirname(__FILE__). DIRECTORY_SEPARATOR. 'interfaces' . DIRECTORY_SEPARATOR . 'IDatabase.php');
abstract class BaseModel{
	private $_pager = null;
	protected $_countRecords = 0;
	private $_ordering = false;
	private $_orderColumn;
	private $_orderDirection;
	
	
	
	protected $_changed = false;
	protected $_added = false;
	protected $_deleted = false;
	
	
	
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
						
		function load($id){
			$id = (int)$id;
			$DE = Project::getDatabase(); // Get DB driver
			$result = array();
			$result = $DE -> selectRow("SELECT * FROM ".$this -> _table." WHERE id = ?d", $id); // Load 1 row
			$this -> bind($result); // Bind to internal variables at class
			return $result;
		}
		
		function loadAll($sortName = null, $sortOrder = null, $defaultSortName = "id"){
			if (is_null($sortName)){
				$sortName = $defaultSortName;
			}
			$DE = Project::getDatabase();
			$this -> checkPager();
			$sortOrder = $this -> getSortDirection($sortOrder);
			$result = $DE -> selectPage($this -> _countRecords, "SELECT * FROM ".$this -> _table." ORDER BY $sortName $sortOrder ");
			$this -> updatePagerAmount();
			return $result;
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
}
?>