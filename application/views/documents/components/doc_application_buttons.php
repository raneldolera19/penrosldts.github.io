<?php
 if(isset($docsroute_count)){ $route_count=$docsroute_count;}else{$route_count="";} 
if(isset($pendingroute_count)){$proute_count=$pendingroute_count;}else{$proute_count="";}
if(isset($tempdocs_count)){$tempcount=$tempdocs_count;}else{$tempcount="";}
if(isset($co_users_count)){$coUsersCount= $co_users_count;}else{$coUsersCount="";}
if(isset($count_fwdroute)){$fwdCount= $count_fwdroute;}else{$fwdCount="";}
if(isset($count_deferredroute)){$deferredCount= $count_deferredroute;}else{$deferredCount="";}
?>


<!------------   -->
<div class="col-md-4">
  <!-- Application buttons -->
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Documents </h3>
            </div>
            <div class="box-body">
              <!--p>Summary </p-->
              <a href="<?php echo base_url(); ?>index.php/documents/receiving" class="btn btn-app">
			   <span class="badge bg-green"><?php echo $tempcount; ?></span>
                <i class="fa  fa  fa-barcode"></i> Receiving NEW
              </a>
			   <a href="<?php echo base_url(); ?>index.php/documents/incoming" class="btn btn-app">
			   <span class="badge bg-green"><?php echo $route_count; ?></span>
                <i class="fa  fa fa-reply-all"></i> Incoming 
              </a>
              <a href="<?php echo base_url(); ?>index.php/documents/pending" class="btn btn-app">
			  <span class="badge bg-red"><?php echo $proute_count; ?></span>
                <i class="fa  fa-exclamation-circle"></i> Pending
              </a>
			  
              <a href="<?php echo base_url(); ?>index.php/documents/forwarded" class="btn btn-app">
			  <span class="badge bg-orange"><?php echo $fwdCount; ?></span>
                <i class="fa fa-mail-forward"></i> Forwarded
              </a>
			  
              <a href="<?php echo base_url(); ?>index.php/documents/deferred" class="btn btn-app">
			  <span class="badge bg-red"><?php echo $deferredCount; ?></span>
                <i class="fa fa-bookmark-o"></i> Deferred
              </a>
			  
			 <a href="<?php echo base_url(); ?>index.php/documents/all_list" class="btn btn-app">
                <i class="fa fa-list"></i> All List
              </a>
			   <a href="<?php echo base_url(); ?>index.php/documents/all_acted" class="btn btn-app">
                <i class="fa fa-folder-open"></i> Acted Docs
              </a>
				<a href="<?php echo base_url(); ?>index.php/documents/excel_download" class="btn btn-app">
				 <span class="badge bg-green"></span>
               <i class="fa fa-file-excel-o"> </i> Download
              </a>
			 <hr>
              <div >
              <h4 class="box-title">Route Document Forms </h4>
            </div>
            <!--  
              <a href="<1?php echo base_url(); ?>index.php/documents/entry_voucher" class="btn btn-app">                
                <i class="fa  fa-credit-card"></i> Voucher
				</a>
				
				-->
				 <a href="<?php echo base_url(); ?>index.php/documents/encode_mydocs" class="btn btn-app">
                <i class="fa   fa-file-archive-o"></i> All Purpose
              </a>
              <hr>
              <div >
              <h4 class="box-title">Others</h4>
            </div>
              
				
              <a class="btn btn-app">
                <span class="badge bg-blue"> <?php echo $coUsersCount; ?></span>
                <i class="fa  fa-users"></i> Unit Users
				</a>
				
				 <a href="<?php echo base_url(); ?>index.php/documents/dts_backup" class="btn btn-app">
                <i class="fa  fa-download"></i> DB Backup
              </a>
				
              
			
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

</div>