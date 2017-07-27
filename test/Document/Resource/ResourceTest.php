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

namespace JsonApiPhp\JsonApi\Test\Document\Resource;

use JsonApiPhp\JsonApi\Document\ArrayMeta;
use JsonApiPhp\JsonApi\Document\Resource\Relationship\Relationship;
use JsonApiPhp\JsonApi\Document\Resource\ResourceIdentifier;
use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;
use JsonApiPhp\JsonApi\Test\BaseTestCase;

/**
 * Resource Objects
 *
 * @see http://jsonapi.org/format/#document-resource-objects
 */
class ResourceTest extends BaseTestCase
{
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
                new ResourceIdentifier('books'),
            ],
            [
                [
                    'type' => 'books',
                    'id' => '42abc',
                ],
                new ResourceIdentifier('books', '42abc'),
            ],
            [
                [
                    'type' => 'books',
                    'id' => '42abc',
                    'meta' => [
                        'foo' => 'bar',
                    ],
                ],
                new ResourceIdentifier('books', '42abc', new ArrayMeta(['foo' => 'bar'])),
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
                    $resource->setMeta(new ArrayMeta(['foo' => 'bar']));
                    $resource->setAttribute('attr', 'val');
                    $resource->setLink('self', 'http://localhost');
                    $resource->setRelationship('author', Relationship::fromMeta(new ArrayMeta(['a' => 'b'])));
                    return $resource;
                })(),
            ],
        ];
    }
}
