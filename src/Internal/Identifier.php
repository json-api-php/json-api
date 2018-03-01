<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Internal;

/**
 * @internal
 */
interface Identifier
{
    public function registerIn(IdentifierRegistry $registry);
}
