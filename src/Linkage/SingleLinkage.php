<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Linkage;

use JsonApiPhp\JsonApi\AttachableValue;
use JsonApiPhp\JsonApi\PrimaryData\Identifier;
use JsonApiPhp\JsonApi\PrimaryData\ResourceIdentifier;
use JsonApiPhp\JsonApi\PrimaryData\ResourceObject;
use JsonApiPhp\JsonApi\RelationshipMember;

final class SingleLinkage extends AttachableValue implements RelationshipMember, Identifier
{
    private $identifier;

    public function __construct(ResourceIdentifier $identifier = null)
    {
        parent::__construct('data', $identifier);
        $this->identifier = $identifier;
    }

    public function identifies(ResourceObject $resource): bool
    {
        return $this->identifier->identifies($resource);
    }
}
