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

use JsonApiPhp\JsonApi\Document\Resource\NullData;
use JsonApiPhp\JsonApi\Document\Resource\Relationship\Linkage;
use JsonApiPhp\JsonApi\Document\Resource\ResourceId;
use JsonApiPhp\JsonApi\Test\HasAssertEqualsAsJson;
use phpDocumentor\Reflection\DocBlock\Tags\Link;
use PHPUnit\Framework\TestCase;

class LinkageTest extends TestCase
{
    use HasAssertEqualsAsJson;

    public function testCanCreateNullLinkage()
    {
        $this->assertEqualsAsJson(
            null,
            Linkage::nullLinkage()
        );
    }

    public function testCanCreateEmptyArrayLinkage()
    {
        $this->assertEqualsAsJson(
            [],
            Linkage::emptyArrayLinkage()
        );
    }

    public function testCanCreateFromResourceId()
    {
        $this->assertEqualsAsJson(
            [
                'type' => 'books',
                'id' => 'abc',
            ],
            Linkage::fromSingleResourceId(new ResourceId('books', 'abc'))
        );
    }

    public function testCanCreateFromResourceIds()
    {
        $this->assertEqualsAsJson(
            [
                [
                    'type' => 'books',
                    'id' => 'abc',
                ],
                [
                    'type' => 'squirrels',
                    'id' => '123',
                ],
            ],
            Linkage::fromManyResourceIds(new ResourceId('books', 'abc'), new ResourceId('squirrels', '123'))
        );
    }

    public function testNullLinkageIsLinkedToNothing()
    {
        $apple = new ResourceId('apples', '1');
        $this->assertFalse(Linkage::nullLinkage()->isLinkedTo($apple));
        $this->assertFalse(Linkage::nullLinkage()->isLinkedTo(new NullData));
    }

    public function testEmptyArrayLinkageIsLinkedToNothing()
    {
        $apple = new ResourceId('apples', '1');
        $this->assertFalse(Linkage::emptyArrayLinkage()->isLinkedTo($apple));
        $this->assertFalse(Linkage::emptyArrayLinkage()->isLinkedTo(new NullData));
    }

    public function testSingleLinkageIsLinkedOnlyToItself()
    {
        $apple = new ResourceId('apples', '1');
        $orange = new ResourceId('oranges', '1');

        $linkage = Linkage::fromSingleResourceId($apple);

        $this->assertTrue($linkage->isLinkedTo($apple));
        $this->assertFalse($linkage->isLinkedTo($orange));
    }

    public function testMultiLinkageIsLinkedOnlyToItsMembers()
    {
        $apple = new ResourceId('apples', '1');
        $orange = new ResourceId('oranges', '1');
        $banana = new ResourceId('bananas', '1');

        $linkage = Linkage::fromManyResourceIds($apple, $orange);

        $this->assertTrue($linkage->isLinkedTo($apple));
        $this->assertTrue($linkage->isLinkedTo($orange));
        $this->assertFalse($linkage->isLinkedTo($banana));
    }
}
