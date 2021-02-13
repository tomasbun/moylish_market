<?php
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>
	<!-- style="background-image: url(<?php //echo $img_base."site/background1.jpg"?>); background-position:center; background-repeat:no-repeat;background-size:cover;" -->
	<div class="container" >
		<hr><h1><strong>Get In Touch</strong></h1>
		
		
                    <div class="row" >
   	
						
                        <div class="col-md-7" >
                                <div class="panel ">
                                    <div class="panel-heading"> <h3>Find Us<h3>  </div>
                                    <div class="panel-body">
                                     <h4>Phone: +35361293000</h4>
									 <h4>Email: Information@lit.ie</h4> 
									</div>
									<hr>
									
									 <div>
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1844.029392353847!2d-8.647524997626131!3d52.67447705799141!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x485b5cf73a3da16d%3A0xf55474500d42913!2sLIT!5e0!3m2!1sen!2sie!4v1580286201976!5m2!1sen!2sie" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
									</div>
									
									<br><hr>
                                </div>
                        </div>
    
                       
					
					   
                        <div class="col-md-5" >
                                <div class="panel ">
                                    <div class="panel-heading"> <h3>Contact Us<h3>  </div>
                                    <div class="panel-body">
										<p>If You have any questions or suggestions, please do not hesitate and let us know! We will be more than happy to help!</p>
										
										<form>
									  <div class="form-group">
										<input type="email" class="form-control" id="email1" placeholder="Your email address">
									  </div>
									 
									  <div class="form-group">
										<textarea class="form-control" id="mytextarea" rows="10" cols="5" placeholder="Your query.."></textarea>
									  </div>
									   <button type="submit" class="btn btn-success">Submit</button>
									</form>
										
                                      
                                    </div>
																		
                                </div>
                        </div> 
    
                    </div>

   

    </div><br> 

	
<?php	
	$this->load->view('footer'); 
?>