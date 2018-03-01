<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test\DataDocument;

use JsonApiPhp\JsonApi\Attribute;
use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\JsonApi;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\Meta;
use JsonApiPhp\JsonApi\ResourceCollection;
use JsonApiPhp\JsonApi\ResourceObject;
use JsonApiPhp\JsonApi\Test\BaseTestCase;

class ManyResourceObjectsTest extends BaseTestCase
{
    public function testMinimalDocument()
    {
        $this->assertEncodesTo(
            '
            {
                "data": []
            }
            ',
            new DataDocument(
                new ResourceCollection()
            )
        );
    }

    public function testExtendedDocument()
    {
        $this->assertEncodesTo(
            '
            {
                "data": [{
                    "type": "apples",
                    "id": "1",
                    "attributes": {
                        "color": "red",
                        "sort": "Fuji"
                    },
                    "meta": {"apple_meta": "foo"}
                },{
                    "type": "apples",
                    "id": "2",
                    "attributes": {
                        "color": "yellow",
                        "sort": "Gala"
                    },
                    "meta": {"apple_meta": "foo"}
                }],
                "links": {
                    "self": "/apples"
                },
                "jsonapi": {
                    "version": "1.0"
                },
                "meta": {"document_meta": "bar"}
            }
            ',
            new DataDocument(
                new ResourceCollection(
                    new ResourceObject(
                        'apples',
                        '1',
                        new Attribute('color', 'red'),
                        new Attribute('sort', 'Fuji'),
                        new Meta('apple_meta', 'foo')
                    ),
                    new ResourceObject(
                        'apples',
                        '2',
                        new Attribute('color', 'yellow'),
                        new Attribute('sort', 'Gala'),
                        new Meta('apple_meta', 'foo')
                    )
                ),
                new SelfLink('/apples'),
                new JsonApi(),
                new Meta('document_meta', 'bar')
            )
        );
    }
}
