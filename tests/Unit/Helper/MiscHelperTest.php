<?php

namespace PhpAmqpLib\Tests\Unit\Helper;

use PhpAmqpLib\Helper\MiscHelper;
use PhpAmqpLib\Tests\TestCaseCompat;

class MiscHelperTest extends TestCaseCompat
{
    /**
     * @dataProvider splitSecondsMicrosecondsData
     * @test
     */
    public function split_seconds_microseconds($input, $expected)
    {
        self::assertEquals($expected, MiscHelper::splitSecondsMicroseconds($input));
    }

    /**
     * @dataProvider hexdumpData
     * @test
     */
    public function hexdump($args, $expected)
    {
        self::assertPattern($expected, MiscHelper::hexdump($args[0], $args[1], $args[2], $args[3]));
    }

    /**
     * @test
     */
    public function method_sig()
    {
        self::assertEquals('test', MiscHelper::methodSig('test'));
    }

    public function splitSecondsMicrosecondsData(): array
    {
        return [
            [0, [0, 0]],
            [0.3, [0, 300000]],
            ['0.3', [0, 300000]],
            [3, [3, 0]],
            ['3', [3, 0]],
            [3.0, [3, 0]],
            ['3.0', [3, 0]],
            [3.1, [3, 100000]],
            ['3.1', [3, 100000]],
            [3.123456, [3, 123456]],
            ['3.123456', [3, 123456]],
        ];
    }

    public function hexdumpData(): array
    {
        return [
            [['FM', false, false, true], '/000\s+46 4d\s+FM/'],
            [['FM', false, true, true], '/000\s+46 4D\s+FM/'],
        ];
    }
}
