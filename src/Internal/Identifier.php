<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Internal;

/**
 * @internal
 */
interface Identifier
{
    /**
     * @internal
     * @param array $registry
     */
    public function registerIn(array &$registry): void;
}
