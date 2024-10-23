<?php
namespace Dsw\T3;

class Image extends AbstractStatement implements DisplayableInterface{
  public $imageName;
  public $path;
  public function __construct($text, $imageName, $path = '') {
    parent::__construct($text);
    $this->imageName = $imageName;
    $this->path = $path;
  }

  public function render(): string
  {
    return sprintf('<img src="%s%s" alt="%s" />', $this->path, $this->imageName, $this->text);
  }
}
?>

<img src="." alt="">