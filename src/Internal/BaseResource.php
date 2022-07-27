<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Internal;

use DomainException;
use LogicException;

use function JsonApiPhp\JsonApi\isValidName;

/**
 * Class BaseResource
 * @internal
 */
class BaseResource implements Attachable {
    protected object $obj;
    protected array $registry = [];

    public function __construct(protected string $type, ResourceMember ...$members) {
        if (isValidName($type) === false) {
            throw new DomainException("Invalid type value: $type");
        }
        $this->obj = (object)['type' => $type];

        $this->addMembers(...$members);
    }

    /**
     * @param ResourceMember ...$members
     * @internal
     */
    protected function addMembers(ResourceMember ...$members): void {
        $fields = [];
        foreach ($members as $member) {
            if ($member instanceof ResourceField) {
                $name = $member->name();
                if (isset($fields[$name])) {
                    throw new LogicException("Field '$name' already exists'");
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
    public function attachTo(object $o): void {
        $o->data = $this->obj;
    }
}
