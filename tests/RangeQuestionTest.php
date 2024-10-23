<?php

use Dsw\T3\AbstractQuestion;
use Dsw\T3\Text;
use Dsw\T3\RangeQuestion;
use PHPUnit\Framework\TestCase;

class RangeQuestionTest extends TestCase {

  public function testRangeQuestionExist()
  {
      $this->assertInstanceOf(AbstractQuestion::class, new RangeQuestion('texto', 1, 10), 'Image no es instancia de AbstractStatement');
  }

  public function testRangeQuestionRenderWithoutStatement()
  {
    $question = new RangeQuestion('satisfaction', 1, 10);
    $this->assertEquals('<input type="range" name="satisfaction" min="1" max="10" />', $question->render(), 'RangeQuestion->render no genera el input correcto.');

    $question = new RangeQuestion('dificulty', 50, 100);
    $this->assertEquals('<input type="range" name="dificulty" min="50" max="100" />', $question->render(), 'RangeQuestion->render no genera el input correcto.');
  }


  public function testTextRenderWithOneStatement() {
    $statement1 = new Text('Statement 1');
    $question = new RangeQuestion('satisfaction', 1, 10);
    $question->addStatement($statement1);

    $this->assertEquals('<p>Statement 1</p><input type="range" name="satisfaction" min="1" max="10" />', $question->render(), 'RangeQuestion->render no genera el input correcto junto con el enunciado');
  }

  public function testTextRenderWithTwoStatement() {
    $statement1 = new Text('Satisfaction Level', 1);
    $statement2 = new Text('1-not at all satisfied 10-completely satisfied', 4);
    $question = new RangeQuestion('satisfaction', 1, 5);
    $question->addStatement($statement1);
    $question->addStatement($statement2);
    $this->assertEquals('<h1>Satisfaction Level</h1><h4>1-not at all satisfied 10-completely satisfied</h4><input type="range" name="satisfaction" min="1" max="5" />', $question->render(), 'RangeQuestion->render no genera el input correcto junto con los dos enunciados');
  }
}