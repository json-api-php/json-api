<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\PrimaryData;

final class Included implements Attachable
{
    /**
     * @var ResourceObject[]
     */
    private $resources = [];

    public function __construct(ResourceObject ...$resources)
    {
        foreach ($resources as $resource) {
            $string_id = $resource->uniqueId();
            if (isset($this->resources[$string_id])) {
                throw new \LogicException("Resource $string_id is already included");
            }
            $this->resources[$string_id] = $resource;
        }
    }

    public function validateLinkage(PrimaryData $data): void
    {
        foreach ($this->resources as $resource) {
            if ($data->identifies($resource)) {
                continue;
            }
            foreach ($this->resources as $anotherResource) {
                if ($resource !== $anotherResource && $anotherResource->identifies($resource)) {
                    continue 2;
                }
            }
            throw new \DomainException('Full linkage required for '.$resource->uniqueId());
        }
    }

    public function attachTo(object $o)
    {
        foreach ($this->resources as $resource) {
            $resource->attachAsIncludedTo($o);
        }
    }
}
