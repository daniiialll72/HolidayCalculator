<?php

use PHPUnit\Framework\TestCase;
include('src/FinnishHolidays.php');


final class FinnishHolidaysTest extends TestCase
{
    public static $finnishHolidays = [
        '1.1.2020',
        '6.1.2020',
        '10.4.2020',
        '13.4.2020',
    ];

    public function testClassConstructor()
    {
        $fin_holiday = new FinnishHolidays(self::$finnishHolidays);
        $this->assertSame([
            '1.1.2020',
            '6.1.2020',
            '10.4.2020',
            '13.4.2020',
        ],$fin_holiday->holidays);
    }

    protected static function getMethod($name) {
        $class = new ReflectionClass('FinnishHolidays');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
      }

    public function testCastHolidays()
    {
        $expected = [
            '01.01.2020',
            '06.01.2020',
            '10.04.2020',
            '13.04.2020',
        ];

        $reflect = self::getMethod('castHolidays');
        $fin_holidays = new FinnishHolidays(self::$finnishHolidays);
        $this->assertEquals($expected,$reflect->invoke($fin_holidays));

    }

    public function testGetHolidays()
    {
        $expected = [
            '01.01.2020',
            '06.01.2020',
            '10.04.2020',
            '13.04.2020',
        ];
        $fin_holiday = new FinnishHolidays(self::$finnishHolidays);
        $this->assertSame($expected,$fin_holiday->getHolidays());
    }

}

































?>