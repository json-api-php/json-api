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
use JsonApiPhp\JsonApi\Document\Resource\ResourceId;
use JsonApiPhp\JsonApi\Test\HasAssertEqualsAsJson;
use PHPUnit\Framework\TestCase;

class LinkageTest extends TestCase
{
    use HasAssertEqualsAsJson;

    public function testNullLinkage()
    {
        $this->assertEqualsAsJson(
            null,
            Linkage::nullLinkage()
        );
    }

    public function testEmptyArrayLinkage()
    {
        $this->assertEqualsAsJson(
            [],
            Linkage::emptyArrayLinkage()
        );
    }

    public function testFromResourceId()
    {
        $this->assertEqualsAsJson(
            [
                'type' => 'books',
                'id' => 'abc',
            ],
            Linkage::fromSingleResourceId(new ResourceId('books', 'abc'))
        );
    }

    public function testFromResourceIds()
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
}
