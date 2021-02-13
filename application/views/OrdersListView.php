<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url().index_page();
	$img_base = base_url()."assets/images/products/";
	$result = $this->session->userdata('logged_in');
	$pagination = $this->pagination;
?>

<script>
	$('.datepicker').pickadate();
</script>

<div class="container">
	
	<?php 
		//page_header($pagination);
		if($this->session->userdata('logged_in')['admin'] == 1) :
		{
			page_header($pagination, 1);
			admin_view($order_info, $img_base, $result);
		}
		else :
		{
			page_header($pagination, 1);
			customer_view($order_info, $img_base, $result);
		}
		endif;
	?>
	
	
</div>
	
<?php
	$this->load->view('footer'); 
?>

<?php function customer_view($order_info, $img_base, $result){ ?>
	
	<table class="table table-striped">
		<thead>
		<tr>
			<th scope="col">Number</th>
			<th scope="col">Order Date</th>
			<th scope="col">Shipped date</th>
			<th scope="col">Status</th>
			<th scope="col">Details</th>
			<th scope="col">Cancel</th>
		</tr>
		</thead>
		<tbody> 
		<?php foreach($order_info as $row){?>
		<tr>
			<form method="post" action="<?php echo base_url()?>index.php/OrdersController/processSelection">
			
			<input type="hidden" name="orderNumber" value="<?php echo $row->orderNumber;?>" />
			<input type="hidden" name="customerNumber" value="<?php echo $row->customerNumber;?>" />
			
			<td><?php echo $row->orderNumber;?></td>
			<td><?php echo $row->orderDate;?></td>
			<td><?php echo $row->shippedDate;?></td>
			<td><?php echo $row->status;?></td>
			<td><input type="submit" class="btn btn-warning" name="action" value="View" ></td>
			
			<?php $candelete ="disabled";
					if($row->status == 'In Process' ) 
						$candelete = ''; ?>
			
			<td><input type="submit" class="btn btn-danger" name="action" value="X" <?php echo $candelete;?> ><td>
			</form>		
		</tr>     
		<?php }?>  
		 </tbody>
   </table>
   
<?php } ?>

<?php function page_header($pagination, $result){ ?>
	<br><br>
	<h1>Orders</h1>
	
	<div class="row">
		<div class="col-md-6">
			<nav aria-label="Page navigation example">
			  <ul class="pagination">
				<?php echo $pagination->create_links();?> 
			  </ul>
			</nav>
		</div>
	</div>
	
	<?php if($result == 1) : ?>
	
	<div class="row">
		<div class="col-md-4 d-flex justify-content-right">
			<div class="dropdown">
			  <a class="btn btn-outline-secondary my-2 my-sm-0 dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Show All
			  </a>
			  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
				<a class="dropdown-item" href="<?php echo base_url()?>index.php/OrdersController/listByStatus/Shipped">Shipped</a>
				<a class="dropdown-item" href="<?php echo base_url()?>index.php/OrdersController/listByStatus/Resolved">Resolved</a>
				<a class="dropdown-item" href="<?php echo base_url()?>index.php/OrdersController/listByStatus/Cancelled">Cancelled</a>
				<a class="dropdown-item" href="<?php echo base_url()?>index.php/OrdersController/listByStatus/Hold">On Hold</a>
				<a class="dropdown-item" href="<?php echo base_url()?>index.php/OrdersController/listByStatus/Disputed">Disputed</a>
				<a class="dropdown-item" href="<?php echo base_url()?>index.php/OrdersController/listByStatus/Process">In Process</a>
				
			  </div>
			</div>
		</div>
			
		<div class="col-md-4 d-flex justify-content-right"  >
			<form class="form-inline" method="post" action="<?php echo base_url()?>index.php/OrdersController/searchOrdersByDate">
				<input class="form-control mr-sm-2" type="date" name="searchDay">
				<button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Go</button>
			</form>
		</div>
		
		<div class="col-md-4 d-flex justify-content-right" >
			<form class="form-inline" method="post" action="<?php echo base_url()?>index.php/OrdersController/searchOrdersByNumber">
				  <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
				  <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
			</form>
		</div>	
	
	<?php endif; ?>
		
	</div>	
<?php } ?>

<?php function admin_view($order_info, $img_base, $result){ ?>
	
	<table class="table table-striped">
		<thead>
		<tr>
			<th scope="col">Number</th>
			<th scope="col">Customer</th>
			<th scope="col">Received</th>
			<th scope="col">Required</th>
			<th scope="col">Shipped</th>
			<th scope="col">Status</th>
			<th scope="col">Comments</th>
			<th>Action<th>
		<!--	<th></th>  -->
		</tr>
		</thead>
		<tbody> 
		<?php foreach($order_info as $row){?>
			<tr>
				<form method="post" action="<?php echo base_url()?>index.php/OrdersController/processSelection">
				
					<input type="hidden" name="orderNumber" value="<?php echo $row->orderNumber;?>" />
					<input type="hidden" name="customerNumber" value="<?php echo $row->customerNumber;?>" />
				
				
					<td><?php echo $row->orderNumber;?></td>
					<td><?php echo $row->customerNumber;?></td>
					<td><input class="form-control mr-sm-2" type="date" id="orderdate" name="orderdate" value="<?php echo $row->orderDate;?>"></td>
					<td><input class="form-control mr-sm-2" type="date" id="requireddate" name="requireddate" value="<?php echo $row->requiredDate;?>"></td>
					<td><input class="form-control mr-sm-2" type="date" id="shippeddate" name="shippeddate" value="<?php echo $row->shippedDate;?>"></td>
					
					<td>
						<select class="form-control" name="status" style="width:auto !important;">
							  <option selected value="<?php echo $row->status;?>"><?php echo $row->status;?></option>
							  <option value="Shipped">Shipped</option>
							  <option value="Resolved">Resolved</option>
							  <option value="Cancelled">Cancelled</option>
							  <option value="Hold">On Hold</option>
							  <option value="Disputed">Disputed</option>
							  <option value="Process">In Process</option> 
						</select>
					</td>
					
								
					<td><textarea name="comment" rows="1" cols="15"><?php echo $row->comments;?></textarea></td>
					<td><input type="submit" class="btn btn-warning" name="action" value="update"></td>
				<!--	<td><input type="submit" class="btn btn-danger" name="action" value="X"></td> -->
					
				</form>
			</tr>     
		<?php }?>  
		 </tbody>
   </table>
   
<?php } ?>