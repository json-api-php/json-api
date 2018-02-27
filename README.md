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
use JsonApiPhp\JsonApi\{
    DataDocument, SingleLinkage, Attribute, ResourceIdentifier, ResourceObject, Relationship,
    Link\RelatedLink, Link\SelfLink, Link\Url
};

echo json_encode(
    new DataDocument(
        new ResourceObject('articles', '1',
            new Attribute('title', 'Rails is Omakase'),
            new Relationship('author',
                new SingleLinkage(new ResourceIdentifier('author', '9')),
                new SelfLink(new Url('/articles/1/relationships/author')),
                new RelatedLink(new Url('/articles/1/author'))
            )
        )
    ),
    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
);
```
## Installation
`composer require json-api-php/json-api`

## Documentation

The library API and use-cases are expressed in comprehensive suite of tests.
- Data Documents (containing primary data)
    -  [With a single Resource Object](./test/DataDocument/SingleResourceObjectTest.php)
    -  [With a single Resource Identifier](./test/DataDocument/SingleResourceIdentifierTest.php)
    -  [With null data](./test/DataDocument/NullDataTest.php)
    -  [With multiple Resource Objects](./test/DataDocument/ManyResourceObjectsTest.php)
    -  [With multiple Resource Identifiers](./test/DataDocument/ManyResourceIdentifiersTest.php)
- [Compound Documents](./test/CompoundDocumentTest.php)
- [Error Documents](./test/ErrorDocumentTest.php)
- [Meta Documents (containing neither data nor errors)](./test/MetaDocumentTest.php)
- [Pagination links](./test/PaginationLinksTest.php)
- [JSON API Object](./test/JsonApiTest.php)
- [Meta Object](./test/MetaTest.php)
