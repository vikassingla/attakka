<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Banner extends CI_Controller 
{ 
	public function __construct()
	{ 
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');	
		$this->load->helper('common');	
		$this->load->library('session');	   
		$this->load->model('category_model');
		$this->load->model('banner_model');		
		$this->load->model('user_model');		
	}
	
	// this method is used for the show list banner 
	public function index()
	{
		// check admin login or not
		validation_login();		
		$data = array();		
		$data['title'] = "Banner List";
		$error = "";
		$message = "";
		$post = $this->input->post();		
		$table_name = "tbl_banner";
		$offset = $this->uri->segment(3);
		if(!$offset)
			$offset=0;
		$data['site_data'] = $this->banner_model->get_banner_list_with_limit($table_name,$offset);		
		$data['offset'] = $offset;
        $this->load->library('pagination');
        $config['base_url'] = base_url().'banner/index/';
		$config['total_rows'] = $this->banner_model->count_total_banner($table_name);
		$config['per_page'] = PER_PAGE_ADMIN_VIEW;
        $this->pagination->initialize($config);
		$data['site_data_pagination'] = $this->pagination->create_links();
		
		$data['error'] = $error;
		$data['message'] = $message;
		$this->load->view('admin_template/admin_header',$data);
		$this->load->view('admin_pages/banner_list');
		$this->load->view('admin_template/admin_footer');
	}
	
	// this method is used for the active inactive
	function active_inactive()
	{
		$banner_id = $this->uri->segment(3);
		$banner_status = $this->uri->segment(4);
		$table_name = "tbl_banner";
		$update_data = array(
							 "banner_id"=>$banner_id,
							 "banner_status"=>$banner_status
							 );
		
		$this->banner_model->active_inactive_banner($table_name,$update_data,$banner_id);
		if($banner_status==0)
		{
			$this->session->set_flashdata('add', 'Banner inactive successfully!'); 	
			redirect("banner");
		}
		if($banner_status==1)
		{
			$this->session->set_flashdata('add', 'Banner active successfully!'); 	
			redirect("banner");	
		}
		
		
		
	}
		
	function add_banner()
	{
			// check admin login or not
		validation_login();
		$session_data = get_session_data();
		
		$data = array();		
		$data['title'] = "Add Banner";
		$error = "";
		$message = "";
		$post = $this->input->post();
		
		if($this->input->post('operation')!="")
		{
			
			if($this->input->post('banner_title')=="")
			{
				$error .="Please enter the banner title !<br/>";
			}
			
			
			
			if($_FILES['banner_image_name']['name']!="")
			{
				$file_name = time()."-".$_FILES['banner_image_name']['name'];
				$banner_data['banner_image_name'] = $file_name;
				$config['file_name'] = $file_name;
				$config['upload_path'] = './banner_image/';
				$config['allowed_types'] = 'gif|jpg|png';
				//$config['max_size']	= '1000';
				//$config['max_width']  = '1024';
				//$config['max_height']  = '1024';
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('banner_image_name'))
				{
					$upload_error =  $this->upload->display_errors();
					$error .= $upload_error;
					//pr($upload_error);
					//pr($_FILES);
					//die;
					
				}
			
			}else{
				$error .= "Please select image";	
			}
			
			
			if($error=="")
			{
				$banner_data['created_by'] = BANNER_CREATED_BY_ADMIN;
				$banner_data['creator_id'] = $session_data['admin_id'];				
				$banner_data['banner_title'] = $this->input->post("banner_title");
				$banner_data['banner_price'] = $this->input->post("banner_price");
				$banner_data['date_time'] = date("Y-m-d H:i:s");
				$banner_data['banner_status'] = 1;
				$banner_id = $this->banner_model->add_banner($banner_data , "tbl_banner");				
				
				
				
				//$this->upload_category_image($_FILES,$category_id);
				
				$this->session->set_flashdata('add', 'Banner add successfully!'); 	
				redirect("banner");
				
									
			}
				
		}
		
		$data['error'] = $error;
		$data['message'] = $message;
		$this->load->view('admin_template/admin_header',$data);
		$this->load->view('admin_pages/add_banner');
		$this->load->view('admin_template/admin_footer');
	}
		
	function edit_banner()
	{
		// check admin login or not
		validation_login();
		$session_data = get_session_data();
		$data = array();		
		$data['title'] = "Edit Banner";
		$error = "";
		$message = "";
		$post = $this->input->post();
		if($this->uri->segment(3)=="")
		{
			redirect("banner");	
		}
		$banner_id = $this->uri->segment(3);		
		$data['banner_data'] = $this->banner_model->get_banner_detail($banner_id,"tbl_banner");
		
				
		if($this->input->post('operation')!="")
		{
			
			if($this->input->post('banner_title')=="")
		   {
				$error .= "Please enter the banner title !<br/>";
		   }
			
			if($_FILES['banner_image_name']['name']!="")
			{
				$file_name = time()."-".$_FILES['banner_image_name']['name'];
				
				$banner_data['banner_image_name'] = $file_name;
				$config['file_name'] = $file_name;
				$config['upload_path'] = './banner_image/';
				$config['allowed_types'] = 'gif|jpg|png';
				//$config['max_size']	= '1000';
				//$config['max_width']  = '1024';
				//$config['max_height']  = '1024';
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('banner_image_name'))
				{
					$upload_error =  $this->upload->display_errors();
					$error .=  $upload_error;
					//pr($upload_error);
					//pr($_FILES);
					//die;
					
				}
			
			}
			
			if($error=="")
			{
				$banner_data['creator_id'] = $session_data['admin_id'];	
				$banner_data['created_by'] = BANNER_CREATED_BY_ADMIN;
				$banner_data['banner_id'] = $this->uri->segment(3);
				$banner_data['banner_title'] = $this->input->post("banner_title");
				$banner_data['banner_price'] = $this->input->post("banner_price");
				$banner_data['date_time'] = date("Y-m-d H:i:s");
				$this->banner_model->edit_banner($banner_data , "tbl_banner");		
				//$this->upload_category_image_edit($_FILES,$category_id,$category_image_data);
				$this->session->set_flashdata('add', 'Banner edit successfully!'); 	
				redirect("banner");
			}
				
		}
		
		$data['error'] = $error;
		$data['message'] = $message;
		$this->load->view('admin_template/admin_header',$data);
		$this->load->view('admin_pages/edit_banner');
		$this->load->view('admin_template/admin_footer');
	}
	
}
/* End of file banner.php */
/* Location: ./application/controllers/banner.php */