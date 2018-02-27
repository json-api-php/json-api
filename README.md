# [JSON API](http://jsonapi.org) spec implemented in PHP 7. Immutable

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
use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\Link\RelatedLink;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\Link\Url;
use JsonApiPhp\JsonApi\SingleLinkage;
use JsonApiPhp\JsonApi\PrimaryData\Attribute;
use JsonApiPhp\JsonApi\PrimaryData\ResourceIdentifier;
use JsonApiPhp\JsonApi\PrimaryData\ResourceObject;
use JsonApiPhp\JsonApi\Relationship;

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
- Data Documents
    -  [With a single Resource Object](./test/DataDocument/SingleResourceObjectTest.php)
- dfd
