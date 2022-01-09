<?php

namespace Tests\Unit;

use App\Filters\RangeFilter;
use App\Filters\RangeCheckFilter;
use Tests\TestCase;

class FilterTest extends TestCase
{
    public function test_range_filter_returns_valid_expression()
    {
        $this->assertEquals("price 1500 TO 5000", RangeFilter::attribute('price')
                                                                     ->values( [1500, 5000] ));
    }

    public function test_range_check_filter_returns_valid_expression()
    {
        $this->assertEquals("(RAM 10 TO 12) OR (RAM 0 TO 3)", RangeCheckFilter::attribute('RAM')
                                                                                      ->values( [ [10,12], [0,3] ] ));
    }
}
