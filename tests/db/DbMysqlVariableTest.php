<?php

use Mockery as m;

class DbMysqlVariableTest extends TestCase
{
    /** @test */
    public function it_returns_false_for_unexisting_mysql_variable()
    {
        $mock = m::mock('alias:Illuminate\Support\Facades\DB');
        $mock->shouldReceive('selectOne')
            ->withArgs(['show variables where variable_name = ?', ['fake']])
            ->once()
            ->andReturnNull();

        $this->assertFalse(db_mysql_variable('fake'));
    }

    /** @test */
    public function it_returns_value_for_known_mysql_variable()
    {
        $mock = m::mock('alias:Illuminate\Support\Facades\DB');
        $mock->shouldReceive('selectOne')
             ->withArgs(['show variables where variable_name = ?', ['hostname']])
             ->once()
             ->andReturnUsing(function () {
                 return (object) ['Variable_name' => 'hostname', 'Value' => 'localhost'];
             });

        $this->assertEquals('localhost', db_mysql_variable('hostname'));
    }
}
