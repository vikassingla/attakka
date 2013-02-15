<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller 
{ 
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');	
		$this->load->helper('common');	
		$this->load->library('session');	   
		$this->load->model('admin_model');
		$this->load->model('message_model');
		$this->load->model('user_model');
		$this->load->model('review_model');
		$this->load->model('topic_model');
		
	}
	
	
	public function index()
	{
		$data = array();		
		$session_data = get_session_data();
		if(isset($session_data['admin_loged_in']))
		{
			redirect("admin/dashboard");
		}
				
		$data['title'] = "Admin Login";
		$error = "";
		$message = "";
		$post = $this->input->post();
		
		if($this->input->post('operation')!="")
		{
			//pr($post);			
			if($post['admin_email']=="")
			{
				$error .= "Please enter email !<br/> ";	
			}else{
				  
						if(!filter_var($this->input->post('admin_email'), FILTER_VALIDATE_EMAIL)){
									$error .="Please enter valid  email!<br />";
						}
				  }
			
			if($post['admin_password']=="")
			{
				$error .= "Please enter password !<br/>";	
			}
			
		
		
		if($error=="")
		{
			$table_name = "tbl_admin";
			$condition = array(
							   	"admin_email"=>$post['admin_email'],
								"admin_password"=>md5($post['admin_password']),
								"admin_status"=>1,
								
							  );	
			$admin_detail = $this->admin_model->verify_admin_login($table_name,$condition);
			
			if(!empty($admin_detail))
			{								
				$admin_detail["admin_loged_in"] = "1";				
				set_session_data($admin_detail);
				redirect("admin/dashboard");	
			}else{
				$error .= "Incorrect email or password !<br/>";		
			}
		}
		
		}
		
		$data['error'] = $error;
		$data['message'] = $message;
		$this->load->view('admin_template/admin_header',$data);
		$this->load->view('admin_pages/admin_login');
		$this->load->view('admin_template/admin_footer');
	}
	
	
	function dashboard()
	{
		
		
	    $data = array();
		validation_login();
		$data['title'] = "Admin Dashboard";
		
		$error = "";
		$message = "";
		
		
		//pr(get_session_data());
		
		
		$data['error'] = $error;
		$data['message'] = $message;
		$this->load->view('admin_template/admin_header',$data);
		$this->load->view('admin_pages/dashboard');
		$this->load->view('admin_template/admin_footer');
	}
	
	
	// admin log out
	function log_out()
	{
		$session_data = get_session_data();
		if(isset($session_data['admin_loged_in']))
		{
			$this->session->unset_userdata('admin_loged_in');
			$this->session->unset_userdata('admin_id');
			$this->session->unset_userdata('admin_first_name');
			$this->session->unset_userdata('admin_last_name');
			$this->session->unset_userdata('admin_mobile_no');
			$this->session->unset_userdata('admin_gender');
			$this->session->unset_userdata('admin_email');
			$this->session->unset_userdata('admin_password');
			$this->session->unset_userdata('admin_status');
			$this->session->unset_userdata('admin_created_date_time');
			redirect("admin");
		}
		
	}
	
	
	// this method is used for the show list category 
	public function user_list()
	{
		// check admin login or not
		validation_login();
		
		$data = array();		
		$data['title'] = "User List";
		$error = "";
		$message = "";
		$post = $this->input->post();
		
		$table_name = "tbl_user";
		$offset = $this->uri->segment(3);
		if(!$offset)
			$offset=0;
		$data['site_data'] = $this->user_model->get_user_list_with_limit($table_name,$offset);		
		$data['offset'] = $offset;
        $this->load->library('pagination');
        $config['base_url'] = base_url().'admin/user_list/';
		$config['total_rows'] = $this->user_model->count_total_user($table_name);
		$config['per_page'] = PER_PAGE_ADMIN_VIEW;
        $this->pagination->initialize($config);
		$data['site_data_pagination'] = $this->pagination->create_links();
		$data['error'] = $error;
		$data['message'] = $message;
		$this->load->view('admin_template/admin_header',$data);
		$this->load->view('admin_pages/user_list');
		$this->load->view('admin_template/admin_footer');
	}
	
	
	// this method is used for the show list category 
	public function view_user_deatil()
	{
		// check admin login or not
		validation_login();
		
		$data = array();		
		$data['title'] = "User Detail";
		$error = "";
		$message = "";
		$post = $this->input->post();
		
		$user_id = $this->uri->segment(3);
		
		if($user_id=="")
		{
			redirect("admin/user_list");	
		}
		$table_name = "tbl_user";
		$data['user_detail'] = $this->user_model->get_user_detail_by_user_id($user_id,"tbl_user");
		
		
		$data['error'] = $error;
		$data['message'] = $message;
		$this->load->view('admin_template/admin_header',$data);
		$this->load->view('admin_pages/user_detail');
		$this->load->view('admin_template/admin_footer');
	}
	
	// this method is used for the active inactive
	function active_inactive_user()
	{
		$user_id = $this->uri->segment(3);
		$user_status = $this->uri->segment(4);
		$table_name = "tbl_user";
		$update_data = array(
							 "user_id"=>$user_id,
							 "user_status"=>$user_status
							 );
		
		$this->user_model->active_inactive_user($table_name,$update_data,$user_id);
		
		if($user_status==0)
		{
			$this->session->set_flashdata('add', 'user inactive successfully!'); 	
			redirect("admin/user_list");
		}
		if($user_status==1)
		{
			$this->session->set_flashdata('add', 'user active successfully!'); 	
			redirect("admin/user_list");	
		}
		
		
	}
	
	
	
	function profile_setting()
	{
			// check admin login or not
		validation_login();
		
		$data = array();		
		$data['title'] = "Edit Category";
		$error = "";
		$message = "";
		$post = $this->input->post();
		
		
		
		$session_data = get_session_data();
		$admin_id = $session_data['admin_id'];
		$data['admin_data'] = $this->admin_model->get_user_detail_by_user_id($admin_id,"tbl_admin");
		
	//	pr($data['admin_data']);
		if($this->input->post('operation')!="")
		{
			
			if($this->input->post('admin_first_name')=="")
			{
				$error .="Please enter the first name !<br/>";
			}
			
			if($this->input->post('admin_last_name')=="")
			{
				$error .="Please enter the last name !<br/>";
			}
			
			if($this->input->post('admin_mobile_no')=="")
			{
				// $error .="Please enter mobile no !<br/>";
			}
			
			if($this->input->post('admin_email')=="")
			{
				$error .="Please enter the email !<br/>";
			}else{
		  
		  		if(!filter_var($this->input->post('admin_email'), FILTER_VALIDATE_EMAIL)){
							$error .= "Please enter valid  email!<br />";
				}
		  }
			
			if($this->input->post('admin_password')=="")
			{
				$admin_password = $data['admin_data']['admin_password'];
			}else{
				$admin_password = md5($this->input->post("admin_password"));	
			}
		  	
			
			
			if($error=="")
			{
				unset($post['admin_password']);
				unset($post['operation']);
				
				$post['admin_password'] = $admin_password;
			//pr($post);
			//die;
				
				$this->admin_model->update_admin_detail_by_admin_id($admin_id,"tbl_admin",$post);						
				$this->session->set_flashdata('add', 'profile update successfully!'); 	
				redirect("admin/profile_setting/1");
			}
				
		}
		
		$data['error'] = $error;
		$data['message'] = $message;
		$this->load->view('admin_template/admin_header',$data);
		$this->load->view('admin_pages/admin_update_profile');
		$this->load->view('admin_template/admin_footer');
	}
	
	
	function forget_password()
	{
		$data = array();	
						
		$data['title'] = "Admin Forget Password";
		$error = "";
		$message = "";
		$post = $this->input->post();
		
		if($this->input->post('operation')!="")
		{
			//pr($post);			
			if($post['admin_email']=="")
			{
				$error .= "Please enter email !<br/> ";	
			}else{
				  
						if(!filter_var($this->input->post('admin_email'), FILTER_VALIDATE_EMAIL)){
									$error .="Please enter valid  email!<br />";
						}
				  }
			
		if($error=="")
		{
			$table_name = "tbl_admin";				
			$admin_detail = $this->admin_model->get_admin_detail_by_admin_email($post['admin_email'],"tbl_admin");
			
			if(!empty($admin_detail))
			{								
				
				$password = uniq_id();	
				$update_data = array("admin_password"=>md5($password));
				$this->admin_model->update_admin_password($update_data,"tbl_admin",$post['admin_email']);
				
				$this->send_forget_password_email($admin_detail,$password );				
				$message = "Please check your email. we have sent password on your email.";
				
			}else{
				$error .= "This Email is not register with us.!<br/>";		
			}
		}
		
		}
		
		$data['error'] = $error;
		$data['message'] = $message;
		$this->load->view('admin_template/admin_header',$data);
		$this->load->view('admin_pages/admin_forget_password');
		$this->load->view('admin_template/admin_footer');		
	}
	
	
	function send_forget_password_email($post,$password )
	{		
		$this->load->library('email');
		$config['mailtype']='html';
		$this->email->initialize($config);
		$this->email->from(ADMIN_FROM_EMAIL_ID, ADMIN_FROM_NAME);
		$this->email->to($post['admin_email']);         
		$this->email->subject('New Password');
		$message = 'Dear '.$post['admin_first_name'].' '.$post['admin_last_name'].',<br /><br /> Please use following detail for the login<br/><br/> Email:&nbsp;&nbsp;'.$post['admin_email'].'<br/>Password:&nbsp;&nbsp;'.$password.'<br /> . <br/><br /><br />Regards,<br />Site Manager<br/>'.SITE_URL;
		$this->email->message($message);
		@$this->email->send();	
	}
	
	
	// this method is used for the show list category 
	public function review_list()
	{
		// check admin login or not		
		validation_login();
		
		$data = array();		
		$data['title'] = "User Review List";
		$error = "";
		$message = "";
		$post = $this->input->post();
		
		$table_name = "tbl_review";
		$offset = $this->uri->segment(3);
		if(!$offset)
			$offset=0;
		$data['site_data'] = $this->review_model->get_review_list_with_limit($table_name,$offset);		
		$data['offset'] = $offset;
        $this->load->library('pagination');
        $config['base_url'] = base_url().'admin/review_list/';
		$config['total_rows'] = $this->review_model->count_total_review($table_name);
		$config['per_page'] = PER_PAGE_ADMIN_VIEW;
        $this->pagination->initialize($config);
		$data['site_data_pagination'] = $this->pagination->create_links();
		$data['error'] = $error;
		$data['message'] = $message;
		$this->load->view('admin_template/admin_header',$data);
		$this->load->view('admin_pages/review_list');
		$this->load->view('admin_template/admin_footer');
	}
	
	
	// this method is used for the show topic review list  
	public function view_topic_review_deatil()
	{
		// check admin login or not
		validation_login();
		
		$data = array();		
		$data['title'] = "User Review";
		$error = "";
		$message = "";
		$post = $this->input->post();
		
		$review_id = $this->uri->segment(3);
		
		if($review_id=="")
		{
			redirect("admin/review_list");	
		}
		
		
		$data['review_detail'] = $this->review_model->get_review_detail_by_review_id("tbl_review",$review_id);
		
		//pr($data['review_detail']);
		
		$data['error'] = $error;
		$data['message'] = $message;
		$this->load->view('admin_template/admin_header',$data);
		$this->load->view('admin_pages/review_detail');
		$this->load->view('admin_template/admin_footer');
	}
	
	
	function user_message_list()
	{
		validation_login();
		
		$data = array();	
		$err = array();
		$error = "";
		$message = "";
		$user_id = $this->uri->segment(3);	
		
		if($user_id=="")
		{
			redirect("admin/user_list");
		}
		
		
		$user_detail = $this->user_model->get_user_detail_by_user_id($user_id,"tbl_user");
	
		
			$data['user_full_name'] = ucfirst($user_detail['user_first_name'])." ".ucfirst($user_detail['user_last_name']);
	
	
	
		
		//pr($user_detail);
		
		$user_email = $user_detail['user_email'];	
		
		
		$segment = $this->uri->segment(4);
		if($segment=='s')
		{
			$segment3 = "s";
		}else if($segment=='r'){

			// $this->db->where("receiver_id",$user_id);
			$segment3 = "r";
			
		}else{
			$segment3 = "s";
		}
		
		
		$table_name = "tbl_message";
		$offset = $this->uri->segment(5);
		if(!$offset)
			$offset=0;
		$data['site_data'] = $this->message_model->get_message_list_with_limit_in_admin($table_name,$offset,$user_id,$user_email);		
		$data['offset'] = $offset;
        $this->load->library('pagination');
        $config['base_url'] = base_url().'admin/user_message_list/'.$user_id."/".$segment3.'/';
		$config['total_rows'] = $this->message_model->count_total_message_in_admin($table_name,$user_id,$user_email);
		$config['per_page'] = PER_PAGE_USER_VIEW;
		$config['uri_segment'] = 5;
        $this->pagination->initialize($config);
		$data['site_data_pagination'] = $this->pagination->create_links();
		
		$data['title'] = 'ATTAKKA - User Message List ';	
		$data['error'] = $error;
		$data['message'] = $message;
		
		$this->load->view('admin_template/admin_header',$data);
		$this->load->view('admin_pages/user_message_list');
		$this->load->view('admin_template/admin_footer');
		
	
		
	}
	
	function send_message_detail()
	{
		validation_login();
		
		$error = "";
		$err = array();
		
		$message = "";
		
		
		$user_id = $this->uri->segment(3);
		
		if($user_id=="")
		{
			redirect("admin/user_list");
		}
		
		
		$user_detail = $this->user_model->get_user_detail_by_user_id($user_id,"tbl_user");
		
			$data['user_full_name'] = ucfirst($user_detail['user_first_name'])." ".ucfirst($user_detail['user_last_name']);
	
		
		//pr($user_detail);
		
		$user_email = $user_detail['user_email'];	
		$message_id = $this->uri->segment(4);
		if($message_id=="")
		{
			$message = "Please select correct category for the edit !";		
			$this->session->set_flashdata('add', 'Please select correct message for the detail !'); 	
			redirect("admin/user_message_list/".$user_id.'/s');
		}
		
			
		$post = $this->input->post();		
		$data["message_detail"] = $this->message_model->get_message_detail_by_message_id($message_id,$user_id,$user_email,"tbl_message");
		
		
		if(empty($data["message_detail"]))
		{
			$this->session->set_flashdata('add', 'Please select correct message for the detail !'); 	
			redirect("admin/user_message_list/".$user_id.'/s');
		}
		
		
		
		
	// pr($data["message_detail"]);
	  
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
		$data['title'] = 'ATTAKKA - Send Message Detail';
		
		
		$this->load->view('admin_template/admin_header',$data);
		$this->load->view('admin_pages/user_send_message_detail');
		$this->load->view('admin_template/admin_footer');
	
		
	}
	
	
	function receive_message_detail()
	{
		
		
		validation_login();
		
		$error = "";
		$err = array();
		
		$message = "";
		
		
		$user_id = $this->uri->segment(3);
		
		if($user_id=="")
		{
			redirect("admin/user_list");
		}
		
		
		$user_detail = $this->user_model->get_user_detail_by_user_id($user_id,"tbl_user");
	
		
		//pr($user_detail);
		
		$user_email = $user_detail['user_email'];	
		$message_id = $this->uri->segment(4);
		
		$data['user_full_name'] = ucfirst($user_detail['user_first_name'])." ".ucfirst($user_detail['user_last_name']);
		
		
		if($message_id=="")
		{
			$message = "Please select correct message for the detail !";		
			$this->session->set_flashdata('add', 'Please select correct message for the detail !'); 	
			redirect("admin/user_message_list/".$user_id.'/r');
		}
					
		$post = $this->input->post();		
		$data["message_detail"] = $this->message_model->get_message_detail_by_message_id_email($message_id,$user_id,$user_email,"tbl_message");
		
		
		if(empty($data["message_detail"]))
		{
			$this->session->set_flashdata('add', 'Please select correct message for the detail !'); 	
			redirect("admin/user_message_list/".$user_id.'/r');
		}
		
		// pr($data["message_detail"]);	  
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
		$data['title'] = 'ATTAKKA - Receive Message Detail';
		
		$this->load->view('admin_template/admin_header',$data);
		$this->load->view('admin_pages/user_receive_message_detail');
		$this->load->view('admin_template/admin_footer');
	}
	
	
	
}

/* End of file admin.php */
/* Location: ./application/controller/admin.php */