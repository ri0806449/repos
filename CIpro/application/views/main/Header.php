<!DOCTYPE html>
<html>
<?php 
	if(isset($this->session->userdata['logged_in'])){
		$username = ($this->session->userdata['logged_in']['username']);
		$email = ($this->session->userdata['logged_in']['email']);
		$gender = ($this->session->userdata['logged_in']['gender']);
		$hobby = ($this->session->userdata['logged_in']['hobby']);
	}
	else{
		header("location: loginn");
	};

	if ($this->session->userdata('logged_in')) {
		echo "胖虎回來了";
	}else{
		echo "胖虎掰掰～";
	}
	//echo $username;
	var_dump($hobby);
?>
<head>
	<title>	<?php echo $title  ?></title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
