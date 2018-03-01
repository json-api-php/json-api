<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Internal;

use function JsonApiPhp\JsonApi\isValidName;

/**
 * @internal
 */
trait ResourceFieldTrait
{
    private $name;

    private function validateFieldName(string $name): void
    {
        if (isValidName($name) === false) {
            throw new \DomainException("Invalid character in a member name '$name'");
        }
        if ($name === 'id' || $name === 'type') {
            throw new \DomainException("Can not use '$name' as a resource field");
        }
    }

    public function name(): string
    {
        return $this->name;
    }
}
