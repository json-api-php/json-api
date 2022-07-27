<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Internal\ErrorMember;

final class Title implements ErrorMember {
    /**
     * @param string $title a short, human-readable summary of the problem that SHOULD NOT change from occurrence
     *                      to occurrence of the problem, except for purposes of localization
     */
    public function __construct(private readonly string $title) {
    }

    /**
     * @param object $o
     * @internal
     */
    public function attachTo(object $o): void {
        $o->title = $this->title;
    }
}
