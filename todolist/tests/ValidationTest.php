<?php
namespace Tests;

use App\Core\Validation;
use PHPUnit\Framework\TestCase;

Final class ValidationTest extends TestCase {


  public function testValidation() {
    $Validation = Validation::make(['name' => 'test'], ['name' => 'required|email']);
    $this->assertEquals($Validation ,['name' => 'test']);
  }
} 