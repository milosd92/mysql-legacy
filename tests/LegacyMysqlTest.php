<?php

/**
 * Created by PhpStorm.
 * User: Milos
 * Date: 9/8/2016
 * Time: 10:24 PM
 */
class LegacyMysqlTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        require_once dirname(__DIR__) . '/lib/mysql.php';
    }

    public function testMysqlConnect()
    {
        $link = mysql_connect('localhost', 'danilov', 'danilov');

        $this->assertInstanceOf(\Danilov\Legacy\MySQL::class, $link);
    }

    public function testMysqlErrnoWithLink()
    {
        $link = mysql_connect('localhost', 'danilov', 'danilov');

        $actualResult = mysql_errno($link);
        $expectedResult = 0;

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testMysqlErrnoWithoutLink()
    {
        mysql_connect('localhost', 'danilov', 'danilov');

        $actualResult = mysql_errno();
        $expectedResult = 0;

        $this->assertEquals($expectedResult, $actualResult);
    }
}