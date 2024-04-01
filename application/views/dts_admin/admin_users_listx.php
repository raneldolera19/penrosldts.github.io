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


<!--------------  CONTENT   ----------------.>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Admin Dashboard
        <small>Document Tracking System</small>
      </h1>
      <ol class="breadcrumb">
      <!--  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>-->
		<li> <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#adduser" ><i class="fa  fa-user-plus"></i>&nbsp; New User</button></li>
      </ol>
    </section>
<hr>
    <!-- Main content -->
    <section class="content">
      
	 
	<!--- list-->	  
	
 <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
             
			   <h3 class="box-title">Users List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			
			
            <!--  <table id="example2" class="table table-bordered table-hover">-->
			 <hr>
<?php if(isset($userlist)){ ?>
			 <table id="data_one" class="table table-bordered table-striped">
			  
                <thead>
                <tr>
                  <th>Name</th>
				   <th>Gender</th>
                  <th>Email</th>
                  <th>Contact Number</th>
                  <th>School</th>
                  <th>DTS User</th>
				  <th>Action</th>
                </tr>
                </thead>
                <tbody>
			<?php foreach($userlist as $list){?>
                <tr>
                  <td><?php echo $list['fullname'];?></td>
				  <td><?php echo $list['sex'];?>  </td>
                  <td><?php echo $list['email'];?>  </td>
                  <td><?php echo $list['contact_number'];?> </td>
                  <td> <?php echo $list['school_name'];?></td>
                  <td><?php if($list['dts_section_id']>0){echo 'Yes';}?> </td>
				  <td width=150 >
				
				  <a href="<?php echo base_url(); ?>dts_admin/edit_user/<?php echo $list['users_id'];?>" >
				   <button type="button"  class="btn btn-success btn-sm"  >
				  <i class="fa fa-edit" ></i>
				  </button> </a> | 
				  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#reset_pass<?php echo $list['users_id']; ?>" >
				 
				  <i class="fa fa-refresh" ></i> Password
				  </button>
   
				  
<!-- -------- REset modal ------------------- ------->
<div class="modal fade" id="reset_pass<?php echo $list['users_id']; ?>">
          <div class="modal-dialog">
           <?php echo form_open(base_url().'index.php/dts_admin/reset_userpassword');?>
		   <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">RESET PASSWORD</h4>
              </div>
              <div class="modal-body">
			
			  <table class="table">
			  <tr>			
			<td>	 Name : </td><td><input type="text" style=" width: 300px;" class="form-control"  value="<?php echo $list['fullname'];?>" disabled>			
			<input type="hidden" name="newuser_id" value="<?php echo $list['users_id'];?>" >
			</td></tr><!--?php echo $list['email'];?-->
                <tr><td> New Password : </td> <td> <input type="text" name="newpassword" id="new_pass<?php echo $list['users_id']; ?>" style=" width: 300px;" data-pass="#reset_pass<?php echo $list['users_id']; ?>" class="form-control"  value="<?php echo $list['email'];?>"  required>								
			</td></tr>
			 <tr><td>  </td> <td> <label>
                    <input class="randompass" id="random" data-check="<?php echo $list['users_id']; ?>" type="checkbox"> Use Random Password
                  </label>								
			</td></tr>
			</table>	
              </div>
              <div class="modal-footer">
                <button type="close" class="btn  pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Reset Password</button>
              </div>
            </div>
			
				<?php echo form_close(); ?>
			
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

				
				
<!-- ---------------- end reset Modal --------------------->



				 </td>
                </tr>
			<?php } ?>
	</tbody>
           
              </table>
			  
<?php } ?>		  
			  
			  
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
	
	<!-- Add UserModal-->
    <div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
 <!--form -->
<?php 
		echo form_open(base_url().'dts_admin/add_newuser');
	?>
 
	   <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
		  	<div class="form-group">
						<div class="row">
						<label class="col-sm-3 control-label" align="right">First Name</label>
						<div class="col-sm-8">	
							<input  type="text" class="form-control" name="firstname" required=required>
			
						</div>
						 </div>
			</div>
			<div class="form-group">
						<div class="row">
						<label class="col-sm-3 control-label" align="right" required>Middle Name</label>
						<div class="col-sm-8">	
							<input  type="text" class="form-control" name="middlename" >
			
						</div>
						 </div>
			</div>
			<div class="form-group">
						<div class="row">
						<label class="col-sm-3 control-label" align="right" required>Last Name</label>
						<div class="col-sm-8">	
							<input  type="text" class="form-control" name="lastname" required >
			
						</div>
						 </div>
			</div>
			<div class="form-group">
						<div class="row">
						<label class="col-sm-3 control-label" align="right">Sex</label>
						<div class="col-sm-8">	
							<select name="sex" class="form-control" id="" name="usertype" required>
									   <option style="visibility: hidden; display: none;" value='' >--Select Gender--</option>
									  <option value="male"   > Male </option>
									   <option value="female"   > Female </option>
									   
							</select>
			
						</div>
						 </div>
			</div>	
			<div class="form-group">
						<div class="row">
						<label class="col-sm-3 control-label" align="right" >Email</label>
						<div class="col-sm-8">	
							<input  type="text" class="form-control" name="user_email" required >
			
						</div>
						 </div>
			</div>
			<div class="form-group">
						<div class="row">
						<label class="col-sm-3 control-label" align="right"  >Password</label>
						<div class="col-sm-8">	
							<!--<input  type="text" class="form-control" name="password" value="<?php  if(isset($random_password)){echo $random_password;} ?>" required >-->
							<input  type="text" class="form-control" name="password" value="1q2w3e4r5t" required >
							<input  type="hidden"  name="default_password" value="1q2w3e4r5t" >
							
						</div>
						 </div>
			</div>
			<div class="form-group">
						<div class="row">
						<label class="col-sm-3 control-label" align="right"  >Designation</label>
						<div class="col-sm-8">	
							<input  type="text" class="form-control" name="designation" required>
			
						</div>
						 </div>
			</div>
		<div class="form-group">
						<div class="row">
						<label class="col-sm-3 control-label" align="right"  >Contact Number</label>
						<div class="col-sm-8">	
							<input  type="text" class="form-control" name="contactnumber" required>
			
						</div>
						 </div>
			</div>
			
			
		<div class="form-group">
						<div class="row">
						<label class="col-sm-3 control-label" align="right"  >Station/School</label>
						<div class="col-sm-8">	
							<!--input  type="text" class="form-control" name="station" required-->
						

						<select name="station" id="office" class="form-control" required>
						<option style="visibility: hidden; display: none;" value='' >--Select--</option>
							<?php foreach($offices as $school) { ?>
						<option value="< ?php echo $school['sch_id']?>" <?php if($default_office_id==$school['sch_id']){echo 'selected';} ?> > <?php echo $school['school_name']?></option>
						   <?php } ?>
							
						</select>
						
						
						</div>
						 </div>
			</div>	
			
			<div class="form-group">
			<div class="row">
                  
				<label class="col-sm-3 control-label" align="right"  >Section</label>
                  <div class="col-sm-8">
                    <?php if(isset($sections)){?>  
					   <select name="section_id" id="office" class="form-control" required>
		<option style="visibility: hidden; display: none;" value='' >--Select--</option>
			<?php foreach ($sections as $section) {
			if(isset($defaultsection)){$dsect=$defaultsection;}else{$dsect='';}
			?>
			
        <option value="<?php echo $section['section_id']?>" <?php if($section['section_id']==$dsect){echo 'selected';} ?> > <?php echo $section['section_description']?></option>
			<?php } ?>
		</select>
					  
				<?php   } //end isset  sections?>
				 </div>
                  </div>
                </div>
			
<?php if($otherfields==0){ ?>
<input  type="hidden" name="schoolhead" value="no">
<input  type="hidden" name="ictcoordinator" value="no">	
<input  type="hidden" name="propertycustodian" value="no">
<?php }else {?>	
<div class="form-group">
						<div class="row">
						<label class="col-sm-3 control-label" align="right">School Head</label>
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
<?php }?>	
		
		</div>
  <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <input class="btn btn-primary" type="submit"  name="addnewuser" value="Add New User" >
          </div>
        </div>
<!--/form-->
<?php echo form_close(); ?>		
      </div>
    </div>
<!-- end MOdal -->
	
	
	
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
