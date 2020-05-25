<?php declare(strict_types=1);

namespace Src\Contract;


interface ICnp
{
    public function getGenderNumber();
    public function getYearNumber();
    public function getMonthNumber();
    public function getDayNumber();
    public function getLocationNumber();
    public function getSerialNumber();
    public function getCheckSumNumber();
    
}