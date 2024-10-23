<?php

use Dsw\T3\AbstractChoiseQuestion;
use Dsw\T3\SingleChoiseQuestion;
use Dsw\T3\Text;
use PHPUnit\Framework\TestCase;

class SingleChoiseQuestionTest extends TestCase
{

  public function testSingleChoiseQuestionExist()
  {
      $question = new SingleChoiseQuestion('name');
      $this->assertInstanceOf(AbstractChoiseQuestion::class, $question, 'SingleChoiseQuestion no hereda de AbstractChoiseQuestion');
  }

  public function testSingleChoiseQuestionAddOptions()
  {
    $question = new SingleChoiseQuestion('nameQuestion');
    $question->addOption('key1','value1');
    $this->assertCount(1, $question->getOptions(), 'No se añade una opción correctamente');
    $this->assertEquals('value1', $question->getOptions()['key1'], 'No se almacena la clave valor en un array asociativo');
    $question->addOption('key2','value2');
    $this->assertCount(2, $question->getOptions(), 'No se añade una opción correctamente');
    $this->assertEquals('value2', $question->getOptions()['key2'], 'No se almacena la clave valor en un array asociativo');
  }

  public function testSingleChoiseQuestionRenderWithOutOptions() {
    $question = new SingleChoiseQuestion('name');
    $this->assertEquals('', $question->render(), 'Si no hay opciones, no se muestra nada');
  }

  public function testSingleChoiseQuestionRenderWithOneOption() {
    $question = new SingleChoiseQuestion('nameQuestion');
    $question->addOption('key1','value1');
    $this->assertEquals('<input type="radio" name="nameQuestion" value="key1" id="nameQuestion_key1" /><label for="nameQuestion_key1">value1</label>', $question->render(), 'render() no da un input con el label de forma correcta');
  }

  public function testSingleChoiseQuestionRenderWithOptions() {
    $question = new SingleChoiseQuestion('module');
    $question->addOption('DSW','Lado del servidor');
    $question->addOption('DEW','Lado del cliente');
    $question->addOption('DOR','Diseño de interfaces web');
    $this->assertEquals(
        '<input type="radio" name="module" value="DSW" id="module_DSW" /><label for="module_DSW">Lado del servidor</label>' .
        '<input type="radio" name="module" value="DEW" id="module_DEW" /><label for="module_DEW">Lado del cliente</label>' .
        '<input type="radio" name="module" value="DOR" id="module_DOR" /><label for="module_DOR">Diseño de interfaces web</label>'
        , $question->render(), 'render() no da todos los inputs con los labels de forma correcta');
  }


  public function testSingleChoiseQuestionRenderWithTwoOptionAndStatements() {
    $question = new SingleChoiseQuestion('module');
    $statement1 = new Text('Módulos del ciclo', 1);
    $statement2 = new Text('Elige tu módulo preferido');
    $question->addStatement($statement1);
    $question->addStatement($statement2);
    $question->addOption('DSW','Lado del servidor');
    $question->addOption('DEW','Lado del cliente');
    $question->addOption('DOR','Diseño de interfaces web');
    $this->assertEquals(
        '<h1>Módulos del ciclo</h1>' .
        '<p>Elige tu módulo preferido</p>' .
        '<input type="radio" name="module" value="DSW" id="module_DSW" /><label for="module_DSW">Lado del servidor</label>' .
        '<input type="radio" name="module" value="DEW" id="module_DEW" /><label for="module_DEW">Lado del cliente</label>' .
        '<input type="radio" name="module" value="DOR" id="module_DOR" /><label for="module_DOR">Diseño de interfaces web</label>'
        , $question->render(), 'render() no da todos los inputs con los labels de forma correcta');
  }
}