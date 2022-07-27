<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\PaginationLink;
use JsonApiPhp\JsonApi\Internal\ToManyMember;

class Pagination implements ToManyMember {
    /**
     * @var PaginationLink[]
     */
    private readonly array $links;

    public function __construct(PaginationLink ...$links) {
        $this->links = $links;
    }

    /**
     * @param object $o
     * @internal
     */
    public function attachTo(object $o): void {
        foreach ($this->links as $link) {
            $link->attachTo($o);
        }
    }
}
