<body>
	<header>
		<h1>
			會員資料總覽
		</h1>
	</header>
	<main>
	<div class="row">
		<div class="col s12">
			  <a class="wave-effect intro wave-light btn-large" onclick="$('.tap-target').tapTarget('open')">自我介紹</a>
		</div>
	</div>
	  <!-- Tap Target Structure -->
	  <div class="tap-target" data-target="menu">
	    <div class="tap-target-content">
	      <h5><?= $username ?> 的相關資訊</h5>
	      <div>帳號：<?=$username  ?></div>
	      <div>
	      	性別：
	      	<?php 
	      		if ($gender == 1) {
	      			echo "男";
	      		}else{
	      			echo "女";
	      		}
	      	?>
	      </div>
	      <div>信箱：<?=$email  ?></div>
	      <div>興趣：<?=$hobby  ?></div>
	    </div>
	  </div>
	<div class="row">
		<div class="col s12 offset-s11">
			<a id="menu" class="waves-effect waves-light btn-large btn-floating" ><i class="material-icons assist">menu</i></a>
		</div>
	</div>
	<div class="row">
		<div class="col s9 offset-s1">
			<table class="centered highlight">
				<thead>
				<tr>
					<th>帳號</th>
					<th>email</th>
					<th>性別</th>
					<th>興趣</th>
					<th>編輯</th>
				</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<span class="edit"><?= $username;  ?></span>
							<input type= "text" class= "txtedit" data-id= '<?= $id  ?>' data-field= 'username' id= 'nametxt_<?= $id ?>' value= '<?= $username ?>'>
						</td>
						<td>
							<span class="edit"><?= $email;  ?></span>
							<input type="text" class= "txtedit" data-id= '<?= $id  ?>' data-field= 'email' id= 'emailtxt_<?= $id ?>' value= '<?= $email ?>'>
						</td>
						<td>
							<span class="edit">
								<?php 
								if ($gender == 0){
									echo "女孩";
									}
								elseif($gender == 1){
									echo "男孩";
									}	
								?>
							</span>
							<input type="text" class= "txtedit" data-id= '<?= $id  ?>' data-field= 'gender' id= 'gendertxt_<?= $id ?>' 
							value= 
								'<?php 
								if ($gender == 0){
									echo "女孩";
									}
								elseif($gender == 1){
									echo "男孩";
									}	
								?>'>
						</td>
						<td>
							<span class="edit"><?= $hobby;  ?></span>
							<input type="text" class= "txtedit" data-id= '<?= $id  ?>' data-field= 'hobby' id= 'hobbytxt_<?= $id ?>' value= '<?= $hobby ?>'>
						</td>
						<td>
							<a class="waves-effect waves-light btn"><i class="material-icons left">edit</i>編輯</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col s12 center">
			<a class="waves-effect waves-light btn-large" id="logout" href="logout"><i class="material-icons right">cloud</i>登出</a>
		</div>
	</div>
	</main>


 
