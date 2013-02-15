<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message_model extends CI_Model
{ 
	
	// this method is used for the add message detail
	function add_message($data,$table_name)
	{
		$this->db->insert($table_name,$data);
		return $this->db->insert_id();
	}
	
	
	// this method is used for the add message reply detail
	function add_message_reply($data,$table_name)
	{
		$this->db->insert($table_name,$data);
		return $this->db->insert_id();
	}
	
	
	
	
	// this method is used for the get message detail by message id
	function get_message_detail_by_message_id($message_id,$user_id,$user_email,$table_name)
	{	
		$this->db->where("sender_id",$user_id);	 // user see send detail		
		$this->db->where("message_id",$message_id);			
		$query = $this->db->get($table_name);
		return $query->row_array();
	}
	
	
	// this method is used for the get message detail by message id
	function get_message_detail_by_message_id_email($message_id,$user_id,$user_email,$table_name)
	{	
		$this->db->where("to_email",$user_email);	 // user see send detail		
		$this->db->where("message_id",$message_id);			
		$query = $this->db->get($table_name);
		return $query->row_array();
	}
	
	
	
	
	function count_message($user_id)
	{
		$this->db->where("sender_id",$user_id);		
		$query = $this->db->get($table_name);
		return $query->row_array();
		
	}
	
	
	
	// this method is used for the count total message record
	function get_message_list_with_limit($table_name,$offset=0,$user_id,$user_email)
	{				
		
		
		$condition = $this->uri->segment(3);
		if($condition=='s')
		{
			$this->db->where("sender_id",$user_id);	
		}else if($condition=='r'){

			// $this->db->where("receiver_id",$user_id);
			$this->db->where("to_email",$user_email);
			
		}else{
			$this->db->where("sender_id",$user_id);	
		}
		
			   
		
		$query = $this->db->get($table_name,PER_PAGE_USER_VIEW,$offset);		
		return $query->result_array();
		
	}
	
	// this method is used for the count total message record of user
	function count_total_message($table_name,$user_id,$user_email)
	{
		$condition = $this->uri->segment(3);
		if($condition=='s')
		{
			$this->db->where("sender_id",$user_id);	
		}else if($condition=='r'){

			// $this->db->where("receiver_id",$user_id);
			$this->db->where("to_email",$user_email);
			
		}else{
			$this->db->where("sender_id",$user_id);	
		}
		
		$query = $this->db->get($table_name);
		return $query->num_rows();
		
	}
	
	
	
	// this method is used for the count total message record
	function get_message_list_with_limit_in_admin($table_name,$offset=0,$user_id,$user_email)
	{				
		
		
		$condition = $this->uri->segment(4);
		if($condition=='s')
		{
			$this->db->where("sender_id",$user_id);	
		}else if($condition=='r'){

			// $this->db->where("receiver_id",$user_id);
			$this->db->where("to_email",$user_email);
			
		}else{
			$this->db->where("sender_id",$user_id);	
		}
		
			   
		
		$query = $this->db->get($table_name,PER_PAGE_USER_VIEW,$offset);		
		return $query->result_array();
		
	}
	
	// this method is used for the count total message record of user
	function count_total_message_in_admin($table_name,$user_id,$user_email)
	{
		$condition = $this->uri->segment(4);
		if($condition=='s')
		{
			$this->db->where("sender_id",$user_id);	
		}else if($condition=='r'){

			// $this->db->where("receiver_id",$user_id);
			$this->db->where("to_email",$user_email);
			
		}else{
			$this->db->where("sender_id",$user_id);	
		}
		
		$query = $this->db->get($table_name);
		return $query->num_rows();
		
	}
	
	
	
	
	
}

/* End of file message_model.php */
/* Location: ./application/models/message_model.php */