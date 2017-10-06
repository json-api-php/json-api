<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Resource\Linkage;

use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;

final class NullLinkage implements LinkageInterface
{
    public function isLinkedTo(ResourceObject $resource): bool
    {
        return false;
    }

    public function jsonSerialize()
    {
        return null;
    }
}
