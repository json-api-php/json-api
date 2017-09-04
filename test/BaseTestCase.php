<?php
/**
 *  This file is part of JSON:API implementation for PHP.
 *
 *  (c) Alexey Karapetov <karapetov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
declare(strict_types=1);

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
