<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Internal;

/**
 * @internal
 */
interface Attachable
{
    /**
     * @param object $o
     * @internal
     */
    public function attachTo($o): void;
}
