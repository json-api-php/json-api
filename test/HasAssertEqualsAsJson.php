<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

trait HasAssertEqualsAsJson
{
    public static function assertEqualsAsJson($expected, $actual, string $message = '')
    {
        self::assertEquals(json_encode($expected), json_encode($actual), $message);
    }
}
