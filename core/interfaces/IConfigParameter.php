<?php
interface IConfigParameter{
	public function get($id, $default=null);
	public function count();
	public function clear();
}
?>