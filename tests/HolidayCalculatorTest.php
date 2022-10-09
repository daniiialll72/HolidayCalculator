<?php

use Mockery\Adapter\Phpunit\MockeryTestCase;

include('src/HolidayCalculator.php');

final class HolidayCalculatorTest extends MockeryTestCase
{

    protected static function getMethod($name)
    {
        $class = new ReflectionClass('HolidayCalculator');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }

    public function testCountHolidays()
    {
        $expected = [
            '01.01.2020',
            '06.01.2020',
            '10.04.2020',
            '13.04.2020',
        ];
        $holiday = Mockery::mock('CountryHolidays');
        $holiday->shouldReceive('getHolidays')->andReturn($expected);

        $days = new HolidayCalculator($holiday);
        $reflect = self::getMethod('countHolidays');
        $this->assertEquals(2, $reflect->invokeArgs($days, ['01.01.2020', '10.01.2020']));
    }
    public function testCalculateWithCorrectPeriod()
    {
        $date1 = '1.1.2020';
        $date2 = '1.2.2020';
        $expected = [
            '01.01.2020',
            '06.01.2020',
            '10.04.2020',
            '13.04.2020',
            '24.12.2020',
            '25.12.2020',
            '01.01.2021',
            '02.04.2021',
            '06.12.2021',
            '24.12.2021'
        ];
        $holiday = Mockery::mock('CountryHolidays');
        $holiday->shouldReceive('getHolidays')->andReturn($expected);

        $days = new HolidayCalculator($holiday);

        //correct Dates
        $this->assertSame(25, $days->calculate($date1, $date2));
    }
}
