<?php

class ConnectionTest extends \PHPUnit_Framework_TestCase
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

        $link = @new \Danilov\Legacy\MySQL('localhost', 'danilov', 'wrongpassword');

        $this->assertEquals(1045, $link->getErrno());
        $this->assertStringStartsWith('Access denied', $link->getError());
    }
}