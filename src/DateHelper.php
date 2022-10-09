<?php

class DateHelper
{
    public static function castToDateTime($date) : DateTime 
    {
        return new DateTime($date);
    }

    public static function getDaysDiff(DateTime $date1,DateTime $date2) : int
    {
        $interval = $date1->diff($date2);
        return $interval->days;
    }

    public static function getPeriod(DateTime $date1,DateTime $date2) : DatePeriod 
    {
        return new DatePeriod($date1, new DateInterval('P1D'), $date2);
    }
}

























?>