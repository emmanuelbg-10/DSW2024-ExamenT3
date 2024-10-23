<?php

use Dsw\T3\AbstractStatement;
use Dsw\T3\Image;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{

  public function testImageExist()
  {
      $this->assertInstanceOf(AbstractStatement::class, new Image('texto', 'image.jpg'), 'Image no es instancia de AbstractStatement');
  }  

  public function testImageProperties()
  {
    $reflection = new ReflectionClass(Image::class);
    $properties = [];
    foreach($reflection->getProperties() as $property) {
      $properties[] = $property->name;
    }
    $this->assertContains('imageName', $properties, 'Image no tiene la propiedad imageName');    
    $this->assertContains('path', $properties, 'Image no tiene la propiedad path');    
  }

  public function testImageWithOutPath()
  {
    $image = new Image('alternative text', 'image.jpg');
    $this->assertEquals('<img src="image.jpg" alt="alternative text" />', $image->render(), 'Image muestra el src y el alt en el formato indicado.');
  }

  public function testImageWithPath()
  {
    $image = new Image('text alternative', 'otherimage.jpg', 'folder/');
    $this->assertEquals('<img src="folder/otherimage.jpg" alt="text alternative" />', $image->render(), 'Image muestra el src con el path y el alt en el formato indicado.');
  }

}