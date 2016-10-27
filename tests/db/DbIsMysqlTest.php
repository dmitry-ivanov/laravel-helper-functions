<?php

class DbIsMysqlTest extends TestCase
{
    /** @test */
    public function it_returns_true_if_laravel_database_default_connection_is_mysql()
    {
        $mock = Mockery::mock('alias:Illuminate\Support\Facades\DB');
        $mock->shouldReceive('getDefaultConnection')->withNoArgs()->once()->andReturn('mysql');

        $this->assertTrue(db_is_mysql());
    }

    /** @test */
    public function it_returns_false_if_laravel_database_default_connection_is_not_mysql()
    {
        $mock = Mockery::mock('alias:Illuminate\Support\Facades\DB');
        $mock->shouldReceive('getDefaultConnection')->withNoArgs()->once()->andReturn('sqlite');

        $this->assertFalse(db_is_mysql());
    }
}
