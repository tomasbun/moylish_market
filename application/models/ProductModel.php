<?php
if (!defined('BASEPATH')) 
{
    exit('No direct script access allowed');
}

class ProductModel extends CI_Model
{
    function __construct()
    {	
		parent::__construct();			
		$this->load->database();		
    }
	
	// OK
	function insertProductModel($produceCode)               
	{	
		$this->db->insert('products',$produceCode);
		if ($this->db->affected_rows() ==1) 
		{
            return true;
		}
		else 
		{
            return false;
		}
	}

	public function deleteProductModel($produceCode)	
	{	
		$this->db->where('produceCode', $produceCode);
		return $this->db->delete('products');
    }
	
	function updateProductModel($product,$produceCode)
	{	
		$this->db->where('produceCode', $produceCode);    
		return $this->db->update('products', $product);
	}

	function get_all_products($limit,$offset)                     
	{	
		$this->db->limit($limit,$offset);
		$this->db->select("produceCode,description,productLine,supplier,quantityInStock,bulkBuyPrice,bulkSalePrice,Photo");
		$this->db->from('products');
		$query = $this->db->get();
		return $query->result();
	}
	
	function search_all_products($limit,$offset,$criteria)
	{
		//$this->db->limit($limit,$offset);
		$this->db->select("produceCode,description,productLine,supplier,quantityInStock,bulkBuyPrice,bulkSalePrice,Photo");
		$this->db->from('products');
		//$this->db->where('productLine', $category);
		$this->db->like('description', $criteria, 'both'); 		
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_product_category($limit,$offset,$category)
	{
		$this->db->limit($limit,$offset);
		$this->db->select("produceCode,description,productLine,supplier,quantityInStock,bulkBuyPrice,bulkSalePrice,Photo");
		$this->db->from('products');
		$this->db->where('productLine', $category); 
		$query = $this->db->get();
		return $query->result();
	}
	
	public function drilldown($produceCode)		
	{	
		$this->db->select("produceCode,description,productLine,supplier,quantityInStock,bulkBuyPrice,bulkSalePrice,Photo"); 
		$this->db->from('products');
		$this->db->where('produceCode',$produceCode);
		$query = $this->db->get();
		return $query->result();
    }
	
	function record_count()
	{
		return $this->db->count_all('products');
	}
}
?>