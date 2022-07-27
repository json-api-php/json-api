<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Internal\ErrorMember;

use function JsonApiPhp\JsonApi\child;

final class SourcePointer implements ErrorMember {
    /**
     * @param string $pointer JSON Pointer [RFC6901] to the associated entity in the request document
     */
    public function __construct(private readonly string $pointer) {
    }

    /**
     * @param object $o
     * @internal
     */
    public function attachTo(object $o): void {
        child($o, 'source')->pointer = $this->pointer;
    }
}
