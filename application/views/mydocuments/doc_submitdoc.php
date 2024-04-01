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
	
	<!------------------------------------          --------------------------->

 	
<div class="row">
	<div class="col-md-8">
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Submit New Document  </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<?php 		echo form_open(base_url().'index.php/documents/submit_document');	?>	
            <div class="form-horizontal">
			
              <div class="box-body">	
	
			<div class="form-group">
                  <label for="from" class="col-sm-3 control-label">FROM ( <?php echo $myschool;?>): </label>

                  <div class="col-sm-8">
				   <input type="hidden" name="submitter_section_id" value="<?php echo $myprofile['section_id'];?>" >
                    <input type="text" name="dummy_office" value="<?php echo $myprofile['section_description'];?>" class="form-control" placeholder="Section Name" disabled >
					
                  </div>
                </div>
			
			<div class="form-group">
                  <label for="from" class="col-sm-3 control-label">BY: </label>

                  <div class="col-sm-8">
				  <input type="hidden" name="submitter_id" value="<?php echo $myprofile['users_id'];?>" >
				   <input type="hidden" name="submitted_by" value="<?php echo $myprofile['fullname'];?>" >
                    <input type="text" name="dummy_who" value="<?php echo $myprofile['fullname'];?>" class="form-control" placeholder="Full Name" disabled >
					 <input type="hidden" name="school_id" value="<?php echo $myprofile['office_id'];?>" >
					 <input type="hidden" name="school" value="<?php echo $myschool;?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label for="document type" class="col-sm-3 control-label">Document Type</label>

                  <div class="col-sm-8">
				 <?php if(isset($docstypes)){?>  
					   <select name="document_type_id" id="office" class="form-control" required>
					<option style="visibility: hidden; display: none;" value='' >--Select--</option>
						<?php foreach ($docstypes as $docstype) {
					
						?>
					<option value="<?php echo $docstype['doctype_id'];?>"  > <?php echo $docstype['doctype_description'];?></option>
						<?php } ?>
					</select>
				 <?php } ?>			
                 
				 </div>
                </div>
				
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Details/Subject Matter</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="tempdoc_description" placeholder="Document Name" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Purpose</label>
				   <div class="col-sm-8">
               <textarea class="form-control" name="actions_needed" rows="3" placeholder="Purposes or Actions to be taken ..."  required ></textarea>
                 
                </div>
				</div>
				
				<div class="form-group">
                  <label for="inputSection" class="col-sm-3 control-label">TO / Receiving Section: </label>

                  <div class="col-sm-8">
				  <?php if(isset($receiving_sections)){?>  
					   <select name="section_id" id="sections" class="form-control" required>
							<option style="visibility: hidden; display: none;" value='' >--Select--</option>
							<?php foreach ($receiving_sections as $section) { ?>
							<option value="<?php echo $section['section_id']?>"  > <?php echo $section['section_description']?></option>
							<?php } ?>
						</select>
					  
				<?php   } //end isset  sections?>
				
                  </div>
                </div>

                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
			   <div class="col-sm-11">
                <input type="reset" class="btn btn-default" value="Cancel">
                <input type="submit" class="btn btn-success pull-right" value="Submit">
				</div>
              </div>
              <!-- /.box-footer -->
    </div><!--div form -->
	<?php echo form_close(); ?>
</div>
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
$this->load->view('documents/components/doc_right_controlsidebar.php');

?>   
 
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php 
$this->load->view('documents/components/doc_footer.php');

?>   
