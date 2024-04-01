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
        
        <small>PENRO Southern Leyte Document Tracking System</small>
      </h1>
      <ol class="breadcrumb">
     <li><a href="<?php echo base_url(); ?>home/advance_search"><i class="fa fa-search"></i> Advance Search</a></li>
     <!--   <li><a href="#">Forms</a></li>-->
        
      </ol>
    </section>
	
	<hr>
	
	
	<div class="row">
	<div class="col-md-8">
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Advance Search </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
		
			<div class="input-group input-group-lg">
                <input type="text" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat">Track </button>
                    </span>
              </div>
              <!-- /.box-footer -->
    
          </div>
	</form>
	
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
