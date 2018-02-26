<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use JsonApiPhp\JsonApi\Link\LinkObject;
use JsonApiPhp\JsonApi\Meta;

class LinkTest extends BaseTestCase
{
    public function testLinkObject()
    {
        $this->assertEncodesTo(
            '
            {
                "href": "http://example.com",
                "meta": {
                    "foo": "bar"
                }
            }
            ',
            new LinkObject('http://example.com', new Meta(['foo' => 'bar']))
        );
    }

}
