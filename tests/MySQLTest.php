<?php

class MySQLTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldConnectAndClose()
    {
        $link = new \Danilov\Legacy\MySQL('localhost', 'danilov', 'danilov');

        $this->assertInstanceOf(\Danilov\Legacy\MySQL::class, $link);

        $this->assertEquals(0, $link->getErrno());
        $this->assertEquals('', $link->getError());

        $this->assertTrue($link->close());
    }

    public function testAccessDenied()
    {
        $this->expectException(\PHPUnit_Framework_Error_Warning::class);
        $this->expectExceptionMessage('(HY000/1045): Access denied for user \'baduser\'@\'localhost\' (using password: YES)');

        new \Danilov\Legacy\MySQL('localhost', 'baduser', 'wrongpassword');
    }

    public function testAccessDeniedError()
    {
        $link = @new \Danilov\Legacy\MySQL('localhost', 'baduser', 'wrongpassword');

        $this->assertEquals(1045, $link->getErrno());
        $this->assertStringStartsWith('Access denied', $link->getError());
    }

    public function testGetConnection()
    {
        $connection = new \Danilov\Legacy\MySQL('localhost', 'danilov', 'danilov');
        $this->assertInstanceOf(\Danilov\Legacy\MySQL::class, $connection);
    }
}
