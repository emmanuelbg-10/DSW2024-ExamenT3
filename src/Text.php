<?php
namespace Dsw\T3;
class Text extends AbstractStatement implements DisplayableInterface{
  public $type;
  public function __construct($text, $type = 7) {
    parent::__construct($text);
    $this->type = $type;
  }

  public function render(): string
  {
    if($this->type >=1 && $this->type <= 6){
      
      return sprintf("<h%d>%s</h%d>", $this->type, $this->text, $this->type);
    }

   return sprintf("<p>%s</p>", $this->text);
  }
}


?>