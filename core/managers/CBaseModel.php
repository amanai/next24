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
		$sql .= "SELECT * FROM " . $this->tableNameDB . " WHERE id = " . $id;
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
	function setData($data)
	{
		foreach ($data as $field => $value) 
		{
			if (array_key_exists($field, $this->fields)) 
			{
				$this->fields[$field] = $value;
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
		$sql = "INSERT INTO `" . $this->tableNameDB . "`
				SET " . $this->_prepareFields();
		MySql::query($sql);
		$this->id = MySql::insert_id();
		return $this->id;
	}

	/*
	�������� ������
	*/
	function update()
	{
		$sql = "UPDATE `" . $this->tableNameDB . "`
				SET " . $this->_prepareFields() . "
				WHERE `id` = '" . $this->id . "'";
		return MySql::query($sql);
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
	function join($name, $cond, $type = null)
    {
		$this->_parts['join'][] = array(
			'type' => $type,
			'name' => $name,
			'cond' => $cond,
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
        if ($this->_parts['distinct']) 
		{
            $sql .= " DISTINCT";
        }
        if ($this->_parts['forUpdate']) 
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
        if ($this->_parts['from']) 
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
        if ($this->_parts['join']) 
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
                $tmp .= 'JOIN ' . TABLE_PREFIX . $join['name'] . " AS " . $join['name'];
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
        if ($this->_parts['having']) 
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
        return $sql;
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
}

?>
