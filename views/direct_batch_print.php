<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
		<title>Direct Payment Batch Print</title>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/fonts/iconic/css/material-design-iconic-font.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/css/style.css'); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/css/util.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/css/main.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/css/demo.css'); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/css/component.css'); ?>" />
	</head>
	<body>
		
		
		<div class="user-dashboard">
			<div class="col-lg-12 col-xs-12 padding_0px margin_top_panel">
				<div class="panel panel-default">
					<div class="panel-heading panel_custom"> <i class="fa fa-medkit"></i> Previously Submitted Batch on  <?php echo date('m/d/Y',strtotime($date));?> 
						<span class='pull-right'> <a onclick="javascript:window.print();" href="javascript:void(0);"><i class="fa fa-print"></i></a></span>    
					</div>
					<?php if(count($client_records) > 0) { ?>   
						<table class="table">
							<thead>
								
								<tr>
									<th>id</th>
									<th>clientid</th>
									<th>name</th>
									<th>acctno</th>
									<th>payment</th>
									<th>balance</th>
									<th>paytype</th>
									<th>cancelwhy</th>
									<th>postingins</th>
									<th>date</th>
									<th>submit</th>
									<th>submit_date</th>
									<th>archive</th>
									
									<th>email_sent</th>
								</tr>
								
							</thead>
							
							<tbody>
								
								<?php foreach($client_records as $cval) { ?>  
									
									<tr>
										<td><?php echo $cval['id']; ?></td>
										<td><?php echo $cval['clientid']; ?></td>
										<td><?php echo $cval['name']; ?></td>
										<td><?php echo $cval['acctno']; ?></td>
										<td><?php echo $cval['payment']; ?></td>
										<td><?php echo $cval['balance']; ?></td>
										<td><?php echo $cval['paytype']; ?></td>
										<td><?php echo $cval['cancelwhy']; ?></td>
										<td><?php echo $cval['postingins']; ?></td>
										
										<td nowrap><?php if($cval['date']!='0000-00-00' && $cval['date']!='') { echo date("m/d/Y",strtotime($cval['date'])); } else { echo"N/A"; } ?></td>
										<td><?php echo $cval['submit']; ?></td>
										
										<td nowrap><?php if($cval['submit_date']!='0000-00-00' && $cval['submit_date']!='') { echo date("m/d/Y",strtotime($cval['submit_date'])); } else { echo"N/A"; } ?></td>
										<td><?php echo $cval['archive']; ?></td>
										
										<td><?php echo $cval['email_sent']; ?></td>
										
										
										
									</tr>
									
								<?php } ?>   
								
								
								
							</tbody>
							
							
						</table>  
						
						
					<?php } ?>  
					
				</div>
			</div>
		</div>
		
		
	</body>
</html>
