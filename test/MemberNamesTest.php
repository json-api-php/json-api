<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use JsonApiPhp\JsonApi\Document;
use JsonApiPhp\JsonApi\Document\Resource\Relationship;
use JsonApiPhp\JsonApi\Document\Resource\ResourceIdentifier;
use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;
use PHPUnit\Framework\TestCase;

class MemberNamesTest extends TestCase
{
    /**
     * The values of type members MUST adhere to the same constraints as member names.
     *
     * @param string   $name
     * @param callable $callback
     * @expectedException \OutOfBoundsException
     * @expectedExceptionMessage Invalid resource type
     * @dataProvider             invalidAttributesAndResourceTypeCallbacks
     */
    public function testInvalidTypesAreNotAllowed(string $name, callable $callback)
    {
        $callback($name);
    }

    /**
     * @expectedException \OutOfBoundsException
     * @expectedExceptionMessage Invalid member name
     * @dataProvider             invalidAttributesAndMemberNameCallbacks
     * @param string   $name
     * @param callable $callback
     */
    public function testInvalidAttributeNamesAreNotAllowed(string $name, callable $callback)
    {
        $callback($name);
    }

    public function invalidAttributesAndMemberNameCallbacks()
    {
        foreach ($this->invalidAttributeNames() as $attributeName) {
            foreach ($this->memberNameCallbacks() as $memberNameCallback) {
                yield [$attributeName, $memberNameCallback];
            }
            foreach ($this->linksCallbacks() as $linksCallback) {
                yield [$attributeName, $linksCallback];
            }
        }
    }

    public function invalidAttributesAndResourceTypeCallbacks()
    {
        foreach ($this->invalidAttributeNames() as $attributeName) {
            foreach ($this->resourceTypeCallbacks() as $resourceTypeCallback) {
                yield [$attributeName, $resourceTypeCallback];
            }
        }
    }

    private function invalidAttributeNames(): array
    {
        return [
            '_abcde',
            'abcd_',
            'abc$EDS',
            '#abcde',
            'abcde(',
            'b_',
            '_a',
            '$ab_c-d',
            '-abc',
        ];
    }

    /**
     * @return callable[]
     */
    private function memberNameCallbacks()
    {
        return [
            function ($name) {
                (new ResourceObject('apples', '0'))->setRelationship(
                    $name,
                    Relationship::fromSelfLink('https://example.com')
                );
            },
            function ($name) {
                (new ResourceObject('apples', '0'))->setAttribute($name, 'foo');
            },
        ];
    }

    private function resourceTypeCallbacks()
    {
        yield function ($type) {
            new ResourceIdentifier($type, 'foo');
        };
        yield function ($type) {
            new ResourceObject($type, 'foo');
        };
    }

    private function linksCallbacks()
    {
        $objects = [
            Document::nullDocument(),
            Relationship::fromSelfLink('https://example.com'),
            new ResourceObject('apples', '0'),
        ];
        foreach ($objects as $object) {
            yield function ($name) use ($object) {
                $object->setLink($name, 'https://example.com');
            };
        }
    }
}
