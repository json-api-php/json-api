<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use JsonApiPhp\JsonApi\Document\Link\Link;
use JsonApiPhp\JsonApi\Document\Resource\Relationship;
use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;
use PHPUnit\Framework\TestCase;

class MemberNamesTest extends TestCase
{
    /**
     * @param string $name
     * @expectedException \OutOfBoundsException
     * @expectedExceptionMessage Not a valid attribute name
     * @dataProvider             invalidAttributeNames
     */
    public function testInvalidAttributeNamesAreNotAllowed(string $name)
    {
        $res = new ResourceObject('books', 'abc');
        $res->setAttribute($name, 1);
    }

    /**
     * @param string $name
     * @dataProvider             validAttributeNames
     */
    public function testValidAttributeNamesCanBeSet(string $name)
    {
        $res = new ResourceObject('books', 'abc');
        $res->setAttribute($name, 1);
        $this->assertInternalType('string', json_encode($res));
    }

    /**
     * @param string $name
     * @expectedException \OutOfBoundsException
     * @expectedExceptionMessage Not a valid attribute name
     * @dataProvider             invalidAttributeNames
     */
    public function testInvalidRelationshipNamesAreNotAllowed(string $name)
    {
        $res = new ResourceObject('books', 'abc');
        $res->setRelationship($name, Relationship::fromSelfLink(new Link('https://example.com')));
    }

    /**
     * @param string $name
     * @dataProvider             validAttributeNames
     */
    public function testValidRelationshipNamesCanBeSet(string $name)
    {
        $res = new ResourceObject('books', 'abc');
        $res->setRelationship($name, Relationship::fromSelfLink(new Link('https://example.com')));
        $this->assertInternalType('string', json_encode($res));
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
