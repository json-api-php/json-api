<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use JsonApiPhp\JsonApi\ResourceIdentifier;

class ResourceIdentifierTest extends BaseTestCase
{
    public function testNameValidation()
    {
        $this->expectException(\DomainException::class);
        new ResourceIdentifier('invalid:id', 'foo');
    }
}
