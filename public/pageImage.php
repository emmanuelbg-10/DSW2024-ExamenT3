<?php

use Dsw\T3\Image;

require '../vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Pruebas con la clase Image</h1>
  <?php
  $image1 = new Image("Imagen1","correcto.webp");
  $image2 = new Image("Imagen2","check.png", "img/");
  $image3 = new Image("Imagen de correcto","check.png", "emmanuel/");
  echo $image1->render();
  echo $image2->render();
  echo $image3->render();
  
  ?>

</body>
</html>