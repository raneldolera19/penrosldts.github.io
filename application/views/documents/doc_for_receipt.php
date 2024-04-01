<?php 

$this->load->view('documents/components/doc_main_header.php');

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
$this->load->view('documents/components/doc_top_navigation.php');

?>
 
<?php 
$this->load->view('documents/components/doc_left_sidebar.php');

?> 

<?php if(isset($mydetails)){

   foreach($mydetails as $myprofile){
	 
	}}   
?>	 
<?php
 if(isset($docsroute_count)){ $route_count=$docsroute_count;}else{$route_count="";} 
if(isset($pendingroute_count)){$proute_count=$pendingroute_count;}else{$proute_count="";}
if(isset($tempdocs_count)){$tempcount=$tempdocs_count;}else{$tempcount="";}
if(isset($co_users_count)){$coUsersCount= $co_users_count;}else{$coUsersCount="";}
if(isset($count_fwdroute)){$fwdCount= $count_fwdroute;}else{$fwdCount="";}
?>
<!--------------  CONTENT   ----------------.>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?php if(isset($mysectionname)){echo $mysectionname;}?> 
        <small></small>
      </h1>
	  <h1>
         <small> Documents to Receive  WITHOUT TRACKING NUMBER</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
		<li><span id="time"> </span> </li>
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
<?php if(isset($track_code)){ ?> 
		<div class="callout callout-success" align="center"><font size="5"><i> New accepted document </i><br> Tracking Code : <?php echo $track_code; ?> </font><br>
		<?php if(isset($doc_details)){
			foreach ($doc_details as $doc){
			$time = strtotime($doc['datetime_accepted']);
			$receivetime = date("m/d/y @ g:i A", $time);
			echo 'Date & Time Accepted : <font size="4"><b>'.$receivetime. '</b></font><br>';	
			echo $doc['doctype_description']. ' | '  ;	
			echo $doc['docs_description']. ' | ';
			echo 'FROM : '.$doc['origin_fname']. ' <br> ';
			echo 'Purpose : '.$doc['actions_needed'] .' <br> ';
			
			}}?>
					
	</div>
<?php 	}?>	
	
	

 <div class="row">
        <div class="col-md-12">
		
	<?php if (isset($mytempdocs)){	?>		
          <div class="box">
		 
            <div class="box-header">
			<div class="box-title">
			FOR RECEIVING
	   
	</div>		
	</div>
			
		
		
            
            <div class="box-body">
			
		
              <table id="data_one" class="table table-bordered table-hover">
                <thead>
                <tr>
				  <th width=12%>Type</th>
                  <th width=18%>Details</th>
				  <th>From</th>
				  <th>Office</th>
				  <th width=20% >ACTIONS NEEDED</th>
                  <th >Date & Time Posted</th>
                  <th>Receive</th>
                <?php if($myprofile['dts_admin']==1){?>  <th>Delete</th> <?php } ?>
                </tr>
                </thead>
                <tbody>
				<?php 
					$num=1;
				foreach($mytempdocs as $doc){ ?>
                <tr>
				<td><?php echo $doc ['doctype_description']; ?>            </td>
                  <td><?php echo $doc ['tempdoc_description']; ?> </td>
				  <td><?php echo $doc ['section_description']; ?> <br><small> <?php echo $doc ['submitted_by']; ?></small>  </td>
				   <td>  <?php echo $doc ['school']; ?>         </td>
				    <td><?php echo $doc ['actions_needed']; ?> </td>
				  <td>  <?php echo viewtime($doc ['datetime_posted']); ?>    </td>
				 <td> 
				  <button type="submit" class="btn btn-block btn-primary" data-toggle="modal" data-target="#accept<?php echo $doc ['tempdoc_id']; ?>" >Receive</button>
				 <!--- --------MODAL ACCEPT ------------------------>
				 	<div class="modal fade" id="accept<?php if (isset($doc ['tempdoc_id'])){ echo $doc ['tempdoc_id'];  }?>"tabindex="-1" role="dialog">
												  <div class="modal-dialog modal-md">
												  	
											<?php echo form_open(base_url().'documents/accept_tempdocument');?>
													<div class="modal-content">
													  <div class="modal-header">
													  <h3 class="modal-title">Receive & Accept Document 
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														</h3>
													  </div>
													  <div class="modal-body">
														<h4><i><b> Are you sure you want to accept this document from <font color="blue"><?php echo $doc ['submitted_by']; ?></font> ?</b></i></h4>
														<table class="table table-bordered">
														<tr> <td width=30%>Document Type  </td> <td> <?php echo $doc ['doctype_description']; ?></td ></tr>
														<tr> <td> Details / Subject Matter  </td> <td>
														<!--input type="text" style="width: 400px; " class="form-control" name="docs_description" value="</?php echo $doc ['tempdoc_description']; ?>" required ><br>-->
														<textarea style="width: 400px;" class="form-control" name="docs_description" rows="3" required > <?php echo $doc ['tempdoc_description']; ?></textarea>
														
														</td ></tr>
														<tr> <td> Actions Needed </td> <td> 
														<!--textarea style="width: 400px; class="form-control" name="actions_needed" rows="3" required ></textarea -->
														<textarea class="form-control" rows="3" cols="60" name="actions_needed" required> <?php echo $doc ['actions_needed']; ?> </textarea>
														
														</td ></tr>
													    <tr> <td> Accepted by </td> <td> <?php echo $myprofile['fullname']; ?> </td ></tr>
													  </table>
													   <input type="hidden" name="receiving_section" value="<?php echo $myprofile['dts_section_id']; ?>" >
													  <input type="hidden" name="acceptedby_userid" value="<?php echo $myprofile['users_id']; ?>" >
													  <input type="hidden" name="doc_type_id" value="<?php echo $doc['temp_doctype_id'];?>" >
													  <input type="hidden" name="tempdocs_id" value="<?php  echo $doc ['tempdoc_id']; ?>">
													  <input type="hidden" name="origin_fname" value="<?php echo $doc ['submitted_by']; ?>" >
													  <input type="hidden" name="origin_userid" value="<?php echo $doc ['submitter_id']; ?>" >
													  <input type="hidden" name="origin_section" value="<?php echo $doc ['fromsection_id']; ?>" >
														<input type="hidden" name="datetime_posted" value="<?php echo $doc ['datetime_posted']; ?>" > 
														<input type="hidden" name="school" value="<?php echo $doc ['school']; ?>" > 
															<input type="hidden" name="school_id" value="<?php echo $doc ['school_id']; ?>" > 
													   </div> <!--end body modal --->
													  <div class="modal-footer">
													  											
														
														<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancel</button>
																						
																						<button type="submit" class="btn btn-success btn-lg">Accept Document</button>
														
																						
													  </div>
													</div><!-- /.modal-content -->
											<?php echo form_close(); ?>
													
												  </div><!-- /.modal-dialog -->
												</div><!-- /.modal -->
											
				 
				 <!--- --------End/ MODAL ACCEPT ------------------------>
				 </td>
			 <?php if($myprofile['dts_admin']==1){?>  	 <td> 
				  <button type="submit" class="btn btn-block btn-danger" data-toggle="modal" data-target="#delete<?php echo $doc ['tempdoc_id']; ?>"  >Delete</button>
				

 <!--- --------MODAL DELETE ------------------------>
				 	<div class="modal fade" id="delete<?php if (isset($doc ['tempdoc_id'])){ echo $doc ['tempdoc_id'];  }?>"tabindex="-1" role="dialog">
												  <div class="modal-dialog modal-md">
												  	
											<?php echo form_open(base_url().'documents/remove_tempdocument');?>
													<div class="modal-content">
													  <div class="modal-header">
													  <h3 class="modal-title">DELETE
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														</h3>
													  </div>
													  <div class="modal-body">
														<h3><i><b> <font color="red"> Are you sure you want to DELETE this document from <br> <?php echo $doc ['submitted_by']; ?>?</font> </b></i></h3>
														<table class="table table-bordered">
														<tr> <td width=30%>Document Type  </td> <td> <?php echo $doc ['doctype_description']; ?></td ></tr>
														<tr> <td> Detail / Subject Matter  </td> <td>
														
														<textarea style="width: 400px;" class="form-control" name="docs_description" rows="3" disabled> <?php echo $doc ['tempdoc_description'];   ?></textarea>
														
														</td ></tr>
														<tr> <td> Actions Needed </td> <td>  <textarea style="width: 400px; class="form-control" name="actions_needed" rows="3" disabled> <?php echo $doc ['actions_needed']; ?></textarea></td ></tr>
													   
													  </table>
													   <input type="hidden" name="tempdoc_id" value="<?php echo $doc ['tempdoc_id']; ?>" >
													 <input type="hidden" name="removeby_id" value="<?php echo $myprofile['users_id']; ?> " >
													   </div> <!--end body modal --->
													  <div class="modal-footer">
													  	<script>
															function delFunc() {
																alert("Are you sure you want to delete!");
															}
															</script>										
																													
														<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancel</button>
																						
																						<button type="submit" class="btn btn-danger btn-lg" onclick="delFunc()" >Delete Document</button>
														
																						
													  </div>
													</div><!-- /.modal-content -->
											<?php echo form_close(); ?>
													
												  </div><!-- /.modal-dialog -->
												</div><!-- /.modal -->
											
				 
				 <!--- --------End/ MODAL DELETE ------------------------>





				
			 </td> <?php } ?>
				 
				 
                </tr>
				<?php 
				$num++;
				} ?>
	</tbody>
           <!--   <tfoot>
                <tr>
                  <th>No</th>
				  <th>Office</th>
                  <th>Section Name</th>
                  <th>Edit</th>
                  <th>Remove</th>
                  
                </tr>
                </tfoot>-->
              </table>
			  
			 
			  
			  
            </div>
            <!-- /.box-body -->
          </div>
		<?php } else{?>	   
		  <div class="row">
	<div class="col-md-8">	
		   <div class="callout callout-warning">
          <h4>No Receivable Documents</h4>

        </div>
	</div>	  
<!-- Application buttons -->
  <?php 
$this->load->view('documents/components/doc_application_buttons.php');
?>  
<!-----------------end application buttons          --->
</div>	
		<?php }?>
          <!-- /.box -->
      
        <!-- /  .col -->
      </div>
	<!-- /end list -->	  	  
	

 
	
		  
		  
		  

    </section>
    <!-- /.content -->
	 </div>
  <!-- /.content-wrapper -->

 
 <!------ // END CONTENT ----------------------- -->
  
 <?php 
$this->load->view('documents/components/doc_footerbar.php');

?>  
  
 <?php 
//$this->load->view('documents/components/doc_right_controlsidebar.php');

?>   
 
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php 
$this->load->view('documents/components/doc_footer.php');

?>   
