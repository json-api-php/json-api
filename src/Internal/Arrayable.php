<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Internal;

/**
 * @internal
 */
interface Arrayable
{
    /**
     * @internal
     */
    public function toArray(): array;
}
