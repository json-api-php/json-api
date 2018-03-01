<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\PrimaryData;
use JsonApiPhp\JsonApi\ResourceObject\IdentifierRegistry;

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
            $string_id = $resource->identity();
            if (isset($this->resources[$string_id])) {
                throw new \LogicException("Resource $string_id is already included");
            }
            $this->resources[$string_id] = $resource;
            $resource->registerIn($this->ids);
        }
    }

    public function validateLinkage(PrimaryData $data): void
    {
        $dataRegistry = new IdentifierRegistry();
        $data->registerIn($dataRegistry);
        foreach ($this->resources as $resource) {
            if ($dataRegistry->has($resource->identity()) || $this->ids->has($resource->identity())) {
                continue;
            }
            throw new \LogicException('Full linkage required for '.$resource->identity());
        }
    }

    public function attachTo(object $o)
    {
        foreach ($this->resources as $resource) {
            $resource->attachAsIncludedTo($o);
        }
    }
}
