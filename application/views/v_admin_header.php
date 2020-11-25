<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Web Inventory</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/all.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/colorpicker/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
  <style>
.none {
    display:none;
}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<table width="100%" style="border-bottom:1px solid black;">
<tr>
	<td style="text-align:left; padding:5px;" width="15%">
		<img src="<?php echo base_url(); ?>assets/dist/img/logo.png?<?php echo strtotime("now");?>" width="60px">
	</td>
	<td style="text-align:left;" width="70%">
		<h4 style="text-align:center; font-size:1.1em"><b></b></h4>
	</td>
	<td style="text-align:right; padding:15px; font-size:18px; font-weight:bold;" width="15%">
		<?php 
		$id_user = $this->session->userdata("userid");
		$user = $this->db->query("select * from tbl_user where id_user='$id_user'")->row();
		echo $user->nama_user;
		?>
	</td>
</tr>
</table>
<div class="wrapper"> 
<?php 
include("v_admin_menu.php");
?>