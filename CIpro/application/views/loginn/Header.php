<!DOCTYPE html>
<html>
	<?php 
		if(isset($this->session->userdata['logged_in']))
		{	
			//我懷疑是路徑有誤，可是我沒有證據，沒辦法開車（是不是應該用site_url？還是應該用base_url？)
			//個人覺得不是導向檔案而是導向controller裡面的程式的話，應該使用site_url
			header("location:http://localhost/repos/CIpro/index.php/user_authentication/user_login_process");
		}
	?>
<head>
	<title>	<?php echo $title  ?></title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/css/all.css">
</head>