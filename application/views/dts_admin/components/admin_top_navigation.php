 <?php if(isset($mydetails)){

   foreach($mydetails as $profile){
	 
	}}   
?>	 
 <header class="main-header">
  
     <!-- Logo -->
     <a href="<?php echo base_url(); ?>index.php/documents" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="<?php echo base_url(); ?>assets/dist/img/logo-sximo.png" alt="logo" height="50"></span>
      <!--<span class="logo-mini"><b>DTS</b></span>-->
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="<?php echo base_url(); ?>assets/dist/img/logo2.png" alt="logo" height="42"></span>
     <!-- <span class="logo-lg">Document Tracking</span>-->
    </a>



    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
       
        
      
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $profile['fullname']; ?></span>
            </a>
			
            <ul class="dropdown-menu">
              <!-- User image -->
             <li class="user-header">
                <img src="<?php echo base_url().$profile['dts_image_url']; ?>" class="img-circle" alt="User Image">

                <p>
                 <?php echo $profile['fullname']; ?>
                  <small><?php echo $profile['designation']; ?></small>
                </p>
              </li>
          
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url(); ?>index.php/home/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
		   <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-gear"></i>  </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url(); ?>index.php/mydocuments">My Documents </a></li>
                <li><a href="#">Routed Documents</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>index.php/documents">Receiving</a></li>
				<li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>index.php/records">Records</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>index.php/dts_admin">System Admin</a></li>
				<li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>index.php/home/logout">Logout</a></li>
              </ul>
			</li>	
		  
		  
          <!-- Control Sidebar Toggle Button -->
         <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
   -->
   
        </ul>
      </div>
    </nav>
  </header>