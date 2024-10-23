<?php

use Dsw\T3\Text;

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
  <h1>Pruebas con la clase Text</h1>
  <?php
  $encabezado1 = new Text("Encabezado 1", 1);
  $encabezado2 = new Text("Encabezado 2", 2);
  $encabezado3 = new Text("Encabezado 3", 3);
  $parrafo = new Text("párrafo", 7);

  echo $encabezado1->render() . "\n";
  echo $encabezado2->render() . "\n";
  echo $encabezado3->render() . "\n";
  echo $parrafo->render() . "\n";
  
  ?>

</body>
</html>