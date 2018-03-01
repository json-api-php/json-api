<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\ResourceObject;

use JsonApiPhp\JsonApi\PrimaryData\Identifier;

/**
 * @internal
 */
final class IdentifierRegistry implements Identifier
{
    private $ids = [];

    public function add(string $id): void
    {
        $this->ids[$id] = true;
    }

    public function has(string $id): bool
    {
        return isset($this->ids[$id]);
    }

    public function registerIn(IdentifierRegistry $registry)
    {
        $registry->ids = array_merge($registry->ids, $this->ids);
    }
}
