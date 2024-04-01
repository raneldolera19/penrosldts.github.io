 <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <!---<a href="<?php echo base_url(); ?>" class="navbar-brand"><b>Document Tracking System</b></a> -->
          
         <!---<a href="<?php echo base_url(); ?>" class="logo-lg" ><img src="<?php echo base_url(); ?>assets/dist/img/logo3.png" alt="logo" height="50"></a>-->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
      
          
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
          <li>
		  <div class="navbar-form navbar-right" role="search">
		  <?php echo form_open(base_url().'index.php/home/search_track');?>
            <div class="form-group">
              <input type="text" name="qtrack" class="form-control" id="navbar-search-input2" placeholder="Tracking Number Here!">
			  <input type="submit" class="form-control btn btn-default" id="navbar-search-submit" value="Track">
            </div>
			<?php echo form_close(); ?>
          </div>
		  
		 </li>
		 
             
           
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>