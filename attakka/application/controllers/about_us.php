<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About_us extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');	
		$this->load->helper('common');	
		$this->load->library('session');	   
		
	}
	
	
	public function index()
	{		
	    $data = array();
		$data['title'] = 'ATTAKKA - About Us';
		$this->load->view('front_template/front_header',$data);
		$this->load->view('front_template/header_navigation');
		$this->load->view('front_template/header_search');
		$this->load->view('front_page/about_us');
		$this->load->view('front_template/front_footer');
	}
	
}

/* End of file about_us.php */
/* Location: ./application/controllers/about_us.php */