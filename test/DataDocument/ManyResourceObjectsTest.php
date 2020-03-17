<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test\DataDocument;

use JsonApiPhp\JsonApi\Attribute;
use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\JsonApi;
use JsonApiPhp\JsonApi\Link\RelatedLink;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\Meta;
use JsonApiPhp\JsonApi\ResourceCollection;
use JsonApiPhp\JsonApi\ResourceObject;
use JsonApiPhp\JsonApi\Test\BaseTestCase;

class ManyResourceObjectsTest extends BaseTestCase
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
                new ResourceCollection()
            )
        );
    }

    public function testExtendedDocument()
    {
        $this->assertEncodesTo(
            '
            {
                "data": [{
                    "type": "people",
                    "id": "1",
                    "attributes": {
                        "name": "Martin Fowler"
                    },
                    "meta": {"apple_meta": "foo"}
                },{
                    "type": "people",
                    "id": "2",
                    "attributes": {
                        "name": "Kent Beck"
                    },
                    "meta": {"apple_meta": "foo"}
                }],
                "links": {
                    "self": "/books/123/relationship/authors",
                    "related": "/books/123/authors"
                },
                "jsonapi": {
                    "version": "1.0"
                },
                "meta": {"document_meta": "bar"}
            }
            ',
            new DataDocument(
                new ResourceCollection(
                    new ResourceObject(
                        'people',
                        '1',
                        new Attribute('name', 'Martin Fowler'),
                        new Meta('apple_meta', 'foo')
                    ),
                    new ResourceObject(
                        'people',
                        '2',
                        new Attribute('name', 'Kent Beck'),
                        new Meta('apple_meta', 'foo')
                    )
                ),
                new SelfLink('/books/123/relationship/authors'),
                new RelatedLink('/books/123/authors'),
                new JsonApi(),
                new Meta('document_meta', 'bar')
            )
        );
    }
}
