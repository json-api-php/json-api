<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Error\Source;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;

class Pointer extends JsonSerializableValue implements SourceMember
{
    /**
     * @param string $pointer JSON Pointer [RFC6901] to the associated entity in the request document
     */
    public function __construct(string $pointer)
    {
        parent::__construct($pointer);
    }

    final public function toName(): string
    {
        return 'pointer';
    }
}