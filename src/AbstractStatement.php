<?php
namespace Dsw\T3;

abstract Class AbstractStatement {
  protected string $text;

  public function __construct($text)
  {
    $this->text = $text;
  }
}