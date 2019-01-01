<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use PHPUnit\Framework\TestCase;

abstract class BaseTestCase extends TestCase
{
    public static function assertEncodesTo(string $expected, $obj, string $message = '')
    {
        self::assertEquals(
            json_decode($expected),
            json_decode(json_encode($obj, JSON_UNESCAPED_SLASHES)),
            $message
        );
    }
}
