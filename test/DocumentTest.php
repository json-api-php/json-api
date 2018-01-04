<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use JsonApiPhp\JsonApi\Document\JsonApi;
use JsonApiPhp\JsonApi\Document\JsonApi\Version;
use JsonApiPhp\JsonApi\Document\Link\SelfLink;
use JsonApiPhp\JsonApi\Document\Link\Url;
use JsonApiPhp\JsonApi\Document\Links;
use JsonApiPhp\JsonApi\Document\Meta;
use JsonApiPhp\JsonApi\MetaDocument;
use JsonApiPhp\JsonApi\NullDocument;

class DocumentTest extends BaseTestCase
{
    /**
     * A valid document may contain just a meta object.
     */
    public function testDocumentMayContainJustMeta()
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
    public function testMetaDocumentMayContainJsonApiMember()
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
                new JsonApi(new Version('1.0'))
            )
        );
    }

    public function testNullDocument()
    {
        $this->assertEncodesTo('{"data": null}', new NullDocument());
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
            new NullDocument(
                new Meta((object)['foo' => 'bar']),
                new JsonApi(new Version('1.0')),
                new Links(
                    new SelfLink(
                        new Url('http://self')
                    )
                )
            )
        );
    }

}