<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\Identifier;
use JsonApiPhp\JsonApi\PrimaryData\ResourceField;

final class Relationship extends ResourceField implements Identifier
{
    private $members = [];

    public function __construct(string $key, RelationshipMember $member, RelationshipMember ...$members)
    {
        parent::__construct($key, combine($member, ...$members));
        $this->members = [$member] + $members;
    }

    public function attachTo(object $o)
    {
        parent::attachTo(child($o, 'relationships'));
    }

    public function identifies(ResourceObject $resource): bool
    {
        foreach ($this->members as $member) {
            if ($member instanceof Identifier && $member->identifies($resource)) {
                return true;
            }
        }
        return false;
    }
}
