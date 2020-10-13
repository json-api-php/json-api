<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\BaseResource;
use JsonApiPhp\JsonApi\Internal\PrimaryData;
use JsonApiPhp\JsonApi\Internal\ResourceMember;

final class ResourceObject extends BaseResource implements PrimaryData
{
    /**
     * @var string
     */
    private $id;

    public function __construct(string $type, string $id, ResourceMember ...$members)
    {
        parent::__construct($type, ...$members);
        $this->obj->id = $id;
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
     * @internal
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
     * @internal
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
