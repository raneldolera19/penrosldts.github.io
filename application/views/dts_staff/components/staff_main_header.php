<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Document Tracking System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" type="image/png"  href="<?php echo base_url(); ?>assets/dist/img/logo-sximo.png" />
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
 
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
 
 
 
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   <!--script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>	
-->
<script src="<?php echo base_url(); ?>assets/dist/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/js/jquery.min.js"></script>  
<script type="text/javascript"  src="<?php echo base_url(); ?>assets/dist/js/jquery-ui.min.js"></script> 	

  <script>
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('time').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
</script>
 <!-- sCRIPT hEAD -->
 
 <script type="text/javascript">  
                  $(document).ready(function() {  
                     $("#sectionsDrop").change(function(){  
                     /*dropdown post *///  
                     $.ajax({  
                        url:"<?php echo base_url();?>documents/get_users",  
                        data: {unit_id:  //this is the post name
                           $(this).val()},  
                        type: "POST",  
                        success:function(data){  
                        $("#usersDrop").html(data);  
                     }  
                  });  
               });  
            });  
 </script> 

	 
		 

<script type="text/javascript">  
    jQuery(function () {
    var url = window.location.pathname;

    if (url == '/') {
        jQuery('.sidebar-menu li > a[href="/"]').parent().addClass('active');
    } else {
        var urlRegExp = new RegExp(url.replace(/\/$/, '') + "$");
        jQuery('.sidebar-menu li > a').each(function () {
            if (urlRegExp.test(this.href.replace(/\/$/, ''))) {
                jQuery(this).parent().addClass('active');
            }
        });
    }
});
   </script> 	
	







 
</head>
<body class="hold-transition skin-blue sidebar-mini" onload="startTime()">
<!--<body class="hold-transition skin-blue layout-top-nav">-->

