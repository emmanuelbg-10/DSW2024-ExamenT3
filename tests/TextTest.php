<?php

use Dsw\T3\AbstractStatement;
use Dsw\T3\Text;
use PHPUnit\Framework\TestCase;

class TextTest extends TestCase
{

  public function testTextExist()
  {
      $this->assertInstanceOf(AbstractStatement::class, new Text('texto'), 'Text no es instancia de AbstractStatement');
  }

  public function testTextWithOutLevelRender()
  {
    $text = new Text('statement');
    $this->assertEquals('<p>statement</p>', $text->render(), 'Un texto sin nivel devuelve el texto como párrafo.');
  }

  public function testTextWithLevel1()
  {
    $text = new Text('statement', 1);
    $this->assertEquals('<h1>statement</h1>', $text->render(), 'Un texto con nivel 1 devuelve el texto como h1.');
  }

  public function testTextWithLevel3()
  {
    $text = new Text('statement', 3);
    $this->assertEquals('<h3>statement</h3>', $text->render(), 'Un texto con nivel 3 devuelve el texto como h3.');
  }

  public function testTextWithLevel6()
  {
    $text = new Text('statement', 6);
    $this->assertEquals('<h6>statement</h6>', $text->render(), 'Un texto con nivel 6 devuelve el texto como h6.');
  }

  public function testTextWithLevelOutRange()
  {
    $text = new Text('statement', 0);
    $this->assertEquals('<p>statement</p>', $text->render(), 'Un texto con nivel 0 devuelve el texto como párrafo.');
    $text = new Text('statement', 7);
    $this->assertEquals('<p>statement</p>', $text->render(), 'Un texto con nivel 7 devuelve el texto como párrafo.');
    $text = new Text('statement', 'wrong');
    $this->assertEquals('<p>statement</p>', $text->render(), 'Un texto con nivel "wrongW devuelve el texto como párrafo.'); 
  }
}