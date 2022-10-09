<?php
include('CountryHolidays.php');
class FinnishHolidays implements CountryHolidays
{

    public function __construct($holidays)
    {
        $this->holidays = $holidays;
    }

    private function castHolidays(): array
    {
        $casted = [];
        foreach ($this->holidays as $holiday) {
            $casted[] = DateHelper::castToDateTime($holiday)->format('d.m.Y');
        }

        return $casted;
    }

    public function getHolidays(): array
    {
        return $this->castHolidays();
    }
}
























?>