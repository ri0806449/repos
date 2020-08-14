<!DOCTYPE html>
<html>
<?php 
	if(isset($this->session->userdata['logged_in'])){
		$username = ($this->session->userdata['logged_in']['username']);
		$email = ($this->session->userdata['logged_in']['email']);
		$gender = ($this->session->userdata['logged_in']['gender']);
		$hobby = ($this->session->userdata['logged_in']['hobby']);
	}else{
		//我懷疑是路徑有誤，可是我沒有證據，沒辦法開車（是不是應該用site_url？還是應該用base_url？)
		//個人覺得不是導向檔案而是導向controller裡面的程式的話，應該使用site_url
		//因為這是在user_authentication中引用的view，所以即如下方給予相對應位置即可
		header("location:user_login_process");
	};

	if ($this->session->userdata('logged_in')) {
		echo "胖虎回來了";
	}else{
		echo "胖虎掰掰～";
	}
	//echo $username;
	var_dump($email);
?>
<head>
	<title>	<?php echo $title  ?></title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
