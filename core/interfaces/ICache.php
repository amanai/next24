<?php
interface ICache{
	public function get($id, $default = null);
	public function set($id, $value, $expire = 0);
	public function add($id, $value, $expire = 0);
	public function delete($id);
}
?>
