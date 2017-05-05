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
use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;
use PHPUnit\Framework\TestCase;

/**
 * Fields
 *
 * A resource object’s attributes and its relationships are collectively called its “fields”.
 *
 * Fields for a resource object MUST share a common namespace with each other and with type and id.
 * In other words, a resource can not have an attribute and relationship with the same name,
 * nor can it have an attribute or relationship named type or id.
 *
 * @see http://jsonapi.org/format/#document-resource-object-fields
 */
class ResourceFireldsTest extends TestCase
{
    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Field foo already exists in attributes
     */
    public function testCanNotSetRelationshipIfAttributeExists()
    {
        $res = new ResourceObject('books', '1');
        $res->setAttribute('foo', 'bar');
        $res->setRelationship('foo', Relationship::fromMeta(new ArrayMeta(['a' => 'b'])));
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Field foo already exists in relationships
     */
    public function testCanNotSetAttributeIfRelationshipExists()
    {
        $res = new ResourceObject('books', '1');
        $res->setRelationship('foo', Relationship::fromMeta(new ArrayMeta(['a' => 'b'])));
        $res->setAttribute('foo', 'bar');
    }
}
