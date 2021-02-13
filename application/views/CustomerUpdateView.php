<?php
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/products/";
?>

<div class="container">

    <div class="row d-flex justify-content-center"> 
		<div class="col-md-12 ">
			<h1><br>Update Customer Details</h1><hr>
		</div>
	</div>

	<div class="row d-flex justify-content-center">
			<?php
			foreach ($edit_data as $row) 
			{  	
				echo form_open_multipart('CustomerController/customerUpdate/'.$row->customerNumber);
			?>
		
			<div class="col-md-12 ">	
				<div class="row ">
					
					<div class="col-md-4" >	
							<?php
								echo 'Customer Name:</br>';
								echo form_input('customerName', $row->customerName);			// 1

								echo '</br></br> Contact Last Name:</br>';
								echo form_input('contactLastName', $row->contactLastName);		// 2

								echo '</br></br>Contact First name:</br>';
								echo form_input('contactFirstName', $row->contactFirstName);	// 3
														
								echo '</br></br>Phone:</br>';
								echo form_input('phone', $row->phone);							// 4
							?>		
					</div>
					
					<div class="col-md-4" >
							<?php
								echo 'Address Line 1:</br>';
								echo form_input('addressLine1', $row->addressLine1);			// 5
															
								echo '</br></br>Address Line 2:</br>';
								echo form_input('addressLine2', $row->addressLine2);			// 6
											
								echo '</br></br>City:</br>';
								echo form_input('city', $row->city);							// 7
								
								echo '</br></br>PostalCode:</br>';
								echo form_input('postalCode', $row->postalCode);				// 8
							?>
					</div>
					
					<div class="col-md-4" >
							<?php
							echo 'Country:</br>';
							echo form_input('country', $row->country);						// 9
							
							echo '</br></br>Email:</br>';
							echo form_input('email', $row->email);							// 10
							echo '</br></br>';
							//echo '</br></br>Password: ';								
							//echo form_input('password', $row->password);					// 11
							?>
					</div>
				</div>
			</div>
	</div>
	
	<div class="row d-flex justify-content-center">
		<div class="col-md-12"><hr>
			<?php echo form_submit('submitInsert', "Submit!"); ?>
			<?php echo form_close(); ?>
			<?php echo validation_errors(); ?>
			<?php } ?>
		<hr></div>
	</div>
		
</div>


<?php
	$this->load->view('footer'); 
?>