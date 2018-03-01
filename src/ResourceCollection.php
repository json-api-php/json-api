<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\IdentifierRegistry;
use JsonApiPhp\JsonApi\Internal\PrimaryData;

class ResourceCollection implements PrimaryData
{
    /**
     * @var ResourceObject[]
     */
    private $resources;

    public function __construct(ResourceObject ...$resources)
    {
        $this->resources = $resources;
    }

    public function attachTo(object $o)
    {
        $o->data = [];
        foreach ($this->resources as $resource) {
            $resource->attachToCollection($o);
        }
    }

    public function registerIn(IdentifierRegistry $registry)
    {
        foreach ($this->resources as $resource) {
            $resource->registerIn($registry);
        }
    }
}
