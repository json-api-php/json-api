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

namespace JsonApiPhp\JsonApi\Test\Document;

use JsonApiPhp\JsonApi\Document\Meta;
use PHPUnit\Framework\TestCase;

class MetaTest extends TestCase
{
    public function testPhpArraysAreConvertedToObjects()
    {
        $this->assertEquals('{"0":"foo"}', json_encode(Meta::fromArray(['foo'])));
    }
}
