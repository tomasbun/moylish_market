<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('header'); 
	$this->load->helper('url');
	$this->load->helper('form');
	$base = base_url().index_page();
	$img_base = base_url()."assets/images/products/";
	$pagination = $this->pagination;
	$total2 = 0;
?>

<div class="container">
	
	<br><h1>Cart</h1><br>
	
	<?php echo form_open('ProductController/UpdateCartPost'); ?> 
	
	<table class="table table-striped"> 

		<tr>
			<th>Photo</th>
			<th>Product</th>
			<th>Quantity</th>
			<th style="text-align:right">Price (Eur)</th>
			<th style="text-align:right">Sub-Total (Eur)</th>
			<th></th>
			<th></th>
		</tr>

		<?php $i = 1; ?>   

		<?php foreach ($this->cart->contents() as $items): ?> <!-- ------------------------- start of foreach ----------------------------------------------->

			<?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

			<tr>
					<td><a href="<?php echo base_url()?>index.php/ProductController/viewProduct/<?php echo $items['id']?>"><img src="<?php echo $img_base.'thumbs/'.$items['photo'];?>" alt="Card image cap"></a></td>
					<td style="vertical-align: middle;"><?php echo $items['name']; ?></td>
									
					<td style="vertical-align: middle;">
						<select class="browser-default custom-select" name="<?php echo $i.'[qty]'?>">
						<?php
						  for($x = 1; $x <= 60; $x++)
						  {
								if($x == $items['qty'])
									echo '<option selected value="'.$x.'">'.$x.'</option>';
								else
									echo '<option value="'.$x.'">'.$x.'</option>';	  
						  }
						?>
									  
						</select>
					</td>
					
					
					<td style="text-align:right" style="vertical-align: middle;"><?php echo $this->cart->format_number($items['price']); ?></td>
					<td style="text-align:right" style="vertical-align: middle;"><?php echo $this->cart->format_number($items['subtotal']); ?></td>
					
					<td align="right" style="vertical-align: middle;">
						<button class="btn  btn-outline-secondary" onclick="window.location.href = '<?php echo base_url()?>index.php/ProductController/RemoveFromCart/<?php echo $items['rowid']?>';">X</button> 
					</td>
					
			</tr>

			<?php $i++; ?>

		<?php endforeach; ?>
	</table>
	
	<div class="row">
	<div class="col-11" align="right" style="vertical-align: middle;">
		<h4><strong>Total: </strong><?php echo $this->cart->format_number($this->cart->total()); ?> Eur</h4>
		<button class="btn  btn-outline-danger" onclick="window.location.href = '<?php echo base_url()?>index.php/ProductController/ClearCart?>';">Clear</button> 
					
		</div>
	</div>

	<p><?php echo form_submit('', 'Update your Cart'); ?></p> <!-- ------------------------------------- end of form --------------------------------------------------------------------> 
</div>	
<?php
	$this->load->view('footer'); 
?>