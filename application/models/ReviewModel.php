<?php
if (!defined('BASEPATH')) 
{
    exit('No direct script access allowed');
}

class ReviewModel extends CI_Model
{
    function __construct()
    {	
		parent::__construct();			
		$this->load->database();		
    }
	
	function review_count($productID)
	{
		return $this->db->where('productID',$productID)->from("reviews")->count_all_results();
		
		//$this->db->count_all('reviews');
		//$this->db->where('productID',$productID);
		//$query = $this->db->get();
		//$query->result();
	}
}
?>