<?php 

include_once('DateHelper.php');

class Validator
{
    const limit = 50; 

    public static function checkLength(string $start,string $end) : bool
    {
        $start = DateHelper::castToDateTime($start);
        $end = DateHelper::castToDateTime($end);
        
        if (DateHelper::getDaysDiff($start,$end) < self::limit) {
            return true;
        } else {
            throw new Exception("Length is more than 50 days");
        }
    }

    public static function checkChronologically(string $start,string $end) : bool
    {
        $start = strtotime($start);
        $end = strtotime($end);

        if ($end - $start > 0) {
            return true;
        } else {
            throw new Exception("The end date is bigger than first...");
        }
    }

    public static function checkHolidayPeriod(string $start,string $end) : bool
    {
        $start = DateHelper::castToDateTime($start);
        $end = DateHelper::castToDateTime($end);

        $start_year = $start->format('Y');
        $end_year = $start->modify('+1 year')->format('Y');

        $start_period = DateHelper::castToDateTime('1.4.'.$start_year);
        $end_period = DateHelper::castToDateTime('31.3.'.$end_year);

        if ($start > $start_period && $end < $end_period) {
            return true;
        } else {
            throw new Exception("Its not in the holiday period");
        }
    }
}
