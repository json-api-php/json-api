<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\Identifier;
use JsonApiPhp\JsonApi\Internal\ResourceField;
use JsonApiPhp\JsonApi\Internal\ResourceFieldTrait;
use JsonApiPhp\JsonApi\Internal\ToOneMember;

final class ToMany implements Identifier, ResourceField
{
    use ResourceFieldTrait;
    /**
     * @var ToOneMember[]
     */
    private $members;
    /**
     * @var ResourceIdentifierCollection
     */
    private $collection;

    public function __construct(string $name, ResourceIdentifierCollection $collection, ToOneMember ...$members)
    {
        $this->validateFieldName($name);
        $this->name = $name;
        $this->members = $members;
        $this->collection = $collection;
    }

    /**
     * @param object $o
     */
    public function attachTo($o): void
    {
        $rel = child(child($o, 'relationships'), $this->name);
        $rel->data = [];
        $this->collection->attachTo($rel);
        foreach ($this->members as $member) {
            $member->attachTo($rel);
        }
    }

    public function registerIn(array &$registry): void
    {
        $this->collection->registerIn($registry);
    }
}
