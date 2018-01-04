<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

class JsonSerializableValue implements \JsonSerializable
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function jsonSerialize()
    {
        return $this->value;
    }
}