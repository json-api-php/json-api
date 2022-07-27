<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test\DataDocument;

use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\JsonApi;
use JsonApiPhp\JsonApi\Link\RelatedLink;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\Meta;
use JsonApiPhp\JsonApi\ResourceIdentifier;
use JsonApiPhp\JsonApi\Test\BaseTestCase;

class SingleResourceIdentifierTest extends BaseTestCase {
    public function testMinimalDocument() {
        $this->assertEncodesTo(
            '
            {
                "data": {
                    "type": "companies",
                    "id": "1"
                }
            }
            ',
            new DataDocument(
                new ResourceIdentifier('companies', '1')
            )
        );
    }

    public function testExtendedDocument() {
        $this->assertEncodesTo(
            '
            {
                "data": {
                    "type": "companies",
                    "id": "1",
                    "meta": {
                        "apple_meta": "foo", 
                        "bar": [42]
                    }
                },
                "links": {
                    "self": "/books/123/relationships/publisher",
                    "related": "/books/123/publisher"
                },
                "jsonapi": {
                    "version": "1.0"
                },
                "meta": {"document_meta": "bar"}
            }
            ',
            new DataDocument(
                new ResourceIdentifier(
                    'companies',
                    '1',
                    new Meta('apple_meta', 'foo'),
                    new Meta('bar', [42])
                ),
                new SelfLink('/books/123/relationships/publisher'),
                new RelatedLink('/books/123/publisher'),
                new JsonApi(),
                new Meta('document_meta', 'bar')
            )
        );
    }
}
