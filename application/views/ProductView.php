<?php
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/products/";
?>

<script>
	function goBack() {window.history.back();}
</script>

<div class='container'>
	<?php foreach ($view_data as $row) { ?>
	
	<br>
	
	<div class="col-12 d-flex justify-content-center" >
		<h3><?php echo ($row->description) ?></h3>
	</div>
	
	<hr><br>
	
	<div class="row">
	
		<div class="col-md-6" >
			 <img class="card-img-top" src="<?php echo $img_base.'full/'.$row->Photo;?>" alt="Card image cap">
		</div>
	
		<div class="col-md-6">
		
			<div class="row">
				<div class="col-md-6" >
					 <?php
						//echo 'Description : <h4>'.$row->produceCode. '</h4>';
						echo 'Product Line: <h4>' .$row->productLine. '</h4> ';
						echo 'Supplier: <h4>'.$row->supplier.'</h4>';
					?>
				</div>
				
				<div class="col-md-6" >
					 <?php
						echo 'Quantity In Stock: <h4>' .$row->quantityInStock. '</h4>  ';
						//echo 'Bulk Buy Price: </br><h4>'.$row->bulkBuyPrice. '</h4> ';
						echo 'Bulk Sale Price:  </br><h4>'.$row->bulkSalePrice.'</h4>  ';
					?>
				</div>
			</div>
			
			<br><hr><br>
			
			<form method="post" action="<?php echo base_url()?>index.php/ProductController/processSelection">
			
			
			<div class="row">
							
				&nbsp;&nbsp;<input type="submit" class="btn btn-warning" name="action" value="wishlist">
				&nbsp;&nbsp;<input type="submit" class="btn btn-warning" name="action" value="cart">
				&nbsp;&nbsp;<input type="submit" class="btn btn-warning" name="action" value="buy">
				<input type="hidden" name="customer" value="<?php echo $this->session->userdata('logged_in')['customerNumber'] ?>" />
				<input type="hidden" name="product" value="<?php echo $row->description ?>" />
				<input type="hidden" name="price" value="<?php echo $row->bulkSalePrice ?>" />
				<input type="hidden" name="photo" value="<?php echo $row->Photo ?>" />
				<input type="hidden" name="productCode" value="<?php echo $row->produceCode?>" />
				
				<div class="col-md-3" >
																			
					<select class="browser-default custom-select" name="quantity">
					  <option selected value="1" >1</option>
					  <?php
					  for($x = 2; $x <= $row->quantityInStock; $x++)
						echo '<option value="'.$x.'">'.$x.'</option>';	  
					  ?>
								  
					</select>
				</div>
				
				
				
			</div>		
			</form>
		
	
		</div>

	</div>
	
	<br><hr><br>
	<div class="col-12 d-flex justify-content-center" >
		<button type="button" class="btn btn-outline-secondary" onclick="goBack()">Back</button>
	</div>	
	<br>
	
	<?php } ?>
	
</div>

<?php
	$this->load->view('footer'); 
?>