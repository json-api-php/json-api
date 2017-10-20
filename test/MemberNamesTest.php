<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use JsonApiPhp\JsonApi\Document\Link\Link;
use JsonApiPhp\JsonApi\Document\Meta;
use JsonApiPhp\JsonApi\Document\Resource\Relationship;
use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;
use PHPUnit\Framework\TestCase;

class MemberNamesTest extends TestCase
{
    /**
     * @param string $name
     * @expectedException \OutOfBoundsException
     * @expectedExceptionMessage Invalid member name
     * @dataProvider             invalidAttributeNames
     */
    public function testInvalidAttributeNamesAreNotAllowed(string $name)
    {
        $res = new ResourceObject('books', 'abc');
        $res->setAttribute($name, 1);
    }

    /**
     * The values of type members MUST adhere to the same constraints as member names.
     *
     * @param string $name
     * @expectedException \OutOfBoundsException
     * @expectedExceptionMessage Invalid resource type
     * @dataProvider             invalidAttributeNames
     */
    public function testInvalidTypesAreNotAllowed(string $name)
    {
        new ResourceObject($name, 'abc');
    }

    /**
     * @param string $name
     * @expectedException \OutOfBoundsException
     * @expectedExceptionMessage Invalid member name
     * @dataProvider             invalidAttributeNames
     */
    public function testInvalidRelationshipNamesAreNotAllowed(string $name)
    {
        $res = new ResourceObject('books', 'abc');
        $res->setRelationship($name, Relationship::fromSelfLink(new Link('https://example.com')));
    }

    /**
     * @param string $name
     * @expectedException \OutOfBoundsException
     * @expectedExceptionMessage Invalid member name
     * @dataProvider             invalidAttributeNames
     */
    public function testInvalidMetaNames(string $name)
    {
        Meta::fromArray(
            [
                'copyright' => 'Copyright 2015 Example Corp.',
                'authors' => [
                    [
                        'firstname' => 'Yehuda',
                        $name => 'Katz',
                    ],
                ],
            ]
        );
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
}
