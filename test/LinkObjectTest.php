<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\Link\LinkObject;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\Meta;
use JsonApiPhp\JsonApi\ResourceIdentifier;

class LinkObjectTest extends BaseTestCase
{
    public function testLinkObject()
    {
        $this->assertEncodesTo(
            '{
                "data": {"type": "apples", "id": "1"},
                "links": {
                    "self": {
                        "href": "http://example.com",
                        "meta": {
                            "foo": "bar"
                        }
                    }
                }
             }
            ',
            new DataDocument(
                new ResourceIdentifier('apples', '1'),
                new SelfLink(new LinkObject('http://example.com', new Meta('foo', 'bar')))
            )
        );
    }
}
