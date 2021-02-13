<?php
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/products/";
?>

<div class="container">
	
	<div class="row d-flex justify-content-center"> 
		<div class="col-md-12 ">
			<h1><br>Add new product</h1><hr>
		</div>
	</div>
	
	 <div class="row d-flex justify-content-center">
			<?php echo form_open_multipart('ProductController/handleInsert');?>
			<div class="col-md-12 ">	
				<div class="row ">
					<div class="col-md-6" >	
						<?php
						echo '<h4>Produce code:</h4>';
						echo form_input('produceCode', $produceCode);
						
						echo '</br></br><h4>Description:</h4>';
						echo form_input('description', $description);

						echo '</br></br><h4>Product Line:</h4>';
						echo form_input('productLine', $productLine);

						echo '</br></br><h4>Supplier:</h4>';
						echo form_input('supplier', $supplier);
						?>
					</div>
					<div class="col-md-6" >
						<?php
						echo '<h4>Quantity in stock:</h4>';
						echo form_input('quantityInStock', $quantityInStock);

						echo '</br></br><h4>Bulk buy price:</h4>';
						echo form_input('bulkBuyPrice', $bulkBuyPrice);

						echo '</br></br><h4>Bulk sale price:</h4>';
						echo form_input('bulkSalePrice', $bulkSalePrice);
									
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