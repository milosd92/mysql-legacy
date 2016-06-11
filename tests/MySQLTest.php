<?php

class MySQLTest extends \PHPUnit_Framework_TestCase
{
    public function testGetConnection()
    {
        $connection = \Danilov\Legacy\MySQL::getConnection('localhost', 'danilov', 'danilov');
        $this->assertInstanceOf(\Danilov\Legacy\MySQL::class, $connection);
    }
}
