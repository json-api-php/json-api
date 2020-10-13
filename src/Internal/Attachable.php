<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Internal;

/**
 * @internal
 */
interface Attachable
{
    /**
     * Adds this object's data to $o
     * @param object $o
     * @internal
     */
    public function attachTo($o): void;
}
