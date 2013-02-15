<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{ 
	
	
	
	public function verify_admin_login($table_name,$condition)
	{
		if(!empty($condition))
		{
			foreach($condition as $key=>$value )
			{
				$this->db->where($key,$value);
			}
		}
		$query = $this->db->get($table_name);
		return $query->row_array();
		
	}
	
	// this methos is used for the get admin detail	
	function get_user_detail_by_user_id($admin_id,$table_name)
	{
		$this->db->where("admin_id",$admin_id);
		$query = $this->db->get($table_name);
		//echo $this->db->last_query();
		return $query->row_array();
	}
	
	
	// this methos is used for the get admin detail	
	function get_admin_detail_by_admin_email($admin_email,$table_name)
	{
		$this->db->where("admin_email",$admin_email);
		$query = $this->db->get($table_name);
		//echo $this->db->last_query();
		return $query->row_array();
	}
	
	
	function update_admin_detail_by_admin_id($admin_id,$table_name,$admin_data)
	{
		$this->db->where("admin_id",$admin_id);
		$this->db->update($table_name,$admin_data);	
	}
	
	function update_admin_password($admin_data,$table_name,$admin_email)
	{
			
		$this->db->where("admin_email",$admin_email);
		$this->db->update($table_name,$admin_data);	
	}
	
}

/* End of file admin_model.php */
/* Location: ./application/controllers/admin_model.php */