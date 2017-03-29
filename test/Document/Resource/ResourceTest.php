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

namespace JsonApiPhp\JsonApi\Test\Document\Resource;

use JsonApiPhp\JsonApi\Document\Resource\Relationship\Relationship;
use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;
use JsonApiPhp\JsonApi\Document\Resource\ResourceId;
use JsonApiPhp\JsonApi\Test\HasAssertEqualsAsJson;
use PHPUnit\Framework\TestCase;

class ResourceTest extends TestCase
{
    use HasAssertEqualsAsJson;

    /**
     * @param array $expected
     * @param mixed $data
     * @dataProvider resourceProvider
     */
    public function testSerialization(array $expected, $data)
    {
        $this->assertEqualsAsJson($expected, $data);
    }

    public function resourceProvider()
    {
        return [
            [
                [
                    'type' => 'books',
                ],
                new ResourceId('books'),
            ],
            [
                [
                    'type' => 'books',
                    'id' => '42abc',
                ],
                new ResourceId('books', '42abc'),
            ],
            [
                [
                    'type' => 'books',
                    'id' => '42abc',
                    'meta' => [
                        'foo' => 'bar',
                    ],
                ],
                new ResourceId('books', '42abc', ['foo' => 'bar']),
            ],
            [
                [
                    'type' => 'books',
                    'id' => '42abc',
                    'attributes' => [
                        'attr' => 'val',
                    ],
                    'relationships' => [
                        'author' => [
                            'meta' => [
                                'a' => 'b',
                            ],
                        ],
                    ],
                    'links' => [
                        'self' => 'http://localhost',
                    ],
                    'meta' => [
                        'foo' => 'bar',
                    ],
                ],
                (function () {
                    $resource = new ResourceObject('books', '42abc');
                    $resource->setMeta('foo', 'bar');
                    $resource->setAttribute('attr', 'val');
                    $resource->setLink('self', 'http://localhost');
                    $resource->setRelationship('author', Relationship::fromMeta(['a' => 'b']));
                    return $resource;
                })()
            ],
        ];
    }

    /**
     * @param string $name
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid attribute name
     * @dataProvider             invalidAttributeNames
     */
    public function testAttributeCanNotHaveReservedNames(string $name)
    {
        $r = new ResourceObject('books', 'abc');
        $r->setAttribute($name, 1);
    }

    public function invalidAttributeNames(): array
    {
        return [
            ['id'],
            ['type'],
        ];
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Field foo already exists in attributes
     */
    public function testCanNotSetRelationshipIfAttributeExists()
    {
        $res = new ResourceObject('books', '1');
        $res->setAttribute('foo', 'bar');
        $res->setRelationship('foo', Relationship::fromMeta(['a' => 'b']));
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Field foo already exists in relationships
     */
    public function testCanNotSetAttributeIfRelationshipExists()
    {
        $res = new ResourceObject('books', '1');
        $res->setRelationship('foo', Relationship::fromMeta(['a' => 'b']));
        $res->setAttribute('foo', 'bar');
    }
}
