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
    public static function assertEqualsAsJson($expected, $actual, string $message = '')
    {
        self::assertEquals(json_encode($expected), json_encode($actual), $message);
    }
}
