<?php
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/products/";
?>

<div class="container">

    <div class="row d-flex justify-content-center"> 
		<div class="col-md-12 ">
			<h1><br>Update Product Details</h1><hr>
		</div>
	</div>

	<div class="row d-flex justify-content-center">
			<?php 
			foreach ($edit_data as $row) 
			{ 
				echo form_open_multipart('ProductController/updateProduct/'.$row->produceCode);
			
			?>
			<div class="col-md-12 ">	
				<div class="row ">
					
					<div class="col-md-6" >	
						<?php
						echo '<h4>Produce Code:</h4>';
						echo form_input('produceCode', $row->produceCode, 'readonly');
					
						echo '<br><br><h4>Description:</h4>';
						echo form_input('description', $row->description);

						echo '</br></br><h4>Product Line:</h4>';
						echo form_input('productLine', $row->productLine);

						echo '</br></br><h4>Supplier:</h4>';
						echo form_input('supplier', $row->supplier);
						?>
					</div>
					<div class="col-md-6" >
						<?php
						echo '<h4>Quantity In Stock:</h4>';
						echo form_input('quantityInStock', $row->quantityInStock);

						echo '</br><br><h4>Bulk Buy Price:</h4>';
						echo form_input('bulkBuyPrice', $row->bulkBuyPrice);

						echo '<br></br><h4>Bulk Sale Price:</h4>';
						echo form_input('bulkSalePrice', $row->bulkSalePrice);
					
						echo '</br></br><h4>Select File for Upload:</h4>';
						echo form_upload('userfile');
						?>
					</div>
				</div>
			</div>
	</div>				
	
	<div class="row d-flex justify-content-center">
		<div class="col-md-12"><hr>
			<?php
				echo form_submit('submitUpdate', "Submit!");
				echo form_close();
				echo validation_errors();
			}?>
		<hr></div>
	</div>
</div>



<?php
	$this->load->view('footer'); 
?>