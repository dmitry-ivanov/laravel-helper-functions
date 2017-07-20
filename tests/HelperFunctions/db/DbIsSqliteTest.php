<?php

namespace Illuminated\Helpers\HelperFunctions\Tests\Db;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminated\Helpers\HelperFunctions\Tests\TestCase;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class DbIsSqliteTest extends TestCase
{
    /** @test */
    public function it_returns_true_if_laravel_database_default_connection_driver_is_sqlite()
    {
        DB::shouldReceive('getDefaultConnection')->withNoArgs()->once()->andReturn('sqlite');
        Config::shouldReceive('get')->with("database.connections.sqlite.driver")->once()->andReturn('sqlite');

        $this->assertTrue(db_is_sqlite());
    }

    /** @test */
    public function it_returns_false_if_laravel_database_default_connection_driver_is_not_sqlite()
    {
        DB::shouldReceive('getDefaultConnection')->withNoArgs()->once()->andReturn('mysql');
        Config::shouldReceive('get')->with("database.connections.mysql.driver")->once()->andReturn('mysql');

        $this->assertFalse(db_is_sqlite());
    }
}
