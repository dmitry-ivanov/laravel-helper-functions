<?php

namespace Illuminated\Helpers\Tests\db;

use Illuminated\Helpers\Tests\TestCase;

class DbMysqlNowTest extends TestCase
{
    /** @test */
    public function it_returns_valid_mysql_datetime()
    {
        $mock = mock('alias:Illuminate\Support\Facades\DB');
        $mock->expects('selectOne')->with('select now() as now')->andReturn((object) ['now' => '2016-09-17 18:49:46']);

        $this->assertEquals('2016-09-17 18:49:46', db_mysql_now());
    }
}
