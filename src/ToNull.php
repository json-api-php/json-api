<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\IdentifierRegistry;
use JsonApiPhp\JsonApi\Internal\ResourceFieldTrait;
use JsonApiPhp\JsonApi\Internal\ResourceMember;
use JsonApiPhp\JsonApi\Internal\ToOneMember;

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
        $obj = combine(...$this->members);
        $obj->data = null;
        child($o, 'relationships')->{$this->name} = $obj;
    }

    public function registerIn(IdentifierRegistry $registry)
    {
    }
}
