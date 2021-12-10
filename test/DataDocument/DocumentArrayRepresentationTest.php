<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test\DataDocument;

use JsonApiPhp\JsonApi\Attribute;
use JsonApiPhp\JsonApi\CompoundDocument;
use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\Included;
use JsonApiPhp\JsonApi\JsonApi;
use JsonApiPhp\JsonApi\Link\LastLink;
use JsonApiPhp\JsonApi\Link\NextLink;
use JsonApiPhp\JsonApi\Link\RelatedLink;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\Meta;
use JsonApiPhp\JsonApi\PaginatedCollection;
use JsonApiPhp\JsonApi\Pagination;
use JsonApiPhp\JsonApi\ResourceCollection;
use JsonApiPhp\JsonApi\ResourceIdentifier;
use JsonApiPhp\JsonApi\ResourceIdentifierCollection;
use JsonApiPhp\JsonApi\ResourceObject;
use JsonApiPhp\JsonApi\Test\BaseTestCase;
use JsonApiPhp\JsonApi\ToMany;
use JsonApiPhp\JsonApi\ToOne;

class DocumentArrayRepresentationTest extends BaseTestCase
{
    public function testDataDocumentArrayRepresentation(): void
    {
        $this->assertEquals(
            json_decode('
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
                    "self": "/books/123/relationships/authors",
                    "related": "/books/123/authors"
                },
                "jsonapi": {
                    "version": "1.0"
                },
                "meta": {"document_meta": "bar"}
            }
            ', true),
            (new DataDocument(
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
                new SelfLink('/books/123/relationships/authors'),
                new RelatedLink('/books/123/authors'),
                new JsonApi(),
                new Meta('document_meta', 'bar')
            ))->toArray()
        );
    }

    public function testCompoundDocumentArrayRepresentation(): void
    {
        $dan = new ResourceObject(
            'people',
            '9',
            new Attribute('first-name', 'Dan'),
            new Attribute('last-name', 'Gebhardt'),
            new Attribute('twitter', 'dgeb'),
            new SelfLink('http://example.com/people/9')
        );

        $comment05 = new ResourceObject(
            'comments',
            '5',
            new Attribute('body', 'First!'),
            new SelfLink('http://example.com/comments/5'),
            new ToOne('author', new ResourceIdentifier('people', '2'))
        );

        $comment12 = new ResourceObject(
            'comments',
            '12',
            new Attribute('body', 'I like XML better'),
            new SelfLink('http://example.com/comments/12'),
            new ToOne('author', $dan->identifier())
        );

        $document = new CompoundDocument(
            new PaginatedCollection(
                new Pagination(
                    new NextLink('http://example.com/articles?page[offset]=2'),
                    new LastLink('http://example.com/articles?page[offset]=10')
                ),
                new ResourceCollection(
                    new ResourceObject(
                        'articles',
                        '1',
                        new Attribute('title', 'JSON API paints my bikeshed!'),
                        new SelfLink('http://example.com/articles/1'),
                        new ToOne(
                            'author',
                            $dan->identifier(),
                            new SelfLink('http://example.com/articles/1/relationships/author'),
                            new RelatedLink('http://example.com/articles/1/author')
                        ),
                        new ToMany(
                            'comments',
                            new ResourceIdentifierCollection(
                                $comment05->identifier(),
                                $comment12->identifier()
                            ),
                            new SelfLink('http://example.com/articles/1/relationships/comments'),
                            new RelatedLink('http://example.com/articles/1/comments')
                        )
                    )
                )
            ),
            new Included($dan, $comment05, $comment12),
            new SelfLink('http://example.com/articles')
        );
        $this->assertEquals(
            json_decode('
            {
              "links": {
                "self": "http://example.com/articles",
                "next": "http://example.com/articles?page[offset]=2",
                "last": "http://example.com/articles?page[offset]=10"
              },
              "data": [{
                "type": "articles",
                "id": "1",
                "attributes": {
                  "title": "JSON API paints my bikeshed!"
                },
                "links": {
                  "self": "http://example.com/articles/1"
                },
                "relationships": {
                  "author": {
                    "links": {
                      "self": "http://example.com/articles/1/relationships/author",
                      "related": "http://example.com/articles/1/author"
                    },
                    "data": { "type": "people", "id": "9" }
                  },
                  "comments": {
                    "links": {
                      "self": "http://example.com/articles/1/relationships/comments",
                      "related": "http://example.com/articles/1/comments"
                    },
                    "data": [
                      { "type": "comments", "id": "5" },
                      { "type": "comments", "id": "12" }
                    ]
                  }
                }
              }],
              "included": [{
                "type": "people",
                "id": "9",
                "attributes": {
                  "first-name": "Dan",
                  "last-name": "Gebhardt",
                  "twitter": "dgeb"
                },
                "links": {
                  "self": "http://example.com/people/9"
                }
              }, {
                "type": "comments",
                "id": "5",
                "attributes": {
                  "body": "First!"
                },
                "relationships": {
                  "author": {
                    "data": { "type": "people", "id": "2" }
                  }
                },
                "links": {
                  "self": "http://example.com/comments/5"
                }
              }, {
                "type": "comments",
                "id": "12",
                "attributes": {
                  "body": "I like XML better"
                },
                "relationships": {
                  "author": {
                    "data": { "type": "people", "id": "9" }
                  }
                },
                "links": {
                  "self": "http://example.com/comments/12"
                }
              }]
            }            
            ', true),
            $document->toArray()
        );
    }
}
