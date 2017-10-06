<?php
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
