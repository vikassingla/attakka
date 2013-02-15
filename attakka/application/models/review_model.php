<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review_model extends CI_Model
{ 
	
	// this method is used for the add review
	function add_review_by_user($data,$table_name)
	{
		$this->db->insert($table_name,$data);
		return $this->db->insert_id();
	}
	
	
	// this method is used for the add review rate
	function add_review_rate_by_user($data,$table_name)
	{
		$this->db->insert($table_name,$data);
		return $this->db->insert_id();
	}
	
	
	// this method is used for the count total review
	function count_total_review($table_name)
	{
		$query = $this->db->get($table_name);
		return $query->num_rows();
		
	}
	
	
	// this method is used for the count total category record
	function get_review_list_with_limit($table_name,$offset=0)
	{
		$query = $this->db->get($table_name,PER_PAGE_ADMIN_VIEW,$offset);		
		return $query->result_array();
		
	}
	
	
		// this method is used for the get review detail by review_id
	function get_review_detail_by_review_id($table_name,$review_id)
	{				
		$this->db->where("review_id",$review_id);
	  	$query = $this->db->get($table_name);		
		return $query->row_array();
		
	}
	
}

/* End of file review_model.php */
/* Location: ./application/models/review_model.php */