<?php declare(strict_types=1);

namespace Src;

use stdClass;
use Src\Contract\ICnp;

class Cnp implements ICnp
{
    private const MATCH_REGEX = '/^([1-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{3})([0-9]{1})/';
    private const CONTROL_CHECKSUM_NUMBERS = [2, 7, 9, 1, 4, 6, 3, 5, 8, 2, 7, 9];
    
    private stdClass $cnp;
    
    public function __construct($cnp)
    {
        $cnp = (string) $cnp;
        
        if (strlen($cnp) === 13) {
            $this->cnp = $this->create($cnp);
        } else {
            throw new \Exception('The provided CNP is must have a length of 13 digits');
        }
    }
    
    /**
     * @param  string  $cnp
     * @return stdClass
     * @throws \Exception
     */
    private function create(string $cnp): stdClass
    {
        $cnpObject = new stdClass();
        $matches = null;
        
        preg_match(self::MATCH_REGEX, $cnp, $matches);
        
        //remove the first match which is the whole string
        array_shift($matches);
        
        if (!$matches && count($matches) !== 7) {
            throw new \Exception('Invalid CNP');
        }
        
        try {
            $cnpObject->digits = $this->convertToIntArray($cnp);
            $cnpObject->genderNumber = $matches[0];
            $cnpObject->yearNumber = $matches[1];
            $cnpObject->monthNumber = $matches[2];
            $cnpObject->dayNumber = $matches[3];
            $cnpObject->locationNumber = $matches[4];
            $cnpObject->serialNumber = $matches[5];
            $cnpObject->checksumNumber = $matches[6];
            
            return $cnpObject;
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong. Could not create CNP object.');
        }
    }
    
    public function getDigits(): array
    {
        return $this->cnp->digits;
    }
    
    /**
     * @return string
     */
    public function getGenderNumber(): string
    {
        return $this->cnp->genderNumber;
    }
    
    /**
     * @return string
     */
    public function getYearNumber(): string
    {
        return $this->cnp->yearNumber;
    }
    
    /**
     * @return string
     */
    public function getMonthNumber(): string
    {
        return $this->cnp->monthNumber;
    }
    
    /**
     * @return string
     */
    public function getDayNumber(): string
    {
        return $this->cnp->dayNumber;
    }
    
    /**
     * @return string
     */
    public function getLocationNumber(): string
    {
        return $this->cnp->locationNumber;
    }
    
    /**
     * @return string
     */
    public function getSerialNumber(): string
    {
        return $this->cnp->serialNumber;
    }
    
    /**
     * @return int
     */
    public function getBirthYear(): int
    {
        $genderNumber = (int) $this->getGenderNumber();
        $year = (int) $this->getYearNumber();
        
        switch ($genderNumber) {
            case 1:
            case 2:
            case 7:
            case 8:
            case 9:
                return 1900 + $year;
                break;
            case 3:
            case 4:
                return 1800 + $year;
                break;
            
            case 5:
            case 6:
                return 2000 + $year;
                break;
            default:
                return 0;
                break;
        }
    }
    
    /**
     * @return int
     */
    public function getBirthMonth(): int
    {
        return (int) $this->getMonthNumber();
    }
    
    /**
     * @return int
     */
    public function getBirthDay(): int
    {
        return (int) $this->getDayNumber();
    }
    
    public function get(): int
    {
        return (int) $this->getDayNumber();
    }
    
    /**
     * @return int
     */
    public function getCheckSumNumber(): int
    {
        return (int) $this->cnp->checksumNumber;
    }
    
    /**
     * @return int
     */
    public function calculateCheckSum(): int
    {
        $digits = $this->getDigits();
        //remove the checksum digit
        $digits = array_slice($digits, 0, count($digits) - 1);
        $sum = array_sum(
            array_map(
                fn ($digit, $position) => (int) $digit * self::CONTROL_CHECKSUM_NUMBERS[$position],
                $digits,
                array_keys($digits)
            )
        );
        $checkSum = ($sum % 11);
        
        return $checkSum === 10 ? 1 : $checkSum;
    }
    
    /**
     * @param  string  $cnp
     * @return array
     */
    protected function convertToIntArray(string $cnp): array
    {
        return array_map(fn ($digit) => (int) $digit, str_split($cnp, 1));
    }
}
