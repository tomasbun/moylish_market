<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url().index_page();
	$img_base = base_url()."assets/images/products/";
	$pagination = $this->pagination;
?>

<div class="container">
	
	<?php 
		page_header($pagination);
		admin_view($customer_info);
	?>
	
	
</div>
	
<?php
	$this->load->view('footer'); 
?>


<?php function page_header($pagination){ ?>
	<br><br>
	<h1>Customers</h1>
	
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
				<a class="dropdown-item" href="#">Administrator</a>
				<a class="dropdown-item" href="#">Registered</a>
				<a class="dropdown-item" href="#">Disabled</a>
			  </div>
			</div>
		</div>
		
		<div class="col-md-4 d-flex justify-content-right" ">
			<form class="form-inline">
				  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
				  <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
			</form>
		</div>	
	</div>	
<?php } ?>

<?php function admin_view($customer_info){ ?>
	
	<table class="table table-striped">
		<thead>
		<tr>
			<th scope="col"width="100">Customer Number</th>
			<th scope="col"width="100">Customer Name</th>
			<th scope="col"width="100">Contact Last name</th>
			<th scope="col"width="120">Contact First name</th>
			<th scope="col"width="100">Phone</th>
			<th scope="col"width="100">Email</th>
			<th scope="col"width="80">Admin</th>
			<th scope="col"width="80">Disabled</th>
			<th scope="col"width="80">Update</th>
			<th scope="col"width="80">Delete</th>
		</tr>
		</thead>
		<tbody> 
		<?php foreach($customer_info as $row){?>
		<tr>
			<td><?php echo $row->customerNumber;?></td>
			<td><?php echo $row->customerName;?></td>
			<td><?php echo $row->contactLastName;?></td>
			<td><?php echo $row->contactFirstName;?></td>
			<td><?php echo $row->phone;?></td>
			<td><?php echo $row->email;?></td>
			
			
			<?php
				$administrator = '';
				$disabled = '';
				if( $row->admin == 1) $administrator = 'checked';
				if( $row->disabled == 1) $disabled = 'checked';
			?>
				<td><input type="checkbox" name="admin" value="admin" <?php echo $administrator?>></td>
				<td><input type="checkbox" name="disabled" value="disabled" <?php echo $disabled?>></td>
					
			<td><?php echo anchor('CustomerController/editCustomer/'.$row->customerNumber, 'Update'); ?> </td>			
			<td><?php echo anchor('CustomerController/customerDelete/'.$row->customerNumber, 'Delete', 'onclick = "return checkDelete()"'); ?> </td>
		</tr>     
		<?php }?>  
		 </tbody>
   </table>
   
<?php } ?>