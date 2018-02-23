<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\ResourceMember;

final class Relationship
    extends AttachableValue
    implements ResourceMember
{
    public function __construct(string $name, RelationshipMember $member, RelationshipMember ...$members)
    {
        parent::__construct($name, combine($member, ...$members));
    }

    public function attachTo(object $o)
    {
        if(empty($o->relationships)) {
            $o->relationships = (object)[];
        }
        parent::attachTo($o->relationships); // TODO: Change the autogenerated stub
    }


}