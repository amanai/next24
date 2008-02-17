<?php
class DbPager implements IDbPager{
	private $_pageNumber;
	private $_pageSize;
	private $_pagedList = false;
	private $_fullAmount = 0;
	
			function __construct($pageNumber = 0, $pageSize = 10){
				$this -> setPager($pageNumber, $pageSize);
			}
			
			/**
			 * Set pager
			 */
			public function setPager($pageNumber, $pageSize) {
				$pageNumber = (int)$pageNumber;
				$pageSize = (int)$pageSize;
				if ($pageSize > 0) {
					$this -> _pageSize = $pageSize;
				}
				if ($pageNumber > 0) {
					$this -> _pageNumber = $pageNumber;
				}
			}
			
			public function getPageCount(){
				return ceil($this -> _fullAmount/$this -> _pageSize);
			}
			
			/**
			 * Get page number
			 */
			public function getPageNumber(){
				return $this -> _pageNumber;
			}
			/**
			 * Get page size
			 */
			public function getPageSize(){
				return $this -> _pageSize;
			}
			
			public function setFullAmount($value) {
				$this -> _fullAmount = $value;
			}
			
			public function getFullAmount() {
				return $this -> _fullAmount;
			}
			
			public function getStartLimit(){
				return ($this -> _pageSize*$this -> _pageNumber);
			}
			
			public function getEndLimit(){
				return ($this -> _pageSize*($this -> _pageNumber + 1));
			}
}
?>
