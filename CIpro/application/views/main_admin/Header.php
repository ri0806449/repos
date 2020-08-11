<!DOCTYPE html>
<html>
<?php 
	if(isset($this->session->userdata['logged_in'])){
		$username = ($this->session->userdata['logged_in']['username']);
		$email = ($this->session->userdata['logged_in']['email']);
		$gender = ($this->session->userdata['logged_in']['gender']);
		$hobby = $this->session->userdata['logged_in']['hobby']
	}
	else{
		header("location: login");
	}
?>
<head>
	<title>	<?php echo $title  ?></title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/css/all.css">
</head>
