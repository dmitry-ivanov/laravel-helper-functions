<?php

namespace Illuminated\Helpers\Tests\db;

use Illuminated\Helpers\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class DbMysqlVariableTest extends TestCase
{
    #[Test]
    public function it_returns_false_for_not_existing_mysql_variable(): void
    {
        $mock = mock('alias:Illuminate\Support\Facades\DB');
        $mock->expects('selectOne')
            ->with('show variables where variable_name = ?', ['fake'])
            ->andReturnNull();

        $this->assertFalse(db_mysql_variable('fake'));
    }

    #[Test]
    public function it_returns_value_for_existing_mysql_variable(): void
    {
        $mock = mock('alias:Illuminate\Support\Facades\DB');
        $mock->expects('selectOne')
            ->with('show variables where variable_name = ?', ['hostname'])
            ->andReturn((object) ['Variable_name' => 'hostname', 'Value' => 'localhost']);

        $this->assertEquals('localhost', db_mysql_variable('hostname'));
    }
}
