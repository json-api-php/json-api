<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

use JsonApiPhp\JsonApi\ResourceObject\FieldRegistry;
use function JsonApiPhp\JsonApi\isValidName;

/**
 * @internal
 */
abstract class ResourceField implements ResourceMember
{
    protected $name;

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

    public function registerResourceField(FieldRegistry $registry)
    {
        $registry->register($this->name);
    }
}
