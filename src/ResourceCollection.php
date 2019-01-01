<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\Collection;
use JsonApiPhp\JsonApi\Internal\PrimaryData;

class ResourceCollection implements PrimaryData, Collection
{
    /**
     * @var ResourceObject[]
     */
    private $resources;

    public function __construct(ResourceObject ...$resources)
    {
        $this->resources = $resources;
    }

    /**
     * @param object $o
     */
    public function attachTo($o): void
    {
        $o->data = [];
        foreach ($this->resources as $resource) {
            $resource->attachToCollection($o);
        }
    }

    public function registerIn(array &$registry): void
    {
        foreach ($this->resources as $resource) {
            $resource->registerIn($registry);
        }
    }
}
