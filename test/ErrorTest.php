<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

use JsonApiPhp\JsonApi\Error;
use JsonApiPhp\JsonApi\Error\Code;
use JsonApiPhp\JsonApi\Error\Detail;
use JsonApiPhp\JsonApi\Error\Id;
use JsonApiPhp\JsonApi\Error\Parameter;
use JsonApiPhp\JsonApi\Error\Pointer;
use JsonApiPhp\JsonApi\Error\Status;
use JsonApiPhp\JsonApi\Error\Title;
use JsonApiPhp\JsonApi\Link\AboutLink;
use JsonApiPhp\JsonApi\Link\Url;
use JsonApiPhp\JsonApi\Meta;
use JsonApiPhp\JsonApi\Test\BaseTestCase;

class ErrorTest extends BaseTestCase
{
    public function testEmptyErrorIsEmptyObject()
    {
        $this->assertEncodesTo('{}', new Error());
    }

    public function testErrorWithFullSetOfProperties()
    {
        $this->assertEncodesTo(
            '
            {
                "id": "test_id",
                "links": {
                    "about":"http://localhost"
                },
                "status": "404",
                "code": "OMG",
                "title": "Error",
                "detail": "Nothing is found",
                "source": {
                    "pointer": "/data",
                    "parameter": "test_param"
                },
                "meta": {
                    "foo":"bar"
                }
            }
            ',
            new Error(
                new Id('test_id'),
                new AboutLink(
                    new Url('http://localhost')
                ),
                new Status('404'),
                new Code('OMG'),
                new Title('Error'),
                new Detail('Nothing is found'),
                new Pointer('/data'),
                new Parameter('test_param'),
                new Meta(['foo' => 'bar'])
            )
        );
    }
}
