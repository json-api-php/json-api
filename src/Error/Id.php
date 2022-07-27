<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Internal\ErrorMember;

final class Id implements ErrorMember {
    /**
     * @param string $id a unique identifier for this particular occurrence of the problem
     */
    public function __construct(private readonly string $id) {
    }

    /**
     * @param object $o
     * @internal
     */
    public function attachTo(object $o): void {
        $o->id = $this->id;
    }
}
