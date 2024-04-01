<?php 

$this->load->view('mydocuments/components/mydoc_main_header.php');

?>
<?php function viewtime($datetime){
	if($datetime!=0){
	         $time = strtotime($datetime);
			$receivetime = date("m/d/y @ g:i A", $time);
			return $receivetime;
	}else {return NULL;}
}
?>
<div class="wrapper"><!-- content-wrapper -->
<?php 
$this->load->view('mydocuments/components/mydoc_top_navigation.php');

?>
 
<?php 
$this->load->view('mydocuments/components/mydoc_left_sidebar.php');

?> 
<?php if(isset($mydetails)){

   foreach($mydetails as $myprofile){
	 
	}}   
?>	 
<?php
 if(isset($docsroute_count)){ $route_count=$docsroute_count;}else{$route_count="";} 
if(isset($pendingroute_count)){$proute_count=$pendingroute_count;}else{$proute_count="";}
if(isset($tempdocs_count)){$tempcount=$tempdocs_count;}else{$tempcount="";}
if(isset($co_users_count)){$coUsersCount= $co_users_count;}else{$$coUsersCount="";}
if(isset($count_fwdroute)){$fwdCount= $count_fwdroute;}else{$fwdCount="";}
?>
<!--------------  CONTENT   ----------------.>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       
       <?php if(isset($mysectionname)){echo $mysectionname;}?>
      </h1>
	  <h1>  <small>Forwarded Documents</small> </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
		<li><span id="time"> </span> <!--?php echo date("Y-m-d  H:i:s "); ? --></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
  
		  
	<!--- list-->
	
<?php
				
				if(validation_errors()){
					$error=validation_errors();
				echo '<div class="callout callout-warning"><h3 align="center">' .$error. '</h3></div>';	
				}
				
				if(isset($submission_success)){
					echo '<div class="callout callout-info"><h3 align="center">' .$submission_success. '</h3></div>';	
				}
				
			
				?>	
	
	

 <div class="row">
        <div class="col-md-12">
		
	<?php if (isset($forwardeddocs)){	?>		
          <div class="box">
		 
            <div class="box-header">
			<div class="box-title2">
			 Documents Forwarded
	   
	</div>		
	</div>
			
		
		
            <!-- /.box-header -->
            <div class="box-body">
			
		
              <table id="data_one" class="table table-bordered table-hover">
                <thead>
                <tr>
				<th class="hidden">No</th>
				<th width=8%>Tracking</th>
                 <th >TYPE & DESCRIPTION</th>
				 <th>FWD TO </th>
                 
				  <th >ACTIONS NEEDED</th>
                  <th  ><div align="center">Date & Time Forwarded </div></th>
				  
                  <th  ><div >Accepted
</div></th>
                 
                </tr>
                </thead>
                <tbody>
				<?php 
					$num=1;
				foreach($forwardeddocs as $doc){ ?>
                <tr>
				<td class="hidden"><?php echo $num; ?> </td>
				<td><a href="<?php echo base_url().'mydocuments/track_view/'.$doc ['doc_tracking'] ; ?>"><?php echo $doc ['doc_tracking']; ?></a> </td>
                  <td><?php echo $doc ['doctype_description']; ?><br><?php echo $doc ['docs_description']; ?> 
				  <br> <small> From : <?php echo $doc ['origin_fname']; ?> </small>
				  </td>
				   <td><?php echo $doc ['route_tosection'];    ?>          

				   </td>
				  
				    <td><?php echo $doc ['route_purpose']; ?> 
					 <?php  if($doc ['fwd_remarks'] != ""){
						echo '<br> <small><font color= "blue">FWD Remarks: '; 
						echo $doc ['fwd_remarks']. '</font></small>';
					} ?>
					</td>
				  <td align="center">  <?php echo viewtime($doc ['datetime_forwarded']); ?>    </td>
				 
				 <td> 
				<?php if ($doc ['receivedby_id']>0)	{ 		
				echo viewtime($doc ['datetime_route_accepted']);
				 } else {  ?>
				 <button type="submit" class="btn btn-block btn-warning" data-toggle="modal" data-target="#editroute<?php echo $doc ['action_id']; ?>" >Edit Route</button>
			<?php	} ?>				 
				 
				
				 
				<!-- ---------------- EditForwarding  Modal --------------------->
				<div class="modal fade" id="editroute<?php if (isset($doc ['action_id'])){ echo $doc ['action_id'];  }?>"tabindex="-1" role="dialog">
												  <div class="modal-dialog modal-md">
												  	
											<?php echo form_open(base_url().'index.php/mydocuments/edit_route');?>
													<div class="modal-content">
													  <div class="modal-header">
													  <h4 class="modal-title">EDIT ROUTING
													  
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														</h4>
														
													  </div>
													  <div class="modal-body">
													<table class="table ">
													<tr><td width=25%> Tracking</td><td><b><?php echo $doc ['doc_tracking']; ?></b> </td></tr> 
													<tr><td width=25%> Details</td><td><?php echo $doc ['doctype_description']; ?><br><?php echo $doc ['docs_description']; ?> 
																<br> <small> From : <?php echo $doc ['origin_fname']; ?></td></tr>  													
																										 
													 <tr><td> Route to :</td><td>
													 
								 <script type="text/javascript">  
												  $(document).ready(function() {  
													 $("#sectionsDrop<?php echo $doc ['action_id'];  ?>").change(function(){  
													 
													 /*dropdown post *///  
													 $.ajax({  
														url:"<?php echo base_url();?>index.php/mydocuments/get_users",  
														data: {unit_id:  //this is the post name
														   $(this).val()},  
														type: "POST",  
														success:function(data){  
														$("#usersDrop<?php echo $doc ['action_id']; ?>").html(data);  
													 }  
												  });  
											   });  
											});  
								 </script> 
								 
													<?php  $routeSecID= $doc ['route_tosection_id']; ?>  
													
													
															<?php if(isset($all_othersections)){?>  
															   <select name="office_id" id="sectionsDrop<?php echo $doc ['action_id'];  ?>" class="form-control" required>
															<option style="visibility: hidden; display: none;" value='' >--Select Section--</option>
																<?php foreach ($all_othersections as $section) { ?>
															<option value="<?php echo $section['section_id']?>"   > <?php echo $section['section_description']?></option>
																<?php } ?>
															</select>
																		  
																	<?php   } //end isset  sections?>
													 
													 </td> </tr>
													 <tr > <td> Personnel  </td>													 
													 <td> 
													 <select name="users_id" id="usersDrop<?php echo $doc ['action_id'];  ?>" class="form-control" required >																			 
													</select>																										 
													 </td>
													 </tr>
													 <tr > <td> Route Purpose </td> <td> <textarea class="form-control" name="fwd_remarks" rows="3"  > </textarea>																								 
													 </td>
													 </tr>
													 
													</table> 
													 <input type="hidden" name="action_id" value="<?php echo $doc ['action_id']; ?>" >
													
													
											           </div> <!--end body modal --->
													  <div class="modal-footer">
													  
													  <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Cancel</button>
													<button type="submit" class="btn btn-primary btn-md">Edit Forward</button>
																							
													  </div>
													</div><!-- /.modal-content -->
											<?php echo form_close(); ?>
													
												  </div><!-- /.modal-dialog -->
												</div><!-- /.modal -->		
												
				<!-- ---------------- //End Edit Forwarding Modal --------------------->	
				<!-- ---------------- end Modal --------------------->
				 </td>
                </tr>
				<?php 
				$num++;
				} ?>
	</tbody>
           
              </table>
			  
			 
			  
			  
            </div>
            <!-- /.box-body -->
          </div>
		<?php } else{?>	   
		   <div class="callout callout-success">
          <h4>No Forwarded Documents</h4>

          
        </div>
		  
		  
		  
		<?php }?>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
	<!-- /end list -->	  	  
	

 
	
		  
		  
		  

    </section>
    <!-- /.content -->
	 </div>
  <!-- /.content-wrapper -->

 
 <!------ // END CONTENT ----------------------- -->
  
 <?php 
$this->load->view('mydocuments/components/mydoc_footerbar.php');

?>  
  
 <?php 
$this->load->view('mydocuments/components/mydoc_right_controlsidebar.php');

?>   
 
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php 
$this->load->view('mydocuments/components/mydoc_footer.php');

?>   
