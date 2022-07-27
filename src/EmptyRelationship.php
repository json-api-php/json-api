<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\RelationshipMember;
use JsonApiPhp\JsonApi\Internal\ResourceField;
use JsonApiPhp\JsonApi\Internal\ResourceFieldTrait;

/**
 * A relationship with no data
 */
class EmptyRelationship implements ResourceField {
    use ResourceFieldTrait;

    private object $obj;

    public function __construct(
        private readonly string $name,
        RelationshipMember $member,
        RelationshipMember ...$members
    ) {
        $this->obj = combine($member, ...$members);
    }

    /**
     * @param object $o
     * @internal
     */
    public function attachTo(object $o): void {
        child($o, 'relationships')->{$this->name} = $this->obj;
    }
}
