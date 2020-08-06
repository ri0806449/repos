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
		<td><?= $user[$key]['username'];  ?></td>
		<td><?= $user[$key]['email'];  ?></td>
		<td>
			<?php 
			if ($user[$key]['gender'] == 0){
				echo "女孩紙";
				}
			elseif($user[$key]['gender'] == 1){
				echo "男孩紙";
				}	
			?>
		</td>
		<td><?= $user[$key]['hobby'];  ?></td>
	</tr>
	<?php endforeach; ?>
	</tbody>
</table>