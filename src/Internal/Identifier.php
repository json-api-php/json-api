<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Internal;

/**
 * @internal
 */
interface Identifier
{
    /**
     * @param array $registry
     * @internal
     */
    public function registerIn(array &$registry): void;
}
