<?php

$sess = $this->session->userdata('user_id');
//var_dump($sess);
//echo base_url(); exit;
?>
<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Agape Customer Support</title>

  <!-- Tell the browser to be responsive to screen width -->

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.5 -->

  <link rel="stylesheet" href="<?=base_url()?>/css/bootstrap.min.css">

  <!-- Font Awesome -->

  <link rel="stylesheet" href="<?=base_url()?>font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->

  <!--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->

  <!-- Theme style -->

  <link rel="stylesheet" href="<?=base_url()?>/css/AdminLTE.min.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins

       folder instead of downloading all of them to reduce the load. -->

  <link rel="stylesheet" href="<?=base_url()?>/css/skins/_all-skins.min.css">

  <!-- iCheck -->

  <link rel="stylesheet" href="<?=base_url()?>/plugins/iCheck/flat/blue.css">

  <!-- Morris chart -->

  <link rel="stylesheet" href="<?=base_url()?>/plugins/morris/morris.css">

  <!-- jvectormap -->

  <link rel="stylesheet" href="<?=base_url()?>/plugins/jvectormap/jquery-jvectormap-1.2.2.css">

  <!-- Date Picker -->

  <link rel="stylesheet" href="<?=base_url()?>/plugins/datepicker/datepicker3.css">

  <!-- Daterange picker -->

  <link rel="stylesheet" href="<?=base_url()?>/plugins/daterangepicker/daterangepicker-bs3.css">

  <!-- bootstrap wysihtml5 - text editor -->

  <link rel="stylesheet" href="<?=base_url()?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">



  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

  <!--[if lt IE 9]>

  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  <![endif]-->

  <script>

  var SITE = '<?=base_url()?>';
    </script>

  <!-- Bootstrap time Picker -->

  <link rel="stylesheet" href="<?=base_url()?>/plugins/timepicker/bootstrap-timepicker.min.css">
<script src="<?php echo base_url();?>js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
 <script src="<?php echo base_url();?>js/general.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">



  <header class="main-header">

    <!-- Logo -->

    <a href="<?=base_url()?>" class="logo">

      <!-- mini logo for sidebar mini 50x50 pixels -->

      <span class="logo-mini"><b>C</b>ourts</span>

      <!-- logo for regular state and mobile devices -->

      <span class="logo-lg"><b>COURTS</b> CRM</span>

    </a>

    <!-- Header Navbar: style can be found in header.less -->

   <nav class="navbar navbar-static-top" role="navigation">

      

      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">

        <span class="sr-only">Toggle navigation</span>

      </a>

	 <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
		<li class="dropdown user user-menu">
        
                <div class="pull-right">
                  <a href="<?=base_url()?>index.php/login/bye" class="btn btn-default">Sign out</a>
                </div>
             
          </li>

			 </ul>
		 </div>

    </nav>

  </header>

   <?php if ($this->session->userdata('user_id') != '') { ?>
  <!-- Left side column. contains the logo and sidebar -->

  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->

    <section class="sidebar">

      <!-- Sidebar user panel -->

      <div class="user-panel">

        <div class="pull-left image">

          <img src="<?=base_url()?>img/user2-160x160.jpg" class="img-circle" alt="User Image">

        </div>

        <div class="pull-left info">

          <p><?php  echo ucfirst($sess['username']); ?></p>

          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>

        </div>

      </div>

      
      <ul class="sidebar-menu">

        <li class="header">MAIN NAVIGATION</li>
		
       
		<?php if($sess['role'] == '4') { ?>
        
        <li class="<?php if($title=='master') { ?> active <?php } ?> treeview">

          <a href="#">

            <i class="fa fa-bell text-green"></i>

            <span>Masters</span>

            <i class="fa fa-angle-left pull-right"></i>

          </a>

          <ul class="<?php if($title=='master') { ?> active <?php } ?> treeview-menu">
		 
		  
		  <li><a href="<?=base_url()?>master/sales_channel" ><i class="fa fa-circle-o"></i> Sales Channel</a></li>

            <li><a href="<?=base_url()?>master/prdc_category"><i class="fa fa-circle-o"></i> Product Category</a></li>

            <li><a href="<?=base_url()?>master/touch_point"><i class="fa fa-circle-o"></i> Touch Point</a></li>

           <li><a href="<?=base_url()?>master/case_nature"><i class="fa fa-circle-o"></i> Case Nature</a></li>
           <li><a href="<?=base_url()?>master/case_topic"><i class="fa fa-circle-o"></i> Case Topic</a></li>
           <li><a href="<?=base_url()?>master/prblm"><i class="fa fa-circle-o"></i> Case Issue</a></li>
           <li><a href="<?=base_url()?>master/rc"><i class="fa fa-circle-o"></i> Root Cause</a></li>
           <li><a href="<?=base_url()?>master/orc"><i class="fa fa-circle-o"></i> Owner of Root Cause</a></li>
           <li><a href="<?=base_url()?>master/con"><i class="fa fa-circle-o"></i> Supplier / Installer</a></li>
          </ul>

        </li>
		<li <?php if($title=='staff') { ?> class="active" <?php } ?>>

          <a href="<?=base_url()?>staff">

            <i class="fa fa-child text-orange"></i> <span>Staffs</span>

            <small class="label pull-right bg-green"><?=@$staffcnt?></small>

          </a>

        </li>
<?php } ?>
		
		<li <?php if($title=='WikiCourts') { ?> class="active" <?php } ?>>

          <a href="<?=base_url()?>master/wikicourts">

            <i class="fa fa-book text-aqua"></i> <span>WikiCourts</span>

            

          </a>

        </li>	
		
        <li class="<?php if($title=='enquiry') { ?> active <?php } ?> treeview">

          <a href="#">

            <i class="fa fa-bookmark text-fuchsia"></i>

            <span>Call Log Entry</span>

            <i class="fa fa-angle-left pull-right"></i>

          </a>

          <ul class="<?php if($title=='enquiry') { ?> active <?php } ?> treeview-menu">
		 
		  
		  <li><a href="<?=base_url()?>index.php/enquiry/add" ><i class="fa fa-circle-o"></i> New Entry</a></li>

            <li><a href="<?=base_url()?>index.php/enquiry"><i class="fa fa-circle-o"></i> List</a></li>
   

          </ul>

        </li>
	
        
      </ul>

    </section>

    <!-- /.sidebar -->

  </aside>
  <?php } ?>