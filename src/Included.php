<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\Attachable;
use JsonApiPhp\JsonApi\Internal\PrimaryData;

final class Included implements Attachable
{
    /**
     * @var ResourceObject[]
     */
    private $resources = [];

    private $identifiers = [];

    public function __construct(ResourceObject ...$resources)
    {
        foreach ($resources as $resource) {
            $key = $resource->key();
            if (isset($this->resources[$key])) {
                throw new \LogicException("Resource $resource is already included");
            }
            $this->resources[$key] = $resource;
            $resource->registerIn($this->identifiers);
        }
    }

    public function validateLinkage(PrimaryData $data): void
    {
        $registry = [];
        $data->registerIn($registry);
        foreach ($this->resources as $resource) {
            if (isset($registry[$resource->key()]) || isset($this->identifiers[$resource->key()])) {
                continue;
            }
            throw new \LogicException('Full linkage required for '.$resource);
        }
    }

    /**
     * @param object $o
     */
    public function attachTo($o): void
    {
        foreach ($this->resources as $resource) {
            $resource->attachAsIncludedTo($o);
        }
    }
}
