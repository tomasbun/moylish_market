<?php
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/products/";
?>

<div class="container">
	
	<div class="row d-flex justify-content-center"> 
		<h1>Add new Product</h1></br></br>
	</div>
	
	 <div class="row d-flex justify-content-center">
		<?php echo form_open_multipart('ProductController/handleInsert');
						
			echo '<hr>Produce code: ';
			echo form_input('produceCode', $produceCode);
			
			echo '</br></br>Description: ';
			echo form_input('description', $description);

			echo '</br></br>Product Line: ';
			echo form_input('productLine', $productLine);

			echo '</br></br>Supplier: ';
			echo form_input('supplier', $supplier);
			
			echo '</br></br>Quantity in stock:';
			echo form_input('quantityInStock', $quantityInStock);

			echo '</br></br>Bulk buy price: ';
			echo form_input('bulkBuyPrice', $bulkBuyPrice);

			echo '</br></br>Bulk sale price: ';
			echo form_input('bulkSalePrice', $bulkSalePrice);
						
			echo '</br></br>Select File for Upload :';
			echo form_upload('userfile');
			
			echo '</br><hr></br>';
			echo form_submit('submitInsert', "Submit!");

			echo form_close();
			echo validation_errors();
		?>
	</div>
</div>
<?php
	$this->load->view('footer'); 
?>