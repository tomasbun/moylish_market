<?php
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>
<div class="container">
    
	<div class="row d-flex justify-content-center"> 
		<h1>Password change</h1><br><br>
	</div>
   
    <div class="row d-flex justify-content-center">
	<?php echo validation_errors();?>
   </div>
   
   <div class="row d-flex justify-content-center">
	
		
		<?php
				echo form_open('CustomerController/verify_new_password'); 
				
				echo "<hr>Old password:<br>";
				echo form_input('oldPassword');
				
				echo "<br><br>New password:<br>";
				echo form_password('newPassword');
				
				echo "<br><br>Repeat new password:<br>";
				echo form_password('repeatNewPassword');
				echo "<hr>";	
		?>
	</div>
	
	<div class="row d-flex justify-content-center">
		<?php echo form_submit("Reset", "Reset!"); ?>
	</div><br>
	
</div>
<?php
	$this->load->view('footer'); 
?>
