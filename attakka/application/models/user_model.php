<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{ 
	
	
	// this method is used for the check user email exits or not
	public function check_email_already_exits_or_not($user_email,$table_name)
	{	
		$this->db->where("user_email",$user_email);
		$query = $this->db->get($table_name);
		return $query->row_array();
		
	}
	
	function add_user_detail($post,$table_name)
	{
		$this->db->insert($table_name,$post);	
		return $this->db->insert_id();
	}
	
	// this methos is used for the add user or registration user
	function add_user($post,$table_name)
	{
		$user_password = $post['user_password'];
		unset($post['operation']);
		unset($post['user_password']);
		unset($post['Submit']);
		unset($post['agree']);
		
		
		$post['user_password'] = md5($user_password);
		$post['user_created_date_time'] = date("Y-m-d H:i:s");		
		$this->db->insert($table_name,$post);	
		return $this->db->insert_id();
	}
	
	
	// this methos is used for the get user detail	
	function get_user_detail($table_name,$unique_id)
	{
		$this->db->where("unique_id",$unique_id);
		$query = $this->db->get($table_name);
		return $query->row_array();
	}
	
	// this method is used for the update user detail	
	function update_user_detail($table_name,$unique_id,$update_data)
	{
		$this->db->where("unique_id",$unique_id);
	    $query = $this->db->update($table_name,$update_data);	
	}
	
	// this method is used for the login user
	
	// this method is used for the check user email exits or not
	public function check_user_login($user_email,$user_password,$table_name)
	{	
		$this->db->where("user_email",$user_email);
		$this->db->where("user_password",md5($user_password));
		//$this->db->where("user_status",1);
		$query = $this->db->get($table_name);
		return $query->row_array();
		
	}
	
	
	function get_user_list($user_id,$table_name)
	{
		$this->db->where("user_id !=",$user_id);
		$this->db->group_by("user_email");
		$query = $this->db->get($table_name);
		return $query->result_array();
		
	}
	
	function get_category_list($user_id,$table_name)
	{
			
		$this->db->where("creator_id !=",$user_id);
		$this->db->order_by("review_average",'desc');
		$this->db->order_by("category_created_date_time",'desc');
		$query = $this->db->get($table_name);
		return $query->result_array();
	}
	
	
	function get_sub_category_list($user_id,$table_name)
	{
			
		$this->db->where("creator_id !=",$user_id);
		$this->db->order_by("review_average",'desc');
		$this->db->order_by("sub_category_created_date_time",'desc');		
		$query = $this->db->get($table_name);
		return $query->result_array();
	}
	
	
	
	// this method is used for the count total user record
	function count_total_user($table_name)
	{
		$query = $this->db->get($table_name);
		return $query->num_rows();
		
	}
	
	
	function active_inactive_user($table_name,$update_data,$user_id)
	{
		$this->db->where("user_id",$user_id);
		$this->db->update($table_name,$update_data);	
	}
	
	
	// this method is used for the count total category record
	function get_user_list_with_limit($table_name,$offset=0)
	{
		$query = $this->db->get($table_name,PER_PAGE_ADMIN_VIEW,$offset);		
		return $query->result_array();
		
	}
	
	// this methos is used for the get user detail	
	function get_user_detail_by_user_id($user_id,$table_name)
	{
		$this->db->where("user_id",$user_id);
		$query = $this->db->get($table_name);
		//echo $this->db->last_query();
		return $query->row_array();
	}
	
	
	function update_user_detail_by_user_id($user_id,$table_name,$user_data)
	{
		$this->db->where("user_id",$user_id);
		$this->db->update($table_name,$user_data);	
	}
	
	function get_user_detail_by_reset_id($reset_id,$table_name)
	{
		$this->db->where("unique_id_forget_password",$reset_id);		
		$query = $this->db->get($table_name);
		
		//echo $this->db->last_query();
		return $query->row_array();
	}
	
	
	// this method is used for the check email id exits or not
	public function check_user_exits_or_not_by_email($user_email,$table_name)
	{	
		$this->db->where("user_email",$user_email);		
		$query = $this->db->get($table_name);
		return $query->row_array();
		
	}
	
	
	function check_user_exits_or_not($user_id , $table_name )
	{
		$this->db->where("user_id",$user_id);		
		$query = $this->db->get($table_name);
		return $query->row_array();	
	}
	
	
	function get_review_by_user_id($user_id,$table_name)
	{
		$this->db->where("creator_id",$user_id);
		$query = $this->db->get($table_name);
		return $query->row_array();			
		
	}
	
	// this method is used for the get one review
	function get_review($table_name)
	{
		if($this->uri->segment(3)!="")
		{
			$this->db->where("review_id",$this->uri->segment(3));	
		}else{
			$this->db->where("rate",5);
		}
		
		$query = $this->db->get($table_name);
		return $query->row_array();			
		
	}
	
	// this method is used for the get latest review	
	function get_5_latest_review($table_name)
	{
		
		$this->db->order_by("rate","desc");
		//$this->db->order_by("review_created_date_time","desc");		 	
		//$this->db->where("review_rate_date_time ",$review_rate_date_time );
		$query = $this->db->get($table_name);
		//echo $this->db->last_query();
		return $query->result_array();	
			
	}
	
	
	
	function get_review_rate($review_id,$table_name)
	{
		$this->db->where("review_id",$review_id);
		$query = $this->db->get($table_name);
		return $query->row_array();	
		
	}
	
	
	function get_user_deatil_by_user_id($user_id,$table_name)
	{
		$this->db->where("user_id",$user_id);
		$query = $this->db->get($table_name);
		return $query->row_array();	
			
	}
	
	
}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */