<?php

use Dsw\T3\AbstractQuestion;
use Dsw\T3\Text;
use Dsw\T3\TextQuestion;
use PHPUnit\Framework\TestCase;

class TextQuestionTest extends TestCase {

  public function testTextQuestionExist()
  {
      $this->assertInstanceOf(AbstractQuestion::class, new TextQuestion('texto'), 'TextQuestion no es instancia de AbstractQuestion');
  }

  public function testTextRenderWithOutStatement() {
    $textQuestion = new TextQuestion('name');
    $this->assertEquals('<input type="text" name="name" />', $textQuestion->render(), 'TextQuestion render() no da la salida correcta');
    $textQuestion = new TextQuestion('model');
    $this->assertEquals('<input type="text" name="model" />', $textQuestion->render(), 'TextQuestion->render no genera el input correcto.');
  }

  public function testTextRenderWithOneStatement() {
    $statement1 = new Text('Statement 1');
    $textQuestion = new TextQuestion('name');
    $textQuestion->addStatement($statement1);

    $this->assertEquals('<p>Statement 1</p><input type="text" name="name" />', $textQuestion->render(), 'TextQuestion render() no da la salida correcta');
  }

  public function testTextRenderWithTwoStatement() {
    $statement1 = new Text('Statement 1', 1);
    $statement2 = new Text('Statement 2', 2);
    $textQuestion = new TextQuestion('name');
    $textQuestion->addStatement($statement1);
    $textQuestion->addStatement($statement2);

    $this->assertEquals('<h1>Statement 1</h1><h2>Statement 2</h2><input type="text" name="name" />', $textQuestion->render(), 'TextQuestion render() no da la salida correcta');
  }
}