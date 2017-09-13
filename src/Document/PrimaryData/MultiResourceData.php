<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\PrimaryData;

use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;

final class MultiResourceData implements PrimaryDataInterface
{
    private $resources;

    public function __construct(ResourceObject ...$resources)
    {
        $this->resources = $resources;
    }

    public function hasLinkTo(ResourceObject $resource): bool
    {
        foreach ($this->resources as $myResource) {
            if ($myResource->identifies($resource)) {
                return true;
            }
        }
        return false;
    }

    public function jsonSerialize()
    {
        return $this->resources;
    }
}
