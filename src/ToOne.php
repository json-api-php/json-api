<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\ResourceFieldTrait;
use JsonApiPhp\JsonApi\PrimaryData\ResourceMember;
use JsonApiPhp\JsonApi\ResourceObject\IdentifierRegistry;

final class ToOne implements ResourceMember
{
    use ResourceFieldTrait;

    /**
     * @var ResourceIdentifier
     */
    private $identifier;

    private $val;

    public function __construct(string $name, ResourceIdentifier $identifier, ToOneMember ...$members)
    {
        $this->validateFieldName($name);
        $this->name = $name;
        $this->val = combine($identifier, ...$members);
        $this->identifier = $identifier;
    }

    public function attachTo(object $o)
    {
        child($o, 'relationships')->{$this->name} = $this->val;
    }

    public function registerAsIdentifier(IdentifierRegistry $registry)
    {
        $this->identifier->registerIn($registry);
    }
}
