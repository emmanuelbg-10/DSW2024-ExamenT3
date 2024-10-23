<?php
namespace Dsw\T3;
use Dsw\T3\AbstractQuestion;

class RangeQuestion extends AbstractQuestion{
  public $min;
  public $max;
  public function __construct($name, $min, $max) {
    parent::__construct($name);
    $this->min = $min;
    $this->max = $max;
  }

  public function render() {
    return parent::renderStatements() . sprintf('<input type="range" name="%s" min="%d" max="%d" />', $this->name, $this->min, $this->max);
    
  }
}
?>