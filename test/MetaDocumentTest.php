<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use JsonApiPhp\JsonApi\JsonApi;
use JsonApiPhp\JsonApi\Meta;
use JsonApiPhp\JsonApi\MetaDocument;

class MetaDocumentTest extends BaseTestCase
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
            new MetaDocument(new Meta('foo', 'bar'))
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
                new Meta('foo', 'bar'),
                new JsonApi()
            )
        );
    }
}
