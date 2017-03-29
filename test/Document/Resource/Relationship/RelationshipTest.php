<?php
/**
 *
 *  * This file is part of JSON:API implementation for PHP.
 *  *
 *  * (c) Alexey Karapetov <karapetov@gmail.com>
 *  *
 *  * For the full copyright and license information, please view the LICENSE
 *  * file that was distributed with this source code.
 *
 */

declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test\Document\Resource\Relationship;

use JsonApiPhp\JsonApi\Document\Resource\Relationship\Linkage;
use JsonApiPhp\JsonApi\Document\Resource\Relationship\Relationship;
use JsonApiPhp\JsonApi\Test\HasAssertEqualsAsJson;
use PHPUnit\Framework\TestCase;

class RelationshipTest extends TestCase
{
    use HasAssertEqualsAsJson;

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
}
