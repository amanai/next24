<?php
class InterestModel extends BaseModel{
		function __construct(){
			parent::__construct('interest');
		}
		
		function set($interest){
			$result = Project::getDatabase() -> selectRow("SELECT * FROM interests WHERE LOWER(TRIM(name))=LOWER(TRIM(?))", $interest);
			$this -> bind($result);
			if ($this -> id <= 0){
				$this -> id = (int)Project::getDatabase() -> query("INSERT INTO interests SET name = ?s, count=0", $interest);
			}
			return $this -> id;
		}
		
		function increaseCounter($interest_id){
			Project::getDatabase() -> query("UPDATE interests SET count=count+1 WHERE id=?d", $interest_id);
		}
		
		function decreaseCounter($interest_id){
			Project::getDatabase() -> query("UPDATE interests SET count=count-1 WHERE id=?d", $interest_id);
		}
		
		function exists($interest_id){
			return (int)Project::getDatabase() -> selectCell("SELECT id FROM interests WHERE id=?d", $interest_id);
		}
}
?>