<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Internal\ErrorMember;

final class Code implements ErrorMember {
    /**
     * @param string $code an application-specific error code, expressed as a string value
     */
    public function __construct(private readonly string $code) {
    }

    /**
     * @param object $o
     * @internal
     */
    public function attachTo(object $o): void {
        $o->code = $this->code;
    }
}
