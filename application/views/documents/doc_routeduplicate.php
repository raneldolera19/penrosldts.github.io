<?php 

$this->load->view('documents/components/doc_main_header.php');
//$this->load->view('documents/components/test_header.php');
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
if(isset($co_users_count)){$coUsersCount= $co_users_count;}else{$$coUsersCount="";}
if(isset($count_fwdroute)){$fwdCount= $count_fwdroute;}else{$fwdCount="";}
?>
<!--------------  CONTENT   ----------------.>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       
        <small><?php if(isset($mysectionname)){echo $mysectionname;}?> | Routed  Incoming Documents</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.php/documents"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Submit Document</li>
		<li><span id="time"> </span> <!--?php echo date("Y-m-d  H:i:s "); ? --></li>
      </ol>
    </section>
<hr>
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
		<div class="callout callout-danger" align="center"><font size="5"><i> New Forwarded Document </i><br> Tracking Code : <?php echo $track_code; ?> </font><br>
		<?php if(isset($doc_details)){
			foreach ($doc_details as $doc){
		//	$time = strtotime($doc['datetime_accepted']);
		//	$receivetime = date("m/d/y @ g:i A", $time);
			echo 'Date & Time FORWARDED : <font size="4"><b>'.$doc['datetime_posted']. '</b></font><br>';	
			
			echo $doc['doctype_description']. ' | '  ;	
			echo $doc['docs_description']. ' | ';
			
			echo 'Purpose : '.$doc['actions_needed'] .' <br> ';
			echo '<hr width=70%><font size="4"> You may now  forward this document to : '.$doc['section_description']. ' </font> ';
			}}?>
					
	</div>
<?php 	}?>	
	<!------------------------------------          --------------------------->

 	
<div class="row">
	<div class="col-md-8">


<div class="box box-info">
            <div class="box-header with-border">
              <h2 class="box-title"><strong> ROUTE DUPLICATE COPY  (PAge Under Construction) </strong> </h2>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<?php if(isset($route_details)){ 
foreach ($route_details as $route){
	 
?>	
			
			<?php 		echo form_open(base_url().'index.php/documents/submit_duplicateroute');	?>	
            <div class="form-horizontal">
			
              <div class="box-body">	
	
			<div class="form-group">
                  <label for="from" class="col-sm-3 control-label">TRACKING </label>

                  <div class="col-sm-8">
				   <input type="hidden" name="submitter_section_id" value="<?php echo $myprofile['section_id'];?>" >
                    <input type="text" name="track_id" value="<?php echo $route['doc_tracking'];?>" class="form-control"  disabled >
					
                  </div>
                </div>
			 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Document Type</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="doctype_description"  value="<?php echo $route['doctype_description'];?>"  disabled>
                  </div>
                </div>
			<div class="form-group">
                  <label for="from" class="col-sm-3 control-label">Document Details </label>

                  <div class="col-sm-8">
				  <textarea class="form-control" rows="3" class="form-control" name="doc_description" disabled> <?php echo $route['docs_description'];?> </textarea>
                  </div>
                </div>
			<div class="form-group">
                  <label for="from" class="col-sm-3 control-label">ACTIONS TAKEN </label>

                  <div class="col-sm-8">
				  <textarea rows="3" class="form-control" disabled> <?php echo $route['actions_taken'];?> </textarea>
                  </div>
                </div>	
				
                
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Purpose of Route</label>
				   <div class="col-sm-8">
               <textarea class="form-control" name="actions_needed" rows="3" placeholder="Purposes  or Actions to be taken ..."  required ></textarea>
                 
                </div>
				</div>
				
				<div class="form-group">
                  <label for="inputSection" class="col-sm-3 control-label">TO / Receiving Section: </label>

                  <div class="col-sm-8">
				  <?php if(isset($receiving_sections)){?>  
					   <select name="section_id" id="sectionsDrop" class="form-control" required>
							<option style="visibility: hidden; display: none;" value='' >--Select--</option>
							<?php foreach ($receiving_sections as $section) { ?>
							<option value="<?php echo $section['section_id']?>"  > <?php echo $section['section_description']?></option>
							<?php } ?>
						</select>
					  
				<?php   } //end isset  sections?>
				
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputSection" class="col-sm-3 control-label">Personnel: </label>

                  <div class="col-sm-8">
				  <select name="users_id" id="usersDrop" class="form-control" required >																			 
													</select>
				
                  </div>
                </div>
				
				<input type="hidden" name="action_id" value="<?php echo $route ['action_id']; ?>" >
				<input type="hidden" name="document_id" value="<?php echo $route['document_id']; ?>" >
				<input type="hidden" name="fwdby_userid" value="<?php echo $myprofile['users_id']; ?>" >
				<input type="hidden" name="fwdby_fname" value="<?php echo $myprofile['fullname']; ?>" >
				<input type="hidden" name="fwdby_section_id" value="<?php echo $myprofile['dts_section_id']; ?>" >
				<input type="hidden" name="route_purpose" value="<?php echo $route ['route_purpose'];  ?>" >
				
				
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
			   <div class="col-sm-11">
                <input type="reset" class="btn btn-default" value="Cancel">
                <input type="submit" class="btn btn-info pull-right" value="Route Duplicate Copy">
				</div>
              </div>
			  
			  
			  
			  
			  
              <!-- /.box-footer -->
    </div><!--div form -->
	<?php echo form_close(); ?>
	
	<?php
}
}
?>	


</div>
<!------------   -->

 <!-- Application buttons -->
  <?php 
$this->load->view('documents/components/doc_application_buttons.php');
?>  
<!------------------ end buttons          --->

		  
<!------------------------------------ ---------------------------------------------->
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
