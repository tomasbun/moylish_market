<?php
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>
<div class="container">
    
	<div class="row d-flex justify-content-center"> 
		<h1><br>Login Form</h1><br>
	</div>
   
   <div class="row d-flex justify-content-center">
		<?php echo '<h5>'.validation_errors().'</h5>'; ?>
	</div>
	
	<div class="row d-flex justify-content-center">
		<?php
				echo form_open('CustomerController/verify_login'); 
				
				echo "<hr><h5>Email:</h5>";
				echo form_input('email');
				
				echo "<br><br><h5>Password:</h5>";
				echo form_password('password');
				echo '<br><br>'.form_checkbox('rememberMe', 'ok', TRUE);
				echo "Rermember Me";
				
				
				echo "<hr>";
				
				echo form_submit("Login", "Login!").'<br><br>'; 
		?>
	</div>
</div>
<?php
	$this->load->view('footer'); 
?>
