<?php
class InterestModel extends BaseModel{
		function __construct(){
			parent::__construct('interest');
		}
		
		function set($interest){
			$result = Project::getDatabase() -> selectRow("SELECT * FROM interest WHERE LOWER(TRIM(name))=LOWER(TRIM(?))", $interest);
			$this -> bind($result);
			if ($this -> id <= 0){
				$this -> id = (int)Project::getDatabase() -> query("INSERT INTO interest SET name = '?', count=0", $interest);
			}
			return $this -> id;
		}
		
		function increaseCounter($interest_id){
			Project::getDatabase() -> query("UPDATE interest SET count=count+1 WHERE id=?d", $interest_id);
		}
		
		function exists($interest_id){
			return (int)Project::getDatabase() -> selectCell("SELECT id FROM interest WHERE id=?d", $interest_id);
		}
}
?>