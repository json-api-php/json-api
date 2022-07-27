<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use DomainException;
use JsonApiPhp\JsonApi\Internal\PrimaryData;

final class ResourceIdentifier implements PrimaryData {
    private readonly object $obj;

    public function __construct(string $type, string $id, Meta ...$metas) {
        if (isValidName($type) === false) {
            throw new DomainException("Invalid type value: $type");
        }
        $this->obj = (object)[
            'type' => $type,
            'id' => $id,
        ];
        foreach ($metas as $meta) {
            $meta->attachTo($this->obj);
        }
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
     * @internal
     */
    public function attachToCollection(object $o): void {
        $o->data[] = $this->obj;
    }
}
