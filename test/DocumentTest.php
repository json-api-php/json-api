<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\EmptySet;
use JsonApiPhp\JsonApi\Error\Error;
use JsonApiPhp\JsonApi\Error\Id;
use JsonApiPhp\JsonApi\ErrorDocument;
use JsonApiPhp\JsonApi\JsonApi;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\Link\Url;
use JsonApiPhp\JsonApi\Meta;
use JsonApiPhp\JsonApi\MetaDocument;
use JsonApiPhp\JsonApi\PrimaryData\Attribute;
use JsonApiPhp\JsonApi\PrimaryData\NullData;
use JsonApiPhp\JsonApi\PrimaryData\ResourceId;
use JsonApiPhp\JsonApi\PrimaryData\ResourceIdSet;
use JsonApiPhp\JsonApi\PrimaryData\ResourceObject;
use JsonApiPhp\JsonApi\PrimaryData\ResourceSet;

class DocumentTest extends BaseTestCase
{
    /**
     * A valid document may contain just a meta object
     */
    public function testMetaDocument()
    {
        $this->assertEncodesTo(
            '
            {
                "meta": {
                    "foo": "bar"
                }
            }
            ',
            new MetaDocument(new Meta(['foo' => 'bar']))
        );
    }

    /**
     * A meta document may contain jsonapi member
     */
    public function testMetaDocumentWithExtraMembers()
    {
        $this->assertEncodesTo(
            '
            {
                "meta": {
                    "foo": "bar"
                },
                "jsonapi": {
                    "version": "1.0"
                }
            }
            ',
            new MetaDocument(
                new Meta(['foo' => 'bar']),
                new JsonApi('1.0')
            )
        );
    }

    public function testErrorDocumentMayContainJustErrors()
    {
        $this->assertEncodesTo(
            '
            {
                "errors": [
                    {
                        "id": "first error"
                    },
                    {
                        "id": "second error"
                    }
                ]
            }
            ',
            new ErrorDocument(
                new Error(new Id('first error')),
                new Error(new Id('second error'))
            )
        );
    }

    public function testErrorDocumentMayContainExtraMembers()
    {
        $this->assertEncodesTo(
            '
            {
                "errors": [
                    {
                        "id": "first error"
                    },
                    {
                        "id": "second error"
                    }
                ],
                "meta": {"foo": "bar"},
                "jsonapi": {
                    "version": "1.0"
                }
            }
            ',
            new ErrorDocument(
                new Error(new Id('first error')),
                new Error(new Id('second error')),
                new Meta(['foo' => 'bar']),
                new JsonApi('1.0')
            )
        );
    }

    public function testNullDocument()
    {
        $this->assertEncodesTo('{"data": null}', new DataDocument(new NullData()));
    }

    public function testNullDocumentWithExtraMembers()
    {
        $this->assertEncodesTo(
            '
            {
                "data": null,
                "meta": {"foo": "bar"},
                "jsonapi": {
                    "version": "1.0"
                },
                "links": {
                    "self": "http://self"
                }
            }
            ',
            new DataDocument(
                new NullData(),
                new Meta(['foo' => 'bar']),
                new JsonApi('1.0'),
                new SelfLink(
                    new Url('http://self')
                )
            )
        );
    }

    public function testSingleResourceIdentifierDocument()
    {
        $this->assertEncodesTo(
            '
            {
                "data": {
                    "type": "apples",
                    "id": "1",
                    "meta": {"foo": "bar"}
                }
            }
            ',
            new DataDocument(
                new ResourceId('apples', '1', new Meta(['foo' => 'bar']))
            )
        );
    }

    public function testSingleResourceObjectDocument()
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
                    "meta": {"foo": "bar"}
                }
            }
            ',
            new DataDocument(
                new ResourceObject(
                    'apples',
                    '1',
                    new Meta(['foo' => 'bar']),
                    new Attribute('title', 'Rails is Omakase')
                )
            )
        );
    }

    public function testEmptySetDocument()
    {
        $this->assertEncodesTo(
            '
            {
                "data": []
            }
            ',
            new DataDocument(
                new EmptySet()
            )
        );
    }

    public function testResourceSetDocument()
    {
        $this->assertEncodesTo(
            '
            {
                "data": [
                    {
                        "type": "apples",
                        "id": "1"
                    },
                    {
                        "type": "pears",
                        "id": "2"
                    }
                ]
            }            ',
            new DataDocument(
                new ResourceSet(
                    new ResourceObject('apples', '1'),
                    new ResourceObject('pears', '2')
                )
            )
        );
    }

    public function testResourceIdSetDocument()
    {
        $this->assertEncodesTo(
            '
            {
                "data": [
                    {
                        "type": "apples",
                        "id": "1"
                    },
                    {
                        "type": "pears",
                        "id": "2"
                    }
                ]
            }            ',
            new DataDocument(
                new ResourceIdSet(
                    new ResourceId('apples', '1'),
                    new ResourceId('pears', '2')
                )
            )
        );
    }
}
