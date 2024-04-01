<?php 

$this->load->view('documents/components/doc_main_header.php');
//$this->load->view('documents/components/test_header.php');
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
if(isset($co_users_count)){$coUsersCount= $co_users_count;}else{$$coUsersCount="";}
if(isset($count_fwdroute)){$fwdCount= $count_fwdroute;}else{$fwdCount="";}
?>
<!--------------  CONTENT   ----------------.>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       
        <small><?php if(isset($mysectionname)){echo $mysectionname;}?> | Routed  Incoming Documents</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.php/documents"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Submit Document</li>
		<li><span id="time"> </span> <!--?php echo date("Y-m-d  H:i:s "); ? --></li>
      </ol>
    </section>
<hr>
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
				
	<?php if(isset($track_code)){ ?> 
		<div class="callout callout-danger" align="center"><font size="5"><i> New Forwarded Document </i><br> Tracking Code : <?php echo $track_code; ?> </font><br>
		<?php if(isset($doc_details)){
			foreach ($doc_details as $doc){
		//	$time = strtotime($doc['datetime_accepted']);
		//	$receivetime = date("m/d/y @ g:i A", $time);
			echo 'Date & Time FORWARDED : <font size="4"><b>'.$doc['datetime_posted']. '</b></font><br>';	
			
			echo $doc['doctype_description']. ' | '  ;	
			echo $doc['docs_description']. ' | ';
			
			echo 'Purpose : '.$doc['actions_needed'] .' <br> ';
			echo '<hr width=70%><font size="4"> You may now  forward this document to : '.$doc['section_description']. ' </font> ';
			}}?>
					
	</div>
<?php 	}?>	
	<!------------------------------------          --------------------------->

 	
<div class="row">
	<div class="col-md-8">


<div class="box box-info" >
            <div class="box-header with-border">
              
            <!-- /.box-header -->
            <!-- form start -->
<?php			
if(isset($error)){
					echo '<div class="callout callout-warning"><h3 align="center">' ;
					if($error=43){ echo 'The document was forwarded or acted already! </h3></div>';
				}}
				
?>	


            </div>			
</div>


</div>
<!------------   -->

 <!-- Application buttons -->
  <?php 
$this->load->view('documents/components/doc_application_buttons.php');
?>  
<!------------------ end buttons          --->

		  
<!------------------------------------ ---------------------------------------------->
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
