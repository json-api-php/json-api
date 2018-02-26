<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\AttachableValue;
use function JsonApiPhp\JsonApi\child;

final class Pointer extends AttachableValue implements Member
{
    /**
     * @param string $pointer JSON Pointer [RFC6901] to the associated entity in the request document
     */
    public function __construct(string $pointer)
    {
        parent::__construct('pointer', $pointer);
    }

    public function attachTo(object $o)
    {
        parent::attachTo(child($o, 'source'));
    }
}
