<?
require_once('config.php');

class Node extends BasicNode{
	// factory
		static function by_id($id, $tablename){
			$id = (int) $id;
			$r = Mysql::query_row(
				" select
					*
				from
					$tablename
				where
					id = $id
				"
			);
			if ($r && isset($r['key'])){
				return new Node(new Key($r['key']), $tablename);
			}else{
				return false;
			}
		}
		static function by_key($key, $tablename){
			if ($key instanceof Key){
				return new Node($key, $tablename);
			}else{
				return new Node(new Key($key) ,$tablename);
			}
		}
	//methods
		function getBranch(){
			return Mysql::query_iterator(
				" select
					id
					, `key`
					, level
					, name
				from
					{$this->tablename}
				where
					`key` like '{$this->key}%'
				order by
					`key`
				"
			);
		}
}

class TreeTestPage extends ioPage{
	function __construct(){
		parent::__construct(array(
			'show_tree' => array()
			, 'move_up' => array(
				'id' => 'int'
			)
			, 'move_down' => array(
				'id' => 'int'
			)
			, 'delete' => array(
				'id' => 'int'
			)
			, 'change_parent' =>array(
				'id' => 'int'
				, 'parent_id' => 'int'
			)
		));
	}
	function show_tree($vars){
		$n = Node::by_key('', 'sitemap');
		$this->data['tree'] = $n->getBranch();
		$this->template_name = 'tree_test.tpl';
	}
	function move_up($vars){
		$n = Node::by_id($vars['id'], 'sitemap');
		$n->moveUp();
		$this->go_page();
	}
	function move_down($vars){
		$n = Node::by_id($vars['id'], 'sitemap');
		$n->moveDown();
		$this->go_page();
	}
	function delete($vars){
		$n = Node::by_id($vars['id'], 'sitemap');
		$n->delete();
		$this->go_page();
	}
	function change_parent($vars){
		$n = Node::by_id($vars['id'], 'sitemap');
		$parent = Node::by_id($vars['parent_id'], 'sitemap');
		$n->changeParent($parent);
		$this->go_page();
	}
}

$p = new TreeTestPage;
$p->renderPage();


?>
