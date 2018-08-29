# [JSON API](http://jsonapi.org) spec implemented in PHP 7. Immutable

The goal of this library is to ensure strict validity of JSON API documents being produced.

JSON:
```json
{
    "data": {
        "type": "articles",
        "id": "1",
        "attributes": {
            "title": "Rails is Omakase"
        },
        "relationships": {
            "author": {
                "data": {
                    "type": "people",
                    "id": "9"
                },
                "links": {
                    "self": "/articles/1/relationships/author",
                    "related": "/articles/1/author"
                }
            }
        }
    }
}
```
PHP:
```php
<?php
use JsonApiPhp\JsonApi\Attribute;
use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\Link\RelatedLink;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\ResourceIdentifier;
use JsonApiPhp\JsonApi\ResourceObject;
use JsonApiPhp\JsonApi\ToOne;

echo json_encode(
    new DataDocument(
        new ResourceObject(
            'articles',
            '1',
            new Attribute('title', 'Rails is Omakase'),
            new ToOne(
                'author',
                new ResourceIdentifier('author', '9'),
                new SelfLink('/articles/1/relationships/author'),
                new RelatedLink('/articles/1/author')
            )
        )
    ),
    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
);
```
## Installation
`composer require json-api-php/json-api`

## Documentation

First, take a look at the examples. All of them are runnable.
- [Simple Document](./examples/simple_doc.php) (the same as above)
- [Extensive Compound Document](./examples/compound_doc.php)

The library API and use-cases are expressed in comprehensive suite of tests.
- Data Documents (containing primary data)
    -  [with a single Resource Object](./test/DataDocument/SingleResourceObjectTest.php)
    -  [with a single Resource Identifier](./test/DataDocument/SingleResourceIdentifierTest.php)
    -  [with null data](./test/DataDocument/NullDataTest.php)
    -  [with multiple Resource Objects](./test/DataDocument/ManyResourceObjectsTest.php)
    -  [with multiple Resource Identifiers](./test/DataDocument/ManyResourceIdentifiersTest.php)
- [Compound Documents](./test/CompoundDocumentTest.php)
- [Error Documents](./test/ErrorDocumentTest.php)
- [Meta Documents (containing neither data nor errors)](./test/MetaDocumentTest.php)
- [Pagination](./test/PaginationTest.php)
- [Link Objects](./test/LinkObjectTest.php)
- [JSON API Object](./test/JsonApiTest.php)
- [Meta Objects](./test/MetaTest.php)
