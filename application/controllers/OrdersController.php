<?php 
if (!defined('BASEPATH')) 
{
	exit('No direct script access allowed');
}

class OrdersController extends CI_Controller 
{
	
    public function __construct()
    {
		parent::__construct();
		$this->load->model('OrdersModel');
		//$this->load->model('WishlistModel');
		$this->load->helper('form');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->library('cart');							
	}

   	public function listAllOrders()                 // OK
    {	
		//echo '<script> alert("this is Orders controller function"); </script>';
		$config['base_url']=site_url('OrdersController/listAllOrders/');	                       
		$config['total_rows']=$this->OrdersModel->orders_count(0,0);			                   
		$config['per_page']=5;												                   
		$this->pagination->initialize($config);								                   
		$data['order_info']=$this->OrdersModel->get_all_orders(20,$this->uri->segment(3));
		$this->load->view('OrdersListView',$data);
    }
	
	function listByStatus($status)					// OK 				
	{
		if($status == 'Hold')
			$status = 'On hold';
		elseif($status == 'Process')
			$status = 'In Process';
				
        $config['base_url']=site_url('OrdersController/listAllOrders/');	                       
		$config['total_rows']=$this->OrdersModel->orders_count($status,'status');			                   
		$config['per_page']=5;												                   
		$this->pagination->initialize($config);								                   
		$data['order_info']=$this->OrdersModel->get_orders_by_status(20,$this->uri->segment(5),$status); 
		$this->load->view('OrdersListView',$data);
    }
	
	function listByCustomer($customerID) 			// OK		
	{
		//echo '<script> alert('.$customerID.'); </script>';
		$config['base_url']=site_url('OrdersController/listAllOrders/');	                       
		$config['total_rows']=$this->OrdersModel->orders_count($customerID,'customerNumber');	

		//echo '<script> alert('.$config['total_rows'].'); </script>';
		
		$config['per_page']=5;												                   
		$this->pagination->initialize($config);								                   
		$data['order_info']=$this->OrdersModel->get_orders_by_customer(20,$this->uri->segment(5),$customerID); 
		$this->load->view('OrdersListView',$data);
    }
	
	function searchOrdersByDate()					// OK	
	{
		//var_dump($_POST);
		$criteria = $_POST['searchDay'];  
		//echo '<script> alert("this is criteria '.$_POST['search'].'"); </script>';
		$config['base_url']=site_url('OrdersController/listAllOrders/');	                       
		$config['total_rows']=$this->OrdersModel->orders_count($criteria,'orderDate');			                   
		$config['per_page']=5;												                   
		$this->pagination->initialize($config);								                   
		$data['order_info']=$this->OrdersModel->get_orders_by_date(20,$this->uri->segment(2), $criteria);
		$this->load->view('OrdersListView',$data);
	}
	
	function searchOrdersByNumber()					// OK				
	{
		//var_dump($_POST);
		$criteria = $_POST['search'];  
		//echo '<script> alert("this is criteria '.$_POST['search'].'"); </script>';
		$config['base_url']=site_url('OrdersController/listAllOrders/');	                       
		$config['total_rows']=$this->OrdersModel->orders_count($criteria,'orderNumber');			                   
		$config['per_page']=5;												                   
		$this->pagination->initialize($config);								                   
		$data['order_info']=$this->OrdersModel->get_orders_by_number(20,$this->uri->segment(5), $criteria);
		$this->load->view('OrdersListView',$data);
	}
	
    public function deleteOrder($orderNumber)     	// OK
    {	
		$deletedRows = $this->OrdersModel->deleteOrder($orderNumber);
		if ($deletedRows > 0)
		{
			$data['message'] = "$deletedRows Order has been deleted";
			$data['photo']="site/cancelled.png";
		}	
		else
		{
			$data['message'] = "There was an error deleting the order with an ID of $orderNumber";
			$data['photo']="site/problem.png";
			
		}
				
		$this->load->view('displayMessageView',$data);
    }

    public function updateOrder()     				// OK
    {	
		//var_dump($_POST);
		//echo '<script> alert("oh yes yes - '.$this->input->post('customerNumber').'"); </script>';
		$anOrder['orderNumber'] = $this->input->post('orderNumber');
		$anOrder['orderDate'] = $this->input->post('orderdate');
		$anOrder['requiredDate'] = $this->input->post('requireddate');
		$anOrder['shippedDate'] = $this->input->post('shippeddate');
		$anOrder['status'] = $this->input->post('status');
		$anOrder['comments'] = $this->input->post('comment');
		$anOrder['customerNumber'] = $this->input->post('customerNumber');
												
		if ($this->OrdersModel->updateOrder($anOrder, $anOrder['orderNumber'])) 
		{
			$data['message']="Record has been updated!";
			$data['photo']="site/updated.png";
		}
		else
		{
			$data['message']="Uh oh ... problem on updating order record!";
			$data['photo']="site/problem.png";
		}
		
		$this->load->view('displayMessageView', $data);
		return;		
    }

	public function processSelection()			    // OK
	{
		if ($_POST['action'] == 'update') 
		{
			$this->updateOrder();	
		}
		else
		{
			$this->deleteOrder($this->input->post('orderNumber'));
		} 
	}	

}