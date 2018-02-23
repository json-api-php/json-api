<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\ResourceField;

final class Relationship extends ResourceField
{
    public function __construct(string $key, RelationshipMember $member, RelationshipMember ...$members)
    {
        parent::__construct($key, combine($member, ...$members));
    }

    public function attachTo(object $o)
    {
        if (empty($o->relationships)) {
            $o->relationships = (object)[];
        }
        parent::attachTo($o->relationships);
    }
}
