<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sub_category_model extends CI_Model
{ 
	
	// this method is used for the add category
	function add_category($data,$table_name)
	{
		$this->db->insert($table_name,$data);
		return $this->db->insert_id();
	}
	
	// this method is used for the edit category
	function edit_category($data,$table_name)
	{		
		$this->db->where("sub_category_id",$data['sub_category_id']);
		$this->db->update($table_name,$data);	
	}
	
	function active_inactive_category($table_name,$update_data,$sub_category_id)
	{
		$this->db->where("sub_category_id",$sub_category_id);
		$this->db->update($table_name,$update_data);	
	}
	
	
	
	// this method is used for the delete category
	function delete_category($sub_category_id,$table_name)
	{
		$this->db->where("sub_category_id",$sub_category_id);
		$this->db->delete($table_name);	
	}
	
	
	// this method is used for the count total category record
	function count_total_category($table_name)
	{
		$query = $this->db->get($table_name);
		return $query->num_rows();
		
	}
	
	
	// this method is used for the count total category record
	function get_category_list_with_limit($table_name,$offset=0)
	{
		$query = $this->db->get($table_name,PER_PAGE_ADMIN_VIEW,$offset);		
		return $query->result_array();
		
	}
	
	
	function check_category_name_already_exits_or_not($sub_category_name,$table_name)
	{
		$this->db->where("sub_category_name",$sub_category_name);
		$query = $this->db->get($table_name);
		return $query->row_array();
	}
	
	function check_sub_category_name_already_exits_or_not($sub_category_name,$table_name,$user_id)
	{
		//$this->db->where("creator_id",$user_id);
		$this->db->where("sub_category_name",$sub_category_name);
		$query = $this->db->get($table_name);
		return $query->row_array();
	}
	
	
	
	function check_sub_category_name_for_edit_already_exits_or_not($sub_category_name,$table_name,$sub_category_id,$user_id)
	{
		
		$this->db->where("sub_category_id !=",$sub_category_id);
		$this->db->where("creator_id",$user_id);
		$this->db->where("sub_category_name",$sub_category_name);
		$query = $this->db->get($table_name);
		return $query->row_array();
	}
	
	
	function check_category_name_for_edit_already_exits_or_not($sub_category_name,$table_name,$sub_category_id)
	{
		
		$this->db->where("sub_category_id !=",$sub_category_id);
		$this->db->where("sub_category_name",$sub_category_name);
		$query = $this->db->get($table_name);
		return $query->row_array();
	}
	
	
	function add_category_image_detail($data,$table_name)
	{
		$this->db->insert($table_name,$data);
	}
	
	
	function edit_category_image_detail($data,$table_name,$category_image_id)
	{
		$this->db->where("sub_category_image_id",$category_image_id);
		$this->db->update($table_name,$data);
		
	}
	
	function get_category_detail($sub_category_id,$table_name)
	{
		$this->db->where("sub_category_id",$sub_category_id);
		$query = $this->db->get($table_name);
		return $query->row_array();	
	}
	
	function get_category_image_detail($sub_category_id,$table_name)
	{
		$this->db->where("sub_category_id",$sub_category_id);
		$query = $this->db->get($table_name);
		return $query->result_array();	
	}
	
	
	function get_all_category($table_name)
	{
		$query = $this->db->get($table_name);
		return $query->result_array();
	}
	
	
	function get_all_category_by_user_id($table_name,$user_id)
	{
		//$this->db->where("creator_id",$user_id);
		 $this->db->where("created_by",CATEGORY_CREATED_BY_USER);	
		$query = $this->db->get($table_name);
		return $query->result_array();
	}
	
	
	
	function get_sub_category_image_list_with_limit($table_name,$offset=0,$sub_category_id)
	{
		$this->db->where("sub_category_id",$sub_category_id);
		$query = $this->db->get($table_name,PER_PAGE_ADMIN_VIEW,$offset);		
		return $query->result_array();
		
	}
	
	
	// this method is used for the count total category record
	function count_total_sub_category_image($table_name,$sub_category_id)
	{
		$this->db->where("sub_category_id",$sub_category_id);
		$query = $this->db->get($table_name);
		return $query->num_rows();
		
	}
	
	function active_inactive_category_image($table_name,$update_data,$sub_category_image_id)
	{
		$this->db->where("sub_category_image_id",$sub_category_image_id);
		$this->db->update($table_name,$update_data);	
	}
	
	// this method is used for the count total category record
	function get_user_category_list_with_limit($table_name,$offset=0,$user_id)
	{				
		
		//$this->db->where("creator_id",$user_id);
	    $this->db->where("created_by",CATEGORY_CREATED_BY_USER);	
		$query = $this->db->get($table_name,PER_PAGE_USER_VIEW,$offset);		
		return $query->result_array();
		
	}
	
	
	function get_user_sub_category_detail_by_category_id($table_name,$user_id,$sub_category_id)
	{
		$this->db->where("creator_id",$user_id);
		$this->db->where("sub_category_id",$sub_category_id);
	    $this->db->where("created_by",CATEGORY_CREATED_BY_USER);	
		$query = $this->db->get($table_name);		
		return $query->row_array();
		
	}
	
	
	
	
	// this method is used for the count total category record of user
	function count_total_user_category($table_name,$user_id)
	{
		//$this->db->where("creator_id",$user_id);
		$this->db->where("created_by",CATEGORY_CREATED_BY_USER);		
		$query = $this->db->get($table_name);
		return $query->num_rows();
		
	}
	
	
	
	
}

/* End of file admin_model.php */
/* Location: ./application/controllers/admin_model.php */