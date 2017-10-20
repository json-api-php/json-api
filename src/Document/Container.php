<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

class Container implements \JsonSerializable, \IteratorAggregate
{
    private $data;

    public function set(MemberName $name, $value)
    {
        if (! $this->data) {
            $this->data = (object) [];
        }
        $this->data->$name = $value;
    }

    public function getIterator(): \Traversable
    {
        return $this->data;
    }

    public function jsonSerialize()
    {
        return $this->data;
    }
}
