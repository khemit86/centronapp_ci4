<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Centron</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/fonts/iconic/css/material-design-iconic-font.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/css/style.css'); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/css/util.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/css/main.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/css/demo.css'); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/css/component.css'); ?>" />
		
		<?php echo $this->include('includes/header_inner'); ?>
		<div class="col-lg-12 col-xs-12 col-md-12" style="padding: 0px;">
			<div class="container-fluid display-table">
				<div class="row display-table-row">
					
					<div class="col-md-3 col-sm-2 hidden-xs display-table-cell v-align box" id="navigation">
						
						<div class="navi">
							
							<?php echo $this->include('includes/userleft'); ?>
							
						</div>
						
					</div>
					
					<div class="col-md-9 col-sm-10 display-table-cell v-align">
						
						
						
						<?php echo $this->include('includes/top'); ?>
						
						<div class="user-dashboard">
							
							<div class="col-lg-12 col-xs-12 padding_0px margin_top_panel">
								
								<div class="panel panel-default">
									
									<div class="panel-heading panel_custom"> <i class="fa fa-credit-card"></i> Direct Payment Form:  Edit A Payment </div>
									
									<div class="panel-body">
										
										<?php
											
											if($error = session()->getFlashdata('collections'))
											
											{  ?>
											
											<div class="alert alert-danger alert-dismissable">
												
												<?php echo $error ?>
												
											</div>
											
											<?php 
												
											}
											
											
											
											// ------------------------------  form open ---------------------------------
											
											$attributes = array('class'=>'form-group','name'=>'form1', 'id' => 'form1');
											
											echo form_open_multipart(base_url().'direct/editdo', $attributes);
											$validation = \Config\Services::validation();
											
											
											
											
											
										?>
										
										
										
										<div class="form-group col-lg-6 col-xs-12">
											
											<label>Your Name <span class="color_red">*</span></label>
											
											
											
											<?php
												
												
												
												$Name=session()->get('client_fname')." ".session()->get('client_lname');
												
												$data = array('name'  => 'client_fname', 'id' => 'client_fname', 'class'=>"form-control", 'readonly'=>'readonly', 'value'=>$Name,  'maxlength' => '200','placeholder'=>'');
												
												echo form_input($data);
												
											?>
											
										</div>
										
										
										
										<div class="form-group col-lg-6 col-xs-12">
											
											<label>Your Company <span class="color_red">*</span> </label>
											
											<?php
												
												
												
												$client_company=session()->get('client_company');
												
												$data = array('name'  => 'client_company', 'id' => 'client_company', 'class'=>"form-control", 'readonly'=>'readonly', 'value'=>$client_company,  'maxlength' => '200','placeholder'=>'');
												
												echo form_input($data);
												
											?>
											
										</div>
										
										
										
										<div class="form-group col-lg-6 col-xs-12">
											
											<label>Your Account No <span class="color_red">*</span> </label>
											
											
											
											<?php
												
												
												
												$client_acctno=session()->get('client_acctno');
												
												$data = array('name'  => 'client_acctno', 'id' => 'client_acctno', 'class'=>"form-control", 'readonly'=>'readonly', 'value'=>$client_acctno,  'maxlength' => '200','placeholder'=>'');
												
												echo form_input($data);
												
											?>     
											
											
											
										</div>
										
										
										
										<div class="form-group col-lg-6 col-xs-12">
											
											<label> Consumer Name <span class="color_red">*</span> 
												
												<span> <a  data-toggle="tooltip" data-placement="top" title="Consumer Name"><i class="fa fa-question-circle"></i> </a> </span>
												
											</label>
											
											<span style="text-align:left; color:#FF0000; font-size:12px;";><?php echo $validation->showError('name'); ?></span>
											
											<?php
												
												$data = array('name'  => 'name', 'id' => 'name', 'class'=>"form-control",  'value'=>$edit_direct[0]['name'],  'maxlength' => '200','placeholder'=>'Consumer Name *');
												
												echo form_input($data);
												
											?>  
											
										</div>
										
										
										
										<div class="form-group col-lg-6 col-xs-12">
											
											<label> Consumer Account # </label>
											
											
											
											<span style="text-align:left; color:#FF0000; font-size:12px;";><?php echo $validation->showError('acctno'); ?></span>
											
											<?php
												
												$data=array('name'  => 'acctno', 'id' => 'acctno', 'class'=>"form-control",  'value'=>$edit_direct[0]['acctno'],  'maxlength' => '200','placeholder'=>'Consumer Account # *');
												
												echo form_input($data);
												
											?>  
											
										</div>
										
										
										
										<div class="form-group col-lg-6 col-xs-12">
											
											<label> Payment Amount <span class="color_red">*</span>
												
												<span> <a  data-toggle="tooltip" data-placement="top" title="Payment Amount"><i class="fa fa-question-circle"></i> </a> </span>
												
											</label>
											
											
											
											<span style="text-align:left; color:#FF0000; font-size:12px;";><?php echo $validation->showError('payment'); ?></span>
											
											<?php
												
												$data=array('name'  => 'payment', 'id' => 'payment', 'class'=>"form-control",  'value'=>$edit_direct[0]['payment'],  'maxlength' => '200','placeholder'=>'Payment Amount *');
												
												echo form_input($data);
												
											?>   
											
											
											
										</div>
										
										
										
										
										
										
										
										<div class="form-group col-lg-6 col-xs-12">
											
											<label> Principal Balance Should Be  <span class="color_red">*</span>
												
												<span> <a  data-toggle="tooltip" data-placement="top" title="Principal Balance Should Be"><i class="fa fa-question-circle"></i> </a> </span>
												
											</label>
											
											
											
											<span style="text-align:left; color:#FF0000; font-size:12px;";><?php echo $validation->showError('balance'); ?></span>
											
											<?php
												
												$data=array('name'  => 'balance', 'id' => 'balance', 'class'=>"form-control",  'value'=>$edit_direct[0]['payment'],  'maxlength' => '200','placeholder'=>'Principal Balance Should Be *');
												
												echo form_input($data);
												
											?>   
											
											
											
										</div>
										
										
										
										
										
										<div class="form-group col-lg-6 col-xs-12">
											
											<label>  Pay Type  <span class="color_red">*</span>
												
												<span> <a  data-toggle="tooltip" data-placement="top" title="Pay Type"><i class="fa fa-question-circle"></i> </a> </span>
												
											</label> <br>
											
											<span style="text-align:left; color:#FF0000; font-size:12px;";><?php echo $validation->showError('paytype'); ?></span>
											
											<label class="radio-inline">
												
												<?php 
													
													$checked=$edit_direct[0]['paytype'];
													
													if($checked=='Paid in Full') 
													
													{                 
														
														$data = array('name'  => 'paytype', 'id' => 'paytype', 'checked'=> TRUE, 'value'=> 'Paid in Full');
														
													}
													
													else
													
													{
														
														$data = array('name'  => 'paytype', 'id' => 'paytype', 'value'=> 'Paid in Full');
														
													}  
													
													echo form_radio($data);
													
												?>  Paid in Full
												
											</label>
											
											<label class="radio-inline">
												
												
												
												<?php 
													
													
													
													if($checked=='Partial') 
													
													{                 
														
														$data = array('name'  => 'paytype', 'id' => 'paytype', 'checked'=> TRUE, 'value'=> 'Partial');
														
													}
													
													else
													
													{
														
														$data = array('name'  => 'paytype', 'id' => 'paytype', 'value'=> 'Partial');
														
													}  
													
													echo form_radio($data);
													
												?> 
												
												
												
												Partial
												
											</label>
											
											
											
											<label class="radio-inline">
												
												<?php 
													
													
													
													if($checked=='Cancel and Return') 
													
													{                 
														
														$data = array('name'  => 'paytype', 'id' => 'paytype', 'checked'=> TRUE, 'value'=> 'Cancel and Return');
														
													}
													
													else
													
													{
														
														$data = array('name'  => 'paytype', 'id' => 'paytype', 'value'=> 'Cancel and Return');
														
													}  
													
													echo form_radio($data);
													
												?> 
												
												
												
												Cancel and Return Why ?
												
											</label>
											
											
											
											
											
											<?php
												
												$data=array('name'  => 'cancelwhy', 'id' => 'cancelwhy', 'class'=>"form-control",  'value'=>$edit_direct[0]['cancelwhy'],  'maxlength' => '255','placeholder'=>'Why *');
												
												echo form_input($data);
												
											?>    
											
										</div>
										
										<div class="form-group col-lg-12 col-xs-12">
											<label>Posting Instructions </label>
											<?php
												
												$data=array('name'  => 'postingins', 'id' => 'postingins', 'class'=>"form-control",  'rows'=>3, 'value'=>$edit_direct[0]['postingins'],  'placeholder'=>'Why *');
												
												echo form_textarea($data);
												
											?>    
											
											
										</div>
										
										<div class="form-group col-lg-12 col-xs-12">
											
											<button class="btn btn-primary"> <i class="fa fa-save"></i> Submit Record </button>
											
										</div>
										
										<?php  
											
											// ------------------------------  form end ---------------------------------
											
											$data = array('id'  => $edit_direct[0]['id']);
											
											echo form_hidden($data);
											
											echo form_close();
											
										?>
										
										
										
									</div>
									
								</div>
								
							</div> 
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
						</div>
						
					</div>
					
				</div>
				
			</div>
			
			<!--  Dashboard #end ############################################################################## -->
			
		</div>
		
		
		
		<div class="col-xs-12 col-md-12" style="padding: 0px;">
			
			<?php include_once('includes/footer.php'); ?>        
			
		</div>
		
		
		
		
		
		<script>
			
			
			
			$(document).ready(function(){
				
				$('[data-toggle="offcanvas"]').click(function(){
					
					$("#navigation").toggleClass("hidden-xs");
					
				});
				
			});
			
			
			
			
			
			
			
			new gnMenu( document.getElementById( 'gn-menu' ) );
			
			
			
			$(document).ready(function(){
				
				$('#s-icons').click(function() {
					
					$('.navbar-nav').toggleClass("show");
					
				});
				
			});
			
		</script>
		
		<script>
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();   
			});
		</script>
		
	</body>
	
</html>