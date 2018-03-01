<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test;

use JsonApiPhp\JsonApi\Error;
use JsonApiPhp\JsonApi\Error\Code;
use JsonApiPhp\JsonApi\Error\Detail;
use JsonApiPhp\JsonApi\Error\Id;
use JsonApiPhp\JsonApi\Error\SourceParameter;
use JsonApiPhp\JsonApi\Error\SourcePointer;
use JsonApiPhp\JsonApi\Error\Status;
use JsonApiPhp\JsonApi\Error\Title;
use JsonApiPhp\JsonApi\ErrorDocument;
use JsonApiPhp\JsonApi\JsonApi;
use JsonApiPhp\JsonApi\Link\AboutLink;
use JsonApiPhp\JsonApi\Meta;

class ErrorDocumentTest extends BaseTestCase
{
    /**
     * The spec does not define any mandatory error members,
     * so the minimal valid error document contains a single empty object
     */
    public function testMinimalExample()
    {
        $this->assertEncodesTo(
            '
            {
                "errors": [{}]
            }
            ',
            new ErrorDocument(
                new Error()
            )
        );
    }

    public function testExtensiveExample()
    {
        $this->assertEncodesTo(
            '
            {
                "errors": [{
                    "id": "1",
                    "links": {
                        "about":"/errors/not_found"
                    },
                    "status": "404",
                    "code": "not_found",
                    "title": "Resource not found",
                    "detail": "We tried hard but could not find anything",
                    "source": {
                        "pointer": "/data",
                        "parameter": "query_string"
                    },
                    "meta": {
                        "purpose":"test"
                    }
                }],
                "meta": {"purpose": "test"},
                "jsonapi": {
                    "version": "1.0"
                }
            }
            ',
            new ErrorDocument(
                new Error(
                    new Id('1'),
                    new AboutLink('/errors/not_found'),
                    new Status('404'),
                    new Code('not_found'),
                    new Title('Resource not found'),
                    new Detail('We tried hard but could not find anything'),
                    new SourcePointer('/data'),
                    new SourceParameter('query_string'),
                    new Meta('purpose', 'test')
                ),
                new Meta('purpose', 'test'),
                new JsonApi()
            )
        );
    }

    public function testMultipleErrors()
    {
        $this->assertEncodesTo(
            '
            {
                "errors": [{
                    "id": "1",
                    "code": "invalid_parameter",
                    "source": {
                        "parameter": "foo"
                    }
                },{
                    "id": "2",
                    "code": "invalid_parameter",
                    "source": {
                        "parameter": "bar"
                    }
                }]
            }
            ',
            new ErrorDocument(
                new Error(
                    new Id('1'),
                    new Code('invalid_parameter'),
                    new SourceParameter('foo')
                ),
                new Error(
                    new Id('2'),
                    new Code('invalid_parameter'),
                    new SourceParameter('bar')
                )
            )
        );
    }
}
