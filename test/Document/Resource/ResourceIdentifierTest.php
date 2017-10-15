<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test\Document\Resource;

use JsonApiPhp\JsonApi\Document\Meta;
use JsonApiPhp\JsonApi\Document\Resource\ResourceIdentifier;
use JsonApiPhp\JsonApi\Test\BaseTestCase;

/**
 * Resource Identifiers
 *
 * @see http://jsonapi.org/format/#document-resource-identifier-objects
 */
class ResourceIdentifierTest extends BaseTestCase
{
    public function testResourceIdentifierMustContainTypeAndId()
    {
        $this->assertEncodesTo(
            '
            {
                "type": "books",
                "id": "1"
            }
            ',
            new ResourceIdentifier('books', '1')
        );
    }

    public function testResourceIdentifierMayContainMeta()
    {
        $this->assertEncodesTo(
            '
            {
                "type": "books",
                "id": "1",
                "meta": {
                    "foo":"bar"
                }
            }
            ',
            new ResourceIdentifier('books', '1', Meta::fromArray(['foo' => 'bar']))
        );
    }
}
