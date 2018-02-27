<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Attachable;
use function JsonApiPhp\JsonApi\child;

final class Pointer implements Attachable, ErrorMember
{
    private $pointer;

    /**
     * @param string $pointer JSON Pointer [RFC6901] to the associated entity in the request document
     */
    public function __construct(string $pointer)
    {
        $this->pointer = $pointer;
    }

    public function attachTo(object $o)
    {
        child($o, 'source')->pointer = $this;
    }

    public function jsonSerialize()
    {
        return $this->pointer;
    }
}
