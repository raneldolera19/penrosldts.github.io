<div class="col-md-4">
	<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Log In  &nbsp;&nbsp; </h3><font color="">(For DENR Personnel)</font> 
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
		  
		 <!--<a href="<?php echo base_url().'index.php/home'; ?> " type="button" class="btn btn-primary active">Submit New Document</a> -->
		 <a href="<?php echo base_url().'index.php/home'; ?> " type="button" class="btn btn-primary pull-right">Submit New Document</a>
		  
		  
	</div>