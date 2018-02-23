<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Linkage;

use JsonApiPhp\JsonApi\AttachableValue;
use JsonApiPhp\JsonApi\RelationshipMember;

class NullLinkage
    extends AttachableValue
    implements RelationshipMember
{
    public function __construct()
    {
        parent::__construct('data', null);
    }
}