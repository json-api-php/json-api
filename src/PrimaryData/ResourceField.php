<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use JsonApiPhp\JsonApi\AttachableValue;

/**
 * @internal
 */
abstract class ResourceField extends AttachableValue implements ResourceMember
{
    private $key;

    public function __construct(string $key, $value)
    {
        if ($this->isReservedWord($key)) {
            throw new \DomainException("Can not use '$key' as a resource field");
        }
        parent::__construct($key, $value);
        $this->key = $key;
    }

    public function toKey(): string
    {
        return $this->key;
    }

    private function isReservedWord(string $key): bool
    {
        return in_array($key, ['id', 'type']);
    }
}
