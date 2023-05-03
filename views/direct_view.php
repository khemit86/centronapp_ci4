<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
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
		<script language="JavaScript">
			// Function to Select / DeSelect all the CheckBoxes........
			// Function to Select / DeSelect all the CheckBoxes........
			//function checkall(objForm){
			//	len = objForm.elements.length;
			//	var i=0;
			//	for( i=0 ; i<len ; i++) {
			//		if (objForm.elements[i].type=='checkbox') {
			//			objForm.elements[i].checked=objForm.check_all.checked;
			//		}
			//	}
			//}
			
			function checkall(){
				
				var objForm = document.forms[1];
				len = objForm.elements.length;
				var i=0;
				for( i=0 ; i<len ; i++) {
					if (objForm.elements[i].type=='checkbox') {
						objForm.elements[i].checked=true;
					}
				}
			}
			
			
			function uncheckall(){
				
				var objForm = document.forms[1];
				len = objForm.elements.length;
				var i=0;
				for( i=0 ; i<len ; i++) {
					if (objForm.elements[i].type=='checkbox') {
						objForm.elements[i].checked=false;
					}
				}
			}
			
			
			/////////////////////////////////////////////////
			// Javascript Function Check that atlease one Checkbox is checked to delete..If no then alert with (Nothing to Delete) and If yes then (Are you sure you want to Delete) and then return true / false........
			function confdel()
			{
				
				var fl = 0;
				for(i = 0; i < (document.form1.elements.length); i++)
				{
					
					if((document.form1.elements[i].type=="checkbox") && (document.form1.elements[i].checked==true))
					{
						fl = 1;
						break;
					}
				}
				if(fl == 1)
				{
					if(confirm("Are you sure you want to finalize?"))
					{
						fl = 1;
					}
					else
					{
						fl = 0;
					}
				}
				else
				{
					alert("Nothing to finalize.");
					fl = 0;
				}
				if(fl == 1)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			
			
		</script>
		
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
									
									<div class="panel-heading panel_custom"> <i class="fa fa-credit-card"></i> Direct Payment Form:  Add A Payment </div>
									
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
											
											$attributes = array('class'=>'form-group','name'=>'form2', 'id' => 'form2');
											
											echo form_open_multipart(base_url('direct/action'), $attributes); 
											$validation = \Config\Services::validation();
											
										?>
										
										
										
										<div class="form-group col-lg-6 col-xs-12">
											
											<label>Your Name <span class="color_red">*</span> </label>
											
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
												<span> <a  data-toggle="tooltip" data-placement="top" title="Consumer Name"><i class="fa fa-question-circle"></i> </a>
												</span>
											</label>
											
											<span style="text-align:left; color:#FF0000; font-size:12px;";><?php echo $validation->showError('name'); ?></span>
											
											<?php
												
												$data = array('name'  => 'name', 'id' => 'name', 'class'=>"form-control",  'value'=>set_value('name'),  'maxlength' => '200','placeholder'=>'Consumer Name *');
												
												echo form_input($data);
												
											?>  
											
										</div>
										
										
										
										<div class="form-group col-lg-6 col-xs-12">
											
											<label> Consumer Account # </label>
											
											
											
											<span style="text-align:left; color:#FF0000; font-size:12px;";><?php echo $validation->showError('acctno'); ?></span>
											
											<?php
												
												$data=array('name'  => 'acctno', 'id' => 'acctno', 'class'=>"form-control",  'value'=>set_value('acctno'),  'maxlength' => '200','placeholder'=>'Consumer Account # *');
												
												echo form_input($data);
												
											?>  
											
										</div>
										
										
										
										<div class="form-group col-lg-6 col-xs-12">
											
											<label> Payment Amount <span class="color_red">*</span>
												
												<span> <a  data-toggle="tooltip" data-placement="top" title="Payment Amount"><i class="fa fa-question-circle"></i> </a> </span>
												
												
											</label>
											
											
											
											<span style="text-align:left; color:#FF0000; font-size:12px;";><?php echo $validation->showError('payment'); ?></span>
											
											<?php
												
												$data=array('name'  => 'payment', 'id' => 'payment', 'class'=>"form-control",  'value'=>set_value('payment'),  'maxlength' => '200','placeholder'=>'Payment Amount *');
												
												echo form_input($data);
												
											?>   
											
											
											
										</div>
										
										<div class="form-group col-lg-6 col-xs-12">
											
											<label> Principal Balance Should Be  <span class="color_red">*</span> 
												
												<span> <a  data-toggle="tooltip" data-placement="top" title="Principal Balance Should Be"><i class="fa fa-question-circle"></i> </a> </span>
												
											</label>
											
											
											
											<span style="text-align:left; color:#FF0000; font-size:12px;";><?php echo $validation->showError('balance'); ?></span>
											
											<?php
												
												$data=array('name'  => 'balance', 'id' => 'balance', 'class'=>"form-control",  'value'=>set_value('payment'),  'maxlength' => '200','placeholder'=>'Principal Balance Should Be *');
												
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
													
													$checked=set_value('paytype');
													
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
												
												$data=array('name'  => 'cancelwhy', 'id' => 'cancelwhy', 'class'=>"form-control",  'value'=>set_value('cancelwhy'),  'maxlength' => '255','placeholder'=>'Why *');
												
												echo form_input($data);
												
											?>    
											
											
											
											
											
											
											
										</div>
										
										
										
										
										
										
										
										
										
										<div class="form-group col-lg-12 col-xs-12">
											
											
											
											<label>Posting Instructions </label>
											
											
											
											<?php
												
												$data=array('name'  => 'postingins', 'id' => 'postingins', 'class'=>"form-control",  'rows'=>3, 'value'=>set_value('postingins'),  'placeholder'=>'Posting Instructions');
												
												echo form_textarea($data);
												
											?>    
											
											
											
											
											
											
											
										</div>
										
										<div class="form-group col-lg-12 col-xs-12">
											
											<button class="btn btn-primary"> <i class="fa fa-save"></i> Submit Record </button>
											
										</div>
										
										<?php  
											
											// ------------------------------  form end ---------------------------------
											
											$currentdate=date('Y-m-d');
											
											
											
											$data = array('submit_date'  => $currentdate);
											
											 echo form_hidden($data);
											
											$data = array('date'  => $currentdate);
											
											echo form_hidden($data);
											
											$data = array('clientid'  => $cid);
											
											echo form_hidden($data);
											
											$data = array('archive'  => 'N');
											
											echo form_hidden($data);
											
											$data = array('submit'  => 'N');
											
											echo form_hidden($data);
											
											echo form_close();
											
										?>
										
										
										
									</div>
									
								</div>
								
								
								<div class="col-xs-12 col-md-12 padding_0px">
									
									<div class="panel panel-default" style="overflow-x: scroll;">
										
										<div class="panel-heading panel_custom">
											
											<i class="fa fa-list"></i> All records waiting to be finalized
											
										</div>
										
										<div class="panel-body hidden-xs hidden-sm">
											
											<?php if(count($client_records) > 0) { 
												
												$attributes = array('class' => 'form-auth-small form-inline', 'name'=>'form1', 'id' => 'form1');
												echo form_open_multipart('direct/bulk_action', $attributes); 
											?>   
											
											<table class="table">
												
												<thead>
													
													<tr>
														<th><?php	//$js = 'onClick="checkall(this.form)"'; echo form_checkbox('check_all', '1', false, $js); ?>
															<a onClick="checkall()" href="javascript:void(0)">Select all</a>/<a onClick="uncheckall()" href="javascript:void(0)">Unselect all</a>
														</th>
														<th>Consumer Name</th>
														
														<th>Consumer Account</th>
														
														<th>Payment</th>
														
														<th>Balance</th>
														
														<th>Type</th>
														
														<th>Cancel Reason</th>
														
														<th>Date Entered</th>
														
														<th>Action</th>
														
													</tr>
													
												</thead>
												
												<tbody>
													
													<?php foreach($client_records as $cval) { ?>  
														
														<tr>
															<td><input checked name="id[]" type="checkbox" value="<?php echo $cval['id']; ?>"></td>
															<td><?php echo $cval['name']; ?></td>
															
															<td><?php echo $cval['acctno']; ?>&nbsp;</td>
															
															<td><?php echo $cval['payment']; ?></td>
															
															<td><?php echo $cval['balance']; ?>&nbsp;</td>
															
															<td><?php echo $cval['paytype']; ?></td>
															
															<td><?php echo $cval['cancelwhy']; ?>&nbsp;</td>
															
															<td><?php if($cval['date']!='' && $cval['date']!='') { echo date('n/d/Y',strtotime($cval['date'])); } ?></td>
															
															
															
															<td nowrap>  
																
																<a class="bt btn-info btn-sm" href="<?php echo base_url() ?>direct/edit/<?php echo $cval['id']; ?>"><i title="Edit" class="fa fa-pencil"></i></a>&nbsp; 
																
																<a onClick="return confirm('Are you sure you want to delete?');" class="bt btn-danger btn-sm" href="<?php echo base_url() ?>direct/delete/<?php echo $cval['id']; ?>"><i title="Delete"  class="fa fa-trash"></i></a>&nbsp; 
																
																<!-- <a class="bt btn-danger btn-sm" href="<?php echo base_url() ?>direct/save/<?php echo $cval['id']; ?>"><i title="Finalize"  class="fa fa-save"></i></a>  -->
																
															</td>
															
														</tr>
														
													<?php } ?>   
													
													<tr>
														<td colspan="9" align="left"> <button onClick="return confdel();" class="btn btn-primary"> <i class="fa fa-save"></i> Finalize </button> <br>
															<small>NOTE: To Finalize and send to staff, select a record(s) and click the Finalize button.</small>
														</td>
													</tr> 
													
													
													
												</tbody>
												
												
												
											</table>
											
											
											
											<?php 
												echo form_close(); 
												
											} else { ?>  
											
											<table style="text-align:center;" class="table">
												
												
												
												<tr>
													
													<th> <center>No records to send to Centron.</center></th>
													
													
													
												</tr>
												
												
												
											</table>  
											
											<?php } ?>
											
											
											
										</div>
										
										
										
										<!--    Phone Views --------------------------------------------->
										
										<div class="panel-body hidden-lg hidden-md">
											
											<?php if(count($client_records) > 0) { ?>   
												
												<table class="table table-responsive">
													
													
													
													<tbody>
														
														<?php foreach($client_records as $cval) { ?>  
															
															
															
															<tr>
																
																<td> Name : </td> <td><?php echo $cval['name']; ?></td>
																
																
																
															</tr>
															
															<tr>
																<td>  Account : </td> <td> <?php echo $cval['acctno']; ?>  </td>
															</tr>
															
															
															
															<tr>
																
																<td> Payment : </td>  <td> <?php echo $cval['payment']; ?> </td>
																
															</tr>
															
															<tr>
																
																<td> Balance : </td>  <td> <?php echo $cval['balance']; ?> </td>
																
															</tr>
															
															
															<tr>
																
																<td> Type : </td>  <td> <?php echo $cval['paytype']; ?> </td>
																
															</tr>
															
															<tr>
																
																<td>   Cancel Reason : </td>  <td> <?php echo $cval['cancelwhy']; ?> </td>
																
															</tr>
															
															<tr>
																
																<td> Date Entered : </td> <td> <?php echo Date('n/d/Y',strtotime($cval['date'])); ?> </td>
																
															</tr>
															
															
															<tr>
																
																<td>
																	Action : 
																</td>
																
																<td nowrap>   
																	
																	<a class="bt btn-info btn-sm" href="<?php echo base_url() ?>direct/edit/<?php echo $cval['id']; ?>"><i title="Edit" class="fa fa-pencil"></i></a>  &nbsp; 
																	
																	<a onClick="return confirm('Are you sure you want to delete?');" class="bt btn-danger btn-sm" href="<?php echo base_url() ?>direct/delete/<?php echo $cval['id']; ?>"><i title="Delete" class="fa fa-trash"></i></a>  &nbsp; 
																	
																	<a class="bt btn-danger btn-sm" href="<?php echo base_url() ?>direct/save/<?php echo $cval['id']; ?>"><i title="Finalize" class="fa fa-save"></i></a>  
																	
																</td>
																
															</tr>
															
															<tr>
																<td style="border-left:1px solid #fff;">   </td> <td style="border-right:1px solid #fff;">   </td>
															</tr>
															
														<?php } ?>   
														
														
														
													</tbody>
													
													
													
												</table>
												
												
												
												<?php } else { ?>  
												
												<table style="text-align:center;" class="table">
													
													
													
													<tr>
														
														<th> <center>No records to send to Centron.</center></th>
														
														
														
													</tr>
													
													
													
												</table>  
												
											<?php } ?>
											
											
											
										</div>
										
										
										
										
										
										
									</div>
									
								</div>
								
								
								
								<div class="col-xs-12 col-md-12 padding_0px" >
									
									<div class="panel panel-default">
										
										
										
										<div class="panel-heading panel_custom">
											
											<i class="fa fa-list"></i> Review Historical Batches
											
										</div>
										
										<div class="panel-body">
											
											<?php if(count($client_batch) > 0) { ?>   
												
												<table class="table">
													
													<thead>
														
														<tr>
															
															<th> Date </th>
															
															<th colspan="3"> Action </th>
															
														</tr>
														
													</thead>
													
													<tbody>
														
														<?php foreach($client_batch as $cval) { ?>  
															
															<tr>
																
																<td> 
																	
																	<?php 
																		
																		$submit_date=$cval['submit_date']; 
																		if($submit_date=='') $submit_date='0000-00-00';
																		
																		$submit_datearr=explode("-",$submit_date);
																		
																		echo $submit_datearrstr=$submit_datearr['1']."/".$submit_datearr['2']."/".$submit_datearr['0'];
																		
																	?> 
																	
																</td>
																
																
																
																<td>  
																	
																	<a class="bt btn-danger btn-sm" href="<?php echo base_url() ?>direct/batches/<?php echo $cval['id']; ?>/<?php echo $cval['submit_date']; ?>"><i title="View Batch"  class="fa fa-eye"></i></a>  
																	
																</td>
																
															</tr>
															
														<?php } ?>   
														
														
														
													</tbody>
													
													
													
												</table>
												
												
												
												<?php } else { ?>  
												
												<table style="text-align:center;" class="table">
													
													
													
													<tr>
														
														<th> <center>Review Historical Batches .</center></th>
														
														
														
													</tr>
													
													
													
												</table>  
												
											<?php } ?>
											
											
											
										</div>
										
										
										
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