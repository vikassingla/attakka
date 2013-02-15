<?php if  ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller 
{ 
	 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');	
		$this->load->helper('common');	
		$this->load->library('session');
		$this->load->model("user_model");	
		$this->load->model('category_model');
		$this->load->model('sub_category_model');
		$this->load->model('review_model');
		$this->load->model('topic_model');
		$this->load->model('comment_model');
	}
	
	// this method is used for the login user
	public function index()
	{		
	    $data = array();		
		// this code is used for the login fb start from here
	
	if($this->uri->segment(3)==1)
	{
		redirect('user/log_out');	
	}
		
		
	include_once(APPPATH.'libraries/facebook.php');			
	$facebook = new Facebook(array(
	  'appId'  => APPID,
	  'secret' => SECRET,
	));		
// Get User ID
 $user = $facebook->getUser();
 
 //echo $user;die;

$data['user'] = $user;
// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

//pr($user);


if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

//echo $user;


// Login or logout url will be needed depending on current user state.
if ($user) {
	
	//echo "login success";
	$id = $user;			
	$user_db_detail = $this->user_model->check_user_exits_or_not($id , "tbl_user" );
	if(empty($user_db_detail))
	{
		
		
		$newPass = uniq_id(); 
	
		
		$addDate=date("Y-m-d H:i:s");
		$post = array(					  
					  'user_id'=>$user_profile['id'],
					  'user_password' 	=> md5($newPass),
					  'user_first_name'=>$user_profile['first_name'],
					  'user_last_name'=>$user_profile['last_name'],
					  'user_email' => $user_profile['email'],					  
					  'user_status'=>'1',
					  'user_created_date_time'	=>$addDate
					  );		
		$this->user_model->add_user_detail($post,"tbl_user");	
		$user_db_detail = $this->user_model->check_user_exits_or_not($id , "tbl_user" );
		$this->send_thanks_email_for_fb_login($user_db_detail,$newPass );
		
		//echo $newPass;
		//die;
		
	}
				
		
	$logout_url = LOGOUT_URL ;	
	
	$params_for_logout = array( 'next' => $logout_url );	
	$data['logoutUrl'] =   $facebook->getLogoutUrl($params_for_logout);	 
	$logout =  $data['logoutUrl']; 	

	 
	// FB_logout
	// user_loged_in 	
	$user_db_detail['FB_logout'] = $logout;
	$user_db_detail['user_loged_in'] = 1;	 
    $this->session->set_userdata($user_db_detail);
	
	//ob_start();
	redirect('user/dashboard');
	
	
	
	// echo "<a href='$logout'>Logout</a>";
	
	
	$params = array(
  'scope' => 'email',
  'redirect_uri' => REDIRECT_URL
);
	
 $data['loginUrl'] =  $facebook->getLoginUrl($params);
 
 
	 
	 
} else {



$params = array(
  'scope' => 'email',
  'redirect_uri' => REDIRECT_URL
);
	
  $data['loginUrl'] =  $facebook->getLoginUrl($params);
	//echo '<a href='.$data['loginUrl'].' >Login</a>';
}	
		
		
// this code end the fb login here		
				
		
		
		$session_data = get_session_data();
		if(isset($session_data['user_loged_in']))
		{
			redirect("user/dashboard");
		}
		
		$error = "";
		$err = array();
		$message = "";
		
		$post = $this->input->post();
		
		if($this->input->post("operation")!="")
		{
			
			if($post['user_password']=="")
			{
				//$error .= "Please enter first name !<br/>";	
				$err['user_password'] = "Please enter password !<br/>";	
			}
			
			if($post['user_email']=="")
			{
				//$error .= "Please enter first name !<br/>";	
				$err['user_email'] = "Please enter email id!<br/>";	
			}else{
		  
		  		if(!filter_var($this->input->post('user_email'), FILTER_VALIDATE_EMAIL)){
							$err['user_email']  = "Please enter valid  email!<br />";
				}
		  }
			
			
			if(empty($err))
			{
				
			$user_deatil = 	$this->user_model->check_user_login($post['user_email'],$post['user_password'],"tbl_user");
			
			//pr($user_deatil);
			
			if(!empty($user_deatil))
			{		
				if($user_deatil['user_status']==1)
				{
					$user_deatil["user_loged_in"] = "1";				
					unset($user_deatil["user_password"]); 
					$user_deatil["FB_logout"] = "";
					
					
					set_session_data($user_deatil);
					redirect("user/dashboard");	
				}else{
					
				$error .= "Sorry, your account is disabled. Please, contact us for more information.";		
				}
				
			}else{
				$error .= "Incorrect email or password !<br/>";		
			}
			
			
			
			}
			
			
				
		}
		
		
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
		
	
		
		
		$data['title'] = 'ATTAKKA - Login';
		$this->load->view('front_template/front_header',$data);
		$this->load->view('front_template/header_navigation');
		$this->load->view('front_page/login',$data);
		$this->load->view('front_template/front_footer2',$data);
	}
	
	// this method is used for the registration user
	function registration()
	{
		$data = array();
		$error = "";
		$err = array();
		$message = "";
		
		$post = $this->input->post();
		
	
		
		if($this->input->post("operation")!="")
		{
			
				
			if($post['user_first_name']=="")
			{
				//$error .= "Please enter first name !<br/>";	
				$err['user_first_name'] = "Please enter first name !<br/>";	
			}
			
			if($post['user_last_name']=="")
			{
				//$error .= "Please enter first name !<br/>";	
				$err['user_last_name'] = "Please enter last name !<br/>";	
			}
			
			
			if($post['user_password']=="")
			{
				//$error .= "Please enter first name !<br/>";	
				$err['user_password'] = "Please enter password !<br/>";	
			}
			
			if($post['user_email']=="")
			{
				//$error .= "Please enter first name !<br/>";	
				$err['user_email'] = "Please enter email id!<br/>";	
			}else{
		  
		  		if(!filter_var($this->input->post('user_email'), FILTER_VALIDATE_EMAIL)){
							$err['user_email']  = "Please enter valid  email!<br />";
				}else{
				
				$check_email = $this->user_model->check_email_already_exits_or_not($this->input->post('user_email'),"tbl_user");
				
				if(!empty($check_email))
				{
					$err['user_email']  = "Email ID already register !<br />";
				}				
				
				
				
				
				}
		  }
			
			if($post['user_country']=="")
			{
				//$error .= "Please enter first name !<br/>";	
				$err['user_country'] = "Please enter country !<br/>";	
			}
			
			
			if($post['user_region']=="")
			{
				//$error .= "Please enter first name !<br/>";	
				$err['user_region'] = "Please enter region !<br/>";	
			}
			
			if(!isset($post['agree']))
			{
				//$error .= "Please enter first name !<br/>";	
				$err['agree'] = "Please accept the terms and condition !<br/>";	
			}
			
			
			if(empty($err))
			{
				
				$unique_id = uniq_id();	
				$post['unique_id'] = $unique_id;
				$this->user_model->add_user($post,"tbl_user");	
				
				$this->send_account_activation_email($post,$unique_id );
				$_POST = "";
				
				$this->send_email_to_admin_for_user_registration_detail($post,$unique_id );
				
				$message = "Thanks for the registraion. Please check your email for the activation account. !<br/>";
				
			
			}
			
			
				
		}
		
		
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
		$data['title'] = 'ATTAKKA - Registration';
		$this->load->view('front_template/front_header',$data);
		$this->load->view('front_template/header_navigation');
		$this->load->view('front_page/registration',$data);
		$this->load->view('front_template/front_footer2',$data);	
	}
	
	
	
	function send_thanks_email_for_fb_login($post,$password )
	{		
		$this->load->library('email');
		$config['mailtype']='html';
		$this->email->initialize($config);
		$this->email->from(ADMIN_FROM_EMAIL_ID, ADMIN_FROM_NAME);
		$this->email->to($post['user_email']);         
		$this->email->subject('Thanks for the registration');				
		$message = 'Hello '.$post['user_first_name'].' '.$post['user_last_name'].',<br /> <br /> Thanks for the registration. Your login detail is  <br/> Email:&nbsp;&nbsp;&nbsp;'.$post['user_email'].'<br/> Password:&nbsp;&nbsp;&nbsp;'.$password.'<br /><br />Regards,<br />Site Manager<br/>'.SITE_URL;
		$this->email->message($message);
		@$this->email->send();	
	}
	
	
	
	function send_account_activation_email($post,$reset_id )
	{		
		$this->load->library('email');
		$config['mailtype']='html';
		$this->email->initialize($config);
		$this->email->from(ADMIN_FROM_EMAIL_ID, ADMIN_FROM_NAME);
		$this->email->to($post['user_email']);         
		$this->email->subject('Account Activation');
		$verfication_link = base_url()."user/account_activation/".$reset_id;		
		$verfication_link = anchor($verfication_link);		
		$message = 'Hello '.$post['user_first_name'].' '.$post['user_last_name'].',<br /> <br /> Kindly click on the following link for the account activation. <br/>'.$verfication_link.'<br /><br />Regards,<br />Site Manager<br/>'.SITE_URL;
		$this->email->message($message);
		@$this->email->send();	
	}
	
	function send_email_to_admin_for_user_registration_detail($post,$reset_id )
	{		
		$this->load->library('email');
		$config['mailtype']='html';
		$this->email->initialize($config);
		$this->email->from(ADMIN_FROM_EMAIL_ID, ADMIN_FROM_NAME);
		$this->email->to(ADMIN_EMAIL_ID); 
		$this->email->bcc(SANJAY_EMAIL_ID); 
		$this->email->subject('User Registration Detail');
	
		$user_detail_str =  'First name : '.$post['user_first_name'].'<br/>'.
							'Last name : '.$post['user_last_name'].'<br/>'.
							'Email ID : '.$post['user_email'].'<br/>'.
							'Country : '.$post['user_country'].'<br/>'.
							'Region : '.$post['user_region'].'<br/>'								
							;
		
		
		$message = 'Dear Admin , <br/><br/> some one submit the registration form. detail are following<br/><br/>'.$user_detail_str.'<br /><br />Regards,<br />Site Manager<br/>'.SITE_URL;
		$this->email->message($message);
		@$this->email->send();	
	}
	
	
	function account_activation()
	{
		$data = array();
		
		$unique_id = $this->uri->segment(3);
		$message = "";
		if($unique_id=="")
		{
			redirect("");
		}else{
			
			$user_data = $this->user_model->get_user_detail("tbl_user",$unique_id);
			$update_data['user_status'] = 1;
			$update_data['unique_id'] = "";
			
			$this->user_model->update_user_detail("tbl_user",$unique_id,$update_data);
			
			if(!empty($user_data))
			{
				 $message = "Account activation successfully !<br/>";	
			}else{
				 $message = "Activation link expire!<br/>";		
			}
			
		}
			
      
		$data['title'] = 'ATTAKKA - Account activation';
		$data['message'] = $message;
		$this->load->view('front_template/front_header',$data);
		$this->load->view('front_template/header_navigation');
		$this->load->view('front_template/header_search');
		$this->load->view('front_page/activation_user_account');
		$this->load->view('front_template/front_footer');
	
		
	}
	
	function dashboard()
	{
	    $data = array();
		validation_login_user();
		$message = "";		
		$data['title'] = 'ATTAKKA - User Dashboard';
		$data['message'] = $message;		
			
		$session_data = get_session_data();
		$user_id = $session_data['user_id'];	
		$data['session_data']= $session_data;
		
		$data['user_list'] = $this->user_model->get_user_list($user_id,"tbl_user");
		$data['category_list'] = $this->user_model->get_category_list($user_id,"tbl_category");
		$data['sub_category_list'] = $this->user_model->get_sub_category_list($user_id,"tbl_sub_category");
		
		//pr($data['user_list']);
			
		// show the topic on the home page start	
			$table_name = "tbl_sub_category";
			$offset = $this->uri->segment(3);
			if(!$offset)
				$offset=0;
			$data['site_data'] = $this->topic_model->get_latest_topic_of_sub_category($table_name,$offset,$user_id);		
			
			
			$data['site_data_category'] = $this->topic_model->get_latest_topic_of_category("tbl_category",$offset,$user_id);	
			
			
			//echo $this->db->last_query();
			
			$data['offset'] = $offset;
			$this->load->library('pagination');
			$config['base_url'] = base_url().'user/dashboard/';
			$config['total_rows'] = $this->topic_model->count_latest_topic_of_sub_category($table_name,$user_id);
			$config['per_page'] = DASHBOARD_PAGE_USER_VIEW;
			$this->pagination->initialize($config);
			$data['site_data_pagination'] = $this->pagination->create_links();	
		// show the topic on the home page end	
		$data['total_review'] = $this->topic_model->get_total_review_by_user_id($user_id);
		$this->load->view('front_template/header_after_login',$data);
		//$this->load->view('front_template/header_navigation');
		//$this->load->view('front_template/header_search');
		$this->load->view('front_page/user_dashboard');
		$this->load->view('front_template/footer_after_login');		
	}


	function favorite()
	{
	    $data = array();
		validation_login_user();
		$message = "";		
		$data['title'] = 'ATTAKKA - User Favorite Category';
		$data['message'] = $message;		
			
		$session_data = get_session_data();
		$user_id = $session_data['user_id'];	
		$data['session_data']= $session_data;
		$category_id = $this->uri->segment(3);
			
		// show the topic on the home page start	
			$table_name = "tbl_sub_category";
			$offset = $this->uri->segment(4);
			if(!$offset)
				$offset=0;
			$data['site_data'] = $this->topic_model->get_favorite_sub_category_topic($table_name,$offset,$category_id);		
			$data['offset'] = $offset;
			$this->load->library('pagination');
			$config['base_url'] = base_url().'user/favorite/'.$category_id.'/';
			$config['total_rows'] = $this->topic_model->count_favote_sub_category_data($table_name,$category_id);
			$config['uri_segment'] = 4;
			
			$config['per_page'] = CATEGORY_PAGE_USER_VIEW;
			$this->pagination->initialize($config);
			$data['site_data_pagination'] = $this->pagination->create_links();	
		// show the topic on the home page end	
		$data['total_review'] = $this->topic_model->get_total_review_by_user_id($user_id);
		$this->load->view('front_template/header_after_login',$data);
		if($category_id==1)
		{
			$this->load->view('front_page/movie_favorite');
		} 
		if($category_id==2)
		{
			$this->load->view('front_page/general_favorite');
		}
		if($category_id==3)
		{
			$this->load->view('front_page/infowall_favorite');
		}
		
		
		$this->load->view('front_template/footer_after_login');		
	}




	function topicdetail()
	{
		
		$error = "";
		$err = array();
		
		$message = "";
		validation_login_user();
	    $session_data = get_session_data();
		$user_id = $session_data['user_id'];
		
		
		$sub_category_id = $this->uri->segment(3); // this may be sub category id or category id
		
		$data['review_on_category'] = $this->topic_model->get_sub_category_of_topic("tbl_sub_category",$sub_category_id,$user_id);
					
		if($this->uri->segment(4)=='s')
		{
		
		$sub_category_id = $this->uri->segment(3);
		$data['topic_data'] = $this->topic_model->get_subcategory_topic_detail_by_subcategory_id($sub_category_id,"tbl_sub_category");	
		
		}
		
		if($this->uri->segment(4)=='m')
		{
		
		$category_id = $this->uri->segment(3);		
		$data['topic_data'] = $this->topic_model->get_category_topic_detail_by_category_id($category_id,"tbl_category");
		
		}
		
		
		
		//pr($data['review_on_category']  );
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
		$data['title'] = 'ATTAKKA - Topic Detail ';		
		$this->load->view('front_template/header_after_login',$data);		
		$this->load->view('front_page/user_topic_detail');
		$this->load->view('front_template/footer_after_login');	
	}

	// admin log out
	function log_out()
	{
		
		validation_login_user();
		
		$session_data = get_session_data();
		if(isset($session_data['user_loged_in']))
		{
			$this->session->unset_userdata('user_loged_in');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('user_first_name');
			$this->session->unset_userdata('user_last_name');			
			$this->session->unset_userdata('user_genter');
			$this->session->unset_userdata('user_country');
			$this->session->unset_userdata('user_region');
			$this->session->unset_userdata('user_mobile_no');
			$this->session->unset_userdata('user_status');
			$this->session->unset_userdata('unique_id');
			$this->session->unset_userdata('user_created_date_time');	
			session_start();
		    session_destroy();
			redirect("user");
		}
		
	}
	
	function edit_profile()
	{
		$data = array();
		validation_login_user();
		
		$error = "";
		$err = array();
		$message = "";	
		
		
		
		$session_data = get_session_data();
		$user_id = $session_data['user_id'];
		$data['user_data'] = $this->user_model->get_user_detail_by_user_id($user_id,"tbl_user");
		
	//pr($data['user_data']);
	
		
		$post = $this->input->post();
		
	
		
		if($this->input->post("operation")!="")
		{
			
				
			if($post['user_first_name']=="")
			{
				//$error .= "Please enter first name !<br/>";	
				$err['user_first_name'] = "Please enter first name !<br/>";	
			}
			
			if($post['user_last_name']=="")
			{
				//$error .= "Please enter first name !<br/>";	
				$err['user_last_name'] = "Please enter last name !<br/>";	
			}
			
			
			if($post['user_password']=="")
			{
				$password = $data['user_data']['user_password'];
			}else{
				$password = md5($this->input->post('user_password'));	
			}
			
			if($post['user_email']=="")
			{
				//$error .= "Please enter first name !<br/>";	
				$err['user_email'] = "Please enter email id!<br/>";	
			}else{
		  
		  		if(!filter_var($this->input->post('user_email'), FILTER_VALIDATE_EMAIL)){
							$err['user_email']  = "Please enter valid  email!<br />";
				}
		  }
			
			if($post['user_country']=="")
			{
				//$error .= "Please enter first name !<br/>";	
				$err['user_country'] = "Please enter country !<br/>";	
			}
			
			
			if($post['user_region']=="")
			{
				//$error .= "Please enter first name !<br/>";
				
				$err['user_region'] = "Please enter region !<br/>";	
			}
			
			
			if($_FILES['user_image_name']['name']!="")
			{
				$file_name = time()."-".$_FILES['user_image_name']['name'];
				$post['user_image_name'] = $file_name;
				$config['file_name'] = $file_name;
				$config['upload_path'] = './user_profile_image/';
				$config['allowed_types'] = 'gif|jpg|png';
				//$config['max_size']	= '100';
				//$config['max_width']  = '87';
				//$config['max_height']  = '84';
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('user_image_name'))
				{
					$upload_error =  $this->upload->display_errors();
					$err['user_image_name'] = $upload_error;
					//pr($upload_error);
					//pr($_FILES);
					//die;
					
				}
			
			}
			
			
			
			
			
			if(empty($err))
			{
				
				unset($post['user_passwrod']);
				unset($post['operation']);
				unset($post['Submit']);
				
				
				$post['user_password'] = $password;
				
				
				//pr($post);
				
				
				
				$this->user_model->update_user_detail_by_user_id($user_id,"tbl_user",$post);				
				//$_POST = "";		
				$session_data = get_session_data();
		        $user_id = $session_data['user_id'];
				if(isset($session_data['FB_logout']))
				{
					$user_deatil["FB_logout"] = $session_data['FB_logout']	;
				}
				
				
				$data['user_data'] = $this->user_model->get_user_detail_by_user_id($user_id,"tbl_user");
				$user_deatil = $data['user_data'];
				$user_deatil["user_loged_in"] = "1";				
				unset($user_deatil["user_password"]); 
				
				set_session_data($user_deatil);
				
				$message = "Profile Detail Update Successfully!<br/>";
				$this->session->set_flashdata('add', 'Profile Detail Update Successfully!<br/>'); 
				redirect("user/edit_profile/1");
				
			
			}
			
			
				
		}
		
		
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;		
		$data['title'] = 'ATTAKKA - Edit User Profile Detail';		
		$this->load->view('front_template/header_after_login',$data);		
		$this->load->view('front_page/edit_user_profile');
		$this->load->view('front_template/footer_after_login');	
		
			
	}
	
	// this method is used for send email for the set password
	function forget_password()
	{	
		$error = "";
		$err = array();
		$message = "";
		
		$post = $this->input->post();
		
		if($this->input->post("operation")!="")
		{
			
			if($post['user_email']=="")
			{
				//$error .= "Please enter first name !<br/>";	
				$err['user_email'] = "Please enter email id!<br/>";	
			}else{
		  
		  		if(!filter_var($this->input->post('user_email'), FILTER_VALIDATE_EMAIL)){
							$err['user_email']  = "Please enter valid  email!<br />";
				}
		  }
			
			
			if(empty($err))
			{
				
			$user_deatil = 	$this->user_model->check_user_exits_or_not_by_email($post['user_email'],"tbl_user");
			
			//pr($user_deatil);
			if(!empty($user_deatil))
			{								
				$post = $user_deatil;
				$unique_id_forget_password = uniq_id();	
				$post['unique_id_forget_password'] = $unique_id_forget_password;
				$user_id = $user_deatil["user_id"];
				$update_data = array("unique_id_forget_password"=>$unique_id_forget_password);
				$this->user_model->update_user_detail_by_user_id($user_id,"tbl_user",$update_data);
				
				$this->send_forget_password_link($post,$unique_id_forget_password );
				$message = "Please check your email for the reset password !";
				
				//redirect("user");	
			}else{
				$error .= "This email id not register with us. !<br/>";		
			}
			
			
			
			}
			
			
				
		}
		
		
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
				
		$data['title'] = 'ATTAKKA - Forget Password';
		$this->load->view('front_template/front_header',$data);
		$this->load->view('front_template/header_navigation');
		$this->load->view('front_page/forget_password_user',$data);
		$this->load->view('front_template/front_footer2',$data);
		
	}
	
	function send_forget_password_link($post,$reset_id )
	{		
		$this->load->library('email');
		$config['mailtype']='html';
		$this->email->initialize($config);
		$this->email->from(ADMIN_FROM_EMAIL_ID, ADMIN_FROM_NAME);
		$this->email->to($post['user_email']);         
		$this->email->subject('Forget Password');
		$verfication_link = base_url()."user/reset_password/".$reset_id;		
		$verfication_link = anchor($verfication_link);		
		$message = 'Hello '.$post['user_first_name'].' '.$post['user_last_name'].',<br /> <br /> Kindly click on the following link for the reset password. <br/>'.$verfication_link.'<br /><br />Regards,<br />Site Manager<br/>'.SITE_URL;
		$this->email->message($message);
		@$this->email->send();	
	}
	
	
	// this method is used for send email for the set password
	function reset_password()
	{	
		$error = "";
		$err = array();
		$message = "";
		
		$reset_id = $this->uri->segment(3);
		
		if($reset_id=="")
		{
			redirect("user");	
		}
		
		$data['user_data'] = $this->user_model->get_user_detail_by_reset_id($reset_id,"tbl_user");
		
		
		//pr(	$data['user_data'] ) ;
		if(empty($data['user_data']))
		{
			$error .="Password reset link expire !";	
		}
		
		
		$post = $this->input->post();
		
		if($this->input->post("operation")!="")
		{
			
			if($post['user_password']=="")
			{
				//$error .= "Please enter first name !<br/>";	
				$err['user_password'] = "Please enter password !<br/>";	
			}
			
			
			if($post['confirm_user_password']=="")
			{
				//$error .= "Please enter first name !<br/>";	
				$err['confirm_user_password'] = "Please enter confirm password !<br/>";	
			}else{
				if($post['user_password']!=$post['confirm_user_password'])
				{
					$err['confirm_user_password'] = "Confirm password not match !<br/>";	
				}
					
			}
			
			
			
			
			
			if(empty($err))
			{
				
			$user_deatil = $data['user_data'];
			//pr($user_deatil);
			if(!empty($user_deatil))
			{	
				$user_id = $user_deatil["user_id"];
				$password = $post['user_password'];
				$update_data = array("unique_id_forget_password"=>"","user_password"=>md5($password));
				$this->user_model->update_user_detail_by_user_id($user_id,"tbl_user",$update_data);
				
				$_POST = "";
				$message = "Password reset successfully!";
				
				//redirect("user");	
			}
			
			
			
			}
			
			
				
		}
		
		
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
				
		$data['title'] = 'ATTAKKA - Reset Password';
		$this->load->view('front_template/front_header',$data);
		$this->load->view('front_template/header_navigation');
		$this->load->view('front_page/reset_forget_password',$data);
		$this->load->view('front_template/front_footer2',$data);
		
	}
	
	
	function create_category()
	{
		
		$error = "";
		$err = array();
		
		$message = "";
		
		validation_login_user();
		
		
	
	    $session_data = get_session_data();
		$user_id = $session_data['user_id'];
		//pr($_POST);
		
		if($this->input->post('operation')!="")
		{
			
			if($this->input->post('category_name')=="")
			{
				//$error .="Please enter the category name !<br/>";
				$err['category_name'] = "Please enter the category name !";
			}else{
				
			
			$category_name = $this->input->post('category_name');
			
			
			$table_name = "tbl_category";
			$category_data = $this->category_model->check_user_category_name_already_exits_or_not($category_name,$table_name,$user_id,CATEGORY_CREATED_BY_USER);
			
			
			//pr($category_data); die;
			
			if(!empty($category_data))
			{
					//$error .="Category name already exits !<br/>";					
					$err['category_name'] ="Category allready exits created !<br/>";
			}
					
				
			}
			
			if($_FILES['category_image']['name']!="")
			{
				$file_name = time()."-".$_FILES['category_image']['name'];
				$category_data['category_image'] = $file_name;
				$config['file_name'] = $file_name;
				$config['upload_path'] = './upload_image/';
				$config['allowed_types'] = 'gif|jpg|png';
				//$config['max_size']	= '1000';
				//$config['max_width']  = '1024';
				//$config['max_height']  = '1024';
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('category_image'))
				{
					$upload_error =  $this->upload->display_errors();
					$err['category_image'] = $upload_error;
					//pr($upload_error);
					//pr($_FILES);
					//die;
					
				}
			
			}else{
				$err['category_image'] = "<br/>Please select category image"; 	
			}
			
			
			if($this->input->post('category_description')=="")
			{
				//$error .="Please enter the category name !<br/>";
				$err['category_description'] = "Please enter the category description!<br/>";
			}
			
		if($this->input->post('category_rules')=="")
			{
				//$error .="Please enter the category name !<br/>";
				$err['category_rules'] = "Please enter the category rules!";
			}
			
			
			if($this->input->post('category_name')=="")
			{
				//$error .="Please enter the category name !<br/>";
				$err['category_name'] = "Please enter the category name !";
			}
			
			
			if(empty($err))
			{
				//pr($_FILES);	
				//die;							
				$category_data['created_by'] = CATEGORY_CREATED_BY_USER; // user
				$category_data['creator_id'] = $user_id; // user				
				$category_data['category_name'] = $this->input->post("category_name");				
				$category_data['category_type'] = $this->input->post("category_type");
	            $category_data['review_default'] = $this->input->post("review_default");				
				$category_data['category_description'] = $this->input->post("category_description");
				$category_data['category_rules'] = $this->input->post("category_rules");
				$category_data['category_created_date_time'] = date("Y-m-d H:i:s");
				$category_id = $this->category_model->add_category($category_data , "tbl_category");				
				$this->upload_category_image($_FILES['category_image_name'],$category_id);
				$this->session->set_flashdata('add', 'Category create successfully !'); 	
				$_POST = "";
				$message = "Category create successfully !";
				
				redirect("user/category_list");
				
									
			}
				
		}
	
		
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
		$data['title'] = 'ATTAKKA - Create Main Category ';
		$this->load->view('front_template/front_header',$data);
		$this->load->view('front_template/header_navigation');
		$this->load->view('front_page/category_created_by_user',$data);
		$this->load->view('front_template/front_footer2',$data);
	}
	
	
	function create_sub_category()
	{
		
		$error = "";
		$err = array();
		
		$message = "";
		
		validation_login_user();
		
		$session_data = get_session_data();
		$user_id = $session_data['user_id'];
		
			
		$post = $this->input->post();
		$data["catgory_list"] =$this->sub_category_model->get_all_category_by_user_id("tbl_category",$user_id);

	  //pr($_POST);		
		if($this->input->post('operation')!="")
		{
			
			
			
			
			if($this->input->post('category_id')=="")
			{
				$error .="Please select the category name !<br/>";
				$err['category_id'] = "Please select the category name !<br/>";
			}
			
			
			
			if($this->input->post('sub_category_name')=="")
			{
				$error .="Please enter the sub category name !<br/>";
				$err['sub_category_name'] = "Please enter the sub category name !";
			}else{
				
			$category_name = $this->input->post('sub_category_name');
				
			$table_name = "tbl_sub_category";
			$sub_category_data = $this->sub_category_model->check_sub_category_name_already_exits_or_not($category_name,$table_name,$user_id);
		
		//$sub_category_name,$table_name,$category_id
			
			//pr($category_data); die;
			
			if(!empty($sub_category_data))
			{
					$error .="Category name already exits !<br/>";
					
					$err['sub_category_name'] ="Sub Category name already exits !<br/>";
			}
					
				
			}
			
			
			if($this->input->post('sub_category_description')=="")
			{
				$error .="Please enter the category name !<br/>";
				$err['sub_category_description'] = "Please enter the sub category description !";
			}
			
			
			if($this->input->post('sub_category_rules')=="")
			{
				$error .="Please enter the category name !<br/>";
				$err['sub_category_rules'] = "Please enter the sub category rules !";
			}
			
			
			if($_FILES['sub_category_image']['name']!="")
			{
				$file_name = time()."-".$_FILES['sub_category_image']['name'];
				$category_data['sub_category_image'] = $file_name;
				$config['file_name'] = $file_name;
				$config['upload_path'] = './upload_image/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '1000';
				$config['max_width']  = '1024';
				$config['max_height']  = '1024';
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('sub_category_image'))
				{
					$upload_error =  $this->upload->display_errors();
					$err['sub_category_image'] = $upload_error;
					//pr($upload_error);
					//pr($_FILES);
					//die;
					
				}
			
			}else{
				$err['sub_category_image'] =" Please select image ";	
			}
		
		
		if(empty($err))
		{
				
				$category_data['created_by'] = CATEGORY_CREATED_BY_USER;
				$category_data['creator_id'] = $user_id;
				$category_data['category_id'] = $this->input->post("category_id");
				$category_data['sub_category_name'] = $this->input->post("sub_category_name");
				$category_data['sub_category_description'] = $this->input->post("sub_category_description");
				$category_data['sub_category_rules'] = $this->input->post("sub_category_rules");
				$category_data['sub_category_rules'] = $this->input->post("sub_category_rules");
				$category_data['sub_category_type'] = $this->input->post("sub_category_type");				
				$category_data['apply_moderator'] = $this->input->post("apply_moderator");
				
				
				$category_data['sub_category_created_date_time'] = date("Y-m-d H:i:s");
				$category_id = $this->sub_category_model->add_category($category_data , "tbl_sub_category");				
				
				$this->upload_category_image($_FILES,$category_id);
				
				$this->session->set_flashdata('add', 'sub category add successfully!'); 
				$message = "sub category created successfully!";
				$_POST = "";
				redirect("user/sub_category_list");
				
									
			}
	
	}
	
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
		$data['title'] = 'ATTAKKA - Create Sub Category ';
		$this->load->view('front_template/front_header',$data);
		$this->load->view('front_template/header_navigation');
		$this->load->view('front_page/sub_category_created_by_user',$data);
		$this->load->view('front_template/front_footer2',$data);
	}
	
	
		
// this method is used for the upload image
function upload_category_image($category_image,$category_id)
{		
	
		
	if(isset($category_image['name']))
	{
		$size_of =  count($category_image['name']);	
	
		
		for( $i=0; $i<=$size_of; $i++ )
		{
			
			$category_image_name =  "";
			if(isset($category_image['name'][$i]))
			{
				$category_image_name =  $category_image['name'][$i];
			}
			if($category_image_name!="")
			{
				$extension_detail = pathinfo($category_image_name);
				//pr($extension_detail);die;
				$extension = $extension_detail['extension'];
				$file_name = $extension_detail['filename'];
				$new_file_name = time()."-".$file_name.".".$extension;
				$category_image_name_temp = $category_image['tmp_name'][$i];			
				
				if(move_uploaded_file($category_image_name_temp,"./upload_image/" . $new_file_name))
				{
					$image_data['category_id'] = $category_id;
					$image_data['category_image_name'] = $new_file_name;
					$image_data['category_image_created_date_time'] = date("Y-m-d H:i:s");			
					$this->category_model->add_category_image_detail($image_data,"tbl_category_image");					
				
				}
			}
			
		}
		
		
		
	}
		
	
}
	
	
	function create_review()
	{
		
		$error = "";
		$err = array();
		
		$message = "";
		
		validation_login_user();
		$session_data = get_session_data();
		$user_id = $session_data['user_id'];
		$topic_id = $this->uri->segment(3); // this topic id may be category id or sub category id
		
		
		
		
		
		if($this->uri->segment(3)=="" || $this->uri->segment(4)=="")
		{
			redirect("user/dashboard");
		}
		
		
		
		
		if($topic_id=="")
		{
			$message = "Please select correct topic for the create review on topic!";		
			$this->session->set_flashdata('add', 'lease select correct topic for the create review on topic'); 	
			redirect("user/dashboard");		
		}
		
		if($this->uri->segment(4)=='s')
		{
		$category_or_sub_category = 2;
		
		$data['topic_data'] = $this->topic_model->get_topic_sub_category_detail_by_sub_category_id($topic_id,"tbl_sub_category");
		
		$segment = 's';
		
		}
		
		if($this->uri->segment(4)=='m')
		{
			
		$category_or_sub_category = 1;
		$segment = 'm';
		
		$data['topic_data'] = $this->topic_model->get_topic_category_detail_by_category_id($topic_id,"tbl_category");
		
		}
	
	    $session_data = get_session_data();
		$user_id = $session_data['user_id'];
		//pr($_POST);
		
		
		
		
	//echo $this->db->last_query();
		
		
		
		
		
		
		if($this->input->post('operation')!="")
		{
			//pr($_POST);
			//die;
			
			
			$check_already_create_reivew_or_not = $this->topic_model->check_crate_review_or_not($user_id,$topic_id,$category_or_sub_category);
			
			if(!empty($check_already_create_reivew_or_not))
			{
				$err['error'] = 'You already create review on topic so please select other topic for review';	
			}
			
			
			
			if(!$this->input->post('review_rate'))
			{
				//$error .="Please enter the category name !<br/>";
				$err['review_rate'] = "Please select review rate !";
			}
			
			if($this->input->post('review_title')=="")
			{
				//$error .="Please enter the category name !<br/>";
				$err['review_title'] = "Please enter review title !";
			}		
			
			
			if($this->input->post('review_description')=="")
			{
				//$error .="Please enter the category name !<br/>";
				$err['review_description'] = "Please enter review description !";
			}		
			
			
			
			if(empty($err))
			{
				//pr($_FILES);	
				//die;							
				
				// 
				$review['category_or_subcategory'] = $category_or_sub_category; // user	
				$review['creator_id'] = $user_id; // user	
				$review['topic_id'] = $topic_id; // topic id				
				$review['rate'] = $this->input->post("review_rate");
				$review['review_title'] = $this->input->post("review_title");
	            $review['review_description'] = $this->input->post("review_description");								
				$review['review_created_date_time'] = date("Y-m-d H:i:s");
				$review['review_ip_address'] = ip_address();
				
				$data_review_insert = $review;				
				$review_id = $this->review_model->add_review_by_user($data_review_insert , "tbl_review");	
				
				
				
				
				if($category_or_sub_category==1)
				{// update review in category table
					$avg = get_topic_rate_without_floor_function($topic_id,$category_or_sub_category);
					$update_data = array('review_average'=>$avg);
					update_category_review($topic_id,$update_data);
				}
				
				if($category_or_sub_category==2)
				{// update review in sub category table
					$avg = get_topic_rate_without_floor_function($topic_id,$category_or_sub_category);
					$update_data = array('review_average'=>$avg);
					update_sub_category_review($topic_id,$update_data);
				}
				
				
				
				
				
				$this->session->set_flashdata('add', 'Review create successfully !'); 	
				redirect("user/topicdetail/".$topic_id.'/'.$segment);
				$_POST = "";
				$message = "Review create successfully !";
									
			}
				
		}
	
		
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
		$data['title'] = 'ATTAKKA - Create Review ';
	
		
		$this->load->view('front_template/header_after_login',$data);		
		$this->load->view('front_page/review_created_by_user');
		$this->load->view('front_template/footer_after_login');	
	}
	
	
	
	
	
	function review_scroller_inside()
	{
		
		$error = "";
		$err = array();
		
		$message = "";
		validation_login_user();
	    $session_data = get_session_data();
		$user_id = $session_data['user_id'];
		
		
		$data['topic_scroller_data'] = $this->topic_model->get_scroller_topic($user_id,"tbl_topic");
		
		//pr($data['topic_scroller_data']  );
		
		
		
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
		$data['title'] = 'ATTAKKA - Review Scroller';			
		$this->load->view('front_page/images-scroller-inside',$data);
	
	}
	
	
	
	
	
	// category_list_of_user
	
	// this method is used for the show list category 
	public function category_list()
	{
		// check user login or not
		validation_login_user();
	    $session_data = get_session_data();
		$user_id = $session_data['user_id'];
		
		$data = array();
		
		$data['user_id'] = $user_id;
		
				
		$data['title'] = "Category List";
		$error = "";
		$err = array();
		$message = "";
		$post = $this->input->post();
		
		$table_name = "tbl_category";
		$offset = $this->uri->segment(3);
		if(!$offset)
			$offset=0;
		$data['site_data'] = $this->category_model->get_category_list_with_limit_for_user($table_name,$offset,$user_id);		
		$data['offset'] = $offset;
        $this->load->library('pagination');
        $config['base_url'] = base_url().'user/category_list/';
		$config['total_rows'] = $this->category_model->count_total_category_for_user($table_name,$user_id);
		$config['per_page'] = PER_PAGE_USER_VIEW;
        $this->pagination->initialize($config);
		$data['site_data_pagination'] = $this->pagination->create_links();
		
		
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
		$data['title'] = 'ATTAKKA - Category List ';		
		$this->load->view('front_template/header_after_login',$data);		
		$this->load->view('front_page/category_list_of_user');
		$this->load->view('front_template/footer_after_login');	
	}
	
	
	function edit_category()
	{
		
		$error = "";
		$err = array();
		
		$message = "";
		
		validation_login_user();
		
		$category_id = $this->uri->segment(3);
		
		
		if($category_id=="")
		{
			$message = "Please select correct category for the edit !";		
			$this->session->set_flashdata('add', 'Please select correct category for the edit !'); 	
			redirect("user/category_list");		
		}
	
	    $session_data = get_session_data();
		$user_id = $session_data['user_id'];
		//pr($_POST);
		
		
		$data['category_data'] = $this->category_model->get_user_category_data("tbl_category",$user_id,$category_id);
		
		$category_image_data = $this->category_model->get_category_image_detail($category_id,"tbl_category_image");
		
		$data['category_image_data'] = $category_image_data;
		
		
		//pr($data['category_data']);
		
		
		if($this->input->post('operation')!="")
		{
			
			if($this->input->post('category_name')=="")
			{
				//$error .="Please enter the category name !<br/>";
				$err['category_name'] = "Please enter the category name !";
			}else{
				
			$category_name = $this->input->post('category_name');
				
			$table_name = "tbl_category";
			
			
			
			
			$category_data = $this->category_model->check_user_edit_category_name_already_exits_or_not($category_id,$category_name,$table_name,$user_id,CATEGORY_CREATED_BY_USER);
			
			
			//pr($category_data); die;
			
			if(!empty($category_data))
			{
					//$error .="Category name already exits !<br/>";
					
					$err['category_name'] ="Category name already created by you !<br/>";
			}
					
				
			}
			
			if($_FILES['category_image']['name']!="")
			{
				$file_name = time()."-".$_FILES['category_image']['name'];
				$category_data['category_image'] = $file_name;
				$config['file_name'] = $file_name;
				$config['upload_path'] = './upload_image/';
				$config['allowed_types'] = 'gif|jpg|png';
				//$config['max_size']	= '1000';
				//$config['max_width']  = '1024';
				//$config['max_height']  = '1024';
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('category_image'))
				{
					$upload_error =  $this->upload->display_errors();
					$err['category_image'] = $upload_error;
					//pr($upload_error);
					//pr($_FILES);
					//die;
					
				}
			
			}
			
			
			if($this->input->post('category_description')=="")
			{
				//$error .="Please enter the category name !<br/>";
				$err['category_description'] = "Please enter the category description!";
			}
			
		if($this->input->post('category_rules')=="")
			{
				//$error .="Please enter the category name !<br/>";
				$err['category_rules'] = "Please enter the category rules!";
			}
			
			
			if($this->input->post('category_name')=="")
			{
				//$error .="Please enter the category name !<br/>";
				$err['category_name'] = "Please enter the category name !";
			}
			
			
			if(empty($err))
			{
				//pr($_FILES);	
				//die;	
				$category_data['category_id'] = $category_id;
				$category_data['created_by'] = CATEGORY_CREATED_BY_USER; // user
				$category_data['creator_id'] = $user_id; // user				
				$category_data['category_name'] = $this->input->post("category_name");				
				$category_data['category_type'] = $this->input->post("category_type");
	            $category_data['review_default'] = $this->input->post("review_default");				
				$category_data['category_description'] = $this->input->post("category_description");
				$category_data['category_rules'] = $this->input->post("category_rules");
				
			
				$this->category_model->edit_category($category_data , "tbl_category");		
				$this->upload_category_image_edit($_FILES['category_image'],$category_id,$category_image_data);				
				$this->session->set_flashdata('add', 'Category edit successfully !'); 	
				//redirect("user/create_category/1");
				$_POST = "";
				$message = "Category edit successfully !";
				
				
					
		$data['category_data'] = $this->category_model->get_user_category_data("tbl_category",$user_id,$category_id);
		
		$category_image_data = $this->category_model->get_category_image_detail($category_id,"tbl_category_image");
		
		$data['category_image_data'] = $category_image_data;									
			}				
		}
		
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
		$data['title'] = 'ATTAKKA - Edit Main Category ';
		$this->load->view('front_template/front_header',$data);
		$this->load->view('front_template/header_navigation');
		$this->load->view('front_page/edit_category_created_by_user',$data);
		$this->load->view('front_template/front_footer2',$data);
	}
	

// this method is used for the upload image
function upload_category_image_edit($category_image,$category_id,$image_data_db)
{

	if(isset($category_image['name']))
	{
	
	$size_of =  count($category_image['name']);	
	$i = 0;
	foreach($image_data_db as $detail_image)
	{
		
		$category_image_name =  "";
		if(isset($category_image['name'][$i]))
		{
			$category_image_name =  $category_image['name'][$i];
		}
		if($category_image_name!="")
		{
			$extension_detail = pathinfo($category_image_name);
			//pr($extension_detail);die;
			$extension = $extension_detail['extension'];
			$file_name = $extension_detail['filename'];
			$new_file_name = time()."-".$file_name.".".$extension;
			$category_image_name_temp = $category_image['tmp_name'][$i];			
			
			if(move_uploaded_file($category_image_name_temp,"./upload_image/" . $new_file_name))
			{
				$image_data['category_id'] = $category_id;
				$image_data['category_image_name'] = $new_file_name;
				$image_data['category_image_created_date_time'] = date("Y-m-d H:i:s");	
				$category_image_id = $detail_image['category_image_id'];
				$this->category_model->edit_category_image_detail($image_data,"tbl_category_image",$category_image_id);
				
				//echo $this->db->last_query();
				
			
			
			}
			
			
		}
		
	$i++;	}
	
	}
	
}

function sub_category_list()
{
		// check user login or not
		validation_login_user();
	    $session_data = get_session_data();
		$user_id = $session_data['user_id'];
		
		
		
		
		$data = array();
		$data['user_id'] = $user_id;
		
		$err = array();
		$data['title'] = "Sub Category List";
		$error = "";
		$message = "";
		$post = $this->input->post();
		
		$table_name = "tbl_sub_category";
		$offset = $this->uri->segment(3);
		if(!$offset)
			$offset=0;
		$data['site_data'] = $this->sub_category_model->get_user_category_list_with_limit($table_name,$offset,$user_id);		
		$data['offset'] = $offset;
        $this->load->library('pagination');
        $config['base_url'] = base_url().'user/sub_category_list/';
		$config['total_rows'] = $this->sub_category_model->count_total_user_category($table_name,$user_id);
		$config['per_page'] = PER_PAGE_USER_VIEW;
        $this->pagination->initialize($config);
		$data['site_data_pagination'] = $this->pagination->create_links();
		
		
		
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
		$data['title'] = 'ATTAKKA - Sub Category List ';		
		$this->load->view('front_template/header_after_login',$data);		
		$this->load->view('front_page/sub_category_list_of_user');
		$this->load->view('front_template/footer_after_login');	
		
}


function edit_sub_category()
	{
		
		$error = "";
		$err = array();
		
		$message = "";
		
		validation_login_user();
		
		$session_data = get_session_data();
		$user_id = $session_data['user_id'];
		
		
		$sub_category_id = $this->uri->segment(3);
		if($sub_category_id=="")
		{
			$message = "Please select correct category for the edit !";		
			$this->session->set_flashdata('add', 'Please select correct category for the edit !'); 	
			redirect("user/sub_category_list");
		}
		
			
		$post = $this->input->post();
		
		$data["catgory_list"] = $this->sub_category_model->get_all_category_by_user_id("tbl_category",$user_id);
		
		
		$data["sub_catgory_data"] = $this->sub_category_model->get_user_sub_category_detail_by_category_id("tbl_sub_category",$user_id,$sub_category_id);
		
		

	// pr($data["sub_catgory_data"]);
	  
		if($this->input->post('operation')!="")
		{
			
			
			
			
			if($this->input->post('category_id')=="")
			{
				$error .="Please select the category name !<br/>";
				$err['category_id'] = "Please select the category name !<br/>";
			}
			
			
			
			if($this->input->post('sub_category_name')=="")
			{
				$error .="Please enter the sub category name !<br/>";
				$err['sub_category_name'] = "Please enter the sub category name !";
			}else{
				
			$category_name = $this->input->post('sub_category_name');
				
			$table_name = "tbl_sub_category";
			$sub_category_data = $this->sub_category_model->check_sub_category_name_for_edit_already_exits_or_not($category_name,$table_name,$sub_category_id,$user_id);
			
		
			
			
			//pr($category_data); die;
			
			if(!empty($sub_category_data))
			{
					$error .="Category name already exits !<br/>";
					
					$err['sub_category_name'] ="Sub Category name already created by you !<br/>";
			}
					
				
			}
			
			
			if($this->input->post('sub_category_description')=="")
			{
				$error .="Please enter the category name !<br/>";
				$err['sub_category_description'] = "Please enter the sub category description !";
			}
			
			
			if($this->input->post('sub_category_rules')=="")
			{
				$error .="Please enter the category name !<br/>";
				$err['sub_category_rules'] = "Please enter the sub category rules !";
			}
			
			
			if($_FILES['sub_category_image']['name']!="")
			{
				$file_name = time()."-".$_FILES['sub_category_image']['name'];
				$category_data['sub_category_image'] = $file_name;
				$config['file_name'] = $file_name;
				$config['upload_path'] = './upload_image/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '1000';
				$config['max_width']  = '1024';
				$config['max_height']  = '1024';
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('sub_category_image'))
				{
					$upload_error =  $this->upload->display_errors();
					$err['sub_category_image'] = $upload_error;
					//pr($upload_error);
					//pr($_FILES);
					//die;
					
				}
			
			}
		
		
		if(empty($err))
			{
				
				$category_data['created_by'] = CATEGORY_CREATED_BY_USER;
				
				$category_data['creator_id'] = $user_id;
				$category_data['sub_category_id'] = $sub_category_id;
				$category_data['category_id'] = $this->input->post("category_id");
				$category_data['sub_category_name'] = $this->input->post("sub_category_name");
				$category_data['sub_category_description'] = $this->input->post("sub_category_description");
				$category_data['sub_category_rules'] = $this->input->post("sub_category_rules");
				$category_data['sub_category_rules'] = $this->input->post("sub_category_rules");
				$category_data['sub_category_type'] = $this->input->post("sub_category_type");				
				$category_data['apply_moderator'] = $this->input->post("apply_moderator");
				
				
				$category_data['sub_category_created_date_time'] = date("Y-m-d H:i:s");
				
				$this->sub_category_model->edit_category($category_data , "tbl_sub_category");				
				
				//$this->upload_category_image($_FILES,$category_id);
				
				
		$data["sub_catgory_data"] = $this->sub_category_model->get_user_sub_category_detail_by_category_id("tbl_sub_category",$user_id,$sub_category_id);
		
		
		
				
				$this->session->set_flashdata('add', 'sub category edit successfully!'); 
				$message = "sub category edit successfully!";
				$_POST = "";
				//redirect("user/sub_category_list");
				
									
			}
	
	}
	
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
		$data['title'] = 'ATTAKKA - Edit Sub Category ';
		$this->load->view('front_template/front_header',$data);
		$this->load->view('front_template/header_navigation');
		$this->load->view('front_page/edit_sub_category_by_user',$data);
		$this->load->view('front_template/front_footer2',$data);
	}
	
	
	

function topic()
{
		// check user login or not
		validation_login_user();
	    $session_data = get_session_data();
		$user_id = $session_data['user_id'];
		
		
		$data = array();	
		$err = array();
		$data['title'] = "Topic List";
		$error = "";
		$message = "";
		$post = $this->input->post();
		
		$table_name = "tbl_topic";
		$offset = $this->uri->segment(3);
		if(!$offset)
			$offset=0;
		$data['site_data'] = $this->topic_model->get_user_topic_list_with_limit($table_name,$offset,$user_id);		
		$data['offset'] = $offset;
        $this->load->library('pagination');
        $config['base_url'] = base_url().'user/topic/';
		$config['total_rows'] = $this->topic_model->count_total_topic_of_user($table_name,$user_id);
		$config['per_page'] = PER_PAGE_USER_VIEW;
        $this->pagination->initialize($config);
		$data['site_data_pagination'] = $this->pagination->create_links();
		
		
		
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
		$data['title'] = 'ATTAKKA - Topic List ';		
		$this->load->view('front_template/header_after_login',$data);		
		$this->load->view('front_page/topic_list_of_user');
		$this->load->view('front_template/footer_after_login');	
		
}

function post_topic()
{
	
		
		$error = "";
		$err = array();		
		$message = "";		
		validation_login_user();		
	    $session_data = get_session_data();
		$user_id = $session_data['user_id'];
		//pr($_POST);		
		$data["catgory_list"] = $this->sub_category_model->get_all_category_by_user_id("tbl_category",$user_id);
		//$category_id = 1;
		//$data["sub_catgory_list"] =$this->topic_model->get_all_sub_category_by_user_id("tbl_sub_category",$user_id,$category_id);
				
		if($this->input->post('operation')!="")
		{
			
			
			if($this->input->post('category_id')=="")
			{
				//$error .="Please enter the category name !<br/>";
				$err['category_id'] = "Please select the category !";
			}
			
			
			if($this->input->post('sub_category_id')=="")
			{
				//$error .="Please enter the category name !<br/>";
				// $err['sub_category_id'] = "Please select the sub category !";
			}
			
			
			if($this->input->post('topic_title')=="")
			{
				//$error .="Please enter the category name !<br/>";
				$err['topic_title'] = "Please enter the topic title!";
			}
			
			if($this->input->post('topic_image_link')=="")
			{
				//$error .="Please enter the category name !<br/>";
				// $err['topic_image_link'] = "Please enter the topic image link!";
			}
			
			if($this->input->post('topic_video_link')=="")
			{
				//$error .="Please enter the category name !<br/>";
				// $err['topic_video_link'] = "Please enter the topic video link!";
			}
			
			
			if($this->input->post('topic_description')=="")
			{
				//$error .="Please enter the category name !<br/>";
				$err['topic_description'] = "Please enter the topic description!";
			}
			
			
			if(empty($err))
			{
				//pr($_FILES);	
				//die;							
							
				$topic_data['category_id'] = $this->input->post("category_id");				
				$topic_data['sub_category_id'] = $this->input->post("sub_category_id");
	            $topic_data['topic_title'] = $this->input->post("topic_title");				
				$topic_data['topic_description'] = $this->input->post("topic_description");
				$topic_data['topic_image_link'] = $this->input->post("topic_image_link");
				$topic_data['topic_video_link'] = $this->input->post("topic_video_link");	
				$topic_data['topic_created_by'] = TOPIC_CREATED_BY_USER; // user
				$topic_data['topic_creator_id'] = $user_id; // user id
				$topic_data['topic_created_date_time'] = date("Y-m-d H:i:s");
				$topic_data['topic_ip_address'] = ip_address(); 
				
				
				$this->topic_model->add_topic($topic_data , "tbl_topic");				
				//$this->upload_category_image($_FILES['category_image_name'],$category_id);				
				$this->session->set_flashdata('add', 'Topic post successfully !'); 	
				$_POST = "";
				$message = "Topic post successfully !";				
				redirect("user/topic");
				
									
			}
				
		}
	
		
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
		$data['title'] = 'ATTAKKA - Post Topic';
		$this->load->view('front_template/front_header',$data);
		$this->load->view('front_template/header_navigation');
		$this->load->view('front_page/post_new_potic_by_user',$data);
		$this->load->view('front_template/front_footer2',$data);
	
}

function topic_detail()
{
	
	
		
		$error = "";
		$err = array();		
		$message = "";		
		validation_login_user();		
	    $session_data = get_session_data();
		$user_id = $session_data['user_id'];
		
		
		$topic_id = $this->uri->segment(3);
		
		if($topic_id=="")
		{
			$message = "Please select correct topic for the detail !";		
			$this->session->set_flashdata('add', 'Please select correct topic for the detail !'); 	
			redirect("user/topic");
		}
			
		$data["topic_data"] = $this->topic_model->get_topic_detail_by_topic_id("tbl_topic",$user_id,$topic_id);
			
		//pr($data["topic_data"]);
		
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
		$data['title'] = 'ATTAKKA - Topic Detail';
		$this->load->view('front_template/front_header',$data);
		$this->load->view('front_template/header_navigation');
		$this->load->view('front_page/topic_detail',$data);
		$this->load->view('front_template/front_footer2',$data);
	

	
}


	function ajax_sub_category_list()
	{
		$data = array();
		validation_login_user();		
		$session_data = get_session_data();
		$user_id = $session_data['user_id'];	
		
		$category_id = $this->input->post("category_id");
		
		
		$data["sub_catgory_list"] =$this->topic_model->get_all_sub_category_by_user_id("tbl_sub_category",$user_id,$category_id);
		
		
		$this->load->view('front_page/sub_category_ajax_result',$data);
	}

	
	function create_comment()
	{
		
		$error = "";
		$err = array();
		
		$message = "";
		
		validation_login_user();
		
		$topic_id = $this->uri->segment(3);
		if($topic_id=="")
		{
			$message = "Please select correct topic for the create review on topic!";		
			$this->session->set_flashdata('add', 'lease select correct topic for the create comment on topic'); 	
			redirect("user/dashboard");		
		}
		
		
		
		$data['topic_data'] = $this->topic_model->get_topic_det_by_topic_id($topic_id,"tbl_topic");
		
	
	    $session_data = get_session_data();
		$user_id = $session_data['user_id'];
		//pr($_POST);
		
		if($this->input->post('operation')!="")
		{
			if($this->input->post('comment_title')=="")
			{
				//$error .="Please enter the category name !<br/>";
				$err['comment_title'] = "Please enter comment title !";
			}		
			
			
			if($this->input->post('comment_description')=="")
			{
				//$error .="Please enter the category name !<br/>";
				$err['comment_description'] = "Please enter comment description !";
			}		

			if(empty($err))
			{
				//pr($_FILES);	
				//die;							
				$comment['comment_creator_id'] = $user_id; // user	
				$comment['topic_id'] = $topic_id; // topic id								
				$comment['comment_title'] = $this->input->post("comment_title");
	            $comment['comment_description'] = $this->input->post("comment_description");								
				$comment['comment_created_date_time'] = date("Y-m-d H:i:s");
				$comment['comment_ip_address'] = ip_address();
				$data_comment_insert = $comment;				
				$review_id = $this->comment_model->add_comment_by_user($data_comment_insert , "tbl_comment");	
				$this->session->set_flashdata('add', 'Comment create successfully !'); 	
				redirect("user/topicdetail/".$topic_id);
				$_POST = "";
				$message = "Comment create successfully !";
			}
				
		}
	
		
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
		$data['title'] = 'ATTAKKA - Create Comment ';
	
		
		$this->load->view('front_template/header_after_login',$data);		
		$this->load->view('front_page/comment_created_by_user');
		$this->load->view('front_template/footer_after_login');	
	}
	
function review()
{
		
		$error = "";
		$err = array();
		
		$message = "";
		validation_login_user();
	    $session_data = get_session_data();
		$user_id = $session_data['user_id'];
		
		
		//$data['review_data'] = $this->user_model->get_review_by_user_id($user_id,"tbl_review");
		
		$data['review_data'] = $this->user_model->get_review("tbl_review");
		
		// pr($data['review_data']);
		
		$data['reveiw_all_user'] = $this->user_model->get_5_latest_review("tbl_review");
		
		//pr($data['reveiw_all_user']  );
		
		
		
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
		$data['title'] = 'ATTAKKA - Review ';		
		$this->load->view('front_template/header_after_login',$data);		
		$this->load->view('front_page/user_review');
		$this->load->view('front_template/footer_after_login');	
}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */