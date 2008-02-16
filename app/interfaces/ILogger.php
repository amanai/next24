<?php
interface ILogger{
	public function log($msg, $level = false, $category = false);
	public function save();
	public function removeAll();
	public function count();
}
?>