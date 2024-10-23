<?php

use Dsw\T3\AbstractStatement;
use PHPUnit\Framework\TestCase;

class AbstractStatementTest extends TestCase
{

  public function testAbstractStatementExist()
  {
      $reflection = new ReflectionClass(AbstractStatement::class);
      $this->assertTrue($reflection->isAbstract(), 'AbstractStatement existe y es abstracta');
  }

  public function testAbstractStatementProperties()
  {
    $reflection = new ReflectionClass(AbstractStatement::class);
    $properties = [];
    foreach($reflection->getProperties() as $property) {
      $properties[] = $property->name;
    }
    $this->assertContains('text', $properties, 'AbstractStatement no tiene la propiedad text');    
  }
}