<?php

use Dsw\T3\AbstractChoiseQuestion;
use Dsw\T3\AbstractQuestion;
use PHPUnit\Framework\TestCase;

class AbstractChoiseQuestionTest extends TestCase
{

  public function testAbstractChoiseQuestionExist()
  {
      $reflection = new ReflectionClass(AbstractChoiseQuestion::class);
      $this->assertTrue($reflection->isAbstract(), 'AbstractChoiseQuestion existe y es abstracta');
  }

  public function testAbstractChoiseQuestionAddOptions()
  {
    $name = "questionselect";
    $question = new class ($name) extends AbstractChoiseQuestion {};
    $question->addOption('key1','value1');
    $this->assertCount(1, $question->getOptions(), 'No se añade una opción correctamente');
    $this->assertEquals('value1', $question->getOptions()['key1'], 'No se almacena la clave valor en un array asociativo');
    $question->addOption('key2','value2');
    $this->assertCount(2, $question->getOptions(), 'No se añade una opción correctamente');
    $this->assertEquals('value2', $question->getOptions()['key2'], 'No se almacena la clave valor en un array asociativo');
  }

}