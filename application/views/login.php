<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agape Support System</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
    var SITE = '<?=base_url().'/';?>';
    </script>
    <link href="<?php echo base_url();?>css/datepicker.css" rel="stylesheet" />
	 <link href="<?php echo base_url();?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
</head>

<body style="background-color: white;">

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: white;">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" style="padding-bottom: 15%;">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url();?>" style="color: #FF9233;font-size:30px">COURTS CRM SYSTEM</a>
            </div>
            <?php if ($this->session->userdata('user_id') != '') { ?>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
              
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Welcome <? //$this->session->userdata('user_id')['user_firstname']?>  <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url();?>index.php/login/bye"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <?php  } ?>
<div class="container">
    <div class="row">
         <div class="col-lg-12">
        <div class="col-lg-6 col-lg-offset-3">
           
            <div class="panel panel-default">
                <div><img src="<?php echo base_url();?>img/clogo.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>img/alogo.png"></div>
                <div class="panel-heading" style="background-color: gold;"> <strong class="">Login</strong>

                </div>
                <div class="panel-body" style="background-color: black;">
                    
                    <?= validation_errors(); ?>
                    <form class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/login/auth" method="post" style="color: white">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-lg-3 control-label">User Name</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="username" name="username" placeholder="User Name" required maxlength="20" autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-lg-3 control-label">Password</label>
                            <div class="col-lg-8">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="" maxlength="20">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">

                            </div>
                        </div>
                        <div class="form-group last">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-success">Sign in</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer" style="background-color: brown;">&nbsp;</div>
            </div>
        </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url();?>js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
 <script src="<?php echo base_url();?>js/general.js"></script>
</body>
</html>