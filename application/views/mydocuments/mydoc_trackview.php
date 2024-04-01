<?php 

$this->load->view('mydocuments/components/mydoc_main_header.php');

?>
<?php function viewtime($datetime){
	if($datetime!=0){
	         $time = strtotime($datetime);
			$receivetime = date("m/d/y @ g:i A", $time);
			return $receivetime; 
	}else {return "";}
}
?>
<div class="wrapper"><!-- content-wrapper -->
<?php 
$this->load->view('mydocuments/components/mydoc_top_navigation.php');

?>
 
<?php 
$this->load->view('mydocuments/components/mydoc_left_sidebar.php');

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
if(isset($count_deferredroute)){$deferredCount= $count_deferredroute;}else{$deferredCount="";}
?>
<!--------------  CONTENT   ----------------.>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Trail for document track # :  
       <?php echo $track_code; ?> 
      </h1>
	  
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php if(isset($mysectionname)){echo $mysectionname;}?></li>
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
		
	<?php if (isset($track_data)){	?>		
      <div class="col-md-8">    
	  <?php 
	  $num=1;
	  $rcount= count($track_data);
	  ?>
	 <div style= "padding: 10px;  background-color: #ffffff; 
	        border-bottom-left-radius: 10% 10%;
			border-bottom-right-radius: 10% 10px;
			border-top-left-radius: 0;
	 font-weight: bold; box-shadow: 8px 1px 12px rgba(0,0,0,.3)"
	 > 
	 
	<?php 
	foreach($doc_detail as $docdet){
	//	echo 'Document Type : '. $docdet['doctype_description']. '<br>';
	//	echo $docdet['docs_description'];
		?>
		<table  class="table table-bordered table-hover"  >
		<tr> <td width= 140>  Tracking Code   </td><td> <?php echo $docdet['doc_tracking']; ?>     </td></tr>
		<tr> <td width= 140>  Document Type   </td><td> <?php echo $docdet['doctype_description']; ?>     </td></tr>
		<tr> <td valign="top">  Description   </td><td> <?php echo $docdet['docs_description']; ?>     </td></tr>
		<tr> <td valign="top">  Origin   </td><td> <?php echo $docdet['origin_fname']; ?> ( <?php echo $docdet['origin_school']; ?>    )</td></tr>
		</table>
		
<?php	} ?>
	
	
	</div>
		<br>&nbsp;
	  <center>
	  <div  style="width: 0; 
  height: 0; 
  border-left: 20px solid transparent;
  border-right: 20px solid transparent;
  
  border-top: 20px solid #f00;"> </div>	
</center>	  
	
	  
	<?php 	foreach($track_data as $doc){	?>
		
		<div align="center" 
			style= "margin: 20px; padding-top: 20px; padding-bottom: 20px; background-color: #ffffff;
			border-bottom-left-radius: 50% 10%;
			border-bottom-right-radius: 50% 10px;
			border-top-left-radius: 0;
		/*	transform: skew(-5deg, -2deg);*/
			margin: 2em 3em;
			box-shadow: 8px 1px 12px rgba(0,0,0,.3)
		
		" >

<?php 
 //echo 'From: '. $doc ['route_from'].'<br>';
echo  $doc ['route_tosection'] .'<br>' ; 
// if ($doc ['fwd_remarks']!=''){echo 'Fwd Remarks: '.$doc ['fwd_remarks']. '<br>';}
 if (viewtime($doc ['datetime_route_accepted'])!=''){
 echo 'Received by : '.$doc ['received_by'].' | ' . viewtime($doc ['datetime_route_accepted']). '<br>' ; 
 echo 'Actions Taken: ' . $doc['actions_taken'] .'<br>';
 echo $doc['end_remarks'] .'<br>';
 } else { echo '<strong><font color ="red"> Not yet received </font></strong>';}
 ?> <br>
<?php  ?> 
		</div>
	<center>	
	<?php if($num<$rcount){ ?>
	<div  style="width: 0; 
  height: 0; 
  border-left: 20px solid transparent;
  border-right: 20px solid transparent;
  
  border-top: 20px solid #f00;"> </div>	
	</center>	
	<?php }//end while ?>
	
	<?php $num++;	} //end for each	?>
		
		</div>
		<?php 
$this->load->view('mydocuments/components/mydoc_application_buttons.php');

?>   
 </div>        
		<?php } else{?>	  
<div class="row">	
<div class="col-md-8">	
		   <div class="callout callout-warning">
          <h4>There is no record available for this tracking number.</h4>

        </div> </div>
		  <!-- Application buttons -->	  
	 <?php 
$this->load->view('documents/components/doc_application_buttons.php');

?>   
          <!--end Application buttons -->
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
