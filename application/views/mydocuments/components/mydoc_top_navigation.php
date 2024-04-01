 <?php if(isset($mydetails)){

   foreach($mydetails as $profile){
	 
	}}   
?>	
<?php
 if(isset($docsroute_count)){ $route_count=$docsroute_count;}else{$route_count="";} 
if(isset($pendingroute_count)){$proute_count=$pendingroute_count;}else{$proute_count="";}
if(isset($tempdocs_count)){$tempcount=$tempdocs_count;}else{$tempcount="";}
?> 
 <header class="main-header">
  
     <!-- Logo -->
    <a href="<?php echo base_url(); ?>index.php/documents" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="<?php echo base_url(); ?>assets/dist/img/logo-sximo.png" alt="" height="100"></span>
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
          <li class="dropdown messages-menu">
            <a href="<?php echo base_url(); ?>index.php/documents/receiving" >
            <i class="fa fa-clone">  </i> 
              <span class="label label-warning"><?php echo $tempcount; ?></span>
            </a>
            
          </li>
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url().$profile['dts_image_url']; ?>" class="user-image" alt="User Image">
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
              <!-- Menu Body -->
         <!--     <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
           <!--   </li>-->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url(); ?>index.php/myprofile" class="btn btn-default btn-flat">Profile</a>
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
			    <li><a href="<?php echo base_url(); ?>myprofile">My Profile</a></li>
                <li><a href="<?php echo base_url(); ?>mydocuments">My Documents </a></li>
               
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>index.php/documents">Receiving</a></li>
				
                <li><a href="<?php echo base_url(); ?>index.php/records">Records</a></li>
               
                <li><a href="<?php echo base_url(); ?>index.php/dts_admin">System Admin</a></li>
				<li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>index.php/home/logout">Log Out</a></li>
              </ul>
			</li>	
		  
		  
          <!-- Control Sidebar Toggle Button -->
         
   
        </ul>
      </div>
    </nav>
  </header>
