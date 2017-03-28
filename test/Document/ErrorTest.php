<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

use JsonApiPhp\JsonApi\Test\HasAssertEqualsAsJson;
use PHPUnit\Framework\TestCase;

class ErrorTest extends TestCase
{
    use HasAssertEqualsAsJson;

    public function testEmptyErrorIsEmptyObject()
    {
        $this->assertEquals('{}', json_encode(new Error()));
    }

    public function testErrorWithFullSetOfProperties()
    {
        $e = new Error();
        $e->setId('test_id');
        $e->setAboutLink('http://localhost');
        $e->setStatus('404');
        $e->setCode('OMG');
        $e->setTitle('Error');
        $e->setDetail('Nothing is found');
        $e->setSourcePointer('/data');
        $e->setSourceParameter('test_param');
        $e->setMeta('foo', 'bar');

        $this->assertEqualsAsJson(
            [
                'id' => 'test_id',
                'links' => [
                    'about' => 'http://localhost',
                ],
                'status' => '404',
                'code' => 'OMG',
                'title' => 'Error',
                'detail' => 'Nothing is found',
                'source' => [
                    'pointer' => '/data',
                    'parameter' => 'test_param',
                ],
                'meta' => [
                    'foo' => 'bar'
                ]
            ],
            $e
        );
    }
}
