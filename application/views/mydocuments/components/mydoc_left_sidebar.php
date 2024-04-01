<?php if(isset($mydetails)){

   foreach($mydetails as $profile){
	 
	}}   
?>	 
<?php
 if(isset($docsroute_count)){ $route_count=$docsroute_count;}else{$route_count="";} 
if(isset($pendingroute_count)){$proute_count=$pendingroute_count;}else{$proute_count="";}
if(isset($count_fwdroute)){$fwdCount= $count_fwdroute;}else{$fwdCount="";}
if(isset($count_deferredroute)){$deferredCount= $count_deferredroute;}else{$deferredCount="";}
?>
 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url().$profile['dts_image_url']; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $profile['fullname']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Logged In</a>
        </div>
      </div>
      <!-- search form -->
      <div class="sidebar-form">
	  <?php echo form_open(base_url().'index.php/mydocuments/search_track');?>
        <div class="input-group">
          <input type="text" name="qtrack" class="form-control" placeholder="Search Tracking">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
		<?php echo form_close(); ?>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
       
		<li><a href="<?php echo base_url(); ?>index.php/mydocuments"> <i class="fa fa-home"></i> <span>HOME</span></a></li>
		
        
		 <li >
          <a  href="<?php echo base_url(); ?>index.php/mydocuments/incoming">
            <i class="fa fa-mail-reply-all"></i> <span>Incoming</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"><?php echo $route_count; ?></small>
             <!-- <small class="label pull-right bg-blue">17</small>-->
            </span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>index.php/mydocuments/pending">
            <i class="fa fa-exclamation-circle"></i> <span>Pending</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red"><?php echo $proute_count; ?></small>
             
            </span>
          </a>
        </li>
       
    <li>
          <a href="<?php echo base_url(); ?>index.php/mydocuments/forwarded">
            <i class="fa fa-mail-forward"></i> <span>Forwarded</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red"><?php echo $fwdCount;?></small>
             
            </span>
          </a>
        </li>
	<li>
          <a href="<?php echo base_url(); ?>index.php/mydocuments/deferred">
            <i class="fa fa-exclamation-circle"></i> <span>Deferred</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-orange"><?php  echo $deferredCount;  ?></small>
             
            </span>
          </a>
        </li>	
		
		 <li>
          <a href="<?php echo base_url(); ?>index.php/mydocuments/encode_mydocs">
            <i class="fa fa-file-o"></i> <span>Submit New</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red"></small>
             
            </span>
          </a>
        </li>
		
		
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
