<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Terms_and_condition extends CI_Controller 
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
		$data['title'] = 'ATTAKKA - Login';
		$this->load->view('front_template/front_header',$data);		
		$this->load->view('front_template/header_navigation');
		$this->load->view('front_template/header_search');
		$this->load->view('front_page/terms_and_condition');
		$this->load->view('front_template/front_footer');
	}
	
}

/* End of file terms_and_condition.php */
/* Location: ./application/controllers/terms_and_condition.php */