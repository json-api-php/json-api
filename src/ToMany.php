<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\Identifier;
use JsonApiPhp\JsonApi\Internal\IdentifierRegistry;
use JsonApiPhp\JsonApi\Internal\RelationshipMember;
use JsonApiPhp\JsonApi\Internal\ResourceField;
use JsonApiPhp\JsonApi\Internal\ResourceFieldTrait;

final class ToMany implements Identifier, ResourceField
{
    use ResourceFieldTrait;
    /**
     * @var RelationshipMember[]
     */
    private $members;
    /**
     * @var ResourceIdentifierCollection
     */
    private $collection;

    public function __construct(string $name, ResourceIdentifierCollection $collection, RelationshipMember ...$members)
    {
        $this->validateFieldName($name);
        $this->name = $name;
        $this->members = $members;
        $this->collection = $collection;
    }

    public function attachTo(object $o): void
    {
        $rel = child(child($o, 'relationships'), $this->name);
        $rel->data = [];
        $this->collection->attachTo($rel);
        foreach ($this->members as $member) {
            $member->attachTo($rel);
        }
    }

    public function registerIn(IdentifierRegistry $registry)
    {
        $this->collection->registerIn($registry);
    }
}
