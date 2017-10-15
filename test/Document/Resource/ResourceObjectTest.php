<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Test\Document\Resource;

use JsonApiPhp\JsonApi\Document\Meta;
use JsonApiPhp\JsonApi\Document\Resource\Linkage\SingleLinkage;
use JsonApiPhp\JsonApi\Document\Resource\Relationship;
use JsonApiPhp\JsonApi\Document\Resource\ResourceIdentifier;
use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;
use JsonApiPhp\JsonApi\Test\BaseTestCase;

/**
 * Resource Objects
 *
 * @see http://jsonapi.org/format/#document-resource-objects
 */
class ResourceObjectTest extends BaseTestCase
{
    /**
     * The id member is not required when the resource object originates at the client
     * and represents a new resource to be created on the server.
     */
    public function testResourceObjectIdIsOptional()
    {
        $this->assertEncodesTo('{"type": "books"}', new ResourceObject('books'));
    }

    /**
     * In addition, a resource object MAY contain any of these top-level members:
     *
     * - attributes: an attributes object representing some of the resource’s data.
     *
     * - relationships: a relationships object describing relationships
     *   between the resource and other JSON API resources.
     *
     * - links: a links object containing links related to the resource.
     *
     * - meta: a meta object containing non-standard meta-information about a resource
     *   that can not be represented as an attribute or relationship.
     */
    public function testResourceObjectMayContainAttributes()
    {
        $apple = new ResourceObject('apples', '1');
        $apple->setAttribute('color', 'red');
        $this->assertEncodesTo('{"type":"apples", "id":"1", "attributes":{"color":"red"}}', $apple);
    }

    public function testResourceObjectMayContainRelationships()
    {
        $article = new ResourceObject('articles', '1');
        $user = new ResourceIdentifier('users', '42');
        $article->setRelationship('author', Relationship::fromLinkage(new SingleLinkage($user)));
        $this->assertEncodesTo(
            '
            {
                "type":"articles", 
                "id":"1",
                "relationships":{
                    "author":{
                        "data":{
                            "type":"users",
                            "id":"42"
                        }
                    }
                }
            }
            ',
            $article
        );
    }

    public function testResourceObjectMayContainLinks()
    {
        $article = new ResourceObject('articles', '1');
        $article->setLink('self', 'https://example.com');
        $this->assertEncodesTo(
            '
            {
                "type":"articles", 
                "id":"1",
                "links":{
                    "self":"https://example.com"
                }
            }
            ',
            $article
        );
    }

    public function testResourceObjectMayContainMeta()
    {
        $article = new ResourceObject('articles', '1');
        $article->setMeta(Meta::fromArray(['tags' => ['cool', 'new']]));
        $this->assertEncodesTo(
            '
            {
                "type":"articles", 
                "id":"1",
                "meta":{
                    "tags":[
                        "cool",
                        "new"
                    ]
                }
            }
            ',
            $article
        );
    }
}
