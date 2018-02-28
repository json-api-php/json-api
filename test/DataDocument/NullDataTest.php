<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test\DataDocument;

use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\JsonApi;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\Meta;
use JsonApiPhp\JsonApi\NullData;
use JsonApiPhp\JsonApi\Test\BaseTestCase;

class NullDataTest extends BaseTestCase
{
    public function testMinimalDocument()
    {
        $this->assertEncodesTo(
            '
            {
                "data": null
            }
            ',
            new DataDocument(
                new NullData()
            )
        );
    }

    public function testExtendedDocument()
    {
        $this->assertEncodesTo(
            '
            {
                "data": null,
                "links": {
                    "self": "/apples/1"
                },
                "jsonapi": {
                    "version": "1.0"
                },
                "meta": {"document_meta": "bar"}
            }
            ',
            new DataDocument(
                new NullData(),
                new SelfLink('/apples/1'),
                new JsonApi(),
                new Meta('document_meta', 'bar')
            )
        );
    }
}
