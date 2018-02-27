<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use function JsonApiPhp\JsonApi\isValidName;

/**
 * @internal
 */
abstract class ResourceField implements ResourceMember
{
    private $key;
    private $value;

    public function __construct(string $key, $value)
    {
        if (isValidName($key) === false) {
            throw new \DomainException("Invalid character in a member name '$key'");
        }
        if ($key === 'id' || $key === 'type') {
            throw new \DomainException("Can not use '$key' as a resource field");
        }
        $this->key = $key;
        $this->value = $value;
    }

    public function key(): string
    {
        return $this->key;
    }

    public function attachTo(object $o)
    {
        $o->{$this->key} = $this->value;
    }

    public function jsonSerialize()
    {
        return $this->value;
    }
}
