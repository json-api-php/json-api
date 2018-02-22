<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use JsonApiPhp\JsonApi\Document\JsonApi\Version;
use JsonApiPhp\JsonApi\JsonApi;
use JsonApiPhp\JsonApi\Meta;

class JsonApiTest extends BaseTestCase
{
    public function testJsonApiMayContainVersionAndMeta()
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
            new JsonApi('1.0', new Meta(['foo' => 'bar']))
        );
    }
}
