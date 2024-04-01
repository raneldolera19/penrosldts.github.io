<?php 
$this->load->view('dtspages/frontpage_components/front_main_header.php');

?>

<div class="wrapper"><!-- content-wrapper -->
<?php 
$this->load->view('dtspages/frontpage_components/front_top_navigation.php');

?>
 <?php function viewtime($datetime){
	if($datetime!=0){
	         $time = strtotime($datetime);
			$receivetime = date("m/d/y @ g:i A", $time);
			return $receivetime;
	}else {return NULL;}
}
?>



<!--------------  CONTENT   ---------------->

<div class="content-wrapper">
    <div class="container">
	
	<section class="content-header">
      <h1>
        
        <small>Document Tracking System</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.php/home/advance_search"><i class="fa fa-search"></i> Advance Search</a></li>
     <!--   <li><a href="#">Forms</a></li>-->
        
      </ol>
    </section>
	
	<hr>
	
	<!-- error/success div -->
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
		
	<div class="row">
        <div class="col-md-12">
		
	<?php if (isset($track_data)){

 if($track_data!=""){
	?>		
      <div class="col-md-8">    
	  <?php 
	  $num=1;
	  $rcount= count($track_data);
	  ?>
	
	 
	<?php 
	if($doc_detail!=""){
	foreach($doc_detail as $docdet){
	//	echo 'Document Type : '. $docdet['doctype_description']. '<br>';
	//	echo $docdet['docs_description'];
		?>
		 <div style= "padding: 10px;  background-color: #ffffff; font-weight: bold;" > 
		<table  class="table table-bordered table-hover" >
		<tr> <td width= 140>  Tracking Code  </td><td> <?php echo $docdet['doc_tracking']; ?>     </td></tr>
		<tr> <td width= 140>  Document Type   </td><td> <?php echo $docdet['doctype_description']; ?>     </td></tr>
		<tr> <td valign="top">  Description   </td><td> <?php echo $docdet['docs_description']; ?>     </td></tr>
		<tr> <td valign="top">  Origin / From  </td><td> <?php echo $docdet['origin_fname']; ?> ( <?php echo $docdet['origin_school']; ?>    )</td></tr>
		</table>
		
		</div>
	<br>&nbsp;
		  <center>
	  <div  style="width: 0; 
  height: 0; 
  border-left: 20px solid transparent;
  border-right: 20px solid transparent;
  
  border-top: 20px solid #f00;"> </div>	
</center>	
		
<?php	} 
	}
	?>
	
	
	
	
	
	  
	  
	<?php 	
	if($track_data!=""){
	foreach($track_data as $doc){	
	
	?>
		
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
// echo 'From: '. $doc ['route_from'].'<br> To: '. $doc ['route_tosection'] .'<br>' ; 
// if ($doc ['fwd_remarks']!=''){echo 'Fwd Remarks: '.$doc ['fwd_remarks']. '<br>';}
 if (viewtime($doc ['datetime_route_accepted'])!=''){
 echo 'Received by : '.$doc ['received_by'].' | ' . viewtime($doc ['datetime_route_accepted']). '<br>' ; 
 if($doc['actions_taken']!=""){echo 'Actions Taken: '. $doc['actions_taken'] .'<br>';} else {echo '<font color="red"> PENDING for Appropriate Action </font>';}
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
	
	<?php 
	$num++;	
		
	} //end for each
	}
	?>
		
		</div>
		<?php 
$this->load->view('dtspages/frontpage_components/front_login_form.php');

?>   





 </div>        
		<?php } else{?>	  
<div class="row">	
<div class="col-md-8">	
		   <div class="callout callout-warning">
          <h4>There is no record available for this tracking number  <?php if (isset($track_code)){echo ' : '.$track_code; }?>. </h4>

        </div> </div>
		  <!-- Application buttons -->	  
	
			<?php 
$this->load->view('dtspages/frontpage_components/front_login_form.php');

?>   
          <!--end Application buttons -->
</div>
       		  
		  
		<?php } }?>
   <!-- /.box -->
        </div>
	
	
	
	
        <!-- /.col -->
      </div>
	<!-- /end list -->	  	  
	

 
	
		  
		  
		  

    </section>
    <!-- /.content -->
	 </div>
	
	
	
	
	
	
	
	
	
	
	
	
	
      
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>






<?php 
//$this->load->view('dtspages/components/main_content.php');

?> 













 
 <!------ // END CONTENT ----------------------- -->
  
 

<?php 
$this->load->view('dtspages/frontpage_components/front_footer.php');

?>   
