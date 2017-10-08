<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test\Document\Resource;

use JsonApiPhp\JsonApi\Document\Meta;
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
class ResourceFieldsTest extends TestCase
{
    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Field foo already exists in attributes
     */
    public function testCanNotSetRelationshipIfAttributeExists()
    {
        $res = new ResourceObject('books', '1');
        $res->setAttribute('foo', 'bar');
        $res->setRelationship('foo', Relationship::fromMeta(Meta::fromArray(['a' => 'b'])));
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Field foo already exists in relationships
     */
    public function testCanNotSetAttributeIfRelationshipExists()
    {
        $res = new ResourceObject('books', '1');
        $res->setRelationship('foo', Relationship::fromMeta(Meta::fromArray(['a' => 'b'])));
        $res->setAttribute('foo', 'bar');
    }

    /**
     * @param string $name
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Can not use a reserved name
     * @dataProvider             reservedAttributeNames
     */
    public function testAttributeCanNotHaveReservedNames(string $name)
    {
        $res = new ResourceObject('books', 'abc');
        $res->setAttribute($name, 1);
    }

    /**
     * @param string $name
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Can not use a reserved name
     * @dataProvider             reservedAttributeNames
     */
    public function testRelationshipCanNotHaveReservedNames(string $name)
    {
        $res = new ResourceObject('books', 'abc');
        $res->setRelationship($name, Relationship::fromMeta(Meta::fromArray(['a' => 'b'])));
    }

    /**
     * @param string $name
     * @expectedException \OutOfBoundsException
     * @expectedExceptionMessage Not a valid attribute name
     * @dataProvider             invalidAttributeNames
     */
    public function testAttributeNameIsNotValid(string $name)
    {
        $res = new ResourceObject('books', 'abc');
        $res->setAttribute($name, 1);
    }
    
    /**
     * @param string $name
     * @dataProvider             validAttributeNames
     */
    public function testAttributeNameIsValid(string $name)
    {
        $res = new ResourceObject('books', 'abc');
        $res->setAttribute($name, 1);
        $this->assertTrue(true);
    }
    
    public function reservedAttributeNames(): array
    {
        return [
            ['id'],
            ['type'],
        ];
    }
    
    public function invalidAttributeNames(): array
    {
        return [
            ['_abcde'],
            ['abcd_'],
            ['abc$EDS'],
            ['#abcde'],
            ['abcde('],
            ['b_'],
            ['_a'],
            ['$ab_c-d'],
            ['-abc'],
        ];
    }
    
    public function validAttributeNames(): array
    {
        return [
            ['abcd'],
            ['abcA4C'],
            ['abc_d3f45'],
            ['abd_eca'],
            ['a'],
            ['b'],
            ['ab'],
            ['a-bc_de'],
            ['abcéêçèÇ_n'],
            ['abc 汉字 abc'],
        ];
    }
}
