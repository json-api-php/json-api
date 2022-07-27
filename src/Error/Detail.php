<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Internal\ErrorMember;

final class Detail implements ErrorMember {
    /**
     * @param string $detail a human-readable explanation specific to this occurrence of the problem.
     */
    public function __construct(private readonly string $detail) {
    }

    /**
     * @param object $o
     * @internal
     */
    public function attachTo(object $o): void {
        $o->detail = $this->detail;
    }
}
