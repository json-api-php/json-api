<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use JsonApiPhp\JsonApi\Link\RelatedLink;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\Link\Url;
use JsonApiPhp\JsonApi\Linkage\MultiLinkage;
use JsonApiPhp\JsonApi\Linkage\SingleLinkage;
use JsonApiPhp\JsonApi\Meta;
use JsonApiPhp\JsonApi\PrimaryData\Attribute;
use JsonApiPhp\JsonApi\PrimaryData\ResourceId;
use JsonApiPhp\JsonApi\PrimaryData\ResourceObject;
use JsonApiPhp\JsonApi\Relationship;

class ResourceObjectTest extends BaseTestCase
{
    public function testFullFledgedResourceObject()
    {
        $this->assertEncodesTo(
            '
            {
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
            ',
            new ResourceObject(
                'apples',
                '1',
                new Meta(['foo' => 'bar']),
                new Attribute('title', 'Rails is Omakase'),
                new SelfLink(new Url('http://self')),
                new Relationship(
                    'author',
                    new Meta(['foo' => 'bar']),
                    new SelfLink(new Url('http://rel/author')),
                    new RelatedLink(new Url('http://author')),
                    new SingleLinkage()
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
                    "type": "apples",
                    "id": "1"
                }
            }
            ',
            new Relationship(
                'fruits',
                new SingleLinkage(
                    new ResourceId('apples', '1')
                )
            )
        );
    }

    public function testRelationshipWithMultiIdLinkage()
    {
        $this->assertEncodesTo(
            '
            {
                "data": [{
                    "type": "apples",
                    "id": "1"
                },{
                    "type": "pears",
                    "id": "2"
                }]
            }
            ',
            new Relationship(
                'fruits',
                new MultiLinkage(
                    new ResourceId('apples', '1'),
                    new ResourceId('pears', '2')
                )
            )
        );
    }

    public function testRelationshipWithEmptyMultiIdLinkage()
    {
        $this->assertEncodesTo(
            '
            {
                "data": []
            }
            ',
            new Relationship(
                'fruits',
                new MultiLinkage()
            )
        );
    }

    public function testCanNotCreateIdAttribute()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage("Can not use 'id' as age resource field");
        new Attribute('id', 'foo');
    }

    public function testCanNotCreateTypeAttribute()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage("Can not use 'type' as age resource field");
        new Attribute('type', 'foo');
    }

    public function testCanNotCreateIdRelationship()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage("Can not use 'id' as age resource field");
        new Relationship('id', new Meta([]));
    }

    public function testCanNotCreateTypeRelationship()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage("Can not use 'type' as age resource field");
        new Relationship('type', new Meta([]));
    }

    public function testResourceFieldsMustBeUnique()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage("Field 'foo' already exists");
        new ResourceObject(
            'apples',
            '1',
            new Attribute('foo', 'bar'),
            new Relationship('foo', new Meta([]))
        );
    }

    /**
     * The id member is not required when the resource object originates at the client and represents
     * a new resource to be created on the server.
     */
    public function testResourceIdCanBeOmitted()
    {
        $this->assertEncodesTo(
            '{
                "type": "apples",
                "id": null,
                "attributes": {
                    "color": "red"
                }
            }',
            new ResourceObject('apples', null, new Attribute('color', 'red'))
        );
    }
}
