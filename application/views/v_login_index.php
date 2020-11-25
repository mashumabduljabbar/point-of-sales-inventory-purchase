<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WEB INVENTORY</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/morris/morris.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <style>
  td.example { 
		background-image: url(<?php echo base_url(); ?>assets/dist/img/logo.png);
		background-repeat: no-repeat;
		padding:10px;
		background-size: 50px;
		background-position: 5% 50%; 
	}
  div{
	  border-radius: 7px;
  }
	.account-wall
	{
		margin-top: 20px;
		padding: 40px 0px 20px 0px;
		background-color: rgba(247, 247, 247, 0.8); //#f7f7f7
		-moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		-webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		
	}
	.form-signin
	{
		max-width: 300px;
		padding: 15px;
		margin: 0 auto;
		
	}
	.form-signin .form-signin-heading, .form-signin .checkbox
	{
		margin-bottom: 10px;
	}
	.form-signin .checkbox
	{
		font-weight: normal;
	}
	.form-signin .form-control
	{
		position: relative;
		font-size: 16px;
		height: auto;
		padding: 10px;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
	}
	.form-signin .form-control:focus
	{
		z-index: 2;
	}
	.form-signin input[type="text"]
	{
		margin-bottom: -1px;
		border-bottom-left-radius: 0;
		border-bottom-right-radius: 0;
		background-color: rgba(247, 247, 247, 0.7);
	}
	.form-signin input[type="password"]
	{
		margin-bottom: 10px;
		border-top-left-radius: 0;
		border-top-right-radius: 0;
		background-color: rgba(247, 247, 247, 0.7);
	}
  </style>
</head>
<body class="hold-transition skin-green layout-top-nav">
    <!-- Main content -->
    <section>
		<div class="register-box"> 
			<div class="account-wall">
				<h4 class="login-box-msg"><strong>Web Inventory</strong></h4>
			 <h5 class="login-box-msg" style="color: green;"><?php echo $hasillogin;?></h5>
				<form action="<?php echo base_url('login/aksi_login'); ?>" method="post" class="form-signin" >
				  <div class="form-group has-feedback">
					<input type="text" name="username" class="form-control" placeholder="Username" >
					<span class="fa fa-user form-control-feedback"></span>
				  </div>
				  
				  <div class="form-group has-feedback">
					<input type="password" name="password" class="form-control" placeholder="Password">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				  </div>
				  
				  <div class="form-group has-feedback">
					<br>
				  </div>
				  <div class="form-group has-feedback">
					<button type="submit" class="btn btn-success btn-block btn-flat">Login</button>
				  </div>
				</form>
			</div>
		</div>
    </section>
</body>
</html>