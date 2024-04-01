  <?php if(isset($mydetails)){

   foreach($mydetails as $profile){
	 
	}}   
?>	 
 
 <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <!---<a href="<?php echo base_url(); ?>" class="navbar-brand"><b>Document Tracking System</b></a> -->
          <a href="<?php echo base_url(); ?>" class="logo-lg" ><img src="<?php echo base_url(); ?>assets/dist/img/logo.png" alt="logo" height="40"></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
         <!--   <li ><a href="#">Link <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Link</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul> 
          -->
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
		  <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Documents <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">My Documents </a></li>
                <li><a href="#">Routed Documents</a></li>
                <li class="divider"></li>
                <li><a href="#">Search All Documents</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>dts_admin">System Admin</a></li>
              </ul>
            </li>
		  
             <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="<?php echo base_url().$profile['dts_image_url']; ?>" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?php echo $profile['fullname']; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="<?php echo base_url().$profile['dts_image_url']; ?>" class="img-circle" alt="User Image">

                  <p>
                         <?php echo $profile['fullname']; ?>
                    <small><?php echo $profile['designation']; ?></small>
                  </p>
                </li>
                <!-- Menu Body -->
               
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?php echo base_url(); ?>index.php/myprofile" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo base_url(); ?>index.php/home/logout" class="btn btn-default btn-flat">Log out</a>
                  </div>
                </li>
              </ul>
            </li>
		 
           <!--li class="dropdown notifications-menu"-->
		    <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-gears"></i>  </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#">My Documents </a></li>
                <li><a href="#">Routed Documents</a></li>
                <li class="divider"></li>
               <li><a href="<?php echo base_url(); ?>index.php/documents">Receiving</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>index.php/records">Records</a></li>
				<li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>index.php/dts_admin">System Admin</a></li>
              </ul>
			</li>	  
           
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
