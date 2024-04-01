<?php 

$this->load->view('dts_admin/components/admin_main_header.php');
//$this->load->view('documents/components/test_header.php');
?>

<div class="wrapper"><!-- content-wrapper -->
<?php 
$this->load->view('dts_admin/components/admin_top_navigation.php');

?>
 
<?php 
$this->load->view('dts_admin/components/admin_left_sidebar.php');

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
       SYSTEM ADMIN
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dts_admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Admin</li>
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
<?php if(isset($doc_details)){
	foreach ($doc_details as $doc){

?>		
	
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Document  </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<?php 		echo form_open(base_url().'dts_admin/submit_editdocument');	?>	
            <div class="form-horizontal">
			
              <div class="box-body">
			 <div class="form-group">
                  <label for="from" class="col-sm-3 control-label">DOCUMENT TRACK </label>

                  <div class="col-sm-8">
				  
                    <input type="text" name="tracking" value="<?php echo $doc['doc_tracking']; ?>" class="form-control" disabled >
					
                  </div>
                </div> 
	
			<div class="form-group">
                  <label for="from" class="col-sm-3 control-label">OFFICE : </label>

                  <div class="col-sm-8">
				  
                    <input type="text" name="origin_school" value="<?php echo $doc['origin_school']; ?>" class="form-control"  >
					
                  </div>
                </div>
			
			<div class="form-group">
                  <label for="from" class="col-sm-3 control-label">BY: </label>

                  <div class="col-sm-8">
				   <input type="text" name="origin_fname" value="<?php echo $doc['origin_fname']; ?>" class="form-control" required >
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
					<option value="<?php echo $docstype['doctype_id'];?>" <?php if ($doc['doc_type_id']=$docstype['doctype_id']){echo "selected";}?>  > <?php echo $doc['doctype_description'];?></option>
						<?php } ?>
					</select>
				 <?php } ?>			
                 
				 </div>
                </div>
				
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Details/Subject Matter</label>

                  <div class="col-sm-8">
                    <!--input type="text" class="form-control" name="doc_description" placeholder="Document Name" required -->
					<textarea class="form-control" rows="3" cols="60" name="docs_description" required> <?php echo $doc['docs_description'];?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Purpose / Actions Needed</label>
				   <div class="col-sm-8">
               <textarea class="form-control" name="actions_needed" rows="3"  required > <?php echo $doc['actions_needed'];?> </textarea>
                 
                </div>
				</div>
				<input type="hidden" name="doc_id" value="<?php echo $doc['doc_id']; ?>"  >
				<input type="hidden" name="user_id" value="<?php echo $myprofile['users_id']; ?>"  >
				
				
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
			   <div class="col-sm-11">
                <input type="reset" class="btn btn-default" value="Cancel">
                <input type="submit" class="btn btn-primary pull-right" value="Save Changes">
				</div>
              </div>
              <!-- /.box-footer -->
    </div><!--div form -->
	<?php echo form_close(); ?>
</div>

<?php	}	}// if isset ?>

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
