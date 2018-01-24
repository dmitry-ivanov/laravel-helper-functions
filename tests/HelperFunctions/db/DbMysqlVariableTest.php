<?php

namespace Illuminated\Helpers\HelperFunctions\Tests\Db;

use Illuminated\Helpers\HelperFunctions\Tests\TestCase;

class DbMysqlVariableTest extends TestCase
{
    /** @test */
    public function it_returns_false_for_unexisting_mysql_variable()
    {
        $mock = mock('alias:Illuminate\Support\Facades\DB');
        $mock->expects()->selectOne('show variables where variable_name = ?', ['fake'])->andReturnNull();

        $this->assertFalse(db_mysql_variable('fake'));
    }

    /** @test */
    public function it_returns_value_for_existing_mysql_variable()
    {
        $mock = mock('alias:Illuminate\Support\Facades\DB');
        $mock->expects()->selectOne('show variables where variable_name = ?', ['hostname'])
                        ->andReturn((object) ['Variable_name' => 'hostname', 'Value' => 'localhost']);

        $this->assertEquals('localhost', db_mysql_variable('hostname'));
    }
}
