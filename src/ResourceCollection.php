<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\Collection;
use JsonApiPhp\JsonApi\Internal\PrimaryData;

class ResourceCollection implements PrimaryData, Collection {
    /**
     * @var ResourceObject[]
     */
    private readonly array $resources;

    public function __construct(ResourceObject ...$resources) {
        $this->resources = $resources;
    }

    /**
     * @param object $o
     * @internal
     */
    public function attachTo(object $o): void {
        $o->data = [];
        foreach ($this->resources as $resource) {
            $resource->attachToCollection($o);
        }
    }
}
