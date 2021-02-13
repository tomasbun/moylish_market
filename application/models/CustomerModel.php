<?php
if (!defined('BASEPATH')) 
{
    exit('No direct script access allowed');
}

class CustomerModel extends CI_Model
{
    function __construct()				// OK
    {	
		parent::__construct();
		$this->load->database();
    }
	
	function insertCustomer($customer)  // OK
	{	
		$this->db->insert('customers',$customer);
		if ($this->db->affected_rows() ==1) 
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	function getCustomerByNum()			// OK
	{
        $number = $this->input->post('customerNumber');
        $resultSet = $this->db->get_where('customers', array('customerNumber' => $number));
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
	
	function login($email, $password) 	// OK
	{
		$this -> db -> select('customerNumber, contactFirstName, customerName, email, admin, country');
		$this -> db -> from('customers');
		$this -> db -> where('email', $email);
		$this -> db -> where('password', MD5($password));
		
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		
		if($query -> num_rows() == 1) 
			return $query->result();
		else
			return false;
	}	
	
	function change_password($email, $password)
	{
		$data = array('password' => $password);
		$this->db->where('email', $email);
		$query =$this->db->update('customers', $data);
	}
	
	public function deleteCustomer($customerNumber)	
	{	
		$this->db->where('customerNumber', $customerNumber);
		return $this->db->delete('customers');
    }
	
	function updateCustomer($customer,$customerNumber)
	{	
		$this->db->where('customerNumber', $customerNumber);    
		return $this->db->update('customers', $customer);
	}
	
	function get_all_customers($limit,$offset)                     
	{	
		$this->db->limit($limit,$offset);
		$this->db->select("customerNumber ,customerName ,contactLastName, contactFirstName, phone,
							addressLine1 ,addressLine2, city , postalCode , country, 
							creditLimit, email, password, admin, disabled"); 
		$this->db->from('customers');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function drilldown($customerNumber)		
	{	
		$this->db->select("customerNumber ,customerName ,contactLastName, contactFirstName, phone,
							addressLine1 ,addressLine2, city , postalCode , country, 
							creditLimit, email, password, admin, disabled"); 
		$this->db->from('customers');
		$this->db->where('customerNumber',$customerNumber);
		$query = $this->db->get();
		return $query->result();
    }
	
	function record_count()
	{
		return $this->db->count_all('customers');
	}
	
}
?>