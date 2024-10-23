<?php
namespace Dsw\T3;

 class SingleChoiseQuestion extends AbstractChoiseQuestion{
  public function __construct($name) {
    parent::__construct($name);
  }

  public function render(): string
  {
    if(count($this->getOptions()) !== 0){
      $aux = '';
      foreach ($this->getOptions() as $key => $value) {
        $aux += parent::renderStatements() . sprintf('<input type="radio" name="%s" /><label for="module_DSW">Lado del servidor</label>', $this->name, $value, $key);
      }
    }
    return "";
  }
}

?>