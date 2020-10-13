<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Internal;

use function JsonApiPhp\JsonApi\isValidName;

/**
 * Class BaseResource
 * @internal
 */
class BaseResource implements Attachable
{
    /**
     * @var string
     */
    protected $type;
    protected $obj;
    protected $registry = [];

    public function __construct(string $type, ResourceMember ...$members)
    {
        if (isValidName($type) === false) {
            throw new \DomainException("Invalid type value: $type");
        }
        $this->obj = (object) ['type' => $type];
        $this->type = $type;

        $this->addMembers(...$members);
    }

    /**
     * @param ResourceMember ...$members
     * @internal
     */
    protected function addMembers(ResourceMember ...$members): void
    {
        $fields = [];
        foreach ($members as $member) {
            if ($member instanceof Identifier) {
                $member->registerIn($this->registry);
            }
            if ($member instanceof ResourceField) {
                $name = $member->name();
                if (isset($fields[$name])) {
                    throw new \LogicException("Field '$name' already exists'");
                }
                $fields[$name] = true;
            }
            $member->attachTo($this->obj);
        }
    }

    /**
     * @param object $o
     * @internal
     */
    public function attachTo($o): void
    {
        $o->data = $this->obj;
    }
}
