<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\Link\FirstLink;
use JsonApiPhp\JsonApi\Link\LastLink;
use JsonApiPhp\JsonApi\Link\NextLink;
use JsonApiPhp\JsonApi\Link\PrevLink;
use JsonApiPhp\JsonApi\ResourceCollection;
use JsonApiPhp\JsonApi\ResourceObject;

class PaginationLinksTest extends BaseTestCase
{
    public function testPagination()
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
                new ResourceCollection(
                    new ResourceObject('apples', '1'),
                    new ResourceObject('apples', '2')
                ),
                new FirstLink('http://example.com/fruits?page=first'),
                new PrevLink('http://example.com/fruits?page=3'),
                new NextLink('http://example.com/fruits?page=5'),
                new LastLink('http://example.com/fruits?page=last')
            )
        );
    }
}
