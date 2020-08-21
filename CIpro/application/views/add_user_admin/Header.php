<!DOCTYPE html>
<html>
<?php 
	if(isset($this->session->userdata['logged_in_admin'])){
		$username = ($this->session->userdata['logged_in_admin']['username']);
		$email = ($this->session->userdata['logged_in_admin']['email']);
		$gender = ($this->session->userdata['logged_in_admin']['gender']);
		$hobby = $this->session->userdata['logged_in_admin']['hobby'];
	}
	else{
		header("location: loginn_admin");
	}
?>
<head>
	<title>	<?php echo $title  ?></title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/all.css">

</head>
