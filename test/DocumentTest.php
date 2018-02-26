<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\Error;
use JsonApiPhp\JsonApi\Error\Id;
use JsonApiPhp\JsonApi\ErrorDocument;
use JsonApiPhp\JsonApi\JsonApi;
use JsonApiPhp\JsonApi\Link\FirstLink;
use JsonApiPhp\JsonApi\Link\LastLink;
use JsonApiPhp\JsonApi\Link\NextLink;
use JsonApiPhp\JsonApi\Link\PrevLink;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\Link\Url;
use JsonApiPhp\JsonApi\Meta;
use JsonApiPhp\JsonApi\MetaDocument;
use JsonApiPhp\JsonApi\PrimaryData\Attribute;
use JsonApiPhp\JsonApi\PrimaryData\NullData;
use JsonApiPhp\JsonApi\PrimaryData\ResourceIdentifier;
use JsonApiPhp\JsonApi\PrimaryData\ResourceIdentifierSet;
use JsonApiPhp\JsonApi\PrimaryData\ResourceObject;
use JsonApiPhp\JsonApi\PrimaryData\ResourceObjectSet;

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
                new ResourceIdentifier('apples', '1', new Meta(['foo' => 'bar']))
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
                    new Attribute('title', 'Rails is Omakase'),
                    new Meta(['foo' => 'bar'])
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
                new ResourceObjectSet()
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
                new ResourceObjectSet(
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
                new ResourceIdentifierSet(
                    new ResourceIdentifier('apples', '1'),
                    new ResourceIdentifier('pears', '2')
                )
            )
        );
    }

    public function testPagination()
    {
        $this->assertEncodesTo(
            '
            {
                "data": [
                    {"type": "apples", "id": "1"},
                    {"type": "oranges", "id": "1"}
                ],
                "links": {
                    "first": "http://example.com/fruits?page=first",
                    "last": "http://example.com/fruits?page=last",
                    "prev": "http://example.com/fruits?page=3",
                    "next": "http://example.com/fruits?page=5"
                }
            }
            ',
            new DataDocument(
                new ResourceObjectSet(
                    new ResourceObject('apples', '1'),
                    new ResourceObject('oranges', '1')
                ),
                new FirstLink(new Url('http://example.com/fruits?page=first')),
                new LastLink(new Url('http://example.com/fruits?page=last')),
                new PrevLink(new Url('http://example.com/fruits?page=3')),
                new NextLink(new Url('http://example.com/fruits?page=5'))
            )
        );
    }
}
