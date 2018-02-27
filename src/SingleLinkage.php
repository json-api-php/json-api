<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\Identifier;

final class SingleLinkage implements RelationshipMember, Identifier
{
    private $identifier;

    public function __construct(ResourceIdentifier $identifier = null)
    {
        $this->identifier = $identifier;
    }

    public function identifies(ResourceObject $resource): bool
    {
        return $this->identifier && $this->identifier->identifies($resource);
    }

    public function attachTo(object $o)
    {
        $o->data = $this->identifier;
    }

    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
    }
}
