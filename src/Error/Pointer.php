<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use function JsonApiPhp\JsonApi\child;

final class Pointer implements ErrorMember
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
        child($o, 'source')->pointer = $this->pointer;
    }
}
