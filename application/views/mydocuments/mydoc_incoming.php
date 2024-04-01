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
?> 

<!--------------  CONTENT   ----------------.>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       
       <?php if(isset($mysectionname)){echo $mysectionname;}?>
      </h1>
	  <h1>  <small>Routed Documents with TRACKING NUMBER</small> </h1>
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
		
	<?php if (isset($routeddocs)){	?>		
          <div class="box">
		 
            <div class="box-header">
			<div class="box-title2">
			RECEIVE ROUTED DOCUMENTS
	   
	</div>		
	</div>
			
		
		
            <!-- /.box-header -->
            <div class="box-body">
			
		
              <table id="data_twoa" class="table table-bordered table-hover">
                <thead>
                <tr>
				<th width=8%>Tracking</th>
                 <th width=25% >TYPE & DESCRIPTION</th>
				 <th width=12%>FWD From</th>
                 
				  <th width=15%>ACTIONS NEEDED</th>
                  <th width=10%><div align="center">Date & Time Forwarded </div></th>
				  
                  <th width=10% ><div align="center">Action
</div></th>
                 
                </tr>
                </thead>
                <tbody>
				<?php 
					$num=1;
				foreach($routeddocs as $doc){ ?>
                <tr>
				<td align="center"><strong><a href="<?php echo base_url().'mydocuments/track_view/'.$doc ['doc_tracking'] ; ?>"><?php echo $doc ['doc_tracking']; ?> </a></strong></td>
                  <td><?php echo $doc ['doctype_description']; ?><br><?php echo $doc ['docs_description']; ?> 
				  <br> <small> From : <?php echo $doc ['origin_fname']; ?> </small>
				  </td>
				   <td><?php echo $doc ['section_description']; 
				   echo '<br> <small>By: '; 
						echo $doc ['route_from']. '</small>';
				   
				   ?>
                    

				   </td>
				  
				    <td><?php echo $doc ['route_purpose']; ?> 
					 <?php  if($doc ['fwd_remarks'] != ""){
						echo '<br> <small><font color= "blue">FWD Remarks: '; 
						echo $doc ['fwd_remarks']. '</font></small>';
					} ?>
					</td>
				  <td align="center">  <?php echo viewtime($doc ['datetime_forwarded']); ?>    </td>
				 
				 <td> 
							 			 
				 <button type="submit" class="btn btn-block btn-success" data-toggle="modal" data-target="#acceptroute<?php echo $doc ['action_id']; ?>" >Accept</button>
				<!-- ---------------- Modal --------------------->
				<div class="modal fade" id="acceptroute<?php if (isset($doc ['action_id'])){ echo $doc ['action_id'];  }?>"tabindex="-1" role="dialog">
												  <div class="modal-dialog modal-md">
												  	
											<?php echo form_open(base_url().'index.php/mydocuments/accept_routes');?>
													<div class="modal-content">
													  <div class="modal-header">
													  <h3 class="modal-title">Receive Routed Document <small> ( Route ID:  <?php echo $doc ['action_id']; ?>) </small>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														</h3>
														<small><font color="green">Route From : <?php echo $doc ['route_from']; ?></font> </small><br>														
														<?php echo $doc ['doctype_description']; ?><br><?php echo $doc ['docs_description']; ?> 
														( <small> <?php echo $doc ['origin_fname']; ?> </small>)
													
													  </div>
													  													  
													  <div class="modal-body">
													  
													 
													  
													  <table class="table table-bordered">
													  <tr> <td width=30%>Tracking Number  </td> <td><b> <?php echo $doc ['doc_tracking']; ?></b>
													 
													  </td ></tr>
														<tr> <td width=30%>Document Type  </td> <td> <?php echo $doc ['doctype_description']; ?></td ></tr>
														<tr> <td> Detail / Subject Matter  </td> <td><input type="text" class="form-control" name="docs_description" value="<?php echo $doc ['docs_description']; ?>" disabled ></td ></tr>
														<tr> <td> Actions Needed </td> <td>  <?php echo $doc ['route_purpose']; ?></td ></tr>
													    <tr> <td> Accepted by </td> <td> <?php echo $myprofile['fullname']; ?> </td ></tr>
														<tr> <td> Receiving Remarks </td> <td>  <textarea class="form-control" name="accepting_remarks" rows="3"  > </textarea></td ></tr>
													  </table>
													  <input type="hidden" name="action_id" value="<?php echo $doc ['action_id']; ?>" >
													   <input type="hidden" name="acceptedby_userid" value="<?php echo $myprofile['users_id']; ?>" >
													  <input type="hidden" name="acceptedby_fname" value="<?php echo $myprofile['fullname']; ?>" >
											           </div> <!--end body modal --->
													  <div class="modal-footer">
													  <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancel</button>
													<button type="submit" class="btn btn-success btn-lg">Accept Document</button>
																							
													  </div>
													</div><!-- /.modal-content -->
											<?php echo form_close(); ?>
													
												  </div><!-- /.modal-dialog -->
												</div><!-- /.modal -->		  
													  
				
				
				
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
          <h4>No Incoming Routed Documents</h4>
        
        </div>
	<!---------app button -------   -->
<?php 
$this->load->view('mydocuments/components/mydoc_application_buttons.php');
?>  
<!------------ end app button--------->
		  
		  
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
