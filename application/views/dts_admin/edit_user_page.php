<?php 
$this->load->view('dts_admin/components/admin_main_header.php');

?>

<div class="wrapper"><!-- content-wrapper -->
<?php 
$this->load->view('dts_admin/components/admin_top_navigation.php');

?>
 
<?php 
$this->load->view('dts_admin/components/admin_left_sidebar.php');

?> 

<?php if(isset($mydetails)){

   foreach($mydetails as $profile){
	 
	}}   
?>	 

<!--------------  CONTENT   ----------------.>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        
        Edit User
      </h1>
      <ol class="breadcrumb">
      <!--  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>-->
		
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
<?php if(isset($user_data)){ foreach($user_data as $user){
  //  $user['station_id'];
}}
?>	
	<!--- list-->	  
	
 <div class="row">
 <div class="col-sm-2">	
		  <div class="user-header">
		 <img src="<?php echo base_url().$user['dts_image_url']; ?>" class="img-circle" alt="User Image">
						 </div>
						  </div>
        <div class="col-xs-10">
          <div class="box">
            <div class="box-header">
             
			   
            </div>
            <!-- /.box-header -->
            <div class="box-body">
      
	<!-- <form> -->
	<?php echo form_open(base_url().'dts_admin/update_user');	?>
	              
	
		  	<div class="form-group">
						<div class="row">
						<label class="col-sm-3 control-label" align="right">First Name</label>
						<div class="col-sm-6">	
							<input  type="text" class="form-control" name="firstname" value="<?php echo $user['first_name']; ?>" required=required>
							<input  type="hidden" class="form-control" name="user_id" value="<?php echo $user['users_id']; ?>" >
						</div>
						
						 </div>
			</div>
			<div class="form-group">
						<div class="row">
						<label class="col-sm-3 control-label" align="right"  >Middle Name</label>
						<div class="col-sm-6">	
							<input  type="text" class="form-control" name="middlename" value="<?php echo $user['middle_name']; ?>">
			
						</div>
						 </div>
			</div>
			<div class="form-group">
						<div class="row">
						<label class="col-sm-3 control-label" align="right" required>Last Name</label>
						<div class="col-sm-6">	
							<input  type="text" class="form-control" name="lastname" value="<?php echo $user['last_name']; ?>" required >
			
						</div>
						 </div>
			</div>
			<div class="form-group">
						<div class="row">
						<label class="col-sm-3 control-label" align="right">Sex</label>
						<div class="col-sm-6">	
							<select name="sex" class="form-control" id="" name="usertype" required>
									   <option style="visibility: hidden; display: none;" value='' >--Select Gender--</option>
									  <option value="male" <?php if($user['sex']=="male"){ echo "selected";} ?>   > Male </option>
									   <option value="female" <?php if($user['sex']=="female"){ echo "selected";} ?>  > Female </option>
									   
							</select>
			
						</div>
						 </div>
			</div>	
			<div class="form-group">
						<div class="row">
						<label class="col-sm-3 control-label" align="right" >Email</label>
						<div class="col-sm-6">	
							<input  type="text" class="form-control" name="user_email" value="<?php echo $user['email']; ?>" required >
			
						</div>
						 </div>
			</div>
			
			<div class="form-group">
						<div class="row">
						<label class="col-sm-3 control-label" align="right"  >Designation</label>
						<div class="col-sm-6">	
							<input  type="text" class="form-control" name="designation" value="<?php echo $user['designation']; ?>" required>
			
						</div>
						 </div>
			</div>
		<div class="form-group">
						<div class="row">
						<label class="col-sm-3 control-label" align="right"  >Contact Number</label>
						<div class="col-sm-6">	
							<input  type="text" class="form-control" name="contactnumber" value="<?php echo $user['contact_number']; ?>" required>
			
						</div>
						 </div>
			</div>
			
			
		<div class="form-group">
						<div class="row">
						<label class="col-sm-3 control-label" align="right"  >Office</label>
						<div class="col-sm-6">	
							<!--input  type="text" class="form-control" name="station" required-->
						

						<select name="station" id="office" class="form-control" required>
						<option style="visibility: hidden; display: none;" value='' >--Select--</option>
							<?php foreach($offices as $school) { ?>
						<option value="<?php echo $school['sch_id']?>" <?php if($user['station_id']==$school['sch_id']){echo 'selected';} ?> > <?php echo $school['school_name']?></option>
							<?php } ?>
						</select>
						
						
						</div>
						 </div>
			</div>	
			
			<div class="form-group">
			<div class="row">
                  
				<label class="col-sm-3 control-label" align="right"  >Section </label>
                  <div class="col-sm-6">
                    <?php if(isset($sections)){?>  
					   <select name="section_id" id="office" class="form-control" required>
		<option style="visibility: hidden; display: none;" value='' >--Select--</option>
			<?php foreach($sections as $section){ ?>
			
        <option value="<?php echo $section['section_id']?>" <?php if($user['dts_section_id']==$section['section_id']){ echo "selected";}?>  > <?php echo $section['section_description'];?></option>
			<?php }?>
		</select>
					  
				<?php   } //end isset  sections?>
				 </div>
                  </div>
                </div>
			
<?php 
if(isset($otherfields)){
if($otherfields==0){ ?>
<input  type="hidden" name="schoolhead" value="no">
<input  type="hidden" name="ictcoordinator" value="no">	
<input  type="hidden" name="propertycustodian" value="no">
<?php }else {?>	
<div class="form-group">
						<div class="row">
						<label class="col-sm-3 control-label" align="right"> Head</label>
						<div class="col-sm-8" align="left">	
							<select class="form-control" id="" name="schoolhead" required>
									   <option style="visibility: hidden; display: none;" value='' >--Select--</option>
									 <option value="0" selected > NO </option>
									   <option value="1"   > YES </option>
									   
							</select>
						</div>
						 </div>
			</div>	
			
			<div class="form-group">
						<div class="row">
						<label class="col-sm-3 control-label" align="right">ICT Coordinator</label>
						<div class="col-sm-8" align="left">	
							<select class="form-control" id="" name="ictcoordinator" required>
									   <option style="visibility: hidden; display: none;" value='' >--Select--</option>
									 <option value="0" selected > NO </option>
									   <option value="1"   > YES </option>
									   
							</select>
						</div>
						 </div>
			</div>	
			<div class="form-group">
						<div class="row">
						<label class="col-sm-3 control-label" align="right">Property Custodian</label>
						<div class="col-sm-8" align="left">	
							<select class="form-control" id="" name="propertycustodian" required>
									   <option style="visibility: hidden; display: none;" value='' >--Select--</option>
									  <option value="0" selected  > NO </option>
									   <option value="1"   > YES </option>
									   
							</select>
						</div>
						 </div>
			</div>	
<?php }}?>	
		
		
	  
	  <div class="form-group">
						<div class="row">
						<label class="col-sm-3 control-label" align="right"  ></label>
						<div class="col-sm-3" align="right" >	
							
						<input  type="reset" class="btn"  value="Cancel" >	
			
						</div>
						<div class="col-sm-3">	
						
						<input  type="submit" class="btn btn-primary"  value="Update" >
						</div>
						 </div>
			</div>
	  
	<!--	</form>	  -->
        <?php echo form_close(); ?>    
			
			
			</div>
            <!-- /.box-body -->
          </div>
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
$this->load->view('dts_admin/components/admin_footerbar.php');

?>  
  
 <?php 
//$this->load->view('dts_admin/components/admin_right_controlsidebar.php');

?>   
 
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php 
$this->load->view('dts_admin/components/admin_footer.php');

?>   
