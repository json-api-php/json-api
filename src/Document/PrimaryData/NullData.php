<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\PrimaryData;

use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;

final class NullData implements PrimaryDataInterface
{
    public function hasLinkTo(ResourceObject $resource): bool
    {
        return false;
    }

    public function jsonSerialize()
    {
        return null;
    }
}
