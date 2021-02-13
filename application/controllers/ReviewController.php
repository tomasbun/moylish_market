<?php if (!defined('BASEPATH')) 
	{
		exit('No direct script access allowed');
	}

class ReviewController extends CI_Controller 
{
	 //public $CI = NULL;
	
    public function __construct()
    {
		parent::__construct();
		$this->load->model('ProductModel');
		$this->load->model('ReviewModel');
		$this->load->helper('form');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->library('cart');
		//$this->CI = & get_instance();		
	}
		
    public function countReviews($productID)
    {	
		return $this->ReviewModel->review_count($productID);			                   
	}	
	
	public function listReviews($productID) 
	{	
		$data['review_info']=$this->ReviewModel->get_reviews($productID);
		$this->load->view('animalListView',$data);
	}
		
    
}