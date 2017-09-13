<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

class Meta implements \JsonSerializable
{
    private $data;

    public function __construct(\stdClass $data)
    {
        $this->data = $data;
    }

    public static function fromArray(array $array): self
    {
        return new self((object) $array);
    }

    public function jsonSerialize()
    {
        return $this->data;
    }
}
