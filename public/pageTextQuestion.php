<?php

use Dsw\T3\Text;
use Dsw\T3\TextQuestion;

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
  <h1>Pruebas con la clase TextQuestion</h1>
  <?php

  $aux = new TextQuestion("nada");

  $textQuestion = new TextQuestion("name");


  $textQuestion2 = new Text("Modulo", 2);

  $aux->addStatement($textQuestion);
  $aux->addStatement($textQuestion2);


  echo $aux->render();
 

  ?>
</body>
</html>