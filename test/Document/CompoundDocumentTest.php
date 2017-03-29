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

namespace JsonApiPhp\JsonApi\Test\Document;

use JsonApiPhp\JsonApi\Document\Document;
use JsonApiPhp\JsonApi\Document\Resource\NullData;
use JsonApiPhp\JsonApi\Document\Resource\Relationship\Linkage;
use JsonApiPhp\JsonApi\Document\Resource\Relationship\Relationship;
use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;
use JsonApiPhp\JsonApi\Test\HasAssertEqualsAsJson;
use PHPUnit\Framework\TestCase;

class CompoundDocumentTest extends TestCase
{
    use HasAssertEqualsAsJson;

    public function testIncludedResourcesRepresentedAsArray()
    {
        $apple = new ResourceObject('apples', '1');
        $apple->setAttribute('color', 'red');
        $orange = new ResourceObject('oranges', '1');
        $orange->setAttribute('color', 'orange');
        $basket = new ResourceObject('basket', '1');
        $basket->setRelationship(
            'fruits',
            Relationship::fromLinkage(
                Linkage::fromManyResourceIds(
                    $apple->toId(),
                    $orange->toId()
                )
            )
        );
        $doc = Document::fromResource($basket);
        $doc->setIncluded($apple, $orange);
        $this->assertEqualsAsJson(
            [
                'data' => [
                    'type' => 'basket',
                    'id' => '1',
                    'relationships' => [
                        'fruits' => [
                            'data' => [
                                [
                                    'type' => 'apples',
                                    'id' => '1',
                                ],
                                [
                                    'type' => 'oranges',
                                    'id' => '1',
                                ],
                            ]
                        ]
                    ],
                ],
                'included' => [
                    [
                        'type' => 'apples',
                        'id' => '1',
                        'attributes' => [
                            'color' => 'red',
                        ],
                    ],
                    [
                        'type' => 'oranges',
                        'id' => '1',
                        'attributes' => [
                            'color' => 'orange',
                        ],
                    ],
                ]

            ],
            $doc
        );
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Full linkage is required for apples:1
     */
    public function testFullLinkageIsRequired()
    {
        $doc = Document::fromResource(new NullData);
        $doc->setIncluded(
            new ResourceObject('apples', '1')
        );
        json_encode($doc);
    }

    public function testFullLinkageIsNotRequiredIfSparse()
    {
        $doc = Document::fromResource(new NullData);
        $doc->setIsSparse();
        $doc->setIncluded(
            new ResourceObject('apples', '1')
        );
        $this->assertInternalType('string', json_encode($doc));
    }
}
