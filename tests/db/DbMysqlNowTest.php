<?php

namespace Illuminated\Helpers\Tests\db;

use Illuminated\Helpers\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class DbMysqlNowTest extends TestCase
{
    #[Test]
    public function it_returns_valid_mysql_datetime(): void
    {
        $mock = mock('alias:Illuminate\Support\Facades\DB');
        $mock->expects('selectOne')->with('select now() as now')->andReturn((object) ['now' => '2016-09-17 18:49:46']);

        $this->assertEquals('2016-09-17 18:49:46', db_mysql_now());
    }
}
