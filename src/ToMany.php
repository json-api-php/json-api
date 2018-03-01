<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\Identifier;
use JsonApiPhp\JsonApi\PrimaryData\ResourceField;
use JsonApiPhp\JsonApi\ResourceObject\IdentifierRegistry;

final class ToMany extends ResourceField implements Identifier
{
    /**
     * @var ToOneMember[]
     */
    private $members;

    public function __construct(string $name, ToManyMember ...$members)
    {
        parent::__construct($name);
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

    public function identifies(ResourceObject $resource): bool
    {
        foreach ($this->members as $member) {
            if ($member instanceof Identifier && $member->identifies($resource)) {
                return true;
            }
        }
        return false;
    }

    public function registerIdentifier(IdentifierRegistry $registry)
    {
        $registry->register($this);
    }
}
