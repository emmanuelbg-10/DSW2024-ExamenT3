<?php

use Dsw\T3\DisplayableInterface;
use PHPUnit\Framework\TestCase;

class DisplayableInterfaceTest extends TestCase
{

  public function testDisplayableInterfaceExist()
  {
      $reflection = new ReflectionClass(DisplayableInterface::class);
      $this->assertTrue($reflection->isInterface(), 'DisplayableInterface debe ser Interfaz.');
  }

  public function testDisplayableInterfaceHasRender()
  {
    $reflection = new ReflectionClass(DisplayableInterface::class);
    $methods = [];
    foreach($reflection->getMethods() as $method) {
      $methods[] = $method->name;
    }
    $this->assertContains('render', $methods, 'DisplayableInterface no tiene el método render');
    
  }
}