<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\PrimaryData;

use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;

final class SingleResourceData implements PrimaryDataInterface
{
    private $resource;

    public function __construct(ResourceObject $resource)
    {
        $this->resource = $resource;
    }

    public function hasLinkTo(ResourceObject $resource): bool
    {
        return $this->resource->identifies($resource);
    }

    public function jsonSerialize()
    {
        return $this->resource;
    }
}
