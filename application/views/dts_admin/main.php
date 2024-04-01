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
      <h1>
        
        <small>Document Tracking System</small>
      </h1>
      <ol class="breadcrumb">
     <!--   <li><a href="<?php echo base_url(); ?>home/advance_search"><i class="fa fa-search"></i> Advance Search</a></li> -->
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
              <h3 class="box-title">Submit Document ( For Guest ) </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
	<?php 		echo form_open(base_url().'home/submit_docs');	?>			
            <div class="form-horizontal">
              <div class="box-body">
			
			<div class="form-group">
                  <label for="from" class="col-sm-3 control-label">FROM: </label>

                  <div class="col-sm-8">
                    <input type="text" name="submitted_by" class="form-control" placeholder="Full Name" required >
					 <input type="hidden" name="submitter_id" class="form-control" value="19" ><!--GUEST GROUP ID is 19 -->
					 <input type="hidden" name="submitter_section_id" class="form-control" value="0" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Description</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="tempdoc_description" placeholder="Description of document/s" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Purpose</label>
				   <div class="col-sm-8">
               <textarea class="form-control" name="actions_needed" rows="3" placeholder="Purposes or Actions to be taken ..."  required ></textarea>
                 
                </div>
				</div>
				
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">TO: </label>

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
				  <!--input type="text" name="route_to" class="form-control" placeholder="Personnel or Office" -->
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
			   <div class="col-sm-11">
                <input type="reset" class="btn btn-default" value="Cancel">
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
              <h3 class="box-title">Log In  &nbsp;&nbsp; </h3><font color="">(For  Personnel)</font> 
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="form-horizontal">
              <div class="box-body">
			  <?php echo form_open(base_url().'home/login');	?>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Email</label>

                  <div class="col-sm-9">
                    <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email" autocomplete="off" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword" class="col-sm-3 control-label">Password</label>

                  <div class="col-sm-9">
                    <input type="password" name="password"  class="form-control" id="inputPassword" placeholder="Password" autocomplete="off" />
                  </div>
                </div>
               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-primary pull-right">Sign in</button>
              </div>
              <!-- /.box-footer -->
            </div><!--form -->
			<?php echo form_close(); ?>
			
          </div>
	</div>
	
	
	</div>
	
	
	
      <!-- Content Header (Page header) 
      <section class="content-header">
        <h1>
          Top Navigation
          <small>Example 2.0</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Layout</a></li>
          <li class="active">Top Navigation</li>
        </ol>
      </section>-->

      <!-- Main content --
      <section class="content">
        <div class="callout callout-info">
          <h4>Tip!</h4>

          <p>Add the layout-top-nav class to the body tag to get this layout. This feature can also be used with a
            sidebar! So use this class if you want to remove the custom dropdown menus from the navbar and use regular
            links instead.</p>
        </div>
        <div class="callout callout-danger">
          <h4>Warning!</h4>

          <p>The construction of this layout differs from the normal one. In other words, the HTML markup of the navbar
            and the content will slightly differ than that of the normal layout.</p>
        </div>
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Blank Box</h3>
          </div>
          <div class="box-body">
            The great content goes here
          </div>
          <!-- /.box-body --
        </div>
        <!-- /.box --
      </section>
	  -->
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
