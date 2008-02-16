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
				if (defined('CLIENT_ID')){
					$this -> _client_id = CLIENT_ID;
				} else {
					throw new DbException("Client is not defined!!!");
				}
				$this -> clear();
			}
							
			function load($id){
				$id = (int)$id;
				$DE = Reg::getDatabase(); // Get DB driver
				$result = array();
				$result = $DE -> selectRow("SELECT * FROM ".$this -> _table." WHERE client_id = ?d AND id = ?d", $this -> _client_id, $id); // Load 1 row
				$this -> bind($result); // Bind to internal variables at class
				return $result;
			}
			
			function loadAll($sortName = null, $sortOrder = null, $defaultSortName = "id"){
				if (is_null($sortName)){
					$sortName = $defaultSortName;
				}
				$DE = Reg::getDatabase();
				$this -> checkPager();
				$sortOrder = $this -> getSortDirection($sortOrder);
				$result = $DE -> selectPage($this -> _countRecords, "SELECT * FROM ".$this -> _table." WHERE client_id=? ORDER BY $sortName $sortOrder ", $this -> _client_id);
				$this -> updatePagerAmount();
				return $result;
			}
			
			function loadByParentId($parentId, $active = true, $parentKey = 'parent_id', $sortName = null, $sortOrder = null){
				if (is_null($sortName)){
					$sortName = 'id';
				}
				
				if (is_null($sortOrder)){
					$sortOrder = 'ASC';
				}
				if ($active === true){
					$a = " active = 1 ";
				} else {
					$a = 1;
				}
				$DE = Reg::getDatabase();
				$sortOrder = $this -> getSortDirection($sortOrder);
				$result = $DE -> select("SELECT * FROM ".$this -> _table." WHERE client_id=?d AND $parentKey = ?d AND $a ORDER BY $sortName $sortOrder ", $this -> _client_id, $parentId);
				return $result;
			}
			
			function loadAcl($field_id, $field_name){
				$DE = Reg::getDatabase();
				return  $DE -> selectRow("SELECT * FROM ".$this -> _table." WHERE client_id=?d AND user_group_id = ?d AND access = 1 AND $field_name=?d ", $this -> _client_id, (int)ReggetUser() -> getDbUser() -> user_group_id, $field_id);
			}

			function loadPage($sortName = null, $sortOrder = null, $defaultSortName = "id"){
				if (is_null($sortName)){
					$sortName = $defaultSortName;
				}
				$DE = Reg::getDatabase();
				$this -> checkPager();
				$sortOrder = $this -> getSortDirection($sortOrder);
				$result = $DE -> selectPage($this -> _countRecords, "SELECT * FROM ".$this -> _table." WHERE client_id = ?d ORDER BY $sortName $sortOrder LIMIT ?d, ?d ", $this -> _client_id, $this -> _pager -> getStartLimit(), $this -> _pager -> getPageSize());
				$this -> updatePagerAmount();
				return $result;
			}
			
			function delete($id){
				$DE = Reg::getDatabase();
				$DE -> query("DELETE FROM ".$this -> _table." WHERE client_id =?d AND id = ?d", $this -> _client_id, $id);
			}
			
			function count(){
				$DE = Reg::getDatabase();
				return (int)$DE -> selectCell("SELECT count(id) FROM ".$this -> _table." WHERE client_id = ?d", $this -> _client_id);
			}
			
			function save(){
				$DE = Reg::getDatabase();
				if ((int)$this -> id > 0){
					$DE -> query('UPDATE '.$this -> _table.' SET ?a WHERE client_id = ?d AND id = ?d', $this -> _data, $this -> _client_id, $this -> id);
				} else {
					if (!isset($this -> _data['client_id'])){
						$this -> _data['client_id'] = $this -> _client_id;
					}
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
				$this -> _data['client_id'] = $this -> _client_id;
			}
			
			public function getCreatedBy(){
				// TODO:: need to check
				return new CUser($this -> created_by);
			}
			
			public function getModifiedBy(){
				// TODO:: need to check
				return new CUser($this -> modified_by);
			}
}
?>