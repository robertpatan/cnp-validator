<?php declare(strict_types=1);

namespace Src;

class CnpValidator
{
    private Cnp $cnp;
    
    public function __construct(string $cnp)
    {
        $this->cnp = new Cnp($cnp);
    }
    
    /**
     *
     * @param  string  $cnp
     * @return bool
     */
    public static function validate(string $cnp): bool
    {
        try {
            return (new self($cnp))->isValid();
        } catch (\Exception $e) {
            return false;
        }
    }
    
    /**
     * @return bool
     */
    public function isValid(): bool
    {
        try {
            return $this->validateYear() &&
                $this->validateMonth() &&
                $this->validateDay() &&
                $this->validateLocation() &&
                $this->validateSerialNumber() &&
                $this->validateCheckSum();
        } catch (\Exception $e) {
            return false;
        }
    }
    
    public function validateYear(): bool
    {
        $year = $this->cnp->getBirthYear();
        
        return 1800 <= $year && $year <= date('Y');
    }
    
    /**
     * @return bool
     */
    public function validateMonth(): bool
    {
        $month = $this->cnp->getBirthMonth();
        
        return 1 <= $month && $month <= 12;
    }
    
    /**
     * @return bool
     */
    public function validateDay(): bool
    {
        $day = $this->cnp->getBirthDay();
        
        return 1 <= $day && $day <= 31;
    }
    
    /**
     * @return bool
     */
    public function validateLocation(): bool
    {
        $locationNumber = (int) $this->cnp->getLocationNumber();
        return $locationNumber >= 1 && $locationNumber <= 52;
    }
    
    public function validateSerialNumber(): bool
    {
        $serialNumber = (int) $this->cnp->getSerialNumber();
        return $serialNumber >= 1 && $serialNumber <= 999;
    }
    
    /**
     * @return bool
     */
    public function validateCheckSum(): bool
    {
        $calculatedCheckSum = $this->cnp->calculateCheckSum();
        $checkSum = $this->cnp->getCheckSumNumber();
        
        return $checkSum === $calculatedCheckSum;
    }
}
