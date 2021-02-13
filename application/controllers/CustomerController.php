-<?php if ( ! defined('BASEPATH')) 
	{
		exit('No direct script access allowed');
	}

class CustomerController extends CI_Controller 
{
	
	public function __construct()	// OK
	{
		parent::__construct();
		$this->load->model('CustomerModel');
		$this->load->helper('form');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->helper('cookie');
		
	}
	
	function setMyCookie($email, $password)
	{
		$cookie= array
		(
			'name'   => "myCookie",
			'value'  => $email.' '.$password,
			'expire' => "3500",
		);	
		$this->input->set_cookie($cookie);
    }
	
	function getMyCookie()
	{
		return explode (" ",$this->input->cookie('myCookie',true));
		//return $this->input->cookie('myCookie',true);	
	}
		
	function index() 				// OK
	{
		if($this->session->userdata('logged_in'))
		{
			//the user is already logged in
			redirect('CustomerController/home');
		}
		else
		{
			//user isn't logged in
			$this->load->view('login_view');
		}
			
	}
		
	function home() 				
	{
		//var_dump($_POST);
		if($this->session->userdata('logged_in')) 
		{
			$session_data = $this->session->userdata('logged_in');
			$data['email'] = $session_data['email'];
			$this->load->view('index', $data);
		}
		else 
		{
			$this->load->view('login_view');
		}
	}
		
	function verify_login() 
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

		if($this->form_validation->run() == false) 
		{
			
			$this->load->view('login_view');				
		}
		else 
		{ 
			redirect('CustomerController/home');			
		}
	}
		
	function check_database($password) 
	{
		//var_dump($_POST);
		$email = $this->input->post('email');
		$result = $this->CustomerModel->login($email, $password);
	    
		//if a valid user write their id & name to session data
		if($result) 
		{
			$sess_array = array();
			foreach($result as $row) 
			{
				$sess_array = array(
					'customerNumber' => $row->customerNumber,
					'contactFirstName' => $row->contactFirstName,
					'customerName' => $row->customerName,
					'email' => $row->email,
					'admin' => $row->admin,
					'country' => $row->country
				);
				$this->session->set_userdata('logged_in', $sess_array);
				
				if($this->input->post('rememberMe') == 'ok')
					$this->setMyCookie($row->email, $password);
				
			}
			//return true -> we have a valid user
			return true;
		}
		else 
		{
			//return false ->we have an invalid user
			$this->form_validation->set_message('check_database', 'Ooops... looks like invalid username or password!');
			return false;
		}
	}
	
	function getInTouch()							
	{
		$this->load->view('GetInTouchView');
	}
	
	function editPassword()							
	{
		$this->load->view('resetPasswordView');
	}
	
	function verify_new_password()
	{
		$this->form_validation->set_rules('oldPassword', 'Old password', 'trim|required|callback_oldpassword_check');
		$this->form_validation->set_rules('newPassword', 'New password', 'trim|required');
		$this->form_validation->set_rules('repeatNewPassword', 'Repeat new password', 'trim|required|matches[newPassword]');

		if($this->form_validation->run() == false) 
		{
			
			$this->load->view('resetPasswordView');				
		}
		else 
		{ 
			$this->CustomerModel->change_password($this->session->userdata('logged_in')['email'],MD5($this->input->post('newPassword')));	
			$this->session->unset_userdata('logged_in');	//unset the session data
			$this->session->sess_destroy();	
			
			$data['message'] = "Password has been updated, please log in again";
			$data['photo']="site/success.png";
			$this->load->view('displayMessageView',$data);
				
		}
	}
	
	public function oldpassword_check($oldpass)			// OK
    {
			$result = $this->CustomerModel->login($this->session->userdata('logged_in')['email'], $oldpass);
			
                if ($result == false)
                {
                    $this->form_validation->set_message('oldpassword_check', 'Old password is incorrect!');
                    return FALSE;
                }
                else
                {
                    return TRUE;
                }
        }
		
	function logout() 									// Ok
	{
		$this->session->unset_userdata('logged_in');	//unset the session data
		$this->session->sess_destroy();					//destroy the session
		$this->load->view('login_view');				//load the login page
	}
	
	function getCustomerByNum() 						// OK
	{
        if ($this->input->post('submitCustomerNum')) 
		{
            $data = $this->CustomerModel->getCustomerByNum();

			//sessions 2018
			$this->session->set_userdata('customerName', $data['customerName']); 
			$this->session->set_userdata('contactFirstName', $data['contactFirstName']); 
			$this->session->set_userdata('contactLastName', $data['contactLastName']); 
			
			//link should appear in view
			//echo is only here to keep the example concise
			echo "<br>Session has been saved! <a href='" . 
				site_url('CustomerController/displaySessionData') . 
				"'>  Get the session from other page  </a>";
            return;
        }
        $this->load->view('getCustomerByNum');
    }
	
	function displaySessionData() 						// OK
	{
		$sessionData = $this->session->userdata();
		echo "Data currently stored in the session<br>";
		echo "Session ID: " 			. session_id() 				. "<br>";
		echo "IP Address: " 			. $_SERVER['REMOTE_ADDR'] 	. "<br>";
		echo "User Agent Info: " 		. $this->input->user_agent(). "<br>";
		echo "Customer number: "		. $sessionData['customerName']. "<br>"; 
		echo "Contact First Name: " 	. $sessionData['contactFirstName']. "<br>"; 
		echo "Contact Last Name: " 		. $sessionData['contactLastName']. "<br>"; 
	}
	
	public function customerInsert()					// OK
	{
		if ($this->input->post('submitInsert'))
		{					
			//set validation rules
			//$this->form_validation->set_rules('customerNumber', 'Customer number', 'required');
			$this->form_validation->set_rules('customerName', 'Customer Name', 'required');
			$this->form_validation->set_rules('contactLastName', 'Contact Last Name', 'required');
			$this->form_validation->set_rules('contactFirstName', 'Contact First Name', 'required');
			$this->form_validation->set_rules('phone', 'Phone', 'required');
			$this->form_validation->set_rules('addressLine1', 'address Line 1', 'required');
			$this->form_validation->set_rules('addressLine2', 'address Line 2', 'required');
			$this->form_validation->set_rules('city', 'City', 'required');
			$this->form_validation->set_rules('postalCode', 'Postal Code', 'required');
			$this->form_validation->set_rules('country', 'Country', 'required');
			//$this->form_validation->set_rules('creditLimit', 'Credit Limit', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			//get values from post
			//$aCustomer['customerNumber'] = $this->input->post('customerNumber');
			$aCustomer['customerName'] = $this->input->post('customerName');
			$aCustomer['contactLastName'] = $this->input->post('contactLastName');
			$aCustomer['contactFirstName'] = $this->input->post('contactFirstName');
			$aCustomer['phone'] = $this->input->post('phone');
			$aCustomer['addressLine1'] = $this->input->post('addressLine1');
			$aCustomer['addressLine2'] = $this->input->post('addressLine2');
			$aCustomer['city'] = $this->input->post('city');
			$aCustomer['postalCode'] = $this->input->post('postalCode');
			$aCustomer['country'] = $this->input->post('country');
			//$aCustomer['creditLimit'] = $this->input->post('creditLimit');
			$aCustomer['email'] = $this->input->post('email');
			$aCustomer['password'] = MD5($this->input->post('password'));
			
						
			//check if the form has passed validation
			if (!$this->form_validation->run())
			{
				//validation has failed, load the form again
				$this->load->view('registerView', $aCustomer);
				return;
			}

			//check if insert is successful
			if ($this->CustomerModel->insertCustomer($aCustomer)) 
			{
				$data['message']="Registration has been successful!";
				$data['photo']="site/registered.png";
			}
			else 
			{
				$data['message']="Uh oh ... problem with registration";
				$data['photo']="site/problem.png";
			}
			
			//load the view to display the message
			$this->load->view('displayMessageView', $data);
			
			return;
		}
		$aCustomer['customerNumber'] = "";
		$aCustomer['customerName'] = "";
		$aCustomer['contactLastName'] = "";
		$aCustomer['contactFirstName'] = "";
		$aCustomer['phone'] = "";
		$aCustomer['addressLine1'] = "";
		$aCustomer['addressLine2'] = "";
		$aCustomer['city'] = "";
		$aCustomer['postalCode'] = "";
		$aCustomer['country'] = "";
		$aCustomer['creditLimit'] = "";
		$aCustomer['email'] = "";
		$aCustomer['password'] = "";

		//load the form
		$this->load->view('registerView', $aCustomer);
	}
	
	public function editCustomer($customerNumber)       // OK
    {	
		$data['edit_data']= $this->CustomerModel->drilldown($customerNumber);
		$this->load->view('CustomerUpdateView', $data);
    }
	
	public function customerUpdate($customerNumber)    // OK
    {	
		//set validation rules
		//$this->form_validation->set_rules('customerNumber', 'Customer number', 'required');			//
		$this->form_validation->set_rules('customerName', 'Customer name', 'required');
		$this->form_validation->set_rules('contactLastName', 'Contact Last Name', 'required');	
		$this->form_validation->set_rules('contactFirstName', 'Contact First Name ', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');
		$this->form_validation->set_rules('addressLine1', 'Address Line 1', 'required');
		$this->form_validation->set_rules('addressLine2', 'Address Line 2', 'required');	
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('postalCode', 'Postal Code', 'required');
		$this->form_validation->set_rules('country', 'Country', 'required');
		//$this->form_validation->set_rules('creditLimit', 'Credit Limit', 'required');				//
		$this->form_validation->set_rules('email', 'Email', 'required');
		//$this->form_validation->set_rules('password', 'Password', 'required');	
		//$this->form_validation->set_rules('admin', 'Admin', 'required');							//
		//$this->form_validation->set_rules('disabled', 'disabled', 'required');						//
		
		
		
		//get values from post
		//$customerNumber = $this->input->post('customerNumber');
		$aCustomer['customerName'] = $this->input->post('customerName');
		$aCustomer['contactLastName'] = $this->input->post('contactLastName');
		$aCustomer['contactFirstName'] = $this->input->post('contactFirstName');
		$aCustomer['phone'] = $this->input->post('phone');
		$aCustomer['addressLine1'] = $this->input->post('addressLine1');
		$aCustomer['addressLine2'] = $this->input->post('addressLine2');
		$aCustomer['city'] = $this->input->post('city');
		$aCustomer['postalCode'] = $this->input->post('postalCode');
		$aCustomer['country'] = $this->input->post('country');
		//$aCustomer['creditLimit'] = $this->input->post('creditLimit');
		$aCustomer['email'] = $this->input->post('email');
		//$aCustomer['password'] = $this->input->post('password');
		//$aCustomer['admin'] = $this->input->post('admin');
		//$aCustomer['disabled'] = $this->input->post('disabled');
		

		//check if the form has passed validation
		if (!$this->form_validation->run())
		{
			//validation has failed, load the form again
			$this->load->view('CustomerUpdateView', $aCustomer);
			return;
		}
		
		//check if update is successful
		if ($this->CustomerModel->updateCustomer($aCustomer, $customerNumber))
        {
			$data['message']= $this->input->post('contactLastName')." record is updated!";
			$data['photo']="site/updated.png";
		}
		else 
		{
			$data['message']="Uh oh ah... problem on update";
			$data['photo']="site/problem.png";
		}
		$this->load->view('displayMessageView', $data);
		return;		
    }
	
	public function customerView($customerNumber)      // OK
    {	
    	$data['view_data']= $this->CustomerModel->drilldown($customerNumber); 
		$this->load->view('CustomerView', $data);
    }
	
    public function customerList()                  	// OK
    {	
		$config['base_url']=site_url('CustomerController/customerList/');	                        // here
		$config['total_rows']=$this->CustomerModel->record_count();			                       // here
		$config['per_page']=5;												                       // here
		$this->pagination->initialize($config);								                       // here
		$data['customer_info']=$this->CustomerModel->get_all_customers(20,$this->uri->segment(3)); // here
		$this->load->view('CustomerListView',$data);
    }

    public function customerEdit($customerNumber)      // OK
    {	
		$data['edit_data']= $this->CustomerModel->drilldown($customerNumber);
		$this->load->view('CustomerUpdateView', $data);
    }

    public function customerDelete($customerNumber)    // OK
    {	
		$deletedRows = $this->CustomerModel->deleteCustomer($customerNumber);
		if ($deletedRows > 0)
		{
				$data['message'] = "$deletedRows Customer has been deleted";
				$data['photo']="site/success.png";
		}
		else
		{
				$data['message'] = "There was an error deleting a customer with a number of $customerNumber";
				$data['photo']="site/problem.png";
		}
		$this->load->view('displayMessageView',$data);
    }	
	
}
