<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment_model extends CI_Model
{ 
	
	// this method is used for the add comment
	function add_comment_by_user($data,$table_name)
	{
		$this->db->insert($table_name,$data);
		return $this->db->insert_id();
	}
	
	
	
	
	
}

/* End of file comment_model.php */
/* Location: ./application/models/comment_model.php */