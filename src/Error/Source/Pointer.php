<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error\Source;

use JsonApiPhp\JsonApi\AttachableValue;

final class Pointer
    extends AttachableValue
    implements SourceMember
{
    /**
     * @param string $pointer JSON Pointer [RFC6901] to the associated entity in the request document
     */
    public function __construct(string $pointer)
    {
        parent::__construct('pointer', $pointer);
    }
}