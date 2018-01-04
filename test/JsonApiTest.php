<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use JsonApiPhp\JsonApi\Document\JsonApi;
use JsonApiPhp\JsonApi\Document\JsonApi\Version;
use JsonApiPhp\JsonApi\Document\Meta;

class JsonApiTest extends BaseTestCase
{
    public function testJsonApiMeyContainVersionAndMeta()
    {
        $this->assertEncodesTo(
            '
            {
                "version": "1.0",
                "meta": {
                    "foo": "bar"
                }
            }
            ',
            new JsonApi(new Version('1.0'), new Meta(['foo' => 'bar']))
        );
    }
}
