<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner_model extends CI_Model
{ 
	
	// this method is used for the add banner
	function add_banner($data,$table_name)
	{
		$this->db->insert($table_name,$data);
		return $this->db->insert_id();
	}
	
	// this method is used for the edit banner
	function edit_banner($data,$table_name)
	{		
		$this->db->where("banner_id",$data['banner_id']);
		$this->db->update($table_name,$data);	
	}
	
	function active_inactive_banner($table_name,$update_data,$banner_id)
	{
		$this->db->where("banner_id",$banner_id);
		$this->db->update($table_name,$update_data);	
	}
	
	// this method is used for the delete banner
	function delete_bannner($banner_id,$table_name)
	{
		$this->db->where("banner_id",$banner_id);
		$this->db->delete($table_name);	
	}
	
	
	// this method is used for the count total banner record
	function count_total_banner($table_name)
	{
		$query = $this->db->get($table_name);
		return $query->num_rows();
		
	}
	
	
	// this method is used for the count total banner record
	function get_banner_list_with_limit($table_name,$offset=0)
	{
		$query = $this->db->get($table_name,PER_PAGE_ADMIN_VIEW,$offset);		
		return $query->result_array();
		
	}
	
	
	function get_banner_detail($banner_id,$table_name)
	{
		$this->db->where("banner_id",$banner_id);
		$query = $this->db->get($table_name);
		return $query->row_array();	
	}
	

}

/* End of file banner_model.php */
/* Location: ./application/controllers/banner_model.php */