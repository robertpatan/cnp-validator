<?php


final class ValidatorTest extends \PHPUnit\Framework\TestCase
{
    
    public function testIsValid(): void
    {
        $this->assertTrue(\Src\CnpValidator::validate('2900517016311'));
    }
    
    public function testIsInvalid(): void
    {
        $this->assertFalse(\Src\CnpValidator::validate('2900527016311'));
        
    }
    
    public function testCornerCase1(): void
    {
        $this->assertFalse(\Src\CnpValidator::validate('0000000000000'));
    }
    
    public function testCornerCase2(): void
    {
        $this->assertFalse(\Src\CnpValidator::validate('1111111111111'));
    }
    
    public function testWrongChecksum(): void
    {
        $this->assertFalse(\Src\CnpValidator::validate('2900517016312'));
        
    }
    
    public function testNonNumeric(): void
    {
        $this->assertFalse(\Src\CnpValidator::validate('29a05s7016311'));
    }
    
    public function testMoreThan13(): void
    {
        $this->assertFalse(\Src\CnpValidator::validate('29005170163123'));
    }
    
    public function testLessThan13(): void
    {
        $this->assertFalse(\Src\CnpValidator::validate('290051701631'));
    }
}