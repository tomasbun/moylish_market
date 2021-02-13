<?php
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/products/";
?>

<script>function goBack() {window.history.back();}</script>

<div class='container'>
	<?php foreach ($view_data as $row) { ?>
	
	<br>
	
	<div class="col-12 d-flex justify-content-center" >
		<h3><?php echo '<H1> Customer '.($row->customerNumber).'</h1>' ?></h3>
	</div>
	
	<hr><br>
	
	<div class="row">
	
		<div class="col-md-12">
		
			<div class="row">
				<div class="col-md-4" >
					 <?php
						echo 'Customer Name : <h4>'.$row->customerName. '</h4>';
						echo 'Contact: <h4>' .$row->contactLastName.' '.$row->contactFirstName.'</h4> ';	
					?>
					
				</div>
				
				<div class="col-md-4" >
					 <?php
						echo 'Address: <h4>' .$row->addressLine1.' '.$row->addressLine2.'</h4>';
						echo '<h4>' .$row->city.' ,'.$row->country.'</h4>';
						echo 'Postal code: <h4>' .$row->postalCode.'</h4>';
					?>
				</div>
				
				<div class="col-md-4">
				 
					 <?php
						echo 'Phone: <h4>' .$row->phone. '</h4>  ';
						echo 'Email: </br><h4>'.$row->email. '</h4> ';
						echo 'CreditLimit:  </br><h4>'.$row->creditLimit.'</h4>  ';
					?>
					
				</div>
			</div>
			<div class="row">
			
				<a class="btn btn-danger" href="<?php echo base_url()?>index.php/CustomerController/resetPassword">Reset password</a>
					
				<a class="btn btn-warning" href="<?php echo base_url()?>index.php/CustomerController/editCustomer/<?php echo $row->customerNumber?>">Update details</a>
			</div>
			
			
		
	
		</div>

	</div>
	
	<hr><br>
	<div class="col-12 d-flex justify-content-center" >
		<button type="button" class="btn btn-outline-secondary" onclick="goBack()">Back</button>
	</div>	
	<br>
	
	<?php } ?>
	
</div>

<?php
	$this->load->view('footer'); 
?>