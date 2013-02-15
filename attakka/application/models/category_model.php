<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model
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
		$this->db->where("category_id",$data['category_id']);
		$this->db->update($table_name,$data);	
	}
	
	function active_inactive_category($table_name,$update_data,$category_id)
	{
		$this->db->where("category_id",$category_id);
		$this->db->update($table_name,$update_data);	
	}
	
	function active_inactive_category_image($table_name,$update_data,$category_image_id)
	{
		$this->db->where("category_image_id",$category_image_id);
		$this->db->update($table_name,$update_data);	
	}
	
	
	// this method is used for the delete category
	function delete_category($category_id,$table_name)
	{
		$this->db->where("category_id",$category_id);
		$this->db->delete($table_name);	
	}
	
	
	// this method is used for the count total category record
	function count_total_category($table_name)
	{
		$query = $this->db->get($table_name);
		return $query->num_rows();
		
	}
	
	// this method is used for the count total category record
	function count_total_category_for_user($table_name,$user_id)
	{
		//$this->db->where("creator_id",$user_id);
		$this->db->where("created_by",CATEGORY_CREATED_BY_USER);		
		$query = $this->db->get($table_name);
		return $query->num_rows();
		
	}
	
	
	function get_user_category_data($table_name,$user_id,$category_id)
	{
		$this->db->where("creator_id",$user_id);
		$this->db->where("category_id",$category_id);
		$this->db->where("created_by",CATEGORY_CREATED_BY_USER);		
		$query = $this->db->get($table_name);
		return $query->row_array();
		
	}
	
	// this method is used for the count total category record
	function count_total_category_image($table_name,$category_id)
	{
		$this->db->where("category_id",$category_id);
		$query = $this->db->get($table_name);
		return $query->num_rows();
		
	}
	
	
	// this method is used for the count total category record
	function get_category_list_with_limit($table_name,$offset=0)
	{
		$query = $this->db->get($table_name,PER_PAGE_ADMIN_VIEW,$offset);		
		return $query->result_array();
		
	}
	
	
	// this method is used for the count total category record
	function get_category_list_with_limit_for_user($table_name,$offset=0,$user_id)
	{
		//this->db->where("creator_id",$user_id);
		$this->db->where("created_by",CATEGORY_CREATED_BY_USER);			
		$query = $this->db->get($table_name,PER_PAGE_USER_VIEW,$offset);		
		return $query->result_array();
		
	}
	
	function get_category_image_list_with_limit($table_name,$offset=0,$category_id)
	{
		
		$this->db->where("category_id",$category_id);
		$query = $this->db->get($table_name,PER_PAGE_ADMIN_VIEW,$offset);		
		return $query->result_array();
		
	}
	
	
	
	
	function check_category_name_already_exits_or_not($category_name,$table_name)
	{
		$this->db->where("category_name",$category_name);
		$query = $this->db->get("tbl_category");
		return $query->row_array();
	}
	
	
	function check_user_category_name_already_exits_or_not($category_name,$table_name,$user_id,$created_by)
	{
		$this->db->where("category_name",$category_name);
		//$this->db->where("creator_id",$user_id);
		$this->db->where("created_by",$created_by);
		$query = $this->db->get("tbl_category");
		return $query->row_array();
	}
	
	function check_user_edit_category_name_already_exits_or_not($category_id,$category_name,$table_name,$user_id,$created_by)
	{
		$this->db->where("category_name",$category_name);
		$this->db->where("category_id !=",$category_id);
		$this->db->where("creator_id",$user_id);
		$this->db->where("created_by",$created_by);
		$query = $this->db->get("tbl_category");
		return $query->row_array();
	}
	
	
	
	function check_category_name_for_edit_already_exits_or_not($category_name,$table_name,$category_id)
	{
		
		$this->db->where("category_id !=",$category_id);
		$this->db->where("category_name",$category_name);
		$query = $this->db->get("tbl_category");
		return $query->row_array();
	}
	
	
	function add_category_image_detail($data,$table_name)
	{
		$this->db->insert($table_name,$data);
	}
	
	
	function edit_category_image_detail($data,$table_name,$category_image_id)
	{
		$this->db->where("category_image_id",$category_image_id);
		$this->db->update($table_name,$data);
		
	}
	
	function get_category_detail($category_id,$table_name)
	{
		$this->db->where("category_id",$category_id);
		$query = $this->db->get($table_name);
		return $query->row_array();	
	}
	
	function get_category_image_detail($category_id,$table_name)
	{
		$this->db->where("category_id",$category_id);
		$query = $this->db->get($table_name);
		return $query->result_array();	
	}
	
	
}

/* End of file admin_model.php */
/* Location: ./application/controllers/admin_model.php */