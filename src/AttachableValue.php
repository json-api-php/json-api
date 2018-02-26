<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

/**
 * @internal
 */
class AttachableValue extends JsonSerializableValue implements Attachable
{
    private $key;

    public function __construct(string $key, $value)
    {
        parent::__construct($value);
        $this->key = $key;
    }

    public function attachTo(object $o)
    {
        $o->{$this->key} = $this;
    }
}
