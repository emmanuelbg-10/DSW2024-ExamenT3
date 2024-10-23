<?php
namespace Dsw\T3;

class TextQuestion extends AbstractQuestion{

  public function __construct($name) {
    parent::__construct($name);
  }

  public function render() {
    return parent::renderStatements() . sprintf('<input type="text" name="%s" />', $this->name);
  }
}

?>