<?php
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>
	<!-- style="background-image: url(<?php //echo $img_base."site/background1.jpg"?>); background-position:center; background-repeat:no-repeat;background-size:cover;" -->
	<div class="container" >
		<hr><h1><strong>Welcome to Moylish Market</strong></h1>
		
		
                    <div class="row" >
   	
						
                        <div class="col-md-8" >
                                <div class="panel ">
                                    <div class="panel-heading"> <h3> We supply <h3>  </div>
                                    <div class="panel-body">
                                    Moylish Market is Limericks's number one supplier of fresh produce. 
									Conveniently located just off the river Shannon in east side the business is situated at the heart of city's road network providing excellent
									access to the Limerick and surrounding areas. Moylish Maarket is a one hundred percent Irish owned family run business that supplies to the catering industry.
									Primarily focused on the supply of Fresh Fruit, Vegetables, Exotics, Salads, Juices, Cheese and Dairy products. 
									The company is redefining standards when it comes to prepared vegetable products, operating from a 
									state of the art temperature controlled facility 8a106 using a combination of hand and machine cutting to produce a finished product 
									that is second to none. Moylish Market supply to a variety of different customers in the food service industry such as hotels, 
									catering companies and some of Ireland’s best known bars and restaurants.  
									</div>
									<hr>
									<a><img src="<?php echo $img_base."site/title3.jpg"?>" class="img-fluid" alt="Responsive image"></a>
									<br><hr>
                                </div>
                        </div>
    
                       
                        <div class="col-md-4" >
                                <div class="panel ">
                                    <div class="panel-heading"> <h3> Our Services<h3>  </div>
                                    <div class="panel-body">
                                    
                                        <ul style="list-style: none;">
                                            <li>
												<img src="<?php echo $img_base."site/leaf.png"?>" width=25 class="img-fluid" alt="Responsive image" style="float: left;">
												<h5><strong> Range </strong></h5> 
												We provide a vast range of Potatoes, Fresh Fruit,Vegetables, Exotics, Salads, Juices, Cheese and Dairy products.
											</li>
											
											<li>
												<img src="<?php echo $img_base."site/leaf.png"?>" width=25 class="img-fluid" alt="Responsive image" style="float: left;">
												<h5><strong>Supply </strong></h5>We supply to a variety of different customers including hotels, catering companies, bars and restaurants.
											</li>
											
                                            <li> 
												<img src="<?php echo $img_base."site/leaf.png"?>" width=25 class="img-fluid" alt="Responsive image" style="float: left;">
												<h5><strong>Source </strong></h5>Moylish Market source the freshest produce from the best local growers and farms throughout Ireland.
											</li>
											
                                            <li>
												<img src="<?php echo $img_base."site/leaf.png"?>" width=25 class="img-fluid" alt="Responsive image" style="float: left;">
												<h5><strong>Distribute </strong></h5>From our production facility in Limerick We source, import and distribute our produce to customers all over.
											</li>
                                            
											<li>
												<img src="<?php echo $img_base."site/leaf.png"?>" width=25 class="img-fluid" alt="Responsive image" style="float: left;">
												<h5><strong>Deliver </strong></h5>We offer a next day delivery service in Limerick. Delivery days are Monday to Saturday, 6.00am-12.30pm.
											</li>
											
											<li>
												<img src="<?php echo $img_base."site/leaf.png"?>" width=25 class="img-fluid" alt="Responsive image" style="float: left;">
												<h5><strong>Produce </strong></h5>We provide one of a kind, bespoke, hand cut, prepared potatoes and vegetables to our customers.
											</li>
                                        </ul>
                                    </div>
																		
                                </div>
                        </div> 
    
                    </div>

   

    </div><br> 

	
<?php	
	$this->load->view('footer'); 
?>