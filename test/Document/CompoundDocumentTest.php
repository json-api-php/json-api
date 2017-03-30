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
 * @link http://jsonapi.org/format/#document-compound-documents
 */
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
        $this->assertEquals(
            [
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
            ],
            $this->convertToArray($doc)['included']
        );
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Full linkage is required for apples:1
     */
    public function testFullLinkageIsRequired()
    {
        $doc = Document::fromResource(new NullData);
        $doc->setIncluded(new ResourceObject('apples', '1'));
        json_encode($doc);
    }

    public function testFullLinkageIsNotRequiredIfSparse()
    {
        $doc = Document::fromResource(new NullData);
        $doc->markSparse();
        $doc->setIncluded(new ResourceObject('apples', '1'));
        $this->assertCanBeBuilt($doc);
    }

    public function testIncludedResourceMayBeIdentifiedByPrimaryData()
    {
        $apple = new ResourceObject('apples', '1');
        $apple->setAttribute('color', 'red');
        $doc = Document::fromResource($apple->toId());
        $doc->setIncluded($apple);
        $this->assertCanBeBuilt($doc);
    }

    private function convertToArray($object): array
    {
        return json_decode(json_encode($object), true);
    }

    private function assertCanBeBuilt($doc)
    {
        $this->assertInternalType('string', json_encode($doc));
    }
}
