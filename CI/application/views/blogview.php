<html>
  <body>
          <h1><?php echo $heading;?></h1>
          <h3>我的小清單</h3>
          <ul>
            <?php foreach ($to_do_list as $key => $value): ?>
              <li><?php echo $key+1 ; ?>.  <?php echo $value ?></li>
            <?php endforeach; ?>
          </ul>
          <ul>
            <?php foreach ($user as $key => $value): ?>
            <li><?= $key+1; ?>.  
                <?= $user[$key]["username"]; ?>：<?= $user[$key]['murmur'];  ?>
            </li>
          <?php endforeach; ?>
          </ul>  


  </body>
</html>
