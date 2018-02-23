<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Linkage;

use JsonApiPhp\JsonApi\AttachableValue;
use JsonApiPhp\JsonApi\PrimaryData\ResourceId;
use JsonApiPhp\JsonApi\RelationshipMember;

class MultiLinkage
    extends AttachableValue
    implements RelationshipMember
{
    public function __construct(ResourceId ...$resources)
    {
        parent::__construct('data', $resources);
    }
}