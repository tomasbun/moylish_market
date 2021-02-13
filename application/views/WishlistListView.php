<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url().index_page();
	$img_base = base_url()."assets/images/products/";
	$pagination = $this->pagination;
	$total2 = 0;
?>

<div class="container">
	
	<br>
	<h1>Whishlist</h1>
	<br>
	<table class="table table-striped">
		<thead>
		<tr>
			<th scope="col"width="180">Photo</th>
			<th scope="col"width="300">Product</th>
			<th scope="col"width="250">Quantity</th>
			<th scope="col"width="250">Price (Eur)</th>
			<th scope="col"width="450" align="right"></th>
		</tr>
		</thead>
		<tbody> 
		<?php foreach($wishlist_info as $row){?>
		<tr>
			<td><a href="<?php echo base_url()?>index.php/ProductController/viewProduct/<?php echo $row->productCode?>"><img src="<?php echo $img_base.'thumbs/'.$row->photo;?>" alt="Card image cap"></a></td>
			<td style="vertical-align: middle;"><h5><?php echo $row->productID;?></h5></td>
			<td style="vertical-align: middle;"><h5><?php echo $row->quantity;?></h5></td>
			<td style="vertical-align: middle;"><h5><?php echo $row->total;?></h5></td>
			<td align="right" style="vertical-align: middle;">
				<button class="btn  btn-outline-success" onclick="window.location.href = '<?php echo base_url()?>index.php/WishlistController/RemoveAddToCart/<?php echo $row->ID?>';">Move To Cart</button> 
				<button class="btn  btn-outline-secondary" onclick="window.location.href = '<?php echo base_url()?>index.php/WishlistController/WishlistRemove/<?php echo $row->ID?>';">X</button> 
			</td>
		</tr>     
		<?php 
			$total2 += $row->total;
		}?>  
		 </tbody>
   </table>
   <hr>
	<h3><?php echo 'Total value of items: '.$total2.' Eur';?></h3><br>	
	
</div>
	
<?php
	$this->load->view('footer'); 
?>