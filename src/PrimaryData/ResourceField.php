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
        if (preg_match('/^(?=[^-_ ])[a-zA-Z0-9\x{0080}-\x{FFFF}-_ ]*(?<=[^-_ ])$/u', $key) !== 1) {
            throw new \DomainException("Invalid character in a member name '$key'");
        }
        if ($this->isReservedWord($key)) {
            throw new \DomainException("Can not use '$key' as a resource field");
        }
        parent::__construct($key, $value);
        $this->key = $key;
    }

    private function isReservedWord(string $key): bool
    {
        return in_array($key, ['id', 'type']);
    }

    public function toKey(): string
    {
        return $this->key;
    }
}
