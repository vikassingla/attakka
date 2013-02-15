<?php if  ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller 
{ 
	 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');	
		$this->load->helper('common');	
		$this->load->library('session');
		$this->load->model("user_model");			
		$this->load->model('message_model');
		
		
	}
	
	// this method is used for the send message
	function index()
	{
		
		$error = "";
		$err = array();
		
		$message = "";
		
		validation_login_user();
		
		$session_data = get_session_data();
		$user_id = $session_data['user_id'];
		
			
		$post = $this->input->post();
		
	  //pr($_POST);		
	  
		if($this->input->post('operation')!="")
		{
					
			if($this->input->post('to_email')=="")
			{
				$error .="Please enter the email !<br/>";
				$err['to_email'] = "Please enter the email !<br/>";
			}else{
		  
		  		if(!filter_var($this->input->post('to_email'), FILTER_VALIDATE_EMAIL)){
							$err['to_email']  = "Please enter valid  email!<br />";
				}
		     }
			
			
			if($this->input->post('subject')=="")
			{
					$error .="Please enter the subject !<br/>";
					$err['subject'] = "Please enter the subject !<br/>";
			}
						
				
			if($this->input->post('message')=="")
			{
				$error .="Please enter the message !<br/>";
				$err['message'] = "Please enter the message !<br/>";
			}	
		
		if(empty($err))
		{
				$receiver_id = "";
				
				$message_data['sender_id'] = $user_id;
				//$message_data['receiver_id'] = $receiver_id;
				$message_data['to_email'] = $this->input->post("to_email");
				$message_data['subject'] = $this->input->post("subject");
				$message_data['message'] = $this->input->post("message");
				$message_data['message_ip_address'] = $this->input->post("message_ip_address");
				$message_data['date_time'] = date("Y-m-d H:i:s");
				$message_data['message_sent_type'] = SEND_MESSAGE_TYPE;
				$message_id = $this->message_model->add_message($message_data,"tbl_message");				
				$this->session->set_flashdata('add', "message send successfully!");
				
				$this->send_message_email($message_data);
				$message = "message send successfully!";
				$_POST = "";
				redirect("message/index/1");
				
									
			}
	
	}
	
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
		$data['title'] = 'ATTAKKA - Compose Message ';
		$this->load->view('front_template/front_header',$data);
		$this->load->view('front_template/header_navigation');
		$this->load->view('front_page/send_message',$data);
		$this->load->view('front_template/front_footer2',$data);
	}
	
	
	function message_list()
	{
		
		
		// check user login or not
		validation_login_user();
	    $session_data = get_session_data();
		$user_id = $session_data['user_id'];
		$user_email = $session_data['user_email'];
		
		
		$data = array();	
		$err = array();
		$error = "";
		$message = "";
		$post = $this->input->post();
		
		
		
		$segment = $this->uri->segment(3);
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
		$offset = $this->uri->segment(4);
		if(!$offset)
			$offset=0;
		$data['site_data'] = $this->message_model->get_message_list_with_limit($table_name,$offset,$user_id,$user_email);		
		$data['offset'] = $offset;
        $this->load->library('pagination');
        $config['base_url'] = base_url().'message/message_list/'.$segment3."/";
		$config['total_rows'] = $this->message_model->count_total_message($table_name,$user_id,$user_email);
		$config['per_page'] = PER_PAGE_USER_VIEW;
		$config['uri_segment'] = 4;
        $this->pagination->initialize($config);
		$data['site_data_pagination'] = $this->pagination->create_links();
		
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
		$data['title'] = 'ATTAKKA - Message List ';		
		$this->load->view('front_template/header_after_login',$data);	
		
		
		
		$this->load->view('front_page/message_list');
		
		$this->load->view('front_template/footer_after_login');	
		
	}
	
	
	function send_message_email($post )
	{		
		// to_email  subject   message
		$session_data = get_session_data();
		
		$this->load->library('email');
		$config['mailtype']='html';
		$this->email->initialize($config);
		$this->email->from(ADMIN_FROM_EMAIL_ID, ADMIN_FROM_NAME);
		$this->email->to($post['to_email']);         
		$this->email->subject($post['subject']);				
		$message = 'Your friend '.$session_data['user_first_name'].' '.$session_data['user_last_name'].' send a message,<br /> <br /> message detail are following:  <br/> Subject:&nbsp;&nbsp;&nbsp;'.$post['subject'].'<br/> Message:&nbsp;&nbsp;&nbsp;'.$post['message'].'<br /><br />Regards,<br />Site Manager<br/>'.SITE_URL;
		$this->email->message($message);
		@$this->email->send();	
	}
	
	
	
	
	function send_message_detail()
	{
		
		$error = "";
		$err = array();
		
		$message = "";
		
		validation_login_user();
		
		$session_data = get_session_data();
		$user_id = $session_data['user_id'];
		$user_email = $session_data['user_email'];
		
		
		$message_id = $this->uri->segment(3);
		if($message_id=="")
		{
			$message = "Please select correct category for the edit !";		
			$this->session->set_flashdata('add', 'Please select correct message for the detail !'); 	
			redirect("message/message_list");
		}
		
			
		$post = $this->input->post();		
		$data["message_detail"] = $this->message_model->get_message_detail_by_message_id($message_id,$user_id,$user_email,"tbl_message");
		
		
		if(empty($data["message_detail"]))
		{
			$this->session->set_flashdata('add', 'Please select correct message for the detail !'); 	
			redirect("message/message_list");
		}
		
		
		
		
	// pr($data["message_detail"]);
	  
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
		$data['title'] = 'ATTAKKA - Message Detail';
		$this->load->view('front_template/front_header',$data);
		$this->load->view('front_template/header_navigation');
		$this->load->view('front_page/send_message_detail',$data);
		$this->load->view('front_template/front_footer2',$data);
	}
	
	
	function receive_message_detail()
	{
		
		$error = "";
		$err = array();		
		$message = "";		
		validation_login_user();		
		$session_data = get_session_data();
		$user_id = $session_data['user_id'];
		$user_email = $session_data['user_email'];
		
		
		$message_id = $this->uri->segment(3);
		
		if($message_id=="")
		{
			$message = "Please select correct message for the detail !";		
			$this->session->set_flashdata('add', 'Please select correct message for the detail !'); 	
			redirect("message/message_list/r");
		}
					
		$post = $this->input->post();		
		$data["message_detail"] = $this->message_model->get_message_detail_by_message_id_email($message_id,$user_id,$user_email,"tbl_message");
		
		
		if(empty($data["message_detail"]))
		{
			$this->session->set_flashdata('add', 'Please select correct message for the detail !'); 	
			redirect("message/message_list/r");
		}
		
		// pr($data["message_detail"]);	  
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
		$data['title'] = 'ATTAKKA - Message Detail';
		$this->load->view('front_template/front_header',$data);
		$this->load->view('front_template/header_navigation');
		$this->load->view('front_page/receive_message_detail',$data);
		$this->load->view('front_template/front_footer2',$data);
	}
	
	
	
	// this method is used for the send message
	function reply_message()
	{
		
		$error = "";
		$err = array();
		
		$message = "";
		
		validation_login_user();
		
		$session_data = get_session_data();
		$user_id = $session_data['user_id'];
		$user_email = $session_data['user_email'];
		
			
		$post = $this->input->post();
		
		$message_id = $this->uri->segment(3);
		
		$data["message_detail"] = $this->message_model->get_message_detail_by_message_id_email($message_id,$user_id,$user_email,"tbl_message");
		
		
		if(empty($data["message_detail"]))
		{
			$this->session->set_flashdata('add', 'Please select correct message for message reply !'); 	
			redirect("message/message_list/r");
		}
		
		
		
		$data['sender_info'] = $this->user_model->get_user_detail_by_user_id($data['message_detail']['sender_id'],"tbl_user");
		
		
		
		
		
	  //pr($_POST);		
	  
		if($this->input->post('operation')!="")
		{
					
			if($this->input->post('to_email')=="")
			{
				$error .="Please enter the email !<br/>";
				$err['to_email'] = "Please enter the email !<br/>";
			}else{
		  
		  		if(!filter_var($this->input->post('to_email'), FILTER_VALIDATE_EMAIL)){
							$err['to_email']  = "Please enter valid  email!<br />";
				}
		     }
			
			
			if($this->input->post('subject')=="")
			{
					$error .="Please enter the subject !<br/>";
					$err['subject'] = "Please enter the subject !<br/>";
			}
						
				
			if($this->input->post('message')=="")
			{
				$error .="Please enter the message !<br/>";
				$err['message'] = "Please enter the message !<br/>";
			}	
		
		if(empty($err))
		{
				$receiver_id = "";
				
				//$message_data['receiver_id'] = $receiver_id;
				
				
				// may be we need so insert data also in reply table.
				$message_data['message_id'] = $this->uri->segment(3);
				$message_data['sender_id'] = $user_id;
				$message_data['to_email'] = $this->input->post("to_email");
				$message_data['subject'] = $this->input->post("subject");
				$message_data['message'] = $this->input->post("message");
				$message_data['message_ip_address'] = $this->input->post("message_ip_address");
				$message_data['date_time'] = date("Y-m-d H:i:s");
				$message_id = $this->message_model->add_message_reply($message_data,"tbl_message_reply");				
				
				$message_data['message_id_fk'] = $this->uri->segment(3);
				$message_data['message_sent_type'] = REPLY_MESSAGE_TYPE;
				
				unset($message_data['message_id']);				
				$this->message_model->add_message($message_data,"tbl_message");	
				
				
				$this->session->set_flashdata('add', "message send successfully!");
				
				$this->reply_message_email($message_data);
				$message = "message send successfully!";
				$_POST = "";
				redirect("message/message_list");
				
									
			}
	
	}
	
		$data['error'] =  $error;
		$data['err'] =  $err;
		$data['message'] =  $message;
		$data['title'] = 'ATTAKKA - Reply Message ';
		$this->load->view('front_template/front_header',$data);
		$this->load->view('front_template/header_navigation');
		$this->load->view('front_page/reply_message',$data);
		$this->load->view('front_template/front_footer2',$data);
	}
	
	
	function reply_message_email($post )
	{		
		// to_email  subject   message
		$session_data = get_session_data();
		
		$this->load->library('email');
		$config['mailtype']='html';
		$this->email->initialize($config);
		$this->email->from(ADMIN_FROM_EMAIL_ID, ADMIN_FROM_NAME);
		$this->email->to($post['to_email']);         
		$this->email->subject($post['subject']);				
		$message = 'Your friend '.$session_data['user_first_name'].' '.$session_data['user_last_name'].' send a message,<br /> <br /> message detail are following:  <br/> Subject:&nbsp;&nbsp;&nbsp;'.$post['subject'].'<br/> Message:&nbsp;&nbsp;&nbsp;'.$post['message'].'<br /><br />Regards,<br />Site Manager<br/>'.SITE_URL;
		$this->email->message($message);
		@$this->email->send();	
	}
	
	
	
	
}

/* End of file message.php */
/* Location: ./application/controllers/message.php */