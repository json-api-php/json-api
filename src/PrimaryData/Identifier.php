<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use JsonApiPhp\JsonApi\ResourceObject;

/**
 * @internal
 */
interface Identifier
{
    public function identifies(ResourceObject $resource): bool;
}
