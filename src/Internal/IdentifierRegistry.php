<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Internal;

/**
 * @internal
 */
final class IdentifierRegistry
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
    public function merge(IdentifierRegistry $registry)
    {
        $this->ids = array_merge($this->ids, $registry->ids);
    }
}
