<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test\DataDocument;

use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\JsonApi;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\Meta;
use JsonApiPhp\JsonApi\ResourceIdentifier;
use JsonApiPhp\JsonApi\Test\BaseTestCase;

class SingleResourceIdentifierTest extends BaseTestCase
{
    public function testMinimalDocument()
    {
        $this->assertEncodesTo(
            '
            {
                "data": {
                    "type": "apples",
                    "id": "1"
                }
            }
            ',
            new DataDocument(
                new ResourceIdentifier('apples', '1')
            )
        );
    }

    public function testExtendedDocument()
    {
        $this->assertEncodesTo(
            '
            {
                "data": {
                    "type": "apples",
                    "id": "1",
                    "meta": {"apple_meta": "foo"}
                },
                "links": {
                    "self": "/apples/1"
                },
                "jsonapi": {
                    "version": "1.0"
                },
                "meta": {"document_meta": "bar"}
            }
            ',
            new DataDocument(
                new ResourceIdentifier(
                    'apples',
                    '1',
                    new Meta('apple_meta', 'foo')
                ),
                new SelfLink('/apples/1'),
                new JsonApi(),
                new Meta('document_meta', 'bar')
            )
        );
    }
}
