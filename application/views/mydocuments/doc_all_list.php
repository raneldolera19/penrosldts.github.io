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

<!--------------  CONTENT   ----------------.>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?php if(isset($mysectionname)){echo $mysectionname;}?>
        <small> | All Documents</small>
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
		
	<?php if (isset($alldocs)){	?>		
          <div class="box">
		 
            <div class="box-header">
			<div class="box-title2">
		<h4>	All List </h4>
	   
	</div>		
	</div>
			
		
		
            <!-- /.box-header -->
            <div class="box-body">
			
		
              <table id="data_twoa" class="table table-bordered table-hover">
                <thead>
                <tr>
				<th width=10%>Tracking</th>
				 <th >DOC TYPE & DETAIL</th>
                
				<!-- <th>GROUP</th> -->
                  <th>FWD FROM</th>
				<!--  <th  ><div align="center">Date & Time Forwarded </div></th>-->
				   <th><div  >ACCEPTED</div></th>
				  <th >ACTIONS TAKEN</th>
                   <th >REMARKS</th>
                 
                </tr>
                </thead>
                <tbody>
				<?php 
					$num=1;
				foreach($alldocs as $doc){ ?>
                <tr>
				<td><strong><?php echo $doc ['doc_tracking']; ?></strong></td>
				<td><?php echo $doc ['doctype_description']; ?><br> <?php echo $doc ['docs_description']; ?>
                  <br> <small> From : <?php echo $doc ['origin_fname']; ?> </small>	  </td>
				<td> <?php echo $doc ['route_fromsection']; ?><br> <small> <?php echo $doc ['route_from']; ?> <br> <?php echo viewtime($doc ['datetime_forwarded']); ?></small>
				</td>
				  				
				<td ><?php echo $doc ['route_tosection']; ?><br> <small> <?php echo viewtime($doc ['datetime_route_accepted']); ?> 
				  <br> <?php if ($doc ['received_by']!=""){
				 echo 'by: '. $doc ['received_by']; }?></small>	  </td>
				 <td>	<?php echo $doc ['actions_taken']; ?> <br> 
				 <?php if ($doc ['acted_by']!=""){
				 echo 'by: '. $doc ['acted_by']; }?> 
				 
				 <br> <?php echo viewtime($doc ['actions_datetime']); ?></small>				</td>
				  
				 <td> 
				 <?php if ($doc ['doc_copy']==1){ ?>
					<font color="blue"> <small> Retained copy</small></font><br> 
				<?php  } ?>
				 <?php 
				 if ($doc ['route_accomplished']==1){
					 echo 'Forwarded';
				 }else if ($doc ['route_accomplished']==2){
					 echo 'Document kept <br><small>('.$doc ['acted_by'] .')</small>';
				 }else if($doc ['route_accomplished']==3){
					 echo 'Document was released to '. $doc ['out_released_to'] ;
				 }
				 ?>
				 
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
		   <div class="callout callout-success">
          <h4>No Documents Recorded </h4>

          
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
$this->load->view('documents/components/doc_right_controlsidebar.php');

?>   
 
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php 
$this->load->view('documents/components/doc_footer.php');

?>   
