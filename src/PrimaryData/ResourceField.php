<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use function JsonApiPhp\JsonApi\isValidName;

/**
 * @internal
 */
abstract class ResourceField implements ResourceMember
{
    private $name;

    public function __construct(string $name)
    {
        if (isValidName($name) === false) {
            throw new \DomainException("Invalid character in a member name '$name'");
        }
        if ($name === 'id' || $name === 'type') {
            throw new \DomainException("Can not use '$name' as a resource field");
        }
        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }
}
