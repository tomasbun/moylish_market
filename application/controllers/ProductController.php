<?php if (!defined('BASEPATH')) 
	{
		exit('No direct script access allowed');
	}

class ProductController extends CI_Controller 
{
	
    public function __construct()
    {
		parent::__construct();
		$this->load->model('ProductModel');
		$this->load->model('WishlistModel');
		$this->load->helper('form');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->library('cart');							
	}

    public function index()                        
    {	
		$this->load->view('index');								// $this->load->view('products/index', $data);
    }

	function addToCart()							// OK				   
	{
        $produceCode = $this->input->post('productCode');
		$quantity = $this->input->post('quantity');
		$price = $this->input->post('price');
		$description = $this->input->post('product');
		$photo = $this->input->post('photo');
		
        $itemdata = array('id'=>$produceCode, 'qty'=>$quantity, 'price'=>$price, 'name'=>$description, 'photo'=>$photo);
        $this->cart->insert($itemdata);
		
		$data['message'] = $quantity.' '.$description." now added to your shoping cart!";
		$data['photo']="site/cart2.png";
		$this->load->view('displayMessageView',$data);   
    }

	function UpdateCartPost()   					// OK
	{
		//print_r($_POST);
		//foreach($_POST as $key => $value) 
		//echo $value[rowid].' '.$value[qty];
			
		$this->cart->update($_POST);
		$this->listCart();
	}
	
	function RemoveFromCart($id)   					// OK
	{
		$data = array(
        'rowid' => $id,
        'qty'   => 0
			);
			
		$this->cart->update($data);
		$this->listCart();
	}
	
	function ClearCart()							// OK
	{
		$this->cart->destroy();
		$this->listCart();
	}
	
	function WishlistInsert()     					// OK            
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
	
    public function viewProduct($produceCode)       // OK
    {	
    	$data['view_data']= $this->ProductModel->drilldown($produceCode); 
		$this->load->view('ProductView', $data);
    }
	
    public function listProduct()                   // OK
    {	
		$config['base_url']=site_url('ProductController/listProduct/');	                       
		$config['total_rows']=$this->ProductModel->record_count();			                   
		$config['per_page']=5;												                   
		$this->pagination->initialize($config);								                   
		$data['product_info']=$this->ProductModel->get_all_products(20,$this->uri->segment(3));
		$this->load->view('ProductListView',$data);
    }
	
	function listCategory($category) 				// OK
	{
		if($category == 'Baked')
			$category = 'Baked Goods';
		elseif($category == 'Eggs')
			$category = 'Eggs & Dairy';
		elseif($category == 'Exotic')
			$category = 'Exotic Fruit';
		elseif($category == 'Jams')
			$category = 'Jams and Preserves';
		
        $config['base_url']=site_url('ProductController/listProduct/');	                       
		$config['total_rows']=$this->ProductModel->record_count();			                   
		$config['per_page']=5;												                   
		$this->pagination->initialize($config);								                   
		$data['product_info']=$this->ProductModel->get_product_category(20,$this->uri->segment(3),$category); 
		$this->load->view('ProductListView',$data);
    }
	
	function searchProduct()						// OK
	{
		//var_dump($_POST);
		$criteria = $_POST['search'];  
		//echo '<script> alert("this is criteria '.$_POST['search'].'"); </script>';
		$config['base_url']=site_url('ProductController/listProduct/');	                       
		$config['total_rows']=$this->ProductModel->record_count();			                   
		$config['per_page']=5;												                   
		$this->pagination->initialize($config);								                   
		$data['product_info']=$this->ProductModel->search_all_products(20,$this->uri->segment(2), $criteria);
		$this->load->view('ProductListView',$data);
	}
	
	public function listCart()                      // OK
    {	
		$x = $this->cart->total();
		if($x == 0)
		{
			$data['message']="Your cart is very empty!!!";
			$data['photo']="site/cart3.png";
			$this->load->view('displayMessageView', $data);
		}
		else	
			$this->load->view('CartListView');
    }

    public function editProduct($produceCode)       // OK
    {	
		$data['edit_data']= $this->ProductModel->drilldown($produceCode);
		$this->load->view('updateProductView', $data);
    }

    public function deleteProduct($produceCode)     // OK
    {	
		$deletedRows = $this->ProductModel->deleteProductModel($produceCode);
		if ($deletedRows > 0)
				$data['message'] = "$deletedRows Product has been deleted";
		else
				$data['message'] = "There was an error deleting the product with an ID of $produceCode";
		$this->load->view('displayMessageView',$data);
    }

    public function updateProduct($produceCode)     // OK
    {	
		$pathToFile = $this->uploadAndResizeFile();
		$this->createThumbnail($pathToFile);

		//set validation rules
		$this->form_validation->set_rules('produceCode', 'Produce Code', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('productLine', 'Product line', 'required');	
		$this->form_validation->set_rules('supplier', 'Supplier', 'required');
		$this->form_validation->set_rules('quantityInStock', 'Quantity in stock', 'required');
		$this->form_validation->set_rules('bulkBuyPrice', 'Bulk buy price', 'required');
		$this->form_validation->set_rules('bulkSalePrice', 'Bulk sale price', 'required');	
		
		//get values from post
		$produceCode = $this->input->post('produceCode');
		$aProduct['description'] = $this->input->post('description');
		$aProduct['productLine'] = $this->input->post('productLine');
		$aProduct['supplier'] = $this->input->post('supplier');
		$aProduct['quantityInStock'] = $this->input->post('quantityInStock');
		$aProduct['bulkBuyPrice'] = $this->input->post('bulkBuyPrice');
		$aProduct['bulkSalePrice'] = $this->input->post('bulkSalePrice');
		$aProduct['Photo'] = $_FILES['userfile']['name'];

		//check if the form has passed validation
		if (!$this->form_validation->run())
		{
			//validation has failed, load the form again
			$this->load->view('updateProductView', $aProduct);
			return;
		}
		
		//check if update is successful
		if ($this->ProductModel->updateProductModel($aProduct, $produceCode))
        {
			$data['message']="Product info updated!";
			$data['photo']="site/updated.png";
		}
		else 
		{
			$data['message']="Uh oh ah... could not add new product!";
			$data['photo']="site/problem.png";
		}
		$this->load->view('displayMessageView', $data);
		return;
    }

    public function handleInsert()                  // OK
    {
		if ($this->input->post('submitInsert'))
        {
            $pathToFile = $this->uploadAndResizeFile();
            $this->createThumbnail($pathToFile);
				
            //set validation rules
            $this->form_validation->set_rules('produceCode', 'Produce Code', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('productLine', 'Product line', 'required');	
            $this->form_validation->set_rules('supplier', 'Supplier', 'required');
            $this->form_validation->set_rules('quantityInStock', 'Quantity in stock', 'required');
            $this->form_validation->set_rules('bulkBuyPrice', 'Bulk buy price', 'required');
            $this->form_validation->set_rules('bulkSalePrice', 'Bulk sale price', 'required');	
            //$this->form_validation->set_rules('Photo', 'Photo', 'required');
			
	
            //get values from post
            $aProduct['produceCode'] = $this->input->post('produceCode');
            $aProduct['description'] = $this->input->post('description');
            $aProduct['productLine'] = $this->input->post('productLine');
            $aProduct['supplier'] = $this->input->post('supplier');
            $aProduct['quantityInStock'] = $this->input->post('quantityInStock');
            $aProduct['bulkBuyPrice'] = $this->input->post('bulkBuyPrice');
            $aProduct['bulkSalePrice'] = $this->input->post('bulkSalePrice');
            $aProduct['Photo'] = $_FILES['userfile']['name'];
			
            //check if the form has passed validation
            if (!$this->form_validation->run())
            {
				//validation has failed, load the form again
				$this->load->view('insertProductView', $aProduct);
				return;
            }

            //check if insert is successful
            if ($this->ProductModel->insertProductModel($aProduct)) 
            {
				$data['message']="New product added to shop list!";
				$data['photo']="site/newproduct.png";
            }
            else
            {
				$data['message']="Uh oh ... Bummer, could not add new product!";
				$data['photo']="site/problem.png";
            }
			
            //load the view to display the message
            $this->load->view('displayMessageView', $data);
			
            return;
		}
	
		$aProduct['produceCode'] = "";
		$aProduct['description'] = "";
		$aProduct['productLine'] = "";
		$aProduct['supplier'] = "";;
		$aProduct['quantityInStock'] = "";
		$aProduct['bulkBuyPrice'] = "";
		$aProduct['bulkSalePrice'] = "";
		$aProduct['Photo'] = "";

		//load the form
		$this->load->view('insertProductView', $aProduct);
    }

	function uploadAndResizeFile()                  // OK
	{	
		//set config options for thumbnail creation
		$config['upload_path']='./assets/images/products/full/';
		$config['allowed_types']='gif|jpg|png';
		$config['max_size']='200';
		$config['max_width']='1024';
		$config['max_height']='768';
		
		$this->load->library('upload',$config);
		if (!$this->upload->do_upload())
			echo $this->upload->display_errors();
		else
			echo 'upload done<br>';	
	
		$upload_data = $this->upload->data();
		$path = $upload_data['full_path'];
		
		$config['source_image']=$path;
		$config['maintain_ratio']='FALSE';
		$config['width']='345';
		$config['height']='186';

		$this->load->library('image_lib',$config);
		if (!$this->image_lib->resize())
			echo $this->image_lib->display_errors();
		else
			echo 'image resized<br>';
			
		$this->image_lib->clear();
		return $path;
	}
	
	function createThumbnail($path)                 // OK
	{	
		//set config options for thumbnail creation
		$config['source_image']=$path;
		$config['new_image']='./assets/images/products/thumbs/';
		$config['maintain_ratio']='FALSE';
		$config['width']='145';
		$config['height']='78';
		
		//load library to do the resizing and thumbnail creation
		$this->image_lib->initialize($config);
		
		//call function resize in the image library to physiclly create the thumbnail
		if (!$this->image_lib->resize())
			echo $this->image_lib->display_errors();
		else
			echo 'thumbnail created<br>';	
	}
	
	public function processSelection()			    // OK
	{
			if ($_POST['action'] == 'wishlist') 
			{
				$this->WishlistInsert();	
			}
			else if ($_POST['action'] == 'cart')
			{
				$this->addToCart();
			} 
			else
			{
				//invalid action!
			}
	}	
	
}