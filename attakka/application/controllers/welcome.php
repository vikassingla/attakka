<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller 
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
		$data['title'] = 'ATTAKKA - Home';
		$this->load->view('front_template/front_header',$data);
		$this->load->view('front_template/header_navigation');
		$this->load->view('front_template/header_search');
		$this->load->view('front_page/home',$data);
		$this->load->view('front_template/front_footer',$data);
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */