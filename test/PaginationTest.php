<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use JsonApiPhp\JsonApi\Attribute;
use JsonApiPhp\JsonApi\CompoundDocument;
use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\Included;
use JsonApiPhp\JsonApi\Link\FirstLink;
use JsonApiPhp\JsonApi\Link\LastLink;
use JsonApiPhp\JsonApi\Link\NextLink;
use JsonApiPhp\JsonApi\Link\PrevLink;
use JsonApiPhp\JsonApi\PaginatedCollection;
use JsonApiPhp\JsonApi\Pagination;
use JsonApiPhp\JsonApi\ResourceCollection;
use JsonApiPhp\JsonApi\ResourceIdentifier;
use JsonApiPhp\JsonApi\ResourceIdentifierCollection;
use JsonApiPhp\JsonApi\ResourceObject;
use JsonApiPhp\JsonApi\ToMany;

class PaginationTest extends BaseTestCase
{
    public function testPaginatedResourceCollection()
    {
        $this->assertEncodesTo(
            '
            {
                "data": [
                    {"type": "apples", "id": "1"},
                    {"type": "apples", "id": "2"}
                ],
                "links": {
                    "first": "http://example.com/fruits?page=first",
                    "last": "http://example.com/fruits?page=last",
                    "prev": "http://example.com/fruits?page=3",
                    "next": "http://example.com/fruits?page=5"
                }
            }
            ',
            new DataDocument(
                new PaginatedCollection(
                    new Pagination(
                        new FirstLink('http://example.com/fruits?page=first'),
                        new PrevLink('http://example.com/fruits?page=3'),
                        new NextLink('http://example.com/fruits?page=5'),
                        new LastLink('http://example.com/fruits?page=last')
                    ),
                    new ResourceCollection(
                        new ResourceObject('apples', '1'),
                        new ResourceObject('apples', '2')
                    )
                )
            )
        );
    }

    public function testPaginatedResourceIdentifierCollection()
    {
        $this->assertEncodesTo(
            '
            {
                "data": {
                    "type": "baskets", 
                    "id": "1",
                    "relationships": {
                        "fruits": {
                            "data": [
                                {"type": "apples", "id": "1"},
                                {"type": "apples", "id": "2"}
                            ],
                            "links": {
                                "first": "http://example.com/basket/1/fruits?page=first",
                                "last": "http://example.com/basket/1/fruits?page=last",
                                "prev": "http://example.com/basket/1/fruits?page=3",
                                "next": "http://example.com/basket/1/fruits?page=5"
                            }
                        }
                    }
                },
                "included": [
                    {"type": "apples", "id": "1", "attributes": {"color": "red"}},
                    {"type": "apples", "id": "2", "attributes": {"color": "yellow"}}
                ]
            }
            ',
            new CompoundDocument(
                new ResourceObject(
                    'baskets',
                    '1',
                    new ToMany(
                        'fruits',
                        new ResourceIdentifierCollection(
                            new ResourceIdentifier('apples', '1'),
                            new ResourceIdentifier('apples', '2')
                        ),
                        new Pagination(
                            new FirstLink('http://example.com/basket/1/fruits?page=first'),
                            new PrevLink('http://example.com/basket/1/fruits?page=3'),
                            new NextLink('http://example.com/basket/1/fruits?page=5'),
                            new LastLink('http://example.com/basket/1/fruits?page=last')
                        )
                    )
                ),
                new Included(
                    new ResourceObject('apples', '1', new Attribute('color', 'red')),
                    new ResourceObject('apples', '2', new Attribute('color', 'yellow'))
                )
            )
        );
    }
}
