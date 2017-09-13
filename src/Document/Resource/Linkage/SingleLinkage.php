<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Resource\Linkage;

use JsonApiPhp\JsonApi\Document\Resource\ResourceIdentifier;
use JsonApiPhp\JsonApi\Document\Resource\ResourceObject;

final class SingleLinkage implements LinkageInterface
{
    private $identifier;

    public function __construct(ResourceIdentifier $identifier)
    {
        $this->identifier = $identifier;
    }

    public function isLinkedTo(ResourceObject $resource): bool
    {
        return $this->identifier->identifies($resource);
    }

    public function jsonSerialize()
    {
        return $this->identifier;
    }
}
