<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Base_Model extends CI_Model  
{

/*
| -----------------------------------------------------
| PRODUCT NAME: 	DIGI ONLINE EXAMINITION SYSTEM (DOES)
| -----------------------------------------------------
| AUTHER:			DIGITAL VIDHYA TEAM
| -----------------------------------------------------
| EMAIL:			digitalvidhya4u@gmail.com
| -----------------------------------------------------
| COPYRIGHTS:		RESERVED BY DIGITAL VIDHYA
| -----------------------------------------------------
| WEBSITE:			http://digitalvidhya.com
|                   http://codecanyon.net/user/digitalvidhya      
| -----------------------------------------------------
|
| MODULE: 			Base Model
| -----------------------------------------------------
| This is base model module file.
| -----------------------------------------------------
*/		

	function __construct()
	{
		parent::__construct();
	}

	
	//General database operations
	function run_query($query)
	{
		return($this->db->query($query)->result());  
	}
	
	function getMaxId($TableName, $ColName)
	{
		$query 							= $this->db->query(
		"select max(".$ColName.") as Id from "
		.$this->db->dbprefix($TableName)
		)->result();
		return $query[0]->Id;
	}

	function insert_operation($inputdata, $table, $email = '')
	{
		if ($this->db->insert($this->db->dbprefix($table), $inputdata))
    		return 1;
		else 
    		return 0;
	}

	function insert_operation_id($inputdata, $table, $email = '')
	{
		$result  = $this->db->insert($this->db->dbprefix($table), $inputdata);
		return $this->db->insert_id();
	}

	function update_operation($inputdata, $table, $where)
	{
		$result  = $this->db->update(
		$this->db->dbprefix($table), 
		$inputdata, 
		$where
		);
		return $result;
	}

	function fetch_single_column_value($table, $column, $where='')
	{
		$this->db->select($column,FALSE);
		$this->db->from( $this->db->dbprefix( $table ) );
		
		if( !empty( $where ) )
			$this->db->where( $where );
		$result_rs = $this->db->get();
		$result = $result_rs->result();
		if( count( $result ) > 0 )
			$ret = $result[0]->$column;
		else
			$ret = '-';
		return $ret;
	}
	
	function fetch_records_from(
	$table, 
	$condition 		= '', 
	$select 		= '*', 
	$order_by 		= '', 
	$limit 			= ''
	)
	{
		$this->db->select($select, FALSE);
		$this->db->from($this->db->dbprefix($table));
		if (!empty($condition))
			$this->db->where( $condition );
		if (!empty($order_by))
			$this->db->order_by($order_by);
		if (!empty($limit))
			$this->db->limit($limit);
		$result = $this->db->get();
		return $result->result();
	}


	function changestatus($table, $inputdata, $where )
	{
		$result = $this->db->update($this->db->dbprefix($table), $inputdata, $where);
		return $result;
	}

	function delete_record($table, $where)
	{	
		$result = $this->db->delete($table, $where);
		return $result;
	}

	function check_duplicate($table_name, $cond, $cond_val)
	{
		$col_name 		= '*';
		$this->db->where(array($cond=>$cond_val));
		$this->db->from($this->db->dbprefix($table_name));
		$query 			= $this->db->get();
		$rows 			= $query->num_rows();
		if ($rows > 0) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	function check_duplicates($table_name, $conditions)
	{
		$col_name 		= '*';
		$this->db->where($conditions);
		$this->db->from($this->db->dbprefix($table_name));
		$query = $this->db->get();
		$rows = $query->num_rows();
		if($rows > 0) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}
	
	public function get_details($table)
	{
		$query 			= $this->db->get($table);
		return $query->result_array();
	}

	function get_single_column_value($column_name, $table, $condition)
	{
		$this->db->select($column_name);
		$this->db->from($table);
		$this->db->where($condition);
		return $this->db->get()->row()->$column_name;
	}
	
}


/* End of file base_model.php */
/* Location: ./application/models/base_model.php */