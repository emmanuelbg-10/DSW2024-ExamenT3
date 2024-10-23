<?php

use Dsw\T3\AbstractQuestion;
use Dsw\T3\Comment;
use Dsw\T3\Text;
use PHPUnit\Framework\TestCase;

class AbstractQuestionTest extends TestCase
{

  public function testAbstractQuestionExist()
  {
      $reflection = new ReflectionClass(AbstractQuestion::class);
      $this->assertTrue($reflection->isAbstract(), 'AbstractQuestion existe y es abstracta');
  }

  public function testAbstractQuestionProperties()
  {
    $reflection = new ReflectionClass(AbstractQuestion::class);
    $properties = [];
    foreach($reflection->getProperties() as $property) {
      $properties[] = $property->name;
    }
    $this->assertContains('name', $properties, 'AbstractQuestion no tiene la propiedad text');    
  }

  public function testAbstractQuestionMethods()
  {
    $reflection = new ReflectionClass(AbstractQuestion::class);
    $methods = [];
    foreach($reflection->getMethods() as $method) {
      $methods[] = $method->name;
    }
    $this->assertContains('render', $methods, 'AbstractQuestionTest no tiene el método render');
    $this->assertContains('addStatement', $methods, 'AbstractQuestionTest no tiene el método addStatement');
    $this->assertContains('getStatements', $methods, 'AbstractQuestionTest no tiene el método getStatements');
    $this->assertContains('renderStatements', $methods, 'AbstractQuestionTest no tiene el método renderStatements');    
  }

  public function testAbstractQuestionWithStatements()
  {
    $text1 = new Text('statement');
    $name = "pregunta falsa";
    $question = new class ($name) extends AbstractQuestion {
      public function render() {
        return "";
      }
    };
    $question->addStatement($text1);
    $this->assertCount(1, $question->getStatements(), 'AbstractQuestion no añade nuevos enunciados');
    $this->assertContains($text1, $question->getStatements(), 'AbstractQuestion addStatement añade el enunciado a la pregunta');

    $text2 = new Text('statement2');
    $question->addStatement($text2);
    $this->assertCount(2, $question->getStatements(), 'AbstractQuestion no añade nuevos enunciados');
    $this->assertContains($text2, $question->getStatements(), 'AbstractQuestion addStatement añade el enunciado a la pregunta');

    $this->assertEquals($text1, $question->getStatements()[0], 'La primera posición debe ser el primer enunciado insertado');
    $this->assertEquals($text2, $question->getStatements()[1], 'La segunda posición debe ser el segundo enunciado insertado');
  }

  
  public function testAbstractQuestionWithStatementsWithComment()
  {
    $name = "pregunta falsa";
    $question = new class ($name) extends AbstractQuestion {
      public function render() {
        return "";
      }
    };
    $text1 = new Text('statement');
    $question->addStatement($text1);
    $this->assertCount(1, $question->getStatements(), 'AbstractQuestion no añade nuevos enunciados');
    $this->assertContains($text1, $question->getStatements(), 'AbstractQuestion addStatement añade el enunciado a la pregunta');

    $text2 = new Text('statement2');
    $question->addStatement($text2);
    $this->assertCount(2, $question->getStatements(), 'AbstractQuestion no añade nuevos enunciados');
    $this->assertContains($text2, $question->getStatements(), 'AbstractQuestion addStatement añade el enunciado a la pregunta');

    $comment1 = new Comment('This is a comment');
    $question->addStatement($comment1);
    $this->assertCount(3, $question->getStatements(), 'AbstractQuestion no añade comentarios');
    $this->assertContains($comment1, $question->getStatements(), 'AbstractQuestion addStatement añade el comentario a la pregunta');

    $this->assertEquals($text1, $question->getStatements()[0], 'La primera posición debe ser el primer enunciado insertado');
    $this->assertEquals($text2, $question->getStatements()[1], 'La segunda posición debe ser el segundo enunciado insertado');
    $this->assertEquals($comment1, $question->getStatements()[2], 'La tercera posición debe ser el comentario insertado');
  }

  public function testAbstractQuestionWithStatementsRender()
  {
    $name = "pregunta falsa";
    $question = new class ($name) extends AbstractQuestion {
      public function render() {
        return "";
      }
    };
    $text1 = new Text('statement', 1);
    $question->addStatement($text1);

    $text2 = new Text('statement2', 2);
    $question->addStatement($text2);

    $this->assertEquals(
      '<h1>statement</h1>' . 
      '<h2>statement2</h2>'
      , $question->renderStatements(), 'La pregunta no muestra los enunciados correctamente.');
  }
  
  
  public function testAbstractQuestionWithStatementsAndCommentRender()
  {
    $name = "pregunta falsa";
    $question = new class ($name) extends AbstractQuestion {
      public function render() {
        return "";
      }
    };
    $text1 = new Text('statement', 1);
    $question->addStatement($text1);

    $text2 = new Text('statement2', 2);
    $question->addStatement($text2);

    $comment1 = new Comment('This is a comment');
    $question->addStatement($comment1);
    $this->assertEquals(
      '<h1>statement</h1>' . 
      '<h2>statement2</h2>'
      , $question->renderStatements(), 'La pregunta no muestra los enunciados correctamente cuando hay comentarios.');
  }
}