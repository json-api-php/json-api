<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use JsonApiPhp\JsonApi\Link\RelatedLink;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\Link\Url;
use JsonApiPhp\JsonApi\Linkage\NullLinkage;
use JsonApiPhp\JsonApi\Meta;
use JsonApiPhp\JsonApi\PrimaryData\Attribute;
use JsonApiPhp\JsonApi\PrimaryData\ResourceObject;
use JsonApiPhp\JsonApi\Relationship;

class ResourceObjectTest extends BaseTestCase
{
    public function testFullFledgedResourceObject()
    {
        $this->assertEncodesTo(
            '
            {
                "type": "apples",
                "id": "1",
                "attributes": {
                    "title": "Rails is Omakase"
                },
                "meta": {"foo": "bar"},
                "links": {
                    "self": "http://self"
                },
                "relationships": {
                    "author": {
                        "meta": {"foo": "bar"},
                        "links": {
                            "self": "http://rel/author",
                            "related": "http://author"
                        },
                        "data": null
                    }
                }
            }
            ',
            new ResourceObject(
                'apples',
                '1',
                new Meta(['foo' => 'bar']),
                new Attribute('title', 'Rails is Omakase'),
                new SelfLink(new Url('http://self')),
                new Relationship(
                    'author',
                    new Meta(['foo' => 'bar']),
                    new SelfLink(new Url('http://rel/author')),
                    new RelatedLink(new Url('http://author')),
                    new NullLinkage()
                )
            )
        );

    }

}
