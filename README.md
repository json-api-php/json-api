# Implementation of [JSON API](http://jsonapi.org) in PHP

## WARNING! Work in progress! The internal library API is not stable yet!
This library is an attempt to express business rules of JSON API specification in a set of PHP 7 classes.

A simple example to illustrate the general idea. This (slightly modified) JSON representation from
[the documentation](http://jsonapi.org/format/#document-resource-objects)

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
                    "self": "\/articles\/1\/relationships\/author",
                    "related": "\/articles\/1\/author"
                }
            }
        }
    }
}
```
can be built with the following php code:
```php
$author = Relationship::fromLinkage(
    Linkage::fromSingleResourceId(
        new ResourceId('people', '9')
    )
);
$author->setLink('self', '/articles/1/relationships/author');
$author->setLink('related', '/articles/1/author');

$articles = new ResourceObject('articles', '1');
$articles->setRelationship('author', $author);
$articles->setAttribute('title', 'Rails is Omakase');

echo json_encode(Document::fromData($articles), JSON_PRETTY_PRINT);
```

Please refer to [the tests](./test) for the full API documentation:
* [Documents](./test/Document/DocumentTest.php)
    * [Compound Documents](./test/Document/CompoundDocumentTest.php)
* [Errors](./test/Document/ErrorTest.php)
* [Resources](./test/Document/Resource/ResourceTest.php)
* [Relationships](./test/Document/Resource/Relationship/RelationshipTest.php)
* [Linkage](./test/Document/Resource/Relationship/LinkageTest.php)
