<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\ResourceMember;

final class Relationship
    extends AttachableValue
    implements ResourceMember
{
    public function __construct(RelationshipMember $member, RelationshipMember ...$members)
    {
        parent::__construct('relationships', combine($member, ...$members));
    }
}