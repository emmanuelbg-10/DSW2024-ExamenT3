<?php
namespace Dsw\T3;
use Dsw\T3\AbstractStatement;
use Dsw\T3\DisplayableInterface;

abstract class AbstractQuestion implements DisplayableInterface {
  public $name;
  private $statements;
  public function __construct($name) {
    $this->name = $name;
    $this->statements = [];
  }

  public function getStatements(): array
  {
    return $this->statements;
  }

  public function addStatement($p1): void
  {
    if($p1 instanceof AbstractStatement || $p1 instanceof AbstractQuestion){
      array_push($this->statements, $p1);  
    } 
  }

  public function renderStatements(): string
  {
    $aux = '';
    foreach ($this->statements as $key => $value) {
      $aux = $aux . $value->render();
    }
    return $aux;
  }

}

?>