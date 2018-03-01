<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use JsonApiPhp\JsonApi\ResourceObject\IdentifierRegistry;

/**
 * @internal
 */
interface Identifier
{
    public function registerIn(IdentifierRegistry $registry);
}
