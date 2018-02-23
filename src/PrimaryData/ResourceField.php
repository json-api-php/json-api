<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use JsonApiPhp\JsonApi\AttachableValue;

/**
 * @internal
 */
abstract class ResourceField extends AttachableValue implements ResourceMember
{
    public function __construct(string $key, $value)
    {
        if ($this->isReservedWord($key)) {
            throw new \DomainException("Can not use '$key' as a resource field");
        }
        parent::__construct($key, $value);
    }

    private function isReservedWord(string $key): bool
    {
        return in_array($key, ['id', 'type']);
    }
}