<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

/**
 * @internal
 */
class AttachableValue implements Attachable, \JsonSerializable
{
    private $key;
    private $value;

    public function __construct(string $key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public function attachTo(object $o)
    {
        $o->{$this->key} = $this;
    }

    public function jsonSerialize()
    {
        return $this->value;
    }
}
