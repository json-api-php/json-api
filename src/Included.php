<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\Attachable;
use JsonApiPhp\JsonApi\Internal\IdentifierRegistry;
use JsonApiPhp\JsonApi\Internal\PrimaryData;

final class Included implements Attachable
{
    /**
     * @var ResourceObject[]
     */
    private $resources = [];

    private $ids;

    public function __construct(ResourceObject ...$resources)
    {
        $this->ids = new IdentifierRegistry();
        foreach ($resources as $resource) {
            $key = $resource->key();
            if (isset($this->resources[$key])) {
                throw new \LogicException("Resource $key is already included");
            }
            $this->resources[$key] = $resource;
            $resource->registerIn($this->ids);
        }
    }

    public function validateLinkage(PrimaryData $data): void
    {
        $registry = new IdentifierRegistry();
        $data->registerIn($registry);
        foreach ($this->resources as $resource) {
            if ($registry->has($resource->key()) || $this->ids->has($resource->key())) {
                continue;
            }
            throw new \LogicException('Full linkage required for '.$resource->key());
        }
    }

    public function attachTo(object $o): void
    {
        foreach ($this->resources as $resource) {
            $resource->attachAsIncludedTo($o);
        }
    }
}
