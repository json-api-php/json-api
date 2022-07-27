<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\Internal\LinkTrait;
use JsonApiPhp\JsonApi\Internal\PaginationLink;

use function JsonApiPhp\JsonApi\child;

final class PrevLink implements PaginationLink {
    use LinkTrait;

    /**
     * @param object $o
     * @internal
     */
    public function attachTo(object $o): void {
        child($o, 'links')->prev = $this->link;
    }
}
