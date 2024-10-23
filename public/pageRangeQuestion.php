<?php

use Dsw\T3\RangeQuestion;
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
  <h1>Pruebas con la clase RangeQuestion</h1>
  <?php



$text = new Text("Nivel: ", 3);

$age = new RangeQuestion("age", 18, 100);

$level = new RangeQuestion("level", 1, 5);



$level->addStatement($age);

$level->addStatement($text);

echo $level->render();


?>

</body>
</html>