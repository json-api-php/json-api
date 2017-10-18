# Implementation of [JSON API](http://jsonapi.org) in PHP 7
This library is an attempt to express business rules of JSON API specification in a set of PHP 7 classes.

A simple example to illustrate the general idea. This JSON representation from
[the documentation](http://jsonapi.org/format/#document-resource-objects)
<!-- name=my_json -->
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
can be built with the following php code (less imports):
<!-- assert=output expect=my_json -->
```php
<?php
$articles = new \JsonApiPhp\JsonApi\Document\Resource\ResourceObject('articles', '1');
$author = \JsonApiPhp\JsonApi\Document\Resource\Relationship::fromLinkage(
    new \JsonApiPhp\JsonApi\Document\Resource\Linkage\SingleLinkage(
        new \JsonApiPhp\JsonApi\Document\Resource\ResourceIdentifier('people', '9')
    )
);
$author->setLink('self', '/articles/1/relationships/author');
$author->setLink('related','/articles/1/author');
$articles->setRelationship('author', $author);
$articles->setAttribute('title', 'Rails is Omakase');
$doc = \JsonApiPhp\JsonApi\Document::fromResource($articles);
echo json_encode($doc, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
```

Please refer to [the tests](./test) for the full API documentation:
* [Documents](./test/Document/DocumentTest.php). Creating documents with primary data, errors, and meta. 
Adding links and API version to a document.
    * [Compound Documents](./test/Document/CompoundDocumentTest.php). Resource linkage.
* [Errors](./test/Document/ErrorTest.php)
* [Resources](./test/Document/Resource/ResourceTest.php)
* [Relationships](./test/Document/Resource/Relationship/RelationshipTest.php)
* [Linkage](./test/Document/Resource/Relationship/LinkageTest.php)

## Installation
With [composer](https://getcomposer.org/): `json-api-php/json-api`.
