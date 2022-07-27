<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Internal\ErrorMember;

use function JsonApiPhp\JsonApi\child;

final class SourceParameter implements ErrorMember {
    /**
     * @param string $parameter a string indicating which URI query parameter caused the error.
     */
    public function __construct(private readonly string $parameter) {
    }

    /**
     * @param object $o
     * @internal
     */
    public function attachTo(object $o): void {
        child($o, 'source')->parameter = $this->parameter;
    }
}
