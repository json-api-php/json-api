<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use JsonApiPhp\JsonApi\JsonApi;
use JsonApiPhp\JsonApi\Meta;
use JsonApiPhp\JsonApi\MetaDocument;

class JsonApiTest extends BaseTestCase
{
    public function testJsonApiMayContainVersionAndMeta()
    {
        $this->assertEncodesTo(
            '
            {
                "meta": {
                    "test": "test"
                },
                "jsonapi": {
                    "version": "1.0",
                    "meta": {
                        "foo": "bar"
                    }
                }
            }
            ',
            new MetaDocument(
                new Meta('test', 'test'),
                new JsonApi('1.0', new Meta('foo', 'bar'))
            )
        );
    }
}
