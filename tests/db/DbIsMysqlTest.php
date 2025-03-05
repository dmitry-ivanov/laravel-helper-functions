<?php

namespace Illuminated\Helpers\Tests\db;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminated\Helpers\Tests\TestCase;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use PHPUnit\Framework\Attributes\Test;

class DbIsMysqlTest extends TestCase
{
    #[Test] #[RunInSeparateProcess] #[PreserveGlobalState(false)]
    public function it_returns_true_if_laravel_database_default_connection_driver_is_mysql(): void
    {
        DB::shouldReceive('getDefaultConnection')->withNoArgs()->once()->andReturn('mysql');
        Config::shouldReceive('get')->with('database.connections.mysql.driver')->once()->andReturn('mysql');

        $this->assertTrue(db_is_mysql());
    }

    #[Test] #[RunInSeparateProcess] #[PreserveGlobalState(false)]
    public function it_returns_false_if_laravel_database_default_connection_driver_is_not_mysql(): void
    {
        DB::shouldReceive('getDefaultConnection')->withNoArgs()->once()->andReturn('sqlite');
        Config::shouldReceive('get')->with('database.connections.sqlite.driver')->once()->andReturn('sqlite');

        $this->assertFalse(db_is_mysql());
    }
}
