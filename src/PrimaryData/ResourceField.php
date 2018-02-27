<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use JsonApiPhp\JsonApi\AttachableValue;
use function JsonApiPhp\JsonApi\isValidName;

/**
 * @internal
 */
abstract class ResourceField extends AttachableValue implements ResourceMember
{
    private $key;

    public function __construct(string $key, $value)
    {
        if (isValidName($key) === false) {
            throw new \DomainException("Invalid character in a member name '$key'");
        }
        if ($key === 'id' || $key === 'type') {
            throw new \DomainException("Can not use '$key' as a resource field");
        }
        parent::__construct($key, $value);
        $this->key = $key;
    }

    public function key(): string
    {
        return $this->key;
    }
}
