<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use JsonApiPhp\JsonApi\Meta;
use PHPUnit\Framework\TestCase;

class MetaTest extends TestCase
{
    public function testKeyMustBeValid()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage("Invalid character in a member name 'invalid:name'");
        new Meta('invalid:name', '1');
    }
}
