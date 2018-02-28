<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use JsonApiPhp\JsonApi\Attribute;
use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\Link\RelatedLink;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\Meta;
use JsonApiPhp\JsonApi\ResourceIdentifier;
use JsonApiPhp\JsonApi\ResourceObject;
use JsonApiPhp\JsonApi\ToMany;
use JsonApiPhp\JsonApi\ToNull;
use JsonApiPhp\JsonApi\ToOne;

class ResourceObjectTest extends BaseTestCase
{
    public function testFullFledgedResourceObject()
    {
        $this->assertEncodesTo(
            '
            {
                "data": {
                    "type": "apples",
                    "id": "1",
                    "attributes": {
                        "title": "Rails is Omakase"
                    },
                    "meta": {"foo": "bar"},
                    "links": {
                        "self": "http://self"
                    },
                    "relationships": {
                        "author": {
                            "meta": {"foo": "bar"},
                            "links": {
                                "self": "http://rel/author",
                                "related": "http://author"
                            },
                            "data": null
                        }
                    }
                }
            }
            ',
            new DataDocument(
                new ResourceObject(
                    'apples',
                    '1',
                    new Meta('foo', 'bar'),
                    new Attribute('title', 'Rails is Omakase'),
                    new SelfLink('http://self'),
                    new ToNull(
                        'author',
                        new Meta('foo', 'bar'),
                        new SelfLink('http://rel/author'),
                        new RelatedLink('http://author')
                    )
                )
            )
        );
    }

    public function testRelationshipWithSingleIdLinkage()
    {
        $this->assertEncodesTo(
            '
            {
                "data": {
                    "type": "basket",
                    "id": "1",
                    "relationships": {
                        "content": {
                            "data": {"type": "apples", "id": "1"}
                        }
                    }
                }
            }
            ',
            new DataDocument(
                new ResourceObject(
                    'basket',
                    '1',
                    new ToOne('content', new ResourceIdentifier('apples', '1'))
                )
            )
        );
    }

    public function testRelationshipWithMultiIdLinkage()
    {
        $this->assertEncodesTo(
            '
            {
                "data": {
                    "type": "basket",
                    "id": "1",
                    "relationships": {
                        "content": {
                            "data": [{
                                "type": "apples",
                                "id": "1"
                            },{
                                "type": "pears",
                                "id": "2"
                            }]
                        }
                    }
                }
            }
            ',
            new DataDocument(
                new ResourceObject(
                    'basket',
                    '1',
                    new ToMany(
                        'content',
                        new ResourceIdentifier('apples', '1'),
                        new ResourceIdentifier('pears', '2')
                    )
                )
            )
        );
    }

    public function testRelationshipWithEmptyMultiIdLinkage()
    {
        $this->assertEncodesTo(
            '
            {
                "data": {
                    "type": "basket",
                    "id": "1",
                    "relationships": {
                        "content": {
                            "data": []
                        }
                    }
                }
            }
            ',
            new DataDocument(
                new ResourceObject(
                    'basket',
                    '1',
                    new ToMany('content')
                )
            )
        );
    }

    public function testCanNotCreateIdAttribute()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage("Can not use 'id' as a resource field");
        new Attribute('id', 'foo');
    }

    public function testCanNotCreateTypeAttribute()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage("Can not use 'type' as a resource field");
        new Attribute('type', 'foo');
    }

    public function testCanNotCreateIdRelationship()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage("Can not use 'id' as a resource field");
        new ToOne('id', new ResourceIdentifier('apples', '1'));
    }

    public function testCanNotCreateTypeRelationship()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage("Can not use 'type' as a resource field");
        new ToOne('type', new ResourceIdentifier('apples', '1'));
    }

    /**
     * @dataProvider invalidCharacters
     * @param string $invalid_char
     */
    public function testAttributeMustOnlyHaveAllowedCharacters(string $invalid_char)
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Invalid character in a member name');
        new Attribute("foo{$invalid_char}bar", 'plus can not be used');
    }

    /**
     * @dataProvider invalidCharacters
     * @param string $invalid_char
     */
    public function testRelationshipMustOnlyHaveAllowedCharacters(string $invalid_char)
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Invalid character in a member name');
        new ToNull("foo{$invalid_char}bar");
    }

    public function invalidCharacters()
    {
        return [
            ['+'],
            ['!'],
            ['@'],
            ['/'],
            ['}'],
        ];
    }

    public function testResourceFieldsMustBeUnique()
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage("Field 'foo' already exists");
        new ResourceObject(
            'apples',
            '1',
            new Attribute('foo', 'bar'),
            new ToOne('foo', new ResourceIdentifier('apples', '1'))
        );
    }

    /**
     * The id member is not required when the resource object originates at the client and represents
     * a new resource to be created on the server.
     */
    public function testResourceIdCanBeOmitted()
    {
        $this->assertEncodesTo(
            '
            {
                "data": {
                    "type": "apples",
                    "id": null,
                    "attributes": {
                        "color": "red"
                    }
                }
            }
            ',
            new DataDocument(new ResourceObject('apples', null, new Attribute('color', 'red')))
        );
    }
}
