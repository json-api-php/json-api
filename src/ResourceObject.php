<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\FieldRegistry;
use JsonApiPhp\JsonApi\Internal\IdentifierRegistry;
use JsonApiPhp\JsonApi\Internal\IdentityTrait;
use JsonApiPhp\JsonApi\Internal\PrimaryData;
use JsonApiPhp\JsonApi\Internal\ResourceMember;

final class ResourceObject implements PrimaryData
{
    use IdentityTrait;
    private $obj;
    private $registry;

    public function __construct(string $type, string $id = null, ResourceMember ...$members)
    {
        if (isValidName($type) === false) {
            throw new \DomainException("Invalid type value: $type");
        }
        $this->type = $type;
        $this->id = $id;
        $this->registry = new IdentifierRegistry();
        $this->obj = (object) ['type' => $type, 'id' => $id];
        $fields = new FieldRegistry();
        foreach ($members as $member) {
            $member->registerField($fields);
            $member->registerIdentifier($this->registry);
            $member->attachTo($this->obj);
        }
    }

    public function toIdentifier(): ResourceIdentifier
    {
        return new ResourceIdentifier($this->type, $this->id);
    }

    public function registerIn(IdentifierRegistry $registry)
    {
        $registry->merge($this->registry);
    }

    public function attachTo(object $o)
    {
        $o->data = $this->obj;
    }

    public function attachAsIncludedTo(object $o): void
    {
        $o->included[] = $this->obj;
    }

    public function attachToCollection(object $o): void
    {
        $o->data[] = $this->obj;
    }
}
