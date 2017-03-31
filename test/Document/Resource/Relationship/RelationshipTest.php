<?php
/**
 *  This file is part of JSON:API implementation for PHP.
 *
 *  (c) Alexey Karapetov <karapetov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test\Document\Resource\Relationship;

use JsonApiPhp\JsonApi\Document\Resource\Relationship\Linkage;
use JsonApiPhp\JsonApi\Document\Resource\Relationship\Relationship;
use JsonApiPhp\JsonApi\Test\HasAssertEqualsAsJson;
use PHPUnit\Framework\TestCase;

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
class RelationshipTest extends TestCase
{
    use HasAssertEqualsAsJson;

    public function testCanCreateFromSelfLink()
    {
        $this->assertEqualsAsJson(
            [
                'links' => [
                    'self' => 'http://localhost',
                ]
            ],
            Relationship::fromSelfLink('http://localhost')
        );
    }

    public function testCanCreateFromRelatedLink()
    {
        $this->assertEqualsAsJson(
            [
                'links' => [
                    'related' => 'http://localhost',
                ]
            ],
            Relationship::fromRelatedLink('http://localhost')
        );
    }

    public function testCanCreateFromLinkage()
    {
        $this->assertEqualsAsJson(
            [
                'data' => null,
            ],
            Relationship::fromLinkage(Linkage::nullLinkage())
        );
    }

    public function testCanCreateFromMeta()
    {
        $this->assertEqualsAsJson(
            [
                'meta' => [
                    'a' => 'b',
                ]
            ],
            Relationship::fromMeta(['a' => 'b'])
        );
    }
}
