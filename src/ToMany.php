<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\Identifier;
use JsonApiPhp\JsonApi\Internal\IdentifierRegistry;
use JsonApiPhp\JsonApi\Internal\ResourceFieldTrait;
use JsonApiPhp\JsonApi\Internal\ResourceMember;
use JsonApiPhp\JsonApi\Internal\ToManyMember;
use JsonApiPhp\JsonApi\Internal\ToOneMember;

final class ToMany implements ResourceMember
{
    use ResourceFieldTrait;
    /**
     * @var ToOneMember[]
     */
    private $members;

    public function __construct(string $name, ToManyMember ...$members)
    {
        $this->validateFieldName($name);
        $this->name = $name;
        $this->members = $members;
    }

    public function attachTo(object $o)
    {
        $rel = child(child($o, 'relationships'), $this->name);
        $rel->data = [];
        foreach ($this->members as $member) {
            if ($member instanceof ResourceIdentifier) {
                $member->attachToCollection($rel);
            } else {
                $member->attachTo($rel);
            }
        }
    }

    public function registerIdentifier(IdentifierRegistry $registry)
    {
        foreach ($this->members as $member) {
            if ($member instanceof Identifier) {
                $member->registerIn($registry);
            }
        }
    }
}
