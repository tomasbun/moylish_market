<?php
if (!defined('BASEPATH')) 
{
    exit('No direct script access allowed');
}

class WishlistModel extends CI_Model
{
    function __construct()
    {	
		parent::__construct();			
		$this->load->database();		
    }
	
	function WishlistInsert($aWishlistItem)               
	{	
		$this->db->insert('wishlist',$aWishlistItem);
		if ($this->db->affected_rows() ==1) 
		{
            return true;
		}
		else 
		{
            return false;
		}
	}

	function record_count($customerID)
	{
		$result = $this->db->where('customerID',$customerID)->from("wishlist")->count_all_results();
		//echo '<script> alert("this is output: '.$result.' !"); </script>';
		
		return $result;
	}
	
	function getItemID($id)
	{
		$resultSet = $this->db->get_where('wishlist', array('ID' => $id));
        if ($resultSet->num_rows() > 0 ) 
		{
			$row = $resultSet->row_array();
            return $row;
        }
        else 
		{
			
            return null;
        }
    }
	
	function get_all_items($limit,$offset,$customerID)                     
	{	
		$this->db->limit($limit,$offset);
		$this->db->select("ID, productID, quantity, total, photo, productCode");
		$this->db->where('customerID',$customerID);
		$this->db->from('wishlist');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function WishlistRemove($itemID)	
	{	
		$this->db->where('ID', $itemID);
		return $this->db->delete('wishlist');
    }
	
}
?>