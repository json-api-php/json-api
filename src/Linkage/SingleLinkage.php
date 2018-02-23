<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Linkage;

use JsonApiPhp\JsonApi\AttachableValue;
use JsonApiPhp\JsonApi\PrimaryData\ResourceId;
use JsonApiPhp\JsonApi\RelationshipMember;

class SingleLinkage extends AttachableValue implements RelationshipMember
{
    public function __construct(ResourceId $resource = null)
    {
        parent::__construct('data', $resource);
    }
}
