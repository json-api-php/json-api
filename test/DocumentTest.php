<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use JsonApiPhp\JsonApi\DataDocument;
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
use JsonApiPhp\JsonApi\PrimaryData\Resource;
use JsonApiPhp\JsonApi\PrimaryData\ResourceId;

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
                new Resource(
                    'apples',
                    '1',
                    new Meta(['foo' => 'bar']),
                    new Attribute('title', 'Rails is Omakase')
                )
            )
        );
    }
}
