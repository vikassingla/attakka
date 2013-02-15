<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Topic_model extends CI_Model
{ 



	// this method is used for the get topic detail
	function get_topic_detail_by_topic_id($table_name,$user_id,$topic_id)
	{				
		
		$this->db->where("topic_creator_id",$user_id);
		$this->db->where("topic_id",$topic_id);
	    $this->db->where("topic_created_by",TOPIC_CREATED_BY_USER);	
		$query = $this->db->get($table_name);		
		return $query->row_array();
		
	}
	
	
	
	
	function get_wall_paper()
	{
		//$this->db->where("topic_creator_id",$user_id);
		//$this->db->where("topic_id",$topic_id);	   
		$query = $this->db->get("tbl_sub_category_image");		
		return $query->result_array();
	}


	// this method is used for the count total category record
	function get_user_topic_list_with_limit($table_name,$offset=0,$user_id)
	{				
		
		$this->db->where("topic_creator_id",$user_id);
	    $this->db->where("topic_created_by",TOPIC_CREATED_BY_USER);	
		$query = $this->db->get($table_name,PER_PAGE_USER_VIEW,$offset);		
		return $query->result_array();
		
	}
	
	// this method is used for the count total category record of user
	function count_total_topic_of_user($table_name,$user_id)
	{
		$this->db->where("topic_creator_id",$user_id);
		$this->db->where("topic_created_by",TOPIC_CREATED_BY_USER);		
		$query = $this->db->get($table_name);
		return $query->num_rows();
		
	}
	
	
	
	// this method is used for the add topic
	function add_topic($data,$table_name)
	{
		$this->db->insert($table_name,$data);
		return $this->db->insert_id();
	}
	
	// this method is used for the get all sub category of user
	function get_all_sub_category_by_user_id($table_name,$user_id,$category_id)
	{
		$this->db->where("creator_id",$user_id);
		$this->db->where("category_id",$category_id);
	    $this->db->where("created_by",CATEGORY_CREATED_BY_USER);	
		$query = $this->db->get($table_name);		
		return $query->result_array();
	}
	
	
	// this method is used for the get latest topic
	function get_latest_topic($table_name,$offset=0,$user_id)
	{				
		
		$this->db->where("topic_creator_id !=",$user_id);
	    $this->db->where("topic_created_by",TOPIC_CREATED_BY_USER);	
		$query = $this->db->get($table_name,TOPIC_HOME_PAGE,$offset);		
		return $query->result_array();
		
	}
	
	// this method is used for the count total category record of user
	function count_latest_topic($table_name,$user_id)
	{
		$this->db->where("topic_creator_id !=",$user_id);
		$this->db->where("topic_created_by",TOPIC_CREATED_BY_USER);		
		$query = $this->db->get($table_name);
		return $query->num_rows();
		
	}
	
	
	function get_topic_det_by_topic_id($topic_id,$table_name)
	{		
		$this->db->where("topic_id",$topic_id);
		$query = $this->db->get($table_name);
		return $query->row_array();	
		
		
	}
	
	
	
	function get_topic_sub_category_detail_by_sub_category_id($sub_category_id,$table_name)
	{		
		$this->db->where("sub_category_id",$sub_category_id);
		$query = $this->db->get($table_name);
		return $query->row_array();	
		
		
	}
	
	
	function get_topic_category_detail_by_category_id($category_id,$table_name)
	{		
		$this->db->where("category_id",$category_id);
		$query = $this->db->get($table_name);
		return $query->row_array();	
		
		
	}
	
	
	
	function get_subcategory_topic_detail_by_subcategory_id($sub_category_id,$table_name)
	{		
		$this->db->where("sub_category_id",$sub_category_id);
		$query = $this->db->get($table_name);
		return $query->row_array();	
		
		
	}
	
	function get_category_topic_detail_by_category_id($category_id,$table_name)
	{		
		$this->db->where("category_id",$category_id);
		$query = $this->db->get($table_name);
		return $query->row_array();	
		
		
	}
	
	
	function get_latest_topic_for_detail_page($table_name,$user_id)
	{
		$this->db->order_by("topic_created_date_time","desc");
		$this->db->where("topic_creator_id !=",$user_id );
		$query = $this->db->get($table_name);
		//echo $this->db->last_query();
		return $query->result_array();	
			
	}
	
	
	function get_review_detail_for_category($table_name,$category_id)
	{
		$this->db->order_by("review_created_date_time","desc");
		$this->db->where("topic_id",$category_id );
		$query = $this->db->get($table_name);
		//echo $this->db->last_query();
		return $query->result_array();	
		
	}
	
	
	function get_sub_category_of_topic($table_name,$sub_category_id,$user_id="")
	{
		$this->db->where("creator_id !=",$user_id);
		$this->db->order_by("review_average","desc");		
		$this->db->order_by("sub_category_created_date_time","desc");
		$this->db->where("sub_category_id !=",$sub_category_id );
		$query = $this->db->get($table_name);
		//echo $this->db->last_query();
		return $query->result_array();	
		
	}
	
	
	
	function get_scroller_topic($user_id,$table_name)
	{
		$this->db->order_by("topic_created_date_time","desc");
		$this->db->where("topic_creator_id !=",$user_id );
		$query = $this->db->get($table_name);
		//echo $this->db->last_query();
		return $query->result_array();	
			
	}
	
	
	function get_total_review($topic_id)
	{
		$rate = 0 ;
		$ci=& get_instance();
		$ci->db->where("topic_id",$topic_id);
		$query = $ci->db->get("tbl_review");
		$row = $query->result_array();
		if(!empty($row))
		{
			
			foreach($row as $detail)
			{
				//$rate += $detail['rate'];
				$rate += 1;
			}
			
		}
		//pr($row );
		return $rate;
		
	}
	
	
	function get_total_review_by_user_id($user_id)
	{
		$rate = 0 ;
		$ci=& get_instance();
		//$ci->db->where("creator_id",$user_id);
		$query = $ci->db->query(" select * from tbl_review as TR , tbl_topic as TT where TR.topic_id = TT. 	topic_id and TT.topic_creator_id = $user_id ");
		
		$row = $query->result_array();
		if(!empty($row))
		{
			
			foreach($row as $detail)
			{
				//$rate += $detail['rate'];
				$rate += 1;
			}
			
		}
		//pr($row );
		return $rate;
		
	}
	
	
	
	
	// change the concept for the topic 
	// topic will be category or sub category 
	
	// this method is used for the get latest topic means category or sub category detail
	function get_latest_topic_of_sub_category($table_name,$offset=0,$user_id)
	{				
		
		$this->db->where("creator_id !=",$user_id);
	    //$this->db->where("topic_created_by",TOPIC_CREATED_BY_USER);
		$this->db->order_by("review_average","desc");
		$this->db->order_by("sub_category_created_date_time","desc");
		$query = $this->db->get($table_name,DASHBOARD_PAGE_USER_VIEW,$offset);		
		//echo $this->db->last_query();
		return $query->result_array();
		
	}
	
	
	// this method is used for the get latest topic means category 
	function get_latest_topic_of_category($table_name,$offset=0,$user_id)
	{		
		
		$this->db->where("creator_id !=",$user_id);
	    //$this->db->where("topic_created_by",TOPIC_CREATED_BY_USER);		
		$this->db->order_by("category_created_date_time","desc");
		$this->db->where("created_by","2");
		$query = $this->db->get($table_name,DASHBOARD_PAGE_USER_VIEW,$offset);		
		//echo $this->db->last_query();
		return $query->result_array();
		
	}
	
	function get_favorite_sub_category_topic($table_name,$offset=0,$category_id)
	{				
		
		//$this->db->where("topic_creator_id !=",$user_id);
	    $this->db->where("category_id",$category_id);		
		$this->db->order_by("sub_category_created_date_time","desc");
		$query = $this->db->get($table_name,CATEGORY_PAGE_USER_VIEW,$offset);		
		//echo $this->db->last_query();
		return $query->result_array();
		
	}
	
	
	function check_crate_review_or_not($user_id,$topic_id,$category_or_subcategory)
	{
		 $this->db->where("topic_id",$topic_id);
		 $this->db->where("category_or_subcategory",$category_or_subcategory);
		 $this->db->where("creator_id",$user_id);
		 $query = $this->db->get("tbl_review");			 
		 return $query->row_array();
	}
	
	// this method is used for the count total category or sub category record 
	function count_latest_topic_of_sub_category($table_name,$user_id)
	{
		$this->db->where("creator_id !=",$user_id);
		//$this->db->where("topic_created_by",TOPIC_CREATED_BY_USER);		
		
		//sub_category_id
		//$this->db->where("sub_category_created_date_time",$user_id);
		$query = $this->db->get($table_name);
		return $query->num_rows();
		
	}
	
	
	// this method is used for the count total category or sub category record 
	function count_favote_sub_category_data($table_name,$category_id)
	{
		//$this->db->where("topic_creator_id !=",$user_id);
		//$this->db->where("topic_created_by",TOPIC_CREATED_BY_USER);		
		
		//sub_category_id
		$this->db->where("category_id",$category_id);
		$query = $this->db->get($table_name);
		return $query->num_rows();
		
	}
	
	
	function get_scroller_topic_sub_category($table_name)
	{
		$this->db->order_by("sub_category_created_date_time","desc");
		$this->db->where("sub_category_id !=",$this->uri->segment(3));
		$query = $this->db->get($table_name);
		//echo $this->db->last_query();
		return $query->result_array();	
			
	}
	
	
	
}

/* End of file topic_model.php */
/* Location: ./application/models/topic_model.php */