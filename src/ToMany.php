<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\Identifier;
use JsonApiPhp\JsonApi\Internal\ResourceField;
use JsonApiPhp\JsonApi\Internal\ResourceFieldTrait;
use JsonApiPhp\JsonApi\Internal\ToManyMember;

final class ToMany implements Identifier, ResourceField {
    use ResourceFieldTrait;

    /**
     * @var ToManyMember[]
     */
    private readonly array $members;

    public function __construct(
        string $name,
        private readonly ResourceIdentifierCollection $collection,
        ToManyMember ...$members
    ) {
        $this->validateFieldName($name);
        $this->name = $name;
        $this->members = $members;
    }

    /**
     * @param object $o
     * @internal
     */
    public function attachTo(object $o): void {
        $rel = child(child($o, 'relationships'), $this->name);
        $rel->data = [];
        $this->collection->attachTo($rel);
        foreach ($this->members as $member) {
            $member->attachTo($rel);
        }
    }
}
