<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\PrimaryData;

use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;

class NullData extends PrimaryData
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