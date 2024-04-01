<?php date_default_timezone_set('Asia/Manila'); ?>

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
      SYSTEM ADMIN
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
		<li><?php echo date("Y-m-d  H:i:s "); ?></li>
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
	
	

 <div class="row">
        <div class="col-md-12">
		
		
          <div class="box">
		 
            <div class="box-header">
			<div class="box-title2">
			 <div class="row">
        <div class="col-lg-6"><font size="5"> Sections </font> </div>
		<div class="col-lg-6" align="right"> 
		 	 
			 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addsection" ><i class="fa fa-plus-square-o"></i>&nbsp; New Section</button>
      </div>
	   
	</div>		
	</div>
		</div>	
		
		
            <!-- /.box-header -->
            <div class="box-body">
			
		<?php
			
		
			if (isset($allsections)){
			
			
		?>	
              <table id="data_twoa" class="table table-bordered table-hover">
                <thead>
                <tr>
				<th width=8%>No</th>
                 <!-- <th width=8%>SECTION ID</th>-->
				  <th width=15% >OFFICE</th>
                  <th>GROUP / SECTION NAME</th>
				 <th width=12%>SECTION ID</th>
				  <th width=12%><div align="center">Receiving Unit</div></th>
                  <th width=10% ><div align="center">Edit</div></th>
                  <th width=10% ><div align="center">Remove</div></th>
                 
                </tr>
                </thead>
                <tbody>
				<?php 
					$num=1;
				foreach($allsections as $section){ ?>
                <tr>
				<td><?php echo $num; ?></td>
                  <!--<td><1?php echo $section ['section_id']; ?></td>-->
				   <td><?php echo $section ['school_name']; ?>    </td>
                  <td><?php echo $section ['section_description']; ?> </td>
				   <td><?php echo $section ['section_id']; ?>            </td>
				    <td align="center"><?php if($section ['initial_receipt']==1){echo 'YES'; }else {echo 'NO';}?>            </td>
				  <td>
				  <div align="center">
				  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editsection<?php echo $section ['section_id'];?>" >
				  <i class="fa fa-fw fa-pencil-square-o"></i>Edit
				  </button>
				  </div>
				<!--edit modal --> 

				<div class="modal fade" id="editsection<?php if (isset($section ['section_id'])){ echo $section ['section_id'];  }?>"tabindex="-1" role="dialog">
				 <div class="modal-dialog">
					<?php echo form_open(base_url().'index.php/dts_admin/edit_section');	?>
													
					<div class="modal-content">
						 <div class="modal-header">
						<h4 class="modal-title">Edit :  <?php echo $section ['section_description']; ?>   <!--?php echo $section ['section_id']; ?--> 
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</h4>
								</div>
							<div class="modal-body">
														
														
			<div class="form-horizontal">
              <div class="box-body">
			  <div class="form-group">
                  <label for="office" class="col-sm-3 control-label">Office</label>

                  <div class="col-sm-9">
				  
                  <!--  <input type="text" name='office' class="form-control"  placeholder="Office/School"> -->
                 <select name="office_id" id="office" class="form-control" required>
		<option style="visibility: hidden; display: none;" value='' >--Select--</option>
			<?php foreach($offices as $school) { ?>
        <option value="<?php echo $school['sch_id']?>" <?php if($section ['office_id']==$school['sch_id']){echo 'selected';} ?> > <?php echo $school['school_name']?></option>
			<?php } ?>
		</select>

				 </div>
                </div>
                <div class="form-group">
                  <label for="section_description" class="col-sm-3 control-label">Section Name</label>

                  <div class="col-sm-9">
                    <input type="text" name='section_description' class="form-control"  value="<?php echo $section['section_description']; ?>" required>
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="allow_receipt" class="col-sm-3 control-label">Receiving Unit</label>
                 <div class="col-sm-9">
				  <select name="allow_receipt" id="office" class="form-control" required>
					<option style="visibility: hidden; display: none;" value='' >--Select--</option>
					<option value="0" <?php if($section ['initial_receipt']==0){echo 'selected';} ?> > NO</option>
					<option value="1" <?php if($section ['initial_receipt']==1){echo 'selected';} ?> > YES</option>	
				</select>
				 </div>
                </div>
				
               
              </div>
              
            </div>
														
														
														
														
													  </div>
											<div class="modal-footer">													  
											<input type="hidden" name="section_id" value="<?php if (isset($section ['section_id'])){ echo $section ['section_id'];  }?>">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																			
											<button type="submit" class="btn btn-primary">Save</button>
											<?php echo form_close(); ?>
														
													  </div>
													  
													  
													  
													  
													</div><!-- /.modal-content -->
													<?php echo form_close(); ?>
													
												  </div><!-- /.modal-dialog -->
												</div><!-- /.modal -->
											
					

			<!--END edit modal --> 
				 </td>
                 
                  <td align="center">
				  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletesection<?php echo $section ['section_id'];?>" >
				  <i class="fa fa-fw fa-trash-o"></i>Delete
				  </button>
				  </td>
                  
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
			  
			<?php } ?>	  
			  
			  
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
	<!-- /end list -->	  	  
	

 <!-- modal -->   
<div class="modal fade" id="addsection" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <!--form -->
		<?php 		echo form_open(base_url().'index.php/dts_admin/add_section');	?>
		<div class="modal-content">
          <div class="modal-header">
           Add Section (Division Office)
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
		   <div class="box">
             <!-- form start -->
            <div class="form-horizontal">
              <div class="box-body">
			  <div class="form-group">
                  <label for="office" class="col-sm-3 control-label">Office</label>

                  <div class="col-sm-9">
				  
                  <!--  <input type="text" name='office' class="form-control"  placeholder="Office/School"> -->
                 <select name="office_id" id="office" class="form-control" required>
    <option style="visibility: hidden; display: none;" value='' >--Select--</option>
    <?php foreach($offices as $school) { ?>
        <option value="<?php echo $school['sch_id']?>" <?php if(isset($default_office_id)){if($school['sch_id']== $default_office_id){ echo'selected';}   } ?> > <?php echo $school['school_name']?></option>
    <?php } ?>
</select>

				 </div>
                </div>
                <div class="form-group">
                  <label for="section_description" class="col-sm-3 control-label">Section Name</label>

                  <div class="col-sm-9">
                    <input type="text" name="section_description" class="form-control"  placeholder="Section Name" required>
                  </div>
                </div>
               <div class="form-group">
                  <label for="office" class="col-sm-3 control-label">Allow Initial Receive</label>
                 <div class="col-sm-9">
				  <select name="allow_receipt" id="office" class="form-control" required>
					<option style="visibility: hidden; display: none;" value='' >--Select--</option>
					<option value="0" selected > NO</option>
					<option value="1"  > YES</option>	
				</select>
				 </div>
                </div>
              </div>
              
            </div>
          </div> 
		  		  
		  </div> <!--end modal body -->
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
           <button type="submit" class="btn btn-primary">Add Section</button>
          </div>
        </div>
		<?php echo form_close(); ?>
		<!--/form -->
      </div>
    </div>
	
	 
<!-- /end modal -->		

	
		  
		  
		  

    </section>
    <!-- /.content -->
	 </div>
  <!-- /.content-wrapper -->

 
 <!------ // END CONTENT ----------------------- -->
  
 <?php 
$this->load->view('dts_admin/components/admin_footerbar.php');

?>  
  
 
 
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php 
$this->load->view('dts_admin/components/admin_footer.php');

?>   
