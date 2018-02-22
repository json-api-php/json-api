<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

abstract class AttachableValue
    extends JsonSerializableValue
    implements Attachable
{
    private $name;

    public function __construct(string $name, $value)
    {
        parent::__construct($value);
        $this->name = $name;
    }

    function attachTo(object $o)
    {
        $o->{$this->name} = $this;
    }
}