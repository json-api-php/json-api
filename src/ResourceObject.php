<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\BaseResource;
use JsonApiPhp\JsonApi\Internal\PrimaryData;
use JsonApiPhp\JsonApi\Internal\ResourceMember;

final class ResourceObject extends BaseResource implements PrimaryData {
    public function __construct(string $type, private readonly string $id, ResourceMember ...$members) {
        parent::__construct($type, ...$members);
        $this->obj->id = $id;
        $this->type = $type;
    }

    public function identifier(): ResourceIdentifier {
        return new ResourceIdentifier($this->type, $this->id);
    }

    public function key(): string {
        return compositeKey($this->type, $this->id);
    }

    /**
     * @param object $o
     * @internal
     */
    public function attachTo(object $o): void {
        $o->data = $this->obj;
    }

    /**
     * @param object $o
     */
    public function attachAsIncludedTo(object $o): void {
        $o->included[] = $this->obj;
    }

    /**
     * @param object $o
     * @internal
     */
    public function attachToCollection(object $o): void {
        $o->data[] = $this->obj;
    }

    public function __toString(): string {
        return $this->key();
    }
}
