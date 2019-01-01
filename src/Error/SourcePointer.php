<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Internal\ErrorMember;
use function JsonApiPhp\JsonApi\child;

final class SourcePointer implements ErrorMember
{
    private $pointer;

    /**
     * @param string $pointer JSON Pointer [RFC6901] to the associated entity in the request document
     */
    public function __construct(string $pointer)
    {
        $this->pointer = $pointer;
    }

    /**
     * @param object $o
     */
    public function attachTo($o): void
    {
        child($o, 'source')->pointer = $this->pointer;
    }
}
