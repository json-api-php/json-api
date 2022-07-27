<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Internal;

use function JsonApiPhp\JsonApi\isValidName;

/**
 * @internal
 */
trait ResourceFieldTrait {
    private readonly string $name;

    private function validateFieldName(string $fieldName): void {
        if (isValidName($fieldName) === false) {
            throw new \DomainException("Invalid character in a member name '$fieldName'");
        }
        if ($fieldName === 'id' || $fieldName === 'type') {
            throw new \DomainException("Can not use '$fieldName' as a resource field");
        }
    }

    public function name(): string {
        return $this->name;
    }
}
