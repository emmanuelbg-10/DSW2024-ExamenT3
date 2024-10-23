<?php
namespace Dsw\T3;

abstract class AbstractChoiseQuestion extends AbstractQuestion{
  private $options = [];
  public function __construct($name) {
    parent::__construct($name);
  }

  public function getOptions(){
    return $this->options;
  }

  public function addOption($clave, $valor){

    $this->options += [$clave => $valor];
  }
}

?>