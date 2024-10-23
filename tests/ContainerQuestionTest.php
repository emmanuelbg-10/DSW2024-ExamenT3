<?php

use Dsw\T3\AbstractQuestion;
use Dsw\T3\ContainerQuestion;
use Dsw\T3\RangeQuestion;
use Dsw\T3\Text;
use Dsw\T3\TextQuestion;
use PHPUnit\Framework\TestCase;

class ContainerQuestionTest extends TestCase
{

  public function testContainerQuestionExist()
  {
      $question = new ContainerQuestion('name');
      $this->assertInstanceOf(AbstractQuestion::class, $question, 'ContainerQuestion no hereda de AbstractQuestion');
  }

  public function testContainerQuestionAddQuestion()
  {
    $question = new ContainerQuestion('nameQuestion');
    $questionText1 = new TextQuestion('name');
    $question->addQuestion($questionText1);
    $this->assertCount(1, $question->getQuestions(), 'No se añade una pregunta correctamente');
    $this->assertContains($questionText1, $question->getQuestions(), 'No se almacena la pregunta');
    $questionText2 = new TextQuestion('surname');
    $question->addQuestion($questionText2);
    $this->assertCount(2, $question->getQuestions(), 'No se añade una pregunta correctamente');
    $this->assertContains($questionText2, $question->getQuestions(), 'No se almacena la pregunta');
  }

  public function testContainerQuestionEmptyRender()
  {
    $question = new ContainerQuestion('nameContainer');
    $this->assertEquals('<fieldset><legend>nameContainer</legend></fieldset>', $question->render(), 'Una pregunta contenedor sin preguntas no devuelve el fieldset con la leyenda.');
  }

  public function testContainerQuestionOneQuestionRender()
  {
    $question = new ContainerQuestion('nameContainer');
    $questionText1 = new TextQuestion('name');
    $question->addQuestion($questionText1);
    $this->assertEquals(
      '<fieldset><legend>nameContainer</legend>' . 
      '<input type="text" name="name" />' . 
      '</fieldset>', $question->render(), 'Una pregunta contenedor sin preguntas no devuelve el fieldset con la leyenda.');
  }

  public function testContainerQuestionThreeQuestionRender()
  {
    $question = new ContainerQuestion('nameContainer');
    $question->addQuestion(new TextQuestion('name'));
    $question->addQuestion(new TextQuestion('surname'));
    $question->addQuestion(new TextQuestion('address'));
    $this->assertEquals(
      '<fieldset><legend>nameContainer</legend>' . 
      '<input type="text" name="name" />' . 
      '<input type="text" name="surname" />' . 
      '<input type="text" name="address" />' . 
      '</fieldset>', $question->render(), 'Una pregunta contenedor sin preguntas no devuelve el fieldset con la leyenda.');
  }

  public function testContainerQuestionOneQuestionAndStatementRender()
  {
    $question = new ContainerQuestion('nameContainer');
    $statement1 = new Text('Statement 1', 1);
    $statement2 = new Text('Statement 2', 2);
    $question->addStatement($statement1);
    $question->addStatement($statement2);
    $questionText1 = new TextQuestion('name');
    $question->addQuestion($questionText1);
    $this->assertEquals(
      '<h1>Statement 1</h1>' . 
      '<h2>Statement 2</h2>' . 
      '<fieldset><legend>nameContainer</legend>' . 
      '<input type="text" name="name" />' . 
      '</fieldset>', $question->render(), 'Una pregunta contenedor sin preguntas no devuelve el fieldset con la leyenda.');
  }

  public function testContainerQuestionWithSubContainerQuestionRender()
  {
    $question1 = new ContainerQuestion('personal data');
    $question2 = new ContainerQuestion('name');
    $question2->addQuestion(new TextQuestion('familyname'));
    $question2->addQuestion(new TextQuestion('surname'));
    $question1->addQuestion($question2);
    $question3 = new ContainerQuestion('address');
    $question3->addQuestion(new TextQuestion('street'));
    $question3->addQuestion(new TextQuestion('district'));
    $question3->addQuestion(new TextQuestion('country'));
    $question1->addQuestion($question3);
    $this->assertEquals(
      '<fieldset><legend>personal data</legend>' . 
      '<fieldset><legend>name</legend>' . 
      '<input type="text" name="familyname" />' . 
      '<input type="text" name="surname" />' . 
      '</fieldset>' .
      '<fieldset><legend>address</legend>' . 
      '<input type="text" name="street" />' . 
      '<input type="text" name="district" />' . 
      '<input type="text" name="country" />' . 
      '</fieldset>' .
      '</fieldset>'
      , $question1->render(), 'Una pregunta contenedor sin preguntas no devuelve el fieldset con la leyenda.');
  }

  public function testContainerQuestionWithSubContainerQuestionAndStatementsIncluyedRender()
  {
    $question1 = new ContainerQuestion('personal data');
    $statement1 = new Text('Registration form', 1);
    $question1->addStatement($statement1);
    $question2 = new ContainerQuestion('name');
    $statement2 = new Text('Write your data:', 2);
    $question2->addStatement($statement2);
    $question2->addQuestion(new TextQuestion('familyname'));
    $question2->addQuestion(new TextQuestion('surname'));
    $question1->addQuestion($question2);
    $question3 = new ContainerQuestion('address');
    $question3->addQuestion(new TextQuestion('street'));
    $question3->addQuestion(new TextQuestion('district'));
    $question3->addQuestion(new TextQuestion('country'));
    $question1->addQuestion($question3);
    $questionAge = new RangeQuestion('age', 18, 99);
    $questionAge->addStatement(new Text('Edad:', 4));
    $question1->addQuestion($questionAge);
    $this->assertEquals(
      '<h1>Registration form</h1>' .
      '<fieldset><legend>personal data</legend>' . 
      '<h2>Write your data:</h2>' .
      '<fieldset><legend>name</legend>' . 
      '<input type="text" name="familyname" />' . 
      '<input type="text" name="surname" />' . 
      '</fieldset>' .
      '<fieldset><legend>address</legend>' . 
      '<input type="text" name="street" />' . 
      '<input type="text" name="district" />' . 
      '<input type="text" name="country" />' . 
      '</fieldset>' .
      '<h4>Edad:</h4>' . 
      '<input type="range" name="age" min="18" max="99" />' . 
      '</fieldset>'
      , $question1->render(), 'Una pregunta contenedor sin preguntas no devuelve el fieldset con la leyenda.');
  }

}