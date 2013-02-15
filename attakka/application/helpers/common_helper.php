<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// this method is used for the debuging array output
function pr($data)
{
	print_r("<pre>");
	print_r($data);
	
}


// this method is used for the debug variable value
function e($data)
{
	echo $data;
	
}

// this method is used for the get ip address
function ip_address()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// this method is used for the check user login or not
function set_session_data($data)
{
	$ci=& get_instance();	
	$ci->session->set_userdata($data);	
	return 1;
	//pr($user_data);
}


// this method is used for the check user login or not
function get_session_data()
{
	$user_data = array();
	$ci=& get_instance();	
	$user_data = $ci->session->all_userdata();
	return $user_data;
	//pr($user_data);
}


// this method is used for the get category name
function get_category_name($category_id)
{
	$category_name = "";
	$ci=& get_instance();
	$ci->db->where("category_id",$category_id);
	$query = $ci->db->get("tbl_category");
	$row = $query->row_array();
	if(!empty($row))
	{
		$category_name = $row['category_name'];
	}
	//pr($row );
	return $category_name;
}


// this method is used for the get review rate 
function get_topic_rate($topic_id,$category_or_subcategory=1)
{
	$avg = 0;
	$ci=& get_instance();
	$ci->db->where("topic_id",$topic_id);
	$ci->db->where("category_or_subcategory",$category_or_subcategory);	
	$query = $ci->db->get("tbl_review");
	$row = $query->result_array();
	if(!empty($row))	
	{
		$number_of_user = 0;
		$rate = 0;
		foreach($row as $detail)
		{
			//$rate += $detail['rate'];
			$rate += $detail['rate'];
			$number_of_user +=1;
			
		}
		//echo $ci->db->last_query();
		 $avg = $rate/$number_of_user;
		
		
	}
	//pr($row );
	return floor($avg);
}



// this method is used for the get review rate 
function get_topic_rate_without_floor_function($topic_id,$category_or_subcategory=1)
{
	$avg = 0;
	$ci=& get_instance();
	$ci->db->where("topic_id",$topic_id);
	$ci->db->where("category_or_subcategory",$category_or_subcategory);	
	$query = $ci->db->get("tbl_review");
	$row = $query->result_array();
	if(!empty($row))	
	{
		$number_of_user = 0;
		$rate = 0;
		foreach($row as $detail)
		{
			//$rate += $detail['rate'];
			$rate += $detail['rate'];
			$number_of_user +=1;
			
		}
		//echo $ci->db->last_query();
		 $avg = $rate/$number_of_user;
		
		
	}
	//pr($row );
	return $avg;
}

// this method is used for the get sub category name
function get_sub_category_name($sub_category_id)
{
	$sub_category_name = "";
	$ci=& get_instance();
	$ci->db->where("sub_category_id",$sub_category_id);
	$query = $ci->db->get("tbl_sub_category");
	$row = $query->row_array();
	if(!empty($row))
	{
		$sub_category_name = $row['sub_category_name'];
	}
	//pr($row );
	return $sub_category_name;
}


// this method is used for the show error message.
if(!function_exists("display_error"))
{
	function display_error($message,$label)
	{
	?>
		<div class="msg msg-error">
		<span class="error">
			<?php echo($label);?>
		</span>
        <p><strong><?php echo($message);?></strong></p>			
		</div>
		<!-- End Message Error -->
		<br />				
			
	<?php 
		}
}   
 
 
// this method is used for the check admin login or not
function validation_login()
	{ 
	 	$session_data = get_session_data();
		if(!isset($session_data['admin_loged_in']))
		{
			redirect("admin");
		}
		
	}
	 
	// this method is used for the check user login or not
function validation_login_user()
	{
		$session_data = get_session_data();
		if(!isset($session_data['user_loged_in']))
		{
			redirect("user");
		}
		
	}


// this methos is used for the generate unique id 
 
function uniq_id()
{  
		//set the random id length 
		$random_id_length = rand(6,6); 
		//generate a random id encrypt it and store it in $rnd_id 
		$rnd_id = crypt(uniqid(rand(),1)); 
		
		//to remove any slashes that might have come 
		$rnd_id = strip_tags(stripslashes($rnd_id)); 
		
		//Removing any . or / and reversing the string 
		$rnd_id = str_replace(".","",$rnd_id); 
		$rnd_id = strrev(str_replace("/","",$rnd_id)); 
		
		//finally I take the first 10 characters from the $rnd_id 
		$submission_id = substr($rnd_id,0,$random_id_length); 		
		return $submission_id;
}
 	 

function find_image_name_review($review_rate)
{ 
	 
	switch($review_rate)
	{
		case -5:
		return "rate-5.png";
		break;		
		
		case -4:
		return "rate-4.png";
		break;
		
		case -3:
		return "rate-3.png";
		break;
		
		case -2:
		return "rate-2.png";
		break;
		
		case -1:
		return "rate-1.png";
		break;
		
		case 1:
		return "rate-1plus.png";
		break;
		
		case 2:
		return "rate-2plus.png";
		break;
		
		case 3:
		return "rate-3plus.png";
		break;
		
		
		case 4:
		return "rate-4plus.png";
		break;
		
		
		case 5:
		return "rate-5plus.png";
		break;
		
		case 0:
		return "rate-review0.png";
		break;
		
	}
	
}


function find_small_image_name_review($review_rate)
{ 
	 
	switch($review_rate)
	{
		case -5:
		return "smallrate-5.png";
		break;		
		
		case -4:
		return "smallrate-4.png";
		break;
		
		case -3:
		return "smallrate-3.png";
		break;
		
		case -2:
		return "smallrate-2.png";
		break;
		
		case -1:
		return "rate-1.png";
		break;
		
		case 1:
		return "rate-1plus.png";
		break;
		
		case 2:
		return "rate2-new.png";
		break;
		
		case 3:
		return "smallrate-3plus.png";
		break;
		
		
		case 4:
		return "smallrate-4plus.png";
		break;
		
		
		case 5:
		return "smallrate-5plus.png";
		break;
		
		case 0:
		return "rate-0.png";
		break;
		
	}
	
}


// this method is used for the get sub category name
function get_user_detail_by_user_id($user_id)
{
	$user_detail = array();
	$ci=& get_instance();
	$ci->db->where("user_id",$user_id);
	$query = $ci->db->get("tbl_user");
	$row = $query->row_array();
	if(!empty($row))
	{
		$user_detail = $row;
	}
	//pr($row );
	return $user_detail;
}


function update_category_review($category_id,$data)
{
	$ci=& get_instance();
	$ci->db->where('category_id',$category_id);	
	$ci->db->update('tbl_category',$data);
}

function update_sub_category_review($sub_category_id,$data)
{
	$ci=& get_instance();
	$ci->db->where('sub_category_id',$sub_category_id);	
	$ci->db->update('tbl_sub_category',$data);
}



 

/* End of file common_helper.php */
/* Location: ./application/helpers/common_helper.php */