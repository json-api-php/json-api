<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\PrimaryData;
use JsonApiPhp\JsonApi\PrimaryData\ResourceMember;
use JsonApiPhp\JsonApi\ResourceObject\FieldRegistry;
use JsonApiPhp\JsonApi\ResourceObject\IdentifierRegistry;

final class ResourceObject implements PrimaryData
{
    private $type;
    private $id;
    private $obj;
    private $identifiers;

    public function __construct(string $type, string $id = null, ResourceMember ...$members)
    {
        $this->type = $type;
        $this->id = $id;
        $this->identifiers = new IdentifierRegistry();
        $this->obj = (object) ['type' => $type, 'id' => $id];
        $registry = new FieldRegistry();
        foreach ($members as $member) {
            $member->registerResourceField($registry);
            $member->registerIdentifier($this->identifiers);
            $member->attachTo($this->obj);
        }
    }

    public function toIdentifier(): ResourceIdentifier
    {
        return new ResourceIdentifier($this->type, $this->id);
    }

    public function identifies(ResourceObject $resource): bool
    {
        return $this->identifiers->identifies($resource);
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

    public function uniqueId(): string
    {
        return "{$this->type}:{$this->id}";
    }
}
