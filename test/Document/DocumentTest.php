<?php
/**
 *  This file is part of JSON:API implementation for PHP.
 *
 *  (c) Alexey Karapetov <karapetov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test\Document;

use JsonApiPhp\JsonApi\Document;
use JsonApiPhp\JsonApi\Document\Error;
use JsonApiPhp\JsonApi\Document\Meta;
use JsonApiPhp\JsonApi\Document\Resource\NullResource;
use JsonApiPhp\JsonApi\Document\Resource\ResourceIdentifier;
use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;
use JsonApiPhp\JsonApi\Test\BaseTestCase;
use JsonApiPhp\JsonApi\Test\Document\Resource\Relationship\LinkageTest;
use JsonApiPhp\JsonApi\Test\Document\Resource\ResourceTest;

/**
 * This is the JSON document's top level object
 */
class DocumentTest extends BaseTestCase
{
    /**
     * A valid document may contain just a meta object.
     */
    public function testDocumentMayContainJustMeta()
    {
        $this->assertEncodesTo(
            '
            {
                "meta": {
                    "foo": "bar"
                }
            }
            ',
            Document::fromMeta(
                Meta::fromArray(['foo' => 'bar'])
            )
        );
    }

    /**
     * A valid document may contain just an array of errors.
     * The array of errors may even be empty, the documentation does not explicitly restrict it.
     */
    public function testDocumentMayContainJustErrors()
    {
        $this->assertEncodesTo(
            '
            {
                "errors": [
                    {
                        "id": "first"
                    }
                ]
            }
            ',
            Document::fromErrors(new Error('first'))
        );

        $this->assertEncodesTo(
            '
            {
                "errors": []
            }
            ',
            Document::fromErrors()
        );
    }

    /**
     * A valid document may contain just a primary data object.
     * The primary data object is represented by ResourceInterface (@see ResourceTest for details).
     * Here is how a document can be created from different kinds of resources:
     * - null resource
     * - resource identifier
     * - full-fledged resource object
     * - an array of resource objects/identifiers
     */
    public function testDocumentMayContainJustData()
    {
        $this->assertEncodesTo(
            '
            {
                "data": null
            }
            ',
            Document::fromResource(new NullResource),
            'The simplest document possible contains null'
        );

        $this->assertEncodesTo(
            '
            {
                "data": {
                    "type": "books",
                    "id": "abc123"
                }
            }        
            ',
            Document::fromResource(new ResourceIdentifier('books', 'abc123')),
            'Resource identifier can be used as primary data'
        );

        $apple = new ResourceObject('apples', '007');
        $apple->setAttribute('color', 'red');
        $this->assertEncodesTo(
            '
            {
                "data": {
                    "type": "apples",
                    "id": "007",
                    "attributes": {
                        "color": "red"
                    }
                }
            }        
            ',
            Document::fromResource($apple),
            'Full-fledged resource object'
        );

        $this->assertEncodesTo(
            '
            {
                "data": [
                    {
                        "type": "books",
                        "id": "12"
                    },
                    {
                        "type": "carrots",
                        "id": "42"
                    }
                ]
            }
            ',
            Document::fromResources(
                new ResourceIdentifier('books', '12'),
                new ResourceIdentifier('carrots', '42')
            ),
            'An array of resource identifiers'
        );
    }

    /**
     * When a document is created, it is possible to add more stuff to it:
     * - API details
     * - meta
     * - links (@see LinkageTest for details)
     */
    public function testDocumentCanHaveExtraProperties()
    {
        $doc = Document::fromResource(
            new ResourceIdentifier('apples', '42')
        );
        $doc->setApiVersion('1.0');
        $doc->setApiMeta(['a' => 'b']);
        $doc->setMeta(Meta::fromArray(['test' => 'test']));
        $doc->setLink('self', 'http://example.com/self');
        $doc->setLink('related', 'http://example.com/rel', ['foo' => 'bar']);
        $this->assertEncodesTo(
            '
            {
                "data": {
                    "type": "apples",
                    "id": "42"
                },
                "meta": {
                    "test": "test"
                },
                "jsonapi": {
                    "version": "1.0",
                    "meta": {
                        "a": "b"
                    }
                },
                "links": {
                    "self": "http://example.com/self",
                    "related": {
                        "href": "http://example.com/rel",
                        "meta": {
                            "foo": "bar"
                        }
                    }
                }
            }
            ',
            $doc
        );
    }
}
