<?php if (!defined('BASEPATH')) 
	{
		exit('No direct script access allowed');
	}

class WishlistController extends CI_Controller 
{
	
    public function __construct()
    {
		parent::__construct();
		$this->load->model('WishlistModel');
		$this->load->helper('form');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->library('cart');		
    }

    public function WishlistInsert()			// OK                 
    {	
				$aWishlistItem['customerID'] = $this->input->post('customer');
				$aWishlistItem['productID'] = $this->input->post('product');
				$aWishlistItem['quantity'] = $this->input->post('quantity');
				$aWishlistItem['total'] =  $aWishlistItem['quantity'] * $this->input->post('price');
				$aWishlistItem['photo'] = $this->input->post('photo');
				$aWishlistItem['productCode'] = $this->input->post('productCode');
												
				if ($this->WishlistModel->WishlistInsert($aWishlistItem)) 
				{
					$data['message']=$aWishlistItem['quantity'].' '.$aWishlistItem['productID']." were added to your Wishlist!";
					$data['photo']="site/wishlist1.jpg";
				}
				else
				{
					$data['message']="Uh oh ... problem on adding to Wishlist!";
					$data['photo']="site/problem.png";
					
				}
				$this->load->view('displayMessageView', $data);
				return;		
    }

	public function WishlistList($customerID)	// OK
	{
		$config['base_url']=site_url('WishlistController/WishlistList/');	                       
		$config['total_rows']=$this->WishlistModel->record_count($customerID);
		
		if($config['total_rows'] == 0)
		{
			$data['message']="Your wishlist is very empty!!!";
			$data['photo']="site/wishlistEmpty.png";
			$this->load->view('displayMessageView', $data);
		}
		else
		{
			$config['per_page']=5;												               
			$this->pagination->initialize($config);								               
			$data['wishlist_info']=$this->WishlistModel->get_all_items(20,$this->uri->segment(2),$customerID);
			$this->load->view('WishlistListView',$data);
		}
		
	}
	
	public function WishlistRemove($itemID)    	// OK
    {	
		$deletedRows = $this->WishlistModel->WishlistRemove($itemID);
		if ($deletedRows > 0)
		{
				$data['message'] = "$deletedRows Item has been removed from wishlist.";
				$data['photo']="site/success.png";
		}
		else
		{
				$data['message'] = "There was an error removing item from your wishlist.";
				$data['photo']="site/problem.png";
				
		}
		$this->load->view('displayMessageView',$data);
    }

	function RemoveAddToCart($thisID)			// OK
	{
		$cartItem = $this->WishlistModel->getItemID($thisID);
		$itemdata = array('id'=>$cartItem['productCode'], 'qty'=>$cartItem['quantity'], 'price'=>$cartItem['total'], 'name'=>$cartItem['productID'], 'photo'=>$cartItem['photo']);
		$this->cart->insert($itemdata);
		$deletedRows = $this->WishlistModel->WishlistRemove($thisID);
		
		$data['message'] = $cartItem['quantity'].' '.$cartItem['productID']. 'now added to your cart!';
		$data['photo']="site/cart2.png";
		$this->load->view('displayMessageView',$data);
		
		
		
	}	
}