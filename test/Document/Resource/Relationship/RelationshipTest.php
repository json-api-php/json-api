<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test\Document\Resource\Relationship;

use JsonApiPhp\JsonApi\Document\Link\Link;
use JsonApiPhp\JsonApi\Document\Meta;
use JsonApiPhp\JsonApi\Document\Resource\Linkage\NullLinkage;
use JsonApiPhp\JsonApi\Document\Resource\Relationship;
use JsonApiPhp\JsonApi\Document\Resource\Relationship\Linkage;
use JsonApiPhp\JsonApi\Test\BaseTestCase;

/**
 * Relationships
 *
 * The value of the relationships key MUST be an object (a “relationships object”).
 * Members of the relationships object (“relationships”) represent references
 * from the resource object in which it’s defined to other resource objects.
 *
 * Relationships may be to-one or to-many.
 *
 * A “relationship object” MUST contain at least one of the following:
 *
 * - links: a links object containing at least one of the following:
 *      -   self: a link for the relationship itself (a “relationship link”).
 *          This link allows the client to directly manipulate the relationship.
 *          For example, removing an author through an article’s relationship URL would disconnect the person
 *          from the article without deleting the people resource itself. When fetched successfully, this link
 *          returns the linkage for the related resources as its primary data. (See Fetching Relationships.)
 *      -   related: a related resource link
 * - data: resource linkage
 * - meta: a meta object that contains non-standard meta-information about the relationship.
 *
 * A relationship object that represents a to-many relationship MAY also contain
 * pagination links under the links member, as described below.
 *
 * @see http://jsonapi.org/format/#document-resource-object-relationships
 * @see RelationshipTest::testCanCreateFromSelfLink()
 * @see RelationshipTest::testCanCreateFromRelatedLink())
 * @see RelationshipTest::testCanCreateFromLinkage())
 * @see RelationshipTest::testCanCreateFromMeta())
 */
class RelationshipTest extends BaseTestCase
{
    public function testCanCreateFromSelfLink()
    {
        $this->assertEncodesTo(
            '
            {
                "links": {
                    "self": "http://localhost"
                }
            }
            ',
            \JsonApiPhp\JsonApi\Document\Resource\Relationship::fromSelfLink(new Link('http://localhost'))
        );
    }

    public function testCanCreateFromRelatedLink()
    {
        $this->assertEncodesTo(
            '
            {
                "links": {
                    "related": "http://localhost"
                }
            }        
           ',
            \JsonApiPhp\JsonApi\Document\Resource\Relationship::fromRelatedLink(new Link('http://localhost'))
        );
    }

    public function testCanCreateFromLinkage()
    {
        $this->assertEncodesTo(
            '
            {
                "data": null
            }
            ',
            \JsonApiPhp\JsonApi\Document\Resource\Relationship::fromLinkage(new NullLinkage())
        );
    }

    public function testCanCreateFromMeta()
    {
        $this->assertEncodesTo(
            '
            {
                "meta": {
                    "a": "b"
                }
            }
            ',
            Relationship::fromMeta(Meta::fromArray(['a' => 'b']))
        );
    }
}
