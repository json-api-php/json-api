<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Internal\ErrorMember;

final class Status implements ErrorMember {
    /**
     * @param string $status the HTTP status code applicable to this problem, expressed as a string value
     */
    public function __construct(private readonly string $status) {
    }

    /**
     * @param object $o
     * @internal
     */
    public function attachTo(object $o): void {
        $o->status = $this->status;
    }
}
