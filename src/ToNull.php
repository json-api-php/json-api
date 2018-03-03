<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\RelationshipMember;
use JsonApiPhp\JsonApi\Internal\ResourceField;
use JsonApiPhp\JsonApi\Internal\ResourceFieldTrait;

final class ToNull implements ResourceField
{
    use ResourceFieldTrait;
    /**
     * @var RelationshipMember[]
     */
    private $members;

    public function __construct(string $name, RelationshipMember ...$members)
    {
        $this->validateFieldName($name);
        $this->name = $name;
        $this->members = $members;
    }

    public function attachTo(object $o): void
    {
        $obj = combine(...$this->members);
        $obj->data = null;
        child($o, 'relationships')->{$this->name} = $obj;
    }
}
