<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

class ReservedName extends MemberName
{
    public function __construct(string $name)
    {
        parent::__construct($name);
        if ($this->isReservedName($name)) {
            throw new \InvalidArgumentException("Can not use a reserved name '$name'");
        }
    }

    private function isReservedName(string $name): bool
    {
        return in_array($name, ['id', 'type']);
    }
}
