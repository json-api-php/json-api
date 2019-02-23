<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\Identifier;
use JsonApiPhp\JsonApi\Internal\PrimaryData;
use JsonApiPhp\JsonApi\Internal\ResourceField;
use JsonApiPhp\JsonApi\Internal\ResourceMember;

final class ResourceObject implements PrimaryData
{
    private $obj;
    private $registry = [];
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $id;

    public function __construct(string $type, string $id, ResourceMember ...$members)
    {
        if (isValidName($type) === false) {
            throw new \DomainException("Invalid type value: $type");
        }
        $this->obj = (object) ['type' => $type, 'id' => $id];
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
        $this->type = $type;
        $this->id = $id;
    }

    public function identifier(): ResourceIdentifier
    {
        return new ResourceIdentifier($this->type, $this->id);
    }

    public function key(): string
    {
        return compositeKey($this->type, $this->id);
    }

    public function registerIn(array &$registry): void
    {
        $registry = array_merge($registry, $this->registry);
    }

    /**
     * @param object $o
     */
    public function attachTo($o): void
    {
        $o->data = $this->obj;
    }

    /**
     * @param object $o
     */
    public function attachAsIncludedTo($o): void
    {
        $o->included[] = $this->obj;
    }

    /**
     * @param object $o
     */
    public function attachToCollection($o): void
    {
        $o->data[] = $this->obj;
    }

    public function __toString(): string
    {
        return $this->key();
    }
}
