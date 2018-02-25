<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use JsonApiPhp\JsonApi\CompoundDocument;
use JsonApiPhp\JsonApi\Included;
use JsonApiPhp\JsonApi\Link\LastLink;
use JsonApiPhp\JsonApi\Link\NextLink;
use JsonApiPhp\JsonApi\Link\RelatedLink;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\Link\Url;
use JsonApiPhp\JsonApi\Linkage\MultiLinkage;
use JsonApiPhp\JsonApi\Linkage\SingleLinkage;
use JsonApiPhp\JsonApi\PrimaryData\Attribute;
use JsonApiPhp\JsonApi\PrimaryData\NullData;
use JsonApiPhp\JsonApi\PrimaryData\ResourceId;
use JsonApiPhp\JsonApi\PrimaryData\ResourceObject;
use JsonApiPhp\JsonApi\PrimaryData\ResourceSet;
use JsonApiPhp\JsonApi\Relationship;

class CompoundDocumentTest extends BaseTestCase
{
    public function testOfficialDocsExample()
    {
        $dan = new ResourceObject(
            'people',
            '9',
            new Attribute('first-name', 'Dan'),
            new Attribute('last-name', 'Gebhardt'),
            new Attribute('twitter', 'dgeb'),
            new SelfLink(new Url('http://example.com/people/9'))
        );

        $comment05 = new ResourceObject(
            'comments',
            '5',
            new Attribute('body', 'First!'),
            new SelfLink(new Url('http://example.com/comments/5')),
            new Relationship('author', new SingleLinkage(new ResourceId('people', '2')))

        );
        $comment12 = new ResourceObject(
            'comments',
            '12',
            new Attribute('body', 'I like XML better'),
            new SelfLink(new Url('http://example.com/comments/12')),
            new Relationship('author', new SingleLinkage($dan->toResourceId()))
        );

        $document = new CompoundDocument(
            new ResourceSet(
                new ResourceObject(
                    'articles',
                    '1',
                    new Attribute('title', 'JSON API paints my bikeshed!'),
                    new SelfLink(new Url('http://example.com/articles/1')),
                    new Relationship(
                        'author',
                        new SingleLinkage($dan->toResourceId()),
                        new SelfLink(new Url('http://example.com/articles/1/relationships/author')),
                        new RelatedLink(new Url('http://example.com/articles/1/author'))
                    ),
                    new Relationship(
                        'comments',
                        new MultiLinkage(
                            $comment05->toResourceId(),
                            $comment12->toResourceId()
                        ),
                        new SelfLink(new Url('http://example.com/articles/1/relationships/comments')),
                        new RelatedLink(new Url('http://example.com/articles/1/comments'))
                    )
                )
            ),
            new Included($dan, $comment05, $comment12),
            new SelfLink(new Url('http://example.com/articles')),
            new NextLink(new Url('http://example.com/articles?page[offset]=2')),
            new LastLink(new Url('http://example.com/articles?page[offset]=10'))
        );
        $this->assertEncodesTo(
            '
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
            ',
            $document
        );
    }

    /**
     * Compound documents require “full linkage”, meaning that every included resource MUST be identified
     * by at least one resource identifier object in the same document.
     * These resource identifier objects could either be primary data or represent resource linkage
     * contained within primary or included resources.
     */
    public function testFullLinkage()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Full linkage required for apples:1');
        new CompoundDocument(new NullData(), new Included(new ResourceObject('apples', '1')));
    }

    public function testIncludedResourceMayBeIdentifiedByLinkageInPrimaryData()
    {
        $author = new ResourceObject('people', '9');
        $article = new ResourceObject(
            'articles',
            '1',
            new Relationship('author', new SingleLinkage($author->toResourceId()))
        );
        $doc = new CompoundDocument($article, new Included($author));
        $this->assertNotEmpty($doc);
    }

    public function testIncludedResourceMayBeIdentifiedByAnotherLinkedResource()
    {
        $writer = new ResourceObject('writers', '3', new Attribute('name', 'Eric Evans'));
        $book = new ResourceObject(
            'books',
            '2',
            new Attribute('name', 'Domain Driven Design'),
            new Relationship('author', new SingleLinkage($writer->toResourceId()))
        );
        $cart = new ResourceObject(
            'shopping-carts',
            '1',
            new Relationship('contents', new MultiLinkage($book->toResourceId()))
        );
        $doc = new CompoundDocument($cart, new Included($book, $writer));
        $this->assertNotEmpty($doc);
    }

    /**
     * A compound document MUST NOT include more than one resource object for each type and id pair.
     * @expectedException \DomainException
     * @expectedExceptionMessage Resource apples:1 is already included
     */
    public function testCanNotBeManyIncludedResourcesWithEqualIdentifiers()
    {
        $apple = new ResourceObject('apples', '1');
        new CompoundDocument($apple->toResourceId(), new Included($apple, $apple));
    }
}
