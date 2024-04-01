<?php 

$this->load->view('dts_staff/components/staff_main_header.php');
//$this->load->view('documents/components/test_header.php');
?>

<div class="wrapper"><!-- content-wrapper -->
<?php 
$this->load->view('dts_staff/components/staff_top_navigation.php');

?>
 
<?php 
$this->load->view('dts_staff/components/staff_left_sidebar.php');

?> 
<?php if(isset($mydetails)){

   foreach($mydetails as $myprofile){
	 
	}}   
?>	 
<?php
 if(isset($docsroute_count)){ $route_count=$docsroute_count;}else{$route_count="";} 
if(isset($pendingroute_count)){$proute_count=$pendingroute_count;}else{$proute_count="";}
if(isset($tempdocs_count)){$tempcount=$tempdocs_count;}else{$tempcount="";}
if(isset($count_fwdroute)){$fwdCount= $count_fwdroute;}else{$fwdCount="";}
?>
<!--------------  CONTENT   ----------------.>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       
       MY PERSONAL PROFILE PAGE
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.php/mydocuments"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">CHANGE PASSWORD</li>
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
              <h3 class="box-title">Change Password </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<?php 		echo form_open(base_url().'index.php/myprofile/change_password_validation');	?>	
            <div class="form-horizontal">
			
              <div class="box-body">	
	
			
			
				
				
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Current Password</label>

                  <div class="col-sm-8">
                    <input type="password" class="form-control" name="currentpassword"  required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">New Password</label>
				   <div class="col-sm-8">
             <input type="password" class="form-control" name="newpassword"  required>
                 
                </div>
				</div>
				 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label"> Confirm New Password</label>
				   <div class="col-sm-8">
             <input type="password" class="form-control" name="cnewpassword"  required>
               <input type="hidden" name="newuser_id" value="<?php echo $myprofile['users_id'];?>" >   
                </div>
				</div>
				
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
			   <div class="col-sm-11">
                <input type="reset" class="btn btn-default" value="Cancel">
                <input type="submit" class="btn btn-primary pull-right" value="Change Password">
				</div>
              </div>
              <!-- /.box-footer -->
    </div><!--div form -->
	<?php echo form_close(); ?>
</div>
</div>
<!---------app button -------   -->
<?php 
$this->load->view('dts_staff/components/staff_application_buttons.php');
?>  
<!------------ end app button--------->
</div>

 
	
		  
		  
		  
<!------------------------------------ ---------------------------------------------->
    </section>
    <!-- /.content -->
	 </div>
  <!-- /.content-wrapper -->

 
 <!------ // END CONTENT ----------------------- -->
  
 <?php 
$this->load->view('dts_staff/components/staff_footerbar.php');

?>  
  
 
 
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php 
$this->load->view('mydocuments/components/mydoc_footer.php');

?>   
