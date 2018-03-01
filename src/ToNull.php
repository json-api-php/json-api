<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\ResourceFieldTrait;
use JsonApiPhp\JsonApi\PrimaryData\ResourceMember;
use JsonApiPhp\JsonApi\ResourceObject\IdentifierRegistry;

final class ToNull implements ResourceMember
{
    use ResourceFieldTrait;
    /**
     * @var ToOneMember[]
     */
    private $members;

    public function __construct(string $name, ToOneMember ...$members)
    {
        $this->validateFieldName($name);
        $this->name = $name;
        $this->members = $members;
    }

    public function attachTo(object $o)
    {
        $val = combine(...$this->members);
        $val->data = null;
        child($o, 'relationships')->{$this->name} = $val;
    }

    public function registerAsIdentifier(IdentifierRegistry $registry)
    {
    }
}
