<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>
<script>
	function goBack() {window.history.back();}
</script>


</br></br>
<div class="container">
	<div class="col-12 d-flex justify-content-center" >
		<h1><?php echo $message?></h1>
	</div>
	<hr>
	<div class="col-12 d-flex justify-content-center" >
		<img src="<?php echo $img_base.$photo?>" class="img-fluid" width="300" alt="Responsive image">
	</div>
	<hr>
	<div class="col-12 d-flex justify-content-center" >
		<button type="button" class="btn btn-outline-secondary" onclick="goBack()">Fantastic!</button>
	</div>
</div>
</br></br>

<?php
	$this->load->view('footer'); 
?>
