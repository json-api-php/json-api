<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\Identifier;
use JsonApiPhp\JsonApi\Internal\RelationshipMember;
use JsonApiPhp\JsonApi\Internal\ResourceField;
use JsonApiPhp\JsonApi\Internal\ResourceFieldTrait;

final class ToOne implements Identifier, ResourceField
{
    use ResourceFieldTrait;

    /**
     * @var ResourceIdentifier
     */
    private $identifier;

    private $obj;

    public function __construct(string $name, ResourceIdentifier $identifier, RelationshipMember ...$members)
    {
        $this->validateFieldName($name);
        $this->name = $name;
        $this->obj = combine($identifier, ...$members);
        $this->identifier = $identifier;
    }

    public function attachTo(object $o): void
    {
        child($o, 'relationships')->{$this->name} = $this->obj;
    }

    public function registerIn(array &$registry): void
    {
        $this->identifier->registerIn($registry);
    }
}
