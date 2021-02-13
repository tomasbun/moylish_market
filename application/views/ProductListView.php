<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url().index_page();
	$img_base = base_url()."assets/images/products/";
	$result = $this->session->userdata('logged_in');
	$pagination = $this->pagination;
?>

<div class="container">
	
	<?php 
		page_header($pagination);
		if($this->session->userdata('logged_in')['admin'] == 1) :
			admin_view($product_info, $img_base, $result);
		else :
			customer_view($product_info, $img_base, $result);
		endif;
	?>
	
	
</div>
	
<?php
	$this->load->view('footer'); 
?>

<?php function customer_view($product_info, $img_base, $result)
{
    echo '<br><br>';
	
	
		$numOfCols = 4;
		$rowCount = 0;
		$bootstrapColWidth = 12 / $numOfCols;
		
	
	echo '<div class="row">';

	
	foreach ($product_info as $row)
	{
	  
		echo '<div class="col-md-'.$bootstrapColWidth.'" align="center">';
						
			echo '<div class="card" >';
			  echo '<img class="card-img-top" src="'.$img_base.'thumbs/'.$row->Photo.'" alt="Card image cap">';
			  echo '<div class="card-body">';
				echo '<h5 class="card-title">'.$row->description.'</h5>';
				
				if($row->quantityInStock == 0):
					echo '<p class="card-text">Currently not available!</p>';
				elseif($row->quantityInStock <= 50): 	
					echo'<p class="card-text">Only a few left!</p>';
				else:
					echo '<p class="card-text">Avilable now!</p>';
				endif;
				
				if($result) :
				echo '<a href="'.base_url('index.php/ProductController/viewProduct/'.$row->produceCode).'" class="btn btn-outline-secondary">View Details</a>';
				endif;
			  echo '</div>';
			echo '</div>';
		echo '</div><br>';
	
		$rowCount++;
		if($rowCount % $numOfCols == 0) 
			echo '</div><br><div class="row">';
	}
	
	echo '</div><br>';
} 
?>

<?php function page_header($pagination){ ?>
	<br><br>
	<h1>Our Products</h1>
	
	<div class="row">	
		<div class="col-md-6">
			<nav aria-label="Page navigation example">
			  <ul class="pagination">
				<?php echo $pagination->create_links();?> 
			  </ul>
			</nav>
		</div>
						
		<div class="col-md-2 d-flex justify-content-right">
			<div class="dropdown">
			  <a class="btn btn-outline-secondary my-2 my-sm-0 dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Show All
			  </a>
			  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
				<a class="dropdown-item" href="<?php echo base_url()?>index.php/ProductController/listCategory/Fruit">Fruit</a>
				<a class="dropdown-item" href="<?php echo base_url()?>index.php/ProductController/listCategory/Vegetables">Vegetables</a>
				<a class="dropdown-item" href="<?php echo base_url()?>index.php/ProductController/listCategory/Jams">Jams and Preserves</a>
				<a class="dropdown-item" href="<?php echo base_url()?>index.php/ProductController/listCategory/Baked">Baked Goods</a>
				<a class="dropdown-item" href="<?php echo base_url()?>index.php/ProductController/listCategory/Eggs">Eggs & Dairy</a>
				<a class="dropdown-item" href="<?php echo base_url()?>index.php/ProductController/listCategory/Exotic">Exotic Fruit</a>
				<a class="dropdown-item" href="<?php echo base_url()?>index.php/ProductController/listCategory/Salads">Salads</a>
				
			  </div>
			</div>
		</div>
		
		<div class="col-md-4 d-flex justify-content-right" >
			<form class="form-inline" method="post" action="<?php echo base_url()?>index.php/ProductController/searchProduct">
				  <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
				  <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
			</form>
		</div>	
	</div>	
<?php } ?>

<?php function admin_view($product_info, $img_base, $result){ ?>
	
	<table class="table table-striped">
		<thead>
		<tr>
			<th scope="col"width="100">Code</th>
			<th scope="col"width="100">Description</th>
			<th scope="col"width="100">Line No.</th>
			<th scope="col" width="100">Supplier</th>
			<th scope="col" width="100">In Stock</th>
			<th scope="col"width="100">Bulk buy</th>
			<th scope="col"width="100">Bulk sale</th>
			<th scope="col" width="180">Photo</th>
			<th scope="col" width="80">Update</th>
			<th scope="col" width="80">Delete</th>
		</tr>
		</thead>
		<tbody> 
		<?php foreach($product_info as $row){?>
		<tr>
			<td><?php echo $row->produceCode;?></td>
			<td><?php echo $row->description;?></td>
			<td><?php echo $row->productLine;?></td>
			<td><?php echo $row->supplier;?></td>
			<td><?php echo $row->quantityInStock;?></td>
			<td><?php echo $row->bulkBuyPrice;?></td>
			<td><?php echo $row->bulkSalePrice;?></td>
			<td><img src="<?php echo $img_base.'thumbs/'.$row->Photo;?>"></td>
			<td><?php echo anchor('ProductController/editProduct/'.$row->produceCode, 'Update'); ?> </td>			
			<td><?php echo anchor('ProductController/deleteProduct/'.$row->produceCode, 'Delete', 'onclick = "return checkDelete()"'); ?> </td>
		</tr>     
		<?php }?>  
		 </tbody>
   </table>
   
<?php } ?>