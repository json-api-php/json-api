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
use JsonApiPhp\JsonApi\Test\BaseTestCase;

class MetaTest extends BaseTestCase
{
    public function testPhpArraysAreConvertedToObjects()
    {
        $this->assertEncodesTo('{"0":"foo"}', Meta::fromArray(['foo']));
    }
}
