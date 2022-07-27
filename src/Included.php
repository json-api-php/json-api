<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\Attachable;
use JsonApiPhp\JsonApi\Internal\PrimaryData;
use LogicException;

/**
 * A set of included resources.
 */
final class Included implements Attachable {
    /**
     * @var ResourceObject[]
     */
    private array $resources;

    public function __construct(ResourceObject ...$resources) {
        foreach ($resources as $resource) {
            $key = $resource->key();
            if (isset($this->resources[$key])) {
                throw new LogicException("Resource $resource is already included");
            }
            $this->resources[$key] = $resource;
        }
    }

    /**
     * @param object $o
     * @internal
     */
    public function attachTo(object $o): void {
        foreach ($this->resources as $resource) {
            $resource->attachAsIncludedTo($o);
        }
    }
}
