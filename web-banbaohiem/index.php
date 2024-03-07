<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Web bảo hiểm</title>
</head>
<body>
    <div class="wrapper">
      <?php
      session_start();
      include("admincp/config/config.php");
      include("pages_daily/header.php");
      include("pages_daily/menu.php");
      include("pages_daily/main.php");
      include("pages_daily/footer.php");
      
      ?>
             
    </div>
</body>
</html>
