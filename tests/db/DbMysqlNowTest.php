<?php

class DbMysqlNowTest extends TestCase
{
    /** @test */
    public function it_returns_valid_mysql_datetime()
    {
        $mock = Mockery::mock('alias:Illuminate\Support\Facades\DB');
        $mock->shouldReceive('selectOne')->withArgs(['select now() as now'])->once()->andReturnUsing(function () {
            return (object) ['now' => '2016-09-17 18:49:46'];
        });

        $this->assertEquals('2016-09-17 18:49:46', db_mysql_now());
    }
}
