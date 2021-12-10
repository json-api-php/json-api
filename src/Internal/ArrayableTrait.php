<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Internal;

use function JsonApiPhp\JsonApi\oToArray;

/**
 * @internal
 */
trait ArrayableTrait
{
    public function toArray(): array
    {
        return oToArray($this);
    }
}
