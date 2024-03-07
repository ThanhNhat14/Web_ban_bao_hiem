<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="stylesadmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>ADMIN</title>
</head>
<body>
    <h2 class="title-admin">MY ADMIN</h2>
    <div class="wrapper">
     <?php
      include("config/config.php");
      //include("../header.php");
      include("modules/menu.php");
      include("modules/main.php");
    //  include("../footer.php    ");
      
      ?>
    </div>
   
    
</body>
</html>