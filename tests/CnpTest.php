<?php


class CnpTest extends \PHPUnit\Framework\TestCase
{
    
    public function getTestData()
    {
        return [
            [
                'cnp'      => '2900517016311',
                'year'     => 1990,
                'month'    => 5,
                'day'      => 17,
                'checkSum' => 1,
            ],
            [
                'cnp'      => 2900517016311,
                'year'     => 1990,
                'month'    => 5,
                'day'      => 17,
                'checkSum' => 1,
            ],
        ];
        
    }
    
    
    public function testSetCnpData()
    {
        $dataSet = $this->getTestData();
        
        foreach($dataSet as $data) {
            $cnp = new \Src\Cnp($data['cnp']);
            $this->assertEquals($cnp->getBirthYear(), $data['year']);
            $this->assertEquals($cnp->getBirthMonth(), $data['month']);
            $this->assertEquals($cnp->getBirthDay(), $data['day']);
            $this->assertEquals($cnp->calculateCheckSum(), $data['checkSum']);
        }
        
    }
    
    
}