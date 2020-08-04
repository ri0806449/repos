<html>
  <head>
          <title><?php echo $title;?></title>
  </head>
  <body>
          <h1><?php echo $heading;?></h1>
          <h3>我的小清單</h3>
          <ul>
            <?php foreach ($to_do_list as $key => $value): ?>
              <li><?php echo $key+1 ; ?>.  <?php echo $value ?></li>
            <?php endforeach; ?>
          </ul>
  </body>
</html>
