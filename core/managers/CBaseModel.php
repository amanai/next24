<?php
class CBaseModel
{
	var $id;
	var $fields = null;
	var $tableName;
	var $tableNameDB;
	var $_parts;

	/*
	�����������
	��� ������� ������� �� ����� ������
	���� ������ Id ��� �������� �������������� ���������� ������ ������� �� �������
	*/
	function __construct($id = null)
	{
		$this->id = $id;
		if (!$this->tableName) 
		{
			$this->tableName = strtolower (get_class($this));
		}
		$this->tableNameDB = TABLE_PREFIX . $this->tableName;
		$this->_initFields();
		$this->_initFieldsValues();
		$this->resetSql();
	}

	/*
	�������������� ������ ����� �������
	*/
	function _initFields()
    {
        if (!is_array($this->fields)) 
		{
            $sql = "SHOW COLUMNS FROM `" . $this->tableNameDB . "`";
            $rs = MySql::query_array($sql);
			foreach($rs as $item)
			{ 
				$this->fields[$item['Field']] = null;
        	} 
        }
        return true;
	}
	
	function load($id){
		$this->resetSql();
		$this->id = $id;
		$this->_initFieldsValues();
	}

	/*
	�������������� �������� �����
	*/
	function _initFieldsValues()
	{
		if ($this->id == null) 
		{
			return false;
		}
		$row = $this->getById($this->id);
		if ($row == false) 
		{
			return false;
		} 
		foreach ($row as $field => $value) 
		{
			if (array_key_exists($field, $this->fields)) 
			{
				$this->fields[$field] = $value;
			}
		}
		return true;
	}

	
	/*
	������� �� ������� �� Id
	*/
	function getById($id)
	{
		$sql = "SELECT * FROM " . $this->tableNameDB . " WHERE id = " . $id;
		//echo $sql.'<br>';
		$rs = MySql::query_row($sql);
		if ($rs) 
		{
			return $rs;
		}
		return false;
	}

	/*
	��������� �������� ��� ����
	*/
	function set($field, $value)
	{
		if ($field == 'id'){
			$this -> id = (int)$value;
		}
		if (!array_key_exists($field, $this->fields)) 
		{
			return false;
		}
		$this->fields[$field] = $value;
		return true;
	}

	/*
	��������� �������� ���� ����� �� �������
	*/
	function setData($data, $encode = false)
	{
		foreach ($data as $field => $value) 
		{
			if ($field == 'id'){
				$this -> id = (int)$value;
			}
			if (array_key_exists($field, $this->fields)) 
			{
				if ($encode){
					$this->fields[$field] = $value;
					//$this->fields[$field] = iconv('UTF-8', 'CP1251', $value);
				} else {
					$this->fields[$field] = $value;
				}
			}
		}
		return true;
	}

	/*
	����� �������� ����
	*/
	function get($field)
	{
		if (!array_key_exists($field, $this->fields)) 
		{
			return false;
		}
		return $this->fields[$field];
	}

	/*
	����� ������ ���� ��������
	*/
	function getData()
	{
		return $this->fields;
	}

	/*
	�������� ������
	*/
	function insert()
	{
		unset($this -> fields['id']);
		$sql = "INSERT INTO `" . $this->tableNameDB . "`
				SET " . $this->_prepareFields();
		
		MySql::query($sql);
		//echo $sql;
		$this->id = MySql::insert_id();
		//echo '<br>'.$sql.'<br>';
		return $this->id;
	}

	/*
	�������� ������
	*/
	function update()
	{
		if (isset($this -> fields['id'])){
			$this->id = (int)$this -> fields['id'];
			unset($this -> fields['id']);
		}
		$sql = "UPDATE `" . $this->tableNameDB . "`
				SET " . $this->_prepareFields() . "
				WHERE `id` = '" . $this->id . "'";
		//echo '<br>'.$sql.'<br>';die;
		return MySql::query($sql);
	}
	
	/**
	 * ��������� ������: ���� ������ ��� - �������, ����� - ��������
	 * �������������� ������ ���� ���������.
	 * <code>
	 * 	$o = new Model();
	 * 	$o -> set('name' , 'Vasya');
	 * 	$id1 = $o -> save(); // New ID
	 * 	$o -> set('name' , 'Kolya');
	 * 	$id2 = $o -> save(); // $id1 = $id2 and fetched same record
	 * </code>
	 */
	function save(){
		if ((int)$this -> id > 0){
			$this -> update();
		} else {
			$this -> id = $this -> insert();
		}
		return (int)$this -> id;
	}

	/*
	������� ������
	*/
	function delete()
	{
		$sql = "DELETE FROM `" . $this->tableNameDB . "`
				WHERE id = " . $this->id;
		return MySql::query($sql);
	}
	
	function escape($value){
		return mysql_escape_string($value);
	}

	/*
	���������� ������ �����
	*/
	function _prepareFields()
	{
		$fieldStr = array();
		foreach ($this->fields as $name => $value) 
		{
			$fieldStr[] = " `" . $name . "` = '" . mysql_escape_string($value) . "'";
		}
		return implode(", ", $fieldStr);
	}

	function resetSql(){
		$this->_parts['cols'] = '*';
		$this->_parts['where'] = array();
        $this->_parts['limitCount']  = 0;
        $this->_parts['limitOffset'] = 0;
        $this->_parts['group'] = array();
        $this->_parts['order'] = array();
        $this->_parts['join'] = array();
        
	}
	
	/*
	��������� ������ �������������� ����� ��� �������
	*/
	function pager($use = true)
	{
		if (!is_bool($use)){
			$use = false;
		}
		$this->_parts['pager'] = $use;
	}
	
	
	/*
	��������� ������ �������������� ����� ��� �������
	*/
	function cols($cols = '*')
	{
		$this->_parts['cols'] = $cols;
	}

	/*
	��������� ������� ������ ��� �������

	*/
	function limit($count = null, $offset = null)
    {
        $this->_parts['limitCount']  = (int) $count;
        $this->_parts['limitOffset'] = (int) $offset;
        return true;
	}

	/*
	��������� ����������� ��� �������
	*/
	function group($group)
	{
		$this->_parts['group'][] = $group;
	}

	/*
	��������� ���������� ��� �������
	*/
	function order($order)
	{
		$this->_parts['order'][] = $order;
	}

	/*
	��������� ������ ������� ��� �������
	$type - ��� ������
	$name - ��� �������
	$cond - �������
	*/
	function join($name, $cond, $type = null, $alias = null)
    {
		$this->_parts['join'][] = array(
			'type' => $type,
			'name' => $name,
			'cond' => $cond,
			'alias' => $alias
		);
        return true;
	}

	/*
	��������� ������� ��� �������
	*/
	function where($cond)
    {
        if ($this->_parts['where']) 
		{
            $this->_parts['where'][] = "AND $cond";
        } 
		else 
		{
            $this->_parts['where'][] = $cond;
        }
        return true;
	}

	/*
	��������� �������
	*/
	function getQueryStr($dateFormat = false)
    {
        $sql = "SELECT";
        if (isset($this->_parts['distinct'])) 
		{
            $sql .= " DISTINCT";
        }
        
        if (isset($this->_parts['pager']) && ($this->_parts['pager'] === true)) 
		{
            $sql .= " SQL_CALC_FOUND_ROWS ";
        }
        
        if (isset($this->_parts['forUpdate'])) 
		{
            $sql .= " FOR UPDATE";
        }
        $sql .= "\n\t";
        // ��������� ����
        if ($this->_parts['cols']) 
		{
            $sql .= implode(",\n\t", (array)$this->_parts['cols']) . "\n";
		} 
		else 
		{
			$sql .= "*";
		}
        $sql .= "\n\t";
        $sql .= "FROM ";
		// ������ ������
        if (isset($this->_parts['from'])) 
		{
            $list = array();
            foreach ($this->_parts['from'] as $from) 
			{
                $list[] = " " . TABLE_PREFIX . $from['name'] . " AS " . $from['name'] . " ";
            }
            $sql .= implode(", ", $list) . "\n";
		}
		else
		{
			$sql .= $this->tableNameDB . ' AS `' .  $this->tableName . '`';
		}
        $sql .= "\n\t";
        // ������ �������
        if (isset($this->_parts['join'])) 
		{
            $list = array();
            foreach ($this->_parts['join'] as $join) 
			{
                $tmp = '';
                // ��� (LEFT, INNER, etc)
                if (! empty($join['type'])) 
				{
                    $tmp .= strtoupper($join['type']) . ' ';
                }
                // ��� ������ � �������
                $tmp .= 'JOIN ' . TABLE_PREFIX . $join['name'] . " AS " . (is_null($join['alias'])?$join['name']:$join['alias']);
                $tmp .= ' ON ' . $join['cond'];
                $list[] = $tmp;
            }
            $sql .= implode("\n", $list) . "\n";
        }
        // ������� ������
        if ($this->_parts['where']) 
		{
            $sql .= "WHERE\n\t";
            $sql .= implode("\n\t", $this->_parts['where']) . "\n";
        }
        // �����������
        if ($this->_parts['group']) 
		{
            $sql .= "GROUP BY\n\t";
            $sql .= implode(",\n\t", $this->_parts['group']) . "\n";
        }
        // having
        if (isset($this->_parts['having'])) 
		{
            $sql .= "HAVING\n\t";
            $sql .= implode("\n\t", $this->_parts['having']) . "\n";
        }
        // ����������
        if ($this->_parts['order']) 
		{
            $sql .= "ORDER BY ";
            $sql .= implode("`,\n\t`", (array)$this->_parts['order']) . "\n";
        }
        // ������
        $count = ! empty($this->_parts['limitCount'])
            ? (int) $this->_parts['limitCount']
            : 0;
        $offset = ! empty($this->_parts['limitOffset'])
            ? (int) $this->_parts['limitOffset']
            : 0;
		if ($count || $offset) 
		{
			$sql .= " LIMIT " . $offset . ", " . $count;
		}
//echo $sql.'<br>';
        return $sql;
	}
	
	function foundRows(){
		$c = MySql::query_row("SELECT FOUND_ROWS() as counter");
		return (int)$c['counter'];
	}

	/*
	��������� ������
	*/
	function Exec()
	{
		$sql = $this->getQueryStr(true);
		return MySql::query($sql);
	}

	/*
	��������� ������. ����� ���� ������
	*/
	function getOne()
	{
		$sql = $this->getQueryStr();
		return MySql::query_row($sql);
	}

	/*
	��������� ������. ����� ����� ���������
	*/
	function getAll()
	{
		$sql = $this->getQueryStr(true);
		//echo $sql .'<br>';
		return MySql::query_array($sql);
	}

	/*
	�������� ������
	*/
	function replace()
	{	
		$sql = "REPLACE INTO `" . $this->tableNameDB . "`
				SET " . $this->_prepareFields() . "
				WHERE `id` = '" . $this->id . "'";
		return MySql::query($sql);
	}
	
	function setUtf8(){
		return MySql::query("SET NAMES utf8");
	}
}

?>
