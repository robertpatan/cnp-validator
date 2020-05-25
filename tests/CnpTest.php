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
            
            //1800-1899
            [
                'cnp'      => 3820101419458,
                'year'     => 1882,
                'month'    => 1,
                'day'      => 1,
                'checkSum' => 8,
            ],
            
            //after 2000
            [
                'cnp'      => 6020131414775,
                'year'     => 2002,
                'month'    => 01,
                'day'      => 31,
                'checkSum' => 5,
            ],
            
            //foreigner with residency
            [
                'cnp'      => 8781001330012,
                'year'     => 1978,
                'month'    => 10,
                'day'      => 1,
                'checkSum' => 2,
            ],
            
            //foreigner without residency
            [
                'cnp'      => 9781001330014,
                'year'     => 1978,
                'month'    => 10,
                'day'      => 1,
                'checkSum' => 4,
            ],
        ];
        
    }
    
    
    public function testCnpDataSet()
    {
        $dataSet = $this->getTestData();
        
        foreach ($dataSet as $data) {
            $cnp = new \Src\Cnp($data['cnp']);
            $this->assertEquals($cnp->getBirthYear(), $data['year']);
            $this->assertEquals($cnp->getBirthMonth(), $data['month']);
            $this->assertEquals($cnp->getBirthDay(), $data['day']);
            $this->assertEquals($cnp->calculateCheckSum(), $data['checkSum']);
        }
        
    }
    
    
}