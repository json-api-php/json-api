<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\ResourceObject;

/**
 * @internal
 */
final class FieldRegistry
{
    protected $keys = [];

    public function register(string $key): void
    {
        if (isset($this->keys[$key])) {
            throw new \LogicException("Field '$key' already exists'");
        }
        $this->keys[$key] = true;
    }
}