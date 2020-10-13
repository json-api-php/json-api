<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use JsonApiPhp\JsonApi\Attribute;
use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\EmptyRelationship;
use JsonApiPhp\JsonApi\Link\RelatedLink;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\Meta;
use JsonApiPhp\JsonApi\NewResourceObject;
use JsonApiPhp\JsonApi\ResourceIdentifier;
use JsonApiPhp\JsonApi\ResourceIdentifierCollection;
use JsonApiPhp\JsonApi\ToMany;
use JsonApiPhp\JsonApi\ToNull;
use JsonApiPhp\JsonApi\ToOne;

class NewResourceObjectTest extends BaseTestCase
{
    public function testFullFledgedResourceObject()
    {
        $this->assertEncodesTo(
            '
            {
                "data": {
                    "type": "apples",
                    "attributes": {
                        "title": "Rails is Omakase"
                    },
                    "meta": {"foo": "bar"},
                    "relationships": {
                        "author": {
                            "meta": {"foo": "bar"},
                            "data": null
                        }
                    }
                }
            }
            ',
            new DataDocument(
                new NewResourceObject(
                    'apples',
                    new Meta('foo', 'bar'),
                    new Attribute('title', 'Rails is Omakase'),
                    new ToNull(
                        'author',
                        new Meta('foo', 'bar')
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
                    "relationships": {
                        "content": {
                            "data": {"type": "apples", "id": "1"}
                        }
                    }
                }
            }
            ',
            new DataDocument(
                new NewResourceObject(
                    'basket',
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
                new NewResourceObject(
                    'basket',
                    new ToMany(
                        'content',
                        new ResourceIdentifierCollection(
                            new ResourceIdentifier('apples', '1'),
                            new ResourceIdentifier('pears', '2')
                        )
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
                    "relationships": {
                        "content": {
                            "data": []
                        }
                    }
                }
            }
            ',
            new DataDocument(
                new NewResourceObject(
                    'basket',
                    new ToMany('content', new ResourceIdentifierCollection())
                )
            )
        );
    }

    public function testRelationshipWithNoData()
    {
        $this->assertEncodesTo(
            '
            {
                "data": {
                    "type": "basket",
                    "relationships": {
                        "empty": {
                            "links": {
                                "related": "/foo"
                            }
                        }
                    }
                }
            }
            ',
            new DataDocument(
                new NewResourceObject(
                    'basket',
                    new EmptyRelationship('empty', new RelatedLink('/foo'))
                )
            )
        );

        $this->assertEncodesTo(
            '
            {
                "data": {
                    "type": "basket",
                    "relationships": {
                        "empty": {
                            "links": {
                                "related": "/foo",
                                "self": "/bar"
                            },
                            "meta": {
                                "foo": "bar"
                            }
                        }
                    }
                }
            }
            ',
            new DataDocument(
                new NewResourceObject(
                    'basket',
                    new EmptyRelationship('empty', new RelatedLink('/foo'), new SelfLink('/bar'), new Meta('foo', 'bar'))
                )
            )
        );
    }

    public function testResourceFieldsMustBeUnique()
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage("Field 'foo' already exists");
        new NewResourceObject(
            'apples',
            new Attribute('foo', 'bar'),
            new ToOne('foo', new ResourceIdentifier('apples', '1'))
        );
    }

    public function testNameValidation()
    {
        $this->expectException(\DomainException::class);
        new NewResourceObject('invalid:id');
    }
}
