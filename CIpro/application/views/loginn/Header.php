<!DOCTYPE html>
<html>
	<?php 
		if(isset($this->session->userdata['logged_in']))
		{
			header("location:http://localhost/repos/CIpro/index.php/user_authentication/user_login_process");
		}
	?>
<head>
	<title>	<?php echo $title  ?></title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/css/all.css">
</head>
