<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	$this->load->helper('url'); 
	$cssbase = base_url()."assets/css/";
	$jsbase = base_url()."assets/js/";
	$img_base = base_url()."assets/images/";
	$base = base_url() . index_page();
?>

<?php echo '<link href="' . base_url() . 'assets/css/bootstrap.css" rel="stylesheet" type="text/css" />'; ?>


<!DOCTYPE>
<html>
<head><!-- ======================================================================================-->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Moylish Market</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="dist/css/custom-bs4.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="<?php echo $jsbase."common.js"?>"></script>
<link href="<?php echo $cssbase . "style.css"?>" rel="stylesheet" type="text/css" media="all" />

</head><!-- =====================================================================================-->

<body>
<header>
	<img src="<?php echo $img_base."site/logo2.jpg"?>"  width=100% class="img-fluid" alt="Responsive image">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  
	  <a class="navbar-brand" href="<?php echo base_url()?>index.php">Moylish Market</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
		  
			<?php if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['admin'] == 0) : ?>
				
				<!-- Navigation link ------------------------------------------------------------------------------------------->
				<li class="nav-item dropdown">
				  
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo ($this->session->userdata('logged_in')['contactFirstName'])?></a>
					
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					  <a class="dropdown-item" href="<?php echo base_url()?>index.php/CustomerController/editCustomer/<?php echo ($this->session->userdata('logged_in')['customerNumber'])?>">Update Details</a>
					  <div class="dropdown-divider"></div>
					  <a class="dropdown-item" href="<?php echo base_url()?>index.php/CustomerController/editPassword">Change password</a>
					</div>
					
				  </li>	  
				
				
				
				<!-- Navigation link ------------------------------------------------------------------------------------------->
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url()?>index.php/ProductController/listProduct">Shop</a>
				</li>
				
				<!-- Navigation link ------------------------------------------------------------------------------------------->
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url()?>index.php/WishlistController/WishlistList/<?php echo ($this->session->userdata('logged_in')['customerNumber'])?>">Wishlist</a>
				</li>
				
				<!-- Navigation link ------------------------------------------------------------------------------------------->
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url()?>index.php/ProductController/listCart/">Cart</a>
				</li>
				
				<!-- Navigation link ------------------------------------------------------------------------------------------->
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url()?>index.php/OrdersController/listByCustomer/<?php echo ($this->session->userdata('logged_in')['customerNumber'])?>">Orders</a>
				</li>
				
				<!-- Navigation link ------------------------------------------------------------------------------------------->
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url()?>index.php/CustomerController/logout">Log Out</a>
				</li>
					  
			<?php elseif($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['admin'] == 1) : ?>	  
			  
				<!-- Navigation dropdown menu ---------------------------------------------------------------------------------->
				  <li class="nav-item dropdown">
				  
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Products</a>
					
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					  <a class="dropdown-item" href="<?php echo base_url()?>index.php/ProductController/listProduct">Management</a>
					  <div class="dropdown-divider"></div>
					  <a class="dropdown-item" href="<?php echo base_url()?>index.php/ProductController/handleInsert">Add new</a>
					</div>
					
				  </li>	  
			  
				<!-- Navigation dropdown menu ---------------------------------------------------------------------------------->
				  <li class="nav-item dropdown">
				  
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Users</a>
					
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					  <a class="dropdown-item" href="<?php echo base_url()?>index.php/CustomerController/customerList">Management</a>
					  <div class="dropdown-divider"></div>
					  <a class="dropdown-item" href="<?php echo base_url()?>index.php/CustomerController/customerInsert">Add new</a>
					</div>
					
				  </li>	  
				
				<!-- Navigation link ------------------------------------------------------------------------------------------->
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url()?>index.php/OrdersController/listAllOrders">Orders</a>
				</li>
				
			  
				<!-- Navigation link ------------------------------------------------------------------------------------------->
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url()?>index.php/CustomerController/logout">Log Out</a>
				</li>
			  
			  
			<?php  else : ?>
			
				<!-- Navigation link ------------------------------------------------------------------------------------------->
				  <li class="nav-item">
					<a class="nav-link" href="<?php echo base_url()?>index.php/ProductController/listProduct">Products</a>
				  </li>	  
			  
				<!-- Navigation dropdown menu ---------------------------------------------------------------------------------->
				  <li class="nav-item dropdown">
				  
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sign In</a>
					
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					  <a class="dropdown-item" href="<?php echo base_url()?>index.php/CustomerController/index">Log In</a>
					  <div class="dropdown-divider"></div>
					  <a class="dropdown-item" href="<?php echo base_url()?>index.php/CustomerController/customerInsert">Register</a>
					</div>
					
				  </li>	  
				  
			<?php endif; ?>
		  
		 
		  
		</ul>
		
		
	  
	  </div>
	</nav>



</header>
