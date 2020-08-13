<body>
	<h1>
		會員資料總覽
	</h1>
<!--以下以表格條列所有會員資料 -->
<table class="centered highlight">
	<thead>
	<tr>
		<th>帳號</th>
		<th>email</th>
		<th>性別</th>
		<th>興趣</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($user as $key => $value):?>
	<tr>
		<td><?= $username;  ?></td>
		<td><?= $email;  ?></td>
		<td>
			<?php 
			if ($gender == 0){
				echo "女孩紙";
				}
			elseif($gender == 1){
				echo "男孩紙";
				}	
			?>
		</td>
		<td><?= $hobby;  ?></td>
	</tr>
	<?php endforeach; ?>
	</tbody>
</table>