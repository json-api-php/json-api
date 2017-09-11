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

use JsonApiPhp\JsonApi\Document\Resource\Linkage\MultiLinkage;
use JsonApiPhp\JsonApi\Document\Resource\Linkage\NullLinkage;
use JsonApiPhp\JsonApi\Document\Resource\Linkage\SingleLinkage;
use JsonApiPhp\JsonApi\Document\Resource\Relationship\Linkage;
use JsonApiPhp\JsonApi\Document\Resource\ResourceIdentifier;
use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;
use JsonApiPhp\JsonApi\Test\BaseTestCase;

/**
 * Resource Linkage
 *
 * Resource linkage in a compound document allows a client to link together
 * all of the included resource objects without having to GET any URLs via links.
 *
 * Resource linkage MUST be represented as one of the following:
 * - null for empty-to-one relationships.
 * - an empty array ([]) for empty to-many relationships.
 * - a single resource identifier object for non-empty to-one relationships.
 * - an array of resource identifier objects for non-empty to-many relationships.
 *
 * @see http://jsonapi.org/format/#document-resource-object-linkage
 * @see LinkageTest::testCanCreateNullLinkage()
 * @see LinkageTest::testCanCreateEmptyArrayLinkage()
 * @see LinkageTest::testCanCreateFromSingleResourceId()
 * @see LinkageTest::testCanCreateFromArrayOfResourceIds()
 */
class LinkageTest extends BaseTestCase
{
    public function testCanCreateNullLinkage()
    {
        $this->assertEncodesTo(
            'null',
            new NullLinkage()
        );
    }

    public function testCanCreateEmptyArrayLinkage()
    {
        $this->assertEncodesTo(
            '[]',
            new MultiLinkage()
        );
    }

    public function testCanCreateFromSingleResourceId()
    {
        $this->assertEncodesTo(
            '
            {
                "type": "books",
                "id": "abc"
            }
            ',
            new SingleLinkage(new ResourceIdentifier('books', 'abc'))
        );
    }

    public function testCanCreateFromArrayOfResourceIds()
    {
        $this->assertEncodesTo(
            '
            [
                {
                    "type": "books",
                    "id": "abc"
                },
                {
                    "type": "squirrels",
                    "id": "123"
                }
            ]
            ',
            new MultiLinkage(
                new ResourceIdentifier('books', 'abc'),
                new ResourceIdentifier('squirrels', '123')
            )
        );
    }

    public function testNullLinkageIsLinkedToNothing()
    {
        $apple = new ResourceObject('apples', '1');
        $this->assertFalse((new NullLinkage())->isLinkedTo($apple));
    }

    public function testEmptyArrayLinkageIsLinkedToNothing()
    {
        $apple = new ResourceObject('apples', '1');
        $this->assertFalse((new MultiLinkage())->isLinkedTo($apple));
    }

    public function testSingleLinkageIsLinkedOnlyToItself()
    {
        $apple = new ResourceObject('apples', '1');
        $orange = new ResourceObject('oranges', '1');

        $linkage = new SingleLinkage($apple->toIdentifier());

        $this->assertTrue($linkage->isLinkedTo($apple));
        $this->assertFalse($linkage->isLinkedTo($orange));
    }

    public function testMultiLinkageIsLinkedOnlyToItsMembers()
    {
        $apple = new ResourceObject('apples', '1');
        $orange = new ResourceObject('oranges', '1');
        $banana = new ResourceObject('bananas', '1');

        $linkage = new MultiLinkage($apple->toIdentifier(), $orange->toIdentifier());

        $this->assertTrue($linkage->isLinkedTo($apple));
        $this->assertTrue($linkage->isLinkedTo($orange));
        $this->assertFalse($linkage->isLinkedTo($banana));
    }
}
