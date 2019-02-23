<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\RelationshipMember;
use JsonApiPhp\JsonApi\Internal\ResourceField;
use JsonApiPhp\JsonApi\Internal\ResourceFieldTrait;

/**
 * A relationship with no data
 */
class EmptyRelationship implements ResourceField
{
    use ResourceFieldTrait;

    private $obj;

    public function __construct(string $name, RelationshipMember $member, RelationshipMember ...$members)
    {
        $this->name = $name;
        $this->obj = combine($member, ...$members);
    }

    /**
     * @param object $o
     */
    public function attachTo($o): void
    {
        child($o, 'relationships')->{$this->name} = $this->obj;
    }
}
