<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Register for an Online Account</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/fonts/iconic/css/material-design-iconic-font.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/css/util.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/css/main.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/css/normalize.css'); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/css/demo.css'); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/css/component.css'); ?>" />
		
	</head>
	<body>
		<?php echo $this->include('includes/header'); ?>
		<div class="col-lg-12 col-xs-12 col-md-12" style="padding: 0px;">
			<div class="container-fluid register">
				<div class="row">
					<div class="col-md-3 register-left">
						<i class="fa fa-sign-in" style="font-size: 72px;"></i>
						<h3>Welcome</h3>
						<p>This communication is from a debt collector and this is an attempt to collect a debt and any information may be used for that purpose.</p>
						<a href="<?php echo base_url(); ?>" class="btn btn-primary"> Login </a>
						
                        <br/>
					</div>
                    <div class="col-md-9 register-right">
						<h3 class="register-heading"> Register for an Online Account </h3>
						<?php 
							// ------------------------------ login form open ---------------------------------
							$attributes = array('name'=>'login', 'id' => 'login');
							echo form_open_multipart(base_url('register/action'), $attributes); 
							$validation = \Config\Services::validation();
						?> 
						
						<div class="row register-form">
							<?php if ($error = session()->getFlashdata('register')) { ?>
								
								<div class="alert alert-danger alert-dismissable">
									<?= $error ?>
								</div>
							<?php    }  ?> 
							
							
							<div class="col-md-6">
								<!-- *********************************************** Company ************************************************************ -->         
								<div class="form-group">
									<span style="text-align:left; color:#FF0000; font-size:12px;";><?php echo $validation->showError('company'); ?></span>
									<?php
										$data = array('name'  => 'company', 'id' => 'company', 'class'=>"form-control",  'value'=>set_value('company'),  'maxlength' => '250','placeholder'=>'Company *');
										echo form_input($data);
									?>
								</div>
								<!-- *********************************************** First Name ************************************************************ -->         
								<div class="form-group">
									<span style="text-align:left; color:#FF0000; font-size:12px;";><?php echo $validation->showError('fname'); ?></span>
									<?php
										$data = array('name'  => 'fname', 'id' => 'fname', 'class'=>"form-control",  'value'=>set_value('fname'),   'maxlength' => '150','placeholder'=>'First Name *');
										echo form_input($data);
									?>
								</div>
								<!-- *********************************************** last Name ************************************************************ -->         
								
								<div class="form-group">
									<span style="text-align:left; color:#FF0000; font-size:12px;";><?php echo $validation->showError('lname'); ?></span>
									<?php
										$data = array('name'  => 'lname', 'id' => 'lname', 'class'=>"form-control",  'value'=>set_value('lname'),   'maxlength' => '150','placeholder'=>'Last Name *');
										echo form_input($data);
									?>
								</div>
								<!-- *********************************************** last Name ************************************************************ -->         
								
								<div class="form-group">
									<span style="text-align:left; color:#FF0000; font-size:12px;";><?php echo $validation->showError('username'); ?></span>
									<?php
										$data = array('name'  => 'username', 'id' => 'username', 'class'=>"form-control",  'value'=>set_value('username'),   'maxlength' => '150','placeholder'=>'User Name *');
										echo form_input($data);
									?>
								</div>           
								
								<!-- *********************************************** last password ************************************************************ -->                     
								<div class="form-group">
									<span style="text-align:left; color:#FF0000; font-size:12px;";><?php echo $validation->showError('password'); ?></span>
									<?php
										$data = array('name'  => 'password', 'id' => 'password', 'class'=>"form-control", 'value'=>set_value('password'),    'maxlength' => '40','placeholder'=>'Password *');
										echo form_password($data);
									?>
									<small>The password field must be 7 characters in length and least one lowercase/uppercase letter, special character and number </small>
								</div>
								<!-- *********************************************** last re_password ************************************************************ -->            
								<div class="form-group">
									<span style="text-align:left; color:#FF0000; font-size:12px;";><?php echo $validation->showError('re_password'); ?></span>
									<?php
										$data = array('name'  => 're_password', 'id' => 're_password', 'class'=>"form-control",  'value'=>set_value('re_password'),    'maxlength' => '40','placeholder'=>'Retype Password *');
										echo form_password($data);
									?>
									<small>Please make sure your passwords match.</small>
								</div>
							</div>
							<!-- *********************************************** last re_password ************************************************************ -->          
							<div class="col-md-6">
								<div class="form-group">
									<span style="text-align:left; color:#FF0000; font-size:12px;";><?php echo $validation->showError('acctno'); ?></span>
									<?php
										$data = array('name'  => 'acctno', 'id' => 'acctno', 'class'=>"form-control",'value'=>set_value('acctno'),    'maxlength' => '40','placeholder'=>' Account Number *');
										echo form_input($data);
									?>                                            
									<small>This is the client number assigned you. If you don't know it, simply enter 777 and we will look it up before approving your registration.</small> 
								</div>
								<!-- *********************************************** Email ************************************************************ --> 
								<div class="form-group">
									
									<span style="text-align:left; color:#FF0000; font-size:12px;";><?php echo $validation->showError('email'); ?></span>
									<?php
										$data = array('name'  => 'email', 'id' => 'email', 'class'=>"form-control", 'value'=>set_value('email'),   'maxlength' => '255','placeholder'=>'Your Email *');
										echo form_input($data);
									?>         
								</div>
								
								<!-- *********************************************** Mobile ************************************************************ --> 
								<div class="form-group">
									
									<span style="text-align:left; color:#FF0000; font-size:12px;";><?php echo $validation->showError('mobile'); ?></span>
									<?php
										$data = array('name'  => 'mobile', 'id' => 'mobile', 'class'=>"form-control", 'value'=>set_value('mobile'),   'maxlength' => '255','placeholder'=>'Your Mobile No. *');
										echo form_input($data);
									?>         
								</div>
								
								
								<div class="form-group">
									<span style="text-align:left; color:#FF0000; font-size:12px;";></span>
									<div class="col-md-12 col-xs-12" style="padding: 0px;">
										<div class="col-md-5" style="padding: 0px;">
											<!-- load the captcha image on the view -->
											<img src="<?php echo base_url('register/captcha'); ?>" alt="captcha">
										</div>
										<!-- *********************************************** Security Code ************************************************************ --> 
										<div class="col-md-7" style="padding: 0px;">
											
											
											
											<?php
												$data = array('name'  => 'SecurityCode', 'id' => 'SecurityCode', 'class'=>"form-control",    'maxlength' => '255','placeholder'=>'Security Code *');
												echo form_input($data);
											?>         
										</div>
									</div>
								</div>
								
								
								<button type="submit" name="smt_enter" class="btnRegister"> Register <i class="fa fa-registered" aria-hidden="true"></i></button>
							</div>
						</div>
						<?php  // ------------------------------ login form open ---------------------------------
							
							$data = array('active'  => '0');
							echo form_hidden($data);
							$data = array('new'  => '1');
							echo form_hidden($data);
							$data = array('otptype'  => 'E');
							echo form_hidden($data);
							
							echo form_close(); 
						?>
						
						
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-12" style="padding: 0px;">
			<?php echo $this->include('includes/footer'); ?>       
		</div>
		<script src="<?php echo base_url('public/assets/js/classie.js'); ?>"></script>
		<script src="<?php echo base_url('public/assets/js/gnmenu.js'); ?>"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
			$(document).ready(function(){
				$('#s-icons').click(function() {
					$('.navbar-nav').toggleClass("show");
				});
			});
		</script>
	</body>
</html>