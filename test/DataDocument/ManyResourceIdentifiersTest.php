<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test\DataDocument;

use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\JsonApi;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\Link\Url;
use JsonApiPhp\JsonApi\Meta;
use JsonApiPhp\JsonApi\ResourceIdentifier;
use JsonApiPhp\JsonApi\ResourceIdentifierSet;
use JsonApiPhp\JsonApi\Test\BaseTestCase;

class ManyResourceIdentifiersTest extends BaseTestCase
{
    public function testMinimalDocument()
    {
        $this->assertEncodesTo(
            '
            {
                "data": []
            }
            ',
            new DataDocument(
                new ResourceIdentifierSet()
            )
        );
    }

    public function testExtendedDocument()
    {
        $this->assertEncodesTo(
            '
            {
                "data": [{
                    "type": "apples",
                    "id": "1",
                    "meta": {"apple_meta": "foo"}
                },{
                    "type": "apples",
                    "id": "2",
                    "meta": {"apple_meta": "foo"}
                }],
                "links": {
                    "self": "/apples"
                },
                "jsonapi": {
                    "version": "1.0"
                },
                "meta": {"document_meta": "bar"}
            }
            ',
            new DataDocument(
                new ResourceIdentifierSet(
                    new ResourceIdentifier(
                        'apples',
                        '1',
                        new Meta('apple_meta', 'foo')
                    ),
                    new ResourceIdentifier(
                        'apples',
                        '2',
                        new Meta('apple_meta', 'foo')
                    )
                ),
                new SelfLink(new Url('/apples')),
                new JsonApi(),
                new Meta('document_meta', 'bar')
            )
        );
    }
}
