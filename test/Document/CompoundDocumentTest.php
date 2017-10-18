<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test\Document;

use JsonApiPhp\JsonApi\Document;
use JsonApiPhp\JsonApi\Document\Meta;
use JsonApiPhp\JsonApi\Document\Resource\Linkage\MultiLinkage;
use JsonApiPhp\JsonApi\Document\Resource\Linkage\SingleLinkage;
use JsonApiPhp\JsonApi\Document\Resource\Relationship;
use JsonApiPhp\JsonApi\Document\Resource\ResourceIdentifier;
use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;
use JsonApiPhp\JsonApi\Test\BaseTestCase;

/**
 * To reduce the number of HTTP requests, servers MAY allow responses that include related resources
 * along with the requested primary resources. Such responses are called “compound documents”.
 *
 * In a compound document, all included resources MUST be represented as an array
 * of resource objects in a top-level included member.
 *
 * Compound documents require “full linkage”, meaning that every included resource
 * MUST be identified by at least one resource identifier object in the same document.
 * These resource identifier objects could either be primary data or represent resource linkage
 * contained within primary or included resources.
 *
 * The only exception to the full linkage requirement is when relationship fields
 * that would otherwise contain linkage data are excluded via sparse fieldsets.
 *
 * Note: Full linkage ensures that included resources are related to either the primary data
 * (which could be resource objects or resource identifier objects) or to each other.
 *
 * @see http://jsonapi.org/format/#document-compound-documents
 */
class CompoundDocumentTest extends BaseTestCase
{
    /**
     * Let's begin with the example from the official docs @link http://jsonapi.org/format/#document-compound-documents
     */
    public function testOfficialDocsExample()
    {
        $dan = new ResourceObject('people', '9');
        $dan->setAttribute('first-name', 'Dan');
        $dan->setAttribute('last-name', 'Gebhardt');
        $dan->setAttribute('twitter', 'dgeb');
        $dan->setLink('self', 'http://example.com/people/9');

        $comment05 = new ResourceObject('comments', '5');
        $comment05->setAttribute('body', 'First!');
        $comment05->setLink('self', 'http://example.com/comments/5');
        $comment05->setRelationship(
            'author',
            Relationship::fromLinkage(new SingleLinkage(new ResourceIdentifier('people', '2')))
        );

        $comment12 = new ResourceObject('comments', '12');
        $comment12->setAttribute('body', 'I like XML better');
        $comment12->setLink('self', 'http://example.com/comments/12');
        $comment12->setRelationship(
            'author',
            Relationship::fromLinkage(new SingleLinkage($dan->toIdentifier()))
        );

        $author = Relationship::fromLinkage(new SingleLinkage($dan->toIdentifier()));
        $author->setLink('self', 'http://example.com/articles/1/relationships/author');
        $author->setLink('related', 'http://example.com/articles/1/author');

        $comments = Relationship::fromLinkage(new MultiLinkage($comment05->toIdentifier(), $comment12->toIdentifier()));
        $comments->setLink('self', 'http://example.com/articles/1/relationships/comments');
        $comments->setLink('related', 'http://example.com/articles/1/comments');

        $article = new ResourceObject('articles', '1');
        $article->setAttribute('title', 'JSON API paints my bikeshed!');
        $article->setLink('self', 'http://example.com/articles/1');
        $article->setRelationship('author', $author);
        $article->setRelationship('comments', $comments);

        $doc = Document::fromResources($article);
        $doc->setIncluded($dan, $comment05, $comment12);
        $doc->setLink('self', 'http://example.com/articles');
        $doc->setLink('next', 'http://example.com/articles?page[offset]=2');
        $doc->setLink('last', 'http://example.com/articles?page[offset]=10');

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
            $doc
        );
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Full linkage is required for apples:1
     * @dataProvider             documentsWithoutFullLinkage
     * @param Document $doc
     */
    public function testFullLinkageIsRequired(Document $doc)
    {
        $doc->setIncluded(new ResourceObject('apples', '1'));
        json_encode($doc);
    }

    public function documentsWithoutFullLinkage(): array
    {
        return [
            [Document::nullDocument()],
            [Document::fromIdentifier(new ResourceIdentifier('oranges', '1'))],
            [Document::fromIdentifiers(new ResourceIdentifier('oranges', '1'), new ResourceIdentifier('oranges', '2'))],
            [Document::fromResource(new ResourceObject('oranges', '1'))],
            [Document::fromResources(new ResourceObject('oranges', '1'), new ResourceObject('oranges', '1'))],
        ];
    }

    /**
     * A compound document must be explicitly marked as sparse. In this case full linkage is not required.
     */
    public function testFullLinkageIsNotRequiredIfSparse()
    {
        $doc = Document::nullDocument();
        $doc->markSparse();
        $doc->setIncluded(new ResourceObject('apples', '1'));
        $this->assertEncodesTo(
            '
            {
                "data": null,
                "included": [
                    {
                        "type": "apples",
                        "id": "1"
                    }
                ]
            }
            ',
            $doc
        );
    }

    /**
     * Compound documents require “full linkage”, meaning that every included resource MUST be identified
     * by at least one resource identifier object in the same document.
     * These resource identifier objects could either be primary data or represent resource linkage
     * contained within primary or included resources.
     */
    public function testIncludedResourceMayBeIdentifiedByPrimaryData()
    {
        $apple = new ResourceObject('apples', '1');
        $apple->setAttribute('color', 'red');
        $doc = Document::fromIdentifier($apple->toIdentifier());
        $doc->setIncluded($apple);
        $this->assertJson(json_encode($doc));
    }

    public function testIncludedResourceMayBeIdentifiedByLinkageInPrimaryData()
    {
        $author = new ResourceObject('people', '9');
        $author->setAttribute('first-name', 'Dan');

        $article = new ResourceObject('articles', '1');
        $article->setAttribute('title', 'JSON API paints my bikeshed!');
        $article->setRelationship(
            'author',
            Relationship::fromLinkage(new SingleLinkage($author->toIdentifier()))
        );

        $doc = Document::fromResource($article);
        $doc->setIncluded($author);
        $this->assertJson(json_encode($doc));
    }

    public function testIncludedResourceMayBeIdentifiedByAnotherLinkedResource()
    {
        $writer = new ResourceObject('writers', '3');
        $writer->setAttribute('name', 'Eric Evans');

        $book = new ResourceObject('books', '2');
        $book->setAttribute('name', 'Domain Driven Design');
        $book->setRelationship(
            'author',
            Relationship::fromLinkage(new SingleLinkage($writer->toIdentifier()))
        );

        $cart = new ResourceObject('shopping-carts', '1');
        $cart->setRelationship(
            'contents',
            Relationship::fromLinkage(new MultiLinkage($book->toIdentifier()))
        );

        $this->assertTrue($book->identifies($writer));

        $doc = Document::fromResource($cart);
        $doc->setIncluded($book, $writer);
        $this->assertJson(json_encode($doc));
    }

    /**
     * A compound document MUST NOT include more than one resource object for each type and id pair.
     * @expectedException \LogicException
     * @expectedExceptionMessage Resource apples:1 is already included
     */
    public function testCanNotBeManyIncludedResourcesWithEqualIdentifiers()
    {
        $apple = new ResourceObject('apples', '1');
        $apple->setAttribute('color', 'red');
        $doc = Document::fromIdentifier($apple->toIdentifier());
        $doc->setIncluded($apple, $apple);
        $this->assertJson(json_encode($doc));
    }

    /**
     * If a document does not contain a top-level data key, the included member MUST NOT be present either.
     * @expectedException \LogicException
     * @expectedExceptionMessage Document with no data cannot contain included resources
     */
    public function testIncludedMustOnlyBePresentWithData()
    {
        $doc = Document::fromMeta(Meta::fromArray(['foo' => 'bar']));
        $doc->setIncluded(new ResourceObject('apples', '1'));
    }
}
