<?php
/**
 * Created by PhpStorm.
 * User: swahlstrom
 * Date: 10/25/18
 * Time: 8:45 AM
 */

namespace BrokerExchange;

use PHPUnit\Framework\TestCase;

class GloadalsTest extends TestCase
{

    /**
     * @dataProvider loadProvider
     */
    public function testLoad($file,$format)
    {
        Gloadals::load($file, $format);

        //test associative array
        $this->assertTrue(is_bool($GLOBALS['associative']['boolean']));
        $this->assertTrue($GLOBALS['associative']['boolean']);

        $this->assertTrue(is_float($GLOBALS['associative']['float']));
        $this->assertSame(1.6, $GLOBALS['associative']['float']);

        $this->assertTrue(is_integer($GLOBALS['associative']['integer']));
        $this->assertSame(2, $GLOBALS['associative']['integer']);

        $this->assertTrue(is_string($GLOBALS['associative']['string']));
        $this->assertSame('this is a string', $GLOBALS['associative']['string']);


        //test numeric-indexed array
        $this->assertTrue(is_bool($GLOBALS['numeric_boolean'][0]));
        $this->assertFalse($GLOBALS['numeric_boolean'][0]);

        $this->assertTrue(is_float($GLOBALS['numeric_float'][0]));
        $this->assertSame(5.4, $GLOBALS['numeric_float'][0]);

        $this->assertTrue(is_integer($GLOBALS['numeric_integer'][0]));
        $this->assertSame(42, $GLOBALS['numeric_integer'][0]);

        $this->assertTrue(is_string($GLOBALS['numeric_string'][0]));
        $this->assertSame('this is also a string', $GLOBALS['numeric_string'][0]);


        //test scalar
        $this->assertTrue(is_bool($GLOBALS['scalar_boolean']));
        $this->assertTrue($GLOBALS['scalar_boolean']);

        $this->assertTrue(is_float($GLOBALS['scalar_float']));
        $this->assertSame(1.5, $GLOBALS['scalar_float']);

        $this->assertTrue(is_integer($GLOBALS['scalar_integer']));
        $this->assertSame(1, $GLOBALS['scalar_integer']);

        $this->assertTrue(is_string($GLOBALS['scalar_string']));
        $this->assertSame('Don\'t look now, but another string.', $GLOBALS['scalar_string']);


        //test multi-dimensional array
        $this->assertTrue(is_bool($GLOBALS['multi']['dimensional']['boolean']));
        $this->assertFalse($GLOBALS['multi']['dimensional']['boolean']);

        $this->assertTrue(is_float($GLOBALS['multi']['dimensional']['float']));
        $this->assertSame(86.2, $GLOBALS['multi']['dimensional']['float']);

        $this->assertTrue(is_integer($GLOBALS['multi']['dimensional']['integer']));
        $this->assertSame(14, $GLOBALS['multi']['dimensional']['integer']);

        $this->assertTrue(is_string($GLOBALS['multi']['dimensional']['string']));
        $this->assertSame('A string, not in theory -- but in practice.', $GLOBALS['multi']['dimensional']['string']);
    }

    public function loadProvider()
    {
        return [
            [__DIR__ . '/_files/.gload.test.ini', 'ini'],
            [__DIR__ . '/_files/.gload.test.php', 'php']
        ];
    }
}
