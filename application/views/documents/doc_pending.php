<?php 

$this->load->view('documents/components/doc_main_header.php');

?>
<?php function viewtime($datetime){
	if($datetime!=0){
	         $time = strtotime($datetime);
			$receivetime = date("m/d/y @ g:i A", $time);
			return $receivetime;
	}else {return NULL;}
}
?>
<div class="wrapper"><!-- content-wrapper -->
<?php 
$this->load->view('documents/components/doc_top_navigation.php');

?>
 
<?php 
$this->load->view('documents/components/doc_left_sidebar.php');

?> 
<?php if(isset($mydetails)){

   foreach($mydetails as $myprofile){
	 
	}}   
?>
<?php
 if(isset($docsroute_count)){ $route_count=$docsroute_count;}else{$route_count="";} 
if(isset($pendingroute_count)){$proute_count=$pendingroute_count;}else{$proute_count="";}
if(isset($tempdocs_count)){$tempcount=$tempdocs_count;}else{$tempcount="";}
if(isset($co_users_count)){$coUsersCount= $co_users_count;}else{$coUsersCount="";}
if(isset($count_fwdroute)){$fwdCount= $count_fwdroute;}else{$fwdCount="";}
?>	 
<!--------------  CONTENT   ----------------.>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?php if(isset($mysectionname)){echo $mysectionname;}?>
        <small> | Accepted Documents for Appropriate Action</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
		<li><span id="time"> </span> <!--?php echo date("Y-m-d  H:i:s "); ? --></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
  
		  
	<!--- list-->
	
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
        <div class="col-md-12">
		
	<?php if (isset($routeddocs)){	?>		
          <div class="box">
		 
            <div class="box-header">
			<div class="box-title2">
		<h4>	DOCUMENT PENDING FOR ACTION </h4>
	   
	</div>		
	</div>
			
		
		
            <!-- /.box-header -->
            <div class="box-body">
			
		
              <table id="data_one" class="table table-bordered table-hover">
                <thead>
                <tr>
				<th width=10%>Tracking</th>
				 <th >DOC TYPE & DETAIL</th>
                
				<!-- <th>GROUP</th> -->
                  <th>FWD FROM</th>
				<!--  <th  ><div align="center">Date & Time Forwarded </div></th>-->
				   <th><div  width=15% align="center">ACCEPTED</div></th>
				  <th width=28%>ACTIONS NEEDED</th>
                   <th width=18%>Actions</th>
                 
                </tr>
                </thead>
                <tbody>
				<?php 
					$num=1;
				foreach($routeddocs as $doc){ ?>
                <tr>
				<td><strong><a href="<?php echo base_url().'documents/track_view/'.$doc ['doc_tracking'] ; ?>"><?php echo $doc ['doc_tracking']; ?></a></strong> </td>
				<td><?php echo $doc ['doctype_description']; ?><br> <?php echo $doc ['docs_description']; ?>
                  <br> <small> From : <?php echo $doc ['origin_fname']; ?> </small>
				  </td>
				   <td><?php echo $doc ['section_description']; ?><br> <small><?php echo $doc ['route_from']; ?> </small></td>
				  
				
				  <td align="center"> <small> <?php echo viewtime($doc ['datetime_route_accepted']); ?> 
				  <br> by:  <?php echo $doc ['received_by'] ?> </small>
				 <?php  if($doc ['accepting_remarks'] != ""){
						echo '<br> <small><font color= "green">Accpt Note: '; 
						echo $doc ['accepting_remarks']. '</font></small>';
					} ?>
				  </td>
				    <td>
					<?php 
					echo $doc ['route_purpose']; 
					if($doc ['fwd_remarks'] != ""){
						echo '<br> <small><font color= "blue"> FWD Remarks: '; 
						echo $doc ['fwd_remarks']. '</font></small>';
					}
					
					?> 
					
					</td>
				  
				 <td> 
				
				  <button type="submit" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#action<?php if (isset($doc ['action_id'])){ echo $doc ['action_id'];  }?>" ><i class="fa   fa-share-square"></i></button>
				  <button type="submit" class="btn btn-xs btn-success" data-toggle="modal" data-target="#forfile<?php if (isset($doc ['action_id'])){ echo $doc ['action_id'];  }?>" ><i class="fa   fa-folder-open"></i></button>
				  <button type="submit" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#forrelease<?php if (isset($doc ['action_id'])){ echo $doc ['action_id'];  }?>" ><i class="fa  fa-send"></i></button>
				  
				  <button type="submit" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#fordefer<?php if (isset($doc ['action_id'])){ echo $doc ['action_id'];  }?>" ><i class="fa   fa-bookmark-o"></i></button>
				<!-----------------   -------------------------------------->
				<script type="text/javascript">  
                  $(document).ready(function() {  
                     $("#sectionsDrop<?php echo $doc ['action_id'];  ?>").change(function(){  
					 
                     /*dropdown post *///  
                     $.ajax({  
                        url:"<?php echo base_url();?>index.php/documents/get_users",  
                        data: {unit_id:  //this is the post name
                           $(this).val()},  
                        type: "POST",  
                        success:function(data){  
                        $("#usersDrop<?php echo $doc ['action_id']; ?>").html(data);  
                     }  
                  });  
               });  
            });  
 </script> 
				
				<!-- ---------------- Forwarding  Modal --------------------->
				<div class="modal fade" id="action<?php if (isset($doc ['action_id'])){ echo $doc ['action_id'];  }?>"tabindex="-1" role="dialog">
												  <div class="modal-dialog modal-md">
												  	
											<?php echo form_open(base_url().'index.php/documents/forwarding_actions');?>
													<div class="modal-content">
													  <div class="modal-header">
													  <h4 class="modal-title">Forward Document
													  
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														</h4>
														
													  </div>
													  <div class="modal-body">
													<table class="table ">
													<tr><td width=25%> Tracking</td><td><b><?php echo $doc ['doc_tracking']; ?></b> </td></tr> 
													<tr><td width=25%> Details</td><td><?php echo $doc ['doctype_description']; ?><br><?php echo $doc ['docs_description']; ?> 
																<br> <small> From : <?php echo $doc ['origin_fname']; ?></td></tr>  	
													<tr><td width=25%> Actions Taken</td><td>
												<!--	<input type="text" style="width: 400px;" class="form-control" name="actions" rows="3" placeholder="Actions Taken ..."  required >-->
													<!--textarea class="form-control" style="width: 400px;" name="actions" rows="3" required=required > </textarea> -->
													<textarea class="form-control" rows="3"  style="width: 400px;" name="actions" required></textarea>
													</td></tr>  
													 <tr><td> Document Copy</td><td>
														 <select name="doc_copy" class="form-control" style="width: 400px;" required>
															<option style="visibility: hidden; display: none;" value='' >--Select--</option>
															<option value=0> NO, I don't retain copy of this document. </option>	
															<option value=1>YES,  I have retain copy of this document.</option>	
															
															</select>
													 
													 
													 </td></tr>  
													 <tr><td> Route to :</td><td>
															<?php if(isset($all_othersections)){?>  
															   <select name="office_id" id="sectionsDrop<?php echo $doc ['action_id'];  ?>" style="width: 400px;" class="form-control" required>
															<option style="visibility: hidden; display: none;" value='' >--Select Section--</option>
																<?php foreach ($all_othersections as $section) { ?>
															<option value="<?php echo $section['section_id']?>"  > <?php echo $section['section_description']?></option>
																<?php } ?>
															</select>
																		  
																	<?php   } //end isset  sections?>
													 
													 </td> </tr>
													 <tr > <td> Personnel  </td>													 
													 <td> 
													 <select name="users_id" id="usersDrop<?php echo $doc ['action_id'];  ?>" style="width: 400px;" class="form-control" required >
													 <option style="visibility: hidden; display: none;" value='' >--Select Personnel--</option>
													</select>																										 
													 </td>
													 </tr>
													 <tr > <td> Route Purpose </td> <td> <textarea class="form-control" style="width: 400px;" name="fwd_remarks" rows="2"  > </textarea>																								 
													 </td>
													 </tr>
													 
													</table> 
													<input type="hidden" name="action_id" value="<?php echo $doc ['action_id']; ?>" >
													<input type="hidden" name="document_id" value="<?php echo $doc['document_id']; ?>" >
													<input type="hidden" name="fwdby_userid" value="<?php echo $myprofile['users_id']; ?>" >
													<input type="hidden" name="fwdby_fname" value="<?php echo $myprofile['fullname']; ?>" >
													<input type="hidden" name="fwdby_section_id" value="<?php echo $myprofile['dts_section_id']; ?>" >
													<input type="hidden" name="route_purpose" value="<?php echo $doc ['route_purpose'];  ?>" >
														<input type="hidden" name="end_remarks" value="Forwarded" >
													
													
											           </div> <!--end body modal --->
													  <div class="modal-footer">
													  
													  <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Cancel</button>
													<button type="submit" class="btn btn-primary btn-md">Forward</button>
																							
													  </div>
													</div><!-- /.modal-content -->
											<?php echo form_close(); ?>
													
												  </div><!-- /.modal-dialog -->
												</div><!-- /.modal -->		
												
				<!-- ---------------- //End Forwarding Modal --------------------->									  
			
				<!-- ---------------- Accepting for File Modal --------------------->
				<div class="modal fade" id="forfile<?php if (isset($doc ['action_id'])){ echo $doc ['action_id'];  }?>"tabindex="-1" role="dialog">
												  <div class="modal-dialog modal-md">
												  	
											<?php echo form_open(base_url().'index.php/documents/keepfile_actions');?>
													<div class="modal-content">
													  <div class="modal-header">
													  <h4 class="modal-title">Keeping the Document
													  
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														</h4>
													<small> There is no need to route or forward this document. I will keep the file.</small>	
													  </div>
													  <div class="modal-body">
													<table class="table ">
													<tr><td width=30%> Actions Taken</td><td>
													<!--<input type="text" class="form-control" name="actions" rows="3" placeholder="Your actions taken."  required >-->
													<!--textarea class="form-control" style="width: 400px;" name="actions" rows="3" required  > </textarea-->
													<textarea class="form-control" rows="3" cols="60" name="actions" required></textarea>
													</td></tr>  
													 
													
													 
													</table>
													<h4 align="center"> Are sure that there is no need to forward this document to other section? </h4>
													<input type="hidden" name="action_id" value="<?php echo $doc ['action_id']; ?>" >
													<input type="hidden" name="document_id" value="<?php echo $doc['document_id']; ?>" >
													<input type="hidden" name="keptby_userid" value="<?php echo $myprofile['users_id']; ?>" >
													<input type="hidden" name="acted_by" value="<?php echo $myprofile['fullname']; ?>" >
													<input type="hidden" name="end_remarks" value="Kept by <?php  echo $myprofile['fullname']. ' No re-routing. (Done) ' ; ?>" >
													
													
											           </div> <!--end body modal --->
													  <div class="modal-footer">
													  
													  <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Cancel</button>
													<button type="submit" class="btn btn-primary btn-md">YES, I / We will keep this document</button>
																							
													  </div>
													</div><!-- /.modal-content -->
											<?php echo form_close(); ?>
													
												  </div><!-- /.modal-dialog -->
												</div><!-- /.modal -->		  
													  
								
				<!-- ---------------- end Accpting Modal --------------------->
				
				<!-- ---------------- Releasing Modal --------------------->
				
				<div class="modal fade" id="forrelease<?php if (isset($doc ['action_id'])){ echo $doc ['action_id'];  }?>"tabindex="-1" role="dialog">
												  <div class="modal-dialog modal-md">
												  	
											<?php echo form_open(base_url().'index.php/documents/forrelease_actions');?>
													<div class="modal-content">
													  <div class="modal-header">
													  <h4 class="modal-title">Release Document													  
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														</h4>
														
													<div>
													<?php echo $doc ['doctype_description']; ?><br> <?php echo $doc ['docs_description']; ?>
													<br> <small> Document Origin From : <?php echo $doc ['origin_fname']; ?> </small>
													</div>													
													 </div>
													  <div class="modal-body">
													<table class="table ">
													<tr><td width=25%> Actions Taken</td><td>
													<!-- input type="text" class="form-control" name="actions" rows="3" placeholder="Actions taken by your section"  required -->
													<textarea class="form-control" rows="3" style="width: 400px;" name="actions" required></textarea>
													
													</td></tr>  
													 <tr><td> Document Copy</td><td>
														 <select name="doc_copy" class="form-control" style="width: 400px;" required>
															<option style="visibility: hidden; display: none;" value='' >--Select--</option>
															<option value=0> NO, I don't retain copy of this document. </option>	
															<option value=1>YES,  I have retain copy of this document.</option>	
															
															</select>
													 
													 
													 </td></tr>  
													 <tr><td> Release to :</td><td>
														<input type="text" class="form-control" name="release_to" style="width: 400px;" placeholder="Full Name"  required >	
													 </td> </tr>
													 <tr > <td> Logbook Page Number  </td>													 
													 <td> 
													 <input type="text" name="logbookpage"  class="form-control" style="width: 400px;" >																			 
																																					 
													 </td>
													 </tr>
													 
													 
													</table> 
													<input type="hidden" name="action_id" value="<?php echo $doc ['action_id']; ?>" >
													<input type="hidden" name="document_id" value="<?php echo $doc['document_id']; ?>" >
													<input type="hidden" name="fwdby_userid" value="<?php echo $myprofile['users_id']; ?>" >
													<input type="hidden" name="fwdby_fname" value="<?php echo $myprofile['fullname']; ?>" >
													<input type="hidden" name="fwdby_section_id" value="<?php echo $myprofile['dts_section_id']; ?>" >
													<input type="hidden" name="route_purpose" value="<?php echo $doc ['route_purpose'];  ?>" >
													<input type="hidden" name="end_remarks" value="Document Released " >
													
													<small><font color="blue"> Neccesary Actions are already taken with this document. This will be released to the person without a DTS Account. </font> </small>
													
											           </div> <!--end body modal --->
													  <div class="modal-footer">
													  
													  <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Cancel</button>
													<button type="submit" class="btn btn-success btn-md">Release</button>
																							
													  </div>
													</div><!-- /.modal-content -->
											<?php echo form_close(); ?>
													
												  </div><!-- /.modal-dialog -->
												</div><!-- /.modal -->		  
													  
								
				<!-- ---------------- end releasing Modal --------------------->
				
				<!-- ---------------- Defer Modal --------------------->
				
				<div class="modal fade" id="fordefer<?php if (isset($doc ['action_id'])){ echo $doc ['action_id'];  }?>"tabindex="-1" role="dialog">
												  <div class="modal-dialog modal-md">
												  	
											<?php echo form_open(base_url().'index.php/documents/fordeferred_actions');?>
													<div class="modal-content">
													  <div class="modal-header">
													  <h3 class="modal-title">Deferred this Document													  
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														</h3>
														
													<div>
													<?php echo $doc ['doctype_description']; ?><br> <?php echo $doc ['docs_description']; ?>
													<br> <small> Document Origin From : <?php echo $doc ['origin_fname']; ?> </small>
													</div>													
													 </div>
													  <div class="modal-body">
													<table class="table ">
													
													 <tr><td> Reason/s  :</td><td>
														<td> <textarea class="form-control" style="width: 400px;" name="def_reason" rows="3" required> </textarea>
													 </td> </tr>
													 
													 
													 
													</table> 
													<input type="hidden" name="actions" value="Deferred" >
													<input type="hidden" name="action_id" value="<?php echo $doc ['action_id']; ?>" >
													<input type="hidden" name="document_id" value="<?php echo $doc['document_id']; ?>" >
													<input type="hidden" name="defby_userid" value="<?php echo $myprofile['users_id']; ?>" >
													<input type="hidden" name="defby_fname" value="<?php echo $myprofile['fullname']; ?>" >
													<input type="hidden" name="end_remarks" value="Deferred " >
													
													
											           </div> <!--end body modal --->
													  <div class="modal-footer">
													  
													  <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Cancel</button>
													<button type="submit" class="btn btn-danger btn-md">Deferred</button>
																							
													  </div>
													</div><!-- /.modal-content -->
											<?php echo form_close(); ?>
													
												  </div><!-- /.modal-dialog -->
												</div><!-- /.modal -->		  
													  
								
				<!-- ---------------- end DEFERRED Modal --------------------->
				
				
				<!-----------------   -------------------------------------->
				
				 </td>
				 
				
                </tr>
				<?php 
				$num++;
				} ?>
	</tbody>
           
              </table>
			  
			 
			  
			  
            </div>
            <!-- /.box-body -->
          </div>
		<?php } else{?>	   
		  <div class="row">
	<div class="col-md-8">	
		   <div class="callout callout-success">
          <h4>No Pending Documents</h4>

        </div>
	</div>	  
<!-- Application buttons -->
  <?php 
$this->load->view('documents/components/doc_application_buttons.php');
?>  
<!-----------------end application buttons          --->
</div>		  
		<?php }?>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
	<!-- /end list -->	  	  
	

 
	
		  
		  
		  

    </section>
    <!-- /.content -->
	 </div>
  <!-- /.content-wrapper -->

 
 <!------ // END CONTENT ----------------------- -->
  
 <?php 
$this->load->view('documents/components/doc_footerbar.php');

?>  
  
 <?php 
//$this->load->view('documents/components/doc_right_controlsidebar.php');

?>   
 
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php 
$this->load->view('documents/components/doc_footer.php');

?>   
