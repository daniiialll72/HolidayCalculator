<?php

include_once('Validator.php');
include_once('FinnishHolidays.php');

class HolidayCalculator
{
    public $holidays;

    public function __construct(CountryHolidays $holidays)
    {
        $this->holidays = $holidays;
    }

    private function countWeekendDays($date1, $date2): int
    {
        $count = 0;
        $period = DateHelper::getPeriod(DateHelper::castToDateTime($date1), DateHelper::castToDateTime($date2));
        foreach ($period as $dt) {
            $curr = $dt->format('D');
            // substract if Saturday 
            if ($curr == 'Sat') {
                $count++;
            }
        }
        return $count;
    }
    private function countHolidays($date1, $date2): int
    {
        $count = 0;
        $period = DateHelper::getPeriod(DateHelper::castToDateTime($date1), DateHelper::castToDateTime($date2));
        foreach ($period as $dt) {
            $curr = $dt->format('d.m.Y');
            if (in_array($curr, $this->holidays->getHolidays())) {
                $count++;
            }
        }
        return $count;
    }

    private function consumeDates($date1, $date2): int
    {
        $days = DateHelper::getDaysDiff(DateHelper::castToDateTime($date1), DateHelper::castToDateTime($date2));

        $weekDays = $this->countWeekendDays($date1, $date2);
        $holidays = $this->countHolidays($date1, $date2);

        return $days - ($weekDays + $holidays);
    }

    public function calculate($date1, $date2): int
    {
        if (Validator::checkChronologically($date1, $date2) && Validator::checkHolidayPeriod($date1, $date2) && Validator::checkLength($date1, $date2)) {
            return $this->consumeDates($date1, $date2);
        }
    }
}

$finnishHolidays = [
    '1.1.2020',
    '6.1.2020',
    '10.4.2020',
    '13.4.2020',
    '24.12.2020',
    '25.12.2020',
    '1.1.2021',
    '2.4.2021',
    '6.12.2021',
    '24.12.2021'
];

$holidays = new FinnishHolidays($finnishHolidays);

$day = new HolidayCalculator($holidays);
// $day->calculate('1.1.2020', '1.2.2020');
var_dump($day->calculate('1.1.2020', '1.2.2020'));
