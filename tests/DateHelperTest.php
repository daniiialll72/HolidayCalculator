<?php

use PHPUnit\Framework\TestCase;
include('src/DateHelper.php');

final class DateHelperTest extends TestCase
{
    public function testCastToDateTime()
    {
        $date = DateHelper::castToDateTime('12.10.2020');
        $this->assertEquals(new DateTime('12.10.2020'), $date);
    }
    public function testGetDaysDiff()
    {
        $diff = DateHelper::getDaysDiff(new DateTime('12.10.2020'),new DateTime('16.10.2020'));
        $this->assertEquals(4, $diff);
    }
}




















?>