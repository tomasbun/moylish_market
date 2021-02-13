<?php
if (!defined('BASEPATH')) 
{
    exit('No direct script access allowed');
}

class OrdersModel extends CI_Model
{
    function __construct()
    {	
		parent::__construct();			
		$this->load->database();		
    }
		
	function get_all_orders($limit,$offset)						// OK used to display all for admin                    
	{	
		$this->db->limit($limit,$offset);
		$this->db->select("orderNumber,orderDate,requiredDate,shippedDate,status,comments,customerNumber");
		$this->db->from('orders');
		$query = $this->db->get();
		return $query->result();
	}
		
	function get_orders_by_status($limit,$offset,$status)		// OK used in drop down menu
	{
		$this->db->limit($limit,$offset);
		$this->db->select("orderNumber,orderDate,requiredDate,shippedDate,status,comments,customerNumber");
		$this->db->from('orders');
		$this->db->where('status', $status); 
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_orders_by_customer($limit,$offset,$customerID) // OK used to display for customer
	{
		$this->db->limit($limit,$offset);
		$this->db->select("orderNumber,orderDate,requiredDate,shippedDate,status,comments,customerNumber");
		$this->db->from('orders');
		$this->db->where('customerNumber', $customerID); 
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_orders_by_date($limit,$offset,$date)			// OK used to filter by date
	{
		$this->db->limit($limit,$offset);
		$this->db->select("orderNumber,orderDate,requiredDate,shippedDate,status,comments,customerNumber");
		$this->db->from('orders');
		$this->db->where('orderDate', $date); 
		$query = $this->db->get();
		return $query->result();
	}
	
	function orders_count($searchValue, $column)				// OK used to count search result
	{
		if ($searchValue == 0 && $column == 0)
			return $this->db->count_all('orders');
		else
			return $this->db->where($column,$searchValue)->count_all_results("orders");
	}
		
	function get_orders_by_number($limit,$offset,$criteria)   	// OK used to finds orders by number
	{
		$this->db->limit($limit,$offset);
		$this->db->select("orderNumber,orderDate,requiredDate,shippedDate,status,comments,customerNumber");
		$this->db->from('orders');
		//$this->db->where('productLine', $category);
		$this->db->like('orderNumber', $criteria, 'both'); 		
		$query = $this->db->get();
		return $query->result();
	}
	
	public function deleteOrder($orderNumber)					// OK
	{	
		$this->db->where('orderNumber', $orderNumber);
		return $this->db->delete('orders');
    }

	function updateOrder($order,$orderNumber)
	{	
		$this->db->where('ordernumber', $orderNumber);    
		return $this->db->update('orders', $order);
	}
	
	public function drilldown($produceCode)		
	{	
		$this->db->select("produceCode,description,productLine,supplier,quantityInStock,bulkBuyPrice,bulkSalePrice,Photo"); 
		$this->db->from('products');
		$this->db->where('produceCode',$produceCode);
		$query = $this->db->get();
		return $query->result();
    }

}
?>