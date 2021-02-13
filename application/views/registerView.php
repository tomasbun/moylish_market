<?php
	$this->load->view('header'); 
	$this->load->helper('url');
	$this->load->helper('form');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/products/";
?>
<div class="container">

    <div class="row d-flex justify-content-center"> 
		<div class="col-md-12 ">
			<?php if($this->session->userdata('logged_in')['admin'] == 0) : 
				echo '<br><h1>Registration Form</h1><hr>';
			else :
				echo '<br><h1>Add New User</h1><hr>';
			endif; ?>
		</div>	
	</div>
	
   <div class="row d-flex justify-content-center"> 
			<?php echo form_open_multipart('CustomerController/customerInsert'); ?>
			<div class="col-md-12 ">	
				<div class="row ">
					<div class="col-md-4" >
						<?php
							echo '<h4>Customer Name:</h4>';
							echo form_input('customerName', $customerName);

							echo '</br></br><h4>Contact Last Name:</h4>';
							echo form_input('contactLastName', $contactLastName);

							echo '</br></br><h4>Contact First name:</h4>';
							echo form_input('contactFirstName', $contactFirstName);
							
							echo '</br></br><h4>Phone:</h4>';
							echo form_input('phone', $phone);
						?>
					</div>
					<div class="col-md-4" >
						<?php
							echo '<h4>Address Line 1:</h4>';
							echo form_input('addressLine1', $addressLine1);

							echo '</br></br><h4>Address Line 2:</h4>';
							echo form_input('addressLine2', $addressLine2);

							echo '</br></br><h4>City:</h4>';
							echo form_input('city', $city);
							
							echo '</br></br><h4>Postal Code:</h4>';
							echo form_input('postalCode', $postalCode);
						?>
					</div>
					<div class="col-md-4" >
						<?php
							echo '<h4>Country:</h4>';
							echo form_input('country', $country);
							
							echo '</br></br><h4>Email:</h4>';
							echo form_input('email', $email);
							
							echo '</br></br><h4>Password:</h4>';
							echo form_input('password', $password);
						?>
					</div>
				</div>
			</div>
	</div>				
	
	<div class="row d-flex justify-content-center">
		<div class="col-md-12"><hr>
			<?php
				echo form_submit('submitInsert', "Submit!");
				echo form_close();
				echo validation_errors();
			?>
   		<hr></div>										
	</div>			
		
</div>

<?php
	$this->load->view('footer'); 
?>