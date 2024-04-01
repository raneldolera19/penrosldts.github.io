<?php
 if(isset($docsroute_count)){ $route_count=$docsroute_count;}else{$route_count="";} 
if(isset($pendingroute_count)){$proute_count=$pendingroute_count;}else{$proute_count="";}
if(isset($tempdocs_count)){$tempcount=$tempdocs_count;}else{$tempcount="";}
if(isset($co_users_count)){$coUsersCount= $co_users_count;}else{$coUsersCount="";}
if(isset($count_fwdroute)){$fwdCount= $count_fwdroute;}else{$fwdCount="";}
?>


<!------------   -->
<div class="col-md-4">
  <!-- Application buttons -->
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Documents</h3>
            </div>
            <div class="box-body">
              <!--p>Summary </p-->
             <!-- <a href="<1?php echo base_url(); ?>index.php/mydocuments/receiving" class="btn btn-app">
			   <span class="badge bg-green"><1?php echo $tempcount; ?></span>
                <i class="fa  fa  fa-barcode"></i> Receiving NEW
              </a> -->
			   <a href="<?php echo base_url(); ?>index.php/mydocuments/incoming" class="btn btn-app">
			   <span class="badge bg-green"><?php echo $route_count; ?></span>
                <i class="fa  fa fa-reply-all"></i> Incoming 
              </a>
              <a href="<?php echo base_url(); ?>index.php/mydocuments/pending" class="btn btn-app">
			  <span class="badge bg-red"><?php echo $proute_count; ?></span>
                <i class="fa  fa-exclamation-circle"></i> Pending
              </a>
			  
              <a href="<?php echo base_url(); ?>index.php/mydocuments/forwarded" class="btn btn-app">
			  <span class="badge bg-orange"><?php echo $fwdCount; ?></span>
                <i class="fa fa-mail-forward"></i> Forwarded
              </a>
			 
              <a href="<?php echo base_url(); ?>index.php/mydocuments/encode_mydocs" class="btn btn-app">
                <i class="fa fa-file-o"></i> Submit New
              </a>
			  
			  <!--
			 <a href="<1?php echo base_url(); ?>index.php/mydocuments/our_list" class="btn btn-app">
                <i class="fa fa-list"></i> Our List
              </a>
				-->
			 
              <hr>
              <div >
              <h4 class="box-title">Others</h4>
            </div>
              
              <a class="btn btn-app">
                <span class="badge bg-blue"> <?php echo $coUsersCount; ?></span>
                <i class="fa  fa-users"></i> Unit Users
				</a>
				
				
				
              
			
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

</div>