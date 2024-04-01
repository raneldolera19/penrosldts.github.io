<?php 
$this->load->view('dtspages/frontpage_components/front_main_header.php');

?>

<div class="wrapper"><!-- content-wrapper -->
<?php 
$this->load->view('dtspages/frontpage_components/front_top_navigation.php');

?>
 
<?php 
//$this->load->view('dtspages/components/left_sidebar.php');

?> 


<!--------------  CONTENT   ---------------->

<div class="content-wrapper">
    <div class="container">
	
	<section class="content-header"> 
  <h2>PENRO SOUTHERN LEYTE DOCUMENT TRACKING SYSTEM</h2>
      <ol class="breadcrumb">
     <!--   <li><a href="<?php echo base_url(); ?>home/advance_search"><i class="fa fa-search"></i> Advance Search</a></li>-->
     <!--   <li><a href="#">Forms</a></li>-->
        
      </ol>
    </section>
	
	<hr>
	
	<!-- error/success div -->
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
	<div class="col-md-8">
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Submit Document ( For Client ) </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
	<?php 		echo form_open(base_url().'index.php/home/submit_docs');	?>			
            <div class="form-horizontal">
              <div class="box-body">
			
			<div class="form-group">
                  <label for="from" class="col-sm-3 control-label">Client Name: </label>

                  <div class="col-sm-8">
                    <input type="text" name="submitted_by" class="form-control" placeholder="Full Name" required >
					 <input type="hidden" name="submitter_id" class="form-control" value="0" >
					 <input type="hidden" name="submitter_section_id" class="form-control" value="1" ><!--GUEST GROUP ID is 1 -->
                  </div>
                </div>
				<div class="form-group">
                  <label for="from" class="col-sm-3 control-label">Office: </label>

                  <div class="col-sm-8">
                    <input type="text" name="school" class="form-control" placeholder="Office" required >
					 <input type="hidden" name="school_id" class="form-control" value="0" >
                </div>
				</div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Document Type:</label>
                  <div class="col-sm-8">
				 <?php if(isset($docstypes)){?>  
					   <select name="document_type_id" id="office" class="form-control" required>
					<option style="visibility: hidden; display: none;" value='' >--Select--</option>
						<?php foreach ($docstypes as $docstype) { ?>
					<option value="<?php echo $docstype['doctype_id'];?>"  > <?php echo $docstype['doctype_description'];?></option>
						<?php } ?>
					</select>
				 <?php } ?>			
                 </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Details:</label>
                  <div class="col-sm-8">
                    <!--input type="text" class="form-control" name="tempdoc_description" placeholder="Description , Date, Destination" required-->
					 <textarea class="form-control" name="tempdoc_description" rows="3" placeholder="Description , Date,  Amount.... "  required></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Purpose of Submission:</label>
				   <div class="col-sm-8">
               <textarea class="form-control" name="actions_needed" rows="2" placeholder="Purposes or Actions to be taken ..."  required ></textarea>
                 </div>
				</div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Send to: </label>
                  <div class="col-sm-8">
					<?php if(isset($sections)){?>  
					   <select name="section_id" id="office" class="form-control" required>
					<option style="visibility: hidden; display: none;" value='' >--Select--</option>
						<?php foreach ($sections as $section) { ?>
						<option value="<?php echo $section['section_id']?>"  > <?php echo $section['section_description']?></option>
						<?php } ?>
					</select>
					
					
					
					
					
					
					
				<?php   } //end isset  sections?>
				  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
			   <div class="col-sm-12">
                <input type="reset" class="btn btn-default" value="Cancel">
                <!--<input type="submit" class="btn btn-success pull-right" value="Submit">-->
				<input type="submit" class="btn btn-primary pull-right" value="Submit">
				
				</div>
              </div>
              <!-- /.box-footer -->
    </div>
	
	<?php echo form_close(); ?>
          </div>
	
	
	</div>
	<div class="col-md-4">
	<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Log In  &nbsp;&nbsp; </h3><font color="">(For PENRO Southern Leyte Personnel)</font> 
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="form-horizontal">
              <div class="box-body">
			  <?php echo form_open(base_url().'index.php/home/login');	?>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Email</label>

                  <div class="col-sm-9">
                    <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email" autocomplete="off" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword" class="col-sm-3 control-label">Password</label>

                  <div class="col-sm-9">
                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" autocomplete="off" />
                  </div>
                </div>
               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-primary pull-right">Sign in</button>
              </div>
              <!-- /.box-footer -->
            </div><!--form -->
			<?php echo form_close(); ?>
			
          </div>
	</div>
	
	
	</div>
	
	
	
      
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>






<?php 
//$this->load->view('dtspages/components/main_content.php');

?> 













 
 <!------ // END CONTENT ----------------------- -->
  
 <?php 
//$this->load->view('dtspages/components/footerbar.php');

?>  
  
 <?php 
//$this->load->view('dtspages/components/right_controlsidebar.php');

?>   
 
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar --
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php 
$this->load->view('dtspages/frontpage_components/front_footer.php');

?>   
